<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$flyoutposition         = ( isset( $iepammenu_item_meta['flyout_settings']['flyout-position'] ) && $iepammenu_item_meta['flyout_settings']['flyout-position'] != '' ) ? esc_attr( $iepammenu_item_meta['flyout_settings']['flyout-position'] ) : 'left';
$flyoutverticalposition = ( isset( $iepammenu_item_meta['flyout_settings']['vertical-position'] ) && $iepammenu_item_meta['flyout_settings']['vertical-position'] != '' ) ? esc_attr( $iepammenu_item_meta['flyout_settings']['vertical-position'] ) : 'full-height';
?>
<div class="settings_title">
 <h2>
   <?php esc_html_e( 'Flyout Settings', IEPA_TEXT_DOMAIN ); ?>
   <span class="dashicons dashicons-arrow-up"></span>
   <span class="dashicons dashicons-arrow-down"></span>
 </h2>
</div>
<div class="iepa_mega_settings">
  <table class="iepa-widefat">

    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Flyout Horizontal Position", IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <select name='iepa_settings[flyout_settings][flyout-position]' class="imma_flyposition">
          <option value='left'<?php echo selected( $flyoutposition, 'left', false ); ?>>
            <?php esc_html_e( "Left", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='right' <?php echo selected( $flyoutposition, 'right', false );?>>
            <?php esc_html_e( "Right", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr class="show_flyposition_type" style="display:none;">
      <td>
        <?php esc_html_e( 'Position Preview', IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <div class="imma_preview_flyposition" id="preview2_left" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/flyout-left.PNG' ); ?>" alt="Left" />
        </div>
        <div class="imma_preview_flyposition" id="preview2_right" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/flyout-right.PNG' ); ?>" alt="Right" />
        </div>
      </td>
    </tr>

    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Flyout Vertical Position", IEPA_TEXT_DOMAIN ); ?>
  		</td>
      <td>
        <select name='iepa_settings[flyout_settings][vertical-position]' class="imma_flyoutvposition">
          <option value='full-height' <?php echo selected( $flyoutverticalposition, 'full-height', false ); ?>>
            <?php esc_html_e( "Full Height", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='aligned-to-parent' <?php echo selected( $flyoutverticalposition, 'aligned-to-parent', false ); ?>>
            <?php esc_html_e( "Aligned to Parent", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr class="show_megamenu_flyvposition_type" style="display:none;">
      <td>
        <?php esc_html_e( 'Vertical Position Preview', IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <div class="imma_preview_flyvposition" id="preview3_full-height" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/flyout-vertical-full-height.PNG' ); ?>" alt="<?php esc_attr_e( 'Full Vertical Height Megamenu', IEPA_TEXT_DOMAIN ); ?>" />
        </div>
        <div class="imma_preview_flyvposition" id="preview3_aligned-to-parent" style="display:none;">
          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/mega_menu_images/flyout-vertical-alignedtoparent.PNG' ); ?>" alt="<?php esc_attr_e( 'Aligned to parent Vertical Menu', IEPA_TEXT_DOMAIN ); ?>" />
        </div>
      </td>
    </tr>

  </table>
</div>
