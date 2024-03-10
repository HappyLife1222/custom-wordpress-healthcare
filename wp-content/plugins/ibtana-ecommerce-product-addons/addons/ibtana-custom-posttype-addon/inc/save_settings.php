<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/**
 * Posttype Data
 *
 */
$icpa_settings_option = '';

$message_id = 0;

$option_name = $tab_name = '';

if ( $_POST['icpa_submit'] == __( 'Add Post Type', 'ibtana-ecommerce-product-addons' ) ) {
  $icpa_settings_option = get_option( 'icpa_settings' );
  $icpa_posttype_arr = array(
    'posttype_name'     =>  sanitize_text_field( $_POST['posttype_name'] ),
    'plural_label'      =>  sanitize_text_field( $_POST['plural_label'] ),
    'singular_label'    =>  sanitize_text_field( $_POST['singular_label'] ),
    'support'           =>  isset( $_POST['support'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['support'] ) ) : [],
    'is_display'        =>  isset( $_POST['is_display'] ) ? true : false
  );

  if ($icpa_settings_option) {
    foreach ($icpa_settings_option as $value) {
      if( $value['posttype_name'] === $_POST['posttype_name'] ) {
        return wp_redirect( admin_url( 'admin.php?page=ibtana-custom-post-type&message=1&tab=posttype_tab' ) );
      }
      break;
    }
    array_push($icpa_settings_option, $icpa_posttype_arr);
  }else{
    $icpa_settings_option = [];
    array_push($icpa_settings_option, $icpa_posttype_arr);
  }

  $message_id = 2;
  $tab_name = 'posttype_tab';
  $option_name = 'icpa_settings';

} else if ( $_POST['icpa_submit'] == __( 'Update Post Type', 'ibtana-ecommerce-product-addons' ) ) {
  $icpa_settings_option = get_option('icpa_settings');

  $posttype_id = sanitize_text_field( $_POST['posttype_id'] );

  foreach ($icpa_settings_option as $key => $option) {

    if ($key == $posttype_id) {
      $icpa_settings_option[$key]['plural_label']   = sanitize_text_field( $_POST['plural_label'] );
      $icpa_settings_option[$key]['singular_label'] = sanitize_text_field( $_POST['singular_label'] );
      $icpa_settings_option[$key]['support']        = isset( $_POST['support'] ) ? IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['support'] ) ) : [];
      $icpa_settings_option[$key]['is_display']     = isset( $_POST['is_display'] ) ? true : false;
      $message_id = 3;
      $tab_name = 'posttype_tab';
      break;
    }
  }
  $option_name = 'icpa_settings';
} else if ( $_POST['icpa_submit'] == __( 'Add Taxonomy', 'ibtana-ecommerce-product-addons' ) ) {

  $icpa_settings_option = get_option('icpa_tax_settings');

  $icpa_taxonomy_arr = array(
    'taxonomy_name'           =>  sanitize_text_field( $_POST['taxonomy_name'] ),
    'tax_plural_label'        =>  sanitize_text_field( $_POST['tax_plural_label'] ),
    'tax_singular_label'      =>  sanitize_text_field( $_POST['tax_singular_label'] ),
    'posttype'                =>  IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['posttype'] ) ),
    'tax_attach_thumbnail'    =>  isset( $_POST['tax_attach_thumbnail'] ) ? sanitize_text_field( $_POST['tax_attach_thumbnail'] ) : false,
    'tax_menu_name'           =>  sanitize_text_field( $_POST['tax_menu_name'] ),
    'tax_all_items'           =>  sanitize_text_field( $_POST['tax_all_items'] ),
    'tax_edit_item'           =>  sanitize_text_field( $_POST['tax_edit_item'] ),
    'tax_view_item'           =>  sanitize_text_field( $_POST['tax_view_item'] ),
    'tax_update_item'         =>  sanitize_text_field( $_POST['tax_update_item'] ),
    'tax_new_item'            =>  sanitize_text_field( $_POST['tax_new_item'] ),
    'tax_parent_item'         =>  sanitize_text_field( $_POST['tax_parent_item'] ),
    'tax_parent_item_colon'   =>  sanitize_text_field( $_POST['tax_parent_item_colon'] ),
    'tax_search_item'         =>  sanitize_text_field( $_POST['tax_search_item'] ),
    'tax_public'              =>  sanitize_text_field( $_POST['tax_public'] ),
    'tax_public_query'        =>  sanitize_text_field( $_POST['tax_public_query'] ),
    'tax_hierarchical'        =>  sanitize_text_field( $_POST['tax_hierarchical'] ),
    'tax_show_ui'             =>  sanitize_text_field( $_POST['tax_show_ui'] ),
    'tax_show_in_menu'        =>  sanitize_text_field( $_POST['tax_show_in_menu'] ),
    'tax_query_var'           =>  sanitize_text_field( $_POST['tax_query_var'] ),
    'tax_rewrite'             =>  sanitize_text_field( $_POST['tax_rewrite'] ),
    'tax_custom_rewrite_slug' =>  sanitize_text_field( $_POST['tax_custom_rewrite_slug'] ),
    'tax_show_admin_column'   =>  sanitize_text_field( $_POST['tax_show_admin_column'] ),
  );

  if ($icpa_settings_option) {
    foreach ($icpa_settings_option as $value) {
      if( $value['taxonomy_name'] === $_POST['taxonomy_name'] ) {
        return wp_redirect( admin_url( 'admin.php?page=ibtana-custom-post-type&message=1&tab=taxonomy_tab' ) );
      }
      break;
    }
    array_push($icpa_settings_option, $icpa_taxonomy_arr);
  }else{
    $icpa_settings_option = [];
    array_push($icpa_settings_option, $icpa_taxonomy_arr);
  }

  $message_id = 2;
  $tab_name = 'taxonomy_tab';
  $option_name = 'icpa_tax_settings';
} else if ( $_POST['icpa_submit'] == __( 'Update Taxonomy', 'ibtana-ecommerce-product-addons' ) ) {

  $icpa_settings_option = get_option('icpa_tax_settings');

  $posttype_id = sanitize_text_field( $_POST['taxonomy_id'] );

  foreach ($icpa_settings_option as $key => $option) {

    if ( $key == $posttype_id ) {
      $icpa_settings_option[$key]['tax_plural_label']           = sanitize_text_field( $_POST['tax_plural_label'] );
      $icpa_settings_option[$key]['tax_singular_label']         = sanitize_text_field( $_POST['tax_singular_label'] );
      $icpa_settings_option[$key]['posttype']                   = IEPA_Loader::iepa_sanitize_array( wp_unslash( $_POST['posttype'] ) );
      $icpa_settings_option[$key]['tax_attach_thumbnail']       = isset( $_POST['tax_attach_thumbnail'] ) ? sanitize_text_field( $_POST['tax_attach_thumbnail'] ) : false;
      $icpa_settings_option[$key]['tax_menu_name']              = isset( $_POST['tax_menu_name'] ) ? sanitize_text_field( $_POST['tax_menu_name'] ) : 'Categories';
      $icpa_settings_option[$key]['tax_all_items']              = isset( $_POST['tax_all_items'] ) ? sanitize_text_field( $_POST['tax_all_items'] ) : 'All Categories';
      $icpa_settings_option[$key]['tax_edit_item']              = isset( $_POST['tax_edit_item'] ) ? sanitize_text_field( $_POST['tax_edit_item'] ) : 'Edit Categories';
      $icpa_settings_option[$key]['tax_view_item']              = isset( $_POST['tax_view_item'] ) ? sanitize_text_field( $_POST['tax_view_item'] ) : 'View Categories';
      $icpa_settings_option[$key]['tax_update_item']            = isset( $_POST['tax_update_item'] ) ? sanitize_text_field( $_POST['tax_update_item'] ) : 'Update Category Name';
      $icpa_settings_option[$key]['tax_new_item']               = isset( $_POST['tax_new_item'] ) ? sanitize_text_field( $_POST['tax_new_item'] ) : 'Add New Category';
      $icpa_settings_option[$key]['tax_new_item_name']          = isset( $_POST['tax_new_item_name'] ) ? sanitize_text_field( $_POST['tax_new_item_name'] ) : 'New Category Name';
      $icpa_settings_option[$key]['tax_parent_item']            = isset( $_POST['tax_parent_item'] ) ? sanitize_text_field( $_POST['tax_parent_item'] ) : 'Parent Category';
      $icpa_settings_option[$key]['tax_parent_item_colon']      = isset( $_POST['tax_parent_item_colon'] ) ? sanitize_text_field( $_POST['tax_parent_item_colon'] ) : 'Parent Category:';
      $icpa_settings_option[$key]['tax_search_item']            = isset( $_POST['tax_search_item'] ) ? sanitize_text_field( $_POST['tax_search_item'] ) : 'Search Category';
      $icpa_settings_option[$key]['tax_public']                 = isset( $_POST['tax_public'] ) ? sanitize_text_field( $_POST['tax_public'] ) : 'true';
      $icpa_settings_option[$key]['tax_public_query']           = isset( $_POST['tax_public_query'] ) ? sanitize_text_field( $_POST['tax_public_query'] ) : 'true';
      $icpa_settings_option[$key]['tax_hierarchical']           = isset( $_POST['tax_hierarchical'] ) ? sanitize_text_field( $_POST['tax_hierarchical'] ) : 'true';
      $icpa_settings_option[$key]['tax_show_ui']                = isset( $_POST['tax_show_ui'] ) ? sanitize_text_field( $_POST['tax_show_ui'] ) : 'true';
      $icpa_settings_option[$key]['tax_show_in_menu']           = isset( $_POST['tax_show_in_menu'] ) ? sanitize_text_field( $_POST['tax_show_in_menu'] ) : 'true';
      $icpa_settings_option[$key]['tax_query_var']              = isset( $_POST['tax_query_var'] ) ? sanitize_text_field( $_POST['tax_query_var'] ) : 'true';
      $icpa_settings_option[$key]['tax_rewrite']                = isset( $_POST['tax_rewrite'] ) ? sanitize_text_field( $_POST['tax_rewrite'] ) : 'true';
      $icpa_settings_option[$key]['tax_custom_rewrite_slug']    = isset( $_POST['tax_custom_rewrite_slug'] ) ? sanitize_text_field( $_POST['tax_custom_rewrite_slug'] ) : 'categories';
      $icpa_settings_option[$key]['tax_show_admin_column']      = isset( $_POST['tax_show_admin_column'] ) ? sanitize_text_field( $_POST['tax_show_admin_column'] ) : 'true';
      $message_id                                               = 3;
      $tab_name                                                 = 'taxonomy_tab';
      break;
    }
  }
  $option_name = 'icpa_tax_settings';
}

update_option( $option_name, $icpa_settings_option );
wp_redirect(admin_url('admin.php?page=ibtana-custom-post-type&tab='.$tab_name.'&message='.$message_id));
exit();
