<?php
  $action       = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : 'new';
  $tab          = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : '';
  $taxonomy_id  = isset( $_GET['taxonomy_id'] ) ? sanitize_text_field( $_GET['taxonomy_id'] ) : '';

  $args = array(
   'public'   => true
  );
  $output = 'names';

  $post_types = get_post_types( $args, $output );

  $taxonomy_name = $tax_plural_label = $tax_singular_label = $tax_menu_name = $tax_all_items = $tax_edit_item = $tax_view_item =
  $tax_view_item = $tax_update_item = $tax_new_item = $tax_new_item_name = $tax_parent_item = $tax_parent_item_colon = $tax_search_item = $tax_custom_rewrite_slug = '';

  $tax_attach_thumbnail = false;

  $custom_posttype_tax_options = get_option( 'icpa_tax_settings' );
  if ( $action == 'edit' && $tab == 'taxonomy_tab' && check_admin_referer( 'edit-taxonomy' ) ) {

    $taxonomy = $custom_posttype_tax_options[$taxonomy_id];

    $taxonomy_name            = isset($taxonomy['taxonomy_name']) ? $taxonomy['taxonomy_name'] : '';
    $tax_plural_label         = isset($taxonomy['tax_plural_label']) ? $taxonomy['tax_plural_label'] : '';
    $tax_singular_label       = isset($taxonomy['tax_singular_label']) ? $taxonomy['tax_singular_label'] : '';
    $tax_attach_thumbnail     = isset($taxonomy['tax_attach_thumbnail']) ? $taxonomy['tax_attach_thumbnail'] : false;
    $tax_menu_name            = isset($taxonomy['tax_menu_name']) ? $taxonomy['tax_menu_name'] : '';
    $tax_all_items            = isset($taxonomy['tax_all_items']) ? $taxonomy['tax_all_items'] : '';
    $tax_edit_item            = isset($taxonomy['tax_edit_item']) ? $taxonomy['tax_edit_item'] : '';
    $tax_view_item            = isset($taxonomy['tax_view_item']) ? $taxonomy['tax_view_item'] : '';
    $tax_update_item          = isset($taxonomy['tax_update_item']) ? $taxonomy['tax_update_item'] : '';
    $tax_new_item             = isset($taxonomy['tax_new_item']) ? $taxonomy['tax_new_item'] : '';
    $tax_new_item_name        = isset($taxonomy['tax_new_item_name']) ? $taxonomy['tax_new_item_name'] : '';
    $tax_parent_item          = isset($taxonomy['tax_parent_item']) ? $taxonomy['tax_parent_item'] : '';
    $tax_parent_item_colon    = isset($taxonomy['tax_parent_item_colon']) ? $taxonomy['tax_parent_item_colon'] : '';
    $tax_search_item          = isset($taxonomy['tax_search_item']) ? $taxonomy['tax_search_item'] : '';
    $tax_custom_rewrite_slug  = isset($taxonomy['tax_custom_rewrite_slug']) ? $taxonomy['tax_custom_rewrite_slug'] : '';
    $attach_posttype          = isset($taxonomy['posttype']) ? $taxonomy['posttype'] : [];
  } elseif ( ( $action == 'delete' ) && ( $tab == 'taxonomy_tab' ) && check_admin_referer( 'delete-taxonomy' ) ) {

    unset($custom_posttype_tax_options[$taxonomy_id]);
    $updated_options = array_values($custom_posttype_tax_options);
    update_option('icpa_tax_settings', $updated_options);
    wp_redirect(admin_url('admin.php?page=ibtana-custom-post-type&message=4&tab=taxonomy_tab'));
    exit();
  }

  if( isset( $_GET['message'] ) && $tab == 'taxonomy_tab' ) {

    if( $_GET['message'] == 1 ) { ?>
      <div class="notice notice-success is-dismissible icpa-notice-bar">
  			<p><?php esc_html_e('Taxonomy name is already registered.','ibtana-ecommerce-product-addons');?></p>
  		</div>
    <?php } elseif ( $_GET['message'] == 2 ) { ?>
        <div class="notice notice-success is-dismissible icpa-notice-bar">
    			<p><?php esc_html_e('Taxonomy added.','ibtana-ecommerce-product-addons');?></p>
    		</div>
    <?php } elseif ( $_GET['message'] == 3 ) { ?>
      <div class="notice notice-success is-dismissible icpa-notice-bar">
        <p><?php esc_html_e('Taxonomy updated.','ibtana-ecommerce-product-addons');?></p>
      </div>
    <?php } elseif ( $_GET['message'] == 4 ) { ?>
      <div class="notice notice-error is-dismissible icpa-notice-bar">
        <p><?php esc_html_e('Taxonomy deleted.','ibtana-ecommerce-product-addons');?></p>
      </div>
    <?php }
  }
?>
<div class="taxonomy-settings-parent-wrapper">
  <form id="custom-posttype-addon-taxonomy-form" class="custom-posttype-addon-taxonomy-form" method="post"
    action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
  >
    <input type="hidden" name="action" value="icpa_process_post_type" />
    <input type="hidden" name="taxonomy_id" value="<?php esc_attr_e( $taxonomy_id, 'ibtana-ecommerce-product-addons' ); ?>"/>
    <?php wp_nonce_field( 'icpa-nonce', 'icpa-nonce-setup' ); ?>
    <div class="iepa-accordion actively-open">
      <h4 class="iepa-accordion-header icpa-taxonomy-settings">
        <span class="dashicons dashicons-admin-generic"></span>
        <?php esc_html_e( 'Basic settings', 'ibtana-ecommerce-product-addons' ); ?>

        <span class="dashicons dashicons-arrow-up"></span>
        <span class="dashicons dashicons-arrow-down"></span>
      </h4>

      <div class="content-settings iepa-accordion-content">
        <div class="field_icpa_wrapper">
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="taxonomy_name"><?php esc_html_e( 'Taxonomy Slug', 'ibtana-ecommerce-product-addons' ); ?></label>
              <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="taxonomy_name" name="taxonomy_name"
                value="<?php esc_attr_e( $taxonomy_name, 'ibtana-ecommerce-product-addons' ); ?>"
                <?php echo esc_attr( ( $taxonomy_name !== '' ) ? 'disabled' : '' ) ?> required
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'The taxonomy name/slug. Used for various queries for taxonomy content.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
              <p class="icpa-slug-details">
                <?php
                esc_html_e(
                  'Slugs should only contain alphanumeric, latin characters. Underscores should be used in place of spaces. Set "Custom Rewrite Slug" field to make slug use dashes for URLs.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_plural_label"><?php esc_html_e( 'Plural Label', 'ibtana-ecommerce-product-addons' ); ?></label>
              <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_plural_label" name="tax_plural_label"
                placeholder="<?php esc_attr_e( '(e.g. Actors)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_plural_label, 'ibtana-ecommerce-product-addons' ); ?>" required
              >
              <p class="icpa-field-description description"><?php esc_html_e( 'Used for the taxonomy admin menu item.', 'ibtana-ecommerce-product-addons' ); ?></p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_singular_label"><?php esc_html_e( 'Singular Label', 'ibtana-ecommerce-product-addons' ); ?></label>
              <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_singular_label" name="tax_singular_label"
                placeholder="<?php esc_attr_e( '(e.g. Actor)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_singular_label, 'ibtana-ecommerce-product-addons' ); ?>" required
              >
              <p class="icpa-field-description description">
                <?php esc_html_e( 'Used when a singular label is needed.', 'ibtana-ecommerce-product-addons' ); ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="singular_label"><?php esc_html_e( 'Attach to Post Type', 'ibtana-ecommerce-product-addons' ); ?></label>
              <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
            </div>
            <div class="field_input_icpa">
              <?php
              foreach ($post_types as $value) {

                  $selected_posttype = isset($attach_posttype[$value]) ? $attach_posttype[$value] : 'off';

                  ?>
                  <div class="checkbox_posttype">
                    <input type="checkbox" id="<?php esc_attr_e( $value, 'ibtana-ecommerce-product-addons' ); ?>"
                      name="posttype[<?php echo esc_attr( $value ); ?>]"
                      <?php echo esc_attr( ( $selected_posttype == 'on' ) ? 'checked' : '' ); ?>
                    >
                    <label for="<?php esc_attr_e( $value, 'ibtana-ecommerce-product-addons' ); ?>">
                      <?php esc_html_e( ucfirst( $value ) ); ?>
                    </label>
                  </div>
              <?php } ?>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_attach_thumbnail">
                <?php esc_html_e( 'Taxonomy Thumbnail', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="checkbox" id="tax_attach_thumbnail" name="tax_attach_thumbnail"
                <?php echo esc_attr( ( $tax_attach_thumbnail == true ) ? 'checked' : '' ); ?>
              >
              <label for="tax_attach_thumbnail"><?php esc_html_e( 'On/Off', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="iepa-accordion actively-open">
      <h4 class="iepa-accordion-header icpa-taxonomy-settings">
        <span class="dashicons dashicons-category"></span>
        <?php esc_html_e( 'Additional Label', 'ibtana-ecommerce-product-addons' ); ?>

        <span class="dashicons dashicons-arrow-up"></span>
        <span class="dashicons dashicons-arrow-down"></span>
      </h4>

      <div class="content-settings iepa-accordion-content">
        <div class="field_icpa_wrapper">
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_menu_name"><?php esc_html_e( 'Menu Name', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_menu_name" name="tax_menu_name"
                placeholder="<?php esc_attr_e( '(e.g. Actors)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_menu_name, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php esc_html_e( 'Custom admin menu name for your taxonomy.', 'ibtana-ecommerce-product-addons' ); ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_all_items">
                <?php esc_html_e( 'All Items', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_all_items" name="tax_all_items"
                placeholder="<?php esc_attr_e( '(e.g. All Actors)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_all_items, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Used as tab text when showing all terms for hierarchical taxonomy while editing post.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_edit_item"><?php esc_html_e( 'Edit Item', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_edit_item" name="tax_edit_item"
                placeholder="<?php esc_attr_e( '(e.g. Edit Actor)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_edit_item, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Used at the top of the term editor screen for an existing taxonomy term.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_view_item"><?php esc_html_e( 'View Item', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_view_item" name="tax_view_item"
                placeholder="<?php esc_html_e( '(e.g. View Actor)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_view_item, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Used in the admin bar when viewing editor screen for an existing taxonomy term.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_update_item">
                <?php esc_html_e( 'Update Item Name', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_update_item" name="tax_update_item"
                placeholder="<?php esc_attr_e( '(e.g. Update Actor Name)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_update_item, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Custom taxonomy label. Used in the admin menu for displaying taxonomies.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_new_item"><?php esc_html_e( 'Add New Item', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_new_item" name="tax_new_item"
                placeholder="<?php esc_attr_e( '(e.g. Add New Actor)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_new_item, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Used at the top of the term editor screen and button text for a new taxonomy term.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_new_item_name">
                <?php esc_html_e( 'New Item Name', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_new_item_name" name="tax_new_item_name"
                placeholder="<?php esc_attr_e( '(e.g. New Actor Name)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_new_item_name, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Used at the top of the term editor screen and button text for a new taxonomy term.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_parent_item">
                <?php esc_html_e( 'Parent Item', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_parent_item" name="tax_parent_item"
                placeholder="<?php esc_attr_e( '(e.g. Parent Actor)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_parent_item, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Custom taxonomy label. Used in the admin menu for displaying taxonomies.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_parent_item_colon">
                <?php esc_html_e( 'Parent Item Colon', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_parent_item_colon" name="tax_parent_item_colon"
                placeholder="<?php esc_attr_e( '(e.g. Parent Actor:)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_parent_item_colon, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Custom taxonomy label. Used in the admin menu for displaying taxonomies.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_search_item"><?php esc_html_e( 'Search Items', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_search_item" name="tax_search_item"
                placeholder="<?php esc_attr_e( '(e.g. Search Actors)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_search_item, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  'Custom taxonomy label. Used in the admin menu for displaying taxonomies.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="iepa-accordion actively-open">
      <h4 class="iepa-accordion-header icpa-taxonomy-settings">
        <span class="dashicons dashicons-admin-settings"></span>
        <?php esc_html_e( 'Settings', 'ibtana-ecommerce-product-addons' ); ?>

        <span class="dashicons dashicons-arrow-up"></span>
        <span class="dashicons dashicons-arrow-down"></span>
      </h4>

      <div class="iepa-accordion-content content-settings">
        <div class="field_icpa_wrapper">
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_public"><?php esc_html_e( 'Public', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_public">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_public'] ) && $taxonomy['tax_public'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_public'] ) && $taxonomy['tax_public'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: true) Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_public_query"><?php esc_html_e( 'Public Queryable', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_public_query">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_public_query'] ) && $taxonomy['tax_public_query'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_public_query'] ) && $taxonomy['tax_public_query'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: value of "public" setting) Whether or not the taxonomy should be publicly queryable.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_hierarchical"><?php esc_html_e( 'Hierarchical', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_hierarchical">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_hierarchical'] ) && $taxonomy['tax_hierarchical'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_hierarchical'] ) && $taxonomy['tax_hierarchical'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: false) Whether the taxonomy can have parent-child relationships.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_show_ui">
                <?php esc_html_e( 'Show UI', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_show_ui">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_show_ui'] ) && $taxonomy['tax_show_ui'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_show_ui'] ) && $taxonomy['tax_show_ui'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: true) Whether to generate a default UI for managing this custom taxonomy.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_show_in_menu"><?php esc_html_e( 'Show in menu', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_show_in_menu">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_show_in_menu'] ) && $taxonomy['tax_show_in_menu'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_show_in_menu'] ) && $taxonomy['tax_show_in_menu'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: value of show_ui) Whether to show the taxonomy in the admin menu.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_query_var">
                <?php esc_html_e( 'Query Var', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_query_var">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_query_var'] ) && $taxonomy['tax_query_var'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_query_var'] ) && $taxonomy['tax_query_var'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php esc_html_e( '(default: true) Sets the query_var key for this taxonomy.', 'ibtana-ecommerce-product-addons' ); ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_rewrite">
                <?php esc_html_e( 'Rewrite', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_rewrite">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_rewrite'] ) && $taxonomy['tax_rewrite'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_rewrite'] ) && $taxonomy['tax_rewrite'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: true) Whether or not WordPress should use rewrites for this taxonomy.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_custom_rewrite_slug">
                <?php esc_html_e( 'Custom Rewrite Slug', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <input type="text" id="tax_custom_rewrite_slug" name="tax_custom_rewrite_slug"
                placeholder="<?php esc_attr_e( '(default: taxonomy name)', 'ibtana-ecommerce-product-addons' ); ?>"
                value="<?php esc_attr_e( $tax_custom_rewrite_slug, 'ibtana-ecommerce-product-addons' ); ?>"
              >
              <p class="icpa-field-description description">
                <?php esc_html_e( 'Custom taxonomy rewrite slug.', 'ibtana-ecommerce-product-addons' ); ?>
              </p>
            </div>
          </div>
          <div class="field_icpa">
            <div class="field_label_icpa">
              <label for="tax_show_admin_column">
                <?php esc_html_e( 'Show Admin Column', 'ibtana-ecommerce-product-addons' ); ?>
              </label>
            </div>
            <div class="field_input_icpa">
              <select name="tax_show_admin_column">
                <option value="true" <?php echo esc_attr( ( isset( $taxonomy['tax_show_admin_column'] ) && $taxonomy['tax_show_admin_column'] == 'true' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'True', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
                <option value="false" <?php echo esc_attr( ( isset( $taxonomy['tax_show_admin_column'] ) && $taxonomy['tax_show_admin_column'] == 'false' ) ? 'selected' : '' ); ?>>
                  <?php esc_html_e( 'False', 'ibtana-ecommerce-product-addons' ); ?>
                </option>
              </select>
              <p class="icpa-field-description description">
                <?php
                esc_html_e(
                  '(default: false) Whether to allow automatic creation of taxonomy columns on associated post-types.',
                  'ibtana-ecommerce-product-addons'
                );
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if ( $action == 'edit' && $tab == 'taxonomy_tab' ) { ?>
      <input type="submit" class="button-primary icpa_update_taxonomy" name="icpa_submit"
        value="<?php esc_attr_e( 'Update Taxonomy', 'ibtana-ecommerce-product-addons' ); ?>"
      />
      <a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-custom-post-type&tab=taxonomy_tab' ) ); ?>"
        class="button-secondary"
      >
        <?php esc_html_e( 'Cancel', 'ibtana-ecommerce-product-addons' ); ?>
      </a>
    <?php } else { ?>
      <input type="submit" class="button-primary icpa_add_taxonomy" name="icpa_submit"
        value="<?php esc_attr_e( 'Add Taxonomy', 'ibtana-ecommerce-product-addons' ); ?>"
      />
    <?php } ?>
  </form>
</div>
