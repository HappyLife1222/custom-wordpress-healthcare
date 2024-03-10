<?php
$enable_shadow  = ( isset( $iepa_custom_theme['general']['enable_shadow'] ) && $iepa_custom_theme['general']['enable_shadow'] == 1 ) ? 1 : 0;
$shadow_color   = ( isset( $iepa_custom_theme['general']['shadow_color'] ) ) ? esc_attr( $iepa_custom_theme['general']['shadow_color'] ) : '#ffffff';
$zindex         = ( isset( $iepa_custom_theme['general']['zindex'] ) ) ? esc_attr( $iepa_custom_theme['general']['zindex'] ) : '999';
$line_height    = ( isset( $iepa_custom_theme['general']['line_height'] ) ) ? esc_attr( $iepa_custom_theme['general']['line_height'] ) : '1.5';

/* menu bar settings*/
$enable_menu_background     = ( isset( $iepa_custom_theme['menu_bar']['enable_menu_background'] ) && $iepa_custom_theme['menu_bar']['enable_menu_background'] == 1 ) ? 1 : 0;
$menu_background_from       = ( isset( $iepa_custom_theme['menu_bar']['menu_background_from'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['menu_background_from'] ) : '#121212';
$font_color                 = ( isset( $iepa_custom_theme['menu_bar']['font_color'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['font_color'] ) : '#ffffff';
$font_hover_color           = ( isset( $iepa_custom_theme['menu_bar']['font_hover_color'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['font_hover_color'] ) : '#000000';
$font_family                = ( isset( $iepa_custom_theme['menu_bar']['font_family'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['font_family'] ) : 'Open Sans';
$font_weight                = ( isset( $iepa_custom_theme['menu_bar']['font_weight'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['font_weight'] ) : 'normal';
$padding_top                = ( isset( $iepa_custom_theme['menu_bar']['padding_top'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['padding_top'] ) : '20px';
$padding_bottom             = ( isset( $iepa_custom_theme['menu_bar']['padding_bottom'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['padding_bottom'] ) : '25px';
$padding_left               = ( isset( $iepa_custom_theme['menu_bar']['padding_left'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['padding_left'] ) : '20px';
$padding_right              = ( isset( $iepa_custom_theme['menu_bar']['padding_right'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['padding_right'] ) : '22px';
$width                      = ( isset( $iepa_custom_theme['menu_bar']['width'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['width'] ) : '600px';
$border_radius_topleft      = ( isset( $iepa_custom_theme['menu_bar']['border_radius_topleft'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['border_radius_topleft'] ) : '0px';
$border_radius_topright     = ( isset( $iepa_custom_theme['menu_bar']['border_radius_topright'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['border_radius_topright'] ) : '0px';
$border_radius_bottomright  = ( isset( $iepa_custom_theme['menu_bar']['border_radius_bottomright'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['border_radius_bottomright'] ) : '0px';
$border_radius_bottomleft   = ( isset( $iepa_custom_theme['menu_bar']['border_radius_bottomleft'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['border_radius_bottomleft'] ) : '0px';
$border_color               = ( isset( $iepa_custom_theme['menu_bar']['border_color'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['border_color'] ) : '#121212';
$alignment                  = ( isset( $iepa_custom_theme['menu_bar']['alignment'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['alignment'] ) : 'left';
$margin_top                 = ( isset( $iepa_custom_theme['menu_bar']['margin_top'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['margin_top'] ) : '0px';
$margin_bottom              = ( isset( $iepa_custom_theme['menu_bar']['margin_bottom'] ) ) ? esc_attr( $iepa_custom_theme['menu_bar']['margin_bottom'] ) : '0px';

/* top menu settings*/
$enable_background_hover1 = ( isset( $iepa_custom_theme['top_menu']['enable_background_hover'] ) ) ? 1 : 0;
$background_hover_from1   = ( isset( $iepa_custom_theme['top_menu']['background_hover_from'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['background_hover_from'] ) : '#47a35b';
$bg_active_color1         = ( isset( $iepa_custom_theme['top_menu']['bg_active_color'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['bg_active_color'] ) : '';
$font_color_active1       = ( isset( $iepa_custom_theme['top_menu']['font_color_active'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['font_color_active'] ) : '#ffffff';
$font_size                = ( isset( $iepa_custom_theme['top_menu']['font_size'] ) && $iepa_custom_theme['top_menu']['font_size'] != '' && $iepa_custom_theme['top_menu']['font_size'] != '0px' ) ? esc_attr( $iepa_custom_theme['top_menu']['font_size'] ) : '13px';

$font_weight_hover1     = ( isset( $iepa_custom_theme['top_menu']['font_weight_hover'] ) && $iepa_custom_theme['top_menu']['font_weight_hover'] != '' && $iepa_custom_theme['top_menu']['font_weight_hover'] != 'default' ) ? esc_attr( $iepa_custom_theme['top_menu']['font_weight_hover'] ) : 'normal';
$transform              = ( isset( $iepa_custom_theme['top_menu']['transform'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['transform'] ) : 'initial';
$font_decoration1       = ( isset( $iepa_custom_theme['top_menu']['font_decoration'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['font_decoration'] ) : 'none';
$font_decoration_hover1 = ( isset( $iepa_custom_theme['top_menu']['font_decoration_hover'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['font_decoration_hover'] ) : 'none';


$enable_menu_divider  = ( isset( $iepa_custom_theme['top_menu']['enable_menu_divider'] ) && $iepa_custom_theme['top_menu']['enable_menu_divider'] == 1 ) ? 1 : 0;
$disable_menu_divider = ( isset( $iepa_custom_theme['top_menu']['disable_menu_divider'] ) && $iepa_custom_theme['top_menu']['disable_menu_divider'] == 1 ) ? 1 : 0;
$menu_divider_color   = ( isset( $iepa_custom_theme['top_menu']['menu_divider_color'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_divider_color'] ) : 'rgb(255,255,255)';
$opacity_glow         = ( isset( $iepa_custom_theme['top_menu']['opacity_glow'] ) && $iepa_custom_theme['top_menu']['opacity_glow'] != '' ) ? esc_attr( $iepa_custom_theme['top_menu']['opacity_glow'] ) : 1;

$enable_menu_label_bgcolor  = ( isset( $iepa_custom_theme['top_menu']['enable_menu_label_bgcolor'] ) && $iepa_custom_theme['top_menu']['enable_menu_label_bgcolor'] == 1 ) ? 1 : 0;
$menu_label_bgcolor         = ( isset( $iepa_custom_theme['top_menu']['menu_label_bgcolor'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_label_bgcolor'] ) : '';
$menu_label_fontcolor       = ( isset( $iepa_custom_theme['top_menu']['menu_label_fontcolor'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_label_fontcolor'] ) : '';
$menu_label_fontsize        = ( isset( $iepa_custom_theme['top_menu']['menu_label_fontsize'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_label_fontsize'] ) : '';
$menu_label_font_weight     = ( isset( $iepa_custom_theme['top_menu']['menu_label_font_weight'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_label_font_weight'] ) : '';
$menu_label_font_transform  = ( isset( $iepa_custom_theme['top_menu']['menu_label_font_transform'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_label_font_transform'] ) : 'initial';
$menu_label_font_family     = ( isset( $iepa_custom_theme['top_menu']['menu_label_font_family'] ) ) ? esc_attr( $iepa_custom_theme['top_menu']['menu_label_font_family'] ) : '';


/* megamenu bar settings*/
$enable_megamenu_background2  = ( isset( $iepa_custom_theme['megamenu_bar']['enable_megamenu_background'] ) && $iepa_custom_theme['megamenu_bar']['enable_megamenu_background'] == 1 ) ? 1 : 0;
$menu_background_from2        = ( isset( $iepa_custom_theme['megamenu_bar']['menu_background_from'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['menu_background_from'] ) : '#ffffff';
$width2                       = ( isset( $iepa_custom_theme['megamenu_bar']['width'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['width'] ) : '100%';
$padding_top2                 = ( isset( $iepa_custom_theme['megamenu_bar']['padding_top'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['padding_top'] ) : '15px';
$padding_bottom2              = ( isset( $iepa_custom_theme['megamenu_bar']['padding_bottom'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['padding_bottom'] ) : '5px';
$padding_left2                = ( isset( $iepa_custom_theme['megamenu_bar']['padding_left'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['padding_left'] ) : '8px';
$padding_right2               = ( isset( $iepa_custom_theme['megamenu_bar']['padding_right'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['padding_right'] ) : '8px';
$border_color2                = ( isset( $iepa_custom_theme['megamenu_bar']['border_color'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['border_color'] ) : '0px';
$border_radius2               = ( isset( $iepa_custom_theme['megamenu_bar']['border_radius'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['border_radius'] ) : '#ffffff';
$box_shadow2                  = ( isset( $iepa_custom_theme['megamenu_bar']['box_shadow'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['box_shadow'] ) : '0 3px 3px';
$box_shadow_color2            = ( isset( $iepa_custom_theme['megamenu_bar']['box_shadow_color'] ) ) ? esc_attr( $iepa_custom_theme['megamenu_bar']['box_shadow_color'] ) : 'rgba(0, 0, 0, 0.2)';

/* widget settings */
$font_color3 = (isset($iepa_custom_theme['widgets']['font_color']) && $iepa_custom_theme['widgets']['font_color'] != '' && $iepa_custom_theme['widgets']['font_color'] != '#00000')? esc_attr($iepa_custom_theme['widgets']['font_color']) :'#000000';
$font_hover_color3 = (isset($iepa_custom_theme['widgets']['font_hover_color']) && $iepa_custom_theme['widgets']['font_hover_color'] != '' && $iepa_custom_theme['widgets']['font_hover_color'] != '#00000') ? esc_attr( $iepa_custom_theme['widgets']['font_hover_color'] ) : '#000000';
$font_size3 = (isset($iepa_custom_theme['widgets']['font_size'])) ? esc_attr( $iepa_custom_theme['widgets']['font_size'] ) :'14px';
$font_weight3 = (isset($iepa_custom_theme['widgets']['font_weight'])) ? esc_attr( $iepa_custom_theme['widgets']['font_weight'] ) : 'bold';
$font_weight_hover3 = (isset($iepa_custom_theme['widgets']['font_weight_hover'])) ? esc_attr( $iepa_custom_theme['widgets']['font_weight_hover'] ) : 'bold';
$transform3 = (isset($iepa_custom_theme['widgets']['transform'])) ? esc_attr( $iepa_custom_theme['widgets']['transform'] ) : 'bold';
$font_family3 = (isset($iepa_custom_theme['widgets']['font_family'])) ? esc_attr( $iepa_custom_theme['widgets']['font_family'] ) : 'bold';
$font_decoration3 = (isset($iepa_custom_theme['widgets']['font_decoration'])) ? esc_attr( $iepa_custom_theme['widgets']['font_decoration'] ) : 'none';
$font_decoration_hover3 = (isset($iepa_custom_theme['widgets']['font_decoration_hover'])) ? esc_attr( $iepa_custom_theme['widgets']['font_decoration_hover'] ) : 'none';
$content_font_color3 = (isset($iepa_custom_theme['widgets']['content_font_color']) && $iepa_custom_theme['widgets']['content_font_color'] != '' && $iepa_custom_theme['widgets']['content_font_color'] != '#00000') ? esc_attr( $iepa_custom_theme['widgets']['content_font_color'] ) : '#000000';
$content_font_family3 = (isset($iepa_custom_theme['widgets']['content_font_family'])) ? esc_attr( $iepa_custom_theme['widgets']['content_font_family'] ) : 'Open Sans';
$margin_top3 = (isset($iepa_custom_theme['widgets']['margin_top']) && $iepa_custom_theme['widgets']['margin_top'] != '') ? esc_attr( $iepa_custom_theme['widgets']['margin_top'] . 'px' ) : '0px';
$margin_bottom3 = (isset($iepa_custom_theme['widgets']['margin_bottom']) && $iepa_custom_theme['widgets']['margin_bottom'] != '') ? esc_attr( $iepa_custom_theme['widgets']['margin_bottom'] . 'px' ) : '10px';

$widget_btnbgcolor = (isset($iepa_custom_theme['widgets']['button_bgcolor'])) ? esc_attr( $iepa_custom_theme['widgets']['button_bgcolor'] ) : '';
$widget_btnbghcolor = (isset($iepa_custom_theme['widgets']['button_bghcolor'])) ? esc_attr( $iepa_custom_theme['widgets']['button_bghcolor'] ) : '';
$widget_btnfcolor = (isset($iepa_custom_theme['widgets']['button_fcolor'])) ? esc_attr( $iepa_custom_theme['widgets']['button_fcolor'] ) : '';
$widget_btnfhcolor = (isset($iepa_custom_theme['widgets']['button_fhcolor'])) ? esc_attr( $iepa_custom_theme['widgets']['button_fhcolor'] ) : '';


/* Top Section settings */
$font_color4 = (isset($iepa_custom_theme['top_section']['font_color'])) ? esc_attr($iepa_custom_theme['top_section']['font_color']) : '#000000';
$font_size4 = (isset($iepa_custom_theme['top_section']['font_size']))? esc_attr( $iepa_custom_theme['top_section']['font_size'] ) :'13px';
$font_weight4 = (isset($iepa_custom_theme['top_section']['font_weight'])) ? esc_attr( $iepa_custom_theme['top_section']['font_weight'] ) : 'normal';
$transform4 = (isset($iepa_custom_theme['top_section']['transform'])) ? esc_attr( $iepa_custom_theme['top_section']['transform'] ) : 'initial';
$font_family4 = (isset($iepa_custom_theme['top_section']['font_family'])) ? esc_attr( $iepa_custom_theme['top_section']['font_family'] ) : 'Open Sans';
$image_margin_top4 = (isset($iepa_custom_theme['top_section']['image_margin_top'])) ? esc_attr( $iepa_custom_theme['top_section']['image_margin_top'] ) :'0px';
$image_margin_bottom4 = (isset($iepa_custom_theme['top_section']['image_margin_bottom'])) ? esc_attr( $iepa_custom_theme['top_section']['image_margin_bottom'] ) : '10px';
$image_margin_left4 = (isset($iepa_custom_theme['top_section']['image_margin_left'])) ? esc_attr( $iepa_custom_theme['top_section']['image_margin_left'] ) : '0px';
$image_margin_right4 = (isset($iepa_custom_theme['top_section']['image_margin_right'])) ? esc_attr( $iepa_custom_theme['top_section']['image_margin_right'] ) : '0px';


/* Bottom Section settings */
$font_color5 = (isset($iepa_custom_theme['bottom_section']['font_color'])) ? esc_attr( $iepa_custom_theme['bottom_section']['font_color'] ) :'#000000';
$font_size5 = (isset($iepa_custom_theme['bottom_section']['font_size'])) ? esc_attr( $iepa_custom_theme['bottom_section']['font_size'] ) : '13px';
$font_weight5 = (isset($iepa_custom_theme['bottom_section']['font_weight'])) ? esc_attr( $iepa_custom_theme['bottom_section']['font_weight'] ) : 'normal';
$transform5 = (isset($iepa_custom_theme['bottom_section']['transform'])) ? esc_attr( $iepa_custom_theme['bottom_section']['transform'] ) : 'initial';
$font_family5 = (isset($iepa_custom_theme['bottom_section']['font_family'])) ? esc_attr( $iepa_custom_theme['bottom_section']['font_family'] ) : 'Open Sans';
$image_margin_top5 = (isset($iepa_custom_theme['bottom_section']['image_margin_top'])) ? esc_attr( $iepa_custom_theme['bottom_section']['image_margin_top'] ) : '10px';
$image_margin_bottom5 = (isset($iepa_custom_theme['bottom_section']['image_margin_bottom'])) ? esc_attr( $iepa_custom_theme['bottom_section']['image_margin_bottom'] ) : '0px';
$image_margin_left5 = (isset($iepa_custom_theme['bottom_section']['image_margin_left'])) ? esc_attr( $iepa_custom_theme['bottom_section']['image_margin_left'] ) : '0px';
$image_margin_right5 = (isset($iepa_custom_theme['bottom_section']['image_margin_right'])) ? esc_attr( $iepa_custom_theme['bottom_section']['image_margin_right'] ) : '0px';


/* Flyout settings */
$enable_background6 = ( isset( $iepa_custom_theme['flyout']['enable_background'] ) ) ? 1 : 0;
$menu_bgcurrentcolor6 = (isset($iepa_custom_theme['flyout']['menu_bgcurrentcolor'])) ? esc_attr( $iepa_custom_theme['flyout']['menu_bgcurrentcolor'] ) : '#121212';
$menu_bg_hovercolor6 = (isset($iepa_custom_theme['flyout']['menu_bg_hovercolor'])) ? esc_attr( $iepa_custom_theme['flyout']['menu_bg_hovercolor'] ) : '#47a35b';
$font_color6 = (isset($iepa_custom_theme['flyout']['font_color'])) ? esc_attr( $iepa_custom_theme['flyout']['font_color'] ) : '#ffffff';
$font_hover_color6 = (isset($iepa_custom_theme['flyout']['font_hover_color'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['font_hover_color'] ) : '#ffffff';
$font_size6 = (isset($iepa_custom_theme['flyout']['font_size'])) ? esc_attr( $iepa_custom_theme['flyout']['font_size'] ) : '12px';
$font_weight6 = (isset($iepa_custom_theme['flyout']['font_weight'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['font_weight'] ) : 'normal';
$font_weight_hover6 = (isset($iepa_custom_theme['flyout']['font_weight_hover'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['font_weight_hover'] ) : 'normal';
$transform6 = (isset($iepa_custom_theme['flyout']['transform'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['transform'] ) : 'initial';
$font_family6 = (isset($iepa_custom_theme['flyout']['font_family'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['font_family'] ) : 'Open Sans';
$font_decoration6 = (isset($iepa_custom_theme['flyout']['font_decoration'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['font_decoration'] ) : 'none';
$font_decoration_hover6 = (isset($iepa_custom_theme['flyout']['font_decoration_hover'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['font_decoration_hover'] ) : 'none';
$item_margin6 = (isset($iepa_custom_theme['flyout']['item_margin'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['item_margin'] ) : '0px 5px';
$item_padding6 = (isset($iepa_custom_theme['flyout']['item_padding'])) ? esc_attr( $iepa_custom_theme['flyout']['item_padding'] ) : '10px';
$item_width6 = (isset($iepa_custom_theme['flyout']['item_width'] ) ) ? esc_attr( $iepa_custom_theme['flyout']['item_width'] ) : '210px';

/* Mobile settings */
$togglebar_enable_bgcolor = ( isset($iepa_custom_theme['mobile_settings']['togglebar_enable_bgcolor']) && $iepa_custom_theme['mobile_settings']['togglebar_enable_bgcolor'] == 1 ) ? 1 : 0;
$togglebar_background_from = (isset($iepa_custom_theme['mobile_settings']['togglebar_background_from'] ) ) ? esc_attr( $iepa_custom_theme['mobile_settings']['togglebar_background_from'] ) : '#121212';
$togglebar_height = (isset($iepa_custom_theme['mobile_settings']['togglebar_height'] ) ) ? esc_attr( $iepa_custom_theme['mobile_settings']['togglebar_height'] ) : '40px';
$resposive_breakpoint_width = (
  isset($iepa_custom_theme['mobile_settings']['resposive_breakpoint_width']) && $iepa_custom_theme['mobile_settings']['resposive_breakpoint_width'] != '' && $iepa_custom_theme['mobile_settings']['resposive_breakpoint_width'] != '910px' && $iepa_custom_theme['mobile_settings']['resposive_breakpoint_width'] != '910'
  ) ? esc_attr( $iepa_custom_theme['mobile_settings']['resposive_breakpoint_width'] ) : '910px';
$toggle_bar_content = (isset($iepa_custom_theme['mobile_settings']['toggle_bar_content'])) ? esc_attr( $iepa_custom_theme['mobile_settings']['toggle_bar_content'] ) : 'Menu';
$icon_color = (isset($iepa_custom_theme['mobile_settings']['icon_color'])) ? esc_attr( $iepa_custom_theme['mobile_settings']['icon_color'] ) : '#ffffff';
$text_color = (isset($iepa_custom_theme['mobile_settings']['text_color'] ) ) ? esc_attr( $iepa_custom_theme['mobile_settings']['text_color'] ) : '#ffffff';
$togglebar_align = (isset($iepa_custom_theme['mobile_settings']['togglebar_align'] ) ) ? esc_attr( $iepa_custom_theme['mobile_settings']['togglebar_align'] ) : 'left';
$submenu_closebtn_position = (isset($iepa_custom_theme['mobile_settings']['submenu_closebtn_position'] ) ) ? esc_attr( $iepa_custom_theme['mobile_settings']['submenu_closebtn_position'] ) : 'bottom';
$submenus_retractor_text = (isset($iepa_custom_theme['mobile_settings']['submenus_retractor_text'] ) ) ? esc_attr( $iepa_custom_theme['mobile_settings']['submenus_retractor_text'] ) : 'CLOSE';

/* Search Bar settings */
$font_size7 = (isset($iepa_custom_theme['search_bar']['font_size'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['font_size'] ) : '10px';
$width7 = (isset($iepa_custom_theme['search_bar']['width'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['width'] ) : '182px';
$text_color7 = (isset($iepa_custom_theme['search_bar']['text_color'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['text_color'] ) : '#fffff';
$bg_color7 = (isset($iepa_custom_theme['search_bar']['bg_color'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['bg_color'] ) : '#121212';
$text_placholder_color7 = (isset($iepa_custom_theme['search_bar']['text_placholder_color'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['text_placholder_color'] ) : '#ccc';
$icon_color7 = (isset($iepa_custom_theme['search_bar']['icon_color'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['icon_color'] ) : '#fffff';
$search_button_bg_color = (isset($iepa_custom_theme['search_bar']['search_button_bg_color'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['search_button_bg_color'] ) : '';
$search_button_bg_hovercolor = (isset($iepa_custom_theme['search_bar']['search_button_bg_hovercolor'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['search_button_bg_hovercolor'] ) : '';
$search_button_font_color = (isset($iepa_custom_theme['search_bar']['search_button_font_color'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['search_button_font_color'] ) : '';
$search_button_font_hovercolor = (isset($iepa_custom_theme['search_bar']['search_button_font_hovercolor'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['search_button_font_hovercolor'] ) : '';
$search_transform = (isset($iepa_custom_theme['search_bar']['transform'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['transform'] ) : 'initial';
$font_popup_family = (isset($iepa_custom_theme['search_bar']['font_popup_family'] ) ) ? esc_attr( $iepa_custom_theme['search_bar']['font_popup_family'] ) : '';



/* tab menu settings*/
$htab_bgcolor = (isset($iepa_custom_theme['horizontal_tabbed']['bgcolor'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['bgcolor'] ) : '';
$htab_bg_active_color = (isset($iepa_custom_theme['horizontal_tabbed']['bg_active_color'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['bg_active_color'] ) : '';
$htab_font_color = (isset($iepa_custom_theme['horizontal_tabbed']['font_color'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['font_color'] ) : '';
$htab_font_hcolor = (isset($iepa_custom_theme['horizontal_tabbed']['font_hcolor'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['font_hcolor'] ) : '';
$htab_content_bgcolor = (isset($iepa_custom_theme['horizontal_tabbed']['content_bgcolor'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['content_bgcolor'] ) : '';
$htab_content_fcolor = (isset($iepa_custom_theme['horizontal_tabbed']['content_fcolor'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['content_fcolor'] ) : '';

$vtab_bgcolor = (isset($iepa_custom_theme['vertical_tabbed']['bgcolor'] ) ) ? esc_attr( $iepa_custom_theme['vertical_tabbed']['bgcolor'] ) : '';
$vtab_bghcolor = (isset($iepa_custom_theme['vertical_tabbed']['bghcolor'] ) ) ? esc_attr( $iepa_custom_theme['vertical_tabbed']['bghcolor'] ) : '';
$vtab_activebgcolor = (isset($iepa_custom_theme['vertical_tabbed']['bg_active_color'] ) ) ? esc_attr( $iepa_custom_theme['vertical_tabbed']['bg_active_color'] ) : '';
$vtab_fcolor = (isset($iepa_custom_theme['vertical_tabbed']['font_color'] ) ) ? esc_attr( $iepa_custom_theme['vertical_tabbed']['font_color'] ) : '';
$vtab_font_hcolor = (isset($iepa_custom_theme['vertical_tabbed']['font_hover_color'] ) ) ? esc_attr( $iepa_custom_theme['vertical_tabbed']['font_hover_color'] ) : '';

$tab_width = (isset($iepa_custom_theme['horizontal_tabbed']['tab_width'] ) ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['tab_width'] ) : '';
$tab_layout = (isset($iepa_custom_theme['horizontal_tabbed']['tab_layout']) && $iepa_custom_theme['horizontal_tabbed']['tab_layout'] != '' ) ? esc_attr( $iepa_custom_theme['horizontal_tabbed']['tab_layout'] ) : 'skew_layout';
if( $transform == "normal" ) {
 $transform = "initial";
}
if( $menu_label_font_transform == "normal" ) {
  $menu_label_font_transform = "initial";
}
if($transform3 == "normal"){
    $transform3 = "initial";
}
if($transform4 == "normal"){
    $transform4 = "initial";
}
if($transform5 == "normal"){
    $transform5 = "initial";
}
if($transform6 == "normal"){
    $transform6 = "initial";
}
if($search_transform == "normal"){
	$search_transform = "initial";
}
$maincustom_idwrapper = ".iepa_megamenu .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper" . $theme_slug;

if( $enable_menu_background == 1 && $menu_background_from != '' ) {
$content .= $maincustom_idwrapper.','.$maincustom_idwrapper.' ul.iepa-mega-wrapper,'.$maincustom_idwrapper.'.iepa-orientation-horizontal,'.$maincustom_idwrapper.'.iepa-orientation-vertical{
  	  background:' . esc_attr( $menu_background_from ) . ';
  	 }';
 /* a tag small line on before tag */
$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title::before,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link::before{
  	  background:'.esc_attr($menu_background_from).';}';
}else{
$content .= $maincustom_idwrapper.','.$maincustom_idwrapper.' ul.iepa-mega-wrapper,'.$maincustom_idwrapper.'.iepa-orientation-horizontal,'.$maincustom_idwrapper.'.iepa-orientation-vertical{
      background:#000000;
     }';
}

if($border_radius_topleft != '' || $margin_top !='' || $margin_bottom!=''){
$content .= $maincustom_idwrapper.','.$maincustom_idwrapper.' ul.iepa-mega-wrapper,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper > li{
  	  border-radius:'.esc_attr($border_radius_topleft).' '.esc_attr($border_radius_topright).' '.esc_attr($border_radius_bottomright).' '.esc_attr($border_radius_bottomleft).';
  	  border:'.esc_attr($border_color).';
  	  margin-top:'.esc_attr($margin_top).';
  	  margin-bottom:'.esc_attr($margin_bottom).';
  	 }';
}
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper > li{
  	  border-radius:'.esc_attr($border_radius_topleft).' '.esc_attr($border_radius_topright).' '.esc_attr($border_radius_bottomright).' '.esc_attr($border_radius_bottomleft).';
  	 }';
if($alignment !=''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper{
  	  text-align:'.esc_attr($alignment).';
  	 }';
}
if($width !=''){
$content .= $maincustom_idwrapper.'.iepa-orientation-horizontal{
  	  width:'.esc_attr($width).';
  	 }';
}
if($font_color_active1 !=''){
$content .= $maincustom_idwrapper.' .iepa-mega-wrapper > li.current-menu-item > a{
  	  color:'.esc_attr($font_color_active1).' !important;
  	 }';
}
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li > a{
  	  color:'.esc_attr($font_color).';
  	  font-size:'.esc_attr($font_size).';
  	  font-weight:'.esc_attr($font_weight).';
  	  font-family:'.esc_attr($font_family).';
  	  text-transform:'.esc_attr($transform).';
  	  text-decoration:'.esc_attr($font_decoration1).';
   }';
if($padding_top != '' || $padding_right != '' || $padding_bottom != '' || $padding_left != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li > a{
  	  padding:'.esc_attr($padding_top).' '.esc_attr($padding_right).' '.esc_attr($padding_bottom).' '.esc_attr($padding_left).';
  	 }';
}
if($enable_background_hover1 == 1 && $background_hover_from1 != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li:hover{
  	  background:'.esc_attr($background_hover_from1).';
  	 }';
}else{
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li:hover{
  	  background:#47a35b;
  	 }';
}
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li:hover > a{
  	  font-weight:'.esc_attr($font_weight_hover1).';
  	  text-decoration:'.esc_attr($font_decoration_hover1).';
  	  color:'.esc_attr($font_hover_color).';
  	 }';

if($disable_menu_divider != 1){
  if($enable_menu_divider == 1){
  	if($menu_divider_color != '' || $opacity_glow != ''){
     $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li > a.iepa-mega-menu-link::before{
  	  background:'.esc_attr($menu_divider_color).';
  	  opacity:'.esc_attr($opacity_glow).';
  	  content: "";
      height: 100%;
      position: absolute;
      right: 0;
      top: 0;
      width: 1px;
  	 }';
  	}
  }
}
if($bg_active_color1 != ''){
$content .= $maincustom_idwrapper.' .iepa-mega-wrapper > li.current-menu-item{
  	  background:'.esc_attr($bg_active_color1).';
  	 }';
}
/*Mega menu */
if($enable_megamenu_background2 == 1 && $menu_background_from2 != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap{
  	  background:'.esc_attr($menu_background_from2).';
  	 }';
}
if($padding_top2 != '' || $padding_bottom2 != '' || $padding_left2 != '' || $padding_right2 != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li:hover > .iepa-sub-menu-wrap{
  	  padding-top:'.esc_attr($padding_top2).';
  	  padding-bottom:'.esc_attr($padding_bottom2).';
  	  padding-left:'.esc_attr($padding_left2).';
  	  padding-right:'.esc_attr($padding_right2).';
  	 }';
}
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap{
  	  width:'.esc_attr($width2).';
  	  border-radius:'.esc_attr($border_radius2).';
  	 }';
if($border_color2 != ''){
     $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap{
      border: 1px solid '.esc_attr($border_color2).';
     }';
}
if($box_shadow2 != '' || $box_shadow_color2 != ''){
     $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap{
      box-shadow:'.esc_attr($box_shadow2).' '.esc_attr($box_shadow_color2).';
     }';
}
/*Widget section*/
$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link span.iepa-mega-menu-href-title,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepa-custom-post-settings.iepamega-image-left .iepa-custom-postimage span.iepa-mega-menu-href-title,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepa-custom-post-settings.iepamega-image-top .iepa-custom-postimage span.iepa-mega-menu-href-title{
  	  color:'.esc_attr($font_color3).';
  	  font-size: '.esc_attr($font_size3).';
  	  font-weight:'.esc_attr($font_weight3).';
  	  text-transform:'.esc_attr($transform3).';
  	  font-family:'.esc_attr($font_family3).';
  	  text-decoration:'.esc_attr($font_decoration3).';
  	  margin-bottom:'.esc_attr($margin_bottom3).';
  	  margin-top:'.esc_attr($margin_top3).';
  	}';
$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap ul li h4.iepa-mega-block-title:hover,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap ul li.im-menu-addon-header > a.iepa-mega-menu-link span.iepa-mega-menu-href-title:hover{
  	  color:'.esc_attr($font_hover_color3).';
  	  font-weight:'.esc_attr($font_weight_hover3).';
  	  text-decoration:'.esc_attr($font_decoration_hover3).';
  	}';
$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap ul li,'.$maincustom_idwrapper.' ul.iepa-mega-sub-menu li a{
  	  color:'.esc_attr($content_font_color3).';
  	  font-family:'.esc_attr($content_font_family3).';
  	}';
if($content_font_color3 != ''){
 $content .= $maincustom_idwrapper.' .iepa-mega-sub-menu li .iepa-sub-menu-wrapper.iepa_menu_1 li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_pages li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_categories li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_archive li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_meta li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_recent_comments li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_recent_entries li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_product_categories ul.product-categories li a::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_categories li::before,'.$maincustom_idwrapper.' .iepa-mega-sub-menu .widget_archive li::before{
  	  color:'.esc_attr($content_font_color3).';
  	}';
  	$content .= $maincustom_idwrapper.' ul li.iepamega-menu-megamenu ul li a:hover,'.$maincustom_idwrapper.' ul li.iepamega-menu-megamenu ul li a,'.$maincustom_idwrapper.' ul li.iepamega-menu-megamenu ul li a:focus,'.$maincustom_idwrapper.' ul li.iepamega-menu-megamenu ul li span.iepa-mega-menu-href-title{
  	  color:'.esc_attr($content_font_color3).';
  	}';
}
/*
* Top Section Stylesheet
*/
 $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap span.iepa_megamenu_topcontent{
  	  font-size:'.esc_attr($font_size4).';
  	  color:'.esc_attr($font_color4).';
  	  font-family:'.esc_attr($font_family4).';
  	  font-weight:'.esc_attr($font_weight4).';
  	  text-transform:'.esc_attr($transform4).';
  	  margin-left:'.esc_attr($image_margin_left4).';
  	  margin-right:'.esc_attr($image_margin_right4).';
  	}';
if($image_margin_bottom4 != ''){
 $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap .top_clearfix{
  	  margin-bottom:'.esc_attr($image_margin_bottom4).';
  	}';
}

if($image_margin_bottom4 != ''){
 $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap .iepa-topimage,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap .iepa-ctop{
  	  margin-left:'.esc_attr($image_margin_left4).';
  	  margin-right:'.esc_attr($image_margin_right4).';
  	  margin-top:'.esc_attr($image_margin_top4).';
  	}';
}
/*
* Bottom Section stylesheet
*/
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap span.iepa_megamenu_bottomcontent{
  	  font-size:'.esc_attr($font_size5).';
  	  color:'.esc_attr($font_color5).';
  	  font-family:'.esc_attr($font_family5).';
  	  font-weight:'.esc_attr($font_weight5).';
  	  text-transform:'.esc_attr($transform5).';
  	  margin-left:'.esc_attr($image_margin_left5).';
  	  margin-right:'.esc_attr($image_margin_right5).';
  	}';
if($image_margin_top5 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap .bottom_clearfix{
  	  margin-top:'.esc_attr($image_margin_top5).';
  	}';
}


$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap .iepa-bottomimage,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap .iepa-cbottom{
  	  margin-left:'.esc_attr($image_margin_left5).';
  	  margin-right:'.esc_attr($image_margin_right5).';
  	  margin-bottom:'.esc_attr($image_margin_bottom5).';
  	}';
/*flyout*/

if($enable_background6 == 1 && $menu_bgcurrentcolor6 != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul{
  	  background:'.esc_attr($menu_bgcurrentcolor6).';
  	}';
}
if($item_width6 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul{
  	  width:'.esc_attr($item_width6).';
  	}';
}
if($menu_bg_hovercolor6 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li:hover{
  	  background:'.esc_attr($menu_bg_hovercolor6).';
  	}';
}

if($item_margin6 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left ul.iepa-mega-sub-menu li,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li{
  	  margin:'.esc_attr($item_margin6).';
  	}';
}
if($item_padding6 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left ul.iepa-mega-sub-menu li a.iepa-mega-menu-link,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li a.iepa-mega-menu-link{
  	  padding:'.esc_attr($item_padding6).';
  	}';
}

$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li a{
  	  font-size:'.esc_attr($font_size6).';
  	  color:'.esc_attr($font_color6).';
  	  font-family:'.esc_attr($font_family6).';
  	  font-weight:'.esc_attr($font_weight6).';
  	  text-transform:'.esc_attr($font_decoration6).';
  	}';
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li:hover a,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li:hover a span{
  	  color:'.esc_attr($font_hover_color6).';
  	  font-weight:'.esc_attr($font_weight_hover6).';
  	  text-decoration:'.esc_attr($font_decoration_hover6).';
  	}';

 /* search bar */
 $content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepa-menu-align-right.iepa-search-type .iepa-sub-menu-wrap
 .megamenu-type-search input.search-submit[type="submit"]{
  	  font-size:'.esc_attr($font_size7).';
  	  color:'.esc_attr($text_color7).';
  	  background:'.esc_attr($bg_color7).';
  	}';
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li.iepa-menu-align-right.iepa-search-type .iepa-sub-menu-wrap .megamenu-type-search input.search-field[type="search"]{
  	  width:'.esc_attr($width7).';
  	  color:'.esc_attr($text_placholder_color7).';
  	}';

 if($icon_color7 != '' ){
  $content .= $maincustom_idwrapper.' .iepa-search-type  > .iepa-mega-menu-icon > i.fa-search,'.$maincustom_idwrapper.' .iepa-search-type  > .iepa-mega-menu-icon > i.genericon-search,'.$maincustom_idwrapper.' .iepa-search-type  > .iepa-mega-menu-icon > i.dashicons-search{
  	  color:'.esc_attr($icon_color7).';
  	}';
 }else{
 	$content .= $maincustom_idwrapper.' a.iepa-search-type > .iepa-mega-menu-icon > i.fa-search,'.$maincustom_idwrapper.' .iepa-search-type  > .iepa-mega-menu-icon > i.genericon-search,'.$maincustom_idwrapper.' .iepa-search-type  > .iepa-mega-menu-icon > i.dashicons-search{
  	  color:'.esc_attr($font_color).';
  	}';
 }

if($width7 != '' ){
$content .= $maincustom_idwrapper.' .iepa-mega-wrapper .iepamega-searchinline input.search-field{
  	  width:'.esc_attr($width7).';
  	}';
}
/* Popup Search Form */
if($bg_color7 != '' || $width7 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li div.popup-search-form .iepa-overlay-search{
  	  background:'.esc_attr($bg_color7).';
  	  width:'.esc_attr($width7).';
  	}';
}
/* Popup Search Form */
if($bg_color7 != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li div.popup-search-form .iepa-overlay-search form label input.search-field{
  	  border: 1px solid '.esc_attr($bg_color7).';
  	}';
}
if( $font_popup_family != '') {
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li div.popup-search-form .iepa-overlay-search{
  	  font-family:'.esc_attr($font_popup_family).';
  	}';
}
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li div.popup-search-form .iepa-overlay-search form input[type="submit"]{
  	  font-size:'.esc_attr($font_size7).';
  	  color:'.esc_attr($search_button_font_color).';
  	  text-transform:'.esc_attr($search_transform).';
}';
if($search_button_bg_color != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li div.popup-search-form .iepa-overlay-search form input[type="submit"]{
  	  background:'.esc_attr($search_button_bg_color).';
  	  border: 3px solid'.esc_attr($search_button_bg_color).';
}';
}
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li div.popup-search-form .iepa-overlay-search form input[type="submit"]:hover{
  	  background:'.esc_attr($search_button_bg_hovercolor).';
  	  color:'.esc_attr($search_button_font_hovercolor).';
}';
/* search bar custom css end */
/* top menu label custom css */
if($enable_menu_label_bgcolor == 1){
$content .= $maincustom_idwrapper.' .iepa-mega-menu-label::before{
  	  border-color:'.esc_attr($menu_label_bgcolor).'  transparent transparent;
}';
$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.im-menu-addon-header a span.iepa-mega-menu-label{
  	  font-size:'.esc_attr($menu_label_fontsize).';
  	  color:'.esc_attr($menu_label_fontcolor).';
}';
$content .= $maincustom_idwrapper.' .iepa-mega-menu-label{
  	  font-size:'.esc_attr($menu_label_fontsize).';
  	  color:'.esc_attr($menu_label_fontcolor).';
  	  background:'.esc_attr($menu_label_bgcolor).';
  	  font-weight:'.esc_attr($menu_label_font_weight).';
  	  text-transform:'.esc_attr($menu_label_font_transform).';
  	  font-family:'.esc_attr($menu_label_font_family).';
}';
}


if($htab_content_fcolor != ''){
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li > a > span.iepa-mega-menu-href-title,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-horizontal-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li > a > span.iepa-mega-menu-href-title{
  	  color:'.esc_attr($htab_content_fcolor).';
}';
$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li > a > span.iepa-mega-menu-href-title:before,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-horizontal-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li > a > span.iepa-mega-menu-href-title:before{
  	  background:'.esc_attr($htab_content_fcolor).';
}';
$content .= $maincustom_idwrapper.' ul.iepa-mega-sub-menu li.iepa-custom-post-settings.iepamega-image-left .iepa-custom-postimage span.iepa-mega-menu-href-title,'.$maincustom_idwrapper.' ul.iepa-mega-sub-menu li.iepa-custom-post-settings.iepamega-image-top .iepa-custom-postimage span.iepa-mega-menu-href-title{
  	  color:'.esc_attr($htab_content_fcolor).';
}';
}

if($htab_bgcolor != ''){
$content .= $maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section > a.iepa-mega-menu-link{
  	  background:'.esc_attr($htab_bgcolor).';
}';
}

if($htab_bg_active_color != '' || $htab_font_hcolor != ''){
	$content .= $maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section.show_tab > a.iepa-mega-menu-link{
  	  background:'.esc_attr($htab_bg_active_color).';
  	  color:'.esc_attr($htab_font_hcolor).';
}';
}
if($htab_bg_active_color != ''){
$content .= $maincustom_idwrapper.' ul li ul li.iepamega-horizontal-tabs > div > ul > li.iepa-tabs-section > .iepa-sub-menu-wrapper{
  	  border: 2px solid'.esc_attr($htab_bg_active_color).';
}';
}

if($htab_content_bgcolor != ''){
$content .= $maincustom_idwrapper.' ul li ul li.iepamega-horizontal-tabs > div > ul > li.iepa-tabs-section > .iepa-sub-menu-wrapper{
  	  background: '.esc_attr($htab_content_bgcolor).';
}';
}

if($htab_font_color != ''){
	$content .= $maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section > a.iepa-mega-menu-link{
  	  color: '.esc_attr($htab_font_color).';
}';
}
if($vtab_bgcolor != ''){
		$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li > a > span{
  	  background: '.esc_attr($vtab_bgcolor).';
}';
}

if($vtab_bghcolor != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.show_tab > a > span{
  	  background: '.esc_attr($vtab_bghcolor).';}';
}


if($vtab_activebgcolor != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li > a:hover:before,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.show_tab > a:before{
  	  background: '.esc_attr($vtab_activebgcolor).';}';
}
if($vtab_fcolor != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li > a > span{
  	  color: '.esc_attr($vtab_fcolor).';}';
}
if($vtab_font_hcolor != ''){
	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li > a:hover span,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li > a:hover{
  	  color: '.esc_attr($vtab_font_hcolor).';}';
}

if($tab_width != ''){
	$content .= $maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section > a.iepa-mega-menu-link{
  	  width: '.esc_attr($tab_width).'px;}';

}

if($tab_layout == 'flat_layout'){
	$content .= $maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section > a.iepa-mega-menu-link,'.$maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section > a.iepa-mega-menu-link span{
  	   -ms-transform: none;
	   -webkit-transform: none;
	   transform: none;
  	}';
  	$content .= $maincustom_idwrapper.' ul li ul.iepa-mega-sub-menu > li.iepamega-horizontal-tabs > .iepa-sub-menu-wrapper > ul > li.iepa-tabs-section:first-child{
  	  margin-left: 0px;
  	}';
}
/* Widget extra options */
if($widget_btnbgcolor != ''){
	$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-text-widgets .wimma-linkbtn,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .imma-recent-product-widget .all-re-product-list li .imma-recentpro-right-section a.button{
  	  background: '.esc_attr($widget_btnbgcolor).';
  	  border: 1px solid '.esc_attr($widget_btnbgcolor).';
  	}';
}

if( $widget_btnbghcolor != '' ) {
	$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-text-widgets .wimma-linkbtn:hover,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button:hover,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .imma-recent-product-widget .all-re-product-list li .imma-recentpro-right-section a.button:hover{
  	  background: '.esc_attr($widget_btnbgcolor).';
  	  border: 1px solid '.esc_attr($widget_btnbgcolor).';
  	}';
}

if($widget_btnfcolor != ''){
   $content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-text-widgets .wimma-linkbtn a,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-pro-recent-posts-widget a.imma-readmore-btn,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .imma-recent-product-widget .all-re-product-list li .imma-recentpro-right-section a.button{
  	  color: '.esc_attr($widget_btnfcolor).' !important;
  	}';
}

if($widget_btnfhcolor != ''){
	$content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-text-widgets .wimma-linkbtn:hover a,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-pro-recent-posts-widget a.imma-readmore-btn:hover,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button:hover,'.$maincustom_idwrapper.' .iepa-sub-menu-wrap li .imma-recent-product-widget .all-re-product-list li .imma-recentpro-right-section a.button:hover{
  	  color: '.esc_attr($widget_btnfhcolor).' !important;
  	}';
}
if($enable_mobile == 1 && $resposive_breakpoint_width != '910' && $resposive_breakpoint_width != '910px'){
    $content .= '/*Responsive Custom Theme Integration CSS Start*/';
	$content .= '
	@media(max-width:'.$resposive_breakpoint_width.'){';
    $content .= '
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper .iepamegamenu-toggle{
        display:block;
	}
	.iepa-ctheme-wrapper .iepamegamenu-toggle .iepamega-closeblock,.iepa-ctheme-wrapper .iepamegamenu-toggle .menutoggle{
		display:none;
	}
   .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper {
    	overflow: hidden;
    	z-index: 999;
    	display:none;
    }
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper.iepa-show-menu{
		display:block;
	}
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li {
		width: 100%;
		border-bottom: 1px solid #ccc;
		text-align: left;
		position: relative;
	}
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper li:last-child {
		border-bottom: none;
	}
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper li .dropdown-toggle {
		display: none;
	}
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a,
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchdown,
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchinline {
		padding: 15px 10px;
	}
	.iepa_megamenu .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchinline,
	.iepa_megamenu .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a.iepa-csingle-menu {
		padding: 15px 10px;
	}
	.iepa-megamenu-main-wrapper.iepamega-midnightblue-sky-white.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a::before {
		display: none;
	}
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li.menu-item-has-children a {
		margin-right: 0;
	}
	.iepa-ctheme-wrapper .iepamegamenu-toggle .iepamega-openblock,
	.iepa-ctheme-wrapper .iepamegamenu-toggle .iepamega-closeblock {
		padding: 10px 10px 13px;
		color: #000;
	}

	.iepa-ctheme-wrapper .iepamegamenu-toggle .iepamega-openblock,
	.iepa-ctheme-wrapper .iepamegamenu-toggle .iepamega-closeblock {
		padding: 10px 10px 13px;
		color: #fff;
	}
    .iepa-ctheme-wrapper.iepamega-clean-white .iepamegamenu-toggle .iepamega-openblock,
	.iepa-ctheme-wrapper.iepamega-clean-white .iepamegamenu-toggle .iepamega-closeblock {
		color: #000;
	}
	.iepa-ctheme-wrapper.iepamega-clean-white .iepamegamenu-toggle{
	    border: 1px solid #ccc;
     }

	.iepa-ctheme-wrapper.iepa-orientation-vertical.iepamega-clean-white .iepamegamenu-toggle .iepamega-openblock,
	.iepa-ctheme-wrapper.iepa-orientation-vertical.iepamega-clean-white .iepamegamenu-toggle .iepamega-closeblock{
      color: #000;
	}

	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper .iepa-mega-menu-label {
		top: 50%;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		left: 23%;
	}
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper .iepa-mega-menu-label::before {
		border-color: #d500fb transparent transparent;
		border-style: solid;
		border-width: 7px 4.5px 0;
		bottom: -6px;
		content: "";
		height: 0;
		left: -6px;
		margin-left: auto;
		margin-right: auto;
		position: absolute;
		right: auto;
		top: 50%;
		transform: rotate(90deg) translateX(-50%);
		width: 0;
	}
	.iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
		transition: none;
		-webkit-transition: none;
		-ms-transition: none;
	}
	.iepa-ctheme-wrapper .iepamega-responsive-closebtn {
		color: #fff;
		border-top: 1px solid #fff;
		padding: 15px 10px;
		font-weight: 600;
		position: relative;
		padding-left: 30px;
		cursor: pointer;
		z-index: 999999;
		overflow: hidden;
		clear: both;
	}

	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepa-menu-align-right.iepa-search-type:hover .iepa-sub-menu-wrap {
		top: 0;
	}
	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-search-form .iepa-search-icon.inline-toggle-right.inline-search.searchbox-open {
		left: auto;
		opacity: 1;
		right: 10px;
	}
	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout ul {
		width: 100%;
	}
	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div,
	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div ul li div {
		width: 100%;
		position: relative;
		max-height: 0;
	}
	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.active-show > div {
		max-height: 1000px;
	}
	.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.active-show > div ul li.active-show > div {
    	max-height: 1000px;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout li.menu-item-has-children > a::after {
    	top: 12px;
    }
    .iepa_megamenu .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchdown {
    	padding: 15px 10px;
    }
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
    	position: relative;
    	max-height: 0;
    	transition: all ease 0.1s;
    	-webkit-transition: all ease 0.1s;
    	-ms-transition: all ease 0.1s;
    	padding: 0 8px 0;
    }
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.active-show .iepa-sub-menu-wrap {
    	position: relative;
    	max-height: 10000px;
    	transition: all ease 0.3s;
    	-webkit-transition: all ease 0.3s;
    	-ms-transition: all ease 0.3s;
    	padding: 15px 8px 5px;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li.iepa-submenu-align-left.menu-item-has-children a:after,
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left ul.iepa-mega-sub-menu li.iepa-submenu-align-left.menu-item-has-children a:after {
    	left: auto;
    	right: 10px;
    	transform: rotate(180deg) !important;
	    -webkit-transform: rotate(180deg) !important;
	    -ms-transform: rotate(180deg) !important;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li.iepa-submenu-align-left.menu-item-has-children a.iepa-mega-menu-link {
    	padding-left: 10px;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li a {
    	padding-left: 20px !important;
    }
    .iepa-megamenu-main-wrapper.iepa-onclick.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout > div {
    	overflow: hidden;
    	height: 0;
    }
    .iepa-megamenu-main-wrapper.iepa-onclick.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout > div.iepa-open-fade {
    	height: 100%;
    	z-index: 999;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left div ul li div {
    	right: 0;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div {
    	z-index: 999;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left div ul li.iepa-submenu-align-right div {
    	left: 0;
    }
    .iepa_megamenu ul.iepa-mega-wrapper.iepa-ctheme-wrapper li.iepamega-hide-on-mobile {
		display: none;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper {
		width: 100%;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper .iepa-mega-toggle-block {
		color: #fff;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper .iepa-mega-toggle-block .iepamega-openblock,
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper .iepa-mega-toggle-block .iepamega-closeblock {
		padding: 10px 10px 13px;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper .iepa-mega-toggle-block .dashicons {
		font-size: 26px;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper .iepa-mega-toggle-block .menutoggle {
		display: none;
	}
	.iepa-orientation-vertical.iepa-ctheme-wrapper .iepamega-responsive-closebtn {
	    color: #fff;
	    border-top: 1px solid #fff;
	    padding: 10px;
	    font-weight: 600;
	    position: relative;
	    padding-left: 10px;
	    cursor: pointer;
	    z-index: 999999;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
    	<!-- position: relative; -->
    	max-height: 0;
    	transition: all ease 0.1s;
    	-webkit-transition: all ease 0.1s;
    	-ms-transition: all ease 0.1s;
    	padding: 0 8px 0;
    	left: 0;
    	width: 100% !important;
    	right: 0;
    }
    .iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.active-show .iepa-sub-menu-wrap {
    	position: relative;
    	max-height: 10000px;
    	transition: all ease 0.3s;
    	-webkit-transition: all ease 0.3s;
    	-ms-transition: all ease 0.3s;
    	padding: 15px 8px 5px;
    }
    .iepa-orientation-vertical.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div {
    	left: 0;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-search-form .iepa-search-icon.inline-toggle-left.inline-search.searchbox-open {
    	left: 40px;
    	top: 27px;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li {
        width: 49%;
        padding: 0;
        margin: 0 0 10px;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li:nth-child(even) {
        margin-left: 1%;
    }
     .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right div ul li.iepa-submenu-align-left div{
        right:0;
    }
    .iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right div ul li div{
        left:0;
    }
    /*=============
    slide on click for responsive
    ==============*/
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper.iepa-slide ul.iepa-mega-wrapper li .iepa-sub-menu-wrap,
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper.iepa-slide ul.iepa-mega-wrapper li.iepamega-horizontal-left-edge .iepa-sub-menu-wrap,
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper.iepa-slide ul.iepa-mega-wrapper li.iepamega-horizontal-center .iepa-sub-menu-wrap {
    	left: 0;
    }
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper.iepa-slide ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
    	position: static;
    	padding: 0 8px;
    }
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper.iepa-slide ul.iepa-mega-wrapper li:hover .iepa-sub-menu-wrap {
		opacity: 0;
		visibility: hidden;
		max-height: 0;
		padding: 0 8px;
    }
    .iepa-megamenu-main-wrapper.iepa-ctheme-wrapper.iepa-slide.iepa-onclick ul.iepa-mega-wrapper li.active-show .iepa-sub-menu-wrap {
		opacity: 1;
		visibility: visible;
		max-height: 10000px;
		z-index: 999;
		transition: all 0.4s ease-in;
		-webkit-transition: all 0.4s ease-in;
		-ms-transition: all 0.4s ease-in;
		padding: 15px 8px 5px;
    }
    .iepa-megamenu-main-wrapper.iepa-onclick.iepa-ctheme-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.active-show > div {
    	overflow: visible;
    }
    .main-navigation button.menu-toggle{
			display: none;
	}';

 if($togglebar_enable_bgcolor == 1){
 	$content .= $maincustom_idwrapper.' .iepamegamenu-toggle{
  	  height: '.esc_attr($togglebar_height).';
  	  background: '.esc_attr($togglebar_background_from).';
  	  text-align: '.esc_attr($togglebar_align).';
  	}';
  }

 	$content .= $maincustom_idwrapper.' .iepamegamenu-toggle .iepamega-openblock,'.$maincustom_idwrapper.' .iepamegamenu-toggle .iepamega-closeblock{
  	  color: '.esc_attr($icon_color).';
  	  background: '.esc_attr($togglebar_background_from).';
  	}';
   $content .= $maincustom_idwrapper.' .close-primary{
  	  color: '.esc_attr($text_color).';
  	}';
  	$content .= $maincustom_idwrapper.',.iepa-orientation-horizontal,'.$maincustom_idwrapper.' ul.iepa-mega-wrapper{
  	  background: '.esc_attr($menu_background_from).';
  	}';
  	$content .= $maincustom_idwrapper.' .iepa-orientation-horizontal ul.iepa-mega-wrapper > li > a,.iepa-orientation-horizontal,'.$maincustom_idwrapper.' .iepa-orientation-vertical ul.iepa-mega-wrapper > li > a{
  	  color: '.esc_attr($font_color).';
  	}';
  	$content .= $maincustom_idwrapper.' ul.iepa-mega-wrapper > li:hover > a,'.$maincustom_idwrapper.' .iepa-orientation-vertical ul.iepa-mega-wrapper > li > a{
  	  font-weight: '.esc_attr($font_weight_hover1).';
  	  text-decoration: '.esc_attr($font_decoration_hover1).';
  	  color: '.esc_attr($font_hover_color).';
  	}';
    $content .= $maincustom_idwrapper.' .iepa-sub-menu-wrap ul li > a{
  	  padding: 0px;
  	}';
	$content .= '}';

   $content .= '
	@media screen and (max-width:'.$resposive_breakpoint_width.'){';
   $content .= '.iepa-sub-menu-wrap li.iepamega-1columns-1total, .iepa-sub-menu-wrap li.iepamega-1columns-2total, .iepa-sub-menu-wrap li.iepamega-1columns-3total, .iepa-sub-menu-wrap li.iepamega-1columns-4total, .iepa-sub-menu-wrap li.iepamega-1columns-5total, .iepa-sub-menu-wrap li.iepamega-1columns-6total, .iepa-sub-menu-wrap li.iepamega-1columns-7total, .iepa-sub-menu-wrap li.iepamega-1columns-8total, .iepa-sub-menu-wrap li.iepamega-2columns-2total, .iepa-sub-menu-wrap li.iepamega-2columns-3total, .iepa-sub-menu-wrap li.iepamega-3columns-3total, .iepa-sub-menu-wrap li.iepamega-2columns-4total, .iepa-sub-menu-wrap li.iepamega-3columns-4total, .iepa-sub-menu-wrap li.iepamega-4columns-4total, .iepa-sub-menu-wrap li.iepamega-2columns-5total, .iepa-sub-menu-wrap li.iepamega-3columns-5total, .iepa-sub-menu-wrap li.iepamega-4columns-5total, .iepa-sub-menu-wrap li.iepamega-5columns-5total, .iepa-sub-menu-wrap li.iepamega-2columns-6total, .iepa-sub-menu-wrap li.iepamega-3columns-6total, .iepa-sub-menu-wrap li.iepamega-4columns-6total, .iepa-sub-menu-wrap li.iepamega-5columns-6total, .iepa-sub-menu-wrap li.iepamega-6columns-6total, .iepa-sub-menu-wrap li.iepamega-2columns-7total, .iepa-sub-menu-wrap li.iepamega-3columns-7total, .iepa-sub-menu-wrap li.iepamega-4columns-7total, .iepa-sub-menu-wrap li.iepamega-5columns-7total, .iepa-sub-menu-wrap li.iepamega-5columns-7total, .iepa-sub-menu-wrap li.iepamega-6columns-7total, .iepa-sub-menu-wrap li.iepamega-7columns-7total, .iepa-sub-menu-wrap li.iepamega-2columns-8total, .iepa-sub-menu-wrap li.iepamega-3columns-8total, .iepa-sub-menu-wrap li.iepamega-4columns-8total, .iepa-sub-menu-wrap li.iepamega-5columns-8total, .iepa-sub-menu-wrap li.iepamega-6columns-8total, .iepa-sub-menu-wrap li.iepamega-7columns-8total, .iepa-sub-menu-wrap li.iepamega-8columns-8total{
      width:100%;
      padding: 0 10px;}';
   $content .= '}';
}
