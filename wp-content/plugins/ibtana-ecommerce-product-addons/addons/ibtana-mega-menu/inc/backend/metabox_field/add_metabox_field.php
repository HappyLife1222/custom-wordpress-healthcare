<?php defined('ABSPATH') or die("No script kiddies please!");?>

<h2 class="iepammenu-header-option">
  <?php esc_html_e( "General Settings", IEPA_TEXT_DOMAIN ); ?>
</h2>

<table class="imma-settings-box">
  <tr>
    <td>
      <label for="iepammmegamenu_enabled_<?php echo esc_attr( $location ); ?>">
        <?php esc_html_e( "Enable", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="iepa-mm-switch">
        <input type="checkbox" class="iepammmegamenu_enabled" name="iepammmegamenu_meta[<?php echo esc_attr( $location ) ?>][enabled]"
        id="iepammmegamenu_enabled_<?php echo esc_attr( $location ); ?>" value='1' <?php checked( isset( $menu_general_settings[$location]['enabled'] ) ); ?> />
        <label for="iepammmegamenu_enabled_<?php echo esc_attr( $location ); ?>"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td>
      <label for="iepammmegamenu_hideicons_<?php echo esc_attr( $location ); ?>">
        <?php esc_html_e( "Hide All Icons?", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="iepa-mm-switch">
        <input type="checkbox" class="iepammmegamenu_enabled"
        name="iepammmegamenu_meta[<?php echo esc_attr( $location ) ?>][hide_all_icons]"
        id="iepammmegamenu_hideicons_<?php echo esc_attr( $location ); ?>" value="1" <?php checked( isset( $menu_general_settings[$location]['hide_all_icons'] ) ); ?> />
        <label for="iepammmegamenu_hideicons_<?php echo esc_attr( $location ); ?>"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td class='immamega-name'>
      <?php esc_html_e( "Orientation", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <td class='iepammmega-value'>
      <select name="iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][orientation]" class="select_fields_imma iepa-orientation">
        <option value='horizontal' <?php selected( isset( $menu_general_settings[$location]['orientation'] ) && $menu_general_settings[$location]['orientation'] == 'horizontal'); ?>>
          <?php esc_html_e( "Horizontal", IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='vertical' <?php selected( isset( $menu_general_settings[$location]['orientation'] ) && $menu_general_settings[$location]['orientation'] == 'vertical' ); ?>>
          <?php esc_html_e( "Vertical", IEPA_TEXT_DOMAIN ); ?>
        </option>
      </select>
    </td>
  </tr>

  <tr class="imma_show_valigntype" style="display:none;">
    <td class='immamega-name'>
      <?php esc_html_e( "Vertical Alignment Type", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <td class='iepammmega-value'>
      <select name='iepammmegamenu_meta[<?php echo esc_attr( $location ) ?>][vertical_alignment_type]' class="select_fields_imma">
        <option value='left' <?php selected( isset( $menu_general_settings[$location]['vertical_alignment_type'] ) && $menu_general_settings[$location]['vertical_alignment_type'] == 'left' ); ?>>
          <?php esc_html_e( "Left", IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='right' <?php selected( isset( $menu_general_settings[$location]['vertical_alignment_type'] ) && $menu_general_settings[$location]['vertical_alignment_type'] == 'right' ); ?>>
          <?php esc_html_e( "Right", IEPA_TEXT_DOMAIN ); ?>
        </option>
      </select>
    </td>
  </tr>

  <tr>
    <td class='immamega-name'>
      <?php esc_html_e( "Trigger Effect", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <td class='iepammmega-value'>
      <select name='iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][trigger_option]' class="select_fields_imma">
        <option value='onhover' <?php selected( isset( $menu_general_settings[$location]['trigger_option'] ) && $menu_general_settings[$location]['trigger_option'] == 'onhover' ); ?>>
          <?php esc_html_e( "Hover", IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='onclick' <?php selected( isset( $menu_general_settings[$location]['trigger_option'] ) && $menu_general_settings[$location]['trigger_option'] == 'onclick' ); ?>>
          <?php esc_html_e( "Click", IEPA_TEXT_DOMAIN ); ?>
        </option>
      </select>
    </td>
  </tr>

  <tr>
    <td class='immamega-name'>
      <?php esc_html_e( "Transition", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <td class='iepammmega-value'>
      <select name='iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][effect_option]' class="select_fields_imma">
        <option value='fade' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'fade' ); ?>>
          <?php esc_html_e( "Fade", IEPA_TEXT_DOMAIN ); ?>
        </option>
        <option value='slide' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide'); ?>>
          <?php esc_html_e("Slide Left", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='slide-left' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide-left'); ?>>
          <?php esc_html_e("Slide Right", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='slide-down' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide-down'); ?>>
          <?php esc_html_e("Slide Down", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='slide-up' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide-up'); ?>>
          <?php esc_html_e("Slide Up", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='slide-up-fade' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide-up-fade'); ?>>
          <?php esc_html_e("Slide Up With Fade", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='slide-down-fade' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'slide-down-fade'); ?>>
          <?php esc_html_e("Slide Down With Fade", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='super-slidedown' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'super-slidedown'); ?>>
          <?php esc_html_e("Super SlideDown", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='zoom-inout' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'zoom-inout'); ?>>
          <?php esc_html_e("Zoom In/Out", IEPA_TEXT_DOMAIN); ?>
        </option>
        <option value='flip-effect' <?php selected( isset( $menu_general_settings[$location]['effect_option'] ) && $menu_general_settings[$location]['effect_option'] == 'flip-effect'); ?>>
          <?php esc_html_e("Flip Effect", IEPA_TEXT_DOMAIN); ?>
        </option>
      </select>
    </td>
  </tr>

  <tr class="themetype">
    <td class="iepammmega-value">
      <?php esc_html_e( "Choose Theme Type", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <?php $available_skin_themes = get_option( 'iepa_mm_register_skin' ); ?>
    <td class="" id="iepammmega-value-type">
      <select name="iepammmegamenu_meta[<?php echo esc_attr($location); ?>][theme_type]" class="iepa_theme_type">
        <option value="available_skins" <?php selected( isset( $menu_general_settings[$location]['theme_type'] ) && $menu_general_settings[$location]['theme_type'] == 'available_skins' ); ?>>
          <?php esc_html_e('Available Skins',IEPA_TEXT_DOMAIN);?>
        </option>
        <option value="custom_themes" <?php selected( isset( $menu_general_settings[$location]['theme_type'] ) && $menu_general_settings[$location]['theme_type'] == 'custom_themes'); ?>>
          <?php esc_html_e('Custom Themes',IEPA_TEXT_DOMAIN);?>
        </option>
      </select>
    </td>
  </tr>

  <tr class="iepa_show_themes" style="display:none;">
    <td><?php esc_html_e("Custom Theme", IEPA_TEXT_DOMAIN); ?></td>
    <td>
      <?php
      $imma_theme_object = new IEPA_MM_Theme_Settings();
      $themes = $imma_theme_object->get_custom_theme_data('');
      ?>
      <select name='iepammmegamenu_meta[<?php echo esc_attr($location); ?>][theme]' class="select_fields_imma">
        <?php
        $selected_theme = isset( $menu_general_settings[$location]['theme'] ) ? $menu_general_settings[$location]['theme'] : 'default';
        foreach ( $themes as $key => $theme ) {
          $theme_id     = $theme->theme_id;
          $theme_title  = $theme->title;
          ?>
          <option value="<?php echo esc_attr( $theme_id ); ?>" <?php echo selected( $selected_theme, $theme_id ); ?>>
            <?php echo esc_html( $theme_title ); ?>
          </option>
          <?php
        }
        ?>
      </select>
    </td>
  </tr>


  <tr class="iepa_show_skins" style="display:none;">
    <td><?php esc_html_e( "Available Skins/Templates", IEPA_TEXT_DOMAIN ); ?></td>
    <td class="iepammmega-value">
      <?php
      $selected_skin = isset( $menu_general_settings[$location]['available_skin'] ) ? $menu_general_settings[$location]['available_skin'] : '';
      ?>
      <select name="iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][available_skin]" class="select_fields_imma">
        <optgroup label="Available Skins">
          <?php
          if( isset( $available_skin_themes ) && !empty( $available_skin_themes ) ) {
            foreach ( $available_skin_themes as $key => $value ) {
              ?>
              <option value="<?php echo esc_attr( $value['id'] ); ?>" <?php echo selected( $selected_skin, $value['id'] );?>>
                <?php esc_html_e( $value['title'], IEPA_TEXT_DOMAIN ); ?>
              </option>
              <?php
            }
          }
          ?>
        </optgroup>
        <optgroup label="Available Templates">
          <option value='simple-mm-template' <?php echo selected( $selected_skin, 'simple-mm-template' ); ?>>
            <?php esc_html_e( 'Simple Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='dark-orchid-mm-template' <?php echo selected( $selected_skin, 'dark-orchid-mm-template' ); ?>>
            <?php esc_html_e( 'Dark Orchid Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='modern-mm-template' <?php echo selected( $selected_skin, 'modern-mm-template' ); ?>>
            <?php esc_html_e( 'Modern Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='highlighted-border-mm-template' <?php echo selected( $selected_skin, 'highlighted-border-mm-template' ); ?>>
            <?php esc_html_e( 'Highlighted Border Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='advanced-magazine-mm-template' <?php echo selected( $selected_skin, 'advanced-magazine-mm-template' );?>>
            <?php esc_html_e( 'Advanced Magazine Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='sporty-mm-template' <?php echo selected( $selected_skin, 'sporty-mm-template' );?>>
            <?php esc_html_e( 'Advanced Sporty Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='unique-mm-template' <?php echo selected( $selected_skin, 'unique-mm-template' );?>>
            <?php esc_html_e( 'Unique Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='box-sized-mm-template' <?php echo selected( $selected_skin, 'box-sized-mm-template' );?>>
            <?php esc_html_e( 'Box Sized Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='mini-mm-template' <?php echo selected( $selected_skin, 'mini-mm-template' ); ?>>
            <?php esc_html_e( 'Mini Sized Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='orangebar-mm-template' <?php echo selected( $selected_skin, 'orangebar-mm-template' ); ?>>
            <?php esc_html_e( 'Orange Bar Mega Menu', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </optgroup>
      </select>
    </td>
  </tr>


  <?php
  $enabled_check  = ( isset( $menu_general_settings[$location]['enabled'] ) && $menu_general_settings[$location]['enabled'] == 1 ) ? 1 : 0;
  $theme_type     = ( isset( $menu_general_settings[$location]['theme_type'] ) && $menu_general_settings[$location]['theme_type'] == 'available_skins' ) ? 'available_skins' : 'custom_themes';
  // if($enabled_check == 1 && $theme_type == "available_skins" ){
  ?>
  <tr class="iepa_show_skins" style="display:none;">
    <td>
      <?php esc_html_e( "Customized Options", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <td>
      <span class="imma_available_custom button button-primary" data-enablemegamenu="<?php echo esc_attr( $enabled_check ); ?>" data-location="<?php echo esc_attr( $location ); ?>" data-templatetype="<?php echo esc_attr( $selected_skin ); ?>">
        <?php esc_html_e( "Click", IEPA_TEXT_DOMAIN ); ?>
      </span>
    </td>
  </tr>
  <?php
  // }
  ?>
</table>

<h2 class="iepammenu-header-option">
  <?php esc_html_e( "Mobile Settings", IEPA_TEXT_DOMAIN ); ?>
</h2>
<p class="description">
  <?php esc_html_e( 'Set above option for Mobile Menu for this menu location.', IEPA_TEXT_DOMAIN ); ?>
</p>

<table class="iepamegamenu-mm-mobile">

  <tr>
    <td>
      <label for="iepammmegamenu_mobile_mm_<?php echo esc_attr( $location ); ?>">
        <?php esc_html_e( "Enable Mega Menu On Mobile?", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="iepa-mm-switch">
        <input type="checkbox" class="iepammmegamenu_enabled" name="iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][enabled_on_mobile]"
        id="iepammmegamenu_mobile_mm_<?php echo esc_attr( $location ); ?>" value="1" <?php checked( isset( $menu_general_settings[$location]['enabled_on_mobile'] ) ); ?> />
        <label for="iepammmegamenu_mobile_mm_<?php echo esc_attr( $location ); ?>"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td>
      <label for="iepammmegamenu_hideiconmobile_mm_<?php echo esc_attr( $location ); ?>">
        <?php esc_html_e( "Hide All Icons On Mobile?", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="iepa-mm-switch">
        <input type="checkbox" class="iepammmegamenu_enabled" name="iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][hide_allicons_mobile]"
        id="iepammmegamenu_hideiconmobile_mm_<?php echo esc_attr( $location ); ?>" value="1" <?php checked( isset( $menu_general_settings[$location]['hide_allicons_mobile'] ) ); ?> />
        <label for="iepammmegamenu_hideiconmobile_mm_<?php echo esc_attr( $location ); ?>"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td class='immamega-name'>
      <?php esc_html_e( "Mobile Menu", IEPA_TEXT_DOMAIN ); ?>
    </td>
    <td class='iepammmega-value'>
      <?php $menus = get_registered_nav_menus(); ?>
      <select name="iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][mobile_menu_location]" class="iepammpro-menu-locations-lists">
        <?php  if ( count ( $menus ) ) {
          $selected_mobile_menu = isset( $menu_general_settings[$location]['mobile_menu_location'] ) ? $menu_general_settings[$location]['mobile_menu_location'] : '';
          foreach ( $menus as $location_key => $description ) { ?>
            <option value="<?php echo esc_attr( $location_key ); ?>" <?php echo selected( $selected_mobile_menu, $location_key ); ?>>
              <?php esc_html_e( $description, IEPA_TEXT_DOMAIN ); ?>
            </option>
          <?php }
        } ?>
      </select>

    </td>
  </tr>

  <tr>
    <td>
      <label for="iepammmegamenu_disable_toggle_<?php echo esc_attr( $location ); ?>">
        <?php esc_html_e( "Disable Menu Toggle?", IEPA_TEXT_DOMAIN ); ?>
      </label>
    </td>
    <td>
      <div class="iepa-mm-switch">
        <input type='checkbox' class='iepammmegamenu_enabled' name='iepammmegamenu_meta[<?php echo esc_attr( $location ); ?>][disabled_menu_toggle]'
        id="iepammmegamenu_disable_toggle_<?php echo esc_attr( $location ); ?>" value="1"
        <?php checked( isset( $menu_general_settings[$location]['disabled_menu_toggle'] ) ); ?> />
        <label for="iepammmegamenu_disable_toggle_<?php esc_attr( $location ); ?>"></label>
      </div>
    </td>
  </tr>

</table>

<p class="description">
  <?php esc_html_e( 'Disable this option for mobile if menu toggle is already exist from theme side.', IEPA_TEXT_DOMAIN ); ?>
</p>
