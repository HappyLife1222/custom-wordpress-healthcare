<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'IEPA_MM_PLUGIN_FILE', __FILE__ );
define( 'IEPA_MM_ABSPATH', dirname(__FILE__) . '/' );
defined( 'IEPA_MM_SOV' ) or define( 'IEPA_MM_SOV', '0.1' ); //siteorigin latest version compatible
defined( 'IEPA_MM_TITLE' ) or define( 'IEPA_MM_TITLE', 'IBTANA MEGA MENU' ); //plugin version
defined( 'IEPA_MM_CSS_PREFIX' ) or define( 'IEPA_MM_CSS_PREFIX', 'iepamega-' ); //plugin's text domain
defined( 'IEPA_MM_IMG_DIR' ) or define( 'IEPA_MM_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images' ); //plugin image directory
defined( 'IEPA_MM_JS_DIR' ) or define( 'IEPA_MM_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );  //plugin js directory
defined( 'IEPA_MM_CSS_DIR' ) or define( 'IEPA_MM_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' ); // plugin css dir
defined( 'IEPA_MM_DYNAMIC_CSS_DIR' ) or define( 'IEPA_MM_DYNAMIC_CSS_DIR', plugin_dir_url( __FILE__ ) . 'iepa-mm-dynamic-css/' ); // plugin css dir
defined( 'IEPA_MM_PATH' ) or define( 'IEPA_MM_PATH', plugin_dir_path( __FILE__ ) );
defined( 'IEPA_MM_DYNAMIC_CSS_PATH' ) or define( 'IEPA_MM_DYNAMIC_CSS_PATH', plugin_dir_path( __FILE__ ) . 'iepa-mm-dynamic-css/');
defined( 'IEPA_MM_URL' ) or define( 'IEPA_MM_URL', plugin_dir_url( __FILE__ ) ); //plugin directory url

if( !defined('IEPA_MEGAMENU_ITEM_OPTIONS') ) {
  define( 'IEPA_MEGAMENU_ITEM_OPTIONS', 'iepa-mega-mm-menu-item-options' );
}
if( !defined('IEPA_MEGAMENU_MENU_LOCATION') ) {
  define( 'IEPA_MEGAMENU_MENU_LOCATION', 'iepa-mega-mm-menu-location' );
}



/* library*/
require_once IEPA_MM_PATH . 'inc/admin/libs/iepa-mm-libary.php';
require_once IEPA_MM_PATH . 'inc/frontend/core/iepa_mm_walker_class.php';
require_once IEPA_MM_PATH . 'inc/admin/iepamegamenu-widget.php';

if( !class_exists( 'IMMA_Class_Pro' ) ) {
  /**
  * Plugin's main class
  */
  class IMMA_Class_Pro extends IEPA_MM_Libary {
    // var $iepamega_settings;

    function __construct() {
      $this->imma_mega_menu_includes();
      // $this->iepamega_settings = get_option( 'iepamega_settings' );
      if ( is_admin() ) {
        new IEPA_MM_Menu_Widget_Manager();
      }
      $imma_theme_settings = new IEPA_MM_Theme_Settings();
    }

    /*
    * Includes Files
    */
    public function imma_mega_menu_includes() {
      include( IEPA_MM_PATH . 'inc/admin/class-iepa-mm-activation.php' );
      include( IEPA_MM_PATH . 'inc/admin/menu_settings_class.php' );
      include( IEPA_MM_PATH . 'inc/admin/theme_settings_class.php' );
      include( IEPA_MM_PATH . 'inc/admin/class-register-widgets.php' );
      include( IEPA_MM_PATH . 'inc/admin/class-iepa-mm-shortcodes.php' );
      include( IEPA_MM_PATH . 'inc/admin/widget-manager_class.php' );

      include( IEPA_MM_PATH . 'inc/admin/class-iepa-mm-enqueue-scripts.php' );
      include( IEPA_MM_PATH . 'inc/admin/class-dynamic-css.php' );

      //include( IEPA_MM_PATH . 'inc/admin/class-aristath-dynamic-css.php' );
      include( IEPA_MM_PATH . 'inc/frontend/IEPAMegamenuWalker_Class.php' );
    }

    public static function iepa_mm_shopping_cart_ajax_data(
      $woo_cart_display,
      $cart_display_pattern,
      $enable_custom_image,
      $custom_image_url,
      $custom_width,
      $custom_height,
      $nameimage,
      $icon_type,
      $icon_class,
      $customwidth,
      $customheight,
      $attr_class,
      $class
    ) {

      $woo_details = array(
        'woo_cart_display'      =>  $woo_cart_display,
        'cart_display_pattern'  =>  $cart_display_pattern,
        'enable_custom_image'   =>  $enable_custom_image,
        'custom_image_url'      =>  $custom_image_url,
        'custom_width'          =>  $custom_width,
        'custom_height'         =>  $custom_height,
        'nameimage'             =>  $nameimage,
        'icon_type'             =>  $icon_type,
        'customwidth'           =>  $customwidth,
        'customheight'          =>  $customheight,
        'icon_class'            =>  $icon_class,
        'attr_class'            =>  $attr_class,
        'class'                 =>  $class
      );

      update_option( 'iepa_mm_woo_settings',  $woo_details );
      $getsettings = get_option( 'iepa_mm_woo_settings' );
      if( IEPA_MM_Libary::is_woocommerce_activated() ) {
        $link         = function_exists( 'wc_get_cart_total' ) ? WC()->cart->wc_get_cart_total() : wc_get_cart_url();
        $html_content = '<a class="imma-cart-contentsone ' . $getsettings['class'] . '" href="' . esc_url( $link ) . '" title="View your shopping cart">';
        if( $getsettings['enable_custom_image'] == "1" ) {
          //enable custom icon
          $html_content .= "<img src=" . esc_url( $custom_image_url ) . " alt=" . esc_attr( $nameimage[0] ) . " width=" . esc_attr( $custom_width ) . " height=" . esc_attr( $custom_height ) . ">";
        } else {
          if( isset( $getsettings['icon_type'] ) && $getsettings['icon_type'] == "custom" ) {
            $html_content .= '<span class="iepa-mega-menu-icon">
            <img src="' . esc_url( $getsettings['icon_class'] ) . '" width="' . esc_attr( $getsettings['customwidth'] ) . '" height="' . esc_attr( $getsettings['customheight'] ) . '" />
            </span>';
          } else {
            $html_content .= '<i class="iepa-mega-menu-icon  ' . $getsettings['icon_class'] . '" aria-hidden="true"></i>';
          }
        }

        switch ( $getsettings['woo_cart_display'] ) {
          case 'icon_only':
            # Icon Only
            break;
          case 'item_only':
            # Icon & Items Only
            if( IEPA_MM_Libary::is_woocommerce_activated() ) {
              $html_content .= "<span class='imma-cart-count'>" .
              wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ) .
              "</span>";
            }
            break;
          case 'price_only':
            # Icon & Price Only
            if( IEPA_MM_Libary::is_woocommerce_activated() ) {
              $html_content .= "<span class='imma-cart-amount'>" . wp_kses_data( WC()->cart->get_cart_subtotal() ) . "</span>";
            }
            break;
          case 'both_pi':
            # Icon Both Price and Items
            if( IEPA_MM_Libary::is_woocommerce_activated() ) {
              $itemcount  = wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) );
              $amt        = wp_kses_data( WC()->cart->get_cart_subtotal() );
              if( $getsettings['cart_display_pattern'] != '' ) {
                $cart_display_pattern = $getsettings['cart_display_pattern'];
                $orginalstr           = array( "#item_count", "#price" );
                $replacestr           = array( $itemcount, $amt );
                $total_cart_display   = str_replace( $orginalstr, $replacestr, $cart_display_pattern );
                $html_content         .=  "<span class='imma-cart-count'>" . $total_cart_display . "</span>";
              }
            }
            break;
          default:
            # code...
            break;
        }
        $html_content .= "</a>";
      } else {
        $html_content = "";
      }
      return  $html_content;
    }
  }
  $iepammegamenu_object  = new IMMA_Class_Pro();
  $iepamega_menu_library = new IEPA_MM_Libary();
}
