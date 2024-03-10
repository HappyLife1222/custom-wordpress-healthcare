<?php

class IEPA_Blocks {
  private static  $iepa_blocks_instance = null;
  /** @var string Token */
  public static  $iepa_token;
  /** @var string Version */
  public static  $iepa_version;
  /** @var string Plugin main __FILE__ */
  public static  $iepa_file;
  /** @var string Plugin directory url */
  public static  $iepa_url;
  /** @var string Plugin directory path */
  public static  $iepa_path;
  public  $iepa_admin;
  public  $iepa_public;
  private  $iepa_templates = array();
  private function __construct( $iepa_file ) {
    self::$iepa_token   = 'ibtanaecommerceproductaddons-blocks';
    self::$iepa_file    = $iepa_file;
    self::$iepa_url     = plugin_dir_url( $iepa_file );
    self::$iepa_path    = plugin_dir_path( $iepa_file );
    self::$iepa_version = '3.6.0';
    add_action( 'plugins_loaded', [ $this, 'iepa_init' ] );
  }

  public static function iepa_blocks_instance( $iepa_file = '' ) {
    if ( null == self::$iepa_blocks_instance ) {
      self::$iepa_blocks_instance = new self( $iepa_file );
    }
    return self::$iepa_blocks_instance;
  }

  public function iepa_init() {
    $this->iepa_admin();
    $this->iepa_public();
  }

  private function iepa_admin() {
    //Instantiating admin class
    $this->iepa_admin = IEPA_Blocks_Admin::instance();
    add_filter(
      'gutenberg_can_edit_post_type',
      [ $this->iepa_admin, 'enable_gutenberg_products' ],
      11,
      2
    );
    add_filter(
      'use_block_editor_for_post_type',
      [ $this->iepa_admin, 'enable_gutenberg_products' ],
      11,
      2
    );
     add_filter('woocommerce_register_post_type_product', function( $args ) {
       unset( $args['template'] );
       return $args;
     });
    // add_action( 'rest_api_init', array( $this->iepa_admin, 'rest_api_init' ) );
    add_action( 'enqueue_block_editor_assets', array( $this->iepa_admin, 'enqueue' ), 7 );
  }

  private function iepa_public() {
    if ( ! has_action( 'woocommerce_simple_add_to_cart' ) ) {
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
      add_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
      add_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
      add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
      add_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
      add_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
      add_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    }

    //Instantiating public class
    $this->iepa_public = IEPA_Blocks_Public::instance();
    // Register blocks
    add_action( 'init', array( $this->iepa_public, 'iepa_setup_product_render' ) );
    add_action( 'init', array( $this->iepa_public, 'iepa_register_blocks' ) );
    add_action( 'wp_head', array( $this->iepa_public, 'maybe_setup_iepa_product' ) );
  }

  public static function template_id( $product_id = 0 ) {
    if ( !$product_id ) {
      $product_id = get_the_ID();
    }
    return get_post_meta( $product_id, 'iepa_builder', 'single' );
  }

  public static function enabled( $product_id = 0 ) {
      return !!self::template_id( $product_id );
  }

  public function iepa_get_templates( $iepa_taxonomy, &$iepa_templates, &$iepa_tpl_html ) {
    $iepa_terms = get_the_terms( get_the_ID(), $iepa_taxonomy );

    if ( $iepa_terms ) {
      $iepa_terms = wp_list_pluck( $iepa_terms, 'term_id' );

      $iepa_tpl_matched = get_posts( [
        'post_type' => 'iepa_template',
        'tax_query' => [
          [
            'terms'    => $iepa_terms,
            'taxonomy' => $iepa_taxonomy,
          ],
          'relation' => 'OR',
        ],
        'orderby'  => 'ID',
        'order'    => 'desc',
      ] );

      if ( $iepa_tpl_matched ) {
        foreach ( $iepa_tpl_matched as $p ) {
          $iepa_tpl_html[ $p->ID ] = $p->post_content;
          if ( ! isset( $iepa_templates[ $p->ID ] ) ) {
            $iepa_templates[ $p->ID ] = 0;
          }
          $iepa_templates[ $p->ID ] += isset( $this->template_weight[ $iepa_taxonomy ] ) ? $this->template_weight[$iepa_taxonomy] : 1;
        }
      }
    }
  }

  public static function iepa_blocks() {
    return [
      'iepa-add-to-cart'            =>  [
        'attributes'=>[
          'uniqueID' => [
            'default' => '',
            'type'    => 'string',
          ],
          'letterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'fontSizeType' => [
            'type'    =>  'string',
            'default' =>  'px',
          ],
          'fontSize' => [
            'type'    => 'array',
            'default' => [ 12, 12, 12 ],
          ],
          'fontFamily' => [
            'type'    => 'string',
            'default' => '',
          ],
          'googleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'loadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'fontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'fontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'fontStyle'  => [
            'type'    =>  'string',
            'default' =>  'normal'
          ],
          'fontSubset'  =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'textTransform' =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'quantityTextColor'   =>  [
            'type'    =>  'string',
            'default' =>  '#000000'
          ],
          'quantityBackgroundColor' =>  [
            'type'    =>  'string',
            'default' =>  '#ffffff'
          ],
          'quantityBorderSize'  =>  [
            'type'    =>  'number',
            'default' =>  0
          ],
          'quantityBorderRadius'  =>  [
            'type'    =>  'number',
            'default' =>  0
          ],
          'quantityBorderColor' =>  [
            'type'    =>  'string',
            'default' =>  '#000000'
          ],
          'quantityBorderColorHov' =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'buttonBorderRadius' => [
            'type' => 'number',
            'default' => 5,
          ],
          'buttonBorderSize' => [
            'type' => 'number',
            'default' => 0,
          ],
          'buttonLeftMargin' => [
            'type' => 'number',
            'default' => 0,
          ],
          'buttonPadding' => [
            'type' => 'number',
            'default' => 0,
          ],
          'quantityPadding' => [
            'type' => 'number',
            'default' => 0,
          ],
          'cartBorderColor' => [
            'type' => 'string',
            'default' => '#000000',
          ],
          'cartBorderColorHov' => [
            'type' => 'string',
            'default' => '#000000',
          ],
          'cartTextColor'=>[
            'type' => 'string',
            'default' => '#000000'
          ],
          'cartTextColorHov'=>[
            'type' => 'string',
            'default' => '#000000'
          ],
          'btnBgColor'      =>  [
            'type'    =>  'string',
            'default' =>  '#28303d'
          ],
          'btnBgHoverColor' =>  [
            'type'    =>  'string',
            'default' =>  '#28303d'
          ],
          'gradientEnable'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'butPadImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'butFontSizeImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'butBodRadImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'cartBorderColorImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'butleftMarginImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'quBorderImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'quColorImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'inputArrowStyle'  =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'buttexColorImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'qubgColorImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'quPaddingImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'quBorderRadiusImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'bgfirstcolorr' => [
            'type' => 'string',
            'default' => '#00B5E2'
          ],
          'bgGradLoc' => [
            'type' => 'number',
            'default' => 0
          ],
          'bgSecondColr' => [
            'type' => 'string',
            'default' => '#00B5E2'
          ],
          'bgGradLocSecond' => [
            'type' => 'number',
            'default' => 100
          ],
          'bgGradType' =>  [
            'type' => 'string',
            'default' => 'linear'
          ],
          'bgGradAngle' =>  [
            'type' => 'number',
            'default' => 180
          ],
          'vBgImgPosition' =>  [
            'type' => 'string',
            'default' => 'center center'
          ],
          'hovGradFirstColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'hovGradSecondColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'buttonBorderRadius' => [
            'type' => 'number',
            'default' => 5,
          ],
        ]
      ],
      'iepa-product-price'          =>  [
        'attributes'  =>  [
          'uniqueID' => [
            'default' => '',
            'type'    => 'string',
          ],
          'letterspaImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'rightMarginpaImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'salepricecolorImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'regularpricecolorImp'  =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'regularpricePosition' => [
            'type'    => 'number',
          ],
          'letterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          "hideRegularPrice"  =>  [
            'type'    =>    'boolean',
            'default' =>  false
          ],
          'fontSizeType' => [
            'type'    =>  'string',
            'default' =>  'px',
          ],
          'fontSize' => [
            'type'    => 'array',
            'default' => [ 12, 12, 12 ],
          ],
          'fontFamily' => [
            'type'    => 'string',
            'default' => '',
          ],
          'googleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'loadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'fontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'fontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'fontStyle'  => [
            'type'    =>  'string',
            'default' =>  'normal'
          ],
          'fontSubset'  =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'regularfontPrice' => [
            'type'    => 'number',
          ],
          'regularPriceFontColor' =>  [
            'type'    =>  'string',
            'default' =>  '#000000'
          ],
          'regularPriceHoverColor'  =>  [
            'type'    =>  'string',
            'default' =>  '#000000'
          ],
          'regularPriceBtnRightPadding' =>  [
            'type'    =>  'array',
            'default' =>  [ 0, 0, 0 ]
          ],
          'priceBtnRightMargin' =>  [
            'type'    =>  'number'
          ],
          'salePriceFontColor'  =>  [
            'type'    =>  'string',
            'default' =>  '#000000'
          ],
          'salePriceHoverColor' =>  [
            'type'    =>  'string',
            'default' =>  '#000000'
          ]
        ]
      ],
      'iepa-product-images'         =>  [
        'attributes'  =>  [
          'uniqueID' => [
            'default' => '',
            'type'    => 'string',
          ],
          'galleryPosition' =>  [
            'type'    =>  'string',
            'default' =>  'horizontal'
          ],
          'sliderArrow' =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'sliderGallery' =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'lightbox' =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'autoplay' =>  [
            'type'    =>  'boolean',
            'default' =>  false
          ],
          'loop' =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'zoom' =>  [
            'type'    =>  'boolean',
            'default' =>  true
          ],
          'arrowColor' =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'arrowBgColor' =>  [
            'type'    =>  'string',
            'default' =>  ''
          ]
        ]
      ],
      'iepa-product-review'         =>  [
        'attributes'=>[
          'uniqueID' => [
            'type'    => 'string',
            'default' => '',
          ],
          'fontSize' => [
            'type'    => 'number',
            'default' => 16,
          ],
          'reviewFontSize' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'textTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'letterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'typography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'googleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'loadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'fontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'fontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'fontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'fontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'gradientDisable' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'bgfirstcolorr' => [
            'type' => 'string',
            'default' => '#00B5E2'
          ],
          'bgGradLoc' => [
            'type' => 'number',
            'default' => 0
          ],
          'bgSecondColr' => [
            'type' => 'string',
            'default' => '#00B5E2'
          ],
          'bgGradLocSecond' => [
            'type' => 'number',
            'default' => 100
          ],
          'bgGradType' =>  [
            'type' => 'string',
            'default' => 'linear'
          ],
          'bgGradAngle' =>  [
            'type' => 'number',
            'default' => 180
          ],
          'vBgImgPosition' =>  [
            'type' => 'string',
            'default' => 'center center'
          ],
          'hovGradFirstColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'hovGradSecondColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'colorReview' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'colorReviewHov' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'colorReviewUnfilled' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'colorHovUnfilled' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'colorTextReview' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'reviewHoverColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'reviewBgColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'reviewBgHovColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'activeGradColor1' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'bggradColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'hoverbggradColor' =>  [
            'type' => 'string',
            'default' => ''
          ],
          'activeGradColor2' =>  [
            'type' => 'string',
            'default' => ''
          ],
        ]
      ],
      'iepa-product-reviews'        =>  [
        'attributes'=>[
          'uniqueID' => [
            'type'    => 'string',
            'default' => '',
          ],
          'descFontSize' => [
            'type'    => 'array',
            'default' => [ 18, 16, 14 ],
          ],
          'desctextTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'descletterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'desctypography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'descgoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'descloadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'descfontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'descfontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'descfontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'descfontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'authFontSize' => [
            'type'    => 'array',
            'default' => [ 18, 16, 14 ],
          ],
          'authtextTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'authletterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'authtypography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'authgoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'authloadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'authfontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'authfontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'authfontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'authfontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'dateFontSize' => [
            'type'    => 'array',
            'default' => [ 18, 16, 14 ],
          ],
          'imgHeight' => [
            'type'    => 'array',
            'default' => [ 60, 40, 20 ],
          ],
          'imgWidth' => [
            'type'    => 'array',
            'default' => [ 60, 40, 20 ],
          ],
          'datetextTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'dateletterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'datetypography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'dategoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'dateloadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'datefontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'datefontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'datefontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'datefontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'descColor' => [
            'type'    => 'string',
            'default' => '#000'
          ],
          'authColor' => [
            'type'    => 'string',
            'default' => '#000'
          ],
          'authColorHov' => [
            'type'    => 'string',
            'default' => '#000'
          ],
          'dateColor' => [
            'type'    => 'string',
            'default' => '#000'
          ],
          'dateColorHov' => [
            'type'    => 'string',
            'default' => ''
          ],
          'descVisibility' => [
            'type'    => 'array',
            'default' => ['true','true','true']
          ],
          'authVisibility' => [
            'type'    => 'array',
            'default' => ['true','true','true']
          ],
          'dateVisibility' => [
            'type'    => 'array',
            'default' => ['true','true','true']
          ],
          'imgVisibility' => [
            'type'    => 'array',
            'default' => ['true','true','true']
          ]
        ]
      ],
      'iepa-product-meta'           =>  [
        'attributes'=>[
          'uniqueID' => [
            'type'    => 'string',
            'default' => ''
          ],
          'skuvisible' => [
            'type'    => 'boolean',
            'default' => true
          ],
          'tagsvisible' => [
            'type'    => 'boolean',
            'default' => true
          ],
          'catvisible' => [
            'type'    => 'boolean',
            'default' => true
          ],
          'sharevisible' => [
            'type'    => 'boolean',
            'default' => true
          ],
          'metaAlignment' => [
            'type'    => 'string',
            'default' => 'left'
          ],
          'skuFontSize' => [
            'type'    => 'array',
            'default' => [ 18, 16, 14 ],
          ],
          'skuColor' => [
            'type'    => 'string',
            'default' => '',
          ],
          'skutextTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'skuletterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'skutypography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'skugoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'skuloadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'skufontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'skufontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'skufontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'skufontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'tagFontSize' => [
            'type'    => 'array',
            'default' => [ 18, 16, 14 ],
          ],
          'tagColor' => [
            'type'    => 'string',
            'default' => '',
          ],
          'tagtextTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'tagletterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'tagtypography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'taggoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'tagloadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'tagfontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'tagfontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'tagfontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'tagfontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'catFontSize' => [
            'type'    => 'array',
            'default' => [ 18, 16, 14 ],
          ],
          'catColor' => [
            'type'    => 'string',
            'default' => '',
          ],
          'cattextTransform' => [
            'type'    => 'string',
            'default' => '',
          ],
          'catletterSpacing' => [
            'type'    => 'number',
            'default' => 1,
          ],
          'cattypography' => [
            'type'    => 'string',
            'default' => '',
          ],
          'catgoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'catloadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'catfontSubset' => [
            'type'    => 'string',
            'default' => '',
          ],
          'catfontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'catfontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'catfontStyle' => [
            'type'    => 'string',
            'default' => 'normal',
          ],
          'sharearr' => [
            'type'    => 'array',
            'default' => array(
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
          ]
        ]
      ],
      'iepa-product-sale-countdown' =>  [
        'attributes'  =>  [
          'uniqueID'  =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'letterSpacing' => [
            'type'  => 'number',
            'default' => 1,
          ],
          'fontSize' => [
            'type'    => 'array',
            'default' => [ 12, 12, 12 ],
          ],
          'fontSizeType' => [
            'type'    =>  'string',
            'default' =>  'px',
          ],
          'fontFamily' => [
            'type'    => 'string',
            'default' => '',
          ],
          'googleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'loadGoogleFont' => [
            'type'    => 'boolean',
            'default' => false,
          ],
          'fontVariant' => [
            'type'    => 'string',
            'default' => '',
          ],
          'fontWeight' => [
            'type'    => 'string',
            'default' => '400',
          ],
          'fontStyle'  => [
            'type'    =>  'string',
            'default' =>  'normal'
          ],
          'fontSubset'  =>  [
            'type'    =>  'string',
            'default' =>  ''
          ],
          'blockAlignment'  =>  [
            'type'    =>  'string',
            'default' =>  'center'
          ],
          'blockStyle'  =>  [
            'type'    =>  'string',
            'default' =>  'around'
          ],
          'arcColor'  =>  [
            'type'    =>  'string',
            'default' =>  '#000'
          ],
          'circleWidth'  =>  [
            'type'    =>  'number',
            'default' =>  5
          ],
          'circleColor'  =>  [
            'type'    =>  'string',
            'default' =>  '#222'
          ],
          'circleBgColor'  =>  [
            'type'    =>  'string',
          ],
          'circleBgColorHov'  =>  [
            'type'    =>  'string',
          ],
          'textColor'  =>  [
            'type'    =>  'string',
            'default' =>  '#000'
          ],
          'textHoverColor'  =>  [
            'type'    =>  'string',
            'default' =>  '#000'
          ],
          'pctextTransform' => [
            'type' => 'string',
            'default' => '',
          ]
        ]
      ]
    ];
  }

	public function iepa_enable_rest_taxonomy( $args ) {
		$args['show_in_rest'] = true;

		return $args;
	}

}
IEPA_Blocks::iepa_blocks_instance( __FILE__ );
