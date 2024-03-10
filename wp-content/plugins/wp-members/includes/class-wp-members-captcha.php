<?php
/**
 * The WP_Members_Captcha Class.
 *
 * This is the WP_Members Captcha object class. This class contains functions
 * for handling the various captchas that the plugin natively supports. This 
 * includes reCAPTCHA v2/v3, Really Simple CAPTCHA, and hCaptcha.
 *
 * @package WP-Members
 * @subpackage WP_Members_Captcha Object Class
 * @since 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class WP_Members_Captcha {
	
	/**
	 * Gets which CAPTCHA is set.
	 *
	 * @since 3.3.5
	 */
	static function type( $decode = false ) {
		global $wpmem;
		$value = ( false !== $decode ) ? $decode : $wpmem->captcha;
		switch ( $value ) {
			case 0:
				return "Disabled";
				break;
			case 1:
			case 3:
				return "recaptcha_v2";
				break;
			case 4:
				return "recaptcha_v3";
				break;
			case 5:
				return "hcaptcha";
				break;
			case 2:
			default:
				return "rs_captcha";
				break;
		}
	}
	
	/**
	 * Display a CAPTCHA.
	 *
	 * @since 3.3.4
	 * @since 3.3.6 $type defaults to false, so captcha defaults to $wpmem setting.
	 *
	 * @param  string  $type  Type of captcha to display.
	 * @param  array   $keys  Google reCAPTCHA keys (if used).
	 */
	static function show( $type = false, $key = false ) {
		if ( false === $type ) {
			$type = self::type();
		}
		if ( 'rs_captcha' == $type ) {
			return self::rs_captcha();
		} elseif ( 'hcaptcha' == $type ) {
			return self::hcaptcha( $key );
		} else {
			return self::recaptcha( $key );
		}
	}

	/**
	 * Create a hCaptcha form.
	 *
	 * @since 3.3.5
	 *
	 * @param  string  $key  Your hCaptcha API key.
	 * @return string  $html The form HTML.
	 */
	static function hcaptcha( $key = false ) {
		
		if ( false === $key ) {
			$opts = get_option( 'wpmembers_captcha' );
			$key  = $opts['hcaptcha']['api_key'];
		}		
		$html  = '<div class="h-captcha" data-sitekey="' . $key . '"></div>';
		$html .= '<script src="https://hcaptcha.com/1/api.js" async defer></script>';
		/** This filter is defined in /includes/class-wp-members-captcha.php */
		return apply_filters( 'wpmem_captcha', $html );
	}

	/**
	 * Create reCAPTCHA form.
	 *
	 * @since  3.3.0  Replaces wpmem_inc_recaptcha().
	 * @since  3.3.5  Accepts API public key for static use.
	 *
	 * @global stdCalss $wpmem
	 * @param  string   $key  Your reCAPTCHA public key.
	 * @return string   $html HTML for reCAPTCHA display.
	 */
	static function recaptcha( $key = false ) {
		
		global $wpmem;
		
		if ( false == $key ) {
			$opts = get_option( 'wpmembers_captcha' );
			$key  = $opts['recaptcha']['public'];
		}
		
		/**
		 * Filters the URL used for google recaptcha API.
		 *
		 * @since 3.4.2
		 *
		 * @param string $url
		 */
		$wpmem_recaptcha_url = apply_filters( 'wpmem_recaptcha_url', 'https://www.google.com/recaptcha/api.js' );
		
		/*
		 * NOTE: DO NOT EDIT THIS. Use the filter hook found below.
		 * 
		 * Don't know how to use filter or action hooks to customize WP?
		 * See https://wpbitz.com/how-to-use-hooks-in-wordpress/
		 */
		if ( 3 == $wpmem->captcha ) {
			$html = '<script src="' . $wpmem_recaptcha_url . '" async defer></script>
			<div class="g-recaptcha" data-sitekey="' . $key . '"></div>';
		} else {
			$html = '<script src="' . $wpmem_recaptcha_url . '?render=' . $key . '"></script>';
			$html.= "<script>
						grecaptcha.ready(function () {
							grecaptcha.execute('" . $key . "', { action: 'contact' }).then(function (token) {
								var recaptchaResponse = document.getElementById('recaptchaResponse');
								recaptchaResponse.value = token;
							});
						});
					</script>";
			$html.= '<input type="hidden" name="recaptcha_response" id="recaptchaResponse">';
		}

		/**
		 * Filter the reCAPTCHA HTML.
		 *
		 * @since 2.7.4
		 * @deprecated 3.3.5 Use wpmem_captcha instead.
		 *
		 * @param string $html A string of HTML for the reCAPTCHA.
		 */
		$html = apply_filters( 'wpmem_recaptcha', $html );

		/**
		 * Filter the captcha HTML.
		 *
		 * @since 3.3.5
		 *
		 * @param string $html A string of HTML for the registration captcha.
		 */
		return apply_filters( 'wpmem_captcha', $html );
	}

	/**
	 * Create Really Simple CAPTCHA.
	 *
	 * @since 3.3.0 Replaces wpmem_build_rs_captcha().
	 *
	 * @return string|array {
	 *     HTML string, OR array of form elements for Really Simple CAPTCHA.
	 *
	 *     @type string label_text The raw text used for the label.
	 *     @type string label      The HTML for the label.
	 *     @type string field      The input tag and the CAPTCHA image.
	 * }
	 */
	static function rs_captcha( $return = 'string' ) {

		if ( defined( 'REALLYSIMPLECAPTCHA_VERSION' ) ) {
			// setup defaults								
			$defaults = array( 
				'characters'   => 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789',
				'num_char'     => '4',
				'dim_w'        => '72',
				'dim_h'        => '30',
				'font_color'   => '0,0,0',
				'bg_color'     => '255,255,255',
				'font_size'    => '12',
				'kerning'      => '14',
				'img_type'     => 'png',
			);
			$opts = get_option( 'wpmembers_captcha' );

			$args = ( isset( $opts['really_simple'] ) && is_array( $opts['really_simple'] ) ) ? $opts['really_simple'] : array();
			$args = wp_parse_args( $args, $defaults );

			$rs_captcha = new ReallySimpleCaptcha();
			$rs_captcha->chars = $args['characters'];
			$rs_captcha->char_length = $args['num_char'];
			$rs_captcha->img_size = array( $args['dim_w'], $args['dim_h'] );
			$rs_captcha->fg = explode( ",", $args['font_color'] );
			$rs_captcha->bg = explode( ",", $args['bg_color'] );
			$rs_captcha->font_size = $args['font_size'];
			$rs_captcha->font_char_width = $args['kerning'];
			$rs_captcha->img_type = $args['img_type'];

			$rs_captcha_word   = $rs_captcha->generate_random_word();
			$rs_captcha_prefix = mt_rand();
			$rs_captcha_image_name = $rs_captcha->generate_image( $rs_captcha_prefix, $rs_captcha_word );

			/**
			 * Filters the default Really Simple Captcha folder location.
			 *
			 * @since 3.0
			 *
			 * @param string The default location of RS Captcha.
			 */
			$rs_captcha_image_url = apply_filters( 'wpmem_rs_captcha_folder', get_bloginfo( 'wpurl' ) . '/wp-content/plugins/really-simple-captcha/tmp/' );

			$img_w = $rs_captcha->img_size[0];
			$img_h = $rs_captcha->img_size[1];
			$src   = $rs_captcha_image_url . $rs_captcha_image_name;
			$size  = $rs_captcha->char_length;
			$pre   = $rs_captcha_prefix;

			/*
			 * NOTE: DO NOT EDIT THIS. Use the filter hook found below.
			 * 
			 * Don't know how to use filter or action hooks to customize WP?
			 * See https://wpbitz.com/how-to-use-hooks-in-wordpress/
			 */
			$captcha_rows_args = array( 
				'label_text' => wpmem_get_text( 'register_rscaptcha' ),
				'code_size'  => esc_attr( $size ),
				'prefix'     => $pre,
				'img_src'    => esc_url( $src ),
				'img_w'      => esc_attr( $img_w ),
				'img_h'      => esc_attr( $img_h ),
				'label'      => '<label class="text" for="captcha">' . wpmem_get_text( 'register_rscaptcha' ) . '</label>',
				'field'      => '<input id="captcha_code" name="captcha_code" size="' . esc_attr( $size ) . '" type="text" class="textbox" required />',
				'hidden'     => '<input id="captcha_prefix" name="captcha_prefix" type="hidden" value="' . esc_attr( $pre ) . '" />',
				'img'        => '<img src="' . esc_url( $src ) . '" alt="captcha" width="' . esc_attr( $img_w ) . '" height="' . esc_attr( $img_h ) . '" />',
			);

			/**
			 * Filter the RS CAPTCHA HTML.
			 *
			 * @since 3.3.5
			 *
			 * @param array
			 */
			$rows = apply_filters( 'wpmem_rs_captcha_rows', $captcha_rows_args );
			
			if ( 'array' == $return ) {
				return $rows;
			} else {
				$html = $rows['label'] . $rows['img'] . $rows['hidden'] . $rows['field'];
				/** This filter is defined in /includes/class-wp-members-captcha.php */
				return apply_filters( 'wpmem_captcha', $html );
			}
		} else {
			return ( 'array' == $return ) ? array( 'field' => "Really Simple CAPTCHA is not enabled", 'label' => '', 'label_text' => '', 'img' => '', 'hidden' => '' ) : "Really Simple CAPTCHA is not enabled";
		}
	}
	
	/**
	 * Process a captcha.
	 *
	 * @since 3.1.6
	 * @since 3.3.0 Ported from wpmem_register_handle_captcha() in register.php.
	 * @since 3.3.4 Added argument to specify which captcha type to validate.
	 * @since 3.4.8 Additional error checking on RS Captchas
	 *
	 * @global $wpmem_themsg
	 * @param  $which_captcha
	 * @return $string
	 */
	static function validate( $which_captcha = false, $secret = false ) {

		global $wpmem_themsg;
		
		$captcha = ( ! $which_captcha ) ? self::type() : $which_captcha;

		if ( 'rs_captcha' == $captcha ) {
			if ( defined( 'REALLYSIMPLECAPTCHA_VERSION' ) ) {
				// Validate Really Simple Captcha.
				$rs_captcha = new ReallySimpleCaptcha();
				// This variable holds the CAPTCHA image prefix, which corresponds to the correct answer.
				$rs_captcha_prefix = ( wpmem_get( 'captcha_prefix', false ) );
				if ( ! $rs_captcha_prefix ) {
					$wpmem_themsg = __( 'Error with the captcha code configuration. Please notify the site administrator', 'wp-members' );
					return false;
				}
				// This variable holds the CAPTCHA response, entered by the user.
				$rs_captcha_code = ( wpmem_get('captcha_code', false ) );
				if ( ! $rs_captcha_code ) {
					$wpmem_themsg = __( 'Captcha code was empty. You must complete the captcha code.', 'wp-members' );
					return false;
				}
				// Check CAPTCHA validity.
				$rs_captcha_correct = ( $rs_captcha->check( $rs_captcha_prefix, $rs_captcha_code ) ) ? true : false;
				// Clean up the tmp directory.
				$rs_captcha->remove( $rs_captcha_prefix );
				$rs_captcha->cleanup();
				// If CAPTCHA validation fails (incorrect value entered in CAPTCHA field), return an error.
				if ( ! $rs_captcha_correct ) {
					$wpmem_themsg = __( 'You have entered an incorrect code value. Please try again.', 'wp-members' );
					return false;
				}
			}
			
		} elseif ( 'hcaptcha' == $captcha ) {
			
			// Get the captcha settings (api keys).
			if ( ! $secret ) {
				$opts = get_option( 'wpmembers_captcha' );
				$secret = $opts['hcaptcha']['secret'];
			}
			
			$captcha = wpmem_get( 'h-captcha-response', false );
			
			// If there is no captcha value, return error.
			if ( false === $captcha ) {
				$wpmem_themsg = wpmem_get_text( 'reg_empty_captcha' );
				return false;
			}

			// Validate the captcha.
			$response = wp_remote_post( 'https://hcaptcha.com/siteverify',  array(
				'body' => array( 
				'secret'   => $secret,
				'response' => $captcha,
			) ) );

			// Decode the json response.
			$response = json_decode( wp_remote_retrieve_body( $response, true ) );

			if ( $response->success ) {
				// your success code goes here
			} else {
				$wpmem_themsg = wpmem_get_text( 'reg_invalid_captcha' );
				return false;
			}			

		} else {
			
			// It is reCAPTCHA.
			$recaptcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify?';
			
			// Get the captcha settings (api keys).
			if ( ! $secret ) {
				$opts = get_option( 'wpmembers_captcha' );
				$secret = $opts['recaptcha']['private'];
			}
			
			if ( 'recaptcha_v2' == $captcha ) {
				
				$captcha = wpmem_get( 'g-recaptcha-response', false );

				// If there is no captcha value, return error.
				if ( false === $captcha ) {
					$wpmem_themsg = wpmem_get_text( 'reg_empty_captcha' );
					return false;
				}

				// Build URL for captcha evaluation.
				$url = $recaptcha_verify_url . http_build_query([
					'secret' => $secret,
					'response' => $captcha,
					'remoteip' => wpmem_get_user_ip(),
				]);
				
				// Validate the captcha.
				$response = wp_remote_fopen( $url );

				// Decode the json response.
				$response = json_decode( $response, true );

				// If captcha validation was unsuccessful.
				if ( false == $response['success'] ) {
					$wpmem_themsg = wpmem_get_text( 'reg_invalid_captcha' );
					if ( WP_DEBUG && isset( $response['error-codes'] ) ) {
						$wpmem_themsg.= '<br /><br />';
						foreach( $response['error-codes'] as $code ) {
							$wpmem_themsg.= "Error code: " . $code . "<br />";
						}
					}
					return false;
				}
			} elseif ( 'recaptcha_v3' == $captcha ) {
				$captcha = wpmem_get( 'recaptcha_response', false );
	
				if ( false === $captcha ) {
					$wpmem_themsg = wpmem_get_text( 'reg_empty_captcha' );
					return false;
				}
				
				if ( $_SERVER['REQUEST_METHOD'] === 'POST' && false !== $captcha ) {

					// Make and decode POST request:
					$url = $recaptcha_verify_url . http_build_query([
						'secret'   => $secret,
						'response' => $captcha, 
					]);
					$recaptcha = file_get_contents( $url );
					$recaptcha = json_decode( $recaptcha );

					/**
					 * Filters the reCAPTCHA v3 score.
					 * @link https://developers.google.com/recaptcha/docs/v3
					 * 
					 * @since 3.3.9
					 * 
					 * @param int $score
					 */
					$score = apply_filters( 'wpmem_recaptcha_score', 0.5 );
					// Take action based on the score returned:
					if ( $recaptcha->score >= $score ) {
						return true;
					} else {
						$wpmem_themsg = wpmem_get_text( 'reg_invalid_captcha' );
						return false;
					}
				} else {
					return false;
				}
			}
		}	

		return true;
	}
}