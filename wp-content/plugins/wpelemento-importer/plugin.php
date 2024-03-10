<?php
/*
  Plugin Name:       WPElemento Importer
  Plugin URI:
  Description:       This plugin helps to import demo content using elementor.
  Version:           0.3.9
  Requires at least: 5.2
  Requires PHP:      7.2
  Author:            wpelemento
  Author URI:
  License:           GPL v2 or later
  License URI:       https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain:       wpelemento-importer
*/

register_activation_hook(__FILE__, 'wpelemento_importer_activate');
add_action('admin_init', 'wpelemento_importer_redirect');

function wpelemento_importer_activate() {
  add_option('wpelemento_importer_do_activation_redirect', true);
}
function wpelemento_importer_redirect() {
  if (get_option('wpelemento_importer_do_activation_redirect', false)) {
    delete_option('wpelemento_importer_do_activation_redirect');
    wp_redirect("admin.php?page=wpelementoimporter-wizard");
    exit;
  }
  }

define( 'EDI_FILE', __FILE__ );
define( 'EDI_BASE', plugin_basename( EDI_FILE ) );
define( 'EDI_DIR', plugin_dir_path( EDI_FILE ) );
define( 'EDI_URL', plugins_url( '/', EDI_FILE ) );
define( 'WPEI_THEME_LICENCE_ENDPOINT', 'https://www.wpelemento.com/wp-json/ibtana-licence/v2/' );
define( 'WPELEMENTO_IMPORTER_TEXT_DOMAIN', "wpelemento-importer" );
define( 'WPELEMENTO_MAIN_URL', "https://www.wpelemento.com/" );

if( ! function_exists('get_plugin_data') ) {
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
require EDI_DIR .'theme-wizard/config.php';
require EDI_DIR .'classes/bdi-notice.php';
