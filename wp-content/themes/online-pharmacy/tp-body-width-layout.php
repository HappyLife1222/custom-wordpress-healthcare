<?php

	$online_pharmacy_tp_theme_css = "";

	$online_pharmacy_theme_lay = get_theme_mod( 'online_pharmacy_tp_body_layout_settings','Full');
    if($online_pharmacy_theme_lay == 'Container'){
		$online_pharmacy_tp_theme_css .='body{';
			$online_pharmacy_tp_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$online_pharmacy_tp_theme_css .='}';
		$online_pharmacy_tp_theme_css .='.page-template-front-page .menubar{';
			$online_pharmacy_tp_theme_css .='position: static;';
		$online_pharmacy_tp_theme_css .='}';
		$online_pharmacy_tp_theme_css .='@media screen and (max-width:575px){';
		$online_pharmacy_tp_theme_css .='body{';
			$online_pharmacy_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left: 0px';
		$online_pharmacy_tp_theme_css .='} }';
		$online_pharmacy_tp_theme_css .='.scrolled{';
			$online_pharmacy_tp_theme_css .='width: auto; left:0; right:0;';
		$online_pharmacy_tp_theme_css .='}';
	}else if($online_pharmacy_theme_lay == 'Container Fluid'){
		$online_pharmacy_tp_theme_css .='body{';
			$online_pharmacy_tp_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$online_pharmacy_tp_theme_css .='}';
		$online_pharmacy_tp_theme_css .='.page-template-front-page .menubar{';
			$online_pharmacy_tp_theme_css .='width: 99%';
		$online_pharmacy_tp_theme_css .='}';
		$online_pharmacy_tp_theme_css .='@media screen and (max-width:575px){';
		$online_pharmacy_tp_theme_css .='body{';
			$online_pharmacy_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left:0px';
		$online_pharmacy_tp_theme_css .='} }';
		$online_pharmacy_tp_theme_css .='.scrolled{';
			$online_pharmacy_tp_theme_css .='width: auto; left:0; right:0;';
		$online_pharmacy_tp_theme_css .='}';
	}else if($online_pharmacy_theme_lay == 'Full'){
		$online_pharmacy_tp_theme_css .='body{';
			$online_pharmacy_tp_theme_css .='max-width: 100%;';
		$online_pharmacy_tp_theme_css .='}';
	}

    $online_pharmacy_scroll_position = get_theme_mod( 'online_pharmacy_scroll_top_position','Right');
    if($online_pharmacy_scroll_position == 'Right'){
        $online_pharmacy_tp_theme_css .='#return-to-top{';
            $online_pharmacy_tp_theme_css .='right: 20px;';
        $online_pharmacy_tp_theme_css .='}';
    }else if($online_pharmacy_scroll_position == 'Left'){
        $online_pharmacy_tp_theme_css .='#return-to-top{';
            $online_pharmacy_tp_theme_css .='left: 20px;';
        $online_pharmacy_tp_theme_css .='}';
    }else if($online_pharmacy_scroll_position == 'Center'){
        $online_pharmacy_tp_theme_css .='#return-to-top{';
            $online_pharmacy_tp_theme_css .='right: 50%;left: 50%;';
        $online_pharmacy_tp_theme_css .='}';
    }

		//Social icon Font size
		$online_pharmacy_social_icon_fontsize = get_theme_mod('online_pharmacy_social_icon_fontsize');
				$online_pharmacy_tp_theme_css .='.media-links i{';
		$online_pharmacy_tp_theme_css .='font-size: '.esc_attr($online_pharmacy_social_icon_fontsize).'px;';
				$online_pharmacy_tp_theme_css .='}';

		// site title and tagline font size option
		$online_pharmacy_site_title_font_size = get_theme_mod('online_pharmacy_site_title_font_size', 30);{
				$online_pharmacy_tp_theme_css .='.logo h1 a, .logo p a{';
		$online_pharmacy_tp_theme_css .='font-size: '.esc_attr($online_pharmacy_site_title_font_size).'px;';
				$online_pharmacy_tp_theme_css .='}';
		}

		$online_pharmacy_site_tagline_font_size = get_theme_mod('online_pharmacy_site_tagline_font_size', 15);{
				$online_pharmacy_tp_theme_css .='.logo p{';
		$online_pharmacy_tp_theme_css .='font-size: '.esc_attr($online_pharmacy_site_tagline_font_size).'px;';
				$online_pharmacy_tp_theme_css .='}';
		}

$online_pharmacy_footer_widget_image = get_theme_mod('online_pharmacy_footer_widget_image');
if($online_pharmacy_footer_widget_image != false){
$online_pharmacy_tp_theme_css .='#footer{';
	$online_pharmacy_tp_theme_css .='background: url('.esc_attr($online_pharmacy_footer_widget_image).');';
$online_pharmacy_tp_theme_css .='}';
}

//menu font size
$online_pharmacy_menu_font_size = get_theme_mod('online_pharmacy_menu_font_size', 10);{
$online_pharmacy_tp_theme_css .='.main-navigation a, .main-navigation li.page_item_has_children:after,.main-navigation li.menu-item-has-children:after{';
	$online_pharmacy_tp_theme_css .='font-size: '.esc_attr($online_pharmacy_menu_font_size).'px;';
$online_pharmacy_tp_theme_css .='}';
}

// menu text tranform
$online_pharmacy_menu_text_tranform = get_theme_mod( 'online_pharmacy_menu_text_tranform','Uppercase');
if($online_pharmacy_menu_text_tranform == 'Uppercase'){
$online_pharmacy_tp_theme_css .='.main-navigation a {';
	$online_pharmacy_tp_theme_css .='text-transform: uppercase;';
$online_pharmacy_tp_theme_css .='}';
}else if($online_pharmacy_menu_text_tranform == 'Lowercase'){
$online_pharmacy_tp_theme_css .='.main-navigation a {';
	$online_pharmacy_tp_theme_css .='text-transform: lowercase;';
$online_pharmacy_tp_theme_css .='}';
}
else if($online_pharmacy_menu_text_tranform == 'Capitalize'){
$online_pharmacy_tp_theme_css .='.main-navigation a {';
	$online_pharmacy_tp_theme_css .='text-transform: capitalize;';
$online_pharmacy_tp_theme_css .='}';
}

//return to header mobile				
$online_pharmacy_return_to_header_mob = get_theme_mod( 'online_pharmacy_return_to_header_mob',false);
if($online_pharmacy_return_to_header_mob == true && get_theme_mod( 'online_pharmacy_return_to_header',true) != true){
$online_pharmacy_tp_theme_css .='.return-to-header{';
	$online_pharmacy_tp_theme_css .='display:none;';
$online_pharmacy_tp_theme_css .='} ';
}
if($online_pharmacy_return_to_header_mob == true){
$online_pharmacy_tp_theme_css .='@media screen and (max-width:575px) {';
$online_pharmacy_tp_theme_css .='.return-to-header{';
	$online_pharmacy_tp_theme_css .='display:block;';
$online_pharmacy_tp_theme_css .='} }';
}else if($online_pharmacy_return_to_header_mob == false){
$online_pharmacy_tp_theme_css .='@media screen and (max-width:575px){';
$online_pharmacy_tp_theme_css .='.return-to-header{';
	$online_pharmacy_tp_theme_css .='display:none;';
$online_pharmacy_tp_theme_css .='} }';
}

//slider mobile	
$online_pharmacy_slider_buttom_mob = get_theme_mod( 'online_pharmacy_slider_buttom_mob',true);
if($online_pharmacy_slider_buttom_mob == true && get_theme_mod( 'online_pharmacy_slider_button',true) != true){
$online_pharmacy_tp_theme_css .='#slider .more-btn{';
	$online_pharmacy_tp_theme_css .='display:none;';
$online_pharmacy_tp_theme_css .='} ';
}
if($online_pharmacy_slider_buttom_mob == true){
$online_pharmacy_tp_theme_css .='@media screen and (max-width:575px) {';
$online_pharmacy_tp_theme_css .='#slider .more-btn{';
	$online_pharmacy_tp_theme_css .='display:block;';
$online_pharmacy_tp_theme_css .='} }';
}else if($online_pharmacy_slider_buttom_mob == false){
$online_pharmacy_tp_theme_css .='@media screen and (max-width:575px){';
$online_pharmacy_tp_theme_css .='#slider .more-btn{';
	$online_pharmacy_tp_theme_css .='display:none;';
$online_pharmacy_tp_theme_css .='} }';
}

//related post
$online_pharmacy_remove_related_post = get_theme_mod('online_pharmacy_remove_related_post',true);
if($online_pharmacy_remove_related_post == false){
	$online_pharmacy_tp_theme_css .='.related-post-block{';
		$online_pharmacy_tp_theme_css .='display: none;';
	$online_pharmacy_tp_theme_css .='}';
}

//related products
$online_pharmacy_related_product = get_theme_mod('online_pharmacy_related_product',true);
if($online_pharmacy_related_product == false){
	$online_pharmacy_tp_theme_css .='.related.products{';
		$online_pharmacy_tp_theme_css .='display: none;';
	$online_pharmacy_tp_theme_css .='}';
}

//======================= slider Content layout ===================== //

$online_pharmacy_slider_content_layout = get_theme_mod('online_pharmacy_slider_content_layout', 'CENTER-ALIGN'); 
$online_pharmacy_tp_theme_css .= '#slider .carousel-caption{';
switch ($online_pharmacy_slider_content_layout) {
    case 'LEFT-ALIGN':
        $online_pharmacy_tp_theme_css .= 'text-align:left; right: 45%; left: 20%';
        break;
    case 'CENTER-ALIGN':
        $online_pharmacy_tp_theme_css .= 'text-align:center; right: 45%; left: 20%';
        break;
    case 'RIGHT-ALIGN':
        $online_pharmacy_tp_theme_css .= 'text-align:right; right: 45%; left: 20%';
        break;
    default:
        $online_pharmacy_tp_theme_css .= 'text-align:center; right: 45%; left: 20%';
        break;
}
$online_pharmacy_tp_theme_css .= '}';

