<?php

/**
 * Settings for theme wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/

if (!defined('IVE_WHIZZIE_DIR')) {
	define('IVE_WHIZZIE_DIR', dirname(__FILE__));
}
// Load the Whizzie class and other dependencies
require trailingslashit(IVE_WHIZZIE_DIR) . 'whizzie.php';
// Gets the theme object
$current_theme = wp_get_theme();
$theme_title = $current_theme->get('Name');

/**
 * Make changes below
 **/

	$config['page_slug'] 	= 'setup-wizard';
	$config['page_title']	= 'Setup Wizard';
	$config['steps'] = array(
		'intro' => array(
			'id'			=> 'intro', // ID for section - don't rename
			'title'			=> __('Welcome to ', 'whizzie') . $theme_title, // Section title
			'icon'			=> 'dashboard', // Uses Dashicons
			'button_text'	=> __('Start Now', 'whizzie'), // Button text
			'can_skip'		=> false // Show a skip button?
		),
		'plugins' => array(
			'id'			=> 'plugins',
			'title'			=> __('Plugins', 'whizzie'),
			'icon'			=> 'admin-plugins',
			'button_text'	=> __('Install Plugins', 'whizzie'),
			'can_skip'		=> true
		),
		'widgets' => array(
			'id'			=> 'widgets',
			'title'			=> __('Import Demo', 'whizzie'),
			'icon'			=> 'welcome-widgets-menus',
			'button_text_one'	=> __('Click On The Image To Import Customizer Demo', 'whizzie'),
			'button_text_two'	=> __('Click On The Image To Import Elementor Demo', 'whizzie'),
			'can_skip'		=> false
		),
		'done' => array(
			'id'			=> 'done',
			'title'			=> __('All Done', 'whizzie'),
			'icon'			=> 'yes',
			'button_text1'	=> __('Visit Site', 'whizzie'),
			'button_text2'	=> __('Customize Site', 'whizzie'),
		)
	);

	/**
	 * This kicks off the wizard
	 **/
	if (class_exists('Free_Whizzie')) {
		$Whizzie = new Free_Whizzie($config);
	}
