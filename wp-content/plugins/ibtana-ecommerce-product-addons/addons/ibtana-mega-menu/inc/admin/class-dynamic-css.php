<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

if ( !class_exists( 'IEPA_MM_DYNAMIC_CSS' ) ) {

  class IEPA_MM_DYNAMIC_CSS extends IEPA_MM_Libary {

    public $stylesheet_id;

    public static $iepa_mm_frontend_dynamic_css = '';

    /**
    * Writing dynamic CSS to file instead of loading to wp_head
    *
    * @since 1.0.0
    */
    public function __construct() {
      // Replace with the ID of your own stylesheet.
      add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_dynamic_css' ), 99 );
    }

    /**
    * Enqueue the dynamic CSS.
    */
    public function enqueue_dynamic_css() {

      if ( !parent::$is_ibtana_mega_menu_enabled ) {
        return;
      }

      wp_enqueue_style( 'iepa-mm-frontend', IEPA_MM_CSS_DIR . '/style.css', [], IEPA_VERSION );

      // Widget Dynamic CSS Enqueue HERE
      $iepa_mm_sidebarwidgets = IEPA_MM_Libary::iepa_mm_sidebarwidgets() ? IEPA_MM_Libary::iepa_mm_sidebarwidgets() : [];
      if ( count( $iepa_mm_sidebarwidgets ) ) {
        $iepa_mm_frontend_dynamic_css_mode = $this->addCSSMode( 'iepa-mm-frontend-dynamic' );
        if ( ( 'file' == $iepa_mm_frontend_dynamic_css_mode ) && ( self::$iepa_mm_frontend_dynamic_css != '' ) ) {
          wp_enqueue_style( 'iepa-mm-frontend-dynamic', $this->file( 'uri', 'iepa-mm-frontend-dynamic' ), [], IEPA_VERSION );
        } elseif ( ( 'inline' == $iepa_mm_frontend_dynamic_css_mode ) && ( self::$iepa_mm_frontend_dynamic_css != '' ) ) {
          wp_add_inline_style( 'iepa-mm-frontend', self::$iepa_mm_frontend_dynamic_css );
        }
      }


      if ( 'file' == $this->addCSSMode( 'default' ) ) {
        wp_enqueue_style( 'iepa-mm-dynamic-css', $this->file( 'uri', 'default' ), [], IEPA_VERSION );
      }

      if ( 'file' == $this->addCSSMode( 'custom_responsive' ) ) {
        $options              = parent::$iepamega_settings;
        $enable_mobile        = ( isset( $options['enable_mobile'] ) && $options['enable_mobile'] == 1 ) ? '1' : '0';
        $custom_responsive_bp = (
            isset( $options['pre_responsive_bp'] ) && ( $options['pre_responsive_bp'] != '' ) && $options['pre_responsive_bp']
          ) ? intval( $options['pre_responsive_bp'] ) : '910';

        if( $enable_mobile  == 1 && $custom_responsive_bp != '910' ) {
          wp_enqueue_style( 'iepa-mm-responsive-css', $this->file( 'uri', 'custom_responsive' ), [], IEPA_VERSION );
        } else {
          $pre_responsive_bp = "910";
          wp_enqueue_style( 'iepa-mm-default-responsive-stylesheet', IEPA_MM_CSS_DIR . '/default-responsive.css', [], IEPA_VERSION );
        }
      }

      if ( 'file' == $this->addCSSMode( 'customtheme' ) ) {
        wp_enqueue_style( 'iepa-mm-custom-theme', $this->file( 'uri' ,'customtheme' ), [], IEPA_VERSION );
      }

      if ( 'file' == $this->addCSSMode( 'dynamic_css' ) ) {
        wp_enqueue_style( 'iepa-mm-extra-custom', $this->file( 'uri' ,'dynamic_css'), [], IEPA_VERSION );
      }

    }


    public function addCSSMode( $resptype ) {
      // Attempt to write to the file.
      $mode = ( $this->can_write( $resptype ) && $this->make_css( $resptype ) ) ? 'file' : 'inline';
      // Does again if the file exists.
      if ( 'file' == $mode ) {
        $mode = ( file_exists( $this->file( 'path' ) ) ) ? 'file' : 'inline';
      }
      return $mode;
    }


    public function can_write( $resptype ) {

      // global $blog_id;
      // Get the upload directory for this site.
      // $upload_dir = wp_upload_dir();
      global $wp_filesystem;
      // Initialize the Wordpress filesystem.
      if ( empty( $wp_filesystem ) ) {
        // We will probably need to load this file
        require_once( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();  // Initial WP file system
      }


      // If this is a multisite installation, append the blogid to the filename
      //  $blog_id = ( is_multisite() && $blog_id > 1 ) ? '_blog-' . $blog_id : null;

      /*$upload_dir =  ABSPATH . 'wp-content/uploads/';
      $folder_path = $upload_dir. '/iepamegamenupro';
      //$dir = trailingslashit( $upload_dir['basedir'] ) . 'iepamegamenupro/'; // Set storage directory path
      $dir = trailingslashit( $upload_dir ) . 'iepamegamenupro/'; // Set storage directory path
      */
      // IEPA_MM_DYNAMIC_CSS_PATH; //dir path
      //IEPA_MM_DYNAMIC_CSS_DIR; //url
      $upload_directory =  IEPA_MM_DYNAMIC_CSS_PATH;

      if ( class_exists( 'IEPA_Helper' ) ) {
        $upload_dir = IEPA_Helper::get_upload_dir();
        if ( isset( $upload_dir['path'] ) ) {
          $upload_directory = $upload_dir['path'];
        }
      }

      $folder_path = $upload_directory;

      if ( $folder_path ) {
        return true;
      } else {
        return false;
      }

      if ( $resptype == 'iepa-mm-frontend-dynamic' ) {
        $file_name  = '/iepa-mm-frontend-dynamic.css';
      } else if ( $resptype == 'default' ) {
        $file_name  = '/template-dynamic_style.css';
      } else if( $resptype == 'custom_responsive' ) {
        $file_name   = '/iepa-mm-temp-custom-responsive_style.css';
      } else if( $resptype == 'dynamic_css' ) {
        $file_name   = '/iepa-mm-extra-custom.css';
      } else if( $resptype == 'customtheme' ) {
        $file_name   = '/iepa-mm-custom-theme.css';
      }

      $dir = trailingslashit( $upload_directory ); // Set storage directory path

      if( ! $wp_filesystem->is_dir( $dir ) ) {
        $wp_filesystem->mkdir( $dir ); // Make a new folder for storing our file
      }

      // Does the folder exist?
      if ( file_exists( $folder_path ) ) {
        // Folder exists, but is the folder writable?
        if ( ! is_writable( $folder_path ) ) {
          // Folder is not writable.
          // Does the file exist?
          if ( ! file_exists( $folder_path . $file_name ) ) {
            // File does not exist, therefore it can't be created
            // since the parent folder is not writable.
            return false;
          } else {
            // File exists, but is it writable?
            if ( ! is_writable( $folder_path . $file_name ) ) {
              // Nope, it's not writable.
              return false;
            }
          }
        } else {
          // The folder is writable.
          // Does the file exist?
          if ( file_exists( $folder_path . $file_name ) ) {
            // File exists.
            // Is it writable?
            if ( ! is_writable( $folder_path . $file_name ) ) {
              // Nope, it's not writable
              return false;
            }
          }
        }
      } else {
        // Can we create the folder?
        // returns true if yes and false if not.
        return wp_mkdir_p( $folder_path );
      }

      // all is well!
      return true;
    }


    public function make_css( $resptype ) {
      global $wp_filesystem;
      // Initialize the Wordpress filesystem.
      if ( empty( $wp_filesystem ) ) {
        require_once( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
      }

      $content = '';

      //$content = "/********* Compiled - Do not edit *********/\n" . apply_filters( 'dynamic_css', '' );
      $options = parent::$iepamega_settings;
      $enable_mobile = ( isset( $options['enable_mobile'] ) && $options['enable_mobile'] == 1 ) ? '1' : '0';
      $custom_responsive_bp = (
          isset( $options['pre_responsive_bp'] ) && ( $options['pre_responsive_bp'] != '' ) && $options['pre_responsive_bp']
        ) ? intval( $options['pre_responsive_bp'] ) : '910';


      if ( $resptype == 'iepa-mm-frontend-dynamic' ) {
        $content = $this->get_Iepa_MM_Frontend_Dynamic_CSS();
        self::$iepa_mm_frontend_dynamic_css = $content;
      } else if( $resptype == 'default' ) {
        $content = $this->getCustomCSS();
      } else if( $resptype == 'custom_responsive' ) {
        if( $enable_mobile == 1 && $custom_responsive_bp != '910' ) {
          $content = $this->getResponsiveCustomCSS( $custom_responsive_bp );
        }
      } else if( $resptype == 'dynamic_css' ) {
        $content = $this->getExtraCSS();
      } else if( $resptype == 'customtheme' ) {
        $content = $this->getCustomThemeCSS();
      }

      // Strip protocols
      $content = str_replace( 'https://', '//', $content );
      $content = str_replace( 'http://', '//', $content );

      if ( is_writable( $this->file( 'path' , $resptype) ) || ( ! file_exists( $this->file( 'path', $resptype ) ) && is_writable( dirname( $this->file( 'path', $resptype ) ) ) ) ) {

        if ( ! $wp_filesystem->put_contents( $this->file( 'path', $resptype ), $content, FS_CHMOD_FILE ) ) {
          // Fail!
          return false;
        } else {
          // Finally, store the file
          return true;

        }

      }
    }


    public function get_Iepa_MM_Frontend_Dynamic_CSS() {

      // Widget Dynamic CSS STARTS HERE
      $iepa_custom_css = '';

      include( IEPA_MM_PATH . '/inc/frontend/generated_css/iepa_mm_frontend_dynamic.php' );

      return $iepa_custom_css;
      // Widget Dynamic CSS ENDS HERE

    }


    /*
    * Main Setting : Custom CSS Generator file for Animation, Custom CSS
    */
    public function getExtraCSS() {
      $options = parent::$iepamega_settings;
      $content = '';
      include( IEPA_MM_PATH . '/inc/frontend/generated_css/extra_css.php' );
      return $content;
    }

    /*
    * Main Setting : Custom CSS Generator file for Pre Available template on custom responsive breakpoint beside 910 as default.
    */
    public function getResponsiveCustomCSS( $custom_responsive_bp ) {
      $content = '';
      include( IEPA_MM_PATH . '/inc/frontend/generated_css/responsive_custom_css.php' );
      return $content;
    }

    /*
    * Dynamic Custom Theme CSS Generator StyleSheet File
    */
    public function getCustomThemeCSS() {
      $options = parent::$iepamega_settings;
      $enable_mobile = ( isset( $options['enable_mobile'] ) && $options['enable_mobile'] == 1 ) ? 1 : 0;
      $menu_settings = parent::$iepamegabox_settings;
      $content = '';
      $iepa_custom_theme = array();
      if( isset( $menu_settings ) && !empty( $menu_settings ) ):
        foreach ( $menu_settings as $lkey => $val ) {
          $enabled_mm   = ( isset( $val['enabled'] ) && $val['enabled'] == 1 ) ? 1 : 0;
          $theme_type   = ( isset( $val['theme_type'] ) && $val['theme_type'] == 'available_skins' ) ? 'available_skins' : 'custom_themes';
          $themeid      = ( isset( $val['theme'] ) && $val['theme'] != '' ) ? intval( $val['theme'] ) : 1;
          $orientation  = ( isset( $val['orientation'] ) && $val['orientation'] == 'horizontal' ) ? 'horizontal' : 'vertical';
          if( $enabled_mm == 1 && $theme_type == 'custom_themes' ) {
            $menuthemes = (array) IEPA_MM_Theme_Settings::get_custom_theme_rowdata( $themeid );
            $theme_slug = '.iepamega-' . $menuthemes['slug'];
            if( isset( $menuthemes['theme_settings'] ) && !empty( $menuthemes['theme_settings'] ) ) {
              $iepa_custom_theme = unserialize( $menuthemes['theme_settings'] );
            } else {
              $iepa_custom_theme = array();
            }
            include( IEPA_MM_PATH . '/inc/frontend/generated_css/custom_theme_css.php' );
          }
        }
      endif;
      return $content;

    }

    /*
    * Custom CSS Generator for Pre available templates
    */
    public function getCustomCSS() {
      $custom_settings  = get_option( 'iepamegabox_csettings' );
      $menu_settings    = parent::$iepamegabox_settings;
      $content = '';
      if( isset( $menu_settings ) && !empty( $menu_settings ) ) {
        foreach ( $menu_settings as $lkey => $val ) {
          # code...
          $enabled_mm     = ( isset( $val['enabled'] ) && $val['enabled'] == 1 ) ? 1 : 0;
          $theme_type     = ( isset( $val['theme_type'] ) && $val['theme_type'] == 'available_skins' ) ? 'available_skins' : 'custom';
          $orientation    = ( isset( $val['orientation'] ) && $val['orientation'] == 'horizontal' ) ? 'horizontal' : 'vertical';
          $available_skin = ( isset( $val['available_skin'] ) && $val['available_skin'] != '' ) ? esc_attr( $val['available_skin'] ) : 'black-white';

          if( isset( $custom_settings ) && !empty( $custom_settings ) ) {
            foreach ( $custom_settings as $location_key => $custom_value ) {
              if( $lkey == $location_key ) {
              $enable_cdesigns = ( isset( $custom_value['enable_cdesigns'] ) && $custom_value['enable_cdesigns'] == 1 ) ? 1 : 0;
                if( $enabled_mm == 1 && $enable_cdesigns == 1 && $theme_type == 'available_skins' ) {
                  include( IEPA_MM_PATH . '/inc/frontend/generated_css/dynamic_css.php' );
                }
              }
            }
          }
        }
      }
      return $content;
    }

    /*
    * Gets the css path or url to the stylesheet
    *
    * @var   string  path/url
    *
    */
    public function file( $target = 'path', $csstype = 'default' ) {

      //global $blog_id;

      // Get the upload directory for this site.
      //$upload_dir = wp_upload_dir();
      // If this is a multisite installation, append the blogid to the filename
      //$blog_id = ( is_multisite() && $blog_id > 1 ) ? '_blog-' . $blog_id : null;

      // IEPA_MM_DYNAMIC_CSS_PATH; //dir path
      //IEPA_MM_DYNAMIC_CSS_DIR; //url
      $upload_directory =  IEPA_MM_DYNAMIC_CSS_PATH;

      if ( class_exists( 'IEPA_Helper' ) ) {
        $upload_dir = IEPA_Helper::get_upload_dir();
        if ( isset( $upload_dir['path'] ) ) {
          $upload_directory = $upload_dir['path'];
        }
      }

      $folder_path = $upload_directory;
      /* $upload_dir =  ABSPATH . 'wp-content/uploads/';
      $folder_path = $upload_dir . 'iepamegamenupro';*/
      if ( $csstype == 'iepa-mm-frontend-dynamic' ) {
        $file_name   = 'iepa-mm-frontend-dynamic.css';
      } else if( $csstype == 'default' ) {
        $file_name   = 'template-dynamic_style.css';
        // $file_name   = 'template-dynamic'.$blog_id."_style.css";
      } else if( $csstype == 'custom_responsive' ) {
        $file_name   = 'iepa-mm-temp-custom-responsive_style.css';
        // $file_name   = 'imma-temp-custom-responsive'.$blog_id."_style.css";
      } else if( $csstype == 'dynamic_css' ) {
        // $file_name   = 'iepa-mm-extra-custom'.$blog_id.".css";
        $file_name   = 'iepa-mm-extra-custom.css';
      } else if( $csstype == 'customtheme' ) {
        // $file_name   = 'iepa-mm-custom-theme'.$blog_id.".css";
        $file_name   = 'iepa-mm-custom-theme.css';
      }

      // The complete path to the file.
      $file_path = $folder_path . $file_name;
      // Get the URL directory of the stylesheet

      /*$css_uri_folder = content_url().'/uploads/';
      $css_uri = trailingslashit( $css_uri_folder ) . 'iepamegamenupro' . $file_name;*/

      $css_uri_folder = IEPA_MM_DYNAMIC_CSS_DIR;
      if ( isset( $upload_dir['url'] ) ) {
        $css_uri_folder = $upload_dir['url'];
      }
      $css_uri = trailingslashit( $css_uri_folder ) . $file_name;

      // Take care of domain mapping
      /*   if ( defined( 'DOMAIN_MAPPING' ) && DOMAIN_MAPPING ) {
      if ( function_exists( 'domain_mapping_siteurl' ) && function_exists( 'get_original_url' ) ) {
      $mapped_domain   = domain_mapping_siteurl( false );
      $original_domain = get_original_url( 'siteurl' );
      $css_uri = str_replace( $original_domain, $mapped_domain, $css_uri );
      }
      }*/
      // Strip protocols
      // $css_uri = str_replace( 'https://', '//', $css_uri );
      // $css_uri = str_replace( 'http://', '//', $css_uri );
      if ( 'path' == $target ) {
        return $file_path;
      } elseif ( 'url' == $target || 'uri' == $target ) {
        $timestamp = ( file_exists( $file_path ) ) ? '?timestamp=' . filemtime( $file_path ) : '';
        return $css_uri . $timestamp;
      }

    }

  }

  new IEPA_MM_DYNAMIC_CSS();

}
