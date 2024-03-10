<?php
add_action('init', 'ive_get_posttype_field_details');
function ive_get_posttype_field_details() {
  $query = new WP_Query(array(
    'post_type' => 'ive_custom_fields',
    'post_status' => 'publish'
  ));
  $get_all_post_type = array();
  foreach ($query->posts as $key => $post) {
    $main_title = $post->post_title;
    $post_slug = $post->post_name. '_'. $post->ID;
    $key_1_values = get_post_meta($post->ID, 'custom_meta_select_field', true);
    array_push($get_all_post_type, $key_1_values);
    $getpost_type = get_post_meta($post->ID, 'custom_meta_select_field', true);
    $existing_array = get_post_meta($post->ID, 'custom_repeater_item', true);
    $post_slugs = str_replace('-', '_', $post_slug);
    if (!is_array($existing_array)) {
      continue;
    }
    // New key-value pair to be added
    $new_key = 'f_post_type';
    $new_value = $getpost_type;
    // Loop through the existing array and add the new key-value pair to each sub-array
    foreach ($existing_array as &$sub_array) {
      $sub_array[$new_key] = $new_value;
      $sub_array['main_title'] = $main_title;
      $sub_array['post_slug'] = $post_slugs;
    }
    // Update the entire $existing_array with the new key-value pair
    update_post_meta($post->ID, 'custom_repeater_item', $existing_array);
  }
  // Now, retrieve the combined data for all posts
  $get_all_data = array();
  foreach ($query->posts as $post) {
    $existing_array = get_post_meta($post->ID, 'custom_repeater_item', true);
    // Add the data for each post to the final array
    if (!is_array($existing_array)) {
      continue;
    }
    $get_all_data = array_merge($get_all_data, $existing_array);
  }
  $transformed_array = array();
  foreach ($get_all_data as $item) {
      $post_title = $item['main_title'];
      $post_slug = $item['post_slug'];
      $post_type = $item['f_post_type'];
  
      $field = array(
          'f_title' => $item['f_title'],
          'f_name' => $item['f_name'],
          'f_type' => $item['f_type'],
          'f_post_type' => $item['f_post_type']
      );
  
      $found = false;
      foreach ($transformed_array as &$post) {
          if ($post['post_title'] === $post_title && $post['post_slug'] === $post_slug && $post['post_type'] === $post_type) {
              $post['fields'][] = $field;
              $found = true;
              break;
          }
      }

      if (!$found) {
          $new_post = array(
              'post_title' => $post_title,
              'post_slug' => $post_slug,
              'post_type' => $post_type,
              'fields' => array($field)
          );
          $transformed_array[] = $new_post;
      }
  }
  return $transformed_array;
}

function ive_custom_text_field_meta_box($post) {
  $get_all_data = ive_get_posttype_field_details();
  foreach ($get_all_data as $data) {
    $post_type = $data['post_type'];
    $f_title = $data['post_title'];
    $post_slug = $data['post_slug'];
    $functionName = "ive_render_custom_text_field_" . $post_slug;
    // Define a dynamic function with a unique name
    $$functionName = function ($post) use ($post_slug, $data) {
        ive_render_custom_text_field($post, $data); // Assuming $post_slug is a field identifier
    };
    // Add meta box using the dynamic function as the callback
    add_meta_box(
        $functionName . '_meta_box', // Meta box ID (unique ID) for each post type
        $f_title, // Meta box title
        $$functionName, // Callback function to render the content
        $post_type, // Use the current post type from the loop
        'normal', // Context (normal, advanced, side)
        'high' // Priority (high, low)
    );
  
  }
}
add_action('add_meta_boxes', 'ive_custom_text_field_meta_box');// Callback function to render the content of the meta box


function ive_render_custom_text_field($post, $meta_data) {
  
  foreach ($meta_data['fields'] as $data) {
   
    if ($data['f_post_type'] == get_post_type($post)) {
     // is fields type text //
     if($data['f_type'] == 'text'){
      $f_name = $data['f_name'];
      $f_title = $data['f_title'];
      // Retrieve the current value of the text field
      $custom_text_value = get_post_meta($post->ID, $f_name, true);
      ?>
  <label for="custom-text-field"><?php esc_html_e($f_title . ': ', 'ibtana-visual-editor'); ?></label>
  <br>
  <input type="text" id="custom-text-field" name="<?php echo esc_attr($f_name);?>" value="<?php echo esc_attr($custom_text_value); ?>" style="width:90%;" />
  <br>
  <br>
  <?php
  }
   // is fields type checkbox //
   if($data['f_type'] == 'checkbox') {
    $f_name = $data['f_name'];
    $f_title = $data['f_title'];
    $value = get_post_meta($post->ID, $f_name, true);
  // Add a nonce field for security
  wp_nonce_field('custom_checkbox_field', 'custom_checkbox_field_nonce');
  // Output the checkbox input
  ?>
  <label for="custom_checkbox">
    <?php esc_html_e($f_title . ': ', 'ibtana-visual-editor'); ?>
      <input type="checkbox" name="<?php echo esc_attr($f_name);?>" id="<?php echo esc_attr($f_name);?>" value="1" <?php checked($value, 1); ?>>
  </label>
  <br>
  <?php
  }
     // is field type repeater start //
     if($data['f_type'] == 'repeater'){
      $f_name = $data['f_name'];
      $f_title = $data['f_title'];
      
      $custom_repeater_item = get_post_meta( $post->ID, $f_name, true );
    	wp_nonce_field( 'repeterBox', 'formType' );
    	?>

    	<table class="ive-wc-item-table" width="100%">
    		<tbody>
    			<?php
    			if( $custom_repeater_item ){
    				foreach( $custom_repeater_item as $item_key => $item_value ){?>
    					<tr class="ive-wc-sub-row">
    						<td>
    							<input name="<?php echo esc_attr($f_name.'[' .$item_key. '][title]');?>" type="text" value="<?php echo (isset($item_value['title'])) ? esc_attr($item_value['title']) : ''; ?>" style="width:98%;" placeholder="Heading">
    						</td>
    						<td>
    							<input type="text" name="<?php echo esc_attr($f_name.'[' .$item_key. '][desc]');?>" value="<?php echo (isset($item_value['desc'])) ? esc_attr($item_value['desc']) : ''; ?>" style="width:98%;" placeholder="Description"/>
    						</td>
    						<td>
    							<button class="ive-wc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'ibtana-visual-editor' );?></button>
    						</td>
    					</tr><?php
    				}
    			}
    			?>
          <br>
          <p> <?php esc_html_e($f_title . ': ', 'ibtana-visual-editor');?></p>
    			<tr class="ive-wc-hide-tr" style="display: none;">
    				<td>
    					<input name="ive_hide_custom_repeater_item[rand_no][title]" type="text" value=""  placeholder="Heading" style="width:98%;" >
    					<input class="ive-get-hidden-val" type="hidden" value="<?php echo esc_attr($f_name); ?>">
    				</td>
    				<td>
    					<input type="text" name="ive_hide_custom_repeater_item[rand_no][desc]" style="width:98%;" placeholder="Description"/>
    				</td>
    				<td>
    					<button class="ive-wc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'ibtana-visual-editor' );?></button>
    				</td>
    			</tr>
    		</tbody>
    		<tfoot>
    			<tr>
    				<td colspan="4"><button class="ive-wc-add-item button" type="button"><?php esc_html_e( 'Add another', 'ibtana-visual-editor' );?></button></td>
    			</tr>
    		</tfoot>
    	</table>
    	<?php
    }
    // is field type repeater end //
  }
  }
  
}
// Save the custom text field data when the post is saved/updated
function ive_save_custom_text_field($post_id) {
  $get_all_data = ive_get_posttype_field_details();
  foreach ($get_all_data as $datas) {
    foreach ($datas['fields'] as $data) {
        // is fields type text //
      if($data['f_type'] == 'text'){
        $f_name = $data['f_name'];
        // if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        // return;
          if (isset($_POST[$f_name])) {
            $custom_text = sanitize_text_field($_POST[$f_name]);
            update_post_meta($post_id, $f_name, $custom_text);
          }
      }
      // is fields type checkbox //
      if($data['f_type'] == 'checkbox'){
        $f_name = $data['f_name'];
        if (isset($_POST[$f_name])) {
            update_post_meta($post_id, $f_name, 1);
        } else {
            delete_post_meta($post_id, $f_name);
        }
      }

      // is fields type repeater //
      if($data['f_type'] == 'repeater'){
        $f_name = $data['f_name'];

        if ( ! defined( 'DOING_AUTOSAVE' ) ) {
          define( 'DOING_AUTOSAVE', true );
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
          return false;
        }

        if ( isset($_POST[$f_name]) ){

          $sanitized_array = array_map(function($item) {
            return array(
                'title' => sanitize_text_field($item['title']),
                'desc' => sanitize_text_field($item['desc'])
            );
          }, $_POST[$f_name]);
          
          update_post_meta( $post_id, $f_name, $sanitized_array );
        } else {
          update_post_meta( $post_id, $f_name, '' );
        }
      }
      // is fields type repeater end//

    }
  }
}
add_action('save_post', 'ive_save_custom_text_field');
?>