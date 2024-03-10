<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="iepammmega_left_content_wrapper image_settings iepa-accordion actively-open">

  <div class="iepamega-image iepa-accordion-header">
    <span class="dashicons dashicons-format-image"></span>
    <?php esc_html_e( "Image Settings", IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </div>

  <table class="form-table iepa-accordion-content">

    <tr>
      <td class="immamega-name iepa-mm-image-section">
        <?php esc_html_e( "Image Size", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Default image settings", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <?php $image_sizes = IEPA_MM_Libary::imma_get_image_sizes(); ?>
      <td class="iepammmega-value">
        <select class="imma-selection" name="image_size">
          <?php
          if( isset( $image_sizes ) && !empty( $image_sizes ) ) {
            foreach ( $image_sizes as $size_name => $key ) {
              ?>
              <option class="image_label" <?php if( $size_name == $image_size ) { echo esc_attr( "selected=selected" ); } ?>
                value="<?php echo esc_attr( $size_name ); ?>"
                data-subtext="<?php esc_attr_e( 'Registered image size: ' . $size_name . ' ' . $key['width'] . ' * ' . $key['height'] ); ?>"
              >
                <?php echo ucwords( esc_html_e( $size_name, IEPA_TEXT_DOMAIN ) ); ?>
              </option>
              <?php
            }
          }
          ?>
        </select>
      </td>
    </tr>


    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Set Default Custom Width", IEPA_TEXT_DOMAIN ); ?>
        <p class="description">
          <?php esc_html_e( 'Note: Set default custom image width here in px', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td>
        <label data-validation="px" class="iepa-mm-mega_container-padding">
          <span><?php esc_html_e( 'Width', IEPA_TEXT_DOMAIN ); ?></span>
          <input type="text" value="<?php echo esc_attr( $custom_width ); ?>" name="custom_width" class="iepammmega-menu_bar_padding" placeholder="45px">
        </label>
      </td>

    </tr>

  </table>

</div>

<div class="iepammmega_left_content_wrapper image_settings iepa-accordion actively-open">

  <div class="iepamega-icon iepa-accordion-header">
    <span class="dashicons dashicons-info"></span>
    <?php esc_html_e( "Icon Settings", IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </div>

  <table class="form-table iepa-accordion-content">
    <tr>
      <td class='immamega-name'>
        <label for="hideallicons">
          <?php esc_html_e( "Hide All Menu Icons", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Check to hide all icons. Enabling this options will hide all the icons of menu items displayed on frontend at once.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="hide_icons" id="hideallicons" value="1" <?php if( $hide_icons == 1 ) echo esc_attr( "checked=checked" ); ?> />
        </div>
      </td>
    </tr>
    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Icon Width", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Fill icon width in px.Default set as 13px. This value is common for all menu icons.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="text" name="icon_width" id="icon_width" value="<?php if( $icon_width ) { echo esc_attr( $icon_width ); } ?>" placeholder="13px" />
      </td>
    </tr>
  </table>

</div>
