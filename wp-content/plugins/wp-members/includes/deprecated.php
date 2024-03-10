<?php
/**
 * WP-Members Deprecated Functions
 *
 * These functions have been deprecated and are now obsolete.
 * Use alternative functions as these will be removed in a 
 * future release.
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2023  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package   WP-Members
 * @author    Chad Butler 
 * @copyright 2006-2023
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! function_exists( 'wpmem_selected' ) ):
/**
 * Determines if a form field is selected (i.e. lists & checkboxes).
 *
 * @since 0.1.0
 * @deprecated 3.1.0 Use selected() or checked() instead.
 *
 * @param  string $value 
 * @param  string $valtochk
 * @param  string $type
 * @return string $issame
 */
function wpmem_selected( $value, $valtochk, $type = null ) {
	wpmem_write_log( "wpmem_selected() is deprecated as of WP-Members 3.1.0. Use selected() or checked() instead" );
	$issame = ( $type == 'select' ) ? ' selected' : ' checked';
	return ( $value == $valtochk ) ? $issame : '';
}
endif;

if ( ! function_exists( 'wpmem_inc_status' ) ):
/**
 * Generate users login status if logged in and gives logout link.
 *
 * @since 1.8
 * @deprecated 3.2.0
 *
 * @global        $user_login
 * @global object $wpmem
 * @return string $status
 */
function wpmem_inc_status() {
	
	wpmem_write_log( "wpmem_inc_status() is deprecated in WP-Members 3.2.0. Use wpmem_login_status() instead." );
	
	global $user_login, $wpmem;
	
	/** This filter is defined in /includes/api/api.php */
	$logout = apply_filters( 'wpmem_logout_link', $url . '/?a=logout' );

	$status = '<p>' . sprintf( wpmem_get_text( 'sb_login_status' ), $user_login )
		. ' | <a href="' . $logout . '">' . wpmem_get_text( 'sb_logout_link' ) . '</a></p>';

	return $status;
}
endif;

if ( ! function_exists( 'wpmem_do_sidebar' ) ):
/**
 * Creates the sidebar login form and status.
 *
 * This function determines if the user is logged in and displays either
 * a login form, or the user's login status. Typically used for a sidebar.		
 * You can call this directly, or with the widget.
 *
 * @since 2.4.0
 * @since 3.0.0 Added $post_to argument.
 * @since 3.1.0 Changed $post_to to $redirect_to.
 * @deprecated 3.2.0 Use widget_wpmemwidget::do_sidebar() instead.
 *
 * @param  string $redirect_to  A URL to redirect to upon login, default null.
 * @global string $wpmem_regchk
 * @global string $user_login
 */
function wpmem_do_sidebar( $redirect_to = null ) {
	wpmem_write_log( "wpmem_do_sidebar() is deprecated in WP-Members 3.2.0. Use wpmem_login_status() instead." );
	widget_wpmemwidget::do_sidebar( $redirect_to );
}
endif;

if ( ! function_exists( 'wpmem_create_formfield' ) ):
/**
 * Creates form fields
 *
 * Creates various form fields and returns them as a string.
 *
 * @since 1.8.0
 * @since 3.1.0 Converted to wrapper for create_form_field() in utlities object.
 * @deprecated 3.2.0 Use wpmem_form_field() instead.
 *
 * @global object $wpmem    The WP_Members object class.
 * @param  string $name     The name of the field.
 * @param  string $type     The field type.
 * @param  string $value    The default value for the field.
 * @param  string $valtochk Optional for comparing the default value of the field.
 * @param  string $class    Optional for setting a specific CSS class for the field.
 * @return string $str      The field returned as a string.
 */
function wpmem_create_formfield( $name, $type, $value, $valtochk=null, $class='textbox' ) {
	$args = array(
		'name'     => $name,
		'type'     => $type,
		'value'    => $value,
		'compare'  => $valtochk,
		'class'    => $class,
	);
	return wpmem_form_field( $args );
}
endif;

/**
 * Adds the successful registration message on the login page if reg_nonce validates.
 *
 * @since 3.1.7
 * @deprecated 3.2.0 Use $wpmem->reg_securify() instead.
 *
 * @param  string $content
 * @return string $content
 */
function wpmem_reg_securify( $content ) {
	global $wpmem, $wpmem_themsg;
	$nonce = wpmem_get( 'reg_nonce', false, 'get' );
	if ( $nonce && wp_verify_nonce( $nonce, 'register_redirect' ) ) {
		$content = wpmem_get_display_message( 'success', $wpmem_themsg );
		$content = $content . wpmem_login_form();
	}
	return $content;
}

if ( ! function_exists( 'wpmem_inc_regemail' ) ):
/**
 * Builds emails for the user.
 *
 * @since 1.8.0
 * @since 2.7.4 Added wpmem_email_headers and individual body/subject filters.
 * @since 2.9.7 Major overhaul, added wpmem_email_filter filter.
 * @since 3.1.0 Can filter in custom shortcodes with wpmem_email_shortcodes.
 * @since 3.1.1 Added $custom argument for custom emails.
 * @deprecated 3.2.0 Use wpmem_email_to_user() instead.
 *
 * @global object $wpmem                The WP_Members object.
 * @global string $wpmem_mail_from      The email from address.
 * @global string $wpmem_mail_from_name The email from name.
 * @param  int    $user_ID              The User's ID.
 * @param  string $password             Password from the registration process.
 * @param  string $toggle               Toggle indicating the email being sent (newreg|newmod|appmod|repass|getuser).
 * @param  array  $wpmem_fields         Array of the WP-Members fields (defaults to null).
 * @param  array  $fields               Array of the registration data (defaults to null).
 * @param  array  $custom               Array of custom email information (defaults to null).
 */
function wpmem_inc_regemail( $user_id, $password, $toggle, $wpmem_fields = null, $field_data = null, $custom = null ) {
	global $wpmem;
	wpmem_write_log( "wpmem_inc_regemail() is deprecated since WP-Members 3.2.0. Use wpmem_email_to_user() instead" );
	wpmem_email_to_user( $user_id, $password, $toggle, $wpmem_fields, $field_data, $custom );
	return;
}
endif;

if ( ! function_exists( 'wpmem_check_activated' ) ):
/**
 * Checks if a user is activated.
 *
 * @since 2.7.1
 * @deprecated 3.2.2 Use wpmem_is_user_activated() instead.
 *
 * @param  object $user     The WordPress User object.
 * @param  string $username The user's username (user_login).
 * @param  string $password The user's password.
 * @return object $user     The WordPress User object.
 */ 
function wpmem_check_activated( $user, $username, $password ) {
	wpmem_write_log( "wpmem_check_activated() is deprecated since WP-Members 3.2.2. Use wpmem_is_user_activated() instead" );
	global $wpmem;
	$user = $wpmem->user->check_activated( $user, $username, $password );
	return $user;
}
endif;

/**
 * Activates a user.
 *
 * If registration is moderated, sets the activated flag 
 * in the usermeta. Flag prevents login when $wpmem->mod_reg
 * is true (1). Function is fired from bulk user edit or
 * user profile update.
 *
 * @since 2.4
 * @since 3.1.6 Dependencies now loaded by object.
 * @deprecated 3.2.4 Use wpmem_activate_user().
 *
 * @param int   $user_id
 * @param bool  $chk_pass
 * @uses  $wpdb WordPress Database object.
 */
function wpmem_a_activate_user( $user_id, $chk_pass = false ) {
	wpmem_write_log( "wpmem_a_activate_user() is deprecated as of WP-Members 3.2.4. Use wpmem_activate_user instead" );
	wpmem_activate_user( $user_id );
}

/**
 * Deactivates a user.
 *
 * Reverses the active flag from the activation process
 * preventing login when registration is moderated.
 *
 * @since 2.7.1
 * @depreacted 3.2.4 Use wpmem_deactivate_user().
 *
 * @param int $user_id
 */
function wpmem_a_deactivate_user( $user_id ) {
	wpmem_write_log( "wpmem_a_deactivate_user() is deprecated as of WP-Members 3.2.4. Use wpmem_deactivate_user instead" );
	wpmem_deactivate_user( $user_id );
}

if ( ! function_exists( 'wpmem_inc_changepassword' ) ):
/**
 * Change Password Dialog.
 *
 * Loads the form for changing password.
 *
 * @since 2.0.0
 * @since 3.2.0 Now an alias for $wpmem->forms->do_changepassword_form()
 * @deprecated 3.3.0 Use wpmem_change_password_form() instead.
 *
 * @global object $wpmem The WP_Members object.
 * @return string $str   The generated html for the change password form.
 */
function wpmem_inc_changepassword() {
	wpmem_write_log( "wpmem_inc_changepassword() is deprecated as of WP-Members 3.3.0. Use wpmem_inc_changepassword() instead" );
	return wpmem_changepassword_form();
}
endif;


if ( ! function_exists( 'wpmem_inc_resetpassword' ) ):
/**
 * Reset Password Dialog.
 *
 * Loads the form for resetting password.
 *
 * @since 2.1.0
 * @since 3.2.0 Now an alias for $wpmem->forms->do_resetpassword_form()
 * @deprecated 3.3.0 Use wpmem_reset_password_form() instead.
 *
 * @global object $wpmem The WP_Members object.
 * @return string $str   The generated html fo the reset password form.
 */
function wpmem_inc_resetpassword() { 
	wpmem_write_log( "wpmem_inc_resetpassword() is deprecated as of WP-Members 3.3.0. Use wpmem_inc_resetpassword() instead" );
	return wpmem_reset_password_form();
}
endif;

/**
 * Forgot Username Form.
 *
 * Loads the form for retrieving a username.
 *
 * @since 3.0.8
 * @since 3.2.0 Moved to forms.php.
 * @deprecated 3.3.0 Use wpmem_forgot_username_form() instead.
 *
 * @global object $wpmem The WP_Members object class.
 * @return string $str   The generated html for the forgot username form.
 */
function wpmem_inc_forgotusername() {
	wpmem_write_log( "wpmem_inc_forgotusername() is deprecated as of WP-Members 3.3.0. Use wpmem_forgot_username_form() instead" );
	return wpmem_forgot_username_form();
}

if ( ! function_exists( 'wpmem_inc_recaptcha' ) ):
/**
 * Create reCAPTCHA form.
 *
 * @since  2.6.0
 * @deprecated 3.3.0 Use WP_Members_Captcha::show( 'captcha_v2' ) instead.
 *
 * @param  array  $arr
 * @return string $str HTML for reCAPTCHA display.
 */
function wpmem_inc_recaptcha( $arr ) {
	wpmem_write_log( "wpmem_inc_recaptcha() is deprecated as of WP-Members 3.3.0." );
	return WP_Members_Captcha::recaptcha();
}
endif;

/**
 * Create Really Simple CAPTCHA.
 *
 * @since 2.9.5
 * @deprecated 3.3.0 Use WP_Members_Captcha::show( 'rs_captcha' ) instead.
 *
 * @global object $wpmem The WP_Members object.
 * @return array {
 *     HTML Form elements for Really Simple CAPTCHA.
 *
 *     @type string label_text The raw text used for the label.
 *     @type string label      The HTML for the label.
 *     @type string field      The input tag and the CAPTCHA image.
 * }
 */
function wpmem_build_rs_captcha() {
	wpmem_write_log( "wpmem_build_rs_captcha() is deprecated as of WP-Members 3.3.0." );
	return ( defined( 'REALLYSIMPLECAPTCHA_VERSION' ) ) ? WP_Members_Captcha::show( 'rs_captcha' ) : '';
}

/**
 * Load constants deprecated in 3.3.0
 *
 * @since 3.3.0
 */
add_action( 'wpmem_after_init', 'wpmem_load_deprecated_constants' );
function wpmem_load_deprecated_constants() {
	global $wpmem;
	( ! defined( 'WPMEM_CSSURL' ) ) ? define( 'WPMEM_CSSURL', $wpmem->cssurl ) : '';
}

if ( ! function_exists( 'wpmem_registration' ) ):
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
 * @deprecated 3.3.0 Use wpmem_user_register() instead.
 *
 * @global int    $user_ID
 * @global object $wpmem
 * @global string $wpmem_themsg
 * @global array  $userdata
 *
 * @param  string $tag           Identifies 'register' or 'update'.
 * @return string $wpmem_themsg|success|editsuccess
 */
function wpmem_registration( $tag ) {
	return wpmem_user_register( $tag );
} // End registration function.
endif;

if ( ! function_exists( 'wpmem_get_captcha_err' ) ):
/**
 * Generate reCAPTCHA error messages.
 *
 * @since 2.4
 * @deprecated 3.3.0 No replacement exists.
 *
 * @param  string $wpmem_captcha_err The response from the reCAPTCHA API.
 * @return string $wpmem_captcha_err The appropriate error message.
 */
function wpmem_get_captcha_err( $wpmem_captcha_err ) {

	switch ( $wpmem_captcha_err ) {

	case "invalid-site-public-key":
		$wpmem_captcha_err = __( 'We were unable to validate the public key.', 'wp-members' );
		break;

	case "invalid-site-public-key":
		$wpmem_captcha_err = __( 'We were unable to validate the private key.', 'wp-members' );
		break;

	case "invalid-request-cookie":
		$wpmem_captcha_err = __( 'The challenge parameter of the verify script was incorrect.', 'wp-members' );
		break;

	case "incorrect-captcha-sol":
		$wpmem_captcha_err = __( 'The CAPTCHA solution was incorrect.', 'wp-members' );
		break;

	case "verify-params-incorrect":
		$wpmem_captcha_err = __( 'The parameters to verify were incorrect', 'wp-members' );
		break;

	case "invalid-referrer":
		$wpmem_captcha_err = __( 'reCAPTCHA API keys are tied to a specific domain name for security reasons.', 'wp-members' );
		break;

	case "recaptcha-not-reachable":
		$wpmem_captcha_err = __( 'The reCAPTCHA server was not reached.  Please try to resubmit.', 'wp-members' );
		break;

	case 'really-simple':
		$wpmem_captcha_err = __( 'You have entered an incorrect code value. Please try again.', 'wp-members' );
		break;
	}

	return $wpmem_captcha_err;
}
endif;

if ( ! function_exists( 'wpmem_inc_login' ) ):
/**
 * Login Dialog.
 *
 * Loads the login form for user login.
 *
 * @since 1.8
 * @since 3.1.4 Global $wpmem_regchk no longer needed.
 * @since 3.2.0 Now an alias for $wpmem->forms->do_login_form().
 * @deprecated 3.3.0 Use wpmem_login_form() instead.
 *
 * @global object $post         The WordPress Post object.
 * @global object $wpmem        The WP_Members object.
 * @param  string $page         If the form is being displayed in place of blocked content. Default: page.
 * @param  string $redirect_to  Redirect URL. Default: null.
 * @param  string $show         If the form is being displayed in place of blocked content. Default: show.
 * @return string $str          The generated html for the login form.
 */
function wpmem_inc_login( $page = "page", $redirect_to = null, $show = 'show' ) {
	wpmem_write_log( 'wpmem_inc_login() is deprecated as of WP-Members 3.3.0. Use wpmem_login_form() instead.' );
	global $wpmem;
	return wpmem_login_form( 'login', array( 'redirect_to'=>$redirect_to ) ); //$wpmem->forms->do_login_form( $page, $redirect_to, $show );
}
endif;

if ( ! function_exists( 'wpmem_inc_registration' ) ):
/**
 * Registration Form Dialog.
 *
 * Outputs the form for new user registration and existing user edits.
 *
 * @since 2.5.1
 * @since 3.1.7 Now an alias for $wpmem->forms->register_form()
 * @since 3.2.0 Preparing for deprecation, use wpmem_register_form() instead.
 * @deprecated 3.3.0 Use wpmem_register_form() instead.
 *
 * @global object $wpmem        The WP_Members object.
 * @param  string $tag          (optional) Toggles between new registration ('new') and user profile edit ('edit').
 * @param  string $heading      (optional) The heading text for the form, null (default) for new registration.
 * @return string $form         The HTML for the entire form as a string.
 */
function wpmem_inc_registration( $tag = 'new', $heading = '', $redirect_to = null ) {
	wpmem_write_log( 'wpmem_inc_registration() is deprecated as of WP-Members 3.3.0. Use wpmem_register_form() instead.' );
	global $wpmem;
	$args = array( 'tag' => $tag, 'heading' => $heading, 'redirect_to' => $redirect_to );
	return $wpmem->forms->register_form( $args );
} // End wpmem_inc_registration.
endif;

if ( ! function_exists( 'wpmem_inc_loginfailed' ) ):
/**
 * Login Failed Dialog.
 *
 * Returns the login failed error message.
 *
 * @since 1.8
 * @deprecated 3.4.0 Use $wpmem->dialogs->login_failed().
 *
 * @global object $wpmem The WP_Members object.
 * @return string $str   The generated html for the login failed message.
 */
function wpmem_inc_loginfailed() {
	wpmem_write_log( 'wpmem_inc_loginfailed() is deprecated as of WP-Members 3.4.0. Use $wpmem->dialogs->login_failed() instead.' );
	global $wpmem;
	return $wpmem->dialogs->login_failed();
}
endif;


if ( ! function_exists( 'wpmem_inc_regmessage' ) ):
/**
 * Message Dialog.
 *
 * Returns various dialogs and error messages.
 *
 * @since 1.8
 * @since 3.3.0 Changed 'toggles' to 'tags'
 * @deprecated 3.4.0 Use wpmem_get_display_message() instead.
 *
 * @global object $wpmem
 * @param  string $tag Error message tag to look for specific error messages.
 * @param  string $msg A message that has no tag that is passed directly to the function.
 * @return string $str The final HTML for the message.
 */
function wpmem_inc_regmessage( $tag, $msg = '' ) {
	wpmem_write_log( "wpmem_inc_regmessage() is deprecated as of WP-Members 3.4.0. Use wpmem_get_display_message() instead." );
	global $wpmem;
	return $wpmem->dialogs->get_message( $tag, $msg );
}
endif;


if ( ! function_exists( 'wpmem_page_pwd_reset' ) ):
/**
 * Password reset forms.
 *
 * This function creates both password reset and forgotten
 * password forms for page=password shortcode.
 *
 * @since 2.7.6
 * @since 3.2.6 Added nonce validation.
 * @deprecated 3.4.0 Use $wpmem->shortcodes->render_pwd_reset() instead.
 *
 * @global object $wpmem
 * @param  string $wpmem_regchk
 * @param  string $content
 * @return string $content
 */
function wpmem_page_pwd_reset( $wpmem_regchk, $content ) {
	wpmem_write_log( "wpmem_page_pwd_reset() is deprecated as of WP-Members 3.4.0." );
	global $wpmem;
	$content = $wpmem->shortcodes->render_pwd_reset( $wpmem_regchk, $content );
	return $content;

}
endif;


if ( ! function_exists( 'wpmem_page_user_edit' ) ):
/**
 * Creates a user edit page.
 *
 * @since 2.7.6
 * @since 3.3.9 Added $atts
 * @deprecated 3.4.0 Use $wpmem->shortcodes->render_user_edit() instead.
 *
 * @global object $wpmem
 * @global string $wpmem_a
 * @global string $wpmem_themsg
 * @param  string $wpmem_regchk
 * @param  string $content
 * @return string $content
 */
function wpmem_page_user_edit( $wpmem_regchk, $content, $atts = false ) {
	wpmem_write_log( "wpmem_page_user_edit() is deprecated as of WP-Members 3.4.0." );
	global $wpmem, $wpmem_a, $wpmem_themsg;
	$content = $wpmem->shortcodes->render_user_edit( $wpmem_regchk, $content );
	return $content;
}
endif;


/**
 * Forgot username form.
 *
 * This function creates a form for retrieving a forgotten username.
 *
 * @since 3.0.8
 * @deprecated 3.4.0 Use $wpmem->shortcodes->render_forgot_username() instead.
 *
 * @param  string $wpmem_regchk
 * @param  string $content
 * @return string $content
 */
function wpmem_page_forgot_username( $wpmem_regchk, $content ) {
	wpmem_write_log( "wpmem_page_forgot_username() is deprecated as of WP-Members 3.4.0." );
	global $wpmem;
	$content = $wpmem->shortcodes->render_forgot_username( $wpmem_regchk, $content );
	return $content;

}

if ( ! function_exists( 'wpmem_inc_memberlinks' ) ):
/**
 * Member Links Dialog.
 *
 * Outputs the links used on the members area.
 *
 * @since 2.0
 * @since 3.4.0 "status" is technically deprecated. Use wpmem_login_status() instead.
 * @deprecated 3.4.0 Use $wpmem->shortocdes->render_links() instead.
 *
 * @gloabl        $user_login
 * @global object $wpmem
 * @param  string $page
 * @return string $str
 */
function wpmem_inc_memberlinks( $page = 'member' ) {
	wpmem_write_log( "wpmem_inc_memberlinks() is deprecated as of WP-Members 3.4.0." );
	global $wpmem;
	switch ( $page ) {

		case 'member':
		case 'register':
		case 'login':
			$str = $wpmem->shortcodes->render_links( $page );
			break;
		case 'status':
			$str = wpmem_login_status();
			break;

	}
	return $str;
}
endif;

/**
 * Wrapper to return a string from the get_text function.
 *
 * @since 3.1.1
 * @since 3.1.2 Added $echo argument.
 * @depreacted 3.4.0 Use wpmem_get_text() instead.
 *
 * @param  string $str   The string to retrieve.
 * @param  bool   $echo  Print the string (default: false).
 * @return string $str   The localized string.
 */
function wpmem_gettext( $str, $echo = false ) {
	return wpmem_get_text( $str, $echo );
}

/**
 * Returns http:// or https:// depending on ssl.
 *
 * @since 2.9.8
 * @deprecated 3.2.3 Use wpmem_force_ssl() instead.
 *
 * @return string https://|http:// depending on whether ssl is being used.
 */
function wpmem_use_ssl() {
	wpmem_write_log( 'wpmem_use_ssl() is deprecated. Use wpmem_force_ssl() instead' );
	return ( is_ssl() ) ? 'https://' : 'http://';
}