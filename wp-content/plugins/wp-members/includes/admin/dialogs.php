<?php
/**
 * WP-Members Admin Functions
 *
 * Handles functions that output admin dialogs to adminstrative users.
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

/**
 * Outputs the various admin warning messages.
 *
 * @since 2.8.0
 * 
 * @param string $did_update     Contains the update message.
 * @param array  $wpmem_settings Array containing the plugin settings.
 */
function wpmem_a_do_warnings( $did_update ) {

	global $wpmem;

	/** This filter is documented in /includes/class-wp-members-admin-api.php */
	$dialogs = apply_filters( 'wpmem_dialogs', get_option( 'wpmembers_dialogs' ) ); 

	if ( $did_update != false ) {?>
		<div id="message" class="updated fade"><p><strong><?php echo $did_update; ?></strong></p></div><?php
	}

	/*
	 * Configuration warnings.
 	 */

	// Are warnings turned off?
	$warnings_on = ( $wpmem->warnings == 0 ) ? true : false;
	
	// Is there an active warning?
	$active_warnings = array();

	// Settings allow anyone to register.
	if ( get_option( 'users_can_register' ) != 0 && $warnings_on ) {
		$active_warnings[] = wpmem_a_warning_msg( 'users_can_register' );
	}

	// Settings allow anyone to comment.
	if ( get_option( 'comment_registration' ) !=1 && $warnings_on ) {
		$active_warnings[] = wpmem_a_warning_msg( 'comment_registration' );
	}

	// Rss set to full text feeds.
	if ( get_option( 'rss_use_excerpt' ) !=1 && $warnings_on ) {
		$active_warnings[] = wpmem_a_warning_msg( 'rss_use_excerpt' );
	}

	// Holding registrations but haven't changed default successful registration message.
	if ( $warnings_on && $wpmem->mod_reg == 1 && $dialogs['success'] == wpmem_get_text( 'success' ) ) {
		$active_warnings[] = wpmem_a_warning_msg( 'success' );
	}

	// Haven't entered recaptcha api keys.
	if ( $warnings_on && $wpmem->captcha > 0 ) {
		$wpmem_captcha = get_option( 'wpmembers_captcha' );
		if ( 1 == $wpmem->captcha || 3 == $wpmem->captcha ) {
			if ( ! $wpmem_captcha['recaptcha']['public'] || ! $wpmem_captcha['recaptcha']['private'] ) {
				$active_warnings[] = wpmem_a_warning_msg( 'wpmembers_captcha' );
			}
		}
	}
	
	// If there is an active warning, display message about warnings.
	if ( ! empty( $active_warnings ) ) {
		$strong_msg = __( 'WP-Members Options', 'wp-members' ) . ': ' . __( 'You have active settings that are not recommended.', 'wp-members' );
		$remain_msg = __( 'If you will not be changing these settings, you can turn off this warning message by checking the "Ignore warning messages" in the settings below.', 'wp-members' );

		echo '<div class="error"><p><strong>' . $strong_msg . '</strong></p><ul style="list-style:initial; margin:5px 20px">';
		foreach ( $active_warnings as $warning ) {
			echo $warning;
		}
		echo '</ul>';
		echo '<p>' . $remain_msg  . '</p></div>';
	}

}


/**
 * Assembles the various admin warning messages.
 *
 * @since 2.4.0
 * @since 3.1.0 Changed $msg argument to string.
 * 
 * @param string $msg The number for which message should be displayed.
 */
function wpmem_a_warning_msg( $msg ) {

	$strong_msg = $remain_msg = $span_msg = '';

	switch ( $msg ) {

	case 'users_can_register':
		$strong_msg = __( 'Your WP settings allow anyone to register - this is not the recommended setting.', 'wp-members' );
		$remain_msg = sprintf( __( 'You can %s change this here %s making sure the box next to "Anyone can register" is unchecked.', 'wp-members'), '<a href="options-general.php" target="_blank">', '</a>' );
		$span_msg   = __( 'If you do not want users to register through wp-login.php, uncheck this option.', 'wp-members' );
		break;

	case 'comment_registration':
		$strong_msg = __( 'Your WP settings allow anyone to comment - this is not the recommended setting.', 'wp-members' );
		$remain_msg = sprintf( __( 'You can %s change this here %s by checking the box next to "Users must be registered and logged in to comment."', 'wp-members' ), '<a href="options-discussion.php" target="_blank">', '</a>' );
		$span_msg   = __( 'If you do not want non-registered users to comment, change this setting.', 'wp-members' );
		break;

	case 'rss_use_excerpt':
		$strong_msg = __( 'Your WP settings allow full text rss feeds - this is not the recommended setting.', 'wp-members' );
		$remain_msg = sprintf( __( 'You can %s change this here %s by changing "For each article in a feed, show" to "Summary."', 'wp-members' ), '<a href="options-reading.php" target="_blank">' , '</a>' );
		$span_msg   = __( 'Full text feeds allow your protected content in an RSS reader.', 'wp-members' );
		break;

	case 'success':
		$strong_msg = __( 'You have set WP-Members to hold registrations for approval', 'wp-members' );
		$remain_msg = __( 'but you have not changed the default message for "Registration Completed" under "WP-Members Dialogs and Error Messages."  You should change this message to let users know they are pending approval.', 'wp-members' );
		break;

	case 'wpmembers_captcha':
		$strong_msg = __( 'You have turned on reCAPTCHA', 'wp-members');
		$remain_msg = __( 'but you have not entered API keys.  You will need both a public and private key.  The CAPTCHA will not display unless a valid API key is included.', 'wp-members' );
		break;

	}

	if ( $span_msg ) {
		$span_msg = ' [<span data-tooltip="' . $span_msg . '">why is this?</span>]';
	}
	
	return '<li><strong>' . $strong_msg . '</strong> ' . $remain_msg . $span_msg . '</li>';

}


/**
 * Assemble the side meta box.
 *
 * @since 2.8.0
 *
 * @global object $wpmem
 */
function wpmem_a_meta_box() {

	global $wpmem;
	
	?><div class="postbox">
		<h3><span>WP-Members Information</span></h3>
		<div class="inside">

			<p><strong><?php _e( 'Version:', 'wp-members' ); echo "&nbsp;" . $wpmem->version; ?></strong><br />
				<a href="https://rocketgeek.com/plugins/wp-members/quick-start-guide/"><?php _e( 'Quick Start Guide', 'wp-members' ); ?></a><br />
				<a href="https://rocketgeek.com/plugins/wp-members/docs/"><?php _e( 'Online User Guide', 'wp-members' ); ?></a><br />
				<a href="https://rocketgeek.com/plugins/wp-members/docs/faqs/"><?php _e( 'FAQs', 'wp-members' ); ?></a>
			<?php if( ! defined( 'WPMEM_REMOVE_ATTR' ) ) { ?>
				<br /><br /><a href="https://rocketgeek.com/about/site-membership-subscription/">Find out how to get access</a> to WP-Members private members forum, premium code snippets, tutorials, and add-on modules!
			<?php } ?>
			</p>

			<p><i>
			<?php _e( 'Thank you for using WP-Members', 'wp-members' ); ?>&trade;!<br /><br />
			<?php _e( 'A plugin developed by', 'wp-members' ); ?>&nbsp;<a href="http://butlerblog.com">Chad Butler</a><br />
			<?php _e( 'Follow', 'wp-members' ); ?> ButlerBlog: <a href="http://feeds.butlerblog.com/butlerblog" target="_blank">RSS</a> | <a href="http://www.twitter.com/butlerblog" target="_blank">Twitter</a><br />
			Copyright &copy; 2006-<?php echo date("Y"); ?><br /><br />
			Premium support and installation service <a href="https://rocketgeek.com/about/site-membership-subscription/">available at rocketgeek.com</a>.
			</i></p>
		</div>
	</div><?php
}


/**
 * Assemble the rocketgeek.com rss feed box.
 *
 * @since 2.8.0
 */
function wpmem_a_rss_box() {

	?><div class="postbox">
		<h3><span><?php _e( 'Latest from RocketGeek', 'wp-members' ); ?></span></h3>
		<div class="inside"><?php
		wp_widget_rss_output( array(
			'url'          => 'https://rocketgeek.com/feed/',  //put your feed URL here
			'title'        => __( 'Latest from RocketGeek', 'wp-members' ),
			'items'        => 4, //how many posts to show
			'show_summary' => 0,
			'show_author'  => 0,
			'show_date'    => 0,
		) );?>
		</div>
	</div><?php
}

/**
 * Adds the rating request meta box.
 *
 * @since 3.2.0
 */
function wpmem_a_rating_box() {
	?><div class="postbox">
		<h3><?php _e( 'Like WP-Members?', 'wp-members' ); ?></h3>
		<div class="inside"><?php echo sprintf( __( 'If you like WP-Members please give it a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating. Thanks!!', 'wp-members' ), '<a href="https://wordpress.org/support/plugin/wp-members/reviews?rate=5#new-post">', '</a>' ); ?></div>
	</div><?php
}


/**
 * Add the dashboard widget.
 *
 * @since 2.8.0
 */
function butlerblog_dashboard_widget() {
	wp_add_dashboard_widget( 'dashboard_custom_feed', __( 'Latest from ButlerBlog', 'wp-members' ), 'butlerblog_feed_output' );
}


/**
 * Output the rss feed for the dashboard widget.
 *
 * @since 2.8.0
 */
function butlerblog_feed_output() {
	echo '<div class="rss-widget">';
	wp_widget_rss_output( array(
		'url'          => 'https://feeds.feedburner.com/butlerblog',
		'title'        => __( 'Latest from ButlerBlog', 'wp-members' ),
		'items'        => 5,
		'show_summary' => 0,
		'show_author'  => 0,
		'show_date'    => 1,
	) );
	echo "</div>";
}

// End of file.