<?php
/**
 * IEPA Block Helper.
 *
 * @package IEPA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'IEPA_Block_JS' ) ) {

	/**
	 * Class IEPA_Block_JS.
	 */
	class IEPA_Block_JS {

		public static function get_product_price_gfonts( $attr ) {
			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['fontFamily'] ) ? $attr['fontFamily'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';
			IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_add_to_cart_gfonts( $attr ) {
			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['fontFamily'] ) ? $attr['fontFamily'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';
			IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_product_rating_gfonts( $attr ) {
			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';
			IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_button_gfonts( $attr ) {

      $load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

      IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_progress_bar_gfonts( $attr ) {

			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

			$load_google_font_cont = isset( $attr['googleFont_cont'] ) ? $attr['googleFont_cont'] : '';
			$font_family_cont      = isset( $attr['typography_cont'] ) ? $attr['typography_cont'] : '';
			$font_weight_cont      = isset( $attr['fontWeight_cont'] ) ? $attr['fontWeight_cont'] : '';
			$font_subset_cont      = isset( $attr['fontSubset_cont'] ) ? $attr['fontSubset_cont'] : '';

			IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );

			IEPA_Helper::blocks_google_font( $load_google_font_cont, $font_family_cont, $font_weight_cont, $font_subset_cont );
		}

		public static function get_tabs_gfonts( $attr ) {

      $load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

      $load_google_font_subtitle = isset( $attr['subtitleFont'][0]['google'] ) ? $attr['subtitleFont'][0]['google'] : '';
			$font_family_subtitle      = isset( $attr['subtitleFont'][0]['family'] ) ? $attr['subtitleFont'][0]['family'] : '';
			$font_weight_subtitle      = isset( $attr['subtitleFont'][0]['weight'] ) ? $attr['subtitleFont'][0]['weight'] : '';
			$font_subset_subtitle      = isset( $attr['subtitleFont'][0]['subset'] ) ? $attr['subtitleFont'][0]['subset'] : '';

			IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );

			IEPA_Helper::blocks_google_font( $load_google_font_subtitle, $font_family_subtitle, $font_weight_subtitle, $font_subset_subtitle );
    }

		public static function get_advanced_text_gfonts( $attr ) {
			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

      IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_accordion_title_gfonts( $attr ) {
			$load_google_font = isset( $attr['titleStyles'][ 0 ]['google'] ) ? $attr['titleStyles'][ 0 ]['google'] : '';
			$font_family      = isset( $attr['titleStyles'][ 0 ]['family'] ) ? $attr['titleStyles'][ 0 ]['family'] : '';
			$font_weight      = isset( $attr['titleStyles'][ 0 ]['fontWeight'] ) ? $attr['titleStyles'][ 0 ]['weight'] : '';
			$font_subset      = isset( $attr['titleStyles'][ 0 ]['fontSubset'] ) ? $attr['titleStyles'][ 0 ]['fontSubset'] : '';

      IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_product_reviews_gfonts( $attr ) {

			$load_google_font_desc = isset( $attr['descloadGoogleFont'] ) ? $attr['descloadGoogleFont'] : '';
			$font_family_desc      = isset( $attr['desctypography'] ) ? $attr['desctypography'] : '';
			$font_weight_desc      = isset( $attr['descfontWeight'] ) ? $attr['descfontWeight'] : '';
			$font_weight_desc      = isset( $attr['descfontSubset'] ) ? $attr['descfontSubset'] : '';

			$load_google_font_auth = isset( $attr['authloadGoogleFont'] ) ? $attr['authloadGoogleFont'] : '';
			$font_family_auth      = isset( $attr['authtypography'] ) ? $attr['authtypography'] : '';
			$font_weight_auth      = isset( $attr['authfontWeight'] ) ? $attr['authfontWeight'] : '';
			$font_subset_auth      = isset( $attr['authfontSubset'] ) ? $attr['authfontSubset'] : '';

			$load_google_font_date = isset( $attr['dateloadGoogleFont'] ) ? $attr['dateloadGoogleFont'] : '';
			$font_family_date      = isset( $attr['datetypography'] ) ? $attr['datetypography'] : '';
			$font_weight_date      = isset( $attr['datefontWeight'] ) ? $attr['datefontWeight'] : '';
			$font_subset_date      = isset( $attr['datefontSubset'] ) ? $attr['datefontSubset'] : '';

			IEPA_Helper::blocks_google_font( $load_google_font_desc, $font_family_desc, $font_weight_desc, $font_weight_desc );
			IEPA_Helper::blocks_google_font( $load_google_font_auth, $font_family_auth, $font_weight_auth, $font_subset_auth );
			IEPA_Helper::blocks_google_font( $load_google_font_date, $font_family_date, $font_weight_date, $font_subset_date );
		}

		public static function get_product_meta_gfonts( $attr ) {

			$load_google_font_sku = isset( $attr['skuloadGoogleFont'] ) ? $attr['skuloadGoogleFont'] : '';
			$font_family_sku      = isset( $attr['skutypography'] ) ? $attr['skutypography'] : '';
			$font_weight_sku      = isset( $attr['skufontWeight'] ) ? $attr['skufontWeight'] : '';
			$font_weight_sku      = isset( $attr['skufontSubset'] ) ? $attr['skufontSubset'] : '';

			$load_google_font_tag = isset( $attr['tagloadGoogleFont'] ) ? $attr['tagloadGoogleFont'] : '';
			$font_family_tag      = isset( $attr['tagtypography'] ) ? $attr['tagtypography'] : '';
			$font_weight_tag      = isset( $attr['tagfontWeight'] ) ? $attr['tagfontWeight'] : '';
			$font_subset_tag      = isset( $attr['tagfontSubset'] ) ? $attr['tagfontSubset'] : '';

			$load_google_font_cat = isset( $attr['catloadGoogleFont'] ) ? $attr['catloadGoogleFont'] : '';
			$font_family_cat      = isset( $attr['cattypography'] ) ? $attr['cattypography'] : '';
			$font_weight_cat      = isset( $attr['catfontWeight'] ) ? $attr['catfontWeight'] : '';
			$font_subset_cat      = isset( $attr['catfontSubset'] ) ? $attr['catfontSubset'] : '';

			$id = isset($attr['uniqueID']) ? $attr['uniqueID'] : '';
			$base_selector = '.iepa_product_meta';
			$selector      = $base_selector . $id . ' .ipea_icon_share_parent';

			global $post;
			// Get the featured image.
			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( $post->ID );
				$thumbnail    = $thumbnail_id ? current( wp_get_attachment_image_src( $thumbnail_id, 'large', true ) ) : '';
			} else {
				$thumbnail = null;
			}

			ob_start();
			?>
			var ssLinks = document.querySelectorAll( '<?php echo esc_attr( $selector ); ?>' );
			for ( var j = 0; j < ssLinks.length; j++ ) {
				var ssLink = ssLinks[j].querySelectorAll( "a[data-href]" );
				for ( var i = 0; i < ssLink.length; i++ ) {
					ssLink[i].addEventListener( "click", function() {
						var social_url = this.dataset.href;
						var target = this.getAttribute('target');
						if( social_url == "mailto:?body=" ) {
							target = "_self";
						}
						var  request_url ="";
						if( social_url.indexOf("/pin/create/link/?url=") !== -1) {
							request_url = social_url + window.location.href + "&media=" + '<?php echo esc_url( $thumbnail ); ?>';
						}else{
							request_url = social_url + window.location.href;
						}
						window.open( request_url, target );
					});
				}
			}
			<?php
			return ob_get_clean();

			IEPA_Helper::blocks_google_font( $load_google_font_sku, $font_family_sku, $font_weight_sku, $font_weight_sku );
			IEPA_Helper::blocks_google_font( $load_google_font_tag, $font_family_tag, $font_weight_tag, $font_subset_tag );
			IEPA_Helper::blocks_google_font( $load_google_font_cat, $font_family_cat, $font_weight_cat, $font_subset_cat );
		}

		public static function get_product_sale_countdown_gfonts( $attr ) {

			$load_google_font = isset( $attr['loadGoogleFont'] ) ? $attr['loadGoogleFont'] : '';
			$font_family      = isset( $attr['fontFamily'] ) ? $attr['fontFamily'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

			ob_start();
			?>

			// region Sales Countdown
			var salesCounter = jQuery( '.ibtanaecommerceproductaddons-sale_counter' );

			if ( salesCounter.length ) {
				var
					date      = salesCounter.data( 'date-end' ),
					timeParts = ['days', 'hours', 'minutes', 'seconds'],
					timeEls   = {};

				for ( var i = 0; i < timeParts.length; i ++ ) {
					timeEls[timeParts[i]] = {
						circ: salesCounter.find( '.woob-timr-arc-' + timeParts[i] ),
						num : salesCounter.find( '.woob-timr-number-' + timeParts[i] ),
					};
				}

				timeEls['days'].max = 31;
				timeEls['hours'].max = 24;
				timeEls['minutes'].max = 60;
				timeEls['seconds'].max = 60;

				setInterval( function () {
					var
						dt      = new Date(),
						timeNow = Math.floor( dt.getTime() / 1000 ),
						diff    = date - timeNow;
					timeEls['days'].val = Math.floor( diff / (
						60 * 60 * 24
					) );
					timeEls['hours'].val = Math.floor( diff % (
						60 * 60 * 24
					) / (
																							 60 * 60
																						 ) );
					timeEls['minutes'].val = Math.floor( diff % (
						60 * 60
					) / 60 );
					timeEls['seconds'].val = Math.floor( diff % 60 );

					for ( var j = 0; j < timeParts.length; j ++ ) {
						var els = timeEls[timeParts[j]];
						els.circ.attr( 'stroke-dasharray', els.val * 100 / els.max + ',100' );
						els.num.html( els.val );
					}

				}, 1000 );
			}
			// endregion Sales Countdown

			<?php
			return ob_get_clean();

			IEPA_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

	}
}
