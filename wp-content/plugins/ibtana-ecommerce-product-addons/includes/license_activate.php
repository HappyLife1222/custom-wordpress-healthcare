<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

check_ajax_referer( 'iepa-license-form', 'security' );

if ( !isset( $_POST['add_on_key'] ) ) {
  wp_send_json(
		array(
			'status'	=> false,
			'msg' 		=> __( 'Please Provide The KEY!', 'ibtana-ecommerce-product-addons' )
		)
	);
  exit;
}


$iepa_post_add_on_key  = sanitize_text_field( $_POST['add_on_key'] );

$iepa_activate_license_endpoint = IBTANA_LICENSE_API_ENDPOINT . 'ibtana_license_activate_premium_addon';

if ( isset( $_POST['iepa_is_envato_key'] ) && ( $_POST['iepa_is_envato_key'] === "true" ) ) {
	$iepa_activate_license_endpoint = IBTANA_LICENSE_API_ENDPOINT . 'ibtana_license_activate_premium_envato_addon';
}

$iepa_response = wp_remote_post( $iepa_activate_license_endpoint , array(
  'method'      => 'POST',
  'body'        => wp_json_encode( array(
      'add_on_key'          =>  $iepa_post_add_on_key,
      'site_url'            =>  site_url(),
      'add_on_text_domain'  =>  get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain']
  ) ),
  'headers'     => [
      'Content-Type' => 'application/json',
  ],
  'data_format' => 'body'
) );


if ( is_wp_error( $iepa_response ) ) {
  wp_send_json(
		array(
			'status'	=> false,
			'msg' 		=> __( 'Something Went Wrong!', 'ibtana-ecommerce-product-addons' )
		)
	);
  exit;
} else {
  $iepa_response     = wp_remote_retrieve_body( $iepa_response );

  $iepa_api_response = json_decode( $iepa_response, true );


	$iepa_key = str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key';
  if ( $iepa_api_response['status'] == true ) {
    update_option( $iepa_key, [
      'license_key'     			=>	$iepa_post_add_on_key,
      'license_status'  			=>	true,
			'plan_expiration_date'	=>	isset( $iepa_api_response['dates_with_diff_info']['plan_expiration_date'] ) ? $iepa_api_response['dates_with_diff_info']['plan_expiration_date'] : '',
			'is_envato_key'					=>	( isset( $iepa_api_response['is_envato_key'] ) && ( $iepa_api_response['is_envato_key'] == true ) ) ? true : false
			// 'save_templates_limit'	=>	5
    ] );
    wp_send_json(
			array(
				'status'	=> true,
				'msg' 		=> __( $iepa_api_response['msg'], 'ibtana-ecommerce-product-addons' )
			)
		);
    exit;
  } else {
    update_option( $iepa_key, [
      'license_key'     => '',
      'license_status'  => false
    ]);
    wp_send_json(
			array(
				'status'	=>	false,
				'msg'			=>	__( $iepa_api_response['msg'], 'ibtana-ecommerce-product-addons' )
			)
		);
    exit;
  }
}
