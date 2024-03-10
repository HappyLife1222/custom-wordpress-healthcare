<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$choose_menu_type = ( isset( $iepammenu_item_meta['mega_menu_settings']['choose_menu_type'] ) && $iepammenu_item_meta['mega_menu_settings']['choose_menu_type'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['choose_menu_type'] ) : 'default';
?>
<div class="settings_title">
  <h2>
    <?php esc_html_e( 'Menu Replacement Settings',IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>

<div class="iepa_mega_settings">
  <table class="iepa-widefat">
    <tr>
      <td class="imma_meta_table">
        <label for="enable_search_form">
          <?php esc_html_e( "Choose Replacement", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <select name="iepa_settings[mega_menu_settings][choose_menu_type]" id="imma_choose_menu_type">
          <option value="default" <?php echo selected( $choose_menu_type, 'default', false ); ?>>
            <?php esc_html_e( 'Default', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="search_type" <?php echo selected( $choose_menu_type, 'search_type', false ); ?>>
            <?php esc_html_e( 'Search Type', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="logo_image" <?php echo selected( $choose_menu_type, 'logo_image', false ); ?>>
            <?php esc_html_e( 'Logo Image', IEPA_TEXT_DOMAIN ); ?>
          </option>

          <?php if( IEPA_MM_Libary::is_woocommerce_activated() ) { ?>
            <option value="woo_cart_total" <?php echo selected( $choose_menu_type, 'woo_cart_total', false ); ?>>
              <?php esc_html_e( 'Woocommerce Cart Total', IEPA_TEXT_DOMAIN ); ?>
            </option>
          <?php } ?>

          <option value="login_form" <?php echo selected( $choose_menu_type, 'login_form', false ); ?>>
            <?php esc_html_e( 'Login Form', IEPA_TEXT_DOMAIN ); ?>
          </option>

          <option value="register_form" <?php echo selected( $choose_menu_type, 'register_form', false ); ?>>
            <?php esc_html_e( 'Register Form', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>

        <p class="description">
          <?php esc_html_e( 'Note: Choose replacement instead of default menu setup such as for search type, logo image display on menu bar.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>

    <tr class="toggle_search_form">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Custom Content", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <textarea name='iepa_settings[mega_menu_settings][custom_content]' cols="40" rows="2" placeholder="<?php esc_attr_e( 'Paste Shortcode here', IEPA_TEXT_DOMAIN ); ?>">
          <?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['custom_content'] ) && $iepammenu_item_meta['mega_menu_settings']['custom_content'] != '' ) ? esc_textarea( $iepammenu_item_meta['mega_menu_settings']['custom_content'] ) : ''; ?>
        </textarea>
        <p class="description">
          <?php esc_html_e( 'Use Shortcode for search menu as', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          <?php esc_html_e( 'Inline Search Toggle Left: [im_menuaddon_search_form template_type="inline-search" style="inline-toggle-left"]', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          <?php esc_html_e( 'Inline toggle to Right search form: [im_menuaddon_search_form template_type="inline-search" style="inline-toggle-right"]', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          <?php esc_html_e( 'Popup Search Form: [im_menuaddon_search_form template_type="popup-search-form"]', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          <?php esc_html_e( 'Display Search form on MegaMenu On hover/click : [im_menuaddon_search_form template_type="megamenu-type-search"]', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>

    <!-- Logo Image display start -->
    <tr class="toggle_logo_image" id="logo_image">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Choose Logo Image", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <div class="imma-option-field">
          <input type="hidden" class="imma-logo-url" name="iepa_settings[mega_menu_settings][logo_image]"
          value="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['logo_image'] ) && $iepammenu_item_meta['mega_menu_settings']['logo_image'] != '' ) ? esc_url( $iepammenu_item_meta['mega_menu_settings']['logo_image'] ) : ''; ?>" />
          <input type="button" class="imma_logo_url_button button button-primary button-large" id="logo_image" name="imma_logo_url_button"
          value="<?php esc_attr_e( 'Upload Logo Image', IEPA_TEXT_DOMAIN ) ?>" size="25" />
          <?php
          $img_url  = ( isset( $iepammenu_item_meta['mega_menu_settings']['logo_image'] ) && $iepammenu_item_meta['mega_menu_settings']['logo_image'] != '' ) ? esc_url( $iepammenu_item_meta['mega_menu_settings']['logo_image'] ) : '';
          ?>
          <div class="imma-option-field imma-image-preview2 <?php if( $img_url == '' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
            <a class="remove_logo_image" href="#">
              <i class="dashicons dashicons-trash"></i>
            </a>
            <img style="width: 100%;" class="imma-logo-image"
            src="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['logo_image'] ) && $iepammenu_item_meta['mega_menu_settings']['logo_image'] != '' ) ? esc_url( $iepammenu_item_meta['mega_menu_settings']['logo_image'] ) : ''; ?>"
            alt="">
          </div>
        </div>
      </td>
    </tr>

    <tr class="toggle_logo_image">
      <td>
        <label>
          <?php esc_html_e( "Custom Width/Height", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <input type="number" placeholder="E.g., 40" class="imma-custom-width custom-logo-size"
        name="iepa_settings[mega_menu_settings][custom_width]"
        value="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['custom_width'] ) && $iepammenu_item_meta['mega_menu_settings']['custom_width'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['custom_width'] ) : ''; ?>" />
        <label><?php esc_html_e( "Width(px)", IEPA_TEXT_DOMAIN ); ?></label>
  	    <input type="number" placeholder="E.g., 40" class="imma-custom-height custom-logo-size"
        name="iepa_settings[mega_menu_settings][custom_height]"
  	    value="<?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['custom_height'] ) && $iepammenu_item_meta['mega_menu_settings']['custom_height'] != '' ) ? esc_attr( $iepammenu_item_meta['mega_menu_settings']['custom_height'] ) : ''; ?>" />
        <label><?php esc_html_e( "Height(px)", IEPA_TEXT_DOMAIN ); ?></label>
        <p class="description">
          <?php esc_html_e( 'Define logo image custom width/height in px.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>
    <!-- Logo Image display End -->


    <tr class="toggle_login_form">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Login Form Shortcode", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
      <td>
        <textarea name='iepa_settings[mega_menu_settings][login_form_shortcode]' cols="40" rows="2" placeholder="<?php esc_attr_e( 'Paste Shortcode here', IEPA_TEXT_DOMAIN ); ?>">
          <?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['login_form_shortcode'] ) && $iepammenu_item_meta['mega_menu_settings']['login_form_shortcode'] != '' ) ? esc_html( $iepammenu_item_meta['mega_menu_settings']['login_form_shortcode'] ) : ''; ?>
        </textarea>
        <p class="description">
          <?php esc_html_e( 'Use Our Default Login form Shortcode or any other external login custom shortcode for user login form on popup modal', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          [im_menuaddon_login_form]
        </p>
      </td>
    </tr>

    <tr class="toggle_register_form">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Register Form Shortcode", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
  	  <td>
        <textarea name='iepa_settings[mega_menu_settings][register_form_shortcode]' cols="40" rows="2" placeholder="<?php esc_attr_e( 'Paste Shortcode here', IEPA_TEXT_DOMAIN ); ?>">
          <?php echo ( isset( $iepammenu_item_meta['mega_menu_settings']['register_form_shortcode'] ) && $iepammenu_item_meta['mega_menu_settings']['register_form_shortcode'] != '' ) ? esc_textarea( $iepammenu_item_meta['mega_menu_settings']['register_form_shortcode'] ) : ''; ?>
        </textarea>
        <p class="description">
          <?php esc_html_e( 'Use Our Default Register form Shortcode or any other external register custom shortcode for user register form on popup modal', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          [im_menuaddon_register_form]
        </p>
      </td>
    </tr>

    <tr class="toggle_fpassword_form">
      <td class="imma_meta_table">
        <label>
          <?php esc_html_e( "Forgot Password Form Shortcode", IEPA_TEXT_DOMAIN ); ?>
        </label>
      </td>
  	  <td>
  	  </td>
    </tr>

  </table>
</div>
