<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="iepammmega_left_content_wrapper custom_css iepa-accordion actively-open">

  <div class="iepamega-css iepa-accordion-header">
    <span class="dashicons dashicons-welcome-write-blog"></span>
    <?php esc_html_e( "Custom CSS", IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </div>

  <div class="iepa-accordion-content">
    <table class="form-table">
      <tr>
        <td class='immamega-name'>
          <label for="enable_custom_css">
            <?php esc_html_e( 'Enable Custom CSS', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <p class="description">
            <?php esc_html_e( 'Enable Custom CSS and add css below to override any theme or plugin css code.', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
        <td class='iepammmega-value'>
          <div class="iepa-mm-switch">
            <input type="checkbox" name="enable_custom_css" id="enable_custom_css" value="1" <?php if( $enable_custom_css  == 1 ) { echo esc_attr("checked"); } ?>/>
            <label for="enable_custom_css"></label>
          </div>
          <p class="description">
            <?php esc_html_e( 'Do you want to enable below custom css?', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>
    </table>

    <textarea name="custom_css" id="imma_custom_css" class="imma_custom large-text code" dir="ltr"><?php echo esc_textarea( $custom_css ); ?></textarea>

    <p class="description description-note">
      <?php esc_html_e( 'Please write your custom css here that you want to be included for ibtana mega menu.', IEPA_TEXT_DOMAIN ); ?>
    </p>
  </div>

</div>

<div class="custom_css iepammmega_left_content_wrapper iepa-accordion actively-open">

  <div class="iepamega-css iepa-accordion-header">
    <span class="dashicons dashicons-welcome-write-blog"></span>
    <?php esc_html_e( "Custom JS", IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </div>

  <div class="iepa-accordion-content">
    <table class="form-table">
      <tr>
        <td class='immamega-name'>
          <label for="enable_custom_js">
            <?php esc_html_e( 'Enable Custom JS', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <p class="description">
            <?php esc_html_e( 'Enable Custom JS and add javascript below.', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
        <td class='iepammmega-value'>
          <div class="iepa-mm-switch">
            <input type="checkbox" name="enable_custom_js" id="enable_custom_js" value="1" <?php if( $enable_custom_js  == 1 ) { echo esc_attr( "checked" ); } ?>/>
            <label for="enable_custom_js"></label>
          </div>
          <p class="description">
            <?php esc_html_e( 'Do you want to enable below custom js?', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
      </tr>
    </table>

    <textarea name="custom_js" id="iepa_mm_custom_js" class="imma_custom large-text code" dir="ltr"><?php echo esc_textarea( $custom_js ); ?></textarea>

    <p class="description description-note">
      <?php esc_html_e( 'Please write your custom js here that you want to be included for ibtana mega menu.', IEPA_TEXT_DOMAIN ); ?>
    </p>

    <code class="iepamegamenu-highlight-code iepamegamenu-highlight-js-code clear">
      <span class="iepamegamenu-code-snippet-type"><?php esc_html_e( 'Starting JS Method', IEPA_TEXT_DOMAIN ); ?>
        <p class="description">
          <?php esc_html_e( 'Copy below js code and paste it in above textarea. You can add your custom js code inside it.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </span>
      <span class="highlightcode">
        <?php echo esc_html( 'jQuery(function ($) {
          /* Add your custom javascript code here*/
        });' ); ?>
      </span>
    </code>
    <div class="clear"></div>
  </div>


</div>
