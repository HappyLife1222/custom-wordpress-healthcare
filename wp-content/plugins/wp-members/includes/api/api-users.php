<?php
/**
 * WP-Members User API Functions
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2023  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package WP-Members
 * @subpackage WP-Members API Functions
 * @author Chad Butler 
 * @copyright 2006-2023
 */

/**
 * Checks if a user exists.
 *
 * @since 3.2.5
 *
 * @param $user_id
 * @return boolean
 */
function wpmem_is_user( $user_id ) {
	$user = get_userdata( $user_id );
	return ( $user ) ? true : false;
}

/**
 * Returns the current user's current role.
 *
 * Note that users may have more than one role. This returns
 * whatever the internal pointer is set to. Usually, this will
 * be the first element in the array, but not always.
 * @see: https://www.php.net/manual/en/function.current.php
 *
 * @since 3.3.0
 *
 * @param  int     $user_id
 * @param  boolean $all     If true, all roles as an array; if false, just the current role.
 * @return mixed   If the user is set and has roles, the current user role, otherwise false.
 */
function wpmem_get_user_role( $user_id = false, $all = false ) {
	$user = ( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();
	$role = ( ! $all   ) ? current( $user->roles  ) : $user->roles;
	return ( $user ) ? $role : false;
}

/**
 * Checks if user has a particular role.
 *
 * Utility function to check if a given user has a specific role. Users can
 * have multiple roles assigned, so it checks the role array rather than using
 * the incorrect method of current_user_can( 'role_name' ). The function can
 * check the role of the current user (default) or a specific user (if $user_id
 * is passed).
 *
 * @since 3.1.1
 * @since 3.1.6 Include accepting an array of roles to check.
 * @since 3.1.9 Return false if user is not logged in.
 * @since 3.2.0 Change return false to not logged in AND no user id.
 * @since 3.4.5 $current_user no longer necessary.
 * @since 3.4.6 $wpmem global is no longer necessary.
 *
 * @param  string|array  $role         Slug or array of slugs of the role being checked.
 * @param  int           $user_id      ID of the user being checked (optional).
 * @return boolean       $has_role     True if user has the role, otherwise false.
 */
function wpmem_user_has_role( $role, $user_id = false ) {
	if ( ! is_user_logged_in() && ! $user_id ) {
		return false;
	}
	$has_role = false;
	$user = ( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();
	if ( is_array( $role ) ) {
		foreach ( $role as $r ) {
			if ( in_array( $r, $user->roles ) ) {
				return true;
			}
		}
	} else {
		return ( in_array( $role, $user->roles ) ) ? true : $has_role;
	}
}

/**
 * Gets user meta.
 *
 * It may seem like WP already has this feature. And it does. But most user meta
 * are single, and WP's get_user_meta() defaults to "false" for the $single
 * argument. This function provides a shorthand that assumes a string value for
 * the meta result and drops the $single argument.
 *
 * @since 3.3.0
 *
 * @param  int    $user_id
 * @param  string $meta_key
 * @return string $result
 */
function wpmem_get_user_meta( $user_id, $meta_key ) {
	return get_user_meta( $user_id, $meta_key, true );
}

/**
 * Get a user meta checkbox label as value if checked.
 *
 * @since 3.4.2
 *
 * @param  int    $user_id
 * @param  string $meta_key
 * @return string $result
 */
function wpmem_get_user_meta_checkbox( $user_id, $meta_key ) {
	$value = wpmem_get_user_meta( $user_id, $meta_key );
	return wpmem_checkbox_field_display( $value );
}

/**
 * Get a user meta select (dropdown) value.
 *
 * @since 3.4.2
 *
 * @param  int    $user_id
 * @param  string $meta_key
 * @return string $result
 */
function wpmem_get_user_meta_select( $user_id, $meta_key ) {
	$value = wpmem_get_user_meta( $user_id, $meta_key );
	return wpmem_select_field_display( $meta_key, $value );
}

/**
 * Get a user meta radio value.
 * Alias of wpmem_get_user_meta_select() for radio field type.
 *
 * @since 3.4.2
 *
 * @param  int    $user_id
 * @param  string $meta_key
 * @return string $result
 */
function wpmem_get_user_meta_radio( $user_id, $meta_key ) {
	return wpmem_get_user_meta_select( $user_id, $meta_key );
}

/**
 * Returns the meta value for a requested mutli-checkbox or multi-select
 * field for a requested user ID.
 *
 * @since 3.4.2
 *
 * @param  int     $user_id
 * @param  string  $field_meta
 * @param  string  $return_type (string|array default:string)
 * @return string
 */
function wpmem_get_user_meta_multi( $user_id, $field_meta, $return_type = "string" ) {
	$fields = wpmem_fields();
	$value  = wpmem_get_user_meta( $user_id, $field_meta );
	$array  = ( '' != $value && false != $value ) ? explode( $fields[ $field_meta ]['delimiter'], $value ) : array();
	if ( ! empty( $array ) && count( $array ) > 1 ) {
		foreach ( $array as $val ) {
			$display_values[] = wpmem_field_display_value( $field_meta, $val );
		}
		$return_value = ( "array" == $return_type ) ? $display_values : implode( ", ", $display_values );
	} else {
		$display_value = wpmem_field_display_value( $field_meta, $value );
		$return_value  = ( "array" == $return_type ) ? array( $display_value ) : $display_value;
	}
	return $return_value;
}

/**
 * Checks if a user has a given meta value.
 *
 * @since 3.1.8
 * @since 3.3.0 Added wpmem_user_has_meta filter.
 * @since 3.3.0 Added array check for multi-value fields (multicheckbox and multiselect).
 *
 * @global object  $wpmem     WP_Members object.
 *
 * @param  string  $meta      Meta key being checked.
 * @param  string  $value     Value the meta key should have (optional).
 * @param  int     $user_id   ID of the user being checked (optional).
 * @return boolean $has_meta  True if user has the meta value, otherwise false.
 */
function wpmem_user_has_meta( $meta, $value = false, $user_id = false ) {

	global $wpmem;
	
	// Get the user ID.
	$user_id = ( $user_id ) ? $user_id : get_current_user_id();
	
	// Get field type.
	$fields = wpmem_fields();
	$multi  = ( ( isset( $fields[ $meta ] ) ) &&  ( 'multicheckbox' == $fields[ $meta ]['type'] || 'multiselect' == $fields[ $meta ]['type'] ) ) ? true : false;
	
	// Get meta.
	$has_meta   = false;
	$user_value = get_user_meta( $user_id, $meta, true );
	
	// Check meta.
	if ( $value ) {
		if ( $multi ) {
			// Check array of values.
			$user_value = explode( $fields[ $meta ]['delimiter'], $user_value );
			$has_meta = ( in_array( $value, $user_value ) ) ? true : $has_meta;
		} else {
			// Straight comparison.
			$has_meta = ( $user_value == $value ) ? true : $has_meta;
		}
	} else {
		// Check if the user has any meta value (regardless of actual value).
		$has_meta = ( $user_value ) ? true : $has_meta;
	}
	
	/**
	 * Filter the user has meta result.
	 *
	 * @since 3.3.0
	 *
	 * @param bool   $has_meta   True if the user has the value, otherwise false.
	 * @param int    $user_id    The user ID being checked.
	 * @param string $user_value The user's stored meta value (false if none).
	 */
	return apply_filters( 'wpmem_user_has_meta', $has_meta, $user_id, $user_value );
}

/**
 * Gets a user by meta key.
 * 
 * @since 3.4.6
 * 
 * @global object  $wpdb
 * @param  string  $meta_key
 * @param  string  $meta_value
 * @return WP_User
 */
function wpmem_get_user_by_meta( $meta_key, $meta_value ) {
	global $wpdb;
	$sql = 'SELECT u1.ID, m1.meta_value
		FROM ' . $wpdb->users . ' u1
		JOIN ' . $wpdb->usermeta . ' m1 ON (m1.user_id = u1.ID AND m1.meta_key = "' . esc_sql( $meta_key ) . '")
		WHERE m1.meta_value = "' . esc_sql( $meta_value ) . '";';
	$user = $wpdb->get_row( $sql );
	return $user;
}

/**
 * Checks if a user is activated.
 *
 * @since 3.1.7
 * @since 3.2.3 Now an alias for WP_Members_Users::is_user_activated().
 *
 * @global object $wpmem
 * @param  int    $user_id
 * @return bool
 */
function wpmem_is_user_activated( $user_id = false ) {
	global $wpmem;
	return $wpmem->user->is_user_activated( $user_id );
}

/**
 * Gets an array of the user's registration data.
 *
 * Returns an array keyed by meta keys of the user's registration data for
 * all fields in the WP-Members Fields.  Returns the current user unless
 * a user ID is specified.
 *
 * @since 3.2.0
 *
 * @global object  $wpmem
 * @param  integer $user_id
 * @param  bool    $all
 * @return array   $user_fields
 */
function wpmem_user_data( $user_id = false, $all = false ) {
	global $wpmem;
	return $wpmem->user->user_data( $user_id, $all );
}

/**
 * Updates a user's role.
 *
 * This is an alias for $wpmem->update_user_role(). It can add a role to a
 * user, change or remove the user's role. If no action is specified it will
 * change the role.
 *
 * @since 3.2.0
 *
 * @global object  $wpmem
 * @param  integer $user_id (required)
 * @param  string  $role    (required)
 * @param  string  $action  (optional add|remove|set default:set)
 */
function wpmem_update_user_role( $user_id, $role, $action = 'set' ) {
	global $wpmem;
	$wpmem->user->update_user_role( $user_id, $role, $action );
}

/**
 * A function for checking user access criteria.
 *
 * @since 3.2.0
 * @since 3.2.3 Reversed order of arguments.
 *
 * @param  mixed   $membership Accepts a single membership slug/meta, or an array of multiple memberships.
 * @param  integer $user_id    User ID (optional|default: false).
 * @return boolean $access     True if user has access, otherwise false.
 */
function wpmem_user_has_access( $membership, $user_id = false ) {
	global $wpmem;
	$user_id = ( false == $user_id ) ? get_current_user_id() : $user_id;
	return $wpmem->user->has_access( $membership, $user_id );
}

/**
 * Checks if user expiration is current.
 *
 * Similar to wpmem_user_has_access(), but specifically checks the
 * expiration date for a specified membership (must be expiration product).
 * 
 * Must be named _user_is_current() as _is_user_current() exists in PayPal extension.
 *
 * @since 3.4.0
 *
 * @param  string  $membership  The meta key of the 
 * @param  integer $user_id     The user ID to check. Optional. If not passed, the currently logged in user will be checked.
 * @return boolean              True if user is current (i.e. not expired), otherwise false.
 */
function wpmem_user_is_current( $membership, $user_id = false ) {
	global $wpmem;
	$user_id = ( false === $user_id ) ? get_current_user_id() : $user_id;
	$memberships = wpmem_get_user_memberships( $user_id );
	return ( $wpmem->user->is_current( $memberships[ $membership ] ) ) ? true : false;
}

/**
 * An alias for wpmem_set_user_product().
 * 
 * @since 3.4.2
 */
function wpmem_set_user_membership( $membership, $user_id = false, $date = false ) {
	return wpmem_set_user_product( $membership, $user_id, $date );
}

/**
 * An alias for wpmem_remove_user_product().
 * 
 * @since 3.4.2
 */
function wpmem_remove_user_membership( $membership, $user_id = false ) {
	return wpmem_remove_user_product( $membership, $user_id );
}

/**
 * An alias for wpmem_get_user_products().
 * 
 * @since 3.4.2
 */
function wpmem_get_user_memberships( $user_id = false ) {
	return wpmem_get_user_products( $user_id );
}

/**
 * Sets product access for a user.
 *
 * @since 3.2.3
 * @since 3.2.6 Added $date to set a specific expiration date.
 * @since 3.4.2 Use wpmem_set_user_membership() instead.
 *
 * @global object $wpmem
 * @param  string $product The meta key of the product.
 * @param  int    $user_id
 * @param  string $date    Expiration date (optional) format: MySQL timestamp
 * @return bool   $result
 */
function wpmem_set_user_product( $product, $user_id = false, $date = false ) {
	global $wpmem;
	return $wpmem->user->set_user_product( $product, $user_id, $date );
}

/**
 * Removes product access for a user.
 *
 * @since 3.2.3
 * @since 3.4.2 Use wpmem_remove_user_membership() instead.
 *
 * @global object $wpmem
 * @param  string $product
 * @param  int    $user_id
 */
function wpmem_remove_user_product( $product, $user_id = false ) {
	global $wpmem;
	$wpmem->user->remove_user_product( $product, $user_id );
	return;
}

/** 
 * Gets memberships a user has.
 *
 * @since 3.3.0
 * @since 3.4.2 Use wpmem_get_user_memberships() instead.
 *
 * @global stdClass $wpmem
 * @param  int      $user_id
 * @return array
 */
function wpmem_get_user_products( $user_id = false ) {
	global $wpmem;
	return ( $user_id ) ? $wpmem->user->get_user_products( $user_id ) : $wpmem->user->access;
}

/**
 * Get user expiration date
 * 
 * @since 3.4.2
 * 
 * @param  $product_key The membership slug being requested (optional: defaults to first membership in the array).
 * @param  $user_id     The user ID (optional: defaults to current user).
 * @param  $format      The date format to return (optional: defaults to raw epoch timestamp).
 * @return $exp_date    The expiration date unformatted (i.e. unix/epoch timestamp) (false if no date or membership does not exist for user).
 */
function wpmem_get_user_expiration( $product_key = false, $user_id = false, $format = false ) {
	$user_id = ( false === $user_id ) ? get_current_user_id() : $user_id;
    $memberships = wpmem_get_user_memberships( $user_id );
	$product_key = ( false == $product_key ) ? key( $memberships ) : $product_key;
    $exp_date = ( is_numeric( $memberships[ $product_key ] ) ) ? $memberships[ $product_key ] : strtotime( $memberships[ $product_key ] );
    return $exp_date;
}

/**
 * Sets a user as logged in.
 *
 * @since 3.2.3
 *
 * @global object $wpmem
 * @param  int    $user_id
 */
function wpmem_set_as_logged_in( $user_id ) {
	global $wpmem;
	$wpmem->user->set_as_logged_in( $user_id );
}

if ( ! function_exists( 'wpmem_login' ) ):
/**
 * Logs in the user.
 *
 * Logs in the the user using wp_signon (since 2.5.2). If login is
 * successful, it will set a cookie using wp_set_auth_cookie (since 2.7.7),
 * then it redirects and exits; otherwise "loginfailed" is returned.
 *
 * @since 0.1.0
 * @since 2.5.2 Now uses wp_signon().
 * @since 2.7.7 Sets cookie using wp_set_auth_cookie().
 * @since 3.0.0 Removed wp_set_auth_cookie(), this already happens in wp_signon().
 * @since 3.1.7 Now an alias for login() in WP_Members_Users Class.
 * @since 3.2.4 Moved to user API (could be deprecated).
 *
 * @global object $wpmem
 * @return string Returns "loginfailed" if the login fails.
 */
function wpmem_login() {
	global $wpmem;
	return $wpmem->user->login();
} // End of login function.
endif;

if ( ! function_exists( 'wpmem_logout' ) ):
/**
 * Logs the user out then redirects.
 *
 * @since 2.0.0
 * @since 3.1.6 Added wp_destroy_current_session(), removed nocache_headers().
 * @since 3.1.7 Now an alias for logout() in WP_Members_Users Class.
 * @since 3.2.4 Moved to user API (could be deprecated).
 *
 * @global object $wpmem
 * @param  string $redirect_to The URL to redirect to at logout.
 */
function wpmem_logout( $redirect_to = false ) {
	global $wpmem;
	$wpmem->user->logout( $redirect_to );
}
endif;

if ( ! function_exists( 'wpmem_change_password' ) ):
/**
 * Handles user password change (not reset).
 *
 * @since 2.1.0
 * @since 3.1.7 Now an alias for password_update() in WP_Members_Users Class.
 * @since 3.2.4 Moved to user API (could be deprecated).
 *
 * @global int $user_ID The WordPress user ID.
 *
 * @return string The value for $wpmem->regchk
 */
function wpmem_change_password() {
	global $wpmem;
	return $wpmem->user->password_update( 'change' );
}
endif;

if ( ! function_exists( 'wpmem_reset_password' ) ):
/**
 * Resets a forgotten password.
 *
 * @since 2.1.0
 * @since 3.1.7 Now an alias for password_update() in WP_Members_Users Class.
 * @since 3.2.4 Moved to user API (could be deprecated).
 *
 * @global object $wpmem The WP-Members object class.
 *
 * @return string The value for $wpmem->regchk
 */
function wpmem_reset_password() {
	global $wpmem;
	return $wpmem->user->password_update( 'reset' );
}
endif;

/**
 * Handles retrieving a forgotten username.
 *
 * @since 3.0.8
 * @since 3.1.6 Dependencies now loaded by object.
 * @since 3.1.8 Now an alias for $wpmem->retrieve_username() in WP_Members_Users Class.
 * @since 3.2.4 Moved to user API (could be deprecated).
 *
 * @global object $wpmem The WP-Members object class.
 *
 * @return string $regchk The regchk value.
 */
function wpmem_retrieve_username() {
	global $wpmem;
	return $wpmem->user->retrieve_username();
}

/**
 * Creates a membership number.
 *
 * @since 3.1.1
 * @since 3.2.0 Changed "lead" to "pad".
 *
 * @param  array  $args {
 *     @type string $option    The wp_options name for the counter setting (required).
 *     @type string $meta_key  The field's meta key (required).
 *     @type int    $start     Number to start with (optional, default 0).
 *     @type int    $increment Number to increment by (optional, default 1).
 *     @type int    $digits    Number of digits for the number (optional).
 *     @type boolen $pad       Pad leading zeros (optional, default true).
 * }
 * @return string $membersip_number
 */
function wpmem_create_membership_number( $args ) {
	global $wpmem;
	return $wpmem->api->generate_membership_number( $args );
}

/**
 * Activates a user.
 *
 * If registration is moderated, sets the activated flag 
 * in the usermeta. Flag prevents login when $wpmem->mod_reg
 * is true (1). Function is fired from bulk user edit or
 * user profile update.
 *
 * @uses  $wpdb WordPress Database object.
 *
 * @since 2.4
 * @since 3.1.6 Dependencies now loaded by object.
 * @since 3.2.4 Renamed from wpmem_a_activate_user().
 * @since 3.3.0 Moved to user API.
 * @since 3.3.5 Added $notify argument.
 * @since 3.4.0 Added $set_pwd argument.
 *
 * @param int   $user_id
 * @param bool  $notify  Send notification to user (optional, default: true).
 */
function wpmem_activate_user( $user_id, $notify = true, $set_pwd = false ) {

	global $wpmem;

	// Define new_pass.
	$new_pass = '';

	// If passwords are user defined skip this.
	if ( true == $set_pwd || ! wpmem_user_sets_password() ) {
		$new_pass = wp_generate_password();
		wp_set_password( $new_pass, $user_id );
	}

	// @todo this should be taken out, use the wpmem_user_activated hook instead.
	// If subscriptions can expire, and the user has no expiration date, set one.
	if ( $wpmem->use_exp == 1 && ! get_user_meta( $user_id, 'expires', true ) ) {
		if ( function_exists( 'wpmem_set_exp' ) ) {
			wpmem_set_exp( $user_id );
		}
	}

	// Generate and send user approved email to user.
	if ( true === $notify ) {
		wpmem_email_to_user( $user_id, $new_pass, 2 );
	}

	// Set the active flag in usermeta.
	update_user_meta( $user_id, 'active', 1 );

	/**
	 * Fires after the user activation process is complete.
	 *
	 * @since 2.8.2
	 *
	 * @param int $user_id The user's ID.
	 */
	do_action( 'wpmem_user_activated', $user_id );

	return;
}

/**
 * Deactivates a user.
 *
 * Reverses the active flag from the activation process
 * preventing login when registration is moderated.
 *
 * @since 2.7.1
 * @since 3.2.4 Renamed from wpmem_a_deactivate_user().
 * @since 3.3.0 Moved to user API.
 *
 * @param int $user_id
 */
function wpmem_deactivate_user( $user_id ) {
	update_user_meta( $user_id, 'active', 0 );

	/**
	 * Fires after the user deactivation process is complete.
	 *
	 * @since 2.9.9
	 *
	 * @param int $user_id The user's ID.
	 */
	do_action( 'wpmem_user_deactivated', $user_id );
}

/**
 * Updates the user_status value in the wp_users table.
 *
 * @since Unknown
 * @since 3.3.0 Moved to User API.
 *
 * @global object $wpdb
 *
 * @param int    $user_id
 * @param string $status
 */
function wpmem_set_user_status( $user_id, $status ) {
	global $wpdb;
	$wpdb->update( $wpdb->users, array( 'user_status' => $status ), array( 'ID' => $user_id ) );
	return;
}

/**
 * Register function.
 *
 * Handles registering new users and updating existing users.
 *
 * @since 2.2.1
 * @since 2.7.2 Added pre/post process actions.
 * @since 2.8.2 Added validation and data filters.
 * @since 2.9.3 Added validation for multisite.
 * @since 3.0.0 Moved from wp-members-register.php to /inc/register.php.
 * @since 3.3.0 Ported from wpmem_registration in /inc/register.php (now deprecated).
 *
 * @todo Review what should be in the API function and what should be moved to object classes.
 *
 * @global int    $user_ID
 * @global object $wpmem
 * @global string $wpmem_themsg
 * @global array  $userdata
 *
 * @param  string $tag Identifies 'register' or 'update'.
 * @return string $wpmem_themsg|success|editsuccess
 */
function wpmem_user_register( $tag ) {

	// Get the globals.
	global $user_ID, $wpmem, $wpmem_themsg, $userdata;
	
	$wpmem->user->register_validate( $tag );
	
	// @todo Added as a fix for legacy versions of security extension and any wpmem_pre_register_data action that might null $wpmem_themsg.
	if ( $wpmem_themsg ) { 
		return $wpmem_themsg;
	}
	
	switch ( $tag ) {

	case "register":
		
		/**
		 * Filter registration data after validation before data insertion.
		 *
		 * @since 2.8.2
		 *
		 * @param array  $wpmem->user->post_data An array of the registration field data.
		 * @param string $tag    A switch to indicate the action (new|edit).
		 */
		$wpmem->user->post_data = apply_filters( 'wpmem_register_data', $wpmem->user->post_data, 'new' ); 

		/**
		 * Fires before any insertion/emails.
		 *
		 * This action is the final step in pre registering a user. This
		 * can be used for attaching custom validation to the registration
		 * process. It cannot be used for changing any user registration
		 * data. Use the wpmem_register_data filter for that.
		 *
		 * @since 2.7.2
		 *
		 * @param array $wpmem->user->post_data The user's submitted registration data.
		 */
		do_action( 'wpmem_pre_register_data', $wpmem->user->post_data );

		// If the _pre_register_data hook sends back an error message.
		if ( $wpmem_themsg ) { 
			return $wpmem_themsg;
		}

		// Main new user fields are ready.
		$new_user_fields = array (
			'user_pass'       => $wpmem->user->post_data['password'], 
			'user_login'      => $wpmem->user->post_data['username'],
			'user_nicename'   => $wpmem->user->post_data['user_nicename'],
			'user_email'      => $wpmem->user->post_data['user_email'],
			'display_name'    => $wpmem->user->post_data['display_name'],
			'nickname'        => $wpmem->user->post_data['nickname'],
			'user_registered' => $wpmem->user->post_data['user_registered'],
			'role'            => $wpmem->user->post_data['user_role']
		);

		// Get any excluded meta fields.
		$wpmem->excluded_meta = wpmem_get_excluded_meta( 'register' );

		// Fields for wp_insert_user: user_url, first_name, last_name, description.
		$new_user_fields_meta = array( 'user_url', 'first_name', 'last_name', 'description' );
		foreach ( $wpmem->fields as $meta_key => $field ) {
			if ( in_array( $meta_key, $new_user_fields_meta ) ) {
				if ( $field['register'] && ! in_array( $meta_key, $wpmem->excluded_meta ) ) {
					$new_user_fields[ $meta_key ] = $wpmem->user->post_data[ $meta_key ];
				}
			}
		}

		// Inserts to wp_users table.
		$user_id = wp_insert_user( $new_user_fields );

		/**
		 * Fires after registration is complete.
		 *
		 * @since 2.7.1
		 * @since 3.1.0 Added $fields
		 * @since 3.1.7 Changed $fields to $this->post_data
		 * @since 3.3.0 Moved to registration function.
		 * @since 3.3.8 Added $user parameter.
		 *
		 * @param array $wpmem->user->post_data The user's submitted registration data.
		 * @param int   $user_id
		 */
		do_action( 'wpmem_register_redirect', $wpmem->user->post_data, $user_id );

		// successful registration message
		return "success";
		break;

	case "update":

		if ( $wpmem_themsg ) { 
			return "updaterr";
			exit();
		}

		/*
		 * Doing a check for existing email is not the same as a new reg. check first to 
		 * see if it's different, then check if it is a valid address and it exists.
		 */
		global $current_user; wp_get_current_user();
		if ( isset( $wpmem->user->post_data['user_email'] ) ) {
			if ( $wpmem->user->post_data['user_email'] != $current_user->user_email ) {
				if ( email_exists( $wpmem->user->post_data['user_email'] ) ) { 
					return "email";
					exit();
				} 
				if ( in_array( 'user_email', $wpmem->fields ) && ! is_email( $wpmem->user->post_data['user_email']) ) { 
					$wpmem_themsg = wpmem_get_text( 'reg_valid_email' );
					return "updaterr";
					exit();
				}
			}
		}

		// If form includes email confirmation, validate that they match.
		if ( array_key_exists( 'confirm_email', $wpmem->user->post_data ) && $wpmem->user->post_data['confirm_email'] != $wpmem->user->post_data ['user_email'] ) { 
			$wpmem_themsg = wpmem_get_text( 'reg_email_match' );
			return "updaterr";
			exit();
		}
		
		// Add the user_ID to the fields array.
		$wpmem->user->post_data['ID'] = $user_ID;
		
		/** This filter is documented in register.php */
		$wpmem->user->post_data = apply_filters( 'wpmem_register_data', $wpmem->user->post_data, 'edit' ); 
		
		/**
		 * Fires before data insertion.
		 *
		 * This action is the final step in pre updating a user. This
		 * can be used for attaching custom validation to the update
		 * process. It cannot be used for changing any user update
		 * data. Use the wpmem_register_data filter for that.
		 *
		 * @since 2.7.2
		 *
		 * @param array $wpmem->user->post_data The user's submitted update data.
		 */
		do_action( 'wpmem_pre_update_data', $wpmem->user->post_data );
		
		// If the _pre_update_data hook sends back an error message.
		if ( $wpmem_themsg ){ 
			return "updaterr";
		}

		// A list of fields that can be updated by wp_update_user.
		$native_fields = array( 
			'user_nicename',
			'user_url',
			'user_email',
			'display_name',
			'nickname',
			'first_name',
			'last_name',
			'description',
			'role',
		);
		$native_update = array( 'ID' => $wpmem->user->post_data['ID'] );

		foreach ( $wpmem->fields as $meta_key => $field ) {
			// If the field is not excluded, update accordingly.
			if ( ! in_array( $meta_key, wpmem_get_excluded_meta( 'update' ) ) ) {
				if ( 'file' != $field['type'] && 'image' != $field['type'] ) {
					switch ( $meta_key ) {
	
					// If the field can be updated by wp_update_user.
					case( in_array( $meta_key, $native_fields ) ):
						if ( 1 == $field['profile'] ) {
							// Prev value in prev_data array.
							$wpmem->user->prev_data[ $meta_key ] = $current_user->{$meta_key};
							// Add to post_data array.
							$wpmem->user->post_data[ $meta_key ] = ( isset( $wpmem->user->post_data[ $meta_key ] ) ) ? $wpmem->user->post_data[ $meta_key ] : '';
							// Add to native update for settings.
							$native_update[ $meta_key ] = $wpmem->user->post_data[ $meta_key ];
						}
						break;
	
					// If the field is password.
					case( 'password' ):
						// Do nothing.
						break;
	
					// Everything else goes into wp_usermeta.
					default:
						if ( ( 'register' == $tag && true == $field['register'] ) || ( 'update' == $tag && true == $field['profile'] ) ) {
							// Get existing value for prev_data array.
							$wpmem->user->prev_data[ $meta_key ] = get_user_meta( $wpmem->user->post_data['ID'], $meta_key, true );
							// Update the value.
							update_user_meta( $wpmem->user->post_data['ID'], $meta_key, $wpmem->user->post_data[ $meta_key ] );
						}
						break;
					}
				}
			}
		}
		
		// Handle file uploads, if any.
		if ( ! empty( $_FILES ) ) {
			$wpmem->user->upload_user_files( $wpmem->user->post_data['ID'], $wpmem->fields );
		}

		// Update wp_update_user fields.
		wp_update_user( $native_update );

		/**
		 * Fires at the end of user update data insertion.
		 *
		 * @since 2.7.2
		 *
		 * @param array $wpmem->user->post_data The user's submitted registration data.
		 * @param int   $user_id
		 * @param array $wpmem->user->prev_data The data for the user prior to update (does not support file and image fields).
		 */
		do_action( 'wpmem_post_update_data', $wpmem->user->post_data, $wpmem->user->post_data['ID'], $wpmem->user->prev_data );

		return "editsuccess"; exit();
		break;
	}
} // End registration function.

/**
 * Get user IP address.
 *
 * From Pippin.
 * @link https://gist.github.com/pippinsplugins/9641841
 *
 * @since 3.3.0
 * @since 3.4.0 Now an alias for rktgk_get_user_ip();
 *
 * @return string $ip.
 */
function wpmem_get_user_ip() {
	/**
	 * Filter the IP result.
	 *
	 * @since 3.3.0
	 *
	 * @param string $ip
	 */
	return apply_filters( 'wpmem_get_ip', rktgk_get_user_ip() );
}

/**
 * Export all or selected users
 *
 * @since 2.9.7
 * @since 3.2.0 Updated to use fputcsv.
 * @since 3.2.1 Added user data filters.
 * @since 3.3.0 Call object class static method.
 * @since 3.3.4 Moved into general API.
 *
 * @todo Move object class file to main /includes/
 *
 * @global object $wpmem
 *
 * @param array $args array {
 *     Array of defaults for export.
 *
 *     @type  string  $export          The type of export (all|selected)
 *     @type  string  $filename
 *     @type  array   $fields {
 *         The array of export fields is keyed as 'meta_key' => 'heading value'.
 *         The array can include fields in the Fields tab, plus the following:
 *
 *         @type int    $ID               ID from wp_users
 *         @type string $username         user_login from wp_users
 *         @type string $user_nicename    user_nicename
 *         @type string $user_url         user_url
 *         @type string $display_name     display_name
 *         @type int    $active           Whether the user is active/deactivated.
 *         @type string $exp_type         If the PayPal extension is installed pending|subscrption (optional)
 *         @type string $expires          If the PayPal extension is installed MM/DD/YYYY (optional)
 *         @type string $user_registered  user_registered
 *         @type string $user_ip          The IP of the user when they registered.
 *         @type string $role             The user's role (or roles, if multiple).
 *     }
 *     @type  array   $exclude_fields  @deprecated 3.4.0
 *     @type  boolean $entity_decode   Whether HTML entities should be decoded (default: false)
 *     @type  string  $date_format     A PHP readable date format (default: Y-m-d which results in YYYY-MM-DD)
 * }
 * @param array  $users Array of user IDs to export.
 */
function wpmem_export_users( $args = array(), $users = array() ) {
	global $wpmem;
	include_once( $wpmem->path . 'includes/class-wp-members-user-export.php' );
	WP_Members_User_Export::export_users( $args, $users );
}

/**
 * Gets user ID based on request.
 *
 * @since 3.3.5
 *
 * @param  mixed  $user
 * @return mixed 
 */
function wpmem_get_user_id( $user ) {
	$user_obj = wpmem_get_user_obj( $user );
	return ( is_object( $user_obj ) ) ? $user_obj->ID : false;
}

/**
 * Gets user object based on request.
 *
 * @since 3.3.5
 *
 * @param  mixed  $user
 * @return mixed 
 */
function wpmem_get_user_obj( $user ) {
	if ( is_numeric( $user ) ) {
		$user_obj = get_userdata( $user );
		if ( $user_obj ) {
			return $user_obj;
		}
	}
	if ( strpos( $user, '@' ) ) {
		$user_obj = get_user_by( 'email', $user );
		if ( $user_obj ) {
			return $user_obj;
		}
	}
	if ( is_string( $user ) ) {
		$user_obj = get_user_by( 'login', $user );
		if ( $user_obj ) {
			return $user_obj;
		}
	}
	return false;
}

/**
 * Get all users by a meta value.
 *
 * @since 3.3.5
 *
 * @param   string  $meta   The meta key to search fo.
 * @param   string  $value  The meta value to search for (defaul:false).
 * @return  array   $users  An array of user IDs who have the requested meta.
 */
function wpmem_get_users_by_meta( $meta, $value = "EXISTS" ) {
	$args  = array( 'fields' => array( 'ID' ), 'meta_key' => $meta );
	if ( false === $value ) {
		$args['meta_value'] = '';
		$args['meta_compare'] = 'NOT EXISTS';
	} elseif ( "EXISTS" === $value ) {
		$args['meta_value'] = '';
		$args['meta_compare'] = '>';
	} else {
		$args['meta_value'] = $value;
	}
	$results = get_users( $args );
	if ( $results ) {
		foreach( $results as $result ) {
			$users[] = $result->ID;
		}
		return $users;
	} else {
		return array();
	}
}

/**
 * Gets a list of all pending users.
 *
 * @since 3.3.5
 *
 * @return array $users An array of user IDs where meta key "active" does not exist.
 */
function wpmem_get_pending_users() {
	return wpmem_get_users_by_meta( 'active', false );
}

/**
 * Gets a list of all activated users.
 *
 * @since 3.3.5
 *
 * @return array $users An array of user IDs who have the meta key active=1
 */
function wpmem_get_activated_users() {
	return wpmem_get_users_by_meta( 'active', 1 );
}

/**
 * Gets a list of all deactivated users.
 *
 * @since 3.3.5
 *
 * @return array $users An array of users IDs who have the meta key active=0
 */
function wpmem_get_deactivated_users() {
	return wpmem_get_users_by_meta( 'active', 0 );
}

/**
 * Sets a user as validated.
 *
 * @since 3.3.5
 *
 * @param  int     $user_id
 * @return void
 */
function wpmem_set_user_as_confirmed( $user_id ) {
	global $wpmem;
	$wpmem->act_newreg->set_as_confirmed( $user_id );
}

/**
 * Sets user as unconfirmed (not validated).
 *
 * @since 3.3.8
 *
 * @param  int  $user_id
 * @return void
 */
function wpmem_set_user_as_unconfirmed( $user_id ) {
	global $wpmem;
	$wpmem->act_newreg->set_as_unconfirmed( $user_id );
}

/** 
 * Checks if a user is confirmed.
 *
 * @since 3.3.8
 *
 * @global object $wpmem
 * @param  int    $user_id
 * @return bool
 */
function wpmem_is_user_confirmed( $user_id = false ) {
	global $wpmem;
	$user_id = ( false === $user_id ) ? get_current_user_id() : $user_id;
	return ( get_user_meta( $user_id, $wpmem->act_newreg->validation_confirm, true ) ) ? true : false;
}

/**
 * Adds WP-Members custom fields to the WP Add New User form.
 *
 * @since 2.9.1
 * @since 3.4.0 Moved from admin.php
 *
 * @global stdClass $wpmem
 */
function wpmem_admin_add_new_user() {
	global $wpmem;
	// Output the custom registration fields.
	echo $wpmem->forms->wp_newuser_form();
	return;
}

/**
 * Creates a username "placeholder" for the db from 
 * the user's email.
 * 
 * @since 3.4.6
 * 
 * @param  string  $email
 * @param  array   $fields   Array of fields
 * @return string  $username
 */
function wpmem_create_username_from_email( $email, $fields = array() ) {
	// If the WooCommerce function exists, use that.
	if ( function_exists( 'wc_create_new_customer_username' ) ) {
		return wc_create_new_customer_username( $email, $fields );
	}
	if ( ! is_email( $email ) ) {
		return false;
	}
	// Extract beginning of email for username
	$parts = explode( "@", $email );
	$temp_user = $parts[0];
	
	// Make sure it's a unique value.  If not, add a number and retest.
	if ( username_exists( $temp_user ) ) {
		$i = 0;
		do {
			$i++;
			$temp_user = $temp_user . $i;
		} while ( username_exists( $temp_user ) );
	}
	
	return $temp_user;
}
// End of file.