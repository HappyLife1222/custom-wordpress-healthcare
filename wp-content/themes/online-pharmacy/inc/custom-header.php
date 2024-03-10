<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

function online_pharmacy_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'online_pharmacy_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'flex-width'  			 => true,
		'flex-height'  			 => true,
		'wp-head-callback'       => 'online_pharmacy_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'online_pharmacy_custom_header_setup' );

if ( ! function_exists( 'online_pharmacy_header_style' ) ) :
add_action( 'wp_enqueue_scripts', 'online_pharmacy_header_style' );
function online_pharmacy_header_style() {
	if ( get_header_image() ) :
	$custom_css = "
        .headerbox,.page-template-front-page .headerbox{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-position: center top;
			background-size: cover;
		}";
	   	wp_add_inline_style( 'online-pharmacy-style', $custom_css );
	endif;
}
endif;
