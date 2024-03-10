<?php

class IEPA_Pro {

	/** @var IEPA_Pro Instance */
	private static $_instance;
	/** @var string Content from tpl */
	private $matching_tpl;

	/**
	 * Returns instance of current calss
	 * @return IEPA_Pro Instance
	 */
	public static function instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {
		add_filter( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post',      array( $this, 'save_iepa_meta' ) );
		add_filter( 'wp_ajax_iepa_use_gt_editor', [ $this, 'iepa_use_gt_editor' ] );
	}

	public function iepa_import_saved_single_product_template() {

		$post_id = sanitize_text_field( $_POST['post_id'] );
		$page_id = sanitize_text_field( $_POST['page_id'] );

		$single_iepa_builder_template = get_post( $post_id );
		if ( !$single_iepa_builder_template ) {
			wp_send_json( [
				 'status' =>	false,
				 'msg'		=>	__( 'Template Not Found!', 'ibtana-ecommerce-product-addons' )
				]
			);
			exit;
		}
		$post_content = $single_iepa_builder_template->post_content;
		wp_update_post( wp_slash( array(
	    'ID' 						=> $page_id,
	    'post_content'	=> $post_content
		) ) );
		wp_send_json( [ 'status' => true ] );
	}

	public function iepa_get_saved_product_templates() {
		$template_posts = get_posts( [
			'numberposts'	=>	-1,
			'post_type'		=> 'iepa_template',
		] );
		wp_send_json( [ 'templates' => $template_posts ] );
	}

	public function iepa_use_gt_editor() {

		$post_id = sanitize_text_field( $_POST['post_id'] );

		if ( $_POST['iepa_use_gt_editor'] === 'true' ) {
			update_post_meta( $post_id, 'iepa_builder', "1" );
		} else {
			delete_post_meta( $post_id, 'iepa_builder' );
		}
		wp_send_json( [ 'status' => true ] );
	}

	/**
	 * Admin styles to hide taxonomies under iepa templates post type.
	 */
	public function admin_styles() {
		?>
		<style>
			a.page-title-action[href*='post-new.php?post_type=iepa_template'],
			#adminmenu .wp-submenu a[href*="post_type=iepa_template"][href*="edit-tags.php?taxonomy=product_"] {
				display: none;
			}
      body.edit-php.post-type-iepa_template a.page-title-action {
				display: none;
      }
		</style>
		<?php
	}

	/**
	 * Adds custom columns on iepa templates post type.
	 * @param array $columns
	 * @return array
	 */
	public function custom_columns( $columns ) {
		$date = $columns['date'];

		unset( $columns['date'] );
		$columns['tpl-cats'] = 'Categories';
		$columns['tpl-tags'] = 'Tags';
		$columns['date'] = $date;
		return $columns;
	}

	/**
	 * Adds iepa templates to product cats and tags
	 * @param array $post_types
	 * @return array
	 */
	public function add_product_templates( $post_types ) {
		$post_types[] = 'iepa_template';

		return $post_types;
	}

	/**
	 * Registers IEPA template post type
	 */
	public function init() {
		register_post_type( 'iepa_template', [
			'public'       => false,
			'label'        => 'Product templates',
			'labels' => array(
				'name'               => __( 'Product templates', 'ibtana-ecommerce-product-addons' ),
				'singular_name'      => __( 'Product template', 'ibtana-ecommerce-product-addons' ),
				'menu_name'          => __( 'Product templates', 'ibtana-ecommerce-product-addons' ),
				'name_admin_bar'     => __( 'Product template', 'ibtana-ecommerce-product-addons' ),
				'add_new'            => __( 'Add New', 'ibtana-ecommerce-product-addons' ),
				'add_new_item'       => __( 'Add New Product template', 'ibtana-ecommerce-product-addons' ),
				'new_item'           => __( 'New Product template', 'ibtana-ecommerce-product-addons' ),
				'edit_item'          => __( 'Edit Product template', 'ibtana-ecommerce-product-addons' ),
				'view_item'          => __( 'View Product template', 'ibtana-ecommerce-product-addons' ),
				'all_items'          => __( 'All Templates', 'ibtana-ecommerce-product-addons' ),
				'search_items'       => __( 'Search Product templates', 'ibtana-ecommerce-product-addons' ),
				'parent_item_colon'  => __( 'Parent Product templates:', 'ibtana-ecommerce-product-addons' ),
				'not_found'          => __( 'No product templates found.', 'ibtana-ecommerce-product-addons' ),
				'not_found_in_trash' => __( 'No product templates found in Trash.', 'ibtana-ecommerce-product-addons' ),
			),
			'show_ui'      			=> true,
			'show_in_menu' 			=> 'edit.php?post_type=product',
			'show_in_admin_bar'	=> false,
		] );
	}

	/**
	 * Adds metabox for iepa post type help
	 */
	public function add_meta_boxes() {

		if ( defined( 'IBTANA_LICENSE_API_ENDPOINT' ) ) {
			if ( 'product' === get_post_type() ) {
				add_meta_box(
					'iepa_product_template_metabox',
					__( 'Ibtana Product Template', 'ibtana-ecommerce-product-addons' ),
					[ $this, 'iepa_render_product_meta_box' ],
					null,
					'side',
					'high'
				);
			}

			if( 'iepa_template' === get_post_type() ) {
				add_meta_box(
					'iepa_template_metabox',
					__( 'Product template', 'ibtana-ecommerce-product-addons' ),
					[ $this, 'render_meta_box' ],
					null,
					'advanced',
					'low'
				);
			}
		}

	}

	function save_iepa_meta( $post_id ) {

		/*
		* We need to verify this came from the our screen and with proper authorization,
		* because save_post can be triggered at other times.
		*/

		// Check if our nonce is set.
		if ( ! isset( $_POST['iepa_inner_custom_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = sanitize_text_field( $_POST['iepa_inner_custom_box_nonce'] );

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'iepa_inner_custom_box' ) ) {
			return $post_id;
		}

		/*
		* If this is an autosave, our form has not been submitted,
		* so we don't want to do anything.
		*/
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'product' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/* OK, it's safe for us to save the data now. */

		if ( !isset( $_POST['iepa_product_metabox_field'] ) ) {
			return $post_id;
		}

		// Update the meta field.
		update_post_meta( $post_id, 'iepa_builder', 1 );
	}

	public function iepa_render_product_meta_box( $post ) {

		$post_ID							=	$post->ID;

		$is_gt_editor_enabled = get_post_meta( $post->ID, 'iepa_builder', 'single' );
		$post_status					=	( 'auto-draft' != get_post_status() ) ? 1 : 0;

		$ibtana_ecommerce_product_addons_license_key = get_option( str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key' );
		$ibtana_ecommerce_product_addons_license_key_license_status = false;
		if ( isset( $ibtana_ecommerce_product_addons_license_key['license_status'] ) ) {
			if ( $ibtana_ecommerce_product_addons_license_key['license_status'] == true ) {
				$ibtana_ecommerce_product_addons_license_key_license_status = true;
			}
		}
		$IBTANA_LICENSE_API_ENDPOINT	=	defined( "IBTANA_LICENSE_API_ENDPOINT" ) ? IBTANA_LICENSE_API_ENDPOINT : false;

		$ive_add_ons_admin_url	=	admin_url( 'admin.php?page=ibtana-visual-editor-addons' );

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'iepa_inner_custom_box', 'iepa_inner_custom_box_nonce' );

		?>
		<input id="iepa_product_metabox" type="checkbox" name="iepa_product_metabox_field" disabled <?php if( $is_gt_editor_enabled == '1' ) { echo esc_attr( "checked=checked" ); } ?>>
		<?php
		esc_html_e( 'Use Gutenberg Editor', 'ibtana-ecommerce-product-addons' );
		if ( $post_status === 0 ) {
			?>
			<br><br>
			<p>
				<?php
				esc_html_e(
					"You need to save the product first in order to use Gutenberg Editor. You can save as a draft with just a title if you want to make other changes later.",
					'ibtana-ecommerce-product-addons'
				);
				?>
			</p>
			<?php
		}

		if ( !$ibtana_ecommerce_product_addons_license_key_license_status ) {
			?>
				<p id="iepa_product_metabox_license" class="iepa_product_metabox_license">
					<?php esc_html_e( 'Get pre-built premium product page templates using ', 'ibtana-ecommerce-product-addons' ); ?>
					<strong>
						<?php esc_html_e( 'Ibtana - Ecommerce Product Addons.', 'ibtana-ecommerce-product-addons' ); ?>
					</strong>
					<a class="button" href="<?php echo esc_url( $ive_add_ons_admin_url ); ?>" target="_blank">
						<?php esc_html_e( 'Upgrade To Pro!', 'ibtana-ecommerce-product-addons' ); ?>
					</a>
				</p>
			<?php
		}

		$admin_url = admin_url( 'admin-ajax.php?action=iepa_use_gt_editor' );
		$post_id = get_the_ID();


		?>
		<style media="screen">
			.iepa_is-busy {
				animation: components-button__busy-animation 2.5s linear infinite;
				opacity: 1;
				background-size: 100px 100%;
				background-image: linear-gradient(-45deg,#fafafa 33%,#e0e0e0 0,#e0e0e0 70%,#fafafa 0);
			}
			#iepa_product_metabox_license {
			    background: rgba(229,195,52,0.25);
			    padding: 10px 8px;
			    border-radius: 3px;
			    border: 1px solid #dadada;
					margin-top: 16px;
					text-align: center;
			}
			#iepa_product_metabox_license a {
				background: linear-gradient(#6ccef5, #016194) !important;
				color: #fff;
				text-transform: capitalize;
				font-weight: bold;
				text-align: center;
				margin: 4% auto 0;
				width: 60%;
				border-radius: 4px !important;
			}
		</style>
		<script type="text/javascript">
			(function ($, window, document) {
				'use strict';
				$(document).ready(function () {

					var __ = wp.i18n.__;

					var $post_status = '<?php esc_html_e( $post_status, "ibtana-ecommerce-product-addons" ); ?>';
					var $IBTANA_LICENSE_API_ENDPOINT = '<?php echo esc_url( $IBTANA_LICENSE_API_ENDPOINT ); ?>';


					$( '#iepa_product_metabox' ).prop( 'disabled', false );

			    $( '#iepa_product_metabox' ).on('change', function () {

						if ( !parseInt( $post_status ) ) {
							// jQuery( this ).prop( 'checked', false );

							if ( !jQuery( '#post #title' ).val().trim() ) {
								jQuery( '#post #title' ).val( __( 'Ibtana Product Template', 'ibtana-ecommerce-product-addons' ) );
								jQuery( '#post #title' ).trigger( 'input' );
							}
							jQuery( '#post #save-post' ).trigger( 'click' );

							return;
						}

						$( '#iepa_product_template_metabox .inside' ).addClass( 'iepa_is-busy' );
						$( '#iepa_product_metabox' ).prop( 'disabled', true );

		        $.post( '<?php echo esc_url( $admin_url ); ?>' ,
							{
								post_id:	'<?php echo esc_attr( $post_id ); ?>',
								iepa_use_gt_editor: document.querySelector('#iepa_product_metabox').checked
							}, function ( data ) {
								if ( data.status === true ) {
									location.reload( true );
								} else {
									$( '#iepa_product_metabox' ).prop( 'checked', !document.querySelector('#iepa_product_metabox').checked );
									$( '#iepa_product_metabox' ).prop( 'disabled', false );
									$( '#iepa_product_template_metabox .inside' ).removeClass( 'iepa_is-busy' );
								}
							}
		        );
			    });


					if ( jQuery( '#iepa_product_metabox_license' ).length && $IBTANA_LICENSE_API_ENDPOINT ) {
						var data_post = {
				      "admin_user_ibtana_license_key": '',
				      "domain": ''
				    };
				    jQuery.ajax({
				      method: "POST",
				      url: $IBTANA_LICENSE_API_ENDPOINT + "get_ibtana_visual_editor_defaults",
				      data: JSON.stringify( data_post ),
				      dataType: 'json',
				      contentType: 'application/json',
				    }).done(function(data) {
				      var get_pro_permalink = data.data.get_pro_permalink;
							jQuery( '.iepa_product_metabox_license a' ).attr( 'href', get_pro_permalink );
				    });
					}

				});
			}(jQuery, window, document));
		</script>
		<?php
	}

	/**
	 * Render post meta box for iepa templates
	 * @param WP_Post $post
	 */
	public function render_meta_box( $post ) {
		?>
		<style>
			#iepa_template_metabox h2.iepa-template-helptext {
				font-size: 18px;
				font-weight: 300;
				padding: 1em 0 0;
			}

			#iepa_template_metabox .iepa-template-links {
				color: inherit;
				text-decoration: none;
				border-bottom: 1px dotted;
			}

			#iepa_template_metabox h3 {
				margin: 1.6em 0 .5em;
			}

			#iepa_template_metabox ul {
				margin-top: 0;
			}
			#product_catdiv,
			#tagsdiv-product_tag {
				transition: all .5s;
			}
			#product_catdiv:target,
			#tagsdiv-product_tag:target {
				transform: scale( 1.06 );
				box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.25);
			}
			.post-type-iepa_template #postdivrich {
				display: none;
			}
		</style>
		<h2 class="iepa-template-helptext"><?php esc_html_e( 'Select the', 'ibtana-ecommerce-product-addons' ); ?>
			<a class="iepa-template-links" href="#product_catdiv">
				<?php esc_html_e( 'Product Categories', 'ibtana-ecommerce-product-addons' ); ?>
			</a><?php esc_html_e( ' and', 'ibtana-ecommerce-product-addons' ); ?>
			<a class="iepa-template-links" href="#tagsdiv-product_tag">
				<?php esc_html_e( 'Product Tags', 'ibtana-ecommerce-product-addons' ); ?>
			</a>
			<?php esc_html_e( 'you would like to apply this template to...', 'ibtana-ecommerce-product-addons' ); ?>
		</h2>

		<?php
		echo get_the_term_list(
			$post->ID, 'product_cat',
			'<h3>' . esc_html_e( "This template will apply to product with any of the following categories:", "ibtana-ecommerce-product-addons" ) .
			'</h3><ul class="ul-disc"><li>',
			'</li><li>',
			'</li></ul>'
		);
		?>

		<?php
		echo get_the_term_list(
			$post->ID, 'product_tag',
			'<h3>' .
			esc_html_e( "This template will apply to product with any of the following tags:", "ibtana-ecommerce-product-addons" ) .
			'</h3><ul class="ul-disc"><li>',
			'</li><li>',
			'</li></ul>'
		);

	}

	private $template_weight = [
		'product_cat' => 2,
	];

}

IEPA_Pro::instance();
