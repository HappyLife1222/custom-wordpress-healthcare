<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
global $widget_object;
$grouptype      = ( isset( $iepammenu_item_meta['group_type'] ) && $iepammenu_item_meta['group_type'] != '' ) ? esc_attr( $iepammenu_item_meta['group_type'] ) : 'single';
$menutype       = ( isset( $iepammenu_item_meta['menu_type'] ) && $iepammenu_item_meta['menu_type'] =='megamenu' ) ? 'megamenu' : 'flyout';
$panel_columns  = ( isset( $iepammenu_item_meta['panel_columns'] ) && $iepammenu_item_meta['panel_columns'] !='' ) ? esc_attr( $iepammenu_item_meta['panel_columns'] ) : '1';
$class = "";
if( isset( $menutype ) ) {
  if( $menutype == "megamenu" ) {
    $class = "enabled_megamenu";
  } else {
    $class = "disabled";
  }
} else {
  $class = "disabled";
}
?>
<div class="main_top_section">
  <div class="iepa_top_section">
    <div class="imma_selection_type">
      <label for='iepammmm_enable_mega_menu'>
        <?php esc_html_e( "Sub Menu Display Mode", IEPA_TEXT_DOMAIN ); ?>
      </label>
      <select id='imma_enable_mega_menu' name="iepa_settings[menu_type]" class="imma-selection"
        title="<?php esc_attr_e( 'Choose Menu Type.', IEPA_TEXT_DOMAIN ); ?>">
        <option value='flyout' <?php echo selected( $menutype, 'flyout', false ); ?>>
          <?php esc_html_e( "Flyout Menu", IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option id='iepamegamenu' value="megamenu" <?php echo selected( $menutype, 'megamenu', false ); ?>>
          <?php esc_html_e( "Mega Menu", IEPA_TEXT_DOMAIN ); ?>
        </option>
      </select>
    </div>
    <div class="imma_row_selection imma_grp_select">
      <label for='immam_choose_group'>
        <?php esc_html_e( "Choose Group", IEPA_TEXT_DOMAIN ); ?>
      </label>
      <select id='immam_choose_group' name='iepa_settings[group_type]' title="<?php esc_attr_e( 'Choose Group Type.', IEPA_TEXT_DOMAIN ); ?>">
        <option value='single' <?php echo selected( $grouptype, 'single', false ); ?>>
          <?php esc_html_e( 'Single Group', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='multiple' <?php echo selected( $grouptype, 'multiple', false ); ?>>
          <?php esc_html_e( 'Multiple Group', IEPA_TEXT_DOMAIN ); ?>
        </option>
      </select>
    </div>
    <div class="main_widget">
      <div class="multiple_button" style="display:none;">
        <input class="button-primary add-mulitple-group" value="<?php esc_attr_e( 'ADD GROUP',IEPA_TEXT_DOMAIN );?>" type="button">
        <input type="button" class="button button-primary iepa-group-remover"
          value="<?php esc_attr_e( 'REMOVE GROUP', IEPA_TEXT_DOMAIN ); ?>"
          data-confirm-message="<?php esc_attr_e( 'Are you sure you want to delete this Group?', IEPA_TEXT_DOMAIN ); ?>"
        />
        <div class="iepa-add-widget-tool_by_grp">
          <i class="fa fa-plus" aria-hidden="true"></i>
          <?php esc_html_e( 'Add Widgets', IEPA_TEXT_DOMAIN ); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- single group mega menu section -->
<div class="iepa_mega_settings imma_single_group_section <?php if( $menutype == 'flyout' ) { echo esc_attr( 'disabled' ); } ?>">
  <div class="iepa_top_section">
    <div class="imma_selection_type"></div>
    <div class="imma_row_selection">
      <label for='imma_choose_total_columns'>
        <?php esc_html_e( "Choose Columns", IEPA_TEXT_DOMAIN ); ?>
      </label>
      <select id='imma_number_of_columns' name='iepa_settings[panel_columns]' class="imma-selection"
        title="<?php esc_attr_e( 'Choose Column for Single Group.', IEPA_TEXT_DOMAIN ); ?>">
        <option value='1' <?php echo selected( $panel_columns, 1, false );?>>
          <?php esc_html_e( '1 Column', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='2' <?php echo selected( $panel_columns, 2, false );?>>
          <?php esc_html_e( '2 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='3' <?php echo selected( $panel_columns, 3, false );?>>
          <?php esc_html_e( '3 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='4' <?php echo selected( $panel_columns, 4, false );?>>
          <?php esc_html_e( '4 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='5' <?php echo selected( $panel_columns, 5, false );?>>
          <?php esc_html_e( '5 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='6' <?php echo selected( $panel_columns, 6, false );?>>
          <?php esc_html_e( '6 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='7' <?php echo selected( $panel_columns, 7, false );?>>
          <?php esc_html_e( '7 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='8' <?php echo selected( $panel_columns, 8, false );?>>
          <?php esc_html_e( '8 Columns', IEPA_TEXT_DOMAIN ); ?>
        </option>
      </select>
    </div>
    <div class="imma_middle_section">
      <label>
        <h3><?php esc_html_e( "Single Group Layout", IEPA_TEXT_DOMAIN ); ?></h3>
      </label>
    </div>
    <!-- widget section frame -->
    <div class="main_widget">
      <div class="iepa-add-widget-tool">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <?php esc_html_e('Add Widgets',IEPA_TEXT_DOMAIN);?></div>
    </div>
  </div>
  <?php
    $items = $widget_object->iepa_get_widgets_and_menu_items_for_menu_id( $menu_item_id, $menu_id , "single" );
  ?>
  <div class="imma_add_components <?php echo esc_attr( $class ); ?>">
    <div id="imma_widgets_setup" class="imma_widgets_setup <?php echo esc_attr( $class ); ?>"
      data-columns="<?php echo ( !isset( $panel_columns ) && $panel_columns == '' ) ? '6' : esc_attr( $panel_columns ); ?>">
      <?php
      if( isset( $items ) ) {
        foreach ( $items as $item ) {
          if( isset( $item['group_type'] ) && $item['group_type'] != 'multiple' || isset( $item['type'] ) && $item['type'] == 'iepa_menu_subitem' ) {
            ?>
            <div class="imma_widget_area widget" id="<?php echo esc_attr( $item['id'] ); ?>"
              data-title="<?php echo esc_attr( $item['title'] );?>" data-columns="<?php echo esc_attr( $item['columns'] );?>"
              data-type="<?php echo esc_attr( $item['type'] );?>" data-id="<?php echo esc_attr( $item['id'] );?>">
              <div class="widget_main_top_section">
                <div class="widget_title">
                  <span class="imma-drag-handler">
                    <i class="fa fa-arrows" aria-hidden="true"></i>
                  </span>
                  <span class="wptitle"><?php echo esc_html( $item['title'] );?></span>
                </div>
                <div class="widget_right_action">
                  <a class="widget-option imma_widget-contract" title="<?php esc_attr_e( "Contract", IEPA_TEXT_DOMAIN ); ?>">
                    <i class="fa fa-caret-left" aria-hidden="true"></i>
                  </a>
                  <span class="widget-cols">
                    <span class="imma_widget-num-cols">
                      <?php echo esc_html( $item['columns'] );?>
                    </span>
                    <span class="imma_widget-of">/</span>
                    <span class="imma_widget-total-cols">
                      <?php echo ( !isset( $panel_columns ) && $panel_columns == '' ) ? '6' : esc_html( $panel_columns ); ?>
                    </span>
                  </span>
                  <a class="widget-option imma_widget-expand" title="<?php esc_attr_e( 'Expand', IEPA_TEXT_DOMAIN ); ?>">
                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                  </a>
                  <a class="widget-option imma_widget-action widget-action" title="<?php esc_attr_e( 'Edit', IEPA_TEXT_DOMAIN );?>">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
              <div class="imma_widget_inner"></div>
            </div>
            <?php
          }
        }//foreach end
      }//if end
      ?>

  </div>
  </div>
</div>

<!-- Multiple Group Popup Form -->
<div id="imma-popup-wrap-<?php echo esc_attr( $menu_item_id ); ?>" class="imma-popup-wrap" style="display: none;">
  <div class="imma-overlay"></div>
  <div class="imma-add-form-wrap">
    <input type="hidden" id="popup_type" class="imma_popup_type" value="add"/>
    <input type="hidden" id="group_number" class="imma_group_in_number" value="1"/>
    <div class="imma-add-field-wrap">
      <label><?php esc_html_e( 'Group Title', IEPA_TEXT_DOMAIN ); ?></label>
      <div class="iepa-field">
        <input type="text" class="iepa-group-title" value="Group 1" placeholder="<?php esc_attr_e( 'Group 1', IEPA_TEXT_DOMAIN ); ?>" readonly="readonly"/>
      </div>
    </div>
    <div class="imma-add-field-wrap">
      <label><?php esc_html_e( 'Choose Column Number', IEPA_TEXT_DOMAIN ); ?></label>
      <div class="iepa-field">
        <select id='imma_columns-num' name='iepa_settings[mulitple][panel_columns]' class="imma-selection">
          <option value='1'>
            <?php esc_html_e( '1 Column', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='2'>
            <?php esc_html_e('2 Columns',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value='3'>
            <?php esc_html_e('3 Columns',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value='4'>
            <?php esc_html_e('4 Columns',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value='5'>
            <?php esc_html_e('5 Columns',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value='6'>
            <?php esc_html_e('6 Columns',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value='7'>
            <?php esc_html_e('7 Columns',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value='8'>
            <?php esc_html_e( '8 Columns', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </div>
      <div class="iepa-field-note">
        <?php esc_html_e( 'Please choose total column number for this group.' , IEPA_TEXT_DOMAIN ); ?>
      </div>
    </div>
    <div class="imma-add-field-wrap">
      <input type="button" class="imma-add-group-btn button-primary" value="<?php esc_attr_e( 'Add Group' , IEPA_TEXT_DOMAIN ); ?>" />
      <span class="imma-ajax-loader" style="display: none"></span>
      <span class="imma-msg" style="display:none;">
        <?php esc_html_e( 'Group Created. Redirecting...' ); ?>
      </span>
      <div class="imma-add-error imma-error" style="display: none;"></div>
    </div>
  </div>
</div>
<?php
  $menu_item_idd        = ( isset( $menu_item_id ) && $menu_item_id != '' ) ? esc_attr( $menu_item_id ) : '';
  $imma_widget_manager  = new IEPA_MM_Menu_Widget_Manager();
  $grouplists           = $imma_widget_manager->iepa_mm_get_group_details( $menu_item_idd );
?>
<div class="imma_mega_settings_multiple <?php if( $grouptype == 'multiple' ) { echo esc_attr( '' ); } else { echo esc_attr( 'iepa-d-none' ); } ?>">
  <div class="imma-grp-wrap">
    <ul class="imma-groups-lists">
      <?php
      if( isset( $grouplists ) && !empty( $grouplists ) ) {
        $count          = $grouplists->totalgroup;
        $group_detailss = $grouplists->group_details;
        $totalgroups    = unserialize($group_detailss);
        foreach ( $totalgroups as $key => $value ) {
          $newgroup      = $value['group_no'];
          $total_columns = $value['column'];
          if( $newgroup == 1 ) {
            $newclass = "imma-grp-active-trigger";
          } else {
            $newclass = '';
          }
          ?>
          <li data-group-ref="<?php echo esc_attr( $newgroup ); ?>" data-columns="<?php echo esc_attr( $total_columns ); ?>"
            class="iepa-group-trigger <?php echo esc_attr( $newclass ); ?>" data-group-name="Group <?php echo esc_attr( $newgroup ); ?>">
            <?php echo esc_html( 'Group ' . $newgroup ); ?>
            <br/>
            <span class="iepa-group-col">
              ( <?php echo esc_html( 'Column ' . $total_columns ); ?> )
            </span>
            <span title="<?php esc_attr_e('Edit this Group',IEPA_TEXT_DOMAIN);?>" class="iepa-group-column-editer">
              <i class="fa fa-pencil-square-o"></i>
            </span>
          </li>
          <?php
        }
      } else {
          ?>
          <li data-group-ref="1" data-columns="2" data-group-name="Group 1" class="iepa-group-trigger imma-grp-active-trigger">
            <?php esc_html_e( 'Group 1', IEPA_TEXT_DOMAIN ); ?>
            <br/>
            <span class="iepa-group-col">( <?php esc_html_e( 'Column 2', IEPA_TEXT_DOMAIN ); ?> )</span>
            <span title="<?php esc_attr_e( 'Edit this Group', IEPA_TEXT_DOMAIN ); ?>" class="iepa-group-column-editer">
              <i class="fa fa-pencil-square-o"></i>
            </span>
          </li>

          <?php
      }
      ?>
    </ul>
  </div>
  <div class="iepa-group-field-holder">
    <div class="imma_group_add_components <?php echo esc_attr( $class ); ?>">
      <?php
      $multiple_items = $widget_object->iepa_get_widgets_and_menu_items_for_menu_id( $menu_item_id, $menu_id, "multiple" );
      if( isset( $grouplists ) && !empty( $grouplists ) ) {
        $count          = $grouplists->totalgroup;
        $group_detailss = $grouplists->group_details;
        $totalgroups    = unserialize( $group_detailss );

        foreach ( $totalgroups as $key => $value ) {
          $newgroup      = $value['group_no'];
          $total_columns = $value['column'];
          if( $total_columns == '' ) {
            $total_columns = 2;
          }

          ?>
          <div id="imma_widgets_setup_<?php echo esc_attr( $newgroup );?>" class="imma_widgets_setup <?php echo esc_attr( $class ); ?> <?php if( $newgroup != 1 ) { echo esc_attr( 'iepa-d-none' ); } ?>" data-group-ref="<?php echo esc_attr( $newgroup ); ?>"
            data-columns="<?php echo esc_attr( $total_columns ); ?>">
            <?php
            if( isset( $multiple_items ) ) {
              foreach ( $multiple_items as $item ) {
                if( isset( $item['group_type'] ) && $item['group_type'] == 'multiple' && $item['group_number'] == $newgroup ) {
                  if( is_numeric( $item['id'] ) ) {
                    $menu_items = IEPA_MM_Libary::get_sub_menu_items( $menu_item_id, $menu_id, $item['id'] ); //get all sub menu item
                    $menu_title = $menu_items[0]['title'];
                    $menu_type  = $menu_items[0]['type'];
                  } else {
                    $widget_name  = IEPA_MM_Menu_Widget_Manager::immagetnameforwidgetid( $item['id'] ); //get widget real name
                    $menu_title   = $item['title'];
                    if( $menu_title == '' ) {
                      $menu_title = $widget_name;
                    }
                    $menu_type = $item['type'];
                    if( $menu_type == '' ) {
                      $menu_type = 'wp_widget';
                    }
                  }
                  if( isset( $menu_type ) && $menu_type == "wp_widget" ) {
                    $item_columns = ( isset( $item['columns'] ) && $item['columns'] != '' ) ? esc_attr( $item['columns'] ) : $total_columns;
                  } else {
                    //sub menu items
                    $mmcolumnsettings = get_post_meta( $item['id'], '_iepamegamenu', true );
                    $item_columns     = ( isset( $mmcolumnsettings['iepa_group_mega_menu_columns'] ) && $mmcolumnsettings['iepa_group_mega_menu_columns'] ) ? $mmcolumnsettings['iepa_group_mega_menu_columns'] : $mmcolumnsettings;
                    // if(is_array( $item_columns )){
                    //   $item_total_columns = (isset($item['columns']) && $item['columns'] != '')?esc_attr($item['columns']):$total_columns;
                    //   $item_columns =  $item_total_columns;
                    // }
                    if( $item_columns == '' ) {
                      if( $total_columns != '' ) {
                        $item_total_columns = $total_columns;
                      } else {
                        $item_total_columns = (isset($item['columns']) && $item['columns'] != '')?esc_attr($item['columns']):1;
                      }

                      $item_columns =  $item_total_columns;
                    }
                    if( is_array( $item_columns ) ) {
                      $item_total_columns = ( isset( $item['columns'] ) && $item['columns'] != '' ) ? esc_attr( $item['columns'] ) : $total_columns;
                      $item_columns =  $item_total_columns;
                    }
                  }
                  ?>
                  <div class="imma_widget_areaa widget" data-title="<?php echo esc_attr( $menu_title ); ?>" data-columns="<?php echo esc_attr( $item_columns ); ?>" data-type="<?php echo esc_attr( $menu_type );?>" data-id="<?php echo esc_attr( $item['id'] );?>" id="<?php echo esc_attr( $item['id'] );?>">
                    <div class="widget_main_top_section">
                      <div class="widget_title">
                        <span>
                          <i class="fa fa-arrows" aria-hidden="true"></i>
                        </span>
                        <span class="wptitle">
                          <?php echo esc_html( $menu_title ); ?>
                        </span>
                      </div>
                      <div class="widget_right_action">
                        <a class="widget-option imma_widget-contract" title="<?php esc_attr_e( "Contract", IEPA_TEXT_DOMAIN ); ?>">
                          <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <span class="widget-cols">
                          <span class="imma_widget-num-cols">
                            <?php echo esc_html( $item_columns ); ?>
                          </span>
                          <span class="imma_widget-of">/</span>
                          <span class="imma_widget-total-cols">
                            <?php echo ( isset( $total_columns ) && $total_columns != '' ) ? esc_html( $total_columns ): '1'; ?>
                          </span>
                        </span>
                        <a class="widget-option imma_widget-expand" title="<?php esc_attr_e( "Expand", IEPA_TEXT_DOMAIN ); ?>">
                          <i class="fa fa-caret-right" aria-hidden="true"></i>
                        </a>
                        <a class="widget-option imma_widget-action widget-action" title="<?php esc_attr_e( "Edit", IEPA_TEXT_DOMAIN ); ?>">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                    <div class="imma_widget_inner"></div>
                  </div>
                <?php
                }
              }// multiple_items foreach end
            } else {// multiple_items if end
              ?>
              <span class="message">
                <?php esc_html_e( "No widgets found. Add a widget to this area using the ADD Widget Button from top right side.", IEPA_TEXT_DOMAIN ); ?>
              </span>
              <?php
            }
            ?>
          </div>
          <?php
        } //main $totalgroups foreach end
      } else {// if case $grouplists end
        ?>
        <div id="imma_widgets_setup_1" class="imma_widgets_setup enabled_megamenu" data-group-ref="1" data-columns="2">
          <?php
          // if there is no any group in database saved then show only first group 1 with sub menu items.
          if( isset( $multiple_items ) ) {
            foreach ( $multiple_items as $item ) {
              if( isset($item['group_type']) && $item['group_type'] == 'multiple' || $item['type'] == "iepa_menu_subitem" ) {
                ?>
                <div class="imma_widget_areaa widget" id="<?php echo esc_attr( $item['id'] ); ?>"
                  data-title="<?php echo esc_attr( $item['title'] ); ?>" data-columns="<?php echo esc_attr( $item['columns'] ); ?>"
                  data-type="<?php echo esc_attr( $item['type'] ); ?>" data-id="<?php echo esc_attr( $item['id'] ); ?>"
                  id="<?php echo esc_attr( $item['id'] ); ?>">
                  <div class="widget_main_top_section">
                    <div class="widget_title">
                      <span>
                        <i class="fa fa-arrows" aria-hidden="true"></i>
                      </span>
                      <span class="wptitle">
                        <?php echo esc_html( $item['title'] ); ?>
                      </span>
                    </div>
                    <div class="widget_right_action">
                      <a class="widget-option imma_widget-contract" title="<?php esc_attr_e( "Contract", IEPA_TEXT_DOMAIN );?>">
                        <i class="fa fa-caret-left" aria-hidden="true"></i>
                      </a>
                      <span class="widget-cols">
                        <span class="imma_widget-num-cols">
                          <?php echo esc_html( $item['columns'] );?>
                        </span>
                        <span class="imma_widget-of">/</span>
                        <span class="imma_widget-total-cols">
                          <?php echo ( isset( $total_columns ) && $total_columns != '' ) ? esc_html( $total_columns ) : '2'; ?>
                        </span>
                      </span>
                      <a class="widget-option imma_widget-expand" title="<?php esc_attr_e( "Expand", IEPA_TEXT_DOMAIN ); ?>">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                      </a>
                      <a class="widget-option imma_widget-action widget-action"
                        title="<?php esc_attr_e( "Edit", IEPA_TEXT_DOMAIN ); ?>">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="imma_widget_inner"></div>
                </div>
              <?php
              }
            } //foreach end
          }//if end
          ?>
        </div>
      <?php
      }
      ?>

    </div> <!-- imma_group_add_components end -->

      <?php
      if( isset( $grouplists ) && !empty( $grouplists ) ) {
        $count = $grouplists->totalgroup;
      } else {
        $count = 1;
      }
      ?>
      <input type="hidden" id="iepa-group-num-<?php echo esc_attr( $menu_item_id ); ?>" class="iepa-field-total-group" name="iepa_settings[mulitple][total_group]" value="<?php echo esc_attr( $count ); ?>" />
      <?php  // get details with menu id
      if( isset( $grouplists ) && !empty( $grouplists ) ) {
        $group_detailss = $grouplists->group_details;
        $widget_details = $grouplists->widget_details;
        if( isset( $widget_details ) && $widget_details != '' ) {
          $widgetsdetails = unserialize( $widget_details );
        } else {
          $widgetsdetails = array();
        }
        if( isset( $group_detailss ) && $group_detailss != '' ) {
          $totalgroups = unserialize( $group_detailss );
        } else {
          $totalgroups = array();
        }
        if( isset( $totalgroups ) && !empty( $totalgroups ) ) :
          foreach ( $totalgroups as $key => $value ) {
            $newgroup      = $value['group_no'];
            $total_columns = $value['column']; ?>
            <input type="hidden" class="imma_field_groups"
              name="iepa_settings[field_groups][group<?php echo esc_attr( $newgroup ); ?>_fields]"
              data-group-fields-ref="<?php echo esc_attr($newgroup ); ?>"
              data-group-column-ref="<?php echo esc_attr($total_columns);?>"
            />
            <?php
            if( isset( $widgetsdetails ) ) {
              foreach ( $widgetsdetails as $key => $val ) {
                if ( $val['group_no'] === $newgroup ) {
                  $lists = $val['lists'];
                  /* added code to get newly added sub items id to group lists*/
                  if( $newgroup  == "1" ) {
                    $arr3 = array();
                    if( isset( $items ) ) {
                      foreach ( $items as $k => $v ) {
                        if ( is_numeric( $k ) ) {
                          array_push( $arr3, $v['id'] );
                        }
                      }
                    }
                    $split1 = explode( ',', $lists );
                    foreach ( $split1 as $key => $val ) {
                      if ( is_numeric( $val ) ) {
                        if( !in_array( $val, $arr3 ) ) {
                          unset( $split1[$key] );
                        }
                      }
                    }
                    foreach ( $arr3 as $key => $val ) {
                      if ( is_numeric( $val ) ) {
                        if( !in_array( $val, $split1 ) ) {
                          array_push( $split1, $val );
                        }
                      }
                    }
                    $lists = implode( ',', $split1 );
                  }
                  /* added code end*/

                }
              }
            } else {
              $lists = '';
            }
            ?>
            <input class="imma_groups_widgets_lists" name="iepa_settings[widget_groups][group<?php echo esc_attr( $newgroup ); ?>]"
              data-group-widget-ref="<?php echo esc_attr( $newgroup ); ?>" type="hidden" value="<?php echo esc_attr( $lists );?>"
            >
            <?php
          }
        endif;
      } else {
        ?>
        <input type="hidden" class="imma_field_groups" name="iepa_settings[field_groups][group1_fields]" data-group-fields-ref='1' data-group-column-ref='2'/>
        <input class="imma_groups_widgets_lists" name="iepa_settings[widget_groups][group1]" data-group-widget-ref="1" type="hidden" value="">
        <?php
      }
      ?>
  </div><!-- iepa-group-field-holder closed -->
</div><!-- imma_mega_settings_multiple closed -->


<?php
  $tmp = array();
  if( isset( $items ) ) {
    foreach ( $items as $item ) {
      if( $item['type'] == "iepa_menu_subitem" ) {
        array_push( $tmp, $item["id"] );
      }
    }
  }
  $tmp = implode( ",", $tmp );
?>
<input class="imma_widgetlists" type="hidden" value="<?php echo esc_attr( $tmp ); ?>">
<!-- ALL Wordpress Widgets Lists Frame -->
<div class="imma_widget_iframe" style="display:none;">
  <div class="imma_widgte_middle_content">
    <!-- left section widgets -->
    <div class="widget_left_section">
      <div class="widgetss_header">
        <?php esc_html_e( 'ALL WIDGETS', IEPA_TEXT_DOMAIN ); ?>
      </div>
      <ul>
        <li>
          <div class="imma_tabss active" id="wordpress_widgets">
            <?php esc_html_e( 'WORDPRESS WIDGETS', IEPA_TEXT_DOMAIN ); ?>
          </div>
        </li>
        <li>
          <div class="imma_tabss" id="imma_widgets">
            <?php esc_html_e( 'IEPA MEGA MENU WIDGETS', IEPA_TEXT_DOMAIN ); ?>
          </div>
        </li>
        <li>
          <div class="imma_tabss" id="imma_woocommercewidgets">
            <?php esc_html_e( 'WOOCOMMERCE WIDGETS', IEPA_TEXT_DOMAIN ); ?>
          </div>
        </li>
      </ul>
    </div>
    <!-- right section widgets -->
    <div class="widget_right_section">

      <div class="btn_close_me">
        <div class="title_widget_add">
          <i class="fa fa-wrench" aria-hidden="true"></i>
          <?php esc_html_e( 'ADD WIDGET SETTINGS', IEPA_TEXT_DOMAIN ); ?>
        </div>
        <span>
          <i class="fa fa-close" aria-hidden="true"></i>
          <?php esc_html_e( 'CLOSE', IEPA_TEXT_DOMAIN ); ?>
        </span>
      </div>

      <div class="right_middle_widgets">
        <div class="tab-panes" id="tabs_wordpress_widgets" style="display:none;">
          <ul>
            <?php
            $imma_widget_manager  = new IEPA_MM_Menu_Widget_Manager();
            $all_widgets          = IEPA_MM_Libary::iepa_get_available_widgets();
            foreach ( $all_widgets as $key => $value ) {
              ?>
              <li class="imma_all_wp_widgets" data-value="<?php echo esc_attr( $value['value'] ); ?>"
                data-text="<?php echo esc_attr( $value['name'] ); ?>"
                >
                <div class="imma_widget-type-wrapper" style="height: 71px;">
                  <span class="imma_widget-icon dashicons dashicons-wordpress"></span>
                  <h3><?php echo esc_html( $value['name'] ); ?></h3>
                  <p class="widgets_description">
                    <?php echo esc_html( $value['description'] ); ?>
                  </p>
                </div>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
        <div class="tab-panes" id="tabs_imma_widgets" style="display:none;">
          <ul>
            <?php
            $imma_widget_manager  = new IEPA_MM_Menu_Widget_Manager();
            $all_widgets          = IEPA_MM_Libary::iepa_mm_get_specific_widgets();
            foreach ( $all_widgets as $key => $value ) {
              ?>
              <li class="imma_all_wp_widgets" data-value="<?php echo esc_attr( $value['value'] ); ?>"
                data-text="<?php echo esc_attr( $value['name'] ); ?>">
                <div class="imma_widget-type-wrapper" style="height: 89px;">
                  <span class="imma_widget-icon dashicons dashicons-wordpress"></span>
                  <h3>
                    <?php echo esc_html( $value['name'] ); ?>
                  </h3>
                  <p class="widgets_description">
                    <?php echo esc_html( $value['description'] ); ?>
                  </p>
                </div>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
        <div class="tab-panes" id="tabs_imma_woocommercewidgets" style="display:none;">
          <ul>
            <?php
            $imma_widget_manager  = new IEPA_MM_Menu_Widget_Manager();
            $all_widgets          = IEPA_MM_Libary::imma_get_woo_widgets();
            foreach ( $all_widgets as $key => $value ) {
              ?>
              <li class="imma_all_wp_widgets" data-value="<?php echo esc_attr( $value['value'] ); ?>"
                data-text="<?php echo esc_attr( $value['name'] ); ?>">
                <div class="imma_widget-type-wrapper" style="height: 89px;">
                  <span class="imma_widget-icon dashicons dashicons-wordpress"></span>
                  <h3>
                    <?php echo esc_html( $value['name'] ); ?>
                  </h3>
                  <p class="widgets_description">
                    <?php echo esc_html( $value['description'] ); ?>
                  </p>
                </div>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
