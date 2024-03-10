<?php
/**
 * Adds and controls pointers for contextual help/tutorials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * IEPA_Admin_Pointers Class.
 */
class IEPA_Admin_Pointers {

		public static $screen_id;

		public static $is_block_editor = false;

		public static $iepa_tutorial_steps = 0;

		public static $iepa_mega_menu_tutorial_steps = 0;

		public static $query_params = [];

  	/**
  	 * Constructor.
  	 */
  	public function __construct() {
  		add_action( 'admin_enqueue_scripts', array( $this, 'iepa_setup_product_tutorial_pointers_for_screen' ) );


			add_action( 'admin_enqueue_scripts', array( $this, 'iepa_setup_mega_menu_tutorial_pointers_for_screen' ) );


			add_action( 'wp_ajax_iepa_update_product_tutorial_status', array( $this, 'iepa_update_product_tutorial_status' ) );

			add_action( 'wp_ajax_iepa_update_mega_menu_tutorial_status', array( $this, 'iepa_update_mega_menu_tutorial_status' ) );

			add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

  	}

		public function iepa_update_mega_menu_tutorial_status() {
			$iepa_mega_menu_tutorial_step	=	(float) sanitize_text_field( $_POST['iepa_mega_menu_tutorial_step'] );
			$is_updated	=	update_option( 'iepa_mega_menu_tutorial_steps', $iepa_mega_menu_tutorial_step );
			wp_send_json_success( [ 'status' => $is_updated ] );
		}

		public function iepa_update_product_tutorial_status() {
			$iepa_tutorial_step	=	(float) sanitize_text_field( $_POST['iepa_tutorial_step'] );
			$is_updated	=	update_option( 'iepa_tutorial_steps', $iepa_tutorial_step );
			wp_send_json_success( [ 'status' => $is_updated ] );
		}


		public function iepa_setup_mega_menu_tutorial_pointers_for_screen() {

			$screen = get_current_screen();

  		if ( ! $screen ) {
  			return;
  		}

			self::$screen_id		=	$screen->id;

			self::$query_params	=	IEPA_Loader::iepa_sanitize_array( wp_unslash( $_GET ) );

			// Check the tutorial status
			self::$iepa_mega_menu_tutorial_steps	=	get_option( 'iepa_mega_menu_tutorial_steps' );

			if ( ( gettype( self::$iepa_mega_menu_tutorial_steps ) === 'boolean' ) && ( self::$iepa_mega_menu_tutorial_steps === false ) ) {
				update_option( 'iepa_mega_menu_tutorial_steps', 0 );
				self::$iepa_mega_menu_tutorial_steps	=	0;
			} else {
				self::$iepa_mega_menu_tutorial_steps	=	( int ) self::$iepa_mega_menu_tutorial_steps;

				if ( isset( self::$query_params['iepa_mega_menu_tutorial'] ) ) {
					update_option( 'iepa_mega_menu_tutorial_steps', 0 );
					self::$iepa_mega_menu_tutorial_steps	=	0;
				}

				if ( self::$iepa_mega_menu_tutorial_steps == 3 ) {
					update_option( 'iepa_mega_menu_tutorial_steps', 4 );
					self::$iepa_mega_menu_tutorial_steps	=	4;
				}

				if ( ( self::$iepa_mega_menu_tutorial_steps < 4 ) && !isset( self::$query_params['iepa_mega_menu_tutorial'] ) ) {
					return;
				}

				if ( self::$iepa_mega_menu_tutorial_steps == 6 ) {
					update_option( 'iepa_mega_menu_tutorial_steps', 7 );
					self::$iepa_mega_menu_tutorial_steps	=	7;
				}

				if ( self::$iepa_mega_menu_tutorial_steps == 8 ) {
					update_option( 'iepa_mega_menu_tutorial_steps', 9 );
					self::$iepa_mega_menu_tutorial_steps	=	9;
				}

			}

			$valid_screens_to_start = array(
				'nav-menus'
			);


			if ( in_array( self::$screen_id, $valid_screens_to_start ) && ( self::$iepa_mega_menu_tutorial_steps != 10 ) ) {

				$this->iepa_init_iepa_mega_menu_tutorial();

			}

		}


		public function iepa_init_iepa_mega_menu_tutorial() {

			$pointers = array(
				'pointers' => array()
			);

			// if ( !get_nav_menu_locations() ) {
				// $pointers['pointers'] = array(
				// 	'create_a_new_menu'	=>	array(
				// 		'target'	=>	'.add-edit-menu-action a',
				// 		'next'		=>	'title',
				// 		'next_trigger' => array(
				// 			'target' => '.add-edit-menu-action a',
				// 			'event'  => 'click',
				// 		),
				// 		'options'      => array(
				// 			'content'  => '<h3 class="iepa-tutorial-head">' . esc_html__( 'Create new menu', IEPA_TEXT_DOMAIN ) . '</h3>' .
				// 										'<p>' . esc_html__( 'Create a new menu.', IEPA_TEXT_DOMAIN ) . '</p>',
				// 			'position' => array(
				// 				'edge'  => 'top',
				// 				'align' => 'middle',
				// 			),
				// 			'button_dismiss'	=>	true,
				// 			'step'				=>	1
				// 		),
				// 	)
				// );
			// }

			$pointers['pointers']['title']	= array(
				'target'       => '#menu-name',
				'next'         => 'menu_theme_locations',
				'next_trigger' => array(
					'target' => '#menu-name',
					'event'  => 'input',
				),
				'options'      => array(
					'content'  => '<h3 class="iepa-tutorial-head">' . esc_html__( 'Menu Name', IEPA_TEXT_DOMAIN ) . '</h3>' .
												'<p>' . esc_html__( 'Give your new menu a name here. This is a required field.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position' => array(
						'edge'  => 'left',
						'align' => 'left',
					),
					'button_dismiss'	=>	true,
					'step'				=>	2
				),
			);

			$pointers['pointers']['menu_theme_locations']	= array(
				'target'  => '.menu-settings-group.menu-theme-locations',
				'next'    => 'save_menu',
				'next_trigger' => array(
					'target' => 'input[type="checkbox"][name*="menu-locations"]',
					'event'  => 'change',
				),
				'options' => array(
					'content'  => '<h3>' . esc_html__( 'Select Menu Display Location!', IEPA_TEXT_DOMAIN ) . '</h3>' .
												'<p>' . esc_html__( 'Select your one of the preferred menu location.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position' => array(
						'edge'  => 'top',
						'align' => 'left',
					),
					'button_dismiss'	=>	true,
					'step'				=>	3
				),
			);

			$pointers['pointers']['save_menu']	=	array(
				'target'				=>	'#save_menu_footer',
				'next'					=>	'select_menus',
				'next_trigger'	=>	array(
					'target'	=>	'#save_menu_footer',
					'event'		=>	'click'
				),
				'options'				=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Save Menu!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Save your menu settings.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'right',
						'align'	=>	'right'
					),
					'button_dismiss'	=>	true,
					'step'						=>	4
				)
			);

			$pointers['pointers']['select_menus']	=	array(
				'target'				=>	'#pagechecklist-most-recent',
				'next'					=>	'add_to_menu',
				'next_trigger'	=>	array(
					'target'	=>	'#pagechecklist-most-recent',
					'event'		=>	'change'
				),
				'options'		=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Selet Pages!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Select pages to add to the menu.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'left',
						'align'	=>	'left'
					),
					'button_dismiss'	=>	true,
					'step'						=>	5
				)
			);

			$pointers['pointers']['add_to_menu']	=	array(
				'target'				=>	'#submit-posttype-page',
				'next'					=>	'save_menu1',
				'next_trigger'	=>	array(
					'target'	=>	'#submit-posttype-page',
					'event'		=>	'click'
				),
				'options'		=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Add to Menu!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Add selected pages to the menu.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'left',
						'align'	=>	'left'
					),
					'button_dismiss'	=>	true,
					'step'						=>	6
				),
			);

			$pointers['pointers']['save_menu1']	=	array(
				'target'				=>	'#save_menu_footer',
				'next'					=>	'enable_mega_menu',
				'next_trigger'	=>	array(
					'target'	=>	'#save_menu_footer',
					'event'		=>	'click'
				),
				'options'		=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Save Menu!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Save your menu settings.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'right',
						'align'	=>	'right'
					),
					'button_dismiss'	=>	true,
					'step'						=>	7
				),
			);

			$pointers['pointers']['enable_mega_menu']	=	array(
				'target'				=>	'#iepammmegamenu_enabled_primary',
				'next'					=>	'save_mega_menu_settings',
				'next_trigger'	=>	array(
					'target'	=>	'#iepammmegamenu_enabled_primary',
					'event'		=>	'change'
				),
				'options'		=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Enable Mega Menu!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Enable Mega Menu Settings.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'left',
						'align'	=>	'left'
					),
					'button_dismiss'	=>	true,
					'step'						=>	8
				),
			);


			$pointers['pointers']['save_mega_menu_settings']	=	array(
				'target'				=>	'.iepa-mega-menu-save',
				'next'					=>	'open_mega_menu_popup',
				'next_trigger'	=>	array(
					'target'	=>	'.iepa-mega-menu-save',
					'event'		=>	'click'
				),
				'options'		=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Save!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Save Mega Menu Settings.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'left',
						'align'	=>	'left'
					),
					'button_dismiss'	=>	true,
					'step'						=>	9
				),
			);


			$pointers['pointers']['open_mega_menu_popup']	=	array(
				'target'				=>	'.menu-item-handle.ui-sortable-handle .item-title .iepa_launch:first',
				'next'					=>	'',
				'next_trigger'	=>	array(
					'target'	=>	'.menu-item-handle.ui-sortable-handle .item-title .iepa_launch:first',
					'event'		=>	'click'
				),
				'options'		=>	array(
					'content'		=>	'<h3>' . esc_html__( 'Open Settings!', IEPA_TEXT_DOMAIN ) . '</h3>' .
													'<p>' . esc_html__( 'Hover over the menu item to see Ibtana Mega Menu Settings button. Click to open Ibtana mega menu settings.', IEPA_TEXT_DOMAIN ) . '</p>',
					'position'	=>	array(
						'edge'	=>	'left',
						'align'	=>	'left'
					),
					'button_dismiss'	=>	true,
					'step'						=>	10
				)
			);


			$this->enqueue_mega_menu_pointers( $pointers );
		}


  	/**
  	 * Setup pointers for screen.
  	 */
  	public function iepa_setup_product_tutorial_pointers_for_screen() {

  		$screen = get_current_screen();

  		if ( ! $screen ) {
  			return;
  		}

			// Check the tutorial status
			self::$iepa_tutorial_steps	=	get_option( 'iepa_tutorial_steps' );

			if ( ( gettype( self::$iepa_tutorial_steps ) === 'boolean' ) && ( self::$iepa_tutorial_steps === false ) ) {
				update_option( 'iepa_tutorial_steps', 0 );
				self::$iepa_tutorial_steps	=	0;
			} else {
				self::$iepa_tutorial_steps	=	( float ) self::$iepa_tutorial_steps;
			}


			self::$query_params	=	IEPA_Loader::iepa_sanitize_array( wp_unslash( $_GET ) );


			self::$screen_id				=	$screen->id;


			self::$is_block_editor	=	$screen->is_block_editor;


			$valid_screens_to_start = array(
				'dashboard',
				'update-core',
				'edit-post',
				'edit-category',
				'edit-post_tag',
				'upload',
				'edit-page',
				'edit-comments',
				'plugins',
				'toplevel_page_ibtana-visual-editor',
				'ibtana-settings_page_ibtana-visual-editor-general-settings',
				'ibtana-settings_page_ibtana-visual-editor-saved-templates',
				'ibtana-settings_page_ibtana-visual-editor-templates',
				'ibtana-settings_page_ibtana-visual-editor-license',
				'ibtana-settings_page_ibtana-visual-editor-addons',
				'woocommerce_page_wc-admin',
				'edit-shop_order',
				'edit-shop_coupon',
				'woocommerce_page_wc-reports',
				'woocommerce_page_wc-settings',
				'woocommerce_page_wc-status',
				'woocommerce_page_wc-addons',
				'edit-product',
				'edit-product_cat',
				'edit-product_tag',
				'product_page_product_attributes',
				'themes',
				'widgets',
				// 'nav-menus',
				'theme-editor',
				'plugin-install',
				'plugin-editor',
				'users',
				'user',
				'profile',
				'tools',
				'import',
				'export',
				'site-health',
				'export-personal-data',
				'erase-personal-data',
				'tools_page_action-scheduler',
				'options-general',
				'options-writing',
				'options-reading',
				'options-discussion',
				'options-media',
				'options-permalink',
				'options-privacy'
			);


  		if ( in_array( self::$screen_id, $valid_screens_to_start ) && ( self::$iepa_tutorial_steps == 0 ) ) {

				$this->iepa_init_iepa_product_tutorial();

			} elseif ( self::$screen_id == 'product' ) {

				if ( !self::$is_block_editor ) {
					$post_status	=	get_post_status();
					if ( 'auto-draft' == $post_status ) {
						if ( isset( self::$query_params['tutorial'] ) ) {
							return;
						}
						if ( self::$iepa_tutorial_steps < 1.1 ) {
							$this->iepa_create_product_tutorial();
						}
					} else {
						if ( self::$iepa_tutorial_steps < 1.2 ) {
							$this->iepa_create_product_tutorial_after_save();
						}
					}
				} else {

					if ( self::$iepa_tutorial_steps < 2 ) {
						$this->iepa_create_product_tutorial_for_block_editor();
					}

				}

  		}
  	}

		/**
		 * Pointers according to the different pages.
		 */
    public function iepa_init_iepa_product_tutorial() {
      $pointers = array(
  			'pointers' => array(
  				'title'          => array(
  					'target'       => '#menu-posts-product',
  					// 'next'         => 'content',
  					'next_trigger' => array(
  						'target' => '#title',
  						'event'  => 'input',
  					),
  					'options'      => array(
  						'content'  => '<h3 class="iepa-tutorial-head">' . esc_html__( 'Create New Product', IEPA_TEXT_DOMAIN ) . '</h3>' .
  										'<p>' . esc_html__( 'To use Ibtana - Ecommerce Product Addons, you need to Add New product first.', IEPA_TEXT_DOMAIN ) . '</p>',
  						'position' => array(
  							'edge'  => 'left',
  							'align' => 'left',
  						),
							'button_dismiss'	=>	true,
							'next_button'	=>	array(
								'text'				=>	esc_html__( 'Add New Product', IEPA_TEXT_DOMAIN ),
								'event_type'	=>	'href',
								'href'				=>	'post-new.php?post_type=product&iepa_tutorial=true',
							),
							'step'				=>	1
  					),
  				)
  			),
  		);

      $this->enqueue_pointers( $pointers );
    }


  	public function iepa_create_product_tutorial() {

  		// These pointers will chain - they will not be shown at once.
  		$pointers = array(
  			'pointers' => array(
  				'title'          => array(
  					'target'       => '#title',
  					'next'         => 'submitdiv',
  					'next_trigger' => array(
  						'target' => '#title',
  						'event'  => 'input',
  					),
  					'options'      => array(
  						'content'  => '<h3 class="iepa-tutorial-head">' . esc_html__( 'Product name', IEPA_TEXT_DOMAIN ) . '</h3>' .
  										'<p>' . esc_html__( 'Give your new product a name here. This is a required field and will be what your customers will see in your store.', IEPA_TEXT_DOMAIN ) . '</p>',
  						'position' => array(
  							'edge'  => 'top',
  							'align' => 'left',
  						),
							'button_dismiss'	=>	true,
							'step'				=>	1.1
  					),
  				),
  				'submitdiv'      => array(
  					'target'  => '#submitdiv',
  					'next'    => '',
  					'options' => array(
  						'content'  => '<h3>' . esc_html__( 'Save your product!', IEPA_TEXT_DOMAIN ) . '</h3>' .
  										'<p>' . esc_html__( 'When you are finished editing your product, hit the "Publish" button to publish your product to your store or you can save as a draft.', IEPA_TEXT_DOMAIN ) . '</p>',
  						'position' => array(
  							'edge'  => 'right',
  							'align' => 'middle',
  						),
  					),
  				),
  			),
  		);

  		$this->enqueue_pointers( $pointers );
  	}


		public function iepa_create_product_tutorial_after_save() {
			$pointers = array(
  			'pointers' => array(
  				'title'          => array(
  					'target'       => '#iepa_product_metabox',
  					// 'next'         => 'content',
  					'next_trigger' => array(
  						'target' => '#iepa_product_metabox',
  						'event'  => 'change',
  					),
  					'options'      => array(
  						'content'  => '<h3 class="iepa-tutorial-head">' . esc_html__( 'Use Block Editor', IEPA_TEXT_DOMAIN ) . '</h3>' .
  										'<p>' . esc_html__( 'Now you are ready to switch to the block editor.', IEPA_TEXT_DOMAIN ) . '</p>',
  						'position' => array(
  							'edge'  => 'right',
  							'align' => 'left',
  						),
							'button_dismiss'	=>	true,
							'next_button'	=>	array(
								'text'				=>	esc_html__( 'Switch Editor', IEPA_TEXT_DOMAIN ),
								'event_type'	=>	'change',
								'selector'		=>	'#iepa_product_metabox',
							),
							'step'				=>	1.2
  					),
  				)
  			),
  		);

      $this->enqueue_pointers( $pointers );
		}


		public function iepa_create_product_tutorial_for_block_editor() {
			$pointers = array(
				'pointers' => array(
					'title'          => array(
						'target'       => '.modal_btn_svg_icon',
						'next'         => '',
						'next_trigger' => array(
							'target' => '.modal_btn_svg_icon',
							'event'  => 'click',
						),
						'options'      => array(
							'content'  => '<h3 class="iepa-tutorial-head">' . esc_html__( 'WooCommerce Product Templates', IEPA_TEXT_DOMAIN ) . '</h3>' .
											'<p>' . esc_html__( 'Check our Ibtana WooCommerce product templates here!', IEPA_TEXT_DOMAIN ) . '</p>',
							'position' => array(
								'edge'  => 'top',
								'align' => 'left',
							),
							'button_dismiss'	=>	true,
							'next_button'	=>	array(
								'text'				=>	esc_html__( 'Check it out now!', IEPA_TEXT_DOMAIN ),
								'event_type'	=>	'click',
								'selector'		=>	'.modal_btn_svg_icon',
							),
							'step'				=>	2
						),
					),
				),
			);

			$this->enqueue_pointers( $pointers );
		}


    /**
  	 * Enqueue pointers and add script to page.
  	 *
  	 * @param array $pointers Pointers data.
  	 */
  	public function enqueue_pointers( $pointers ) {
  		$pointers = rawurlencode( wp_json_encode( $pointers ) );
  		wp_enqueue_style( 'wp-pointer' );
  		wp_enqueue_script( 'wp-pointer' );

			wp_enqueue_style(
				'iepa-admin-pointers-css',
				IEPA_URL . 'IEPA_Pointers/iepa-admin-pointers.css',
				[],
				time()
			);

			wp_register_script(
				'iepa-admin-pointers-js',
				IEPA_URL . 'IEPA_Pointers/iepa-admin-pointers.js',
				[ 'jquery' ],
				time(),
				true
			);

			// Add pointer options to script.
			$iepa_admin_pointers = array(
				'pointers' 					=>	$pointers,
				'IEPA_TEXT_DOMAIN'	=>	IEPA_TEXT_DOMAIN
			);
    	wp_localize_script( 'iepa-admin-pointers-js', 'iepa_admin_pointers', $iepa_admin_pointers );
			wp_enqueue_script( 'iepa-admin-pointers-js' );

  	}



		public function enqueue_mega_menu_pointers( $pointers ) {

  		$pointers = rawurlencode( wp_json_encode( $pointers ) );

  		wp_enqueue_style( 'wp-pointer' );
  		wp_enqueue_script( 'wp-pointer' );

			wp_enqueue_style(
				'iepa-admin-pointers-css',
				IEPA_URL . 'IEPA_Pointers/iepa-admin-pointers.css',
				[],
				time()
			);

			wp_register_script(
				'iepa-admin-pointers-js',
				IEPA_URL . 'IEPA_Pointers/iepa-admin-mega-menu-pointers.js',
				[ 'jquery' ],
				time(),
				true
			);

			// Add pointer options to script.
			$iepa_admin_pointers = array(
				'pointers' 											=>	$pointers,
				'IEPA_TEXT_DOMAIN'							=>	IEPA_TEXT_DOMAIN,
				'iepa_mega_menu_tutorial_steps'	=>	self::$iepa_mega_menu_tutorial_steps
			);
    	wp_localize_script( 'iepa-admin-pointers-js', 'iepa_admin_pointers', $iepa_admin_pointers );
			wp_enqueue_script( 'iepa-admin-pointers-js' );

  	}


}


new IEPA_Admin_Pointers();
