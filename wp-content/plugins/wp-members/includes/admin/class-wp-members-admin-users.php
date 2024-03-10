<?php
/**
 * The WP_Members Admin Users Class.
 *
 * @package WP-Members
 * @subpackage WP_Members Admin Users Object Class
 * @since 3.3.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class WP_Members_Admin_Users {

	/**
	 * Function to add activate/export to the bulk dropdown list.
	 *
	 * @since 2.8.2
	 */
	static function bulk_user_action() {
		global $wpmem; ?>
		<script type="text/javascript">
			var $j = jQuery.noConflict();
			$j(document).ready(function() {
		<?php if( $wpmem->mod_reg == 1 ) { ?>
			$j('<option>').val('activate').text('<?php _e( 'Activate', 'wp-members' )?>').appendTo("select[name='action']");
			$j('<option>').val('deactivate').text('<?php _e( 'Deactivate', 'wp-members' )?>').appendTo("select[name='action']");
		<?php } ?>
			$j('<option>').val('export').text('<?php _e( 'Export', 'wp-members' )?>').appendTo("select[name='action']");
			$j('<input id="export_all" name="export_all" class="button action" type="submit" value="<?php _e( 'Export All Users', 'wp-members' ); ?>" />').appendTo(".top .bulkactions");
		<?php if( $wpmem->mod_reg == 1 ) { ?>
			$j('<option>').val('activate').text('<?php _e( 'Activate', 'wp-members' )?>').appendTo("select[name='action2']");
			$j('<option>').val('deactivate').text('<?php _e( 'Deactivate', 'wp-members' )?>').appendTo("select[name='action2']");
		<?php } ?>
			$j('<option>').val('export').text('<?php _e( 'Export', 'wp-members' )?>').appendTo("select[name='action2']");
			$j('<input id="export_all" name="export_all" class="button action" type="submit" value="<?php _e( 'Export All Users', 'wp-members' ); ?>" />').appendTo(".bottom .bulkactions");
		});
		</script><?php
	}

	/**
	 * Function to add activate link to the user row action.
	 *
	 * @since 2.8.2
	 * @since 3.3.5 Updated to use wpmem_is_user_activated().
	 * @since 3.3.8 Added confirmation link, changed from insert_activate_link().
	 *
	 * @param  array $actions
	 * @param  $user_object
	 * @return array $actions
	 */
	static function insert_hover_links( $actions, $user_object ) {
		global $wpmem;
		if ( $user_object->ID != get_current_user_id() ) {
			
			if ( 1 == $wpmem->act_link ) {
				if ( false === wpmem_is_user_confirmed( $user_object->ID ) ) {
					$action = 'confirm';
					$term   = __( 'Confirm', 'wp-members' );
				} else {
					$action = 'unconfirm';
					$term   = __( 'Unconfirm', 'wp-members' );
				}
				$url = add_query_arg( array( 'action' => $action . '-single', 'user' => $user_object->ID ), "users.php" );
				$url = wp_nonce_url( $url, 'confirm-user' );
				$actions[ $action ] = '<a href="' . $url . '">' . $term . '</a>';
				
				// Resend welcome email (will contain confirmation link if enabled).
				//$actions['resend_welcome'] = '<a href="' . wp_nonce_url( add_query_arg( array( 'action' => 'resend_welcome', 'user' => $user_object->ID ), "users.php" ), 'resend-welcome' ) . '">' . __( 'Resend welcome email', 'wp-members' ) . '</a>';
			}
			
			if ( 1 == $wpmem->mod_reg ) {
				$is_active = wpmem_is_user_activated( $user_object->ID );

				if ( false === $is_active ) {
					$action = 'activate';
					$term   = __( 'Activate', 'wp-members' );
				} else {
					$action = 'deactivate';
					$term   = __( 'Deactivate', 'wp-members' );
				}
				$url = add_query_arg( array( 'action' => $action . '-single', 'user' => $user_object->ID ), "users.php" );
				$url = wp_nonce_url( $url, 'activate-user' );
				$actions[ $action ] = '<a href="' . $url . '">' . $term . '</a>';
			}
		}
		return $actions;
	}

	/**
	 * Function to handle bulk actions at page load.
	 *
	 * @since 2.8.2
	 *
	 * @uses WP_Users_List_Table
	 *
	 * @global object $wpmem
	 */
	static function page_load() {

		global $wpmem;
		if ( current_user_can( 'list_users' ) ) {
			$wpmem->admin->user_search = new WP_Members_Admin_User_Search();
		}

		// If exporting all users, do it, then exit.
		if ( current_user_can( 'list_users' ) && wpmem_get( 'export_all', false, 'request' ) ) {
			$today = date( "Y-m-d" ); 
			wpmem_export_users();
			exit();
		}

		$wp_list_table = _get_list_table( 'WP_Users_List_Table' );
		$action = $wp_list_table->current_action();
		$sendback = '';

		switch ( $action ) {

			case 'activate':
			case 'deactivate':

				// Validate nonce.
				check_admin_referer( 'bulk-users' );

				// Get the users.
				if ( isset( $_REQUEST['users'] ) ) {

					$users = $_REQUEST['users'];

					// Update the users.
					$x = 0;
					foreach ( $users as $user ) {
						$user = filter_var( $user, FILTER_VALIDATE_INT );
						// Current user cannot activate or deactivate themselves.
						if ( $user != get_current_user_id() ) {
							// Check to see if the user is already activated, if not, activate.
							if ( 'activate' == $action && 1 != get_user_meta( $user, 'active', true ) ) {
								wpmem_activate_user( $user );
							} elseif( 'deactivate' == $action ) {
								wpmem_deactivate_user( $user );
							}
							$x++;
						}
					}
					$msg = ( 'activate' == $action ) ? urlencode( sprintf( __( '%s users activated', 'wp-members' ), $x ) ) : urlencode( sprintf( __( '%s users deactivated', 'wp-members' ), $x ) );

				} else {
					$msg = urlencode( __( 'No users selected', 'wp-members' ) );
				}

				// Set the return message.
				$sendback = add_query_arg( array( 'activated' => $msg ), $sendback );
				break;

			case 'activate-single':
			case 'deactivate-single':

				// Validate nonce.
				check_admin_referer( 'activate-user' );

				// Get the users.
				$user_id = filter_var( $_REQUEST['user'], FILTER_VALIDATE_INT );

				// Check to see if the user is already activated, if not, activate.
				if ( $user_id == get_current_user_id() ) {
					$msg = urlencode( sprintf( esc_html__( 'You cannot activate or deactivate yourself', 'wp-members' ) ) );

				} elseif ( 'activate-single' == $action && false === wpmem_is_user_activated( $user_id ) ) {
					wpmem_activate_user( $user_id );
					$user_info = get_userdata( $user_id );
					$msg = urlencode( sprintf( esc_html__( "%s activated", 'wp-members' ), $user_info->user_login ) );

				} elseif ( 'deactivate-single' == $action ) {
					wpmem_deactivate_user( $user_id );
					$user_info = get_userdata( $user_id );
					$msg = urlencode( sprintf( esc_html__( "%s deactivated", 'wp-members' ), $user_info->user_login ) );

				} else {
					// Set the return message.
					$msg = urlencode( __( "That user is already active", 'wp-members' ) );
				}
				$sendback = add_query_arg( array( 'activated' => $msg ), $sendback );
				break;

			case 'confirm-single':
			case 'unconfirm-single':
				
				// Validate nonce.
				check_admin_referer( 'confirm-user' );

				// Get the users.
				$user_id = filter_var( $_REQUEST['user'], FILTER_VALIDATE_INT );

				// Check to see if the user is already activated, if not, activate.
				if ( $user_id == get_current_user_id() ) {
					$msg = urlencode( sprintf( esc_html__( 'You cannot confirm or unconfirm yourself', 'wp-members' ) ) );

				} elseif ( 'confirm-single' == $action && false === wpmem_is_user_confirmed( $user_id ) ) {
					wpmem_set_user_as_confirmed( $user_id );
					$user_info = get_userdata( $user_id );
					$msg = urlencode( sprintf( esc_html__( "%s confirmed", 'wp-members' ), $user_info->user_login ) );

				} elseif ( 'unconfirm-single' == $action ) {
					wpmem_set_user_as_unconfirmed( $user_id );
					$user_info = get_userdata( $user_id );
					$msg = urlencode( sprintf( esc_html__( "%s unconfirmed", 'wp-members' ), $user_info->user_login ) );

				} else {
					// Set the return message.
					$msg = urlencode( __( "That user is already confirmed", 'wp-members' ) );
				}
				$sendback = add_query_arg( array( 'activated' => $msg ), $sendback );
				break;

			case 'show':

				add_action( 'pre_user_query', array( 'WP_Members_Admin_Users', 'pre_user_query' ) );
				return;
				break;

			case 'export':

				$users = wpmem_get( 'users', array(), 'request' );
				wpmem_export_users( array( 'export'=>'selected' ), wpmem_sanitize_array( $users, 'integer' ) );
				return;
				break;

			default:
				return;
				break;

		}
		
		/**
		 * Doing user action.
		 *
		 * @since 3.3.0
		 */
		do_action( 'wpmem_user_action' );

		// If we did not return already, we need to wp_safe_redirect.
		wp_safe_redirect( $sendback );
		exit();

	}

	/**
	 * Function to echo admin update message.
	 *
	 * @since 2.8.2
	 */
	static function admin_notices() {

		global $pagenow, $user_action_msg;
		 if( $pagenow == 'users.php' && isset( $_REQUEST['activated'] ) ) {
			$message = esc_html( $_REQUEST['activated'] );
			echo "<div class=\"updated\"><p>{$message}</p></div>";
		}

		if ( $user_action_msg ) {
			echo "<div class=\"updated\"><p>{$user_action_msg}</p></div>";
		}
	}

	/**
	 * Function to add user views to the top list.
	 *
	 * @since 2.8.2
	 * @since 3.1.2 Added user view counts as transient.
	 * 
	 * @todo Could revise to use wpmem_add_user_view_link().
	 *
	 * @global object $wpdb
	 * @global object $wpmem
	 * @param  array  $views
	 * @return array  $views
	 */
	static function views( $views ) {

		global $wpmem;

		// Get the cached user counts.
		$user_counts = get_transient( 'wpmem_user_counts' );

		// check to see if data was successfully retrieved from the cache
		if ( false === $user_counts ) {

			// @todo For now, 5 minutes.  We'll see how things go.
			$transient_expires = 300; // Value in seconds, 1 day: ( 60 * 60 * 24 );

			global $wpdb;

			// We need a count of total users.
			// @todo - need a more elegant way of this entire process.
			$sql = "SELECT COUNT(*) FROM " . $wpdb->users;
			$users = $wpdb->get_var( $sql );

			// What needs to be counted?		
			$count_metas = array(
				'pending'      => 'pending',      // Used for PayPal Extension
				'trial'        => 'trial',        // Used for PayPal Extension
				'subscription' => 'subscription', // Used for PayPal Extension
				'expired'      => 'expired',      // Used for PayPal Extension
				'active'       => 'active',
				'notactive'    => 'active',
				'deactivated'  => 'deactivated',
				'notexported'  => 'exported',
				'confirmed'    => '_wpmem_user_confirmed',
				'notconfirmed' => '_wpmem_user_confirmed',
			);

			// Handle various counts.
			$user_counts = array();
			foreach ( $count_metas as $key => $meta_key ) {
				if ( 'confirmed' == $key || 'notconfirmed' == $key ) {
					$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key=%s AND meta_value>0", $meta_key ) );
					$count = ( 'notconfirmed' == $key ) ? $users - $count : $count;
				}
				if ( 'active' == $key ) {
					$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key=%s AND meta_value=1", $meta_key ) );
				}
				if ( 'notactive' == $key || 'notexported' == $key ) {
					$users_with_meta = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key=%s AND meta_value=1", $meta_key ) );
					$count = $users - $users_with_meta;
				}
				if ( 'deactivated' == $key ) {
					$count = $wpdb->get_var( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key = 'active' AND meta_value = 0" );
				}
				if ( 'trial' == $key || 'subscription' == $key || 'pending' == $key ) {
					$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key = 'exp_type' AND meta_value = \"%s\"", $key ) );
				}
				if ( 'expired' == $key ) {
					$count = $wpdb->get_var( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key = 'expires' AND STR_TO_DATE( meta_value, '%m/%d/%Y' ) < CURDATE() AND meta_value != '01/01/1970'" );
				}
				$user_counts[ $key ] = $count;
			}
			set_transient( 'wpmem_user_counts', $user_counts, $transient_expires );
		}

		if ( defined( 'WPMEM_EXP_MODULE' ) && 1 == $wpmem->use_exp ) {
			$views['pending']      = __( 'Pending',       'wp-members' );
			$views['trial']        = __( 'Trial',         'wp-members' );
			$views['subscription'] = __( 'Subscription',  'wp-members' );
			$views['expired']      = __( 'Expired',       'wp-members' );
		}
		if ( 1 == $wpmem->mod_reg ) {
			$views['active']       = __( 'Activated',          'wp-members' );
			$views['notactive']    = __( 'Pending Activation', 'wp-members' );
			$views['deactivated']  = __( 'Deactivated',        'wp-members' );
		}
		if ( 1 == $wpmem->act_link ) {
			$views['confirmed']    = __( 'Confirmed',     'wp-members' );
			$views['notconfirmed'] = __( 'Not Confirmed', 'wp-members' );
		}
		$views['notexported']      = __( 'Not Exported',  'wp-members' );
		$show = sanitize_text_field( wpmem_get( 'show', false, 'get' ) );
		
		foreach ( $views as $key => $view ) {
			if ( isset( $user_counts[ $key ] ) ) {
				$link          = "users.php?action=show&amp;show=" . $key;
				$current       = ( $show == $key ) ? ' class="current"' : '';
				$views[ $key ] = sprintf(
					'<a href="%s" %s>%s <span class="count">(%d)</span></a>',
					esc_url( $link ),
					$current,
					$view,
					isset( $user_counts[ $key ] ) ? $user_counts[ $key ] : ''
				);
			}
		}
		
		/**
		 * Filters all views before returning to the WP 'views_users' filter.
		 *
		 * @since 3.3.0
		 * @since unknown Added $show
		 *
		 * @param array  $views {
		 *
		 *     @type string The HTML for the view.
		 * }
		 * @param string $show
		 */
		$views = apply_filters( 'wpmem_views_users', $views, $show );
		
		return $views;
	}

	/**
	 * Function to add custom user columns to the user table.
	 *
	 * @since 2.8.2
	 *
	 * @param  array $columns
	 * @return array $columns
	 */
	static function add_user_column( $columns ) {

		global $wpmem_user_columns, $wpmem;

		// Get any columns to be added to the Users > All Users screen.
		$wpmem_user_columns = get_option( 'wpmembers_utfields' );

		if ( $wpmem_user_columns ) {
			$column_labels = array();
			if ( 1 != $wpmem->mod_reg ) {
				unset( $wpmem_user_columns['active'] );
			}
			
			// @todo This is a workaround so that wpmembers_utfields doesn't have to be updated.
			if ( isset( $wpmem_user_columns['active'] ) ) { 
				$wpmem_user_columns['active'] = __( 'Activated', 'wp-members' );
			}

			if ( 1 != $wpmem->act_link ) {
				unset( $wpmem_user_columns['_wpmem_user_confirmed'] );
			}
			
			// @todo Need to eventually change the wpmembers_utfields setting so we don't have to do it this way.
			$fields = wpmem_fields();
			foreach ( $wpmem_user_columns as $key => $value ) {
				$column_labels[ $key ] = ( isset( $fields[ $key ] ) ) ? $fields[ $key ]['label'] : $value;
			}
			
			/**
			 * Filter the User > All Users custom columns before they are merged.
			 *
			 * @since 3.3.8
			 *
			 * @param array
			 */
			$column_labels = apply_filters( 'wpmem_user_columns', $column_labels );

			$columns = array_merge( $columns, $column_labels );
		}

		// Makes WP-Members columns sortable.
		// @todo - finish debugging class or add sortable functions to users.php.
		// require_once( $wpmem->path . 'admin/includes/class-wp-members-sortable-user-columns.php' );
		// new WP_Members_Sortable_User_Columns( $wpmem_user_columns );

		return $columns;
	} 

	/**
	 * Function to add the user content to the custom column.
	 *
	 * @since 2.8.2
	 * 
	 * @param  $value
	 * @param  $column_name
	 * @param  $user_id
	 * @return The user value for the custom column.
	 */
	static function add_user_column_content( $value, $column_name, $user_id ) {

		// Is the column a WP-Members column?
		global $wpmem_user_columns, $wpmem;
		$is_wpmem = ( is_array( $wpmem_user_columns ) && array_key_exists( $column_name, $wpmem_user_columns ) ) ? true : false;

		if ( $is_wpmem ) {

			switch ( $column_name ) {

				case 'active':
					if ( 1 == $wpmem->mod_reg ) {
					// If the column is "active", then return the value or empty. Returning in here keeps us from displaying another value.
						return ( get_user_meta( $user_id , 'active', 'true' ) != 1 ) ? '<span class="dashicons dashicons-dismiss" style="color:red;"></span>' : '<span class="dashicons dashicons-yes-alt" style="color:green;"></span>';
					} else {
						return;
					}
					break;
					
				case '_wpmem_user_confirmed':
					if ( 1 == $wpmem->act_link ) {
						$user_confirmed = get_user_meta( $user_id , '_wpmem_user_confirmed', 'true' );
						return ( $user_confirmed ) ? date_i18n( get_option( 'date_format' ), $user_confirmed ) : __( 'Not confirmed', 'wp-members' );
					} else {
						return;
					}
					break;

				case 'user_url':
				case 'user_registered':
					// Unlike other fields, website/url is not a meta field.
					$user_info = get_userdata( $user_id );
					return $user_info->$column_name;
					break;

				case 'user_id':
					return $user_id;

				default:
					return get_user_meta( $user_id, $column_name, true );
					break;
			}

		}

		/**
		 * Filter user column content.
		 *
		 * @since 3.3.8
		 *
		 * @param string $value
		 * @param string $column_name
		 * @param int    $user_id
		 */
		$value = apply_filters( 'wpmem_user_column_content', $value, $column_name, $user_id );
		return $value;
	}

	/**
	 * Adjusts user query based on custom views.
	 *
	 * @since 2.8.3
	 *
	 * @todo Currently, not activated query returns users who are deactivated. This
	 *       may be confusing for admins, so work on a query that displays only
	 *       users who have never been activated.
	 * 
	 * @todo Do theses using wpmem_add_query_where().
	 *
	 * @param $user_search
	 */
	static function pre_user_query( $user_search ) {

		global $wpdb;
		$show = sanitize_text_field( wpmem_get( 'show', '', 'get' ) );
		switch ( $show ) {

			case 'trial':
			case 'subscription':
			case 'pending':
				$replace_query = "WHERE 1=1 AND {$wpdb->users}.ID IN (
				 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
					WHERE {$wpdb->usermeta}.meta_key = 'exp_type'
					AND {$wpdb->usermeta}.meta_value = \"" . esc_sql( $show ) . "\" )";
				break;

			case 'expired':
				$replace_query = "WHERE 1=1 AND {$wpdb->users}.ID IN (
				 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
					WHERE {$wpdb->usermeta}.meta_key = 'expires'
					AND STR_TO_DATE( {$wpdb->usermeta}.meta_value, '%m/%d/%Y' ) < CURDATE()
					AND {$wpdb->usermeta}.meta_value != '01/01/1970' )";
				break;
				
			case 'confirmed':
			case 'notconfirmed':
				$in  = ( 'confirmed' == $show ) ? 'IN' : 'NOT IN';
				$replace_query = "WHERE 1=1 AND {$wpdb->users}.ID " . esc_sql( $in ) . " (
				 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
					WHERE {$wpdb->usermeta}.meta_key = \"" . esc_sql( '_wpmem_user_confirmed' ) . "\" )";
				break;
				
			case 'active':
			case 'notactive':
			case 'notexported':
			case 'deactivated':
			default:
				$key = ( 'notactive' == $show || 'deactivated' == $show  ) ? 'active' : 'exported';
				$in  = ( 'deactivated' == $show ) ? 'IN' : 'NOT IN';
				$val = ( 'deactivated' == $show ) ? '0'  : '1';
				if ( 'active' == $show ) {
					$key = 'active'; $in = 'IN';
				}
				$replace_query = "WHERE 1=1 AND {$wpdb->users}.ID " . esc_sql( $in ) . " (
				 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
					WHERE {$wpdb->usermeta}.meta_key = \"" . esc_sql( $key ) . "\"
					AND {$wpdb->usermeta}.meta_value = \"" . esc_sql( $val ) . "\" )";
				break;
		}
		
		$query_where = str_replace( 'WHERE 1=1', $replace_query, $user_search->query_where );
		
		/**
		 * Filters the pre_user_query being applied.
		 *
		 * @since 3.3.0
		 *
		 * @param  string  $query_where
		 */
		$query_where = apply_filters( 'wpmem_query_where', $query_where, $show );

		$user_search->query_where = $query_where;
	}

	/**
	 * Use wpmem_post_register_data to set the user_status field to 2 using wp_update_user.
	 * http://codex.wordpress.org/Function_Reference/wp_update_user
	 *
	 * @deprecated 3.3.6 No longer used.
	 *
	 * @uses  wpmem_set_user_status
	 * @param $fields
	 */
	static function set_new_user_non_active( $fields ) {
		wpmem_set_user_status( $fields['ID'], 2 );
		return;
	}

	/**
	 * Use wpmem_user_activated to set the user_status field to 0 using wp_update_user.
	 *
	 * @uses  wpmem_set_user_status
	 * @param $user_id
	 */
	static function set_activated_user( $user_id ) {
		wpmem_set_user_status( $user_id, 0 );
		return;
	}

	/**
	 * Use wpmem_user_deactivated to set the user_status field to 2 using wp_update_user.
	 *
	 * @uses  wpmem_set_user_status
	 * @param $user_id
	 */
	static function set_deactivated_user( $user_id ) {
		wpmem_set_user_status( $user_id, 2 );
		return;
	}

}