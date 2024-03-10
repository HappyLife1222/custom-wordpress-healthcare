<?php

namespace WPS\WPS_Child_Theme_Generator;

class Pub {

	/**
	 *
	 * Return PF current user
	 *
	 * @return null|string|string[]
	 */
	public static function wps_ip_check_return_pf() {
		$pf        = '';
		$host_name = gethostname();
		if ( strpos( $host_name, 'wps' ) !== false ) {

			if ( false !== strpos( $host_name, 'wpserveur' ) ) {
				$pf = 'pf1';
				return $pf;
			}

			$pf = preg_replace( "/[^0-9]/", '', $host_name );
			$pf = 'pf' . $pf;
		}

		return $pf;
	}

	public static function is_plugin_installed( $plugin ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $plugin ] );
	}

	/**
	 * @return array|string|WP_Error
	 */
	public static function get_api_result() {
		if ( false === ( $response = get_transient( 'wps_plugins_adds' ) ) ) {
			$response = wp_remote_get( WPS_PUB_API_URL . 'wp/v2/wps_plugins_adds/' );
			set_transient( 'wps_plugins_adds', $response, 24 * HOUR_IN_SECONDS );
		}

		$datas = '';
		if ( is_array( $response ) ) {
			$datas = $response;
		}

		return $datas;
	}

	/**
	 * @param $response
	 *
	 * @return array
	 */
	public static function get_json_array( $response ) {
		if ( empty( $response ) ) {
			return array();
		}

		$datas = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! is_array( $datas ) ) {
			return array();
		}

		if ( isset( $datas['code'] ) && is_null( $datas['data'] ) ) {
			return array();
		}

		$adds = array();
		foreach ( $datas as $data ) {

			$post_metas = $data['post-meta-fields'];

			$title = $data['title']['rendered'];

			$description = $data['content']['rendered'];

			$plugin = '';
			if ( isset( $post_metas['plugin'] ) ) {
				$plugin = $post_metas['plugin'];
				$plugin = reset( $plugin );
			}

			$wps_pour_tous = '';
			if ( isset( $post_metas['pour_tous'] ) ) {
				$wps_pour_tous = $post_metas['pour_tous'];
				$wps_pour_tous = reset( $wps_pour_tous );
			}

			$locale = get_locale();
			$locale = substr( $locale, 0, 2 );
			if ( 'fr' !== $locale ) {
				if ( isset( $post_metas[ 'description_' . $locale ] ) ) {
					$description = $post_metas[ 'description_' . $locale ];
					$description = reset( $description );
				}
			}

			$adds[] = array(
				'title'         => $title,
				'plugin'        => $plugin,
				'description'   => $description,
				'wps_pour_tous' => $wps_pour_tous,
				'img_64'        => $post_metas['img_64'][0],
			);
		}

		return $adds;
	}
}