<?php
/**
 * @package VW Healthcare
 * Setup the WordPress core custom header feature.
 *
 * @uses vw_healthcare_header_style()
*/
function vw_healthcare_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'vw_healthcare_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 2000,
		'height'                 => 200,
		'flex-width'    		 => true,
		'flex-height'    		 => true,
		'wp-head-callback'       => 'vw_healthcare_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'vw_healthcare_custom_header_setup' );

if ( ! function_exists( 'vw_healthcare_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see vw_healthcare_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'vw_healthcare_header_style' );

function vw_healthcare_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .middle-bar{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		    background-size: cover;
		}";
	   	wp_add_inline_style( 'vw-healthcare-basic-style', $custom_css );
	endif;
}
endif;