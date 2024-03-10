<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$disable_text           = ( isset($iepammenu_item_meta['general_settings']['disable_text']) && $iepammenu_item_meta['general_settings']['disable_text'] == 'true' ) ? 'true' : 'false';
$disable_desc           = ( isset($iepammenu_item_meta['general_settings']['disable_desc']) && $iepammenu_item_meta['general_settings']['disable_desc'] == 'true' ) ? 'true' : 'false';
$visible_hidden_menu    = ( isset($iepammenu_item_meta['general_settings']['visible_hidden_menu']) && $iepammenu_item_meta['general_settings']['visible_hidden_menu'] == 'true' ) ? 'true' : 'false';
$active_link            = ( isset($iepammenu_item_meta['general_settings']['active_link']) && $iepammenu_item_meta['general_settings']['active_link'] == 'true' ) ? 'true' : 'false';
$hide_arrow             = ( isset($iepammenu_item_meta['general_settings']['hide_arrow']) && $iepammenu_item_meta['general_settings']['hide_arrow'] == 'true' ) ? 'true' : 'false';
$hide_on_mobile         = ( isset($iepammenu_item_meta['general_settings']['hide_on_mobile']) && $iepammenu_item_meta['general_settings']['hide_on_mobile'] == 'true' ) ? 'true' : 'false';
$hide_on_desktop        = ( isset($iepammenu_item_meta['general_settings']['hide_on_desktop']) && $iepammenu_item_meta['general_settings']['hide_on_desktop'] == 'true' ) ? 'true' : 'false';
$menu_icon              = ( isset($iepammenu_item_meta['general_settings']['menu_icon']) && $iepammenu_item_meta['general_settings']['menu_icon'] == 'enabled' ) ? 'enabled' : '';
$hide_icon_mobile       = ( isset($iepammenu_item_meta['general_settings']['hide_icon_mobile']) && $iepammenu_item_meta['general_settings']['hide_icon_mobile'] == 'enabled' ) ? 'enabled':'';
$active_single_menu     = ( isset($iepammenu_item_meta['general_settings']['active_single_menu']) && $iepammenu_item_meta['general_settings']['active_single_menu'] == 'enabled' ) ? 'enabled':'';
$activate_view_more_btn = ( isset($iepammenu_item_meta['general_settings']['activate_view_more_btn']) && $iepammenu_item_meta['general_settings']['activate_view_more_btn'] == 'true' ) ? 'true':'false';

?>
<div class="iepa_mega_settings">

  <div class="settings_content">

    <div class="settings_title">
      <h2>
        <?php esc_html_e( 'Menu Item Settings', IEPA_TEXT_DOMAIN ); ?>
        <span class="dashicons dashicons-arrow-up"></span>
        <span class="dashicons dashicons-arrow-down"></span>
      </h2>
    </div>

    <table class="iepa-widefat">

      <tr class=="<?php if( $menu_item_depth > 0 ) { echo esc_attr( 'iepa-d-none' ); } ?>">
        <td class="imma_meta_table">
          <label for="disable_menu_text"><?php esc_html_e( "Hide Menu Text", IEPA_TEXT_DOMAIN ); ?></label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="disable_menu_text" name='iepa_settings[general_settings][disable_text]' value='true' <?php echo checked( $disable_text,'true', false ); ?>/>
            <label for="disable_menu_text"></label>
          </div>
          <p class="description">
            <?php esc_html_e( "Note: Enable this option if you want to hide menu title and its height will also set to 0.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="disable_desc">
            <?php esc_html_e( "Disable Description", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="disable_desc" name='iepa_settings[general_settings][disable_desc]' value='true' <?php echo checked( $disable_desc, 'true', false ); ?>/>
            <label for="disable_desc"></label>
          </div>
          <p class="description">
            <?php esc_html_e( "Enable this option in order to hide menu description.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr class="<?php if( $menu_item_depth > 0 ) { echo esc_attr( 'iepa-d-none' ); } ?>">
        <td class="imma_meta_table">
          <label for="visible_hidden_text">
            <?php esc_html_e( "Hide Menu Text With Visible Height", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="visible_hidden_text" name='iepa_settings[general_settings][visible_hidden_menu]' value='true' <?php echo checked( $visible_hidden_menu, 'true', false ); ?>/>
            <label for="visible_hidden_text"></label>
          </div>

          <p class="description">
            <?php esc_html_e( "Note: Enable this option if you want to hide menu title but the respective height of this menu text will be displayed.", IEPA_TEXT_DOMAIN ); ?>
          </p>

        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="active_menu_link">
            <?php esc_html_e( "Active Menu Link", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_active_links' id="active_menu_link" name='iepa_settings[general_settings][active_link]' value='true' <?php echo checked( $active_link, 'true', false ); ?> />
            <label for="active_menu_link"></label>
          </div>
          <p class="description">
            <?php esc_html_e( "Enable this option in order to active menu link.", IEPA_TEXT_DOMAIN ); ?>
          </p>

        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="hide_arrow"><?php esc_html_e( "Hide Arrow", IEPA_TEXT_DOMAIN ); ?></label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="hide_arrow" name='iepa_settings[general_settings][hide_arrow]' value='true' <?php echo checked( $hide_arrow, 'true', false ); ?> />
            <label for="hide_arrow"></label>
          </div>
          <p class="description"><?php esc_html_e( "Enable this option in order to hide this menu arrow.", IEPA_TEXT_DOMAIN ); ?></p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="hide_menu_onmobile">
            <?php esc_html_e( "Hide Menu On Mobile", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="hide_menu_onmobile" name='iepa_settings[general_settings][hide_on_mobile]' value='true' <?php echo checked( $hide_on_mobile, 'true', false ); ?> />
            <label for="hide_menu_onmobile"></label>
          </div>
          <p class="description"><?php esc_html_e( "Enable this option in order to hide this menu item on mobile version only.", IEPA_TEXT_DOMAIN ); ?></p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="hide_menu_ondesktop">
            <?php esc_html_e( "Hide Menu On Desktop", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="hide_menu_ondesktop" name='iepa_settings[general_settings][hide_on_desktop]' value='true' <?php echo checked( $hide_on_desktop, 'true', false ); ?> />
            <label for="hide_menu_ondesktop"></label>
          </div>
          <p class="description"><?php esc_html_e( "Enable this option in order to hide this menu item on desktop version only.", IEPA_TEXT_DOMAIN ); ?></p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="menu_icon"><?php esc_html_e( "Show Menu Icon", IEPA_TEXT_DOMAIN ); ?></label>
        </td>
        <td>
          <div class="iepa-mm-switch">
			      <input type='checkbox' class='imma_menu_settingss' id="menu_icon" name='iepa_settings[general_settings][menu_icon]' value='enabled' <?php echo checked( $menu_icon, 'enabled', 'disabled' ); ?> />
            <label for="menu_icon"></label>
          </div>
          <p class="description">
            <?php esc_html_e( "Important Note: Enabling this option is compulsory if you want to display menu icon choosed from 'Icon Settings' for this specific menu item.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="hide_icon_mobile">
            <?php esc_html_e( "Hide Menu Icon On Mobile?", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="hide_icon_mobile" name='iepa_settings[general_settings][hide_icon_mobile]' value='enabled' <?php echo checked( $hide_icon_mobile, 'enabled', 'disabled' ); ?> />
            <label for="hide_icon_mobile"></label>
          </div>
          <p class="description">
            <?php esc_html_e( "In order to hide menu icon only on mobile then you need to enable this option.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <label for="active_single_menu">
            <?php esc_html_e( "Active Single Menu", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="active_single_menu" name='iepa_settings[general_settings][active_single_menu]' value='enabled' <?php echo checked( $active_single_menu, 'enabled', 'disabled' ); ?> />
            <label for="active_single_menu"></label>
          </div>
          <p class="description">
            <?php esc_html_e( 'Enable single menu if menu is custom single menu link. Useful for Any Custom Links such as social links (facebook, twitter)', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <?php esc_html_e( "Menu Item Alignment", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td>
          <?php
          $menu_align = ( isset( $iepammenu_item_meta['general_settings']['menu_align'] ) && $iepammenu_item_meta['general_settings']['menu_align'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['menu_align'] ) : 'left';
          ?>
          <select name='iepa_settings[general_settings][menu_align]' class='imma_menu_align'>
            <option value='left' <?php echo selected( $menu_align, 'left', false );?>>
              <?php esc_html_e( "Left", IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value='right' <?php echo selected( $menu_align, 'right', false );?>>
              <?php esc_html_e( "Right", IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <br/> <br/>
          <p class="description">
            <?php esc_html_e( 'Right aligned items will appear in reverse order on the right hand side of the menu bar. Specially required for search icon and other custom links with social icons.', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <?php esc_html_e( "Sub Menu Alignment", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td>
          <?php
          $submenu_align  = ( isset( $iepammenu_item_meta['general_settings']['submenu_align'] ) && $iepammenu_item_meta['general_settings']['submenu_align'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['submenu_align'] ) : 'left';
          ?>
          <select name='iepa_settings[general_settings][submenu_align]'>
            <option value='left' <?php echo selected( $submenu_align, 'left', false );?>>
              <?php esc_html_e( "Left", IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value='right' <?php echo selected( $submenu_align, 'right', false );?>>
              <?php esc_html_e( "Right", IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <p class="description">
            <?php esc_html_e( "Note: Choose individual flyout menu display position on hover/click for sub menu.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <?php esc_html_e( "Menu Label", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td class='iepammmega-value'>
          <?php
          $topmenulabel = ( isset( $iepammenu_item_meta['general_settings']['top_menu_label'] ) && $iepammenu_item_meta['general_settings']['top_menu_label'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['top_menu_label'] ) : ''; ?>
          <input type="text" name="iepa_settings[general_settings][top_menu_label]"
            value="<?php echo esc_attr( $topmenulabel ); ?>"
            placeholder="<?php esc_attr_e( 'E.g., HOT!', IEPA_TEXT_DOMAIN ); ?>"
          />
          <p class="description">
            <?php esc_attr_e( "Fill menu label such as HOT!, NEW!, UPDATES! and so on.", IEPA_TEXT_DOMAIN ); ?>
          </p>
				</td>
			</tr>

		  <tr>
        <td class="imma_meta_table">
          <?php esc_html_e( "Menu Label Animation", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td class='iepammmega-value'>
          <?php $label_animation = ( isset( $iepammenu_item_meta['general_settings']['label_animation'] ) && $iepammenu_item_meta['general_settings']['label_animation'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['label_animation'] ) : 'none'; ?>
          <select name="iepa_settings[general_settings][label_animation]" class="imma-selection">
            <option value="none" <?php if( $label_animation == "none" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'None', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="mybounce" <?php if( $label_animation == "mybounce" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'Bounce', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="flash" <?php if( $label_animation == "flash" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'Flash', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="shake" <?php if( $label_animation == "shake" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'Shake', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="swing" <?php if( $label_animation == "swing" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'Swing', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="tada" <?php if( $label_animation == "tada" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'Tada', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="bounceIn" <?php if( $label_animation == "bounceIn" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'BounceIn', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="flipInX" <?php if( $label_animation == "flipInX" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'FlipInX', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="flipInY" <?php if( $label_animation == "flipInY" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'FlipInY', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="slideInUp" <?php if( $label_animation == "slideInUp" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'SlideInUp', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="slideInDown" <?php if( $label_animation == "slideInDown" ) { echo esc_attr( "selected=selected" ); } ?>>
              <?php esc_html_e( 'SlideInDown', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <p class="description">
            <?php esc_html_e( 'Choose specific animation type for this menu label.Default is set as None which will disable animation.', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <?php esc_html_e( "Animation Iteration Count", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td class='iepammmega-value'>
          <?php $animation_iteration_count  = ( isset( $iepammenu_item_meta['general_settings']['animation_iteration_count'] ) && $iepammenu_item_meta['general_settings']['animation_iteration_count'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['animation_iteration_count'] ) : ''; ?>
          <input type="text" value="<?php echo esc_attr( $animation_iteration_count ); ?>" class="imma_mm_animation_iteration_count" placeholder="<?php esc_html_e( 'E.g., infinite,2,3,1,2.3', IEPA_TEXT_DOMAIN ); ?>" name="iepa_settings[general_settings][animation_iteration_count]" />
          <p class="description">
            <?php esc_html_e( 'Fill the animation Iteration count in number such as 2,3. You can also use "infinite" word instead of number which let the animation to repeat forever.', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr>
        <td class="imma_meta_table">
          <?php esc_html_e( "Menu Visibility on User Based", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td>
          <input type="radio" id="always_show" name="iepa_settings[general_settings][show_menu_to_users]" <?php if ( isset( $iepammenu_item_meta['general_settings']['show_menu_to_users'] ) && $iepammenu_item_meta['general_settings']['show_menu_to_users'] == "always" ) echo esc_attr( "checked" ); ?> value="always" />
          <label for="always_show">
            <?php esc_html_e( 'Always', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <br/>
          <input type="radio" id="loggedinshow" name="iepa_settings[general_settings][show_menu_to_users]" <?php if ( isset( $iepammenu_item_meta['general_settings']['show_menu_to_users'] ) && $iepammenu_item_meta['general_settings']['show_menu_to_users'] == "onlyloggedin_users" ) echo esc_attr( "checked" ); ?> value="onlyloggedin_users" />
          <label for="loggedinshow">
            <?php esc_html_e( 'Show Only To Logged In Users', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <br/>
          <input type="radio" id="loggedoutshow"  name="iepa_settings[general_settings][show_menu_to_users]" <?php if ( isset( $iepammenu_item_meta['general_settings']['show_menu_to_users'] ) && $iepammenu_item_meta['general_settings']['show_menu_to_users'] == "onlyloggedout_users" ) echo esc_attr( "checked" ); ?> value="onlyloggedout_users" />
          <label for="loggedoutshow">
            <?php esc_html_e( 'Show Only To Logged Out Users', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <br/>
          <p class="description">
            <?php esc_html_e( "Choose any one to show this menu as per logged in users, logged out users or show always.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr class="hide_fortopmenu">
        <td class="imma_meta_table">
          <label for="activate_view_more_button">
            <?php esc_html_e( "Activate View More Button", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="activate_view_more_button" name='iepa_settings[general_settings][activate_view_more_btn]' value='true' <?php echo checked( $activate_view_more_btn, 'true', false ); ?>/>
            <label for="activate_view_more_button"></label>
          </div>
          <p class="description">
            <?php esc_html_e( "In order to display or set view more or read more button to this menu, you need to activate view more button.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr class="hide_fortopmenu viewmoreenable_option <?php if( $activate_view_more_btn ) { echo esc_attr( '' ); } else { echo esc_attr( 'iepa-d-none' ); } ?>">
        <td class="imma_meta_table">
          <label>
            <?php esc_html_e( "View More Button BG Color", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <input type='text' name='iepa_settings[general_settings][vbtn_bgcolor]' data-alpha="true"
            value="<?php echo ( isset( $iepammenu_item_meta['general_settings']['vbtn_bgcolor'] ) && $iepammenu_item_meta['general_settings']['vbtn_bgcolor'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['vbtn_bgcolor'] ) : ''; ?>"
            class="imma-mm-color-picker"
          />
			  </td>
      </tr>

      <tr class="hide_fortopmenu viewmoreenable_option <?php if( $activate_view_more_btn ) { echo esc_attr( '' ); } else  { echo esc_attr('iepa-d-none'); } ?>">
        <td class="imma_meta_table">
          <label>
            <?php esc_html_e( "View More Button BG Hover Color", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <input type='text' name='iepa_settings[general_settings][vbtn_bghcolor]' data-alpha="true"
            value="<?php echo ( isset( $iepammenu_item_meta['general_settings']['vbtn_bghcolor'] ) && $iepammenu_item_meta['general_settings']['vbtn_bghcolor'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['vbtn_bghcolor'] ) : ''; ?>"
            class="imma-mm-color-picker"
          />
			  </td>
      </tr>

      <tr class="hide_fortopmenu viewmoreenable_option <?php if( $activate_view_more_btn ) {echo esc_attr(''); } else {echo esc_attr('display:none;');} ?>">
        <td class="imma_meta_table">
          <label>
            <?php esc_html_e( "View More Button Font Color", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <input type='text' name='iepa_settings[general_settings][vbtn_fcolor]'
            value="<?php echo ( isset( $iepammenu_item_meta['general_settings']['vbtn_fcolor'] ) && $iepammenu_item_meta['general_settings']['vbtn_fcolor'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['vbtn_fcolor'] ) : ''; ?>"
            class="imma-mm-color-picker"
          />
			  </td>
			</tr>

      <tr class="hide_fortopmenu viewmoreenable_option <?php if( $activate_view_more_btn ) {echo esc_attr('');} else  {echo esc_attr( 'display:none;' );} ?>">
        <td class="imma_meta_table">
          <label>
            <?php esc_html_e( "View More Button Font Hover Color", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <input type='text' name='iepa_settings[general_settings][vbtn_fhcolor]'
            value="<?php echo ( isset( $iepammenu_item_meta['general_settings']['vbtn_fhcolor'] ) && $iepammenu_item_meta['general_settings']['vbtn_fhcolor'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['vbtn_fhcolor'] ) : ''; ?>"
            class="imma-mm-color-picker"
          />
			  </td>
			</tr>

			<tr class="show_for_tabbed">
        <td class="imma_meta_table">
          <label for="choose_trigger_effect">
            <?php esc_html_e( "Choose Trigger Effect", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <?php $choose_trigger_effect = ( isset( $iepammenu_item_meta['general_settings']['choose_trigger_effect'] ) && $iepammenu_item_meta['general_settings']['choose_trigger_effect'] == "onclick" ) ? "onclick" : "onhover"; ?>
          <select name="iepa_settings[general_settings][choose_trigger_effect]" class="imma-selection">
            <option value="onhover" <?php if( $choose_trigger_effect == "onhover" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'On Hover', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="onclick" <?php if( $choose_trigger_effect == "onclick" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'On Click', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <p class="description">
            <?php esc_html_e( "Choose Tabbed Event as clicked or on hover effect.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr class="show_for_tabbed">
        <td class="imma_meta_table">
          <label for="tab_layouts">
            <?php esc_html_e( "Choose Tab Layouts", IEPA_TEXT_DOMAIN ); ?>
          </label>
        </td>
        <td>
          <?php $tab_layouts = ( isset( $iepammenu_item_meta['general_settings']['tab_layouts'] ) && $iepammenu_item_meta['general_settings']['tab_layouts'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['tab_layouts'] ) : "iepa-default-tab-design"; ?>
          <select name="iepa_settings[general_settings][tab_layouts]" class="imma-selection">
            <option value="iepa-default-tab-design" <?php if( $tab_layouts == "iepa-default-tab-design" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Default Layout', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="iepa-simple-design-layout" <?php if( $tab_layouts == "iepa-simple-design-layout" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Simple Design Layout', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="iepa-animated-border-design" <?php if( $tab_layouts == "iepa-animated-border-design" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Animated Border Design', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="iepa-creative-tab-design" <?php if( $tab_layouts == "iepa-creative-tab-design" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Creative Tab Design', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="iepa-modern-tab-design" <?php if( $tab_layouts == "iepa-modern-tab-design" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Modern Tab Design', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <p class="description">
            <?php esc_html_e( "Choose tab layout design. Selected design layout will work for both horizontal and verical tab.", IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

      <tr class="show_for_tabbed">
        <td class="imma_meta_table">
          <?php esc_html_e( "Tabbed Content Animation", IEPA_TEXT_DOMAIN ); ?>
        </td>
        <td class='iepammmega-value'>
          <?php $tabbed_animation = ( isset( $iepammenu_item_meta['general_settings']['tabbed_animation'] ) && $iepammenu_item_meta['general_settings']['tabbed_animation'] != '' ) ? esc_attr( $iepammenu_item_meta['general_settings']['tabbed_animation'] ) : 'none'; ?>
          <select name="iepa_settings[general_settings][tabbed_animation]" class="imma-selection">
            <option value="none" <?php if( $tabbed_animation == "none" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'None', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="mybounce" <?php if( $tabbed_animation == "mybounce" ) echo esc_attr("selected=selected");?>>
              <?php esc_html_e( 'Bounce', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="flash" <?php if( $tabbed_animation == "flash" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Flash', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="shake" <?php if( $tabbed_animation == "shake" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Shake', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="swing" <?php if( $tabbed_animation == "swing" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Swing', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="tada" <?php if( $tabbed_animation == "tada" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'Tada', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="bounceIn" <?php if( $tabbed_animation == "bounceIn" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'BounceIn', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="flipInX" <?php if( $tabbed_animation == "flipInX" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'FlipInX', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="flipInY" <?php if( $tabbed_animation == "flipInY" ) echo esc_attr("selected=selected");?>>
              <?php esc_html_e( 'FlipInY', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="slideInUp" <?php if( $tabbed_animation == "slideInUp" ) echo esc_attr("selected=selected"); ?>>
              <?php esc_html_e( 'SlideInUp', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="slideInDown" <?php if( $tabbed_animation == "slideInDown" ) echo esc_attr("selected=selected");?>>
              <?php esc_html_e( 'SlideInDown', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="fadeInDown" <?php if( $tabbed_animation == "fadeInDown" ) echo esc_attr("selected=selected");?>>
              <?php esc_html_e( 'FadeInDown', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="fadeInUp" <?php if( $tabbed_animation == "fadeInUp" ) echo esc_attr("selected=selected");?>>
              <?php esc_html_e( 'FadeInUp', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <p class="description">
            <?php esc_html_e( 'Choose specific animation type for this tabbed content.Default is set as FadeInDown. None will disable the animation.', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>

    </table>

  </div>

</div>
