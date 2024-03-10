<?php
/**
 * Plugin Name: Styles For WP Pagenavi Addon
 * Plugin URI: https://www.essentialplugin.com/wordpress-plugin/styles-wp-pagenavi-addon/
 * Text Domain: styles-for-wp-pagenavi-addon
 * Domain Path: /languages/
 * Description: Adds a more styling options to Wp-PageNavi WordPress plugin OR  the_posts_pagination(); WordPress navigation function
 * Author: WP OnlineSupport, Essential Plugin
 * Version: 1.2.1
 * Author URI: https://www.essentialplugin.com/wordpress-plugin/styles-wp-pagenavi-addon/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! defined('SFWPPA_VERSION') ) {
    define( 'SFWPPA_VERSION', '1.2.1' ); // Plugin version
}
if( ! defined( 'SFWPPA_VERSION_DIR' ) ) {
    define( 'SFWPPA_VERSION_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'SFWPPA_URL' ) ) {
    define( 'SFWPPA_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if(!defined( 'SFWPPA_SITE_LINK' ) ) {
	define('SFWPPA_SITE_LINK','https://www.essentialplugin.com'); // Plugin link
}

function sfwppa_load_textdomain() {
	load_plugin_textdomain( 'styles-for-wp-pagenavi-addon', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'sfwppa_load_textdomain'); 

global $sfwppa_options;

// Function file
require_once( SFWPPA_VERSION_DIR . '/includes/sfwppa-function.php' );
$sfwppa_options = sfwppa_get_settings();

// Admin Class
require_once( SFWPPA_VERSION_DIR . '/includes/admin/class-sfwppa-admin.php' );

// Script
require_once( SFWPPA_VERSION_DIR . '/includes/class-sfwppa-script.php' );