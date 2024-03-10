<?php
  // post type start //
  function create_ive_custom_field_post_type() {
    $labels = array(
      'name' => 'IVE Custom Fields',
      'singular_name' => 'IVE Custom Fields',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Fields',
      'edit_item' => 'Edit Fields',
      'new_item' => 'New Fields',
      'view_item' => 'View Fields',
      'search_items' => 'Search',
      'not_found' => 'No Fields found',
      'not_found_in_trash' => 'No Fields found in Trash',
      'parent_item_colon' => '',
      'menu_name' => 'IVE Custom Fields'
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'ive_custom_fields' ),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array( 'title'),
      'menu_icon' => 'dashicons-schedule' // You can choose a different icon here
    );
    
    register_post_type( 'ive_custom_fields', $args );

    add_submenu_page(
      'admin.php?page=ibtana-visual-editor',
      'Fund Settings', /*page title*/
      'Settings', /*menu title*/
      'manage_options', /*roles and capabiliyt needed*/
      'wnm_fund_set',
      'create_ive_custom_field_post_type' /*replace with your own function*/
    );
  }
  add_action( 'init', 'create_ive_custom_field_post_type' );
  // post type end //
?>
