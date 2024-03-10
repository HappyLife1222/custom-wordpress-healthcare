<?php
/**
 * Wizard
 *
 * @package IEPA_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class IEPA_Whizzie {

	protected $version = '1.1.0';

	/** @var string Current plugin name, used as namespace in actions. */
	protected $plugin_name = '';
	protected $plugin_title = '';

	/** @var string Wizard page slug and title. */
	protected $page_slug = '';
	protected $page_title = '';

	/** @var array Wizard steps set by user. */
	protected $config_steps = array();

	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $iepa_tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $iepa_tgmpa_menu_slug = 'iepa-tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'plugins.php?page=iepa-tgmpa-install-plugins';


	public $iepa_loading_errors	=	0;


	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {

		require_once trailingslashit( IEPA_WHIZZIE_DIR ) . 'iepa_tgmpa/iepa-class-tgm-plugin-activation.php';
		require_once trailingslashit( IEPA_WHIZZIE_DIR ) . 'iepa_tgmpa/required-plugins.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug	=	esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps	= $config['steps'];
		}

		$this->plugin_path	=	trailingslashit( dirname( __FILE__ ) );
		$relative_url				=	str_replace( IEPA_DIR, '', $this->plugin_path );
		$this->plugin_url		=	trailingslashit( IEPA_PLUGIN_URI . $relative_url );
		$this->plugin_url		=	IEPA_PLUGIN_URI . 'IEPA_Whizzie/';

		$current_plugin			=	get_plugin_data( IEPA_PLUGIN_FILE );
		$this->plugin_title = $current_plugin[ 'Name' ];
		$this->plugin_name	=	strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_plugin[ 'Name' ] ) );
		$this->page_slug		=	apply_filters( $this->plugin_name . '_theme_setup_wizard_page_slug', $this->plugin_name . '-setup' );

		$this->parent_slug	=	apply_filters( $this->plugin_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {

		add_action( 'activated_plugin', array( $this, 'redirect_to_wizard' ), 100, 2 );

		if ( class_exists( 'IEPA_TGM_Plugin_Activation' ) && isset( $GLOBALS['iepa_tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_iepa_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'iepa_tgmpa_load', array( $this, 'iepa_tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_iepa_setup_plugins', array( $this, 'iepa_setup_plugins' ) );

	}

	public function iepa_load_plugin() {

		if ( ! class_exists( 'WooCommerce' ) ) {
			/* TO DO */
			++$this->iepa_loading_errors;
		}

		if ( ! did_action( 'ibtana-visual-editor/loaded' ) ) {
			/* TO DO */
			++$this->iepa_loading_errors;
		}

	}

	public function redirect_to_wizard( $plugin, $network_wide ) {
		global $pagenow;
		if( is_admin() && ( 'plugins.php' == $pagenow ) && current_user_can( 'manage_options' ) && ( IEPA_BASE == $plugin ) ) {
			if ( !class_exists( 'WooCommerce' ) || !did_action( 'ibtana-visual-editor/loaded' ) ) {
				wp_redirect( admin_url( 'tools.php?page=' . esc_attr( $this->page_slug ) ) );
				exit;
			}
		}
	}

	public function enqueue_scripts( $hook ) {
		if ( "tools_page_ibtanaecommerceproductaddons-setup" != $hook ) {
			return;
		}

		wp_enqueue_style( 'iepa-whizzie-style', $this->plugin_url . 'assets/css/iepa-admin-style.css', array(), time() );
		wp_register_script( 'iepa-whizzie-script-js', $this->plugin_url . 'assets/js/iepa_whizzie.js', array( 'jquery' ), time() );
		wp_localize_script(
			'iepa-whizzie-script-js',
			'iepa_whizzie_params',
			array(
				'ajaxurl'				=>	admin_url( 'admin-ajax.php' ),
				'admin_url'			=>	admin_url(),
				'wpnonce' 			=>	wp_create_nonce( 'iepa_whizzie_nonce' ),
				'verify_text'		=>	esc_html( 'verifying', IEPA_TEXT_DOMAIN ),
				'woocommerce'		=>	class_exists( 'WooCommerce' )
			)
		);
		wp_enqueue_script( 'iepa-whizzie-script-js' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function iepa_tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_plugins' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_iepa_tgmpa_instance() {
		$this->iepa_tgmpa_instance = call_user_func( array( get_class( $GLOBALS['iepa_tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $iepa_tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->iepa_tgmpa_menu_slug = ( property_exists( $this->iepa_tgmpa_instance, 'menu' ) ) ? $this->iepa_tgmpa_instance->menu : $this->iepa_tgmpa_menu_slug;
		$this->iepa_tgmpa_menu_slug = apply_filters( $this->plugin_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->iepa_tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->iepa_tgmpa_instance, 'parent_slug' ) && $this->iepa_tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->plugin_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->iepa_tgmpa_menu_slug );
	}

	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_submenu_page(
			'tools.php',
			esc_html__( $this->page_title ),
			esc_html__( $this->page_title ),
			'manage_options',
			$this->page_slug,
			array( $this, 'iepa_wizard_page' )
		);
	}

	/**
	 * Make an interface for the wizard
	 */
	public function iepa_wizard_page() {

		iepa_tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'IEPA_TGM_Plugin_Activation' ) || ! isset( $GLOBALS['iepa_tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST ) ) ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>


		<div class="iepa-theme-page-header">
			<div class="iepa-container iepa-flex iepa-templates-header-container">
				<div class="iepa-theme-title">
					<img src="<?php echo esc_url( IEPA_URL . 'IEPA_Whizzie/assets/img/adminIcon.png' ); ?>" class="iepa-theme-icon">
				</div>
				<div class="iepa-top-links">
					<p class="iepara-theme-version">
						<strong>
							<?php
								esc_html_e( 'v' . IEPA_VERSION, IEPA_TEXT_DOMAIN );
							?>
						</strong>
					</p>
					<p>
						<img src="<?php echo esc_url( IEPA_URL . 'IEPA_Whizzie/assets/img/lightning.svg' ); ?>" class="iepara-lightning-icon">
						<?php esc_html_e( 'Lightning Fast &amp; Fully Customizable WordPress theme!', IEPA_TEXT_DOMAIN ); ?>
					</p>
				</div>
			</div>
		</div>


		<div class="iepa-admin-wrap">
			<?php
			// printf( '<h1>%s</h1>', esc_html( $this->page_title ) );
			$plugins = $this->get_plugins();

			$iepa_all_dependencies_available = false;
			if ( isset( $plugins['all'] ) && !$plugins['all'] ) {
				$iepa_all_dependencies_available = true;
			}


			if ( !$iepa_all_dependencies_available ) {
			?>
			<div class="card iepa-whizzie-wrap">
				<?php
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo wp_kses_post( '<ul class="iepa-whizzie-menu">' );
				foreach( $steps as $step ) {
					$class = 'iepa-step step-' . esc_attr( $step['id'] );
					echo wp_kses_post( '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">' );
						printf( '<h2>%s</h2>', esc_html__( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf(
								'<p><a href="#" class="iepa-more-info">%s</a></p>',
								__( 'More Info', IEPA_TEXT_DOMAIN )
							);
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button
						if( isset( $step['button_text'] ) && $step['button_text'] ) {
							printf(
								'<div class="iepa-button-wrap"><a href="#" class="button button-primary iepa-do-it" data-callback="%s" data-step="%s">%s</a></div>',
								esc_attr( $step['callback'] ),
								esc_attr( $step['id'] ),
								esc_html__( $step['button_text'] )
							);
						}
						// The skip button
						if( isset( $step['can_skip'] ) && $step['can_skip'] ) {
							printf(
								'<div class="iepa-button-wrap" style="margin-left: 0.5em;"><a href="#" class="button button-secondary iepa-do-it" data-callback="%s" data-step="%s">%s</a></div>',
								'do_next_step',
								esc_attr( $step['id'] ),
								__( 'Skip', IEPA_TEXT_DOMAIN )
							);
						}

					echo wp_kses_post( '</li>' );
				}
				echo wp_kses_post( '</ul>' );
				echo wp_kses_post( '<ul class="iepa-whizzie-nav">' );
					foreach( $steps as $step ) {
						if( isset( $step['icon'] ) && $step['icon'] ) {
							echo wp_kses_post( '<li class="nav-step-' . esc_attr( $step['id'] ) . '"><span class="dashicons dashicons-' . esc_attr( $step['icon'] ) . '"></span></li>' );
						}
					}
				echo wp_kses_post( '</ul>' );
				?>
				<div class="iepa-step-loading"><span class="spinner"></span></div>
			</div><!-- .iepa-whizzie-wrap -->
			<?php
			}
			?>

			<div class="iepa-cards-wrap" <?php if( $iepa_all_dependencies_available ) { echo esc_attr( "style=display:flex;" ); } ?>>
				<?php
				// Check if the license is activated or not
				$iepa_key = str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key';
				$iepa_key_arr = get_option( $iepa_key );
				$iepa_key_arr_license_status = false;
				if ( $iepa_key_arr ) {
					if ( isset( $iepa_key_arr['license_status'] ) ) {
						if ( true == $iepa_key_arr['license_status'] ) {
							$iepa_key_arr_license_status = true;
						}
					}
				}

				?>

				<div class="card">
					<h2>
						<?php esc_html_e( 'Ibtana Ecommerce Product Addons', 'ibtana-ecommerce-product-addons' ); ?>
					</h2>

					<img src="<?php echo esc_url( IEPA_URL . 'IEPA_Whizzie/assets/img/ibtana-ecommerce-product-addon-display-image.png' ); ?>" alt="">

					<div class="summary">
						<p>
							<?php
							esc_html_e(
								'View our free and premium demos or start the setup wizard which will guide you through all the steps to set up your product.',
								'ibtana-ecommerce-product-addons'
							);
							?>
						</p>
					</div>

					<div class="iepa-button-wrap">
						<a href="<?php echo esc_url( 'https://www.vwthemesdemo.com/vw-ecommerce-templates/#templates-main' ); ?>"
							target="_blank" class="button button-primary <?php if( $iepa_key_arr_license_status ) { echo 'iepa-button-wide'; } ?>"
						>
							<?php esc_html_e( 'View Demos', 'ibtana-ecommerce-product-addons' ); ?>
						</a>

						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=product&iepa_tutorial=true' ) ); ?>"
							class="button button-primary <?php if( $iepa_key_arr_license_status ) { echo esc_attr( 'iepa-button-wide' ); } ?>"
						>
							<?php esc_html_e( 'Start Setup', 'ibtana-ecommerce-product-addons' ); ?>
						</a>

						<?php if ( !$iepa_key_arr_license_status ): ?>
						<a href="<?php echo esc_url( 'https://www.vwthemes.com/plugins/woocommerce-product-add-ons/' ); ?>"
							target="_blank" class="button button-primary iepa-button-wide"
						>
							<?php esc_html_e( 'Get Premium', 'ibtana-ecommerce-product-addons' ); ?>
						</a>
						<?php endif; ?>

					</div>


					<div class="summary">
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Use Gutenberg editor to fully customize your WooCommerce product page.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get 4 free WooCommerce Gutenberg blocks to make product page functionality-rich: Add To Cart, Product Images, Product Price, Product Rating.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get 3 premium Gutenberg blocks to enhance product page functionality: Product Sale Countdown, Product Meta, Product Reviews.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get 37+ free and 8+ premium pre-build product templates.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Customize prebuild templates and save them in the library as your own template.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Add custom CSS and JS.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get step by step setup wizard which will guide you through all the steps to set up the product page.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
					</div>

				</div>



				<div class="card">
					<h2>
						<?php esc_html_e( 'Ibtana Mega Menu', 'ibtana-ecommerce-product-addons' ); ?>
					</h2>

					<img src="<?php echo esc_url( IEPA_URL . 'IEPA_Whizzie/assets/img/ibtana-mega-menu-display-image.png' ); ?>" alt="">

					<div class="summary">
						<p>
							<?php
							esc_html_e(
								'View our mega menu demos or start the setup wizard which will guide you through all the steps to set up your menus.',
								'ibtana-ecommerce-product-addons'
							);
							?>
						</p>
					</div>

					<div class="iepa-button-wrap">
						<a href="<?php echo esc_url( 'https://www.vwthemesdemo.com/ibtana-mega-menu-addon/' ); ?>"
							target="_blank" class="button button-primary iepa-button-wide"
						>
							<?php esc_html_e( 'View Demos', 'ibtana-ecommerce-product-addons' ); ?>
						</a>
						<?php if ( $iepa_key_arr_license_status ): ?>
						<a href="<?php echo esc_url( admin_url( 'nav-menus.php?action=edit&menu=0&iepa_mega_menu_tutorial=true' ) ); ?>" class="button button-primary iepa-button-wide">
							<?php esc_html_e( 'Start Setup', 'ibtana-ecommerce-product-addons' ); ?>
						</a>
						<?php else: ?>
						<a href="<?php echo esc_url( 'https://www.vwthemes.com/plugins/woocommerce-product-add-ons/' ); ?>"
							target="_blank" class="button button-primary iepa-button-wide"
						>
							<?php esc_html_e( 'Get Premium', 'ibtana-ecommerce-product-addons' ); ?>
						</a>
						<?php endif; ?>
					</div>

					<div class="summary">
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get 12 mega menu widgets.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get 24 skins/templates.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get 3 WooCommerce widgets.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Add custom CSS and JS.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get a shortcode to manually integrate the mega menu at a specific location.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get event behavior, animation settings, mobile settings, sticky option, image settings, icon settings, menu orientation settings for the mega menu.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
						<p>
							<span class="dashicons dashicons-yes"></span>
							<?php esc_html_e( 'Get step by step setup wizard which will guide you through all the steps to set up the mega menu.', 'ibtana-ecommerce-product-addons' ); ?>
						</p>
					</div>

				</div>

			</div>



		</div><!-- .wrap -->
		<?php
	}

	/**
	 * Set options for the steps
	 * Incorporate any options set by the plugin dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps	=	array(
			'intro'		=>	array(
				'id'					=>	'intro',
				'title'				=>	__( 'Welcome to ', IEPA_TEXT_DOMAIN ) . $this->plugin_title,
				'icon'				=>	'dashboard',
				'view'				=>	'get_step_intro', // Callback for content
				'callback'		=>	'do_next_step', // Callback for JS
				'button_text'	=>	__( 'Start Now', IEPA_TEXT_DOMAIN ),
				'can_skip'		=>	false // Show a skip button?
			),
			'plugins'	=>	array(
				'id'					=>	'plugins',
				'title'				=>	__( 'Plugins', IEPA_TEXT_DOMAIN ),
				'icon'				=>	'admin-plugins',
				'view'				=>	'get_step_plugins',
				'callback'		=>	'install_plugins',
				'button_text'	=>	__( 'Install Plugins', IEPA_TEXT_DOMAIN ),
				'can_skip'		=>	false
			),
			'done'		=>	array(
				'id'					=>	'done',
				'title'				=>	__( 'All Done', IEPA_TEXT_DOMAIN ),
				'icon'				=>	'yes',
				'view'				=>	'get_step_done',
				'callback'		=>	'',
				'button_text'	=>	__( 'Check Now', IEPA_TEXT_DOMAIN ),
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/**
	 * Print the content for the intro step
	 */
	public function get_step_intro() {
		$content = array();
		// The summary element will be the content visible to the user
		$content['summary'] = sprintf(
			'<p>%s</p>',
			esc_html__( 'Thank you for choosing Ecommerce Product Addons. To setup your product page click start now. It should only take a couple of minutes to go through all the steps.', 'ibtana-ecommerce-product-addons' ),
			IEPA_TEXT_DOMAIN
		);
		return $content;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array();
		// The summary element will be the content visible to the user
		$content['summary'] = sprintf(
			'<p>%s</p>',
			esc_html__(
				'This plugin works only when required plugins are installed. Click the button to install. You can still install or deactivate plugins later from the dashboard.',
				IEPA_TEXT_DOMAIN
			),
			IEPA_TEXT_DOMAIN
		);
		$content = apply_filters( 'whizzie_filter_summary_content', $content );

		// The detail element is initially hidden from the user
		$content['detail'] = '<ul class="iepa-whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug => $plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html__( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = esc_html__( 'Installation', 'ibtana-ecommerce-product-addons' );
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = esc_html__( 'Update', 'ibtana-ecommerce-product-addons' );
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = esc_html__( 'Activation', 'ibtana-ecommerce-product-addons' );
			}
			$content['detail'] .= implode( ' and ', $keys ) . esc_html__( ' required', 'ibtana-ecommerce-product-addons' );
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}


	/**
	 * Print the content for the final step
	 */
	public function get_step_done() {
		$content = array();
		// The summary element will be the content visible to the user

		$content['summary'] = sprintf(
			'<p>%s</p>',
			esc_html__( 'You can check our free and premium ibtana templates or start setting things up.', 'ibtana-ecommerce-product-addons' ),
			IEPA_TEXT_DOMAIN
		);
		return $content;
	}


	function find_my_menu_item( $handle, $sub = false ) {
	  if( !is_admin() || (defined('DOING_AJAX') && DOING_AJAX) )
	    return false;
	  global $menu, $submenu;
	  $check_menu = $sub ? $submenu : $menu;
	  if( empty( $check_menu ) )
	    return false;
	  foreach( $check_menu as $k => $item ){
	    if( $sub ){
	      foreach( $item as $sm ){
	        if($handle == $sm[2])
	          return true;
	      }
	    } else {
	      if( $handle == $item[2] )
	        return true;
	    }
	  }
	  return false;
	}


	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {

		if ( !$this->find_my_menu_item( 'iepa-tgmpa-install-plugins', true ) ) {
			remove_submenu_page( 'tools.php', 'ibtanaecommerceproductaddons-setup' );
		}

		$instance = call_user_func( array( get_class( $GLOBALS['iepa_tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 			=>	array(),
			'install'		=>	array(),
			'update'		=>	array(),
			'activate'	=>	array()
		);
		foreach( $instance->plugins as $slug => $plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}



	public function iepa_setup_plugins() {
		if ( ! check_ajax_referer( 'iepa_whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->iepa_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'iepa-tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->iepa_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'iepa-tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->iepa_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'iepa-tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success' ) ) );
		}
		exit;
	}


}
