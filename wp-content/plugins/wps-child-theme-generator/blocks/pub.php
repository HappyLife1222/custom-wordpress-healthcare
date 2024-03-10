<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$datas = \WPS\WPS_Child_Theme_Generator\Pub::get_api_result();

if ( empty( $datas ) ) {
	return false;
}

$plugins_adds = \WPS\WPS_Child_Theme_Generator\Pub::get_json_array( $datas );

if ( empty( $plugins_adds ) ) {
	return false;
}

foreach ( $plugins_adds as $add ) {
	$plugin = $add['plugin'] . '/' . $add['plugin'] . '.php';

	$button_plugin = $classes_plugin = '';

	if ( ! \WPS\WPS_Child_Theme_Generator\Pub::is_plugin_installed( $plugin ) ) {
		$classes_plugin    = 'install-now';
		$action_url_plugin = wp_nonce_url( add_query_arg(
			array(
				'action' => 'install-plugin',
				'plugin' => $add['plugin'],
			),
			network_admin_url( 'update.php' )
		), 'install-plugin_' . $add['plugin'] );
		$button_plugin     = __( 'Install', 'wps-child-theme-generator' ) . ' ' . $add['title'];
	} elseif ( is_plugin_inactive( $plugin ) ) {
		$action_url_plugin = wp_nonce_url( add_query_arg(
			array(
				'action'        => 'activate',
				'plugin'        => $plugin,
				'plugin_status' => 'all',
				'paged'         => 1
			),
			network_admin_url( 'plugins.php' )
		), 'activate-plugin_' . $plugin );

		$button_plugin = __( 'Enable', 'wps-child-theme-generator' ) . ' ' . $add['title'];
	}

	if ( empty( $button_plugin ) ) {
		continue;
	}

	$details_url_plugin = add_query_arg(
		array(
			'tab'       => 'plugin-information',
			'plugin'    => $add['plugin'],
			'TB_iframe' => true,
			'width'     => 722,
			'height'    => 949,
		),
		network_admin_url( 'plugin-install.php' )
	); ?>
    <div class="pub-wp-serveur plugin-card plugin-card-<?php echo $add['plugin']; ?>">
        <p class="wps-pub-logo"><img
                    src="<?php echo $add['img_64']; ?>"
                    height="64"/></p>
        <div class="message"><strong><?php echo $add['description']; ?></strong></div>
        <div class="cta">
            <a data-slug="<?php echo $add['plugin']; ?>" href="<?php echo $action_url_plugin; ?>"
               class="btn-pubwps btn-install-plugin <?php echo $classes_plugin; ?>"><?php echo $button_plugin; ?></a>
            <a href="<?php echo $details_url_plugin; ?>"
               class="thickbox open-plugin-details-modal btn-wps-details"><?php echo sprintf( __( 'More about %s', 'wps-child-theme-generator' ), $add['title'] ); ?></a>
        </div>
    </div>
	<?php
}