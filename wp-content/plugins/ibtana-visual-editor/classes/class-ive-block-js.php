<?php
/**
 * IVE Block Helper.
 *
 * @package IVE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'IVE_Block_JS' ) ) {

	/**
	 * Class IVE_Block_JS.
	 */
	class IVE_Block_JS {

		public static function get_productscarousel_gfonts( $attr ) {

			$googleFontC	=	isset( $attr['googleFontC'] ) ? $attr['googleFontC'] : false;
			$typographyC	=	isset( $attr['typographyC'] ) ? $attr['typographyC'] : '';
			$fontWeightC	=	isset( $attr['fontWeightC'] ) ? $attr['fontWeightC'] : '';
			$fontSubsetC	=	isset( $attr['fontSubsetC'] ) ? $attr['fontSubsetC'] : '';
			IVE_Helper::blocks_google_font( $googleFontC, $typographyC, $fontWeightC, $fontSubsetC );

			$googleFont	=	isset( $attr['googleFont'] ) ? $attr['googleFont'] : false;
			$typography	= isset( $attr['typography'] ) ? $attr['typography'] : '';
			$fontWeight	=	isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$fontSubset	=	isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';
			IVE_Helper::blocks_google_font( $googleFont, $typography, $fontWeight, $fontSubset );

			$googleFontT	=	isset( $attr['googleFontT'] ) ? $attr['googleFontT'] : false;
			$typographyT	=	isset( $attr['typographyT'] ) ? $attr['typographyT'] : '';
			$fontWeightT	=	isset( $attr['fontWeightT'] ) ? $attr['fontWeightT'] : '';
			$fontSubsetT	=	isset( $attr['fontSubsetT'] ) ? $attr['fontSubsetT'] : '';
			IVE_Helper::blocks_google_font( $googleFontT, $typographyT, $fontWeightT, $fontSubsetT );

			$googleFontPrice	=	isset( $attr['googleFontPrice'] ) ? $attr['googleFontPrice'] : false;
			$typographyPrice	=	isset( $attr['typographyPrice'] ) ? $attr['typographyPrice'] : '';
			$fontWeightPrice	=	isset( $attr['fontWeightPrice'] ) ? $attr['fontWeightPrice'] : '';
			$fontSubsetPrice	=	isset( $attr['fontSubsetPrice'] ) ? $attr['fontSubsetPrice'] : '';
			IVE_Helper::blocks_google_font( $googleFontPrice, $typographyPrice, $fontWeightPrice, $fontSubsetPrice );

			$googleFontBadge	=	isset( $attr['googleFontBadge'] ) ? $attr['googleFontBadge'] : false;
			$typographyBadge	=	isset( $attr['typographyBadge'] ) ? $attr['typographyBadge'] : '';
			$fontWeightBadge	=	isset( $attr['fontWeightBadge'] ) ? $attr['fontWeightBadge'] : '';
			$fontSubsetBadge	=	isset( $attr['fontSubsetBadge'] ) ? $attr['fontSubsetBadge'] : '';
			IVE_Helper::blocks_google_font( $googleFontBadge, $typographyBadge, $fontWeightBadge, $fontSubsetBadge );

			$wishBtnGoogleFont	=	isset( $attr['wishBtnGoogleFont'] ) ? $attr['wishBtnGoogleFont'] : false;
			$wishBtnTypography	=	isset( $attr['wishBtnTypography'] ) ? $attr['wishBtnTypography'] : '';
			$wishBtnFontWeight	=	isset( $attr['wishBtnFontWeight'] ) ? $attr['wishBtnFontWeight'] : '';
			$wishBtnFontSubset	=	isset( $attr['wishBtnFontSubset'] ) ? $attr['wishBtnFontSubset'] : '';
			IVE_Helper::blocks_google_font( $wishBtnGoogleFont, $wishBtnTypography, $wishBtnFontWeight, $wishBtnFontSubset );

			$compareBtnGoogleFont	=	isset( $attr['compareBtnGoogleFont'] ) ? $attr['compareBtnGoogleFont'] : false;
			$compareBtnTypography	=	isset( $attr['compareBtnTypography'] ) ? $attr['compareBtnTypography'] : '';
			$compareBtnFontWeight	=	isset( $attr['compareBtnFontWeight'] ) ? $attr['compareBtnFontWeight'] : '';
			$compareBtnFontSubset	=	isset( $attr['compareBtnFontSubset'] ) ? $attr['compareBtnFontSubset'] : '';
			IVE_Helper::blocks_google_font( $compareBtnGoogleFont, $compareBtnTypography, $compareBtnFontWeight, $compareBtnFontSubset );

			$quickViewBtnGoogleFont	=	isset( $attr['quickViewBtnGoogleFont'] ) ? $attr['quickViewBtnGoogleFont'] : false;
			$quickViewBtnTypography	=	isset( $attr['quickViewBtnTypography'] ) ? $attr['quickViewBtnTypography'] : '';
			$quickViewBtnFontWeight	=	isset( $attr['quickViewBtnFontWeight'] ) ? $attr['quickViewBtnFontWeight'] : '';
			$quickViewBtnFontSubset	=	isset( $attr['quickViewBtnFontSubset'] ) ? $attr['quickViewBtnFontSubset'] : '';
			IVE_Helper::blocks_google_font( $quickViewBtnGoogleFont, $quickViewBtnTypography, $quickViewBtnFontWeight, $quickViewBtnFontSubset );

			$paginationGoogleFont	=	isset( $attr['paginationGoogleFont'] ) ? $attr['paginationGoogleFont'] : false;
			$paginationTypography	=	isset( $attr['paginationTypography'] ) ? $attr['paginationTypography'] : '';
			$paginationFontWeight	=	isset( $attr['paginationFontWeight'] ) ? $attr['paginationFontWeight'] : '';
			$paginationFontSubset	=	isset( $attr['paginationFontSubset'] ) ? $attr['paginationFontSubset'] : '';
			IVE_Helper::blocks_google_font( $paginationGoogleFont, $paginationTypography, $paginationFontWeight, $paginationFontSubset );

		}

		public static function get_productscarousel_js( $attr, $uniqueID ) {


			$contents = '';


			if (
				isset( $attr['displaySocialShareIcons'] ) &&
				(
					( $attr['displaySocialShareIcons'][0] == 'true' ) ||
					( $attr['displaySocialShareIcons'][1] == 'true' ) ||
					( $attr['displaySocialShareIcons'][2] == 'true' )
				)
			) {
				ob_start();
				?>
					var $uniqueID = '<?php echo esc_attr( $uniqueID ); ?>';
					var $all_ive_posttype_carousel	=	document.querySelectorAll( '#ive-posttype-carousel' + $uniqueID );
					for( var k = 0; k < $all_ive_posttype_carousel.length; k++ ) {
						var $single_ive_posttype_carousel = $all_ive_posttype_carousel[k];
						var $all_ive_posttype_carousel_social_links = $single_ive_posttype_carousel.querySelectorAll( 'a[data-href]' );
						for( var m = 0; m < $all_ive_posttype_carousel_social_links.length; m++ ) {
							var $single_ive_posttype_carousel_social_link = $all_ive_posttype_carousel_social_links[m];
							$single_ive_posttype_carousel_social_link.addEventListener( 'click', function() {
								var $social_url = this.getAttribute( 'data-href' );
								var $target			=	this.getAttribute( 'target' );
								if( $social_url.indexOf( 'mailto:?body=' ) !== -1 ) {
	                $target = "_self";
	              }
								window.open( $social_url, $target );
							});
						}
					}
				<?php
				$contents .= ob_get_clean();
			}


			if (
				isset( $attr['isPaginationEnabled'] ) &&
				( true == $attr['isPaginationEnabled'] ) &&
				isset( $attr['paginationType'] ) &&
				( 'loadmore' == $attr['paginationType'] )
			) {
				ob_start();
				?>
					var $uniqueID = '<?php echo esc_attr( $uniqueID ); ?>';
					var $all_ive_posttype_carousel	=	document.querySelectorAll( '#ive-posttype-carousel' + $uniqueID );
					for( var n = 0; n < $all_ive_posttype_carousel.length; n++ ) {
						var $single_ive_posttype_carousel = $all_ive_posttype_carousel[n];
						var $single_ive_posttype_carousel_load_more_link = $single_ive_posttype_carousel.querySelector( '.ive-loadmore-action' );
						$single_ive_posttype_carousel_load_more_link.addEventListener( 'click', function(e) {
							e.preventDefault();
							let that		=	$(this);
							let parents	=	that.closest('.ive-block-wrapper');
							let paged  	=	parseInt(that.attr('data-pagenum'));
							var pages		=	parseInt(that.attr('data-pages'));
							if( that.hasClass( 'ive-disable' ) ) {
								return;
							} else {
								paged++;
								that.attr('data-pagenum', paged);
								if( paged == pages ) {
									that.addClass('ive-disable');
								} else {
									that.removeClass('ive-disable');
								}
							}
							jQuery.ajax({
		              url: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
		              type: 'POST',
		              data: {
		                action:     'ive_load_more',
		                paged:      paged,
		                blockId:    that.attr('data-blockid'),
		                postId:     that.attr('data-postid'),
		                blockName:  that.attr('data-blockname'),
		                isAjax:     true,
		                wpnonce:    '<?php echo esc_attr( wp_create_nonce( 'posttype_slider_nonce' ) ); ?>'
		              },
		              beforeSend: function() {
		                parents.addClass( 'ive-loading-active' );
		              },
		              success: function( data ) {
		                jQuery( 'div[id*="' + that.attr('data-blockid') + '"] .row:first' ).append( data );
		              },
		              complete:function() {
		                  parents.removeClass( 'ive-loading-active' );
		              },
		              error: function( xhr ) {
		                parents.removeClass( 'ive-loading-active' );
		              },
		          });
						});
					}
				<?php
				$contents .= ob_get_clean();
			}


			if ( $contents ) {
				return $contents;
			}
		}

		public static function get_social_share_js( $attr, $id ) {


			$base_selector	=	'.ive-svg-icons';
			$selector     	=	$base_selector . $id;
			global $post;
			// Get the featured image.
			if ( has_post_thumbnail() ) {
				$thumbnail_id	=	get_post_thumbnail_id( $post->ID );
				$thumbnail		=	$thumbnail_id ? current( wp_get_attachment_image_src( $thumbnail_id, 'large', true ) ) : '';
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
						var request_url =	"";
						if( social_url.indexOf("/pin/create/link/?url=") !== -1 ) {
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
		}

		public static function get_button_gfonts( $attr ) {

			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

			IVE_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
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

			IVE_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );

			IVE_Helper::blocks_google_font( $load_google_font_cont, $font_family_cont, $font_weight_cont, $font_subset_cont );
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

			IVE_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );

			IVE_Helper::blocks_google_font( $load_google_font_subtitle, $font_family_subtitle, $font_weight_subtitle, $font_subset_subtitle );
    }

		public static function get_advanced_text_gfonts( $attr ) {
			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

      IVE_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

		public static function get_accordion_title_gfonts( $attr ) {
			$load_google_font = isset( $attr['titleStyles'][ 0 ]['google'] ) ? $attr['titleStyles'][ 0 ]['google'] : '';
			$font_family      = isset( $attr['titleStyles'][ 0 ]['family'] ) ? $attr['titleStyles'][ 0 ]['family'] : '';
			$font_weight      = isset( $attr['titleStyles'][ 0 ]['fontWeight'] ) ? $attr['titleStyles'][ 0 ]['weight'] : '';
			$font_subset      = isset( $attr['titleStyles'][ 0 ]['fontSubset'] ) ? $attr['titleStyles'][ 0 ]['fontSubset'] : '';

      IVE_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}
		
		public static function get_form_button_gfont( $blockattr ){
			$load_google_font = isset( $attr['googleFont'] ) ? $attr['googleFont'] : '';
			$font_family      = isset( $attr['typography'] ) ? $attr['typography'] : '';
			$font_weight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$font_subset      = isset( $attr['fontSubset'] ) ? $attr['fontSubset'] : '';

			IVE_Helper::blocks_google_font( $load_google_font, $font_family, $font_weight, $font_subset );
		}

	}
}
