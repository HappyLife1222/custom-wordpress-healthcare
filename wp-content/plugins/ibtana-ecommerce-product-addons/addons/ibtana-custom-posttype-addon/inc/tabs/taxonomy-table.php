<div class="taxonomy-settings-parent-wrapper taxonomy-view-parent">
  <div class="iepa-accordion actively-open">
    <h4 class="iepa-accordion-header icpa-taxonomy-settings">
      <span class="dashicons dashicons-editor-table"></span>
      <?php esc_html_e( 'Registered Taxonomies', 'ibtana-ecommerce-product-addons' ); ?>

      <span class="dashicons dashicons-arrow-up"></span>
      <span class="dashicons dashicons-arrow-down"></span>
    </h4>
    <div class="iepa-accordion-content content-settings">
      <?php
      $custom_posttype_tax_options = get_option('icpa_tax_settings');
      ?>
      <div class="">
        <table class="table widefat">
          <thead>
            <tr>
              <th><?php esc_html_e( 'Sr No', 'ibtana-ecommerce-product-addons' ); ?></th>
              <th><?php esc_html_e( 'Taxonomy Slug', 'ibtana-ecommerce-product-addons' ); ?></th>
              <th><?php esc_html_e( 'Plural Label', 'ibtana-ecommerce-product-addons' ); ?></th>
              <th><?php esc_html_e( 'Singular Label', 'ibtana-ecommerce-product-addons' ); ?></th>
              <th><?php esc_html_e( 'Posttype', 'ibtana-ecommerce-product-addons' ); ?></th>
              <th><?php esc_html_e( 'Action', 'ibtana-ecommerce-product-addons' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
              if ($custom_posttype_tax_options) {

                foreach ($custom_posttype_tax_options as $key => $taxonomy) {

                  $posttype = 'N/A';
                  if ( gettype($taxonomy['posttype'] == 'array') && !empty( $taxonomy['posttype'] ) ) {
                    $posttype = implode(', ', array_map(
                      function ($v, $k) {
                        return sprintf("%s", $k, $v);
                      },
                      $taxonomy['posttype'],
                      array_keys($taxonomy['posttype'])
                    ));
                  }

                  ?>
                  <tr>
                    <td><?php esc_html_e( $key + 1 ); ?></td>
                    <td><?php esc_html_e( $taxonomy['taxonomy_name'] ); ?></td>
                    <td><?php esc_html_e( $taxonomy['tax_plural_label'] ); ?></td>
                    <td><?php esc_html_e( $taxonomy['tax_singular_label'] ); ?></td>
                    <td><?php esc_html_e( strtoupper( $posttype ) ); ?></td>
                    <td>
                      <span>
                        <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ibtana-custom-post-type&action=edit&tab=taxonomy_tab&taxonomy_id=' . $key ), 'edit-taxonomy' ) ); ?>"
                          class="edit_btn">
                          <?php esc_html_e( 'Edit', 'ibtana-ecommerce-product-addons' ); ?>
                        </a> /
                        <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ibtana-custom-post-type&action=delete&tab=taxonomy_tab&taxonomy_id=' . $key ), 'delete-taxonomy' ) ); ?>"
                          class="delete_btn" onclick="return confirm('Are you sure you want to delete it..')">
                          <?php esc_html_e( 'Delete', 'ibtana-ecommerce-product-addons' ); ?>
                        </a>
                      </span>
                    </td>
                  </tr>
                <?php }

              }else{ ?>
                <tr>
                  <td class="no_posttype" colspan="7">
                    <?php esc_html_e( 'No Taxonomies Found..', 'ibtana-ecommerce-product-addons' ); ?>
                  </td>
                </tr>
              <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
