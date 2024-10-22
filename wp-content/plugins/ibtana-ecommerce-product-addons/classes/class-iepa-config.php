<?php
/**
 * IEPA Config.
 *
 * @package IEPA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'IEPA_Config' ) ) {

	/**
	 * Class IEPA_Config.
	 */
	class IEPA_Config {

		/**
		 * Block Attributes
		 *
		 * @var block_attributes
		 */
		public static $block_attributes = null;

		/**
		 * Get Widget List.
		 *
		 * @since 0.0.1
		 *
		 * @return array The Widget List.
		 */
		public static function get_block_attributes() {

			if ( null === self::$block_attributes ) {
				self::$block_attributes = array(
					'iepa/iepa-add-to-cart'								=> 	array(
							'slug'				=>	'',
							'title'       =>	__( 'Add To Cart', 'ibtana-ecommerce-product-addons' ),
							'description' =>	__( 'Do not limit yourself to showing only particular products. Use the Product Slider block to create a separate category of your favorite products for featuring it on the slider.', 'ibtana-ecommerce-product-addons' ),
							'default'     =>	true,
							'attributes'  =>	array(
							'uniqueID' 					=>	'',
							'fontSizeType'				=>	'px',
							'fontSize' 					=>	[ 12, 12, 12 ],
							'fontFamily' 				=>	'',
							'googleFont' 				=>	false,
							'loadGoogleFont'			=>	false,
							'fontVariant' 				=>	'',
							'fontWeight' 				=>	'400',
							'fontStyle'					=>	'normal',
							'fontSubset'				=>	'',
							'textTransform'				=>	'',
							'letterSpacing' 			=>  '',
							'buttonBorderRadius'		=> 	5,
							'buttonBorderSize' 			=>	0,
							'buttonLeftMargin' 			=>	0,
							'buttonPadding'         	=> '',
							'quantityPadding'       => '',
							'cartBorderColor' 			=>	'#000000',
							'cartBorderColorHov' 		=>	'#000000',
							'cartTextColor'				=>	'#000000',
							'gradientEnable'			=>	false,
							'butPadImp'					=>	false,
							'butFontSizeImp'			=>	true,
							'butBodRadImp'						=>	false,
							'cartBorderColorImp'						=>	true,
							'butleftMarginImp'		=>	true,
							'quBorderImp'					=>	false,
							'quColorImp'					=>	false,
							'inputArrowStyle'					=>	true,
							'buttexColorImp'					=>	true,
							'qubgColorImp'				=>	false,
							'quPaddingImp'				=>	false,
							'quBorderRadiusImp'				=>	false,
							'btnBgColor'					=>	'#28303d',
							'btnBgHoverColor'			=>	'#28303d',
							'bgfirstcolorr' 			=>	'#00B5E2',
							'bgGradLoc' 					=>	0,
							'bgSecondColr' 				=>	'#00B5E2',
							'bgGradLocSecond' 		=> 	100,
							'bgGradType' 					=>	'linear',
							'bgGradAngle'					=>	180,
							'vBgImgPosition' 			=>	'center center',
							'hovGradFirstColor'		=>	'#00B5E2',
							'hovGradSecondColor'	=>  '#00B5E2',
							'buttonBorderRadius'	=>	5,
							'quantityTextColor'   =>	'#000000',
							'quantityBackgroundColor' =>	'#ffffff',
							'quantityBorderSize'  =>	0,
							'quantityBorderRadius'	=>	0,

							'quantityBorderColor'	=>	'#000000',
							'quantityBorderColorHov'	=>	'',
							),
					),
					'iepa/iepa-product-images'						=> 	array(
						'slug'				=>	'',
						'title'				=>	__( 'Product Images', 'ibtana-ecommerce-product-addons' ),
						'description'	=>	__( 'Do not limit yourself to showing only particular products. Use the Product Slider block to create a separate category of your favorite products for featuring it on the slider.', 'ibtana-ecommerce-product-addons' ),
						'default'     =>	true,
						'attributes'	=>	array(
									'uniqueID'				=>	'',
									'galleryPosition'	=>	'bottom'
						)
					),
					'iepa/iepa-product-price'							=>	array(
						'slug'			=>	'',
						'title'			=>	__( 'Product Price', 'ibtana-ecommerce-product-addons' ),
						'description'	=>	__( 'Do not limit yourself to showing only particular products. Use the Product Slider block to create a separate category of your favorite products for featuring it on the slider.', 'ibtana-ecommerce-product-addons' ),
						'default'		=> true,
						'attributes'	=> array(
									'uniqueID'						=>	'',
									'letterspaImp'					=>	false,
									'rightMarginpaImp'				=>	false,
									'salepricecolorImp'				=>	false,
									'regularpricecolorImp'			=>	false,
									'regularpricePosition'			=> 	'',
									'regularfontPrice'				=> 	'',
									'hideRegularPrice'				=>	false,
									'letterSpacing' 				=>  1,
									'fontSizeType' 					=>	'px',
									'fontSize' 						=>	[ 12, 12, 12 ],
									'fontFamily' 					=>	'',
									'googleFont' 					=>	false,
									'loadGoogleFont'				=>	false,
									'fontVariant' 					=>	'',
									'fontWeight'					=>	'400',
									'fontStyle'  					=>	'normal',
									'fontSubset'  					=>	'',
									'regularPriceBtnRightPadding'	=>	[ 0, 0, 0 ],
									'priceBtnRightMargin'			=> 0,
									'regularPriceFontColor' 		=>  '#000000',
									'regularPriceHoverColor'		=>  '#000000',
									'salePriceFontColor'  			=>  '#000000',
									'salePriceHoverColor' 			=>  '#000000',
						)
					),
					'iepa/iepa-product-review'						=>	array(
						'slug'				=>	'',
						'title'				=>	__( 'Product Review', 'ibtana-ecommerce-product-addons' ),
						'description'	=>	__( 'Do not limit yourself to showing only particular products. Use the Product Slider block to create a separate category of your favorite products for featuring it on the slider.', 'ibtana-ecommerce-product-addons' ),
						'default'			=>	true,
						'attributes'	=>	array(
							'uniqueID'						=>	'',
							'fontSize'						=>	16,
							'reviewFontSize' 			=>	1,
							'textTransform'				=>	'',
							'letterSpacing' 			=>	1,
							'typography' 					=>	'',
							'googleFont' 					=>	false,
							'loadGoogleFont'			=>	false,
							'fontSubset' 					=>	'',
							'fontVariant' 				=>	'',
							'fontWeight'					=>	'400',
							'fontStyle'						=>	'normal',
							'gradientDisable'			=>	false,
							'bgfirstcolorr' 			=>	'#00B5E2',
							'bgGradLoc' 					=>	0,
							'bgSecondColr'				=>	'#00B5E2',
							'bgGradLocSecond' 		=>	100,
							'bgGradType'					=>	'linear',
							'bgGradAngle'					=>	180,
							'vBgImgPosition'			=>	'center center',
							'hovGradFirstColor'		=>	'',
							'hovGradSecondColor'	=>	'',
							'colorReview'					=>	'',
							'colorReviewHov'			=>	'',
							'colorReviewUnfilled'	=>	'',
							'colorHovUnfilled'		=>	'',
							'colorTextReview'			=>	'',
							'reviewHoverColor'			=>	'',
							'reviewBgColor'			=>	'',
							'reviewBgHovColor'			=>	'',
							'activeGradColor1'		=>	'',
							'bggradColor'					=>	'',
							'hoverbggradColor'		=>	'',
							'activeGradColor2'		=>	''
						)
					),
					'iepa/iepa-product-reviews'						=>	array(
						'slug'				=>	'',
						'title'				=>	__( 'Product Reviews', 'ibtana-ecommerce-product-addons' ),
						'description'	=>	__( 'Do not limit yourself to showing only particular products. Use the Product Slider block to create a separate category of your favorite products for featuring it on the slider.', 'ibtana-ecommerce-product-addons' ),
						'default'			=>	true,
						'attributes'	=>	array(
							'uniqueID'						=> '',
							'descFontSize'					=> [ 18, 16, 14 ],
							'desctextTransform'				=>	'',
							'descletterSpacing' 			=>	1,
							'desctypography' 				=>	'',
							'descgoogleFont' 				=>	false,
							'descloadGoogleFont'			=>	false,
							'descfontSubset' 				=>	'',
							'descfontVariant' 				=>	'',
							'descfontWeight'				=>	'400',
							'descfontStyle'					=>	'normal',
							'authFontSize'					=> [ 18, 16, 14 ],
							'authtextTransform'				=>	'',
							'authletterSpacing' 			=>	1,
							'authtypography' 				=>	'',
							'authgoogleFont' 				=>	false,
							'authloadGoogleFont'			=>	false,
							'authfontSubset' 				=>	'',
							'authfontVariant' 				=>	'',
							'authfontWeight'				=>	'400',
							'authfontStyle'					=>	'normal',
							'dateFontSize'					=> [ 18, 16, 14 ],
							'imgHeight'						=> [ 60, 40, 20 ],
							'imgWidth'						=> [ 60, 40, 20 ],
							'datetextTransform'				=>	'',
							'dateletterSpacing' 			=>	1,
							'datetypography' 				=>	'',
							'dategoogleFont' 				=>	false,
							'dateloadGoogleFont'			=>	false,
							'datefontSubset' 				=>	'',
							'datefontVariant' 				=>	'',
							'datefontWeight'				=>	'400',
							'datefontStyle'					=>	'normal',
							'dateColor'						=>	'#000',
							'dateColorHov'						=>	'',
							'authColor'						=>	'#000',
							'authColorHov'						=>	'#000',
							'descColor'						=>	'#000',
							'descVisibility' 				=> ['true','true','true'],
							'authVisibility' 				=> ['true','true','true'],
							'dateVisibility' 				=> ['true','true','true'],
							'imgVisibility' 				=> ['true','true','true'],
						)
					),
					'iepa/iepa-product-meta'							=>	array(
						'slug'				=>	'',
						'title'				=>	__( 'Product Meta', 'ibtana-ecommerce-product-addons' ),
						'description'	=>	__( 'This Block allows you to construct and customize your product Meta fields. Select and show a single product in a new, high-effect fashion. Control textual content alignment, hide or display the price and description, upload a color overlay.', 'ibtana-ecommerce-product-addons' ),
						'default'			=>	true,
						'attributes'	=>	array(
							'uniqueID' => '',
							'skuvisible' => true,
							'tagsvisible' => true,
							'catvisible' => true,
							'sharevisible' => true,
							'metaAlignment' => 'left',
							'skuFontSize' => [ 18, 16, 14 ],
							'skuColor' => '',
							'skutextTransform' => '',
							'skuletterSpacing' => 1,
							'skutypography' => '',
							'skugoogleFont' => false,
							'skuloadGoogleFont' => false,
							'skufontSubset' => '',
							'skufontVariant' => '',
							'skufontWeight' => '400',
							'skufontStyle' => 'normal',
							'tagFontSize' => [ 18, 16, 14 ],
							'tagColor' => '',
							'tagtextTransform' => '',
							'tagletterSpacing' => 1,
							'tagtypography' => '',
							'taggoogleFont' => false,
							'tagloadGoogleFont' => false,
							'tagfontSubset' => '',
							'tagfontVariant' => '',
							'tagfontWeight' => '400',
							'tagfontStyle' => 'normal',
							'catFontSize' => [ 18, 16, 14 ],
							'catColor' => '',
							'cattextTransform' => '',
							'catletterSpacing' => 1,
							'cattypography' => '',
							'catgoogleFont' => false,
							'catloadGoogleFont' => false,
							'catfontSubset' => '',
							'catfontVariant' => '',
							'catfontWeight' => '400',
							'catfontStyle' => 'normal',
							'sharearr' => array(
								array(
									'icon' => 'fab fa-facebook',
									'name' => 'Facebook',
									'visible' => true,
									'link' => 'https://www.facebook.com/sharer.php?u=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-twitter-square',
									'name' => 'Twitter',
									'visible' => true,
									'link' => 'https://twitter.com/share?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-google-plus-square',
									'name' => 'Google Plus',
									'visible' => false,
									'link' => 'https://plus.google.com/share?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-linkedin',
									'name' => 'Linkedin',
									'visible' => true,
									'link' => 'https://www.linkedin.com/shareArticle?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-digg',
									'name' => 'Digg',
									'visible' => false,
									'link' => 'http://digg.com/submit?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-blogger',
									'name' => 'Blogger',
									'visible' => false,
									'link' => 'https://www.blogger.com/blog_this.pyra?t&amp;u=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-reddit-square',
									'name' => 'Reddit',
									'visible' => false,
									'link' => 'https://reddit.com/submit?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-stumbleupon-circle',
									'name' => 'Stumbleupon',
									'visible' => false,
									'link' => 'https://www.stumbleupon.com/submit?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-tumblr-square',
									'name' => 'Tumblr',
									'visible' => false,
									'link' => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fas fa-envelope',
									'name' => 'Mail',
									'visible' => true,
									'link' => 'mailto:?body',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-pinterest-square',
									'name' => 'Pinterest',
									'visible' => false,
									'link' => 'https://pinterest.com/pin/create/link/?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-vk',
									'name' => 'VK',
									'visible' => false,
									'link' => 'https://vkontakte.ru/share.php?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-odnoklassniki-square',
									'name' => 'Odnoklassniki',
									'visible' => false,
									'link' => 'https://connect.ok.ru/offer?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-get-pocket',
									'name' => 'Pocket',
									'visible' => false,
									'link' => 'https://getpocket.com/edit?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-whatsapp-square',
									'name' => 'Whatsapp',
									'visible' => false,
									'link' => 'https://api.whatsapp.com/send?text=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-xing-square',
									'name' => 'Xing',
									'visible' => false,
									'link' => 'https://www.xing.com/app/user?op=share&url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-telegram',
									'name' => 'Telegram',
									'visible' => false,
									'link' => 'https://telegram.me/share/url?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-skype',
									'name' => 'Skype',
									'visible' => false,
									'link' => 'https://web.skype.com/share?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								),
								array(
									'icon' => 'fab fa-buffer',
									'name' => 'Buffer',
									'visible' => false,
									'link' => 'https://buffer.com/add?url=',
									'target'=> '_self',
									'desksize'=> 50,
									'tabsize'=> 35,
									'mobsize'=> 20,
									'deskwidth'=> 'auto',
									'deskheight'=> 'auto',
									'tabwidth'=> 'auto',
									'tabheight'=> 'auto',
									'mobwidth'=> 'auto',
									'mobheight'=> 'auto',
									'color'=> '#444444',
									'hoverColor'=> '#eeeeee',
									'background'=> '#ffffff',
									'hoverBackground'=> '#000000',
									'border'=> '#444444',
									'hoverBorder'=> '#FF0000',
									'borderRadius'=> 0,
									'borderWidth'=> 2,
									'borderStyle'=> 'none',
									'deskpadding'=> 20,
									'tabpadding'=> 16,
									'mobpadding'=> 12,
									'deskpadding2'=> 20,
									'tabpadding2'=> 16,
									'mobpadding2'=> 12,
									'style'=> 'default',
									'iconGrad'=> false,
									'gradFirstColor'=> '',
									'gradFirstLoc'=> 0,
									'gradSecondColor'=> '#00B5E2',
									'gradSecondLoc'=> '100',
									'gradType'=> 'linear',
									'gradAngle'=> '180',
									'gradRadPos'=> 'center center',
									'hovGradFirstColor'=> '',
									'hovGradSecondColor'=> '',
								)
							)
						)
					),
					'iepa/iepa-product-sale-countdown'		=>	array(
						'slug'				=>	'',
						'title'				=>	__( 'Product Sale Countdown', 'ibtana-ecommerce-product-addons' ),
						'description'	=>	__( 'Product Sale Countdown', 'ibtana-ecommerce-product-addons' ),
						'default'			=>	true,
						'attributes'	=>	array(
							'uniqueID' => '',
							'fontSize' 								=>	[ 12, 12, 12 ],
							'fontFamily' 							=>	'',
							'googleFont' 							=>	false,
							'loadGoogleFont'					=>	false,
							'fontVariant' 						=>	'',
							'fontWeight'							=>	'400',
							'fontStyle'  							=>	'normal',
							'fontSubset'  						=>	'',
							'blockAlignment'  				=>	'center',
							'textColor'  							=>	'#000',
							'blockStyle'							=>	'around',
							'arcColor'								=>	'#000',
							'circleWidth'							=>	5,
							'circleColor'							=>	'#222',
							'circleBgColor'						=>	'',
							'circleBgColorHov'						=>	'',
							'letterSpacing'			 			=>  1,
						)
					)

				);
			}
			return self::$block_attributes;
		}
	}
}
