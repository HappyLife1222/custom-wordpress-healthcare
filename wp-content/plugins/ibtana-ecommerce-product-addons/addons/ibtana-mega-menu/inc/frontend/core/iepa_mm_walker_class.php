<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * IEPA Mega Menu Display Menu Frontend
 * Class with all the necessary functions regarding displaying menu using Walker Class
 */
if ( !class_exists( 'IEPA_MM_Walker_Class' ) ) {

  class IEPA_MM_Walker_Class extends IEPA_MM_Libary {
    var $group_counter = 0;
    var $order = 0;

    /**
    * Constructor
    */
    public function __construct() {

      /*
      * Frontend Ibtana Mega Menu Display
      */
      /* Frontend Display IBTANAMenuAddon with integration of Walker class Modification */
      add_filter( 'wp_nav_menu_args', array( $this, 'iepa_navmenuargs' ), 999999 );

      /* Frontend Display IBTANAMenuAddon Widgets For specific menu location and hook on menu objects */
      add_filter( 'wp_nav_menu_objects', array( $this, 'iepa_addwidgetsmegamenu' ), 9, 2 );

      /* Save setup array with _iepamegamenu post meta data into posts array for specific posts */
      add_filter( 'iepamegamenu_navmenu_before_setup', array( $this, 'iepasetupmenuitems' ), 3, 2 );
      add_filter( 'iepa_navmenuafterobj', array( $this, 'iepa_reordermenuitems' ), 5, 2 );

      /* Apply Neccessary Classes for li items of top level menu with depth check*/
      add_filter( 'iepa_navmenuafterobj', array( $this, 'iepa_setclassesmenuitems' ), 7, 2 );
      add_filter( 'widget_text', 'do_shortcode' );

      /*
      * Responsive Hook Frontend IBTANA Mega Menu Display
      */
      /* responsive toggle bar content display filter hook start */
      add_filter( 'wp_nav_menu', array( $this, 'iepa_mobiletoggle' ), 10, 2 ); // display toggle bar on top of menu frontend
      add_filter( 'iepamegamenu_togglebar_content', array( $this, 'iepa_responsive_display_togglebar_content' ), 9, 5 );

    }

    public function simple_filter_nav_menu_pages( $items, $args ) {

      $non_allowed_post_ids   = array( 2000, 2001 );
      $non_allowed_post_urls  = array( 'url1', 'url2' );
      foreach ( $items as $key => $post ) {
        if ( in_array( absint( $post->object_id ), $non_allowed_post_ids ) ) {
          unset( $items[ $key ] );
          continue;
        }
        if ( in_array( absint( $post->object_id ), $non_allowed_post_urls ) ) {
          unset( $items[ $key ] );
        }
      }
      return $items;
    }


    /**
    * Use the IBTANA Mega Menu walker to output the menu
    * Resets all parameters used in the wp_nav_menu call
    * Wraps the menu in im-menu-addon IDs and classes
    */
    public function iepa_navmenuargs( $args ) {

      $settings               = get_option( 'iepamegabox_settings' ); //get all plugin metabox data
      $current_theme_location = $args['theme_location']; // get current menu location i.e primary
      $locations              = get_nav_menu_locations(); // get all menu location

      /*
      * Check if ibtana mega menu is enabled or not for specific menu location
      */
      if ( isset ( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == 1 ) {

        if ( ! isset( $locations[ $current_theme_location ] ) ) {
          return $args;
        }

        $menu_id = $locations[ $current_theme_location ];

        if ( ! $menu_id ) {
          return $args;
        }

        if ( ! $current_theme_location ) {
          return false;
        }

        if ( ! has_nav_menu( $current_theme_location ) ) {
          return false;
        }


        $themes_style_manager   = new IEPA_MM_Theme_Settings();
        $retractor_default_text = __( 'CLOSE', IEPA_TEXT_DOMAIN );

        //$themes = $themes_style_manager->get_custom_theme_data(''); // get all custom themes
        if( isset( $settings[ $current_theme_location ]['theme_type'] ) && $settings[ $current_theme_location ]['theme_type'] == "custom_themes" ) {
          $theme          = $settings[ $current_theme_location ]['theme'];
          $menu_theme     = $themes_style_manager->get_custom_theme_rowdata( $theme );
          $theme_title    = 'iepamega-' . $menu_theme->slug;
          $theme_settings = unserialize( $menu_theme->theme_settings );

          $resposive_breakpoint_width = (
            isset( $theme_settings['mobile_settings']['resposive_breakpoint_width'] ) && ( $theme_settings['mobile_settings']['resposive_breakpoint_width'] != '' )
            ) ? esc_attr( $theme_settings['mobile_settings']['resposive_breakpoint_width'] ) : '';
          $responsive_submenus_retractor  = (
            isset( $theme_settings['mobile_settings']['submenu_closebtn_position'] ) && ( $theme_settings['mobile_settings']['submenu_closebtn_position'] == 'top' )
            ) ? 'iepa-top-retractor' : 'iepa-bottom-retractor';
          $submenus_retractor_text  = (
            isset( $theme_settings['mobile_settings']['submenus_retractor_text'] ) && ( $theme_settings['mobile_settings']['submenus_retractor_text'] != '' )
            ) ? esc_attr( $theme_settings['mobile_settings']['submenus_retractor_text'] ) : $retractor_default_text;

          $skin_type  = "iepa-mm-custom-theme";
          $skin_type1 = "iepa-ctheme-wrapper";
          $arrow_type = (
            isset( $theme_settings['mobile_settings']['submenus_retractor_text'] ) && ( $theme_settings['mobile_settings']['submenus_retractor_text'] != '' )
            ) ? esc_attr( $theme_settings['mobile_settings']['submenus_retractor_text'] ) : $retractor_default_text;

        } else {
          $theme      = $settings[ $current_theme_location ]['available_skin'];
          $menu_theme = isset( $theme ) ? 'iepamega-' . $theme : 'iepamega-black-white';


          $resposive_breakpoint_width     = "680";
          $responsive_submenus_retractor  = "iepa-bottom-retractor";
          $submenus_retractor_text        = $retractor_default_text;

          $skin_type    = "iepa-pre-available-skins";
          $skin_type1   = "iepa-askins-wrapper";
          $theme_title  = 'iepamega-' . $theme;
          $arrow_type   = "";
        }

        $iepammmega_general_settings = get_option( 'iepamega_settings' );

        /*
        * features added : Sticky menu
        */
        if( isset( $iepammmega_general_settings['active_sticky_menu'] ) && ( $iepammmega_general_settings['active_sticky_menu'] == 1 ) ) {
          if( isset( $iepammmega_general_settings['sticky_theme_location'] ) ) {
            if( $iepammmega_general_settings['sticky_theme_location'] == $current_theme_location ) {
              $sticky_class = "iepa-pro-sticky";
            } else {
              $sticky_class = "";
            }
          }
        } else {
          $sticky_class = "";
        }
        /* sticky menu end*/

        if( isset( $iepammmega_general_settings['disable_submenu_retractor'] ) && ( $iepammmega_general_settings['disable_submenu_retractor'] == 1 ) ) {
          $retractor      = '';
          $retractor_txt  = '';
        } else {
          $retractor      = $responsive_submenus_retractor;
          $retractor_txt  = $submenus_retractor_text;
        }

        if( isset( $iepammmega_general_settings['enable_mobile'] ) && ( $iepammmega_general_settings['enable_mobile'] != 1 ) ) {
          $addClass = "iepamega-disable-mobile-menu";
        } else {
          $addClass = "iepamega-enabled-mobile-menu";
        }

        $orientation            = ( isset( $settings[ $current_theme_location ]['orientation'] ) && $settings[ $current_theme_location ]['orientation'] != '' ) ? esc_attr( $settings[ $current_theme_location ]['orientation'] ) : '';
        $hide_all_icons_desktop = ( isset( $settings[ $current_theme_location ]['hide_all_icons'] ) && $settings[ $current_theme_location ]['hide_all_icons'] == 1 ) ? 'iepa-hideallicons-desktop' : '';
        $hide_allicons_mobile   = ( isset( $settings[ $current_theme_location ]['hide_allicons_mobile'] ) && $settings[ $current_theme_location ]['hide_allicons_mobile'] == 1 ) ? 'iepa-hideallicons-mobile' : '';
        $mobile_menu_location   = ( isset( $settings[ $current_theme_location ]['mobile_menu_location'] ) && $settings[ $current_theme_location ]['mobile_menu_location'] != '' ) ? esc_attr( $settings[ $current_theme_location ]['mobile_menu_location'] ) : '';

        $menu_settings  = $settings[ $current_theme_location ]; /* Get data of specific menu location*/
        $trigger_option = isset( $menu_settings['trigger_option'] ) ? 'iepa-' . $menu_settings['trigger_option'] : 'iepa-onhover';  //trigger option:hover_indent/onhover/onclick

        $iepa_common_attributes = apply_filters( "iepamegamenu_common_attributes", array(
          "id"                  =>  '%1$s',
          "class"               =>  'iepa-mega-wrapper iepamemgamenu-pro',
          "data-advanced-click" =>  isset( $settings['advanced_click'] ) ? esc_attr( $settings['advanced_click'] ) : 'iepa-click-submenu',
          "data-trigger-effect" =>  esc_attr( $trigger_option ),
        ), $menu_id, $menu_settings, $settings, $current_theme_location );

        $attributes = "";

        foreach( $iepa_common_attributes as $attribute => $value ) {
          if ( strlen( $value ) ) {
            // $attributes .= " ". esc_attr( $value );
            $attributes .= " " . $attribute . '="' . esc_attr( $value ) . '"';
          }
        }

        $sanitized_location = str_replace(
          apply_filters( "iepamegamenu_arg_replacements", array( "-", " " ) ),
          "-",
          $current_theme_location
        );
        $orientation        = (
          isset( $menu_settings['orientation'] ) && ( $menu_settings['orientation'] != '' )
          ) ? esc_attr( $menu_settings['orientation'] ) : 'horizontal';

        /* Integrate dynamic Stylesheet for menu */
        /*  if($skin_type =="iepa-mm-custom-theme"){
        IEPA_MM_Libary::get_custom_designs($current_theme_location,$settings);
        }*/
        /* End */


        /* Metabox options as per menu location here */

        if( $orientation == "vertical" ) {
          $vertical_aligntype   = (
            isset( $menu_settings['vertical_alignment_type'] ) && ( $menu_settings['vertical_alignment_type']  != '' )
            ) ? esc_attr( $menu_settings['vertical_alignment_type'] ) : 'left';
          if( $vertical_aligntype == "left" ) {
            $vertical_alignment_type   = 'iepa-vertical-right-align';
          } else {
            $vertical_alignment_type   = 'iepa-vertical-left-align';
          }

        } else {
          $vertical_alignment_type = '';
        }
        $orientation    = "iepa-orientation-" . $orientation;
        $effectoption   = isset( $menu_settings['effect_option'] ) ? 'iepa-' . $menu_settings['effect_option'] : 'iepa-fade';

        /* END */

        /* other general common options */
        $hideallmenuicons     = ( isset( $settings['hide_icons'] ) && $settings['hide_icons'] == "1" ) ? 'hide-icons-true' : '';
        $mobile_toggle_option = ( isset( $iepammmega_general_settings['mobile_toggle_option'] ) && ( $iepammmega_general_settings['mobile_toggle_option'] == "toggle_standard" ) ) ? 'iepa-toggle-standard' : 'iepa-toggle-accordion';
        /* END */
        $disabled_menu_toggle   = ( isset( $settings[ $current_theme_location ]['disabled_menu_toggle'] ) && $settings[ $current_theme_location ]['disabled_menu_toggle'] == '1' ) ? true : false;
        if( $disabled_menu_toggle ) {
          $disabled_menu_toggle_class = "iepa-hide-toggle";
        } else {
          $disabled_menu_toggle_class = "";
        }

        $dynamicclass = $skin_type1 . ' ' . $disabled_menu_toggle_class . ' ' . $theme_title . ' ' . $addClass . ' ' . $hide_allicons_mobile .
        ' ' . $hide_all_icons_desktop . ' ' . $mobile_toggle_option . ' ' . $trigger_option . ' ' . $orientation . ' ' .
        $vertical_alignment_type . ' ' . $effectoption . ' ' . $sticky_class;

        // $enable_megamenu_mobile = 0;
        $enable_megamenu_mobile   = (
          isset( $settings[ $current_theme_location ]['enabled_on_mobile'] ) && ( $settings[ $current_theme_location ]['enabled_on_mobile'] == 1 )
          ) ? 1 : 0;


        if( wp_is_mobile() ) {
          if( isset( $mobile_menu_location ) ) {
            if( $mobile_menu_location != $current_theme_location ) {
              if( $enable_megamenu_mobile == 1 ) {
                if ( isset ( $settings[ $mobile_menu_location ]['enabled'] ) && ( $settings[ $mobile_menu_location ]['enabled'] == 1 ) ) {
                  $menu_id            = $locations[ $mobile_menu_location ];
                  $menu_location      = $mobile_menu_location;
                  $sanitized_location = str_replace( apply_filters( "iepamegamenu_arg_replacements", array( "-", " " ) ), "-", $mobile_menu_location );
                  $defaults           = $this->overrider_walker_menu( $retractor, $menu_id, $dynamicclass, $menu_location, $sanitized_location, $attributes, $submenus_retractor_text );
                } else {
                  $menu_id        = $locations[ $mobile_menu_location ];
                  $menu_location  = $mobile_menu_location;
                  $defaults = array(
                    'menu'            => $menu_id,
                    'container_id'    => $menu_location,
                  );
                }
              } else {
                $menu_id        = $locations[ $current_theme_location ];
                $menu_location  = $current_theme_location;
                $defaults = array(
                  'menu'            => $menu_id,
                  'container_id'    => $menu_location,
                );
              }
            } else {

              if( $enable_megamenu_mobile == 1 ) {
                $defaults =  $this->overrider_walker_menu(
                  $retractor,
                  $menu_id,
                  $dynamicclass,
                  $current_theme_location,
                  $sanitized_location,
                  $attributes,
                  $submenus_retractor_text
                );
              } else {
                $menu_id        = $locations[ $current_theme_location ];
                $menu_location  = $current_theme_location;
                $defaults = array(
                  'menu'            => $menu_id,
                  'container_id'    => $menu_location,
                );
              }

            }
          } else {
            $defaults = $this->overrider_walker_menu(
              $retractor,
              $menu_id,
              $dynamicclass,
              $current_theme_location,
              $sanitized_location,
              $attributes,
              $submenus_retractor_text
            );
          }
        } else {

          $defaults = $this->overrider_walker_menu(
            $retractor,
            $menu_id,
            $dynamicclass,
            $current_theme_location,
            $sanitized_location,
            $attributes,
            $submenus_retractor_text
          );

        }


        $args = array_merge( $args, apply_filters( "iepamegamenu_menu_args", $defaults, $menu_id, $current_theme_location ) );
      }

      return $args;
    }

    public function overrider_walker_menu( $retractor, $menu_id, $dynamicclass, $menu_location, $sanitized_location, $attributes, $submenus_retractor_text ) {
      if( $retractor != '' ) {
        if( $retractor  == "iepa-bottom-retractor" ) {

          $defaults = array(
            'menu'            =>  $menu_id,
            'container'       =>  'div',
            'container_class' =>  'iepa-megamenu-main-wrapper ' . $dynamicclass,
            'container_id'    =>  'iepa-wrap-' . $menu_location,
            'menu_class'      =>  'iepamegamenu',
            'menu_id'         =>  'iepamega-menu-' . $sanitized_location,
            'fallback_cb'     =>  'wp_page_menu',
            'before'          =>  '',
            'after'           =>  '',
            'link_before'     =>  '',
            'link_after'      =>  '',
            'items_wrap'      =>  '<ul' . $attributes . '>%3$s</ul><div class="iepamega-responsive-closebtn" id="close-'.$menu_location.'">'.$submenus_retractor_text.'</div>',
            'depth'           =>  0,
            'walker'          =>  new IEPAMegamenuWalker_Class()
          );

        } else {
          /* Top retractor */
          $defaults = array(
            'menu'            =>  $menu_id,
            'container'       =>  'div',
            'container_class' =>  'iepa-megamenu-main-wrapper ' . $dynamicclass,
            'container_id'    =>  'iepa-wrap-' . $menu_location,
            'menu_class'      =>  'iepamegamenu',
            'menu_id'         =>  'iepamega-menu-' . $sanitized_location,
            'fallback_cb'     =>  'wp_page_menu',
            'before'          =>  '',
            'after'           =>  '',
            'link_before'     =>  '',
            'link_after'      =>  '',
            'items_wrap'      =>  '<div class="iepamega-responsive-closebtn" id="close-'.$menu_location.'">'.$submenus_retractor_text.'</div><ul' . $attributes . '>%3$s</ul>',
            'depth'           =>  0,
            'walker'          =>  new IEPAMegamenuWalker_Class()
          );

        }
      } else {
        //noretractor
        $defaults = array(
          'menu'            =>  $menu_id,
          'container'       =>  'div',
          'container_class' =>  'iepa-megamenu-main-wrapper '.$dynamicclass,
          'container_id'    =>  'iepa-wrap-' .$menu_location,
          'menu_class'      =>  'iepamegamenu',
          'menu_id'         =>  'iepamega-menu-' . $sanitized_location,
          'fallback_cb'     =>  'wp_page_menu',
          'before'          =>  '',
          'after'           =>  '',
          'link_before'     =>  '',
          'link_after'      =>  '',
          'items_wrap'      =>  '<ul' . $attributes . '>%3$s</ul>',
          'depth'           =>  0,
          'walker'          =>  new IEPAMegamenuWalker_Class()
        );

      }
      return $defaults;
    }


    function searchForId($id,  $array) {
      if( isset( $array ) && !empty( $array ) ) {
        foreach ($array as $key => $val) {

          if ($val['id'] === $id ) {
            return true;
          }
        }
      }
      return false;
    }


    /**
    * Append the widget objects to the menu array before the
    * menu is processed by the walker.
    */
    public function iepa_addwidgetsmegamenu( $items, $args ) {

      // make sure we're working with a Mega Menu
      if ( ! is_a( $args->walker, 'IEPAMegamenuWalker_Class' ) ) {
        return $items;
      }
      $items = apply_filters( "iepamegamenu_navmenu_before_setup", $items, $args );
      $mywidget_manager = new IEPA_MM_Menu_Widget_Manager();
      if( isset( $args->menu ) ) {
        $menuid = $args->menu;
      }
      // IEPA_MM_Libary::displayArr($items);
      foreach ( $items as $item ) {

        // only look for widgets on top level items
        if ( $item->depth === 0 && $item->iepamegamenu_settings['menu_type'] == 'megamenu' ) {


          if( isset( $item->iepamegamenu_settings['group_type'] ) && $item->iepamegamenu_settings['group_type'] == "multiple" ) {

            //$count = 1;
            //multiple group

            $mypanelwidgets = $mywidget_manager->iepa_mm_get_group_details( $item->ID );
            $totalgroup     = $mypanelwidgets->totalgroup;
            $widget_details = unserialize( $mypanelwidgets->widget_details );
            $group_details  = unserialize( $mypanelwidgets->group_details );

            // IEPA_MM_Libary::displayArr($group_details);
            //  IEPA_MM_Libary::displayArr($widget_details);

            if( isset( $group_details ) && !empty( $group_details ) ) {
              foreach ( $group_details as $key => $value ) {
                $this->group_counter  = $this->group_counter + 100;

                $newgroup             = $value['group_no'];
                $total_columns        = $value['column'];
                if( isset( $widget_details ) && !empty( $widget_details ) ) {
                  foreach ( $widget_details as $key => $val ) {

                    if ($val['group_no'] === $newgroup ) {
                      $lists      = $val['lists'];
                      $groupnum   = $val['group_no'];
                      $splitlists = explode( ',', $lists );
                      // IEPA_MM_Libary::displayArr($splitlists);

                      $widgets_details = $mywidget_manager->iepa_getwidgets_menuid( $item->ID , $menuid , 'multiple' );
                      for ( $i=0; $i < count( $splitlists ); $i++ ) {
                        $megamenu_sets = get_post_meta( $item->ID, '_iepamegamenu', true );


                        $getallwidgetsettings = array_merge( get_post_meta( $item->ID, '_iepamegamenu', true ), array(
                          'iepa_mega_menu_columns'            => isset( $widgets_details[$splitlists[$i]]['columns'] ) ? absint( $widgets_details[$splitlists[$i]]['columns'] ) : '2',
                          'iepa_mega_menu_group_number'       => isset( $widgets_details[$splitlists[$i]]['group_number'] ) ? absint( $widgets_details[$splitlists[$i]]['group_number'] ) : '1',
                          'iepa_mega_menu_group_total_column' => $total_columns
                          // 'iepa_group_mega_menu_columns'  => $megamenu_sets['iepa_group_mega_menu_columns']
                        ) );


                        if( $i == 0 ) {
                          $this->order  = $this->order + 1;
                          $order        = $this->order + $this->group_counter;
                          $groupsection = "start_group_widget";
                          $iepammmenuitems1 = array(
                            'type'                      =>  'widget',
                            'group_section'             =>  $groupsection,
                            'in_iepamegamenu'           =>  true,
                            'title'                     =>  'start_widget',
                            'group_type'                =>  'multiple',
                            'group_number'              =>  $groupnum,
                            'content'                   =>  '',
                            'menu_item_parent'          =>  $item->ID,
                            'object_id'                 =>  !isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                            'object'                    =>  $item->object,
                            'url'                       =>  isset( $item->url ) ? $item->url : '',
                            'db_id'                     =>  0, // This menu item does not have any childen
                            'ID'                        =>  $item->ID,
                            'iepa_menu_order'           =>  $order,
                            'iepamegamenu_order'        =>  $order,
                            'iepamegamenu_settings'     =>  $getallwidgetsettings,
                            'depth'                     =>  1,
                            'classes'                   =>  array(
                                                              "iepa-start-group-section",
                                                              "iepa-group" . $groupnum,
                                                              "iepa-mega-" . $total_columns . "columns"
                                                            )
                          );

                          $items[] = (object) $iepammmenuitems1;
                        } else if( $i == count( $splitlists ) - 1 ) {
                          $groupsection = "end_group_widget";
                        }

                        if( intval( $splitlists[$i] ) ) {
                          $group_widget_type  = "submenu";
                          $content            = "";

                        } else {
                          $group_widget_type  = "widget";
                          $content            = $mywidget_manager->iepashowwidget(  $splitlists[$i] );
                        }

                        $this->order  = $this->order + 1;
                        $order        = $this->order + $this->group_counter;

                        $iepammmenuitems = array(
                          'type'                  =>  $group_widget_type,
                          'group_section'         =>  $group_widget_type ,
                          'in_iepamegamenu'       =>  true,
                          'title'                 =>  $splitlists[$i],
                          'group_type'            =>  'multiple',
                          'group_number'          =>  $groupnum,
                          'content'               =>  $content,
                          'menu_item_parent'      =>  $item->ID,
                          'object_id'             =>  ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                          'object'                =>  $item->object,
                          'url'                   =>  isset( $item->url ) ? $item->url : '',
                          'db_id'                 =>  0, // This menu item does not have any childen
                          'ID'                    =>  $splitlists[$i],
                          'iepa_menu_order'       =>  $order,
                          'iepamegamenu_order'    =>  $order,
                          'iepamegamenu_settings' =>  $getallwidgetsettings,
                          'depth'                 =>  1,
                          'classes'               =>  array(
                                                        "menu-item",
                                                        "menu-item-type-widget",
                                                        "menu-widget-class-" . $mywidget_manager->iepa_getwidget( $splitlists[$i] ),
                                                        $mywidget_manager->iepa_getwidget( $splitlists[$i] )
                                                      )
                        );

                        $items[] = (object) $iepammmenuitems;

                        if( $i == count($splitlists) - 1 ) {
                          $this->order  = $this->order + 1;
                          $order        = $this->order + $this->group_counter;
                          $iepammmenuitems2 = array(
                            'type'                      => 'widget',
                            'group_section'             => 'end_group_widget',
                            'in_iepamegamenu'             => true,
                            'title'                     => 'end_widget',
                            'group_type'                => 'multiple',
                            'group_number'              => $groupnum,
                            'content'                   => '',
                            'menu_item_parent'          => $item->ID,
                            'object_id'                 => ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                            'object' => $item->object,
                            'url'                      => isset( $item->url ) ? $item->url : '',
                            'db_id'                     => 0, // This menu item does not have any childen
                            'ID'                        => '' ,
                            'iepa_menu_order'             => $order,
                            'iepamegamenu_order'          => $order,
                            'depth'                     => 1,
                            'classes'                   => array()
                          );


                          $items[] = (object) $iepammmenuitems2;
                        }



                      }

                    }
                  }
                }

              }
            }


          } else {
            //single group

            $mypanelwidgets = $mywidget_manager->iepa_getwidgets_menuid( $item->ID, $args->menu ,'' );

            if ( count( $mypanelwidgets ) ) {

              $wdposition           = 0;
              $nxtorder             = $this->iepa_getnextmenuorder( $item->ID, $items);
              $totalwidgetsinwpmenu = count( $mypanelwidgets );

              if ( ! in_array( 'menu-item-has-children', $item->classes ) ) {
                $item->classes[] = 'menu-item-has-children';
              }


              foreach ( $mypanelwidgets as $mywidget ) {
                if( $mywidget['group_type'] != "multiple" ) {

                  $getallwidgetsettings = array_merge( get_post_meta( $item->ID, '_iepamegamenu', true ), array(
                    'iepa_mega_menu_columns'  =>  absint( $mywidget['columns'] )
                  ) );

                  $iepammmenuitem = array(
                    'type'                    =>  'widget',
                    'in_iepamegamenu'         =>  true,
                    'title'                   =>  $mywidget['id'],
                    'group_type'              =>  $mywidget['group_type'],
                    'group_number'            =>  $mywidget['group_number'],
                    'content'                 =>  $mywidget_manager->iepashowwidget( $mywidget['id'] ),
                    'menu_item_parent'        =>  $item->ID,
                    'object_id'               =>  ! isset( $item->object_id ) ? get_post_meta( $item->ID, '_menu_item_object_id', true ) : $item->object_id,
                    'object'                  =>  $item->object,
                    'url'                     =>  isset( $item->url ) ? $item->url : '',
                    'db_id'                   =>  0, // This menu item does not have any childen
                    'ID'                      =>  $mywidget['id'],
                    'iepa_menu_order'         =>  $nxtorder - $totalwidgetsinwpmenu + $wdposition,
                    'iepamegamenu_order'      =>  $mywidget['order'],
                    'iepamegamenu_settings'   =>  $getallwidgetsettings,
                    'depth'                   =>  1,
                    'classes'                 =>  array(
                                                    "menu-item",
                                                    "menu-item-type-widget",
                                                    "menu-widget-class-" . $mywidget_manager->iepa_getwidget( $mywidget['id'] ),
                                                    $mywidget_manager->iepa_getwidget( $mywidget['id'] )
                                                  )
                  );

                  $items[] = (object) $iepammmenuitem;

                  $wdposition++;
                }
              }
            }


          }


        }
      }
      //IEPA_MM_Libary::displayArr($items);
      $items = apply_filters( "iepa_navmenuafterobj", $items, $args );
      return $items;
    }



    /**
    * Setup and array for each menu item from ibtana mega menu settings
    */
    public function iepasetupmenuitems( $items, $args ) {
      // apply depth
      $parray = array();
      foreach ( $items as $key => $value ) {
        if ( $value->menu_item_parent == 0 ) { // check menu parent id 0 if toplevel menu or not
          $parray[] = $value->ID;
          $value->depth = 0;
        }
      }
      if ( count( $parray ) ) {
        foreach ( $items as $key => $item ) {
          if ( in_array( $item->menu_item_parent, $parray ) ) {
            $item->depth = 1;
          }
        }
      }

      // apply saved metadata to each menu item
      foreach ( $items as $elementKey => $item ) {

        $saved_settings               = array_filter( (array) get_post_meta( $item->ID, '_iepamegamenu', true ) );
        $default_settings             = new IEPA_MM_Menu_Settings();
        $item->iepamegamenu_settings  = array_merge( $default_settings->iepa_mm_menu_item_defaults(), $saved_settings );
        $item->iepamegamenu_order     = isset( $item->iepamegamenu_settings['iepa_menu_order'][$item->menu_item_parent] ) ? $item->iepamegamenu_settings['iepa_menu_order'][$item->menu_item_parent] : 0;
        $item->in_iepamegamenu        = false;
        $item->wpmenu_order           = $item->menu_order * 1000;
        // add in_iepamegamenu
        if ( $item->depth == 1 ) {

          $parent_settings = array_filter( (array) get_post_meta( $item->menu_item_parent, '_iepamegamenu', true ) );

          // if ( isset( $parent_settings['group_type'] ) && $parent_settings['group_type'] == 'multiple' ) {

          //     unset($items[$elementKey]);

          // }else{
          if ( isset( $parent_settings['menu_type'] ) && $parent_settings['menu_type'] == 'megamenu' ) {

            $item->in_iepamegamenu = true;

          }
          //}

        }

      }
      //  IEPA_MM_Libary::displayArr($items);

      return $items;
    }


    /**
    * This returns the menu order of the next top level menu item.
    */
    private function iepa_getnextmenuorder( $item_id, $items ) {
      $get_next_parent = false;
      foreach ( $items as $key => $item ) {
        if ( $item->menu_item_parent != 0 ) {
          continue;
        }
        if ( $item->type == 'widget' ) {
          continue;
        }
        if ( $get_next_parent ) {
          return $item->menu_order;
        }
        if ( $item->ID == $item_id ) {
          $get_next_parent = true;
        }
        $last_menu_order = $item->menu_order;
      }
      // there isn't a next top level menu item
      return $last_menu_order + 1000;

    }


    /**
    * Reorder items within the ibtana mega menu.
    */
    public function iepa_reordermenuitems( $items, $args ) {
      $new_items = array();
      foreach ( $items as $item ) {
        if ( $item->in_iepamegamenu && isset( $item->iepamegamenu_order ) && $item->iepamegamenu_order !== 0 ) {
          $parent_post      = get_post( $item->menu_item_parent );
          $item->menu_order = $parent_post->menu_order * 1000 + $item->iepamegamenu_order;
        }
      }
      foreach ( $items as $item ) {
        $new_items[ $item->menu_order ] = $item;
      }
      ksort( $new_items );
      return $new_items;
    }


    /**
    * Apply column and clear classes to menu items (inc. widgets)
    */
    public function iepa_setclassesmenuitems( $items, $args ) {
      // IEPA_MM_Libary::displayArr($items);
      $parents = array();

      $current_theme_location = $args->theme_location; // get current menu location i.e primary
      $settings = get_option( 'iepamega_settings' );

      $settings = get_option( 'iepamegabox_settings' ); //get all plugin metabox data
      //IEPA_MM_Libary::displayArr($items);
      $orientation  = isset( $settings[$current_theme_location]['orientation'] ) ? $settings[$current_theme_location]['orientation'] : 'horizontal';
      foreach ( $items as $item ) {
        if( $item->title != "start_widget" ) {
          if( $item->depth == 1 ) {
            $item->classes[] = 'im-menu-addon-header';
          }

          if ( $item->depth === 0 ) {
            /* menu replacement class */
            if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] ) && $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'search_type' ) {
              $item->classes[] = 'iepamega-custom-content iepa-search-type';
            } else if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] ) && $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'woo_cart_total' ) {
              $item->classes[] = 'iepamega-custom-content iepa-woo-cart-total';
            } else if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] ) && $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'logo_image' ) {
              $item->classes[] = 'iepamega-custom-content iepa-clogo-image';
            } else if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] ) && $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'login_form' ) {
              $item->classes[] = 'iepamega-custom-content iepa-wplogin-form';
            } else if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] ) && $item->iepamegamenu_settings['mega_menu_settings']['choose_menu_type'] == 'register_form' ) {
              $item->classes[] = 'iepamega-custom-content iepa-wpregister-form';
            } else {
              if( isset( $item->iepamegamenu_settings['menu_type'] ) &&  $item->iepamegamenu_settings['menu_type'] == "megamenu" ) {
                $item->classes[] = 'iepamega-menu-' . $item->iepamegamenu_settings['menu_type'];
              } else {
                $item->classes[] = 'iepamega-menu-flyout';
              }
            }
            /* menu replacement class end*/
          }


          if ( isset( $item->iepamegamenu_settings['general_settings']['hide_arrow'] ) && $item->iepamegamenu_settings['general_settings']['hide_arrow'] == 'true' ) {
            $item->classes[] = 'iepamega-hide-arrow';
          } else {
            $item->classes[] = 'iepamega-show-arrow';
          }

          if( isset( $item->iepamegamenu_settings['general_settings']['activate_view_more_btn'] ) && $item->iepamegamenu_settings['general_settings']['activate_view_more_btn'] == 'true' ) {
            $item->classes[] = 'iepamega-view-more-btn';
          }


          if ( isset( $item->iepamegamenu_settings['general_settings']['visible_hidden_menu'] ) && $item->iepamegamenu_settings['general_settings']['visible_hidden_menu'] == 'true' ) {
            $item->classes[] = 'iepamega-visible-hide-menu';
          }

          if ( isset( $item->iepamegamenu_settings['general_settings']['active_single_menu'] ) && $item->iepamegamenu_settings['general_settings']['active_single_menu'] == 'enabled' ) {
            $item->classes[] = 'iepamega-enable-single-menu';
          }

          // if ( $item->depth  > 0 ) {
          //  if(isset($item->iepamegamenu_settings['general_settings']['submenu_align']) && $item->iepamegamenu_settings['general_settings']['submenu_align'] != '') {
          //      $item->classes[] = 'iepa-submenu-align-' . $item->iepamegamenu_settings['general_settings']['submenu_align'];
          //  }else{
          //     $item->classes[] = 'iepa-submenu-align-left';
          //  }
          // }


          if( isset( $item->iepamegamenu_settings['general_settings']['menu_align'] ) && $item->depth == 0 ) {
            $item->classes[] = 'iepa-menu-align-' . $item->iepamegamenu_settings['general_settings']['menu_align'];
          } else {
            $item->classes[] = 'iepa-menu-align-left';
          }

          if ( isset( $item->iepamegamenu_settings['general_settings']['menu_icon'] ) && $item->iepamegamenu_settings['general_settings']['menu_icon'] == "enabled" ) {
            //show menu icon
            $item->classes[] = 'iepamega-show-menu-icon';
          } else {
            $item->classes[] = 'iepamega-hide-menu-icon';
          }

          if ( isset( $item->iepamegamenu_settings['general_settings']['hide_icon_mobile'] ) && $item->iepamegamenu_settings['general_settings']['hide_icon_mobile'] == "enabled" ) {
            //hide menu icon on mobile
            $item->classes[] = 'iepamega-hide-icon-mobile';
          } else {
            $item->classes[] = '';
          }

          if ( isset( $item->iepamegamenu_settings['general_settings']['hide_on_desktop'] ) && $item->iepamegamenu_settings['general_settings']['hide_on_desktop'] == 'true' ) {
            $item->classes[] = 'iepamega-hide-on-desktop';
          }

          if ( isset( $item->iepamegamenu_settings['general_settings']['hide_on_mobile'] ) && $item->iepamegamenu_settings['general_settings']['hide_on_mobile'] == 'true' ) {
            $item->classes[] = 'iepamega-hide-on-mobile';
          }


          if( $item->depth === 0 ) {
            if( $orientation == "horizontal" ) {
              if( isset( $item->iepamegamenu_settings['menu_type'] ) && $item->iepamegamenu_settings['menu_type'] == "megamenu" ) {
                //megamenu
                if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['horizontal-menu-position'] ) ) {
                  $item->classes[] = 'iepamega-horizontal-' . $item->iepamegamenu_settings['mega_menu_settings']['horizontal-menu-position'];
                } else {
                  $item->classes[] = 'iepamega-horizontal-full-width';
                }
              } else {
                //flyout
                if ( $item->depth === 0 ) {
                  if ( isset( $item->iepamegamenu_settings['flyout_settings']['flyout-position'] ) ) {
                    $item->classes[] = 'iepamega-flyout-horizontal-' . $item->iepamegamenu_settings['flyout_settings']['flyout-position'];
                  } else {
                    $item->classes[] = 'iepamega-flyout-horizontal-left';
                  }
                }
              }

            } else {

              //vertical
              if( isset( $item->iepamegamenu_settings['menu_type'] ) && $item->iepamegamenu_settings['menu_type'] == "megamenu" ) {
                //megamenu
                if ( isset( $item->iepamegamenu_settings['mega_menu_settings']['vertical-menu-position'] ) ) {
                  $item->classes[] = 'iepamega-vertical-' . $item->iepamegamenu_settings['mega_menu_settings']['vertical-menu-position'];
                } else {
                  $item->classes[] = 'iepamega-vertical-full-height';
                }


              } else {
                //flyout
                if ( $item->depth === 0 ) {
                  if ( isset( $item->iepamegamenu_settings['flyout_settings']['vertical-position'] ) ) {
                    $item->classes[] = 'iepamega-flyout-vertical-' . $item->iepamegamenu_settings['flyout_settings']['vertical-position'];
                  } else {
                    $item->classes[] = 'iepamega-flyout-vertical-full-height';
                  }
                }

              }

            }


          }



          /* Tabs Section */
          $trigger_effect = ( isset( $item->iepamegamenu_settings['general_settings']['choose_trigger_effect'] ) && $item->iepamegamenu_settings['general_settings']['choose_trigger_effect'] == "onclick" ) ? "onclick" : "onhover";
          $tab_layouts    = ( isset( $item->iepamegamenu_settings['general_settings']['tab_layouts'] ) && $item->iepamegamenu_settings['general_settings']['tab_layouts'] != '' ) ? esc_attr( $item->iepamegamenu_settings['general_settings']['tab_layouts'] ) : "iepa-default-tab-design";

          $tabed_effect   = "iepa-tabbed-" . $trigger_effect;
          if( isset( $item->post_title ) && $item->post_title == "[Tabs]" ) {
            $item->classes[] = "iepamega-tabs iepamega-vertical-tabs " . $tabed_effect . " " . $tab_layouts;
          } else if( isset( $item->post_title ) && $item->post_title == "[HTabs]" ) {
            $item->classes[] = "iepamega-tabs iepamega-horizontal-tabs " . $tabed_effect . " " . $tab_layouts;
          }
          /* Tabs Section End */

          /* Roles & Restriction Section */
          if( $item->depth === 0 ) {
            if( isset( $item->iepamegamenu_settings['restriction_roles']['display_mode'] ) && $item->iepamegamenu_settings['restriction_roles']['display_mode'] != '' ){
              $display_mode = (
                isset( $item->iepamegamenu_settings['restriction_roles']['display_mode'] ) && ( $item->iepamegamenu_settings['restriction_roles']['display_mode'] != '' )
                ) ? esc_attr( $item->iepamegamenu_settings['restriction_roles']['display_mode'] ) : 'show_to_all';// loggedinusers,loggedoutusers, all_users, by_role
              $roles_type   = ( isset( $item->iepamegamenu_settings['restriction_roles']['roles_type'] ) ? $item->iepamegamenu_settings['restriction_roles']['roles_type'] : '' ); //adminsitrator, editor, subscriber, shop manager, customer,author, contributer.

              if ( is_user_logged_in() ) {
                $current_user_id  = get_current_user_id();
                $user_meta        = get_userdata( $current_user_id );
                $user_roles       = $user_meta->roles; //array of roles the user is part of.
                // IEPA_MM_Libary::displayArr($user_roles);
                if( $display_mode == "logged_in_users" ) {
                  $item->classes[] = "iepa-display-mode-off";
                } else if( $display_mode == "all_users" ) {
                  // all users except admin
                  if( $user_roles[0] != "administrator" ) {
                    $item->classes[] = "iepa-display-mode-off";
                  }
                } else if( $display_mode == "by_role" ) {
                  if( !empty( $roles_type ) ) {
                    if( in_array( $user_roles[0], $roles_type ) ) {
                      $item->classes[] = "iepa-display-mode-off";
                    }
                  }
                } else if( $display_mode == "show_to_all" ) {
                  $item->classes[] = "iepa-display-mode-on";
                }

              } else {

                if( $display_mode == "logged_out_users" ) {
                  $item->classes[] = "iepa-display-mode-off";
                }
              }

            }
          }
          /* Roles & Restriction Section */

          if( isset( $item->iepamegamenu_settings['general_settings']['show_menu_to_users'] ) ) {
            $menu_users_check = $item->iepamegamenu_settings['general_settings']['show_menu_to_users']; //always/loggedin users or logged oout users
            if( $menu_users_check != "always" ) {
              if( $menu_users_check == "onlyloggedin_users" ) {
                if ( !is_user_logged_in() ) {
                  $item->classes[] = "iepa-hide-menu-ltusers";
                }
              } else if( $menu_users_check == "onlyloggedout_users" ) {
                if ( is_user_logged_in() ) {
                  $item->classes[] = "iepa-hide-menu-ltusers";
                }
              }
            }
          }


          // add column classes for second level menu items displayed in mega menus
          if ( $item->in_iepamegamenu === true ) {

            $parent_settings  = array_filter( (array) get_post_meta( $item->menu_item_parent, '_iepamegamenu', true ) );
            $default_settings = new IEPA_MM_Menu_Settings();
            $parent_settings  = array_merge( $default_settings->iepa_mm_menu_item_defaults(), $parent_settings );

            $menu_item_parent     = $item->menu_item_parent;
            $get_megamenu_details = get_post_meta( $menu_item_parent, '_iepamegamenu', true );
            $grouptype            = ( isset( $get_megamenu_details['group_type'] ) ? esc_attr( $get_megamenu_details['group_type'] ) : 'single' );

            $mywidget_manager           = new IEPA_MM_Menu_Widget_Manager();
            $iepa_mega_menu_group_number = (
              isset( $item->iepamegamenu_settings['iepa_mega_menu_group_number'] ) && ( $item->iepamegamenu_settings['iepa_mega_menu_group_number'] != '' )
              ) ? esc_attr( $item->iepamegamenu_settings['iepa_mega_menu_group_number'] ) : '1';

            if( isset( $item->iepamegamenu_settings['group_type'] ) && ( $item->iepamegamenu_settings['group_type'] == "multiple" ) ) {

              if( isset( $item->iepamegamenu_settings['iepa_mega_menu_group_total_column'] ) && ( $item->iepamegamenu_settings['iepa_mega_menu_group_total_column'] != '' ) ) {
                $iepa_mega_menu_group_total_column = $item->iepamegamenu_settings['iepa_mega_menu_group_total_column'];
              } else {
                $grpwidgets     = $mywidget_manager->iepa_mm_get_group_details( $menu_item_parent );
                $group_details  = unserialize( $grpwidgets->group_details );
                if( isset( $group_details ) && !empty( $group_details ) ) {
                  foreach ( $group_details as $key => $value ) {
                    $newgroup = $value['group_no'];
                    if( $iepa_mega_menu_group_number == $newgroup ) {
                      $iepa_mega_menu_group_total_column = $value['column'];
                    }
                  }
                }
              }
              $total_columns  = $iepa_mega_menu_group_total_column;
              if( isset( $item->type ) && $item->type == "widget" ) {
                $span = (
                  isset( $item->iepamegamenu_settings['iepa_mega_menu_columns'] ) && ( $item->iepamegamenu_settings['iepa_mega_menu_columns'] != '' )
                  ) ? esc_attr( $item->iepamegamenu_settings['iepa_mega_menu_columns'] ) : '1';
              } else {
                $span = (
                  isset( $item->iepamegamenu_settings['iepa_group_mega_menu_columns'] ) && ( $item->iepamegamenu_settings['iepa_group_mega_menu_columns'] != '' )
                  ) ? esc_attr( $item->iepamegamenu_settings['iepa_group_mega_menu_columns'] ) : $total_columns;
              }


            } else {
              if( $grouptype == "multiple" ) {
                if( isset( $item->iepamegamenu_settings['iepa_mega_menu_group_total_column'] ) && $item->iepamegamenu_settings['iepa_mega_menu_group_total_column'] != '' ) {
                  $iepa_mega_menu_group_total_column = $item->iepamegamenu_settings['iepa_mega_menu_group_total_column'];
                } else {

                  $grpwidgets     = $mywidget_manager->iepa_mm_get_group_details( $menu_item_parent );
                  $group_details  = unserialize( $grpwidgets->group_details );
                  if( isset($group_details) && !empty( $group_details ) ) {
                    foreach ( $group_details as $key => $value ) {
                      $newgroup = $value['group_no'];
                      if( $iepa_mega_menu_group_number == $newgroup ) {
                        $iepa_mega_menu_group_total_column = $value['column'];
                      }
                    }
                  }
                }
                $total_columns = $iepa_mega_menu_group_total_column;

                if( isset( $item->type ) && ( $item->type == "widget" ) ) {

                  $columnsettings = get_post_meta( $item->ID, '_iepamegamenu', true );
                  $item_each_columns = (
                    isset( $columnsettings['iepa_group_mega_menu_columns'] ) && $columnsettings['iepa_group_mega_menu_columns']
                    ) ? esc_attr( $columnsettings['iepa_group_mega_menu_columns'] ) : $columnsettings;

                  $span = (
                    isset( $item->iepamegamenu_settings['iepa_mega_menu_columns'] ) && ( $item->iepamegamenu_settings['iepa_mega_menu_columns'] != '' )
                    ) ? esc_attr( $item->iepamegamenu_settings['iepa_mega_menu_columns'] ) : '1';
                } else {

                  $columnsettings     = get_post_meta( $item->ID, '_iepamegamenu', true );
                  $item_each_columns  = (
                    isset( $columnsettings['iepa_group_mega_menu_columns'] ) && $columnsettings['iepa_group_mega_menu_columns']
                    ) ? esc_attr( $columnsettings['iepa_group_mega_menu_columns'] ) : $columnsettings;

                  $span = (
                    isset( $item->iepamegamenu_settings['iepa_group_mega_menu_columns'] ) && ( $item->iepamegamenu_settings['iepa_group_mega_menu_columns'] != '' )
                    ) ? esc_attr( $item->iepamegamenu_settings['iepa_group_mega_menu_columns'] ) : $item_each_columns;
                }

              } else {
                //single column
                $total_columns  = $parent_settings['panel_columns'];
                $span = (
                  isset( $item->iepamegamenu_settings['iepa_mega_menu_columns'] ) && ( $item->iepamegamenu_settings['iepa_mega_menu_columns'] != '' )
                  ) ? esc_attr( $item->iepamegamenu_settings['iepa_mega_menu_columns'] ) : '1';
              }


            }

            if ( $total_columns >= $span ) {
              $item->classes[]  = "iepamega-{$span}columns-{$total_columns}total";
              $column_count     = $span;
            } else {
              $item->classes[]  = "iepamega-{$total_columns}columns-{$total_columns}total";
              $column_count     = $total_columns;
            }

            if ( ! isset( $parents[ $item->menu_item_parent ] ) ) {
              $parents[ $item->menu_item_parent ] = $column_count;
            } else {
              $parents[ $item->menu_item_parent ] = $parents[ $item->menu_item_parent ] + $column_count;

              if ( $parents[ $item->menu_item_parent ] > $total_columns ) {
                $parents[ $item->menu_item_parent ] = $column_count;
                $item->classes[]                    = 'iepaclear';
              }
            }

          }



        } else {

        }


      }
      return $items;
    }




    /**
    * Add responsive toggle box to the menu
    *
    */
    public function iepa_mobiletoggle( $nav_menu, $args ) {
      // make sure we're working with a IBTANA Mega Menu walker class

      if ( ! is_a( $args->walker, 'IEPAMegamenuWalker_Class' ) ) {
        return $nav_menu;
      }

      $dynamicclass = 'class="' . $args->container_class . '">';

      $current_theme_location = $args->theme_location;

      if ( ! $current_theme_location ) {
        return false;
      }

      if ( ! has_nav_menu( $current_theme_location ) ) {
        return false;
      }
      $themes_style_manager = new IEPA_MM_Theme_Settings();
      $themes               = $themes_style_manager->get_custom_theme_data(''); // get all custom themes

      // if a current_theme_location has been passed, check to see if MMM has been enabled for the current_theme_location
      $settings = get_option( 'iepamegabox_settings' ); //get all plugin metabox data from nav menu location

      $iepammmega_general_settings = get_option( 'iepamega_settings' );
      if ( is_array( $settings ) && isset( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == 1 ) {
        if( isset( $settings[ $current_theme_location ]['theme_type'] ) && ( $settings[ $current_theme_location ]['theme_type'] == "custom_themes" ) ) {
          $theme_id   = $settings[ $current_theme_location ]['theme'];
          $menu_theme = $themes_style_manager->get_custom_theme_rowdata( $theme_id );

          $theme_settings               = unserialize( $menu_theme->theme_settings );
          $responsive_breakpoint_width  = ( isset( $theme_settings['mobile_settings']['resposive_breakpoint_width'] ) && $theme_settings['mobile_settings']['resposive_breakpoint_width'] != '' ) ? esc_attr( $theme_settings['mobile_settings']['resposive_breakpoint_width'] ) : '';
        } else {
          $theme_id = esc_attr( $settings[ $current_theme_location ]['available_skin'] );
          if( isset( $iepammmega_general_settings['pre_responsive_bp'] ) && ( $iepammmega_general_settings['pre_responsive_bp'] != '' ) ) {
            $pre_responsive_bp = esc_attr( $iepammmega_general_settings['pre_responsive_bp'] );
          } else {
            $pre_responsive_bp = "910";
          }
          $responsive_breakpoint_width = $pre_responsive_bp;
        }

      }


      if( isset( $iepammmega_general_settings['enable_mobile'] ) && ( $iepammmega_general_settings['enable_mobile'] != 1 ) ) {
        $addClass = "iepamega-disable-menutoggle";
      } else {
        $addClass = "iepamega-enabled-menutoggle";
      }

      $main_content = "";

      $main_content = apply_filters(
        "iepamegamenu_togglebar_content", $main_content, $nav_menu, $args, $theme_id, $iepammmega_general_settings
      );

      $replace = $dynamicclass .
      '<div class="iepamegamenu-toggle ' . $addClass.'" data-responsive-breakpoint="' . $responsive_breakpoint_width . '">' .
      $main_content . '</div>';

      return str_replace( $dynamicclass, $replace, $nav_menu );

    }


    /**
    * Get the HTML output for the toggle blocks
    */
    public function iepa_responsive_display_togglebar_content( $content, $nav_menu, $args, $theme_id, $general_settings ) {

      $close_menu_icon =   $general_settings['close_menu_icon'];
      $open_menu_icon  =   $general_settings['open_menu_icon'];

      // if a current_theme_location has been passed, check to see if MMM has been enabled for the current_theme_location
      $settings               = get_option( 'iepamegabox_settings' ); //get all plugin metabox data from nav menu location
      $current_theme_location = $args->theme_location;

      $menutoggle_name = __( 'Menu',IEPA_TEXT_DOMAIN );
      // this is for available theme toggle section
      $blocks_html  =   "<div class='iepa-mega-toggle-block'>";
      $blocks_html  .=  "<div class='iepamega-closeblock'><i class='" . $close_menu_icon . "'></i></div>";
      $blocks_html  .=  "<div class='iepamega-openblock'><i class='" . $open_menu_icon . "'></i></div>";
      $blocks_html  .=  "<div class='menutoggle'>" . $menutoggle_name . "</div>";
      $blocks_html  .=  "</div>";

      $content .= $blocks_html;

      return $content;
    }


  }//class termination


  /**
  * Plugin initialization with object creation
  */
  $iepa_walker_obj = new IEPA_MM_Walker_Class();

}//class exists check
