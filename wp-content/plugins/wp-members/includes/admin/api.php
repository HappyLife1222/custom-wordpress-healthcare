<?php
/**
 * WP-Members Admin API Functions
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2023  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package WP-Members
 * @author Chad Butler
 * @copyright 2006-2023
 *
 * Functions included:
 * - wpmem_add_custom_email
 * - wpmem_add_custom_dialog
 * - wpmem_is_tab
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Wrapper function for adding custom emails.
 *
 * @since 3.1.1
 *
 * @global object $wpmem         The WP_Members object class.
 * @param  string $tag           Slug for the custom email.
 * @param  string $heading       Heading to display in admin panel.
 * @param  string $subject_input Slug for the subject. 
 * @param  string $message_input Slug for the message body.
 */
function wpmem_add_custom_email( $tag, $heading, $subject_input, $message_input ) {
	global $wpmem;
	$args = array(
		'name'          => $tag,
		'heading'       => $heading, 
		'subject_input' => $subject_input,
		'body_input'    => $message_input,	
	);
	$wpmem->admin->add_email( $args );
}

/**
 * Checks the current tab being displayed in the admin panel.
 *
 * @since 3.1.4
 *
 * @param  string $tab The tab slug.
 * @return bool
 */
function wpmem_is_tab( $tab ) {
	return ( $tab == wpmem_get( 'tab', false, 'get' ) ) ? true : false;
}

/**
 * Utility function generates link to user profile.
 *
 * @since 3.1.7
 *
 * @param  int    $user_id
 * @return string user profile URL.
 */
function wpmem_admin_user_profile( $user_id ) {
	return add_query_arg( 'user_id', $user_id, admin_url( 'user-edit.php' ) );
}

/**
 * Wrapper for form_post_url().
 *
 * @since 3.1.8
 *
 * @global object $wpmem The WP_Members Object.
 * @param  string $tab   The plugin tab being displayed.
 * @param  mixed  $args  Array of additional arguments|boolean. Default: false.
 * @return string $url
 */
function wpmem_admin_form_post_url( $args = false ) {
	global $wpmem;
	return $wpmem->admin->form_post_url( $args );
}

/**
 * Returns an array of WordPress reserved terms.
 *
 * @since 3.0.2
 * @since 3.2.3 Moved to Admin API as wrapper for WP_Members_Admin_API::wp_reserved_terms().
 *
 * @global object $wpmem
 * @return array  An array of WordPress reserved terms.
 */
function wpmem_wp_reserved_terms() {
	global $wpmem;
	return $wpmem->admin->wp_reserved_terms();
}

/**
 * Updates a single plugin option.
 *
 * @since 3.3.6
 *
 * @param  string  $option  Name of the option to update.
 * @param  string  $key     Which key to update. Update a subkey as primary_key/subkey.
 * @param  string  $value   New value.
 * @return bool             True if the value was updated, otherwise false.
 */
function wpmem_update_option( $option, $key, $value ) {
	$settings = get_option( $option );
	if ( strpos( $key, '/' ) ) {
		$keys = explode( '/', $key );
		$settings[ $keys[0] ][ $keys[1] ] = $value;
	} else {
		$settings[ $key ] = $value;
	}
	return update_option( $option, $settings );
}

/**
 * Returns a custom "query_where" if the current view is selected.
 * 
 * @since 3.4.5
 * 
 * @param  string  $query_where  $query_where value from the filter (required)
 * @param  string  $view         Custom view slug
 * @param  string  $meta_key     Meta key the view is filtered by (needed for count)
 * @param  string  $meta_value   Value of the meta key for the view (needed for count)
 * @param  string  $compare      Comparison operator (optional, default "=")
 */
function wpmem_add_query_where( $query_where, $view, $meta_key, $meta_value, $compare = '=' ) {
	$show = sanitize_text_field( wpmem_get( 'show', false, 'get' ) );
	if ( $view == $show ) {
		$query_where = wpmem_get_query_where( $meta_key, $meta_value, $compare );
	}
	return $query_where;
}

/**
 * Builds a "query_where" for custom user views in Users > All Users.
 * 
 * @since 3.4.5
 * 
 * @param  string  $meta_key     Meta key the view is filtered by (needed for count)
 * @param  string  $meta_value   Value of the meta key for the view (needed for count)
 * @param  string  $compare      Comparison operator (optional, default "=")
 */
function wpmem_get_query_where( $meta_key, $meta_value, $compare = '=' ) {
	global $wpdb;
	$query_where = 'WHERE 1=1 AND ' . $wpdb->users . '.ID IN (
		SELECT ' . $wpdb->usermeta . '.user_id FROM ' . $wpdb->usermeta . '
		WHERE ' . $wpdb->usermeta . '.meta_key = "' . esc_sql( $meta_key ) . '"
		AND ' . $wpdb->usermeta . '.meta_value ' . $compare . ' "' . esc_sql( $meta_value ) . '" )';
	return $query_where;
}

/**
 * Adds a custom user view link for Users > All Users to the existing views array.
 * 
 * @since 3.4.5
 * 
 * @param  array   $views        The $views value from the "wpmem_views_users" filter (required)
 * @param  string  $name         Text for the view link
 * @param  string  $view         Custom view slug
 * @param  string  $meta_key     Meta key the view is filtered by (needed for count)
 * @param  string  $meta_value   Value of the meta key for the view (needed for count)
 * @param  string  $compare      Comparison operator (optional, default "=")
 * @param  int     $expires      Expiration of the count transient in seconds (optional, default = 60)
 */
function wpmem_add_user_view_link( $views, $link_text, $view_slug, $meta_key, $meta_value, $compare = "=", $expires = 60 ) {
	$views[ $view_slug ] = wpmem_get_user_view_link( $link_text, $view_slug, $meta_key, $meta_value, $compare, $expires );
	return $views;
}

/**
 * Returns a custom user view link for Users > All Users.
 * 
 * @since 3.4.5
 * 
 * @param  string  $name         Text for the view link
 * @param  string  $view         Custom view slug
 * @param  string  $meta_key     Meta key the view is filtered by (needed for count)
 * @param  string  $meta_value   Value of the meta key for the view (needed for count)
 * @param  string  $compare      Comparison operator (optional, default "=")
 * @param  int     $expires      Expiration of the count transient in seconds (optional, default = 60)
 */
function wpmem_get_user_view_link( $name, $view, $meta_key, $meta_value, $compare = "=", $expires = 60 ) {
	$show = sanitize_text_field( wpmem_get( 'show', '', 'get' ) );
	$url = 'users.php?action=show&show=' . $view;
	$class = ( $show == $view ) ? ' class="current"' : ''; 
	$count = wpmem_get_user_view_count( $view, $meta_key, $meta_value, $compare, $expires );
	return sprintf(
		'<a href="%s" %s>%s <span class="count">(%d)</span></a>',
		esc_url( $url ),
		$class,
		$name,
		$count
	);
}

/**
 * Returns a count for custom user view for Users > All Users.
 * 
 * @since 3.4.5
 * 
 * @param  string  $view         Custom view slug
 * @param  string  $meta_key     Meta key the view is filtered by (needed for count)
 * @param  string  $meta_value   Value of the meta key for the view (needed for count)
 * @param  string  $compare      Comparison operator (optional, default "=")
 * @param  int     $expires      Expiration of the count transient in seconds (optional, default = 60)
 */
function wpmem_get_user_view_count( $view, $meta_key, $meta_value, $compare = '=', $expires = 60 ) {
	global $wpdb;
	// Count is stored in a transient (see "if" condition below).
	$count = get_transient( 'wpmem_user_counts_' . $view );
	// If the transient is not already set.
	if ( false === $count ) {

		// Get the count
		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->usermeta . " WHERE meta_key=%s AND meta_value " . $compare . " \"%s\"", $meta_key, $meta_value ) );

		// Save it in a transient
		$transient_expires = $expires; // Value in seconds, 1 day: ( 60 * 60 * 24 );
		set_transient( 'wpmem_user_counts_' . $view, $count, $transient_expires );
	}
	// Return the count, either new or transient.
	return $count;
}