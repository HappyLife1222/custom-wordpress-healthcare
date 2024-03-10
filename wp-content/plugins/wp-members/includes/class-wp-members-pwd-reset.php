<?php
/**
 * An object class for WP-Members Password Reset.
 *
 * @since 3.3.5
 * @since 3.3.8 Rebuild processing to utilize WP native functions and user_activation_key.
 */
class WP_Members_Pwd_Reset {
	
	/**
	 * Message containers.
	 *
	 * @since 3.3.5
	 */
	public  $invalid_key;
	public  $invalid_user;
	public  $key_is_expired;
	public  $request_new_key;
	private $reset_key;
	public  $content = false;
	
	/**
	 * Meta containers
	 *
	 * @since 3.3.5
	 */
	public $action = 'set_password_from_key';
	
	/**
	 * Initialize the class.
	 *
	 * @since 3.3.5
	 */
	function __construct() {
		
		$defaults = array(
			'invalid_key'     => __( "Invalid key." ),
			'invalid_user'    => __( "Invalid user.", 'wp-members' ),
			'key_is_expired'  => __( "Sorry, the password reset key is expired.", 'wp-members' ),
			'request_new_key' => __( "Request a new reset key.", 'wp-members' ),
		);
		
		/**
		 * Filter default dialogs.
		 *
		 * @since 3.3.8
		 *
		 * @param array $defaults {
		 *     
		 * }
		 */
		$defaults = apply_filters( 'wpmem_pwd_reset_default_dialogs', $defaults );

		foreach ( $defaults as $key => $value ) {
			$this->{$key} = $value;
		}
		
		add_filter( 'wpmem_email_filter', array( $this, 'add_reset_key_to_email' ), 10, 3 );
		add_action( 'template_redirect',  array( $this, 'handle_reset'           ), 20  );
		//add_filter( 'the_content',        array( $this, 'display_content'        ), 100 );
	}

	function handle_reset() {
	
		// User has to be not logged in and action needs to be 'set_password_from_key'
		if ( ! is_user_logged_in() && $this->action == wpmem_get( 'a', false, 'request' ) && ! is_admin() ) {
			
			$key   = sanitize_text_field( wpmem_get( 'key',   false, 'request' ) );
			$login = sanitize_text_field( wpmem_get( 'login', false, 'request' ) );
			$pass1 = wpmem_get( 'pass1', false );
			
			$form_submitted = ( 1 == wpmem_get( 'formsubmit' ) && $this->action == wpmem_get( 'a', false ) ) ? true : false;

			// Set an error container.
			$errors = new WP_Error();

			// Check the user. get_user_by() will return false if user_login does not exist.
			$is_user = get_user_by( 'login', $login );
			if ( false == $is_user ) {
				$errors->add( 'invalid_user', $this->error_msg( 'invalid_user', $this->invalid_user ) );
			}

			/**
			 * Validate the key.
			 *
			 * WP_Error will be invalid_key or expired_key. Process triggers password_reset_expiration filter
			 * filtering DAY_IN_SECONDS default. Filter password_reset_key_expired is also triggered filtering
			 * the return value (which can be used to override the expired/invalid check based on user_id).
			 *
			 * WP filter/actions triggered:
			 * - password_reset_expiration
			 * - password_reset_key_expired
			 *
			 * @see https://developer.wordpress.org/reference/functions/check_password_reset_key/
			 * @param string Hash to validate sending user's password.
			 * @param string The user login.
			 * @return WP_User|WP_Error WP_User object on success, WP_Error object for invalid or expired keys (invalid_key|expired_key).
			 */
			$user = check_password_reset_key( $key, $login );

			if ( $user->has_errors() ) {
				$errors->add( 'invalid_key', $this->error_msg( 'invalid_key', $this->invalid_key ) );
			}
	
			// If the password change form was submitted, validate the result.
			if ( $form_submitted ) {
				
				// Verify nonce.
				if ( ! wp_verify_nonce( $_REQUEST['_wpmem_pwdchange_nonce'], 'wpmem_shortform_nonce' ) ) {
					$errors->add( 'reg_generic', $this->error_msg( 'reg_generic', wpmem_get_text( 'reg_generic' ) ) );
				}

				// Can't have an empty pass1.
				if ( '' == $pass1 || false == $pass1 ) {
					$errors->add( 'password_empty', $this->error_msg( 'password_empty', wpmem_get_text( 'pwdchangempty' ) ) );
				}
				
				// Make sure submitted passwords match.  
				if ( $pass1 != wpmem_get( 'pass2', false ) ) {
					$errors->add( 'password_reset_mismatch', $this->error_msg( 'password_reset_mismatch', wpmem_get_text( 'pwdchangerr' ) ) );
				}
				
				/** This action is documented in wp-login.php */
				// do_action( 'validate_password_reset', $errors, $user );
			}

			/**
			 * Filter validation result.
			 * 
			 * @since 3.4.7
			 * 
			 * @param  stdClass  $errors
			 * @param  stdClass  $user
			 * @param  boolean   $form_submitted
			 */
			$errors = apply_filters( 'wpmem_validate_password_reset', $errors, $user, $form_submitted );

			// If form was submitted.
			if ( $form_submitted ) {
				if ( ! $errors->has_errors() ) {
					reset_password( $user, $pass1 );
					$this->content = wpmem_get_display_message( 'pwdchangesuccess', $this->error_msg( 'pwdchangesuccess' ) ) . wpmem_login_form( 'pwdreset' );
				} else {
					$this->content = $errors->get_error_message() .  wpmem_change_password_form();
				}
			} else {
				// Password change form has not been submitted yet.
				if ( ! $errors->has_errors() ) {
					$this->content = wpmem_change_password_form();
				} else {
					$this->content = $errors->get_error_message();
				}
			}
		}
	}

	/**
	 * Add reset key to the email.
	 *
	 * @since 3.3.5
	 *
	 * @param  array  $arr
	 * @param  array  $wpmem_fields
	 * @param  array  $field_data
	 * @return array  $arr
	 */
	function add_reset_key_to_email( $arr, $wpmem_fields, $field_data ) {

		if ( $arr['toggle'] == 'repass' ) {
			
			$user = get_user_by( 'ID', $arr['user_id'] );
			
			// Get the stored key.
			$key = get_password_reset_key( $user );
			$query_args = array(
				'a'     => $this->action,
				'key'   => $key,
				'login' => $user->user_login,
			);
			
			// urlencode, primarily for user_login with a space.
			$query_args = array_map( 'rawurlencode', $query_args );
			
			// Generate reset link.
			$link = add_query_arg( $query_args, trailingslashit( wpmem_profile_url() ) );

			/**
			 * Filter the password reset URL in the email.
			 * 
			 * @since 3.4.5
			 * 
			 * @param  string  $link
			 * @param  array   $query_args
			 * @param  object  $user
			 */
			$link = apply_filters( 'wpmem_pwd_reset_email_link', $link, $query_args, $user );
			
			// Does email body have the [reset_link] shortcode?
			if ( strpos( $arr['body'], '[reset_link]' ) ) {
				$arr['body'] = str_replace( '[reset_link]', $link, $arr['body'] );
			} else {
				// Add text and link to the email body.
				$arr['body'] = $arr['body'] . "\r\n"
					. $link;
			}
		}
		return $arr;
	}

	/**
	 * Display page content to user.
	 *
	 * @since 3.3.5
	 *
	 * @param  string  $content
	 * @return string  $content
	 */
	function display_content( $content ) {
		return ( false != $this->content ) ? $this->content : $content;
	}

	
	function error_msg( $code, $message = false ) {
		if ( $message ) {
			$error = wpmem_get_display_message( $code, $message . '<br /><a href="' . wpmem_profile_url( 'pwdreset' ) . '">' . $this->request_new_key . '</a>' );
		} else {
			$error = wpmem_get_display_message( $code );
		}
		/**
		 * Filters the password reset error message.
		 * 
		 * @since 3.4.4
		 * 
		 * @param  string  $error    The generated HTML error message.
		 * @param  string  $code     The error code generated.
		 * @param  string  $message  The plain text error message.
		 */
		return apply_filters( 'wpmem_pwd_reset_error_msg', $error, $code, $message );
	}
}