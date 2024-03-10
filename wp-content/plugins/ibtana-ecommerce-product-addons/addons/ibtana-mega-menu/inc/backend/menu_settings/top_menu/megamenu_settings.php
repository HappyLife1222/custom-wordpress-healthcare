<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$show_top_content     = ( isset( $iepammenu_item_meta['mega_menu_settings']['show_top_content'] ) && $iepammenu_item_meta['mega_menu_settings']['show_top_content'] == 'true' ) ? 'true' : 'false';
$show_bottom_content  = ( isset( $iepammenu_item_meta['mega_menu_settings']['show_bottom_content'] ) && $iepammenu_item_meta['mega_menu_settings']['show_bottom_content'] == 'true' ) ? 'true' : 'false';

$top_content_type     = ( isset( $iepammenu_item_meta['mega_menu_settings']['top']['top_content_type'] ) && $iepammenu_item_meta['mega_menu_settings']['top']['top_content_type'] != '' ) ? $iepammenu_item_meta['mega_menu_settings']['top']['top_content_type'] : 'text_only';
$bottom_content_type  = ( isset( $iepammenu_item_meta['mega_menu_settings']['bottom']['bottom_content_type'] ) && $iepammenu_item_meta['mega_menu_settings']['bottom']['bottom_content_type'] != '' ) ? $iepammenu_item_meta['mega_menu_settings']['bottom']['bottom_content_type'] : 'text_only';
?>

<div class="settings_title">
  <h2>
    <?php esc_html_e( 'Mega Menu Settings', IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>

<div class="iepa_mega_settings">
  <table class="iepa-widefat">
    <tr>
      <td class="imma_meta_table">
        <label for="show_top_content">
          <?php esc_html_e( "Show Top Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_menu_settingss' id="show_top_content"
          name='iepa_settings[mega_menu_settings][show_top_content]' value='true' <?php echo checked( $show_top_content, 'true', false ); ?> />
          <label for="show_top_content"></label>
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <label for="show_bottom_content">
          <?php esc_html_e( "Show Bottom Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="iepa-mm-switch">
          <input type='checkbox' class='imma_active_links' id="show_bottom_content"
            name="iepa_settings[mega_menu_settings][show_bottom_content]" value="true" <?php echo checked( $show_bottom_content, 'true', false ); ?> />
          <label for="show_bottom_content"></label>
        </div>
      </td>
    </tr>

    <!-- top content start-->
    <tr>
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Select Top Content Type", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <select title="<?php esc_attr_e( 'Select top content type as text only, image only or image with text.', IEPA_TEXT_DOMAIN ); ?>" name="iepa_settings[mega_menu_settings][top][top_content_type]" id="imma_choose_topcontent_type">
          <option value="text_only" <?php echo selected( $top_content_type, 'text_only', false ); ?>>
            <?php esc_html_e( 'Text Only' ); ?>
          </option>
          <option value="image_only" <?php echo selected( $top_content_type, 'image_only', false ); ?>>
            <?php esc_html_e( 'Image Only' ); ?>
          </option>
          <option value="html" <?php echo selected( $top_content_type, 'html', false ); ?>>
            <?php esc_html_e( 'HTML' ); ?>
          </option>
        </select>
        <p class="description">
          <?php esc_html_e( "Note:HTML type content with tinymce implementation only works for WordPress version above 4.8", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>

    <?php
    $top_content_type = $top_content_type;
    ?>

    <!-- case 1: only text here -->
    <tr class="toggle_toptext <?php if( $top_content_type != 'text_only' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Top Text Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <textarea name='iepa_settings[mega_menu_settings][top][top_content]' cols="70" rows="3"><?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['top']['top_content'] ) && $iepammenu_item_meta['mega_menu_settings']['top']['top_content'] != '' ) ? esc_textarea( $iepammenu_item_meta['mega_menu_settings']['top']['top_content'] ) : ''; ?></textarea>
      </td>
    </tr>

    <!-- case 2: only image here -->
    <tr class="toggle_topimage <?php if( $top_content_type != 'image_only' ) { echo esc_attr( 'iepa-d-none' ); } ?>" id="top_image">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Top Image", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="imma-option-field">
          <input type="hidden" class="iepa-image-url" name="iepa_settings[mega_menu_settings][top][image_url]"
          value="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['top']['image_url'] ) && $iepammenu_item_meta['mega_menu_settings']['top']['image_url'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['top']['image_url'] ) : ''; ?>" />

          <input type="button" class="imma_image_url_button button button-primary button-large" id="top_image"
          name="imma_image_url_button" value="Upload Image" size="25"
          />

          <p class="description">
            <?php esc_html_e( 'Recommended Image Size to fit on top section with width of 1240px and height of 150px.', IEPA_TEXT_DOMAIN ); ?>
          </p>

          <div class="imma-option-field iepa-image-preview">
            <a class="remove_top_image" href="#">
              <i class="dashicons dashicons-trash"></i>
            </a>
            <img style="width: 38%;" class="imma-top-image"
            src="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['top']['image_url'] ) && $iepammenu_item_meta['mega_menu_settings']['top']['image_url'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['top']['image_url'] ) : ''; ?>"
            alt="">
          </div>
        </div>
      </td>
    </tr>

    <!-- case 3: image with text here -->
    <tr class="toggle_html <?php if( $top_content_type != 'html' ) { echo esc_attr( 'iepa-d-none' ); } ?>" id="top_imagetext">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Html Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="imma-option-field">
          <div class="imma-row" style="padding: 10px;">
            <?php
            $key          = IEPA_MM_Libary::generateRandomIndex();
            $editor_idd   = 'imma_html_content_' . $menu_item_id . '_' . $key;
            $html_content = ( isset( $iepammenu_item_meta['mega_menu_settings']['top']['html_content'] ) && $iepammenu_item_meta['mega_menu_settings']['top']['html_content'] != '' ) ? $iepammenu_item_meta['mega_menu_settings']['top']['html_content'] : '';
            wp_editor(
              $html_content,
              $editor_idd,
              array( 'media_buttons' => true, 'textarea_name' => "iepa_settings[mega_menu_settings][top][html_content]" )
            );
            ?>
          </div>
          <input type="hidden" class="imma_key_unique" value="<?php echo esc_attr( $key ); ?>" />
        </div>
      </td>
    </tr>

    <!-- top content end-->
    <!-- bottom content -->
    <tr>
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Select Bottom Content Type", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <select title="<?php esc_attr_e( 'Select bottom content type as text only, image only or image with text.', IEPA_TEXT_DOMAIN ); ?>"
          name="iepa_settings[mega_menu_settings][bottom][bottom_content_type]" id="imma_choose_bottomcontent_type">
          <option value="text_only" <?php echo selected( $bottom_content_type, 'text_only', false ); ?>>
            <?php esc_html_e( 'Text Only' ); ?>
          </option>
          <option value="image_only" <?php echo selected( $bottom_content_type, 'image_only', false ); ?>>
            <?php esc_html_e( 'Image Only' ); ?>
          </option>
          <option value="html" <?php echo selected( $bottom_content_type, 'html', false );?>>
            <?php esc_html_e( 'HTML' ); ?>
          </option>
        </select>
        <p class="description">
          <?php esc_html_e( "Note:HTML type content with tinymce implementation only works for WordPress version above 4.8", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>
    <?php
    if( $bottom_content_type == "html" ) {
      $bottomhtml = '';
    } else {
      $bottomhtml = 'style="display:none;"';
    }
    ?>

    <!-- case 1: only text here -->
    <tr class="toggle_bottomtext <?php if( $bottom_content_type != 'text_only' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Bottom Text Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <textarea name='iepa_settings[mega_menu_settings][bottom][bottom_content]' cols="70" rows="3"><?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['bottom']['bottom_content'] ) && $iepammenu_item_meta['mega_menu_settings']['bottom']['bottom_content'] != '' ) ? esc_textarea( $iepammenu_item_meta['mega_menu_settings']['bottom']['bottom_content'] ) : ''; ?></textarea>
      </td>
    </tr>

    <!-- case 2: only image here -->
    <tr class="toggle_bimage <?php if( $bottom_content_type != 'image_only' ) { echo esc_attr( 'iepa-d-none' ); } ?>" id="bottom_image">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Bottom Image", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="imma-option-field">
          <input type="hidden" class="imma-bimage-url" name="iepa_settings[mega_menu_settings][bottom][image_url]"
          value="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['bottom']['image_url'] ) && $iepammenu_item_meta['mega_menu_settings']['bottom']['image_url'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['bottom']['image_url'] ) : ''; ?>"
          />

          <input type="button" class="imma_image_url_bottom button button-primary button-large" id="bottom_image"
            name="imma_image_url_bottom" value="Upload Image" size="25"
          />

          <p class="description">
            <?php esc_html_e( 'Recommended Image Size to fit on bottom section with width of 1240px and height of 150px.', IEPA_TEXT_DOMAIN ); ?>
          </p>

          <div class="imma-option-field imma-bimage-preview">
            <a class="remove_bottom_image" href="#">
              <i class="dashicons dashicons-trash"></i>
            </a>
            <img style="width: 38%;" class="imma-bottom-image"
            src="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['bottom']['image_url'] ) && $iepammenu_item_meta['mega_menu_settings']['bottom']['image_url'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['bottom']['image_url'] ) : ''; ?>">
          </div>
        </div>
      </td>
    </tr>

    <!-- case 3: image with text here -->
    <tr class="toggle_bhtml <?php if( $bottom_content_type != 'html' ) { echo esc_attr( 'iepa-d-none' ); } ?>" id="bottom_html_only">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Bottom Html Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="imma-option-field">
          <div class="imma-row" style="padding: 10px;">
            <?php
            $editor_id      = 'imma_html_content_' . $key;
            $bhtml_content  = ( isset( $iepammenu_item_meta['mega_menu_settings']['bottom']['html_content'] ) && $iepammenu_item_meta['mega_menu_settings']['bottom']['html_content'] != '' ) ? $iepammenu_item_meta['mega_menu_settings']['bottom']['html_content'] : '';
            wp_editor(
              $bhtml_content,
              $editor_id,
              array(
                'media_buttons' =>  true,
                'textarea_name' =>  "iepa_settings[mega_menu_settings][bottom][html_content]",
                'quicktags'     =>  array(
                  'buttons' =>  'strong,em,link,block,del,ins,img,ul,ol,li,code,close'
                )
              )
            );
            ?>
          </div>
        </div>
      </td>
    </tr>
    <!-- bottom content end -->

    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Mega Menu Horizontal Position", IEPA_TEXT_DOMAIN ); ?>
			</td>
      <td>
        <?php
        $horizontalmenuposition = ( isset( $iepammenu_item_meta['mega_menu_settings']['horizontal-menu-position'] ) && $iepammenu_item_meta['mega_menu_settings']['horizontal-menu-position'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['horizontal-menu-position'] ) : 'full-width';
        ?>
        <select name='iepa_settings[mega_menu_settings][horizontal-menu-position]' class="imma_position">
          <option value='full-width' <?php echo selected( $horizontalmenuposition, 'full-width', false ); ?>>
            <?php esc_html_e( "Full Width", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='center' <?php echo selected( $horizontalmenuposition, 'center', false ); ?>>
            <?php esc_html_e( "Center", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='left-edge' <?php echo selected( $horizontalmenuposition, 'left-edge', false ); ?>>
            <?php esc_html_e( "Left-Edge", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='right-edge' <?php echo selected( $horizontalmenuposition, 'right-edge', false ); ?>>
            <?php esc_html_e( "Right-Edge", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr class="show_megamenu_position_type" style="display:none;">
      <td><?php esc_html_e( 'Position Preview', IEPA_TEXT_DOMAIN ); ?></td>
      <td>
        <div class="imma_preview_position" id="preview_full-width" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/full-width.PNG' ); ?>" alt="FUllwidthMegamenu"/>
        </div>
        <div class="imma_preview_position" id="preview_center" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/center.PNG' ); ?>" alt="Center Mega menu"/>
        </div>
        <div class="imma_preview_position" id="preview_left-edge" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/left-edge.PNG' ); ?>" alt="Left edge"/>
        </div>
        <div class="imma_preview_position" id="preview_right-edge" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/right-edge.PNG' ); ?>" alt="Right edge"/>
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Mega Menu Vertical Position", IEPA_TEXT_DOMAIN ); ?>
			</td>
			<td>
        <?php
        $verticalmenuposition = ( isset( $iepammenu_item_meta['mega_menu_settings']['vertical-menu-position'] ) && $iepammenu_item_meta['mega_menu_settings']['vertical-menu-position'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['vertical-menu-position'] ) : 'full-height';
        ?>
        <select name='iepa_settings[mega_menu_settings][vertical-menu-position]' class="imma_vposition">
          <option value='full-height' <?php echo selected( $verticalmenuposition, 'full-height', false );?>>
            <?php esc_html_e( "Full Height", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='aligned-to-parent' <?php echo selected( $verticalmenuposition, 'aligned-to-parent', false );?>>
            <?php esc_html_e( "Aligned to Parent", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr class="show_megamenu_vposition_type" style="display:none;">
      <td>
        <?php esc_html_e( 'Vertical Position Preview', IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <div class="imma_preview_vposition" id="preview_full-height" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/vertical-full-height.PNG' ); ?>"
          alt="FUll Vertical Height Megamenu"
          />
        </div>
        <div class="imma_preview_vposition" id="preview_aligned-to-parent" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/vertical-alignedto-parent.PNG' ); ?>"
          alt="Aligned to parent Vertical Menu"
          />
        </div>
      </td>
    </tr>

  </table>
</div>
