<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! class_exists( 'IEPA_MM_Menu_Settings' ) ) {

  /**
   * Admin Menu Settings
   */
  class IEPA_MM_Menu_Settings {
    var $iepa_mm_addon_id             = 0;
    var $iepa_mm_addon_item_id        = 0;
    var $imma_mm_addon_item_depth     = 0;
    var $iepammenu_item_meta          = array();
    /**
     * Constructor
     */
    public function __construct() {
      add_action( 'admin_menu' , array( $this , 'iepa_mm_menu_page' ) ); // add plugin menu
      add_action( 'admin_enqueue_scripts', array( $this, 'iepamegamenu_mm_admin_scripts' ) );
      add_action( 'im_menuaddon_nav_menus_scripts', array( $this, 'enqueue_menu_page_scripts' ), 9 );
      add_action( 'admin_post_iepamegamenu_mm_save_settings', array( $this, 'iepamegamenu_mm_save_settings' ) ); //recieves the posted values from general settings
      /* custom metabox to enable */

      add_action( 'admin_head', array( $this, 'addIEPAMegamenuMetaBox' ) ); // Metabox on left of menu to enable megamenu

      add_action( 'admin_footer', array( $this, 'iepa_admin_footer_function' ) );

      add_action( 'wp_ajax_iepammsavesettings', array( $this, 'wp_save_settings' ) ); //ajax iepa menu settings save to options


      add_action( 'wp_ajax_iepa_mm_show_lightbox_html', array( $this, 'iepa_mm_getlightbox_by_ajax' ) );
      add_action( 'wp_ajax_iepa_mm_save_menuitem_settings', array( $this, 'save_menuitem_settings_byajax' ) ); //save ajax data of each menu item

      //pre available templates setting customized options as per menu location
      add_action( 'wp_ajax_iepa_mm_show_custom_option', array( $this, 'iepa_mm_customized_templates_option' ) );
      add_action( 'wp_ajax_iepammsavecustomsettings', array( $this, 'wp_save_custom_settings' ) ); //ajax iepa menu settings save to options

      //features
      add_action( 'admin_init' , array( $this, 'iepamegamenu_custom_menu_items_meta_box' ) );
      add_filter( 'iepa_mm_custom_menu_item_types' , array( $this, 'iepa_mm_custom_menu_item_types' ) );

      add_action( 'wp_ajax_iepa_mm_save_menu_group_settings', array( $this, 'save_menu_group_settings' ) );
      add_action( 'wp_ajax_iepa_mm_edit_menu_group_settings', array( $this, 'edit_menu_group_settings' ) );

      add_filter( 'siteorigin_panels_is_admin_page', array( $this, 'enable_site_origin_page_builder' ) );

      if ( function_exists( 'siteorigin_panels_admin_enqueue_scripts' ) ) {
        add_action( 'admin_print_scripts-nav-menus.php', array( $this, 'siteorigin_panels_admin_enqueue_scripts' ) );
      }

      if ( function_exists( 'siteorigin_panels_admin_enqueue_styles' ) ) {
        add_action( 'admin_print_styles-nav-menus.php', array( $this, 'siteorigin_panels_admin_enqueue_styles' ) );
      }
      add_action( 'init', array( $this, 'iepa_mm_add_excerpt_support_for_pages' ) );
    }

    /**
     * Enables the Excerpt meta box in Page edit screen.
     */
    public function iepa_mm_add_excerpt_support_for_pages() {
      add_post_type_support( 'page', 'excerpt' );
    }


    /**
    * Enqueue Site Origin Page Builder scripts on nav-menus page.
    */
    public function enable_site_origin_page_builder( $enabled ) {
      $screen = get_current_screen();

      if ( $screen->base == 'nav-menus' ) {
        return true;
      }

      return $enabled;
    }


    /**
    * Enqueue Page Builder scripts https ://wordpress.org/plugins/siteorigin-panels
    */
    public function siteorigin_panels_admin_enqueue_scripts() {
      siteorigin_panels_admin_enqueue_scripts( '', true );
    }


    /**
    * Enqueue Page Builder styles
    */
    public function siteorigin_panels_admin_enqueue_styles() {
      siteorigin_panels_admin_enqueue_styles( '', true );
    }


    /**
    * Return the default settings for each menu item
    */
    public static function iepa_mm_menu_item_defaults() {

      $defaults = array(
        'menu_type'                     => 'flyout', //flyout or megamenu
        'group_type'                    => 'single', //single or multiple group for mega menu only
        // 'total_group'            => '', //single or multiple group for mega menu only
        'panel_columns'                 => 6, // total number of columns displayed in the panel
        'iepa_mega_menu_columns'        => 1, // for sub menu items, how many columns to span in the panel,
        'iepa_group_mega_menu_columns'  => 1, // for sub menu items, how many columns to span in the panel,
        'iepa_menu_order'               => 0,
        'general_settings'              => array(
          'active_link'             => 'true',
          'disable_text'            => 'false',
          'disable_desc'            => 'false',
          'visible_hidden_menu'     => 'false',
          'hide_arrow'              => 'false',
          'hide_on_mobile'          => 'false',
          'hide_on_desktop'         => 'false',
          'menu_icon'               => 'disabled',
          'hide_icon_mobile'        => 'disabled',
          'active_single_menu'      => 'disabled',   //useful for custom single menu links
          'menu_align'              => 'left',      //default as left with left or right menitem useful for custom search bar:Right aligned items will appear in reverse order on the right hand side of the menu bar
          'top_menu_label'          => '',         // Hot! , New! for top menu
          'hide_sub_menu_on_mobile' => 'false',
          'submenu_align'           => 'left',       //left or right, // flyout menu
          'show_menu_to_users'      => 'always_show',
          'choose_trigger_effect'   => 'onhover',
          'tabbed_animation'        => 'fadeInDown'
        ),
        'mega_menu_settings'            => array(
          'horizontal-menu-position'  => 'full-width', //full-width, center, left-edge and right-edge
          'vertical-menu-position'    => 'full-height', //full-height or aligned-to-parent
          'show_top_content'          => 'true',
          'show_bottom_content'       => 'true',
          'top'                         => array(
            'top_content_type'     => 'text_only',
            'top_content'          => '',
            'image_url'            =>  '',
            'html_content'         => ''
          ),
          'bottom'                      => array(
            'bottom_content_type'  => 'text_only',
            'bottom_content'       => '',
            'image_url'            => '',
            'html_content'         => ''
          ),
          'choose_menu_type'         => 'default',  // for default as sub menu and search form display with custom content for shortcodes.
          'custom_content'           => ''
        ),
        'flyout_settings'               => array(
          'flyout-position'          => 'right',       //left or right
          'vertical-position'        => 'full-height',// full-hegiht or aligned-to-parent,
        ),
        'icons_settings'                => array(
          'icon_choose'              => '',
          'enable_customimg'         => 'false',
          'custom_image_url'         => '',
          'custom_width'             => '',
          'custom_height'            => '',
        ),
        'upload_image_settings'        => array(
          'use_custom_settings'        => 'false',
          'text_position'              => 'left' ,          // left image, right image or onlyimage , for : above, below and image only.
          'display_posts_images'       =>'featured-image', //featured-image or custom-image of posts
          'default_thumbnail_imageurl' => '',
          'show_description'           => 'true',
          'show_desc_length'           => '',
          'display_readmore'           => 'true',
          'readmore_text'              => 'Read more >>',
          'display_post_date'          => 'true',
          'display_author_name'        => 'true',
          'display_cat_name'           => 'true',
          'image_size'                 => 'default',
          'enable_custom_inherit'      => '1',
          'custom_width'               => '',
          'enable_bg_image'            => 'false',
          'bg_image_type'              => 'single', //single or double
          'single_bg_image_url'        => '',
          'bg_image_url1'              => '',
          'bg_image_url2'              => '',
          'image_position'             => 'left top',
          'image_repeat'               => 'no-repeat',
          'cross_fading_type'          => 'changeonhover' //changeonhover or changeontimer
        ),
        // 'custom_extra_settings'        => array(
        //        'content_type'        => 'none',
        //        'content_description' => '',
        //        // 'content_html'        => '',
        //        'shortcodes'          => '',
        //       ),
        'custom_styling'              => array(
          'enable_custom_styling'         => 'false',
          'enable_menu_bg_color'          => '',
          'menu_background_color'         => '',
          'enable_menu_bg_hover_color'    => '',
          'menu_bg_hover_color'           => '',
          'enable_menu_font_color'        => '',
          'menu_font_color'               => '',
          'enable_menu_font_hover_color'  => '',
          'menu_font_hover_color'         => '',
          'enable_submenu_megamenu_width' => '',
          'submenu_megamenu_width'        => '',
          'enable_submenu_bg_color'       => '',
          'submenu_bg_color'              => '',
          'enable_menu_icon_color'        => '',
          'menu_icon_color'               => '',
          'enable_menu_icon_hover_color'  => '',
          'menu_icon_hover_color'         => '',
          'enable_sub_cfont_color'        => '',
          'submenu_cfont_color'           => '',
          'enable_sub_heading_font_color' =>  '',
          'sub_heading_font_color'        =>  '',
        ),
        'restriction_roles' =>  array(
          'display_mode'  => 'show_to_all', // loggedinusers,loggedoutusers, all_users, by_role
          'roles_type'    => '', //adminsitrator, editor, subscriber, shop manager, customer,author, contributer.
        ),
      );
      $iepa_mm_default_settings = get_option( 'iepa_mm_default_settings' );
      if ( empty( $iepa_mm_default_settings ) ) {
        update_option( 'iepa_mm_default_settings', $defaults );
      }

      return $iepa_mm_default_settings;
    }

    /*
    * Includes ALl Class Files Here
    */
    function iepa_mm_menu_page() {
      add_submenu_page(
        'ibtana-visual-editor',
        __( 'Mega Menu Settings', IEPA_TEXT_DOMAIN ),
        __( 'Mega Menu Settings', IEPA_TEXT_DOMAIN ),
        'manage_options',
        'iepa-mega-menu',
        array( $this, 'iepa_mm_main_page' )
      );
    }

    /*
     * Main Settings Page
     */
    function iepa_mm_main_page() {
      include_once( IEPA_MM_PATH . '/inc/backend/main_page.php' );
    }

    /*
    *  Saves General Settings to database
    */
    function iepamegamenu_mm_save_settings() {
      if( !empty( $_POST ) && wp_verify_nonce( $_POST['iepammmegamenu-nonce-setup'], 'iepammmegamenu-nonce' ) ) {

        if( isset( $_POST['settings_submit'] ) ) {

          include_once( IEPA_MM_PATH . '/inc/backend/save_settings.php' );

        } else if( isset( $_POST['restore_old_settings'] ) ) {

          $default_settings = IEPA_MM_Activation::iepa_mm_default_settings();
          update_option( 'iepamega_settings', $default_settings );
          wp_redirect( admin_url( 'admin.php?page=iepa-mega-menu&message=2' ) );

        }
      } else {
        die( 'No script kiddies please!' );
      }
    }


    /*
     *  Admin Enqueue style and js
     */
    function iepamegamenu_mm_admin_scripts( $hook ) {

      $plugin_pages = array(
        IEPA_TEXT_DOMAIN,
        'imma-theme-settings',
        'imma-how-to-use',
        'imma-add-theme-',
        'imma-edit-theme-',
        'imma-about-us',
        'iepa-mega-menu',
        'imma-export-demo-settings'
      );

      if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $plugin_pages ) ) {
        wp_enqueue_style( 'im_menuaddon-bootstrap-style', IEPA_MM_CSS_DIR . '/bootstrap.min.css', array(), IEPA_VERSION );
        wp_enqueue_style( 'im_menuaddon-verticaltabs-style', IEPA_MM_CSS_DIR . '/bootstrap.vertical-tabs.css', array(), IEPA_VERSION );

        wp_enqueue_script( 'im_menuaddon-bootstrap-scripts', IEPA_MM_JS_DIR . '/bootstrap.min.js', array( 'jquery' ), IEPA_VERSION );

        wp_enqueue_style( 'im_menuaddon-admin-style', IEPA_MM_CSS_DIR . '/backend.css', array(), IEPA_VERSION );

        wp_enqueue_style( 'iepamegamenu-icon-picker-genericons', IEPA_MM_CSS_DIR . '/iepa-mm-icons/genericons.css', array(), IEPA_VERSION );
        wp_enqueue_style( 'iepamegamenu-icon-picker-icomoon', IEPA_MM_CSS_DIR . '/iepa-mm-icons/icomoon.css', array(), IEPA_VERSION );
        wp_enqueue_style( 'iepamegamenu-icon-picker-fontawesome', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fontawesome.css', array(), IEPA_VERSION );

        wp_enqueue_style( 'imma-codemirror-css', IEPA_MM_CSS_DIR . '/syntax/codemirror.css', array(), IEPA_VERSION );
        wp_enqueue_script( 'imma-codemirror-js', IEPA_MM_JS_DIR . '/syntax/codemirror.js', array( 'jquery' ), IEPA_VERSION );
        wp_enqueue_script(
          'imma-codemirror-css-js',
          IEPA_MM_JS_DIR . '/syntax/css.js',
          array( 'jquery', 'imma-codemirror-js' ),
          IEPA_VERSION
        );
        wp_enqueue_style( 'wp-color-picker' ); //for including color picker css
        wp_enqueue_script(
          'im_menuaddon-color-alpha-scripts',
          IEPA_MM_JS_DIR . '/wp-color-picker-alpha.js',
          array( 'wp-color-picker' ),
          IEPA_VERSION,
        );
        wp_enqueue_style( 'im_menuaddon-admin-style2', IEPA_MM_CSS_DIR . '/available-style.css', array(), IEPA_VERSION );

        wp_enqueue_style( 'iepa-custom-select-css', IEPA_MM_CSS_DIR . '/bootstrap-select.min.css', array(), IEPA_VERSION );
        wp_enqueue_script(
          'im-menuaddon-custom-select-js',
          IEPA_MM_JS_DIR . '/bootstrap-select.min.js',
          array(
            'jquery',
            'im_menuaddon-bootstrap-scripts'
          ),
          IEPA_VERSION
        );
      }

      if( $hook == "nav-menus.php" ) {
        wp_enqueue_script( 'accordion' );
        wp_enqueue_style( 'wp-color-picker' ); //for including color picker css
        wp_enqueue_script( 'wp-color-picker' );

        wp_enqueue_script( 'im_menuaddon-color-alpha', IEPA_MM_JS_DIR . '/wp-color-picker-alpha.js', array( 'jquery' ,'wp-color-picker' ), IEPA_VERSION, true );

        wp_enqueue_script( 'im_menuaddon-color-alpha', IEPA_MM_JS_DIR . '/wp-color-picker-alpha.js', array( 'jquery' , 'wp-color-picker' ), IEPA_VERSION );
        wp_enqueue_style( 'im_menuaddon-admin-style2', IEPA_MM_CSS_DIR . '/available-style.css', array(), IEPA_VERSION );
      }


      wp_enqueue_script(
        'im_menuaddon-admin-scripts',
        IEPA_MM_JS_DIR . '/backend.js',
        array(
          'jquery',
          'jquery-ui-core',
          'wp-color-picker',
          // 'im-menuaddon-custom-select-js'
        ),
        IEPA_VERSION,
        false
      );

    }

    /**
     * Enqueue required CSS and JS for Ibtana Mega Menu
     */
    function enqueue_menu_page_scripts( $hook ) {

      if( 'nav-menus.php' != $hook ) {
        return;
      }

      // Get the WP Version global.
      global $wp_version;
      if( $wp_version >= "4.8" ) {
        wp_enqueue_editor();
        $version = "addeditor";
      } else {
        $version = "noeditor";
      }

      $iepa_mm_variable = array(
        'plugin_javascript_path'  =>  IEPA_MM_JS_DIR,
        'check_version'           =>  $version,
        'depth_check_message'     =>  __( 'Option only available for top level menu.', IEPA_TEXT_DOMAIN ),
        'success_msg'             =>  __( 'Successfully Saved.', IEPA_TEXT_DOMAIN ),
        'saving_msg'              =>  __( 'Saving Data.', IEPA_TEXT_DOMAIN ),
        'saved_msg'               =>  __( 'Saved.', IEPA_TEXT_DOMAIN ),
        'group_edit_message'      =>  __( 'Edit this Group.', IEPA_TEXT_DOMAIN ),
        'menu_lightbox'           =>  __( "Ibtana Mega Menu", IEPA_TEXT_DOMAIN ),
        'ajax_url'                =>  esc_url( admin_url() . 'admin-ajax.php' ),
        'checked_disabled_error'  =>  __( "Please enable Ibtana Mega Menu using the IEPA Mega Menu Settings on left section of this page.", IEPA_TEXT_DOMAIN ),
        'checked_enable_megamenu' =>  __( "Please enable Ibtana Mega Menu from above option at first.", IEPA_TEXT_DOMAIN ),
        'template_check'          =>  __( 'Choose pre available template at first.', IEPA_TEXT_DOMAIN ),
        'location_check'          =>  __( 'Choose menu location at first and save the menu.', IEPA_TEXT_DOMAIN ),
        'ajax_nonce'              =>  wp_create_nonce( 'iepa-mm-ajax-nonce' ),
        'is_ive_loaded'           =>  did_action( 'ibtana-visual-editor/loaded' )
      );
      wp_localize_script( 'im_menuaddon-admin-scripts', 'iepa_mm_variable', $iepa_mm_variable ); //localization of php variable in edn-frontend-js

      if ( class_exists( 'Tribe_Image_Widget' ) ) {
        $image_widget = new Tribe_Image_Widget;
        $image_widget->admin_setup();
      }
      wp_deregister_script('codemirror');
      wp_deregister_style('codemirror');

      wp_enqueue_style( 'iepa-mega-menu', IEPA_MM_CSS_DIR . '/backend.css', array(), IEPA_VERSION );
      wp_enqueue_media();

      wp_enqueue_script('accordion');
      wp_enqueue_style('wp-color-picker'); //for including color picker css
      wp_enqueue_script( 'wp-color-picker' );
      wp_enqueue_script( 'im_menuaddon-color-alpha', IEPA_MM_JS_DIR . '/wp-color-picker-alpha.js', array( 'jquery' , 'wp-color-picker' ), IEPA_VERSION );

      wp_enqueue_style( 'iepamegamenu-linecon-css', IEPA_MM_CSS_DIR . '/iepa-mm-icons/linecon.css', array(), IEPA_VERSION );

      wp_enqueue_style( 'iepamegamenu-icon-picker-genericons', IEPA_MM_CSS_DIR . '/iepa-mm-icons/genericons.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-icomoon', IEPA_MM_CSS_DIR . '/iepa-mm-icons/icomoon.css', array(), IEPA_VERSION );
      wp_enqueue_script( 'iepamegamenu-linearicons', IEPA_MM_JS_DIR . '/svgembedder.min.js' );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fontawesome', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fontawesome.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fa-solid', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fa-solid.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fa-regular', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fa-regular.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker-fa-brands', IEPA_MM_CSS_DIR . '/iepa-mm-icons/fa-brands.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-font-awesome-style', IEPA_MM_CSS_DIR . '/iepa-mm-icons/font-awesome.min.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-linearicons', IEPA_MM_CSS_DIR . '/iepa-mm-icons/icon-font.min.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-themify', IEPA_MM_CSS_DIR . '/iepa-mm-icons/themify-icons.css', array(), IEPA_VERSION );
      wp_enqueue_style( 'iepamegamenu-icon-picker', IEPA_MM_CSS_DIR . '/iepa-mm-icons/icon-picker.css', array(), IEPA_VERSION );
      wp_enqueue_script( 'iepamegamenu-icon-picker-script', IEPA_MM_JS_DIR . '/icon-picker.js', array( 'jquery' ), IEPA_VERSION );

      wp_enqueue_script( 'iepa-mega-menu', IEPA_MM_JS_DIR . '/admin-menu.js', array(
        'jquery',
        'jquery-ui-core',
        'jquery-ui-sortable',
        'wp-color-picker',
        'jquery-ui-accordion',
        'iepamegamenu-icon-picker-script'
      ), IEPA_VERSION );


    }


    function displayArr( $array ) {
      echo "<pre>";
      print_r( $array );
      echo "</pre>";
    }

    /*
    * IEPA MEGA MENU METABOX
    */
    function addIEPAMegamenuMetaBox() {
      if ( did_action( 'ibtana-visual-editor/loaded' ) ) {
        if ( wp_get_nav_menus() ) {
          add_meta_box(
            'nav-menu-theme-iepamegamenus',
            __( 'Select Ibtana Mega Menu Settings', IEPA_TEXT_DOMAIN ),
            array( $this, 'createIEPAMegamenuMetaBox' ),
            'nav-menus',
            'side',
            'high'
          );
        }
      }
    }

    /*
    *  Metabox Location
    */
    function createIEPAMegamenuMetaBox() {

      $menulocations = array();

      ?>
      <div class='iepa_mm_megamenu-custom_metaBox'>
        <?php

        /* Get menu id of current opened page */
        $mynavmenus         = wp_get_nav_menus( array( 'orderby' => 'name' ) );

        $total_pgcount      = wp_count_posts( 'page' ); // get total page count here
        $count              = count( $mynavmenus );
        $getselectedmenuid  = ( isset( $_GET['menu'] ) ? (int) sanitize_text_field( $_GET['menu'] ) : 0 );
        $newscreen          = ( isset( $_GET['menu'] ) && $_GET['menu'] == 0 ) ? true : false;
        if( count( get_registered_nav_menus() ) == 1 && ! $newscreen && empty( $mynavmenus ) && ! empty( $total_pgcount->publish ) ) {
          $themelocationnomenus = 1;
        } else {
          $themelocationnomenus = 0;
        }
        $recentlyeditednavmenu = absint( get_user_option( 'nav_menu_recently_edited' ) ); //get recently edited nav menu
        if ( empty( $recentlyeditednavmenu ) && is_nav_menu( $getselectedmenuid ) ) {
          $recentlyeditednavmenu = $getselectedmenuid;
        }
        if ( empty( $getselectedmenuid ) && ! isset( $_GET['menu'] ) ) {
          if( is_nav_menu( $recentlyeditednavmenu ) ) {
            $getselectedmenuid = $recentlyeditednavmenu; // use recently nav menu if none are selected
          }
        }
        if ( ! $newscreen && $count > 0 && isset( $_GET['action'] ) ) {
          if( $_GET['action'] == 'delete' ) {
            $getselectedmenuid = $mynavmenus[0]->term_id; //on deletion of menu, if another menu exists, show it
          }
        }
        if ( $themelocationnomenus == 1 ) { //set get selected menu id to 0 if there is no any menus
          $getselectedmenuid = 0;
        } else if ( ! empty( $mynavmenus ) && ! $newscreen && empty( $getselectedmenuid ) ) {
          $getselectedmenuid = $mynavmenus[0]->term_id; // no any menu so set first one menu
        }

        /* Get menu location of specific menu id/return the locations that a specific menu ID has been tagged to.*/
        $get_all_registered_menu_locations  = get_registered_nav_menus();  //Returns all registered navigation menu locations in a theme.
        $navmenu_locations                  = get_nav_menu_locations(); // Returns an array with the registered navigation menu locations and the menu assigned to it

        foreach ( $get_all_registered_menu_locations as $id => $title ) {
          if ( isset( $navmenu_locations[ $id ] ) && $navmenu_locations[$id] == $getselectedmenuid ) {
            $menulocations[$id] = $title;
          }
        }

        $check_menu_count = count( $menulocations );

        $menu_general_settings = get_option( 'iepamegabox_settings' );

        if ( !$check_menu_count ) {
          ?>
          <p>
            <?php
            esc_html_e(
              "To Enable Ibtana Mega Menu, First please assign this menu to theme location. This Menu is not assigned to any theme location yet.",
              IEPA_TEXT_DOMAIN
            );
            ?>
          </p>
          <?php
        } else if( !count( $get_all_registered_menu_locations ) ) {
          ?>
          <p>
            <?php
            esc_html_e(
              "Please create a new menu location in order to activate IEPA Mega Menu. This Theme does not have any menu location created yet.",
              IEPA_TEXT_DOMAIN
            );
            ?>
          </p>
          <?php
        } else {

          if ( $check_menu_count == 1 ) {
            $getlocations = array_keys( $menulocations );
            $location     = $getlocations[0];
            if ( isset( $menulocations[ $location ] ) ) {
              include( IEPA_MM_PATH . '/inc/backend/metabox_field/add_metabox_field.php' );
            }
          } else { // create accordion for multiple theme location if assigned to menu
            ?>
            <div id='iepamegamenu_accordion'>
              <?php
              foreach ( $get_all_registered_menu_locations as $location => $menu_name ) {
                if ( isset( $menulocations[ $location ] ) ) {
                  ?>
                  <h3 class='theme_settings'>
                    <?php echo esc_html( $menu_name ); ?>
                  </h3>

                  <div class='accordion_content' style='display: none;'>
                    <?php
                    include( IEPA_MM_PATH . '/inc/backend/metabox_field/add_metabox_field.php' );
                    ?>
                  </div>
                <?php
                }
              }
              ?>
            </div>
            <?php
          }
          ?>
          <p class="submit">
            <input name="submit" id="submit" class="button button-primary iepa-mega-menu-save button-primary alignright" value="Save" type="submit">
          </p>
          <span class='iepa_mm_loader' style="display:none;">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/ajax-loader.svg' ); ?>" />
          </span>
          <div class='iepamm_success'></div>
          <?php
        }
        ?>
      </div>
      <?php
    }

    public function wp_save_custom_settings() {
      check_ajax_referer( 'iepa-mm-ajax-nonce', 'wp_nonce' );
      $submitcustom_settings = array();
      if ( isset( $_POST['iepamenuid'] ) && $_POST['iepamenuid'] > 0 ) {
        if( is_nav_menu( sanitize_text_field( $_POST['iepamenuid'] ) ) && isset( $_POST['iepa_megamenu_cmeta'] ) ) {
          $megacustom_metadata      = sanitize_text_field( $_POST['iepa_megamenu_cmeta'] );
          $getparsedsubmitcsettings = json_decode( stripslashes( $megacustom_metadata ), true );
          $iepamegabox_csettings    = get_option( 'iepamegabox_csettings' );
          foreach ( $getparsedsubmitcsettings as $key => $value ) {
            $titlee = $value['name'];
            preg_match_all( "/\[(.*?)\]/", $titlee, $matchess );
            if ( isset( $matchess[1][0] ) && isset( $matchess[1][1] ) ) {
              $mymlocation = $matchess[1][0];
              $mycsetting = $matchess[1][1];
              $submitcustom_settings[$mymlocation][$mycsetting] = $value['value'];
            }
          }
          if (!$iepamegabox_csettings) {
            update_option( 'iepamegabox_csettings', $submitcustom_settings );
          } else {
            $setup_custom_settings = get_option( 'iepamegabox_csettings' );
            $csettings = array_merge( $setup_custom_settings, $submitcustom_settings );
            update_option( 'iepamegabox_csettings', $csettings );
          }
        }
      }
      wp_die();
    }


    /**
    * Ajax Save Widget Menu Settings  Data (submitted from Menus Page Meta Box)
    */
    public function wp_save_settings() {
      check_ajax_referer( 'iepa-mm-ajax-nonce', 'wp_nonce' );
      $submitsettings = array();
      if ( isset( $_POST['wp_menu_id'] ) && $_POST['wp_menu_id'] > 0 ) {
        if( is_nav_menu( sanitize_text_field( $_POST['wp_menu_id'] ) ) && isset( $_POST['im_menuaddon_meta'] ) ) {
          $megametadata             = sanitize_text_field( $_POST['im_menuaddon_meta'] );
          $getparsedsubmitsettings  = json_decode( stripslashes( $megametadata ), true );
          $iepamegabox_settings     = get_option( 'iepamegabox_settings' );
          foreach ( $getparsedsubmitsettings as $key => $val ) {
            $title = $val['name'];
            preg_match_all( "/\[(.*?)\]/", $title, $matches );
            if ( isset( $matches[1][0] ) && isset( $matches[1][1] ) ) {
              $mylocation = $matches[1][0];
              $mysetting = $matches[1][1];
              $submitsettings[$mylocation][$mysetting] = $val['value'];
            }
          }

          if (!$iepamegabox_settings) {
            update_option( 'iepamegabox_settings', $submitsettings );
          } else {
            $setupsettings = get_option( 'iepamegabox_settings' );
            $settings = array_merge( $setupsettings, $submitsettings );
            update_option( 'iepamegabox_settings', $settings );
          }
        }
      }
      wp_die();
    }

    public function iepa_mm_customized_templates_option() {
      check_ajax_referer( 'iepa-mm-ajax-nonce', 'wp_nonce' );
      if( isset( $_POST ) && $_POST['mlocation'] != '' && $_POST['templatetype'] != '' ) {
        $mlocation              = sanitize_text_field( $_POST['mlocation'] );
        $templatetype           = sanitize_text_field( $_POST['templatetype'] );
        $menu_general_settings  = get_option( 'iepamegabox_csettings' );
        include( IEPA_MM_PATH . '/inc/backend/metabox_field/templates-custom-options.php' );
      }
    }

    public function iepa_mm_getlightbox_by_ajax() {
      check_ajax_referer( 'iepa-mm-ajax-nonce', 'wp_nonce' );
      if( isset( $_POST ) && $_POST['menu_item_id'] != '' && $_POST['menu_id'] != '' ) {
        $menu_item_title  = sanitize_text_field( $_POST['menu_item_title'] );
        $menuitemid       = intval( sanitize_text_field( $_POST['menu_item_id'] ) );
        $menuid           = intval( sanitize_text_field( $_POST['menu_id'] ) );
        $menuitemdepth    = intval( sanitize_text_field( $_POST['menu_item_depth'] ) );
        if ( isset( $menuitemid ) ) {
          $this->iepa_mm_addon_item_id  = absint( $menuitemid );
          $alreadysaved_settings        = array_filter( (array) get_post_meta( $this->iepa_mm_addon_item_id, '_iepamegamenu', true ) );
          $this->iepammenu_item_meta    = $alreadysaved_settings;
        }
        $this->imma_mm_addon_item_depth = absint( $menuitemdepth );
        $this->iepa_mm_addon_id         = ( isset( $menuid ) ? absint( $menuid ) : '' );
        $menu_item_id                   = $this->iepa_mm_addon_item_id;
        $menu_id                        = $this->iepa_mm_addon_id;
        $menu_item_depth                = $this->imma_mm_addon_item_depth;
        $iepammenu_item_meta            = $this->iepammenu_item_meta;

        if ( $menu_item_depth > 0 ) {
          include( IEPA_MM_PATH.'inc/backend/menu_settings/submenu_settings.php' );
        } else {
          include( IEPA_MM_PATH.'inc/backend/menu_settings/top_menu_settings.php' );
        }

      }
      wp_die();
    }


    public static function save_menuitem_settings_byajax() {
      check_ajax_referer( 'iepa-mm-ajax-nonce', '_wpnonce' );

      $iepa_mm_menu_item_id = absint( sanitize_text_field( $_POST['iepa_mm_menu_item_id'] ) );

      $iepa_settings = array();

      if( isset( $_POST['iepa_settings'] ) && is_array( $_POST['iepa_settings'] ) && $iepa_mm_menu_item_id > 0 ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'iepa_mm_menugrouplists';
        if ( isset( $_POST['iepa_settings']['menu_type'] ) && isset( $_POST['iepa_settings']['group_type'] ) ) {
          $iepa_settings['menu_type']  = sanitize_text_field( $_POST['iepa_settings']['menu_type'] );
          $iepa_settings['group_type'] = sanitize_text_field( $_POST['iepa_settings']['group_type'] );

          $resultss = (
            isset( $_POST['iepa_settings']['total_results'] ) && !empty( $_POST['iepa_settings']['total_results'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['iepa_settings']['total_results'] ) ) : array()
          );
          if( $_POST['iepa_settings']['group_type'] == "multiple" && !empty( $resultss ) ) {
            $submenulists   = IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['iepa_settings']['submenulists'] ) );
            $checked_lists  = sanitize_text_field( $_POST['iepa_settings']['checked_lists'] );
            if( $checked_lists == "grouplists" ) {
              $widget_details = $submenulists;
            } else {
              $widget_details = array(
                '0' => array(
                  'group_no' => '1',
                  'lists' =>  $submenulists
                ),
              );
            }

            $imma_menu_detailss = $wpdb->get_row( "SELECT * FROM $table_name where menuid = $iepa_mm_menu_item_id" );

            if( empty( $imma_menu_detailss ) ) {

              $idata = $wpdb->insert( $table_name, array(
                'menuid'          =>  $iepa_mm_menu_item_id,
                'totalgroup'      =>  1,
                'group_type'      =>  sanitize_text_field( $_POST['iepa_settings']['group_type'] ),
                'widget_details'  =>  serialize( $widget_details ),
                'group_details'   =>  serialize( $resultss ),
              ),
                array(
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s'
                )
              );
              $results = $wpdb->query( $idata );
            } else {
              $idata = $wpdb->update(
                $table_name,
                array(
                  'totalgroup'      =>  1,
                  'group_type'      =>  sanitize_text_field( $_POST['iepa_settings']['group_type'] ),
                  'widget_details'  =>  serialize( $widget_details ),
                  'group_details'   =>  serialize( $resultss )
                ),
                array( 'menuid' => $iepa_mm_menu_item_id ),
                array(
                  '%s',
                  '%s',
                  '%s',
                  '%s'
                ),
                array( '%d' )
              );
              $results = $wpdb->query( $idata );
            }



          }
        } else if ( isset( $_POST['iepa_settings']['menu_type'] ) && isset( $_POST['iepa_settings']['panel_columns'] ) ) {
          $iepa_settings['menu_type']      = sanitize_text_field( $_POST['iepa_settings']['menu_type'] );
          $iepa_settings['panel_columns']  = sanitize_text_field( $_POST['iepa_settings']['panel_columns'] );
        } else {
          //general settings
          $iepa_settings['general_settings']['disable_text']         = ( isset( $_POST['iepa_settings']['general_settings']['disable_text'] ) && $_POST['iepa_settings']['general_settings']['disable_text'] == true ) ? 'true' : 'false';
          $iepa_settings['general_settings']['disable_desc']         = ( isset( $_POST['iepa_settings']['general_settings']['disable_desc'] ) && $_POST['iepa_settings']['general_settings']['disable_desc'] == true ) ? 'true' : 'false';
          $iepa_settings['general_settings']['active_link']          = ( isset( $_POST['iepa_settings']['general_settings']['active_link'] ) && $_POST['iepa_settings']['general_settings']['active_link'] == true ) ? 'true' : 'false';
          $iepa_settings['general_settings']['visible_hidden_menu']  = ( !isset( $_POST['iepa_settings']['general_settings']['visible_hidden_menu'] ) ? 'false' : 'true' );
          $iepa_settings['general_settings']['hide_arrow']           = ( !isset( $_POST['iepa_settings']['general_settings']['hide_arrow'] ) ? 'false' : 'true' );
          $iepa_settings['general_settings']['hide_on_mobile']       = ( !isset( $_POST['iepa_settings']['general_settings']['hide_on_mobile'] ) ? 'false' : 'true' );
          $iepa_settings['general_settings']['hide_on_desktop']      = ( !isset( $_POST['iepa_settings']['general_settings']['hide_on_desktop'] ) ? 'false' : 'true' );
          $iepa_settings['general_settings']['menu_icon']            = ( !isset( $_POST['iepa_settings']['general_settings']['menu_icon'] ) ? 'disabled' : 'enabled' );
          //show menu icon enabled true
          $iepa_settings['general_settings']['active_single_menu']     = isset( $_POST['iepa_settings']['general_settings']['active_single_menu'] ) ? 'enabled' : 'disabled';
          $iepa_settings['general_settings']['choose_trigger_effect']  = ( isset( $_POST['iepa_settings']['general_settings']['choose_trigger_effect'] ) && $_POST['iepa_settings']['general_settings']['choose_trigger_effect'] == "onclick" ) ? 'onclick' : 'onhover';

          //sub custom settings
          $iepa_settings['upload_image_settings']['use_custom_settings'] = isset( $_POST['iepa_settings']['upload_image_settings']['use_custom_settings'] ) ? 'true' : 'false';
          $iepa_settings['upload_image_settings']['show_description']    = isset( $_POST['iepa_settings']['upload_image_settings']['show_description'] ) ? 'true' : 'false';
          $iepa_settings['upload_image_settings']['display_readmore']    = isset( $_POST['iepa_settings']['upload_image_settings']['display_readmore'] ) ? 'true' : 'false';
          $iepa_settings['upload_image_settings']['display_post_date']   = isset( $_POST['iepa_settings']['upload_image_settings']['display_post_date'] ) ? 'true' : 'false';
          $iepa_settings['upload_image_settings']['display_author_name'] = isset( $_POST['iepa_settings']['upload_image_settings']['display_author_name'] ) ? 'true' : 'false';
          $iepa_settings['upload_image_settings']['display_cat_name']    = isset( $_POST['iepa_settings']['upload_image_settings']['display_cat_name'] ) ? 'true' : 'false';

          //megamenu settings
          // $iepa_settings['general_settings']['hide_sub_menu_on_mobile'] = (!isset($_POST['iepa_settings']['general_settings']['hide_sub_menu_on_mobile'])?'disabled':$_POST['iepa_settings']['general_settings']['hide_sub_menu_on_mobile']);
          $iepa_settings['mega_menu_settings']['show_top_content']     = ( !isset( $_POST['iepa_settings']['mega_menu_settings']['show_top_content'] ) ? 'false' : 'true' );
          $iepa_settings['mega_menu_settings']['show_bottom_content']  = ( !isset( $_POST['iepa_settings']['mega_menu_settings']['show_bottom_content'] ) ? 'false' : 'true' );

          $iepa_settings['mega_menu_settings']['top']['top_content_type']        = ( isset( $_POST['iepa_settings']['mega_menu_settings']['top']['top_content_type'] ) ? sanitize_text_field( $_POST['iepa_settings']['mega_menu_settings']['top']['top_content_type'] ) : 'text_only' );
          $iepa_settings['mega_menu_settings']['bottom']['bottom_content_type']  = ( isset( $_POST['iepa_settings']['mega_menu_settings']['bottom']['bottom_content_type'] ) ? sanitize_text_field( $_POST['iepa_settings']['mega_menu_settings']['bottom']['bottom_content_type'] ) : 'text_only' );
          $iepa_settings['mega_menu_settings']['top']['top_content']             = ( isset( $_POST['iepa_settings']['mega_menu_settings']['top']['top_content'] ) ? sanitize_text_field( $_POST['iepa_settings']['mega_menu_settings']['top']['top_content'] ) : '' );
          $iepa_settings['mega_menu_settings']['bottom']['bottom_content']       = ( isset( $_POST['iepa_settings']['mega_menu_settings']['bottom']['bottom_content'] ) ? sanitize_text_field( $_POST['iepa_settings']['mega_menu_settings']['bottom']['bottom_content'] ) : '' );

          $iepa_settings['mega_menu_settings']['top']['image_url']       = (
            isset( $_POST['iepa_settings']['mega_menu_settings']['top']['image_url'] ) ? esc_url_raw( $_POST['iepa_settings']['mega_menu_settings']['top']['image_url'] ) : ''
          );
          $iepa_settings['mega_menu_settings']['bottom']['image_url']    = (
            isset( $_POST['iepa_settings']['mega_menu_settings']['bottom']['image_url'] ) ? esc_url_raw( $_POST['iepa_settings']['mega_menu_settings']['bottom']['image_url'] ) : ''
          );
          $iepa_settings['mega_menu_settings']['top']['html_content']    = (
            isset( $_POST['iepa_settings']['mega_menu_settings']['top']['html_content'] ) && wp_kses_post( $_POST['iepa_settings']['mega_menu_settings']['top']['html_content'] ) != ''
            ) ? wp_kses_post( $_POST['iepa_settings']['mega_menu_settings']['top']['html_content'] ) : '';
          $iepa_settings['mega_menu_settings']['bottom']['html_content'] = (
            isset( $_POST['iepa_settings']['mega_menu_settings']['bottom']['html_content'] ) && wp_kses_post( $_POST['iepa_settings']['mega_menu_settings']['bottom']['html_content'] ) != ''
            ) ? wp_kses_post( $_POST['iepa_settings']['mega_menu_settings']['bottom']['html_content'] ) : '';

          $iepa_settings['restriction_roles']['display_mode'] = (
            isset( $_POST['iepa_settings']['restriction_roles']['display_mode'] ) && $_POST['iepa_settings']['restriction_roles']['display_mode'] != ''
            ) ? sanitize_text_field( $_POST['iepa_settings']['restriction_roles']['display_mode'] ) : 'show_to_all';
        }
        $get_all_settings = get_post_meta( $iepa_mm_menu_item_id, '_iepamegamenu', true );
        if ( is_array( $get_all_settings ) ) {
          $iepa_settings = array_merge( $get_all_settings, $iepa_settings );
        }
        update_post_meta( $iepa_mm_menu_item_id, '_iepamegamenu', $iepa_settings );
      }
      if ( ob_get_contents() ) ob_clean();
      wp_send_json_success();

    }

    public function iepa_admin_footer_function() {
      $allowed_html = array(
        'div'      => array(
          'class' =>  array(),
          'id'    =>  array(),
          'style' =>  array()
        ),
        'span'  =>  array(
          'class' =>  array()
        )
      );
      echo wp_kses( "<div class='iepa_menu_wrapper'><div class='iepa_overlay'></div>", $allowed_html );
      echo wp_kses( "<div id='iepa_menu_settings_frame' class='iepa-d-none'><div class='imma_frame_header'>", $allowed_html );
      echo wp_kses( "<span class='close_btn'>x</span></div>", $allowed_html );
      echo wp_kses( "<div class='imma_main_content'></div></div></div>", $allowed_html );
      echo wp_kses( "<div class='immapro-templates-custom-wrapper iepa-d-none'></div>", $allowed_html );
    }

    /**
    * Returns the menu ID for a specified menu location, defaults to 0
    */
    private function imma_get_menu_id_for_location( $location ) {

      $locations = get_nav_menu_locations();

      $id = isset( $locations[ $location ] ) ? $locations[ $location ] : 0;

      return $id;

    }

    /* Features added */

    /*
    *  Ibtana Mega Menu Advanced Menu Items
    */
    function iepamegamenu_custom_menu_items_meta_box() {
      if ( wp_get_nav_menus() ) {
        add_meta_box(
          'imma_custom_nav_items',
          __( 'Ibtana Advanced Menu Items', IEPA_TEXT_DOMAIN ),
          array( $this, 'iepa_mm_custom_menu_items_meta_box' ),
          'nav-menus',
          'side',
          'low'
        );
      }
    }

    public function iepa_mm_custom_menu_items_meta_box() {
      global $_nav_menu_placeholder, $nav_menu_selected_id;
      $items = $this->iepa_get_custom_menu_item_types();
      ?>
      <div id="iepamegamenu-custom-menu-metabox" class="posttypediv">
        <div id="tabs-panel-iepamegamenu-custom" class="tabs-panel tabs-panel-active">
          <ul id ="iepamegamenu-custom-checklist" class="categorychecklist form-no-clear">

            <?php
            foreach( $items as $id => $item ) :
              $url  = '#iepamegamenu-' . $id;
              if( isset( $item['url'] ) ) {
                $url  = $item['url'];
              }
              ?>
              <li>
                <label class="menu-item-title">
                  <input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ) ?>][menu-item-label]" value="0"> <?php echo esc_html( $item['label'] ); ?>
                  <span class="iepammega-tooltip">
                    <?php echo esc_html( $item['desc'] ); ?>
                  </span>
                </label>
                <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ) ?>][menu-item-type]" value="custom">
                <input type="hidden" class="menu-item-iepamegamenu-custom" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ) ?>][menu-item-iepamegamenu-custom]" value="on">
                <input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ) ?>][menu-item-title]" value="<?php echo esc_attr( $item['title'] ); ?>">
                <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ) ?>][menu-item-url]" value="<?php echo esc_attr( $url ); ?>">
              </li>

            <?php endforeach; ?>

          </ul>
        </div>
        <p class="button-controls">
          <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-iepamegamenu-custom-menu-item" id="submit-iepamegamenu-custom-menu-metabox">
            <span class="spinner"></span>
          </span>
        </p>
      </div>
      <?php
    }



    public function iepa_get_custom_menu_item_types() {
      $items['tabs']  = array(
        'label'   =>  __( 'Vertical Tabs Block' , IEPA_TEXT_DOMAIN ),
        'title'   =>  '['.__( 'Tabs' , IEPA_TEXT_DOMAIN ) . ']',
        'panels'  =>  array( 'tabs' , 'responsive' ),
        'desc'    =>  __( '(A group of vertical tabs.)' , IEPA_TEXT_DOMAIN ),
        'url'     =>  '#iepamegamenupro-vertical-tabs',
      );
      $items['horizontal_tabs'] = array(
        'label'   =>  __( 'Horizontal Tabs Block' , IEPA_TEXT_DOMAIN ),
        'title'   =>  '['.__( 'HTabs' , IEPA_TEXT_DOMAIN ) . ']',
        'panels'  =>  array( 'tabs' , 'responsive' ),
        'desc'    =>  __( '(A group of horizontal tabs.)' , IEPA_TEXT_DOMAIN ),
        'url'     =>  '#iepamegamenupro-horizontal-tabs',
      );
      return $items;
    }


    /**
    * Save multiple group added menu id wise
    */
    public static function save_menu_group_settings() {
      global $wpdb;
      check_ajax_referer( 'iepa-mm-ajax-nonce', '_wpnonce' );

      $iepa_mm_menu_item_id = absint( sanitize_text_field( $_POST['iepa_mm_menu_item_id'] ) );
      $act                  = sanitize_text_field( $_POST['iepa_mm_group_settings']['act'] );
      $resultss             = (
        isset( $_POST['iepa_mm_group_settings']['total_results'] ) && !empty( $_POST['iepa_mm_group_settings']['total_results'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['iepa_mm_group_settings']['total_results'] ) ) : array()
      );
      $widget_details       = ( isset( $_POST['iepa_mm_group_settings']['widget_details'] ) && !empty( $_POST['iepa_mm_group_settings']['widget_details'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['iepa_mm_group_settings']['widget_details'] ) ) : array() );

      if( isset( $_POST['iepa_mm_group_settings'] ) && is_array( $_POST['iepa_mm_group_settings'] ) && $iepa_mm_menu_item_id > 0 ) {

        $table_name = $wpdb->prefix .'iepa_mm_menugrouplists';

        $iepa_mm_menu_details = $wpdb->get_row( "SELECT * FROM $table_name where menuid = $iepa_mm_menu_item_id" );

        if( $act == "add" ) {
          if( empty( $iepa_mm_menu_details ) ) {
            $idata = $wpdb->insert(
              $table_name,
              array(
                'menuid'          =>  $iepa_mm_menu_item_id,
                'totalgroup'      =>  sanitize_text_field( $_POST['iepa_mm_group_settings']['totgroup'] ),
                'group_type'      =>  'multiple',
                'group_details'   =>  serialize( $resultss ),
                'widget_details'  =>  serialize( $widget_details )
              ),
              array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
              )
            );
            //  $results = $wpdb->query( $idata );
          } else {

            $idata = $wpdb->update(
              $table_name,
              array(
                'totalgroup'      =>  sanitize_text_field( $_POST['iepa_mm_group_settings']['totgroup'] ),
                'group_type'      =>  'multiple',
                'group_details'   =>  serialize( $resultss ),
                'widget_details'  =>  serialize( $widget_details )
              ),
              array( 'menuid' => $iepa_mm_menu_item_id ),
              array(
                '%d',
                '%s',
                '%s',
                '%s'
              ),
              array( '%d' )
            );
            // $wpdb->print_error();
          }
        } else {
          //delete by updating group
          if( empty( $resultss ) ) {
            $wpdb->delete( $table_name, array( 'menuid' => $iepa_mm_menu_item_id ), array( '%d' ) );
          } else {
            $idata = $wpdb->update(
              $table_name,
              array(
                'totalgroup'      =>  sanitize_text_field( $_POST['iepa_mm_group_settings']['totgroup'] ),
                'group_type'      =>  'multiple',
                'group_details'   =>  serialize( $resultss ),
                'widget_details'  =>  serialize( $widget_details )
              ),
              array( 'menuid' => $iepa_mm_menu_item_id ),
              array(
                '%s',
                '%s',
                '%s',
                '%s'
              ),
              array( '%d' )
            );
          }


        }
        $results = $wpdb->query( $idata );

        if ( ob_get_contents() ) ob_clean(); // remove any warnings or output from other plugins which may corrupt the response

        wp_send_json_success();

      }


    }

    /*
    * Edit Group Column Wise To database
    */
    public function edit_menu_group_settings() {
      global $wpdb;
      check_ajax_referer( 'iepa-mm-ajax-nonce', '_wpnonce' );

      $iepa_mm_menu_item_id = absint( sanitize_text_field( $_POST['iepa_mm_menu_item_id'] ) );
      $total_group_columns  = (
        isset( $_POST['iepa_mm_group_settings']['total_group_columns'] ) && !empty( $_POST['iepa_mm_group_settings']['total_group_columns'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['iepa_mm_group_settings']['total_group_columns'] ) ) : array()
      );
      $groupwidgets         = (
        isset( $_POST['iepa_mm_group_settings']['groupwidgets'] ) && !empty( $_POST['iepa_mm_group_settings']['groupwidgets'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['iepa_mm_group_settings']['groupwidgets'] ) ) : array()
      );
      if( isset( $_POST['iepa_mm_group_settings'] ) && is_array( $_POST['iepa_mm_group_settings'] ) && $iepa_mm_menu_item_id > 0 ) {
        $table_name = $wpdb->prefix . 'iepa_mm_menugrouplists';
        $iepa_mm_menu_details = $wpdb->get_row("SELECT * FROM $table_name where menuid = $iepa_mm_menu_item_id");
        if( empty( $iepa_mm_menu_details ) ) {
          $idata = $wpdb->insert(
            $table_name, array(
              'menuid'          =>  $iepa_mm_menu_item_id,
              'totalgroup'      =>  sanitize_text_field( $_POST['iepa_mm_group_settings']['totgroup'] ),
              'group_type'      =>  'multiple',
              'group_details'   =>  serialize( $total_group_columns ),
              'widget_details'  =>  serialize( $groupwidgets )
            ),
            array(
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s'
            )
          );
          $results = $wpdb->query( $idata );
        } else {
          $idata = $wpdb->update(
            $table_name,
            array(
              'totalgroup'      =>  sanitize_text_field( $_POST['iepa_mm_group_settings']['totgroup'] ),
              'group_type'      =>  'multiple',
              'group_details'   =>  serialize( $total_group_columns ),
              'widget_details'  =>  serialize( $groupwidgets )
            ),
            array( 'menuid' => $iepa_mm_menu_item_id ),
            array(
              '%s',
              '%s',
              '%s',
              '%s'
            ),
            array( '%d' )
          );
          $results = $wpdb->query( $idata );
        }
      }
      if ( ob_get_contents() ) ob_clean(); // remove any warnings or output from other plugins which may corrupt the response
      wp_send_json_success();
    }
  }

  $global['menu_obj'] = new IEPA_MM_Menu_Settings();

}
