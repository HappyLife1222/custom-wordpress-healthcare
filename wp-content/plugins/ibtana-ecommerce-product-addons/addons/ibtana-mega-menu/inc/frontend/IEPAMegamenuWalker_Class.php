<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if( ! class_exists( 'IEPAMegamenuWalker_Class' ) ) {

  class IEPAMegamenuWalker_Class extends Walker_Nav_Menu {
    var $counter = 0;
    /**
    * Starts the list before the elements are added.
    *
    * @see Walker::start_lvl()
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of arguments. @see wp_nav_menu()
    */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat( "\t", $depth );

      $output .= "\n$indent<div class='iepa-sub-menu-wrapper imma-menu{$depth}'>";
      //here
      $output .= "<ul class=\"iepa-mega-sub-menu\">\n"; // starting loop for sub items
    }

    /**
    * Ends the list of after the elements are added.
    *
    * @see Walker::end_lvl()
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of arguments. @see wp_nav_menu()
    */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat( "\t", $depth );
      $output .= "$indent</ul></div>\n";
    }

    /**
    * Custom walker. Add the widgets into the menu.
    *
    * @see Walker::start_el()
    *
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param object $item   Menu item data object.
    * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of arguments. @see wp_nav_menu()
    * @param int    $id     Current item ID.
    */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      $counter        = $this->counter;
      $counter++;
      $this->counter  = $counter;
      if ( is_array( $args ) ) {
        echo esc_html( "IEPA Mega Menu Notice: You haven\'t set Menu locations in menu settings or menu you selected as megamenu is not available." );
        die();
      }

      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';


      if ( !get_option( 'iepamega_settings' ) ) {
        $general_settings =  IEPA_MM_Activation::iepa_mm_default_settings();
      } else {
        $general_settings = get_option( 'iepamega_settings' );
      }


      if ( property_exists( $item, 'iepamegamenu_settings' ) ) {
        $settings = $item->iepamegamenu_settings;
      } else {
        $settings = IEPA_MM_Menu_Settings::iepa_mm_menu_item_defaults();
      }

      // Item Class  passed classes
      $classes    = empty( $item->classes ) ? array() : (array) $item->classes;

      $itemid     = isset( $item->ID ) ? $item->ID : '';
      $item_title = isset( $item->title ) ? $item->title : '';
      $type       = isset( $item->type ) ? $item->type : '';

      if ( isset( $settings['general_settings']['active_single_menu'] ) && $settings['general_settings']['active_single_menu'] == 'enabled' ) {
        $singlemenuclass  = 'imma-social-menu-item';
        $classes[]        = $singlemenuclass;
      }

      $submenu_align  = ( isset( $settings['general_settings']['submenu_align'] ) && $settings['general_settings']['submenu_align'] != "" ) ? 'iepa-submenu-align-' . $settings['general_settings']['submenu_align'] : 'iepa-submenu-align-left';
      $classes[]      = 'menu-item-' . $itemid;
      $classes[]      = 'menu-item-depth-' . $depth;
      $classes[]      = $submenu_align;


      if ( isset( $item->group_section ) && $item->group_section == 'start_group_widget' && $item->group_type == "multiple" ) {

      } else {
        if ( isset( $args->has_children ) && $args->has_children == true ) {
          $classes[] = "has-dropdown";
        } else {
          $classes[] = "no-dropdown";
        }
      }

      if ( isset( $settings['upload_image_settings']['use_custom_settings'] ) && $settings['upload_image_settings']['use_custom_settings'] == 'true' && $depth > 0 ) {
        $classes[] = "iepa-custom-post-settings";
        if( isset( $settings['upload_image_settings']['text_position'] ) ) {
          $classes[] = IEPA_MM_CSS_PREFIX . 'image-' . $settings['upload_image_settings']['text_position'];
        }
      }


      $class = join( ' ', apply_filters( 'imma_nav_menu_css_class', array_filter( $classes ), $item, $args ) );

      // strip widget classes back to how they're intended to be output
      $class = str_replace( "im_menu_addon_widget_wrap-", "", $class );

      // Item ID
      $itemid = esc_attr( apply_filters( 'iepamegamenu_nav_menu_item_id', "wp_nav_menu-item-{$itemid}", $item, $args ) );

      //IEPA_MM_Libary::displayArr($item);
      // build html
      $tabbed_animation = ( isset( $settings['general_settings']['tabbed_animation'] ) ) ? esc_attr( $settings['general_settings']['tabbed_animation'] ) : "fadeInDown";
      if ( isset( $item->group_section ) && $item->group_section == 'start_group_widget' && $item->group_type == "multiple" ) {
        $output .= $indent ."<div class='{$class}'>";
      } else if( isset( $item->group_section ) && $item->group_section == 'end_group_widget' && $item->group_type == "multiple" ) {
      } else {
        $menu_parent_id   = ( isset( $item->menu_item_parent ) ? $item->menu_item_parent : '' );
        $parent_settings  = array_filter( (array) get_post_meta( $menu_parent_id, '_iepamegamenu', true ) );

        if( isset( $parent_settings['group_type'] ) && $parent_settings['group_type'] == "multiple" ) {

          if( $type != "widget" && $type == "submenu" && $item->depth == 1 ) {
            $output .= $indent . "<div class='iepa-clone-submenus'><li class='{$class}' id='{$itemid}'>";
          } else if( $type != "widget" && $type != "submenu" && $item->depth == 1 ) {
            $output .= $indent ."<div class='iepa-original-submenus'><li class='{$class}' id='{$itemid}'>";
          } else {
            if( $item_title == "[Tabs]" || $item_title == "[HTabs]" ) {
              $animation = " data-animation='{$tabbed_animation}'";
            } else {
              $animation = '';
            }
            $output .= $indent ."<li class='{$class}' id='{$itemid}'{$animation}>";
          }

        } else {
          if( $item_title == "[Tabs]" || $item_title == "[HTabs]" ) {
            $animation = " data-animation='{$tabbed_animation}'";
          } else {
            $animation = '';
          }
          $output .= $indent . "<li class='{$class}' id='{$itemid}'{$animation}>";
        }
      }

      //IEPA_MM_Libary::displayArr($item);

      if ( isset( $item->group_section ) && $item->group_section == 'start_group_widget' && $item->group_type == "multiple" ) {
        $item_output = '';
      } else if( isset( $item->group_section ) && $item->group_section == 'end_group_widget' && $item->group_type == "multiple" ) {
        $item_output ='';
      } else {


        /************************************************  Case 2: Single  Group Start ************************************************/
        // output the widgets

        if ( $type == 'widget' && $item->content ) {

          $item_output = $item->content;

        } else {
          /* check if search type or not*/
          $choose_menu_type = ( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] != "default" ) ? esc_attr( $settings['mega_menu_settings']['choose_menu_type'] ) : '';

          $sub_attrs = array();

          $sub_attrs['title']   = !empty( $item->attr_title ) ? esc_attr( $item->attr_title ) : '';
          $sub_attrs['target']  = !empty( $item->target ) ? esc_attr( $item->target ) : '';
          $sub_attrs['class']   = '';
          $sub_attrs['rel']     = !empty( $item->xfn ) ? esc_attr( $item->xfn ) : '';

          if ( isset( $settings['general_settings']['active_link'] ) ) {
            if( $choose_menu_type != "search_type" ) {
              if( isset( $item->url ) ) {
                $sub_attrs['href']  =  !( empty( $item->url ) && $item->url != '#' ) ? esc_url( $item->url ) : '';
              } else {
                $sub_attrs['href']  =  "";
              }
            }
          }

          if ( isset( $general_settings['hide_icons']) && $general_settings['hide_icons'] == '1' ) {
            $sub_attrs['class'] = "hide_main_icons";
          }

          $sub_attrs = apply_filters( 'im_menu_addon_nav_menu_link_attributes', $sub_attrs, $item, $args );

          if ( isset( $sub_attrs['class'] ) && strlen( $sub_attrs['class'] ) ) {
            $sub_attrs['class'] = $sub_attrs['class'] . ' iepa-mega-menu-link';
          } else {
            $sub_attrs['class'] = 'iepa-mega-menu-link';
          }

          /* Menu Replacement type */
          switch ( $choose_menu_type ) {
            case 'search_type':
              $choose_style   = isset( $settings['mega_menu_settings']['custom_content'] ) ? $settings['mega_menu_settings']['custom_content'] : '';
              $out            = $this->iepa_get_all_attributes( 'im_menuaddon_search_form', $choose_style );
              $template_type  = $out['template_type'];
              // $style = $out['style'];
              if( $template_type == "inline-search" ) {
                $classtype = "iepa-search-type iepamega-searchinline";
              } else if( $template_type == "popup-search-form" ) {
                $classtype = "iepa-search-type iepa-search-popup";
              } else {
                $classtype = "iepa-search-type iepamega-searchdown";
              }
              break;

            case 'logo_image':
              $classtype = "iepamega-logo-image";
              break;

            case 'woo_cart_total':
              $classtype = "iepamega-woo-cart-total";
              break;

            case 'login_form':
              if( is_user_logged_in() ) {
                $classtype = "iepamega-user-logout";
              } else {
                $classtype = "iepamega-user-login-form";
              }
              break;

            case 'register_form':
              $classtype = "iepamega-user-register-form";
              break;

            default:
              $classtype = 'iepa-mega-menu-link';
              break;
          }
          $sub_attrs['class'] =  $classtype;

          /* Menu Replacement type End*/

          /* Custom Single Menu Item Link Such as for social links*/
          if ( isset( $settings['general_settings']['active_single_menu'] ) && $settings['general_settings']['active_single_menu'] == 'enabled' ) {
            $sub_attrs['class'] =  'iepa-csingle-menu';
          }
          if ( isset( $settings['general_settings']['disable_text'] ) && $settings['general_settings']['disable_text'] == 'true' ) {
            $sub_attrs['class'] .=  ' iepa-disable-text';
          }

          $attributes = '';

          foreach ( $sub_attrs as $attr => $value ) {

            if ( ! empty( $value ) ) {
              $value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
              $attributes .= ' ' . $attr . '="' . $value . '"';
            }

          }


          $item_output = $args->before;

          if ( isset( $settings['upload_image_settings']['use_custom_settings'] ) && $settings['upload_image_settings']['use_custom_settings'] == 'true' && $depth > 0 ) {
            $item_output .= '';
          } else {
            if( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'woo_cart_total' || $item_title == "[Tabs]" || $item_title == "[HTabs]" ) {
              $item_output .= '';
            } else if( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'login_form' ) {
              if( is_user_logged_in() ) {
                $item_output .= '<a class="iepa-logout-btn" href="' . wp_logout_url() . '">';
              } else {
                $item_output .= '<a' . $attributes . '>';
              }
            } else {
              if( $item_title != '' ) {
                $item_output .= '<a' . $attributes . '>';
              }
            }
          }


          /* Case 1: Show Menu label*/
          $menu_label = ( isset( $settings['general_settings']['top_menu_label'] ) && $settings['general_settings']['top_menu_label'] != "" ) ? esc_attr( $settings['general_settings']['top_menu_label'] ) : '';

          //for specific menu animation
          $specificmenu_animation = ( isset( $settings['general_settings']['label_animation'] ) && $settings['general_settings']['label_animation'] != "" ) ? esc_attr( $settings['general_settings']['label_animation'] ) : 'none';
          $mlabel                 = ( isset( $general_settings['mlabel_animation_type'] ) && $general_settings['mlabel_animation_type'] != "none" ) ? esc_attr( $general_settings['mlabel_animation_type'] ) : '';
          if( $specificmenu_animation != 'none' ) {
            $mlabel = $specificmenu_animation;
          } else {
            if( $mlabel != "none" ) {
              $mlabel = $mlabel;
            } else {
              $mlabel = "";
            }
          }

          if( !empty( $menu_label ) ) {
            $cl = 'mlabel_' . $itemid;
            if( $depth == 0 ) {
              $depthclass   = "imma_depth_first";
              $item_output  .= '<span id="' . $cl . '" class="iepa-mega-menu-label ' . $depthclass . ' ' . $mlabel . '" aria-hidden="true">' . ucwords( $menu_label ) . '</span>';
            }
            /*  else{
            $depthclass = "imma_depth_last";
            if (isset($settings['upload_image_settings']['use_custom_settings']) && $settings['upload_image_settings']['use_custom_settings'] != 'true') {
            $item_output .= '<span id="'.$cl .'" class="iepa-mega-menu-label '.$depthclass.' '.$mlabel.'" aria-hidden="true">'.ucwords($menu_label).'</span>';
            }
            }*/
          }

          /* Menu label Section End */

          /* check menu icons */
          /* Case 2: To show icons menu is equal to 1 */

          $disable_description  = ( isset( $settings['general_settings']['disable_desc'] ) && $settings['general_settings']['disable_desc'] == "true" ) ? 1 : 0;
          if ( isset( $general_settings['hide_icons'] ) && $general_settings['hide_icons'] != '1' ) {

            if( isset( $settings['general_settings']['menu_icon'] ) ) {
              if ( $settings['general_settings']['menu_icon'] == 'enabled' || $settings['general_settings']['menu_icon'] != '' ) {
                if( isset( $settings['icons_settings']['enable_customimg'] ) && $settings['icons_settings']['enable_customimg'] == true ) {
                  //custom image icons
                  $custom_image_url = ( isset( $settings['icons_settings']['custom_image_url'] ) && $settings['icons_settings']['custom_image_url'] != '' ) ? esc_url( $settings['icons_settings']['custom_image_url'] ) : '';

                  $icon_type        = 'custom';
                  $icon_class       = $custom_image_url;
                } else if( isset( $settings['icons_settings']['icon_choose'] ) ) {
                  $attr_class = $settings['icons_settings']['icon_choose'];

                  $split      = explode( '|', $attr_class, 2 );
                  $v1         = empty( $split[0] ) ? '' : $split[0];
                  $v2         = empty( $split[1] ) ? '' : $split[1];

                  $icon_class = $v1 . ' ' . $v2;
                  $icon_type = 'available';

                } //icon_choose not blank
              } // menu_icon not disabled end
            } else {
              $attr_class = "";
              $icon_class = "";
              $icon_type  = "";
            }
          } //hide_icons is not equal to 1 end
          else {
            $attr_class = "";
            $icon_class = "";
            $icon_type  = "";
          }
          $customwidth  = ( isset( $settings['icons_settings']['custom_width'] ) &&  $settings['icons_settings']['custom_width'] != '' ) ? esc_attr( $settings['icons_settings']['custom_width'] ) : '13';
          $customheight = ( isset( $settings['icons_settings']['custom_height'] ) &&  $settings['icons_settings']['custom_height'] != '' ) ? esc_attr( $settings['icons_settings']['custom_height'] ) : '13';

          //IEPA_MM_Libary::displayArr($general_settings);


          if ( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'search_type' && $depth == 0 ) {
            //Display Search Icon and form here
            $choose_style   = $settings['mega_menu_settings']['custom_content'];
            $out            = $this->iepa_get_all_attributes( 'im_menuaddon_search_form', $choose_style );
            $template_type  = $out['template_type'];
            // $style = $out['style'];
            if( $template_type == "inline-search" ) {
              $classtype  = "iepa-search-inline";
            } else if( $template_type == "popup-search-form" ) {
              $classtype = "iepa-popup-search-form";
            }
            if( isset( $icon_type ) && $icon_type == "custom" ) {
              if( $icon_class != '' && !empty( $icon_class ) ) {
                $item_output .= '<span class="iepa-mega-menu-icon ' . $classtype . '">
                <img src="' . esc_url( $icon_class ) . '" width="' . esc_attr( $customwidth ) . '" height="' . esc_attr( $customheight ) . '" />
                </span>';
              }
            } else {
              if( $icon_class != '' && !empty( $icon_class ) ) {
                $item_output .= '<span class="iepa-mega-menu-icon ' . $classtype . '">
                <i class="iepa-mega-menu-icon ' . $icon_class . '" aria-hidden="true"></i>
                </span>';
              }
            }

            if( $template_type == "inline-search" || $template_type == "popup-search-form" ) {
              $item_output .= '<div class="iepa-search-form">' . do_shortcode( $choose_style ) . '</div>';
            }
          } else if( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'logo_image' && $depth == 0 ) {
            //Display Logo Image here
            $logo_image_url = ( isset( $settings['mega_menu_settings']['logo_image'] ) && $settings['mega_menu_settings']['logo_image'] != '' ) ? esc_url( $settings['mega_menu_settings']['logo_image'] ) : '';
            $logowidth      = ( isset( $settings['mega_menu_settings']['custom_width'] ) && $settings['mega_menu_settings']['custom_width'] != '' ) ? esc_attr( $settings['mega_menu_settings']['custom_width'] ) : '';
            $logoheight     = ( isset( $settings['mega_menu_settings']['custom_height'] ) && $settings['mega_menu_settings']['custom_height'] != '' ) ? esc_attr( $settings['mega_menu_settings']['custom_height'] ) : '';
            $classstyle     = "style=width:" . $logowidth . "px; height:" . $logoheight . "px;";

            if( $logo_image_url != '' ) {
              $url_arr  = explode( '/', $logo_image_url );
              $ct       = count( $url_arr );
              $name     = $url_arr[ $ct-1 ];
              $name_div = explode( '.', $name );
              //  $ct_dot = count($name_div);
              // $img_type = $name_div[$ct_dot -1]; // return image type i.e png
              $item_output .= '<img src="' . esc_url( $logo_image_url ) . '" alt="' . esc_attr( $name_div[0] ) . '" ' . $classstyle . '>';
            }

          } else if( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'woo_cart_total' && $depth == 0 ) {
                         //Display Woocommerce Cart here

           $woo_cart_display      = ( isset( $general_settings['choose_woo_cart_display'] ) ) ? esc_attr( $general_settings['choose_woo_cart_display'] ) : 'both_pi';
           $cart_display_pattern  = ( isset( $general_settings['cart_display_pattern'] ) && $general_settings['cart_display_pattern'] != '' ) ? esc_attr( $general_settings['cart_display_pattern'] ) : '(#price)#item_count items';
            // $cart_display_layout = (isset($settings['mega_menu_settings']['cart_display_layout']) && $settings['mega_menu_settings']['cart_display_layout']!='')?esc_attr($settings['mega_menu_settings']['cart_display_layout']):'';
            $enable_custom_image = (isset($settings['icons_settings']['enable_customimg']) && $settings['icons_settings']['enable_customimg'] == 'true')?1:0;
            $custom_image_url = (isset($settings['icons_settings']['custom_image_url']) && $settings['icons_settings']['custom_image_url']!='')?esc_url($settings['icons_settings']['custom_image_url']):'';
            $custom_width = (isset($settings['icons_settings']['custom_width']) && $settings['icons_settings']['custom_width']!='')?esc_attr($settings['icons_settings']['custom_width']):'20';
            $custom_height = (isset($settings['icons_settings']['custom_height']) && $settings['icons_settings']['custom_height']!='')?esc_attr($settings['icons_settings']['custom_height']):'20';

            if($custom_image_url != ''){
                        $url_arr = explode ('/', $custom_image_url);
                        $ct = count($url_arr);
                        $name = $url_arr[$ct-1];
                        $nameimage = explode('.', $name);
             }else{
               $nameimage = '';
             }
            if (isset($settings['general_settings']['disable_text']) &&
             $settings['general_settings']['disable_text'] == 'true' ) {
                  $class =  ' iepa-disable-text';
             }else{
              $class =  '';
             }

             $item_output .= IMMA_Class_Pro::iepa_mm_shopping_cart_ajax_data($woo_cart_display, $cart_display_pattern,$enable_custom_image,$custom_image_url,$custom_width,$custom_height,$nameimage,$icon_type,$icon_class, $customwidth,$customheight,$attr_class,$class);


                }else if(isset($settings['mega_menu_settings']['choose_menu_type']) && $settings['mega_menu_settings']['choose_menu_type'] == 'login_form' && $depth == 0){
                       if( !is_user_logged_in() ) {
                         if( isset( $icon_type ) && $icon_type == "custom" ) {
                           if( $icon_class != '' && !empty( $icon_class ) ) {
                            $item_output .= '<span class="iepa-mega-menu-icon imma-mega-userlogin">
                            <img src="' . esc_url( $icon_class ) . '" width="' . esc_attr( $customwidth ) . '" height="' . esc_attr( $customheight ) . '" />
                            </span>';
                           }
                          } else {
                            if( $icon_class != '' && !empty( $icon_class ) ) {
                              $item_output .= '<span class="iepa-mega-menu-icon imma-mega-userlogin"><i class="iepa-mega-menu-icon ' . $icon_class . '" aria-hidden="true"></i></span>';
                            }
                          }


                       }
                }else if( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'register_form' && $depth == 0 ) {
                          if( isset( $icon_type ) && $icon_type == "custom" ) {
                            if( $icon_class != '' && !empty( $icon_class ) ) {
                              $item_output .= '<span class="iepa-mega-menu-icon imma-mega-userlogin">
                              <img src="' . esc_url( $icon_class ) . '" width="' . esc_attr( $customwidth ) . '" height="' . esc_attr( $customheight ) . '"/>
                              </span>';
                            }
                          } else{
                            if($icon_class != '' && !empty($icon_class)){
                              $item_output .= '<span class="iepa-mega-menu-icon imma-mega-userlogin"><i class="iepa-mega-menu-icon ' . $icon_class . '" aria-hidden="true"></i></span>';
                            }
                          }
                }else{

                           if( isset( $icon_type ) && $icon_type == "custom" ) {
                             if( $icon_class != '' && !empty( $icon_class ) ) {
                               $item_output .= '<span class="iepa-mega-menu-icon">
                               <img src="' . esc_url( $icon_class ) . '" width="' . esc_attr( $customwidth ) . '" height="' . esc_attr( $customheight ) . '" />
                               </span>';
                             }
                           } else{
                             if(isset($attr_class) && $attr_class != ''){
                               if($icon_class != '' && !empty($icon_class)){
                                 $item_output .= '<i class="iepa-mega-menu-icon ' . $icon_class . '" aria-hidden="true"></i>';
                               }
                             }
                           }

                  }



          //} // check if second level custom settings is enable or not , if enable dont display menu icon and label here.

          /* Case 3: To display menu title if enable */
            /*menu icons check end*/
           if (isset($settings['general_settings']['disable_text']) && $settings['general_settings']['disable_text'] == 'true' ) {
                /** This filter is documented in wp-includes/post-template.php */
            }else if($item_title == "[Tabs]"){
                  // $item_output .= 'tabs here';
             }else if($item_title == "[HTabs]"){
                  // $item_output .= 'tabs here';
             }else{
                  if (isset($settings['upload_image_settings']['use_custom_settings']) && $settings['upload_image_settings']['use_custom_settings'] == 'true') {
                   //dont show menu text here for custom settings
                  }else{

                    //display menu title
                    if (!isset($settings['general_settings']['disable_text'])) {
                        if($item_title != ''){
                         $item_output .= '<span class="iepa-mega-menu-href-title">';
                        }
                        if(isset($settings['mega_menu_settings']['choose_menu_type']) && $settings['mega_menu_settings']['choose_menu_type'] == 'login_form' && $depth == 0){
                          if(!is_user_logged_in()){
                             $item_output .= $args->link_before . apply_filters( 'im_menu_addon_the_title', $item_title, $itemid ) . $args->link_after;
                          }else{
                             $item_output .= $args->link_before . apply_filters( 'im_menu_addon_the_title', 'Logout', $itemid ) . $args->link_after;
                          }
                        }else{
                          $item_output .= $args->link_before . apply_filters( 'im_menu_addon_the_title', $item_title, $itemid ) . $args->link_after;
                        }
                      $item_output .= '</span>';
                      /* show login and register form here */
                      if(isset($settings['mega_menu_settings']['choose_menu_type']) && $settings['mega_menu_settings']['choose_menu_type'] == 'register_form'){
                             $rshowform = ( isset( $settings['mega_menu_settings']['register_form_shortcode'] ) && $settings['mega_menu_settings']['register_form_shortcode'] != '' ) ? $settings['mega_menu_settings']['register_form_shortcode'] : '';
                              if ( shortcode_exists( 'im_menuaddon_register_form' ) ) {
                                  // The [gallery] short code exists.
                                $rnew_showform = '[im_menuaddon_register_form title="Register"]';
                                $item_output .= '<div class="iepa-login-form"><div class="iepa_login_overlay"></div>' . do_shortcode( $rnew_showform ) . '</div>';
                              }else{
                                $item_output .= '<div class="iepa-login-form"><div class="iepa_login_overlay"></div>' . do_shortcode( $rshowform ) . '</div>';
                              }

                        }else if( isset( $settings['mega_menu_settings']['choose_menu_type'] ) && $settings['mega_menu_settings']['choose_menu_type'] == 'login_form'){
                             $showform = ( isset( $settings['mega_menu_settings']['login_form_shortcode'] ) && $settings['mega_menu_settings']['login_form_shortcode'] != '' ) ? $settings['mega_menu_settings']['login_form_shortcode'] : '';
                              if ( shortcode_exists( 'im_menuaddon_login_form' ) ) {
                                  // The [gallery] short code exists.
                                $lnew_showform = '[im_menuaddon_login_form title="Login"]';
                                 $item_output .= '<div class="iepa-login-form"><div class="iepa_login_overlay"></div>' . do_shortcode( $lnew_showform ) . '</div>';
                              }else{
                                  $item_output .= '<div class="iepa-login-form"><div class="iepa_login_overlay"></div>' . do_shortcode( $showform ) . '</div>';
                              }

                        }

                    }else{
                        if (isset($settings['general_settings']['disable_text']) && $settings['general_settings']['disable_text'] == "false") {
                        if($item_title != ''){
                         $item_output .= '<span class="iepa-mega-menu-href-title">';
                        }
                        $item_output .= $args->link_before . apply_filters( 'im_menu_addon_the_title', $item_title, $itemid ) . $args->link_after;
                        $item_output .= '</span>';

                      }
                    }
                  if($disable_description == 0 && isset($item->description) && $item->description != '' && $item->description != '...' ){
                     $item_output .= '<span class="imma-span-divider"></span>';
                    $item_output .= '<span class="imma-target-description imma-target-text">';
                    $item_output .= $item->description;
                    $item_output .= '</span>';
                  }
                 /* menu label for second depth*/
                 if(!empty($menu_label)){
                    $cl = 'mlabel_' . $itemid;
                    if($depth > 0){
                        $depthclass = "imma_depth_last";
                        if (isset($settings['upload_image_settings']['use_custom_settings']) && $settings['upload_image_settings']['use_custom_settings'] != 'true') {
                            $item_output .= '<span id="' . $cl . '" class="iepa-mega-menu-label ' . $depthclass . ' ' . $mlabel . '" aria-hidden="true">' . ucwords( esc_html( $menu_label ) ) . '</span>';
                        }
                      }
                   }

                 }
            }


           if (isset($settings['upload_image_settings']['use_custom_settings']) && $settings['upload_image_settings']['use_custom_settings'] == 'true' && $depth > 0) {
            }else{
            if(isset($settings['mega_menu_settings']['choose_menu_type']) && $settings['mega_menu_settings']['choose_menu_type'] == 'woo_cart_total' || isset($item_title) && $item_title == "[Tabs]" || isset($item_title) && $item_title == "[HTabs]"){
             }else{
                $item_output .= '</a>';
              }
            }

            $item_output .= $args->after;

               /* Display Top Content for megamenu*/
            if($depth == 0){
               if(isset($settings['menu_type']) && $settings['menu_type'] == "megamenu"){

                if(isset($settings['upload_image_settings']['enable_bg_image']) && $settings['upload_image_settings']['enable_bg_image'] == true){
                  $bgtype = (isset($settings['upload_image_settings']['bg_image_type']) && $settings['upload_image_settings']['bg_image_type'] == "single_image")?'single_image':'double_image';
                  $single_bg_image_url = (isset($settings['upload_image_settings']['single_bg_image_url']) && $settings['upload_image_settings']['single_bg_image_url'] != "")?esc_url($settings['upload_image_settings']['single_bg_image_url']):'';
                  $bg_image_url1 = (isset($settings['upload_image_settings']['bg_image_url1']) && $settings['upload_image_settings']['bg_image_url1'] != "")?esc_url($settings['upload_image_settings']['bg_image_url1']):'';
                  $bg_image_url2 = (isset($settings['upload_image_settings']['bg_image_url2']) && $settings['upload_image_settings']['bg_image_url2'] != "")?esc_url($settings['upload_image_settings']['bg_image_url2']):'';
                  $image_position = (isset($settings['upload_image_settings']['image_position'])) ? esc_attr( $settings['upload_image_settings']['image_position'] ) : 'bottom right';
                  $image_repeat = (isset($settings['upload_image_settings']['image_repeat'])) ? esc_attr( $settings['upload_image_settings']['image_repeat'] ) : 'no-repeat';
                  $bgsize = (isset($settings['upload_image_settings']['bgsize'])) ? esc_attr( $settings['upload_image_settings']['bgsize'] ) : 'cover';

                  $enable_bgoverlay = (isset($settings['upload_image_settings']['enable_bg_overlay']) && $settings['upload_image_settings']['enable_bg_overlay'] == 'true') ? 1 : 0;
                  $setoverlay_color = (isset($settings['upload_image_settings']['setoverlay_color'])) ? esc_attr( $settings['upload_image_settings']['setoverlay_color'] ) : '';
                  $animation_type = (isset($settings['upload_image_settings']['animation_type']) ? esc_attr( $settings['upload_image_settings']['animation_type'] ) : 'FadeInOut');
                  $single_animation_type = ( isset( $settings['upload_image_settings']['single_animation_type'] ) ? esc_attr( $settings['upload_image_settings']['single_animation_type'] ) :'zoom' );
                  $bgstyle_overlay_attr = '';
                  if( $enable_bgoverlay ==  '1' ) {
                    if( $setoverlay_color != '' ) {
                      $bgstyle_overlay_attr .= 'style="background-color: ' . $setoverlay_color . '"';
                    }
                  }
                /* Single background and double bg image setup */
                 if($bgtype == "single_image"){
                    if($single_bg_image_url != ''){
                       $single_bg_image_url_wrap = 'style="background-image:url(' . esc_url( $single_bg_image_url ) . ');background-size:' . esc_attr( $bgsize ) . ';background-repeat:' . esc_attr( $image_repeat ) . '; background-position:' . esc_attr( $image_position ) . ';"';
                       $bgclass = "imma-enable-bgimage";
                    }else{
                      $single_bg_image_url_wrap = '';
                      $bgclass = "";
                    }
                    $item_output .= "<div class='iepa-sub-menu-wrap " . $bgclass . "' data-id='" . esc_attr($enable_bgoverlay) . "' ".$single_bg_image_url_wrap.">";
                      if($single_bg_image_url != ''){
                       $item_output .= "<div class='imma-bgoverlay' ".$bgstyle_overlay_attr ."></div>";
                       }

                  }else{
                    if($bg_image_url1 != ''){
                       $double_bg_image_url_wrap = 'style="background-image:url('.$bg_image_url1.');background-size:'.$bgsize.';background-repeat:'.$image_repeat.';background-position:'.$image_position.';"';
                     $bgclass = "imma-enable-bgimage";
                    }else{
                      $double_bg_image_url_wrap = '';
                      $bgclass = "";
                    }

                       $item_output .= "<div class='iepa-sub-menu-wrap " . $bgclass . " imma-" . $animation_type . " iepa-double-image-animation' " . $double_bg_image_url_wrap . ">";
                        if($bg_image_url1 != '' || $bg_image_url2 != '') {
                          $item_output .= "<div class='imma-bgoverlay' " . $bgstyle_overlay_attr . "></div>";
                          $item_output .= "<div class='iepa-background-image " . $animation_type . "' id='imma_cbg_".$itemid."' style='display:none;'>";
                           $item_output .= "<span data-second-image='" . esc_url( $bg_image_url2 ) . "' data-top-image='" . esc_url( $bg_image_url1 ) . "' class='animation-double-bgimage' />";
                          $item_output .= "</div>";
                       }
                 }

                }else{
                  if( $choose_menu_type == "search_type" ){
                     $out = $this->iepa_get_all_attributes( 'im_menuaddon_search_form', $choose_style );
                      $template_type = $out['template_type'];
                      if($template_type == "megamenu-type-search"){
                        $item_output .= "<div class='iepa-sub-menu-wrap'>";
                        $item_output .= '<div class="iepa-search-form">' . do_shortcode( $choose_style ) . '</div>';
                      }
                  }else if( $choose_menu_type != "logo_image" && $choose_menu_type != "login_form" && $choose_menu_type != "register_form" ) {
                     $item_output .= "<div class='iepa-sub-menu-wrap'>";
                  }
                }

              }

                if(isset($settings['menu_type']) && $settings['menu_type'] == "megamenu" && isset($settings['mega_menu_settings']['show_top_content']) && $settings['mega_menu_settings']['show_top_content'] == 'true'){
                    if(isset($settings['mega_menu_settings']['top']['top_content_type'])){
                    if($settings['mega_menu_settings']['top']['top_content_type'] == "text_only"){
                        //text only

                     $topcontent = $settings['mega_menu_settings']['top']['top_content'];
                     if($topcontent != ''){
                     $item_output .= "<span class='iepa_megamenu_topcontent'>" . $topcontent . "</span><div class='clear top_clearfix'></div>";
                    }


                    }else if($settings['mega_menu_settings']['top']['top_content_type'] == "image_only"){
                          //image only
                        $image_url = $settings['mega_menu_settings']['top']['image_url'];
                        if($image_url != ''){
                          $topimage = "<img src='" . esc_url( $image_url ) . "'/>";
                          $item_output .= "<div class='iepa-topimage'>" . $topimage . "</div><div class='clear top_clearfix'></div>";
                         }
                    }else{

                      $html_content = (isset($settings['mega_menu_settings']['top']['html_content']) && $settings['mega_menu_settings']['top']['html_content'] != '')?$settings['mega_menu_settings']['top']['html_content']:'';
                      if( $html_content != ''){
                          $item_output .= "<div class='iepa-html-content iepa-ctop'>". $html_content."</div><div class='clear top_clearfix'></div>";
                      }


                    }
                 }//close top content type

                }//megamenu check close


                if(isset($settings['mega_menu_settings']['choose_menu_type'])){
                  $menutypee = $settings['mega_menu_settings']['choose_menu_type'];

                  switch ($menutypee) {
                    case 'search_type':
                      # code...
                      $choose_style = (isset($settings['mega_menu_settings']['custom_content']) && $settings['mega_menu_settings']['custom_content'] != '')?esc_attr($settings['mega_menu_settings']['custom_content']):'';
                      $out = $this->iepa_get_all_attributes( 'im_menuaddon_search_form', $choose_style );
                      $template_type = $out['template_type'];
                      if($template_type == "megamenu-type-search"){
                           $item_output .= '<div class="iepa-search-form">'.do_shortcode($choose_style).'</div>';
                        }else if($template_type == "popup-search-form"){
                           $item_output .= do_shortcode($choose_style);
                        }
                      break;
                   case 'woo_cart_total':
                      # code...
                      break;

                    default:
                      # code...
                      break;
                  }

                }
            }//top depth check complete

         /* Case 4: Show custom setting for submegamenu with post details display on sub menu ,feasible only on meagemenu type*/
                if (isset($settings['upload_image_settings']['use_custom_settings']) && $settings['upload_image_settings']['use_custom_settings'] == 'true' && $depth > 0) {
                 $post_id = $item->object_id;
                 $get_posts_details = get_post($item->object_id );

                 $title = isset($get_posts_details->post_title)?$get_posts_details->post_title:'';
                 $post_date = isset($get_posts_details->post_date)?date('d F Y',strtotime($get_posts_details->post_date)):'';

                 $post_date = isset($get_posts_details->post_date)?date('d F Y',strtotime($get_posts_details->post_date)):'';

                 if(isset($settings['upload_image_settings']['show_description']) && $settings['upload_image_settings']['show_description'] == 'true'){
                    $post_length = isset($settings['upload_image_settings']['show_desc_length'])?$settings['upload_image_settings']['show_desc_length']:'';
                    $desc = $this->imma_get_excerpt_by_id($post_id,$post_length);

                 }else{
                     $desc = '';
                 }

                //author name
                if(isset($settings['upload_image_settings']['display_author_name']) && $settings['upload_image_settings']['display_author_name'] == 'true'){
                     $post_author_id = isset($get_posts_details->post_author)?$get_posts_details->post_author:'';
                   //$author_name = get_author_name($post_author_id);
                   $author_name = get_the_author_meta('display_name',$post_author_id);
                 }else{
                     $author_name = '';
                 }

                 //category name
                if(isset($settings['upload_image_settings']['display_cat_name']) && $settings['upload_image_settings']['display_cat_name'] == 'true'){
                    $category = get_the_category( $post_id );
                    $cat_name = (isset($category[0]) && $category[0]->cat_name != '')?$category[0]->cat_name:'';
                 }else{
                     $cat_name = '';
                 }

                 // $desc = isset($post_7->post_content)?$post_7->post_excerpt:'';
                  if(isset($settings['upload_image_settings']['display_posts_images']) && $settings['upload_image_settings']['display_posts_images'] == "featured-image"){
                     $default_imgsetsize  = ( isset( $settings['upload_image_settings']['image_size'] ) ) ? esc_attr( $settings['upload_image_settings']['image_size'] ) : 'default';
                     if( $default_imgsetsize == "default" ) {
                       $imgsetsize = $general_settings['image_size'];
                     } else {
                       $imgsetsize = $settings['upload_image_settings']['image_size'];
                     }
                     $img_src     = get_the_post_thumbnail( $item->object_id, $imgsetsize );
                     $image_url   = get_the_post_thumbnail( $item->object_id, $imgsetsize );
                     $class_name  = "iepa-featured-image";
                     $stylee      = '';
                 }else{
                    $image_url              = isset( $settings['upload_image_settings']['default_thumbnail_imageurl'] ) ? esc_url( $settings['upload_image_settings']['default_thumbnail_imageurl'] ) : '';
                    $enable_custom_inherit  = ( isset( $settings['upload_image_settings']['enable_custom_inherit'] ) && $settings['upload_image_settings']['enable_custom_inherit'] == 1 ) ? '1' : '0';

                     if( $enable_custom_inherit == "1"){
                        //choose default custom set
                         $image_width = isset($settings['upload_image_settings']['custom_width'])?esc_attr($settings['upload_image_settings']['custom_width']):'';
                     }else{
                         $image_width = isset($settings['upload_image_settings']['custom_width'])?esc_attr($settings['upload_image_settings']['custom_width']):'';
                     }

                   if($image_width != ''){
                        $stylee = "style='width:".$image_width.";'";
                    }else{
                        $stylee = '';
                    }
                    $img_src = "<img src='" . esc_url( $image_url ) . "' />";
                    $class_name = "iepa-custom-image";
                 }


                 if(isset($settings['upload_image_settings']['display_readmore']) && $settings['upload_image_settings']['display_readmore'] == "true"){
                   $readmorelink = isset($settings['upload_image_settings']['readmore_text']) ? $settings['upload_image_settings']['readmore_text'] : '';
                 }else{
                    $readmorelink = '';
                 }

                $class_position = ( isset( $settings['upload_image_settings']['text_position'] ) ? esc_attr( $settings['upload_image_settings']['text_position'] ) : 'left' );


                 $item_output .= '<div class="iepa-sub-menu-posts">';


                   $item_output .= '<div class="iepa-custom-postimage">';
                   $item_output .= '<a'. $attributes .'>';

                    if( $image_url != '' ) {
                      $item_output .= '<div class=' . $class_name . ' ' . $stylee . '>';
                    }
                     if($image_url != ''){
                             // show menu label on image overlap for custom settings
                             if(!empty($menu_label)){

                              $item_output .= '<span class="iepa-custom-label" aria-hidden="true">'.
                              ucwords( $menu_label ) .
                              '</span>';

                             }
                           $item_output .= $img_src;
                     }

                    if($class_position != "onlyimage"){
                      if($cat_name != ''){
                        $item_output .= '<span class="iepa-post-category">' . $cat_name . '</span>';
                      }
                    }

                  if($image_url != ''){
                     $item_output .= "</div>";
                   }

                     if($class_position != "onlyimage"){
                        if( $image_url == '' && !empty( $menu_label ) ) {
                          $item_output .= '<span class="iepa-mega-menu-label" aria-hidden="true">' . ucwords( $menu_label ) . '</span>';
                        }

                         $item_output .= '<div class="imma-posts-title-desc-wrap"><span class="iepa-mega-menu-href-title">';
                         $item_output .= $args->link_before .apply_filters( 'im_menu_addon_the_title', $item_title, $itemid ). $args->link_after;
                         $item_output .= '</span>';
                       if($author_name != ''){
                          $texxt = __('By',IEPA_TEXT_DOMAIN);
                          $item_output .= '<span class="iepa-author-name">'.$texxt.' '.$author_name.'</span>';
                       }
                       if(isset($settings['upload_image_settings']['display_post_date']) && $settings['upload_image_settings']['display_post_date'] == "true"){
                         $item_output .= "<span class='megapost-date'>" . $post_date . "</span>";
                       }
                       if(isset($settings['upload_image_settings']['show_description']) && $settings['upload_image_settings']['show_description'] == 'true'){
                       $item_output .= "<p class='iepa-posts-desc'>" . $desc . "</p>";
                       }
                       $item_output .= "</div>";
                    }

                    $item_output .= '</a>';
                    //==readmore link here==
                    if(isset($settings['upload_image_settings']['display_readmore']) && $settings['upload_image_settings']['display_readmore'] == "true"){
                     $item_output .= "<span class='iepareadmorelink'>";
                     $item_output .= '<a'. $attributes .'>';
                     $item_output .= $args->link_before .$readmorelink. $args->link_after;
                     $item_output .= '</a>';
                     $item_output .= '</span>';
                   }


                  $item_output .= "</div>";


                  $item_output .= "</div>";
                   /* Case 4: Megamenu Show custom setting for submegamenu Start for post details display end*/
                }
           }
        }

         $output .= apply_filters( 'im_menu_addon_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $item_output = "";
        $itemid = isset($item->ID)?$item->ID:'';
        $item_title = isset($item->title)?$item->title:'';
        $type = isset($item->type)?$item->type:'';
         /* Display Bottom Content for megamenu*/
            if(isset($item->iepamegamenu_settings['menu_type']) &&  $item->iepamegamenu_settings['menu_type'] == "megamenu" && isset($item->iepamegamenu_settings['mega_menu_settings']['show_bottom_content']) && $item->iepamegamenu_settings['mega_menu_settings']['show_bottom_content'] == 'true' && $depth == 0){

              if(isset($item->iepamegamenu_settings['mega_menu_settings']['bottom']['bottom_content_type'])){
                 if($item->iepamegamenu_settings['mega_menu_settings']['bottom']['bottom_content_type'] == "text_only"){
                        //text only
                    $bottomcontent = $item->iepamegamenu_settings['mega_menu_settings']['bottom']['bottom_content'];
                     if($bottomcontent != ''){
                       $item_output .= "<div class='clear bottom_clearfix'></div><span class='iepa_megamenu_bottomcontent'>".$bottomcontent."</span>";
                      }
                    }else if($item->iepamegamenu_settings['mega_menu_settings']['bottom']['bottom_content_type'] == "image_only"){
                          //image only
                        $bimage_url = $item->iepamegamenu_settings['mega_menu_settings']['bottom']['image_url'];
                        if( $bimage_url != '' ) {
                          $bottomimage = "<img src='" . esc_url( $bimage_url ) . "'/>";
                          $item_output .= "<div class='clear bottom_clearfix'></div><div class='iepa-bottomimage'>" . $bottomimage . "</div>";
                        }

                    }else{
                         //html content for bottom
                          $html_bcontent = (isset($item->iepamegamenu_settings['mega_menu_settings']['bottom']['html_content']) && $item->iepamegamenu_settings['mega_menu_settings']['bottom']['html_content'] != '')?$item->iepamegamenu_settings['mega_menu_settings']['bottom']['html_content']:'';
                          if($html_bcontent != ''){
                           $item_output .= "<div class='clear bottom_clearfix'></div><div class='iepa-html-content iepa-cbottom'>". $html_bcontent."</div>";
                          }
                    }
                  }

                  if(isset($settings['menu_type']) && $settings['menu_type'] == "megamenu"){
                    $choose_menu_type =(isset($settings['mega_menu_settings']['choose_menu_type']) && $settings['mega_menu_settings']['choose_menu_type'] !="default") ? esc_attr( $settings['mega_menu_settings']['choose_menu_type'] ) : '';

                  if( $choose_menu_type == "search_type" ){
                     $out = $this->iepa_get_all_attributes( 'im_menuaddon_search_form', $choose_style );
                      $template_type = $out['template_type'];
                      if($template_type == "megamenu-type-search"){
                        $item_output .= "</div>";
                      }
                  }else if($choose_menu_type != "logo_image" && $choose_menu_type != "login_form" && $choose_menu_type != "register_form"){
                    $item_output .= "</div>";
                  }

                    //end of iepa-sub-menu-wrap div class
                   }
            }
        // $item_output .="</div>";
        $output .= $item_output;
       //  if ( $item->group_section == 'end_group_widget' && $item->group_type == "multiple") {
       // $output .= "</div>";
       //    }else{
       //  $output .= "</li>"; // remove new line to remove the 4px gap between menu items
       //   }
          if (isset($item->group_section) && $item->group_section == 'start_group_widget' && $item->group_type == "multiple") {

         }else if(isset($item->group_section) && $item->group_section == 'end_group_widget' && $item->group_type == "multiple"){
            $output .= "</div>";
         }else{
            $menu_parent_id = (isset($item->menu_item_parent)?$item->menu_item_parent:'');
            $parent_settings = array_filter( (array) get_post_meta($menu_parent_id, '_iepamegamenu', true ) );

           if(isset($parent_settings['group_type']) && $parent_settings['group_type'] == "multiple"){
              if($type != "widget" && $type == "submenu" && $item->depth == 1){
                $output .= "</div></li>";
              }else if($type != "widget" && $type != "submenu" && $item->depth == 1){
                 $output .= "</div></li>";
              }else{
                $output .= "</li>";
              }

            }else{
              $output .= "</li>";
           }

         }

    }

    /**
     * Grab all attributes for a given shortcode in a text
     *
     * @uses get_shortcode_regex()
     * @uses shortcode_parse_atts()
     * @param  string $tag   Shortcode tag
     * @param  string $text  Text containing shortcodes
     * @return array  $out   Array of attributes
     */

    public function iepa_get_all_attributes( $tag, $text )
    {
        preg_match_all( '/' . get_shortcode_regex() . '/s', $text, $matches );

        if( isset( $matches[2] ) )
        {
            foreach( (array) $matches[2] as $key => $value )
            {
                if( $tag === $value )
                    $out = shortcode_parse_atts( $matches[3][$key] );
            }
        }
        return $out;
    }

   public function imma_get_excerpt_by_id($post_id,$post_length){
        $the_post = get_post($post_id); //Gets post ID
        $the_excerpt = $the_post->post_excerpt; //Gets post_content to be used as a basis for the excerpt
        if(isset($the_excerpt) && $the_excerpt == ''){
          $the_excerpt = $the_post->post_content;
        }
        $excerpt_length = $post_length; //Sets excerpt length by word count
        $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
        $words = explode(' ', $the_excerpt, $excerpt_length + 1);
        if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '');
        $the_excerpt = implode(' ', $words);
        endif;
        $the_excerpt =  $the_excerpt;
        return $the_excerpt;
     }

}




}
