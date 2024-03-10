<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BDI_Admin_Notice' ) ) {

    class BDI_Admin_Notice {
        
        function __construct() {
            add_action( 'admin_notices', array( $this, 'bdi_admin_notice' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'bdi_notice_scripts' ) );
            add_action( 'wp_ajax_bdi_admin_notice_ignore', array( $this, 'bdi_admin_notice_ignore' ) );
            add_action( 'wp_ajax_bdi_get_admin_notices', array( $this, 'bdi_get_admin_notices' ) );
        }

        function bdi_notice_scripts() {
            wp_enqueue_style( 'bdi-notice-style', EDI_URL . 'assets/css/bdi-notice.css' );
			wp_enqueue_script( 'bdi-notice-script', EDI_URL . 'assets/js/bdi-notice.js' );

            $bdi_admin_notices = get_option( 'bdi_admin_notices', [] );
            
            $bdi_notice_params = array(
                'WPEI_THEME_LICENCE_ENDPOINT'	=>	WPEI_THEME_LICENCE_ENDPOINT,
                'ajax_url' 	 					=>	esc_url( admin_url( 'admin-ajax.php' ) ),
				'bdi_admin_notices'				=>	$bdi_admin_notices,
				'wpnonce'						=>	wp_create_nonce( 'bdi_notice_nonce' )
            );
            wp_localize_script( 'bdi-notice-script', 'bdi_notice_params', $bdi_notice_params );
        }

        function bdi_admin_notice() { ?>
            <div id="bdi-admin-notice" class="notice">
            </div>
        <?php }

        function bdi_admin_notice_ignore() {

            if ( ! wp_verify_nonce( $_POST['wpnonce'], 'bdi_notice_nonce' ) ) {
                exit;
            }

            if ( ! current_user_can( 'manage_options' ) ) {
                exit;
            }

            $bdi_admin_notice_id	=	sanitize_text_field( $_POST['bdi_admin_notice_id'] );
            $bdi_admin_notices		=	get_option( 'bdi_admin_notices', [] );

            array_push( $bdi_admin_notices, $bdi_admin_notice_id );

            if ( count( $bdi_admin_notices ) > 50 ) {
                array_shift( $bdi_admin_notices );
            }

            update_option( 'bdi_admin_notices', $bdi_admin_notices );
            wp_send_json_success();
		}

        function bdi_get_admin_notices() {

			// Check for nonce security
			if ( ! wp_verify_nonce( $_POST['wpnonce'], 'bdi_notice_nonce' ) ) {
				exit;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				exit;
			}

			$endpoint	=	WPEI_THEME_LICENCE_ENDPOINT . 'get_client_admin_notices_for_client';
			$response	=	wp_remote_post( $endpoint );

			if ( is_wp_error( $response ) ) {
				$response = array( 'status' => false, 'msg' => 'Something Went Wrong!' );
				wp_send_json( $response );
				exit;
			}

			$response_json	= json_decode( wp_remote_retrieve_body( $response ) );

			$notices_data		= $response_json->data;
			wp_send_json_success( $notices_data );
		}
    }

	new BDI_Admin_Notice();
}