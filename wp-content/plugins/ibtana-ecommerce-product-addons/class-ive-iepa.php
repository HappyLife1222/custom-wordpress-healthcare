<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IEPA_Backend' ) ) :

   final class IEPA_Backend {

		// Add-on installed or not for licensing
		function iepa_is_add_on_installed( $flag ) {
			return true;
		}

		function iepa_is_envato_add_on_installed( $flag ) {
			return true;
		}

		// Print license functionlity for this add-on
		function iepa_addon_license_area() {
			include IEPA_ABSPATH . 'includes/addon_license_area.php';
		}

		function iepa_envato_addon_license_area() {
			include IEPA_ABSPATH . 'includes/envato_addon_license_area.php';
		}

		// Activate Assign Agent license
		function iepa_license_activate() {
			include IEPA_ABSPATH . 'includes/license_activate.php';
      die();
		}

		function iepa_activation_status() {
			$ibtana_ecommerce_product_addons_license_key = get_option( str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key' );

			$iepa_license_key 		=	'';
			if ( $ibtana_ecommerce_product_addons_license_key ) {
			  if ( isset( $ibtana_ecommerce_product_addons_license_key['license_key'] ) && isset( $ibtana_ecommerce_product_addons_license_key['license_status'] ) ) {
			    if ( $ibtana_ecommerce_product_addons_license_key['license_key'] ) {
			      $iepa_license_key    = $ibtana_ecommerce_product_addons_license_key['license_key'];
			    }
			  }
			}


			if ( $iepa_license_key == '' ) {
				wp_send_json( array( 'status' => false ) );
				exit;
			}

			$request_body = array(
					'add_on_key'          =>  $iepa_license_key,
					'site_url'            =>  site_url(),
					'add_on_text_domain'  =>  get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain']
			);


			$iepa_activation_status_endpoint = IBTANA_LICENSE_API_ENDPOINT . 'ibtana_client_premium_add_on_check_activation_status';

			if ( isset( $ibtana_ecommerce_product_addons_license_key['is_envato_key'] ) && ( $ibtana_ecommerce_product_addons_license_key['is_envato_key'] == true ) ) {
				$iepa_activation_status_endpoint = IBTANA_LICENSE_API_ENDPOINT . 'ibtana_envato_add_on_check_activation_status';
			}

			$iepa_response = wp_remote_post( $iepa_activation_status_endpoint, array(
			  'method'      => 'POST',
			  'body'        => wp_json_encode( $request_body ),
			  'headers'     => [
			      'Content-Type' => 'application/json',
			  ],
			  'data_format' => 'body'
			));

			if ( is_wp_error( $iepa_response ) ) {
			  wp_send_json(
					array(
						'status'	=>	false,
						'msg'			=>	__( 'Something Went Wrong!', 'ibtana-ecommerce-product-addons' )
					)
				);
			  exit;
			} else {
				$iepa_response			=	wp_remote_retrieve_body( $iepa_response );
				$iepa_api_response	=	json_decode( $iepa_response, true );


				if ( $iepa_api_response['status'] == true ) {

					// Update the template limit here
					$iepa_key = str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key';
					if ( isset( $iepa_api_response['save_template_limit'] ) && ( $iepa_api_response['save_template_limit'] != '' ) ) {
						$ive_add_on_license_key = get_option( $iepa_key );
						if ( $ive_add_on_license_key ) {
							$ive_add_on_license_key['license_status']				=	true;
							$ive_add_on_license_key['save_templates_limit'] = $iepa_api_response['save_template_limit'];
							update_option( $iepa_key, $ive_add_on_license_key );
						}

					}


					// Update the template limit here finished

					if ( $iepa_api_response['msg_type'] === 'before_expiration_message' ) {
						wp_send_json( array(
							'status'					=>	true,
							'msg'							=>	$iepa_api_response['msg'],
							'display_string'	=>	$iepa_api_response['display_string']
						) );
					} else {
						wp_send_json(
							array(
								'status'	=>	true,
								'msg'			=>	__( $iepa_api_response['msg'], 'ibtana-ecommerce-product-addons' )
							)
						);
						exit;
					}
				} else {



					// Update the template limit here
					$iepa_key = str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key';
					$ive_add_on_license_key = get_option( $iepa_key );



					if ( $ive_add_on_license_key ) {

						$ive_add_on_license_key['save_templates_limit'] = 0;

						if ( isset( $iepa_api_response['is_suspended'] ) ) {
							$ive_add_on_license_key['is_suspended']	=	$iepa_api_response['is_suspended'];
						}

						if ( isset( $iepa_api_response['is_expired'] ) ) {
							$ive_add_on_license_key['is_expired']	=	$iepa_api_response['is_expired'];
						}



						$ive_add_on_license_key['license_status']	=	false;

						update_option( $iepa_key, $ive_add_on_license_key );
					}
					// Update the template limit here finished

					wp_send_json(
						array(
							'status'	=>	false,
							'msg'			=>	__( $iepa_api_response['msg'], 'ibtana-ecommerce-product-addons' )
						)
					);
			    exit;
				}
			}
		}

	}
endif;

?>
