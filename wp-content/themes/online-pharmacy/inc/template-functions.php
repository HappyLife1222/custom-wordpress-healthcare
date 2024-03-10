<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function online_pharmacy_body_classes( $online_pharmacy_classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$online_pharmacy_classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$online_pharmacy_classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$online_pharmacy_classes[] = 'online-pharmacy-customizer';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$online_pharmacy_classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$online_pharmacy_classes[] = 'has-sidebar';
	}

	return $online_pharmacy_classes;
}
add_filter( 'body_class', 'online_pharmacy_body_classes' );
