<?php


$medical_clinic_lite_custom_css = '';

	/*---------------------------text-transform-------------------*/

	$medical_clinic_lite_text_transform = get_theme_mod( 'menu_text_transform_medical_clinic_lite','CAPITALISE');
    if($medical_clinic_lite_text_transform == 'CAPITALISE'){

		$medical_clinic_lite_custom_css .='#main-menu ul li a{';

			$medical_clinic_lite_custom_css .='text-transform: capitalize ; font-size: 15px;';

		$medical_clinic_lite_custom_css .='}';

	}else if($medical_clinic_lite_text_transform == 'UPPERCASE'){

		$medical_clinic_lite_custom_css .='#main-menu ul li a{';

			$medical_clinic_lite_custom_css .='text-transform: uppercase ; font-size: 14px;';

		$medical_clinic_lite_custom_css .='}';

	}else if($medical_clinic_lite_text_transform == 'LOWERCASE'){

		$medical_clinic_lite_custom_css .='#main-menu ul li a{';

			$medical_clinic_lite_custom_css .='text-transform: lowercase ; font-size: 15px;';

		$medical_clinic_lite_custom_css .='}';
	}

	/*---------------------------Container Width-------------------*/

	$medical_clinic_lite_container_width = get_theme_mod('medical_clinic_lite_container_width');

			$medical_clinic_lite_custom_css .='body{';

				$medical_clinic_lite_custom_css .='width: '.esc_attr($medical_clinic_lite_container_width).'%; margin: auto;';

			$medical_clinic_lite_custom_css .='}';

	/*---------------------------Slider-content-alignment-------------------*/

	$medical_clinic_lite_slider_content_alignment = get_theme_mod( 'medical_clinic_lite_slider_content_alignment','LEFT-ALIGN');

	 if($medical_clinic_lite_slider_content_alignment == 'LEFT-ALIGN'){

			$medical_clinic_lite_custom_css .='.blog_box{';

				$medical_clinic_lite_custom_css .='text-align:left;';

			$medical_clinic_lite_custom_css .='}';


		}else if($medical_clinic_lite_slider_content_alignment == 'CENTER-ALIGN'){

			$medical_clinic_lite_custom_css .='.blog_box{';

				$medical_clinic_lite_custom_css .='text-align:center; right: 30%;left: 30%;';

			$medical_clinic_lite_custom_css .='}';


		}else if($medical_clinic_lite_slider_content_alignment == 'RIGHT-ALIGN'){

			$medical_clinic_lite_custom_css .='.blog_box{';

				$medical_clinic_lite_custom_css .='text-align:right; right: 15%;left: 55%;';

			$medical_clinic_lite_custom_css .='}';

		}

		/*---------------------------Copyright Text alignment-------------------*/

$medical_clinic_lite_copyright_text_alignment = get_theme_mod( 'medical_clinic_lite_copyright_text_alignment','LEFT-ALIGN');

 if($medical_clinic_lite_copyright_text_alignment == 'LEFT-ALIGN'){

		$medical_clinic_lite_custom_css .='.copy-text p{';

			$medical_clinic_lite_custom_css .='text-align:left;';

		$medical_clinic_lite_custom_css .='}';


	}else if($medical_clinic_lite_copyright_text_alignment == 'CENTER-ALIGN'){

		$medical_clinic_lite_custom_css .='.copy-text p{';

			$medical_clinic_lite_custom_css .='text-align:center;';

		$medical_clinic_lite_custom_css .='}';


	}else if($medical_clinic_lite_copyright_text_alignment == 'RIGHT-ALIGN'){

		$medical_clinic_lite_custom_css .='.copy-text p{';

			$medical_clinic_lite_custom_css .='text-align:right;';

		$medical_clinic_lite_custom_css .='}';

	}

	/*---------------------------related Product Settings-------------------*/


$medical_clinic_lite_related_product_setting = get_theme_mod('medical_clinic_lite_related_product_setting',true);

	if($medical_clinic_lite_related_product_setting == false){

		$medical_clinic_lite_custom_css .='.related.products, .related h2{';

			$medical_clinic_lite_custom_css .='display: none;';

		$medical_clinic_lite_custom_css .='}';
	}


		/*---------------------------Scroll to Top Alignment Settings-------------------*/

	$medical_clinic_lite_scroll_top_position = get_theme_mod( 'medical_clinic_lite_scroll_top_position','Right');

	if($medical_clinic_lite_scroll_top_position == 'Right'){

		$medical_clinic_lite_custom_css .='.scroll-up{';

			$medical_clinic_lite_custom_css .='right: 20px;';

		$medical_clinic_lite_custom_css .='}';

	}else if($medical_clinic_lite_scroll_top_position == 'Left'){

		$medical_clinic_lite_custom_css .='.scroll-up{';

			$medical_clinic_lite_custom_css .='left: 20px;';

		$medical_clinic_lite_custom_css .='}';

	}else if($medical_clinic_lite_scroll_top_position == 'Center'){

		$medical_clinic_lite_custom_css .='.scroll-up{';

			$medical_clinic_lite_custom_css .='right: 50%;left: 50%;';

		$medical_clinic_lite_custom_css .='}';
	}

		/*---------------------------Pagination Settings-------------------*/


$medical_clinic_lite_pagination_setting = get_theme_mod('medical_clinic_lite_pagination_setting',true);

	if($medical_clinic_lite_pagination_setting == false){

		$medical_clinic_lite_custom_css .='.nav-links{';

			$medical_clinic_lite_custom_css .='display: none;';

		$medical_clinic_lite_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$medical_clinic_lite_slider_opacity_color = get_theme_mod( 'medical_clinic_lite_slider_opacity_color','0.6');

	if($medical_clinic_lite_slider_opacity_color == '0'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.1'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.1';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.2'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.2';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.3'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.3';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.4'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.4';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.5'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.5';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.6'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.6';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.7'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.7';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.8'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.8';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '0.9'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.9';

		$medical_clinic_lite_custom_css .='}';

		}else if($medical_clinic_lite_slider_opacity_color == '1.0'){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.9';

		$medical_clinic_lite_custom_css .='}';

		}

	/*---------------------- Slider Image Overlay ------------------------*/

	$medical_clinic_lite_overlay_option = get_theme_mod('medical_clinic_lite_overlay_option', true);

	if($medical_clinic_lite_overlay_option == false){

		$medical_clinic_lite_custom_css .='.blog_inner_box img{';

			$medical_clinic_lite_custom_css .='opacity:0.6;';

		$medical_clinic_lite_custom_css .='}';
	}

	$medical_clinic_lite_slider_image_overlay_color = get_theme_mod('medical_clinic_lite_slider_image_overlay_color', true);

	if($medical_clinic_lite_slider_image_overlay_color != false){

		$medical_clinic_lite_custom_css .='.blog_inner_box{';

			$medical_clinic_lite_custom_css .='background-color: '.esc_attr($medical_clinic_lite_slider_image_overlay_color).';';

		$medical_clinic_lite_custom_css .='}';
	}

