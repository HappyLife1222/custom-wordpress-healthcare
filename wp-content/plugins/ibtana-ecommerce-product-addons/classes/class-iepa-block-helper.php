<?php
/**
 * IEPA Block Helper.
 *
 * @package IEPA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'IEPA_Block_Helper' ) ) {

	/**
	 * Class IEPA_Block_Helper.
	 */
	class IEPA_Block_Helper {

		/**
		 * Get block CSS
		 *
		 * @since 1.19.0
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array The Widget List.
		 */

		public static function get_add_to_cart_css( $attr, $id ) {
			$defaults = IEPA_Helper::$block_list['iepa/iepa-add-to-cart']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$fontSizeType   =	isset( $attr['fontSizeType'] ) ? $attr['fontSizeType'] : 'px';
			$fontSizeDesk   = isset( $attr['fontSize'] ) ? $attr['fontSize'][0] . $fontSizeType . ' !important' : '12px';
			$fontSizeTab    = isset( $attr['fontSize'] ) ? $attr['fontSize'][1] . $fontSizeType . ' !important' : '12px';
			$fontSizeMob    = isset( $attr['fontSize'] ) ? $attr['fontSize'][2] . $fontSizeType . ' !important' : '12px';

			$fontFamily           = ( isset( $attr['fontFamily'] ) && $attr['fontFamily'] !== '' ) ? $attr['fontFamily'] : 'Open+Sans';
			$fontWeight           = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : 400;
			$fontStyle            = isset( $attr['fontStyle'] ) ? $attr['fontStyle'] : 'normal';
			$textTransform        = isset( $attr['textTransform'] ) ? $attr['textTransform'] : '';
			$letterSpacing        = isset( $attr['letterSpacing'] ) ? $attr['letterSpacing'] . 'px' : '0px';

			$radialBtnGrad 	= 'radial-gradient(at ' . $attr['vBgImgPosition'] . ',' . $attr['bgfirstcolorr'] . ' ' . $attr['bgGradLoc'] . '%, ' . $attr['bgSecondColr'] . ' ' . $attr['bgGradLocSecond'].'%) !important';
			$linearBtnGrad 	= 'linear-gradient(' . $attr['bgGradAngle'] . 'deg, ' . $attr['bgfirstcolorr'] . ' ' . $attr['bgGradLoc'] . '%, ' . $attr['bgSecondColr'] . ' ' . $attr['bgGradLocSecond'].'%) !important';
			$gradientColor 	= $attr['bgGradType'] === 'radial' ? $radialBtnGrad : $linearBtnGrad;

			$radialBtnHoverGrad 	= 'radial-gradient(at ' . $attr['vBgImgPosition'] . ',' . $attr['hovGradFirstColor'] . ' ' . $attr['bgGradLoc'] . '%, ' . $attr['hovGradSecondColor'] . ' ' . $attr['bgGradLocSecond'].'%) !important';
			$linearBtnHoerGrad 		= 'linear-gradient(' . $attr['bgGradAngle'] . 'deg, ' . $attr['hovGradFirstColor'] . ' ' . $attr['bgGradLoc'] . '%, ' . $attr['hovGradSecondColor'] . ' ' . $attr['bgGradLocSecond'].'%) !important';
			$gradientHoverColor		=	$attr['bgGradType'] === 'radial' ? $radialBtnHoverGrad : $linearBtnHoerGrad;

			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			if ( $attr['butPadImp'] == true ) {
				$padding_imp = $attr['buttonPadding'] . "px !important";
			} else {
				$padding_imp = $attr['buttonPadding'] . "px";
			}
			
			if ( $attr['butBodRadImp'] == true ) {
				$butBodRad_imp = $attr['buttonBorderRadius'] . '% !important';
			} else {
				$butBodRad_imp = $attr['buttonBorderRadius'] . '%';
			}
			
			if ( $attr['cartBorderColorImp'] == true ) {
				$cartBorderColorImp = $attr['buttonBorderSize'] . 'px solid ' . $attr['cartBorderColor'] . ' !important';
				$cartBorderColorImpHov = $attr['buttonBorderSize'] . 'px solid ' . $attr['cartBorderColorHov'] . ' !important';
			} else {
				$cartBorderColorImp = $attr['buttonBorderSize'] . 'px solid ' . $attr['cartBorderColor'];
				$cartBorderColorImpHov = $attr['buttonBorderSize'] . 'px solid ' . $attr['cartBorderColorHov'];
			}

			if ( $attr['quBorderImp'] == true ) {
				$bordercolor_imp =  $attr['quantityBorderSize'] . 'px solid' . $attr['quantityBorderColor'] . " !important";
				$bordercolorhov_imp =  $attr['quantityBorderSize'] . 'px solid' . $attr['quantityBorderColorHov']. " !important";
			} else {
				$bordercolor_imp = $attr['quantityBorderSize'] . 'px solid' . $attr['quantityBorderColor'];
				$bordercolorhov_imp = $attr['quantityBorderSize'] . 'px solid' . $attr['quantityBorderColorHov'];
			}

			if ( $attr['quColorImp'] == true ) {
				$qucolor_imp =  $attr['quantityTextColor']. " !important";
			} else {
				$qucolor_imp = $attr['quantityTextColor'];
			}
			if ( $attr['buttexColorImp'] == true ) {
				$buttexColorImp =  isset( $attr['cartTextColor'] ) ? $attr['cartTextColor'] . ' !important' : '#000000';
			} else {
				$buttexColorImp =isset( $attr['cartTextColor'] ) ? $attr['cartTextColor'] : '#000000';
			}

			if ( $attr['qubgColorImp'] == true ) {
				$qubgcolor_imp =  $attr['quantityBackgroundColor']. " !important";
			} else {
				$qubgcolor_imp = $attr['quantityBackgroundColor'];
			}
			if ( $attr['quPaddingImp'] == true ) {
				$quPaddingImp =  $attr['quantityPadding'] . "px !important";
			} else {
				$quPaddingImp = $attr['quantityPadding'];
			}
			if ( $attr['quBorderRadiusImp'] == true ) {
				$quBorderRadiusImp =  $attr['quantityBorderRadius'] . '% !important';
			} else {
				$quBorderRadiusImp = $attr['quantityBorderRadius'] . '%';
			}

			if ( $attr['butleftMarginImp'] == true ) {
				$butleftMarginImp_imp = isset($attr['buttonLeftMargin']) ? $attr['buttonLeftMargin'] . 'px !important' : '0px';
			} else {
				$butleftMarginImp_imp = isset($attr['buttonLeftMargin']) ? $attr['buttonLeftMargin'] . 'px' : '0px';
			}

			$appearance = '';
			if ( $attr['inputArrowStyle'] != true ) {
				$appearance = array(
					'appearance' => 'textfield',
					'-moz-appearance' => 'textfield',
					'-webkit-appearance' => 'textfield'
				);
			}

			$selectors	=	array(
				' .single_add_to_cart_button' => array(
					'color'					=>	$buttexColorImp,
					'border'				=>	$cartBorderColorImp,
					'padding'				=>	$padding_imp,
					'border-radius'			=>	$butBodRad_imp,
					'font-family'			=>	$fontFamily,
					'font-weight'			=>	$fontWeight . ' !important',
					'font-style'			=>	$fontStyle,
					'text-transform'		=>	$textTransform,
					'margin-left'			=> $butleftMarginImp_imp
				),
				' .qty'	=>	array(
					'font-family'			=>	$fontFamily . ' !important',
					'font-weight'			=>	$fontWeight,
					'font-style'			=>	$fontStyle,
					'color'							=>	$qucolor_imp,
					'background-color'	=>	$qubgcolor_imp,
					'padding'						=>	$quPaddingImp,
					'border'						=>	$bordercolor_imp,
					'border-radius'			=>	$quBorderRadiusImp
				),
				' .qty:hover'	=>	array(
					'border'						=>	$bordercolorhov_imp,
				),
				' .single_add_to_cart_button:hover' => array(
					'color'							=>	isset( $attr['cartTextColorHov'] ) ? $attr['cartTextColorHov'] . ' !important' : '#000000',
					'border'						=>	$cartBorderColorImpHov,
				)

			);

			$appearance = '';
			if ( $attr['inputArrowStyle'] != true ) {
				$selectors[' .qty']['appearance'] = 'textfield';
				$selectors[' .qty']['-moz-appearance'] = 'textfield';
				$selectors[' .qty']['-webkit-appearance'] = 'textfield';
			}

			if ( isset( $attr['gradientEnable'] ) && ( $attr['gradientEnable'] === true ) ) {
				$selectors[' .single_add_to_cart_button']['background-image']		=	$gradientColor;
				$selectors[' .single_add_to_cart_button:hover']['background-image']		=	$gradientHoverColor;
			} else {
				$selectors[' .single_add_to_cart_button']['background-color']							=	isset( $attr['btnBgColor'] ) ? $attr['btnBgColor'] . ' !important' : '#28303d';
				$selectors[' .single_add_to_cart_button:hover']['background-color']				=	isset( $attr['btnBgHoverColor'] ) ? $attr['btnBgHoverColor'] . ' !important' : '#28303d';
			}

			if ( isset( $attr['letterSpacing'] ) && ( $attr['letterSpacing'] != '' ) ) {
				$selectors[' .single_add_to_cart_button']['letter-spacing']	=	$attr['letterSpacing'] . 'px !important';
			}

			$d_selectors	=	array(
				' .qty'	=> array(
					'font-size'	=>	$fontSizeDesk
				),
				' .single_add_to_cart_button'	=>	array(
					'font-size'	=>	$fontSizeDesk
				)
			);

			$t_selectors	=	array(
				' .qty'	=> array(
					'font-size'	=>	$fontSizeTab
				),
				' .single_add_to_cart_button'	=>	array(
					'font-size'	=>	$fontSizeTab
				)
			);

			$m_selectors	=	array(
				' .qty'	=> array(
					'font-size'	=>	$fontSizeMob
				),
				' .single_add_to_cart_button'	=>	array(
					'font-size'	=>	$fontSizeMob
				)
			);

			$combined_selectors = array(
				'desktop'				=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_add_to_cart' . $attr['uniqueID'] );
		}

		public static function get_product_images_css( $attr, $id ) {
			$defaults = IEPA_Helper::$block_list['iepa/iepa-add-to-cart']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			$selectors	=	array(
				' .woocommerce-product-gallery'	=> array(
					'opacity'	=>	'1 !important;'
				)
			);


			if ( isset( $attr['galleryPosition'] ) ) {
				if ( $attr['galleryPosition'] === 'bottom' ) {
					$selectors[' .woocommerce-product-gallery ol']['padding']			=	0;
				} elseif ( $attr['galleryPosition'] === 'left' ) {
					$selectors[' .woocommerce-product-gallery ol']['position']					=	'absolute';
					$selectors[' .woocommerce-product-gallery ol']['top']								=	0;
					$selectors[' .woocommerce-product-gallery ol']['left']							=	0;
					$selectors[' .woocommerce-product-gallery ol']['padding']						=	0;
					$selectors[' .woocommerce-product-gallery ol']['overflow-y']				=	'scroll';
					$selectors[' .woocommerce-product-gallery ol']['height']						=	'84%';
					$selectors[' .woocommerce-product-gallery ol']['width']							=	'26%';
					$selectors[' .woocommerce-product-gallery ol']['scrollbar-width']		=	'thin';

					$selectors[' .woocommerce-product-gallery .flex-control-thumbs li']['float']	=	'unset';
					$selectors[' .woocommerce-product-gallery .flex-control-thumbs li']['width']	=	'100%';

					$selectors[' .woocommerce-product-gallery .flex-viewport']['display']			=	'inline-block';
					$selectors[' .woocommerce-product-gallery .flex-viewport']['margin-left']	=	'30%';

					$selectors[' .woocommerce-product-gallery .woocommerce-product-gallery__trigger']['right']	=	'-4rem';

				} elseif ( $attr['galleryPosition'] === 'right' ) {
					$selectors[' .woocommerce-product-gallery ol']['position']					=	'absolute';
					$selectors[' .woocommerce-product-gallery ol']['top']								=	0;
					$selectors[' .woocommerce-product-gallery ol']['right']							=	'-30%';
					$selectors[' .woocommerce-product-gallery ol']['padding']						=	0;
					$selectors[' .woocommerce-product-gallery ol']['overflow-y']				=	'scroll';
					$selectors[' .woocommerce-product-gallery ol']['height']						=	'84%';
					$selectors[' .woocommerce-product-gallery ol']['width']							=	'26%';
					$selectors[' .woocommerce-product-gallery ol']['scrollbar-width']		=	'thin';

					$selectors[' .woocommerce-product-gallery .flex-control-thumbs li']['float']	=	'unset';
					$selectors[' .woocommerce-product-gallery .flex-control-thumbs li']['width']	=	'100%';

					$selectors[' .woocommerce-product-gallery .flex-viewport']['display']			=	'inline-block';

				} elseif ( $attr['galleryPosition'] === 'top' ) {
					$selectors[' .woocommerce-product-gallery']['display']				=	'flex';
					$selectors[' .woocommerce-product-gallery']['flex-direction']	=	'column-reverse';

					$selectors[' .woocommerce-product-gallery ol']['padding']			=	0;

					$selectors[' .woocommerce-product-gallery .woocommerce-product-gallery__trigger']['top']	=	'11.5rem';
				}
			} else {
				$selectors[' .woocommerce-product-gallery ol']['padding']			=	0;
			}



			$combined_selectors = array(
				'desktop'				=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_product_images' . $attr['uniqueID'] );
		}

		public static function get_product_price_css( $attr, $id ) {
			$defaults = IEPA_Helper::$block_list['iepa/iepa-product-price']['attributes'];

			$attr = array_merge( $defaults, $attr );


			$fontSizeType   =	isset( $attr['fontSizeType'] ) ? $attr['fontSizeType'] : 'px';

			$letterSpacing 	= isset( $attr['letterSpacing'] ) ? $attr['letterSpacing'] . 'px' : '1px';

			$fontFamily           = ( isset( $attr['fontFamily'] ) && $attr['fontFamily'] !== '' ) ? $attr['fontFamily'] : 'Open+Sans';
			$fontWeight           = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : 400;
			$fontStyle            = isset( $attr['fontStyle'] ) ? $attr['fontStyle'] : 'normal';

			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			if ( $attr['letterspaImp'] == true ) {
				$letterSpacingr_imp =  $letterSpacing. " !important";
				$pricefontFamily_imp =  $fontFamily. " !important";
				$pricefontWeight_imp =  $fontWeight. " !important";
			} else {
				$pricefontFamily_imp =  $fontFamily;
				$letterSpacingr_imp = $letterSpacing;
				$pricefontWeight_imp = $fontWeight;
			}

			if ( $attr['rightMarginpaImp'] == true ) {
				$rightMarginpaImp =  isset($attr['priceBtnRightMargin']) ? $attr['priceBtnRightMargin'] . 'px !important' : '0px !important';
			} else {
				$rightMarginpaImp =  isset($attr['priceBtnRightMargin']) ? $attr['priceBtnRightMargin'] . 'px' : '0px';
			}

			if ( $attr['salepricecolorImp'] == true ) {
				$salecolord = $attr['salePriceFontColor'] . ' !important';
				$salecolordHov = $attr['salePriceHoverColor'] . ' !important';
			} else {
				$salecolord = $attr['salePriceFontColor'];
				$salecolordHov = $attr['salePriceHoverColor'];
			}
			if ( $attr['regularpricecolorImp'] == true ) {
				$regularpricecolorImp = $attr['regularPriceFontColor'] . ' !important';
				$regularpricecolorHov = $attr['regularPriceHoverColor'] . ' !important';
			} else {
				$regularpricecolorImp = $attr['regularPriceFontColor'];
				$regularpricecolorHov = $attr['regularPriceHoverColor'];
			}

			if ( isset($attr['butFontSizeImp']) == true ) {
				$fontSizeDesk   = isset( $attr['fontSize'] ) ? $attr['fontSize'][0] . $fontSizeType . ' !important' : '12px';
				$fontSizeTab    = isset( $attr['fontSize'] ) ? $attr['fontSize'][1] . $fontSizeType . ' !important' : '12px';
				$fontSizeMob    = isset( $attr['fontSize'] ) ? $attr['fontSize'][2] . $fontSizeType . ' !important' : '12px';
			} else {
				$fontSizeDesk   = isset( $attr['fontSize'] ) ? $attr['fontSize'][0] . $fontSizeType : '12px';
				$fontSizeTab    = isset( $attr['fontSize'] ) ? $attr['fontSize'][1] . $fontSizeType : '12px';
				$fontSizeMob    = isset( $attr['fontSize'] ) ? $attr['fontSize'][2] . $fontSizeType : '12px'; 
			}

			$selectors	=	array(
				'' =>	array(
					'display' => 'flex',
				),
				' del'				=>	array(
					'font-family'			=>	$pricefontFamily_imp,
					'font-weight'			=>	$pricefontWeight_imp,
					'font-style'			=>	$fontStyle,
					'letter-spacing'	=>  $letterSpacingr_imp,
					'color'						=>	$regularpricecolorImp,
					'order'						=>	$attr['regularpricePosition'],
					'margin-right'		=> $rightMarginpaImp
				),
				' del:hover'	=>	array(
					'color'						=>	$regularpricecolorHov
				),
				' del bdi'		=>	array(
					'color'						=>	$regularpricecolorImp,
					'font-size' 			=> 	$attr['regularfontPrice'] . 'px !important',
				),
				' del bdi:hover'		=>	array(
					'color'						=>	$regularpricecolorHov
				),

				' ins'				=>	array(
					'font-family'			=>	$pricefontFamily_imp,
					'font-weight'			=>	$pricefontWeight_imp,
					'font-style'			=>	$fontStyle,
					'letter-spacing'	=>  $letterSpacing,
					'color'						=>	$attr['salePriceFontColor']
				),
				' ins:hover'	=>	array(
					'color'						=>	$attr['salePriceHoverColor']
				),
				' ins bdi'		=>	array(
					'color'						=> $salecolord
				),
				' ins bdi:hover'		=>	array(
					'color'						=> $salecolordHov
				),
			);

			if ( $attr['hideRegularPrice'] === true ) {
				$selectors[' del']['display'] = 'none !important';
			}


			$d_selectors	= array(
				' del'	=>	array(
					'font-size'	=>	$fontSizeDesk,
					'padding-right'	=>	$attr['regularPriceBtnRightPadding'][0] . 'px'
				),
				' ins'	=>	array(
					'font-size'	=>	$fontSizeDesk
				)
			);

			$t_selectors	= array(
				' del'	=>	array(
					'font-size'	=>	$fontSizeTab,
					'padding-right'	=>	$attr['regularPriceBtnRightPadding'][1] . 'px'
				),
				' ins'	=>	array(
					'font-size'	=>	$fontSizeTab
				)
			);

			$m_selectors	=	array(
				' del'	=>	array(
					'font-size'	=>	$fontSizeMob,
					'padding-right'	=>	$attr['regularPriceBtnRightPadding'][2] . 'px'
				),
				' ins'	=>	array(
					'font-size'	=>	$fontSizeMob
				)
			);


			$combined_selectors = array(
				'desktop'				=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_product_price' . $attr['uniqueID'] );
		}

		public static function get_product_rating_css( $attr, $id ) {
			$defaults = IEPA_Helper::$block_list['iepa/iepa-product-review']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$fontSize             = isset( $attr['fontSize'] ) ? $attr['fontSize'] . 'px' : '16px';
			$letterSpacing        = isset( $attr['letterSpacing'] ) ? $attr['letterSpacing'] . 'px' : '0px';
			$textTransform        = isset( $attr['textTransform'] ) ? $attr['textTransform'] : '';
			$textColor            = isset( $attr['colorTextReview'] ) ? $attr['colorTextReview'] : '';
			$textHoverColor            = isset( $attr['reviewHoverColor'] ) ? $attr['reviewHoverColor'] : '';
			$reviewBgColor            = isset( $attr['reviewBgColor'] ) ? $attr['reviewBgColor'] : '';
			$reviewBgHovColor            = isset( $attr['reviewBgHovColor'] ) ? $attr['reviewBgHovColor'] : '';

			$typography           = ( isset( $attr['typography'] ) && $attr['typography'] !== '' ) ? $attr['typography'] : 'Open+Sans';
			$fontWeight           = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : 400;
			$fontStyle            = isset( $attr['fontStyle'] ) ? $attr['fontStyle'] : 'normal';



			$vBgImgPosition       = isset($attr['vBgImgPosition']) ? $attr['vBgImgPosition'] : '';
			$bgfirstcolorr        = isset($attr['bgfirstcolorr']) ? $attr['bgfirstcolorr'] : '';
			$bgGradLoc            = isset($attr['bgGradLoc']) ? $attr['bgGradLoc'] : '';
			$bgSecondColr         = isset($attr['bgSecondColr']) ? $attr['bgSecondColr'] : '';
			$bgGradLocSecond      = isset($attr['bgGradLocSecond']) ? $attr['bgGradLocSecond'] : '';

			$bgGradAngle          = isset($attr['bgGradAngle']) ? $attr['bgGradAngle'] : '';
			$bgGradType           = isset($attr['bgGradType']) ? $attr['bgGradType'] : '';

			$radialFilledGrad 		= 'radial-gradient(at '.$vBgImgPosition.' }, '.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.' '.$bgGradLocSecond.'%) !important';
			$linearFilledGrad 		= 'linear-gradient('.$bgGradAngle.'deg, '.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.' '.$bgGradLocSecond.'%) !important';
			$gradFilledColor 			= $bgGradType === 'radial' ? $radialFilledGrad : $linearFilledGrad;
			$filledGradColor 			= $attr['gradientDisable'] ? $gradFilledColor : 'unset !important';

			$colorReviewUnfilled  = isset($attr['colorReviewUnfilled']) ? $attr['colorReviewUnfilled'] : '';


			$activeGradColor1     = isset($attr['activeGradColor1']) ? $attr['activeGradColor1'] : '';
	    	$activeGradColor2     = isset($attr['activeGradColor2']) ? $attr['activeGradColor2'] : '';

			$radialUnfilledGrad 	= 'radial-gradient(at '.$vBgImgPosition.' }, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
	    	$linearUnfilledGrad 	= 'linear-gradient('.$bgGradAngle.'deg, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
			$gradUnfilledColor 		= $bgGradType === 'radial' ? $radialUnfilledGrad : $linearUnfilledGrad;
			$unfilledGradColor 		=	$attr['gradientDisable'] ? $gradUnfilledColor : 'unset !important';

			$colorReview          = isset($attr['colorReview']) ? $attr['colorReview'] : '';


			$hovGradFirstColor    = isset($attr['hovGradFirstColor']) ? $attr['hovGradFirstColor'] : '';
			$hovGradSecondColor   = isset($attr['hovGradSecondColor']) ? $attr['hovGradSecondColor'] : '';

			$radialFilledGradHov = 'radial-gradient(at '.$vBgImgPosition.' }, '.$hovGradFirstColor.' '.$bgGradLoc.'%, '.$hovGradSecondColor.' '.$bgGradLocSecond.'%) !important';
			$linearFilledGradHov = 'linear-gradient('.$bgGradAngle.'deg, '.$hovGradFirstColor.' '.$bgGradLoc.'%, '.$hovGradSecondColor.' '.$bgGradLocSecond.'%) !important';
			$gradFilledColorHov = $attr['bgGradType'] === 'radial' ? $radialFilledGradHov : $linearFilledGradHov;
			$filledGradHovColor = $attr['gradientDisable'] ? $gradFilledColorHov : 'unset !important';


			$colorReviewHov       = isset($attr['colorReviewHov']) ? $attr['colorReviewHov'] : '';


			$radunfilledGradHov			= 'radial-gradient(at '.$vBgImgPosition.' }, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
			$linearunfilledGradHov	= 'linear-gradient('.$bgGradAngle.'deg, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
			$gradUnfilledColorHov		= $attr['bgGradType'] === 'radial' ? $radunfilledGradHov : $linearunfilledGradHov;
			$unfilledGradHovColor		= $attr['gradientDisable'] ? $gradUnfilledColorHov : 'unset !important';


			$colorHovUnfilled     =	isset( $attr['colorHovUnfilled'] ) ? $attr['colorHovUnfilled'] : '';

			$reviewFontSize       =	isset( $attr['reviewFontSize'] ) ? $attr['reviewFontSize'] . 'em' : '1em';

			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			$selectors	=	array(
				' .iepa_product_review'				=>	array(
					'display'						=>	'flex'
				),
				' .iepa-review-link:hover'					=>	array(
					'color'	=>	$textHoverColor
				),
				' .iepa-review-link'			=>	array(
					'font-size'					=>	$fontSize,
					'letter-spacing'			=>	$letterSpacing,
					'text-transform'			=>	$textTransform,
					'color'						=>	$textColor,
					'font-family'				=>	$typography,
					'font-weight'				=>	$fontWeight,
					'font-style'				=>	$fontStyle,
					'background-color'			=>	$reviewBgColor
				),
				' .iepa-review-link:hover'			=>	array(
					'background-color'			=>	$reviewBgHovColor
				),
				' .star-rating:before'				=>	array(
					'background-image'	=>	$filledGradColor,
					'color'							=>	$colorReviewUnfilled
				),
				' .star-rating span:before'		=>	array(
					'background-image'	=>	$unfilledGradColor,
					'color'							=>	$colorReview
				),
				' .star-rating:hover span:before'		=>	array(
					'background-image'	=>	$filledGradHovColor,
					'color'							=>	$colorReviewHov
				),
				' .star-rating:hover:before'				=>	array(
					'background-image'	=>	$unfilledGradHovColor,
					'color'							=>	$colorHovUnfilled
				),
				' .star-rating'											=>	array(
					'font-size'					=>	$reviewFontSize . ' !important'
				)
			);


			if ( $attr['gradientDisable'] ) {
				$selectors[' .star-rating:before']['-webkit-text-fill-color']							=	'transparent';
				$selectors[' .star-rating:before']['-webkit-background-clip']							=	'text';

				$selectors[' .star-rating span:before']['-webkit-text-fill-color']				=	'transparent';
				$selectors[' .star-rating span:before']['-webkit-background-clip']				=	'text';

				$selectors[' .star-rating:hover span:before']['-webkit-text-fill-color']	=	'transparent';
				$selectors[' .star-rating:hover span:before']['-webkit-background-clip']	=	'text';

				$selectors[' .star-rating:hover:before']['-webkit-text-fill-color']				=	'transparent';
				$selectors[' .star-rating:hover:before']['-webkit-background-clip']				=	'text';
			}

			$combined_selectors = array(
				'desktop'				=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_product_review' . $attr['uniqueID'] );
		}

		public static function get_product_reviews_css( $attr, $id ) {
			$defaults = IEPA_Helper::$block_list['iepa/iepa-product-reviews']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			$unit = 'px';
			$descFontSize 	= !empty($attr['descFontSize']) ? $attr['descFontSize'] : [];
			$authFontSize 	= !empty($attr['authFontSize']) ? $attr['authFontSize'] : [];
			$dateFontSize 	= !empty($attr['dateFontSize']) ? $attr['dateFontSize'] : [];
			$imgHeight 		= !empty($attr['imgHeight']) ? $attr['imgHeight'] : [];
			$imgWidth 		= !empty($attr['imgWidth']) ? $attr['imgWidth'] : [];
			$descVisibility = !empty($attr['descVisibility']) ? $attr['descVisibility'] : ['true','true','true'];
			$authVisibility = !empty($attr['authVisibility']) ? $attr['authVisibility'] : ['true','true','true'];
			$dateVisibility = !empty($attr['dateVisibility']) ? $attr['dateVisibility'] : ['true','true','true'];
			$imgVisibility 	= !empty($attr['imgVisibility']) ? $attr['imgVisibility'] : ['true','true','true'];


			$selectors	= array(
				' .comment-text .description p'	=>	array(
					'letter-spacing'		=>	isset($attr['descletterSpacing']) ? $attr['descletterSpacing'].$unit : '1px',
					'text-transform'		=>	isset($attr['desctextTransform']) ? $attr['desctextTransform'] : '',
					'font-family'			=>	isset($attr['desctypography']) ? $attr['desctypography'] : '',
					'font-weight'			=>	isset($attr['descfontWeight']) ? $attr['descfontWeight'] : '400',
					'font-style'			=>	isset($attr['descfontStyle']) ? $attr['descfontStyle'] : 'normal',
					'color'					=>	isset($attr['descColor']) ? $attr['descColor'] : '#000',
				),
				' .comment-text .woocommerce-review__author' => array(
					'letter-spacing'		=>	isset($attr['authletterSpacing']) ? $attr['authletterSpacing'].$unit : '1px',
					'text-transform'		=>	isset($attr['authtextTransform']) ? $attr['authtextTransform'] : '',
					'font-family'			=>	isset($attr['authtypography']) ? $attr['authtypography'] : '',
					'font-weight'			=>	isset($attr['authfontWeight']) ? $attr['authfontWeight'] : '400',
					'font-style'			=>	isset($attr['authfontStyle']) ? $attr['authfontStyle'] : 'normal',
					'color'					=>	isset($attr['authColor']) ? $attr['authColor'] : '#000',
				),
				' .comment-text .woocommerce-review__published-date' => array(
					'letter-spacing'		=>	isset($attr['dateletterSpacing']) ? $attr['dateletterSpacing'].$unit : '1px',
					'text-transform'		=>	isset($attr['datetextTransform']) ? $attr['datetextTransform'] : '',
					'font-family'			=>	isset($attr['datetypography']) ? $attr['datetypography'] : '',
					'font-weight'			=>	isset($attr['datefontWeight']) ? $attr['datefontWeight'] : '400',
					'font-style'			=>	isset($attr['datefontStyle']) ? $attr['datefontStyle'] : 'normal',
					'color'					=>	isset($attr['dateColor']) ? $attr['dateColor'] : '#000',
				),
				' .comment-text .woocommerce-review__author:hover' => array(
					'color'					=>	isset($attr['authColorHov']) ? $attr['authColorHov'] : '#000',
				),
				' .comment-text .woocommerce-review__published-date:hover' => array(
					'color'					=>	isset($attr['dateColorHov']) ? $attr['dateColorHov'] : '',
				)
			);

			$d_selectors	= array(
				' .comment-text .description p'	=>	array(
					'font-size'	=>	$descFontSize[0].$unit
				),
				' .comment-text .description'	=>	array(
					'display'	=>	$descVisibility[0] == 'true' ? 'block' : 'none'
				),
				' .comment-text .woocommerce-review__author'	=>	array(
					'font-size'	=>	$authFontSize[0].$unit,
					'display'	=>	$authVisibility[0] == 'true' ? 'unset' : 'none'
				),
				' .comment-text .woocommerce-review__published-date' => array(
					'font-size'	=>	$dateFontSize[0].$unit,
					'display'	=>	$dateVisibility[0] == 'true' ? 'unset' : 'none'
				),
				' .comment_container .avatar' => array(
					'display'	=>	$imgVisibility[0] == 'true' ? 'unset' : 'none',
					'height'	=>	$imgHeight[0].$unit . '!important',
					'width'		=>	$imgWidth[0].$unit . '!important'
				)
			);

			$t_selectors	= array(
				' .comment-text .description p'	=>	array(
					'font-size'	=>	$descFontSize[1].$unit
				),
				' .comment-text .description'	=>	array(
					'display'	=>	$descVisibility[1] == 'true' ? 'block' : 'none'
				),
				' .comment-text .woocommerce-review__author'	=>	array(
					'font-size'	=>	$authFontSize[1].$unit,
					'display'	=>	$authVisibility[1] == 'true' ? 'unset' : 'none'
				),
				' .comment-text .woocommerce-review__published-date' => array(
					'font-size'	=>	$dateFontSize[1].$unit,
					'display'	=>	$dateVisibility[1] == 'true' ? 'unset' : 'none'
				),
				' .comment_container .avatar' => array(
					'display'	=>	$imgVisibility[1] == 'true' ? 'unset' : 'none',
					'height'	=>	$imgHeight[1].$unit . '!important',
					'width'		=>	$imgWidth[1].$unit . '!important'
				)
			);

			$m_selectors	= array(
				' .comment-text .description p'	=>	array(
					'font-size'	=>	$descFontSize[2].$unit
				),
				' .comment-text .description'	=>	array(
					'display'	=>	$descVisibility[2] == 'true' ? 'block' : 'none'
				),
				' .comment-text .woocommerce-review__author'	=>	array(
					'font-size'	=>	$authFontSize[2].$unit,
					'display'	=>	$authVisibility[2] == 'true' ? 'unset' : 'none'
				),
				' .comment-text .woocommerce-review__published-date' => array(
					'font-size'	=>	$dateFontSize[2].$unit,
					'display'	=>	$dateVisibility[2] == 'true' ? 'unset' : 'none'
				),
				' .comment_container .avatar' => array(
					'display'	=>	$imgVisibility[2] == 'true' ? 'unset' : 'none',
					'height'	=>	$imgHeight[2].$unit . '!important',
					'width'		=>	$imgWidth[2].$unit . '!important'
				)
			);

			$combined_selectors = array(
				'desktop'			=> $selectors,
				'desktop_media'		=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_product_reviews' . $attr['uniqueID'] );
		}

		public static function get_product_meta_css( $attr, $id ) {
			$defaults = IEPA_Helper::$block_list['iepa/iepa-product-meta']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$icons = $attr['sharearr'];
			$sharevisible = $attr['sharevisible'] ? 'block' : 'none';

			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			$selectors	= array(
				' .ipea_icon_share_parent'	=>	array(
					'display'		=>	$sharevisible
				),
				''	=>	array(
					'text-align'	=>	isset($attr['metaAlignment']) ? $attr['metaAlignment'] : 'left'
				)
			);

			foreach ($icons as $key => $icon) {

				$hoverClass = ' .iepa_icon_parent_'.$key.':hover';
				$mainClass = ' .iepa_icon_parent_'.$key;
				$mainIconClass = ' .iepa_icon_parent_'.$key.' i';

				$unit = 'px';
				$defaultval = '0'.$unit;
				$stylecon = ($icon['style'] == 'default');
				$background = isset($icon['background']) ? $icon['background'] : '#ffffff';
				$backgroundColor = $stylecon ? 'unset' : $background;
				$border = isset($icon['border']) ? $icon['border'] : '#444444';
				$borderColor = $stylecon ? 'unset' : $border;
				$bordWidth = isset($icon['borderWidth']) ? $icon['borderWidth'] : 2;
				$borderWidth = $stylecon ? $defaultval : $bordWidth.$unit;
				$bordRadius = isset($icon['borderRadius']) ? $icon['borderRadius'] : 0;
				$borderRadius = $stylecon ? $defaultval : $bordRadius.$unit;

				$deskpadding = isset($icon['deskpadding']) ? $icon['deskpadding'].$unit : '20'.$unit;
				$deskpadding2 = isset($icon['deskpadding2']) ? $icon['deskpadding2'].$unit : '20'.$unit;
				$paddingdesk = !$stylecon ? $deskpadding.' '.$deskpadding2 : 'unset' ;

				$tabpadding = isset($icon['tabpadding']) ? $icon['tabpadding'].$unit : '16'.$unit;
				$tabpadding2 = isset($icon['tabpadding2']) ? $icon['tabpadding2'].$unit : '16'.$unit;
				$paddingtab = !$stylecon ? $tabpadding.' '.$tabpadding2 : 'unset' ;

				$mobpadding = isset($icon['mobpadding']) ? $icon['mobpadding'].$unit : '12'.$unit;
				$mobpadding2 = isset($icon['mobpadding2']) ? $icon['mobpadding2'].$unit : '12'.$unit;
				$paddingmob = !$stylecon ? $mobpadding.' '.$mobpadding2 : 'unset' ;

				if(isset($icon['iconGrad']) && $icon['iconGrad']){
				  $gradRadPos = isset($icon['gradRadPos']) ? $icon['gradRadPos'] : '';
				  $gradFirstColor = isset($icon['gradFirstColor']) ? $icon['gradFirstColor'] : '';
				  $gradFirstLoc = isset($icon['gradFirstLoc']) ? $icon['gradFirstLoc']. '%' : '';
				  $gradSecondColor = isset($icon['gradSecondColor']) ? $icon['gradSecondColor'] : '';
				  $gradSecondLoc = isset($icon['gradSecondLoc']) ? $icon['gradSecondLoc'] .'%' : '';
				  $gradAngle = isset($icon['gradAngle']) ? $icon['gradAngle'] .'deg' : '';

				  $hovGradFirstColor = isset($icon['hovGradFirstColor']) ? $icon['hovGradFirstColor'] : '';
				  $hovGradSecondColor = isset($icon['hovGradSecondColor']) ? $icon['hovGradSecondColor'] : '';

				  if($icon['gradType'] === 'radial'){
					$gradient = ' radial-gradient(at '.$gradRadPos.', '. $gradFirstColor.' '. $gradFirstLoc .' '. $gradSecondColor .' '. $gradSecondLoc .' ) !important' ;
					$gradientHover = ' radial-gradient(at '.$gradRadPos.', '. $hovGradFirstColor.' '. $gradFirstLoc .' '. $gradSecondColor .' '. $gradSecondLoc .' ) !important' ;
				  }else{
					$gradient = ' linear-gradient('.$gradAngle.', '. $gradFirstColor.' '. $gradFirstLoc .', '. $gradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
					$gradientHover = ' linear-gradient('.$gradAngle.', '. $hovGradFirstColor.' '. $gradFirstLoc .', '. $hovGradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
				  }

				}else{
				  $gradient = ' unset !important';
				  $gradientHover = ' unset !important';
				}

				$borderStyle = isset($icon['borderStyle']) ? $icon['borderStyle'] : 'none';
				$color = isset($icon['color']) ? $icon['color'].' !important' : '#444444 !important';
				$hoverBackground = ( !$stylecon && isset($icon['hoverBackground'])) ? $icon['hoverBackground'] : 'undefined';
				$hoverBorder = ( !$stylecon && isset($icon['hoverBorder'])) ? $icon['hoverBorder'] : 'undefined';
				$hoverColor = isset($icon['hoverColor']) ? $icon['hoverColor'] : '#eeeeee';

				$deskpadding = isset($icon['deskpadding']) ? $icon['deskpadding'].$unit : '20'.$unit;
				$deskpadding2 = isset($icon['deskpadding2']) ? $icon['deskpadding2'].$unit : '20'.$unit;
				$paddingdesk = !$stylecon ? $deskpadding.' '.$deskpadding2 : 'unset' ;

				$tabpadding = isset($icon['tabpadding']) ? $icon['tabpadding'].$unit : '16'.$unit;
				$tabpadding2 = isset($icon['tabpadding2']) ? $icon['tabpadding2'].$unit : '16'.$unit;
				$paddingtab = !$stylecon ? $tabpadding.' '.$tabpadding2 : 'unset' ;

				$mobpadding = isset($icon['mobpadding']) ? $icon['mobpadding'].$unit : '12'.$unit;
				$mobpadding2 = isset($icon['mobpadding2']) ? $icon['mobpadding2'].$unit : '12'.$unit;
				$paddingmob = !$stylecon ? $mobpadding.' '.$mobpadding2 : 'unset' ;

				$desksize = isset($icon['desksize']) ? $icon['desksize'].$unit : '50'.$unit;
				$deskwidth = (isset($icon['deskwidth']) && $icon['deskwidth'] != 0 ) ? $icon['deskwidth'].$unit : 'auto';
				$deskheight = (isset($icon['deskheight']) && $icon['deskheight'] != 0 ) ? $icon['deskheight'].$unit : 'auto';

				//tablet icon css
				$tabsize = isset($icon['tabsize']) ? $icon['tabsize'].$unit : '35'.$unit;
				$tabwidth = (isset($icon['tabwidth']) && $icon['tabwidth'] != 0 ) ? $icon['tabwidth'].$unit : 'auto';
				$tabheight = (isset($icon['tabheight']) && $icon['tabheight'] != 0 ) ? $icon['tabheight'].$unit : 'auto';

				//mobile icon css
				$mobsize = isset($icon['mobsize']) ? $icon['mobsize'].$unit : '20'.$unit;
				$mobwidth = (isset($icon['mobwidth']) && $icon['mobwidth'] != 0 ) ? $icon['mobwidth'].$unit : 'auto';
				$mobheight = (isset($icon['mobheight']) && $icon['mobheight'] != 0 ) ? $icon['mobheight'].$unit : 'auto';

				$visible = $icon['visible'] ? 'inline-block' : 'none';

				$selectors[$hoverClass]['background'] = $hoverBackground;
				$selectors[$hoverClass]['color'] = isset($icon['hoverColor']) ? $icon['hoverColor'] : '';
				$selectors[$hoverClass]['border-color'] = $hoverBorder;
				$selectors[$hoverClass]['background-image'] = $gradientHover;

				$selectors[$mainClass]['background-image'] = $gradient;
				$selectors[$mainClass]['margin-left'] = '15px';
				$selectors[$mainClass]['border-style'] = $borderStyle;
				$selectors[$mainClass]['border-color'] = $borderColor;
				$selectors[$mainClass]['color'] = $color;
				$selectors[$mainClass]['background-color'] = $backgroundColor;
				$selectors[$mainClass]['border-width'] = $borderWidth;
				$selectors[$mainClass]['border-radius'] = $borderRadius;
				$selectors[$mainClass]['line-height'] = 0;
				$selectors[$mainClass]['display'] = $visible;

				$m_selectors[$mainIconClass]['font-size'] = $mobsize;
				$m_selectors[$mainIconClass]['padding'] = $paddingmob;
				$m_selectors[$mainIconClass]['width'] = $mobwidth;
				$m_selectors[$mainIconClass]['height'] = $mobheight;

				$t_selectors[$mainIconClass]['font-size'] = $tabsize;
				$t_selectors[$mainIconClass]['padding'] = $paddingtab;
				$t_selectors[$mainIconClass]['width'] = $tabwidth;
				$t_selectors[$mainIconClass]['height'] = $tabheight;

				$d_selectors[$mainIconClass]['font-size'] = $desksize;
				$d_selectors[$mainIconClass]['padding'] = $paddingdesk;
				$d_selectors[$mainIconClass]['width'] = $deskwidth;
				$d_selectors[$mainIconClass]['height'] = $deskheight;
			}

			$skuletterSpacing = isset($attr['skuletterSpacing']) ? $attr['skuletterSpacing'].$unit : '1px';
			$skutextTransform = isset($attr['skutextTransform']) ? $attr['skutextTransform'] : '';
			$skutypography = isset($attr['skutypography']) ? $attr['skutypography'] : '';
			$skufontWeight =	isset($attr['skufontWeight']) ? $attr['skufontWeight'] : '400';
			$skufontStyle = isset($attr['skufontStyle']) ? $attr['skufontStyle'] : 'normal';
			$skuColor = isset($attr['skuColor']) ? $attr['skuColor'] : '#000';

			$tagletterSpacing = isset($attr['tagletterSpacing']) ? $attr['tagletterSpacing'].$unit : '1px';
			$tagtextTransform = isset($attr['tagtextTransform']) ? $attr['tagtextTransform'] : '';
			$tagtypography = isset($attr['tagtypography']) ? $attr['tagtypography'] : '';
			$tagfontWeight =	isset($attr['tagfontWeight']) ? $attr['tagfontWeight'] : '400';
			$tagfontStyle = isset($attr['tagfontStyle']) ? $attr['tagfontStyle'] : 'normal';
			$tagColor = isset($attr['tagColor']) ? $attr['tagColor'] : '#000';

			$catletterSpacing = isset($attr['catletterSpacing']) ? $attr['catletterSpacing'].$unit : '1px';
			$cattextTransform = isset($attr['cattextTransform']) ? $attr['cattextTransform'] : '';
			$cattypography = isset($attr['cattypography']) ? $attr['cattypography'] : '';
			$catfontWeight =	isset($attr['catfontWeight']) ? $attr['catfontWeight'] : '400';
			$catfontStyle = isset($attr['catfontStyle']) ? $attr['catfontStyle'] : 'normal';
			$catColor = isset($attr['catColor']) ? $attr['catColor'] : '#000';

			$selectors[' .ibtanaecommerceproductaddons-sku']['letter-spacing'] = $skuletterSpacing;
			$selectors[' .ibtanaecommerceproductaddons-sku']['text-transform'] = $skutextTransform;
			$selectors[' .ibtanaecommerceproductaddons-sku']['font-family'] = $skutypography;
			$selectors[' .ibtanaecommerceproductaddons-sku']['font-weight'] = $skufontWeight;
			$selectors[' .ibtanaecommerceproductaddons-sku']['font-style'] = $skufontStyle;
			$selectors[' .ibtanaecommerceproductaddons-sku']['color'] = $skuColor;

			$selectors[' .tagged_as a']['letter-spacing'] = $tagletterSpacing;
			$selectors[' .tagged_as a']['text-transform'] = $tagtextTransform;
			$selectors[' .tagged_as a']['font-family'] = $tagtypography;
			$selectors[' .tagged_as a']['font-weight'] = $tagfontWeight;
			$selectors[' .tagged_as a']['font-style'] = $tagfontStyle;
			$selectors[' .tagged_as a']['color'] = $tagColor;

			$selectors[' .posted_in a']['letter-spacing'] = $catletterSpacing;
			$selectors[' .posted_in a']['text-transform'] = $cattextTransform;
			$selectors[' .posted_in a']['font-family'] = $cattypography;
			$selectors[' .posted_in a']['font-weight'] = $catfontWeight;
			$selectors[' .posted_in a']['font-style'] = $catfontStyle;
			$selectors[' .posted_in a']['color'] = $catColor;

			$desksku = isset($icon['skuFontSize']) ? $icon['skuFontSize'][0].$unit : '18'.$unit;
			$desktag = isset($icon['tagFontSize']) ? $icon['tagFontSize'][0].$unit : '18'.$unit;
			$deskcat = isset($icon['catFontSize']) ? $icon['catFontSize'][0].$unit : '18'.$unit;

			$tabsku = isset($icon['skuFontSize']) ? $icon['skuFontSize'][1].$unit : '16'.$unit;
			$tabtag = isset($icon['tagFontSize']) ? $icon['tagFontSize'][1].$unit : '16'.$unit;
			$tabcat = isset($icon['catFontSize']) ? $icon['catFontSize'][1].$unit : '16'.$unit;

			$mobsku = isset($icon['skuFontSize']) ? $icon['skuFontSize'][2].$unit : '14'.$unit;
			$mobtag = isset($icon['tagFontSize']) ? $icon['tagFontSize'][2].$unit : '14'.$unit;
			$mobcat = isset($icon['catFontSize']) ? $icon['catFontSize'][2].$unit : '14'.$unit;

			$m_selectors[' .tagged_as a']['font-size'] = $mobtag;
			$t_selectors[' .tagged_as a']['font-size'] = $tabtag;
			$d_selectors[' .tagged_as a']['font-size'] = $desktag;

			$m_selectors[' .ibtanaecommerceproductaddons-sku']['font-size'] = $mobsku;
			$t_selectors[' .ibtanaecommerceproductaddons-sku']['font-size'] = $tabsku;
			$d_selectors[' .ibtanaecommerceproductaddons-sku']['font-size'] = $desksku;

			$m_selectors[' .posted_in a']['font-size'] = $mobcat;
			$t_selectors[' .posted_in a']['font-size'] = $tabcat;
			$d_selectors[' .posted_in a']['font-size'] = $deskcat;

			$combined_selectors = array(
				'desktop'			=> $selectors,
				'desktop_media'		=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_product_meta' . $attr['uniqueID'] );
		}

		public static function get_product_sale_countdown_css( $attr, $id ) {

			$defaults = IEPA_Helper::$block_list['iepa/iepa-product-sale-countdown']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$fontFamily     = ( isset( $attr['fontFamily'] ) && $attr['fontFamily'] !== '' ) ? $attr['fontFamily'] : 'Open+Sans';
			$fontWeight     = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : 400;
			$fontSizeDesk   = isset( $attr['fontSize'] ) ? $attr['fontSize'][0] . 'px !important' : '12px';
			$fontSizeTab    = isset( $attr['fontSize'] ) ? $attr['fontSize'][1] . 'px !important' : '12px';
			$fontSizeMob    = isset( $attr['fontSize'] ) ? $attr['fontSize'][2] . 'px !important' : '12px';
			$blockAlignment = isset( $attr['blockAlignment'] ) ? $attr['blockAlignment'] : 'center';
			$textColor 			= isset( $attr['textColor'] ) ? $attr['textColor'] : '#000';
			$textHoverColor = isset( $attr['textHoverColor'] ) ? $attr['textHoverColor'] : '#000';
			$textTransform  = isset( $attr['pctextTransform'] ) ? $attr['pctextTransform'] : '';
			$letterSpacing 	= isset( $attr['letterSpacing'] ) ? $attr['letterSpacing'] . 'px' : '1px';
			$blockStyle			= isset( $attr['blockStyle'] ) ? $attr['blockStyle'] : 'around';
			$circleBgColor 	= isset( $attr['circleBgColor'] ) ? $attr['circleBgColor'] : '#000';
			$circleBgColorHov 	= isset( $attr['circleBgColorHov'] ) ? $attr['circleBgColorHov'] : '#000';
			$selectors   = array();
			$d_selectors = array();
			$t_selectors = array();
			$m_selectors = array();

			if ($blockStyle == 'above') {
				$selectors   = array(
					'.ibtanaecommerceproductaddons-sale_counter_wrap:not([class*="woobuilder-style"]) .woob-timr-number' => array(
						'margin' => 'unset !important'
					),
					'.ibtanaecommerceproductaddons-sale_counter_wrap:not([class*="woobuilder-style"]) .woob-timr-number, .ibtanaecommerceproductaddons-sale_counter_wrap:not([class*="woobuilder-style"]) .woob-timr-label' => array(
						'position' => 'unset !important',
						'top' => 'unset !important',
						'left' => 'unset !important',
						'right' => 'unset !important'
					),
					'.ibtanaecommerceproductaddons-sale_counter_wrap svg' => array(
						'order' => 7
					)
				);
			} elseif ($blockStyle == 'below') {
				$selectors   = array(
					'.ibtanaecommerceproductaddons-sale_counter_wrap:not([class*="woobuilder-style"]) .woob-timr-number' => array(
						'margin' => 'unset !important'
					),
					'.ibtanaecommerceproductaddons-sale_counter_wrap:not([class*="woobuilder-style"]) .woob-timr-number, .ibtanaecommerceproductaddons-sale_counter_wrap:not([class*="woobuilder-style"]) .woob-timr-label' => array(
						'position' => 'unset !important',
						'top' => 'unset !important',
						'left' => 'unset !important',
						'right' => 'unset !important'
					)
				);
			} elseif ($blockStyle == 'no-dial') {
				$selectors   = array(
					'.ibtanaecommerceproductaddons-sale_counter_wrap svg' => array(
						'display' => 'none'
					),
				);
			}
			$selectors['']['font-size'] 	= $fontSizeDesk;
			$selectors['']['font-family'] = $fontFamily;
			$selectors['']['font-weight'] = $fontWeight;
			$selectors['']['text-align'] 	= $blockAlignment;
			$selectors['']['color'] 			= $textColor;
			$selectors['']['text-transform'] = $textTransform;
			$selectors['']['letter-spacing'] = $letterSpacing;
			$selectors[' .woob-timr:hover .woob-timr-number']['color'] = $textHoverColor;
			$selectors[' .woob-timr:hover .woob-timr-label']['color'] = $textHoverColor;
			$selectors[' svg circle:not([class*="woob-timr-arc-"])']['fill'] = $circleBgColor;
			$selectors[' svg circle:not([class*="woob-timr-arc-"]):hover']['fill'] = $circleBgColorHov;
			$t_selectors = array(
				''	=>	array(
					'font-size'	=>	$fontSizeTab
				)
			);

			$m_selectors = array(
				''	=>	array(
					'font-size'	=>	$fontSizeMob
				)
			);

			$combined_selectors = array(
				'desktop'			=> $selectors,
				'desktop_media'		=> $d_selectors,
				'tablet'  			=> $t_selectors,
				'mobile'  			=> $m_selectors
			);

			return IEPA_Helper::generate_all_css( $combined_selectors, ' .iepa_sale_countdown' . $attr['uniqueID'] );
		}
	}
}
