<div class="settings_title">
  <h2>
    <?php _e('Roles & Restriction Settings',IEPA_TEXT_DOMAIN);?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h2>
</div>

<div class="iepa_mega_settings">
  <?php
  $display_mode = ( isset( $iepammenu_item_meta['restriction_roles']['display_mode'] ) && $iepammenu_item_meta['restriction_roles']['display_mode'] != '' ) ? esc_attr( $iepammenu_item_meta['restriction_roles']['display_mode'] ) : 'show_to_all';
  ?>
  <table class="iepa-widefat">
    <caption>
      <p class="description">
        <?php esc_html_e( 'Choose roles or restriction from below to hide this menu item according to this settings.', IEPA_TEXT_DOMAIN ); ?>
      </p>
      <div class="clear"></div>
    </caption>
    <tr>
      <td class="imma_meta_table">
        <?php esc_html_e( "Menu Item Restriction", IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <select name='iepa_settings[restriction_roles][display_mode]' class="imma_display_mode">
          <option value='show_to_all' <?php echo selected( $display_mode, 'show_to_all', false ); ?>>
            <?php esc_html_e( "Show To All", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='logged_in_users' <?php echo selected( $display_mode, 'logged_in_users', false ); ?>>
            <?php esc_html_e( "Hide to Logged In Users", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='logged_out_users' <?php echo selected( $display_mode, 'logged_out_users', false ); ?>>
            <?php esc_html_e( "Hide to All Logged Out Users", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='all_users' <?php echo selected( $display_mode, 'all_users', false );?>>
            <?php esc_html_e( "All Users Except Administrator", IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value='by_role' <?php echo selected( $display_mode, 'by_role', false );?>>
            <?php esc_html_e( "By Role", IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
        <p class="description">
          <?php esc_html_e( 'Choose restriction options from above select options to hide this menu item.', IEPA_TEXT_DOMAIN ); ?>
        </p>
      </td>
    </tr>

    <tr class="imma-by-role">
      <td class="imma_meta_table">
        <?php esc_html_e( "Choose User Roles", IEPA_TEXT_DOMAIN ); ?>
      </td>
      <td>
        <?php global $wp_roles; ?>

        <?php
        foreach ( $wp_roles->roles as $key => $value ):
          $checked  = isset( $iepammenu_item_meta['restriction_roles']['roles_type'] ) && in_array( $key, $iepammenu_item_meta['restriction_roles']['roles_type'] ) ? esc_attr( "checked" ) : "";
          ?>
          <label for="roles_<?php echo esc_attr( $key ); ?>">
            <input type="checkbox" id="roles_<?php echo esc_attr( $key ); ?>" name="iepa_settings[restriction_roles][roles_type][]"
            value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked );?>
            />
            <?php echo esc_html( $value['name'] ); ?>
          </label>
          <br /><br />

          <?php
        endforeach;
        ?>

      </td>

    </tr>

  </table>
</div>
