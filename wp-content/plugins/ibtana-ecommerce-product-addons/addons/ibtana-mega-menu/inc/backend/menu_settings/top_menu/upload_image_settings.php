<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$use_custom_settings  = ( isset( $iepammenu_item_meta['upload_image_settings']['use_custom_settings'] ) && $iepammenu_item_meta['upload_image_settings']['use_custom_settings'] == 'true' ) ? 'true' : 'false';
$show_description     = ( isset( $iepammenu_item_meta['upload_image_settings']['show_description'] ) && $iepammenu_item_meta['upload_image_settings']['show_description'] == 'true' ) ? 'true' : 'false';
$display_readmore     = ( isset( $iepammenu_item_meta['upload_image_settings']['display_readmore'] ) && $iepammenu_item_meta['upload_image_settings']['display_readmore'] == 'true' ) ? 'true' : 'false';
$display_post_date    = ( isset( $iepammenu_item_meta['upload_image_settings']['display_post_date'] ) && $iepammenu_item_meta['upload_image_settings']['display_post_date'] == 'true' ) ? 'true' : 'false';
$display_author_name  = ( isset( $iepammenu_item_meta['upload_image_settings']['display_author_name'] ) && $iepammenu_item_meta['upload_image_settings']['display_author_name'] == 'true' ) ? 'true' : 'false';
$display_cat_name     = ( isset( $iepammenu_item_meta['upload_image_settings']['display_cat_name'] ) && $iepammenu_item_meta['upload_image_settings']['display_cat_name'] == 'true' ) ? 'true' : 'false';

$posts_images_type    = ( isset( $iepammenu_item_meta['upload_image_settings']['display_posts_images'] ) && $iepammenu_item_meta['upload_image_settings']['display_posts_images'] == 'featured-image' ) ? 'featured-image' : 'custom-image';
$text_position        = ( isset( $iepammenu_item_meta['upload_image_settings']['text_position'] ) && $iepammenu_item_meta['upload_image_settings']['text_position'] != '' ) ? esc_attr( $iepammenu_item_meta['upload_image_settings']['text_position'] ) : 'left';
?>
<div class="settings_title">
  <h2>
    <?php esc_html_e( 'Custom Menu Settings',IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>
<div class="iepa_mega_settings">
  <table class="iepa-widefat">

    <caption>
      <p class="description">
        <?php esc_html_e( 'Here you can select particular post featured images, excerpt, read more text and date for sub menu post selected only on megamenu type.', IEPA_TEXT_DOMAIN ); ?>
      </p>
    </caption>

    <tr>
      <td class="imma_meta_table">
        <label for="use_custom_settings">
          <?php esc_html_e( "Use Custom Settings", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='use_custom_settings' id="use_custom_settings"
          name='iepa_settings[upload_image_settings][use_custom_settings]' value='true' <?php echo checked( $use_custom_settings, 'true', false ); ?>/>
          <label for="use_custom_settings"></label>
        </div>
        <p class="description">
          <?php esc_html_e( 'Note: On check , use below custom settings for this sub menu in ibtana mega menu.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>
    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Display Posts Image", IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <select name='iepa_settings[upload_image_settings][display_posts_images]' class="imma-displaypostimg">
          <option value='featured-image' <?php echo selected( $posts_images_type, 'featured-image', false );?>>
            <?php esc_html_e( "Featured Image", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='custom-image' <?php echo selected( $posts_images_type, 'custom-image', false );?>>
            <?php esc_html_e( "Custom Image", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
        <p class="description">
          <?php esc_html_e( 'Note: Choose featured image of this menu as side image or custom image and enter custom thumbnail link below for ibtana mega menu.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>
    <tr>
      <td class="imma_meta_table">
        <label for="default_thumbnail_imageurl">
          <?php esc_html_e( "Default Thumbnail Image Link", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td class="iepammmega-value">
        <input type='text' class='imma_menu_settingss' id="default_thumbnail_imageurl"
        name='iepa_settings[upload_image_settings][default_thumbnail_imageurl]' placeholder="http://placehold.it/45x45/f0f0f0/ccc"
        value='<?php echo ( isset( $iepammenu_item_meta['upload_image_settings']['default_thumbnail_imageurl'] ) ? esc_url( $iepammenu_item_meta['upload_image_settings']['default_thumbnail_imageurl'] ) : '' ); ?>' />
      </td>
    </tr>
    <tr>
      <td class="imma_meta_table">
        <label for="show_excerpt"><?php esc_html_e( "Show Excerpt", IEPA_TEXT_DOMAIN ); ?></label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="show_excerpt"
          name='iepa_settings[upload_image_settings][show_description]' value='true' <?php echo checked( $show_description,'true', false ); ?>/>
          <label for="show_excerpt"></label>
        </div>
        <p class="description">
          <?php esc_html_e( 'Show description of posts,page or post type for ibtana mega menu.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>
    <tr>
      <td class="imma_meta_table">
        <label for="show_desc_length">
          <?php esc_html_e( "Excerpt Length", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <input type='number' class='imma_menu_settingss' id="show_desc_length"
        name='iepa_settings[upload_image_settings][show_desc_length]'
        value='<?php echo ( isset( $iepammenu_item_meta['upload_image_settings']['show_desc_length'] ) ? intval( esc_attr( $iepammenu_item_meta['upload_image_settings']['show_desc_length'] ) ) : '10' ); ?>' />
      </td>
    </tr>
    <tr>
      <td class="imma_meta_table">
        <label for="display_readmore"><?php esc_html_e( "Display Readmore", IEPA_TEXT_DOMAIN ); ?></label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="display_readmore"
          name='iepa_settings[upload_image_settings][display_readmore]' value='true' <?php echo checked( $display_readmore, 'true', false ); ?> />
          <label for="display_readmore"></label>
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <label for="readmore_text"><?php esc_html_e( "Readmore Text", IEPA_TEXT_DOMAIN ); ?></label>
      </td>
      <td>
        <input type='text' class='imma_menu_settingss' id="readmore_text"
        name='iepa_settings[upload_image_settings][readmore_text]' placeholder="Read More >>"
        value='<?php echo ( isset( $iepammenu_item_meta['upload_image_settings']['readmore_text'] ) ? esc_attr( $iepammenu_item_meta['upload_image_settings']['readmore_text'] ) : '' ); ?>' />
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <label for="display_post_date"><?php esc_html_e( "Display Date", IEPA_TEXT_DOMAIN ); ?></label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="display_post_date"
          name='iepa_settings[upload_image_settings][display_post_date]' value='true' <?php echo checked( $display_post_date, 'true', false ); ?> />
          <label for="display_post_date"></label>
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <label for="display_author_name"><?php esc_html_e( "Display Author Name", IEPA_TEXT_DOMAIN ); ?></label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="display_author_name"
          name='iepa_settings[upload_image_settings][display_author_name]' value='true' <?php echo checked( $display_author_name, 'true', false ); ?> />
          <label for="display_author_name"></label>
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <label for="display_cat_name"><?php esc_html_e( "Display Category Name", IEPA_TEXT_DOMAIN ); ?></label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="display_cat_name"
          name='iepa_settings[upload_image_settings][display_cat_name]' value='true' <?php echo checked( $display_cat_name, 'true', false ); ?>/>
          <label for="display_cat_name"></label>
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Image Position", IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <select name='iepa_settings[upload_image_settings][text_position]' class="imma_textposition">
          <option value='left' <?php echo selected( $text_position, 'left', false ); ?>>
            <?php esc_html_e( "Image Left", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='right' <?php echo selected( $text_position, 'right', false );?>>
            <?php esc_html_e( "Image Right", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='top' <?php echo selected( $text_position, 'top', false );?>>
            <?php esc_html_e( "Image Top", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='onlyimage' <?php echo selected( $text_position, 'onlyimage', false );?>>
            <?php esc_html_e( "Only Image", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr class="show_text_position" style="display:none;">
      <td>
        <?php esc_html_e( 'Sub Menu Text Position Preview', IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <div class="imma_preview_textposition" id="preview_left" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/text-position-left.PNG' ); ?>" />
        </div>
        <div class="imma_preview_textposition" id="preview_right" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/text-position-right.PNG' ); ?>" />
        </div>
        <div class="imma_preview_textposition" id="preview_top" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/text-position-top.PNG' ); ?>" />
        </div>
        <div class="imma_preview_textposition" id="preview_onlyimage" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/text-position-image-only.PNG' ); ?>"/>
        </div>
      </td>
    </tr>
  </table>
</div>
