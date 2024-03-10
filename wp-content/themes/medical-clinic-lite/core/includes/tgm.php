<?php
	
require get_template_directory() . '/core/includes/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function medical_clinic_lite_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'medical-clinic-lite' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	medical_clinic_lite_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'medical_clinic_lite_register_recommended_plugins' );