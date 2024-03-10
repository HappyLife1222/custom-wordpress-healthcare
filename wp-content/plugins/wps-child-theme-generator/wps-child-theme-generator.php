<?php
/*
Plugin Name: WPS Child Theme Generator
Description:  WPS Child Theme Generator.
Donate link: https://www.paypal.me/donateWPServeur
Version: 1.5.4
Tested up to: 6.3
Author: WPServeur, Benoti, NicolasKulka
Author URI: https://wpserveur.net
License: GPL2
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Plugin constants
define( 'WPS_CHILD_THEME_GENERATOR_VERSION', '1.5.4' );
define( 'WPS_CHILD_THEME_GENERATOR_FOLDER', 'wps-child-theme-generator' );
define( 'WPS_CHILD_THEME_GENERATOR_BASENAME', plugin_basename( __FILE__ ) );
if ( ! defined( 'WPS_PUB_API_URL' ) ) {
	define( 'WPS_PUB_API_URL', 'https://www.wpserveur.net/wp-json/' );
}

define( 'WPS_CHILD_THEME_GENERATOR_URL', plugin_dir_url( __FILE__ ) );
define( 'WPS_CHILD_THEME_GENERATOR_DIR', plugin_dir_path( __FILE__ ) );

require_once WPS_CHILD_THEME_GENERATOR_DIR . 'autoload.php';

add_action( 'plugins_loaded', 'plugins_loaded_wps_child_theme_generator_plugin' );
function plugins_loaded_wps_child_theme_generator_plugin() {
	\WPS\WPS_Child_Theme_Generator\Plugin::get_instance();

	load_plugin_textdomain( 'wps-child-theme-generator', false, basename( rtrim( dirname( __FILE__ ), '/' ) ) . '/languages' );
}