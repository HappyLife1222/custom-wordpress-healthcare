<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}


include( IEPA_MM_PATH . 'inc/admin/widgets/iepamegamenu_contact_info.php' );


//======================================= Woocommerce Widget Start ==================================================//

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_pro_productlist_widget_area.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_pro_recent_products_widget_area.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_pro_products_cart_widget_area.php' );

//======================================= Woocommerce Widget END ==================================================//


include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_pro_simple_recent_posts_widget_area.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_pro_post_heading_widget.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepamegamenu_pro_blogformat.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepamegamenu_pro_textimage.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_featured_box_layout.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepamegamenu_pro_advanced_postslider.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepamegamenu_pro_linkimage.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepamegamenu_pro_gallery_image.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_post_category_tabs_widget.php' );

include( IEPA_MM_PATH . 'inc/admin/widgets/iepa_post_category_tabs_widget_advanced.php' );
