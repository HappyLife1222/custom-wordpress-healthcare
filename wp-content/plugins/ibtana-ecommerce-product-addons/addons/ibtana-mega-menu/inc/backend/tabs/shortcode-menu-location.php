<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<?php
  $menus = get_registered_nav_menus();
  $location_settings = new IEPA_MM_Menu_Settings();
?>

<div class="iepammmega_left_content_wrapper shortcode_menu_location iepa-accordion actively-open">

  <div class="iepa-accordion-header iepamega-shortcode">
    <span class="dashicons dashicons-shortcode"></span>
    <?php esc_html_e("Shortcodes", IEPA_TEXT_DOMAIN); ?>
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </div>

  <div class="form-style-2 iepammmega_left_contents iepa-accordion-content">
    <p class="description description-note">
      <?php esc_html_e( 'Note: You can use this plugin to display menu using below shortcode.', IEPA_TEXT_DOMAIN ); ?>
    </p>

    <table class="form-table">
      <tr>
        <td class="immamega-name">
          <label for="field1">
            <?php esc_html_e( 'Integrate Specific Theme Location', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <p class="description">
            <?php esc_html_e( 'Select a Theme Location below to generate the proper code below ', IEPA_TEXT_DOMAIN ); ?>
          </p>
        </td>
        <td class="iepammmega-value">
          <select class="menu_shortcode imma-selection">
            <?php
            if ( count ( $menus ) ) {
              foreach ( $menus as $location => $description ) {
                ?>
                <option value="<?php echo esc_attr( $location ); ?>">
                  <?php esc_html_e( $description, IEPA_TEXT_DOMAIN ); ?>
                </option>
                <?php
              }
            }
            ?>
          </select>
        </td>
      </tr>
    </table>
    <!-- <div class="clear"></div> -->

    <?php
    if ( count ( $menus ) ) {
      foreach ( $menus as $location => $description ) {
        $menu_id = $location_settings->imma_get_menu_id_for_location( $location );
        ?>
        <div class="iepamegamenu-integration-code" id="imma-integration-<?php echo esc_attr( $location ); ?>" style="display: none;">
          <table class="form-table">
            <tr>
              <td class="immamega-name">
                <div class="manual_intergration">
                  <?php esc_html_e('Manual Integration Code',IEPA_TEXT_DOMAIN);?>
                </div>
              </td>
              <td class="iepammmega-value">
                <div class="right_code">

                  <div class="menuname">
                    <p class="menu_name">
                      <?php esc_html_e( ucwords( $location ), IEPA_TEXT_DOMAIN );?>
                    </p>
                    <p class="location_name">
                      <?php esc_html_e( 'Menu Location Name: ', IEPA_TEXT_DOMAIN );?>
                      <?php esc_html_e( $description, IEPA_TEXT_DOMAIN ); ?>
                      <?php if( $menu_id != '' || $menu_id != 0 ) { ?>
                        <a href='<?php echo esc_url( admin_url( "nav-menus.php?action=edit&menu={$menu_id}" ) ); ?>'>
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          <?php esc_html_e( 'Edit',IEPA_TEXT_DOMAIN ); ?>
                        </a>
                      <?php } else { ?>
                        <br/>
                        <em>
                          <?php esc_html_e('(You havenot assigned this theme location with any menu.)',IEPA_TEXT_DOMAIN); ?>
                          <a href='<?php echo esc_url( admin_url( 'nav-menus.php?action=locations' ) );?>'>
                            <?php esc_html_e("Assign a menu", IEPA_TEXT_DOMAIN);?>
                          </a>
                        </em>
                      <?php } ?>
                    </p>
                  </div>

                  <div class="iepamegamenu-desc-row">
                    <code class="iepamegamenu-highlight-code">
                      <span class="iepamegamenu-code-snippet-type">
                        <?php esc_html_e( "PHP Function", IEPA_TEXT_DOMAIN ); ?>
                        <p class="description"> <?php esc_html_e( "For use in a theme template (usually header.php)", IEPA_TEXT_DOMAIN ); ?>
                        </p>
                      </span>
                      <span class="highlightcode" title="content">
                        <?php echo esc_html( "&lt;?php wp_nav_menu( array( 'theme_location' => '".$location."' ) ); ?&gt;" ); ?>
                      </span>
                    </code>
                  </div>

                  <div class="iepamegamenu-desc-row">
                    <code class="iepamegamenu-highlight-code">
                      <span class="iepamegamenu-code-snippet-type">
                        <?php esc_html_e( "Shortcode", IEPA_TEXT_DOMAIN ); ?>
                        <p class="description">
                          <?php esc_html_e( "Shortcodes for use in a post or page with specific menu location.", IEPA_TEXT_DOMAIN ); ?>
                        </p>
                      </span>
                      <span class="highlightcode">
                        <?php echo esc_html( '[iepamegamenu menu_location="'.$location.'"]' );  ?>
                      </span>
                    </code>
                  </div>

                  <div class="iepamegamenu-desc-row" style="display:none;">
                    <code class="iepamegamenu-highlight-code">
                      <span class="iepamegamenu-code-snippet-type">
                        <?php esc_html_e( "Widget", IEPA_TEXT_DOMAIN ); ?>
                        <p class="description">
                          <?php esc_html_e( "For Widget, add this shortcode in your widget area.", IEPA_TEXT_DOMAIN ); ?>
                        </p>
                      </span>
                      <span class="highlightcode">
                        <?php echo esc_html( '[iepamegamenu menu_location="'.$location.'"]' ); ?>
                      </span>
                    </code>
                  </div>

                </div>
              </td>
            </tr>
          </table>
        </div>
      <?php
      }
    }
    ?>
  </div>
</div>
<div class="clear"></div>
