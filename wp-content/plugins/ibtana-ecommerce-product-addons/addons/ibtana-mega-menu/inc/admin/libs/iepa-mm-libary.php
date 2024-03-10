<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Ibtana Mega Menu Library Class
 * Contains all the common functions
 */
if ( !class_exists( 'IEPA_MM_Libary' ) ) {

  class IEPA_MM_Libary {

    public static $get_nav_menu_locations       = array();

    public static $iepamegabox_settings         = array();
    public static $iepamega_settings            = array();

    public static $is_ibtana_mega_menu_enabled  = false;

    public function __construct() {
      self::$get_nav_menu_locations   = get_nav_menu_locations(); // Returns an array with the registered navigation menu locations and the menu assigned to it

      self::$iepamegabox_settings     = get_option( 'iepamegabox_settings' ); //METABOX Settings
      self::$iepamega_settings        = get_option( 'iepamega_settings' );

      self::is_ibtana_mega_menu_enabled();
    }

    public static function is_ibtana_mega_menu_enabled() {
      foreach ( self::$get_nav_menu_locations as $menu_key => $menu_value ) {
        if ( isset( self::$iepamegabox_settings[ $menu_key ] ) ) {
          if (
            isset( self::$iepamegabox_settings[ $menu_key ][ 'enabled' ] ) &&
            ( self::$iepamegabox_settings[ $menu_key ][ 'enabled' ] == '1' )
          ) {
            self::$is_ibtana_mega_menu_enabled = true;
            break;
          }
        }
      }
    }


    /**
    * Print An Array
    */
    public function displayArr( $array ) {
      echo "<pre>";
      print_r( $array );
      echo "</pre>";
    }

    /**
    * Function to generate random number
    * @param  integer $length Length of the random number to be generated
    * @return mixed Returns the mixed value of number and alphabets
    */
    public static function generateRandomIndex( $length = 10 ) {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen( $characters );
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    /**
    * Query WooCommerce activation check
    */
    public static function is_woocommerce_activated() {
      return class_exists( 'woocommerce' ) ? true : false;
    }

    /**
    * Get size information for all currently-registered image sizes.
    *
    * @global $_wp_additional_image_sizes
    * @uses   get_intermediate_image_sizes()
    * @return array $sizes Data for all currently-registered image sizes.
    */
    public static function imma_get_image_sizes() {
      global $_wp_additional_image_sizes;

      $sizes = array();

      foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
          $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
          $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
          $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
          $sizes[ $_size ] = array(
            'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
            'height' => $_wp_additional_image_sizes[ $_size ]['height'],
            'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
          );
        }
      }

      return $sizes;
    }


    /*
    * Append Custom CSS
    */
    public static function get_custom_designs( $current_theme_location,$settings ) {
      include( IEPA_MM_PATH . '/inc/frontend/generated_css/custom_theme_css.php' );
    }


    public static function imma_get_excerptbyid( $post_id, $post_length ) {
      $the_post       = get_post($post_id); //Gets post ID
      $the_excerpt    = $the_post->post_excerpt; //Gets post_content to be used as a basis for the excerpt
      $excerpt_length = $post_length; //Sets excerpt length by word count
      $the_excerpt    = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
      $words          = explode(' ', $the_excerpt, $excerpt_length + 1);
      if( count( $words ) > $excerpt_length ) {
        array_pop( $words );
        array_push( $words, '' );
        $the_excerpt = implode( ' ', $words );
      }
      $the_excerpt =  $the_excerpt;
      return $the_excerpt;
    }

    /**
    * Get current taxonomy
    * */
    public static function get_all_taxonomy_lists() {
      wp_reset_postdata();
      $args           = array( 'public' => true, '_builtin' => false );
      $output         = 'objects';  //or objects
      $operator       = 'and';  //'and' or 'or'
      $taxonomies     = get_taxonomies($args,$output,$operator);
      $taxanomy_lists = array();
      if( count( $taxonomies ) > 0 ) {
        foreach( $taxonomies as $taxonomy => $vlue ) {
          //  $taxanomy_lists[] = $vlue->labels->singular_name;
          $taxanomy_lists[] = $taxonomy;
        }
        return $taxanomy_lists;
      }
    }

    //returns all the registered post types only
    public static function imma_get_registered_post_types() {
      $post_types = get_post_types();
      unset( $post_types['attachment'] );
      unset( $post_types['page'] );
      unset( $post_types['product_variation'] );
      unset( $post_types['shop_order'] );
      unset( $post_types['shop_order_refund'] );
      unset( $post_types['shop_coupon'] );
      unset( $post_types['shop_webhook'] );
      unset( $post_types['wp1slider'] );
      unset( $post_types['revision'] );
      unset( $post_types['nav_menu_item'] );
      unset( $post_types['wp-types-group'] );
      unset( $post_types['wp-types-user-group'] );
      return $post_types;
    }


    public static function imma_generate_meta_keys( $post_type = 'post' ) {
      global $wpdb;
      $query = "
          SELECT DISTINCT($wpdb->postmeta.meta_key)
          FROM $wpdb->posts
          LEFT JOIN $wpdb->postmeta
          ON $wpdb->posts.ID = $wpdb->postmeta.post_id
          WHERE $wpdb->posts.post_type = '%s'
          AND $wpdb->postmeta.meta_key != ''
          AND $wpdb->postmeta.meta_key NOT RegExp '(^[_0-9].+$)'
          AND $wpdb->postmeta.meta_key NOT RegExp '(^[0-9]+$)'
      ";
      $meta_keys  = $wpdb->get_col( $wpdb->prepare( $query, $post_type ) );
      return $meta_keys;
    }


    //Set the Post Custom Field in the WP dashboard as Name/Value pair
    public static function imma_PostViews( $post_ID ) {

      //Set the name of the Posts Custom Field.
      $count_key = 'post_views_count';

      //Returns values of the custom field with the specified key from the specified post.
      $count = get_post_meta( $post_ID, $count_key, true );

      //If the the Post Custom Field value is empty.
      if( $count == '' ) {
        $count = 0; // set the counter to zero.

        //Delete all custom fields with the specified key from the specified post.
        delete_post_meta($post_ID, $count_key);

        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count;

        //If the the Post Custom Field value is NOT empty.
      } else {
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta( $post_ID, $count_key, $count );

        //If statement, is just to have the singular form 'View' for the value '1'
        if( $count == '1' ) {
          return $count;
        }
        //In all other cases return (count) Views
        else {
          return $count;
        }
      }
    }


    /**
    * Returns an unfiltered array of all widgets in our sidebar
    */
    public static function iepa_mm_sidebarwidgets() {
      $imma_sidebar_widgets = wp_get_sidebars_widgets();

      if ( ! isset( $imma_sidebar_widgets[ 'im-menu-addon'] ) ) {
        return false;
      }
      return $imma_sidebar_widgets[ 'im-menu-addon' ];
    }

    /**
    * Sets the sidebar widgets
    */
    public static function imma_set_mm_sidebar_widgets( $widgets ) {

      $imma_sidebar_widgets = wp_get_sidebars_widgets();
      $imma_sidebar_widgets[ 'im-menu-addon' ] = $widgets;
      wp_set_sidebars_widgets( $imma_sidebar_widgets );

    }


    /**
    * Returns an specific Ibtana Mega Menu widget object.
    */
    public static function iepa_mm_get_specific_widgets() {
      global $wp_widget_factory;
      $iepamegamenupro_widgets = array();
      foreach( $wp_widget_factory->widgets as $wordpress_widget ) {
        $idbase       = $wordpress_widget->id_base;
        $widget_name  = $wordpress_widget->name;
        $description  = $wordpress_widget->widget_options['description'];
        $immapro_widgets = array(
          'iepamegamenu_contact_info',
          'iepamegamenu_pro_textimage',
          'iepa_pro_post_heading_widget',
          'iepamegamenu_pro_blogformat',
          'iepa_featured_box_layout',
          'iepa_pro_simple_recent_posts_widget_area',
          'iepa_pro_recent_products_widget_area',
          'iepa_pro_products_cart_widget_area',
          'iepa_pro_productlist_widget_area',
          'iepamegamenu_pro_advanced_postslider',
          'iepamegamenu_pro_linkimage',
          'iepamegamenu_pro_gallery_image',
          'iepa_post_category_tabs_widget',
          'iepa_post_category_tabs_widget_advanced'
        );

        if (in_array( $idbase , $immapro_widgets ) ) {
          $iepamegamenupro_widgets[] = array(
            'name' => $widget_name,
            'value' => $idbase,
            'description' => $description
          );
        }

      }
      return $iepamegamenupro_widgets;
    }


    /**
    * Returns an objects representing all widgets registered in woocommerce widgets
    */
    public static function imma_get_woo_widgets() {
      global $wp_widget_factory;
      $wordpress_widgets = array();
      foreach( $wp_widget_factory->widgets as $wordpress_widget ) {
        $idbase       = $wordpress_widget->id_base;
        $widget_name  = $wordpress_widget->name;
        $description  = $wordpress_widget->widget_options['description'];
        if ( strpos( $idbase, 'woocommerce' ) !== false ) {
          $wordpress_widgets[] = array(
            'name'        => $widget_name,
            'value'       => $idbase,
            'description' => $description
          );
        }
      }
      return $wordpress_widgets;
    }


    /**
    * Returns an object representing all widgets registered in WordPress
    */
    public static function iepa_get_available_widgets() {
      global $wp_widget_factory;
      $available_widgets = array();

      foreach( $wp_widget_factory->widgets as $wordpress_widget ) {
        $idbase       = $wordpress_widget->id_base;
        $widget_name  = $wordpress_widget->name;
        $description  = $wordpress_widget->widget_options['description'];

        $disabled_widgets = array(
          'iepamegamenu_contact_info',
          'iepamegamenu_pro_textimage',
          'iepa_pro_post_heading_widget',
          'iepamegamenu_pro_blogformat',
          'iepa_featured_box_layout',
          'iepa_pro_simple_recent_posts_widget_area',
          'iepa_pro_recent_products_widget_area',
          'iepa_pro_products_cart_widget_area',
          'iepa_pro_productlist_widget_area',
          'iepamegamenu_pro_advanced_postslider',
          'iepamegamenu_pro_linkimage',
          'iepamegamenu_pro_gallery_image',
          'iepa_post_category_tabs_widget',
          'iepa_post_category_tabs_widget_advanced'
        );

        if ( ! in_array( $wordpress_widget->id_base, $disabled_widgets ) ) {
          if ( strpos($idbase, 'woocommerce') !== false ) { } else {
            $available_widgets[] = array(
              'name'        => $widget_name,
              'value'       => $idbase,
              'description' => $description
            );
          }
        }
      }
      return $available_widgets;

    }



    /**
    * Returns the id_base value for a Widget ID imma_get_id_base_for_widget_id
    */
    public static function imma_get_id_widget_id( $widget_id ) {
      global $wp_registered_widget_controls;

      if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
        return false;
      }

      $control = $wp_registered_widget_controls[ $widget_id ];

      $id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];

      return $id_base;
    }

    /*
    * Widget CallBack Form: On edit specific widget on megamenu backend display widgets callback form
    */
    public static function show_widget_form( $widget_id_base ) {
      global $wp_registered_widget_controls;
      $control_widget = $wp_registered_widget_controls[$widget_id_base];
      $control        = $wp_registered_widget_controls[ $widget_id_base ];
      $id_base        = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];
      $widget_number  = isset($control_widget['params'][0]['number']) ? $control_widget['params'][0]['number'] : '';
      $widget_nonce   = wp_create_nonce('imma_save_widget_' . $widget_id_base);
      $before_form    = '<form method="post">';
      $after_form     = '</form>';

      $allowed_html = array(
          'form'      => array(
              'method'  => array(),
          )
      );
      ?>

      <div class='imma_widget-content'>
        <?php echo wp_kses( $before_form, $allowed_html ); ?>
        <input type="hidden" name="widget_id" class="widget-id" value="<?php echo esc_attr( $widget_id_base ); ?>" />
        <input type='hidden' name='action' value='imma_saveitemwidget' />
        <input type='hidden' name='id_base' class="id_base" value='<?php echo esc_attr( $id_base ); ?>' />
        <input type='hidden' name='_wpnonce' value='<?php echo esc_attr( $widget_nonce ) ?>' />
        <input type="hidden" name="widget_number" class="widget_number" value="<?php echo esc_attr($widget_number); ?>" />

        <?php
        if ( isset( $control_widget['callback'] ) ) {
          if ( is_callable( $control_widget['callback'] ) ) {
            call_user_func_array( $control_widget['callback'], $control_widget['params'] );
          }
        } else {
          ?>
          <p><?php  esc_html_e( 'There are no options for this widget.',IEPA_TEXT_DOMAIN ); ?></p>
          <?php
        }
        ?>

        <div class='iepa-widget-controls'>
          <a class='imma_delete' href='#delete'><?php esc_html_e( "Delete", IEPA_TEXT_DOMAIN ); ?></a> |
          <a class='imma_close' href='#close'><?php esc_html_e( "Close", IEPA_TEXT_DOMAIN ); ?></a>
        </div>

        <?php
        submit_button( esc_html( 'Save', IEPA_TEXT_DOMAIN ), 'button-primary alignright', 'imma_savewidget', false );
        ?>
        <?php echo wp_kses( $after_form, $allowed_html ); ?>
      </div>
      <?php
    }


    public static function get_all_sub_menu_items( $menu_id, $parent_menu_item_id, $grouptype ) {

      /* Returns an array of immediate child menu items for the current item*/
      if( $grouptype == "multiple" ) {
        $groupnumber = '1';
      } else {
        $groupnumber = '';
      }
      $items = array();

      // check we're using a valid menu ID
      if ( ! is_nav_menu( $menu_id ) ) {
        return $items;
      }
      $menu = wp_get_nav_menu_items( $menu_id );
      if ( count( $menu ) ) {

        foreach ( $menu as $item ) {

          // find the child menu items
          if ( $item->menu_item_parent == $parent_menu_item_id ) {

            $saved_settings             = array_filter( (array) get_post_meta( $item->ID, '_iepamegamenu', true ) );
            $submitted_default_settings = new IEPA_MM_Menu_Settings();
            $submitted_settings         = $submitted_default_settings->iepa_mm_menu_item_defaults();
            $settings                   = array_merge( $submitted_settings, $saved_settings );

            if( $groupnumber == '' ) {
              $items[ $item->ID ] = array(
                'id'      => $item->ID,
                'type'    => 'iepa_menu_subitem', //menu_item i.e second item display on mega menu
                'title'   => $item->title,
                'columns' => $settings['iepa_mega_menu_columns'],
                'order'   => isset( $settings['iepa_menu_order'][ $parent_menu_item_id ] ) ? $settings['iepa_menu_order'][ $parent_menu_item_id ] : 0
              );
            } else {
              $items[ $item->ID ] = array(
                'id'            => $item->ID,
                'type'          => 'iepa_menu_subitem', //menu_item i.e second item display on mega menu
                'title'         => $item->title,
                'columns'       => $settings['iepa_mega_menu_columns'],
                'order'         => isset( $settings['iepa_menu_order'][ $parent_menu_item_id ] ) ? $settings['iepa_menu_order'][ $parent_menu_item_id ] : 0,
                'group_number'  => $groupnumber,
                'group_type'    => 'multiple'
              );
            }


          }

        }

      }

      return $items;
    }


    /*
    * Get Menu title from menu id
    */
    public static function get_sub_menu_items( $parent_menu_item_id, $menu_id, $id ) {
      $items = array();

      // check we're using a valid menu ID
      if ( ! is_nav_menu( $menu_id ) ) {
        return $items;
      }
      $menu = wp_get_nav_menu_items( $menu_id );
      if ( count( $menu ) ) {

        foreach ( $menu as $item ) {

          // find the child menu items
          if ( $item->menu_item_parent == $parent_menu_item_id ) {
            if( $item->ID == $id ) {
              $items[] = array(
                'id'    => $item->ID,
                'type'  => 'iepa_menu_subitem', //menu_item i.e second item display on mega menu
                'title' => $item->title
              );

            }

          }

        }

      }

      return $items;
    }



    public static function get_id_base_for_widget_id( $widget_id ) {
      global $wp_registered_widget_controls;

      if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
        return false;
      }

      $control = $wp_registered_widget_controls[ $widget_id ];

      $id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];

      return $id_base;

    }


    public static function get_widget_number_for_widget_id( $widget_id ) {

      $parts = explode( "-", $widget_id );

      return absint( end( $parts ) );

    }

    public static function get_widget_base_for_widget_id( $widget_id ) {

      $parts = explode( "-", $widget_id );

      return $parts[0];

    }

    /*
    * Get Lighter Color From Darker Color Using Color Code
    */
    public static function colourBrightness( $hex, $percent ) {
      // Work out if hash given
      $hash = '';
      if ( stristr( $hex,'#' ) ) {
        $hex = str_replace( '#','',$hex );
        $hash = '#';
      }
      /// HEX TO RGB
      $rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
      //// CALCULATE
      for ($i=0; $i<3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
        // Lighter
          $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
        } else {
          // Darker
          $positivePercent = $percent - ($percent*2);
          $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
          $rgb[$i] = 255;
        }
      }
      //// RBG to Hex
      $hex = '';
      for($i=0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if(strlen($hexDigit) == 1) {
          $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
      }
      return $hash.$hex;
    }


    // nav_menu_itemID


    public static function iepa_mm_get_widget_data_for( $sidebar_name = 'im-menu-addon' ) {
      global $wp_registered_sidebars, $wp_registered_widgets;

      // Holds the final data to return
      $output = array();

      // Loop over all of the registered sidebars looking for the one with the same name as $sidebar_name
      $sidebar_id = false;

      foreach ( $wp_registered_sidebars as $sidebar ) {
        if ( $sidebar['name'] == $sidebar_name ) {
          // We now have the Sidebar ID, we can stop our loop and continue.
          $sidebar_id = $sidebar['id'];
          break;
        }
      }

      if ( ! $sidebar_id ) {
        // There is no sidebar registered with the name provided.
        return $output;
      }

      // A nested array in the format $sidebar_id => array( 'widget_id-1', 'widget_id-2' ... );
      $sidebars_widgets = wp_get_sidebars_widgets();
      $widget_ids = $sidebars_widgets[ $sidebar_id ];

      if ( ! $widget_ids ) {
        // Without proper widget_ids we can't continue.
        return array();
      }

      // Loop over each widget_id so we can fetch the data out of the wp_options table.
      foreach ( $widget_ids as $id ) {
        // The name of the option in the database is the name of the widget class.
        $option_name = $wp_registered_widgets[ $id ]['callback'][0]->option_name;

        // Widget data is stored as an associative array. To get the right data we need to get the right key which is stored in $wp_registered_widgets
        $key = $wp_registered_widgets[ $id ]['params'][0]['number'];

        $widget_data = get_option( $option_name );

        // Add the widget data on to the end of the output array.
        $output[] = (object) $widget_data[ $key ];
      }

      return $output;
    }

    public static function iepa_mm_get_widget_instance( $widget_id ) {
      global $wp_registered_widgets;

      if ( empty( $wp_registered_widgets[$widget_id]['callback'] ) ) {
        return array();
      }

      /** @var WP_Widget $widget */
      $widget = $wp_registered_widgets[$widget_id]['callback'][0];

      $settings = $widget->get_settings();

      return ! empty( $settings[self::get_widget_number_for_widget_id( $widget_id )] ) ? $settings[self::get_widget_number_for_widget_id( $widget_id )] : array();
    }


  }//class termination

}//class exists check
