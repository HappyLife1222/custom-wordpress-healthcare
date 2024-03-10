<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="iepammmega_left_content_wrapper iepa-accordion general_settings actively-open">

  <h4 class="iepamega-general iepa-accordion-header">
    <span class="dashicons dashicons-admin-generic"></span>
    <?php esc_html_e("General Settings", IEPA_TEXT_DOMAIN); ?>

    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>

  </h4>

  <table class="iepammmega_left_contents form-table iepa-accordion-content">
    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Event Behaviour", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Define what should happen when the event is set to 'click'. This also applies to mobiles.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <select name='advanced_click' class="imma-selection">
          <option value='click_submenu' <?php if( $advanced_click == "click_submenu" ) {echo esc_attr( "selected=selected" );} ?>>
            <?php esc_html_e( "Open Submenu on first click and close on second click.", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='follow_link' <?php if( $advanced_click == "follow_link" ) {echo esc_attr( "selected=selected" );} ?>>
            <?php esc_html_e("Open submenu on first click and follow link on second click.", IEPA_TEXT_DOMAIN); ?>
          </option>
        </select>
        <p class='description'></p>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Menu Label Animation Type", IEPA_TEXT_DOMAIN ); ?>
        <p class="description">
          <?php
          esc_html_e(
            'Choose default animation type for menu label such as Hot!, New!. Default is set as None which will disable animation. This field is necessary to set for overall menu label animation.',
            IEPA_TEXT_DOMAIN
          );
          ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <select name="mlabel_animation_type" class="imma-selection">
          <option value="none" <?php if( $mlabel_animation_type == "none" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'None', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="mybounce" <?php if( $mlabel_animation_type == "mybounce" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'Bounce', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="flash" <?php if( $mlabel_animation_type == "flash" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'Flash', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="shake" <?php if( $mlabel_animation_type == "shake" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'Shake', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="swing" <?php if( $mlabel_animation_type == "swing" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'Swing', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="tada" <?php if( $mlabel_animation_type == "tada" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'Tada',IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="bounceIn" <?php if($mlabel_animation_type == "bounceIn") { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'BounceIn', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="flipInX" <?php if( $mlabel_animation_type == "flipInX" ) { echo esc_attr( "selected=selected" ); } ?> >
            <?php esc_html_e( 'FlipInX',IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="flipInY" <?php if( $mlabel_animation_type == "flipInY" ) { echo esc_attr( "selected=selected" ); } ?> >
            <?php esc_html_e( 'FlipInY', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="slideInUp" <?php if( $mlabel_animation_type == "slideInUp" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'SlideInUp', IEPA_TEXT_DOMAIN );?>
          </option>
          <option value="slideInDown" <?php if( $mlabel_animation_type == "slideInDown" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( 'SlideInDown', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Animation Duration", IEPA_TEXT_DOMAIN ); ?>
        <p class="description">
          <?php esc_html_e( 'Choose the animation duration time in second. Default value set to 3s.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="number" value="<?php echo esc_attr( $animation_duration ); ?>" class="imma_mm_animation_duration" placeholder="1" name="animation_duration" />
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Animation Delay", IEPA_TEXT_DOMAIN ); ?>
        <p class="description">
          <?php esc_html_e( 'Choose the animation delay time in second.Default value set to 2s.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="number" value="<?php echo esc_attr( $animation_delay ); ?>" class="imma_mm_animation_delay" placeholder="1" name="animation_delay" />
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Animation Iteration Count", IEPA_TEXT_DOMAIN ); ?>
        <p class="description">
          <?php esc_html_e( 'Fill the animation Iteration count in number such as 2,3. You can also use "infinite" word instead of number which let the animation to repeat forever.', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <p class="description">
          <?php esc_html_e( 'The number of times the animation should repeat; this is 1 by default. Negative values are invalid. You may specify non-integer values to play part of an animation cycle (for example 0.5 will play half of the animation cycle).', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="text" value="<?php echo esc_attr( $animation_iteration_count ); ?>" class="imma_mm_animation_iteration_count"
          placeholder="<?php echo esc_attr( 'E.g., infinite,2,3,1,2.3' ); ?>" name="animation_iteration_count" />
      </td>
    </tr>

    <!-- woocommerce cart total display start -->
    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Woocommerce Cart Display", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Choose Woocommerce Cart Display type for menu replaced as woocommerce cart for each menu items.", IEPA_TEXT_DOMAIN ); ?>
          <br/>
          <?php esc_html_e( 'Set common settings for each menu for menu replacement settings.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <select name="choose_woo_cart_display" id="choose_woo_cart_display" class="imma-selection">
          <option value="icon_only"  <?php if($choose_woo_cart_display == "icon_only") { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e('Icon Only',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value="item_only"  <?php if($choose_woo_cart_display == "item_only") { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e('Icon & Items Only',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value="price_only"  <?php if($choose_woo_cart_display == "price_only") { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e('Icon & Price Only',IEPA_TEXT_DOMAIN);?>
          </option>
          <option value="both_pi"  <?php if($choose_woo_cart_display == "both_pi") { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e('Icon Both Price and Items',IEPA_TEXT_DOMAIN);?>
          </option>
        </select>
      </td>
    </tr>



    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Woocommerce Cart Display Layout", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( 'Note: Fill the type of layout you want to display for woocommerce cart on menu and use #tag method such as #price to display price and #item_count to display total icon count. You can fill any layout as you wanted such as #price(#item_count) which is display as $32(2) display type where 32 is total price and total item count is 2.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="text" name="cart_display_pattern" value="<?php echo esc_attr( $cart_display_pattern ); ?>" placeholder="#item_count items - #price" />
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <label for="enable_rtl"><?php esc_html_e("Enable RTL", IEPA_TEXT_DOMAIN); ?></label>
        <p class='description'>
          <?php esc_html_e("Enable or disable rtl for mega menu.", IEPA_TEXT_DOMAIN); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="enable_rtl" id="enable_rtl" value="1" <?php if( $enable_rtl  == 1 ) { echo esc_attr( "checked" ); } ?> />
        </div>
      </td>
    </tr>

  </table>

</div>

<div class="iepammmega_left_content_wrapper iepa-accordion general_settings actively-open">

  <h4 class="iepamega-mob iepa-accordion-header">
    <span class="dashicons dashicons-smartphone"></span>
    <?php esc_html_e( "Mobile Settings", IEPA_TEXT_DOMAIN ); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h4>

  <table class="iepammmega_left_contents form-table iepa-accordion-content">
    <tr>
      <td class='immamega-name'>
        <label for="enable_immenuaddon">
          <?php esc_html_e( "Enable Ibtana Mega Menu on Mobile", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Enable or disable submenu on mobile version.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="enable_mobile" id="enable_immenuaddon" value="1" <?php if( $enable_mobile  == 1 ) { echo esc_attr( "checked" ); } ?> />
        </div>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <label for="disable_submenu_retractor">
          <?php esc_html_e( "Disable Submenu Retractor", IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class='description'>
          <?php esc_html_e( "Check to disable submenu retractor close button at last of menu after toggle open on mobile version.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="iepa-mm-switch">
          <input type="checkbox" name="disable_submenu_retractor" id="disable_submenu_retractor" value="1" <?php if( $disable_submenu_retractor  == 1 ) { echo esc_attr( "checked" ); } ?> />
        </div>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Toggle Behavior", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Standard toggle will open sub menus even if another menu is clicked and accordion toggle will close opened submenus automatically when another one is open.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <select name='mobile_toggle_option' class="imma-selection">
          <option value='toggle_standard' <?php if( $mobile_toggle_option == "toggle_standard" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( "Standard", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='toggle_accordion' <?php if( $mobile_toggle_option == "toggle_accordion" ) { echo esc_attr( "selected=selected" ); } ?>>
            <?php esc_html_e( "Accordion", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Mobile Responsive Breakpoint", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Note: Set up responsive breakpoint for only pre available template. Default will always be 910px if left empty. Also for custom template, you need to setup from its specific template edit page in Mobile Responsive Toggle Section.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <input type="number" name="pre_responsive_bp" value="<?php echo esc_attr( $pre_responsive_bp ); ?>" placeholder="910" />
      </td>
    </tr>

    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Toggle Menu Close Icon", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Choose toggle close icon for responsive menubar.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="im-mega-toggle">
          <div class="toggle_menu_icons" id="close">
            <span class="dash-closedmenu"><i class="<?php echo esc_attr($close_menu_icon);?>"></i></span>
          </div>
          <input type="hidden" name="close_menu_icon" id="close_menu_icon" value="<?php echo esc_attr($close_menu_icon);?>"/>
          <div class="menulistsicons_close">
            <ul>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-menu"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-editor-justify"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-no"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-no-alt"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-arrow-up"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-arrow-up-alt"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons  dashicons-plus-alt"></i>
                </span>
              </li>
              <li class="imma-menuicon">
                <span id="select2-chosen-66" class="select2-chosen">
                  <i class="dashicons dashicons-arrow-down-alt2"></i>
                </span>
              </li>
            </ul>
          </div>
        </div>

      </td>
    </tr>


    <tr>
      <td class='immamega-name'>
        <?php esc_html_e( "Toggle Menu Open Icon", IEPA_TEXT_DOMAIN ); ?>
        <p class='description'>
          <?php esc_html_e( "Choose toggle open icon for responsive menubar.", IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
      <td class='iepammmega-value'>
        <div class="im-mega-toggle">
          <div class="toggle_menu_icons" id="open">
            <span class="dash-openmenu">
              <i class="<?php echo esc_attr( $open_menu_icon ); ?>"></i>
            </span>
          </div>
          <input type="hidden" name="open_menu_icon" id="open_menu_icon" value="<?php echo esc_attr( $open_menu_icon ); ?>"/>

          <div class="menulistsicons_open">
            <ul>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-menu"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-editor-justify"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-no"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-no-alt"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-arrow-up"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-arrow-up-alt"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons  dashicons-plus-alt"></i>
              </span>
            </li>
            <li class="imma-menuicon">
              <span id="select2-chosen-66" class="select2-chosen">
                <i class="dashicons dashicons-arrow-down-alt2"></i>
              </span>
            </li>
            </ul>
          </div>

        </div>


      </td>
    </tr>


  </table>

</div>
