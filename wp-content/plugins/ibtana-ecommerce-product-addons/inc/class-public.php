<?php

/**
 * IEPA blocks public class
 */
class IEPA_Blocks_Public {

	/** @var IEPA_Blocks_Public Instance */
	private static $_instance = null;

	/* @var string $token Plugin token */
	public $token;

	/* @var string $url Plugin root dir url */
	public $url;

	/* @var string $path Plugin root dir path */
	public $path;

	/* @var string $version Plugin version */
	public $version;
	private $product_description;

	/** @var string Gallery image size */
	protected $_gallery_image_size;

  protected $iepa_gallery_image_size;

	/**
	 * IEPA blocks public class instance
	 * @return IEPA_Blocks_Public instance
	 */
	public static function instance() {
		if ( null == self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor function.
	 * @access  private
	 * @since   1.0.0
	 */
	private function __construct() {
		// $this->token   = IEPA_Blocks::$token;
		// $this->url     = IEPA_Blocks::$url;
		// $this->path    = IEPA_Blocks::$path;
		// $this->version = IEPA_Blocks::$version;
	}

	// region IEPA product frontend setup
  public function iepa_setup_product_render() {
    add_action( 'iepa_render_product', 'the_content' );
		if ( class_exists( 'WooCommerce' ) ) {
			add_action( 'iepa_render_product', [ wc()->structured_data, 'generate_product_data' ] );
		}
  }

	/**
	 * Sets up IEPA for single product when enabled.
	 */
  public function maybe_setup_iepa_product() {
    if ( IEPA_Blocks::enabled() ) {
      if ( function_exists( 'gencwooc_single_product_loop' ) && has_action( 'genesis_loop', 'gencwooc_single_product_loop' ) ) {
        remove_action( 'genesis_loop', 'gencwooc_single_product_loop' );
        add_action( 'genesis_loop', [ $this, 'iepa_gencwooc_single_product_template' ] );
      }
      // Priority more than storefront pro 999
      add_filter( 'wc_get_template_part', array( $this, 'wc_get_template_part' ), 1001, 3 );
    }
  }

	public function iepa_gencwooc_single_product_template() {
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	}

	/**
	 * Adds front end stylesheet and js
	 * @action wp_enqueue_scripts
	 * @since 1.0.0
	 */
	public function wc_get_template_part( $template, $slug, $name ) {
		if (
			'content' == $slug &&
			'single-product' == $name
		) {
			return dirname( __FILE__ ) . '/tpl/iepa-single-product.php';
		}

		return $template;
	}

	// endregion IEPA product frontend setup

  public function iepa_register_blocks() {
    $iepa_blocks = IEPA_Blocks::iepa_blocks();

    foreach ( $iepa_blocks as $key => $block ) {
       $is_registered = register_block_type(
        str_replace( '_', '-', 'iepa/' . $key ),
        array(
        'category'        =>  esc_html__( 'Ibtana Blocks', 'ibtana-ecommerce-product-addons' ),
        'attributes'      =>  $block['attributes'],
        'apiVersion'      =>  2,
        'render_callback' =>  array( $this, 'render_' . str_replace( '-', '_', $key ) ),
        )
      );
    }

  }

  private function iepa_openWrap( $props, $class, $tag = 'div', $style = '' ) {

		if ( ! empty( $props['className'] ) ) {
			$class .= " $props[className]";
		}

		if ( ! empty( $props['text_align'] ) ) {
			$style .= "text-align:{$props['text_align']};";
		}

		if ( ! empty( $props['font_size'] ) ) {
			$style .= "font-size:{$props['font_size']}px;";
		}
		if ( ! empty( $props['font'] ) ) {
			$props['font'] = stripslashes( $props['font'] );
			$style         .= "font-family:{$props['font']};";
		}
		if ( ! empty( $props['text_color'] ) ) {
			$style .= "color:{$props['text_color']};";
		}
		if ( ! empty( $props['iepa_style'] ) ) {
			$class .= " ibtanaecommerceproductaddons-style-$props[iepa_style]";
		}

		if ( $style ) {
			$style = 'style="' . $style . '"';
		}

		return "<$tag class='ibtanaecommerceproductaddons-block ibtanaecommerceproductaddons-$class' $style>";
	}

  public function render_iepa_add_to_cart( $prop ) {
    $attributes = $prop;

    $className = isset( $attributes['className'] ) ? $attributes['className'] : '';

    global $product;
    if ( ! $product ) return '';

    ob_start();
    echo wp_kses_post( '<div class="iepa_add_to_cart' . $prop['uniqueID'] . ' ' . $className . '">' );
    woocommerce_template_single_add_to_cart();
    echo wp_kses_post( '</div>' );
    return ob_get_clean();
  }

  public function render_iepa_product_sale_countdown( $props ) {
		global $product;

		if ( ! $product ) return '';

		/** @var WC_Product $product */
		// Declare and define two dates
		$date_to_date = strtotime( $product->get_date_on_sale_to() );
    $date_from_date = strtotime( $product->get_date_on_sale_from() );

		$diff_to_date  = $date_to_date - time();
    $diff_from_date  = $date_from_date - time();

		if ( ! $diff_to_date || $diff_to_date < 5 ) {
			return '<div></div>';
		}

		$props = wp_parse_args( $props, [
			'active_color' => '#555',
			'track_color' => '#ddd',
			'track_width' => '2',
		] );


    $end_date = '';
    $html = '';

    if (!empty($date_from_date) && $date_from_date <= time()) {
      $end_date = $date_to_date;
      $html .= $this->sale_countdown_counter_html($diff_to_date, $props);
    }else {
      $diff_from_date  = $date_from_date - time();
      $days_from_date = floor( $diff_from_date / ( 60 * 60 * 24 ) );
      if ($days_from_date > 0) {
        $end_date = $date_from_date;
        $html .= $this->sale_countdown_counter_html($diff_from_date, $props);
      }
    }

    $uniqueID = isset($props['uniqueID']) ? $props['uniqueID'] : '';

		ob_start();

		echo ( $this->iepa_openWrap( $props, 'sale_counter_wrap'. ' iepa_sale_countdown' . $uniqueID ) );
		echo ( "<div class='ibtanaecommerceproductaddons-sale_counter' data-date-end='$end_date'>" );

		echo ( $html );

		echo ( '</div></div>' );

		return ob_get_clean();
	}

  public function sale_countdown_counter_html($diff_date, $props){

    $html = '';

    $days = floor( $diff_date / ( 60 * 60 * 24 ) );

    $hours = floor( $diff_date % (60 * 60 * 24) / ( 60 * 60 ) );

    $minutes = floor( $diff_date % (60 * 60) / 60 );

    $seconds = floor( $diff_date % 60 );

    $r = 15.9154; // 100/2PI
    $center = $r + $props['circleWidth'] / 2;

    $width = 2 * $center;


    $circle_attrs = "cx=$center cy=$center r='{$r}' stroke-width='{$props['circleWidth']}' " .
                    "style='transform-origin:50% 50%;transform:rotate(-90deg);' fill='none'";

    $format =
      '<div class="woob-timr woob-timr-%1$s">' .
      "<svg viewBox='0 0 $width $width'>" .
      "<circle $circle_attrs stroke='{$props['circleColor']}' />" .
      "<circle $circle_attrs stroke='{$props['arcColor']}' class='woob-timr-arc-%1\$s' />" .
      '</svg>' .
      '<div class="woob-timr-number-%1$s woob-timr-number">%3$s</div>' .
      '<div class="woob-timr-label">%4$s</div>' .
      '</div>';

    $html .= $days ? sprintf( $format, 'days', $days * 100 / 31, $days, _n( 'day', 'days', $days ) ) : '';

    $html .= sprintf( $format, 'hours', $hours * 100 / 24, $hours, _n( 'hour', 'hours', $hours ) );

    $html .= sprintf( $format, 'minutes', $minutes * 100 / 60, $minutes, _n( 'minute', 'minutes', $minutes ) );

    $html .= sprintf( $format, 'seconds', $seconds * 100 / 60, $seconds, _n( 'second', 'seconds', $seconds ) );

    return $html;
  }

  public function render_iepa_product_price( $props ) {

    $attributes=$prop=$props;
    $className = isset($attributes['className']) ? $attributes['className'] : '';

		global $product;

		if ( ! $product ) return '';

		return '<div class="iepa_product_price'.$prop['uniqueID'].' '.$className.'">' .
              $product->get_price_html() .
           '</div>';
	}

  public function render_iepa_product_meta( $props ) {
		global $product;

		if ( ! $product ) return '';

		ob_start();
		echo wp_kses_post( $this->iepa_openWrap( $props, 'meta' ) );
		$metadata = '';
    $metadata .=  "<div class='iepa_product_meta".$props['uniqueID']."'>";

		$sku      = $product->get_sku();
		if ( $sku ) {
			$metadata .= "<span class='ibtanaecommerceproductaddons-sku'>SKU: $sku</span> ";
		}
		$metadata .= wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'ibtana-ecommerce-product-addons' ) . ' ', '</span> ' );
		$metadata .= wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'ibtana-ecommerce-product-addons' ) . ' ', '</span> ' );

    $icons = $props['sharearr'];

    $metadata .= "<span class='ipea_icon_share_parent'>Share:";
    foreach ($icons as $key => $icon) {

      $metadata .= "<a class='iepa_icon_parent_".$key."' target='".$icon['target']."' rel='noopener' data-href='".$icon['link']."'><i class='".$icon['icon']."'></i></a>";
    }
    $metadata .= "</span>";
    $metadata .= "</div>";

		echo wp_kses_post( apply_filters( 'iepa_product_meta', $metadata ) );

		echo wp_kses_post( '</div>' );

		return ob_get_clean();
	}

  public function render_iepa_product_review( $props ) {

		global $product;

		if ( ! $product ) return '';

    $className            = isset($props['className']) ? $props['className'] : '';
    $fontSize             = isset($props['fontSize']) ? $props['fontSize'].'px' : '16px';
    $reviewFontSize       = isset($props['reviewFontSize']) ? $props['reviewFontSize'].'em' : '1em';
    $letterSpacing        = isset($props['letterSpacing']) ? $props['letterSpacing'].'px' : '0px';
    $textTransform        = isset($props['textTransform']) ? $props['textTransform'] : '';
    $textColor            = isset($props['colorTextReview']) ? $props['colorTextReview'] : '';
    $textHoverColor            = isset( $attr['reviewHoverColor'] ) ? $attr['reviewHoverColor'] : '';
    $reviewBgColor            = isset( $attr['reviewBgColor'] ) ? $attr['reviewBgColor'] : '';
    $reviewBgHovColor            = isset( $attr['reviewBgHovColor'] ) ? $attr['reviewBgHovColor'] : '';

    $typography           = (isset($props['typography']) && $props['typography'] !== '') ? $props['typography'] : 'Open+Sans';
    $tyochange            = str_replace(" ","+",$typography);
    $fontWeight           = isset($props['fontWeight']) ? $props['fontWeight'] : 400;
    $fontStyle            = isset($props['fontStyle']) ? $props['fontStyle'] : 'normal';

    $colorReview          = isset($props['colorReview']) ? $props['colorReview'] : '';
    $colorReviewHov       = isset($props['colorReviewHov']) ? $props['colorReviewHov'] : '';
    $colorReviewUnfilled  = isset($props['colorReviewUnfilled']) ? $props['colorReviewUnfilled'] : '';
    $colorHovUnfilled     = isset($props['colorHovUnfilled']) ? $props['colorHovUnfilled'] : '';
    $bgfirstcolorr        = isset($props['bgfirstcolorr']) ? $props['bgfirstcolorr'] : '';
    $bgSecondColr         = isset($props['bgSecondColr']) ? $props['bgSecondColr'] : '';
    $vBgImgPosition       = isset($props['vBgImgPosition']) ? $props['vBgImgPosition'] : '';
    $bgGradType           = isset($props['bgGradType']) ? $props['bgGradType'] : '';
    $bgGradAngle          = isset($props['bgGradAngle']) ? $props['bgGradAngle'] : '';
    $bgGradLocSecond      = isset($props['bgGradLocSecond']) ? $props['bgGradLocSecond'] : '';
    $bgGradLoc            = isset($props['bgGradLoc']) ? $props['bgGradLoc'] : '';
    $hovGradSecondColor   = isset($props['hovGradSecondColor']) ? $props['hovGradSecondColor'] : '';
    $hovGradFirstColor    = isset($props['hovGradFirstColor']) ? $props['hovGradFirstColor'] : '';
    $activeGradColor1     = isset($props['activeGradColor1']) ? $props['activeGradColor1'] : '';
    $activeGradColor2     = isset($props['activeGradColor2']) ? $props['activeGradColor2'] : '';
    $bggradColor          = isset($props['bggradColor']) ? $props['bggradColor'] : '';
    $hoverbggradColor     = isset($props['hoverbggradColor']) ? $props['hoverbggradColor'] : '';

    $radialFilledGrad = 'radial-gradient(at '.$vBgImgPosition.' }, '.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.' '.$bgGradLocSecond.'%) !important';
    $linearFilledGrad = 'linear-gradient('.$bgGradAngle.'deg, '.$bgfirstcolorr.' '.$bgGradLoc.'%, '.$bgSecondColr.' '.$bgGradLocSecond.'%) !important';
    $gradFilledColor = $bgGradType === 'radial' ? $radialFilledGrad : $linearFilledGrad;
    $filledGradColor = $props['gradientDisable'] ? $gradFilledColor : 'unset !important';

    $radialUnfilledGrad = 'radial-gradient(at '.$vBgImgPosition.' }, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
    $linearUnfilledGrad = 'linear-gradient('.$bgGradAngle.'deg, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
    $gradUnfilledColor = $bgGradType === 'radial' ? $radialUnfilledGrad : $linearUnfilledGrad;
    $unfilledGradColor = $props['gradientDisable'] ? $gradUnfilledColor : 'unset !important';

    $transparent = '';
    if ($props['gradientDisable']) {
      $transparent = '-webkit-text-fill-color: transparent;-webkit-background-clip: text;';
    }

    $radialFilledGradHov = 'radial-gradient(at '.$vBgImgPosition.' }, '.$hovGradFirstColor.' '.$bgGradLoc.'%, '.$hovGradSecondColor.' '.$bgGradLocSecond.'%) !important';
    $linearFilledGradHov = 'linear-gradient('.$bgGradAngle.'deg, '.$hovGradFirstColor.' '.$bgGradLoc.'%, '.$hovGradSecondColor.' '.$bgGradLocSecond.'%) !important';
    $gradFilledColorHov = $props['bgGradType'] === 'radial' ? $radialFilledGradHov : $linearFilledGradHov;
    $filledGradHovColor = $props['gradientDisable'] ? $gradFilledColorHov : 'unset !important';

    $radunfilledGradHov = 'radial-gradient(at '.$vBgImgPosition.' }, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
    $linearunfilledGradHov = 'linear-gradient('.$bgGradAngle.'deg, '.$activeGradColor1.' '.$bgGradLoc.'%, '.$activeGradColor2.' '.$bgGradLocSecond.'%) !important';
    $gradUnfilledColorHov = $props['bgGradType'] === 'radial' ? $radunfilledGradHov : $linearunfilledGradHov;
    $unfilledGradHovColor = $props['gradientDisable'] ? $gradUnfilledColorHov : 'unset !important';

		ob_start();
		echo wp_kses_post( $this->iepa_openWrap( $props, 'rating' ) );
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
    // echo "<style>
    // @import url(https://fonts.googleapis.com/css2?family=$tyochange:wght@$fontWeight&display=swap);
    // </style>";
		?>
    <div class="<?php echo esc_attr( 'iepa_product_review' . $props['uniqueID'] . ' ' . $className ); ?>">
			<?php echo wp_kses_post( wc_get_rating_html( $average, $rating_count ) ); ?>
			<?php if ( $rating_count > 0 && comments_open() ) : ?>
        <a href="#reviews" class="iepa-review-link" rel="nofollow">
          (
            <?php printf(
              _n( '%s customer review', '%s customer reviews', $review_count, 'ibtana-ecommerce-product-addons' ),
              '<span class="count">' . esc_html( $review_count ) . '</span>'
            ); ?>
          )
        </a>
      <?php endif; ?>
    </div>
		<?php
		echo wp_kses_post( '</div>' );

		return ob_get_clean();
	}

  public function render_iepa_product_reviews( $props ) {
    global $product;
		if ( ! $product ) return '';

    $isIepaGutenberg = ( isset( $_GET['isIepaGutenberg'] ) && ( $_GET['isIepaGutenberg'] == true ) ) ? true : false;

    $className = isset( $props['className'] ) ? $props['className'] : '';

		ob_start();
    if ( !$isIepaGutenberg ) {
      echo wp_kses_post( '<div class="iepa_product_reviews' . $props['uniqueID'] . ' ' . $className . '">' );
    }
		comments_template();
    if ( !$isIepaGutenberg ) {
      echo wp_kses_post( '</div>' );
    }

		return ob_get_clean();
	}

	public function woocommerce_gallery_image_size( $size ) {
		if ( $this->_gallery_image_size ) {
			return $this->_gallery_image_size;
		}

		return $size;
	}

  public function render_iepa_product_images( $props ) {
		global $post, $product;

    $className = isset($props['className']) ? $props['className'] : '';

		if ( ! empty( $props['img_size'] ) ) {
			$this->iepa_gallery_image_size = $props['img_size'];
		}

		if ( ! $product ) return '';

    $attachment_ids = $product->get_gallery_image_ids();

    $sliderArrow      = $props['sliderArrow'] ? 'true' : 'false';
    $lightbox         = $props['lightbox'] ? 'true' : 'false';
    $sliderGallery    = $props['sliderGallery'] ? $props['sliderGallery'] : false;
    $autoplay         = $props['autoplay'] ? 'true' : 'false';
    $loop             = $props['loop'] ? 'true' : 'false';
    $zoom             = $props['zoom'] ? 'true' : 'false';
    $arrowColor       = $props['arrowColor'] ? $props['arrowColor'] : '#ffffff';
    $arrowBgColor     = $props['arrowBgColor'] ? $props['arrowBgColor'] : '#000000';
    $galleryPosition  = $props['galleryPosition'] ? $props['galleryPosition'] : 'horizontal';

    if ( has_post_thumbnail() ) {
      $thumbanil_id   = array(get_post_thumbnail_id());
      $attachment_ids = array_merge($thumbanil_id,$attachment_ids);
    }
    ob_start();

    if($sliderGallery){
      echo wp_kses_post( '<div class="iepa_product_images' . $props['uniqueID'] . ' ' . $className . '">' );
      //Image With Slider 2 Zoom
      if ( has_post_thumbnail() ) {

        $attachment_count = count( $attachment_ids);

        $gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
        $image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
        $imgProps2        = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
        $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
          'title'	 => $imgProps2['title'],
          'alt'    => $imgProps2['alt'],
        ) );

        $fullimage        = get_the_post_thumbnail( $post->ID, 'full', array(
          'title'	 => $imgProps2['title'],
          'alt'    => $imgProps2['alt'],
        ) );

        // IEPA FOR SLIDER vertical-img-right
        $html  = '<div class="slider iepa-slider-for" data-arrow='.$sliderArrow.' data-lightbox='.$lightbox.' data-autoplay='.$autoplay.' data-loop='.$loop.' data-zoom='.$zoom.'
        data-arrow-color='.$arrowColor.' data-arrow-bg-color='.$arrowBgColor.' data-arrow-position='.$galleryPosition.'>';


        foreach( $attachment_ids as $attachment_id ) {
          $imgfull_src = wp_get_attachment_image_src( $attachment_id,'full');
          $image_src   = wp_get_attachment_image_src( $attachment_id,'shop_single');
          $html .= '<div class="zoom"><img src="'.$imgfull_src[0].'" /><img src="'.$image_src[0].'" /><a href="'.$imgfull_src[0].'" class="iepa-popup fa fa-expand" data-fancybox="product-gallery"></a></div>';
        }

        $html .= '</div>';

        echo wp_kses_post( apply_filters(
          'woocommerce_single_product_image_html',
          $html,
          $post->ID
        ) );
      } else {
        echo wp_kses_post(
          apply_filters(
            'woocommerce_single_product_image_html',
            sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'ibtana-ecommerce-product-addons' ) ),
            $post->ID
          )
        );
      }

      //Image With Slider 1
      if ( $attachment_ids ) {
        //vertical-thumb-right

        echo wp_kses_post( '<div id="iepa-gallery" class="slider iepa-slider-nav">' );

          foreach ( $attachment_ids as $attachment_id ) {

            $imgProps = wc_get_product_attachment_props( $attachment_id, $post );

            $thumbnails_catlog = '';

            if ( ! $imgProps['url'] ) {
              continue;
            }

            echo wp_kses_post(
              apply_filters(
                'woocommerce_single_product_image_thumbnail_html',
                sprintf(
                  '<li title="%s">%s</li>',
                  esc_attr( $imgProps['caption'] ),
                  wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'thumbnail' ), 0, $thumbnails_catlog )
                ),
                $attachment_id,
                $post->ID
              )
            );
          }

        echo wp_kses_post( '</div>' );
      }
      echo wp_kses_post( '</div>' );

    } else {

      echo wp_kses_post( '<div class="iepa_product_images' . $props['uniqueID'] . ' ' . $className . '">' );
      add_action( 'woocommerce_gallery_image_size', [ $this, 'iepa_woocommerce_gallery_image_size' ], 999 );

      woocommerce_show_product_images();
      remove_action( 'woocommerce_gallery_image_size', [ $this, 'iepa_woocommerce_gallery_image_size' ], 999 );
      echo wp_kses_post( '</div>' );
    }

		return ob_get_clean();
	}

  public function iepa_woocommerce_gallery_image_size( $size ) {
    if ( $this->iepa_gallery_image_size ) {
      return $this->iepa_gallery_image_size;
    }
    return $size;
  }

}
