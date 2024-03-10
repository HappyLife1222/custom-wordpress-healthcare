<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Styles For WP Pagenavi Addon
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Sfwppa_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'sfwppa_front_style') );		
		
		// Action to add style at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'sanpop_pro_admin_style' ) );	

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'sfwppa_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'sfwppa_add_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_front_style() {		
		
		// Registring and enqueing public css
		wp_register_style( 'sfwppa-public-style', SFWPPA_URL.'assets/css/sfwppa-style.css', array(), SFWPPA_VERSION );
		wp_enqueue_style( 'sfwppa-public-style' );
	}

	/**
	 * Function to add script at back side
	 * 
	 * @package search-and-navigation-popup
	 * @since 1.0.0
	 */
	function sanpop_pro_admin_style($hook){
	// Pages array
		$pages_array = array( 'toplevel_page_sfwppa-settings');
		
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Enqueu built in style for color picker
			if( wp_style_is( 'wp-color-picker', 'registered' ) ) { // Since WordPress 3.5
				wp_enqueue_style( 'wp-color-picker' );
			} else {
				wp_enqueue_style( 'farbtastic' );
			}

			// Registring admin script
			wp_register_style( 'wpspw-pro-admin-css', SFWPPA_URL.'assets/css/sfwppa-setting-admin.css', null, SFWPPA_VERSION );

			wp_enqueue_style( 'wpspw-pro-admin-css' );
		}
	}

	
	/**
	 * Function to add script at admin side
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_admin_script( $hook ) {
   	 	global $wp_version , $wp_query, $post_type;
	
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
			
		// Pages array
		$pages_array = array( 'toplevel_page_sfwppa-settings' );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook , $pages_array) ) {

			// Enqueu built-in script for color picker
			if( wp_script_is( 'wp-color-picker', 'registered' ) ) { // Since WordPress 3.5
				wp_enqueue_script( 'wp-color-picker' );
				
			} else {
				wp_enqueue_script( 'farbtastic' );
			}
				wp_register_script( 'sfwppa-admin-js', SFWPPA_URL .'assets/js/sfwppa-setting-admin.js' , array('jquery') , SFWPPA_VERSION, true );
				wp_localize_script( 'sfwppa-admin-js', 'sfwppaAdminjs', array(
																'new_ui' 	=> $new_ui,
																'reset_msg'	=> __('Click OK to reset all options. All settings will be lost!', 'styles-for-wp-pagenavi-addon'),
															));
				wp_enqueue_script( 'sfwppa-admin-js');
				wp_enqueue_media();
		}
	}
	
	/**
	 * Add custom css to head
	 * 
	 * @package Styles For WP Pagenavi Addon
	 * @since 1.0.0
	 */
	function sfwppa_add_custom_css() {
		global $sfwppa_options;

		$font_size 			= !empty($sfwppa_options['font_size']) 			? $sfwppa_options['font_size']			: '12';
		$font_color 		= !empty($sfwppa_options['font_color']) 		? $sfwppa_options['font_color']			: '#000000';
		$border_color 		= !empty($sfwppa_options['border_color']) 		? $sfwppa_options['border_color']		: '#dd3333';
		$active_bg_color 	= !empty($sfwppa_options['active_bg_color']) 	? $sfwppa_options['active_bg_color']	: '#dd3333';
		$hover_bg_color 	= !empty($sfwppa_options['hover_bg_color']) 	? $sfwppa_options['hover_bg_color']		: '#dd3333';		
		$active_text_color 	= !empty($sfwppa_options['active_text_color']) 	? $sfwppa_options['active_text_color']	: '#ffffff';
		$hover_text_color 	= !empty($sfwppa_options['hover_text_color']) 	? $sfwppa_options['hover_text_color']	: '#d1d1d1';
		$radius_padding 	= round($font_size/2);
		$layout_style 		= sfwppa_get_option('menu_arr');
		if($layout_style	== 'style-1'){
				$custom_css = '

		/************************************************************
						Style-1
		************************************************************/
		.sfwppa-navi-style.sfwppa-style-1 .sfwppa-pages, 
		.sfwppa-navi-style.sfwppa-style-1 .wp-pagenavi .current,
		.sfwppa-navi-style.sfwppa-style-1 .nav-links .current, 
		.sfwppa-navi-style.sfwppa-style-1 .nav-links .page-numbers{font-size: '.esc_attr($font_size).'px;color:'.esc_attr($font_color).'; border: 1px solid '.esc_attr($border_color).';}
		
		.sfwppa-navi-style.sfwppa-style-1 .nav-links .current,
		.sfwppa-navi-style.sfwppa-style-1 .wp-pagenavi .current{ background: '.esc_attr($active_bg_color).'; color:'.esc_attr($active_text_color).';  border-right: 1px solid '.esc_attr($border_color).';}
		
		.sfwppa-navi-style.sfwppa-style-1 .sfwppa-pages:hover, 
		.sfwppa-navi-style.sfwppa-style-1 .nav-links .page-numbers:hover { background: '.esc_attr($hover_bg_color).';  border: 1px solid '.esc_attr($border_color).'; color:'.esc_attr($hover_text_color).';}
		';
		}

		if($layout_style == 'style-2'){
				$custom_css = '
		/************************************************************
						Style-2
		************************************************************/
		.sfwppa-navi-style.sfwppa-style-2 span.sfwppa-pages,
		.sfwppa-navi-style.sfwppa-style-2 .nav-links .prev,
		.sfwppa-navi-style.sfwppa-style-2 .nav-links .next,
		.sfwppa-navi-style.sfwppa-style-2 .wp-pagenavi .current{border:0px ; color:'.esc_attr($font_color).' ;font-size: '.esc_attr($font_size).'px;}
		
		.sfwppa-navi-style.sfwppa-style-2 .nav-links .prev:hover,
		.sfwppa-navi-style.sfwppa-style-2 .nav-links .next:hover{color:'.esc_attr($hover_text_color).'}
		
		.sfwppa-navi-style.sfwppa-style-2 .sfwppa-link,
		.sfwppa-navi-style.sfwppa-style-2 a.sfwppa-pages,	
		.sfwppa-navi-style.sfwppa-style-2 .nav-links a.page-numbers,
		.sfwppa-navi-style.sfwppa-style-2 .sfwppa-current-page,
		.sfwppa-navi-style.sfwppa-style-2 .nav-links .current,		
		.sfwppa-navi-style.sfwppa-style-2 span.sfwppa-pages.sfwppa-extend,
		.sfwppa-navi-style.sfwppa-style-2 .page-numbers.dots,
		.sfwppa-navi-style.sfwppa-style-2 .wp-pagenavi .current{font-size: '.esc_attr($font_size).'px; color:'.esc_attr($font_color).'; display:inline-block; border: 1px solid '.esc_attr($border_color).'}
		
		.sfwppa-navi-style.sfwppa-style-2 .nav-links .current,
		.sfwppa-navi-style.sfwppa-style-2 .wp-pagenavi .current{ background: '.esc_attr($active_bg_color).'; color:'.esc_attr($active_text_color).';  border-right: 1px solid '.esc_attr($border_color).';}

		.sfwppa-navi-style.sfwppa-style-2 .nav-links a.page-numbers:hover,
		.sfwppa-navi-style.sfwppa-style-2 a.sfwppa-pages:hover,
		.sfwppa-navi-style.sfwppa-style-2 a.sfwppa-pages:hover{ background: '.esc_attr($hover_bg_color).';  border: 1px solid '.esc_attr($border_color).'; color:'.esc_attr($hover_text_color).';}
		
		.sfwppa-navi-style.sfwppa-style-2 span.sfwppa-pages.sfwppa-extend:hover { background: '.esc_attr($hover_bg_color).' !important;  border: 1px solid '.esc_attr($border_color).' !important; color:'.esc_attr($hover_text_color).' !important;}
		';
		}

		if($layout_style == 'style-3'){
				$custom_css = '
		/************************************************************
						Style-3
		************************************************************/
		.sfwppa-navi-style.sfwppa-style-3 span.sfwppa-pages,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .prev,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .next,
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-first,
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-last{color:'.esc_attr($font_color).' ; font-size: '.esc_attr($font_size).'px;  }
		.sfwppa-navi-style.sfwppa-style-3 a.sfwppa-pages:hover,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .prev:hover, .sfwppa-navi-style.sfwppa-style-3 .nav-links .next:hover,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .page-numbers:hover{color:'.esc_attr($hover_text_color).';}
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-link,
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-current-page,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .current,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .page-numbers
		{ color:'.$font_color.'; }
		
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-extend{ color:'.esc_attr($font_color).'; }
		
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .current{ background: '.esc_attr($active_bg_color).'; color:'.esc_attr($active_text_color).';  border: 1px solid '.esc_attr($border_color).';}
		
		.sfwppa-navi-style.sfwppa-style-3 a.sfwppa-pages:hover,
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-link:hover,
		.sfwppa-navi-style.sfwppa-style-3 .nav-links .page-numbers:hover,
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-current-page:hover,
		.sfwppa-navi-style.sfwppa-style-3 .sfwppa-extend:hover { background: '.esc_attr($hover_bg_color).'; color:'.esc_attr($hover_text_color).';}
		';
		}

		if($layout_style == 'style-4'){
				$custom_css = '
		/************************************************************
						Style-4
		************************************************************/
		.sfwppa-navi-style.sfwppa-style-4 span.sfwppa-pages,
		.sfwppa-navi-style.sfwppa-style-4 .nav-links .prev, 
		.sfwppa-navi-style.sfwppa-style-4 .nav-links .next,
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-first, 
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-last{color:'.esc_attr($font_color).' ; font-size: '.esc_attr($font_size).'px; }
		.sfwppa-navi-style.sfwppa-style-4 a.sfwppa-pages:hover,
		.sfwppa-navi-style.sfwppa-style-4 .nav-links .prev:hover, .sfwppa-navi-style.sfwppa-style-4 .nav-links .next:hover{color:'.esc_attr($hover_text_color).';}
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-link,
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-current-page,
		.sfwppa-navi-style.sfwppa-style-4 .current,
		.sfwppa-navi-style.sfwppa-style-4 .page-numbers
		{ color:'.esc_attr($font_color).'; border: 1px solid '.esc_attr($border_color).';}
		
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-pages.sfwppa-extend{ color:'.esc_attr($font_color).';border: 1px solid '.esc_attr($border_color).'; }
		
		.sfwppa-navi-style.sfwppa-style-4 .current{ background: '.esc_attr($active_bg_color).'; color:'.esc_attr($active_text_color).';  border: 1px solid '.esc_attr($border_color).';}
		.sfwppa-navi-style.sfwppa-style-4 .nav-links .page-numbers:hover,		
		.sfwppa-navi-style.sfwppa-style-4 a.sfwppa-pages:hover,
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-link:hover,
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-current-page:hover{ background: '.esc_attr($hover_bg_color).';  border: 1px solid '.esc_attr($border_color).'; color:'.esc_attr($hover_text_color).';}
		.sfwppa-navi-style.sfwppa-style-4 .sfwppa-pages.sfwppa-extend:hover { background: '.esc_attr($hover_bg_color).' !important;  border: 1px solid '.esc_attr($border_color).' !important; color:'.esc_attr($hover_text_color).' !important;}
		';
		}

		if($layout_style == 'style-5'){
				$custom_css = '
		/************************************************************
						Style-5
		************************************************************/		
		.sfwppa-navi-style.sfwppa-style-5 .nav-links, .sfwppa-navi-style.sfwppa-style-5 .wp-pagenavi{border:1px solid '.esc_attr($border_color).'; }		
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-link,
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-current-page,
		.sfwppa-navi-style.sfwppa-style-5 .current,
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-pages,
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-extend,
		.sfwppa-navi-style.sfwppa-style-5 .page-numbers{color:'.esc_attr($font_color).'; border-right: 1px solid '.esc_attr($border_color).'; font-size: '.esc_attr($font_size).'px;  }
		.sfwppa-navi-style.sfwppa-style-5 span.sfwppa-pages.sfwppa-extend{ border-right: 1px solid '.esc_attr($border_color).';}
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-link-previous, .sfwppa-navi-style.sfwppa-style-5 .sfwppa-first{ border-left: 1px solid '.esc_attr($border_color).';}
		.sfwppa-navi-style.sfwppa-style-5 .current{ background: '.esc_attr($active_bg_color).'; color:'.esc_attr($active_text_color).';  border-right: 1px solid '.esc_attr($border_color).';}

		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-link:hover,
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-current-page:hover,
		.sfwppa-navi-style.sfwppa-style-5 .sfwppa-extend:hover,
		.sfwppa-navi-style.sfwppa-style-5 a.sfwppa-pages:hover,
		.sfwppa-navi-style.sfwppa-style-5 a.page-numbers:hover { background: '.esc_attr($hover_bg_color).'; color:'.esc_attr($hover_text_color).';  border-right: 1px solid '.esc_attr($border_color).';}
		
		';
		}
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$sfwppa_script = new Sfwppa_Script();
