<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$iepa_license_key    = '';
$iepa_license_status = false;
$iepa_plan_expiration_date	=	'';



$ibtana_ecommerce_product_addons_license_key = get_option( str_replace( '-', '_', get_plugin_data( IEPA_PLUGIN_FILE )['TextDomain'] ) . '_license_key' );
if ( $ibtana_ecommerce_product_addons_license_key ) {
  if (
		isset( $ibtana_ecommerce_product_addons_license_key['license_key'] ) &&
		isset( $ibtana_ecommerce_product_addons_license_key['license_status'] )

	) {
    if (
			$ibtana_ecommerce_product_addons_license_key['license_key']

		) {
			$is_envato_key = false;
			if (
				isset( $ibtana_ecommerce_product_addons_license_key['is_envato_key'] ) &&
				( $ibtana_ecommerce_product_addons_license_key['is_envato_key'] == true )
			) {
				$is_envato_key = true;
			}

			if ( !$is_envato_key ) {
				$iepa_license_key    = $ibtana_ecommerce_product_addons_license_key['license_key'];
	      $iepa_license_status = $ibtana_ecommerce_product_addons_license_key['license_status'];


				// Remaining Days Calculation
				$current_date            		= date( 'Y-m-d' );
				$current_date_obj        		= date_create( $current_date );

				$plan_expiration_date				=	$ibtana_ecommerce_product_addons_license_key['plan_expiration_date'];
				$plan_expiration_date_obj		=	date_create( $plan_expiration_date );

				$diffObj										= date_diff( $plan_expiration_date_obj, $current_date_obj );
				$iepa_plan_expiration_date	= (int)$diffObj->format( "%r%a" );
			}

    }
  }
}

?>
<div class="ibtana_addon_license_container">
  <div class="ibtana_lic_title">
    <h4>
      <?php esc_html_e( get_plugin_data( IEPA_PLUGIN_FILE )['Name'], 'ibtana-ecommerce-product-addons' ); ?>
    </h4>
  </div>
  <div class="ibtana_lic_body">
    <form id="iepa-license-form">
      <input
				type="text" id="iepa_license_key_input"
				placeholder="<?php esc_attr_e( 'Enter License Key', 'ibtana-ecommerce-product-addons' ) ?>"
				required=""
				<?php echo esc_attr( $iepa_license_status ? 'disabled' : '' ); ?>
				value="<?php echo esc_html( $iepa_license_key ); ?>"
			>
			<div class="ive-addon-license-key-buttons-wrap">
	      <?php
				if ( !$iepa_license_status ) {
					?>
	        <button type="submit" name="button">
	          <?php esc_html_e( 'Activate', 'ibtana-ecommerce-product-addons' ); ?>
	        </button>
					<button type="button" name="iepa_premium_page" class="iepa_premium_page">
						<?php esc_html_e( 'Buy Premium', 'ibtana-ecommerce-product-addons' ); ?>
					</button>
	        <?php
	      } else {
	        ?>
	        <button type="submit" name="button" disabled>
	          <?php esc_html_e( 'Activated', 'ibtana-ecommerce-product-addons' ); ?>
	        </button>
					<button type="reset" name="iepa_change_key">
						<?php esc_html_e( 'Change Key', 'ibtana-ecommerce-product-addons' ); ?>
					</button>
	        <?php
	      }
	      ?>
			</div>
    </form>
  </div>
  <div class="ibtana_lic_footer">
    <?php
			// echo $iepa_plan_expiration_date;
    ?>
    </div>
</div>

<script>
  (function($) {
		window.addEventListener( 'load', function() {
			var __ = wp.i18n.__;

			function get_iepa_activation_status( callback ) {
				jQuery.post( '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
					action:							'iepa_activation_status'
				}, function( iepa_response ) {

					if ( iepa_response.status == true ) {
						jQuery('#iepa-license-form').closest('.ibtana_addon_license_container').find('.ibtana_lic_footer').empty();
						if ( iepa_response.hasOwnProperty( 'display_string' ) ) {
							jQuery('#iepa-license-form').closest('.ibtana_addon_license_container').find('.ibtana_lic_footer').html(
								iepa_response.display_string
							);
						}
						callback( true );
					}
				});
			}

	    $( '#iepa-license-form' ).on( 'submit', function(e) {
	      e.preventDefault();
	      var iepa_license_key = jQuery('#iepa_license_key_input').val().trim();
	      if ( !iepa_license_key ) {
	        alert( __( 'Please enter license key!', 'ibtana-ecommerce-product-addons' ) );
	        return;
	      }
	      jQuery( '#iepa_license_key_input, #iepa-license-form button' ).attr( 'disabled', true );
	      var iepa_data = {
	        action:     'activate_iepa_license',
	        add_on_key: iepa_license_key,
					security:		'<?php echo wp_create_nonce( "iepa-license-form" ); ?>'

	      };
	      jQuery.post( ive_whizzie_params.ajaxurl, iepa_data, function( iepa_response ) {
	        if( iepa_response.status == true ) {
	          alert( __( iepa_response.msg, 'ibtana-ecommerce-product-addons' ) );
	          jQuery( '#iepa-license-form button' ).text( __( 'Activated', 'ibtana-ecommerce-product-addons' ) );
						$( '#iepa-license-form .ive-addon-license-key-buttons-wrap' ).append(
							`<button type="reset" name="iepa_change_key">` + __( "Change Key", "ibtana-ecommerce-product-addons" ) + `</button>`
						);
						get_iepa_activation_status( function( status ) {
							if ( true === status ) {
								location.href = ive_whizzie_params.adminUrl + "tools.php?page=ibtanaecommerceproductaddons-setup";
							}
						} );
	        } else {
	          alert( iepa_response.msg );
	          jQuery( '#iepa_license_key_input, #iepa-license-form button' ).attr( 'disabled', false );
	        }
	      });
	    });

			$( '#iepa-license-form' ).on( 'click', '[name="iepa_change_key"]', function() {
				$('#iepa_license_key_input').val('');
				$('#iepa_license_key_input').prop( 'disabled', false );
				$( '#iepa-license-form button[type="submit"]' ).text( __( "Activate", "ibtana-ecommerce-product-addons" ) );
				$( '#iepa-license-form button[type="submit"]' ).prop( 'disabled', false );
				$( this ).remove();
			} );


			get_iepa_activation_status( function() {

			} );

		}, false);
  })(jQuery);
</script>
