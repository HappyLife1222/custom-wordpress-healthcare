<?php

require get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function medical_healthcare_elementor_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'medical-healthcare-elementor' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WPElemento Importer', 'medical-healthcare-elementor' ),
			'slug'             => 'wpelemento-importer',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	medical_healthcare_elementor_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'medical_healthcare_elementor_register_recommended_plugins' );
