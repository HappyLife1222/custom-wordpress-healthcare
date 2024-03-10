<?php
require EDI_DIR . 'theme-wizard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function wpelemento_importer_pro_register_recommended_plugins_set() {


	$plugins_arr = array(
		array(
			'name'             => __( 'Elementor', 'elementor-importer' ),
			'slug'             => 'elementor',
			'required'         => true,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Kirki Customizer Framework', 'elementor-importer' ),
			'slug'             => 'kirki',
			'required'         => true,
			'force_activation' => false,
		),
	);

	if ( file_exists( get_template_directory() . '/inc/plugins.json' ) ) {
		$plugins_json = file_get_contents( get_template_directory() . '/inc/plugins.json' );
		$plugins_json_decoded = json_decode($plugins_json, true);

		$plugins_arr = array();

		foreach ( $plugins_json_decoded as $plugins_arr_single ) {
			if ( isset( $plugins_arr_single['source'] ) ) {
				$plugins_arr_single['source'] = get_template_directory() . $plugins_arr_single['source'];
			}
			array_push( $plugins_arr, $plugins_arr_single );
		}

	}

	$wpelemento_importer_config = array();
	wpelemento_importer_tgmpa( $plugins_arr, $wpelemento_importer_config );
}
add_action( 'wpelemento_importer_tgmpa_register', 'wpelemento_importer_pro_register_recommended_plugins_set' );
