<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="iepammmega_left_content_wrapper general_settings iepa-accordion actively-open">

  <div class="iepamega-sticky iepa-accordion-header">
    <span class="dashicons dashicons-sticky"></span>
    <?php esc_html_e( "Sticky Settings", IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </div>

  <table class="form-table iepa-accordion-content">
    <tr>
      <td class='immamega-name'>
        <label for="activestickymenu">
          <?php esc_html_e( "Enable Sticky Menu", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Enable Sticky Menu for specific theme location.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="active_sticky_menu" id="activestickymenu" value="1" <?php if( $activestickymenu == 1 ) { echo esc_attr( "checked=checked" ); } ?> />
        </div>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Choose Theme Location", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Here choose theme location on which you want sticky menu on page scroll.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <?php $menus = get_registered_nav_menus(); ?>

      <td class='iepammmega-value'>
        <select name='sticky_theme_location' class="imma-selection">
          <option value=""  <?php if( $sticky_theme_location == "" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( '--Select Theme Location--', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <?php
          if ( count ( $menus ) ) {
            foreach ( $menus as $location => $description ) {
              ?>
              <option value="<?php echo esc_attr( $location ); ?>" <?php if( $sticky_theme_location ==  $location ) { echo esc_attr( "selected=selected" ); } ?>>
                <?php esc_html_e( $description, IEPA_TEXT_DOMAIN ); ?>
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
        <label for="sticky_on_mobile">
          <?php esc_html_e( "Enable Sticky Menu On Mobile", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Enable Sticky Menu on Mobile.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="sticky_on_mobile" id="sticky_on_mobile" value="1" <?php if( $sticky_on_mobile == 1 ) { echo esc_attr( "checked=checked" ); } ?> />
        </div>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <label for="stickyopacity">
          <?php esc_html_e( "Sticky Opacity", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Important Note: Assign Sticky Opacity to 1 to show menu on page scroll. If value is set to 0 then the menu will be hidden on page scroll.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="text" name="sticky_opacity" id="stickyopacity" value="<?php echo esc_attr( $sticky_opacity ); ?>" placeholder="1" />
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <label for="stickyzindex">
          <?php esc_html_e( "Sticky Zindex", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Assign Sticky Zindex.Default value set to 999.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="text" name="sticky_zindex" id="stickyzindex" value="<?php echo esc_attr( $sticky_zindex ); ?>" placeholder="999" />
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <label for="sticky_offset">
          <?php esc_html_e( "Sticky Offset", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Assign Sticky Offset.Default value set to 0px.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="text" name="sticky_offset" id="sticky_offset" placeholder="0px" value="<?php echo esc_attr( $sticky_offset ); ?>" />
      </td>
    </tr>



  </table>

</div>
