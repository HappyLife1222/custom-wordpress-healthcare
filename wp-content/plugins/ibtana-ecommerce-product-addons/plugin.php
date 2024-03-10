<?php
/**
 * Plugin Name: Ibtana - Ecommerce Product Addons
 * Plugin URI: https://www.vwthemes.com/plugins/free-woocommerce-product-add-ons/
 * Description: With the Ibtana - Ecommerce Product Addons, you get to explore so many options for editing the product page by simple drag and drop functionality. You just need to use the add ons to create a unique product page in a manner that it resembles your brand in the most promising way. Woocommerce add ons will help you to get a distinct online store than those with the conventional design that your customers are tired of seeing.
 * Author: VowelWeb
 * Author URI: https://www.vowelweb.com/
 * Version: 0.4.6.2
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ibtana-ecommerce-product-addons
 * Domain Path:       /languages
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'IEPA_PLUGIN_FILE', __FILE__ );
define( 'IEPA_PLUGIN_URI', plugins_url( '/', IEPA_PLUGIN_FILE ) );
define( 'IEPA_PLUGIN_THEME', 'ibtana' );
define( 'IEPA_DESKTOP_STARTPOINT', '1025' );
define( 'IEPA_TABLET_BREAKPOINT', '1024' );
define( 'IEPA_MOBILE_BREAKPOINT', '767' );
define( 'IEPA_BASE', plugin_basename( IEPA_PLUGIN_FILE ) );
define( 'IEPA_DIR', plugin_dir_path( IEPA_PLUGIN_FILE ) );
define( 'IEPA_WP_PLUGINS_DIR', str_replace( 'ibtana-ecommerce-product-addons/', '', plugin_dir_path( IEPA_PLUGIN_FILE ) ) );
define( 'IEPA_URL', plugins_url( '/', IEPA_PLUGIN_FILE ) );
define( 'IEPA_ABSPATH', dirname(__FILE__) . '/' );

if( ! function_exists('get_plugin_data') ) {
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$plugin_data = get_plugin_data( __FILE__ );
define( 'IEPA_VERSION', $plugin_data['Version'] );
define( 'IEPA_TEXT_DOMAIN', $plugin_data['TextDomain'] );

require_once 'classes/class-iepa-loader.php';
require_once IEPA_DIR . 'IEPA_Whizzie/config.php';

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

require_once IEPA_DIR . 'inc/class-admin.php';
require_once IEPA_DIR . 'inc/class-public.php';
require_once IEPA_DIR . 'inc/class-pro.php';
require_once IEPA_DIR . 'iepa_addon.php';

require_once IEPA_DIR . 'classes/class-iepa-config.php';
require_once IEPA_DIR . 'classes/class-iepa-block-helper.php';
require_once IEPA_DIR . 'classes/class-iepa-block-js.php';
require_once IEPA_DIR . 'classes/class-iepa-helper.php';
