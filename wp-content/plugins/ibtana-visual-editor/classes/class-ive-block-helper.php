<?php
/**
 * UAGB Block Helper.
 *
 * @package UAGB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'IVE_Block_Helper' ) ) {

	/**
	 * Class IVE_Block_Helper.
	 */
	class IVE_Block_Helper {

		/**
		 * Get block CSS
		 *
		 * @since 1.19.0
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array The Widget List.
		 */
		public static function get_button_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/ibtana-visual-editorbtn']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$unit		=	'px';
			$index	=	0;
			$typography					=	isset($attr['typography']) ? ($attr['typography']) : '';
			$fonttypography			=	str_replace(' ','+',$typography);
			$fontfamilyname			=	( $typography !== '' ) ? $fonttypography : 'Open+Sans';
			$iconGrad						=	$attr['iconGrad'];
			$background					=	isset($attr['btns'][$index]['background']) ? ($attr['btns'][$index]['background']) : 'transparent';
			$backgroundHov			=	isset($attr['btns'][$index]['backgroundHover']) ? ($attr['btns'][$index]['backgroundHover']) : 'transparent';
			$mobpaddingBT				=	isset($attr['btns'][$index]['mobpaddingBT']) ? $attr['btns'][$index]['mobpaddingBT'] : 10;
			$mobpaddingLR				=	isset($attr['btns'][$index]['mobpaddingLR']) ? $attr['btns'][$index]['mobpaddingLR'] : 10;
			$tabpaddingBT				=	isset($attr['btns'][$index]['tabpaddingBT']) ? $attr['btns'][$index]['tabpaddingBT'] : 10;
			$tabpaddingLR				=	isset($attr['btns'][$index]['tabpaddingLR']) ? $attr['btns'][$index]['tabpaddingLR'] : 10;
			$deskpaddingBT			=	isset($attr['btns'][$index]['deskpaddingBT']) ? $attr['btns'][$index]['deskpaddingBT'] : 10;
			$deskpaddingLR			=	isset($attr['btns'][$index]['deskpaddingLR']) ? $attr['btns'][$index]['deskpaddingLR'] : 10;
			$vBgImgPosition			=	isset($attr['vBgImgPosition']) ? $attr['vBgImgPosition'] : 'center center';
			$bgfirstcolorr			=	isset($attr['bgfirstcolorr']) ? $attr['bgfirstcolorr'] : '';
			$hovGradFirstColor	=	isset($attr['hovGradFirstColor']) ? $attr['hovGradFirstColor'] : '';
			$bgGradLoc					=	isset($attr['bgGradLoc']) ? $attr['bgGradLoc'] : 0;
			$bgSecondColr				=	isset($attr['bgSecondColr']) ? $attr['bgSecondColr'] : '';
			$hovGradSecondColor	=	isset($attr['hovGradSecondColor']) ? $attr['hovGradSecondColor'] : '';
			$bgGradLocSecond		=	isset($attr['bgGradLocSecond']) ? $attr['bgGradLocSecond'] : 100;
			$bgGradAngle				=	isset($attr['bgGradAngle']) ? $attr['bgGradAngle'] : 180;


			if( 'radial' === $attr['bgGradType'] ) {
				$backgroundImage = 'radial-gradient(at '.$vBgImgPosition.','.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.' '.$bgGradLocSecond.'%)';
			}else{
				$backgroundImage = 'linear-gradient('.$bgGradAngle.'deg, '.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.'  '.$bgGradLocSecond.'%)';
			}

			if('radial' === $attr['bgGradType']){
				$backgroundImageHov = 'radial-gradient(at '.$vBgImgPosition.','.$hovGradFirstColor.' '.$bgGradLoc.'%, '.$hovGradSecondColor.' '.$bgGradLocSecond.'%)';
			}else{
				$backgroundImageHov = 'linear-gradient('.$bgGradAngle.'deg, '.$hovGradFirstColor.' '.$bgGradLoc.'%, '.$hovGradSecondColor.'  '.$bgGradLocSecond.'%)';
			}

			$hovericon = 'inline !important';
			if(isset($attr['iconDisableHover']) && $attr['iconDisableHover'] == 1){
			  $hovericon = 'none !important';
			}

			if( $attr['fontColorImp'] == true ){
				$color_imp = isset($attr['btns'][$index]['color'] ) ? $attr['btns'][$index]['color'] . ' !important': '#555555 !important';
				$color_hov_imp = isset($attr['btns'][$index]['colorHover']) ? $attr['btns'][$index]['colorHover'] . ' !important': '#555555 !important';
			}else {
				$color_imp = isset($attr['btns'][$index]['color']) ? $attr['btns'][$index]['color'] : '#555555';
				$color_hov_imp = isset($attr['btns'][$index]['colorHover']) ? $attr['btns'][$index]['colorHover'] : '#555555';
			}

			if( $attr['borderColorImp'] == true ){
				$border_imp = isset($attr['btns'][$index]['border'] ) ? $attr['btns'][$index]['border'] . ' !important': 'transparent !important';
				$border_hov_imp = isset($attr['btns'][$index]['borderHover']) ? ($attr['btns'][$index]['borderHover'] . ' !important') : 'transparent !important';
			}else {
				$border_imp = isset($attr['btns'][$index]['border']) ? ($attr['btns'][$index]['border']) : 'transparent';
				$border_hov_imp = isset($attr['btns'][$index]['borderHover']) ? ($attr['btns'][$index]['borderHover']) : 'transparent';
			}
			if( $attr['backgColorImp'] == true ){
				$background_imp = !$iconGrad ? $background . ' !important' : 'unset !important';
				$background_hov_imp = !$iconGrad ? $backgroundHov . ' !important': 'unset !important';
				$background_ima_imp = $iconGrad ? $backgroundImage . ' !important' : 'unset !important';
				$background_img_hov_imp = $iconGrad ? $backgroundImageHov . ' !important' : 'unset !important';
			}else {
				$background_imp = !$iconGrad ? $background : 'unset';
				$background_hov_imp = !$iconGrad ? $backgroundHov : 'unset';
				$background_ima_imp = $iconGrad ? $backgroundImage . ' !important' : 'unset !important';
				$background_img_hov_imp = $iconGrad ? $backgroundImageHov : 'unset';
			}
			if( $attr['bgOpacityimp'] == true ){
				$bgOpacityimp_imp = isset($attr['bgOpacity']) ? $attr['bgOpacity'] . ' !important' : 1 . ' !important';
			}else {
				$bgOpacityimp_imp = isset($attr['bgOpacity']) ? $attr['bgOpacity'] : 1;
			}
			if( $attr['iconPadImp'] == true ){
				$icon_pad_imp_left	= isset($attr['btns'][$index]['iconpaddingleft']) ? $attr['btns'][$index]['iconpaddingleft'].$unit. ' !important' : '5'.$unit. ' !important';
				$icon_pad_imp_right	= isset($attr['btns'][$index]['iconpaddingright']) ? $attr['btns'][$index]['iconpaddingright'].$unit. ' !important' : '5'.$unit. ' !important';
				$icon_pad_imp_bottom	= isset($attr['btns'][$index]['iconpaddingbottom']) ? $attr['btns'][$index]['iconpaddingbottom'].$unit. ' !important' : '5'.$unit. ' !important';
				$icon_pad_imp_top	= isset($attr['btns'][$index]['iconpaddingtop']) ? $attr['btns'][$index]['iconpaddingtop'].$unit. ' !important' : '5'.$unit. ' !important';
			}else {
				$icon_pad_imp_left	= isset($attr['btns'][$index]['iconpaddingleft']) ? $attr['btns'][$index]['iconpaddingleft'].$unit: '5'.$unit;
				$icon_pad_imp_right	= isset($attr['btns'][$index]['iconpaddingright']) ? $attr['btns'][$index]['iconpaddingright'].$unit : '5'.$unit;
				$icon_pad_imp_bottom	= isset($attr['btns'][$index]['iconpaddingbottom']) ? $attr['btns'][$index]['iconpaddingbottom'].$unit: '5'.$unit;
				$icon_pad_imp_top	= isset($attr['btns'][$index]['iconpaddingtop']) ? $attr['btns'][$index]['iconpaddingtop'].$unit: '5'.$unit;
			}
			if( $attr['iconMarImp'] == true ){
				$icon_margin_imp_left			= isset($attr['btns'][$index]['marginleft']) ? $attr['btns'][$index]['marginleft'].$unit. ' !important' : ''.$unit. ' !important';
				$icon_margin_imp_right			= isset($attr['btns'][$index]['marginright']) ? $attr['btns'][$index]['marginright'].$unit. ' !important' : ''.$unit. ' !important';
			}else {
				$icon_margin_imp_left			= isset($attr['btns'][$index]['marginleft']) ? $attr['btns'][$index]['marginleft'].$unit : ''.$unit;
				$icon_margin_imp_right			= isset($attr['btns'][$index]['marginright']) ? $attr['btns'][$index]['marginright'].$unit : ''.$unit;
			}
			if( $attr['iconSizeImp'] == true ){
				$icon_desktop_size = isset($attr['iconsize'][0]) ? $attr['iconsize'][0]. $unit. ' !important' : '12'. $unit. ' !important';
				$icon_tab_size = isset($attr['iconsize'][1]) ? $attr['iconsize'][1]. $unit. ' !important' : '12'. $unit. ' !important';
				$icon_mobile_size = isset($attr['iconsize'][2]) ? $attr['iconsize'][2]. $unit. ' !important' : '12'. $unit. ' !important';
			}else {
				$icon_desktop_size = isset($attr['iconsize'][0]) ? $attr['iconsize'][0]. $unit : '12'. $unit;
				$icon_tab_size = isset($attr['iconsize'][1]) ? $attr['iconsize'][1]. $unit : '12'. $unit;
				$icon_mobile_size = isset($attr['iconsize'][2]) ? $attr['iconsize'][2]. $unit : '12'. $unit;
			}
			if( $attr['borderRadiusImp'] == true ){
			$borderradiusimp =	isset($attr['btns'][$index]['borderRadius']) ? ($attr['btns'][$index]['borderRadius']).$unit. ' !important' : '0' . $unit. ' !important';
			}else {
				$borderradiusimp = isset($attr['btns'][$index]['borderRadius']) ? ($attr['btns'][$index]['borderRadius']).$unit : '0' . $unit;
			}
			if( $attr['desksizeImp'] == true ){
				$btn_font_size_imp = isset($attr['btns'][$index]['desksize']) ? $attr['btns'][$index]['desksize'] . $unit. ' !important': '18'.$unit. ' !important';
			}else {
				$btn_font_size_imp = isset($attr['btns'][$index]['desksize']) ? $attr['btns'][$index]['desksize'] . $unit : '18'.$unit;
			}
			if( $attr['borderWidthImp'] == true ){
			$borderwidthimp = isset($attr['btns'][$index]['borderWidth']) ? ($attr['btns'][$index]['borderWidth']).$unit. ' !important': '0' . $unit. ' !important';
			}else {
				$borderwidthimp = isset($attr['btns'][$index]['borderWidth']) ? ($attr['btns'][$index]['borderWidth']).$unit : '0' . $unit;
			}

			if( $attr['btnMarImp'] == true ){
				$dest_btnMar_top = isset($attr['btns'][$index]['deskMarginTop']) ? $attr['btns'][$index]['deskMarginTop'] . $unit. ' !important' : '20'.$unit. ' !important';
				$mob_btnMar_top = isset($attr['btns'][$index]['mobMarginTop']) ? $attr['btns'][$index]['mobMarginTop'] . $unit. ' !important' : '20'.$unit. ' !important';
				$tab_btnMar_top =  isset($attr['btns'][$index]['tabMarginTop']) ? $attr['btns'][$index]['tabMarginTop'] . $unit. ' !important' : '20'.$unit. ' !important';

				$dest_btnMar_bottom = isset($attr['btns'][$index]['deskMarginBottom']) ? $attr['btns'][$index]['deskMarginBottom'] . $unit. ' !important': '20'.$unit. ' !important';
				$mob_btnMar_bottom = isset($attr['btns'][$index]['mobMarginBottom']) ? $attr['btns'][$index]['mobMarginBottom'] . $unit. ' !important': '20'.$unit. ' !important';
				$tab_btnMar_bottom =  isset($attr['btns'][$index]['tabMarginBottom']) ? $attr['btns'][$index]['tabMarginBottom'] . $unit . ' !important': '20'.$unit. ' !important';

				$dest_btnMar_left =  isset($attr['btns'][$index]['deskMarginLeft']) ? $attr['btns'][$index]['deskMarginLeft'] . $unit . ' !important': '20'.$unit. ' !important';
				$mob_btnMar_left =  isset($attr['btns'][$index]['mobMarginLeft']) ? $attr['btns'][$index]['mobMarginLeft'] . $unit . ' !important': '20'.$unit. ' !important';
				$tab_btnMar_left =  isset($attr['btns'][$index]['tabMarginLeft']) ? $attr['btns'][$index]['tabMarginLeft'] . $unit . ' !important': '20'.$unit. ' !important';
			}else {
				$dest_btnMar_top = isset($attr['btns'][$index]['deskMarginTop']) ? $attr['btns'][$index]['deskMarginTop'] . $unit : '20'.$unit;
				$mob_btnMar_top = isset($attr['btns'][$index]['mobMarginTop']) ? $attr['btns'][$index]['mobMarginTop'] . $unit : '20'.$unit;
				$tab_btnMar_top =  isset($attr['btns'][$index]['tabMarginTop']) ? $attr['btns'][$index]['tabMarginTop'] . $unit : '20'.$unit;

				$dest_btnMar_bottom = isset($attr['btns'][$index]['deskMarginBottom']) ? $attr['btns'][$index]['deskMarginBottom'] . $unit : '20'.$unit;
				$mob_btnMar_bottom = isset($attr['btns'][$index]['mobMarginBottom']) ? $attr['btns'][$index]['mobMarginBottom'] . $unit : '20'.$unit;
				$tab_btnMar_bottom =  isset($attr['btns'][$index]['tabMarginBottom']) ? $attr['btns'][$index]['tabMarginBottom'] . $unit : '20'.$unit;

				$dest_btnMar_left =  isset($attr['btns'][$index]['deskMarginLeft']) ? $attr['btns'][$index]['deskMarginLeft'] . $unit : '0'.$unit;
				$mob_btnMar_left =  isset($attr['btns'][$index]['mobMarginLeft']) ? $attr['btns'][$index]['mobMarginLeft'] . $unit : '20'.$unit;
				$tab_btnMar_left =  isset($attr['btns'][$index]['tabMarginLeft']) ? $attr['btns'][$index]['tabMarginLeft'] . $unit : '20'.$unit;
			}
				if( $attr['letterspacingImp'] == true ){
				$letterspacingImp = isset($attr['letterSpacing']) ? ($attr['letterSpacing']).$unit . ' !important': '0' . $unit. ' !important';
			}else {
				$letterspacingImp = isset($attr['letterSpacing']) ? ($attr['letterSpacing']).$unit : '0' . $unit;
			}
			if( $attr['textTranImp'] == true ){
				$textTranImp = isset($attr['ive_buttoncontentTransform']) ? $attr['ive_buttoncontentTransform'] . ' !important': '';
			}else {
				$textTranImp = isset($attr['ive_buttoncontentTransform']) ? $attr['ive_buttoncontentTransform'] : '';
			}
			if( $attr['fontFamImp'] == true ){
				$typographys = $typography . ' !important';
			}else {
				$typographys = $typography;
			}
			if( $attr['boxShadowBtnColorImp'] == true ){
				$boxShadowBtnColorImp = isset($attr['boxshadowcolor']) ? $attr['boxshadowpos'].' '. $attr['boxshadowx'] .$unit.' '. $attr['boxshadowY'].$unit.' '. $attr['boxshadowblur'].$unit.' '. $attr['boxshadowspread'].$unit.' '. $attr['boxshadowcolor']. ' !important' : '' ;
				$boxShadowBtnColorImpHov = isset($attr['hoverboxshadowcolor']) ? $attr['hoverboxshadowpos'].' '. $attr['hoverboxshadowx'] .$unit.' '. $attr['hoverboxshadowY'].$unit.' '. $attr['hoverboxshadowblur'].$unit.' '. $attr['hoverboxshadowspread'].$unit.' '. $attr['hoverboxshadowcolor']. ' !important' : '';
			}else {
				$boxShadowBtnColorImp = isset($attr['boxshadowcolor']) ? $attr['boxshadowpos'].' '. $attr['boxshadowx'] .$unit.' '. $attr['boxshadowY'].$unit.' '. $attr['boxshadowblur'].$unit.' '. $attr['boxshadowspread'].$unit.' '. $attr['boxshadowcolor'] : '' ;
				$boxShadowBtnColorImpHov = isset($attr['hoverboxshadowcolor']) ? $attr['hoverboxshadowpos'].' '. $attr['hoverboxshadowx'] .$unit.' '. $attr['hoverboxshadowY'].$unit.' '. $attr['hoverboxshadowblur'].$unit.' '. $attr['hoverboxshadowspread'].$unit.' '. $attr['hoverboxshadowcolor'] : '';
			}

			$selectors = array(
				' .anchrstyle' => array(
					'background-image' 	=> $background_ima_imp,
					'background-color' 	=> $background_imp,
					'opacity' 					=> $bgOpacityimp_imp,
					'text-decoration' 	=> 'none',
					'border-radius' 		=> $borderradiusimp,
					'border-width' 			=> $borderwidthimp,
					'border-color' 			=> $border_imp,
					'border-style' 			=> 'solid',
					'color' 						=> $color_imp,
					'letter-spacing' 		=> $letterspacingImp,
					'font-family' 			=> $typographys,
					'font-style' 				=> isset($attr['fontStyle']) ? ($attr['fontStyle']) : 'normal',
					'font-weight' 			=> isset($attr['fontWeight']) ? ($attr['fontWeight']) : 'normal',
					'font-size'					=> $btn_font_size_imp,
					'padding'						=> $deskpaddingBT.$unit .' '. $deskpaddingLR . $unit,
					'box-shadow'				=> $boxShadowBtnColorImp,
					'display'						=> 'inline-block',
					'text-transform'		=> $textTranImp,
				),
				' .anchrstyle:hover' => array(
					'background-color' => $background_hov_imp,
					'color' 					 => $color_hov_imp,
					'border-color' 		 => $border_hov_imp,
					'background-image' => $background_img_hov_imp,
					'box-shadow'			 => $boxShadowBtnColorImpHov,
				),
				' .anchrstyle .ive-left-icon-parent' => array(
					'display' 				=> 'inline'
				),
				' .anchrstyle .ive-right-icon-parent' => array(
					'display' 				=> 'inline'
				),
				'.btn-inner-wrap' => array(
					'display'				=> $attr['deskvisible'] ? 'block' : 'none',
					'margin-top'			=> $dest_btnMar_top,
					'margin-bottom'			=> $dest_btnMar_bottom,
					'margin-left'			=> $dest_btnMar_left,
				),
				' .anchrstyle .ive-button-icon-padding'.$index.' i' => array(
					'font-size'				=> $icon_desktop_size
				),
				' .anchrstyle .ive-button-icon-padding'.$index => array(
					'padding-left'			=> $icon_pad_imp_left,
					'padding-right'			=> $icon_pad_imp_right,
					'padding-bottom'			=> $icon_pad_imp_bottom,
					'padding-top'			=> $icon_pad_imp_top,
					'color'					=> isset($attr['iconColor']) ? $attr['iconColor'] : '',
					'background-color'		=> isset($attr['iconBGColor']) ? $attr['iconBGColor'] : '',
					'margin-left'			=> $icon_margin_imp_left,
					'margin-right'			=> $icon_margin_imp_right,

				),
				' .anchrstyle .ive-button-icon-padding'.$index.':hover' => array(
					'color'				=> isset($attr['iconhoverColor']) ? $attr['iconhoverColor'] : '',
					'background-color'	=> isset($attr['iconhoverBGColor']) ? $attr['iconhoverBGColor'] : '',
				),
				' .anchrstyle:hover .ive-button-icon-padding'.$index => array(
				  'display'	=> $hovericon,
				)
			);

			$t_selectors = array(
				' .anchrstyle' => array(
					'font-size'				=> isset($attr['btns'][$index]['tabsize']) ? $attr['btns'][$index]['tabsize'] . $unit : '16'.$unit,
					'padding'				=> $tabpaddingBT.$unit .' '. $tabpaddingLR . $unit,
				),
				'.btn-inner-wrap' => array(
					'display'				=> $attr['tabvisible'] ? 'block' : 'none',
					'margin-top'			=> $tab_btnMar_top,
					'margin-bottom'			=> $tab_btnMar_bottom,
					'margin-left'			=> $tab_btnMar_left,
				),
				' .anchrstyle .ive-button-icon-padding'.$index.' i' => array(
					'font-size'				=> $icon_tab_size
				)
			);

			$m_selectors = array(
				' .anchrstyle' => array(
					'font-size'				=> isset($attr['btns'][$index]['mobsize']) ? $attr['btns'][$index]['mobsize'] . $unit : '14'.$unit,
					'padding'				=> $mobpaddingBT.$unit .' '. $mobpaddingLR . $unit,
				),
				'.btn-inner-wrap' => array(
					'display'				=> $attr['mobvisible'] ? 'block' : 'none',
					'margin-top'			=> $mob_btnMar_top,
					'margin-bottom'			=> $mob_btnMar_bottom,
					'margin-left'			=> $mob_btnMar_left,
				),
				' .anchrstyle .ive-button-icon-padding'.$index.' i' => array(
					'font-size'				=> $icon_mobile_size
				)
			);

			// animation css
			$animationtype = isset($attr['animationtype']) ? $attr['animationtype'] : '';
			$animationdelay = isset($attr['animationdelay']) ? $attr['animationdelay'] : '';
			$animationspeed = isset($attr['animationspeed']) ? $attr['animationspeed'] : '';
			$animationiteration = isset($attr['animationiteration']) ? $attr['animationiteration'] : '';

			if($animationtype !='none' ){
				$anchrstyle = ' .anchrstyle:hover' ;
				$selectors[$anchrstyle]['animation-name']				= $animationtype;
				$selectors[$anchrstyle]['animation-delay'] = $animationdelay.'s';
				$selectors[$anchrstyle]['animation-duration'] = $animationspeed.'s';
				$selectors[$anchrstyle]['animation-iteration-count'] = $animationiteration ;
			}
			//animation css end

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
            );

			return IVE_Helper::generate_all_css( $combined_selectors, ' .ive-btn-main-parent' . $attr['uniqueID'] );

		}

		public static function get_page_title_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/page-title']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$selectors = array(
				'.vw-page-title' => array(
					'display'				=> isset($attr['page_title']) && $attr['page_title'] ? 'none' : 'block'
				),
				'.vw-page-pagination' => array(
					'display'				=> isset($attr['pagination_title']) && $attr['pagination_title'] ? 'none' : 'block'
				)
			);

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
            );

			return IVE_Helper::generate_all_css( $combined_selectors, '' );
		}

		public static function get_google_map_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/google-map']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$unit = 'px';

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$selectors = array(
				' .ive-google-map__wrap' => array(
					'background-color'		=> isset($attr['bgColor']) ? $attr['bgColor'] : '',
					'margin-top'			=> isset($attr['margin_top']) ? $attr['margin_top'].$unit : '35'.$unit,
					'margin-bottom'			=> isset($attr['margin_bottom']) ? $attr['margin_bottom'].$unit : '35'.$unit,
				),
				' .ive-google-map__iframe' => array(
					'height'				=> isset($attr['height']) ? $attr['height'].$unit : '300'.$unit,
					'opacity'				=> isset($attr['bgOpacity']) ? $attr['bgOpacity'] : 1
				)
			);

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.ive_google_map' . $attr['uniqueID'] );
		}

		public static function get_image_gallery_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/gallery']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();
			$selectors = array(
				' .ibtana-blocks-gallery-item' => array(
					'cursor'				=> 'pointer',
				),
				' .gallery-overlay' => array(
					'background'			=> isset($attr['overlayacolor']) ? $attr['overlayacolor'] : '#F5353561',
					'opacity'				=> isset($attr['imgopacity']) ? $attr['imgopacity'] : 1
				),
				' .ibtana-blocks-gallery-item i' => array(
					'justify-content'				=> isset($attr['iconPosition']) ? $attr['iconPosition'] : '',
					'color'									=> isset($attr['iconColor']) ? $attr['iconColor'] : '',
					'font-size'							=> isset($attr['iconfontSize']) ? $attr['iconfontSize'].'px' : '12px',
					'top' =>  'calc(50% - 10px)',
					'display' =>  'flex',
					'position' =>  'relative',
				),
			);

			$paddingtopdesk = isset($attr['paddingtop'][0]) ? $attr['paddingtop'][0].'px' : '0';
			$paddingleftdesk = isset($attr['paddingleft'][0]) ? $attr['paddingleft'][0].'px' : '0';
			$paddingrightdesk = isset($attr['paddingright'][0]) ? $attr['paddingright'][0].'px' : '0';
			$paddingbottomdesk = isset($attr['paddingbottm'][0]) ? $attr['paddingbottm'][0].'px' : '0';

			$paddingtoptab = isset($attr['paddingtop'][1]) ? $attr['paddingtop'][1].'px' : '0';
			$paddinglefttab = isset($attr['paddingleft'][1]) ? $attr['paddingleft'][1].'px' : '0';
			$paddingrighttab = isset($attr['paddingright'][1]) ? $attr['paddingright'][1].'px' : '0';
			$paddingbottomtab = isset($attr['paddingbottm'][1]) ? $attr['paddingbottm'][1].'px' : '0';

			$paddingtopmob = isset($attr['paddingtop'][2]) ? $attr['paddingtop'][2].'px' : '0';
			$paddingleftmob = isset($attr['paddingleft'][2]) ? $attr['paddingleft'][2].'px' : '0';
			$paddingrightmob = isset($attr['paddingright'][2]) ? $attr['paddingright'][2].'px' : '0';
			$paddingbottommob = isset($attr['paddingbottm'][2]) ? $attr['paddingbottm'][2].'px' : '0';

			$d_selectors = array(
				' .ibtana-blocks-gallery-item' => array(
					'padding'				=> $paddingtopdesk.' '.$paddingrightdesk.' '.$paddingbottomdesk.' '.$paddingleftdesk
				),
			);
			$t_selectors = array(
				' .ibtana-blocks-gallery-item' => array(
					'padding'				=> $paddingtoptab.' '.$paddingrighttab.' '.$paddingbottomtab.' '.$paddinglefttab
				),
			);
			$m_selectors = array(
				' .ibtana-blocks-gallery-item' => array(
					'padding'				=> $paddingtopmob.' '.$paddingrightmob.' '.$paddingbottommob.' '.$paddingleftmob
				),
			);


			$animationtype = isset($attr['animationtype']) ? $attr['animationtype'] : '';
			$animationspeed = isset($attr['animationspeed']) ? $attr['animationspeed'] : '';
			$aniclass= ' .ibtana-blocks-gallery-item:hover' ;
			if($animationtype != 'none' && $animationtype != 'rotateIn' && $animationtype != 'rotateOut' && $animationtype != 'flip' ){
				$selectors[$aniclass]['animation-name']				= $animationtype;
				$selectors[$aniclass]['transition'] = 'transform '.$animationspeed.'s';

				if($animationtype =='zoomIn' ){
					$selectors[$aniclass]['transform'] = 'scale(0.8)';
				} else if($animationtype =='zoomOut' ){
					$selectors[$aniclass]['transform'] = 'scale(1.1)';
				}
			} else {
				$selectors[$aniclass]['animation'] = $animationtype .' '. $animationspeed .'s';
			}

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.ive-gallery-wrap-id-' . $attr['uniqueID'] );
		}

		public static function get_icon_css( $attr, $id ) {
			$defaults = IVE_Helper::$block_list['ive/icon']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$unit = 'px';
			$margintbdesk  = isset($attr['margintb'][2]) ? $attr['margintb'][2].$unit : '5'.$unit;
			$marginlrdesk = isset($attr['marginlr'][2]) ? $attr['marginlr'][2].$unit : '5'.$unit;
			$margintbtab  = isset($attr['margintb'][1]) ? $attr['margintb'][1].$unit : '5'.$unit;
			$marginlrtab  = isset($attr['marginlr'][1]) ? $attr['marginlr'][1].$unit : '5'.$unit;
			$margintbmob  = isset($attr['margintb'][0]) ? $attr['margintb'][0].$unit : '5'.$unit;
			$marginlrmob  = isset($attr['marginlr'][0]) ? $attr['marginlr'][0].$unit : '5'.$unit;

			$iconsticky = $attr['iconsticky'];
			$alignType = isset($attr['alignType']) ? $attr['alignType'] : 'horizontal';
			$stickytop = $alignType == 'horizontal' ? 'auto' : '50%' ;
			$stickytransform = $alignType == 'horizontal' ? 'none' : 'translateY(-50%)' ;
			$stickybottom = $alignType == 'horizontal' ? 0 : 'auto' ;
			$stickyposition = isset($attr['stickyposition']) ? $attr['stickyposition'] : 'left';
			$stickyleft = $stickyposition == 'left' ? 0 : 'auto' ;
			$stickyright = $stickyposition == 'right' ? 0 : 'auto' ;

			$align = 'grid';
			if($alignType == 'horizontal'){
				$align = 'flex';
			}

			$iconCount = $attr['iconCount'];

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			for ($i=0; $i < $iconCount; $i++) {
				$icon = $attr['icons'][$i];
				//classes
				$paddingClass = ' .ive_icon_parent_icon_padding'.$i;
				$sizeClass = ' .ive_icon_parent_icon_size'.$i;
				$hoverClass = ' .ive-svg-item-'.$i.':hover .ive_icon_parent_icon_padding'.$i;
				$iconGradClass = ' .ive-svg-item-'.$i.' .ive_icon_parent_icon_padding'.$i;
				$iconGradHoverClass = ' .ive-svg-item-'.$i.':hover .ive_icon_parent_icon_padding'.$i;
				$defaultval = '0'.$unit;

				if( isset( $icon['iconGrad'] ) ){
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


				$selectors[$iconGradClass]['background-image'] = $gradient;
				$selectors[$iconGradHoverClass]['background-image'] = $gradientHover;

				//desktop icon css
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

				$selectors[$paddingClass]['border-style'] = isset($icon['borderStyle']) ? $icon['borderStyle'] : 'none';
				$selectors[$paddingClass]['color'] = isset($icon['color']) ? $icon['color'] : '#444444';
				$selectors[$paddingClass]['background-color'] = $backgroundColor;
				$selectors[$paddingClass]['border-color'] = $borderColor;
				$selectors[$paddingClass]['border-width'] = $borderWidth;
				$selectors[$paddingClass]['border-radius'] = $borderRadius;
				$selectors[$paddingClass]['line-height'] = 0;

				//hover css
				$selectors[$hoverClass]['background'] = ( !$stylecon && isset($icon['hoverBackground'])) ? $icon['hoverBackground'] : 'undefined';
				$selectors[$hoverClass]['border-color'] = ( !$stylecon && isset($icon['hoverBorder'])) ? $icon['hoverBorder'] : 'undefined';
				$selectors[$hoverClass]['color'] = isset($icon['hoverColor']) ? $icon['hoverColor'] : '#eeeeee';

				$selectors[$sizeClass]['font-size'] = isset($icon['desksize']) ? $icon['desksize'].$unit : '50'.$unit;
				$selectors[$paddingClass]['padding'] = $paddingdesk;
				$selectors[$paddingClass]['width'] = (isset($icon['deskwidth']) && $icon['deskwidth'] != 0 ) ? $icon['deskwidth'].$unit : 'auto';
				$selectors[$paddingClass]['height'] = (isset($icon['deskheight']) && $icon['deskheight'] != 0 ) ? $icon['deskheight'].$unit : 'auto';

				//tablet icon css
				$t_selectors[$sizeClass]['font-size'] = isset($icon['tabsize']) ? $icon['tabsize'].$unit : '35'.$unit;
				$t_selectors[$paddingClass]['padding'] = $paddingtab;
				$t_selectors[$paddingClass]['width'] = (isset($icon['tabwidth']) && $icon['tabwidth'] != 0 ) ? $icon['tabwidth'].$unit : 'auto';
				$t_selectors[$paddingClass]['height'] = (isset($icon['tabheight']) && $icon['tabheight'] != 0 ) ? $icon['tabheight'].$unit : 'auto';

				//mobile icon css
				$m_selectors[$sizeClass]['font-size'] = isset($icon['mobsize']) ? $icon['mobsize'].$unit : '20'.$unit;
				$m_selectors[$paddingClass]['padding'] = $paddingmob;
				$m_selectors[$paddingClass]['width'] = (isset($icon['mobwidth']) && $icon['mobwidth'] != 0 ) ? $icon['mobwidth'].$unit : 'auto';
				$m_selectors[$paddingClass]['height'] = (isset($icon['mobheight']) && $icon['mobheight'] != 0 ) ? $icon['mobheight'].$unit : 'auto';
			}

			$selectors['.ive-svg-icons-block']['display'] = $align;
			$selectors[' .ive-svg-icon-margin']['margin'] = $margintbdesk.' '.$marginlrdesk;
			$t_selectors[' .ive-svg-icon-margin']['margin']  = $margintbtab.' '.$marginlrtab;
			$m_selectors[' .ive-svg-icon-margin']['margin']  = $margintbmob.' '.$marginlrmob;

			if ($iconsticky) {
				$selectors['.ive-svg-icons-block']['position'] = 'fixed';
				$selectors['.ive-svg-icons-block']['z-index'] = 99;
				$selectors['.ive-svg-icons-block']['top'] = $stickytop;
				$selectors['.ive-svg-icons-block']['transform'] = $stickytransform;
				$selectors['.ive-svg-icons-block']['left'] = $stickyleft;
				$selectors['.ive-svg-icons-block']['right'] = $stickyright;
				$selectors['.ive-svg-icons-block']['bottom'] = $stickybottom;
			}

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.ive-svg-icons' . $attr['uniqueID'] );
		}

		public static function get_separator_css( $attr, $id ) {
			$defaults = IVE_Helper::$block_list['ive/separator']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$unit = 'px';

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			if(isset($attr['avdSepHeightImp']) == true ){
				$advanceHeighSepimp = isset($attr['spacerHeight']) ? $attr['spacerHeight'].$unit . ' !important': '6'.$unit . ' !important';
			}else{
				$advanceHeighSepimp = isset($attr['spacerHeight']) ? $attr['spacerHeight'].$unit : '6'.$unit;
			}

			if(isset($attr['avdSepDividerImp']) == true ){
				$avd_border_color_img = isset($attr['dividerColor']) ? $attr['dividerColor'] . ' !important': '#eeeeee !important';
				$avd_width_img = isset($attr['dividerWidth']) ? $attr['dividerWidth'].'% !important' : '80% !important';
				$avd_border_top_width = isset($attr['dividerHeight']) ? $attr['dividerHeight'].$unit . ' !important' : '1'.$unit . ' !important';
				$avd_border_style = isset($attr['dividerStyle']) ? $attr['dividerStyle'] . ' !important' : 'solid !important';
				$avd_margin = '0 auto !important';
			}else{
				$avd_border_color_img = isset($attr['dividerColor']) ? $attr['dividerColor'] : '#eeeeee';
				$avd_width_img = isset($attr['dividerWidth']) ? $attr['dividerWidth'].'%' : '80%';
				$avd_border_top_width = isset($attr['dividerHeight']) ? $attr['dividerHeight'].$unit : '1'.$unit;
				$avd_border_style = isset($attr['dividerStyle']) ? $attr['dividerStyle'] : 'solid';
				$avd_margin = '0 auto';
			}

			$selectors = array(
				' .ive-separator' => array(
					'height'				=> $advanceHeighSepimp,
				),
				' .ive-separator-hr' 	=> array(
					'border-color'			=> $avd_border_color_img,
					'width'							=> $avd_width_img,
					'border-top-width'	=> $avd_border_top_width,
					'border-style'			=> $avd_border_style,
					'margin'						=> $avd_margin,
					'opacity'						=> isset($attr['dividerOpacity']) ? $attr['dividerOpacity']/100 : 1
				)
			);

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.ive-separator-' . $attr['uniqueID'] );
		}

		public static function get_progress_bar_css( $attr, $id ) {
			$defaults = IVE_Helper::$block_list['ive/progress-bar']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$unit 							= 'px';
			$size 							= isset($attr['circularSize']) ? $attr['circularSize'] : '150';
			$barType 						= isset($attr['barType']) ? $attr['barType'] : 'linear';
			$percentage 				= isset($attr['percentage']) ? $attr['percentage'] : 25;
			$counter 						= isset($attr['counter']) ? $attr['counter'] : false;
			$barThickness 			= isset($attr['barThickness']) ? $attr['barThickness'] : 1;
			$circleRadius 			= 50 - ($barThickness + 3) / 2;
			$circlePathLength 	= $circleRadius * pi() * 2;
			$strokeArcLength 		= ($circlePathLength * $percentage) / 100;
			$strokeArcLengthVal	= number_format((float)$strokeArcLength, 3, '.', '');
			$strokeDasharray 		= number_format((float)$circlePathLength, 3, '.', '');
			if( $counter ) {
				$circular_pg = '301.430px, 301.593px';
			}else{
				$circular_pg = $strokeArcLengthVal.$unit.', '.$strokeDasharray.$unit;
			}

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();
			if(isset($attr['spaCountImp']) == true){
				$spacing_count_top_imp = isset($attr['margin_top']) ? $attr['margin_top'].$unit . ' !important': '10'.$unit . ' !important';
				$spacing_count_bottom_imp = isset($attr['margin_bottom']) ? $attr['margin_bottom'].$unit . ' !important': '10'.$unit . ' !important';
			}else{
				$spacing_count_top_imp = isset($attr['margin_top']) ? $attr['margin_top'].$unit : '10'.$unit;
				$spacing_count_bottom_imp = isset($attr['margin_bottom']) ? $attr['margin_bottom'].$unit : '10'.$unit;
			}
			if(isset($attr['fontProgImp']) == true){
				$fontProgImp_fontSize_imp = isset($attr['deskfontSize_cont']) ? $attr['deskfontSize_cont'].$unit . ' !important': '24'.$unit . ' !important';
				$fontProgImp_typography_cont_imp = isset($attr['typography_cont']) ? $attr['typography_cont'] . ' !important' : '';
				$fontProgImp_letterSpacing_cont_imp = isset($attr['letterSpacing_cont']) ? $attr['letterSpacing_cont'].$unit. ' !important' : 0 . ' !important';
				$fontProgImp_fontWeight_cont_imp = isset($attr['fontWeight_cont']) ? $attr['fontWeight_cont']. ' !important' : 'normal'. ' !important';
				$fontProgImp_fontStyle_cont_imp = isset($attr['fontStyle_cont']) ? $attr['fontStyle_cont'] . ' !important': 'normal'. ' !important';
				}else{
				$fontProgImp_fontSize_imp = isset($attr['deskfontSize_cont']) ? $attr['deskfontSize_cont'].$unit : '24'.$unit;
				$fontProgImp_typography_cont_imp = isset($attr['typography_cont']) ? $attr['typography_cont'] : '';
				$fontProgImp_letterSpacing_cont_imp = isset($attr['letterSpacing_cont']) ? $attr['letterSpacing_cont'].$unit : 0;
				$fontProgImp_fontWeight_cont_imp = isset($attr['fontWeight_cont']) ? $attr['fontWeight_cont'] : 'normal';
				$fontProgImp_fontStyle_cont_imp = isset($attr['fontStyle_cont']) ? $attr['fontStyle_cont'] : 'normal';
			}
			$selectors = array(
				'.ibtana_progress-bar' => array(
					'margin-top'			=> $spacing_count_top_imp,
					'margin-bottom'			=> $spacing_count_bottom_imp
				),
				' .circular-progressbar-right' => array(
					'margin-left'			=> 'auto'
				),
				' .circular-progressbar-center' => array(
					'margin'				=> 'auto'
				),
				' .ibtana_progress_title:hover' => array(
					'color'					=> isset($attr['hoverTextColor']) ? $attr['hoverTextColor'].' !important' : '#111111',
				),
				' .ibtana_progress_title' => array(
					'font-size'				=> isset($attr['deskfontSize']) ? $attr['deskfontSize'].$unit : '24'.$unit,
					'color'					=> isset($attr['titleColor']) ? $attr['titleColor'].' !important' : '#111111',
					'background'			=> isset($attr['titlebgColor']) ? $attr['titlebgColor'] : '',
					'font-family'			=> isset($attr['typography']) ? $attr['typography'] : '',
					'text-transform'		=> isset($attr['textTransform']) ? $attr['textTransform'] : '',
					'letter-spacing'		=> isset($attr['letterSpacing']) ? $attr['letterSpacing'].$unit : 0,
					'font-weight'			=> isset($attr['fontWeight']) ? $attr['fontWeight'] : 'normal',
					'font-style'			=> isset($attr['fontStyle']) ? $attr['fontStyle'] : 'normal',
					'white-space'			=> 'pre-wrap'
				),
				' .ibtana_progress-bar-container.row' => array(
					'border-color'			=> isset($attr['progress_border']) ? $attr['progress_border'] : '#fff',
					'border-style'			=> 'solid',
					'border-width'			=> isset($attr['progress_borderWidth']) ? $attr['progress_borderWidth'].$unit : '2'.$unit,
					'border-radius'			=> isset($attr['progress_borderRadius']) ? $attr['progress_borderRadius'].$unit : 0,
					'padding'				=> isset($attr['progress_padding']) ? $attr['progress_padding'].$unit : '20'.$unit
				),
				' .ibtana_progress-bar-container.row .ibtana_progress-bar-line-path' => array(
					'stroke-dashoffset'		=> $counter ? '100'.$unit : (100 - $percentage).$unit
				),
				' .ibtana_progress-bar-container.circular' => array(
					'height'				=> isset($size) ? $size.$unit : '150'.$unit,
					'width'					=> isset($size) ? $size.$unit : '150'.$unit,
					'position'				=> 'relative'
				),
				' .ibtana_progress-bar-label' => array(
					'font-size'				=> $fontProgImp_fontSize_imp,
					'visibility'			=> 'visible',
					'text-align'			=> 'right',
					'min-width'				=> '24px',
					'color'					=> isset($attr['contentColor']) ? $attr['contentColor'] : '#111111',
					'font-family'			=> $fontProgImp_typography_cont_imp,
					'letter-spacing'		=> $fontProgImp_letterSpacing_cont_imp,
					'font-weight'			=> $fontProgImp_fontWeight_cont_imp,
					'font-style'			=> $fontProgImp_fontStyle_cont_imp,
				),
				' .ibtana_progress-bar-label:hover' => array(
					'color'					=> isset($attr['contentHoverColor']) ? $attr['contentHoverColor'] : '#111111',
				),
				' .ibtana_progress-bar-container.circular .ibtana_progress-bar-circle' => array(
					'position' 				=> 'absolute'
				),
				' .ibtana_progress-bar-container.circular .ibtana_progress-bar-circle-trail' => array(
					'stroke-dasharray'		=> $strokeDasharray.$unit.', '.$strokeDasharray.$unit
				),
				' .ibtana_progress-bar-container.circular .ibtana_progress-bar-circle-path' => array(
					'stroke-dasharray'		=> $circular_pg,
					'stroke-dashoffset'		=> ($counter ? '310' : '0').$unit
				)
			);

			if( $barType === 'circular' ) {
				$selectors[' .ibtana_progress-bar-label']['font-size']			=	isset($attr['deskfontSize_cont']) ? $attr['deskfontSize_cont'].$unit : '24'.$unit;
				$selectors[' .ibtana_progress-bar-label']['position']				=	'absolute';
				$selectors[' .ibtana_progress-bar-label']['visibility']			=	 'visible';
				$selectors[' .ibtana_progress-bar-label']['top']						=	'50%';
				$selectors[' .ibtana_progress-bar-label']['transform']			=	'translateY(-50%)';
				$selectors[' .ibtana_progress-bar-label']['margin']					= 'auto';
				$selectors[' .ibtana_progress-bar-label']['text-align']			= 'center';
				$selectors[' .ibtana_progress-bar-label']['left']						= 0;
				$selectors[' .ibtana_progress-bar-label']['right']					= 0;
				$selectors[' .ibtana_progress-bar-label']['color']					= isset($attr['contentColor']) ? $attr['contentColor'] : '#111111';
				$selectors[' .ibtana_progress-bar-label']['font-family']		=	isset($attr['typography_cont']) ? $attr['typography_cont'] : '';
				$selectors[' .ibtana_progress-bar-label']['letter-spacing']	= isset($attr['letterSpacing_cont']) ? $attr['letterSpacing_cont'].$unit : 0;
				$selectors[' .ibtana_progress-bar-label']['font-weight']		= isset($attr['fontWeight_cont']) ? $attr['fontWeight_cont'] : 'normal';
				$selectors[' .ibtana_progress-bar-label']['font-style']			= isset($attr['fontStyle_cont']) ? $attr['fontStyle_cont'] : 'normal';
			}

			if ( isset( $attr['percentBgGradient'] ) && $attr['percentBgGradient'] === true ) {

				$percentBgGradLocOne		=	isset( $attr['percentBgGradLocOne'] )	?	$attr['percentBgGradLocOne'] : 0;
				$percentBgGradLocSecond	=	isset( $attr['percentBgGradLocSecond'] ) ? $attr['percentBgGradLocSecond'] : 100;

					if ( isset( $attr['percentBgGradType'] ) && ( $attr['percentBgGradType'] === 'radial' ) ) {
						$percentVbgImgPosition	=	isset( $attr['percentVbgImgPosition'] ) ? $attr['percentVbgImgPosition'] : 'center center';
						if ( $attr['percentBgFirstColor'] && $attr['percentBgSecondColor'] ) {
							$selectors[' .ibtana_progress-bar-label']['background-image']				=	'radial-gradient(at ' . $percentVbgImgPosition . ', ' . $attr['percentBgFirstColor'] . ' ' . $percentBgGradLocOne . '%, ' . $attr['percentBgSecondColor'] . ' ' . $percentBgGradLocSecond . '%)';
						}
						if ( $attr['percentBgHovGradFirstColor'] && $attr['percentBgHovGradSecondColor'] ) {
							$selectors[' .ibtana_progress-bar-label:hover']['background-image']	=	'radial-gradient(at ' . $percentVbgImgPosition . ', ' . $attr['percentBgHovGradFirstColor'] . ' ' . $percentBgGradLocOne . '%, ' . $attr['percentBgHovGradSecondColor'] . ' ' . $percentBgGradLocSecond . '%)';
						}
					} else {
						$percentBgGradAngle	=	isset( $attr['percentBgGradAngle'] ) ? $attr['percentBgGradAngle'] : 180;
						if ( $attr['percentBgFirstColor'] && isset($attr['percentBgSecondColor']) ) {
							$selectors[' .ibtana_progress-bar-label']['background-image']				=	'linear-gradient(' . $percentBgGradAngle . 'deg, ' . $attr['percentBgFirstColor'] . ' ' . $percentBgGradLocOne . '%, ' . $attr['percentBgSecondColor'] . ' ' . $percentBgGradLocSecond . '%)';
						}
						if ( isset($attr['percentBgHovGradFirstColor']) && $attr['percentBgHovGradSecondColor'] ) {
							$selectors[' .ibtana_progress-bar-label:hover']['background-image']	=	'linear-gradient(' . $percentBgGradAngle . 'deg, ' . $attr['percentBgHovGradFirstColor'] . ' ' . $percentBgGradLocOne . '%, ' . $attr['percentBgHovGradSecondColor'] . ' ' . $percentBgGradLocSecond . '%)';
						}
					}

			} else {
				if ( isset( $attr['percentBgColor'] ) ) {
					$selectors[' .ibtana_progress-bar-label']['background-color']	=	$attr['percentBgColor'];
				}
				if ( isset( $attr['percentBgHoverColor'] ) ) {
					$selectors[' .ibtana_progress-bar-label:hover']['background-color']	=	$attr['percentBgHoverColor'];
				}
			}

			$t_selectors = array(
				' .ibtana_progress_title' => array(
					'text-transform'		=> isset($attr['textTransform']) ? $attr['textTransform'] : '',
					'font-size'				=> isset($attr['tabfontSize']) ? $attr['tabfontSize'].$unit : '20'.$unit
				),
				' .ibtana_progress-bar-label' => array(
					'font-size'				=> isset($attr['tabfontSize_cont']) ? $attr['tabfontSize_cont'].$unit : '20'.$unit,
				)
			);

			$m_selectors = array(
				' .ibtana_progress_title' => array(
					'text-transform'		=> isset($attr['textTransform']) ? $attr['textTransform'] : '',
					'font-size'				=> isset($attr['mobfontSize']) ? $attr['mobfontSize'].$unit : '16'.$unit
				),
				' .ibtana_progress-bar-label' => array(
					'font-size'				=> isset($attr['mobfontSize_cont']) ? $attr['mobfontSize_cont'].$unit : '16'.$unit,
				)
			);

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.ibtana_progress_bar' . $attr['uniqueID'] );
		}

		public static function get_advanced_text_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/ibtana-visual-editorheading']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$dropCap	=	isset( $attr['dropCap'] ) ? $attr['dropCap'] : false;

			$unit = 'px';
			//attributes
			$gradientDisable		= isset($attr['gradientDisable']) ? $attr['gradientDisable'] : false;
			$textOptions			= isset($attr['textOptions']) ? $attr['textOptions'] : 'text';
			$bgGradType				= isset($attr['bgGradType']) ? $attr['bgGradType'] : 'linear';
			$vBgImgPosition			= isset($attr['vBgImgPosition']) ? $attr['vBgImgPosition'] : 'center center';
			$bgfirstcolorr			= isset($attr['bgfirstcolorr']) ? $attr['bgfirstcolorr'] : '';
			$bgGradAngle			= isset($attr['bgGradAngle']) ? $attr['bgGradAngle'] : 180;
			$bgGradLoc				= isset($attr['bgGradLoc']) ? $attr['bgGradLoc'] : 0;
			$bgSecondColr			= isset($attr['bgSecondColr']) ? $attr['bgSecondColr'] : '#00B5E2';
			$bgGradLocSecond		= isset($attr['bgGradLocSecond']) ? $attr['bgGradLocSecond'] : 100;
			$headhoverbgfirstcolor 	= isset($attr['headhoverbgfirstcolor']) ? $attr['headhoverbgfirstcolor'] : '';
			$headhoverbgSecondColr 	= isset($attr['headhoverbgSecondColr']) ? $attr['headhoverbgSecondColr'] : '';
			$animationtype			= isset($attr['animationtype']) ? $attr['animationtype'] : 'none';
			$paddingtype			= isset($attr['paddingtype']) ? $attr['paddingtype'] : 'px';
			$marginType				= isset($attr['marginType']) ? $attr['marginType'] : 'px';
			$optionSide				= isset($attr['optionSide']) ? $attr['optionSide'] : 'row';
			$deskalign				= isset($attr['deskalign']) ? $attr['deskalign'] : 'center';
			$tabalign				= isset($attr['tabalign']) ? $attr['tabalign'] : 'center';
			$mobalign				= isset($attr['mobalign']) ? $attr['mobalign'] : 'center';

			$backgdfirstcolor				= isset($attr['backgdfirstcolor']) ? $attr['backgdfirstcolor'] : '';
			$backgdGradLoc				= isset($attr['backgdGradLoc']) ? $attr['backgdGradLoc'] : '';
			$backgdSecondColr				= isset($attr['backgdSecondColr']) ? $attr['backgdSecondColr'] : '';
			$backgdGradLocSecond				= isset($attr['backgdGradLocSecond']) ? $attr['backgdGradLocSecond'] : '';
			$backgdGradType				= isset($attr['backgdGradType']) ? $attr['backgdGradType'] : '';
			$backgdGradAngle				= isset($attr['backgdGradAngle']) ? $attr['backgdGradAngle'] : '';
			$backgdImgPosition				= isset($attr['backgdImgPosition']) ? $attr['backgdImgPosition'] : '';
			$backgdheadhoverfirstcolor				= isset($attr['backgdheadhoverfirstcolor']) ? $attr['backgdheadhoverfirstcolor'] : '';
			$backgdheadhoverSecondColr				= isset($attr['backgdheadhoverSecondColr']) ? $attr['backgdheadhoverSecondColr'] : '';
			$backgdOpacity				= isset($attr['backgdOpacity']) ? $attr['backgdOpacity'] : '';
			$headhoverbackgdOpacity				= isset($attr['headhoverbackgdOpacity']) ? $attr['headhoverbackgdOpacity'] : '';
			$bggradientDisable				= isset($attr['bggradientDisable']) ? $attr['bggradientDisable'] : '';

			$backgroundImage; $bgcolorgrad;
			if($gradientDisable){
				if ($bgGradType === 'radial') {
					$backgroundImage = 'radial-gradient(at ' .$vBgImgPosition. ',' .$bgfirstcolorr. ' ' .$bgGradLoc. '%,' .$bgSecondColr. ' ' .$bgGradLocSecond. '%);';
				}else{
					$backgroundImage = 'linear-gradient(' .$bgGradAngle. 'deg,' .$bgfirstcolorr. ' ' .$bgGradLoc. '%,' .$bgSecondColr. ' ' .$bgGradLocSecond. '%);';
				}
				$bgcolorgrad = isset($attr['headbggradColor']) ? $attr['headbggradColor'] : '';
			}else{
				$backgroundImage = 'unset';
      			$bgcolorgrad = isset($attr['backgroundcolor']) ? $attr['backgroundcolor'] : '';
			}

			$backgroundImageHov; $bgcolorgradHov;
			if($gradientDisable){
				if ($bgGradType === 'radial') {
					$backgroundImageHov = 'radial-gradient(at ' .$vBgImgPosition. ',' .$headhoverbgfirstcolor. ' ' .$bgGradLoc. '%,' .$headhoverbgSecondColr. ' ' .$bgGradLocSecond. '%);';
				}else{
					$backgroundImageHov = 'linear-gradient(' .$bgGradAngle. 'deg,' .$headhoverbgfirstcolor. ' ' .$bgGradLoc. '%,' .$headhoverbgSecondColr. ' ' .$bgGradLocSecond. '%);';
				}
				$bgcolorgradHov = isset($attr['headhoverbggradcolor']) ? $attr['headhoverbggradcolor'] : '';
			}else{
				$backgroundImageHov = 'unset';
      			$bgcolorgradHov = isset($attr['hoverbackgroundcolor']) ? $attr['hoverbackgroundcolor'] : '';
			}
			$backgroundImage_div = '';
			$backgroundImage_div_hover = '';

			if($bggradientDisable){
				if ($backgdGradType === 'radial') {
					$backgroundImage_div = 'radial-gradient(at ' .$backgdImgPosition. ',' .$backgdfirstcolor. ' ' .$backgdGradLoc. '%,' .$backgdSecondColr. ' ' .$backgdGradLocSecond. '%);';
					$backgroundImage_div_hover = 'radial-gradient(at ' .$backgdImgPosition. ',' .$backgdheadhoverfirstcolor. ' ' .$backgdGradLoc. '%,' .$backgdheadhoverSecondColr. ' ' .$backgdGradLocSecond. '%);';
				}else{
					$backgroundImage_div = 'linear-gradient(' .$backgdGradAngle. 'deg,' .$backgdfirstcolor. ' ' .$backgdGradLoc. '%,' .$backgdSecondColr. ' ' .$backgdGradLocSecond. '%);';
					$backgroundImage_div_hover = 'linear-gradient(' .$backgdGradAngle. 'deg,' .$backgdheadhoverfirstcolor. ' ' .$backgdGradLoc. '%,' .$backgdheadhoverSecondColr. ' ' .$backgdGradLocSecond. '%);';
				}
			}

			//box shadow
			$boxshadowpos    = isset($attr['boxshadowpos']) ? $attr['boxshadowpos'] : '';
			$boxshadowx      = isset($attr['boxshadowx']) ? $attr['boxshadowx'] : 0;
			$boxshadowy      = isset($attr['boxshadowy']) ? $attr['boxshadowy'] : 0;
			$boxshadowblur   = isset($attr['boxshadowblur']) ? $attr['boxshadowblur'] : 5;
			$boxshadowspread = isset($attr['boxshadowspread']) ? $attr['boxshadowspread'] : 1;
			$boxshadowcolor  = isset($attr['boxshadowcolor']) ? $attr['boxshadowcolor'] : 'transparent';

			$boxshadowposhover    = isset($attr['boxshadowposhover']) ? $attr['boxshadowposhover'] : '';
			$boxshadowxhover      = isset($attr['boxshadowxhover']) ? $attr['boxshadowxhover'] : 0;
			$boxshadowyhover      = isset($attr['boxshadowyhover']) ? $attr['boxshadowyhover'] : 0;
			$boxshadowblurhover   = isset($attr['boxshadowblurhover']) ? $attr['boxshadowblurhover'] : 5;
			$boxshadowspreadhover = isset($attr['boxshadowspreadhover']) ? $attr['boxshadowspreadhover'] : 1;
			$boxshadowcolorhover  = isset($attr['boxshadowcolorhover']) ? $attr['boxshadowcolorhover'] : 'transparent';


			//border
			$bordertype   = isset($attr['bordertype']) ? $attr['bordertype'] : 'none';
			$bordertop    = isset($attr['bordertop']) ? $attr['bordertop'].$unit : '0'.$unit;
			$borderright  = isset($attr['borderright']) ? $attr['borderright'].$unit : '0'.$unit;
			$borderbottom = isset($attr['borderbottom']) ? $attr['borderbottom'].$unit : '0'.$unit;
			$borderleft   = isset($attr['borderleft']) ? $attr['borderleft'].$unit : '0'.$unit;

			$borderadiustype   = isset($attr['borderadiustype']) ? $attr['borderadiustype'] : 'px';
			$borderadiustop    = isset($attr['borderadiustop']) ? $attr['borderadiustop'].$borderadiustype : '0'.$borderadiustype;
			$borderadiusright  = isset($attr['borderadiusright']) ? $attr['borderadiusright'].$borderadiustype : '0'.$borderadiustype;
			$borderadiusbottom = isset($attr['borderadiusbottom']) ? $attr['borderadiusbottom'].$borderadiustype : '0'.$borderadiustype;
			$borderadiusleft   = isset($attr['borderadiusleft']) ? $attr['borderadiusleft'].$borderadiustype : '0'.$borderadiustype;

			$bordertypehover   = isset($attr['bordertypehover']) ? $attr['bordertypehover'] : 'none';
			$bordertophover    = isset($attr['bordertophover']) ? $attr['bordertophover'].$unit : '0'.$unit;
			$borderrighthover  = isset($attr['borderrighthover']) ? $attr['borderrighthover'].$unit : '0'.$unit;
			$borderbottomhover = isset($attr['borderbottomhover']) ? $attr['borderbottomhover'].$unit : '0'.$unit;
			$borderlefthover   = isset($attr['borderlefthover']) ? $attr['borderlefthover'].$unit : '0'.$unit;

			$borderadiustypehover   = isset($attr['borderadiustypehover']) ? $attr['borderadiustypehover'] : 'px';
			$borderadiustophover    = isset($attr['borderadiustophover']) ? $attr['borderadiustophover'].$borderadiustypehover : '0'.$borderadiustypehover;
			$borderadiusrighthover  = isset($attr['borderadiusrighthover']) ? $attr['borderadiusrighthover'].$borderadiustypehover : '0'.$borderadiustypehover;
			$borderadiusbottomhover = isset($attr['borderadiusbottomhover']) ? $attr['borderadiusbottomhover'].$borderadiustypehover : '0'.$borderadiustypehover;
			$borderadiuslefthover   = isset($attr['borderadiuslefthover']) ? $attr['borderadiuslefthover'].$borderadiustypehover : '0'.$borderadiustypehover;

			//visibility
			$deskvisible = isset($attr['deskvisible']) ? $attr['deskvisible'] : true;
			$tabvisible  = isset($attr['tabvisible']) ? $attr['tabvisible'] : true;
			$mobvisible  = isset($attr['mobvisible']) ? $attr['mobvisible'] : true;

			//padding
			$paddingtopdesk 	= isset($attr['paddingtopdesk']) ? $attr['paddingtopdesk'].$paddingtype : 0;
			$paddingrightdesk 	= isset($attr['paddingrightdesk']) ? $attr['paddingrightdesk'].$paddingtype : 0;
			$paddingbottomdesk 	= isset($attr['paddingbottomdesk']) ? $attr['paddingbottomdesk'].$paddingtype : 0;
			$paddingleftdesk 	= isset($attr['paddingleftdesk']) ? $attr['paddingleftdesk'].$paddingtype : 0;

			$paddingtoptablet	  = isset($attr['paddingtoptablet']) ? $attr['paddingtoptablet'].$paddingtype : 0;
			$paddingrighttablet   = isset($attr['paddingrighttablet']) ? $attr['paddingrighttablet'].$paddingtype : 0;
			$paddingbottomtablet  = isset($attr['paddingbottomtablet']) ? $attr['paddingbottomtablet'].$paddingtype : 0;
			$paddinglefttablet 	  = isset($attr['paddinglefttablet']) ? $attr['paddinglefttablet'].$paddingtype : 0;

			$paddingtopmob 	   = isset($attr['paddingtopmob']) ? $attr['paddingtopmob'].$paddingtype : 0;
			$paddingrightmob   = isset($attr['paddingrightmob']) ? $attr['paddingrightmob'].$paddingtype : 0;
			$paddingbottommob  = isset($attr['paddingbottommob']) ? $attr['paddingbottommob'].$paddingtype : 0;
			$paddingleftmob    = isset($attr['paddingleftmob']) ? $attr['paddingleftmob'].$paddingtype : 0;

			$iconfontSizedesk = isset($attr['iconfontSize'][0]) ? $attr['iconfontSize'][0].$unit : '12'.$unit;
			$iconfontSizetab = isset($attr['iconfontSize'][1]) ? $attr['iconfontSize'][1].$unit : '12'.$unit;
			$iconfontSizemob = isset($attr['iconfontSize'][2]) ? $attr['iconfontSize'][2].$unit : '12'.$unit;

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			if( isset($attr['headingColorImp']) == true ){
				$headingColorImp = isset($attr['color']) ? $attr['color'] . ' !important' : '';
				$headingColorImpHov = isset($attr['headinghovercolor']) ? $attr['headinghovercolor'].' !important' : '';
			}else {
				$headingColorImp = isset($attr['color']) ? $attr['color'] : '';
				$headingColorImpHov = isset($attr['headinghovercolor']) ? $attr['headinghovercolor'] : '';
			}

			if( isset($attr['headingBgColorImp']) == true ){
				$headingBgColorImp = $bgcolorgrad . ' !important';
				$headingBgColorImpHov = $bgcolorgradHov .' !important';
			}else {
				$headingBgColorImp = $bgcolorgrad;
				$headingBgColorImpHov = $bgcolorgradHov;
			}

			if( isset($attr['spacingTopImp']) == true ){
				$spacingTopImp = isset($attr['topMargin']) ? $attr['topMargin'].$marginType . ' !important': '1'.$marginType . ' !important';
			}else {
				$spacingTopImp = isset($attr['topMargin']) ? $attr['topMargin'].$marginType : '1'.$marginType;
			}

			if( isset($attr['spacingBottomImp']) == true ){
				$spacingBottomImp = isset($attr['bottomMargin']) ? $attr['bottomMargin'].$marginType . ' !important' : '1'.$marginType . ' !important';
			}else {
				$spacingBottomImp = isset($attr['bottomMargin']) ? $attr['bottomMargin'].$marginType : '1'.$marginType;
			}
			if( isset($attr['boxShaowImp']) == true ){
				$boxShaowImp = $boxshadowpos.' '.$boxshadowx.$unit.' '.$boxshadowy.$unit.' '.$boxshadowblur.$unit.' '.$boxshadowspread.$unit.' '.$boxshadowcolor . ' !important';
				$boxShaowImpHov = $boxshadowposhover.' '.$boxshadowxhover.$unit.' '.$boxshadowyhover.$unit.' '.$boxshadowblurhover.$unit.' '.$boxshadowspreadhover.$unit.' '.$boxshadowcolorhover . ' !important';
			}else {
				$boxShaowImp = $boxshadowpos.' '.$boxshadowx.$unit.' '.$boxshadowy.$unit.' '.$boxshadowblur.$unit.' '.$boxshadowspread.$unit.' '.$boxshadowcolor;
				$boxShaowImpHov = $boxshadowposhover.' '.$boxshadowxhover.$unit.' '.$boxshadowyhover.$unit.' '.$boxshadowblurhover.$unit.' '.$boxshadowspreadhover.$unit.' '.$boxshadowcolorhover;
			}

			if( isset($attr['advpaddIngImp']) == true ){
				$advpaddIngtopdeskImp = $paddingtopdesk.' '.$paddingrightdesk.' '.$paddingbottomdesk.' '.$paddingleftdesk . ' !important';
				$paddingtoptabletImp = $paddingtoptablet.' '.$paddingrighttablet.' '.$paddingbottomtablet.' '.$paddinglefttablet. ' !important';
				$paddingtopmobImp = $paddingtopmob.' '.$paddingrightmob.' '.$paddingbottommob.' '.$paddingleftmob. ' !important';
			}else {
				$advpaddIngtopdeskImp = $paddingtopdesk.' '.$paddingrightdesk.' '.$paddingbottomdesk.' '.$paddingleftdesk;
				$paddingtoptabletImp = $paddingtoptablet.' '.$paddingrighttablet.' '.$paddingbottomtablet.' '.$paddinglefttablet;
				$paddingtopmobImp = $paddingtopmob.' '.$paddingrightmob.' '.$paddingbottommob.' '.$paddingleftmob;
			}



			$selectors = array(
				' .ive-advanced-text-inner-wrap' => array(
					'background'			=> $backgroundImage,
					'opacity'				=> isset($attr['bgOpacity']) ? $attr['bgOpacity']/100 : 1,
					'font-weight'			=> isset($attr['fontWeight']) ? $attr['fontWeight'] : 400,
					'font-style'			=> isset($attr['fontStyle']) ? $attr['fontStyle'] : 'normal',
					'font-family'			=> isset($attr['typography']) ? $attr['typography'] : '',
					'color'					=> $headingColorImp,
					'letter-spacing'		=> isset($attr['letterSpacing']) ? $attr['letterSpacing'].$unit : '1'.$unit,
					'text-transform'		=> isset($attr['textTransform']) ? $attr['textTransform'] : '',
				),
				' .ive-advanced-text-inner-wrap:hover' => array(
					'color'					=> $headingColorImpHov,
					'opacity'				=> isset($attr['headhoverbgOpacity']) ? $attr['headhoverbgOpacity']/100 : 1,
					'background'			=> $backgroundImageHov
				),
				'.ive-advanced-text-wrap' => array(
					'background-color'		=> $headingBgColorImp,
					'box-shadow'			=> $boxShaowImp,
					'margin-top'			=> $spacingTopImp,
					'margin-bottom'			=> $spacingBottomImp,
					'background'			=> $backgroundImage_div,
				),
				'.ive-advanced-text-wrap:hover' => array(
					'background-color'		=> $headingBgColorImpHov,
					'box-shadow'			=> $boxShaowImpHov,
					'background'			=> $backgroundImage_div_hover,
				)
			);

			$d_selectors = array(
				'.ive-advanced-text-wrap' => array(
					'display'				=> $deskvisible ? (($textOptions !== 'text') ? 'flex' : 'block' ) : 'none',
				),
				' .ive-advanced-text-inner-wrap' => array(
					'font-size'				=> isset($attr['deskfontSize']) ? $attr['deskfontSize'].$unit : '24'.$unit,
					'padding'				=> $advpaddIngtopdeskImp
				),
			);

			$t_selectors = array(
				'.ive-advanced-text-wrap' => array(
					'display'				=> $tabvisible ? (($textOptions !== 'text') ? 'flex' : 'block' ) : 'none',
				),
				' .ive-advanced-text-inner-wrap' => array(
					'font-size'				=> isset($attr['tabfontSize']) ? $attr['tabfontSize'].$unit : '20'.$unit,
					'padding'				=> $paddingtoptabletImp
				)
			);

			$m_selectors = array(
				'.ive-advanced-text-wrap' => array(
					'display'				=> $mobvisible ? (($textOptions !== 'text') ? 'flex' : 'block') : 'none',
				),
				' .ive-advanced-text-inner-wrap' => array(
					'font-size'				=> isset($attr['mobfontSize']) ? $attr['mobfontSize'].$unit : '16'.$unit,
					'padding'				=> $paddingtopmobImp
				)
			);

			if ($textOptions == 'icon') {
				if ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $deskalign == 'right' ) {
					$selectors[' .ive-text-option-parent']['margin-left'] = 'auto';
				}elseif ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $deskalign == 'left' ) {
					$selectors[' .ive-text-option-parent']['margin-left'] = 0;
				}elseif ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $deskalign == 'center' ) {
					$selectors[' .ive-text-option-parent']['margin'] = 'auto';
				}

				if ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $tabalign == 'right' ) {
					$t_selectors[' .ive-text-option-parent']['margin-left'] = 'auto';
				}elseif ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $tabalign == 'left' ) {
					$t_selectors[' .ive-text-option-parent']['margin-left'] = 0;
				}elseif ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $tabalign == 'center' ) {
					$t_selectors[' .ive-text-option-parent']['margin'] = 'auto';
				}

				if ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $mobalign == 'right' ) {
					$m_selectors[' .ive-text-option-parent']['margin-left'] = 'auto';
				}elseif ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $mobalign == 'left' ) {
					$m_selectors[' .ive-text-option-parent']['margin-left'] = 0;
				}elseif ( ($optionSide == 'column-reverse' || $optionSide == 'column') && $mobalign == 'center' ) {
					$m_selectors[' .ive-text-option-parent']['margin'] = 'auto';
				}

				$selectors[' .ive-paragraph-icon']['font-size'] = $iconfontSizedesk;
				$t_selectors[' .ive-paragraph-icon']['font-size'] = $iconfontSizetab;
				$m_selectors[' .ive-paragraph-icon']['font-size'] = $iconfontSizemob;
				$selectors[' .ive-paragraph-icon']['color'] = isset($attr['iconColor']) ? $attr['iconColor'] : '';

				$selectors[' .ive-paragraph-icon:hover']['color'] = isset($attr['iconHoverColor']) ? $attr['iconHoverColor'] : '';

			}
			if ($textOptions !== 'text') {
				$selectors['.ive-advanced-text-wrap']['display'] = 'flex';
				$selectors['.ive-advanced-text-wrap']['flex-direction'] = $optionSide;
			}

			if ( ($optionSide == 'row-reverse' || $optionSide == 'row') && $textOptions !== 'text') {
				$selectors['.ive-advanced-text-wrap']['justify-content'] = $deskalign;
				$t_selectors['.ive-advanced-text-wrap']['justify-content'] = $tabalign;
				$m_selectors['.ive-advanced-text-wrap']['justify-content'] = $mobalign;
			}

			if ($optionSide === 'row' && $textOptions !== 'text' ) {
				$selectors[' .ive-text-option-parent']['padding-right'] = isset($attr['optionPadding']) ? $attr['optionPadding'].$unit : '20'.$unit;
			}
			if ($optionSide === 'row-reverse' && $textOptions !== 'text' ) {
				$selectors[' .ive-text-option-parent']['padding-left'] = isset($attr['optionPadding2']) ? $attr['optionPadding2'].$unit : '20'.$unit;
			}

			// if ($optionSide == 'row' && $textOptions !== 'text' ) {
			// 	// $selectors[' .ive-advanced-text-inner-wrap']['padding-right'] = isset($attr['optionPadding2']) ? $attr['optionPadding2'].$unit : '20'.$unit;
			// }

			if($gradientDisable){
				$selectors[' .ive-advanced-text-inner-wrap']['-webkit-text-fill-color'] = 'transparent';
				$selectors[' .ive-advanced-text-inner-wrap']['-webkit-background-clip'] = 'text';

				$selectors['.ive-advanced-text-inner-wrap:hover']['-webkit-text-fill-color'] = 'transparent';
				$selectors['.ive-advanced-text-inner-wrap:hover']['-webkit-background-clip'] = 'text';
				$selectors['.ive-advanced-text-inner-wrap:hover']['background-clip'] = 'text';
			}

			if ($animationtype != 'none' ) {
				$selectors['.ive-advanced-text-wrap']['animation-iteration-count'] = isset($attr['animationiteration']) ? $attr['animationiteration'] : 1;
				$selectors['.ive-advanced-text-wrap']['visibility'] = 'visible';
				$selectors['.ive-advanced-text-wrap']['animation-name'] = $animationtype;
				$selectors['.ive-advanced-text-wrap']['animation-delay'] = isset($attr['animationdelay']) ? $attr['animationdelay'].'s' : '';
				$selectors['.ive-advanced-text-wrap']['animation-duration'] = isset($attr['animationspeed']) ? $attr['animationspeed'].'s' : '';
			}

			if ($bordertype != 'none') {
				$border = $bordertop.' '.$borderright.' '.$borderbottom.' '.$borderleft;
				$borderRadius = $borderadiustop.' '.$borderadiusright.' '.$borderadiusbottom.' '.$borderadiusleft;
				if( isset($attr['advborderImp']) == true ){
					$selectors['.ive-advanced-text-wrap']['border-color'] = isset($attr['bordercolor']) ? $attr['bordercolor'] . ' !important' : '';
					$selectors['.ive-advanced-text-wrap']['border-width'] = $border . ' !important';
					$selectors['.ive-advanced-text-wrap']['border-style'] = $bordertype . ' !important';
					$selectors['.ive-advanced-text-wrap']['border-radius'] = $borderRadius . ' !important';
				}else {

					$selectors['.ive-advanced-text-wrap']['border-color'] = isset($attr['bordercolor']) ? $attr['bordercolor'] : '';
					$selectors['.ive-advanced-text-wrap']['border-width'] = $border;
					$selectors['.ive-advanced-text-wrap']['border-style'] = $bordertype;
					$selectors['.ive-advanced-text-wrap']['border-radius'] = $borderRadius;
				}
			}

			if ($bordertypehover != 'none') {
				$borderHov = $bordertophover.' '.$borderrighthover.' '.$borderbottomhover.' '.$borderlefthover;
				$borderRadiusHov = $borderadiustophover.' '.$borderadiusrighthover.' '.$borderadiusbottomhover.' '.$borderadiuslefthover;

				if( isset($attr['advborderImp']) == true ){
					$selectors['.ive-advanced-text-wrap:hover']['border-color'] = isset($attr['bordercolorhover']) ? $attr['bordercolorhover'] . ' !important' : '';
					$selectors['.ive-advanced-text-wrap:hover']['border-width'] = $borderHov . ' !important';
					$selectors['.ive-advanced-text-wrap:hover']['border-style'] = $bordertypehover . ' !important';
					$selectors['.ive-advanced-text-wrap:hover']['border-radius'] = $borderRadiusHov . ' !important';
				}else {
					$selectors['.ive-advanced-text-wrap:hover']['border-color'] = isset($attr['bordercolorhover']) ? $attr['bordercolorhover'] : '';
					$selectors['.ive-advanced-text-wrap:hover']['border-width'] = $borderHov;
					$selectors['.ive-advanced-text-wrap:hover']['border-style'] = $bordertypehover;
					$selectors['.ive-advanced-text-wrap:hover']['border-radius'] = $borderRadiusHov;
				}
			}

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);
			return IVE_Helper::generate_all_css( $combined_selectors, '.ive-div-advance-text' . $attr['uniqueID'] );
		}

		public static function get_slider_css( $attr, $id ) {

		  $defaults = IVE_Helper::$block_list['ive/slide']['attributes'];

		  $attr = array_merge( $defaults, $attr );

		  //attributes
		  $unit = 'px';
		  $innerPadding 		= isset($attr['innerPadding']) ? $attr['innerPadding'] : [];

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();


		  $selectors = array(
		    '' => array(
		      'padding'				=> ( isset($innerPadding) ) ? ($innerPadding[2].$unit.' '.$innerPadding[1].$unit.' '.$innerPadding[3].$unit.' '.$innerPadding[0].$unit).' !important' : 0,

		    ),
		  );

		  $combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );

		  return IVE_Helper::generate_all_css( $combined_selectors, '.ive-inner-tab' . $attr['uniqueID'] );
		}

		public static function get_multiblock_slider_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/carousel']['attributes'];

			$attr = array_merge( $defaults, $attr );

			//attributes
			$unit = 'px';
			$innerPadding 		= isset($attr['innerPadding']) ? $attr['innerPadding'] : [];
			$contentBorder 		= isset($attr['contentBorder']) ? $attr['contentBorder'] : [];
			$owlNavMaxWidth 	= isset($attr['owlNavMaxWidth']) ? $attr['owlNavMaxWidth'] : [];
			$owlNavTop 			= isset($attr['owlNavTop']) ? $attr['owlNavTop'] : [];
			$owlNavLeft 		= isset($attr['owlNavLeft']) ? $attr['owlNavLeft'] : [];
			$owlNavRight 		= isset($attr['owlNavRight']) ? $attr['owlNavRight'] : [];
			$navType 			= isset($attr['navType']) ? $attr['navType'] : [];
			$arrowBtnWidth 		= isset($attr['arrowBtnWidth']) ? $attr['arrowBtnWidth'] : [];
			$arrowBtnHeight 	= isset($attr['arrowBtnHeight']) ? $attr['arrowBtnHeight'] : [];
			$navArrowBdWidth 	= isset($attr['navArrowBdWidth']) ? $attr['navArrowBdWidth'] : [];
			$arrowBtnPadding 	= isset($attr['arrowBtnPadding']) ? $attr['arrowBtnPadding'] : [];
			$navArrowSize 		= isset($attr['navArrowSize']) ? $attr['navArrowSize'] : [];
			$isbggradient 		= isset($attr['isbggradient']) ? $attr['isbggradient'] : false;
			$bgGradType 		= isset($attr['bgGradType']) ? $attr['bgGradType'] : '';
			$contentBgColor = isset($attr['contentBgColor']) ? $attr['contentBgColor'] : '';

			$gradRadPos		= isset($attr['vBgImgPosition']) ? $attr['vBgImgPosition'] : '';
			$gradFirstColor		= isset($attr['bgfirstcolorr']) ? $attr['bgfirstcolorr'] : '';
			$gradFirstLoc		= isset($attr['bgGradLoc1']) ? $attr['bgGradLoc1'] .'%' : '';
			$gradSecondColor		= isset($attr['bgSecondColr']) ? $attr['bgSecondColr'] : '';
			$gradSecondLoc		= isset($attr['bgGradLocSecond']) ? $attr['bgGradLocSecond']. '%' : '';
			$gradAngle		= isset($attr['bgGradAngle']) ? $attr['bgGradAngle'].'deg' : '';

			$hovGradFirstColor		= isset($attr['hovGradFirstColor']) ? $attr['hovGradFirstColor'] : '';
			$hovGradSecondColor		= isset($attr['hovGradSecondColor']) ? $attr['hovGradSecondColor'] : '';
			$actvGradFirstColor		= isset($attr['actvGradFirstColor']) ? $attr['actvGradFirstColor'] : '';
			$actvGradSecondColor	= isset($attr['actvGradSecondColor']) ? $attr['actvGradSecondColor'] : '';

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$background = ''; $backgroundhover = ''; $backgrounddot = ''; $backgrounddotact = '';
			if($isbggradient){
					if($bgGradType === 'radial'){
						$background = ' radial-gradient(at '.$gradRadPos.', '. $gradFirstColor.' '. $gradFirstLoc .' , '. $gradSecondColor .' '. $gradSecondLoc .' ) !important' ;
						$backgroundhover = ' radial-gradient(at '.$gradRadPos.', '. $hovGradFirstColor.' '. $gradFirstLoc .' , '. $hovGradSecondColor .' '. $gradSecondLoc .' ) !important' ;
						$backgrounddotact = ' radial-gradient(at '.$gradRadPos.', '. $actvGradFirstColor.' '. $gradFirstLoc .' , '. $actvGradSecondColor .' '. $gradSecondLoc .' ) !important' ;
					}else{
						$background = ' linear-gradient('.$gradAngle.', '. $gradFirstColor.' '. $gradFirstLoc .', '. $gradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
						$backgroundhover = ' linear-gradient('.$gradAngle.', '. $hovGradFirstColor.' '. $gradFirstLoc .', '. $hovGradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
						$backgrounddotact = ' linear-gradient('.$gradAngle.', '. $actvGradFirstColor.' '. $gradFirstLoc .', '. $actvGradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
					}
					$backgrounddot	= $background ;
			}else{
				$background = isset($attr['navArrowBgColor']) ? $attr['navArrowBgColor'].' !important' : '#ffffff';
				$backgroundhover = isset($attr['navArrowBgHovColor']) ? $attr['navArrowBgHovColor'].' !important' : '#ffffff';
				$backgrounddot	= isset($attr['dotColor']) ? $attr['dotColor'].' !important' : '#222222';
				$backgrounddotact = isset($attr['dotActiveColor']) ? $attr['dotActiveColor'].' !important' : '#000000';
			}

			$selectors = array(
				' .ive-carousel-content-wrap' => array(
					'padding'				=> ( isset($innerPadding) ) ? ($innerPadding[2].$unit.' '.$innerPadding[1].$unit.' '.$innerPadding[3].$unit.' '.$innerPadding[0].$unit).' !important' : 0,
					'border-width'			=> ( isset($contentBorder) ) ? ($contentBorder[2].$unit.' '.$contentBorder[1].$unit.' '.$contentBorder[3].$unit.' '.$contentBorder[0].$unit).' !important' : 0,
					'border-style'			=> isset($attr['contentBorderStyle']) ? $attr['contentBorderStyle'].' !important' : 'solid',
					'border-radius'			=> isset($attr['contentBorderRadius']) ? $attr['contentBorderRadius'].$unit.' !important' : 0,
					'background'				=> isset($attr['contentBgColor']) ? $attr['contentBgColor']: 0,
				),
				' .owl-dots .owl-dot.active span' => array(
					'background'			=> $backgrounddotact,
				),
				' .owl-dots .owl-dot span' => array(
					'background'			=> $backgrounddot,
					'border-radius'		=> isset($attr['dotBorderRadius']) ? $attr['dotBorderRadius'].$unit.' !important' : 0,
					'border-style'		=> 'solid !important',
					'border-color'					=> isset($attr['navArrowBdColor']) ? $attr['navArrowBdColor'].' !important' : '#000000'
				),
				' .owl-dots' => array(
					'width'					=> 'auto !important',
					'position'				=> 'relative !important',
					'float'					=> isset($attr['dotsalign']) ? $attr['dotsalign'].' !important' : 'center',
					'padding-top'			=> ( isset($attr['dotPaddingTop']) && $attr['dotPaddingTop'] !== 0) ? $attr['dotPaddingTop'].$unit.' !important' : ''
				),
				' .owl-nav button' => array(
					'border-radius'			=> isset($attr['navArrowBdRadius']) ? $attr['navArrowBdRadius'].$unit.' !important' : 0,
					'border-style'			=> 'solid !important',
					'color'					=> isset($attr['navArrowColor']) ? $attr['navArrowColor'].' !important' : '#000000',
					'background'			=> $background,
					'border-color'			=> isset($attr['navArrowBdColor']) ? $attr['navArrowBdColor'].' !important' : '#000000',
				),
				' .owl-nav button i' => array(
					'color'						=> isset($attr['navArrowColor']) ? $attr['navArrowColor'].' !important' : '#000000',
				),
				' .owl-nav button:hover' => array(
					'color'						=> isset($attr['navArrowHovColor']) ? $attr['navArrowHovColor'].' !important' : '#ffffff',
					'background'			=> $backgroundhover,
					'border-color'		=> isset($attr['navArrowBdHovColor']) ? $attr['navArrowBdHovColor'].' !important' : '#ffffff',
				),
				' .owl-nav button:hover i' => array(
					'color'						=> isset($attr['navArrowHovColor']) ? $attr['navArrowHovColor'].' !important' : '#ffffff',
				),
				'.ive-carousel-wrap' => array(
					'max-width'				=> isset($attr['maxWidth']) ? $attr['maxWidth'].$unit : 'none',
				)
			);

			$m_selectors = array(
				' .owl-nav' => array(
					'max-width'				=> ( !empty($owlNavMaxWidth) ) ? $owlNavMaxWidth[2].'% !important' : '100% !important',
					'top'					=> ( !empty($owlNavTop) ) ? $owlNavTop[2].'% !important' : '35% !important',
				),
				' .owl-nav button' => array(
					'width'					=> ( !empty($arrowBtnWidth) ) ? $arrowBtnWidth[2].$unit.' !important' : '40'.$unit.' !important',
					'height'				=> ( !empty($arrowBtnHeight) ) ? $arrowBtnHeight[2].$unit.' !important' : '40'.$unit.' !important',
					'border-width'			=> ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[2].$unit.' !important' : 0,
					'position'				=> 'relative !important'
				),
				' .owl-nav button.owl-prev' => array(
					'padding'				=> (isset($arrowBtnPadding) ? ($arrowBtnPadding[2][0].$unit.' '.$arrowBtnPadding[2][1].$unit.' '.$arrowBtnPadding[2][2].$unit.' '.$arrowBtnPadding[2][3].$unit).' !important' : ''),
					'left'					=> ( isset($owlNavLeft) ) ? $owlNavLeft[2].'% !important' : 0,
				),
				' .owl-nav button.owl-next' => array(
					'padding'				=> (isset($arrowBtnPadding) ? ($arrowBtnPadding[2][0].$unit.' '.$arrowBtnPadding[2][1].$unit.' '.$arrowBtnPadding[2][2].$unit.' '.$arrowBtnPadding[2][3].$unit).' !important' : ''),
					'right'					=> ( isset($owlNavRight) ) ? $owlNavRight[2].'% !important' : 0,
				),
				' .owl-nav button i' => array(
					'font-size'				=> (isset($navArrowSize) ? $navArrowSize[2].$unit : '20'.$unit ).' !important'
				),
				' .owl-dots .owl-dot span' => array(
				  'border-width'			=> ( isset($navArrowBdWidth) ) ? $navArrowBdWidth[2].$unit.' !important' : 0,
				),
			);

			$t_selectors = array(
				' .owl-nav' => array(
					'max-width'				=> ( isset($owlNavMaxWidth) ) ? $owlNavMaxWidth[1].'% !important' : '100% !important',
					'top'					=> ( isset($owlNavTop) ) ? $owlNavTop[1].'% !important' : '35% !important',
				),
				' .owl-nav button' => array(
					'width'					=> ( isset($arrowBtnWidth) ) ? $arrowBtnWidth[1].$unit.' !important' : '40'.$unit.' !important',
					'height'				=> ( isset($arrowBtnHeight) ) ? $arrowBtnHeight[1].$unit.' !important' : '40'.$unit.' !important',
					'border-width'			=> ( isset($navArrowBdWidth) ) ? $navArrowBdWidth[1].$unit.' !important' : 0,
					'position'				=> 'relative !important'
				),
				' .owl-nav button.owl-prev' => array(
					'padding'				=> (isset($arrowBtnPadding) ? ($arrowBtnPadding[1][0].$unit.' '.$arrowBtnPadding[1][1].$unit.' '.$arrowBtnPadding[1][2].$unit.' '.$arrowBtnPadding[1][3].$unit).' !important' : ''),
					'left'					=> ( isset($owlNavLeft) ) ? $owlNavLeft[1].'% !important' : 0,
				),
				' .owl-nav button.owl-next' => array(
					'padding'				=> (isset($arrowBtnPadding) ? ($arrowBtnPadding[1][0].$unit.' '.$arrowBtnPadding[1][1].$unit.' '.$arrowBtnPadding[1][2].$unit.' '.$arrowBtnPadding[1][3].$unit).' !important' : ''),
					'right'					=> ( isset($owlNavRight) ) ? $owlNavRight[1].'% !important' : 0,
				),
				' .owl-nav button i' => array(
					'font-size'				=> (isset($navArrowSize) ? $navArrowSize[1].$unit : '20'.$unit ).' !important'
				),
				' .owl-dots .owl-dot span' => array(
				  'border-width'			=> ( isset($navArrowBdWidth) ) ? $navArrowBdWidth[1].$unit.' !important' : 0,
				),
			);

			$d_selectors = array(
				' .owl-nav' => array(
					'max-width'				=> ( isset($owlNavMaxWidth) ) ? $owlNavMaxWidth[0].'% !important' : '100% !important',
					'top'					=> ( isset($owlNavTop) ) ? $owlNavTop[0].'% !important' : '35% !important',
				),
				' .owl-nav button' => array(
					'width'					=> ( isset($arrowBtnWidth) ) ? $arrowBtnWidth[0].$unit.' !important' : '40'.$unit.' !important',
					'height'				=> ( isset($arrowBtnHeight) ) ? $arrowBtnHeight[0].$unit.' !important' : '40'.$unit.' !important',
					'border-width'			=> ( isset($navArrowBdWidth) ) ? $navArrowBdWidth[0].$unit.' !important' : 0,
					'position'				=> 'relative !important'
				),
				' .owl-nav button.owl-prev' => array(
					'padding'				=> (isset($arrowBtnPadding) ? ($arrowBtnPadding[0][0].$unit.' '.$arrowBtnPadding[0][1].$unit.' '.$arrowBtnPadding[0][2].$unit.' '.$arrowBtnPadding[0][3].$unit).' !important' : ''),
					'left'					=> ( isset($owlNavLeft) ) ? $owlNavLeft[0].'% !important' : 0,
				),
				' .owl-nav button.owl-next' => array(
					'padding'				=> (isset($arrowBtnPadding) ? ($arrowBtnPadding[0][0].$unit.' '.$arrowBtnPadding[0][1].$unit.' '.$arrowBtnPadding[0][2].$unit.' '.$arrowBtnPadding[0][3].$unit).' !important' : ''),
					'right'					=> ( isset($owlNavRight) ) ? $owlNavRight[0].'% !important' : 0,
				),
				' .owl-nav button i' => array(
					'font-size'				=> (isset($navArrowSize) ? $navArrowSize[0].$unit : '20'.$unit ).' !important'
				),
				' .owl-dots .owl-dot span' => array(
				  'border-width'			=> ( isset($navArrowBdWidth) ) ? $navArrowBdWidth[0].$unit.' !important' : 0,
				),
			);

			if ( !empty($navType) ) {
				$d_selectors[' .owl-nav']['display'] 	= ( $navType[0] == 'arrows' || $navType[0] == 'both' ) ? '' : 'none !important';
				$d_selectors[' .owl-dots']['display'] 	= ( $navType[0] == 'dots' || $navType[0] == 'both' ) ? '' : 'none !important';

				$t_selectors[' .owl-nav']['display'] 	= ( $navType[1] == 'arrows' || $navType[1] == 'both' ) ? '' : 'none !important';
				$t_selectors[' .owl-dots']['display'] 	= ( $navType[1] == 'dots' || $navType[1] == 'both' ) ? '' : 'none !important';

				$m_selectors[' .owl-nav']['display'] 	= ( $navType[2] == 'arrows' || $navType[2] == 'both' ) ? '' : 'none !important';
				$m_selectors[' .owl-dots']['display'] 	= ( $navType[2] == 'dots' || $navType[2] == 'both' ) ? '' : 'none !important';
			}

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.ive-carousel-id' . $attr['uniqueID'] );
		}

		public static function get_multiblock_slider_image_css( $attr, $id ) {

			$defaults = IVE_Helper::$block_list['ive/carouselimage']['attributes'];

			$attr = array_merge( $defaults, $attr );

			$left 		= isset($attr['left']) ? $attr['left'] : [];
			$right 		= isset($attr['right']) ? $attr['right'] : [];

			$isbggradient 	= isset($attr['isbggradient']) ? $attr['isbggradient'] : false;
			$bgGradType 		= isset($attr['bgGradType']) ? $attr['bgGradType'] : 'linear';
			$vBgImgPosition 		= isset($attr['vBgImgPosition']) ? $attr['vBgImgPosition'] : '';
			$bgfirstcolorr 		= isset($attr['bgfirstcolorr']) ? $attr['bgfirstcolorr'] : '';
			$bgGradLoc 		= isset($attr['bgGradLoc1']) ? $attr['bgGradLoc1']. '%' : '';
			$bgSecondColr 		= isset($attr['bgSecondColr']) ? $attr['bgSecondColr'] : '';
			$bgGradLocSecond 		= isset($attr['bgGradLocSecond']) ? $attr['bgGradLocSecond']. '%' : '';
			$bgGradAngle 		= isset($attr['bgGradAngle']) ? $attr['bgGradAngle'].'deg' : '';

			$background = '';
			if($isbggradient){
					if($bgGradType === 'radial'){
						$background = ' radial-gradient(at '.$gradRadPos.', '. $bgfirstcolorr.' '. $bgGradLoc .' , '. $bgSecondColr .' '. $bgGradLocSecond .' ) !important' ;
					}else{
						$background = ' linear-gradient('.$bgGradAngle.', '. $bgfirstcolorr.' '. $bgGradLoc .', '. $bgSecondColr . ' '. $bgGradLocSecond .' ) !important' ;
					}
			}else{
				$background = isset($attr['bgColor']) ? $attr['bgColor'] : '';
			}

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$selectors = array(
				' .carousel-image' => array(
					'position'				=> 'relative'
				),
				' .carosol-overlay' => array(
					'position'				=> 'absolute',
					'left'					=> 0,
					'top'					=> 0,
					'width'					=> '100%',
					'height'				=> '100%',
					'background'		=> $background,
					'opacity'				=> isset($attr['bgOpacity']) ? $attr['bgOpacity']/100 : '',
				),
				' .carousel-content' => array(
					'transform'				=> 'translateY(-50%)',
					'top'					=> '50%'
				)
			);

			$d_selectors = array(
				' .carousel-content' => array(
					'left'					=> (!empty($left) ? $left[2].'% !important' : 0 ),
					'right'					=> (!empty($right) ? $right[2].'% !important' : 0 )
				)
			);

			$t_selectors = array(
				' .carousel-content' => array(
					'left'					=> (!empty($left) ? $left[1].'% !important' : 0 ),
					'right'					=> (!empty($right) ? $right[1].'% !important' : 0 )
				)
			);

			$m_selectors = array(
				' .carousel-content' => array(
					'left'					=> (!empty($left) ? $left[0].'% !important' : 0 ),
					'right'					=> (!empty($right) ? $right[0].'% !important' : 0 )
				)
			);

			$combined_selectors = array(
				'desktop' 		=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'  		=> $t_selectors,
				'mobile'  		=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '.carousel-outer-dynamic' . $attr['uniqueID'] );
		}

		public static function get_tabs_css( $attr, $id ) {
			$defaults = IVE_Helper::$block_list['ive/tabs']['attributes'];
			$attr = array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();
			$tabCount = $attr['tabCount'];

			$mainDivmaxWidth		= isset($attr['maxWidth']) ? $attr['maxWidth'] .'px ' : '';
			$titleColorHover		= isset($attr['titleColorHover']) ? $attr['titleColorHover'] : '';
			$titleBorderHover		= isset($attr['titleBorderHover']) ? $attr['titleBorderHover'] : '';
			$titleBgHover				= isset($attr['titleBgHover']) ? $attr['titleBgHover'] : '';

			$tabsidmclass 																			=	'.ive-tabs-wrap';
			$selectors[$tabsidmclass]['max-width']							= $mainDivmaxWidth;
			$d_selectors[' .ive-tabs-xl-left']['text-align']		= 'left !important';
			$d_selectors[' .ive-tabs-xl-center']['text-align']	= 'center !important';
			$d_selectors[' .ive-tabs-xl-right']['text-align']		= 'right !important';

			$tabhoverClass 															= ' .ive-title-item:hover .ive-tab-title';
			$selectors[$tabhoverClass]['color']					= $titleColorHover.' !important';
			$selectors[$tabhoverClass]['border-color']	= $titleBorderHover;

			$backgroundColor			= isset($attr['titleBg']) ? $attr['titleBg'] : '';
			$titleColor						= isset($attr['titleColor']) ? $attr['titleColor'].' !important' : '';
			$size									= isset($attr['size']) ? $attr['size'] : '';
			$sizeType							= isset($attr['sizeType']) ? $attr['sizeType'] : '';
			$lineHeight						= isset($attr['lineHeight']) ? $attr['lineHeight'] : '';
			$lineType							= isset($attr['lineType']) ? $attr['lineType'] : '';
			$fontWeight						= isset($attr['fontWeight']) ? $attr['fontWeight'] : '';
			$fontStyle						= isset($attr['fontStyle']) ? $attr['fontStyle'] : '';
			$letterSpacing				= isset($attr['letterSpacing']) ? $attr['letterSpacing'].'px !important' : '';
			$fontfamily						= isset($attr['typography']) ? $attr['typography'] : '';
			$borderWidth					= isset($attr['titleBorderWidth']) ? $attr['titleBorderWidth'].'px !important' : '';
			$borderRadius					= isset($attr['titleBorderRadius']) ? $attr['titleBorderRadius'].'px !important' : '';
			$textTransform				= isset($attr['tebscontentTransform']) ? $attr['tebscontentTransform'] : '';

			$titlePadding					= isset( $attr['titlePadding'] ) ? $attr['titlePadding'] : [
				[ 10, 10, 10, 10 ],
				[ 10, 10, 10, 10 ],
				[ 10, 10, 10, 10 ]
			];
			$selectors[' .ive-tab-title']['text-transform']		=	$textTransform;
			$selectors[' .ive-tab-title']['padding']		=	$titlePadding[0][0] . 'px ' . $titlePadding[0][1] . 'px ' . $titlePadding[0][2] . 'px ' . $titlePadding[0][3] . 'px !important';
			$t_selectors[' .ive-tab-title']['padding']	=	$titlePadding[1][0] . 'px ' . $titlePadding[1][1] . 'px ' . $titlePadding[1][2] . 'px ' . $titlePadding[1][3] . 'px !important';
			$m_selectors[' .ive-tab-title']['padding']	=	$titlePadding[2][0] . 'px ' . $titlePadding[2][1] . 'px ' . $titlePadding[2][2] . 'px ' . $titlePadding[2][3] . 'px !important';

			$titlePaddingTop			= isset($attr['titlePaddingTop']) ? $attr['titlePaddingTop'] . 'px ' : ' 0px ';
			$titlePaddingRight		= isset($attr['titlePaddingRight']) ? $attr['titlePaddingRight'].'px ' : ' 0px ';
			$titlePaddingBottom		= isset($attr['titlePaddingBottom']) ? $attr['titlePaddingBottom'].'px ' : ' 0px ';
			$titlePaddingLeft			= isset($attr['titlePaddingLeft']) ? $attr['titlePaddingLeft'].'px ' : ' 0px ';

			$titleMarginTop				= isset($attr['titleMarginTop']) ? $attr['titleMarginTop'].'px ' : '';
			$titleMarginBottom		= isset($attr['titleMarginBottom']) ? $attr['titleMarginBottom'].'px ' : '0px ';
			$titleMarginLeft			= isset($attr['titleMarginLeft']) ? $attr['titleMarginLeft'].'px ' : '0px ';
			$titleMarginRight			= isset($attr['titleMarginRight']) ? $attr['titleMarginRight'].'px ' : '0px ';
			$borderColor					= isset($attr['titleBorder']) ? $attr['titleBorder'].' !important' : '';
			$widthType						= isset($attr['widthType']) ? $attr['widthType'] : 'normal';
			$layout								= isset($attr['layout']) ? $attr['layout'] : 'tabs';
			$tabSize							= isset($attr['tabSize']) ? $attr['tabSize'] : '';
			$tabLineHeight				= isset($attr['tabLineHeight']) ? $attr['tabLineHeight'] : '';
			$mobileSize						= isset($attr['mobileSize']) ? $attr['mobileSize'] : '';
			$mobileLineHeight			= isset($attr['mobileLineHeight']) ? $attr['mobileLineHeight'] : '';

			$titleMargin					= isset($attr['titleMargin']) ? $attr['titleMargin'].'px ' : '';
			$titleColorActive			= isset($attr['titleColorActive']) ? $attr['titleColorActive'] .' !important' : '';
			$titleBorderActive		= isset($attr['titleBorderActive']) ? $attr['titleBorderActive'] .' !important' : '';
			$titleBgActive				= isset($attr['titleBgActive']) ? $attr['titleBgActive'] .' !important' : '';

			//slider
			$navType 					= isset($attr['navType']) ? $attr['navType'] : [];
			$owlNavMaxWidth 	= isset($attr['owlNavMaxWidth']) ? $attr['owlNavMaxWidth'] : [];
			$owlNavTop 				= isset($attr['owlNavTop']) ? $attr['owlNavTop'] : [];
			$owlNavLeft 			= isset($attr['owlNavLeft']) ? $attr['owlNavLeft'] : [];
			$owlNavRight 			= isset($attr['owlNavRight']) ? $attr['owlNavRight'] : [];
			$arrowBtnWidth 		= isset($attr['arrowBtnWidth']) ? $attr['arrowBtnWidth'] : [];
			$arrowBtnHeight 	= isset($attr['arrowBtnHeight']) ? $attr['arrowBtnHeight'] : [];
			$navArrowBdWidth 	= isset($attr['navArrowBdWidth']) ? $attr['navArrowBdWidth'] : [];
			$arrowBtnPadding 	= isset($attr['arrowBtnPadding']) ? $attr['arrowBtnPadding'] : [];
			$navArrowSize 		= isset($attr['navArrowSize']) ? $attr['navArrowSize'] : [];

			$tabshowBGimg				= isset($attr['backgroundType']) ? $attr['backgroundType'] : 'color';

			$tabActiveClass 				= ' .ive-tab-title-active .ive-tab-title';
			$tabHeadingClass 				= ' .ive-tab-alltitle-heading';
			$tabHeadingHoverClass		= ' .ive-tab-alltitle-heading:hover ';

			$selectors[$tabHeadingHoverClass]['color']				= $titleColorHover.' !important';
			$selectors[$tabHeadingHoverClass]['border-color']	= $titleBorderHover;

			$selectors[$tabActiveClass]['color']				= $titleColorActive;
			$selectors[$tabActiveClass]['border-color']	= $titleBorderActive;
			if( $tabshowBGimg == 'color' ) {
				$selectors[$tabHeadingHoverClass]['background-color']= $titleBgHover;
				$selectors[$tabActiveClass]['background-color'] = $titleBgActive;
				$selectors[$tabHeadingClass]['background-color'] = $backgroundColor;
			  	$selectors[$tabhoverClass]['background-color']= $titleBgHover;
		  	}
			$selectors[$tabHeadingClass]['color'] = $titleColor ;
			$selectors[$tabHeadingClass]['font-size'] = $size.$sizeType;
			$selectors[$tabHeadingClass]['line-height'] = $lineHeight.$lineType;
			$selectors[$tabHeadingClass]['font-weight'] = $fontWeight ;
			$selectors[$tabHeadingClass]['font-style'] = $fontStyle;
			$selectors[$tabHeadingClass]['letter-spacing'] = $letterSpacing;
			$selectors[$tabHeadingClass]['font-family'] = $fontfamily	;
			$selectors[$tabHeadingClass]['border-width'] = $borderWidth ;
			$selectors[$tabHeadingClass]['border-radius'] = $borderRadius ;

			$selectors[$tabHeadingClass]['border-color'] = $borderColor	;

			$marginRighttab		= isset($attr['gutter'][ 1 ]) ? $attr['gutter'][ 1 ].'px' : '';
			$t_selectors[$tabHeadingClass]['margin-right'] = $marginRighttab	;

			$t_selectors[$tabHeadingClass]['font-size'] = $tabSize.$sizeType;
			$t_selectors[$tabHeadingClass]['line-height'] = $tabLineHeight.$lineType;

			//Mobilecss
			$marginRighttab		= isset($attr['gutter'][ 2 ]) ? $attr['gutter'][ 2 ].'px' : '';
			$m_selectors[$tabHeadingClass]['margin-right'] = $marginRighttab	;

			$m_selectors[$tabHeadingClass]['font-size'] = $mobileSize.$sizeType;
			$m_selectors[$tabHeadingClass]['line-height'] = $mobileLineHeight.$lineType;

			if( 'vtabs' !== $layout && 'percent' === $widthType ) {
				$selectors[' > .ive-tabs-title-list li .ive-tab-title']['margin-right']	=	isset( $attr['gutter'][0] ) ? $attr['gutter'][0] . 'px' : '10px';

				if ( isset( $attr['tabWidth'] ) && ! empty( $attr['tabWidth'] ) && is_array( $attr['tabWidth'] ) && ! empty( $attr['tabWidth'][1] ) && '' !== $attr['tabWidth'][1] ) {
					$t_selectors[' > .ive-tabs-title-list.ive-tabs-list-columns > li']['flex']	=	'0 1 ' . round( 100 / $attr['tabWidth'][1], 2 ) . '%';
				}

				if ( isset( $attr['gutter'] ) && ! empty( $attr['gutter'] ) && is_array( $attr['gutter'] ) && isset( $attr['gutter'][1] ) && is_numeric( $attr['gutter'][1] ) ) {
					$t_selectors[' > .ive-tabs-title-list li .ive-tab-title']['margin-right']	=	$attr['gutter'][1] . 'px';
				}

				if ( isset( $attr['tabWidth'] ) && ! empty( $attr['tabWidth'] ) && is_array( $attr['tabWidth'] ) && ! empty( $attr['tabWidth'][2] ) && '' !== $attr['tabWidth'][2] ) {
					$m_selectors[' > .ive-tabs-title-list.ive-tabs-list-columns > li']['flex']	=	'0 1 ' . round( 100 / $attr['tabWidth'][2], 2 ) . '%';
				}

				if ( isset( $attr['gutter'] ) && ! empty( $attr['gutter'] ) && is_array( $attr['gutter'] ) && isset( $attr['gutter'][2] ) && is_numeric( $attr['gutter'][2] ) ) {
					$m_selectors[' > .ive-tabs-title-list li .ive-tab-title']['margin-right']	=	$attr['gutter'][2] . 'px';
				}

				$setmargin = $titleMarginTop .' 0px '. $titleMarginBottom .' !important' ;
			} else {
				$marginRight= '';
				$marginTab = $titleMargin;
				$setmargin = $titleMarginTop . $titleMarginRight . $titleMarginBottom . $titleMarginLeft .' !important' ;
				$selectors[$tabHeadingClass]['margin-right'] = $marginRight	;
			}


			/*if($titleMargin){
				$tabmargin = $titleMargin	. $marginTab . $titleMargin . $marginTab .' !important' ;
			}else{
				$tabmargin= ' !important';
			}*/

			$tabtabTitleClass 	= ' .ive-tab-alltitle-item' ;
	    	$selectors[$tabtabTitleClass]['margin'] = $setmargin;

			$tabcontentminHeight		= isset($attr['minHeight']) ? $attr['minHeight'] .' px ' : '';
			$tabcontentinnerPadding		= isset($attr['innerPadding']) ? $attr['innerPadding'] .'px ' : '';
			$tabcontentcontentBorder		= isset($attr['contentBorder']) ? $attr['contentBorder'] .'px ' : '';
			$tabcontentcontentBgColor		= isset($attr['contentBgColor']) ? $attr['contentBgColor'] : '';
			$contentBorderColor		= isset($attr['contentBorderColor']) ? $attr['contentBorderColor'] : '';

			$selectors[' .ive-tabs-content-wrap']['min-height'] 						= $tabcontentminHeight;
			$selectors[' .ive-tabs-content-wrap']['padding'] 								= $tabcontentinnerPadding;
			$selectors[' .ive-tabs-content-wrap']['border-width'] 					= $tabcontentcontentBorder;
			$selectors[' .ive-tabs-content-wrap']['background-color'] 			= $tabcontentcontentBgColor;
			$selectors[' .ive-tabs-content-wrap']['border-color'] 					= $contentBorderColor;

			$tabSubtitleClass = ' .ive-title-sub-text';
			$subtitleweight		= isset($attr['subtitleFont'][0]['weight']) ? $attr['subtitleFont'][0]['weight'] : '';
			$subtitlestyle		= isset($attr['subtitleFont'][0]['style']) ? $attr['subtitleFont'][0]['style'] : '';
			$subtitleletterSpacing		= isset($attr['subtitleFont'][0]['letterSpacing']) ? $attr['subtitleFont'][0]['letterSpacing'] .'px' : '';
			$subtitlefamily		= isset($attr['subtitleFont'][0]['family']) ? $attr['subtitleFont'][0]['family'] : '';
			$subtitlepadding		= isset($attr['subtitleFont'][0]['padding']) ? $attr['subtitleFont'][0]['padding'][0].'px '.$attr['subtitleFont'][0]['padding'][1].'px '.$attr['subtitleFont'][0]['padding'][2].'px '.$attr['subtitleFont'][0]['padding'][3].'px '  : '';
			$subtitlemargin		= isset($attr['subtitleFont'][0]['margin']) ? $attr['subtitleFont'][0]['margin'][0].'px '.$attr['subtitleFont'][0]['margin'][1].'px '.$attr['subtitleFont'][0]['margin'][2].'px '.$attr['subtitleFont'][0]['margin'][3].'px '  : '';

			$subtitlefontSizeDesk		= isset($attr['subtitleFont'][0]['size'][0]) ? $attr['subtitleFont'][0]['size'][0] .$attr['subtitleFont'][0]['sizeType'] : '';
	    	$subtitlelineHeightDesk		= isset($attr['subtitleFont'][0]['lineHeight'][0]) ? $attr['subtitleFont'][0]['lineHeight'][0] .$attr['subtitleFont'][0]['lineType'] : '';

			$subtitlefontSizetab		= isset($attr['subtitleFont'][0]['size'][1]) ? $attr['subtitleFont'][0]['size'][1] .$attr['subtitleFont'][0]['sizeType'] .' !important' : '';
	    	$subtitlelineHeightab		= isset($attr['subtitleFont'][0]['lineHeight'][1]) ? $attr['subtitleFont'][0]['lineHeight'][1] .$attr['subtitleFont'][0]['lineType'] : '';

			$subtitlefontSizemob		= isset($attr['subtitleFont'][0]['size'][2]) ? $attr['subtitleFont'][0]['size'][2] .$attr['subtitleFont'][0]['sizeType'] : '';
			$subtitlelineHeightmob		= isset($attr['subtitleFont'][0]['lineHeight'][2]) ? $attr['subtitleFont'][0]['lineHeight'][2] .$attr['subtitleFont'][0]['lineType'] : '';

			$d_selectors[$tabSubtitleClass]['font-size'] = $subtitlefontSizeDesk	;
			$d_selectors[$tabSubtitleClass]['line-height'] = $subtitlelineHeightDesk ;
			$t_selectors[$tabSubtitleClass]['font-size'] = $subtitlefontSizetab	;
			$t_selectors[$tabSubtitleClass]['line-height'] = $subtitlelineHeightab	;
			$m_selectors[$tabSubtitleClass]['font-size'] = $subtitlefontSizemob	;
			$m_selectors[$tabSubtitleClass]['line-height'] = $subtitlelineHeightmob	;

			$selectors[$tabSubtitleClass]['font-weight'] 					= $subtitleweight;
			$selectors[$tabSubtitleClass]['font-style'] 					= $subtitlestyle;
			$selectors[$tabSubtitleClass]['letter-spacing'] 			= $subtitleletterSpacing;
			$selectors[$tabSubtitleClass]['font-family'] 					= $subtitlefamily;
			$selectors[$tabSubtitleClass]['padding'] 							= $subtitlepadding;
			$selectors[$tabSubtitleClass]['margin'] 							= $subtitlemargin;

			for ($i=0; $i < $tabCount; $i++) {
				//classes
				$tabHeadingImgClass = ' .ive-tab-img-'.$i;
				$titleImgHeight		= isset($attr['titles'][$i]['imageheight']) ? $attr['titles'][$i]['imageheight'] .'px ' : '';
					$imagewidth				= isset($attr['titles'][$i]['imagewidth']) ? $attr['titles'][$i]['imagewidth'] .'px ' : '';
				$selectors[$tabHeadingImgClass]['height'] = $titleImgHeight;
				$selectors[$tabHeadingImgClass]['width'] = $imagewidth;
			}

			$tabshowBGimg				= isset($attr['backgroundType']) ? $attr['backgroundType'] : '';
			if($tabshowBGimg == 'image'){
				for ($i=0; $i < $tabCount; $i++) {
					$ic = $i+1;
					$tabClass = ' .tabBGImg.ive-title-item-'.$ic;
					$tabBGImg				= isset($attr['titles'][$i]['normalBGimgURL']) ? $attr['titles'][$i]['normalBGimgURL'] : '';
					$selectors[$tabClass]['background'] = "url('$tabBGImg')";
					$selectors[$tabClass]['background-size'] = "cover";

					$tabhoverBGImg				= isset($attr['titles'][$i]['hoverBGImgimgURL']) ? $attr['titles'][$i]['hoverBGImgimgURL'] : '';
					$selectors[$tabClass.':hover']['background'] = "url('$tabhoverBGImg')";
					$selectors[$tabClass.':hover']['background-size'] = "cover";

					$activeBGimgURL				= isset($attr['titles'][$i]['activeBGimgURL']) ? $attr['titles'][$i]['activeBGimgURL'] : '';
					$selectors[$tabClass.'.ive-tab-title-active']['background'] = "url('$activeBGimgURL')";
					$selectors[$tabClass.'.ive-tab-title-active']['background-size'] = "cover";

					$selectors[$tabHeadingClass]['background-color'] = 'transparent !important';
				}
			}

			if($tabshowBGimg == 'gradient'){
				$vBgImgPosition = isset($attr['vBgImgPosition']) ? $attr['vBgImgPosition'] : 'center center';
				$bgfirstcolorr = isset($attr['bgfirstcolorr']) ? $attr['bgfirstcolorr'] : '';
				$headhoverbgfirstcolor = isset($attr['headhoverbgfirstcolor']) ? $attr['headhoverbgfirstcolor'] : '';
				$bgGradLoc = isset($attr['bgGradLoc']) ? $attr['bgGradLoc'] : 0;
				$bgSecondColr = isset($attr['bgSecondColr']) ? $attr['bgSecondColr'] : '';
				$headhoverbgSecondColr = isset($attr['headhoverbgSecondColr']) ? $attr['headhoverbgSecondColr'] : '';
				$bgGradLocSecond = isset($attr['bgGradLocSecond']) ? $attr['bgGradLocSecond'] : 100;
				$bgGradAngle = isset($attr['bgGradAngle']) ? $attr['bgGradAngle'] : 180;
				$backgdOpacity				= isset($attr['backgdOpacity']) ? $attr['backgdOpacity'] : '';
				$actvGradFirstColor = isset($attr['actvGradFirstColor']) ? $attr['actvGradFirstColor'] : '';
				$actvGradSecondColor = isset($attr['actvGradSecondColor']) ? $attr['actvGradSecondColor'] : '';

				$bgGradType = isset($attr['bgGradType']) ? $attr['bgGradType'] : '';

				if('radial' === $bgGradType){
					$backgroundImage = 'radial-gradient(at '.$vBgImgPosition.','.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.' '.$bgGradLocSecond.'%)';
				}else{
					$backgroundImage = 'linear-gradient('.$bgGradAngle.'deg, '.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.'  '.$bgGradLocSecond.'%)';
				}
				if('radial' === $bgGradType){
					$backgroundImageHov = 'radial-gradient(at '.$vBgImgPosition.','.$headhoverbgfirstcolor.' '.$bgGradLoc.'%, '.$headhoverbgSecondColr.' '.$bgGradLocSecond.'%)';
					$titleBgActive = 'radial-gradient(at '.$vBgImgPosition.','.$actvGradFirstColor.' '.$bgGradLoc.'%, '.$actvGradSecondColor.' '.$bgGradLocSecond.'%)';
				}else{
					$backgroundImageHov = 'linear-gradient('.$bgGradAngle.'deg, '.$headhoverbgfirstcolor.' '.$bgGradLoc.'%, '.$headhoverbgSecondColr.'  '.$bgGradLocSecond.'%)';
					$titleBgActive = 'linear-gradient('.$bgGradAngle.'deg, '.$actvGradFirstColor.' '.$bgGradLoc.'%, '.$actvGradSecondColor.'  '.$bgGradLocSecond.'%)';
				}
				$selectors[$tabHeadingClass]['background'] = $backgroundImage ;
				$selectors[$tabHeadingClass.':hover']['background'] = $backgroundImageHov ;
				$selectors[$tabActiveClass]['background'] = $titleBgActive .'!important';

					// $selectors[$tabHeadingHoverClass]['background-color']= $titleBgHover;
			    // $selectors[$tabActiveClass]['background-color'] = $titleBgActive;
			    // $selectors[$tabHeadingClass]['background-color'] = $backgroundColor;
			}
			// print_r($attr['titles']);

			//SLIDER CSS
			$slider_class = ' .ive-tabs_carousel-id' . $attr['uniqueID'] ;

			if ( !empty($navType) ) {
				$d_selectors[$slider_class.' .owl-nav']['display'] 	= ( $navType[0] == 'arrows' || $navType[0] == 'both' ) ? '' : 'none !important';
				$d_selectors[$slider_class.' .owl-dots']['display'] 	= ( $navType[0] == 'dots' || $navType[0] == 'both' ) ? '' : 'none !important';

				$t_selectors[$slider_class.' .owl-nav']['display'] 	= ( $navType[1] == 'arrows' || $navType[1] == 'both' ) ? '' : 'none !important';
				$t_selectors[$slider_class.' .owl-dots']['display'] 	= ( $navType[1] == 'dots' || $navType[1] == 'both' ) ? '' : 'none !important';

				$m_selectors[$slider_class.' .owl-nav']['display'] 	= ( $navType[2] == 'arrows' || $navType[2] == 'both' ) ? '' : 'none !important';
				$m_selectors[$slider_class.' .owl-dots']['display'] 	= ( $navType[2] == 'dots' || $navType[2] == 'both' ) ? '' : 'none !important';
			}else{
				$selectors[$slider_class.' .owl-nav']['display'] 	= 'none !important';
				$selectors[$slider_class.' .owl-dots']['display'] = 'none !important';
			}

			$unit = 'px';
			$backgrounddotact = isset($attr['dotActiveColor']) ? $attr['dotActiveColor'].' !important' : '#000000';
			$background = isset($attr['navArrowBgColor']) ? $attr['navArrowBgColor'].' !important' : '#ffffff';
			$backgroundhover = isset($attr['navArrowBgHovColor']) ? $attr['navArrowBgHovColor'].' !important' : '#ffffff';
			$backgrounddot	= isset($attr['dotColor']) ? $attr['dotColor'].' !important' : '#222222';
			$backgrounddotact = isset($attr['dotActiveColor']) ? $attr['dotActiveColor'].' !important' : '#000000';

			$selectors[$slider_class.' .owl-dots .owl-dot.active span']['background'] = $backgrounddotact;
			$selectors[$slider_class.' .owl-dots .owl-dot span']['background'] = $backgrounddot;
			$selectors[$slider_class.' .owl-dots .owl-dot span']['border-radius'] = isset($attr['dotBorderRadius']) ? $attr['dotBorderRadius'].$unit.' !important' : 0;
			$selectors[$slider_class.' .owl-dots .owl-dot span']['border-style'] = 'solid !important';
			$selectors[$slider_class.' .owl-dots .owl-dot span']['border-color'] = isset($attr['navArrowBdColor']) ? $attr['navArrowBdColor'].' !important' : '#000000';
			$selectors[$slider_class.' .owl-dots']['width'] = 'auto !important';
			$selectors[$slider_class.' .owl-dots']['position'] = 'relative !important';
			$selectors[$slider_class.' .owl-dots']['float'] = isset($attr['dotsalign']) ? $attr['dotsalign'].' !important' : 'center';
			$selectors[$slider_class.' .owl-dots']['padding-top'] = ( isset($attr['dotPaddingTop']) && $attr['dotPaddingTop'] !== 0) ? $attr['dotPaddingTop'].$unit.' !important' : '';
			$selectors[$slider_class.' .owl-nav button']['border-radius'] = isset($attr['navArrowBdRadius']) ? $attr['navArrowBdRadius'].$unit.' !important' : 0;
			$selectors[$slider_class.' .owl-nav button']['border-style'] = 'solid !important' ;
			$selectors[$slider_class.' .owl-nav button']['color'] = isset($attr['navArrowColor']) ? $attr['navArrowColor'].' !important' : '#000000';
			$selectors[$slider_class.' .owl-nav button']['background'] = $background ;
			$selectors[$slider_class.' .owl-nav button']['border-color'] = isset($attr['navArrowBdColor']) ? $attr['navArrowBdColor'].' !important' : '#000000';
			$selectors[$slider_class.' .owl-nav button i']['color'] = isset($attr['navArrowColor']) ? $attr['navArrowColor'].' !important' : '#000000';
			$selectors[$slider_class.' .owl-nav button:hover']['color'] = isset($attr['navArrowHovColor']) ? $attr['navArrowHovColor'].' !important' : '#ffffff' ;
			$selectors[$slider_class.' .owl-nav button:hover']['background'] = $backgroundhover;
			$selectors[$slider_class.' .owl-nav button:hover']['border-color'] = isset($attr['navArrowBdHovColor']) ? $attr['navArrowBdHovColor'].' !important' : '#ffffff';
			$selectors[$slider_class.' .owl-nav button:hover i']['color'] = isset($attr['navArrowHovColor']) ? $attr['navArrowHovColor'].' !important' : '#ffffff';
			$selectors[$slider_class.' .owl-nav button:hover']['border-color'] = isset($attr['navArrowBdHovColor']) ? $attr['navArrowBdHovColor'].' !important' : '#ffffff';

			$m_selectors[$slider_class.' .owl-nav']['max-width'] = ( !empty($owlNavMaxWidth) ) ? $owlNavMaxWidth[2].'% !important' : '100% !important';
			$m_selectors[$slider_class.' .owl-nav']['top'] = ( !empty($owlNavTop) ) ? $owlNavTop[2].'% !important' : '35% !important';

			$m_selectors[$slider_class.' .owl-nav button']['width'] = ( !empty($arrowBtnWidth) ) ? $arrowBtnWidth[2].$unit.' !important' : '40'.$unit.' !important';
			$m_selectors[$slider_class.' .owl-nav button']['height'] = ( !empty($arrowBtnHeight) ) ? $arrowBtnHeight[2].$unit.' !important' : '40'.$unit.' !important';
			$m_selectors[$slider_class.' .owl-nav button']['border-width'] = ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[2].$unit.' !important' : 0;
			$m_selectors[$slider_class.' .owl-nav button']['position'] = 'relative !important';

			$m_selectors[$slider_class.' .owl-nav button.owl-prev']['padding'] = (!empty($arrowBtnPadding) ? ($arrowBtnPadding[2][0].$unit.' '.$arrowBtnPadding[2][1].$unit.' '.$arrowBtnPadding[2][2].$unit.' '.$arrowBtnPadding[2][3].$unit).' !important' : '');
			$m_selectors[$slider_class.' .owl-nav button.owl-prev']['left'] = ( !empty($owlNavLeft) ) ? $owlNavLeft[2].'% !important' : 0;
			$m_selectors[$slider_class.' .owl-nav button.owl-next']['padding'] = (!empty($arrowBtnPadding) ? ($arrowBtnPadding[2][0].$unit.' '.$arrowBtnPadding[2][1].$unit.' '.$arrowBtnPadding[2][2].$unit.' '.$arrowBtnPadding[2][3].$unit).' !important' : '');
			$m_selectors[$slider_class.' .owl-nav button.owl-next']['right'] = ( !empty($owlNavRight) ) ? $owlNavRight[2].'% !important' : 0;

			$m_selectors[$slider_class.' .owl-nav button i']['font-size'] = (!empty($navArrowSize) ? $navArrowSize[2].$unit : '20'.$unit ).' !important';

			$m_selectors[$slider_class.' .owl-dots .owl-dot span']['border-width'] = ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[2].$unit.' !important' : 0;


			$t_selectors[$slider_class.' .owl-nav']['max-width'] = ( !empty($owlNavMaxWidth) ) ? $owlNavMaxWidth[1].'% !important' : '100% !important';
			$t_selectors[$slider_class.' .owl-nav']['top'] = ( !empty($owlNavTop) ) ? $owlNavTop[1].'% !important' : '35% !important';
			$t_selectors[$slider_class.' .owl-nav button']['width'] = ( !empty($arrowBtnWidth) ) ? $arrowBtnWidth[1].$unit.' !important' : '40'.$unit.' !important';
			$t_selectors[$slider_class.' .owl-nav button']['height'] = ( !empty($arrowBtnHeight) ) ? $arrowBtnHeight[1].$unit.' !important' : '40'.$unit.' !important';
			$t_selectors[$slider_class.' .owl-nav button']['border-width'] = ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[1].$unit.' !important' : 0;
			$t_selectors[$slider_class.' .owl-nav button']['position'] = 'relative !important';

			$t_selectors[$slider_class.' .owl-nav button.owl-prev']['padding'] = (!empty($arrowBtnPadding) ? ($arrowBtnPadding[1][0].$unit.' '.$arrowBtnPadding[1][1].$unit.' '.$arrowBtnPadding[1][2].$unit.' '.$arrowBtnPadding[1][3].$unit).' !important' : '');
			$t_selectors[$slider_class.' .owl-nav button.owl-prev']['left'] = ( !empty($owlNavLeft) ) ? $owlNavLeft[1].'% !important' : 0;
			$t_selectors[$slider_class.' .owl-nav button.owl-next']['padding'] = (!empty($arrowBtnPadding) ? ($arrowBtnPadding[1][0].$unit.' '.$arrowBtnPadding[1][1].$unit.' '.$arrowBtnPadding[1][2].$unit.' '.$arrowBtnPadding[1][3].$unit).' !important' : '');
			$t_selectors[$slider_class.' .owl-nav button.owl-next']['right'] = ( !empty($owlNavRight) ) ? $owlNavRight[1].'% !important' : 0;

			$t_selectors[$slider_class.' .owl-nav button i']['font-size'] = (!empty($navArrowSize) ? $navArrowSize[1].$unit : '20'.$unit ).' !important';
			$t_selectors[$slider_class.' .owl-dots .owl-dot span']['border-width'] = ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[1].$unit.' !important' : 0;

			$d_selectors[$slider_class.' .owl-nav']['max-width'] = ( !empty($owlNavMaxWidth) ) ? $owlNavMaxWidth[0].'% !important' : '100% !important' ;
			$d_selectors[$slider_class.' .owl-nav']['top'] = ( !empty($owlNavTop) ) ? $owlNavTop[0].'% !important' : '35% !important' ;

			$d_selectors[$slider_class.' .owl-nav button']['width'] = ( !empty($arrowBtnWidth) ) ? $arrowBtnWidth[0].$unit.' !important' : '40'.$unit.' !important' ;
			$d_selectors[$slider_class.' .owl-nav button']['height'] = ( !empty($arrowBtnHeight) ) ? $arrowBtnHeight[0].$unit.' !important' : '40'.$unit.' !important' ;
			$d_selectors[$slider_class.' .owl-nav button']['border-width'] = ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[0].$unit.' !important' : 0 ;
			$d_selectors[$slider_class.' .owl-nav button']['position'] = 'relative !important' ;

			$d_selectors[$slider_class.' .owl-nav button.owl-prev']['padding'] = (!empty($arrowBtnPadding) ? ($arrowBtnPadding[0][0].$unit.' '.$arrowBtnPadding[0][1].$unit.' '.$arrowBtnPadding[0][2].$unit.' '.$arrowBtnPadding[0][3].$unit).' !important' : '') ;
			$d_selectors[$slider_class.' .owl-nav button.owl-prev']['left'] = ( !empty($owlNavLeft) ) ? $owlNavLeft[0].'% !important' : 0 ;

			$d_selectors[$slider_class.' .owl-nav button.owl-next']['padding'] = (!empty($arrowBtnPadding) ? ($arrowBtnPadding[0][0].$unit.' '.$arrowBtnPadding[0][1].$unit.' '.$arrowBtnPadding[0][2].$unit.' '.$arrowBtnPadding[0][3].$unit).' !important' : '') ;
			$d_selectors[$slider_class.' .owl-nav button.owl-next']['right'] = ( !empty($owlNavRight) ) ? $owlNavRight[0].'% !important' : 0 ;

			$d_selectors[$slider_class.' .owl-nav button i']['font-size'] = (!empty($navArrowSize) ? $navArrowSize[0].$unit : '20'.$unit ).' !important' ;
			$d_selectors[$slider_class.' .owl-dots .owl-dot span']['border-width'] = ( !empty($navArrowBdWidth) ) ? $navArrowBdWidth[0].$unit.' !important' : 0 ;

			/*$selectors = array(
				$slider_class.'.ive-carousel-wrap' => array(
					'max-width'				=> isset($attr['maxWidth']) ? $attr['maxWidth'].$unit : 'none',
				)
			);*/

		  $combined_selectors = array(
		    'desktop' 			=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  			=> $t_selectors,
		    'mobile'  			=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.ive-tabs-id' . $attr['uniqueID'] );

		}

		public static function get_accordion_css( $attr, $id ) {
		  $defaults = IVE_Helper::$block_list['ive/accordion']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$d_selectors[' .ive-accordions-xl-start']['justify-content']	= 'left !important';
			$d_selectors[' .ive-accordions-xl-center']['justify-content']= 'center !important';
		  $d_selectors[' .ive-accordions-xl-end']['justify-content']	= 'right !important';

			$maxWidth		= isset($attr['maxWidth']) ? $attr['maxWidth'] : 'none';
			$color		= isset($attr['titleStyles'][0]['color']) ? $attr['titleStyles'][0]['color'] : '';
			$border		= isset($attr['titleStyles'][0]['border']) ? $attr['titleStyles'][0]['border'] : '';
			$background		= isset($attr['titleStyles'][0]['background']) ? $attr['titleStyles'][0]['background'] : '';
			$gradType		= isset($attr['gradType']) ? $attr['gradType'] : '';
			$gradRadPos		= isset($attr['gradRadPos']) ? $attr['gradRadPos'] : '';
			$gradFirstColor		= isset($attr['gradFirstColor']) ? $attr['gradFirstColor'] : '';
			$gradFirstLoc		= isset($attr['gradFirstLoc']) ? $attr['gradFirstLoc'] .'%' : '';
			$gradSecondColor		= isset($attr['gradSecondColor']) ? $attr['gradSecondColor'] : '';
			$gradSecondLoc		= isset($attr['gradSecondLoc']) ? $attr['gradSecondLoc']. '%' : '';
			$gradAngle		= isset($attr['gradAngle']) ? $attr['gradAngle'].'deg' : '';
			$padding		= isset($attr['titleStyles'][0]['padding']) ? $attr['titleStyles'][0]['padding'].'px !important' : '';
			$marginTop		= isset($attr['titleStyles'][0]['marginTop']) ? $attr['titleStyles'][0]['marginTop'].'px' : '';
			$borderWidth		= isset($attr['titleStyles'][0]['borderWidth']) ? $attr['titleStyles'][0]['borderWidth'] .'px' : '';
			$borderRadius		= isset($attr['titleStyles'][0]['borderRadius']) ? $attr['titleStyles'][0]['borderRadius'].'px' : '';
			$sizeType		= isset($attr['titleStyles'][0]['sizeType']) ? $attr['titleStyles'][0]['sizeType'] : '';
			$sizedesk		= isset($attr['titleStyles'][0]['size'][0]) ? $attr['titleStyles'][0]['size'][0] : '';
			$sizetab		= isset($attr['titleStyles'][0]['size'][1]) ? $attr['titleStyles'][0]['size'][1] : '';
		  	$sizemob		= isset($attr['titleStyles'][0]['size'][2]) ? $attr['titleStyles'][0]['size'][2] : '';
			$lineType		= isset($attr['titleStyles'][0]['lineType']) ? $attr['titleStyles'][0]['lineType'] : '';
			$lineHeightdesk		= isset($attr['titleStyles'][0]['lineHeight'][0]) ? $attr['titleStyles'][0]['lineHeight'][0] : '';
			$lineHeighttab		= isset($attr['titleStyles'][0]['lineHeight'][1]) ? $attr['titleStyles'][0]['lineHeight'][1] : '';
		  	$lineHeightmob		= isset($attr['titleStyles'][0]['lineHeight'][2]) ? $attr['titleStyles'][0]['lineHeight'][2] : '';
			$letterSpacing		= isset($attr['titleStyles'][0]['letterSpacing']) ? $attr['titleStyles'][0]['letterSpacing'] .'px' : '';
			$textTransform		= isset($attr['titleStyles'][0]['textTransform']) ? $attr['titleStyles'][0]['textTransform'] : '';
			$family		= isset($attr['titleStyles'][0]['family']) ? $attr['titleStyles'][0]['family']  : '';
			$style		= isset($attr['titleStyles'][0]['style']) ? $attr['titleStyles'][0]['style'] : '';
			$weight		= isset($attr['titleStyles'][0]['weight']) ? $attr['titleStyles'][0]['weight'] : '';

			$contentPadding		= isset($attr['contentPadding']) ? $attr['contentPadding'] .'px' : '';
			$contentBgColor		= isset($attr['contentBgColor']) ? $attr['contentBgColor'] : '';
			$contentBorderColor		= isset($attr['contentBorderColor']) ? $attr['contentBorderColor'] : '';
	 		$contentBorder		= isset($attr['contentBorder']) ? $attr['contentBorder'] .'px' : '';
			$contentBorderRadius		= isset($attr['contentBorderRadius']) ? $attr['contentBorderRadius'] .'px' : '0 px';
			$minHeight		= isset($attr['minHeight']) ? $attr['minHeight'] .'px' : '0';

			$colorHover		= isset($attr['titleStyles'][0]['colorHover']) ? $attr['titleStyles'][0]['colorHover'] .' !important' : '';
			$borderHover		= isset($attr['titleStyles'][0]['borderHover']) ? $attr['titleStyles'][0]['borderHover'] .' !important' : '';
			$backgroundHover		= isset($attr['titleStyles'][0]['backgroundHover']) ? $attr['titleStyles'][0]['backgroundHover'] .' ' : '';

			$hovGradFirstColor		= isset($attr['hovGradFirstColor']) ? $attr['hovGradFirstColor'] : '';
			$hovGradSecondColor		= isset($attr['hovGradSecondColor']) ? $attr['hovGradSecondColor'] : '';



			$colorActive		= isset($attr['titleStyles'][0]['colorActive']) ? $attr['titleStyles'][0]['colorActive'] .' !important' : '';
			$borderActive		= isset($attr['titleStyles'][0]['borderActive']) ? $attr['titleStyles'][0]['borderActive'] .' !important' : '';
			$backgroundActive		= isset($attr['titleStyles'][0]['backgroundActive']) ? $attr['titleStyles'][0]['backgroundActive'] : '';
			$actvGradFirstColor		= isset($attr['actvGradFirstColor']) ? $attr['actvGradFirstColor'] : '';
			$actvGradSecondColor		= isset($attr['actvGradSecondColor']) ? $attr['actvGradSecondColor'] : '';
			$openPane		= isset($attr['openPane']) ? $attr['openPane'] : '';

			$openPane1 = $openPane + 1 ;
			$accordianwrap = '.ive-accordion-wrap';
			$accordianHeaderClass = ' .ive-blocks-accordion-header';
			$accordianHeadertitleClass = ' .ive-blocks-accordion-header .ive-blocks-accordion-title';
			$accordianActiveHeaderClass = ' .ive-accordion-pane .ive-blocks-accordion-header.ive-accordion-panel-active';
			$accordianHeaderHoverClass = ' .ive-blocks-accordion-header:hover';

			$selectors	=	array(
				' .ive-blocks-accordion-header .ive-blocks-accordion-icon-trigger:before'						=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconColor'] . ' !important' : '#555555'
				),
				' .ive-blocks-accordion-header .ive-blocks-accordion-icon-trigger:after'						=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconColor'] . ' !important' : '#555555'
				),

				' .ive-blocks-accordion-header:hover .ive-blocks-accordion-icon-trigger:before'			=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconHoverColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconHoverColor'] . ' !important' : '#444444'
				),
				' .ive-blocks-accordion-header:hover .ive-blocks-accordion-icon-trigger:after'				=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconHoverColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconHoverColor'] . ' !important' : '#444444'
				),

				' .ive-accordion-panel-active .ive-blocks-accordion-icon-trigger:before'	=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconActiveColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconActiveColor'] . ' !important' : '#ffffff'
				),
				' .ive-accordion-panel-active .ive-blocks-accordion-icon-trigger:after'	=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconActiveColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconActiveColor'] . ' !important' : '#ffffff'
				),


				' .ive-blocks-accordion-header .ive-blocks-accordion-icon-trigger'	=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconBgColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconBgColor'] . ' !important' : '#f2f2f2'
				),

				' .ive-blocks-accordion-header:hover .ive-blocks-accordion-icon-trigger'	=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconBgHoverColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconBgHoverColor'] . ' !important' : '#eeeeee'
				),
				' .ive-accordion-panel-active .ive-blocks-accordion-icon-trigger'	=>	array(
					'background-color'	=>	isset( $attr['titleStyles'][0]['titleTriggerIconActiveBgColor'] ) ? $attr['titleStyles'][0]['titleTriggerIconActiveBgColor'] . ' !important' : '#444444'
				)
			);

			if($maxWidth=='') {
				$selectors[$accordianwrap]['max-width']= 'none';
			} else {
				$selectors[$accordianwrap]['max-width']= $maxWidth .'px';
			}
			$selectors[$accordianHeaderClass]['color']					= $color . ' !important';
			$selectors[$accordianHeaderClass]['border-color']		= $border;
			$selectors[$accordianHeaderClass]['padding']				= $padding;
			$selectors[$accordianHeaderClass]['margin-top']			= $marginTop;
			$selectors[$accordianHeaderClass]['border-width']		= $borderWidth;
			$selectors[$accordianHeaderClass]['border-radius']	= $borderRadius;
			$selectors[$accordianHeaderClass]['letter-spacing']	= $letterSpacing;
			$selectors[$accordianHeaderClass]['text-transform']	= $textTransform;
			$selectors[$accordianHeaderClass]['font-family']		= $family;
			$selectors[$accordianHeaderClass]['font-style']			= $style;
			$selectors[$accordianHeaderClass]['font-weight']		= $weight;

			$d_selectors[$accordianHeaderClass]['font-size']= $sizedesk.$sizeType .' !important';
			$d_selectors[$accordianHeaderClass]['line-height']= $lineHeightdesk.$lineType;

			$t_selectors[$accordianHeaderClass]['font-size']= $sizetab.$sizeType .' !important';
			$t_selectors[$accordianHeaderClass]['line-height']= $lineHeighttab.$lineType;

			$m_selectors[$accordianHeaderClass]['font-size']= $sizemob.$sizeType .' !important';
			$m_selectors[$accordianHeaderClass]['line-height']= $lineHeightmob.$lineType;



			$accordians10Class = '.ive-start-active-pane-'.$openPane1.' .ive-accordion-pane-'.$openPane1.' .ive-blocks-accordion-header.ive-accordion-panel-active';
			$selectors[$accordians10Class]['color']= $colorActive;
			$selectors[$accordians10Class]['border-color']= $borderActive;


			if( !$attr['iconGrad'] ) {
				$selectors[$accordianHeaderClass]['background-color'] 			= $background . ' !important';
				$selectors[$accordianHeaderHoverClass]['background-color']	= $backgroundHover . ' !important';
				$selectors[$accordianActiveHeaderClass]['background-color']	= $backgroundActive;
				// $selectors[$accordians10Class]['background-color']					= $backgroundActive;
			}
			if( $attr['iconGrad'] ){
				if($gradType === 'radial'){
					$gradient = ' radial-gradient(at '.$gradRadPos.', '. $gradFirstColor.' '. $gradFirstLoc .' , '. $gradSecondColor .' '. $gradSecondLoc .' ) !important' ;
					$gradientHover = ' radial-gradient(at '.$gradRadPos.', '. $hovGradFirstColor.' '. $gradFirstLoc .' , '. $hovGradSecondColor .' '. $gradSecondLoc .' ) !important' ;
					$gradientActive = ' radial-gradient(at '.$gradRadPos.', '. $actvGradFirstColor.' '. $gradFirstLoc .' , '. $actvGradSecondColor .' '. $gradSecondLoc .' ) !important' ;
				}else{
					$gradient = ' linear-gradient('.$gradAngle.', '. $gradFirstColor.' '. $gradFirstLoc .', '. $gradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
					$gradientHover = ' linear-gradient('.$gradAngle.', '. $hovGradFirstColor.' '. $gradFirstLoc .', '. $hovGradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
					$gradientActive = ' linear-gradient('.$gradAngle.', '. $actvGradFirstColor.' '. $gradFirstLoc .', '. $actvGradSecondColor . ' '. $gradSecondLoc .' ) !important' ;
				}
				$selectors[$accordianHeaderClass]['background-image']= $gradient;
				$selectors[$accordianHeaderClass.':hover']['background-image']= $gradientHover;
				$selectors[$accordianHeaderHoverClass]['background-image']= $gradientHover;
				$selectors[$accordians10Class]['background-image']= $gradientActive;
				$selectors[$accordianActiveHeaderClass]['background-image']= $gradientActive;
			}

			$d_selectors[$accordianHeadertitleClass]['line-height']= $lineHeightdesk.$lineType;
			$t_selectors[$accordianHeadertitleClass]['line-height']= $lineHeighttab.$lineType;
			$m_selectors[$accordianHeadertitleClass]['line-height']= $lineHeightmob.$lineType;

		  $accordianContentClass = ' .ive-accordion-panel-inner';
			$selectors[$accordianContentClass]['padding']= $contentPadding;
			$selectors[$accordianContentClass]['background-color']= $contentBgColor;
			$selectors[$accordianContentClass]['border-color']= $contentBorderColor;
			$selectors[$accordianContentClass]['border-width']= $contentBorder;
			$selectors[$accordianContentClass]['border-radius']= $contentBorderRadius;
			$selectors[$accordianContentClass]['min-height']= $minHeight;

			$selectors[$accordianHeaderClass.':hover']['color']= $colorHover;
			$selectors[$accordianHeaderClass.':hover']['border-color']= $borderHover;

			$selectors[$accordianActiveHeaderClass]['color']= $colorActive;
			$selectors[$accordianActiveHeaderClass]['border-color']= $borderActive;



		  $combined_selectors = array(
		    'desktop' 			=>	$selectors,
		    'desktop_media'	=>	$d_selectors,
		    'tablet'  			=>	$t_selectors,
		    'mobile'  			=>	$m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.ive-accordion-' . $attr['uniqueID'] );

		}

		public static function get_accordion_pane_css($attr, $id){
		  $defaults = IVE_Helper::$block_list['ive/pane']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$iconfontSizedesk = isset($attr['iconfontSize'][0]) ? $attr['iconfontSize'][0] : '12' ;
			$iconfontSizetab = isset($attr['iconfontSize'][1]) ? $attr['iconfontSize'][1] : '12' ;
			$iconfontSizemob = isset($attr['iconfontSize'][2]) ? $attr['iconfontSize'][2] : '12' ;

			$iveiconSVGClass = '.ive-btn-svg-icon svg';

			$d_selectors[$iveiconSVGClass]['width']= $iconfontSizedesk.'px' ;
			$d_selectors[$iveiconSVGClass]['height']= $iconfontSizedesk.'px' ;
			$t_selectors[$iveiconSVGClass]['width']= $iconfontSizetab.'px' ;
			$t_selectors[$iveiconSVGClass]['height']= $iconfontSizetab.'px' ;
			$m_selectors[$iveiconSVGClass]['width']= $iconfontSizemob.'px' ;
			$m_selectors[$iveiconSVGClass]['height']= $iconfontSizemob.'px' ;

		  $combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.pane-svg-' . $attr['uniqueID'] );

		}
		// form css //
		public static function get_form_css($attr,$id){

			$defaults = IVE_Helper::$block_list['ive/ive-form']['attributes'];
		  	$attr = array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$unit = 'px';

			$typography								=	isset($attr['typography']) ? ($attr['typography']) : '';

			$selectors = array(
				'' => array(
					'letter-spacing' 		=> 	isset($attr['letterSpacing']) ? ($attr['letterSpacing']).$unit : '0' . $unit,
					'font-family' 			=> $typography,
					'font-weight' 			=> isset($attr['fontWeight']) ? ($attr['fontWeight']) : 'normal',
					'font-style' 			=> isset($attr['fontStyle']) ? ($attr['fontStyle']) : 'normal',
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',

				),
			);

			$d_selectors = array(
				'' => array(
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',
					'font-size'	=> isset($attr['deskfontSize']) ? $attr['deskfontSize'].$unit : '24'.$unit,

				),
			);

			$t_selectors = array(
				'' => array(
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',
					'font-size'	=> isset($attr['tabfontSize']) ? $attr['tabfontSize'].$unit : '20'.$unit,
				),
			);

			$m_selectors = array(
				'' => array(
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',
					'font-size'	=> isset($attr['mobfontSize']) ? $attr['mobfontSize'].$unit : '16'.$unit,
				),
			);
			$combined_selectors = array(
					'desktop'				=>	$selectors,
					'desktop_media'	=>	$d_selectors,
					'tablet'				=>	$t_selectors,
					'mobile'				=>	$m_selectors,
				);

				return IVE_Helper::generate_all_css( $combined_selectors, '.ive-form' . $attr['uniqueID'] );
			}
			// form css //
			public static function get_form_checkbox_css($attr, $id) {
				$defaults = IVE_Helper::$block_list['ive/form-field-checkbox']['attributes'];
		  	$attr = array_merge( $defaults, $attr );


			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );

		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_checkbox' . $attr['uniqueID'] );
		}

		public static function get_form_date_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-date']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );

		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_date' . $attr['uniqueID'] );
		}

		public static function get_form_email_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-email']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_Email' . $attr['uniqueID'] );
		}

		public static function get_form_name_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-name']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_name' . $attr['uniqueID'] );
		}

		public static function get_form_number_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-number']['attributes'];
		  	$attr = array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_number' . $attr['uniqueID'] );
		}

		public static function get_form_phone_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-phone']['attributes'];
		  $attr = array_merge( $defaults, $attr );

			  $t_selectors = array();
			  $m_selectors = array();
			  $d_selectors = array();
			  $selectors   = array();

				$unit = 'px';

				$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																				.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																				.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																				.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

				$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																			 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																			 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																			 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

				$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																			 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																			 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																			 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

				$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
				$frameNormalboxshadx = $attr['frameNormalboxshadx'];
				$frameNormalboxshady = $attr['frameNormalboxshady'];
				$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
				$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
				$spacingMargin = $attr['spacingMargin'];
				$spacingPadding = $attr['spacingPadding'];

				//hover
				$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																							.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																							.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																							.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

				$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																						 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																						 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																						 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

				$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																						 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																						 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																						 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

				$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
				$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
				$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
				$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
				$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

				$d_selectors = array(
					'' => array(
						'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
						'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
						'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
						'border-radius' => $deskBorderRadius,
						'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
						'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
						'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
						'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
					),
					':hover' => array(
						'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
						'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
						'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
						'border-radius' => $deskHovBorderRadius,
						'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
					)
				);

				$t_selectors = array(
					'' => array(
						'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
						'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
						'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
						'border-radius' => $tabBorderRadius,
						'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
						'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
						'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
						'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
					),
					':hover' => array(
						'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
						'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
						'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
						'border-radius' => $tabHovBorderRadius,
						'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
					)
				);

				$m_selectors = array(
					'' => array(
						'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
						'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
						'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
						'border-radius' => $mobBorderRadius,
						'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
						'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
						'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
						'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
					),
					':hover' => array(
						'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
						'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
						'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
						'border-radius' => $mobHovBorderRadius,
						'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
					)
				);
				$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

				$combined_selectors = array(
			    'desktop' 		=> $selectors,
			    'desktop_media'	=> $d_selectors,
			    'tablet'  		=> $t_selectors,
			    'mobile'  		=> $m_selectors,
			  );
			  return IVE_Helper::generate_all_css( $combined_selectors, '.form_phone' . $attr['uniqueID'] );
		}

		public static function get_form_radio_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-radio']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_radio' . $attr['uniqueID'] );
		}

		public static function get_form_select_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-select']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_select' . $attr['uniqueID'] );
		}

		public static function get_form_text_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-text']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_text' . $attr['uniqueID'] );
		}

		public static function get_form_textarea_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-textarea']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_textarea' . $attr['uniqueID'] );
		}

		public static function get_form_url_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/form-field-url']['attributes'];
		  $attr = array_merge( $defaults, $attr );

		  $t_selectors = array();
		  $m_selectors = array();
		  $d_selectors = array();
		  $selectors   = array();

			$unit = 'px';

			$deskBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][0][0].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][1].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][2].$unit.' '
																																			.$attr['frameNormalBorderRadius'][0][3].$unit : 0;

			$tabBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][1][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][1][3].$unit : 0;

			$mobBorderRadius = (!empty($attr['frameNormalBorderRadius'])) ? $attr['frameNormalBorderRadius'][2][0].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][1].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][2].$unit.' '
																																		 .$attr['frameNormalBorderRadius'][2][3].$unit : 0;

			$frameNormalboxshadcolor = $attr['frameNormalboxshadcolor'];
			$frameNormalboxshadx = $attr['frameNormalboxshadx'];
			$frameNormalboxshady = $attr['frameNormalboxshady'];
			$frameNormalboxshadblur = $attr['frameNormalboxshadblur'];
			$frameNormalboxshadspread = $attr['frameNormalboxshadspread'];
			$spacingMargin = $attr['spacingMargin'];
			$spacingPadding = $attr['spacingPadding'];

			//hover
			$deskHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][0][0].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][1].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][2].$unit.' '
																																						.$attr['frameNormalHovBorderRadius'][0][3].$unit : 0;

			$tabHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][1][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][1][3].$unit : 0;

			$mobHovBorderRadius = (!empty($attr['frameNormalHovBorderRadius'])) ? $attr['frameNormalHovBorderRadius'][2][0].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][1].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][2].$unit.' '
																																					 .$attr['frameNormalHovBorderRadius'][2][3].$unit : 0;

			$frameNormalHovboxshadcolor = $attr['frameNormalHovboxshadcolor'];
			$frameNormalHovboxshadx = $attr['frameNormalHovboxshadx'];
			$frameNormalHovboxshady = $attr['frameNormalHovboxshady'];
			$frameNormalHovboxshadblur = $attr['frameNormalHovboxshadblur'];
			$frameNormalHovboxshadspread = $attr['frameNormalHovboxshadspread'];

			$d_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][0] : 'transparent'),
					'border-radius' => $deskBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[0].' '.$frameNormalboxshadx[0].$unit.' '.$frameNormalboxshady[0].$unit.' '.$frameNormalboxshadblur[0].$unit.' '.$frameNormalboxshadspread[0].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'				=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][0] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][0].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][0] : 'transparent'),
					'border-radius' => $deskHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[0].' '.$frameNormalHovboxshadx[0].$unit.' '.$frameNormalHovboxshady[0].$unit.' '.$frameNormalHovboxshadblur[0].$unit.' '.$frameNormalHovboxshadspread[0].$unit,
				)
			);

			$t_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][1] : 'transparent'),
					'border-radius' => $tabBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[1].' '.$frameNormalboxshadx[1].$unit.' '.$frameNormalboxshady[1].$unit.' '.$frameNormalboxshadblur[1].$unit.' '.$frameNormalboxshadspread[1].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'				=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][1] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][1].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][1] : 'transparent'),
					'border-radius' => $tabHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[1].' '.$frameNormalHovboxshadx[1].$unit.' '.$frameNormalHovboxshady[1].$unit.' '.$frameNormalHovboxshadblur[1].$unit.' '.$frameNormalHovboxshadspread[1].$unit,
				)
			);

			$m_selectors = array(
				'' => array(
					'border-style' => (!empty($attr['frameNormalBorderStyle']) ? $attr['frameNormalBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalBorderWidth']) ? $attr['frameNormalBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalBorderColor']) ? $attr['frameNormalBorderColor'][2] : 'transparent'),
					'border-radius' => $mobBorderRadius,
					'box-shadow' => $frameNormalboxshadcolor[2].' '.$frameNormalboxshadx[2].$unit.' '.$frameNormalboxshady[2].$unit.' '.$frameNormalboxshadblur[2].$unit.' '.$frameNormalboxshadspread[2].$unit,
					'margin' => (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding' => (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'				=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'block' : 'none',
				),
				':hover' => array(
					'border-style' => (!empty($attr['frameNormalHovBorderStyle']) ? $attr['frameNormalHovBorderStyle'][2] : 'none'),
					'border-width' => (!empty($attr['frameNormalHovBorderWidth']) ? $attr['frameNormalHovBorderWidth'][2].'px' : '0'),
					'border-color' => (!empty($attr['frameNormalHovBorderColor']) ? $attr['frameNormalHovBorderColor'][2] : 'transparent'),
					'border-radius' => $mobHovBorderRadius,
					'box-shadow' => $frameNormalHovboxshadcolor[2].' '.$frameNormalHovboxshadx[2].$unit.' '.$frameNormalHovboxshady[2].$unit.' '.$frameNormalHovboxshadblur[2].$unit.' '.$frameNormalHovboxshadspread[2].$unit,
				)
			);
			$selectors[' .ive-form-hidden-label']['display'] = (isset($attr['hideLabel']) && $attr['hideLabel']) ? 'none' : 'block' ;

			$combined_selectors = array(
		    'desktop' 		=> $selectors,
		    'desktop_media'	=> $d_selectors,
		    'tablet'  		=> $t_selectors,
		    'mobile'  		=> $m_selectors,
		  );
		  return IVE_Helper::generate_all_css( $combined_selectors, '.form_url' . $attr['uniqueID'] );
		}

		public static function get_form_button_css($attr, $id) {
			$defaults = IVE_Helper::$block_list['ive/button-single']['attributes'];
			$attr = array_merge( $defaults, $attr );
			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

	  		$defaults = IVE_Helper::$block_list['ive/button-single']['attributes'];
			$attr = array_merge( $defaults, $attr );

			$unit = 'px';
			$spacingMargin						=	$attr['spacingMargin'];
			$spacingPadding						=	$attr['spacingPadding'];
			$frameNormalboxshadcolor	=	(!empty($attr['focusOutlineColor']) ? $attr['focusOutlineColor'] : 'transparent') ;
			$focusOutlineWeight				=	(!empty($attr['focusOutlineWeight']) ? $attr['focusOutlineWeight'].$unit : '0');
			$typography								=	isset($attr['typography']) ? ($attr['typography']) : '';

			$selectors = array(
				'' => array(
					'border-style'			=>	'solid',
					'border-width'			=>	(!empty($attr['borderWeight']) ? $attr['borderWeight'].'px' : '0'),
					'background-color'	=>	(!empty($attr['color']) ? $attr['color'] : 'transparent'),
					'color'							=>	(!empty($attr['textColor']) ? $attr['textColor'] : '#000'),
					'border-color'			=>	(!empty($attr['borderColor']) ? $attr['borderColor'] : 'transparent'),
					'border-radius'			=>	(!empty($attr['borderRadius']) ? $attr['borderRadius'].$unit : '0'),
					'letter-spacing' 		=> 	isset($attr['letterSpacing']) ? ($attr['letterSpacing']).$unit : '0' . $unit,
					'font-family' 			=> $typography,
					'font-weight' 			=> isset($attr['fontWeight']) ? ($attr['fontWeight']) : 'normal',
					'font-style' 			=> isset($attr['fontStyle']) ? ($attr['fontStyle']) : 'normal',
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',

				),
				':hover' => array(
					'background-color'	=>	(!empty($attr['hoverColor']) ? $attr['hoverColor'] : 'transparent'),
					'color'							=>	(!empty($attr['hoverTextColor']) ? $attr['hoverTextColor'] : '#000'),
					'border-color'			=>	(!empty($attr['hoverBorderColor']) ? $attr['hoverBorderColor'] : 'transparent'),
				),
				':focus' => array(
					'box-shadow' => $frameNormalboxshadcolor.' 0px 0px 1px '.$focusOutlineWeight,
				)
			);

			$d_selectors = array(
				'' => array(
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',
					'margin'	=> (!empty($spacingMargin) ? $spacingMargin[0][0].$unit.' '.$spacingMargin[0][1].$unit.' '.$spacingMargin[0][2].$unit.' '.$spacingMargin[0][3].$unit : 0),
					'padding'	=> (!empty($spacingPadding) ? $spacingPadding[0][0].$unit.' '.$spacingPadding[0][1].$unit.' '.$spacingPadding[0][2].$unit.' '.$spacingPadding[0][3].$unit : 0),
					'display'	=> ($attr['displayFields'][0] && $attr['displayFields'][0]=='true') ? 'inline-flex' : 'none',
					'font-size'	=> isset($attr['deskfontSize']) ? $attr['deskfontSize'].$unit : '24'.$unit,

				),
			);

			$t_selectors = array(
				'' => array(
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',
					'margin'	=> (!empty($spacingMargin) ? $spacingMargin[1][0].$unit.' '.$spacingMargin[1][1].$unit.' '.$spacingMargin[1][2].$unit.' '.$spacingMargin[1][3].$unit : 0),
					'padding'	=> (!empty($spacingPadding) ? $spacingPadding[1][0].$unit.' '.$spacingPadding[1][1].$unit.' '.$spacingPadding[1][2].$unit.' '.$spacingPadding[1][3].$unit : 0),
					'display'	=> ($attr['displayFields'][1] && $attr['displayFields'][1]=='true') ? 'inline-flex' : 'none',
					'font-size'	=> isset($attr['tabfontSize']) ? $attr['tabfontSize'].$unit : '20'.$unit,

				),
			);

			$m_selectors = array(
				'' => array(
					'text-transform'		=> isset($attr['buttoncontentTransform']) ? $attr['buttoncontentTransform'] : '',
					'margin'	=> (!empty($spacingMargin) ? $spacingMargin[2][0].$unit.' '.$spacingMargin[2][1].$unit.' '.$spacingMargin[2][2].$unit.' '.$spacingMargin[2][3].$unit : 0),
					'padding'	=> (!empty($spacingPadding) ? $spacingPadding[2][0].$unit.' '.$spacingPadding[2][1].$unit.' '.$spacingPadding[2][2].$unit.' '.$spacingPadding[2][3].$unit : 0),
					'display'	=> ($attr['displayFields'][2] && $attr['displayFields'][2]=='true') ? 'inline-flex' : 'none',
					'font-size'	=> isset($attr['mobfontSize']) ? $attr['mobfontSize'].$unit : '16'.$unit,

				),
			);

			$combined_selectors = array(
				'desktop'				=>	$selectors,
				'desktop_media'	=>	$d_selectors,
				'tablet'				=>	$t_selectors,
				'mobile'				=>	$m_selectors,
			);
			return IVE_Helper::generate_all_css( $combined_selectors, '.ive-button-' . $attr['uniqueID'] );
		}


		public static function get_productscarousel_css( $attr, $id ) {
			$defaults	=	IVE_Helper::$block_list['ive/ive-productscarousel']['attributes'];
			$attr			=	array_merge( $defaults, $attr );

			$t_selectors = array();
			$m_selectors = array();
			$d_selectors = array();
			$selectors   = array();

			$post_type = ( isset( $attr['post_type'] ) && ( $attr['post_type'] != '' ) ) ? $attr['post_type'] : 'post';

			$uniqueID = isset($attr['uniqueID']) ? $attr['uniqueID'] : '';
			// Post Type Button START
			$cartBackgroundColor		=	!$attr['iconGrad'] ? $attr['cartBackgroundColor'] . ' !important' : 'unset';
			$cartBackgroundHovColor	=	!$attr['iconGrad'] ? $attr['cartBackgroundHovColor'] . ' !important' : 'unset';

			$radialBtnGrad		=	'radial-gradient(at '.$attr['vBgImgPosition'].', '.$attr['bgfirstcolorr'].' '.$attr['bgGradLoc'].'%, '.$attr['bgSecondColr'].' '.$attr['bgGradLocSecond'].'%) !important;';
	    	$linearBtnGrad		=	'linear-gradient('.$attr['bgGradAngle'].'deg, '.$attr['bgfirstcolorr'].' '.$attr['bgGradLoc'].'%, '.$attr['bgSecondColr'].' '.$attr['bgGradLocSecond'].'%) !important;';
			$gradientColor		=	$attr['bgGradType'] === 'radial' ? $radialBtnGrad : $linearBtnGrad;
			$cartBtnGradColor	=	$attr['iconGrad'] ? $gradientColor : 'unset !important';

			$mobFlex = '0 0 50%';
			$mobWidth = '50%';
			if ($attr['layoutType'][0] == 'column' || $attr['layoutType'][0] == 'column-reverse') {
				$mobFlex = '0 0 100%';
				$mobWidth = '100%';
			}

			$tabFlex = '0 0 50%';
			$tabWidth = '50%';
			if ($attr['layoutType'][1] == 'column' || $attr['layoutType'][1] == 'column-reverse') {
				$tabFlex = '0 0 100%';
				$tabWidth = '100%';
			}

			$deskFlex = '0 0 50%';
			$deskWidth = '50%';
			if ($attr['layoutType'][2] == 'column' || $attr['layoutType'][2] == 'column-reverse') {
				$deskFlex = '0 0 100%';
				$deskWidth = '100%';
			}

			$mobNavDisplay   = 'none';
			$mobDotsDisplay  = 'none';
			if ($attr['navigation'][2] == 'arrows') {
				$mobNavDisplay = '';
			} else if ($attr['navigation'][2] == 'dots') {
				$mobDotsDisplay = '';
			} else if ($attr['navigation'][2] == 'both') {
				$mobNavDisplay = '';
				$mobDotsDisplay = '';
			}

			$tabNavDisplay   = 'none';
			$tabDotsDisplay  = 'none';
			if ($attr['navigation'][1] == 'arrows') {
				$tabNavDisplay = '';
			} else if ($attr['navigation'][1] == 'dots') {
				$tabDotsDisplay = '';
			} else if ($attr['navigation'][1] == 'both') {
				$tabNavDisplay = '';
				$tabDotsDisplay = '';
			}

			$deskNavDisplay   = 'none';
			$deskDotsDisplay  = 'none';
			if ($attr['navigation'][0] == 'arrows') {
				$deskNavDisplay = '';
			} else if ($attr['navigation'][0] == 'dots') {
				$deskDotsDisplay = '';
			} else if ($attr['navigation'][0] == 'both') {
				$deskNavDisplay = '';
				$deskDotsDisplay = '';
			}

			if($attr['align'] == 'center'){
				$imgAlign = '0 auto';
			} elseif ($attr['align'] == 'left') {
				$imgAlign = '0 auto 0 0';
			} else {
				$imgAlign = '0 0 0 auto';
			}

			$titleLetterSpacing   = isset($attr['letterSpacingT']) ? $attr['letterSpacingT'].'px' : '0px';
			$PMLetterSpacing      = isset($attr['letterSpacingPM']) ? $attr['letterSpacingPM'].'px' : '0px';
			$letterSpacingPrice = isset( $attr['letterSpacingPrice'] ) ? $attr['letterSpacingPrice'] : '0';
			$contentLetterSpacing = isset($attr['letterSpacingC']) ? $attr['letterSpacingC'].'px' : '0px';
			if( $attr['pcimageColorImp'] == true ){
				$pcimageColorImp	= $attr['imgbgColor'] . ' !important';
			}else {
				$pcimageColorImp	= $attr['imgbgColor'];
			}

			if( $attr['otherFontImp'] == true ){
				$otherFontImp	= isset( $attr['imgleftmargin'] ) ? $attr['imgleftmargin'] . 'px !important' : 'auto !important';
			}else {
				$otherFontImp	= isset( $attr['imgleftmargin'] ) ? $attr['imgleftmargin'] . 'px' : 'auto';
			}
			
			if( $attr['otherBorderImp'] == true ){
				$imageColorTab	= $attr['imageColorTab'] . ' !important';
				$imageColorTabHov	= $attr['imageColorTabHov'] . ' !important';
			}else {
				$imageColorTab	= $attr['imageColorTab'];
				$imageColorTabHov	= $attr['imageColorTabHov'];
			}

			if( $attr['pctitleFontImp'] == true ){
				$typographyT = $attr['typographyT'] . ' !important';
				$fontWeightT = $attr['fontWeightT'] . ' !important';
				$fontStyleT = $attr['fontStyleT'] . ' !important';
				$titleLetterSpacings = $titleLetterSpacing . ' !important';
			}else {
				$typographyT = $attr['typographyT'];
				$fontWeightT = $attr['fontWeightT'];
				$fontStyleT = $attr['fontStyleT'];
				$titleLetterSpacings = $titleLetterSpacing;
			}
			$selectors = array(
				' .ibtana-product-name-'.$uniqueID.' h6' => array(
					'color' => isset($attr['nameHoverColor']) ? $attr['nameHoverColor'] . ' !important' : 'black'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-title a:hover' => array(
					'color' => isset($attr['nameHoverColor']) ? $attr['nameHoverColor'] . ' !important' : 'black'
				),
				' .ibtana-product-name-'.$uniqueID.' .product-title-link .ibtana-product-title-child:hover' => array(
					'color' => isset($attr['nameHoverColor']) ? $attr['nameHoverColor'] . ' !important' : 'black'
				),
				' .ibtana-product-name-'.$uniqueID.' h6, .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-title a' => array(
					'font-family' => $typographyT,
					'font-weight' => $fontWeightT,
          			'font-style' => $fontStyleT,
          			'letter-spacing' => $titleLetterSpacings,
          			'text-transform' => isset($attr['titleTransform']),
				),
				' .ibtana-product-name-'.$uniqueID.' h6, .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-meta , .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img' => array(
					'font-family'=> $attr['typographyPM'],
					'font-weight'=> $attr['fontWeightPM'],
					'font-style'=> $attr['fontStylePM'],
					'letter-spacing'=> $PMLetterSpacing
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-title,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-title .ibtana-product-title-child' => array(
				'font-family' => $attr['typographyT'],
				'font-weight' => $attr['fontWeightT'],
				'font-style' => $attr['fontStyleT'],
				'letter-spacing' => $titleLetterSpacing
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-excerpt, .ive-product-slider-parent'.$uniqueID.' .ibtana-product-content .ibtana-product-content-child' => array(
					'color' => $attr['contentColor']
				),
				' .ive-product-slider-parent'.$uniqueID.' .ibtana-product-content .ibtana-product-content-child p' => array(
					'color' => $attr['contentColor']
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .blog-category' => array(
					'color' => isset($attr['postCatTextColor']) ? $attr['postCatTextColor'] : ''
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .blog-category:hover' => array(
					'color' => isset($attr['postCatTextColorHov']) ? $attr['postCatTextColorHov'] : ''
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments:hover' => array(
					'color' => isset($attr['postMetaTextColorHov']) ? $attr['postMetaTextColorHov'] . ' !important' : ''
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author a:hover' => array(
					'color' => isset($attr['postMetaTextColorHov']) ? $attr['postMetaTextColorHov'] . ' !important' : ''
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date:hover' => array(
					'color' => isset($attr['postMetaTextColorHov']) ? $attr['postMetaTextColorHov'] . ' !important' : ''
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img .post-meta-content:hover' => array(
					'color' => isset($attr['postMetaTextColorHov']) ? $attr['postMetaTextColorHov'] . ' !important' : '',
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img .post-meta-content' => array(
					'text-transform' => isset($attr['postmetaTextTransform']) ? $attr['postmetaTextTransform'] : 'capitalize',
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-meta' => array(
					'color' => $attr['postMetaTextColor'],
					'text-transform' => isset($attr['postmetaTextTransform']) ? $attr['postmetaTextTransform'] : 'capitalize',
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta .ive_latest_post_date' => array(
					'color' => $attr['postMetaTextColor']
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta .ive_latest_post_author a' => array(
					'color' => $attr['postMetaTextColor'],
					'text-transform' => isset($attr['postmetaTextTransform']) ? $attr['postmetaTextTransform'] : 'capitalize',
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-meta i' => array(
					'color' => $attr['postMetaIconColor'],
					'text-transform' => isset($attr['postmetaTextTransform']) ? $attr['postmetaTextTransform'] : 'capitalize',

				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-meta i:hover' => array(
					'color' => $attr['postMetaIconColorHov'] ? $attr['postMetaIconColorHov'] : '',
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img' => array(
					'color' => $attr['postMetaTextColor']
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img i' => array(
					'color' => $attr['postMetaIconColor']
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-excerpt p' => array(
					'color' => $attr['contentFontSizedesk'] . 'px !important'
				),
				' .ibtana-price-tag-'.$uniqueID => array(
					'color' => $attr['priceColor'],
					'font-family' => $attr['typographyPrice'],
					'font-weight' => $attr['fontWeightPrice'],
					'font-style' => $attr['fontStylePrice'],
					'letter-spacing' => $letterSpacingPrice . 'px',
					'margin-top' => $attr['marginTopPrice'] . 'px',
					'margin-bottom' => $attr['marginBottomPrice'] . 'px',
					'font-size' => $attr['fontPrice'] . 'px'
				),
				' .ibtana-price-tag-'.$uniqueID.' .price-meta-sale-price:hover' => array(
					'color' => $attr['priceHoverColor'],
				)
				,
				' .woo-prd-slider'.$uniqueID.' .woo-prod-img img' => array(
					'margin' => $imgAlign
				),
				' .ibtana-product-cart-button' => array(
					'margin-top' => '14px'
				),
				' .owl-dots .owl-dot.active span' => array(
					'background' => $attr['dotActiveColor'] . ' !important'
				),
				' .owl-dots .owl-dot span' => array(
					'display' => 'flex',
					'background' => $attr['dotColor'] . ' !important',
					'border-radius' => $attr['dotBorderRadius'] . 'px',
					'width' => '10px',
					'height' => '10px',
					'margin' => '5px 7px',
					'-webkit-backface-visibility' => 'visible',
					'transition' => 'opacity 200ms ease'
				),
				' .owl-nav button' => array(
					'background'	=> $attr['navArrowBgColor'] . ' !important',
					'border-radius'	=> $attr['navArrowBdRadius'] . 'px !important',
					'border-color'	=> $attr['navArrowBdColor'] . ' !important',
					'border-style'	=> 'solid !important',
					'color'	=> $attr['navArrowColor'] . ' !important'
				),
				' .owl-nav button:hover' => array(
					'background' => $attr['navArrowBgHovColor'] . ' !important',
					'color' => $attr['navArrowHovColor'] . ' !important',
					'border-color' => $attr['navArrowBdHovColor'] . ' !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-excerpt p, .ive-product-slider-parent'.$uniqueID.' .ibtana-product-content .ibtana-product-content-child' => array(
					'font-family' => $attr['typographyC'],
					'font-weight' => $attr['fontWeightC'],
					'text-transform' => $attr['contentTransform'],
					'font-style' => $attr['fontStyleC'],
					'letter-spacing' => $contentLetterSpacing
				),
				' .ive-product-slider-parent'.$uniqueID.' .price-regular-sale-ibtana-parent' => array(
					'display' => 'flex'
				),
				' .ibtana-price-tag-'.$uniqueID.' .price-meta-regular-price' => array(
					'margin-right' => $attr['marginPrice'] . 'px'
				),
				' .ive-product-slider-parent'.$uniqueID.' .comment-value' => array(
					'line-height' => '24px',
					'color' => '#000',
					'top' => '-2px'
				),
				' .ive-product-slider-parent'.$uniqueID.' .star-rating' => array(
					'overflow' => 'hidden',
					'position' => 'relative',
					'height' => '1em',
					'line-height' => '1',
					'font-size' => '1em',
					'width' => '5.4em',
					'font-family' => 'star'
				),
				' .ive-product-slider-parent'.$uniqueID.' .star-rating span' => array(
					'overflow' => 'hidden',
					'float' => 'left',
					'top' => '0',
					'left' => '0',
					'position' => 'absolute',
					'padding-top' => '1.5em',
					'color' => $attr['ratingColor'],
					'border-color' => $attr['ratingColor']
				),
				' .ive-product-slider-parent'.$uniqueID.' .star-rating::before' => array(
					'content' => "\73\73\73\73\73",
					'float' => 'left',
					'top' => '0',
					'left' => '0',
					'position' => 'absolute',
					'color' => $attr['ratingColor']
				),
				' .ive-product-slider-parent'.$uniqueID.' .star-rating span::before' => array(
					'content' => "\53\53\53\53\53",
					'top' => '0',
					'position' => 'absolute',
					'left' => '0'
				),
				' .post-meta-content' => array(
					'padding-left' => '4px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author' => array(
					'order' => $attr['authorOrderPosition']
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date' => array(
				'order' => $attr['dateOrderPosition']
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments' => array(
				'order' => $attr['commentOrderPosition']
				),
				' .full-width-banner-slider-inner-item' => array(
					'position' => 'relative'
				),
				' .ive-product-slider-parent'.$uniqueID.' .woo-prod-img' => array(
				  'background' => $attr['imgbgColor'],
					'color'					 => $imageColorTab,
					'border-style' 	 =>	isset( $attr['imgBorderType'] ) ? $attr['imgBorderType'] : '',
					'border-width'	 =>	isset( $attr['imgBorderWidth'] ) ? $attr['imgBorderWidth'] . 'px' : '',
				),
				' .ive-product-slider-parent'.$uniqueID.' .woo-prod-img:hover' => array(
					'color'					 => $imageColorTabHov,
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .post-image' => array(
				  	'background' 		 => $pcimageColorImp, 
					'color'					 => $imageColorTab,
					'border-style' 	 =>	isset( $attr['imgBorderType'] ) ? $attr['imgBorderType'] : '',
					'border-width'	 =>	isset( $attr['imgBorderWidth'] ) ? $attr['imgBorderWidth'] . 'px !important' : '',
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .post-image:hover' => array(
					'color' => $imageColorTabHov,
					'background' => isset( $attr['imgbgColorHov'] ) ? $attr['imgbgColorHov'] : '',
				),
				' .price-meta-regular-price strike' => array(
				  'color' 	 	 => $attr['regularPricetabColor'],
					'font-size'  => $attr['regularfontPrice'] . 'px !important',
				),
				' .price-meta-regular-price strike:hover' => array(
				  'color' => $attr['regularPricetabColorHov']
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive-inner-post-content' => array(
						'color' 				=> $attr['contentColorTab'],
						'border-style'	=>	isset( $attr['contentborderType'] ) ? $attr['contentborderType'] : '',
						'border-width' 	=>	isset( $attr['contentBorderWidth'] ) ? $attr['contentBorderWidth'] . 'px !important' : '',
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive-inner-post-content:hover' => array(
						'color' => isset( $attr['contentColorTabHov'] ) ? $attr['contentColorTabHov'] : ''
				),
				' .ive-product-slider-parent'.$uniqueID.' .full_content' => array(
						'color' 				=> $attr['contentColorTab'],
						'border-style'	=>	isset( $attr['contentborderType'] ) ? $attr['contentborderType'] : '',
						'border-width' 	=>	isset( $attr['contentBorderWidth'] ) ? $attr['contentBorderWidth'] . 'px !important' : '',
				),
				' .ive-product-slider-parent'.$uniqueID.' .full_content:hover' => array(
						'color' => isset( $attr['contentColorTabHov'] ) ? $attr['contentColorTabHov'] : ''
				)
			);

			$mobCartButton = $attr['cartButton'][0] == 'true' ?  'flex' : 'none';
			$mobdispPostTitle = $attr['displayPostTitle'][0] == 'true' ?  'block' : 'none';
			$mobdispPostContent = $attr['displayPostExcerpt'][0] == 'true' ?  'block' : 'none';
			$mobdispPostBtn = $attr['displayPostReadMoreButton'][0] == 'true' ?  'inline-block' : 'none';
			$mobdispPostImg = $attr['displayPostImage'][0] == 'true' ?  'block' : 'none';
			$mobdispPostCat = $attr['displayPostCategory'][0] == 'true' ?  'block' : 'none';
			$mobdispPostAuth = $attr['displayPostAuthor'][0] == 'true' ?  'block' : 'none';
			$mobdispPostAuthIcon = $attr['displayPostAuthorIcon'][0] == 'true' ?  'inline-block' : 'none';
			$mobdispPostDate = $attr['displayPostDate'][0] == 'true' ?  'block' : 'none';
			$mobdispPostDateIcon = $attr['displayPostDateIcon'][0] == 'true' ?  'inline-block' : 'none';
			$mobdispPostImgDate = $attr['imageDateOption'][0] == 'true' ?  'block' : 'none';
			$mobdispPostComment = $attr['displayComment'][0] == 'true' ?  'block' : 'none';
			$mobdispPostCommentIcon = $attr['displayCommentIcon'][0] == 'true' ?  'inline-block' : 'none';
			$mobdispdisplayCommentText = $attr['displayCommentText'][0] == 'true' ?  'inline' : 'none';
			$mobdispProductContent = $attr['displayProductExcerpt'][0] == 'true' ?  'block' : 'none';
			$mobProdSaleBadge = $attr['displayProductSaleBadge'][0] == 'true' ?  'block' : 'none';

			$m_selectors = array(
				' .ibtana_cart_button_'.$uniqueID => array(
					'font-size' => $attr['cartFontSizemob'] . 'px !important',
					'padding' => $attr['mobcartButtonPadding'] . 'px ' . $attr['mobcartButtonPadding2'] . 'px !important'
				),
				' .content_full_'.$uniqueID.' .ibtana-product-cart-button' => array(
					'display' => $mobCartButton
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-excerpt p,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-content .ibtana-product-content-child' => array(
					'font-size' => $attr['contentFontSizemob'] . 'px !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-title,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-title .ibtana-product-title-child' => array(
					'font-size' =>	$attr['titleFontSizemob'] . 'px !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-title' => array(
					'display' =>	$mobdispPostTitle
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-excerpt' => array(
					'display' => $mobdispPostContent
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-read-more-parent' => array(
					'display' => $mobdispPostBtn
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .post-image' => array(
					'display' => $mobdispPostImg
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .blog-category' => array(
					'display' => $mobdispPostCat
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author' => array(
					'display' => $mobdispPostAuth
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author i' => array(
					'display' => $mobdispPostAuthIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date' => array(
					'display' => $mobdispPostDate
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date i' => array(
					'display' => $mobdispPostDateIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img' => array(
					'display' => $mobdispPostImgDate
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta.row i' => array(
					'font-size' => $attr['iconPostMetaSize'][0] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta-content' => array(
					'font-size' => $attr['contentPostMetaSize'][0] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img i' => array(
					'display' => $mobdispPostDateIcon,
					'font-size' => $attr['iconPostMetaSize'][0] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments' => array(
					'display' => $mobdispPostComment
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments i' => array(
					'display' => $mobdispPostCommentIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments .comment-text' => array(
					'display' => $mobdispdisplayCommentText
				),
				' .ibtana-product-justify-content-'.$uniqueID => array(
					'justify-content' => $attr['productmobalign'] . ' !important'
				),
				' .ive-product-slider-parent'.$uniqueID.' .ibtana-product-content' => array(
					'display' => $mobdispProductContent
				),
				' .ive-product-slider-parent'.$uniqueID.' .onsale' => array(
					'display' => $mobProdSaleBadge
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item, .ive-post-slider-parent'.$uniqueID.' .post-content-area' => array(
					'flex-direction' => $attr['layoutType'][0]
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item .woo-prod-img, .ive-post-slider-parent'.$uniqueID.' .post-image' => array(
					'width' => $mobWidth,
					'flex' => $mobFlex
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item .woo-prod-content, .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content' => array(
					'width' => $mobWidth,
					'flex' => $mobFlex
				),
				' .owl-nav' => array(
					'max-width' => $attr['owlNavMaxWidth'][2].'%',
					'top' => $attr['owlNavTop'][2].'%',
					'left' => $attr['owlNavLeft'][2].'%',
					'right' => $attr['owlNavRight'][2].'%',
					'display' => $mobNavDisplay
				),
				' .owl-dots' => array(
					'display' => $mobDotsDisplay
				),
				' .owl-nav button' => array(
					'width' => $attr['arrowBtnWidth'][2].'px !important',
					'height' => $attr['arrowBtnHeight'][2].'px !important',
					'border-width' => $attr['navArrowBdWidth'][2].'px !important'
				),
				' .owl-nav button.owl-prev' => array(
					'padding' => $attr['arrowBtnPadding'][2][0].'px '.$attr['arrowBtnPadding'][2][1].'px '.$attr['arrowBtnPadding'][2][2].'px '.$attr['arrowBtnPadding'][2][3].'px !important'
				),
				' .owl-nav button.owl-next' => array(
					'padding' => $attr['arrowBtnPadding'][2][0].'px '.$attr['arrowBtnPadding'][2][1].'px '.$attr['arrowBtnPadding'][2][2].'px '.$attr['arrowBtnPadding'][2][3].'px !important'
				),
				' .owl-nav button i' => array(
					'font-size' => $attr['navArrowSize'][2].'px'
				),
				' .ive-product-slider-parent'.$uniqueID.' .woo-prod-img img, .ive-post-slider-parent'.$uniqueID.' .post-image img' => array(
					'width' => $attr['imgWidth'][2].'px',
					'height' => $attr['imgHeight'][2].'px'
				)
			);

			$tabCartButton = $attr['cartButton'][1] == 'true' ?  'flex' : 'none';
			$tabdispPostTitle = $attr['displayPostTitle'][1] == 'true' ?  'block' : 'none';
			$tabdispPostContent = $attr['displayPostExcerpt'][1] == 'true' ?  'block' : 'none';
			$tabdispPostBtn = $attr['displayPostReadMoreButton'][1] == 'true' ?  'inline-block' : 'none';
			$tabdispPostImg = $attr['displayPostImage'][1] == 'true' ?  'block' : 'none';
			$tabdispPostCat = $attr['displayPostCategory'][1] == 'true' ?  'block' : 'none';
			$tabdispPostAuth = $attr['displayPostAuthor'][1] == 'true' ?  'block' : 'none';
			$tabdispPostAuthIcon = $attr['displayPostAuthorIcon'][1] == 'true' ?  'inline-block' : 'none';
			$tabdispPostDate = $attr['displayPostDate'][1] == 'true' ?  'block' : 'none';
			$tabdispPostDateIcon = $attr['displayPostDateIcon'][1] == 'true' ?  'inline-block' : 'none';
			$tabdispPostImgDate = $attr['imageDateOption'][1] == 'true' ?  'block' : 'none';
			$tabdispPostComment = $attr['displayComment'][1] == 'true' ?  'block' : 'none';
			$tabdispPostCommentIcon = $attr['displayCommentIcon'][1] == 'true' ?  'inline-block' : 'none';
			$tabdispdisplayCommentText = $attr['displayCommentText'][1] == 'true' ?  'inline' : 'none';
			$tabdispProductContent = $attr['displayProductExcerpt'][1] == 'true' ?  'block' : 'none';
			$tabProdSaleBadge = $attr['displayProductSaleBadge'][1] == 'true' ?  'block' : 'none';

			$t_selectors = array(
				' .ibtana_cart_button_'.$uniqueID => array(
					'font-size' => $attr['cartFontSizetab'] . 'px !important',
					'padding' => $attr['tabcartButtonPadding'] . 'px ' . $attr['tabcartButtonPadding2'] . 'px !important'
				),
				' .content_full_'.$uniqueID.' .ibtana-product-cart-button' => array(
					'display' => $tabCartButton
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-excerpt p,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-content .ibtana-product-content-child' => array(
					'font-size' => $attr['contentFontSizetab'] . 'px !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-title,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-title .ibtana-product-title-child' => array(
					'font-size' =>	$attr['titleFontSizetab'] . 'px !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-title' => array(
					'display' =>	$tabdispPostTitle
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-excerpt' => array(
					'display' => $tabdispPostContent
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-read-more-parent' => array(
					'display' => $tabdispPostBtn
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .post-image' => array(
					'display' => $tabdispPostImg
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .blog-category' => array(
					'display' => $tabdispPostCat
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author' => array(
					'display' => $tabdispPostAuth
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author i' => array(
					'display' => $tabdispPostAuthIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date' => array(
					'display' => $tabdispPostDate
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date i' => array(
					'display' => $tabdispPostDateIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img' => array(
					'display' => $tabdispPostImgDate
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta.row i' => array(
					'font-size' => $attr['iconPostMetaSize'][1] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta-content' => array(
					'font-size' => $attr['contentPostMetaSize'][1] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img i' => array(
					'display' => $tabdispPostDateIcon,
					'font-size' => $attr['iconPostMetaSize'][1] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments' => array(
					'display' => $tabdispPostComment
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments i' => array(
					'display' => $tabdispPostCommentIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments .comment-text' => array(
					'display' => $tabdispdisplayCommentText
				),
				' .ibtana-product-justify-content-'.$uniqueID => array(
					'justify-content' => $attr['producttabalign'] . ' !important'
				),
				' .ive-product-slider-parent'.$uniqueID.' .ibtana-product-content' => array(
					'display' => $tabdispProductContent
				),
				' .ive-product-slider-parent'.$uniqueID.' .onsale' => array(
					'display' => $tabProdSaleBadge
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item, .ive-post-slider-parent'.$uniqueID.' .post-content-area' => array(
					'flex-direction' => $attr['layoutType'][1]
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item .woo-prod-img, .ive-post-slider-parent'.$uniqueID.' .post-image' => array(
					'width' => $tabWidth,
					'flex' => $tabFlex
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item .woo-prod-content, .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content' => array(
					'width' => $tabWidth,
					'flex' => $tabFlex
				),
				' .owl-nav' => array(
					'max-width' => $attr['owlNavMaxWidth'][1].'%',
					'top' => $attr['owlNavTop'][1].'%',
					'left' => $attr['owlNavLeft'][1].'%',
					'right' => $attr['owlNavRight'][1].'%',
					'display' => $tabNavDisplay
				),
				' .owl-dots' => array(
					'display' => $tabDotsDisplay
				),
				' .owl-nav button' => array(
					'width' => $attr['arrowBtnWidth'][1].'px !important',
					'height' => $attr['arrowBtnHeight'][1].'px !important',
					'border-width' => $attr['navArrowBdWidth'][1].'px !important'
				),
				' .owl-nav button.owl-prev' => array(
					'padding' => $attr['arrowBtnPadding'][1][0].'px '.$attr['arrowBtnPadding'][1][1].'px '.$attr['arrowBtnPadding'][1][2].'px '.$attr['arrowBtnPadding'][1][3].'px !important'
				),
				' .owl-nav button.owl-next' => array(
					'padding' => $attr['arrowBtnPadding'][1][0].'px '.$attr['arrowBtnPadding'][1][1].'px '.$attr['arrowBtnPadding'][1][2].'px '.$attr['arrowBtnPadding'][1][3].'px !important'
				),
				' .owl-nav button i' => array(
					'font-size' => $attr['navArrowSize'][1].'px'
				),
				' .ive-product-slider-parent'.$uniqueID.' .woo-prod-img img, .ive-post-slider-parent'.$uniqueID.' .post-image img' => array(
					'width' => $attr['imgWidth'][1].'px',
					'height' => $attr['imgHeight'][1].'px'
				)
			);

			$deskCartButton = $attr['cartButton'][2] == 'true' ?  'flex' : 'none';
			$deskdispPostTitle = $attr['displayPostTitle'][2] == 'true' ?  'block' : 'none';
			$deskdispPostContent = $attr['displayPostExcerpt'][2] == 'true' ?  'block' : 'none';
			$deskdispPostBtn = $attr['displayPostReadMoreButton'][2] == 'true' ?  'inline-block' : 'none';
			$deskdispPostImg = $attr['displayPostImage'][2] == 'true' ?  'block' : 'none';
			$deskdispPostCat = $attr['displayPostCategory'][2] == 'true' ?  'block' : 'none';
			$deskdispPostAuth = $attr['displayPostAuthor'][2] == 'true' ?  'block' : 'none';
			$deskdispPostAuthIcon = $attr['displayPostAuthorIcon'][2] == 'true' ?  'inline-block' : 'none';
			$deskdispPostDate = $attr['displayPostDate'][2] == 'true' ?  'block' : 'none';
			$deskdispPostDateIcon = $attr['displayPostDateIcon'][2] == 'true' ?  'inline-block' : 'none';
			$deskdispPostImgDate = $attr['imageDateOption'][2] == 'true' ?  'block' : 'none';
			$deskdispPostComment = $attr['displayComment'][2] == 'true' ?  'block' : 'none';
			$deskdispPostCommentIcon = $attr['displayCommentIcon'][2] == 'true' ?  'inline-block' : 'none';
			$deskdispdisplayCommentText = $attr['displayCommentText'][2] == 'true' ?  'inline' : 'none';
			$deskdispProductContent = $attr['displayProductExcerpt'][2] == 'true' ?  'block' : 'none';
			$deskProdSaleBadge = $attr['displayProductSaleBadge'][2] == 'true' ?  'block' : 'none';

			$d_selectors = array(
				' .ibtana_cart_button_'.$uniqueID => array(
					'font-size' => $attr['cartFontSizedesk'] . 'px !important',
					'padding' => $attr['deskcartButtonPadding'] . 'px ' . $attr['deskcartButtonPadding2'] . 'px !important'
				),
				' .content_full_'.$uniqueID.' .ibtana-product-cart-button' => array(
					'display' => $deskCartButton
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-excerpt p,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-content .ibtana-product-content-child' => array(
					'font-size' => $attr['contentFontSizedesk'] . 'px !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-title,.ive-product-slider-parent'.$uniqueID.' .ibtana-product-title .ibtana-product-title-child' => array(
					'font-size' =>	$attr['titleFontSizedesk'] . 'px !important'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-title' => array(
					'display' =>	$deskdispPostTitle
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-excerpt' => array(
					'display' => $deskdispPostContent
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content .post-read-more-parent' => array(
					'display' => $deskdispPostBtn
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .post-image' => array(
					'display' => $deskdispPostImg
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .blog-category' => array(
					'display' => $deskdispPostCat
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author' => array(
					'display' => $deskdispPostAuth
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_author i' => array(
					'display' => $deskdispPostAuthIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date' => array(
					'display' => $deskdispPostDate
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_date i' => array(
					'display' => $deskdispPostDateIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img' => array(
					'display' => $deskdispPostImgDate
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta.row i' => array(
					'font-size' => $attr['iconPostMetaSize'][2] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-meta-content' => array(
					'font-size' => $attr['contentPostMetaSize'][2] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .ive_latest_post_date_img i' => array(
					'display' => $deskdispPostDateIcon,
					'font-size' => $attr['iconPostMetaSize'][2] . 'px'
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments' => array(
					'display' => $deskdispPostComment
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments i' => array(
					'display' => $deskdispPostCommentIcon
				),
				' .ive-post-slider-parent'.$uniqueID.' .post-content-area .ive_latest_post_comments .comment-text' => array(
					'display' => $deskdispdisplayCommentText
				),
				' .ibtana-product-justify-content-'.$uniqueID => array(
					'justify-content' => $attr['productdeskalign'] . ' !important'
				),
				' .ive-product-slider-parent'.$uniqueID.' .ibtana-product-content' => array(
					'display' => $deskdispProductContent
				),
				' .ive-product-slider-parent'.$uniqueID.' .onsale' => array(
					'display' => $deskProdSaleBadge
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item, .ive-post-slider-parent'.$uniqueID.' .post-content-area' => array(
					'flex-direction' => $attr['layoutType'][2]
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item .woo-prod-img, .ive-post-slider-parent'.$uniqueID.' .post-image' => array(
					'width' => $deskWidth,
					'flex' => $deskFlex
				),
				' .ive-product-slider-parent'.$uniqueID.' .full-width-banner-slider-inner-item .woo-prod-content, .ive-post-slider-parent'.$uniqueID.' .ive-inner-post-content' => array(
					'width' => $deskWidth,
					'flex' => $deskFlex
				),
				' .owl-nav' => array(
					'max-width' => $attr['owlNavMaxWidth'][0].'%',
					'top' => $attr['owlNavTop'][0].'%',
					'left' => $attr['owlNavLeft'][0].'%',
					'right' => $attr['owlNavRight'][0].'%',
					'display' => $deskNavDisplay
				),
				' .owl-dots' => array(
					'display' => $deskDotsDisplay
				),
				' .owl-nav button' => array(
					'width' => $attr['arrowBtnWidth'][0].'px !important',
					'height' => $attr['arrowBtnHeight'][0].'px !important',
					'border-width' => $attr['navArrowBdWidth'][0].'px !important'
				),
				' .owl-nav button.owl-prev' => array(
					'padding' => $attr['arrowBtnPadding'][0][0].'px '.$attr['arrowBtnPadding'][0][1].'px '.$attr['arrowBtnPadding'][0][2].'px '.$attr['arrowBtnPadding'][0][3].'px !important'
				),
				' .owl-nav button.owl-next' => array(
					'padding' => $attr['arrowBtnPadding'][0][0].'px '.$attr['arrowBtnPadding'][0][1].'px '.$attr['arrowBtnPadding'][0][2].'px '.$attr['arrowBtnPadding'][0][3].'px !important'
				),
				' .owl-nav button i' => array(
					'font-size' => $attr['navArrowSize'][0].'px'
				),
				' .ive-product-slider-parent'.$uniqueID.' .woo-prod-img img, .ive-post-slider-parent'.$uniqueID.' .post-image img' => array(
					'width' => $attr['imgWidth'][0].'px',
					'height' => $attr['imgHeight'][0].'px'
				)
			);

			$selectors[' .ive-pt-btn']	=	array(
				'background-color'	=>	$cartBackgroundColor,
				'background-image'	=>	$cartBtnGradColor,
				'color'							=>	isset( $attr['cartTextColor'] ) ? $attr['cartTextColor'] . ' !important' : '',
				'border-radius'			=>	isset( $attr['cartBorderRadius'] ) ? $attr['cartBorderRadius'] . 'px !important' : '',
				'border-color'			=>	isset( $attr['cartBorderColor'] ) ? $attr['cartBorderColor'] . ' !important' : '',
				'font-family'				=>	isset( $attr['typography'] ) ? $attr['typography'] : '',
				'font-weight'				=>	isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : 400,
				'font-style'				=>	isset( $attr['fontStyle'] ) ? $attr['fontStyle'] : '',
				'border-style'			=>	isset( $attr['borderType'] ) ? $attr['borderType'] : '',
				'border-width'			=>	isset( $attr['cartBorderWidth'] ) ? $attr['cartBorderWidth'] . 'px !important' : '',
				'letter-spacing'		=>	isset( $attr['letterSpacing'] ) ? $attr['letterSpacing'] . 'px' : '0',
				'text-transform'		=>  isset( $attr['buttoncontentTransform'] ) ? $attr['buttoncontentTransform'] : '',
			);

			$radialBtnGradHov			=	'radial-gradient(at '.$attr['vBgImgPosition'].', '.$attr['hovGradFirstColor'].' '.$attr['bgGradLoc'].'%, '.$attr['hovGradSecondColor'].' '.$attr['bgGradLocSecond'].'%) !important;';
	    	$linearBtnGradHov			=	'linear-gradient('.$attr['bgGradAngle'].'deg, '.$attr['hovGradFirstColor'].' '.$attr['bgGradLoc'].'%, '.$attr['hovGradSecondColor'].' '.$attr['bgGradLocSecond'].'%) !important;';
			$gradientColorHov			=	$attr['bgGradType'] === 'radial' ? $radialBtnGradHov : $linearBtnGradHov;
			$cartBtnGradHovColor	=	$attr['iconGrad'] ? $gradientColorHov : 'unset !important';
			$selectors[' .ive-pt-btn:hover']	=	array(
				'background-color'	=>	( !$attr['iconGrad'] ) ? $attr['cartBackgroundHovColor'] . ' !important' : 'unset',
				'background-image'	=>	$cartBtnGradHovColor,
				'border-color'			=>	isset( $attr['cartBorderHovColor'] ) ? $attr['cartBorderHovColor'] . ' !important' : 'transparent',
				'color'							=>	$attr['cartTextHoverColor'] . ' !important'
			);


			$cartIconColor	=	isset( $attr['cartIconColor'] ) ? $attr['cartIconColor'] : '0';
			$selectors[' .ive-pt-btn i']	=	array(
				'color'	=>	$cartIconColor
			);

			$cartIconHoverColor = isset( $attr['cartIconHoverColor'] ) ? $attr['cartIconHoverColor'] : '0';
			$selectors[' .ive-pt-btn:hover i']	=	array(
				'color'	=>	$cartIconHoverColor . ' !important'
			);
			// Post Type Button END

			if ( $attr['buttonOption'] == 'text' ) {
				$textIcon = 'block';
				$iconLeft = 'none';
				$iconRight = 'none';
			} elseif ( $attr['buttonOption'] == 'icon' ) {
				$textIcon = 'none';
				if ( $attr['iconAlignButton'] == 'left' ) {
					$iconLeft = 'block';
					$iconRight = 'none';
				} elseif ( $attr['iconAlignButton'] == 'right' ) {
					$iconLeft = 'none';
					$iconRight = 'block';
				} else {
					$iconLeft = 'block';
					$iconRight = 'block';
				}
			} else {
				$textIcon = 'block';
				if ( $attr['iconAlignButton'] == 'left' ) {
					$iconLeft = 'block';
					$iconRight = 'none';
				} elseif ( $attr['iconAlignButton'] == 'right' ) {
					$iconLeft = 'none';
					$iconRight = 'block';
				} else {
					$iconLeft = 'block';
					$iconRight = 'block';
				}
			}


			$selectors[' .ive-posttype-icon-align-left']	=	array(
				'display'	=>	$iconLeft
			);
			$selectors[' .ive-posttype-icon-align-right']	=	array(
				'display'	=>	$iconRight
			);
			$selectors[' .ive-posttype-text-display']			=	array(
				'display'				=>	$textIcon,
				'margin-left'		=>	( $attr['buttonOption'] == 'both' && $attr['iconAlignButton'] == 'left' ) ? $attr['iconSpacingLeft'] . 'px' : 0 . 'px',
				'margin-right'	=>	( $attr['buttonOption'] == 'both' && $attr['iconAlignButton'] == 'right' ) ? $attr['iconSpacingRight'] . 'px' : 0 . 'px'
			);

			$cartTextColor	=	isset( $attr['cartTextColor'] ) ? $attr['cartTextColor'] . ' !important' : '';

			if ( $post_type == 'post' ) {

				$selectors[' .post-image img']		=	array(
					'margin-left'		=>	$otherFontImp,
					'margin-right'	=>	'auto'
				);

				$selectors[' .ive-inner-post-content']	=	array(
					'padding'	=>	'20px'
				);

				$selectors[' .post-read-more']	=	array(
					'display'			=>	'flex !important',
	        'flex-wrap'		=>	'wrap',
	        'align-items'	=>	'center',
					'color'				=>	$cartTextColor
				);

			} elseif ( $post_type = 'product' ) {

				$selectors[' .woo-prod-img img']	=	array(
					'margin-left'		=>	'auto',
					'margin-right'	=>	'auto'
				);

				$selectors[' .onsale']	=	array(
					'color'							=>	isset( $attr['badgeColor'] ) ? $attr['badgeColor'] : 'transparent',
					'background-color'	=>	isset( $attr['badgeBgColor'] ) ? $attr['badgeBgColor'] : 'transparent',
					'font-size'					=>	isset( $attr['badgeFontSize'] ) ? $attr['badgeFontSize'] . 'px' : '18px',
					'letter-spacing'		=>	isset( $attr['letterSpacingBadge'] ) ? $attr['letterSpacingBadge'] . 'px' : '0px',
					'font-family'				=>	( isset( $attr['typographyBadge'] ) && ( $attr['typographyBadge'] != '' ) ) ? $attr['typographyBadge'] : 'Open+Sans',
					'font-weight'				=>	isset( $attr['fontWeightBadge'] ) ? $attr['fontWeightBadge'] : 400,
					'font-style'				=>	isset( $attr['fontStyleBadge'] ) ? $attr['fontStyleBadge'] : ''
				);

				$selectors[' .onsale:hover']	=	array(
					'color'							=>	isset( $attr['badgeHovColor'] ) ? $attr['badgeHovColor'] : 'transparent',
					'background-color'	=>	isset( $attr['badgeBgHovColor'] ) ? $attr['badgeBgHovColor'] : 'transparent'
				);

			}

			$selectors[' .ajax_add_to_cart']	=	array(
				'display'			=>	'flex !important',
				'flex-wrap'		=>	'wrap',
				'align-items'	=>	'center',
				'color'				=>	$cartIconColor
			);


			$selectors[' .ajax_add_to_cart:hover']	=	array(
				'color'	=>	$cartIconHoverColor
			);


			$selectors[' .post-read-more i']	=	array(
				'color'	=>	$cartIconColor
			);
			$selectors[' .post-read-more:hover i']	=	array(
				'color'	=>	$cartIconHoverColor
			);
			$selectors[' .post-read-more-parent:hover .post-read-more']	=	array(
				'color'	=>	$attr['cartTextHoverColor'] . ' !important'
			);


			$selectors[' .ibtana-product-title h6']	=	array(
				'color'	=>	$attr['nameColor'] . ' !important'
			);

			if( $attr['pctitleColorImp'] == true ){
				$pctitleColorImp	= $attr['nameColor'] . ' !important';
			}else {
				$pctitleColorImp	= $attr['nameColor'];
			}

			$selectors[' .ive-inner-post-content .post-title a']	=	array(
				'color'	=>	$pctitleColorImp
			);

			$selectors[' .ibtana-product-title-child']	=	array(
				'color'	=>	$attr['nameColor'] . ' !important'
			);

			$combined_selectors = array(
				'desktop'				=> $selectors,
				'desktop_media'	=> $d_selectors,
				'tablet'				=> $t_selectors,
				'mobile'				=> $m_selectors,
			);

			return IVE_Helper::generate_all_css( $combined_selectors, '#ive-posttype-carousel' . $attr['uniqueID'] );
		}

	}

}
