<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$enable_custom_styling  = ( isset( $iepammenu_item_meta['custom_styling']['enable_custom_styling'] ) && $iepammenu_item_meta['custom_styling']['enable_custom_styling'] == 'true' ) ? 'true' : 'false';
$enable_menu_bg_color   = ( isset( $iepammenu_item_meta['custom_styling']['enable_menu_bg_color'] ) && $iepammenu_item_meta['custom_styling']['enable_menu_bg_color'] == 'true' ) ? 'true' : 'false';
?>
<!-- <div class="iepa_mega_settings"> -->
  <!-- <div class="settings_content"> -->
<div class="settings_title">
  <h2>
    <?php esc_html_e( 'Custom Styling Settings', IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>
<table class="iepa-widefat">
  <caption>
    <p class="description">
      <?php esc_html_e( "Note: Set below custom styling for each menu items.This values setup will override the styling setup of available theme as well as custom theme.", IEPA_TEXT_DOMAIN ); ?>
    </p>
  </caption>
  <tr>
    <td class="imma_meta_table">
      <label for="enable_custom_styling">
        <?php esc_html_e( "Enable All Custom Styling", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="imma-section">
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="enable_custom_styling"
            name='iepa_settings[custom_styling][enable_custom_styling]'
            value='true' <?php echo checked( $enable_custom_styling, 'true', false ); ?>
          />
          <label for="enable_custom_styling"></label>
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable this button first in order to apply below styling. If not enable the below styling wont be applied.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_menu_bg_color">
        <?php esc_html_e( "Background Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_menu_bg_color"
              name='iepa_settings[custom_styling][enable_menu_bg_color]'
              value='true' <?php echo checked( $enable_menu_bg_color, 'true', false ); ?>
            />
            <label for="enable_menu_bg_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="menu_background_color"
            name='iepa_settings[custom_styling][menu_background_color]'
            value="<?php echo ( isset( $iepammenu_item_meta['custom_styling']['menu_background_color'] ) && $iepammenu_item_meta['custom_styling']['menu_background_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['menu_background_color'] ) : ''; ?>" class="imma-mm-color-picker"
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set Background color for this menu item.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

  <?php
  $enable_menu_bg_hover_color = ( isset( $iepammenu_item_meta['custom_styling']['enable_menu_bg_hover_color'] ) && $iepammenu_item_meta['custom_styling']['enable_menu_bg_hover_color'] == 'true' ) ? 'true' : 'false';
  ?>
  <tr>
    <td class="imma_meta_table">
      <label for="enable_menu_bg_hover_color">
        <?php esc_html_e( "Background Hover Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_menu_bg_hover_color"
              name='iepa_settings[custom_styling][enable_menu_bg_hover_color]'
              value='true' <?php echo checked( $enable_menu_bg_hover_color, 'true', false ); ?>
            />
            <label for="enable_menu_bg_hover_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="menu_bg_hover_color"
            name='iepa_settings[custom_styling][menu_bg_hover_color]'
            value="<?php echo ( isset( $iepammenu_item_meta['custom_styling']['menu_bg_hover_color'] ) && $iepammenu_item_meta['custom_styling']['menu_bg_hover_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['menu_bg_hover_color'] ) : ''; ?>" class="imma-mm-color-picker"
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set Background color for this menu item.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_menu_font_color">
        <?php esc_html_e( "Menu Font Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <?php
      $enable_menu_font_color = ( isset( $iepammenu_item_meta['custom_styling']['enable_menu_font_color'] ) && $iepammenu_item_meta['custom_styling']['enable_menu_font_color'] == 'true' ) ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_menu_font_color"
              name='iepa_settings[custom_styling][enable_menu_font_color]'
              value='true' <?php echo checked( $enable_menu_font_color, 'true', false ); ?>
            />
            <label for="enable_menu_font_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="menu_font_color"
            name='iepa_settings[custom_styling][menu_font_color]'
            value='<?php echo ( isset( $iepammenu_item_meta['custom_styling']['menu_font_color'] ) && $iepammenu_item_meta['custom_styling']['menu_font_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['menu_font_color'] ) : ''; ?>' class="imma-mm-color-picker"
          />
        </div>
      </div>
      <p class="description"><?php esc_html_e( "Enable and Set font color for this menu item.", IEPA_TEXT_DOMAIN ); ?></p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_menu_font_hover_color">
        <?php esc_html_e( "Menu Font Hover Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
      </td>
    <td>
      <?php
      $enable_menu_font_hover_color = ( isset( $iepammenu_item_meta['custom_styling']['enable_menu_font_hover_color'] ) && $iepammenu_item_meta['custom_styling']['enable_menu_font_hover_color'] == 'true' ) ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_menu_font_hover_color"
              name='iepa_settings[custom_styling][enable_menu_font_hover_color]'
              value='true' <?php echo checked( $enable_menu_font_hover_color, 'true', false ); ?>
            />
            <label for="enable_menu_font_hover_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="menu_font_hover_color"
            name='iepa_settings[custom_styling][menu_font_hover_color]'
            value='<?php echo ( isset( $iepammenu_item_meta['custom_styling']['menu_font_hover_color'] ) && $iepammenu_item_meta['custom_styling']['menu_font_hover_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['menu_font_hover_color'] ) : ''; ?>' class="imma-mm-color-picker"
          />
        </div>
      </div>
      <p class="description"><?php esc_html_e("Enable and Set font hover color for this menu item.", IEPA_TEXT_DOMAIN); ?></p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_submenu_megamenu_width"><?php esc_html_e( "Sub Menu/Mega Menu Width", IEPA_TEXT_DOMAIN ); ?></label>
    </td>
    <td>
      <?php
      $enable_submenu_megamenu_width = ( isset( $iepammenu_item_meta['custom_styling']['enable_submenu_megamenu_width'] ) && $iepammenu_item_meta['custom_styling']['enable_submenu_megamenu_width'] == 'true' ) ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_submenu_megamenu_width"
              name='iepa_settings[custom_styling][enable_submenu_megamenu_width]'
              value='true' <?php echo checked( $enable_submenu_megamenu_width, 'true', false ); ?>
            />
            <label for="enable_submenu_megamenu_width"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="submenu_megamenu_width" placeholder="800px or 60%"
            name='iepa_settings[custom_styling][submenu_megamenu_width]'
            value='<?php echo (isset($iepammenu_item_meta['custom_styling']['submenu_megamenu_width']) && $iepammenu_item_meta['custom_styling']['submenu_megamenu_width'] != '') ? esc_attr( $iepammenu_item_meta['custom_styling']['submenu_megamenu_width'] ) : ''; ?>'
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable this option first and then set width in px or % for each menu item sub menu. Note: add px or % after number as per your requirement as shown on placeholder.", IEPA_TEXT_DOMAIN ); ?>
        </p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_submenu_bg_color">
        <?php esc_html_e("Sub Menu Background Color", IEPA_TEXT_DOMAIN) ?>
      </label>
    </td>
    <td>
      <?php
      $enable_submenu_bg_color = ( isset( $iepammenu_item_meta['custom_styling']['enable_submenu_bg_color'] ) && $iepammenu_item_meta['custom_styling']['enable_submenu_bg_color'] == 'true' ) ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_submenu_bg_color"
              name='iepa_settings[custom_styling][enable_submenu_bg_color]'
              value='true' <?php echo checked( $enable_submenu_bg_color, 'true', false ); ?>
            />
            <label for="enable_submenu_bg_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' class="imma-mm-color-picker" id="submenu_bg_color"
            name='iepa_settings[custom_styling][submenu_bg_color]'
            value='<?php echo ( isset( $iepammenu_item_meta['custom_styling']['submenu_bg_color'] ) && $iepammenu_item_meta['custom_styling']['submenu_bg_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['submenu_bg_color'] ) : ''; ?>'
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set Sub menu background color for each menu item.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_sub_heading_font_color">
        <?php esc_html_e( "Sub Menu Header Font Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <?php
      $enable_sub_heading_font_color = (isset($iepammenu_item_meta['custom_styling']['enable_sub_heading_font_color']) && $iepammenu_item_meta['custom_styling']['enable_sub_heading_font_color'] == 'true') ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_sub_heading_font_color"
            name='iepa_settings[custom_styling][enable_sub_heading_font_color]'
            value='true' <?php echo checked($enable_sub_heading_font_color,'true', false ); ?>/>
            <label for="enable_sub_heading_font_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' class="imma-mm-color-picker" id="sub_heading_font_color"
            name='iepa_settings[custom_styling][sub_heading_font_color]'
            value='<?php echo ( isset( $iepammenu_item_meta['custom_styling']['sub_heading_font_color'] ) && $iepammenu_item_meta['custom_styling']['sub_heading_font_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['sub_heading_font_color'] ) : ''; ?>'
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set Sub menu widget header font color for each menu item.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_sub_cfont_color">
        <?php esc_html_e( "Sub Menu Content Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <?php
      $enable_sub_cfont_color = ( isset( $iepammenu_item_meta['custom_styling']['enable_sub_cfont_color'] ) && $iepammenu_item_meta['custom_styling']['enable_sub_cfont_color'] == 'true' ) ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_sub_cfont_color"
              name='iepa_settings[custom_styling][enable_sub_cfont_color]'
              value='true' <?php echo checked( $enable_sub_cfont_color, 'true', false ); ?>
            />
            <label for="enable_sub_cfont_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' class="imma-mm-color-picker" id="submenu_cfont_color"
            name='iepa_settings[custom_styling][submenu_cfont_color]'
            value='<?php echo (isset($iepammenu_item_meta['custom_styling']['submenu_cfont_color']) && $iepammenu_item_meta['custom_styling']['submenu_cfont_color'] != '') ? esc_attr( $iepammenu_item_meta['custom_styling']['submenu_cfont_color'] ) : ''; ?>'
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set Sub menu Widget content font color for each menu item.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

  <tr>
    <td class="imma_meta_table">
      <label for="enable_menu_icon_color">
        <?php esc_html_e( "Menu Icon Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <?php
      $enable_menu_icon_color = (isset($iepammenu_item_meta['custom_styling']['enable_menu_icon_color']) && $iepammenu_item_meta['custom_styling']['enable_menu_icon_color'] == 'true') ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_menu_icon_color"
              name='iepa_settings[custom_styling][enable_menu_icon_color]'
              value='true' <?php echo checked( $enable_menu_icon_color,'true', false ); ?>
            />
            <label for="enable_menu_icon_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="menu_icon_color"
            name='iepa_settings[custom_styling][menu_icon_color]' class="imma-mm-color-picker"
            value='<?php echo ( isset($iepammenu_item_meta['custom_styling']['menu_icon_color'] ) && $iepammenu_item_meta['custom_styling']['menu_icon_color'] != '') ? esc_attr( $iepammenu_item_meta['custom_styling']['menu_icon_color'] ) : ''; ?>'
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set color for available icons choosed such as for font awesome, genericons and dashicons.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>

	<tr>
  	<td class="imma_meta_table">
      <label for="enable_menu_icon_hover_color">
        <?php esc_html_e( "Menu Icon Hover Color", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <?php
      $enable_menu_icon_hover_color = (isset($iepammenu_item_meta['custom_styling']['enable_menu_icon_hover_color']) && $iepammenu_item_meta['custom_styling']['enable_menu_icon_hover_color'] == 'true') ? 'true' : 'false';
      ?>
      <div class="imma-section">
        <div class="left-section-styling">
          <div class="iepa-mm-switch">
            <input type='checkbox' class='imma_menu_settingss' id="enable_menu_icon_hover_color"
              name='iepa_settings[custom_styling][enable_menu_icon_hover_color]'
              value='true' <?php echo checked( $enable_menu_icon_hover_color, 'true', false ); ?>
            />
            <label for="enable_menu_icon_hover_color"></label>
          </div>
        </div>
        <div class="rt-section-styling">
          <input type='text' id="menu_icon_hover_color"
            name='iepa_settings[custom_styling][menu_icon_hover_color]' class="imma-mm-color-picker"
            value='<?php echo ( isset( $iepammenu_item_meta['custom_styling']['menu_icon_hover_color'] ) && $iepammenu_item_meta['custom_styling']['menu_icon_hover_color'] != '' ) ? esc_attr( $iepammenu_item_meta['custom_styling']['menu_icon_hover_color'] ) : ''; ?>'
          />
        </div>
      </div>
      <p class="description">
        <?php esc_html_e( "Enable and Set hover color for available icons choosed such as for font awesome, genericons and dashicons.", IEPA_TEXT_DOMAIN ); ?>
      </p>
    </td>
  </tr>


</table>
  <!-- </div> -->
<!-- </div> -->
