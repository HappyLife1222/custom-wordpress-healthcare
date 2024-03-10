<?php
define( 'ICPA_PLUGIN_FILE', __FILE__ );
define( 'ICPA_PATH', plugin_dir_path( ICPA_PLUGIN_FILE ) );
define( 'ICPA_ABSPATH', dirname(ICPA_PLUGIN_FILE) . '/' );
define( 'ICPA_PLUGIN_URI', plugins_url( '/', ICPA_PLUGIN_FILE ) );

if( ! function_exists('get_plugin_data') ) {
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$plugin_data = get_plugin_data( __FILE__ );
define( 'ICPA_VERSION', $plugin_data['Version'] );

require_once ICPA_PATH . 'classes/class-icpa-loader.php';
require_once ICPA_PATH . 'classes/class-icpa-submenu.php';
