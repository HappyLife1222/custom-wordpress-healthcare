<?php
/**
 * WP-Members API Functions
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2023  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package    WP-Members
 * @subpackage WP-Members API Functions
 * @author     Chad Butler 
 * @copyright  2006-2023
 */

/**
 * Gets the present state of a form. 
 * 
 * Currently uses the value contained in $wpmem->regchk
 * 
 * @since 3.4.8.
 */
function wpmem_get_form_state() {
	global $wpmem;
	return $wpmem->regchk;
}

if ( ! function_exists( 'wpmem_login_form' ) ):
/**
 * Invokes a login form.
 *
 * Note: The original pluggable version of this function used a $page param
 * and an array. This function should (1) no longer be considered pluggable
 * and (2) should pass all arguments in the form if a single array. The previous
 * methods are maintained for legacy reasons, but should be updated to apply
 * to the current function documentation.
 *
 * @since 2.5.1
 * @since 3.1.7 Now an alias for $wpmem->forms->login_form()
 * @since 3.3.0 Added to API.
 * @since 3.4.0 Main API function for displaying login form.
 *
 * @global object $wpmem
 * @param  array  $args {
 *     Possible arguments for creating the form.
 *
 *     @type string $id
 *     @type string $tag
 *     @type string $form
 *     @type string $redirect_to
 * }
 * @param  array  $arr {
 *     Maintained only for legacy reasons.
 *     The elements needed to generate the form (login|reset password|forgotten password).
 *
 *     @type string $heading     Form heading text.
 *     @type string $action      The form action (login|pwdchange|pwdreset).
 *     @type string $button_text Form submit button text.
 *     @type array  $inputs {
 *         The form input values.
 *
 *         @type array {
 *
 *             @type string $name  The field label.
 *             @type string $type  Input type.
 *             @type string $tag   Input tag name.
 *             @type string $class Input tag class.
 *             @type string $div   Div wrapper class.
 *         }
 *     }
 *     @type string $redirect_to Optional. URL to redirect to.
 * }
 * @return string $form  The HTML for the form as a string.
 */
function wpmem_login_form( $args = array(), $arr = false ) {
	global $wpmem;
	
	/*
	// Convert legacy values.
	if ( ( ! is_array( $args ) && is_array( $arr ) ) || ( is_array( $args ) && empty( $args ) ) ) {
		$page = $args;
		$args = $arr;
		$args['page'] = $page;
	}
	$args['form'] = ( isset( $args['form'] ) ) ? $args['form'] : 'login';
	// @todo Work on making this $wpmem->forms->do_login_form( $args );
	return $wpmem->forms->login_form( $args );
	*/
	
	return $wpmem->forms->do_shortform( 'login', $args );
}
endif;

/**
 * Use the WP login form.
 *
 * @since 3.3.2
 * @since 3.4.2 echo set to false by default.
 *
 * @global stdClass $wpmem
 * @param  array    $args
 */
function wpmem_wp_login_form( $args ) {
	global $wpmem;
	$args['echo'] = ( ! isset( $args['echo'] ) ) ? false : $args['echo'];
	return $wpmem->forms->wp_login_form( $args );
}

/**
 * Invokes a registration or user profile update form.
 *
 * @since 3.2.0
 *
 * @global object $wpmem
 * @param  array  $args {
 *     Possible arguments for creating the form.
 *
 *     @type string id
 *     @type string tag
 *     @type string form
 *     @type string product
 *     @type string include_fields
 *     @type string exclude_fields
 *     @type string redirect_to
 *     @type string heading
 * }
 * @return string $html
 */
function wpmem_register_form( $args = 'new' ) {
  global $wpmem;
  return $wpmem->forms->register_form( $args );
}

/**
 * Change Password Form.
 *
 * @since 3.3.0 Replaces wpmem_inc_changepassword().
 * @since 3.3.0 Added $action argument.
 *
 * @global stdClass $wpmem   The WP_Members object.
 *
 * @param  string   $action  Determine if it is password change or reset.
 * @return string   $str     The generated html for the change password form.
 */
function wpmem_change_password_form() {
	global $wpmem;
	return $wpmem->forms->do_shortform( 'changepassword' );
}

/**
 * Reset Password Form.
 *
 * @since 3.3.0 Replaced wpmem_inc_resetpassword().
 *
 * @global object $wpmem The WP_Members object.
 * @return string $str   The generated html fo the reset password form.
 */
function wpmem_reset_password_form() { 
	global $wpmem;
	return $wpmem->forms->do_shortform( 'resetpassword' );
}

/**
 * Forgot Username Form.
 *
 * @since 3.3.0 Replaced wpmem_inc_forgotusername().
 *
 * @global object $wpmem The WP_Members object class.
 * @return string $str   The generated html for the forgot username form.
 */
function wpmem_forgot_username_form() {
	global $wpmem;
	return $wpmem->forms->do_shortform( 'forgotusername' );
}

/**
 * Add registration fields to the native WP registration.
 *
 * @since 2.8.3
 * @since 3.1.8 Added $process argument.
 * @since 3.3.0 Moved to forms API.
 *
 * @global  stdClass  $wpmem
 * @param   string    $process
 */
function wpmem_wp_register_form( $process = 'register_wp' ) {
	global $wpmem;
	$wpmem->forms->wp_register_form( $process );
}

/**
 * Add registration fields to WooCommerce registration.
 *
 * As of WooCommerce 3.0, the WC registration process no longer includes the
 * WP register_form action hook.  It only includes woocommerce_register_form.
 * In previous versions, WP-Members hooked to register_form for both WP and
 * WC registration. To provide backward compatibility with users who may
 * continue to use updated WP-Members with pre-3.0 WooCommerce, this function
 * checks for WC version and if it is older than 3.0 it will ignore adding
 * the WP-Members form fields as they would have already been added when the
 * register_form action hook fired.
 *
 * @since 3.1.8
 * @since 3.3.0 Moved to forms API.
 *
 * @global  stdClass  $woocommerce
 */
function wpmem_woo_register_form() {
	if ( class_exists( 'WooCommerce' ) ) {
		global $woocommerce;
		if ( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
			wpmem_wp_register_form( 'woo' );
		}
	}
}

/**
 * Alias for $wpmem->create_form_field().
 *
 * @since 3.1.2
 * @since 3.2.0 Accepts wpmem_create_formfield() arguments.
 *
 * @global object $wpmem    The WP_Members object class.
 * @param string|array  $args {
 *     @type string  $name        (required) The field meta key.
 *     @type string  $type        (required) The field HTML type (url, email, image, file, checkbox, text, textarea, password, hidden, select, multiselect, multicheckbox, radio).
 *     @type string  $value       (optional) The field's value (can be a null value).
 *     @type string  $compare     (optional) Compare value.
 *     @type string  $class       (optional) Class identifier for the field.
 *     @type boolean $required    (optional) If a value is required default: true).
 *     @type string  $delimiter   (optional) The field delimiter (pipe or comma, default: | ).
 *     @type string  $placeholder (optional) Defines the placeholder attribute.
 *     @type string  $pattern     (optional) Adds a regex pattern to the field (HTML5).
 *     @type string  $title       (optional) Defines the title attribute.
 *     @type string  $min         (optional) Adds a min attribute (HTML5).
 *     @type string  $max         (optional) Adds a max attribute (HTML5).
 *     @type string  $rows        (optional) Adds rows attribute to textarea.
 *     @type string  $cols        (optional) Adds cols attribute to textarea.
 * }
 * @param  string $type     The field type.
 * @param  string $value    The default value for the field.
 * @param  string $valtochk Optional for comparing the default value of the field.
 * @param  string $class    Optional for setting a specific CSS class for the field.
 * @return string           The HTML of the form field.
 */
//function wpmem_form_field( $args ) {
function wpmem_form_field( $name, $type=null, $value=null, $valtochk=null, $class='textbox' ) {
	global $wpmem;
	if ( is_array( $name ) ) {
		$args = $name;
	} else {
		$args = array(
			'name'     => $name,
			'type'     => $type,
			'value'    => $value,
			'compare'  => $valtochk,
			'class'    => $class,
		);
	}
	return $wpmem->forms->create_form_field( $args );
}

/**
 * Wrapper for $wpmem->create_form_label().
 *
 * @since 3.1.7
 *
 * @global object $wpmem
 * @param array  $args {
 *     @type string $meta_key
 *     @type string $label
 *     @type string $type
 *     @type string $id         (optional)
 *     @type string $class      (optional)
 *     @type string $required   (optional)
 *     @type string $req_mark   (optional)
 * }
 * @return string The HTML of the form label.
 */
function wpmem_form_label( $args ) {
	global $wpmem;
	return $wpmem->forms->create_form_label( $args );
}

/**
 * Wrapper to get form fields.
 *
 * @since 3.1.1
 * @since 3.1.5 Checks if fields array is set or empty before returning.
 * @since 3.1.7 Added wpmem_form_fields filter.
 * @since 3.3.9 load_fields() moved to forms object class.
 *
 * @global object $wpmem  The WP_Members object.
 * @param  string $tag    The action being used (default: null).
 * @param  string $form   The form being generated.
 * @return array  $fields The form fields.
 */
function wpmem_fields( $tag = '', $form = 'default' ) {
	global $wpmem;
	// Load fields if none are loaded.
	if ( ! isset( $wpmem->fields ) || empty( $wpmem->fields ) ) {
		$wpmem->forms->load_fields( $form );
	}
	
	// @todo Review for removal.
	$tag = $wpmem->convert_tag( $tag );
	
	/**
	 * Filters the fields array.
	 *
	 * @since 3.1.7
	 * @since 3.3.2 Change object var and return.
	 * @since 3.4.2 Added $form parameter.
	 *
	 * @param  array  $wpmem->fields
	 * @param  string $tag  (optional)
	 * @param  string $form (optional)
	 */
	$wpmem->fields = apply_filters( 'wpmem_fields', $wpmem->fields, $tag, $form );
	
	return $wpmem->fields;
}

/**
 * Sanitizes classes passed to the WP-Members form building functions.
 *
 * This generally uses just sanitize_html_class() but allows for 
 * whitespace so multiple classes can be passed (such as "regular-text code").
 * This is an API wrapper for WP_Members_Forms::sanitize_class().
 *
 * @since 3.2.9
 * @since 3.4.0 Now an alias for rktgk_sanitize_class().
 *
 * @global  object $wpmem
 *
 * @param	string $class
 * @return	string sanitized_class
 */
function wpmem_sanitize_class( $class ) {
	return rktgk_sanitize_class( $class );
}

/**
 * Sanitizes the text in an array.
 *
 * This is an API wrapper for WP_Members_Forms::sanitize_array().
 *
 * @since 3.2.9
 * @since 3.3.7 Added optional $type
 * @since 3.4.0 Now an alias for rktgk_sanitize_array().
 *
 * @global  object $wpmem
 *
 * @param  array  $data
 * @param  string $type The data type integer|int (default: false)
 * @return array  $data
 */
function wpmem_sanitize_array( $data, $type = false ) {
	return rktgk_sanitize_array( $data, $type );
}

/**
 * A multi use sanitization function.
 *
 * @since 3.3.0
 * @since 3.4.2 Added text, url, array, class as accepted $type
 *
 * @global  object  $wpmem
 *
 * @param  string $data
 * @param  string $type (text|array|multiselect|multicheckbox|textarea|email|file|image|int|integer|number|url|class) Default:text
 * @return string $sanitized_data
 */
function wpmem_sanitize_field( $data, $type = 'text' ) {
	return rktgk_sanitize_field( $data, $type );
}

/**
 * Generate a form nonce.
 *
 * @since 3.3.0
 *
 * @param   string    $nonce
 * @param   boolean   $echo
 * @return  string    The nonce.
 */
function wpmem_form_nonce( $nonce, $echo = false ) {
	$form = ( 'update' == $nonce || 'register' == $nonce ) ? 'longform' : 'shortform';
	return wp_nonce_field( 'wpmem_' . $form . '_nonce', '_wpmem_' . $nonce . '_nonce', true, $echo );
}

// @todo Experimental
/**
 * Create WP-Members fields set for woo checkout.
 *
 * @since 3.3.4
 *
 * @param array $checkout_fields
 */
function wpmem_woo_checkout_fields( $checkout_fields = false ) {
	$woo_checkout = array( 
		'billing_first_name',
		'billing_last_name',
		'billing_company',
		'billing_country',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_state',
		'billing_postcode',
		'billing_phone',
		'billing_email',
		'account_username',
		'account_password',
	);
	$fields = wpmem_fields();
	
	if ( ! $checkout_fields ) {
		$checkout_fields = WC()->checkout()->checkout_fields;
	}

	foreach ( $fields as $meta_key => $field ) {
		
		if ( 1 != $fields[ $meta_key ]['register'] ) {
			unset( $fields[ $meta_key ] );
		} else {
			if ( isset( $checkout_fields['billing'][ $meta_key ] ) ) {
				unset( $fields[ $meta_key ] );
			}
			if ( isset( $checkout_fields['shipping'][ $meta_key ] ) ) {
				unset( $fields[ $meta_key ] );
			}
			if ( isset( $checkout_fields['account'][ $meta_key ] ) ) {
				unset( $fields[ $meta_key ] );
			}
			if ( isset( $checkout_fields['order'][ $meta_key ] ) ) {
				unset( $fields[ $meta_key ] );
			}
		}
		
		// @todo For now, remove any unsupported field types.
		if ( 'hidden' == $field['type'] || 'image' == $field['type'] || 'file' == $field['type'] || 'membership' == $field['type'] ) {
			unset( $fields[ $meta_key ] );
		}
	}
	unset( $fields['username'] );
	unset( $fields['password'] );
	unset( $fields['confirm_password'] );
	unset( $fields['confirm_email'] );
	unset( $fields['user_email'] );
	unset( $fields['first_name'] );
	unset( $fields['last_name'] );

	return $fields;
}

/**
 * Adds WP-Members custom fields to woo checkout.
 *
 * @since 3.3.4
 *
 * @param array $checkout_fields
 */
function wpmem_woo_checkout_form( $checkout_fields ) {
	global $wpmem;
	$fields = wpmem_woo_checkout_fields( $checkout_fields );

	/**
	 * Filters the initial WC priority of the WP-members added fields.
	 *
	 * @since 3.3.7
	 *
	 * @param int
	 */
	$priority = apply_filters( 'wpmem_wc_checkout_field_priority_seed', 10 );
	
	foreach ( $fields as $meta_key => $field ) {
		$checkout_fields['order'][ $meta_key ] = array(
			'type'     => $fields[ $meta_key ]['type'],
			'label'    => ( 'tos' == $meta_key ) ? $wpmem->forms->get_tos_link( $field, 'woo' ) : $fields[ $meta_key ]['label'],
			'required' =>  $fields[ $meta_key ]['required'],
			'priority' => $priority,
		);
		if ( isset( $fields[ $meta_key ]['placeholder'] ) ) {
			$checkout_fields['order'][ $meta_key ]['placeholder'] = $fields[ $meta_key ]['placeholder'];
		}
		$priority = $priority + 10;
	}
	return $checkout_fields;
}

/**
 * Saves WP-Members custom fields for woo checkout.
 *
 * @since 3.3.4
 *
 * @param int $order_id
 */
function wpmem_woo_checkout_update_meta( $order_id ) {
	
	// Get user id from order.
	$order = wc_get_order( $order_id );
	$user_id = $order->get_user_id();
	
	$checkout_fields = WC()->checkout()->checkout_fields;
	$fields = wpmem_fields();
	foreach ( $fields as $meta_key => $field ) {
		if ( isset( $checkout_fields['order'][ $meta_key ] ) && isset( $_POST[ $meta_key ] ) ) {
			switch ( $fields[ $meta_key ]['type'] ) {
				case 'checkbox':
					update_user_meta( $user_id, $meta_key, $field['checked_value'] );
					break;
				case 'textarea':
					update_user_meta( $user_id, $meta_key, sanitize_textarea_field( $_POST[ $meta_key ] ) );
					break;
				case 'multicheckbox':
				case 'multiselect':
					update_user_meta( $user_id, $meta_key, wpmem_sanitize_array( $_POST[ $meta_key ] ) );
					break;
				case 'membership':
					wpmem_set_user_product( wpmem_sanitize_array( $_POST[ $meta_key ] ), $user_id );
					break;
				default:
					if ( 'user_url' == $meta_key ) {
						wp_update_user( array( 'ID' => $user_id, 'user_url' => sanitize_text_field( $_POST[ $meta_key ] ) ) );
					} else {
						update_user_meta( $user_id, $meta_key, sanitize_text_field( $_POST[ $meta_key ] ) );
					}
					break;
			}
		}
	}
}

/**
 * Adds WP-Members custom fields to woo profile update.
 *
 * @since 3.5.0
 *
 * @param array $checkout_fields
 */
function wpmem_woo_edit_account_form() {
	$fields = wpmem_woo_edit_account_fields();
	foreach ( $fields as $meta_key => $field ) { ?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="<?php echo $meta_key; ?>"><?php _e( $field['label'], 'wp-members' ); ?></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo wpmem_get_user_meta( get_current_user_id(), $meta_key ); ?>" />
		</p>
	<?php }
}

function wpmem_woo_edit_account_fields() {
	$fields = wpmem_fields();
	foreach ( $fields as $meta => $settings ) {
		if ( isset( $settings['wcupdate'] ) && true == $settings['wcupdate'] ) {
			$return_fields[ $meta ] = $settings;
		}
	}
	return $return_fields;
}

/**
 * Handle custom fields for WooCommerce.
 * 
 * @since Unknown
 * 
 * @param  string  $field
 * @param  string  $key    The field's meta key.
 * @param  array   $args
 * @param  string  $value
 * @param  string  $field
 */
function wpmem_form_field_wc_custom_field_types( $field, $key, $args, $value ) {

	$wpmem_fields = wpmem_fields();
	/**
	 * @type string  $name        (required) The field meta key.
	 * @type string  $type        (required) The field HTML type (url, email, image, file, checkbox, text, textarea, password, hidden, select, multiselect, multicheckbox, radio).
	 * @type string  $value       (optional) The field's value (can be a null value).
	 * @type string  $compare     (optional) Compare value.
	 * @type string  $class       (optional) Class identifier for the field.
	 * @type boolean $required    (optional) If a value is required default: true).
	 * @type string  $delimiter   (optional) The field delimiter (pipe or comma, default: | ).
	 * @type string  $placeholder (optional) Defines the placeholder attribute.
	 * @type string  $pattern     (optional) Adds a regex pattern to the field (HTML5).
	 * @type string  $title       (optional) Defines the title attribute.
	 * @type string  $min         (optional) Adds a min attribute (HTML5).
	 * @type string  $max         (optional) Adds a max attribute (HTML5).
	 * @type string  $rows        (optional) Adds rows attribute to textarea.
	 * @type string  $cols        (optional) Adds cols attribute to textarea.
	 */

	// Let's only mess with WP-Members fields (in case another checkout fields plugin is used).
	if ( array_key_exists( $key, $wpmem_fields ) ) {
		
		// If it is a checkbox.
		if ( 'checkbox' == $wpmem_fields[ $key ]['type'] ) {
			
			if ( ! $_POST && $wpmem_fields[ $key ]['checked_default'] ) {
				$field = str_replace( '<input type="checkbox"', '<input type="checkbox" checked ', $field );
			}

		} else {
		
			$field_args = array(
				'name' => $key,
				'type' => $wpmem_fields[ $key ]['type'],
				'required' => $wpmem_fields[ $key ]['required'],
				'delimiter' => $wpmem_fields[ $key ]['delimiter'],
				'value' => $wpmem_fields[ $key ]['values'],
			);

			$field_html = wpmem_form_field( $field_args );
			$field_html = str_replace( 'class="' . $wpmem_fields[ $key ]['type'] . '"', 'class="' . $wpmem_fields[ $key ]['type'] . '" style="display:initial;"', $field_html );
			$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .'" id="' . $key . '_field">
				<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . ( ( 1 == $wpmem_fields[ $key ]['required'] ) ? '&nbsp;<abbr class="required" title="required">*</abbr>' : '' ) . '</label>';
			$field .= $field_html;
			$field .= '</p>';
		}
		
	}
	
	return $field;  
}

function wpmem_woo_reg_validate( $username, $email, $errors ) {

	$fields = wpmem_woo_checkout_fields();
	
	unset( $fields['username'] );
	unset( $fields['password'] );
	unset( $fields['confirm_password'] );
	unset( $fields['user_email'] );
	unset( $fields['first_name'] );
	unset( $fields['last_name']  );
	
	foreach ( $fields as $key => $field_args ) {
		if ( 1 == $field_args['required'] && empty( $_POST[ $key ] ) ) {
			$message = sprintf( __( '%s is a required field.', 'wp-members' ), '<strong>' . $field_args['label'] . '</strong>' );
			$errors->add( $key, $message );
		}
	}
	return $errors;
}

function wpmem_is_reg_form_showing() {
	global $wpmem;
	return ( isset( $wpmem->reg_form_showing ) && true == $wpmem->reg_form_showing ) ? true : false;
}

/**
 * Returns the display value of certain field types.
 *
 * Some WP-Members field types may have a different "saved" value and
 * "displayed" value. This function provides a simple way to get the displayed
 * value for a field based on the saved value.
 *
 * @since 3.4.0
 * @since 3.4.2 Cleanup, completed support for all field types.
 *
 * @param  string  $field_meta  The meta key for the requested field.
 * @param  string  $value       The value to convert (empty for checkbox).
 * @param  boolean $echo        Whether to echo or return the value (default: false).
 * @return string
 */
function wpmem_field_display_value( $field_meta, $value = '', $echo = false ) {
	$fields = wpmem_fields();
	$type   = $fields[ $field_meta ]['type'];
	
	$display_value = ( 'checkbox' == $type ) ? $fields[ $field_meta ]['label'] : $fields[ $field_meta ]['options'][ $value ];
	
	/**
	 * Filter the value.
	 *
	 * @since 3.4.0
	 *
	 * @param  string  $display_value
	 * @param  string  $field_meta
	 * @param  string  $type
	 */
	$display_value = apply_filters( 'wpmem_' . $type . '_field_display', $display_value, $field_meta, $type );
	if ( $echo ) {
		echo $display_value;
	} else {
		return $display_value;
	}
}

function wpmem_checkbox_field_display( $field_meta, $echo = false ) {
	return wpmem_field_display_value( $field_meta, '', $echo );
}

function wpmem_select_field_display( $field_meta, $value, $echo = false ) {
	return wpmem_field_display_value( $field_meta, $value, $echo );
}