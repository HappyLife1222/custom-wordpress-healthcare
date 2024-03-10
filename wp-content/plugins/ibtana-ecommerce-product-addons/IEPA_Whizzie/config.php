<?php
/**
 * Settings for plugin wizard
 *
 * @package IEPA_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'IEPA_WHIZZIE_DIR' ) ) {
	define( 'IEPA_WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the IEPA_Whizzie class and other dependencies
require trailingslashit( IEPA_WHIZZIE_DIR ) . 'iepa_whizzie.php';

// Gets the plugin object
$current_plugin = get_plugin_data( IEPA_PLUGIN_FILE );
$plugin_title = $current_plugin[ 'Name' ];


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['page_slug'] 	= 'iepa-get-started';
$config['page_title']	= 'Get Started';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$config['steps'] = array(
	'intro' => array(
		'id'			=> 'intro', // ID for section - don't rename
		'title'			=> __( 'Welcome to ', IEPA_TEXT_DOMAIN ) . $plugin_title, // Section title
		'icon'			=> 'dashboard', // Uses Dashicons
		'button_text'	=> __( 'Start Now', IEPA_TEXT_DOMAIN ), // Button text
		'can_skip'		=> false // Show a skip button?
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', IEPA_TEXT_DOMAIN ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', IEPA_TEXT_DOMAIN ),
		'can_skip'		=> false
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', IEPA_TEXT_DOMAIN ),
		'icon'			=> 'yes',
		'button_text'	=> __( 'Check Now', IEPA_TEXT_DOMAIN ),
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'IEPA_Whizzie' ) ) {
	$IEPA_Whizzie = new IEPA_Whizzie( $config );
}
