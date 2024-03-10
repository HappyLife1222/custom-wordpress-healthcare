<?php
$location_class           = "#iepa-wrap-" . $location_key;
$orientation_class        = ".iepa-orientation-" . $orientation;
$available_skin_class     = ".iepamega-" . $available_skin;
$available_skin_type      = "iepamega-" . $available_skin;
$main_id_wrapper          = $location_class . $orientation_class;
$main_id2_wrapper         = $location_class . $orientation_class . $available_skin_class;
$bgcolor                  = ( isset($custom_value['bgcolor']) && $custom_value['bgcolor'] != '' ) ? esc_attr( $custom_value['bgcolor'] ) : '';
$topmenubordercolor       = ( isset($custom_value['topmenubordercolor']) && $custom_value['topmenubordercolor'] != '') ? esc_attr( $custom_value['topmenubordercolor'] ) : '';
$menu_bordercolor         = ( isset($custom_value['menu_bordercolor']) && $custom_value['menu_bordercolor'] != '') ? esc_attr( $custom_value['menu_bordercolor'] ) : ''; //rgba(221,51,51,0.68)
$divider_color            = ( isset($custom_value['divider_color']) && $custom_value['divider_color'] != '') ? esc_attr( $custom_value['divider_color'] ) : '';
$menu_font_family         = ( isset($custom_value['menu_font_family']) && $custom_value['menu_font_family'] != '' && $custom_value['menu_font_family'] != 'theme-default' ) ? esc_attr( $custom_value['menu_font_family'] ) : '';
$menu_font_weight         = ( isset($custom_value['menu_font_weight']) && $custom_value['menu_font_weight'] != '' && $custom_value['menu_font_weight'] != 'theme_default' ) ? esc_attr( $custom_value['menu_font_weight'] ) : '';
$menu_fontsize            = ( isset($custom_value['menu_fontsize']) && $custom_value['menu_fontsize'] != '' ) ? esc_attr( $custom_value['menu_fontsize'] . 'px' ) : '13px';
$menu_fcolor              = ( isset($custom_value['menu_fcolor']) && $custom_value['menu_fcolor'] != '') ? esc_attr( $custom_value['menu_fcolor'] ) : '';
$active_bgcolor           = ( isset($custom_value['active_bgcolor']) && $custom_value['active_bgcolor'] != '' ) ? esc_attr( $custom_value['active_bgcolor'] ) : '';
$active_fcolor            = ( isset($custom_value['active_fcolor']) && $custom_value['active_fcolor'] != '') ? esc_attr( $custom_value['active_fcolor'] ) : '';
$eachmenu_bghovercolor    = ( isset($custom_value['eachmenu_bgcolor']) && $custom_value['eachmenu_bgcolor'] != '') ? esc_attr( $custom_value['eachmenu_bgcolor'] ) : '';
$eachmenu_fhcolor         = ( isset($custom_value['eachmenu_fhcolor']) && $custom_value['eachmenu_fhcolor'] != '') ? esc_attr( $custom_value['eachmenu_fhcolor'] ) : '';
$eachmenu_topbordercolor  = ( isset($custom_value['eachmenu_topbordercolor']) && $custom_value['eachmenu_topbordercolor'] != '' ) ? esc_attr( $custom_value['eachmenu_topbordercolor'] ) : '';
$megamenu_topborder       = ( isset($custom_value['megamenu_topborder']) && $custom_value['megamenu_topborder'] != '' ) ? esc_attr( $custom_value['megamenu_topborder'] ) : '';
$border_circlecolor       = ( isset($custom_value['eachmenu_border_circlecolor']) && $custom_value['eachmenu_border_circlecolor'] != '' ) ? esc_attr( $custom_value['eachmenu_border_circlecolor'] ) : '';

$padding_top              = (isset($custom_value['padding_top']) && $custom_value['padding_top'] != '') ? esc_attr($custom_value['padding_top']):'';
$padding_left             = (isset($custom_value['padding_left']) && $custom_value['padding_left'] != '') ? esc_attr($custom_value['padding_left']):'';
$padding_right            = (isset($custom_value['padding_right']) && $custom_value['padding_right'] != '') ? esc_attr($custom_value['padding_right']):'';
$padding_bottom           = (isset($custom_value['padding_bottom']) && $custom_value['padding_bottom'] != '') ? esc_attr($custom_value['padding_bottom']):'';

$padding_top_noicon         = (isset($custom_value['padding_top_noicon']) && $custom_value['padding_top_noicon'] != '')?esc_attr($custom_value['padding_top_noicon']):'';
$padding_left_noicon        = (isset($custom_value['padding_left_noicon']) && $custom_value['padding_left_noicon'] != '')?esc_attr($custom_value['padding_left_noicon']):'';
$padding_right_noicon       = (isset($custom_value['padding_right_noicon']) && $custom_value['padding_right_noicon'] != '')?esc_attr($custom_value['padding_right_noicon']):'';
$padding_bottom_noicon      = (isset($custom_value['padding_bottom_noicon']) && $custom_value['padding_bottom_noicon'] != '')?esc_attr($custom_value['padding_bottom_noicon']):'';

//menu icon settings
$iconcolor                  = (isset($custom_value['iconcolor']) && $custom_value['iconcolor'] != '')?esc_attr($custom_value['iconcolor']):'';
$icon_hcolor                = (isset($custom_value['icon_hcolor']) && $custom_value['icon_hcolor'] != '')?esc_attr($custom_value['icon_hcolor']):'';
$icon_bgcolor               = (isset($custom_value['icon_bgcolor']) && $custom_value['icon_bgcolor'] != '')?esc_attr($custom_value['icon_bgcolor']):'';
$icon_bghcolor              = (isset($custom_value['icon_bghcolor']) && $custom_value['icon_bghcolor'] != '')?esc_attr($custom_value['icon_bghcolor']):'';
//flyout menu
$flyoutmenu_fcolor          = (isset($custom_value['flyoutmenu_fcolor']) && $custom_value['flyoutmenu_fcolor'] != '')?esc_attr($custom_value['flyoutmenu_fcolor']):'';
$flyoutmenu_fhcolor         = (isset($custom_value['flyoutmenu_fhcolor']) && $custom_value['flyoutmenu_fhcolor'] != '')?esc_attr($custom_value['flyoutmenu_fhcolor']):'';
$flyoutmenu_ucolor          = (isset($custom_value['flyoutmenu_ucolor']) && $custom_value['flyoutmenu_ucolor'] != '')?esc_attr($custom_value['flyoutmenu_ucolor']):'';
$flyoutmenu_bghcolor        = (isset($custom_value['flyoutmenu_bghcolor']) && $custom_value['flyoutmenu_bghcolor'] != '')?esc_attr($custom_value['flyoutmenu_bghcolor']):'';
$flyoutmenu_bgcolor         = (isset($custom_value['flyoutmenu_bgcolor']) && $custom_value['flyoutmenu_bgcolor'] != '')?esc_attr($custom_value['flyoutmenu_bgcolor']):'';
//mega menu content
$headertitle_fcolor         = (isset($custom_value['headertitle_fcolor']) && $custom_value['headertitle_fcolor'] != '')?esc_attr($custom_value['headertitle_fcolor']):'';
$underline_color            = (isset($custom_value['underline_color']) && $custom_value['underline_color'] != '')?esc_attr($custom_value['underline_color']):'';
$header_title_fsize         = (isset($custom_value['header_title_fsize']) && $custom_value['header_title_fsize'] != '')?intval($custom_value['header_title_fsize']):'';
$header_title_bgcolor       = (isset($custom_value['header_title_bgcolor']) && $custom_value['header_title_bgcolor'] != '')?esc_attr($custom_value['header_title_bgcolor']):'';

$submenu_fsize              = (isset($custom_value['submenu_fsize']) && $custom_value['submenu_fsize'] != '') ? intval( esc_attr( $custom_value['submenu_fsize'] ) ) : '';

$submenu_fcolor             = (isset($custom_value['submenu_fcolor']) && $custom_value['submenu_fcolor'] != '') ? esc_attr($custom_value['submenu_fcolor']):'';
$submenu_fhcolor            = (isset($custom_value['submenu_fhcolor']) && $custom_value['submenu_fhcolor'] != '')?esc_attr($custom_value['submenu_fhcolor']):'';
$submenu_border_ucolor      = (isset($custom_value['submenu_border_ucolor']) && $custom_value['submenu_border_ucolor'] != '')?esc_attr($custom_value['submenu_border_ucolor']):'';
$submenu_bghcolor           = (isset($custom_value['submenu_bghcolor']) && $custom_value['submenu_bghcolor'] != '')?esc_attr($custom_value['submenu_bghcolor']):'';
//mega menu
$megamenu_bgcolor           = (isset($custom_value['megamenu_bgcolor']) && $custom_value['megamenu_bgcolor'] != '')?esc_attr($custom_value['megamenu_bgcolor']):'';
//menu label
$menu_label_bradius         = (isset($custom_value['menu_label_bradius']) && $custom_value['menu_label_bradius'] != '')?esc_attr($custom_value['menu_label_bradius']):'';
$menu_label_fcolor          = (isset($custom_value['menu_label_fcolor']) && $custom_value['menu_label_fcolor'] != '')?esc_attr($custom_value['menu_label_fcolor']):'';
$menu_label_bgcolor         = (isset($custom_value['menu_label_bgcolor']) && $custom_value['menu_label_bgcolor'] != '')?esc_attr($custom_value['menu_label_bgcolor']):'';
$menu_label_text_transform  = (isset($custom_value['menu_label_text_transform']) && $custom_value['menu_label_text_transform'] != '')?esc_attr($custom_value['menu_label_text_transform']):'';
$menu_label_arrowcolor      = (isset($custom_value['menu_label_arrowcolor']) && $custom_value['menu_label_arrowcolor'] != '')?esc_attr($custom_value['menu_label_arrowcolor']):'';


$margin_top                 = (isset($custom_value['margin_top']) && $custom_value['margin_top'] != '')?esc_attr($custom_value['margin_top']):'';
$margin_left                = (isset($custom_value['margin_left']) && $custom_value['margin_left'] != '')?esc_attr($custom_value['margin_left']):'';
$margin_right               = (isset($custom_value['margin_right']) && $custom_value['margin_right'] != '')?esc_attr($custom_value['margin_right']):'';
$margin_bottom              = (isset($custom_value['margin_bottom']) && $custom_value['margin_bottom'] != '')?esc_attr($custom_value['margin_bottom']):'';
//social
$sicon_padding_top          = (isset($custom_value['sicon_padding_top']) && $custom_value['sicon_padding_top'] != '')?esc_attr($custom_value['sicon_padding_top']):'';
$sicon_padding_left         = (isset($custom_value['sicon_padding_left']) && $custom_value['sicon_padding_left'] != '')?esc_attr($custom_value['sicon_padding_left']):'';
$sicon_padding_right        = (isset($custom_value['sicon_padding_right']) && $custom_value['sicon_padding_right'] != '')?esc_attr($custom_value['sicon_padding_right']):'';
$sicon_padding_bottom       = (isset($custom_value['sicon_padding_bottom']) && $custom_value['sicon_padding_bottom'] != '')?esc_attr($custom_value['sicon_padding_bottom']):'';
$sicon_margin_top           = (isset($custom_value['sicon_margin_top']) && $custom_value['sicon_margin_top'] != '')?esc_attr($custom_value['sicon_margin_top']):'';
$sicon_margin_left          = (isset($custom_value['sicon_margin_left']) && $custom_value['sicon_margin_left'] != '')?esc_attr($custom_value['sicon_margin_left']):'';
$sicon_margin_right         = (isset($custom_value['sicon_margin_right']) && $custom_value['sicon_margin_right'] != '')?esc_attr($custom_value['sicon_margin_right']):'';
$sicon_margin_bottom        = (isset($custom_value['sicon_margin_bottom']) && $custom_value['sicon_margin_bottom'] != '')?esc_attr($custom_value['sicon_margin_bottom']):'';

$content .= '/*Custom CSS For '.$location_key.'*/';

//menu item with icon - class .iepamega-show-menu-icon
if( $padding_top != '' || $padding_right != '' || $padding_bottom != '' || $padding_left != ''  ) {
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.iepamega-show-menu-icon > a.iepa-mega-menu-link,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li.iepamega-show-menu-icon > a.iepa-logout-btn{
   padding:'.esc_attr($padding_top).' '.esc_attr($padding_right).' '.esc_attr($padding_bottom).' '.esc_attr($padding_left).';
 }';
}

//menu item with no icon - class .iepamega-hide-menu-icon
if($padding_top_noicon != '' || $padding_right_noicon != '' || $padding_bottom_noicon != '' || $padding_left_noicon != '' ){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.iepamega-hide-menu-icon > a.iepa-mega-menu-link,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li.iepamega-hide-menu-icon > a.iepa-logout-btn{
   padding:'.esc_attr($padding_top_noicon).' '.esc_attr($padding_right_noicon).' '.esc_attr($padding_bottom_noicon).' '.esc_attr($padding_left_noicon).';
 }';
}
if($margin_top != '' || $margin_right != '' || $margin_bottom != '' || $margin_left != '' ){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li > a.iepa-mega-menu-link,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li > a.iepa-logout-btn{
   margin:'.esc_attr($margin_top).' '.esc_attr($margin_right).' '.esc_attr($margin_bottom).' '.esc_attr($margin_left).';
 }';
}

//social icon menu type
if($sicon_padding_top != '' || $sicon_padding_right != '' || $sicon_padding_bottom != '' || $sicon_padding_left != '' ){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.imma-social-menu-item > a,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li.iepa-search-type > a{
   padding:'.esc_attr($sicon_padding_top).' '.esc_attr($sicon_padding_right).' '.esc_attr($sicon_padding_bottom).' '.esc_attr($sicon_padding_left).';
 }';
}
if($sicon_margin_top != '' || $sicon_margin_right != '' || $sicon_margin_bottom != '' || $sicon_margin_left != '' ){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.imma-social-menu-item > a,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li.iepa-search-type > a{
   margin:'.esc_attr($sicon_margin_top).' '.esc_attr($sicon_margin_right).' '.esc_attr($sicon_margin_bottom).' '.esc_attr($sicon_margin_left).';
 }';
}

if( $menu_font_family != '' || $menu_font_weight != '' || $menu_fontsize != '' || $menu_fcolor != '' ) {

  // Load Google Fonts Start
  if ( $menu_font_family != '' ) {
    $content .= ' @import url("https://fonts.googleapis.com/css2?family='.$menu_font_family;
    if ( $menu_font_weight == 'normal' ) {
      $content .= ':wght@400&';
    } elseif ( $menu_font_weight == 'bold' ) {
      $content .= ':wght@700&';
    } elseif ( $menu_font_weight == 'light' ) {
      $content .= ':wght@300&';
    } else {
      $content .= '&';
    }
    $content .= 'display=swap"); ';
  }
  // Load Google Fonts End

 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li > a.iepa-mega-menu-link,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li > a span.iepa-mega-menu-href-title{
   font-family:'.esc_attr($menu_font_family).';font-weight:'.esc_attr($menu_font_weight).';color:'.esc_attr($menu_fcolor).';font-size:'.esc_attr($menu_fontsize).';
 }';
}
if( $eachmenu_fhcolor != '' ) {
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li:hover > a,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li:hover > a > span.iepa-mega-menu-href-title{
   color:'.esc_attr($eachmenu_fhcolor).';
 }';
}
if( $active_fcolor != '' ) {
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a > span.iepa-mega-menu-href-title{
   color:'.esc_attr($active_fcolor).';
 }';
}

if($available_skin_type == 'iepamega-simple-mm-template'){

  if($megamenu_topborder != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-megamenu:hover > .iepa-sub-menu-wrap:before,'.$main_id2_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout:hover .iepa-sub-menu-wrapper:before{
     background-color:'.esc_attr($megamenu_topborder).';
   }';
	}
	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{
     background:'.esc_attr($bgcolor).';
     border:1px solid '.esc_attr($menu_bordercolor).';
   }';
	}
	if($divider_color != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li{
     border-left:1px solid'.esc_attr($divider_color).';
   }';
	}
	//flyoutmenu
	if($flyoutmenu_ucolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li > a > .iepa-mega-menu-href-title:after{background:'.esc_attr($flyoutmenu_ucolor).';}';
	}
	if($underline_color != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link{border-bottom:1px solid '.esc_attr($underline_color).';}';
    }
    if($submenu_border_ucolor != ''){
	 $content .= $main_id2_wrapper.' ul li ul li ul > li > a:after{border-bottom:1px solid '.esc_attr($submenu_border_ucolor).';}';
    }
    if($eachmenu_bghovercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover{background:'.esc_attr($eachmenu_bghovercolor).';}';
	}
	if($active_bgcolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a > span.iepa-mega-menu-href-title{background:'.esc_attr($active_bgcolor).';}';
	}


}else if($available_skin_type == 'iepamega-dark-orchid-mm-template'){

	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{
     background:'.esc_attr($bgcolor).';border:1px solid '.esc_attr($menu_bordercolor).';
   }';
	}
	if($divider_color != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li{
     border-left:1px solid'.esc_attr($divider_color).';
   }';
	}
	if($megamenu_bgcolor != ''){
	$content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.menu-item-has-children > a:before{
    border-bottom:12px solid'.esc_attr($megamenu_bgcolor).';
  }';
	}
	if($eachmenu_bghovercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover{
     background:'.esc_attr($eachmenu_bghovercolor).';
   }';
	}
	if($active_bgcolor != ''){
	 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a,'.$main_id_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a > span.iepa-mega-menu-href-title{
     background:'.esc_attr($active_bgcolor).';
   }';
	}

	if($submenu_bghcolor != ''){
	$content .= $main_id2_wrapper.' .iepa-mega-sub-menu li .iepa-sub-menu-wrapper.iepa_menu_1 li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_nav_menu li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_pages li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_categories li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .iepa-mega-sub-menu .widget_archive li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_meta li:hover,'.$main_id2_wrapper.' .iepa-sub-menu-wrapper.iepa-menu1 .iepa-mega-sub-menu li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_product_categories ul.product-categories li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_recent_comments li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_recent_entries li:hover{
    background:'.esc_attr($submenu_bghcolor).';
  }';
	}

}else if($available_skin_type == 'iepamega-modern-mm-template'){
	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{
     background:'.esc_attr($bgcolor).';
     border:1px solid '.esc_attr($menu_bordercolor).';
   }';
	}
	if($eachmenu_topbordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a:before,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li > a.iepa-mega-menu-link:before{
     background-color:'.esc_attr($eachmenu_topbordercolor).';
   }';
	}
	if($header_title_bgcolor != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link{
     background:'.esc_attr($header_title_bgcolor).';
   }';
	}
	if($header_title_bgcolor != ''){
	$brightness = 0.5; // 50% brighter
    $bright_color = IEPA_MM_Libary::colourBrightness($header_title_bgcolor,$brightness);
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{
     border-right:10px solid '.esc_attr($bright_color).';
   }';
	}
	if($eachmenu_bghovercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover{
     background:'.esc_attr($eachmenu_bghovercolor).';
   }';
	}
	if($active_bgcolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a > span.iepa-mega-menu-href-title{
     background:'.esc_attr($active_bgcolor).';
   }';
	}

}else if($available_skin_type == 'iepamega-highlighted-border-mm-template'){

	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li{
     background:'.esc_attr($bgcolor).';
     border:1px solid '.esc_attr($menu_bordercolor).';
   }';
	}

	if($underline_color != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{
     background:'.esc_attr($underline_color).';
   }';
    }
    if($submenu_border_ucolor != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrapper.iepa-menu1 .iepa-mega-sub-menu li.menu-item-depth-2 > a:before,'.$main_id2_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li.menu-item-has-children > a:before,'.$main_id2_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li > a:before{
     border-bottom:1px solid '.esc_attr($submenu_border_ucolor).';
   }';
    }

    if($megamenu_topborder != ''){
	 $content .= $main_id2_wrapper.' > ul.iepa-mega-wrapper > li > .iepa-sub-menu-wrapper,'.$main_id2_wrapper.' > ul.iepa-mega-wrapper > li > .iepa-sub-menu-wrap{
     border-top:5px solid '.esc_attr($megamenu_topborder).';
   }';
	}
	 if($megamenu_topborder != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.menu-item-has-children > a:before,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.menu-item-has-children > a:before{
     background-color:'.esc_attr($megamenu_topborder).';
   }';
	}
	if($eachmenu_bghovercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover{
     background:'.esc_attr($eachmenu_bghovercolor).';
   }';
	}
	if($active_bgcolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a > span.iepa-mega-menu-href-title{
     background:' . esc_attr($active_bgcolor).';
   }';
	}

}else if($available_skin_type == 'iepamega-advanced-magazine-mm-template'){
	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{
     background:'.esc_attr($bgcolor).';
     border:1px solid '.esc_attr($menu_bordercolor).';
   }';
	}
	if($border_circlecolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a.iepa-mega-menu-link,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.active-show >a.iepa-mega-menu-link,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover >a.iepa-mega-menu-link,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover > a.iepa-logout-btn{
     border:1px solid '.esc_attr($border_circlecolor).';
   }';
	}
	if($megamenu_topborder != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover .iepa-sub-menu-wrap{
     border-top:3px solid '.esc_attr($megamenu_topborder).';
   }';
	}
    if($underline_color != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{background: '.esc_attr($underline_color).';}';
    }

}else if($available_skin_type == 'iepamega-sporty-mm-template'){
	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{background:'.esc_attr($bgcolor).';border:1px solid '.esc_attr($menu_bordercolor).';}';
	}
	if($header_title_bgcolor != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link{background:'.esc_attr($header_title_bgcolor).';}';
	}
	if($header_title_bgcolor != ''){
	$brightness = 0.5; // 50% brighter
    $bright_color = IEPA_MM_Libary::colourBrightness($header_title_bgcolor,$brightness);
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{border-right:10px solid '.esc_attr($bright_color).';}';
	}
	if($megamenu_topborder != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li > a.iepa-mega-menu-link:before{background-color:'.esc_attr($megamenu_topborder).';}';
	}

}else if($available_skin_type == 'iepamega-unique-mm-template'){
	if($bgcolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{background:'.esc_attr($bgcolor).';}';
	}
	if($topmenubordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{border-top: 5px solid '.esc_attr($topmenubordercolor).';}';
	}
	if($underline_color != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{background:'.esc_attr($underline_color).';}';
    }

}else if($available_skin_type == 'iepamega-box-sized-mm-template'){
	if($submenu_bghcolor != ''){
	$content .= $main_id2_wrapper.' .iepa-mega-sub-menu li .iepa-sub-menu-wrapper.iepa_menu_1 li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_nav_menu li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_pages li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_categories li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .iepa-mega-sub-menu .widget_archive li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_meta li:hover,'.$main_id2_wrapper.' .iepa-sub-menu-wrapper.iepa-menu1 .iepa-mega-sub-menu li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_product_categories ul.product-categories li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_recent_comments li:hover,'.$main_id2_wrapper.' .iepa-mega-sub-menu .widget_recent_entries li:hover{
    background:'.esc_attr($submenu_bghcolor).';
  }';
	}
	if($bgcolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{
     background:'.esc_attr($bgcolor).';
   }';
	}
	if($eachmenu_bghovercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover{
     background:'.esc_attr($eachmenu_bghovercolor).';
   }';
	}
	if($underline_color != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{
     background:'.esc_attr($underline_color).';
   }';
    }

}else if($available_skin_type == 'iepamega-mini-mm-template'){
	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper{
     background:'.esc_attr($bgcolor).';
     border:1px solid '.esc_attr($menu_bordercolor).';
   }';
	}
	if($border_circlecolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item >a,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.active-show >a,'.$main_id2_wrapper.'  ul.iepa-mega-wrapper > li:hover >a{
     background:'.esc_attr($bgcolor).';
     border-right:1px solid '.esc_attr($border_circlecolor).';
   }';
	}
	if($divider_color != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li{
     border-right:1px solid '.esc_attr($divider_color).';
   }';
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.imma-social-menu-item,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.iepa-search-type{
     border-right:none;
   }';
	}
	if($megamenu_bgcolor != ''){
	$content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.menu-item-has-children > a:before{
    border-bottom:12px solid'.esc_attr($megamenu_bgcolor).';
  }';
	}
	if($underline_color != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:after,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:after{
     background:'.esc_attr($underline_color).';
   }';
    }
    if($flyoutmenu_bgcolor != ''){
		 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li.iepamega-menu-flyout.menu-item-has-children > a:before{
       border-bottom: 12px solid '.esc_attr($flyoutmenu_bgcolor).';
     }';
	}


}else if($available_skin_type == 'iepamega-orangebar-mm-template'){
   if($header_title_bgcolor != ''){
	 $content .= $main_id2_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title,'.$main_id2_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link{
     background:'.esc_attr($header_title_bgcolor).';
   }';
	}
	if($eachmenu_bghovercolor != ''){
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.current-menu-item > a,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.active-show > a,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li:hover > a{
     background:'.esc_attr($eachmenu_bghovercolor).';
   }';
	 $content .= $main_id2_wrapper.' ul.iepa-mega-wrapper > li.menu-item-has-children.active-show > a:before,'.$main_id2_wrapper.' ul.iepa-mega-wrapper > li.menu-item-has-children > a:before{border-top: 8px solid '.esc_attr($eachmenu_bghovercolor).';}';
	}


}else{
	if($bgcolor != '' || $menu_bordercolor != ''){
	 $content .= $main_id_wrapper.'{background:'.esc_attr($bgcolor).';border:1px solid '.esc_attr($menu_bordercolor).';}';
	}
	if($divider_color != ''){
	 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li > a.iepa-mega-menu-link:before{background:'.esc_attr($divider_color).';}';
	}

	if($eachmenu_bghovercolor != ''){
	 $content .= $main_id_wrapper.' .iepa-mega-wrapper > li:hover,'.$main_id_wrapper.' .iepa-mega-wrapper > li.current-menu-item{background:'.esc_attr($eachmenu_bghovercolor).';}';
	}
	if($underline_color != ''){
	 $content .= $main_id_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:before,'.$main_id_wrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link:before{background:'.esc_attr($underline_color).';}';
	}

}

/*common settings designs*/
/*header title megamenu start*/
if($headertitle_fcolor != ''){
	 $content .= $main_id_wrapper.' ul .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.menu-item-depth-1 > a > span,'.$main_id_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title{color:'.esc_attr($headertitle_fcolor).';}';
}
if($header_title_fsize != ''){
	 $content .= $main_id_wrapper.' ul .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.menu-item-depth-1 > a > span,'.$main_id_wrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title{
     font-size:' . intval( esc_attr( $header_title_fsize ) ) . 'px;
   }';
}
/*header title megamenu start*/
/*flyout menu start*/
if($flyoutmenu_fcolor != ''){
	 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul li a{color:'.esc_attr($flyoutmenu_fcolor).';}';
}
if($flyoutmenu_fhcolor != ''){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul li:hover a{color:'.esc_attr($flyoutmenu_fhcolor).';}';
}
if($flyoutmenu_bgcolor != ''){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li{
   background-color:'.esc_attr($flyoutmenu_bgcolor).';
 }';
}
if($flyoutmenu_bghcolor != ''){
 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li:hover{
   background-color:'.esc_attr($flyoutmenu_bghcolor).';
 }';
}
/*flyout menu end*/
/*icon menu start*/
if($iconcolor != ''){
	 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li > a i.iepa-mega-menu-icon{
     color:'.esc_attr($iconcolor).';
   }';
}
if($icon_hcolor != ''){
	 $content .= $main_id_wrapper.' ul.iepa-mega-wrapper > li:hover > a i.iepa-mega-menu-icon{
     color:'.esc_attr($icon_hcolor).';
   }';
}
/*icon menu end*/

if($submenu_fsize != ''){
	 $content .= $main_id_wrapper.' .iepa-sub-menu-wrap ul li{
     font-size:' . intval( esc_attr( $submenu_fsize ) ) . 'px;
     background:none;
   }';
}
if( $submenu_fcolor != '' ) {
	 $content .= $main_id_wrapper.' ul li ul li ul > li > a,'.$main_id_wrapper.' ul li ul li ul > li > a span{
     color:'.esc_attr($submenu_fcolor).';
   }';
}
if($submenu_fhcolor != ''){
	 $content .= $main_id_wrapper.' ul li ul li ul > li:hover > a,'.
	 $main_id_wrapper.' ul li ul li ul > li:hover > a span{
     color:'.esc_attr($submenu_fhcolor).';
   }';
}
if($megamenu_bgcolor != ''){
$content .= $main_id_wrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap{
  background:'.esc_attr($megamenu_bgcolor).';
}';
}

//menu label
if($menu_label_bradius != ''){
$content .= $main_id_wrapper.' .iepa-mega-menu-label{
  border-radius:'.esc_attr($menu_label_bradius).'px;
}';
}
if($menu_label_fcolor != ''){
$content .= $main_id_wrapper.' .iepa-mega-menu-label{
  color:'.esc_attr($menu_label_fcolor).';
}';
}
if($menu_label_bgcolor != ''){
$content .= $main_id_wrapper.' .iepa-mega-menu-label{
  background-color:'.esc_attr($menu_label_bgcolor).';
}';
}
if($menu_label_bgcolor != ''){
$content .= $main_id_wrapper.' .iepa-mega-menu-label,'.$main_id_wrapper.' .iepa-mega-menu-label::before{
  border-color:'.esc_attr($menu_label_bgcolor).' transparent transparent transparent;
}';
}
if($menu_label_text_transform != ''){
$content .= $main_id_wrapper.' .iepa-mega-menu-label{
  text-transform:'.esc_attr($menu_label_text_transform).';
}';
}
if($available_skin_type == 'iepamega-advanced-magazine-mm-template'){
    if($menu_label_arrowcolor != ''){
	 $content .= $main_id_wrapper.' .iepa-mega-menu-label{
     border: 1px solid ' . esc_attr( $menu_label_arrowcolor ) . ';
   }';
	 $content .= $main_id_wrapper.' .iepa-mega-menu-label:before{
     border-color:' . esc_attr( $menu_label_arrowcolor ) . ' transparent transparent transparent;
   }';
	}
}else{
	if($menu_label_arrowcolor != ''){
	 $content .= $main_id_wrapper.' .iepa-mega-menu-label:before{
     border-color:' . esc_attr($menu_label_arrowcolor) . '  transparent transparent transparent;
   }';
	}
}
$content .= '/*Custom CSS End For '.$location_key.'*/';
