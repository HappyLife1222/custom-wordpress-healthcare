<?php
// enqueue admin css for ive custom fields start //
function enqueue_admin_styles() {
    // wp_register_style('ive-custom-fields', plugin_dir_url(__FILE__) . 'assets/ive-cf-admin.css', array(), '1.0.0', 'all');
    // wp_enqueue_style('ive-custom-fields');
    wp_enqueue_script('ive-custom-js', plugin_dir_url(__FILE__) . 'assets/ive-admin-custom.js', array('jquery'), '1.0.0', true);

}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');
// enqueue admin css for ive custom fields end //

// meta create custom fields start //
  add_action( 'admin_init', 'ive_single_rapater_meta_boxes', 2 );
  function ive_single_rapater_meta_boxes() {
    add_meta_box( 'ive-single-repeater-data', 'Create Fields', 'ive_single_repeatable_meta_box_callback', 'ive_custom_fields', 'normal', 'default');
  }

  function ive_single_repeatable_meta_box_callback( $post ) {
    $custom_repeater_item = get_post_meta( $post->ID, 'custom_repeater_item', true );
    wp_nonce_field( 'repeterBox', 'formType', 'custom_repeater_item_nonce' );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($){
      jQuery(document).on('click', '.wc-remove-item', function() {
        jQuery(this).parents('tr.wc-sub-row').remove();
      });
      jQuery(document).on('click', '.wc-add-item', function() {
        var row_no = jQuery('.wc-item-table tr.wc-sub-row').length;
        var p_this = jQuery(this);
        row_no = parseFloat(row_no);
        var row_html = jQuery('.wc-item-table .wc-hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_custom_repeater_item/g, 'custom_repeater_item');
        jQuery('.wc-item-table tbody').append('<tr class="wc-sub-row">' + row_html + '</div>');
      });
    });
  </script>
  <table class="wc-item-table" width="100%">
    <tbody>
      <?php
      if( $custom_repeater_item ){
        foreach( $custom_repeater_item as $item_key => $item_value ){
          ?>
          <tr class="wc-sub-row">
            <td>
              <p><?php esc_html_e( 'Title:', 'ibtana-visual-editor' );?></p>
              <input name="<?php echo esc_attr('custom_repeater_item['.$item_key.'][f_title]'); ?>" type="text" value="<?php echo (isset($item_value['f_title'])) ? esc_attr($item_value['f_title']) : ''; ?>" style="width:98%;" placeholder="Title" required>
            </td>
            <td>
              <p><?php esc_html_e( 'Name:', 'ibtana-visual-editor' );?></p>
              <input name="<?php echo esc_attr('custom_repeater_item['.$item_key.'][f_name]'); ?>" type="text" value="<?php echo (isset($item_value['f_name'])) ? esc_attr($item_value['f_name']) : ''; ?>" style="width:98%;" placeholder="Name" required>
            </td>
            <td>
              <p><?php esc_html_e( 'Type:', 'ibtana-visual-editor' );?></p>
              <?php
              // Assuming $item_key and $item_value are already defined or fetched from somewhere
              $selected_value = isset($item_value['f_type']) ? $item_value['f_type'] : '';
              ?>
              <select name="custom_repeater_item[<?php echo $item_key; ?>][f_type]" style="width:98%;">
                <option value="text" <?php echo ($selected_value === 'text') ? 'selected' : ''; ?>><?php esc_html_e( 'Text', 'ibtana-visual-editor' );?></option>
                <option value="repeater" <?php echo ($selected_value === 'repeater') ? 'selected' : ''; ?>><?php esc_html_e( 'Repeater', 'ibtana-visual-editor' );?></option>
                <option value="checkbox" <?php echo ($selected_value === 'checkbox') ? 'selected' : ''; ?>><?php esc_html_e( 'Checkbox', 'ibtana-visual-editor' );?></option>
              </select>
            </td>
            <td>
              <button class="wc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'ibtana-visual-editor' );?></button>
            </td>
          </tr>
          <?php
        }
      }
      ?>
      <tr class="wc-hide-tr" style="display: none;">
        <td>
          <p><?php esc_html_e( 'Title:', 'ibtana-visual-editor' );?></p>
          <input name="hide_custom_repeater_item[rand_no][f_title]" type="text" value=""  placeholder="Field Title" style="width:98%;">
        </td>
        <td>
          <p><?php esc_html_e( 'Name:', 'ibtana-visual-editor' );?></p>
          <input name="hide_custom_repeater_item[rand_no][f_name]" type="text" value=""  placeholder="Field Name" style="width:98%;">
        </td>
        <td>
          <p><?php esc_html_e( 'Type:', 'ibtana-visual-editor' );?></p>
          <select name="hide_custom_repeater_item[rand_no][f_type]" style="width:98%;">
            <option value="text"><?php esc_html_e( 'Text', 'ibtana-visual-editor' );?></option>
            <option value="select"><?php esc_html_e( 'Repeater', 'ibtana-visual-editor' );?></option>
            <option value="checkbox"><?php esc_html_e( 'Checkbox', 'ibtana-visual-editor' );?></option>
          </select>
        </td>
        <td>
					<button class="wc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'ibtana-visual-editor' );?></button>
				</td>
			</tr>
		</tbody>
    <tfoot>
      <tr>
        <td colspan="4"><button class="wc-add-item button" type="button"><?php esc_html_e( 'Add field', 'ibtana-visual-editor' );?></button></td>
      </tr>
    </tfoot>
  </table>
  <?php
}

add_action( 'save_post', 'ive_single_repeatable_meta_box_save' );
function ive_single_repeatable_meta_box_save( $post_id ) {

  if ( !isset( $_POST['formType'] ) || !wp_verify_nonce( $_POST['formType'], 'repeterBox' ) ){
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  if ( !current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  if ( isset($_POST['custom_repeater_item']) ){
    update_post_meta( $post_id, 'custom_repeater_item', $_POST['custom_repeater_item'] );
  } else {
    update_post_meta( $post_id, 'custom_repeater_item', '' );
  }
}
// meta create custom fields end //
