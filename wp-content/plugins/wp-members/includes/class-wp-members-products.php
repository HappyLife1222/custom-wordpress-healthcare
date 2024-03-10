<?php
/**
 * The WP_Members Membership Products Class.
 *
 * This is the main WP_Members object class. This class contains functions
 * for loading settings, shortcodes, hooks to WP, plugin dropins, constants,
 * and registration fields. It also manages whether content should be blocked.
 *
 * @package WP-Members
 * @subpackage WP_Members Membership Products Object Class
 * @since 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class WP_Members_Products {

	/**
	 * Product post type.
	 *
	 * @since  3.4.0
	 * @access public
	 * @var    string
	 */
	public $post_type = 'wpmem_product';
	
	/**
	 * Product meta key.
	 *
	 * @since  3.2.0
	 * @access public
	 * @var    string
	 */
	public $post_meta = '_wpmem_products';

	/**
	 * Product meta key stem.
	 *
	 * @since  3.2.0
	 * @access public
	 * @var    string
	 */
	public $post_stem = '_wpmem_products_';

	/**
	 * The admin object. 
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $admin;
	
	/**
	 * Product details.
	 *
	 * @since  3.2.0
	 * @access public
	 * @var    array {
	 *     Array of membership product information.
	 *
	 *     @type array $product_slug {
	 *         Array of membership product settings.
	 *
	 *         @type string $title   The product title (user view).
	 *         @type string $role    User role, if a role is required.
	 *         @type string $name    The product slug.
	 *         @type string $default
	 *         @type array  $expires {
	 *              If the membership has expiration periods.
	 *
	 *              $type string number|period Number of periods|Period (year/month/week/day).
	 *         }
	 *     }
	 * }
	 */
	public $products = array();

	/**
	 * Product meta keyed by ID.
	 *
	 * @since  3.2.4
	 * @access public
	 * @var    array {
	 *     Array of membership products keyed by CPT ID.
	 *
	 *     @type string $ID The membership product slug.
	 * }
	 */
	public $product_by_id = array();
	
	/**
	 * Class constructor.
	 *
	 * @since 3.2.0
	 *
	 * @global object $wpmem The WP_Members object class.
	 */
	function __construct() {
		
		$this->load_products();
		
		add_filter( 'wpmem_securify',               array( $this, 'product_access' ) );
		add_filter( 'wpmem_product_restricted_msg', array( $this, 'apply_custom_access_message' ), 10, 2 );
		add_filter( 'wpmem_restricted_msg',         array( $this, 'apply_custom_access_message' ), 10, 4 );
		add_filter( 'wpmem_email_shortcodes',       array( $this, 'email_shortcodes' ), 10, 3 );

		add_shortcode( 'wpmem_user_memberships',      array( $this, 'sc_show_memberships'       ) );
		add_shortcode( 'wpmem_user_membership_posts', array( $this, 'sc_show_membership_posts' ) );
	}
	
	/**
	 * Loads product settings.
	 *
	 * @since 3.2.0
	 *
	 * @global object $wpdb The WPDB object class.
	 */
	function load_products() {
		global $wpdb;
		$sql = "SELECT ID, post_title, post_name FROM " 
			. $wpdb->prefix 
			. "posts WHERE post_type = 'wpmem_product' AND post_status = 'publish';";
		$result = $wpdb->get_results( $sql );
		foreach ( $result as $plan ) {
			$this->product_by_id[ $plan->ID ] = $plan->post_name;
			$this->products[ $plan->post_name ]['title'] = $plan->post_title;			
			$post_meta = get_post_meta( $plan->ID );
			foreach ( $post_meta as $key => $meta ) {
				if ( false !== strpos( $key, 'wpmem_product' ) ) {
					if ( 'wpmem_product_expires' == $key ) {
						$meta[0] = unserialize( $meta[0] );
					}
					if ( 'wpmem_product_fixed_period' == $key ) {
						$meta[0] = $this->explode_fixed_period( $meta[0] );
					}
					$this->products[ $plan->post_name ][ str_replace( 'wpmem_product_', '', $key ) ] = $meta[0];
				}
			}
		}
	}
	
	/**
	 * Gets products assigned to a post.
	 *
	 * @since 3.2.4
	 *
	 * @param  integer $post_id
	 * @return array   $products {
	 *     Membership product slugs the post is restricted to.
	 *
	 *     @type string $slug
	 * }
	 */
	function get_post_products( $post_id ) {
		$products = get_post_meta( $post_id, $this->post_meta, true );
		/**
		 * Filter product access by post ID.
		 *
		 * @since 3.3.5
		 *
		 * @param array $post_products
		 * @param int   $post_id
		 */
		$products = apply_filters( 'wpmem_post_products', $products, $post_id );
		return $products;
	}

	/**
	 * Gets default membership products.
	 *
	 * @since 3.3.0
	 *
	 * @return array $defaults
	 */
	function get_default_products() {
		// Get any default membership products.
		$args = array(
			'numberposts' => -1,
			'post_type'   => $this->post_type,
			'meta_key'    => 'wpmem_product_default',
			'meta_value'  => 1,
			'fields'      => array( 'post_name' ),
		);
		$default_products = get_posts( $args );
		$defaults = array();
		if ( $default_products ) {
			foreach ( $default_products as $product ) {
				$defaults[] = $product->post_name;
			}
		}
		return $defaults;
	}

	/**
	 * Sets up custom access restriction by product.
	 *
	 * @since 3.2.0
	 * @since 3.2.2 Merged check_product_access() logic for better messaging.
	 *
	 * @global object $post    The WordPress Post object.
	 * @global object $wpmem   The WP_Members object class.
	 * @param  string $content
	 * @return string $content
	 */
	function product_access( $content ) {
		
		global $post, $wpmem;
		// Is the user logged in and is this blocked content?
		if ( ! is_admin() && is_user_logged_in() && wpmem_is_blocked() && 1 == $wpmem->enable_products ) {  // @todo Should is_admin() check be run on securify in general?

			// Get the post access products.
			$post_products = $this->get_post_products( $post->ID );
			// If the post is restricted to a product.
			if ( is_array( $post_products ) && ! empty( $post_products ) ) {
				$access = ( wpmem_user_has_access( $post_products ) ) ? true : false;
			} else {
				$access = true;
			}
		
			// Only produce the product restricted message if access is false.
			if ( false === $access ) {

				// Set up excerpt if excerpts are set to display.
				$excerpt = '';
				if ( isset( $wpmem->show_excerpt[ $post->post_type ] ) && 1 == $wpmem->show_excerpt[ $post->post_type ] ) {

					// @todo Can this be condensed or eliminated?
					$len = strpos( $content, '<span id="more' );
					if ( false === $len ) {
						$excerpt = wpmem_do_excerpt( $content );
					} else {
						$excerpt = substr( $content, 0, $len );
					}
				}

				$message = wpmem_get_access_message( $post_products );

				/**
				 * Filter the product restricted message HTML.
				 *
				 * @since 3.3.3
				 * @since 3.3.4 Added $post_products
				 * @since 3.4.4 Added $excerpt
				 *
				 * @param array  $product_restricted {
				 *     $type string $wrapper_before
				 *     $type string $message
				 *     $type string $wrapper_after
				 * }
				 * @param array  $post_products {
				 *     Membership product slugs the post is restricted to.
				 *
				 *     @type string $slug
				 * }
				 */
				$product_restricted = apply_filters( 'wpmem_product_restricted_args', array(
					'excerpt'        => $excerpt,
					'wrapper_before' => '<div class="wpmem_msg">',
					'message'        => $message,
					'wrapper_after'  => '</div>',
				), $post_products );
				
				$content = $product_restricted['excerpt'] . $product_restricted['wrapper_before'] . $product_restricted['message'] . $product_restricted['wrapper_after'];
			
				// Handle comments.
				add_filter( 'wpmem_securify_comments', '__return_false' );
			}

		}

		return $content;
	}

	/**
	 * Gets the access message if user does not have required membership.
	 *
	 * @since 3.4.0
	 *
	 * @param  array  $post_products
	 * @return string $message
	 */
	function get_access_message( $post_products ) {
		// Singular message if post only has one membership, otherwise multiple.
		if ( 1 == count( $post_products ) ) {
			$message = wpmem_get_text( 'product_restricted_single' )
				. "<br />" . wpmem_get_membership_name( $post_products[0] );
		} else {
			$message = wpmem_get_text( 'product_restricted_multiple' ) . "<br />";
			foreach ( $post_products as $post_product ) {
				$message .= wpmem_get_membership_name( $post_product ) . "<br />";
			}
		}
		/**
		 * Filter the product restricted message.
		 *
		 * @since 3.2.3
		 *
		 * @param string                The message.
		 * @param array  $post_products {
		 *     Membership product slugs the post is restricted to.
		 *
		 *     @type string $slug
		 * }
		 */
		$message = apply_filters( 'wpmem_product_restricted_msg', $message, $post_products );
		return $message;
	}
	
	/**
	 * Filters the access message if the user does not have
	 * access to this membership.
	 *
	 * @since 3.3.4
	 * @since 3.4.0 Renamed from access_message().
	 *
	 * @global stdClass $post
	 * @param  string   $msg
	 * @return string   $msg
	 */
	function apply_custom_access_message( $msg, $mixed, $before = false, $after = false ) {
		global $post;
		// If this is "wpmem_restricted_msg", second arg is the raw msg string, not post products
		$post_products =  ( ! is_array( $mixed ) && false != $before && false != $after ) ? $this->get_post_products( $post->ID ) : $mixed;
		if ( $post_products ) {
			$product_message = false;
			$count = count( $post_products );
			foreach( $post_products as $post_product ) {
				$membership_id = array_search( $post_product, $this->product_by_id );
				$message = get_post_meta( $membership_id, 'wpmem_product_message', true );
				if ( $message ) {
					$product_message = ( isset( $product_message ) ) ? $product_message . wpautop( $message ) : wpautop( $message );
				}
			}
			if ( false !== $product_message ) {
				$msg = ( $before ) ? '<div id="wpmem_restricted_msg">' : '';
				$msg.= do_shortcode( $product_message );
				$msg.= ( $after  ) ? '</div>' : '';
			}
		}
		return $msg;
	}
	
	/**
	 * Register Membership Plans Custom Post Type
	 *
	 * @since 3.2.0
	 *
	 * @global object $wpmem The WP_Members object class.
	 */
	function add_cpt() {
		
		global $wpmem;
		
		$args = array( 'capabilities' => 'manage_options', );
		/**
		 * Filter customizable elements of the membership custom post type.
		 *
		 * @since 3.3.5
		 *
		 * @param array
		 */
		$args = apply_filters( 'wpmem_membership_cpt_args', $args );
		
		$singular = __( 'Membership', 'wp-members' );
		$plural   = __( 'Memberships', 'wp-members' );

		$labels = array(
			'name'                  => $plural,
			'singular_name'         => $singular,
			'menu_name'             => __( 'Memberships', 'wp-members' ),
			'all_items'             => sprintf( __( 'All %s', 'wp-members' ), $plural ),
			'add_new_item'          => sprintf( __( 'Add New %s', 'wp-members' ), $singular ),
			'add_new'               => __( 'Add New', 'wp-members' ),
			'new_item'              => sprintf( __( 'New %s', 'wp-members' ), $singular ),
			'edit_item'             => sprintf( __( 'Edit %s', 'wp-members' ), $singular ),
			'update_item'           => sprintf( __( 'Update %s', 'wp-members' ), $singular ),
			'view_item'             => sprintf( __( 'View %s', 'wp-members' ), $singular ),
			'view_items'            => sprintf( __( 'View %s', 'wp-members' ), $plural ),
			'search_items'          => sprintf( __( 'Search %s', 'wp-members' ), $plural ),
			'not_found'             => __( 'Not found', 'wp-members' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-members' ),
			'insert_into_item'      => __( 'Insert into item', 'wp-members' ),
			'publish'               => sprintf( __( 'Save %s Details', 'wp-members' ), $singular ),
			'attributes'            => __( 'Membership Attributes', 'wp-members' ),
		);
		$args = array(
			'label'                 => __( 'Membership Product', 'wp-members' ),
			'description'           => __( 'WP-Members Membership Products', 'wp-members' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'page-attributes' ),
			'hierarchical'          => true,
			'public'                => false,
			'show_ui'               => ( $wpmem->enable_products ) ? true : false,
			'show_in_menu'          => ( $wpmem->enable_products ) ? true : false,
			'menu_position'         => 58,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'query_var'             => 'membership_product',
			'rewrite'               => false,
			'capability_type'       => 'page',
			'capabilities'          => array(
				'publish_posts' => $args['capabilities'],
				'edit_posts'    => $args['capabilities'],
				'delete_posts'  => $args['capabilities'],
				'edit_post'     => $args['capabilities'],
				'delete_post'   => $args['capabilities'],
				'read_post'     => $args['capabilities'],
			),
			'show_in_rest'          => false,
			//'register_meta_box_cb'  => '', // callback for meta box
		);
		register_post_type( $this->post_type, $args );
	}
	
	/**
	 * Get all posts tagged to a specified product.
	 *
	 * @since 3.3.0
	 *
	 * @global  stdClass      $wpdb
	 *
	 * @param   string        $product_meta
	 * @return  array|boolean $post_ids if not empty, otherwise false
	 */
	function get_all_posts( $product_meta ) {
		global $wpdb;
		$results = $wpdb->get_results( $wpdb->prepare( "
			SELECT post_id 
			FROM {$wpdb->postmeta} 
			WHERE meta_key = %s
			", $this->post_stem . $product_meta ), ARRAY_N );
		foreach ( $results as $result ) {
			$post_ids[] = $result[0];
		}
		return ( ! empty( $post_ids ) ) ? $post_ids : false;
	}
	
	/**
	 * Utility to explode fixed period.
	 *
	 * @since 3.3.5
	 */
	function explode_fixed_period( $array ) {
		$period_parts = explode( "-", $array );
		$period['start'] = ( $period_parts ) ? $period_parts[0] . '-' . $period_parts[1] : '';
		$period['end']   = ( $period_parts ) ? $period_parts[2] . '-' . $period_parts[3] : '';
		$period['grace']['num'] = ( $period_parts && isset( $period_parts[4] ) ) ? $period_parts[4] : '';
		$period['grace']['per'] = ( $period_parts && isset( $period_parts[5] ) ) ? $period_parts[5] : '';
		return $period;
	}
	
	/**
	 * Set an expiration date.
	 *
	 * @since 3.3.5
	 *
	 * @param  string  $product
	 * @param  int     $user_id
	 * @param  mixed   $set_date
	 * @param  mixed   $pre_value
	 * @param  boolean $renew
	 * @return mixed   $new_value
	 */
	function set_product_expiration( $product, $user_id, $set_date, $prev_value, $renew ) {
		// If this is setting a specific date.
		if ( $set_date ) {
			$new_value = strtotime( $set_date );
		} else {
			// Either setting initial expiration based on set time period, or adding to the existing date (renewal/extending).
			$raw_add = explode( "|", $this->products[ $product ]['expires'][0] );
			$add_period = ( 1 < $raw_add[0] ) ? $raw_add[0] . " " . $raw_add[1] . "s" : $raw_add[0] . " " . $raw_add[1];

			if ( $prev_value ) {
				if ( isset( $this->products[ $product ]['no_gap'] ) && 1 == $this->products[ $product ]['no_gap'] ) {
					// Add to the user's existing date (no gap).
					$new_value = strtotime( $add_period, $prev_value );					
				} else {
					// Add to the user either from end or now (whichever is later; i.e. allow gaps (default)).
					if ( wpmem_user_has_access( $product, $user_id ) ) {
						// if not expired, set from when they expire.
						$new_value = strtotime( $add_period, $prev_value );
					} else {
						// if expired, set from today.
						$new_value = strtotime( $add_period );
					}
				}
			} else {
				// User doesn't have this membershp. Go ahead and add it.
		
				// If we are using fixed period expiration, calculate the expiration date
				if ( isset( $this->products[ $product ] ) && isset( $this->products[ $product ]['fixed_period'] ) ) {
					// Calculate the fixed period expiration.
					$new_value = $this->calculate_fixed_period ( $product );
				} else {
					// Just add to the existing expiration.
					$new_value = strtotime( $add_period );
				}
			}
		}
		
		/**
		 * Filter the expiration date.
		 *
		 * @since 3.3.2
		 *
		 * @param int|boolean  $new_value  Unix timestamp of new expiration, true|false if not an expiry product.
		 * @param int|boolean  $prev_value The user's current value (prior to updating).
		 * @param boolean      $renew      Is this a renewal transaction?
		 */
		$new_value = apply_filters( 'wpmem_user_product_set_expiration', $new_value, $prev_value, $renew );
		
		return $new_value;
	}
	
	/**
	 * Calculate a fixed period expiration.
	 *
	 * @since 3.3.5
	 *
	 * @param string  $product
	 * @return string $timestamp
	 */
	function calculate_fixed_period( $product ) {
		// Use fixed period expiration.
		$end = $this->products[ $product ]['fixed_period']['end'];

		// Get the current year.
		$current_year = date( 'Y' );

		// Format period end date for current year.
		$cur_date = DateTime::createFromFormat( 'd-m-Y', $end . '-' . $current_year ); //DateTime( $start_date );

		// Where are we now?
		$now  = new DateTime();

		// If date is past, set next period.
		if ( $cur_date < $now ) {
			// Date is past.
			$next_year = date( 'Y', strtotime( '+1 year' ) );
			$next_date = DateTime::createFromFormat( 'd-m-Y', $end . '-' . $next_year );
			$new_value = $next_date->format( 'U' );
		} else {
			// Date is not past.
			// Are we using a grace period?
			if ( isset( $this->products[ $product ]['fixed_period']['grace'] ) && $this->products[ $product ]['fixed_period']['grace']['num'] > 0 ) {
				// Are we in the grace period?
				$grace_period = "-" . $this->products[ $product ]['fixed_period']['grace']['num'] . " " . $this->products[ $product ]['fixed_period']['grace']['per'];
				$grace_date   = DateTime::createFromFormat( 'U', strtotime( $grace_period, strtotime( $cur_date->format( 'd-m-Y' ) ) ) );
				if ( $grace_date < $now ) {
					// We are in grace period, set expiration as next year.
					$next_year = date( 'Y', strtotime( '+1 year' ) );
					$next_date = DateTime::createFromFormat( 'd-m-Y', $end . '-' . $next_year );
					$new_value = $next_date->format( 'U' );
				} else {
					// Not in grace period, set the current year.
					$new_value = $cur_date->format( 'U' );
				}
			} else {
				// No grace period, and date is not past. Use current year.
				$new_value = $cur_date->format( 'U' );
			}
		}
		
		return $new_value;
	}

	/**
	 * Adds [user_memberships] shortcode for use in the admin email
	 * 
	 * @since 3.4.4
	 * 
	 * @param  array  $shortcodes
	 * @param  string $tag
	 * @param  int    $user_id
	 * @return array  $shortcodes
	 */
	function email_shortcodes( $shortcodes, $tag, $user_id ) {
		global $wpmem;
		if ( 'notify' == $tag ) {
			$user_memberships  = wpmem_get_user_memberships( $user_id );
			$site_memberships  = wpmem_get_memberships();
			$email_memberships = ( $wpmem->email->html ) ? '<p><ul>' : "";
			foreach ( $user_memberships as $meta_key => $membership ) {
				/*
				 * In the odd situation where a user has a membership that does
				 * not exist in $site_memberships, such as if the user had the membership
				 * and the site later deleted it but it's still in the user's array,
				 * check for unknown values before outputting to avoid undefined errors.
				 */
				if ( isset( $site_memberships[ $meta_key ] ) ) {
					$email_memberships .= ( $wpmem->email->html ) ? "<li>" . esc_html( $site_memberships[ $meta_key ]['title'] ) . '</li>' : esc_attr( $site_memberships[ $meta_key ]['title'] ) . "\r\n";
				}
			}
			$email_memberships .= ( $wpmem->email->html ) ? '</ul>' : "";

			$shortcodes['memberships'] = $email_memberships;
		}
		return $shortcodes;
	}

	public function sc_show_memberships( $atts, $content, $tag ) {

		$pairs = array(
			'title_before' => '<h2>',
			'title_after'  => '</h2>',
			'title'        => __( 'Memberships', 'wp-members' ),
			'list_before'  => '<ul>',
			'list_after'   => '</ul>',
			'item_before'  => '<li>',
			'item_after'   => '</li>',
			'date_format'  => 'default',
			'no_expire'    => __( 'Does not expire', 'wp-members' ),
		);

		$args = shortcode_atts( $pairs, $atts, $tag );

		$content  = $args['title_before'] . $args['title'] . $args['title_after'];
		$content .= $args['list_before'];
		foreach ( wpmem_get_user_memberships() as $key => $value ) {
			
			$exp_date = wpmem_get_user_expiration( $key );
			if ( $exp_date > 1 ) {
				$exp_formatted = ( 'default' == $args['date_format'] ) ? wpmem_format_date( $exp_date ) : date( $args['date_format'], $exp_date );
			} else {
				$exp_formatted = $args['no_expire'];
			}

			if ( $value ) {
				$content .= $args['item_before'] . wpmem_get_membership_name( $key ) . " - " . $exp_formatted . $args['item_after'];
			}
		}
		$content .= $args['list_after'];
		return $content;
	}

	public function sc_show_membership_posts( $atts, $content, $tag ) {

		$pairs = array(
			'title_before' => '<h2>',
			'title_after'  => '</h2>',
			'list_before'  => '<ul>',
			'list_after'   => '</ul>',
			'item_before'  => '<li>',
			'item_after'   => '</li>',
		);

		$args = shortcode_atts( $pairs, $atts, $tag );

		// Go through each membership the user has.
		foreach ( wpmem_get_user_memberships() as $key => $value ) {
			
			// Get a list of content for this membership.
			$ids = wpmem_get_membership_post_list( $key );
			
			if ( $ids ) {

				$title = $args['title_before'] . wpmem_get_membership_name( $key ) . $args['title_after'];
				$post_list = $args['list_before'];
				foreach ( $ids as $id ) {
					$title = get_the_title( $id );
					$link  = '<a href="' . get_permalink( $id ) . '">' . $title . '</a>';
					$post_list .= $args['item_before'] . $link . $args['item_after'];
				}
				$post_list .= $args['list_after'];
				
				$content .= $title . $post_list;
			}
		}
	
		return $content;
	}
}