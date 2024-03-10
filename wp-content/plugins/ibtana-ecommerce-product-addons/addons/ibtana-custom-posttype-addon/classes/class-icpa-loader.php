<?php
/**
 * ICPA Loader.
 *
 * @package ICPA
 */

if ( ! class_exists( 'ICPA_Loader' ) ) {
  /**
	 * Class ICPA_Loader.
	 */
	final class ICPA_Loader {

    /**
		 * Member Variable
		 *
		 * @var icpa_loader_instance
		 */
		private static $icpa_loader_instance;

    /**
		 *  Initiator
		 */
		public static function icpa_loader_get_instance() {
			if ( ! isset( self::$icpa_loader_instance ) ) {
				self::$icpa_loader_instance = new self();
			}
			return self::$icpa_loader_instance;
		}

    /**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'icpa_add_styles' ) );
			add_action( 'admin_post_icpa_process_post_type', array( $this, 'icpa_process_post_type' ) );
			add_action( 'init', array( $this, 'custom_posttype_register' ) );
			add_action( 'custom_posttype_register', array( $this, 'custom_posttype_register' ) );
		}

    /**
		 * Loads Styles and JS.
		 *
		 * @since 0.0.1
		 *
		 * @return void
		 */
    public function icpa_add_styles( $hook ) {
			wp_enqueue_media();
			if ( __( 'ibtana-settings', 'ibtana-ecommerce-product-addons' ) . '_page_ibtana-custom-post-type' != $hook ) {
				return;
			}

      wp_enqueue_style( 'icpa-admin-css', ICPA_PLUGIN_URI . "assets/css/admin.css", [], ICPA_VERSION );
			wp_enqueue_script( 'icpa-admin-js', ICPA_PLUGIN_URI . "assets/js/admin.js", array( 'jquery' ), ICPA_VERSION );
    }

		function icpa_process_post_type() {
			if( !empty( $_POST ) && wp_verify_nonce( $_POST['icpa-nonce-setup'], 'icpa-nonce' ) ) {
				if( isset( $_POST['icpa_submit'] ) ) {
					include_once( ICPA_PATH . '/inc/save_settings.php' );
				}
			}
		}

		public function add_category_image ( $taxonomy ) { ?>
			<div class="form-field term-group">
				<label for="icpa-tax-img-id"><?php esc_html_e('Image', 'ibtana-ecommerce-product-addons'); ?></label>
				<input type="hidden" id="icpa-tax-img-id" name="icpa-tax-img-id" class="custom_media_url" value="">
				<div id="category-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary icpa_tax_media_button" id="icpa_tax_media_button" name="icpa_tax_media_button" value="<?php echo esc_attr( 'Add Image', 'ibtana-ecommerce-product-addons' ); ?>" />
					<input type="button" class="button button-secondary icpa_tax_media_remove" id="icpa_tax_media_remove" name="icpa_tax_media_remove" value="<?php echo esc_attr( 'Remove Image', 'ibtana-ecommerce-product-addons' ); ?>" />
				</p>
			</div>
			<?php
		}

		/*
 		* Add script
 		* @since 1.0.0
 		*/
		public function add_script() { ?>
			<script>
				jQuery(document).ready( function($) {
					function icpa_media_upload(button_class) {
						var _custom_media = true,
						_orig_send_attachment = wp.media.editor.send.attachment;
						$('body').on('click', button_class, function(e) {
							var button_id = '#'+$(this).attr('id');
							var send_attachment_bkp = wp.media.editor.send.attachment;
           		var button = $(button_id);
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
								if ( _custom_media ) {
									$('#icpa-tax-img-id').val(attachment.id);
									$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									$('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
								} else {
									return _orig_send_attachment.apply( button_id, [props, attachment] );
								}
							}
							wp.media.editor.open(button);
							return false;
						});
					}
					icpa_media_upload('.icpa_tax_media_button.button');
					$('body').on('click','.icpa_tax_media_remove',function(){
						$('#icpa-tax-img-id').val('');
						$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					});

					$(document).ajaxComplete(function(event, xhr, settings) {
						var queryStringArr = settings.data.split('&');
						if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
							var xml = xhr.responseXML;
							$response = $(xml).find('term_id').text();
							if($response!=""){
								// Clear the thumb image
								$('#category-image-wrapper').html('');
							}
						}
					});
				});
			</script>
		<?php }

		public function save_category_image ( $term_id, $tt_id ) {
			if( isset( $_POST['icpa-tax-img-id'] ) && '' !== $_POST['icpa-tax-img-id'] ){
				$image = sanitize_text_field( $_POST['icpa-tax-img-id'] );
				add_term_meta( $term_id, 'icpa-tax-img-id', $image, true );
			}
		}

		/*
		* Update the form field value
		* @since 1.0.0
		*/

		public function updated_category_image ( $term_id, $tt_id ) {
			if( isset( $_POST['icpa-tax-img-id'] ) && '' !== $_POST['icpa-tax-img-id'] ){
				$image = $_POST['icpa-tax-img-id'];
				update_term_meta ( $term_id, 'icpa-tax-img-id', $image );
			} else {
				update_term_meta ( $term_id, 'icpa-tax-img-id', '' );
			}
		}

		/*
		* Edit the form field
		* @since 1.0.0
		*/
		public function update_category_image ( $term, $taxonomy ) { ?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="icpa-tax-img-id"><?php esc_html_e( 'Image', 'ibtana-ecommerce-product-addons' ); ?></label>
				</th>
				<td>
					<?php $image_id = get_term_meta ( $term->term_id, 'icpa-tax-img-id', true ); ?>
					<input type="hidden" id="icpa-tax-img-id" name="icpa-tax-img-id" value="<?php echo esc_attr( $image_id, 'ibtana-ecommerce-product-addons' ); ?>">
					<div id="category-image-wrapper">
						<?php if ( $image_id ) {
							$image_attributes = wp_get_attachment_image_src( $image_id, 'thumbnail' ); ?>
							<img width="<?php echo esc_attr($image_attributes[1]); ?>" height="<?php echo esc_attr($image_attributes[2]); ?>" src="<?php echo esc_url($image_attributes[0]); ?>" class="attachment-thumbnail size-thumbnail" alt="" loading="lazy" />
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary icpa_tax_media_button" id="icpa_tax_media_button" name="icpa_tax_media_button" value="<?php echo esc_attr( 'Add Image', 'ibtana-ecommerce-product-addons' ); ?>" />
						<input type="button" class="button button-secondary icpa_tax_media_remove" id="icpa_tax_media_remove" name="icpa_tax_media_remove" value="<?php echo esc_attr( 'Remove Image', 'ibtana-ecommerce-product-addons' ); ?>" />
					</p>
				</td>
			</tr>
			<?php
		}

		function custom_posttype_register(){

			$options = get_option('icpa_settings');
			$custom_posttype_tax_options = get_option('icpa_tax_settings');

			if ($options) {
				foreach ($options as $option) {

					$supports = implode(', ', array_map(
							function ($v, $k) {
								return sprintf("%s", $k, $v);
							},
							$option['support'],
							array_keys($option['support'])
					));

					$explode_support = explode(", ",$supports);

					if ($option['is_display']) {
						register_post_type( $option['posttype_name'],
							array(
								'labels' => array(
									'name' => __( $option['plural_label'] ,'ibtana-ecommerce-product-addons' ),
									'singular_name' => __( $option['singular_label'] ,'ibtana-ecommerce-product-addons' )
								),
								'menu_icon'  => 'dashicons-tag',
								'public' => true,
								'supports' => $explode_support
							)
						);
					}

				}
			}

			if ($custom_posttype_tax_options) {

				foreach ($custom_posttype_tax_options as $taxonomy) {

					if ( gettype($taxonomy['posttype']) != 'array' || empty( $taxonomy['posttype'] ) ) {
						continue;
					}

					$posttype_tax = implode(', ', array_map(
							function ($v, $k) {
								return sprintf("%s", $k, $v);
							},
							$taxonomy['posttype'],
							array_keys($taxonomy['posttype'])
					));

					$explode_posttype_tax = explode(", ",$posttype_tax);

					$taxonomy_name					=	isset($taxonomy['taxonomy_name']) ? $taxonomy['taxonomy_name'] : 'categories';
					$tax_plural_label 			=	isset($taxonomy['tax_plural_label']) ? $taxonomy['tax_plural_label'] : 'Categories';
					$tax_singular_label 		=	isset($taxonomy['tax_singular_label']) ? $taxonomy['tax_singular_label'] : 'Categories';
					$tax_attach_thumbnail		=	isset($taxonomy['tax_attach_thumbnail']) ? $taxonomy['tax_attach_thumbnail'] : false;
					$tax_menu_name 					=	isset($taxonomy['tax_menu_name']) ? $taxonomy['tax_menu_name'] : 'Categories';
					$tax_all_items 					=	isset($taxonomy['tax_all_items']) ? $taxonomy['tax_all_items'] : 'All Categories';
					$tax_edit_item 					=	isset($taxonomy['tax_edit_item']) ? $taxonomy['tax_edit_item'] : 'Edit Categories';
					$tax_view_item 					=	isset($taxonomy['tax_view_item']) ? $taxonomy['tax_view_item'] : 'View Categories';
					$tax_update_item 				=	isset($taxonomy['tax_update_item']) ? $taxonomy['tax_update_item'] : 'Update Categories';
					$tax_new_item 					=	isset($taxonomy['tax_new_item']) ? $taxonomy['tax_new_item'] : 'Add New Categories';
					$tax_new_item_name 			=	isset($taxonomy['tax_new_item_name']) ? $taxonomy['tax_new_item_name'] : 'New Categories Name';
					$tax_parent_item 				=	isset($taxonomy['tax_parent_item']) ? $taxonomy['tax_parent_item'] : 'Parent Categories';
					$tax_parent_item_colon	=	isset($taxonomy['tax_parent_item_colon']) ? $taxonomy['tax_parent_item_colon'] : 'Parent Categories:';
					$tax_search_item = isset($taxonomy['tax_search_item']) ? $taxonomy['tax_search_item'] : 'Search Category';

					$labels = array(
						'name'     => __( $tax_plural_label, 'ibtana-ecommerce-product-addons' ),
						'singular_name'  => __( $tax_singular_label, 'ibtana-ecommerce-product-addons' ),
						'search_items'  => __( $tax_search_item, 'ibtana-ecommerce-product-addons' ),
						'all_items'   => __( $tax_all_items, 'ibtana-ecommerce-product-addons' ),
						'parent_item'  => __( $tax_parent_item, 'ibtana-ecommerce-product-addons' ),
						'parent_item_colon' => __( $tax_parent_item_colon, 'ibtana-ecommerce-product-addons' ),
						'edit_item'  => __( $tax_edit_item, 'ibtana-ecommerce-product-addons' ),
						'view_item'  => __( $tax_view_item, 'ibtana-ecommerce-product-addons' ),
						'update_item'  => __( $tax_update_item, 'ibtana-ecommerce-product-addons' ),
						'add_new_item' => __( $tax_new_item, 'ibtana-ecommerce-product-addons' ),
						'new_item_name' => __( $tax_new_item_name, 'ibtana-ecommerce-product-addons' ),
						'menu_name'  => __( $tax_plural_label, 'ibtana-ecommerce-product-addons' ),
					);

					$args = array(
				    'hierarchical' => isset($taxonomy['tax_hierarchical']) ? filter_var($taxonomy['tax_hierarchical'], FILTER_VALIDATE_BOOLEAN) : false,
				    'labels' => $labels,
				    'public' => isset($taxonomy['tax_public']) ? filter_var($taxonomy['tax_public'], FILTER_VALIDATE_BOOLEAN) : false,
				    'publicly_queryable' => isset($taxonomy['tax_public_query']) ? filter_var($taxonomy['tax_public_query'], FILTER_VALIDATE_BOOLEAN) : false,
				    'show_in_menu' => isset($taxonomy['tax_show_in_menu']) ? filter_var($taxonomy['tax_show_in_menu'], FILTER_VALIDATE_BOOLEAN) : false,
				    'show_ui' => isset($taxonomy['tax_show_ui']) ? filter_var($taxonomy['tax_show_ui'], FILTER_VALIDATE_BOOLEAN) : false,
				    'show_admin_column' => isset($taxonomy['tax_show_admin_column']) ? filter_var($taxonomy['tax_show_admin_column'], FILTER_VALIDATE_BOOLEAN) : false,
				    'query_var'	=> isset($taxonomy['tax_query_var']) ? filter_var($taxonomy['tax_query_var'], FILTER_VALIDATE_BOOLEAN) : false,
				    'rewrite' => array( 'slug' => $taxonomy_name ),
				  );

					register_taxonomy( $taxonomy_name, $explode_posttype_tax, $args );

					if ($tax_attach_thumbnail) {
						add_action( "{$taxonomy_name}_add_form_fields", array ( $this, 'add_category_image' ), 10, 2 );
						add_action( 'admin_footer', array ( $this, 'add_script' ) );
						add_action( "created_{$taxonomy_name}", array ( $this, 'save_category_image' ), 10, 2 );
						add_action( "{$taxonomy_name}_edit_form_fields", array ( $this, 'update_category_image' ), 10, 2 );
						add_action( "edited_{$taxonomy_name}", array ( $this, 'updated_category_image' ), 10, 2 );
					}
				}
			}

		}

  }

  /**
	 *  Prepare if class 'ICPA_Loader' exist.
	 *  Kicking this off by calling 'icpa_loader_get_instance()' method
	 */
	ICPA_Loader::icpa_loader_get_instance();
}
