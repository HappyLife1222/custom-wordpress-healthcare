<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

global $wpdb;
/**
* Creating table for storing custom themes created.
*/
$table_name = "{$wpdb->prefix}iepa_mm_custom_theme";
$sql = "CREATE TABLE IF NOT EXISTS {$table_name} ( theme_id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(theme_id), title TEXT, slug TEXT, theme_settings LONGTEXT, created datetime, modified datetime )";
$wpdb->query( $sql );

$table_names = "{$wpdb->prefix}iepa_mm_menugrouplists";
$sql2 = "CREATE TABLE IF NOT EXISTS {$table_names} ( id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), menuid BIGINT, group_type VARCHAR(225), widget_details LONGTEXT, totalgroup VARCHAR(225), group_details LONGTEXT )";
$wpdb->query( $sql2 );

//create default theme on activation of plugin//
$empty = $wpdb->get_results( "SELECT * FROM {$table_name}" );
if( empty( $empty ) ) {

  $imma_general = array(
    'line_height'            => '1.5',
    'zindex'                 => '999',
    'enable_shadow'          => '1',
    'shadow_color'           => '#ffffff',
  );

  $imma_menu_bar = array(
    'enable_menu_background'       => '1',
    'menu_background_from'         => '#121212',
    'font_color'                   => '#ffffff',
    'font_family'                  => 'Open Sans',
    'font_weight'                  => 'normal',
    'padding_top'                  => '20px',
    'padding_bottom'               => '25px',
    'padding_left'                 => '20px',
    'padding_right'                => '22px',
    'width'                        => '100%',
    'border_radius_topleft'        => '0px',
    'border_radius_topright'       => '0px',
    'border_radius_bottomright'    => '0px',
    'border_radius_bottomleft'     => '0px',
    'border_color'                 => '#121212',
    'alignment'                    => 'left',
    'margin_top'                   => '0px',
    'margin_bottom'                => '0px',
  );

  $imma_top_menu = array(
    'enable_background_hover'      => '1',
    'background_hover_from'        => '#47a35b',
    'bg_active_color'              => '#47a35b',
    'font_color_active'            => '#ffffff',
    'font_size'                    => '13px',
    'font_weight_hover'            => 'normal',
    'transform'                    => 'normal',
    'font_decoration'              => 'none',
    'font_decoration_hover'        => 'none',
    'enable_menu_divider'          => '1',
    'menu_divider_color'           => 'rgb(255,255,255)',
    'opacity_glow'                 => '0.5',
    'enable_menu_label_bgcolor'    =>  '1',
    'menu_label_bgcolor'           =>  '#f1ee1a',
    'menu_label_fontcolor'         =>  '#000',
    'menu_label_fontsize'          =>  '10px',
    'menu_label_font_weight'       =>  'normal',
    'menu_label_font_transform'    =>  'uppercase',
    'menu_label_font_family'       =>  'Open Sans'
  );

  $imma_megamenu_bar = array(
    'enable_megamenu_background'   => '1',
    'menu_background_from'         => '#ffffff',
    //  'menu_background_to'           => '#ffffff',
    'width'                        => '100%',
    'padding_top'                  => '15px',
    'padding_bottom'               => '5px',
    'padding_left'                 => '8px',
    'padding_right'                => '8px',
    'border_color'                 => '#ffffff',
    'border_radius'                => '0px',
    'box_shadow'                   => '0 3px 3px',
    'box_shadow_color'             => 'rgba(0, 0, 0, 0.2)',
  );


  $imma_widgets = array(
    'font_color'            => '#000000',
    'font_hover_color'      => '#000000',
    'font_size'             => '14px',
    'font_weight'           => 'bold',
    'font_weight_hover'     => 'bold',
    'transform'             => 'uppercase',
    'font_family'           => 'Open Sans',
    'font_decoration'       => 'none',
    'font_decoration_hover' => 'none',
    'content_font_color'    => '#000000',
    'content_font_family'   => 'Open Sans',
    'margin_top'            => '0px',
    'margin_bottom'         => '10px'
  );

  $iepa_top_section = array(
    'font_color'          => '#000000',
    'font_size'           => '13px',
    'font_weight'         => 'normal',
    'transform'           => 'normal',
    'font_family'         => 'Open Sans',
    'image_margin_top'    => '0px',
    'image_margin_bottom' => '10px',
    'image_margin_left'   => '0px',
    'image_margin_right'  => '0px'
  );

  $imma_bottom_section = array(
    'font_color'          => '#000000',
    'font_size'           => '13px',
    'font_weight'         => 'normal',
    'transform'           => 'normal',
    'font_family'         => 'Open Sans',
    'image_margin_top'    => '10px',
    'image_margin_bottom' => '0px',
    'image_margin_left'   => '0px',
    'image_margin_right'  => '0px'
  );

  $imma_flyout = array(
    'enable_background'     => '1',
    'menu_bgcurrentcolor'   => '#121212',
    'menu_bg_hovercolor'    => '#47a35b',
    'font_color'            => '#ffffff',
    'font_hover_color'      => '#ffffff',
    'font_size'             => '12px',
    'font_weight'           => 'normal',
    'font_weight_hover'     => 'normal',
    'transform'             => 'normal',
    'font_family'           => 'Open Sans',
    'font_decoration'       => 'none',
    'font_decoration_hover' => 'none',
    'item_margin'           => '0px 5px',
    'item_padding'          => '10px',
    'item_width'            => '210px'
  );

  $imma_mobile_settings = array(
    'togglebar_enable_bgcolor'    => '1',
    'togglebar_background_from'   => '#121212',
    'togglebar_height'            => '40px',
    'resposive_breakpoint_width'  => '910px',
    'icon_color'                  => '#ffffff',
    'text_color'                  => '#ffffff',
    'togglebar_align'             => 'left',
    'submenu_closebtn_position'   => 'bottom',
    'submenus_retractor_text'     => 'CLOSE'
  );

  $imma_search_bar = array(
    'font_size'             => '10px',
    'width'                 => '182px',
    'text_color'            => '#fffff',
    'bg_color'              => '#121212',
    'text_placholder_color' => '#ccc',
    'icon_color'            => '#ffffff'
  );


  $all_parameters = array(
    'general'           => $imma_general,
    'menu_bar'          => $imma_menu_bar,
    'top_menu'          => $imma_top_menu,
    'megamenu_bar'      => $imma_megamenu_bar,
    'widgets'           => $imma_widgets,
    'top_section'       => $iepa_top_section,
    'bottom_section'    => $imma_bottom_section,
    'flyout'            => $imma_flyout,
    'mobile_settings'   => $imma_mobile_settings,
    'search_bar'        => $imma_search_bar
  );

  $theme_title    = "Default Theme";
  $theme_slug     = "default-theme";
  $added_date     = date( 'Y-m-d H:m:s' );
  $modified_date  = date( 'Y-m-d H:m:s' );

  $insert_default = $wpdb->insert(
    $table_name,
    array(
      'title'          => $theme_title,
      'slug'           => $theme_slug,
      'theme_settings' => serialize( $all_parameters ),
      'created'        => $added_date,
      'modified'       => $modified_date
    ),
    array(
      '%s',
      '%s',
      '%s',
      '%s',
      '%s'
    )
  );

}
