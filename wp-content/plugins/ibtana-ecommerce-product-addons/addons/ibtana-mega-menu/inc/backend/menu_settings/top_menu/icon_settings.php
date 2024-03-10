<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="settings_title">
  <h2>
    <?php esc_html_e( 'Icon Settings', IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>
<div class="iepa_mega_settings">
<?php
$attr_class       = ( isset( $iepammenu_item_meta['icons_settings']['icon_choose'] ) && $iepammenu_item_meta['icons_settings']['icon_choose'] != '' ) ? $iepammenu_item_meta['icons_settings']['icon_choose'] : '';
$enable_customimg = ( isset( $iepammenu_item_meta['icons_settings']['enable_customimg'] ) && $iepammenu_item_meta['icons_settings']['enable_customimg'] == 'true' ) ? 'true' : 'false';
?>
  <table class="iepa-widefat">

    <tr>
      <td class="imma_meta_table">
        <label for="show_top_content">
          <?php esc_html_e( "Choose Pre Available Icon", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div data-target="icon-picker" class="button icon-picker <?php if ( $attr_class !='' ) { $v = explode( '|', $attr_class ); echo esc_attr( $v[0] . ' ' . $v[1] ); } ?>"></div>
        <input class="icon-picker-input" type="text" name="iepa_settings[icons_settings][icon_choose]" value="<?php if ( $attr_class !='' ) { $v = explode( '|', $attr_class ); echo esc_attr( $v[0] . ' ' . $v[1] ); } ?>" />
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <label for="enable_customimg">
          <?php esc_html_e( "Enable Custom Icon", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="enable_customimg" name='iepa_settings[icons_settings][enable_customimg]' value='true' <?php echo checked( $enable_customimg, 'true', false ); ?> />
          <label for="enable_customimg"></label>
        </div>
        <p class="description">
          <?php esc_html_e( "Note: Enable to show uploaded custom icon for menu. If this option is enable, only uploaded custom icon will be shown on this menu item, the above available icon will not be displayed.So, if you want to display above available choosed menu icon, then please do disable this option.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>


    <tr class="toggle_custom_image" id="customimage">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Choose Icon", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="imma-option-field">
          <input type="hidden" class="imma-customimage-url" name="iepa_settings[icons_settings][custom_image_url]"
            value="<?php echo ( isset( $iepammenu_item_meta['icons_settings']['custom_image_url'] ) && $iepammenu_item_meta['icons_settings']['custom_image_url'] != '' ) ? esc_url( $iepammenu_item_meta['icons_settings']['custom_image_url'] ) : ''; ?>"
          />

          <input type="button" class="imma_logo_url_button button button-primary button-large"
            id="customimage" name="imma_custom_image_url"
            value="<?php esc_attr_e( 'Upload Custom Icon', IEPA_TEXT_DOMAIN ) ?>" size="25"
          />
          <?php
          $img_url  = ( isset( $iepammenu_item_meta['icons_settings']['custom_image_url'] ) && $iepammenu_item_meta['icons_settings']['custom_image_url'] != '' ) ? esc_url( $iepammenu_item_meta['icons_settings']['custom_image_url'] ) : '';
          ?>
          <div class="imma-option-field imma-image-preview3 <?php if( $img_url == '' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
            <a class="remove_custom_image_url" href="#">
              <i class="dashicons dashicons-trash"></i>
            </a>
            <img class="iepa-custom-image" style="width: 80%;"
              src="<?php echo ( isset( $iepammenu_item_meta['icons_settings']['custom_image_url'] ) && $iepammenu_item_meta['icons_settings']['custom_image_url'] != '' ) ? esc_url( $iepammenu_item_meta['icons_settings']['custom_image_url'] ) : ''; ?>"
              alt=""
            />
          </div>

        </div>
      </td>
    </tr>

    <tr>
      <td>
        <label>
          <?php esc_html_e( "Custom Width/Height", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <input type="number" placeholder="E.g., 40" class="imma-custom-width custom-cart-icon-size" name="iepa_settings[icons_settings][custom_width]"
          value="<?php echo ( isset( $iepammenu_item_meta['icons_settings']['custom_width'] ) && $iepammenu_item_meta['icons_settings']['custom_width'] != '' ) ? esc_attr( $iepammenu_item_meta['icons_settings']['custom_width'] ) : ''; ?>" />
        <label>
          <?php esc_html_e( "Width(px)", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="number" placeholder="E.g., 40" class="imma-custom-height custom-cart-icon-size" name="iepa_settings[icons_settings][custom_height]"
          value="<?php echo ( isset( $iepammenu_item_meta['icons_settings']['custom_height'] ) && $iepammenu_item_meta['icons_settings']['custom_height'] != '' ) ? esc_attr( $iepammenu_item_meta['icons_settings']['custom_height'] ) : ''; ?>" />
        <label>
          <?php esc_html_e( "Height(px)", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class="description">
          <?php esc_html_e( 'Define image custom width/height in px.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>
  </table>
</div>
