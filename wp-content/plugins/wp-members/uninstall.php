<?php
/**
 * WP-Members Uninstall
 *
 * Removes all settings WP-Members added to the WP options table
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2023  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package WP-Members
 * @author Chad Butler
 * @copyright 2006-2023
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If uninstall is not called from WordPress, kill the uninstall.
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die( 'invalid uninstall' );
}
 
// Uninstall process removes WP-Members settings from the WordPress database (_options table).
if ( WP_UNINSTALL_PLUGIN ) {

	if ( is_multisite() ) {

		global $wpdb;
		$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		$original_blog_id = get_current_blog_id();

		foreach ( $blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			wpmem_uninstall_options(); 
		}
		switch_to_blog( $original_blog_id );
	
	} else {
		wpmem_uninstall_options();
	}
}


/**
 * Compartmentalizes uninstall
 *
 * @since 2.9.3
 */
function wpmem_uninstall_options() {

	delete_option( 'wpmembers_settings' );
	delete_option( 'wpmembers_fields'   );
	delete_option( 'wpmembers_dialogs'  );
	delete_option( 'wpmembers_captcha'  );
	delete_option( 'wpmembers_tos'      );
	delete_option( 'wpmembers_export'   );
	delete_option( 'wpmembers_utfields' );
	delete_option( 'wpmembers_usfields' );
	delete_option( 'wpmembers_dropins'  );
	delete_option( 'wpmem_hidden_posts' );

	delete_option( 'wpmembers_email_newreg'  );
	delete_option( 'wpmembers_email_newmod'  );
	delete_option( 'wpmembers_email_appmod'  );
	delete_option( 'wpmembers_email_repass'  );
	delete_option( 'wpmembers_email_footer'  );
	delete_option( 'wpmembers_email_notify'  );
	delete_option( 'wpmembers_email_wpfrom'  );
	delete_option( 'wpmembers_email_wpname'  );
	delete_option( 'wpmembers_email_getuser' );
	delete_option( 'wpmembers_email_validated' );

	delete_option( 'widget_wpmemwidget' );
	
	// For pre-3.x settings that may remain.
	delete_option( 'wpmembers_msurl'    );
	delete_option( 'wpmembers_regurl'   );
	delete_option( 'wpmembers_logurl'   );
	delete_option( 'wpmembers_cssurl'   );
	delete_option( 'wpmembers_style'    );
	delete_option( 'wpmembers_autoex'   );
	delete_option( 'wpmembers_attrib'   );

	delete_transient( 'wpmem_user_counts' );
	
	// Drop user meta key search table.
	global $wpdb;
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpmembers_user_search_keys" );

	$optin = get_option( 'wpmembers_optin' );
	if ( 1 == $optin ) {
		include_once( plugin_dir_path( __FILE__ ) . 'includes/vendor/rocketgeek-tools/class-rocketgeek-satellite.php' );
		$uninstall = new RocketGeek_Satellite_Beta( 'wp-members', plugin_dir_path( __FILE__ ) . 'wp-members.php', 'delete', 'plugin' );
	}
	delete_option( 'wpmembers_optin' );
	delete_option( 'wpmembers_install_state' );

	delete_option( 'wpmem_enable_field_sc' );
}

// End of file.