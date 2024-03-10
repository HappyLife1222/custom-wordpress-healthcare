<?php
$iepa_mm_sidebarwidgets = IEPA_MM_Libary::iepa_mm_sidebarwidgets();

foreach ( $iepa_mm_sidebarwidgets as $iepa_mm_sidebar_widget_id ) {

  $iepa_mm_widget_base = IEPA_MM_Libary::get_widget_base_for_widget_id( $iepa_mm_sidebar_widget_id );

  switch ( $iepa_mm_widget_base ) {
    case 'iepa_pro_post_heading_widget':
      $iepa_custom_css .= IEPA_Mega_Menu_Posts_Heading_Widget::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepa_pro_productlist_widget_area':
      $iepa_custom_css .= IEPA_MM_prodlist_widget_area::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepa_featured_box_layout':
      $iepa_custom_css .= IEPA_Mega_Menu_FeatureBox::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepamegamenu_pro_blogformat':
      $iepa_custom_css .= IEPA_Mega_Menu_PostsFormat::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepamegamenu_pro_linkimage':
      $iepa_custom_css .= IEPA_Mega_Menu_LinkImage::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepamegamenu_pro_textimage':
      $iepa_custom_css .= IEPA_Mega_Menu_TextImage::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepa_post_category_tabs_widget':
      $iepa_custom_css .= IEPA_Mega_Menu_PostCategoryLayout::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    case 'iepa_post_category_tabs_widget_advanced':
      $iepa_custom_css .= IEPA_Mega_Menu_PostCategoryLayoutAdvanced::get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id );
      break;

    default:
      // code...
      break;
  }

}
