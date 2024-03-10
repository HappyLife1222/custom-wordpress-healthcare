<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="settings_title">
  <h4>
    <?php esc_html_e( 'Extra Settings', IEPA_TEXT_DOMAIN );?>
  </h4>
</div>
<div class="iepa_mega_settings imma-extra">
  <table class="widefat">
    <tr>
      <td class="imma_meta_table">
        <label for="enable_search_form">
          <?php esc_html_e( "Choose Content Type", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <select name="iepa_settings[custom_extra_settings][content_type]" id="imma_content_type">
          <option value="none" <?php echo selected( $iepammenu_item_meta['custom_extra_settings']['content_type'], 'none', false );?>>
            <?php esc_html_e( 'Default', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="description_field" <?php echo selected( $iepammenu_item_meta['custom_extra_settings']['content_type'], 'description_field', false );?>>
            <?php esc_html_e( 'Simple Description Field', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="shortcodes" <?php echo selected( $iepammenu_item_meta['custom_extra_settings']['content_type'], 'shortcodes', false );?>>
            <?php esc_html_e( 'Shortcodes', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
        <p class="description">
          <?php esc_html_e( 'Note: Choose content type to display for this submenu.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>


    <tr class="toggle_description">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Custom Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <textarea name='iepa_settings[custom_extra_settings][content_description]' cols="40" rows="2" placeholder="<?php esc_html_e( 'Fill Simple Description here.', IEPA_TEXT_DOMAIN );?>"><?php echo ( isset( $iepammenu_item_meta['custom_extra_settings']['content_description'] ) && $iepammenu_item_meta['custom_extra_settings']['content_description'] != '' ) ? esc_html( $iepammenu_item_meta['custom_extra_settings']['content_description'] ) : ''; ?></textarea>
      </td>
    </tr>

    <tr class="toggle_shortcodes">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Custom Shortcode", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <textarea name='iepa_settings[custom_extra_settings][shortcodes]' cols="40" rows="2" placeholder="<?php esc_html_e( 'Place Shortcode here.', IEPA_TEXT_DOMAIN );?>"><?php echo ( isset( $iepammenu_item_meta['custom_extra_settings']['shortcodes'] ) && $iepammenu_item_meta['custom_extra_settings']['shortcodes'] != '' ) ? esc_html( $iepammenu_item_meta['custom_extra_settings']['shortcodes'] ) : ''; ?></textarea>
      </td>
    </tr>

  </table>
</div>
