<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'IEPA_MM_Register_Widgets' ) ) {
  class IEPA_MM_Register_Widgets extends IEPA_MM_Libary {
    /**
     * Executes all the tasks on Plugin activation
     *
     * @since 1.0.0
     */
    function __construct() {
      add_action( 'widgets_init',  array( $this,'iepa_mega_register_widget' ) );
      add_filter( 'widget_text', 'do_shortcode' );
      add_filter( 'black_studio_tinymce_enable_pages' , array( $this, 'iepamegamenu_blackstudio_tinymce' ) );
    }

    function iepa_mega_register_widget() {
      // register_widget( 'IEPA_Mega_Menu_Widget' );
      register_widget( 'IEPA_Mega_Menu_Contact_Info' );
      register_widget( 'IEPA_Mega_Menu_Posts_Heading_Widget' );
      // register_widget( 'IEPA_Mega_Menu_PostsTimeline' );
      register_widget( 'IEPA_Mega_Menu_PostsFormat' );
      register_widget( 'IEPA_Mega_Menu_TextImage' );
      register_widget( 'IEPA_Mega_Menu_FeatureBox' );
      register_widget( 'IEPA_MM_Simple_Recent_Posts' );
      register_widget( 'IEPA_Mega_Menu_Posts_Slider_Widget' );
      register_widget( 'IEPA_Mega_Menu_LinkImage' );
      register_widget( 'IEPA_Mega_Menu_GalleryImageWidget' );
      // register_widget( 'IEPA_Mega_Menu_HtmlText' );
      if( IEPA_MM_Libary::is_woocommerce_activated() ) {
        register_widget( 'IEPA_MM_prodlist_widget_area' );
        register_widget( 'IEPA_MM_Recent_Products_widget_area' );
        register_widget( 'IEPA_MM_Products_With_Cart_widget_area' );
        register_widget( 'IEPA_Mega_Menu_PostCategoryLayout' );
        register_widget( 'IEPA_Mega_Menu_PostCategoryLayoutAdvanced' );
      }
    }

    /**
    * Black Studio TinyMCE Compatibility.
    * Load TinyMCE assets on nav-menus.php page.
    */
    public function iepamegamenu_blackstudio_tinymce( $pages ) {
      $pages[] = 'nav-menus.php';
      return $pages;
    }



  }
  new IEPA_MM_Register_Widgets();
}
