<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

if ( !class_exists( 'IEPA_MM_Enqueue_Scripts' ) ) {

  class IEPA_MM_Enqueue_Scripts extends IEPA_MM_Libary {


    /**
    * Enqueue all the necessary JS and CSS
    *
    * since @1.0.0
    */
    function __construct() {

      add_action( 'wp_enqueue_scripts', array( $this, 'iepa_megamenu_frontend_scripts' ), 100 );
      add_action( 'wp_head', array( $this, 'prefix_add_header_scripts' ) );
      add_action( 'wp_footer', array( $this, 'prefix_add_footer_scripts' ) );
      add_action( 'admin_enqueue_scripts', array( $this, 'wp_admin_enqueue_scripts' ), 11 );
    }


    public function prefix_add_header_scripts() {
      $options            = get_option( 'iepamega_settings' );
      $enable_mobile      = ( isset( $options['enable_mobile'] ) && $options['enable_mobile'] == 1 ) ? 1 : 0;
      $fonts_final_arr    = array();
      $menu_settings      = get_option( 'iepamegabox_settings' );
      $content            = '';
      $iepa_custom_theme  = array();

      if( isset( $menu_settings ) && !empty( $menu_settings ) ) {

        foreach ( $menu_settings as $lkey => $val ) {
          $enabled_mm   =  ( isset( $val['enabled'] ) && $val['enabled'] == 1 ) ? 1 : 0;
          $theme_type   =  ( isset( $val['theme_type'] ) && $val['theme_type'] == 'available_skins' ) ? 'available_skins' : 'custom_themes';
          $themeid      =  ( isset( $val['theme'] ) && $val['theme'] != '' ) ? intval( $val['theme'] ) : 1;
          $orientation  =  ( isset( $val['orientation'] ) && $val['orientation'] == 'horizontal' ) ? 'horizontal' : 'vertical';
          if( $enabled_mm == 1 && $theme_type == 'custom_themes' ) {
            $menuthemes = (array) IEPA_MM_Theme_Settings::get_custom_theme_rowdata( $themeid );
            $theme_slug = '.iepamega-' . $menuthemes['slug'];
            if( isset( $menuthemes['theme_settings'] ) && !empty( $menuthemes['theme_settings'] ) ) {
              $iepa_custom_theme = unserialize( $menuthemes['theme_settings'] );
            } else {
              $iepa_custom_theme = array();
            }
            $font_family            = ( isset( $iepa_custom_theme['menu_bar']['font_family'] ) ) ? $iepa_custom_theme['menu_bar']['font_family'] : 'Open Sans';
            $menu_label_font_family = ( isset( $iepa_custom_theme['top_menu']['menu_label_font_family'] ) ) ? $iepa_custom_theme['top_menu']['menu_label_font_family'] : '';
            $font_family3           = ( isset( $iepa_custom_theme['widgets']['font_family'] ) ) ? $iepa_custom_theme['widgets']['font_family'] : 'bold';
            $content_font_family3   = ( isset( $iepa_custom_theme['widgets']['content_font_family'] ) ) ? $iepa_custom_theme['widgets']['content_font_family'] : 'Open Sans';
            $font_family4           = ( isset( $iepa_custom_theme['top_section']['font_family'] ) ) ? $iepa_custom_theme['top_section']['font_family'] : 'Open Sans';
            $font_family5           = ( isset( $iepa_custom_theme['bottom_section']['font_family'] ) ) ? $iepa_custom_theme['bottom_section']['font_family'] : 'Open Sans';
            $font_family6           = ( isset( $iepa_custom_theme['flyout']['font_family'] ) ) ? $iepa_custom_theme['flyout']['font_family'] : 'Open Sans';
            $font_popup_family      = ( isset( $iepa_custom_theme['search_bar']['font_popup_family'] ) ) ? $iepa_custom_theme['search_bar']['font_popup_family'] : '';
            $fonts                  = $font_family;
            $fonts5                 = $menu_label_font_family;
            $fonts1                 = $font_family3;
            $fonts2                 = $font_family4;
            $fonts3                 = $font_family5;
            $fonts4                 = $font_family6;

            $fonts_final  = str_replace( ' ', '+', $fonts );
            $fonts_final1 = str_replace( ' ', '+', $fonts1 );
            $fonts_final2 = str_replace( ' ', '+', $fonts2 );
            $fonts_final3 = str_replace( ' ', '+', $fonts3 );
            $fonts_final4 = str_replace( ' ', '+', $fonts4 );
            $fonts_final5 = str_replace( ' ', '+', $fonts5 );
            $rkey         = IEPA_MM_Libary::generateRandomIndex();
            $fonts_final_arr = array(
              '0' =>  $fonts_final,
              '1' =>  $fonts_final1,
              '2' =>  $fonts_final2,
              '3' =>  $fonts_final3,
              '4' =>  $fonts_final4,
              '5' =>  $fonts_final5
            );
            $result_fonts = array_unique( $fonts_final_arr );
            if( !empty( $result_fonts ) ) {
              foreach ( $result_fonts as $key => $value ) {
                if( $value != 'Assistant' || $value != '' || $value != 'default' ) { ?>
                  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=<?php esc_html_e( $value, 'ibtana-ecommerce-product-addons' );?>' type='text/css' media='all' />
                <?php } else { ?>
                  <link href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800&amp;subset=hebrew" rel="stylesheet" />
                <?php }
              }
            }
          }

        }

      }
    }


    /*
    * Enqueue Back-end Scripts
    */
    function wp_admin_enqueue_scripts( $hooks ) {
      if ( 'nav-menus.php' == $hooks ) {
        do_action( "im_menuaddon_nav_menus_scripts", $hooks );
      }
    }


    /*
    * Load script to footer
    */
    public function prefix_add_footer_scripts() {

      if ( !parent::$is_ibtana_mega_menu_enabled ) {
        return;
      }

      $options          = get_option( 'iepamega_settings' );
      $enable_custom_js = ( isset( $options['enable_custom_js'] ) && $options['enable_custom_js'] == 1 ) ? '1' : '0';
      $custom_js        = ( isset( $options['custom_js'] ) ) ? $options['custom_js'] : '';
      if( $enable_custom_js == 1 ) {
        if( $custom_js != '' ) {
          ?>
          <script type="text/javascript">
          <?php echo $custom_js; ?>
          </script>
          <?php
        }
      }
    }


    function iepa_megamenu_frontend_scripts() {

      if ( !parent::$is_ibtana_mega_menu_enabled ) {
        return;
      }

      //Get General Settings
      $options        = get_option( 'iepamega_settings' ); // Variables for JS scripts

      $enable_mobile  = ( isset( $options['enable_mobile'] ) && $options['enable_mobile'] == 1 ) ? '1' : '0';

      $enable_rtl     = ( isset( $options['enable_rtl'] ) && $options['enable_rtl'] == 1 ) ? '1' : '0';
      if( $enable_mobile == 1 ) {
        wp_enqueue_style( 'iepa-responsive-stylesheet', IEPA_MM_CSS_DIR . '/responsive.css', array(), IEPA_VERSION );
      }
      if( is_rtl() && $enable_rtl == 1 ) {
        wp_enqueue_style( 'iepa-style-rtl', IEPA_MM_CSS_DIR . '/style-rtl.css', array(), IEPA_VERSION );
      }
      wp_enqueue_style( 'iepa-animate-css', IEPA_MM_CSS_DIR . '/animate.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepa-colorbox', IEPA_MM_CSS_DIR . '/colorbox.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepa-frontwalker-stylesheet', IEPA_MM_CSS_DIR . '/frontend_walker.css', array(), IEPA_VERSION );
      wp_enqueue_style(
        'iepa-google-fonts-style',
        "//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700"
      );

      wp_enqueue_style( 'iepa-bxslider-style', IEPA_MM_CSS_DIR . '/jquery.bxslider.css', array(), IEPA_VERSION );
      wp_enqueue_script( 'iepa-jquery-bxslider-min', IEPA_MM_JS_DIR . '/jquery.bxslider.min.js', array( 'jquery' ), IEPA_VERSION );

      wp_enqueue_script( 'iepa_megamenu_actual_scripts', IEPA_MM_JS_DIR . '/jquery.actual.js', array( 'jquery' ), IEPA_VERSION );
      wp_enqueue_script( 'iepa_megamenu_colorbox', IEPA_MM_JS_DIR . '/jquery.colorbox.js', array( 'jquery' ), IEPA_VERSION );
      wp_enqueue_script( 'iepa_megamenu-frontend_scripts', IEPA_MM_JS_DIR . '/frontend.js', array( 'jquery' ), IEPA_VERSION, true );
      wp_enqueue_script( 'iepa_megamenu_validate_scripts', IEPA_MM_JS_DIR . '/jquery.validate.js', array( 'jquery' ), IEPA_VERSION );

      wp_register_script( 'iepa_ajax-auth-script', IEPA_MM_JS_DIR . '/ajax-auth-script.js', array( 'jquery' ), IEPA_VERSION );
      wp_enqueue_script( 'iepa_ajax-auth-script' );

      if( IEPA_MM_Libary::is_woocommerce_activated() ) {
        $wooenabled = "true";
      } else {
        $wooenabled = "false";
      }
      $mlabel_animation_type      = ( isset( $options['mlabel_animation_type'] ) ) ? $options['mlabel_animation_type'] : 'none';
      $animation_delay            = ( isset( $options['animation_delay'] ) ) ? $options['animation_delay'] : '2';
      $animation_duration         = ( isset( $options['animation_duration'] ) ) ? $options['animation_duration'] : '3';
      $animation_iteration_count  = ( isset( $options['animation_iteration_count'] ) ) ? $options['animation_iteration_count'] : '1';
      wp_localize_script(
        'iepa_megamenu-frontend_scripts',
        'iepa_megamenu_params',
        array(
          'iepa_mobile_toggle_option'       =>  esc_attr( $options['mobile_toggle_option'] ),
          'iepa_enable_rtl'                 =>  $enable_rtl,
          'iepa_event_behavior'             =>  esc_attr( $options['advanced_click'] ), //click_submenu or follow_link
          'iepa_ajaxurl'                    =>  admin_url( 'admin-ajax.php' ),
          'iepa_ajax_nonce'                 =>  wp_create_nonce( 'wpm-ajax-nonce' ),
          'check_woocommerce_enabled'       =>  $wooenabled,
          'iepa_mlabel_animation_type'      =>  esc_attr( $mlabel_animation_type ),
          'iepa_animation_delay'            =>  esc_attr( $animation_delay ),
          'iepa_animation_duration'         =>  esc_attr( $animation_duration ),
          'iepa_animation_iteration_count'  =>  esc_attr( $animation_iteration_count ),
          'enable_mobile'                   =>  $enable_mobile,
          'iepa_sticky_opacity'             =>  ( isset( $options['sticky_opacity'] ) ? esc_attr( $options['sticky_opacity'] ) : '' ),
          'iepa_sticky_offset'              =>  ( isset( $options['sticky_offset'] ) ? esc_attr( $options['sticky_offset'] ) : '' ),
          'iepa_sticky_zindex'              =>  ( isset( $options['sticky_zindex'] ) ? esc_attr( $options['sticky_zindex'] ) : '' )
        )
      );

      wp_localize_script(
        'iepa_ajax-auth-script',
        'iepa_megamenu_ajax_auth_object',
        array(
          'ajaxurl'         =>  admin_url( 'admin-ajax.php' ),
          'redirecturl'     =>  home_url(),
          'loadingmessage'  =>  __( 'Sending user info, please wait...', 'ibtana-ecommerce-product-addons' )
        )
      );

      wp_enqueue_style( 'iepamegamenu-linecon-css', IEPA_MM_CSS_DIR . '/iepa-mm-icons/linecon.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'dashicons' );
      wp_enqueue_style( 'iepamegamenu-genericons', IEPA_MM_CSS_DIR . '/iepa-mm-icons/genericons.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icomoon', IEPA_MM_CSS_DIR . '/iepa-mm-icons/icomoon.css', array(), IEPA_VERSION );
      wp_enqueue_script( 'iepamegamenu-linearicons', IEPA_MM_JS_DIR . '/svgembedder.min.js' );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fontawesome', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fontawesome.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fa-solid', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fa-solid.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fa-regular', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fa-regular.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fa-brands', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fa-brands.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-font-awesome-style', IEPA_MM_CSS_DIR . '/iepa-mm-icons/font-awesome.min.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-linearicons', IEPA_MM_CSS_DIR . '/iepa-mm-icons/icon-font.min.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-themify', IEPA_MM_CSS_DIR . '/iepa-mm-icons/themify-icons.css', array(), IEPA_VERSION );
      /*         wp_dequeue_style('iepamegamenu-icon-picker-fontawesome');
      wp_dequeue_style('iepamegamenu-icon-picker-fa-solid');
      wp_dequeue_style('iepamegamenu-icon-picker-fa-regular');
      wp_dequeue_style('iepamegamenu-icon-picker-fa-regular');
      wp_dequeue_style('iepamegamenu-icon-picker-fa-brands');
      wp_dequeue_style('iepamegamenu-font-awesome-style');*/
    }



  }

  new IEPA_MM_Enqueue_Scripts();
}
