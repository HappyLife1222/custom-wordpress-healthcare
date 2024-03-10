<?php
/**
 * IEPA Loader.
 *
 * @package IEPA
 */

if ( ! class_exists( 'IEPA_Loader' ) ) {

	/**
	 * Class IEPA_Loader.
	 */
	final class IEPA_Loader {

		/**
		 * Member Variable
		 *
		 * @var iepa_loader_instance
		 */
		private static $iepa_loader_instance;

		public static $iepa_loading_errors	=	0;

		/**
		 *  Initiator
		 */
		public static function iepa_loader_get_instance() {
			if ( ! isset( self::$iepa_loader_instance ) ) {
				self::$iepa_loader_instance = new self();
			}
			return self::$iepa_loader_instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'iepa_load_plugin' ) );
			do_action( 'ibtana-ecommerce-product-addons/loaded' );
		}


		/**
		 * Loads plugin files.
		 *
		 * @since 0.0.1
		 *
		 * @return void
		 */
		public function iepa_load_plugin() {

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

			$is_IEPA_Whizzie_page	=	( isset( $_GET['page'] ) && ( $_GET['page'] == 'ibtanaecommerceproductaddons-setup' ) ) ? true : false;

			if ( ! class_exists( 'WooCommerce' ) ) {
				/* TO DO */
				if ( !$is_IEPA_Whizzie_page ) {
					add_action( 'admin_notices', array( $this, 'iepa_woocommerce_fails_to_load' ) );
					add_action( 'network_admin_notices', array( $this, 'iepa_woocommerce_fails_to_load' ) );
				}
				++self::$iepa_loading_errors;
			}


			if ( !did_action( 'ibtana-visual-editor/loaded' ) || !file_exists( IEPA_WP_PLUGINS_DIR . '/ibtana-visual-editor/plugin.php' ) ) {
				/* TO DO */
				if ( !$is_IEPA_Whizzie_page ) {
					add_action( 'admin_notices', array( $this, 'iepa_ive_fails_to_load' ) );
					add_action( 'network_admin_notices', array( $this, 'iepa_ive_fails_to_load' ) );
				}
				++self::$iepa_loading_errors;
			}

			if ( !self::$iepa_loading_errors ) {
				require_once IEPA_ABSPATH . '../ibtana-visual-editor/plugin.php';
				require_once IEPA_DIR . 'iepa_submenu.php';
				require_once IEPA_DIR . 'IEPA_Pointers/class-iepa-admin-pointers.php';

				if ( file_exists( IEPA_DIR . 'addons/ibtana-custom-posttype-addon/ibtana-custom-posttype-addon.php' ) ) {
					require_once IEPA_DIR . 'addons/ibtana-custom-posttype-addon/ibtana-custom-posttype-addon.php'; // Custom Posttype
				}


				if ( file_exists( IEPA_DIR . 'addons/ibtana-mega-menu/iepa-mega-menu.php' ) ) {
					require_once IEPA_DIR . 'addons/ibtana-mega-menu/iepa-mega-menu.php'; // Mega Menu
				}

				add_filter( 'ive_add_on_license_info', function( $ive_add_on_license_keys ) {
					$iepa_key = str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key';
					$ive_add_on_license_keys[ $iepa_key ] = get_option( $iepa_key );
					return $ive_add_on_license_keys;
				} );
			} else {
				require_once IEPA_DIR . 'IEPA_Whizzie/config.php';
			}
		}


		/**
		 * Fires admin notice when WooCommerce is not installed and activated.
		 *
		 * @since 0.0.1
		 *
		 * @return void
		 */
		public function iepa_woocommerce_fails_to_load() {
			$iepa_notice_class = 'notice notice-error';
			/* translators: %s: html tags */
			$iepa_plugin_name = get_plugin_data( IEPA_PLUGIN_FILE )['Name'];
			$iepa_message_notice = sprintf(
				__(
						'The %1$s' . $iepa_plugin_name . '%2$s plugin requires %1$sWooCommerce%2$s plugin installed & activated.',
						'ibtana-ecommerce-product-addons'
					),
				'<strong>',
				'</strong>'
			);

			$iepa_woo_com_plugin = 'woocommerce/woocommerce.php';

			if ( iepa_is_woocommerce_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}

				$iepa_action_url   = wp_nonce_url(
					'plugins.php?action=activate&amp;plugin=' . $iepa_woo_com_plugin . '&amp;plugin_status=all&amp;paged=1&amp;s',
					'activate-plugin_' . $iepa_woo_com_plugin
				);
				$iepa_button_label = __( 'Activate WooCommerce', 'ibtana-ecommerce-product-addons' );

			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}

				$iepa_action_url   = wp_nonce_url(
					self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ),
					'install-plugin_woocommerce'
				);
				$iepa_button_label = __( 'Install WooCommerce', 'ibtana-ecommerce-product-addons' );
			}

			$iepa_button = '<p><a href="' . $iepa_action_url . '" class="button-primary">' . $iepa_button_label . '</a></p><p></p>';

			printf(
				'<div class="%1$s"><p>%2$s</p>%3$s</div>',
				esc_attr( $iepa_notice_class ),
				wp_kses_post( $iepa_message_notice ),
				wp_kses_post( $iepa_button )
			);
		}

		/**
		 * Fires admin notice when Ibtana – WordPress Website Builder is not installed and activated.
		 *
		 * @since 0.0.1
		 *
		 * @return void
		 */
		public function iepa_ive_fails_to_load() {
			$iepa_notice_class = 'notice notice-error';
			/* translators: %s: html tags */
			$iepa_plugin_name = get_plugin_data( IEPA_PLUGIN_FILE )['Name'];
			$iepa_message_notice = sprintf(
				__(
						'The %1$s' . $iepa_plugin_name . '%2$s plugin requires %1$sIbtana – WordPress Website Builder%2$s plugin installed & activated.',
						'ibtana-ecommerce-product-addons'
					),
				'<strong>',
				'</strong>'
			);

			$iepa_ive_plugin = 'ibtana-visual-editor/plugin.php';

			if ( iepa_is_ive_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}

				$iepa_action_url   = wp_nonce_url(
					'plugins.php?action=activate&amp;plugin=' . $iepa_ive_plugin . '&amp;plugin_status=all&amp;paged=1&amp;s',
					'activate-plugin_' . $iepa_ive_plugin
				);
				$iepa_button_label = __( 'Activate Ibtana – WordPress Website Builder', 'ibtana-ecommerce-product-addons' );

			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}

				$iepa_action_url   = wp_nonce_url(
					self_admin_url( 'update.php?action=install-plugin&plugin=ibtana-visual-editor' ),
					'install-plugin_ibtana-visual-editor'
				);
				$iepa_button_label = __( 'Install Ibtana – WordPress Website Builder', 'ibtana-ecommerce-product-addons' );
			}

			$iepa_button = '<p><a href="' . $iepa_action_url . '" class="button-primary">' . $iepa_button_label . '</a></p><p></p>';

			printf(
				'<div class="%1$s"><p>%2$s</p>%3$s</div>',
				esc_attr( $iepa_notice_class ),
				wp_kses_post( $iepa_message_notice ),
				wp_kses_post( $iepa_button )
			);
		}

		public static function iepa_sanitize_array( $var ) {
			if ( is_array( $var ) ) {
				return array_map( 'self::iepa_sanitize_array', $var );
			} else {
				return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
			}
		}

	}

	/**
	 *  Prepare if class 'IEPA_Loader' exist.
	 *  Kicking this off by calling 'iepa_loader_get_instance()' method
	 */
	IEPA_Loader::iepa_loader_get_instance();
}

/**
 * Is Ibtana – WordPress Website Builder plugin installed.
 */
if ( ! function_exists( 'iepa_is_ive_installed' ) ) {

	/**
	 * Check if Ibtana – WordPress Website Builder is installed
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	function iepa_is_ive_installed() {
		$iepa_ive_path    = 'ibtana-visual-editor/plugin.php';
		$iepa_get_plugins = get_plugins();

		return isset( $iepa_get_plugins[ $iepa_ive_path ] );
	}
}

/**
 * Is WooCommerce plugin installed.
 */
if ( ! function_exists( 'iepa_is_woocommerce_installed' ) ) {

	/**
	 * Check if WooCommerce is installed
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	function iepa_is_woocommerce_installed() {
		$iepa_woo_com_path	= 'woocommerce/woocommerce.php';
		$iepa_get_plugins	= get_plugins();

		return isset( $iepa_get_plugins[ $iepa_woo_com_path ] );
	}
}
