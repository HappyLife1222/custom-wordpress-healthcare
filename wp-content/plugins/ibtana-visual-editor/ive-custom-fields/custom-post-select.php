<?php
  function custom_meta_box_callback($post) {
    $postss = get_post_types();

    $get_all_post_type = array();
    foreach ($postss as $key => $value) {
      array_push($get_all_post_type, $value);
    }

    $remove_unwated_posttype = array(
      'attachment',
      'revision',
      'nav_menu_item',
      'custom_css',
      'customize_changeset',
      'oembed_cache',
      'user_request',
      'wp_block',
      'wp_template',
      'wp_template_part',
      'wp_global_styles',
      'wp_navigation',
      'ibtana_template',
      'ive_custom_fields'
    );

    // Remove 'post' and 'page' from $get_all_post_type
    $get_all_post_type = array_diff($get_all_post_type, $remove_unwated_posttype);
    $options = array(); // Initialize the options array outside the loop

    foreach ($get_all_post_type as $key => $valusse) {
      // Add each value as a separate option
      $options[$valusse] = $valusse;
    }
    // Add your select field options here
    // Retrieve the current value of the meta field (if it exists)
    $selected_value = get_post_meta($post->ID, 'custom_meta_select_field', true);
    // Output the select field HTML
    ?>
    <label for="custom-meta-select-field"><?php esc_html_e('Select Post Type:', 'ibtana-visual-editor'); ?></label>
    <select name="custom_meta_select_field" id="custom-meta-select-field">
      <?php foreach ($options as $value => $label) { ?>
        <option value="<?php echo esc_attr($value); ?>" <?php selected($selected_value, $value); ?>>
          <?php echo esc_html($label); ?>
        </option>
      <?php } ?>
    </select>
    <?php
  }

function ive_add_custom_meta_boxs() {
  add_meta_box(
    'ive-custom-meta-boxs',
    'Post Type',
    'custom_meta_box_callback',
    'ive_custom_fields', // You can change this to other post types if needed
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'ive_add_custom_meta_boxs');

function ive_save_custom_meta_data($post_id) {

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  if (!current_user_can('edit_post', $post_id)) return;

  if (isset($_POST['custom_meta_select_field'])) {

    $selected_value = sanitize_text_field($_POST['custom_meta_select_field']);
    update_post_meta($post_id, 'custom_meta_select_field', $selected_value);
    
  }
}
add_action('save_post', 'ive_save_custom_meta_data');
?>
