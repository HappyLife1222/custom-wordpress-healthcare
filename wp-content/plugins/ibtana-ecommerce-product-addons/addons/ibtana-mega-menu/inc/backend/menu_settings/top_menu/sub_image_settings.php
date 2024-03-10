<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="settings_title">
  <h2>
    <?php esc_html_e( 'Image Settings', IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>

<?php
$image_size             = ( isset( $iepammenu_item_meta['upload_image_settings']['image_size'] ) ? esc_attr( $iepammenu_item_meta['upload_image_settings']['image_size'] ) : 'default' );
$enable_custom_inherit  = ( isset( $iepammenu_item_meta['upload_image_settings']['enable_custom_inherit'] ) ? esc_attr( $iepammenu_item_meta['upload_image_settings']['enable_custom_inherit'] ) : '0' );
$custom_width           = ( isset( $iepammenu_item_meta['upload_image_settings']['custom_width'] ) ? $iepammenu_item_meta['upload_image_settings']['custom_width'] : '' );
?>

<div class="iepa_mega_settings">
  <table class="iepa-widefat">
    <tr>
      <td class="imma_meta_table">
        <label for="enable_search_form">
          <?php esc_html_e( "Image Size", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <input id="imma_default_imagesize" class="radio"
          type="radio" <?php if( $image_size == "default" ) { echo esc_attr( "checked='checked'" ); } ?>
          value="default" name="iepa_settings[upload_image_settings][image_size]"
        />
        <label for="imma_default_imagesize" class="image_label">
          <?php esc_html_e( 'Default Value', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br />
        <p class="description">
          <?php esc_html_e( 'Inherit default image size settings.', IEPA_TEXT_DOMAIN ); ?>
        </p>

        <?php $image_sizes = IEPA_MM_Libary::imma_get_image_sizes(); ?>

        <?php
        if( isset( $image_sizes ) && !empty( $image_sizes ) ) {
          foreach ( $image_sizes as $size_name => $key ) {
            ?>

            <input id="imma_<?php echo esc_attr( $size_name ); ?>_imagesize" class="radio"
            type="radio" <?php if( $size_name == $image_size ) { echo esc_attr( "checked=checked" ); } ?>
            value="<?php echo esc_attr( $size_name ); ?>" name="iepa_settings[upload_image_settings][image_size]">
            <label for="imma_<?php echo esc_attr( $size_name ); ?>_imagesize" class="image_label">
              <?php echo ucwords( esc_html( $size_name ) ); ?>
            </label>
            <br />
            <p class="description">
              <?php esc_html_e( 'Registered image size:', IEPA_TEXT_DOMAIN ); ?> <?php echo esc_html( $size_name ); ?> <?php echo esc_html( $key['width'] . ' * ' . $key['height'] ); ?>
            </p>
            <?php
          }
        }
        ?>

      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <label for="customdefaultwidth">
          <?php esc_html_e( "Inherit Custom Default Width", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "On enable, default custom width you set will be used for image.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="iepa_settings[upload_image_settings][enable_custom_inherit]" id="customdefaultwidth"
          value="1" <?php if( $enable_custom_inherit == 1 ) { echo esc_attr( "checked=checked" ); } ?>
          />
          <label for="customdefaultwidth"></label>
        </div>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Image Custom Width", IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <label data-validation="px" class="iepa-mm-mega_container-padding">
          <span>
            <?php esc_html_e( 'Width', IEPA_TEXT_DOMAIN ); ?>
          </span>
          <input type="text" value="<?php echo esc_attr( $custom_width ); ?>" name="iepa_settings[upload_image_settings][custom_width]" class="iepammmega-menu_bar_padding" placeholder="45px">
        </label>
      </td>
    </tr>

  </table>
</div>
