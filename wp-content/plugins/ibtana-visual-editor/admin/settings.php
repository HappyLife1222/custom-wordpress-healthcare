<?php

if ( ! function_exists( 'ibtana_visual_editor_register_ajax_json_endpont' ) ) {
	/**
	 * Plugin bootstrap process.
	 *
	 * @return void
	 */
	function ibtana_visual_editor_register_ajax_json_endpont() {

		register_rest_route(
        'ibtana-visual-editor/v1',
        '/update_google_recaptcha_keys',
        array(
            'methods'            	=>	'POST',
            'callback'           	=>	'ibtana_visual_editor_update_key_option',
            'permission_callback'	=>	'__return_true',
        )
    );
	}
	add_action( 'rest_api_init', 'ibtana_visual_editor_register_ajax_json_endpont' );
}

if ( ! function_exists( 'ibtana_visual_editor_get_all_categories' ) ) {
	function ibtana_visual_editor_get_all_categories() {
		register_rest_route(
			'ibtana-visual-editor/v1',
			'getAllCategories/',
			array(
				'methods' => 'GET',
				'callback' => 'ibtana_visual_editor_getAllCategories',
				'permission_callback' => '__return_true'
			)
		);
	}
	add_action('rest_api_init', 'ibtana_visual_editor_get_all_categories');
}

function ibtana_visual_editor_getAllCategories() {
	$categories = get_categories(array(
		'orderby' => 'name',
		'order'   => 'ASC'
	));
	return array('result' => $categories);
}

function ibtana_visual_editor_update_key_option($request) {

	$site_key 	= sanitize_text_field( $request->get_param( 'site_key' ) );
	$secret_key	=	sanitize_text_field( $request->get_param( 'secret_key' ) );
	$showRecaptcha	=	sanitize_text_field( $request->get_param( 'showRecaptcha' ) );

	update_option( 'ive_googleReCaptchaAPISiteKey', $site_key );
  update_option( 'ive_googleReCaptchaAPISecretKey', $secret_key );
  update_option( 'ive_googleReCaptchaAPIToggle', $showRecaptcha );
	return new WP_REST_Response(
      array(
          'success'  => true,
          'response' => true,
      ),
      200
  );
}

function ibtana_visual_editor_file_generation() {
	// Check for nonce security
	if ( ! wp_verify_nonce( $_POST['wpnonce'], 'ive_whizzie_nonce' ) ) {
		exit;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		exit;
	}

	wp_send_json_success(
		array(
			'success' => true,
			'message' => update_option( '_ive_allow_file_generation', sanitize_text_field( $_POST['value'] ) ),
		)
	);
}
add_action( 'wp_ajax_ive_file_generation', 'ibtana_visual_editor_file_generation' );

function ive_save_general_settings() {
	// Check for nonce security
	if ( ! wp_verify_nonce( $_POST['wpnonce'], 'ive_whizzie_nonce' ) ) {
		exit;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		exit;
	}

	$ive_save_general_settings = get_option( 'ive_general_settings' );
	$ive_save_general_settings = $ive_save_general_settings ? $ive_save_general_settings : array();

	$ive_save_general_settings['google_api_key']	=	sanitize_text_field( $_POST['google_api_key'] );
	$ive_save_general_settings['ive_custom_css']	=	stripcslashes( sanitize_text_field( $_POST['ive_custom_css'] ) );
	$ive_save_general_settings['ive_custom_js']		=	stripcslashes( sanitize_text_field( $_POST['ive_custom_js'] ) );

	wp_send_json_success(
		array(
			'success' => true,
			'message' => update_option( 'ive_general_settings', $ive_save_general_settings ),
		)
	);
}
add_action( 'wp_ajax_ive_save_general_settings', 'ive_save_general_settings' );
