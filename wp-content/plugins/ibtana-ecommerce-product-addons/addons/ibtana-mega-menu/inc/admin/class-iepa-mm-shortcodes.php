<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'IMMA_Shortcodes' ) ) {
  class IMMA_Shortcodes extends IEPA_MM_Libary {
    /**
     * Executes Shortcodes
     *
     * @since 1.0.0
     */
    function __construct() {
      add_shortcode( 'im_menuaddon_search_form', array( $this, 'imma_generate_search_shortcode' ) );
      add_shortcode( 'iepamegamenu', array( $this, 'imma_print_menu_shortcode' ) );
      add_filter( 'woocommerce_add_to_cart_fragments',  array( $this, 'imma_cart_header_one_link_fragment' ) ); //latest woocommerce
      add_shortcode( 'im_menuaddon_login_form', array( $this, 'login_form_shortcode' ) );
      add_shortcode( 'im_menuaddon_register_form', array( $this, 'register_form_shortcode' ) );
      add_action( 'wp_ajax_nopriv_ajaxlogin', array( $this, 'ajax_login' ) );
      add_action( 'wp_ajax_nopriv_ajaxregister', array( $this, 'ajax_register' ) );
    }


    /**
     * Add Login Form with form Using Shortcode
     * [im_menuaddon_login_form]
     **/
    function login_form_shortcode( $atts ) {
      global $post;
      extract( shortcode_atts( array(
        'title' => 'Login',
      ), $atts ) );
      ob_start();
        include( IEPA_MM_PATH.'inc/backend/iepa_mm_login_form.php' );
        $html = ob_get_contents();
      ob_get_clean();
      return $html;
    }

    /**
     * Add Register Form with form Using Shortcode
     * [im_menuaddon_register_form]
     **/
    function register_form_shortcode( $atts ) {
      global $post;
      extract( shortcode_atts( array(
        'title' => 'Register',
      ), $atts ) );
      ob_start();
        include( IEPA_MM_PATH.'inc/backend/iepa_mm_login_form.php' );
        $html = ob_get_contents();
      ob_get_clean();
      return $html;
    }

    /**
     * Add Search icon with form Using Shortcode
     * [im_menuaddon_search_form template_type="inline-search" style="inline-toggle-left"] or
     * [im_menuaddon_search_form template_type="inline-search" style="inline-toggle-right"]
     * [im_menuaddon_search_form template_type="popup-search-form"] //pro
     * [im_menuaddon_search_form template_type="megamenu-type-search"]
     **/
    function imma_generate_search_shortcode( $atts, $content = null ) {
      extract( shortcode_atts( array( 'template_type' => '', 'stype' => '' ), $atts ) );
      ob_start();
        include(IEPA_MM_PATH. 'inc/backend/iepa_mm_search_shortcode.php' );
        $html = ob_get_contents();
      ob_get_clean();
      return $html;
    }


    /*
     *  Display Menu Using Shortcode [iepamegamenu menu_location=primary]
     */
    function imma_print_menu_shortcode( $atts, $content = null ) {
      extract( shortcode_atts( array( 'menu_location' => null ), $atts ) );
      if ( !isset( $menu_location ) ) {
        return false;
      }
      if ( has_nav_menu( $menu_location ) ) {
        $settings               = get_option( 'iepamegabox_settings' ); //get all plugin metabox data
        $current_theme_location = $menu_location; // get current menu location i.e primary
        if ( isset ( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == 1 ) {

          if( isset( $settings[ $current_theme_location ]['theme_type'] ) && $settings[ $current_theme_location ]['theme_type'] == "custom_themes" ) {
            $skin_type = "iepa-mm-custom-theme";
          } else {
            $skin_type = '';
          }
          if( $skin_type =="iepa-mm-custom-theme" ) {
            IEPA_MM_Libary::get_custom_designs( $current_theme_location, $settings );
          }
          return wp_nav_menu( array( 'theme_location' => $menu_location, 'echo' => false ) );
        }
      }
      return "<!-- Menu Location Not found for [iepamegamenu menu_location={$menu_location}] -->";
    }

    public static function imma_cart_header_one_link_fragment( $fragments ) {
      global $woocommerce;
      ob_start();
      $version              = '2.5';
      $woo_settings         = get_option( 'iepa_mm_woo_settings' );

      $woo_cart_display     = sanitize_text_field( $woo_settings['woo_cart_display'] );
      $cart_display_pattern = sanitize_text_field( $woo_settings['cart_display_pattern'] );
      $enable_custom_image  = sanitize_text_field( $woo_settings['enable_custom_image'] );
      $custom_image_url     = sanitize_text_field( $woo_settings['custom_image_url'] );
      $custom_width         = sanitize_text_field( $woo_settings['custom_width'] );
      $custom_height        = sanitize_text_field( $woo_settings['custom_height'] );
      $nameimage[0]         = sanitize_text_field( $woo_settings['nameimage'] );
      $attr_class           = sanitize_text_field( $woo_settings['attr_class'] );
      $class                = sanitize_text_field( $woo_settings['class'] );
      $icon_class           = sanitize_text_field( $woo_settings['icon_class'] );

     if( version_compare( $woocommerce->version, $version, ">=" ) ) {
       $cart_url = wc_get_cart_url();
     } else {
       $cart_url = $woocommerce->cart->get_cart_url();
     }
     ?>
     <a class="imma-cart-contentsone <?php echo esc_attr( $class ); ?>"
       href="<?php echo esc_url( $cart_url ); ?>"
       title="<?php esc_attr_e( 'View your shopping cart', IEPA_TEXT_DOMAIN ); ?>">
       <?php
       if( $enable_custom_image == "1" ) {
         //enable custom icon ?>
         <img src="<?php echo esc_url( $custom_image_url ); ?>" alt="<?php echo esc_attr( $nameimage[0] ); ?>" width="<?php echo esc_attr( $custom_width ); ?>" height="<?php echo esc_attr( $custom_height ); ?>">
       <?php } else {
         //show font icon instead
         if( $attr_class != '' ) {
           ?>
           <i class="iepa-mega-menu-icon <?php echo esc_attr( $icon_class ); ?>" aria-hidden="true"></i>
         <?php }
       }

       switch ( $woo_cart_display ) {
         case 'icon_only':
          # Icon Only
          break;
         case 'item_only':
          # Icon & Items Only
          if( IEPA_MM_Libary::is_woocommerce_activated() ) {
            ?>
            <span class='imma-cart-count'>
              <?php echo wp_kses_data( sprintf( WC()->cart->get_cart_contents_count() ) ); ?>
            </span>
          <?php }
          break;
         case 'price_only':
          # Icon & Price Only
          if( IEPA_MM_Libary::is_woocommerce_activated() ) {
            ?>
            <span class='imma-cart-amount'>
              <?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
            </span>
            <?php
          }
          break;
         case 'both_pi':
          # Icon Both Price and Items
          if( IEPA_MM_Libary::is_woocommerce_activated() ) {
            $itemcount  = wp_kses_data( sprintf( WC()->cart->get_cart_contents_count() ) );
            $amt        = wp_kses_data( WC()->cart->get_cart_subtotal());
            if( $cart_display_pattern != '' ) {
              $orginalstr         = array( "#item_count", "#price" );
              $replacestr         = array( $itemcount, $amt );
              $total_cart_display = str_replace( $orginalstr, $replacestr, $cart_display_pattern );
              ?>
              <span class='imma-cart-count'>
                <?php echo esc_html( $total_cart_display ); ?>
              </span>
              <?php
            }
          }
          break;

          default:
            # code...
            break;
       }
       ?>
     </a>
     <?php
     $fragments['a.imma-cart-contentsone'] = ob_get_clean();
     return $fragments;
   }


   /* Login Form Using Ajax */
   function ajax_login() {
     // First check the nonce, if it fails the function will break
     check_ajax_referer( 'ajax-login-nonce', 'security' );

     $username = sanitize_text_field( trim( $_POST['username'] ) );
     $password = sanitize_text_field( trim( $_POST['password'] ) );
     //$password = $wpdb->escape(sanitize_text_field($_POST['password']));

     // Nonce is checked, get the POST data and sign user on
     // Call imma_auth_user_login
     $this->imma_auth_user_login($username,$password, 'Login');

     die();
   }


   function ajax_register() {
     // First check the nonce, if it fails the function will break
     check_ajax_referer( 'ajax-register-nonce', 'security' );
     // Nonce is checked, get the POST data and sign user on
     $info = array();

     $username              = ( isset( $_POST['username'] ) && $_POST['username'] != '' ) ? sanitize_user( trim( $_POST['username'] ) ) : '';
     $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = $username;
     $info['user_pass']     = sanitize_text_field( $_POST['password'] );
     $info['user_email']    = sanitize_email( $_POST['email'] ) ;

     // Register the user
     $user_register = wp_insert_user( $info );
     if ( is_wp_error( $user_register ) ) {
       $error  = $user_register->get_error_codes();

       if( in_array( 'empty_user_login', $error ) ) {
         echo json_encode(
           array(
             'loggedin' => false,
             'message'  => __( $user_register->get_error_message( 'empty_user_login' ) )
           )
         );
       } elseif( in_array( 'existing_user_login', $error ) ) {
         echo json_encode(
           array(
             'loggedin' =>  false,
             'message'  =>  __( 'This username is already registered.' )
           )
         );
       } elseif( in_array( 'existing_user_email', $error ) ) {
         echo json_encode(
           array(
             'loggedin' =>  false,
             'message'  =>  __( 'This email address is already registered.' )
           )
         );
       }
     } else {
       $this->imma_auth_user_login( $info['nickname'], $info['user_pass'], 'Registration' );
     }

      die();
    }

    function imma_auth_user_login( $user_login, $password, $login ) {
      $info                   = array();
      $info['user_login']     = $user_login;
      $info['user_password']  = $password;
      $info['remember']       = false;

      //      if ( !$info['user_login'] ) {
      //            echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong Username entered.')));
      //      }else if ( !$info['user_password'] ) {
      //          echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong Password entered.')));
      //      }else{
      //         wp_set_current_user($user_verify->ID);
      //         echo json_encode(array('loggedin'=>true, 'message'=>__($login.' successful, redirecting...')));
      //      }


      $user_verify  = wp_signon( $info, false );
      if ( is_wp_error( $user_verify ) ) {
        echo json_encode(
          array(
            'loggedin'  =>  false,
            'message'   =>  __( 'Wrong username or password.' )
          )
        );
      } else {
        wp_set_current_user( $user_verify->ID );
        echo json_encode(
          array(
            'loggedin'  =>  true,
            'message'   =>  __( $login . ' successful, redirecting...' )
          )
        );
      }
      die();
    }



  }
  new IMMA_Shortcodes();
}
