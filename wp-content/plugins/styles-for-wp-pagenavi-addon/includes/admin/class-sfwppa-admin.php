<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Styles For WP Pagenavi Addon
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Sfwppa_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'sfwppa_register_menu') );
		
		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'sfwppa_register_extra_menu'), 12 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'sfwppa_register_settings') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_register_menu() {
		add_menu_page(__('WPOS Pagenavi', 'styles-for-wp-pagenavi-addon'), __('WPOS - Pagenavi', 'styles-for-wp-pagenavi-addon'), 'manage_options', 'sfwppa-settings', array($this, 'sfwppa_main_page'),'dashicons-format-gallery' );
	}
	
	/**
	 * Function to register admin menus
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_register_extra_menu() {		
		add_submenu_page( 'sfwppa-settings', __('Upgrade to PRO - WP Pagenavi Addon', 'styles-for-wp-pagenavi-addon'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'styles-for-wp-pagenavi-addon').'</span>', 'manage_options', 'sfwppa-premium', array($this, 'sfwppa_premium_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_main_page() {
		include_once( SFWPPA_VERSION_DIR . '/includes/admin/settings/sfwppa-settings.php' );
	}
	
	/**
	 * Upgrade to PRO Vs Free 
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_premium_page() {
		include_once( SFWPPA_VERSION_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	
	function sfwppa_register_settings(){
		register_setting( 'sfwppa_plugin_options', 'sfwppa_options' );
	}	
}	

$sfwppa_admin = new Sfwppa_Admin();