<?php
  class Ibtana_Visual_Editor_Pro_PostControl {

    function __construct() {
      add_action( 'init',                         array( $this, 'post_slider_layout_register_post_grid' ) );
      add_action( 'init',                         array( $this, 'gutenberg_my_block_init' ) );
      add_action( 'rest_api_init',                array( $this, 'post_slider_layout_register_rest_fields' ) );
      add_action( 'after_setup_theme',            array( $this, 'post_slider_layout_image_sizes' ) );
      add_action( 'wp_ajax_ive_load_more',        array( $this, 'ive_load_more_callback' ) );       // Next Previous AJAX Call
      add_action( 'wp_ajax_nopriv_ive_load_more', array( $this, 'ive_load_more_callback' ) );       // Next Previous AJAX Call
    }

    // Load More Action
    public function ive_load_more_callback() {

      // Check for nonce security
  		if ( ! wp_verify_nonce( $_POST['wpnonce'], 'posttype_slider_nonce' ) ) {
  			exit;
  		}

      $paged      = sanitize_text_field( $_POST['paged'] );
      $blockId    = sanitize_text_field( $_POST['blockId'] );
      $postId     = sanitize_text_field( $_POST['postId'] );
      $blockRaw   = sanitize_text_field( $_POST['blockName'] );
      $blockName  = str_replace( '_', '/', $blockRaw );

      if( $paged && $blockId && $postId && $blockName ) {
        $post = get_post( $postId );
        if ( has_blocks( $post->post_content ) ) {
          $blocks = parse_blocks( $post->post_content );
          foreach ( $blocks as $key => $value ) {
            if( $blockName == $value['blockName'] ) {
              if( $value['attrs']['uniqueID'] == $blockId ) {
                $attr = $this->get_attributes( true );
                $attr['paged'] = $paged;
                $attr = array_merge( $attr, $value['attrs'] );
                echo $this->post_slider_layout_render_post_grid( $attr, true );
                die();
              }
            }
          }
        }
      }
    }

    private static $instance;

    /**
    * Initiator
    */
    public static function get_instance() {
      if ( ! isset( self::$instance ) ) {
        self::$instance = new self();
      }
      return self::$instance;
    }


    function get_post_slider_layout_featured_media( $object ) {

      $objFeatured_media = isset($object['featured_media']) ? $object['featured_media'] : 0;

      $featured_media = wp_get_attachment_image_src($objFeatured_media, 'full', false);

      return array(
        'thumbnail' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'thumbnail',
          false
        ) : '',
        'post_slider_layout_landscape_large' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'post_slider_layout_landscape_large',
          false
        ) : '',
        'post_slider_layout_portrait_large' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'post_slider_layout_portrait_large',
          false
        ) : '',
        'post_slider_layout_square_large' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'post_slider_layout_square_large',
          false
        ) : '',
        'post_slider_layout_landscape' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'post_slider_layout_landscape',
          false
        ) : '',
        'post_slider_layout_portrait' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'post_slider_layout_portrait',
          false
        ) : '',
        'post_slider_layout_square' => is_array($featured_media) ? wp_get_attachment_image_src(
          $objFeatured_media,
          'post_slider_layout_square',
          false
        ) : '',
        'full' => is_array($featured_media) ? $featured_media : '',
      );
    }

    function post_slider_layout_image_sizes(){
      add_image_size('post_slider_layout_landscape_large', 1200, 800, true);
      add_image_size('post_slider_layout_portrait_large', 1200, 1800, true);
      add_image_size('post_slider_layout_square_large', 1200, 1200, true);
      add_image_size('post_slider_layout_landscape', 600, 400, true);
      add_image_size('post_slider_layout_portrait', 600, 900, true);
      add_image_size('post_slider_layout_square', 600, 600, true);
    }

    function post_slider_layout_register_rest_fields(){
      $post_types = get_post_types();
      register_rest_field(
        $post_types,
        'post_slider_layout_featured_media_urls',
        array(
          'get_callback' => array($this, 'get_post_slider_layout_featured_media'),
          'update_callback' => null,
          'schema' => array(
            'description' => __('Different Sized Featured Images', 'post-slider-layout'),
            'type' => 'array'
          )
        )
      );
    }

    public function get_attributes( $default = false ) {
      $attributes = array(
        'marginleft' => array(
          'type' => 'number',
        ),
        'marginright' => array(
          'type' => 'number',
        ),
        'imageColorTab' => array(
          'type' => 'string',
          'default' => ''
        ),
        'imageColorTabHov' => array(
          'type' => 'string',
          'default' => ''
        ),
        'imgBorderWidth' => array(
          'type' => 'number',
          'default' => 0
        ),
        'imgleftmargin' => array(
          'type' => 'number',
        ),
        'imgBorderType' => array(
          'type' => 'string',
          'default' => 'none'
        ),
        'contentColorTab' => array(
          'type' => 'string',
          'default' => ''
        ),
        'contentColorTabHov' => array(
          'type' => 'string',
          'default' => ''
        ),
        'contentBorderWidth' => array(
          'type' => 'number',
          'default' => 0
        ),
        'contentborderType' => array(
          'type' => 'string',
          'default' => 'none'
        ),
        'regularfontPrice' => array(
          'type' => 'number',
        ),
        'regularPricetabColor' => array(
          'type' => 'string',
          'default' => ''
        ),
        'regularPricetabColorHov' => array(
          'type' => 'string',
          'default' => ''
        ),
        'postBlockWidth' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'buttoncontentTransform' => array(
          'type' => 'string',
          'default' => '',
        ),
        'postmetaTextTransform' => array(
          'type' => 'string',
          'default' => '',
        ),
        'align' => array(
          'type' => 'string',
          'default' => 'left',
        ),
        'post_type' => array(
          'type' => 'string',
          'default' => 'post'
        ),
        'categories' => array(
          'type' => 'string',
        ),
        'postcategories' => array(
          'type' => 'string',
        ),
        'team_cats' => array(
          'type' => 'string',
        ),
        'postscount' => array(
          'type' => 'number',
          'default' => 5,
        ),
        'order' => array(
          'type' => 'string',
          'default' => 'desc',
        ),
        'orderBy'  => array(
          'type' => 'string',
          'default' => 'date',
        ),
        'columns' => array(
          'type' => 'number',
          'default' => 2
        ),
        'columnGap' => array(
          'type' => 'number',
          'default' => 15
        ),
        'postLayout' => array(
          'type' => 'string',
          'default' => 'grid',
        ),
        'layoutType' => array(
          'type' => 'array',
          'default' => ['column', 'column', 'column']
        ),
        'carouselLayoutStyle' => array(
          'type' => 'string',
          'default' => 'skin1',
        ),
        'slidesToShow' => array(
          'type' => 'number',
          'default' => 2,
        ),
        'deskslideItems' => array(
          'type' => 'number',
          'default' => 3,
        ),
        'tabslideItems' => array(
          'type' => 'number',
          'default' => 2,
        ),
        'mobslideItems' => array(
          'type' => 'number',
          'default' => 1,
        ),
        'slideMargin' => array(
          'type' => 'number',
          'default' => 3,
        ),
        'autoPlay' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'slideLoop'=>array(
          'type' => 'boolean',
          'default' => true
        ),
        'mouseDrag'=>array(
          'type' => 'boolean',
          'default' => true
        ),
        'pctitleColorImp'=>array(
          'type' => 'boolean',
          'default' => false
        ),
        'pctitleFontImp'=>array(
          'type' => 'boolean',
          'default' => false
        ),
        'pcimageColorImp'=>array(
          'type' => 'boolean',
          'default' => false
        ),
        'otherFontImp'=>array(
          'type' => 'boolean',
          'default' => true
        ),
        'otherBorderImp'=>array(
          'type' => 'boolean',
          'default' => true
        ),
        'overlayContent'=>array(
          'type' => 'boolean',
          'default' => true
        ),
        'overlayTop'=> array(
          'type' => 'number',
          'default' => 0,
        ),
        'uniqueID'=> array(
          'type'=> 'string',
          'default'=> '',
        ),
        'isSlider'=>array(
          'type' => 'boolean',
          'default' => true
        ),
        'navigation' => array(
          'type' => 'array',
          'default' => [ 'none', 'none', 'none' ]
        ),
        'gridLayoutStyle' => array(
          'type' => 'string',
          'default' => 'g_skin1',
        ),
        'postImageSizes' => array(
          'type' => 'string',
          'default' => 'full',
        ),
        'displayPostTitle' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'displayPostImage' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'displayPostCategory' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayPostDate' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayPostDateIcon' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayComment' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayCommentIcon' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayCommentText' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'CommentText' => array(
          'type' => 'string',
          'default' => 'Comment'
        ),
        'displayPostAuthor' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayPostAuthorIcon' => array(
          'type' => 'array',
          'default' => [ 'false', 'false', 'false' ]
        ),
        'displayPostExcerpt' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'displayProductExcerpt' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'displayProductSaleBadge' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'displayPostReadMoreButton' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'postReadMoreButtonText' => array(
          'type' => 'string',
          'default' => 'Read More',
        ),
        'postCurrency' => array(
          'type' => 'string',
          'default' => $this->show_currency_symbol(),
        ),
        'nameColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'nameHoverColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'contentColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'postMetaTextColor' => array(
          'type' => 'string',
          'default' => 'black'
        ),
        'postMetaTextColorHov' => array(
          'type' => 'string',
          'default' => ''
        ),
        'postCatTextColor' => array(
          'type' => 'string',
          'default' => 'black'
        ),
        'postCatTextColorHov' => array(
          'type' => 'string',
          'default' => ''
        ),
        'postMetaIconColor' => array(
          'type' => 'string',
          'default' => '#222222'
        ),
        'postMetaIconColorHov' => array(
          'type' => 'string',
          'default' => ''
        ),
        'postDateFormat' => array(
          'type' => 'string',
          'default' => 'd F Y'
        ),
        'priceColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'priceHoverColor'=> array(
          'type' => 'string',
          'default' => 'black',
        ),
        'contentBackgroundColor' => array(
          'type' => 'string',
          'default' => '#ffffff',
        ),
        'cartButton' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ],
        ),
        'contentOpacity'=> array(
          'type' => 'number',
          'default' => 0,
        ),
        'cartBackgroundColor' => array(
          'type' => 'string',
          'default' => '#f7f7f7',
        ),
        'cartBackgroundHovColor' => array(
          'type' => 'string',
          'default' => '#ffffff',
        ),
        'cartTextColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'cartTextHoverColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'cartIconColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'cartIconHoverColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'imgbgColor' => array(
          'type' => 'string',
          'default' => '',
        ),
        'imgbgColorHov' => array(
          'type' => 'string',
          'default' => '',
        ),
        'cartBorderColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'cartBorderHovColor' => array(
          'type' => 'string',
          'default' => 'black',
        ),
        'cartBorderRadius' => array(
          'type' => 'number',
          'default' => 0
        ),
        'cartFontSizemob' => array(
          'type' => 'number',
          'default' => 14,
        ),
        'cartFontSizetab' => array(
          'type' => 'number',
          'default' => 16,
        ),
        'cartFontSizedesk' => array(
          'type' => 'number',
          'default' => 18,
        ),
        'contentFontSizemob' => array(
          'type' => 'number',
          'default' => 14,
        ),
        'contentFontSizetab' => array(
          'type' => 'number',
          'default' => 16,
        ),
        'contentFontSizedesk' => array(
          'type' => 'number',
          'default' => 18,
        ),
        'titleFontSizemob' => array(
          'type' => 'number',
          'default' => 14,
        ),
        'titleFontSizetab' => array(
          'type' => 'number',
          'default' => 16,
        ),
        'titleFontSizedesk' => array(
          'type' => 'number',
          'default' => 18,
        ),
        'mobcartButtonPadding' => array(
          'type' => 'number',
          'default' => 10,
        ),
        'mobcartButtonPadding2' => array(
          'type' => 'number',
          'default' => 10,
        ),
        'tabcartButtonPadding' => array(
          'type' => 'number',
          'default' => 10,
        ),
        'tabcartButtonPadding2' => array(
          'type' => 'number',
          'default' => 10,
        ),
        'deskcartButtonPadding' => array(
          'type' => 'number',
          'default' => 10,
        ),
        'deskcartButtonPadding2' => array(
          'type' => 'number',
          'default' => 10,
        ),
        'cartButtonPaddingControl' => array(
          'type' => 'string',
          'default' => 'linked',
        ),
        'letterSpacing' => array(
          'type' => 'number'
        ),
        'typography' => array(
          'type' => 'string',
          'default' => ''
        ),
        'googleFont' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'loadGoogleFont' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'fontSubset' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontVariant' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontWeight' => array(
          'type' => 'string',
          'default' => '400'
        ),
        'fontStyle' => array(
          'type' => 'string',
          'default' => 'normal'
        ),
        'letterSpacingC' => array(
          'type' => 'number'
        ),
        'typographyC' => array(
          'type' => 'string',
          'default' => ''
        ),
        'googleFontC' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'loadGoogleFontC' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'fontSubsetC' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontVariantC' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontWeightC' => array(
          'type' => 'string',
          'default' => '400'
        ),
        'fontStyleC' => array(
          'type' => 'string',
          'default' => 'normal'
        ),
        'letterSpacingT' => array(
          'type' => 'number'
        ),
        'typographyT' => array(
          'type' => 'string',
          'default' => ''
        ),
        'googleFontT' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'loadGoogleFontT' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'fontSubsetT' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontVariantT' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontWeightT' => array(
          'type' => 'string',
          'default' => '400'
        ),
        'fontStyleT' => array(
          'type' => 'string',
          'default' => 'normal'
        ),
        'blockAlignment' => array(
          'type' => 'string',
          'default' => 'none'
        ),
        'autoplayHover' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'rewind' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'autoplayTimeOut' => array(
          'type' => 'number',
          'default' => 5000
        ),
        'autoplaySpeed' => array(
          'type' => 'number',
          'default' => 5000
        ),
        'navigationSpeed' => array(
          'type' => 'number',
          'default' => 5000
        ),
        'dotSpeed' => array(
          'type' => 'number',
          'default' => 5000
        ),
        'stagePadding' => array(
          'type' =>  'number',
          'default' =>  0
        ),
        'navArrowSize' => array(
          'type' =>  'array',
          'default' =>  [ 20, 20, 20 ]
        ),
        'navArrowColor' => array(
          'type' =>  'string',
          'default' =>  '#000000'
        ),
        'navArrowBgColor' => array(
          'type' =>  'string',
          'default' =>  '#ffffff'
        ),
        'navArrowBdColor' => array(
          'type' =>  'string',
          'default' =>  '#000000'
        ),
        'navArrowBdWidth' => array(
          'type' =>  'array',
          'default' =>  [ 0, 0, 0 ]
        ),
        'navArrowBdRadius' => array(
          'type' =>  'number',
          'default' =>  0
        ),
        'dotActiveColor' => array(
          'type' =>  'string',
          'default' =>  '#000000'
        ),
        'dotColor' => array(
          'type' =>  'string',
          'default' =>  '#222222'
        ),
        'navArrowHovColor' => array(
          'type' =>  'string',
          'default' =>  '#ffffff'
        ),
        'navArrowBgHovColor' => array(
          'type' =>  'string',
          'default' =>  '#000000'
        ),
        'navArrowBdHovColor' => array(
          'type' =>  'string',
          'default' =>  '#ffffff'
        ),
        'isnavText' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'navbtntype' => array(
          'type' => 'string',
          'default' => 'icon'
        ),
        'navTextPrev' => array(
          'type' => 'string',
          'default' => 'Prev'
        ),
        'navTextNext' => array(
          'type' => 'string',
          'default' => 'Next'
        ),
        'navTextPrevicon' => array(
          'type' => 'string',
          'default' => 'fas fa-angle-left'
        ),
        'navTextNexticon' => array(
          'type' => 'string',
          'default' => 'fas fa-angle-right'
        ),
        'buttonOption' => array(
          'type' =>  'string',
          'default' => 'text'
        ),
        'buttonIconName' => array(
          'type' =>  'string',
          'default' => 'fas fa-cart-plus'
        ),
        'buttonIconName2' => array(
          'type' =>  'string',
          'default' => 'fas fa-cart-plus'
        ),
        'iconAlignButton' => array(
          'type' =>  'string',
          'default' => 'right'
        ),
        'imageDateOption' => array(
          'type' => 'array',
          'default' => [ 'true', 'true', 'true' ]
        ),
        'imgWidth' => array(
          'type' => 'array',
          'default' => [400, 400, 400]
        ),
        'imgHeight' => array(
          'type' => 'array',
          'default' => [400, 400, 400]
        ),
        'postdeskalign' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'posttabalign' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'postmobalign' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'productdeskalign' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'producttabalign' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'productmobalign' => array(
          'type' => 'string',
          'default' => 'center'
        ),
        'borderType' => array(
          'type' => 'string',
          'default' => 'solid'
        ),
        'cartBorderWidth' => array(
          'type' => 'number',
          'default' => 0
        ),
        'content_excerpt' => array(
          'type' => 'number',
          'default' => 100
        ),
        'showRegularPrice' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'showproductName' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'showSalePrice' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'isWooComActive' => array(
          'type' => 'boolean',
          'default' => $this->check_woocommerce_active(),
        ),
        'marginPrice' => array(
          'type' => 'number',
          'default' => 0
        ),
        'fontPrice' => array(
          'type' => 'number',
          'default' => 18
        ),
        'marginTopPrice' => array(
          'type' => 'number',
          'default' => 0
        ),
        'marginBottomPrice' => array(
          'type' => 'number',
          'default' => 0
        ),
        'iconSpacingRight' => array(
          'type' => 'number',
          'default' => 0
        ),
        'iconSpacingLeft' => array(
          'type' => 'number',
          'default' => 0
        ),
        'iconPostMetaSize' => array(
          'type' => 'array',
          'default' => [ 10, 10, 10 ]
        ),
        'contentPostMetaSize' => array(
          'type' => 'array',
          'default' => [ 10, 10, 10 ]
        ),
        'iconGrad' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'fontColorImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'fontFamImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'textTranImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'headingColorImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'spacingTopImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'spacingBottomImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'advpaddIngImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'advborderImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'boxShaowImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'headingBgColorImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'letterspacingImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'btnMarImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'borderRadiusImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'desksizeImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'borderWidthImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'iconMarImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'iconSizeImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'iconPadImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'borderColorImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'backgColorImp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'bgOpacityimp' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'iconposTop' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'israting' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'ratingColor' => array(
          'type' => 'string',
          'default' => '#fe2b2b'
        ),
        'bgfirstcolorr' => array(
          'type' => 'string',
          'default' => '#00B5E2'
        ),
        'bgGradLoc' => array(
          'type' => 'number',
          'default' => 0
        ),
        'bgSecondColr' => array(
          'type' => 'string',
          'default' => '#00B5E2'
        ),
        'bgGradLocSecond' => array(
          'type' => 'number',
          'default' => 100
        ),
        'bgGradType' => array(
          'type' => 'string',
          'default' => 'linear'
        ),
        'bgGradAngle' => array(
          'type' => 'number',
          'default' => 180
        ),
        'vBgImgPosition' => array(
          'type' => 'string',
          'default' => 'center center'
        ),
        'hovGradFirstColor' => array(
          'type' => 'string',
          'default' => ''
        ),
        'hovGradSecondColor' => array(
          'type' => 'string',
          'default' => ''
        ),
        'productCount' => array(
          'type' => 'number',
          'default' => $this->get_product_count()
        ),
        'postCount' => array(
          'type' => 'number',
          'default' => $this->get_post_count()
        ),
        'owlNavMaxWidth' => array(
          'type' => 'array',
          'default' => [ 100, 100, 100 ]
        ),
        'owlNavTop' => array(
          'type' => 'array',
          'default' => [ 35, 35, 35 ]
        ),
        'owlNavLeft' => array(
          'type' => 'array',
          'default' => [ 0, 0, 0 ]
        ),
        'owlNavRight' => array(
          'type' => 'array',
          'default' => [ 0, 0, 0 ]
        ),
        'arrowBtnWidth' => array(
          'type' => 'array',
          'default' => [ 45, 45, 45 ]
        ),
        'arrowBtnHeight' => array(
          'type' => 'array',
          'default' => [ 40, 40, 40 ]
        ),
        'arrowBtnPadding' => array(
          'type' => 'array',
          'default' => [
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0]
          ]
        ),
        'arrowBtnPaddingControl' => array(
          'type' => 'array',
          'default' => [
            'individual',
            'individual',
            'individual'
          ]
        ),
        'dotBorderRadius' => array(
          'type' => 'number',
          'default' => 0
        ),
        'letterSpacingPM' => array(
          'type' => 'number'
        ),
        'typographyPM' => array(
          'type' => 'string',
          'default' => ''
        ),
        'googleFontPM' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'loadGoogleFontPM' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'fontSubsetPM' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontVariantPM' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontWeightPM' => array(
          'type' => 'string',
          'default' => '400'
        ),
        'fontStylePM' => array(
          'type' => 'string',
          'default' => 'normal'
        ),
        'letterSpacingPrice' => array(
          'type' => 'number'
        ),
        'typographyPrice' => array(
          'type' => 'string',
          'default' => ''
        ),
        'googleFontPrice' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'loadGoogleFontPrice' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'fontSubsetPrice' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontVariantPrice' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontWeightPrice' => array(
          'type' => 'string',
          'default' => '400'
        ),
        'fontStylePrice' => array(
          'type' => 'string',
          'default' => 'normal'
        ),
        'badgeColor' => array(
          'type' => 'string',
          'default' => 'black'
        ),
        'badgeHovColor' => array(
          'type' => 'string',
          'default' => '#222222'
        ),
        'badgeBgColor' => array(
          'type' => 'string',
          'default' => '#ffffff'
        ),
        'badgeBgHovColor' => array(
          'type' => 'string',
          'default' => '#222222'
        ),
        'badgeFontSize' => array(
          'type' => 'number',
          'default' => 18
        ),
        'letterSpacingBadge' => array(
          'type' => 'number'
        ),
        'typographyBadge' => array(
          'type' => 'string',
          'default' => ''
        ),
        'googleFontBadge' => array(
          'type' => 'boolean',
          'default' => false
        ),
        'loadGoogleFontBadge' => array(
          'type' => 'boolean',
          'default' => true
        ),
        'fontSubsetBadge' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontVariantBadge' => array(
          'type' => 'string',
          'default' => ''
        ),
        'fontWeightBadge' => array(
          'type' => 'string',
          'default' => '400'
        ),
        'fontStyleBadge' => array(
          'type' => 'string',
          'default' => 'normal'
        ),
        'authorOrderPosition' =>  array(
          'type'    =>  'number',
          'default' =>  1
        ),
        'dateOrderPosition'   =>  array(
          'type'    =>  'number',
          'default' =>  2
        ),
        'commentOrderPosition'  =>  array(
          'type'    =>  'number',
          'default' =>  3
        ),
        'displaySocialShareIcons' =>  array(
          'type'    =>  'array',
          'default' =>  [ 'false', 'false', 'false' ]
        ),
        'iconCount' =>  array(
          'type'    =>  'number',
          'default' =>  1
        ),
        'icons'     =>  array(
          'type'    =>  'array',
          'default' =>  array(
            array(
              'icon'                =>  'fe_aperture',
              'iconSvg'             =>  'fa fa-bookmark',
              'link'                =>  '',
              'target'              =>  '_self',
              'desksize'            =>  50,
              'tabsize'             =>  35,
              'mobsize'             =>  20,
              'title'               =>  '',
              'deskwidth'           =>  'auto',
              'deskheight'          =>  'auto',
              'tabwidth'            =>  'auto',
              'tabheight'           =>  'auto',
              'mobwidth'            =>  'auto',
              'mobheight'           =>  'auto',
              'color'               =>  '#444444',
              'hoverColor'          =>  '#eeeeee',
              'background'          =>  '#ffffff',
              'hoverBackground'     =>  '#000000',
              'border'              =>  '#444444',
              'hoverBorder'         =>  '#FF0000',
              'borderRadius'        =>  0,
              'borderWidth'         =>  2,
              'borderStyle'         =>  'none',
              'deskpadding'         =>  20,
              'tabpadding'          =>  16,
              'mobpadding'          =>  12,
              'deskpadding2'        =>  20,
              'tabpadding2'         =>  16,
              'mobpadding2'         =>  12,
              'style'               =>  'default',
              'iconGrad'            =>  false,
              'gradFirstColor'      =>  '',
              'gradFirstLoc'        =>  0,
              'gradSecondColor'     =>  '#00B5E2',
              'gradSecondLoc'       =>  '100',
              'gradType'            =>  'linear',
              'gradAngle'           =>  '180',
              'gradRadPos'          =>  'center center',
              'hovGradFirstColor'   =>  '',
              'hovGradSecondColor'  =>  '',
              'socialShareType'     =>  'facebook'
            )
          )
        ),
        'alignType' =>  array(
          'type'  =>  'string',
          'default' =>  'horizontal'
        ),
        'deskIconAlignment' =>  array(
          'type'    =>  'string',
          'default' =>  'center'
        ),
        'tabIconAlignment'  =>  array(
          'type'    =>  'string',
          'default' =>  'center'
        ),
        'mobIconAlignment'  =>  array(
          'type'    =>  'string',
          'default' =>  'center'
        ),
        'margintb'    =>  array(
          'type'    =>  'array',
          'default' =>  [ 5, 5, 5 ],
        ),
        'marginlr'    =>  array(
          'type'    =>  'array',
          'default' =>  [ 5, 5, 5 ]
        ),


        // Wishlist Attributes Starts
        'isWishlistBtnEnabled'   =>  array(
          'type'      =>  'array',
          'default'   =>  [ 'false', 'false', 'false' ]
        ),
        'wishlistPlugin'  =>  array(
          'type'            =>  'string',
          'default'         =>  'yith-woocommerce-wishlist'
        ),
        'isWishListTypoEnabled'   =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'wishBtnLetterSpacing'   =>  array(
          'type'      =>  'number',
          'default'   =>  1
        ),
        'wishBtnTypography'       =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'wishBtnGoogleFont'       =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'wishBtnLoadGoogleFont'   =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'wishBtnFontVariant'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'wishBtnFontWeight'       =>  array(
          'type'      =>  'string',
          'default'   =>  '400'
        ),
        'wishBtnFontStyle'        =>  array(
          'type'      =>  'string',
          'default'   =>  'normal'
        ),
        'wishBtnFontSubset'       =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'wishBtnTextTransform'    =>  array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        // Wishlist Attributes ENDs


        // product compare buton attributes starts
        'isProductCompareEnabled'   =>  array(
          'type'      =>  'array',
          'default'   =>  [ 'false', 'false', 'false' ]
        ),
        'productComparePlugin'      =>  array(
          'type'      =>  'string',
          'default'   =>  'yith-woocommerce-compare'
        ),
        'isCompareBtnTypoEnabled'   =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'compareBtnLetterSpacing'   =>  array(
          'type'      =>  'number',
          'default'   =>  1
        ),
        'compareBtnTypography'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'compareBtnGoogleFont'      =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'compareBtnLoadGoogleFont'  =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'compareBtnFontVariant'     =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'compareBtnFontWeight'      =>  array(
          'type'      =>  'string',
          'default'   =>  '400'
        ),
        'compareBtnFontStyle'       =>  array(
          'type'      =>  'string',
          'default'   =>  'normal'
        ),
        'compareBtnFontSubset'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'compareBtnTextTransform'   =>  array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        'titleTransform' => array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        'contentTransform' => array(
          'type'      =>   'string',
          'default'   =>   'none'
        ),
        // product compare buton attributes ends

        // quick view button attributes starts
        'isQuickViewEnabled'        =>  array(
          'type'      =>  'array',
          'default'   =>  [ 'false', 'false', 'false' ]
        ),
        'quickViewPlugin'           =>  array(
          'type'      =>  'string',
          'default'   =>  'woosq'
        ),
        'isQuickViewBtnTypoEnabled'   =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'quickViewBtnLetterSpacing'   =>  array(
          'type'      =>  'number',
          'default'   =>  1
        ),
        'quickViewBtnTypography'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'quickViewBtnGoogleFont'      =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'quickViewBtnLoadGoogleFont'  =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'quickViewBtnFontVariant'     =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'quickViewBtnFontWeight'      =>  array(
          'type'      =>  'string',
          'default'   =>  '400'
        ),
        'quickViewBtnFontStyle'       =>  array(
          'type'      =>  'string',
          'default'   =>  'normal'
        ),
        'quickViewBtnFontSubset'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'quickViewBtnTextTransform'   =>  array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        // quick view button attributes ends

        // pagination attributes starts here
        'isPaginationEnabled'  =>  array(
          'type'    =>  'boolean',
          'default' =>  false
        ),
        'paginationType'  =>  array(
          'type'    =>  'string',
          'default' =>  'pagination'
        ),
        'paginationNav'  =>  array(
          'type'    =>  'string',
          'default' =>  'textArrow'
        ),
        'deskPaginationAlign' =>  array(
          'type'    =>  'string',
          'default' =>  'center'
        ),
        'tabPaginationAlign'  =>  array(
          'type'    =>  'string',
          'default' =>  'center'
        ),
        'mobPaginationAlign'  =>  array(
          'type'    =>  'string',
          'default' =>  'center'
        ),
        'paginationBorderWidth'     =>  array(
          'type'    =>  'number',
          'default' =>  0
        ),
        'paginationBorderRadius'    =>  array(
          'type'    =>  'number',
          'default' =>  0
        ),
        'paginationBorderType'      =>  array(
          'type'    =>  'string',
          'default' =>  'solid'
        ),
        'paginationLetterSpacing'   =>  array(
          'type'      =>  'number',
          'default'   =>  1
        ),
        'paginationTypography'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'paginationGoogleFont'      =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'paginationLoadGoogleFont'  =>  array(
          'type'      =>  'boolean',
          'default'   =>  false
        ),
        'paginationFontVariant'     =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'paginationFontWeight'      =>  array(
          'type'      =>  'string',
          'default'   =>  '400'
        ),
        'paginationFontStyle'       =>  array(
          'type'      =>  'string',
          'default'   =>  'normal'
        ),
        'paginationFontSubset'      =>  array(
          'type'      =>  'string',
          'default'   =>  ''
        ),
        'paginationTextTransform'   =>  array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        'paginationTextColor'       =>  array(
          'type'      =>  'string',
          'default'   =>  '#fff'
        ),
        'paginationTextHoverColor'  =>  array(
          'type'      =>  'string',
          'default'   =>  '#fff'
        ),
        'paginationTextActiveColor' =>  array(
          'type'      =>  'string',
          'default'   =>  '#fff'
        ),
        'paginationBackgroundColor' =>  array(
          'type'      =>  'string',
          'default'   =>  '#0e1523'
        ),
        'paginationBackgroundHovColor'  =>  array(
          'type'      =>  'string',
          'default'   =>  '#FF4747'
        ),
        'paginationBackgroundActiveColor' =>  array(
          'type'      =>  'string',
          'default'   =>  '#FF4747'
        ),
        'paginationBorderColor'     =>  array(
          'type'      =>  'string',
          'default'   =>  '#0e1523'
        ),
        'paginationBorderHovColor'  =>  array(
          'type'      =>  'string',
          'default'   =>  '#FF4747'
        ),
        'paginationBorderActiveColor' =>  array(
          'type'      =>  'string',
          'default'   =>  '#FF4747'
        ),
        // pagination attributes ends here


        // Card Border Attributes START
        'cardNormalBorderType'    =>  array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        'cardNormalBorderTop'     =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardNormalBorderRight'   =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardNormalBorderBottom'  =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardNormalBorderLeft'    =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardNormalBorderColor'   =>  array(
          'type'      =>  'string',
          'default'   =>  'transparent'
        ),

        'cardHoverBorderType'     =>  array(
          'type'      =>  'string',
          'default'   =>  'none'
        ),
        'cardHoverBorderTop'      =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardHoverBorderRight'    =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardHoverBorderBottom'   =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardHoverBorderLeft'     =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardHoverBorderColor'   =>  array(
          'type'      =>  'string',
          'default'   =>  'transparent'
        ),

        'cardBorderRadiustype'  =>  array(
          'type'      =>  'string',
          'default'   =>  'px'
        ),
        'cardBorderRadiusTop'   =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardBorderRadiusRight'   =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardBorderRadiusBottom'   =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        'cardBorderRadiusLeft'   =>  array(
          'type'      =>  'number',
          'default'   =>  0
        ),
        // Card Border Attributes END

      );

      if( $default ) {
        $temp = array();
        foreach ($attributes as $key => $value) {
          if( isset($value['default']) ){
            $temp[$key] = $value['default'];
          }
        }
        return $temp;
      } else {
        return $attributes;
      }
    }

    function post_slider_layout_register_post_grid() {
      if (!function_exists('register_block_type')) {
        return;
      }

      $ive_options = array(
        'admin_url' => admin_url(),
      );
      wp_localize_script( 'wp-blocks', 'ive_product_option', $ive_options );


      register_block_type(
        'ive/ive-productscarousel',
        array(
          'attributes'      =>  $this->get_attributes(),
          'render_callback' =>  array( $this, 'post_slider_layout_render_post_grid' ),
          'editor_script'   =>  'wp-blocks',
        )
      );
    }

    function check_woocommerce_active() {
      if ( class_exists( 'WooCommerce' ) ) {
         return true;
       } else {
         return false;
       }
    }

    function get_product_count() {
      if ( class_exists( 'WooCommerce' ) ) {
         $productCount = wp_count_posts('product')->publish;
       } else {
         $productCount = "0";
       }
      return (int)$productCount;
    }

    function get_post_count() {
      $postCount = wp_count_posts('post')->publish;
      return (int)$postCount;
    }

    function show_currency_symbol( ) {
      if ( !function_exists( 'get_woocommerce_currency_symbol' ) ) {
        return '';
      }
      global  $woocommerce;
      $code= get_woocommerce_currency_symbol();
      return '<span>'.$code.'</span>';
    }

    function gutenberg_my_block_init() {
      register_meta( 'post', '_regular_price', array(
        'show_in_rest' => true,
      ));
      register_meta( 'post', 'currency_symbol', array(
        'show_in_rest' => true,
      ));

      //Adding align full width for blocks
      add_theme_support( 'align-wide' );
    }

    function hex2rgb( $colour ) {
      if ( $colour[0] == '#' ) {
        $colour = substr( $colour, 1 );
      }
      if ( strlen( $colour ) == 6 ) {
        list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
      } elseif ( strlen( $colour ) == 3 ) {
        list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
      } else {
        return false;
      }
      $r = hexdec( $r );
      $g = hexdec( $g );
      $b = hexdec( $b );
      return array( 'red' => $r, 'green' => $g, 'blue' => $b );
    }

    function object_to_array_ive($obj) {
      if(is_object($obj)) $obj = (array) $obj;
      if(is_array($obj)) {
        $new = array();
        foreach($obj as $key => $val) {
          $new[$key] = $this->object_to_array_ive($val);
        }
      }
      else $new = $obj;
      return $new;
    }

    public function post_slider_layout_render_post_grid( $attributes ) {

      $noAjax = isset( $_POST['isAjax'] ) ? true : false;

      $page_id  = get_the_ID();

      $wraper_before = $wraper_after = $post_loop = '';

      if ( isset( $attributes['post_type'] ) && $attributes['post_type'] !== 'post' ) {
        if( isset( $attributes['categories'] ) && $attributes['categories'] != '' && $attributes['categories'] != 'all' ) {
          $args = array(
            'post_type' => $attributes['post_type'],
            'tax_query' => array(
              array(
                'taxonomy'          => 'product_cat',
                'field'             => 'term_id',
                'terms'             => $attributes['categories'],
                'include_children'  => true
              )
            ),
            'posts_per_page' => $attributes['postscount']
          );
        } else {
          $args = array(
            'post_type'       =>  $attributes['post_type'],
            'posts_per_page'  =>  $attributes['postscount']
          );
        }
      } else {
        if( isset( $attributes['postcategories'] ) && $attributes['postcategories'] != '' ) {
          $args = array(
            'posts_per_page'  => $attributes['postscount'],
            'post_type'       => $attributes['post_type'],
            'cat'             => $attributes['postcategories']
          );
        } else {
          $args = array(
            'post_type'       =>  $attributes['post_type'],
            'cat'             =>  isset($attributes['postcategories']) ? $attributes['postcategories'] : '',
            'posts_per_page'  =>  $attributes['postscount']
          );
        }
      }

      if( !$noAjax ) {
        $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
        $args['paged'] = $paged ? $paged : 1;
      } else {
        $args['paged'] = sanitize_text_field( $_POST['paged'] );
      }


      $postss         = new \WP_Query( $args );
      $recent_posts   = $postss;

      if ( !$recent_posts->have_posts() ) {
        return;
      }

      $uniqueID = $attributes['uniqueID'];

      $className = isset($attributes['className']) ? $attributes['className'] : '';

      $stagePadding = $attributes['slideLoop'] ? $attributes['stagePadding'] : 0;
      $rewind = $attributes['rewind'] ? 'true' : 'false';
      $autoPLay = $attributes['autoPlay'] ? 'true' : 'false';
      $autoplayTimeOut = $attributes['autoPlay'] ? $attributes['autoplayTimeOut'] : 0;
      $autoplayHover = $attributes['autoplayHover'] ? 'true' : 'false';
      $autoplaySpeed = $attributes['autoplaySpeed'] == 0 ? 'false' : $attributes['autoplaySpeed'];
      $navigationSpeed = $attributes['navigationSpeed'] == 0 ? 'false' : $attributes['navigationSpeed'];
      $dotSpeed = $attributes['dotSpeed'] == 0 ? 'false' : $attributes['dotSpeed'];
      $slideLoop = $attributes['slideLoop'] ? 'true' : 'false';

      $opac =$attributes['contentOpacity']/100;
      $rgb = $this->hex2rgb($attributes['contentBackgroundColor']);

      $wraper_before .= '
      <style>
        .content_full_'.$uniqueID.' {
          background-color: rgba('.$rgb['red'].', '.$rgb['green'].', '.$rgb['blue'].', '.$opac.');
          padding: 20px;
          text-align: '.$attributes['align'].';
        }
        .ive-post-slider-parent'.$uniqueID.' {
          background-color: rgba('.$rgb['red'].', '.$rgb['green'].', '.$rgb['blue'].', '.$opac.');
        }
      ';


      if (
        isset( $attributes['displaySocialShareIcons'] ) &&
        (
          ( $attributes['displaySocialShareIcons'][0] == 'true' ) ||
          ( $attributes['displaySocialShareIcons'][1] == 'true' ) ||
          ( $attributes['displaySocialShareIcons'][2] == 'true' )
        )
      ) {

        $unit = 'px';
        $margintbdesk = isset($attributes['margintb'][2]) ? $attributes['margintb'][2].$unit : '5'.$unit;
        $marginlrdesk = isset($attributes['marginlr'][2]) ? $attributes['marginlr'][2].$unit : '5'.$unit;
        $margintbtab  = isset($attributes['margintb'][1]) ? $attributes['margintb'][1].$unit : '5'.$unit;
        $marginlrtab  = isset($attributes['marginlr'][1]) ? $attributes['marginlr'][1].$unit : '5'.$unit;
        $margintbmob  = isset($attributes['margintb'][0]) ? $attributes['margintb'][0].$unit : '5'.$unit;
        $marginlrmob  = isset($attributes['marginlr'][0]) ? $attributes['marginlr'][0].$unit : '5'.$unit;

        $alignType  = isset( $attributes['alignType'] ) ? $attributes['alignType'] : 'horizontal';
        $align = 'grid';
  			if( $alignType == 'horizontal' ){
  				$align = 'flex';
  			}

        $wraper_before .=  '
        #ive-posttype-carousel'.$uniqueID.' .ive-svg-icons-block {
          display: ' . $align . ';
        }
        #ive-posttype-carousel'.$uniqueID.' .ive-svg-icon-margin {
          margin: ' . $margintbdesk .' ' . $marginlrdesk . ';
        }
        ';

        // Check the visibility for desktop
        if ( $attributes['displaySocialShareIcons'][2] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 1025px ) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-svg-icons-block {
              display: none;
            }
          }
          ';
        }

        // Check the visibility for tablet
        if ( $attributes['displaySocialShareIcons'][1] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 768px) and (max-width: 1024px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-svg-icons-block {
              display: none;
            }
          }
          ';
        }

        // Check the visibility for mobile
        if ( $attributes['displaySocialShareIcons'][0] == 'false' ) {
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-svg-icons-block {
              display: none;
            }
          }
          ';
        }

        $wraper_before .=  '
        @media screen and (max-width: 767px) {
          #ive-posttype-carousel'.$uniqueID.' .ive-svg-icon-margin {
            margin: ' . $margintbtab . ' ' . $marginlrtab . ';
          }
        }
        @media screen and (min-width: 768px) and ( max-width: 1024px ) {
          #ive-posttype-carousel'.$uniqueID.' .ive-svg-icon-margin {
            margin: ' . $margintbmob . ' ' . $marginlrmob . ';
          }
        }
        ';

        $iconCount = $attributes['iconCount'];


        for ( $i=0; $i < $iconCount; $i++ ) {
          $icon = $attributes['icons'][$i];

          //classes
          $paddingClass = ' .ive_icon_parent_icon_padding' . $i;
          $sizeClass = ' .ive_icon_parent_icon_size' . $i;
          $hoverClass = ' .ive-svg-item-' . $i . ':hover .ive_icon_parent_icon_padding' . $i;
          $iconGradClass = ' .ive-svg-item-' . $i . ' .ive_icon_parent_icon_padding' . $i;
          $iconGradHoverClass = ' .ive-svg-item-' . $i . ':hover .ive_icon_parent_icon_padding' . $i;
          $defaultval = '0' . $unit;

          if ( isset( $icon['iconGrad'] ) ) {
            $gradRadPos         = isset( $icon['gradRadPos'] ) ? $icon['gradRadPos'] : '';
            $gradFirstColor     = isset( $icon['gradFirstColor'] ) ? $icon['gradFirstColor'] : '';
            $gradFirstLoc       = isset( $icon['gradFirstLoc'] ) ? $icon['gradFirstLoc']. '%' : '';
            $gradSecondColor    = isset( $icon['gradSecondColor'] ) ? $icon['gradSecondColor'] : '';
            $gradSecondLoc      = isset( $icon['gradSecondLoc'] ) ? $icon['gradSecondLoc'] .'%' : '';
            $gradAngle          = isset( $icon['gradAngle'] ) ? $icon['gradAngle'] .'deg' : '';
            $hovGradFirstColor  = isset( $icon['hovGradFirstColor'] ) ? $icon['hovGradFirstColor'] : '';
            $hovGradSecondColor = isset( $icon['hovGradSecondColor'] ) ? $icon['hovGradSecondColor'] : '';
            if( $icon['gradType'] === 'radial' ) {
  						$gradient = 'radial-gradient(at ' . $gradRadPos . ', ' . $gradFirstColor . ' ' . $gradFirstLoc . ' ' . $gradSecondColor . ' ' . $gradSecondLoc . ') !important';
  						$gradientHover = 'radial-gradient(at ' . $gradRadPos . ', ' . $hovGradFirstColor . ' ' . $gradFirstLoc . ' ' . $gradSecondColor . ' ' . $gradSecondLoc . ') !important';
  					} else {
  						$gradient = ' linear-gradient(' . $gradAngle . ', ' . $gradFirstColor . ' ' . $gradFirstLoc . ', ' . $gradSecondColor . ' ' . $gradSecondLoc . ' ) !important';
  						$gradientHover = 'linear-gradient(' . $gradAngle . ', ' . $hovGradFirstColor . ' ' . $gradFirstLoc . ', ' . $hovGradSecondColor . ' ' . $gradSecondLoc . ' ) !important';
  					}
          } else {
            $gradient = 'unset !important';
            $gradientHover = 'unset !important';
          }


          $wraper_before .=  '
           #ive-posttype-carousel' . $uniqueID . ' .ive-svg-item-' . $i . ' .ive_icon_parent_icon_padding' . $i . ' {
             background-image: ' . $gradient . ';
           }
           #ive-posttype-carousel' . $uniqueID . ' .ive-svg-item-' . $i . ':hover .ive_icon_parent_icon_padding' . $i . ' {
             background-image: ' . $gradientHover . ';
            }
          ';

          //desktop icon css
          $stylecon         = ( $icon['style'] == 'default' );
  				$background       = isset( $icon['background'] ) ? $icon['background'] : '#ffffff';
  				$backgroundColor  = $stylecon ? 'unset' : $background;
  				$border           = isset( $icon['border'] ) ? $icon['border'] : '#444444';
  				$borderColor      = $stylecon ? 'unset' : $border;
  				$bordWidth        = isset( $icon['borderWidth'] ) ? $icon['borderWidth'] : 2;
  				$borderWidth      = $stylecon ? $defaultval : $bordWidth.$unit;
  				$bordRadius       = isset( $icon['borderRadius'] ) ? $icon['borderRadius'] : 0;
  				$borderRadius     = $stylecon ? $defaultval : $bordRadius.$unit;

  				$deskpadding = isset($icon['deskpadding']) ? $icon['deskpadding'].$unit : '20'.$unit;
  				$deskpadding2 = isset($icon['deskpadding2']) ? $icon['deskpadding2'].$unit : '20'.$unit;
  				$paddingdesk = !$stylecon ? $deskpadding.' '.$deskpadding2 : 'unset' ;

  				$tabpadding = isset($icon['tabpadding']) ? $icon['tabpadding'].$unit : '16'.$unit;
  				$tabpadding2 = isset($icon['tabpadding2']) ? $icon['tabpadding2'].$unit : '16'.$unit;
  				$paddingtab = !$stylecon ? $tabpadding.' '.$tabpadding2 : 'unset' ;

  				$mobpadding = isset($icon['mobpadding']) ? $icon['mobpadding'].$unit : '12'.$unit;
  				$mobpadding2 = isset($icon['mobpadding2']) ? $icon['mobpadding2'].$unit : '12'.$unit;
  				$paddingmob = !$stylecon ? $mobpadding . ' ' . $mobpadding2 : 'unset' ;

          $borderStyle = isset( $icon['borderStyle'] ) ? $icon['borderStyle'] : 'none';
          $icon_color  = isset( $icon['color'] ) ? $icon['color'] : '#444444';

          $wraper_before .=  '
          #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_padding' . $i . '{
            border-style:     ' . $borderStyle . ';
            color:            ' . $icon_color . ';
            background-color: ' . $backgroundColor . ';
            border-color:     ' . $borderColor . ';
            border-width:     ' . $borderWidth . ';
            border-radius:    ' . $borderRadius . ';
            line-height:      0;
          }
          ';

          $hoverBackground = ( !$stylecon && isset( $icon['hoverBackground'] ) ) ? $icon['hoverBackground'] : 'undefined';
          $hoverBorder = ( !$stylecon && isset( $icon['hoverBorder'] ) ) ? $icon['hoverBorder'] : 'undefined';
          $hoverColor  = isset( $icon['hoverColor'] ) ? $icon['hoverColor'] : '#eeeeee';

          //hover css
          $wraper_before .=  '
          #ive-posttype-carousel' . $uniqueID . ' .ive-svg-item-' . $i . ':hover .ive_icon_parent_icon_padding' . $i . ' {
            background:   ' . $hoverBackground . ';
            border-color: ' . $hoverBorder . ';
            color:        ' . $hoverColor . ';
          }
          ';

          $desksize  = isset( $icon['desksize'] ) ? $icon['desksize'] . $unit : '50' . $unit;

          $wraper_before .=  '
          #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_size' . $i . ' {
            font-size:  ' . $desksize . ';
          }
          ';

          $icon_deskwidth  = ( isset( $icon['deskwidth'] ) && $icon['deskwidth'] != 0 ) ? $icon['deskwidth'] . $unit : 'auto';
          $icon_deskheight = ( isset( $icon['deskheight'] ) && $icon['deskheight'] != 0 ) ? $icon['deskheight'] . $unit : 'auto';
          $wraper_before .=  '
          #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_padding' . $i . ' {
            padding:  ' . $paddingdesk . ';
            width:    ' . $icon_deskwidth . ';
            height:   ' . $icon_deskheight . ';
          }
          ';


          $icon_tabsize = isset( $icon['tabsize'] ) ? $icon['tabsize'] . $unit : '35' . $unit;
          $icon_tabwidth = ( isset( $icon['tabwidth'] ) && $icon['tabwidth'] != 0 ) ? $icon['tabwidth'] . $unit : 'auto';
          $icon_tabheight  = ( isset( $icon['tabheight'] ) && $icon['tabheight'] != 0 ) ? $icon['tabheight'] . $unit : 'auto';
          //tablet icon css
          $wraper_before .=  '
          @media screen and ( min-width: 768px ) and ( max-width: 1024px ) {
            #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_size' . $i . ' {
              font-size:  ' . $icon_tabsize . ';
            }
            #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_padding' . $i . ' {
              padding:  ' . $paddingtab . ';
              width:    ' . $icon_tabwidth . ';
              height:   ' . $icon_tabheight . ';
            }
          }
          ';

          $icon_mobsize  = isset( $icon['mobsize'] ) ? $icon['mobsize'] . $unit : '20' . $unit;
          $icon_mobwidth = ( isset( $icon['mobwidth'] ) && ( $icon['mobwidth'] != 0 ) ) ? $icon['mobwidth'] . $unit : 'auto';
          $icon_mobheight  = ( isset( $icon['mobheight'] ) && $icon['mobheight'] != 0 ) ? $icon['mobheight'] . $unit : 'auto';
          //mobile icon css
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_size' . $i . ' {
              font-size:  ' . $icon_mobsize . ';
            }
            #ive-posttype-carousel' . $uniqueID . ' .ive_icon_parent_icon_padding' . $i . ' {
              padding:  ' . $paddingmob . ';
              width:    ' . $icon_mobwidth . ';
              height:   ' . $icon_mobheight . ';
            }
          }
          ';
        }
      }

      if ( isset( $attributes['layoutType'] ) ) {
        if ( ( ( $attributes['layoutType'][0] == 'column' ) || ( $attributes['layoutType'][0] == 'column-reverse' ) ) && ( $attributes['columns'] == 1 ) ) {
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel'.$uniqueID.' .ive-shortcodes-wrap {
              display: flex;
              margin: 2% auto auto;
            }
            .ive-shortcodes-wrap > div {
              margin: 1% auto;
            }
          }';
        } else {
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel'.$uniqueID.' .ive-shortcodes-wrap {
              text-align: center;
              margin: 2% auto auto;
            }
            .ive-shortcodes-wrap > div {
              margin: 1% auto;
            }
          }';
        }


        if ( ( ( $attributes['layoutType'][1] == 'column' ) || ( $attributes['layoutType'][1] == 'column-reverse' ) ) && ( $attributes['columns'] == 1 ) ) {
          $wraper_before .=  '
          @media screen and (min-width: 768px) and (max-width: 1024px) {
            #ive-posttype-carousel'.$uniqueID.' .ive-shortcodes-wrap {
              display: flex;
              margin: 2% auto auto;
            }
            .ive-shortcodes-wrap > div {
              margin: 1% auto;
            }
          }';
        } else {
          $wraper_before .=  '
          @media screen and (min-width: 768px) and (max-width: 1024px) {
            #ive-posttype-carousel'.$uniqueID.' .ive-shortcodes-wrap {
              text-align: center;
              margin: 2% auto auto;
            }
            .ive-shortcodes-wrap > div {
              margin: 1% auto;
            }
          }';
        }


        if ( ( ( $attributes['layoutType'][2] == 'column' ) || ( $attributes['layoutType'][2] == 'column-reverse' ) ) && ( $attributes['columns'] == 1 ) ) {
          $wraper_before .=  '
          @media screen and (min-width: 1025px) {
            #ive-posttype-carousel'.$uniqueID.' .ive-shortcodes-wrap {
              display: flex;
              margin: 2% auto auto;
            }
            .ive-shortcodes-wrap > div {
              margin: 1% auto;
            }
          }';
        } else {
          $wraper_before .=  '
          @media screen and (min-width: 1025px) {
            #ive-posttype-carousel'.$uniqueID.' .ive-shortcodes-wrap {
              text-align: center;
              margin: 2% auto auto;
            }
            .ive-shortcodes-wrap > div {
              margin: 1% auto;
            }
          }';
        }

      }



      if ( isset( $attributes['isWishlistBtnEnabled'] ) ) {
        // Check the visibility for desktop
        if ( $attributes['isWishlistBtnEnabled'][2] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 1025px ) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-wishlist-wrap {
              display: none !important;
            }
          }
          ';
        }

        // Check the visibility for tablet
        if ( $attributes['isWishlistBtnEnabled'][1] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 768px) and (max-width: 1024px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-wishlist-wrap {
              display: none !important;
            }
          }
          ';
        }

        // Check the visibility for mobile
        if ( $attributes['isWishlistBtnEnabled'][0] == 'false' ) {
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-wishlist-wrap {
              display: none !important;
            }
          }
          ';
        }


        if ( $attributes['isWishListTypoEnabled'] === true ) {
          $wishBtnTypography =  ( $attributes['wishBtnTypography'] !== '' ) ? $attributes['wishBtnTypography'] : 'Open+Sans';
          $wishBtnTypography = str_replace( " ", "+", $wishBtnTypography );

          $wishBtnFontWeight = isset( $attributes['wishBtnFontWeight'] ) ? $attributes['wishBtnFontWeight'] : 400;

          $wishBtnFontStyle  =  isset( $attributes['wishBtnFontStyle'] ) ? $attributes['wishBtnFontStyle'] : '';

          $wraper_before .= '
          #ive-posttype-carousel' . $uniqueID . ' .ive-wishlist-wrap {
            letter-spacing: ' . $attributes['wishBtnLetterSpacing'] . 'px;
            text-transform: ' . $attributes['wishBtnTextTransform'] . ';
            font-family:    ' . $wishBtnTypography . ';
            font-weight:    ' . $wishBtnFontWeight . ';
            font-style:     ' . $wishBtnFontStyle . ';
          }
          ';
        }

      }


      if ( isset( $attributes['isProductCompareEnabled'] ) ) {
        // Check the visibility for desktop
        if ( $attributes['isProductCompareEnabled'][2] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 1025px ) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-compare-wrap {
              display: none !important;
            }
          }
          ';
        }

        // Check the visibility for tablet
        if ( $attributes['isProductCompareEnabled'][1] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 768px) and (max-width: 1024px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-compare-wrap {
              display: none !important;
            }
          }
          ';
        }

        // Check the visibility for mobile
        if ( $attributes['isProductCompareEnabled'][0] == 'false' ) {
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-compare-wrap {
              display: none !important;
            }
          }
          ';
        }


        if ( $attributes['isCompareBtnTypoEnabled'] === true ) {
          $compareBtnTypography =  ( $attributes['compareBtnTypography'] !== '' ) ? $attributes['compareBtnTypography'] : 'Open Sans';
          $compareBtnTypography_url = str_replace( " ", "+", $compareBtnTypography );

          $compareBtnFontWeight = isset( $attributes['compareBtnFontWeight'] ) ? $attributes['compareBtnFontWeight'] : 400;

          $compareBtnFontStyle  =  isset( $attributes['compareBtnFontStyle'] ) ? $attributes['compareBtnFontStyle'] : '';

          $wraper_before .= '
          #ive-posttype-carousel' . $uniqueID . ' .ive-compare-wrap {
            letter-spacing: ' . $attributes['compareBtnLetterSpacing'] . 'px;
            text-transform: ' . $attributes['compareBtnTextTransform'] . ';
            font-family:    ' . $compareBtnTypography . ';
            font-weight:    ' . $compareBtnFontWeight . ';
            font-style:     ' . $compareBtnFontStyle . ';
          }
          ';
        }
      }


      if ( isset( $attributes['isQuickViewEnabled'] ) ) {
        // Check the visibility for desktop
        if ( $attributes['isQuickViewEnabled'][2] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 1025px ) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-quickview-wrap {
              display: none !important;
            }
          }
          ';
        }

        // Check the visibility for tablet
        if ( $attributes['isQuickViewEnabled'][1] == 'false' ) {
          $wraper_before .=  '
          @media screen and (min-width: 768px) and (max-width: 1024px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-quickview-wrap {
              display: none !important;
            }
          }
          ';
        }

        // Check the visibility for mobile
        if ( $attributes['isQuickViewEnabled'][0] == 'false' ) {
          $wraper_before .=  '
          @media screen and (max-width: 767px) {
            #ive-posttype-carousel' . $uniqueID . ' .ive-quickview-wrap {
              display: none !important;
            }
          }
          ';
        }


        if ( $attributes['isQuickViewBtnTypoEnabled'] === true ) {
          $quickViewBtnTypography =  ( $attributes['quickViewBtnTypography'] !== '' ) ? $attributes['quickViewBtnTypography'] : 'Open Sans';
          $quickViewBtnTypography_url = str_replace( " ", "+", $quickViewBtnTypography );

          $quickViewBtnFontWeight = isset( $attributes['quickViewBtnFontWeight'] ) ? $attributes['quickViewBtnFontWeight'] : 400;

          $quickViewBtnFontStyle  =  isset( $attributes['quickViewBtnFontStyle'] ) ? $attributes['quickViewBtnFontStyle'] : '';

          $wraper_before .= '
          #ive-posttype-carousel' . $uniqueID . ' .ive-quickview-wrap * {
            letter-spacing: ' . $attributes['quickViewBtnLetterSpacing'] . 'px;
            text-transform: ' . $attributes['quickViewBtnTextTransform'] . ';
            font-family:    ' . $quickViewBtnTypography . ';
            font-weight:    ' . $quickViewBtnFontWeight . ';
            font-style:     ' . $quickViewBtnFontStyle . ';
          }
          ';
        }
      }


      // Pagination CSS Starts Here
      include IVE_DIR . 'dist/post/pagination-css.php';
      // Pagination CSS Ends Here


      // Card Border CSS STARTS HERE
      $wraper_before .= '#ive-posttype-carousel' . $uniqueID . ' .post-content-area,
      #ive-posttype-carousel' . $uniqueID . ' .full-width-banner-slider-inner-item {
        border-style:               ' . $attributes['cardNormalBorderType'] . ';
        border-top-width:           ' . $attributes['cardNormalBorderTop'] . 'px;
        border-right-width:         ' . $attributes['cardNormalBorderRight'] . 'px;
        border-bottom-width:        ' . $attributes['cardNormalBorderBottom'] . 'px;
        border-left-width:          ' . $attributes['cardNormalBorderLeft'] . 'px;
        border-color:               ' . $attributes['cardNormalBorderColor'] . ';
        border-top-left-radius:     ' . $attributes['cardBorderRadiusTop'] . $attributes['cardBorderRadiustype'] . ';
        border-top-right-radius:    ' . $attributes['cardBorderRadiusRight'] . $attributes['cardBorderRadiustype'] . ';
        border-bottom-right-radius: ' . $attributes['cardBorderRadiusBottom'] . $attributes['cardBorderRadiustype'] . ';
        border-bottom-left-radius:  ' . $attributes['cardBorderRadiusLeft'] . $attributes['cardBorderRadiustype'] . ';
      }
      ';
      $wraper_before .= '#ive-posttype-carousel' . $uniqueID . ' .post-content-area:hover,
      #ive-posttype-carousel' . $uniqueID . ' .full-width-banner-slider-inner-item:hover {
        border-style:         ' . $attributes['cardHoverBorderType'] . ';
        border-top-width:     ' . $attributes['cardHoverBorderTop'] . 'px;
        border-right-width:   ' . $attributes['cardHoverBorderRight'] . 'px;
        border-bottom-width:  ' . $attributes['cardHoverBorderBottom'] . 'px;
        border-left-width:    ' . $attributes['cardHoverBorderLeft'] . 'px;
        border-color:         ' . $attributes['cardHoverBorderColor'] . ';
      }
      ';
      // Card Border CSS ENDS HERE


      $wraper_before .=  '</style>';


      $widthClass = ( isset( $attributes['postBlockWidth'] ) && $attributes['postBlockWidth'] ) ? 'align' . $attributes['postBlockWidth'] : '';

      $item_col_Class[1]='col-md-12 col-sm-12 col-lg-12 col-12';
      $item_col_Class[2]='col-md-6 col-sm-12 col-lg-6 col-12';
      $item_col_Class[3]='col-md-4 col-sm-6 col-lg-4 col-12';
      $item_col_Class[4]='col-md-4 col-sm-6 col-lg-3 col-12';
      $item_col_Class[5]='col-md-4 col-sm-6 col-lg-3 col-12';
      $item_col_Class[6]='col-md-4 col-sm-6 col-lg-3 col-12';

      if ($attributes['post_type']  == 'post') {

        $is_grid = false;
        if( $attributes['postLayout'] == 'carousel' ) {
          if( $attributes['navbtntype'] == 'icon' ) {
            $dataprev = json_encode( $attributes['navTextPrevicon'] );
            $datanext = json_encode( $attributes['navTextNexticon'] );
          } else {
            $dataprev= $attributes['navTextPrev']; $datanext= $attributes['navTextNext'];
          }

          $wraper_before .=  '<div id="ive-posttype-carousel'.$uniqueID.'" class="ive-carousel-content-wrap ive-product-slider-hidden owl-theme owl-carousel '.$className.' align'.$attributes['postBlockWidth'].'" data-unique='.$uniqueID.' data-margin='.$attributes['slideMargin'].' data-stagePadding='.$stagePadding.' data-rewind='.$rewind.' data-autoplay='.$autoPLay.'
          data-autoplayTimeout='.$autoplayTimeOut.' data-autoplayHoverPause='.$autoplayHover.' data-autoplaySpeed='.$autoplaySpeed.' data-navSpeed='.$navigationSpeed.' data-dotsSpeed='.$dotSpeed.' data-loop='.$slideLoop.' data-responsive-desk='.$attributes['deskslideItems'].' data-responsive-tab='.$attributes['tabslideItems'].' data-responsive-mob='.$attributes['mobslideItems'].' data-navtextprev='.$dataprev.' data-navtextnext='.$datanext.' data-navbtntype="'.$attributes['navbtntype'].'">';
        } else {
          $is_grid  =   true;
          $wraper_before   .=  '<div id="ive-posttype-carousel' . $uniqueID . '" class="ive-posttype-carousel' . $uniqueID . ' ' . $className . ' ' . $widthClass . ' ive-block-wrapper">';
          $wraper_before   .=  '<div class="row ' . $className . '">';
        }


        while ( $recent_posts->have_posts() ): $recent_posts->the_post();

          $post_id  = get_the_ID();
          $post     = $this->object_to_array_ive( get_post( $post_id ) );

          $categories = get_the_category();

          $comment_count = $post['comment_count'];

          $post_thumbnail_id = get_post_thumbnail_id( $post_id );
          $attachment_image_id = $post_thumbnail_id !== 0 ? wp_get_attachment_image_src( $post_thumbnail_id, '' . $attributes['postImageSizes'] . '', false )[0] : '';

          $gridView = $attributes['postLayout'] == 'grid' ? 'post-item mb-3 ive-column-' . $attributes['columns'] . ' ive-post-slider-parent' . $uniqueID . ' ' . $item_col_Class[$attributes['columns']] . '' : 'post-item ive-post-slider-parent' . $uniqueID . ' mb-3';
          $image    = $attributes['post_type'] == 'attachment' ? $post['guid'] : $attachment_image_id;

          $hasImage         = $image ? 'has-image' : '';
          $contentHasImage  = $image ? 'content-has-image' : '';

          // start the post-item wrap
          $post_loop .=  sprintf(
            '<div class="%1$s %2$s">',
            esc_attr( $gridView ),
            $attributes['carouselLayoutStyle']
          );

          // start the post content wrap
          $post_loop .=  '<div class="post-content-area ' . $attributes['align'] . ' ' . $hasImage . '">';

          if ( $attributes['displayPostImage'] && $image ) {
            $post_loop .= sprintf(
              '<div class="post-image">
                <a href="%1$s" target="_blank" rel="bookmark">
                  <img src="%2$s"/>
                </a>
                <div class="ive_latest_post_date_img">
                  <i class="fas fa-calendar-alt"></i>
                  <time class="post-meta-content" datetime="%3$s">%4$s</time>
                </div>
              </div>',
              esc_url( get_permalink( $post_id ) ),
              $image,
              esc_attr( get_the_date( 'c', $post_id ) ),
              esc_html( get_the_date( $attributes['postDateFormat'], $post_id ) )
            );
          }

          // start the inner post content wrap
          $post_loop .=  '<div class="ive-inner-post-content ' . $contentHasImage . ' text-xl-' . $attributes['postdeskalign'] . ' text-lg-' . $attributes['postdeskalign'] . ' text-sm-' . $attributes['posttabalign'] . ' text-' . $attributes['postmobalign'] . '">';

          // start the post meta wrap
          $post_loop .= '<div class="post-meta row">';

          if ( isset( $attributes['displayPostAuthor'] ) && $attributes['displayPostAuthor'] && $attributes['carouselLayoutStyle'] !== 'g_skin2' ) {
            $post_loop .=  '<div class="ive_latest_post_author col-md-4 text-xl-' . $attributes['postdeskalign'] . ' text-lg-' . $attributes['postdeskalign'] . ' text-sm-' . $attributes['posttabalign'] . ' text-' . $attributes['postmobalign'] . '">';
            $post_loop .=  sprintf(
              '<i class="fas fa-user"></i><a class="post-meta-content" target="_blank" href="%2$s">%1$s</a>',
              esc_html( get_the_author_meta( 'display_name', $post['post_author'] ) ),
              esc_url( get_author_posts_url( get_author_posts_url( $post['post_author'] ) ) )
            );
            $post_loop .=  "</div>";
          }

          if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
            $post_loop .=  '<div class="ive_latest_post_date col-md-4  text-xl-' . $attributes['postdeskalign'] . ' text-lg-' . $attributes['postdeskalign'] . ' text-sm-' . $attributes['posttabalign'] . ' text-' . $attributes['postmobalign'] . '">';
            $post_loop .=  sprintf(
              '<i class="fas fa-calendar-alt"></i><time class="post-meta-content" datetime="%1$s">%2$s</time>',
              esc_attr( get_the_date( 'c', $post_id ) ),
              esc_html( get_the_date( $attributes['postDateFormat'], $post_id ) )
            );
            $post_loop .=  "</div>";
          }

          if ( isset( $attributes['displayComment'] ) && $attributes['displayComment'] ) {
            $comment_text =   $attributes['CommentText'] ? $attributes['CommentText'] : '';
            $post_loop       .=  '<div class="ive_latest_post_comments col-md-4  text-xl-' . $attributes['postdeskalign'] . ' text-lg-' . $attributes['postdeskalign'] . ' text-sm-' . $attributes['posttabalign'] . ' text-' . $attributes['postmobalign'] . '">';
            $post_loop       .=  sprintf(
              '<i class="fas fa-comments"></i><span class="post-meta-content">%1$s</span>',
              esc_attr( $comment_count )
            );
            $post_loop .=  sprintf(
              '<span class="post-meta-content comment-text">%s</span>',
              esc_attr( $comment_text )
            );
            $post_loop .=  "</div>";
          }

          $post_loop .=  '</div>';
          // close the post meta wrap

          if ( isset($attributes['displayPostCategory']) && $attributes['displayPostCategory'] ) {
            $post_category = '';
            if (count($categories) > 0) {

              if (count($categories) > 1) {
                foreach ( $categories as $category ) {
    
    
                  if ($category->name !== 'Uncategorized') {
                    $post_category = $category->name;
                    break;
                  }
                }
              } else {
                
                $first_category = $categories[0];
                $post_category = $first_category->name;
              }
            }

            $post_loop .=  sprintf('<div class="blog-category">
                %1$s
              </div>',
              $post_category
            );
          }

          // start the post title wrap
          $post_loop .=  sprintf(
            '<h2 class="post-title text-xl-' . $attributes['postdeskalign'] . ' text-lg-' . $attributes['postdeskalign'] . ' text-sm-' . $attributes['posttabalign'] . ' text-' . $attributes['postmobalign'] . '"><a href="%1$s" target="_blank" rel="bookmark">%2$s</a></h2>',
            esc_url( get_permalink( $post_id ) ),
            esc_html( get_the_title( $post_id ) )
          );
          // close the post title wrap

          // start the post excerpt wrap
          $content  = get_the_excerpt( $post_id );
          $excerpt  = substr( $content, 0, $attributes['content_excerpt'] );
          $result   = substr( $content, 0, strrpos( $excerpt, ' ' ) );

          if ( $content && $attributes['displayPostExcerpt'] && $attributes['carouselLayoutStyle'] !== 'g_skin1' && $attributes['carouselLayoutStyle'] !== 'g_skin2' ) {
            $post_loop .= sprintf(
              ' <div class="post-excerpt text-xl-' . $attributes['postdeskalign'] . ' text-lg-' . $attributes['postdeskalign'] . ' text-sm-' . $attributes['posttabalign'] . ' text-' . $attributes['postmobalign'] . '"><p>%1$s</p></div>',
              wp_kses_post( $result )
            );
          }
          // close the post excerpt wrap

          // Start Social Share Icons Wrap
          include IVE_DIR . 'dist/post/social-share.php';
          // End Social Share Icons Wrap

          // start the post read more wrap
          if ( isset( $attributes['displayPostReadMoreButton'] ) && $attributes['displayPostReadMoreButton'] && $attributes['carouselLayoutStyle'] !== 'g_skin1' && $attributes['gridLayoutStyle'] !== 'g_skin2' ) {
            $post_loop .= sprintf(
              '<div class="ive-pt-btn post-read-more-parent ibtana_cart_button_'.$uniqueID.' text-xl-'.$attributes['postdeskalign'].' text-lg-'.$attributes['postdeskalign'].' text-sm-'.$attributes['posttabalign'].' text-'.$attributes['postmobalign'].'">
                <a class="post-read-more" href="%1$s" target="_blank" rel="bookmark">
                  <i class="%3$s ive-posttype-icon-align-left"></i>
                  <span class="ive-posttype-text-display">%2$s</span>
                  <i class="%4$s ive-posttype-icon-align-right"></i>
                </a>
              </div>',
              esc_url( get_permalink( $post_id ) ),
              esc_html( $attributes['postReadMoreButtonText'] ),
              esc_html( $attributes['buttonIconName'] ),
              esc_html( $attributes['buttonIconName2'] )
            );
          }
          // close the post read more wrap

          $post_loop .= '</div>';
          $post_loop .= '<div class="ive-overlay-effect"></div>';
          $post_loop .= '</div>';
          $post_loop .= '</div>';
        endwhile;

        $wraper_after .=  '</div>';


        if ( $is_grid ) {

          include IVE_DIR . 'dist/post/pagination.php';

          $wraper_after .= '</div>';
        }

      } elseif( $attributes['post_type'] == 'product' ) {

        $is_grid = false;
        if( $attributes['postLayout'] == 'carousel' ) {
          if( $attributes['navbtntype']=='icon' ) {
            $dataprev = json_encode( $attributes['navTextPrevicon'] );
            $datanext = json_encode( $attributes['navTextNexticon'] );
          } else {
            $dataprev= $attributes['navTextPrev']; $datanext= $attributes['navTextNext'];
          }

          $wraper_before .= '<div id="ive-posttype-carousel'.$uniqueID.'" class="ive-carousel-content-wrap ive-product-slider-hidden owl-theme owl-carousel ive-product-slider woo-prd-slider'.$uniqueID.' '.$className.' align'.$attributes['postBlockWidth'].'" data-unique='.$uniqueID.' data-margin='.$attributes['slideMargin'].' data-stagePadding='.$stagePadding.' data-rewind='.$rewind.' data-autoplay='.$autoPLay.'data-autoplayTimeout='.$autoplayTimeOut.' data-autoplayHoverPause='.$autoplayHover.' data-autoplaySpeed='.$autoplaySpeed.' data-navSpeed='.$navigationSpeed.' data-dotsSpeed='.$dotSpeed.' data-loop='.$slideLoop.' data-responsive-desk='.$attributes['deskslideItems'].' data-responsive-tab='.$attributes['tabslideItems'].' data-responsive-mob='.$attributes['mobslideItems']. ' data-navtextprev='.$dataprev.' data-navtextnext='.$datanext.' data-navbtntype="'.$attributes['navbtntype'].'">';
        } else {
          $is_grid = true;
          $wraper_before .=  '<div id="ive-posttype-carousel'.$uniqueID.'" class="ive-posttype-carousel'.$uniqueID.' ' . $className . ' ' . $widthClass . ' ive-block-wrapper">';
          $wraper_before .=  '<div class="row '.$className.'">';
        }


        while ( $recent_posts->have_posts() ): $recent_posts->the_post();

          $post_id  = get_the_ID();
          $post     = $this->object_to_array_ive( get_post( $post_id ) );

          $post_thumbnail_id = get_post_thumbnail_id( $post_id );

          $gridView = $attributes['postLayout'] == 'grid' ? 'slider-product-item mb-3 ive-column-'.$attributes['columns'].' ive-product-slider-parent'.$uniqueID.' '.$item_col_Class[$attributes['columns']].' ' : 'slider-product-item ive-product-slider-parent'.$uniqueID.' mb-3';

          $post_loop .= sprintf(
            '<div class="%1$s">',
            esc_attr( $gridView )
          );
          $post_loop        .=  '<div class="full-width-banner-slider-inner-item">';
          $image            =   $attributes['post_type'] == 'attachment' ? $post['guid'] : ( $post_thumbnail_id !== 0 ? wp_get_attachment_image_src( $post_thumbnail_id, '' . $attributes['postImageSizes'] . '', false )[0] : '' );
          $hasImage         =   $image ? 'has-image' : '';
          $contentHasImage  =   $image ? 'content-has-image' : '';
          if ( $attributes['iconposTop'] ) {
            $cartoptop  =   '';
            $cartoptop  .=  '<div class="icon-button-top ibtana-product-cart-but-top'.$uniqueID.'">';
            $cartoptop  .=  '<a href="?add-to-cart='.$post_id.'" data-quantity="1" class="ive-pt-btn button product_type_simple add_to_cart_button ajax_add_to_cart ibtana_cart_button_' . $uniqueID . '" style="display: inline-block !important;" data-product_id=' . $post_id . ' data-product_sku="" rel="nofollow">
                              <i class="' . $attributes['buttonIconName'] . ' ive-posttype-icon-align-left"></i>
                              <span class="ive-posttype-text-display">' . $attributes['postReadMoreButtonText'] . '</span>
                              <i class="' . $attributes['buttonIconName2'] . ' ive-posttype-icon-align-right"></i>
                            </a>';
            $cartoptop .='</div>';
          } else {
            $cartoptop='';
          }
          if ( $attributes['displayPostImage'] && $image ) {
            $post_loop .=
            '<div class="woo-prod-img"><a href="' . esc_url( get_permalink( $post_id ) ) . '" target="_blank" rel="bookmark"><img src="' . $image . '"/></a>
            '.$cartoptop.'
            </div>';
          }
          $product = wc_get_product( $post_id );
          if ( $product->is_on_sale() ) {
            $span_class_onsale_esc_html_sale_woocommerce_span = apply_filters(
              'woocommerce_sale_flash',
              '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>',
              $post,
              $product
            );

            if ( !empty( $span_class_onsale_esc_html_sale_woocommerce_span ) ) {
               $post_loop .= $span_class_onsale_esc_html_sale_woocommerce_span ;
            }
          }

          $post_loop  .=  '<div class="woo-prod-content text-xl-' . $attributes['postdeskalign'] . ' text-xl-' . $attributes['productdeskalign'] . ' text-lg-' . $attributes['productdeskalign'] . ' text-sm-' . $attributes['producttabalign'] . ' text-' . $attributes['productmobalign'] . '">';
          $post_loop  .=  '<div class="full_content content_full_' . $uniqueID . '">';
          $post_loop  .=  '<div class="ibtana-product-title ibtana-product-name-' . $uniqueID . ' text-xl-' . $attributes['productdeskalign'] . ' text-lg-' . $attributes['productdeskalign'] . ' text-sm-' . $attributes['producttabalign'] . ' text-' . $attributes['productmobalign'] . '">';
          $post_loop  .=  '<a class="product-title-link" href="' . esc_url( get_permalink( $post_id ) ) . '" target="_blank" rel="bookmark">';
          if ( $attributes['showproductName'] ) {
            $post_loop .=  '<h6 class="ibtana-product-title-child">';
            $post_loop .=  esc_html( get_the_title( $post_id ) );
            $post_loop .=  '</h6>';
          }
          $post_loop .=  '</a>';
          $post_loop .=  '</div>';

          $content  = get_the_excerpt( $post_id );
          $excerpt  = substr( $content, 0, $attributes['content_excerpt'] );
          $result   = substr( $content, 0, strrpos( $excerpt , ' ' ) );

          $post_loop .=  '<div class="ibtana-product-content ibtana-product-content-' . $uniqueID . ' text-xl-' . $attributes['productdeskalign'] . ' text-lg-' . $attributes['productdeskalign'] . ' text-sm-' . $attributes['producttabalign'] . ' text-' . $attributes['productmobalign'] . '">';
          $post_loop .=  '<p class="ibtana-product-content-child">' . $result . '</p>';
          $post_loop .=  '</div>';

          $sale_price     = get_post_meta( $post_id, '_sale_price', true );
          $regular_price  = get_post_meta( $post_id, '_regular_price', true );


          $post_loop .=  '<div class="price-tag ibtana-price-tag-' . $uniqueID . ' ibtana-product-justify-content-' . $uniqueID . '" >';
          $post_loop .=  '<div class="price-regular-sale-ibtana-parent">';
          if ( $regular_price !== '' && $attributes['showRegularPrice'] ) {
            if ( !$attributes['showSalePrice'] || $sale_price == '' ) {
              $post_loop .=  sprintf(
                "<div class='price-meta-regular-price'>%s%u</div>",
                $this->show_currency_symbol(),
                $regular_price
              );
            } else {
              $post_loop .=  sprintf(
                "<div class='price-meta-regular-price'><strike>%s%u</strike></div>",
                $this->show_currency_symbol(),
                $regular_price
              );
            }
          }
          if ( $sale_price !== '' && $attributes['showSalePrice'] ) {
            $post_loop .=  sprintf(
              "<div class='price-meta-sale-price'>%s%u</div>",
              $this->show_currency_symbol(),
              $sale_price
            );
          }
          $post_loop .=  '</div>';
          $post_loop .=  '</div>';
          if ( $attributes['israting'] ) {
            $post_loop    .=  '<div class="ibtana-product-review-parent ibtana-product-justify-content-' . $uniqueID . '">';
            $product      =   wc_get_product( $post_id);
            $rating_count =   $product->get_rating_count();
            if ( $average_rating = $product->get_average_rating() ) {
              $post_loop .=  '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $average_rating ) . '" data-rating-count="' . $rating_count . '"><span style="width:' . ( ( $average_rating / 5 ) * 100 ) . '%"></span></div>
              <div class="comment-value font-famrubik font-weight400">(' . $rating_count . ')</div>';
            }
            $post_loop .=  '</div>';
          }

          if ( !$attributes['iconposTop'] ) {
            $post_loop .=  '<div class="ibtana-product-cart-button ibtana-product-justify-content-' . $uniqueID . '">';
            $post_loop .=  '<a href="?add-to-cart=' . $post_id . '" data-quantity="1" class="ive-pt-btn button product_type_simple add_to_cart_button ajax_add_to_cart ibtana_cart_button_' . $uniqueID . '" data-product_id=' . $post_id . ' data-product_sku="" rel="nofollow">
                              <i class="' . $attributes['buttonIconName'] . ' ive-posttype-icon-align-left"></i>
                              <span class="ive-posttype-text-display">' . $attributes['postReadMoreButtonText'] . '</span>
                              <i class="' . $attributes['buttonIconName2'] . ' ive-posttype-icon-align-right"></i>
                            </a>';

            $post_loop .=   '</div>';
          }


          // Wishlist, compare, quick view wrap starts here
          $post_loop .=  '<div class="ive-shortcodes-wrap">';

          // Wishlist code starts here for product post type
          if ( isset( $attributes['isWishlistBtnEnabled'] ) && isset( $attributes['wishlistPlugin'] ) && ( $attributes['paginationType'] == 'pagination' ) ) {
            if ( ( $attributes['isWishlistBtnEnabled'][0] == 'true' ) || ( $attributes['isWishlistBtnEnabled'][1] == 'true' ) || ( $attributes['isWishlistBtnEnabled'][2] == 'true' ) ) {
              $post_loop .= '<div class="ive-wishlist-wrap">';
              if ( ( $attributes['wishlistPlugin'] == 'yith-woocommerce-wishlist' ) && shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
                $post_loop .= do_shortcode( '[yith_wcwl_add_to_wishlist product_id="'.$post_id.'"]' );
              } elseif ( ( $attributes['wishlistPlugin'] == 'ti-woocommerce-wishlist' ) && shortcode_exists( 'ti_wishlists_addtowishlist' ) ) {
                $post_loop .= do_shortcode( '[ti_wishlists_addtowishlist product_id="'.$post_id.'"]' );
              } elseif ( ( $attributes['wishlistPlugin'] == 'woosw' ) && shortcode_exists( 'woosw' ) ) {
                $post_loop .= do_shortcode( '[woosw id="'.$post_id.'"]' );
              }
              $post_loop .= '</div>';
            }
          }
          // Wishlist code ends here for product post type


          // Product Compare Code start
          if ( isset( $attributes['isProductCompareEnabled'] ) && isset( $attributes['productComparePlugin'] ) && ( $attributes['paginationType'] == 'pagination' ) ) {
            if ( ( $attributes['isProductCompareEnabled'][0] == 'true' ) || ( $attributes['isProductCompareEnabled'][1] == 'true' ) || ( $attributes['isProductCompareEnabled'][2] == 'true' ) ) {
              $post_loop .= '<div class="ive-compare-wrap">';
              if ( ( $attributes['productComparePlugin'] == 'yith-woocommerce-compare' ) && shortcode_exists( 'yith_compare_button' ) ) {
                $post_loop .= do_shortcode( '[yith_compare_button product=' . $post_id . ']' );
              } elseif ( ( $attributes['productComparePlugin'] == 'wooscp' ) && shortcode_exists( 'woosc' ) ) {
                $post_loop .= do_shortcode( '[woosc id="' . $post_id . '"]' );
              }
              $post_loop .= '</div>';
            }
          }
          // Product Compare Code end


          // Product QuickView Btn Code start
          if ( isset( $attributes['isQuickViewEnabled'] ) && isset( $attributes['quickViewPlugin'] ) && ( $attributes['paginationType'] == 'pagination' ) ) {
            if ( ( $attributes['isQuickViewEnabled'][0] == 'true' ) || ( $attributes['isQuickViewEnabled'][1] == 'true' ) || ( $attributes['isQuickViewEnabled'][2] == 'true' ) ) {
              $post_loop .= '<div class="ive-quickview-wrap">';
              if ( ( $attributes['quickViewPlugin'] == 'woosq' ) && shortcode_exists( 'woosq' ) ) {
                $post_loop .= do_shortcode( '[woosq id=' . $post_id . ']' );
              }
              $post_loop .= '</div>';
            }
          }
          // Product QuickView Btn Code end

          $post_loop .=  '</div>';
          // Wishlist, compare, quick view wrap ends here



          $post_loop .='</div>';
          $post_loop .='</div>';




          $post_loop .= '<div class="ive-overlay-effect">';
          $post_loop .= '</div>';


          $post_loop .='</div>';
          $post_loop .='</div>';

        endwhile;


        $wraper_after .=  '</div>';



        if ( $is_grid ) {

          include IVE_DIR . 'dist/post/pagination.php';

          $wraper_after .= '</div>';
        }

      }

      wp_reset_query();

      return $noAjax ? $post_loop : ( $wraper_before . $post_loop . $wraper_after );
    }
  }
  Ibtana_Visual_Editor_Pro_PostControl::get_instance();
?>
