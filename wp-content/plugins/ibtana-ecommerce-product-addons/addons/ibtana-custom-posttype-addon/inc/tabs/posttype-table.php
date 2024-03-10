<div class="iepa-accordion actively-open">
  <h4 class="iepa-accordion-header">
    <span class="dashicons dashicons-editor-table"></span>
    <?php esc_html_e( 'Registered Posttypes', 'ibtana-ecommerce-product-addons' ); ?>

    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h4>
  <div class="content-settings iepa-accordion-content">

    <?php
    $custom_posttype_options = get_option( 'icpa_settings' );
    ?>

    <div class="">
      <table class="table widefat">
        <thead>
          <tr>
            <th><?php esc_html_e( 'Sr No', 'ibtana-ecommerce-product-addons' ); ?></th>
            <th><?php esc_html_e( 'Posttype Slug', 'ibtana-ecommerce-product-addons' ); ?></th>
            <th><?php esc_html_e( 'Plural Label', 'ibtana-ecommerce-product-addons' ); ?></th>
            <th><?php esc_html_e( 'Singular Label', 'ibtana-ecommerce-product-addons' ); ?></th>
            <th><?php esc_html_e( 'Support', 'ibtana-ecommerce-product-addons' ); ?></th>
            <th><?php esc_html_e( 'Visibility', 'ibtana-ecommerce-product-addons' ); ?></th>
            <th><?php esc_html_e( 'Action', 'ibtana-ecommerce-product-addons' ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($custom_posttype_options) {
              foreach ($custom_posttype_options as $key => $posttype) {

                $supports = implode(', ', array_map(
                    function ($v, $k) {
                      return sprintf("%s", $k, $v);
                    },
                    $posttype['support'],
                    array_keys($posttype['support'])
                ));

                $is_display = $posttype['is_display'];
                ?>
                <tr>
                  <td><?php esc_html_e( $key + 1 ); ?></td>
                  <td><?php esc_html_e( $posttype['posttype_name'], 'ibtana-ecommerce-product-addons' ); ?></td>
                  <td><?php esc_html_e( $posttype['plural_label'], 'ibtana-ecommerce-product-addons' ); ?></td>
                  <td><?php esc_html_e( $posttype['singular_label'], 'ibtana-ecommerce-product-addons' ); ?></td>
                  <td><?php esc_html_e( strtoupper( $supports ) ); ?></td>
                  <td><?php $is_display ? esc_html_e( 'Visible' , 'ibtana-ecommerce-product-addons' ) : esc_html_e( 'Hide' , 'ibtana-ecommerce-product-addons' ); ?></td>
                  <td>
                    <span>
                      <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ibtana-custom-post-type&action=edit&tab=posttype_tab&posttype_id=' . $key ), 'edit-post' ) ); ?>" class="edit_btn">
                        <?php esc_html_e( 'Edit', 'ibtana-ecommerce-product-addons' ); ?>
                      </a> /
                      <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ibtana-custom-post-type&tab=posttype_tab&action=delete&posttype_id=' . $key ), 'trash-post' ) ); ?>" class="delete_btn" onclick="return confirm('Are you sure you want to delete it..')">
                        <?php esc_html_e( 'Delete', 'ibtana-ecommerce-product-addons' ); ?>
                      </a>
                    </span>
                  </td>
                </tr>
              <?php }
            }else{ ?>
              <tr>
                <td class="no_posttype" colspan="7">
                  <?php esc_html_e( 'No Posttypes Found..', 'ibtana-ecommerce-product-addons' ); ?>
                </td>
              </tr>
            <?php }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
