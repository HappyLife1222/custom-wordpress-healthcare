<?php
$action       = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : 'new';
$tab          = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : '';
$posttype_id  = isset( $_GET['posttype_id'] ) ? sanitize_text_field( $_GET['posttype_id'] ) : '';

$posttype_name = $plural_label = $singular_label = '';
$is_display = $support_title = $support_editor = $support_author = $support_thumbnail =
$support_excerpt = $support_custom_fields = $support_comments = $support_revisions = $support_page_attributes = $support_post_formats = false;

if ( ( $action == 'edit' ) && ( $tab == 'posttype_tab' ) && check_admin_referer( 'edit-post' ) ) {
  $custom_posttype_options  = get_option('icpa_settings');
  $single_option            = $custom_posttype_options[$posttype_id];

  $posttype_name            = $single_option['posttype_name'];
  $plural_label             = $single_option['plural_label'];
  $singular_label           = $single_option['singular_label'];
  $is_display               = $single_option['is_display'];
  $support_title            = ( isset($single_option['support']['title']) && $single_option['support']['title'] == 'on') ? true : false;
  $support_editor           = ( isset($single_option['support']['editor']) && $single_option['support']['editor'] == 'on') ? true : false;
  $support_author           = ( isset($single_option['support']['author']) && $single_option['support']['author'] == 'on') ? true : false;
  $support_thumbnail        = ( isset($single_option['support']['thumbnail']) && $single_option['support']['thumbnail'] == 'on') ? true : false;
  $support_excerpt          = ( isset($single_option['support']['excerpt']) && $single_option['support']['excerpt'] == 'on') ? true : false;
  $support_custom_fields    = ( isset($single_option['support']['custom-fields']) && $single_option['support']['custom-fields'] == 'on') ? true : false;
  $support_comments         = ( isset($single_option['support']['comments']) && $single_option['support']['comments'] == 'on') ? true : false;
  $support_revisions        = ( isset($single_option['support']['revisions']) && $single_option['support']['revisions'] == 'on') ? true : false;
  $support_page_attributes  = ( isset($single_option['support']['page-attributes']) && $single_option['support']['page-attributes'] == 'on') ? true : false;
  $support_post_formats     = ( isset($single_option['support']['post-formats']) && $single_option['support']['post-formats'] == 'on') ? true : false;
} elseif ( ( $action == 'delete' ) && ( $tab == 'posttype_tab' ) && check_admin_referer( 'trash-post' ) ) {
  $custom_posttype_options = get_option('icpa_settings');
  unset($custom_posttype_options[$posttype_id]);
  $updated_options = array_values($custom_posttype_options);
  update_option('icpa_settings', $updated_options);
  wp_redirect(admin_url('admin.php?page=ibtana-custom-post-type&message=4&tab=posttype_tab'));
  exit();
}

if( isset( $_GET['message'] ) && $tab == 'posttype_tab' ) {
  if( $_GET['message'] == 1 ) { ?>
    <div class="notice notice-success is-dismissible icpa-notice-bar">
			<p><?php esc_html_e('Posttype name is already registered.','ibtana-ecommerce-product-addons');?></p>
		</div>
  <?php } elseif ( $_GET['message'] == 2 ) { ?>
      <div class="notice notice-success is-dismissible icpa-notice-bar">
  			<p><?php esc_html_e('Posttype added.','ibtana-ecommerce-product-addons');?></p>
  		</div>
  <?php } elseif ( $_GET['message'] == 3 ) { ?>
    <div class="notice notice-success is-dismissible icpa-notice-bar">
      <p><?php esc_html_e('Posttype updated.','ibtana-ecommerce-product-addons');?></p>
    </div>
  <?php } elseif ( $_GET['message'] == 4 ) { ?>
    <div class="notice notice-error is-dismissible icpa-notice-bar">
      <p><?php esc_html_e('Posttype deleted.','ibtana-ecommerce-product-addons');?></p>
    </div>
  <?php }
}
?>

<div class="iepa-accordion actively-open">
  <h4 class="iepa-accordion-header">
    <span class="dashicons dashicons-admin-generic"></span>
    <?php esc_html_e( 'Basic settings', 'ibtana-ecommerce-product-addons' ); ?>

    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
  </h4>

  <div class="content-settings iepa-accordion-content">
    <form class="custom-posttype-addon-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
      <input type="hidden" name="action" value="icpa_process_post_type" />
      <input type="hidden" name="posttype_id" value="<?php echo esc_attr( $posttype_id ); ?>"/>
      <?php wp_nonce_field( 'icpa-nonce', 'icpa-nonce-setup' ); ?>
      <div class="field_icpa_wrapper">
        <div class="field_icpa">
          <div class="field_label_icpa">
            <label for="posttype_name"><?php esc_html_e( 'Post Type Slug', 'ibtana-ecommerce-product-addons' ); ?></label>
            <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
          </div>
          <div class="field_input_icpa">
            <input type="text" id="posttype_name" name="posttype_name" maxlength="20"
            value="<?php esc_attr_e( $posttype_name, 'ibtana-ecommerce-product-addons' ); ?>" <?php echo esc_attr( $posttype_name !== '' ? 'disabled' : '' ) ?> required>
            <p class="icpa-field-description description"><?php esc_html_e( 'The post type name/slug. Used for various queries for post type content.', 'ibtana-ecommerce-product-addons' ); ?></p>
            <p class="icpa-slug-details"><?php esc_html_e( 'Slugs should only contain alphanumeric, latin characters. Underscores should be used in place of spaces. Set "Custom Rewrite Slug" field to make slug use dashes for URLs.', 'ibtana-ecommerce-product-addons' ); ?></p>
          </div>
        </div>
        <div class="field_icpa">
          <div class="field_label_icpa">
            <label for="plural_label"><?php esc_html_e( 'Plural Label', 'ibtana-ecommerce-product-addons' ); ?></label>
            <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
          </div>
          <div class="field_input_icpa">
            <input type="text" id="plural_label" name="plural_label"
              placeholder="<?php esc_attr_e( '(e.g. Movies)', 'ibtana-ecommerce-product-addons' ); ?>"
              value="<?php esc_attr_e( $plural_label, 'ibtana-ecommerce-product-addons' ); ?>" required
            >
            <p class="icpa-field-description description">
              <?php esc_html_e( 'Used for the post type admin menu item.', 'ibtana-ecommerce-product-addons' ); ?>
            </p>
          </div>
        </div>
        <div class="field_icpa">
          <div class="field_label_icpa">
            <label for="singular_label"><?php esc_html_e( 'Singular Label', 'ibtana-ecommerce-product-addons' ); ?></label>
            <span class="required"><?php esc_html_e( '*', 'ibtana-ecommerce-product-addons' ); ?></span>
          </div>
          <div class="field_input_icpa">
            <input type="text" id="singular_label" name="singular_label"
              placeholder="<?php esc_attr_e( '(e.g. Movie)', 'ibtana-ecommerce-product-addons' ); ?>"
              value="<?php esc_attr_e( $singular_label, 'ibtana-ecommerce-product-addons' ); ?>" required
            >
            <p class="icpa-field-description description">
              <?php esc_html_e( 'Used when a singular label is needed.', 'ibtana-ecommerce-product-addons' ); ?>
            </p>
          </div>
        </div>
        <div class="field_icpa">
          <div class="field_label_icpa">
            <label for="is_display"><?php esc_html_e( 'Display', 'ibtana-ecommerce-product-addons' ); ?></label>
          </div>
          <div class="field_input_icpa">
            <div class="checkbox_support">
              <input type="checkbox" id="is_display" name="is_display" <?php echo esc_attr( ( $is_display == true ) ? 'checked' : '' ) ; ?>>
              <label for="is_display"><?php esc_html_e( 'On/Off', 'ibtana-ecommerce-product-addons' ); ?></label>
            </div>
          </div>
        </div>
        <div class="field_icpa">
          <div class="field_label_icpa">
            <span><?php esc_html_e( 'Support', 'ibtana-ecommerce-product-addons' ); ?></span>
          </div>
          <div class="field_input_icpa">
              <div class="checkbox_support">
                <input type="checkbox" id="title_support" name="support[title]" <?php echo esc_attr( ( $support_title ) ? 'checked' : '' ) ; ?>>
                <label for="title_support"><?php esc_html_e( 'Title', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="editor_support" name="support[editor]" <?php echo esc_attr( ( $support_editor == true ) ? 'checked' : '' ) ; ?>>
                <label for="editor_support"><?php esc_html_e( 'Editor', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="fea_img_support" name="support[thumbnail]" <?php echo esc_attr( ( $support_thumbnail == true ) ? 'checked' : '' ) ; ?>>
                <label for="fea_img_support"><?php esc_html_e( 'Featured Image', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="excerpt_support" name="support[excerpt]" <?php echo esc_attr( ( $support_excerpt == true ) ? 'checked' : '' ); ?>>
                <label for="excerpt_support"><?php esc_html_e( 'Excerpt', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="custom_field_support" name="support[custom-fields]" <?php echo esc_attr( ( $support_custom_fields == true ) ? 'checked' : '' ) ; ?>>
                <label for="custom_field_support"><?php esc_html_e( 'Custom Fields', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="comments_support" name="support[comments]" <?php echo esc_attr( ( $support_comments == true ) ? 'checked' : '' ) ; ?>>
                <label for="comments_support"><?php esc_html_e( 'Comments', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="revision_support" name="support[revisions]" <?php echo esc_attr( ( $support_revisions == true ) ? 'checked' : '' ); ?>>
                <label for="revision_support"><?php esc_html_e( 'Revisions', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="author_support" name="support[author]" <?php echo esc_attr( ( $support_author == true ) ? 'checked' : '' ); ?>>
                <label for="author_support"><?php esc_html_e( 'Author', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="page_attr_support" name="support[page-attributes]" <?php echo esc_attr( ( $support_page_attributes == true ) ? 'checked' : '' ) ; ?>>
                <label for="page_attr_support"><?php esc_html_e( 'Page Attributes', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
              <div class="checkbox_support">
                <input type="checkbox" id="post_format_support" name="support[post-formats]" <?php echo esc_attr( ( $support_post_formats == true ) ? 'checked' : '' ) ; ?>>
                <label for="post_format_support"><?php esc_html_e( 'Post Formats', 'ibtana-ecommerce-product-addons' ); ?></label>
              </div>
          </div>
        </div>
        <?php if ( $action == 'edit' && $tab == 'posttype_tab') { ?>
          <input type="submit" class="button-primary" name="icpa_submit" value="<?php esc_attr_e( 'Update Post Type', 'ibtana-ecommerce-product-addons' ); ?>" />
          <a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-custom-post-type&tab=posttype_tab' ) ) ?>" class="button-secondary">
            <?php esc_html_e( 'Cancel', 'ibtana-ecommerce-product-addons' ); ?>
          </a>
        <?php } else { ?>
          <input type="submit" class="button-primary" name="icpa_submit" value="<?php esc_attr_e( 'Add Post Type', 'ibtana-ecommerce-product-addons' ); ?>" />
        <?php } ?>
      </div>
    </form>
  </div>
</div>
