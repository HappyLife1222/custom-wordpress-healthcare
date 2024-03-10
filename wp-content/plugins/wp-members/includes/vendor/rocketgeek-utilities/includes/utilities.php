<?php
/**
 * This file is part of the RocketGeek Utility Functions library.
 *
 * This library is open source and Apache-2.0 licensed. I hope you find it
 * useful for your project(s). Attribution is appreciated ;-)
 *
 * @package    RocketGeek_Utilities
 * @subpackage RocketGeek_Utilities_Utilities
 * @version    1.0.2
 *
 * @link       https://github.com/rocketgeek/rocketgeek-utilities/
 * @author     Chad Butler <https://butlerblog.com>
 * @author     RocketGeek <https://rocketgeek.com>
 * @copyright  Copyright (c) 2023 Chad Butler
 * @license    Apache-2.0
 *
 * Copyright [2023] Chad Butler, RocketGeek
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     https://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if ( ! function_exists( 'rktgk_force_ssl' ) ):
/**
 * Forces a URL to be secure (ssl).
 *
 * @since 1.0.0
 *
 * @param  string $url URL to be make secure.
 * @return string      The secure URL.
 */
function rktgk_force_ssl( $url ) {
	return ( is_ssl() ) ? preg_replace( "/^http:/i", "https:", $url ) : $url;
}
endif;

if ( ! function_exists( 'rktgk_get_suffix' ) ):
/**
 * Determines whether to use a .min suffix for a script/style file.
 *
 * @since 1.0.0
 *
 * @param boolean $echo
 */
function rktgk_get_suffix( $echo = false ) {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';
	if ( true === $echo ) {
		echo $suffix;
		return;
	} else {
		return $suffix;
	}
}
endif;

if ( ! function_exists( 'rktgk_maybe_unserialize' ) ):
/**
 * Better unserialization than WP's maybe_unserialize().
 *
 * Sanitizes array output before returning. If the unserialized result is an
 * array, then it runs the result through wpmem_sanitize_array(), which 
 * sanitizes each individual array element.
 *
 * @since 1.0.0
 *
 * @param  mixed  $original
 * @return mixed  $original
 */
function rktgk_maybe_unserialize( $original ) {
	if ( is_serialized( $original ) ) { // don't attempt to unserialize data that wasn't serialized going in
		$original = unserialize( $original );
	}
	return ( is_array( $original ) ) ? wpmem_sanitize_array( $original ) : $original;
}
endif;

if ( ! function_exists( 'rktgk_maybe_wpautop' ) ):
/**
 * Run wpautop on content. Defaults to true.
 *
 * Useful for shortcodes that don't autop on their own.
 * Toggle boolean can be passed as a string without pre-filtering
 * since it runs rktgk_str_to_bool().
 * 
 * @since 1.0.0
 * 
 * @param  string  $content
 * @param  mixed   $do_autop
 * @return string  $content either autop'ed or not.
 */
function rktgk_maybe_wpautop( $content, $do_autop = true ) {
	return ( true === rktgk_str_to_bool( $do_autop ) ) ? wpautop( $content ) : $content;
}
endif;

if ( ! function_exists( 'rktgk_do_shortcode' ) ):
/**
 * Call a shortcode function by tag name.
 *
 * Use this function for directly calling a shortcode without using do_shortcode.
 * do_shortcode() runs an extensive regex that goes through every shortcode in
 * the WP global $shortcode_tags. That's a lot of processing wasted if all you
 * want to do is run a specific shortcode/function. Yes, you could run the callback
 * directly, but what if that callback is in a class instance method? This utlitiy
 * allows you to run a shortcode function directly, regardless of whether it is
 * a direct function or in a class. It comes from an article by J.D. Grimes on this
 * subject and I've provided a link to that article.
 *
 * @author J.D. Grimes
 * @link https://codesymphony.co/dont-do_shortcode/
 *
 * @since 1.0.0
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function rktgk_do_shortcode( $tag, array $atts = array(), $content = null ) {
 
	global $shortcode_tags;

	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}
endif;

if ( ! function_exists( 'rktgk_is_woo_active' ) ):
/**
 * Checks if WooCommerce is active.
 * 
 * @link https://woocommerce.com/document/query-whether-woocommerce-is-activated/
 *
 * @since 1.0.0
 *
 * @return boolean
 */
function rktgk_is_woo_active() {
	return ( class_exists( 'woocommerce' ) ) ? true : false;
}
endif;

if ( ! function_exists( 'rktgk_get_user_ip' ) ):
/**
 * Get user IP address.
 *
 * From Pippin.
 * @link https://gist.github.com/pippinsplugins/9641841
 *
 * @since 1.0.0
 *
 * @return string $ip.
 */
function rktgk_get_user_ip() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		//to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	$sanitized_ip = sanitize_text_field( $ip );

	/**
	 * Filter the IP result.
	 *
	 * @since 1.0.0
	 *
	 * @param string $sanitized_ip
	 */
	return apply_filters( 'rktgk_get_user_ip', $sanitized_ip );
}
endif;

if ( ! function_exists( 'rktgk_get_server_var' ) ) :
/**
 *  A getter for $_SERVER vars
 * 
 * @since 1.0.2
 * 
 * @param  string  $server_var
 * @return string
 */
function rktgk_get_server_var( $server_var ) {
	return ( isset( $_SERVER[ $server_var ] ) ) ? $_SERVER[ $server_var ] : '';
}
endif;

if ( ! function_exists( 'rktgk_get_script_uri' ) ) :
function rktgk_get_script_uri( $var = false ) {
	$url = rktgk_get_server_var( 'SCRIPT_URI' );
	if ( '' != $url ) {
		return $url;
	} else {
		$url = rktgk_get_server_var( 'REQUEST_URI' );
		if ( '' != $url ) {
			return $url;
		} else {
			return rktgk_get_server_var( 'SCRIPT_NAME' );
		}
	}
}
endif;

if ( ! function_exists( 'rktgk_build_html_tag' ) ) :
/**
 * Builds an HTML tag from provided attributes.
 * 
 * @since 1.0.2
 * 
 * @param  array  $args {
 *     An array of attributes to build the html tag.
 * 
 *     @type string  $tag              HTML tag to build.
 *     @type array   $attributes|$atts Array of attributes of the tag, keyed as the attribute name.
 *     @type string  $content          Content inside the wrapped tag (omit for self-closing tags).
 * }
 * @param boolean $echo
 */
function rktgk_build_html_tag( $args, $echo = false ) {
	
	// A list of self-closing tags (so $content is not used).
	$self_closing_tags = array( 'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr' );

	// Check for attributes and allow for shorthand "atts"
	if ( isset( $args['attributes'] ) ) {
		$attributes = $args['attributes'];
	} elseif ( isset( $args['atts'] ) ) {
		$attributes = $args['atts'];
	} else {
		$attributes = false;
	}

	// Assemble tag and attributes.
	$tag = '<' . esc_attr( $args['tag'] );
	if ( false != $attributes ) {
		foreach ( $attributes as $attribute => $value ) {
			// Sanitize classes.
			$value = ( 'class' == $attribute || 'id' == $attribute ) ? rktgk_sanitize_class( $value ) : $value;

			// Escape urls and remaining attributes.
			$esc_value = ( 'href' == $attribute ) ? esc_url( $value ) : esc_attr( $value );
			
			// Continue tag assembly.
			$tag .= ' ' . esc_attr( $attribute ) . '="' . $esc_value . '"';
		}
	}

	// If tag is self closing.
	if ( in_array( $args['tag'], $self_closing_tags ) ) {
		$tag .= ' />';
	} else {
		// If tag is a wrapped tag.
		$tag .= '>' . esc_html( $args['content'] ) . '</' . esc_attr( $args['tag'] ) . '>';
	}

	if ( $echo ) {
		echo $tag;
	} else {
		return $tag;
	}
}
endif;

if ( ! function_exists( 'rktgk_wc_checkout_fields' ) ):
function rktgk_wc_checkout_fields() {
	return array(
		// Billing checkout fields.
		'billing_first_name',
		'billing_last_name',
		'billing_company',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_postcode',
		'billing_country',
		'billing_state',
		'billing_email',
		'billing_phone',

		// Shipping checkout fields.
		'shipping_first_name',
		'shipping_last_name',
		'shipping_company',
		'shipping_address_1',
		'shipping_address_2',
		'shipping_city',
		'shipping_postcode',
		'shipping_country',
		'shipping_state',

		// Account checkout fields.
		'account_username',
		'account_passoword',
		'account_password-2',

		// Order checkout fields.
		'order_comments',
	);
}
endif;