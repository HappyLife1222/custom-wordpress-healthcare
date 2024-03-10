<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}


if ( ! class_exists( 'IEPA_MM_prodlist_widget_area' ) ) {

  class IEPA_MM_prodlist_widget_area extends WP_Widget {


    public static $widget_base_id     = 'iepa_pro_productlist_widget_area';
    public static $widget_name        = 'IEPA :  Products Lists Widget';
    public static $widget_description = 'A widget that shows WooCommerce products.';

    public function __construct() {
      parent::__construct(
        self::$widget_base_id, // Base ID
        __( self::$widget_name, IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __(
            self::$widget_description,
            IEPA_TEXT_DOMAIN
          )
        )
      );
    }



    /**
    * Front-end display of widget.
    * @see WP_Widget::widget()
    * @param array   $args     Widget arguments.
    * @param array   $instance Saved values from database.
    */
    public function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $display_title                = isset($instance['display_title']) ? esc_attr( $instance['display_title'] ) : '';
      $product_type                 = isset($instance['product_list_type']) ? esc_attr( $instance['product_list_type'] ) : 'category';
      $product_category             = isset($instance['product_list_category']) ? esc_attr( $instance['product_list_category'] ) : 'all';
      $product_number               = isset($instance['product_list_number']) ? intval( $instance['product_list_number'] ) : '';
      $post_length                  = ( isset( $instance['product_post_length'] ) && $instance['product_post_length'] != '' ) ? esc_attr( $instance['product_post_length'] ) : '10';
      $product_show_description     = isset( $instance['product_show_description'] ) ? esc_attr( $instance['product_show_description'] ) : '';
      //$link_name = (isset($instance['link_name']) && $instance['link_name'] != '')?esc_attr( $instance['link_name'] ):'';
      $product_show_category        = (isset($instance['product_show_category']) && $instance['product_show_category'] != '')?esc_attr( $instance['product_show_category'] ):'0';
      $image_layout                 = (isset($instance['image_layout']) && $instance['image_layout'] != '')?esc_attr( $instance['image_layout'] ):'';
      $total_column                 = (isset($instance['total_column']) && $instance['total_column'] != '')?intval($instance['total_column']):'2';
      $show_addtocart               = (isset($instance['show_addtocart']) && $instance['show_addtocart'] != '')?esc_attr( $instance['show_addtocart'] ):'0';
      $product_show_image           = (isset($instance['product_show_image']) && $instance['product_show_image'] != '')?esc_attr( $instance['product_show_image'] ):'0';
      $rating                       = (isset($instance['rating']) && $instance['rating'] != '')?esc_attr( $instance['rating'] ):'0';
      // featured image options
      $image_size                   = (isset($instance['image_size']) && $instance['image_size'] != '')?esc_attr( $instance['image_size'] ):'large';
      $custom_width                 = (isset($instance['custom_width']) && $instance['custom_width'] != '')?esc_attr( $instance['custom_width'] ):'';
      $custom_height                = (isset($instance['custom_height']) && $instance['custom_height'] != '')?esc_attr( $instance['custom_height'] ):'';
      $product_visibility_term_ids  = wc_get_product_visibility_term_ids();

      $wpl_title_color              = isset($instance['iepaplist_title_color'])?$instance['iepaplist_title_color']:'';
      $wpl_desc_color               = isset($instance['iepaplist_desc_color'])?$instance['iepaplist_desc_color']:'';
      $wpl_catprice_color           = isset($instance['iepaplist_catprice_color'])?$instance['iepaplist_catprice_color']:'';
      $wpl_atcbtncolor              = isset($instance['addtocartbtncolor'])?$instance['addtocartbtncolor']:'';
      $wpl_atcbtnhcolor             = isset($instance['addtocartbtnhcolor'])?$instance['addtocartbtnhcolor']:'';
      $wpl_atcbtnfontcolor          = isset($instance['addtocartbtnfontcolor'])?$instance['addtocartbtnfontcolor']:'';
      $wpl_atcbtnfonthcolor         = isset($instance['addtocartbtnfonthcolor'])?$instance['addtocartbtnfonthcolor']:'';


      if( $product_type == 'category' ) {

        if( $product_category == "all" ) {

          $product_args = array(
            'post_type' => 'product',
            'posts_per_page' => $product_number
          );

        } else {

          $product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
              array(
                'taxonomy'  =>  'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page' => $product_number
          );

        }

      } elseif( $product_type == 'latest_product' ) {

        $product_label_custom = esc_html__( 'New', IEPA_TEXT_DOMAIN );

        if( $product_category == "all" ) {

          $product_args = array(
            'post_type'       =>  'product',
            'posts_per_page'  =>  $product_number,
            'orderby'         =>  'date',
            'order'           =>  'desc'
          );

        } else {

          $product_args = array(
            'post_type' =>  'product',
            'tax_query' =>  array(
              array(
                'taxonomy'  =>  'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page'  =>  $product_number
          );

        }

      } else if( $product_type == 'feature_product' ) {

        if( $product_category == "all" ) {
          //  $meta_query[] = array(
          //      'key'   => '_featured',
          //      'value' => 'yes'
          //  );
          // $product_args = array(
          //     'post_type' => 'product',
          //     'posts_per_page' => $product_number,
          //      'orderby'     =>  'date',
          //      'order'       =>  'DESC',
          //      'meta_query'  =>  $meta_query
          // );

          // from woocommerce new version updates of 3.0.4
          $product_args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $product_number,
            'meta_query'      => array(),
            'tax_query'       => array(
              'relation' => 'AND',
            ),
          );

          $product_args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'term_taxonomy_id',
            'terms'    => $product_visibility_term_ids['featured'],
          );

        } else {

          $product_args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $product_number,
            'meta_query'      => array(),
            'tax_query'       => array(
              'relation' => 'AND',
            ),
          );

          $product_args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'id',
            'terms'    => $product_category
          );

          // $product_args = array(
          //     'post_type'        => 'product',
          //     'meta_key'         => '_featured',
          //     'meta_value'       => 'yes',
          //        'tax_query' => array(
          //         array('taxonomy'  => 'product_cat',
          //          'field'     => 'id',
          //          'terms'     => $product_category
          //         )
          //     ),
          //     'posts_per_page'   => $product_number
          // );
        }

      } elseif( $product_type == 'upsell_product' ) {

        if( $product_category == "all" ) {

          $product_args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $product_number,
            'meta_key'        => 'total_sales',
            'orderby'         => 'meta_value_num'
          );

        } else {

          $product_args = array(
            'post_type'         => 'product',
            'meta_key'          => 'total_sales',
            'orderby'           => 'meta_value_num',
            'tax_query'         => array(
              array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page'  =>  $product_number
          );

        }
      } else if( $product_type == 'on_sale' ) {
        if( $product_category == "all" ) {
          $product_args = array(
            'post_type'       =>  'product',
            'posts_per_page'  =>  $product_number,
            'meta_query'      =>  array(
              'relation'  =>  'OR',
              array( // Simple products type
                'key'           => '_sale_price',
                'value'         => 0,
                'compare'       => '>',
                'type'          => 'numeric'
              ),
              array( // Variable products type
                'key'           => '_min_variation_sale_price',
                'value'         => 0,
                'compare'       => '>',
                'type'          => 'numeric'
              )
            )
          );

        } else {
          $product_args = array(
            'post_type'       =>  'product',
            'posts_per_page'  =>  $product_number,
            'tax_query'       =>  array(
              array(
                'taxonomy'  =>  'product_cat',
                'field'     =>  'id',
                'terms'     =>  $product_category
              )
            ),
            'meta_query'     => array(
              'relation' => 'OR',
              array( // Simple products type
                'key'           => '_sale_price',
                'value'         => 0,
                'compare'       => '>',
                'type'          => 'numeric'
              ),
              array( // Variable products type
                'key'           => '_min_variation_sale_price',
                'value'         => 0,
                'compare'       => '>',
                'type'          => 'numeric'
              )
            )
          );
        }
      }
      echo $before_widget;
      ?>
      <div class="iepa-pro-productlist-wrap">

        <div class="immastore-container">
          <div id="product-list" class="product-list-area clearfix">

            <div class="product-block-title-wrap clearfix">
              <?php
              if ( !empty( $instance['display_title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['display_title'] ) . $args['after_title'];
              }
              ?>
            </div>

            <ul class="all-product-list <?php echo esc_attr( 'imma-' . $image_layout );?> <?php echo esc_attr('imma-prodlist-col'.$total_column); ?>">
              <?php

              $product_args = isset( $product_args ) ? $product_args : '';
              $query        = new WP_Query( $product_args );

              if( $query->have_posts() ) {
                while( $query->have_posts() ) {
                  $query->the_post();
                  $idd = get_the_ID();
                  $postclass_id = "post-".$idd;

                  ?>
                  <li <?php #post_class(); ?>>

                    <div class="imma-product-wrap iepamegamenupro-clearfix">

                      <!-- show featured image -->
                      <div class="imma-prodimage">

                        <?php

                        if( isset( $product_show_image ) && $product_show_image == 1 ) {
                          if ( has_post_thumbnail() ) {
                            woocommerce_show_product_loop_sale_flash();
                            if( $image_size == "custom_size" ) {
                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                            } else {
                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), $image_size );
                            }


                            if ( ! empty( $large_image_url[0] ) ) {
                              ?>
                              <a href="<?php echo esc_url( get_the_permalink() ); ?>"
                                title="<?php echo esc_attr(the_title_attribute( array( 'echo' => 0 ) )); ?>">
                                <?php
                                if( $image_size != "custom_size" ) {
                                  echo wp_kses_post( get_the_post_thumbnail( get_the_ID(), $image_size ) );
                                } else {
                                  ?>
                                  <div style="<?php echo esc_attr( 'width:' . $custom_width . 'px;' ) ?> <?php echo esc_attr( 'height:' . $custom_height . 'px' ) ?>;">
                                    <img src="<?php echo esc_url( $large_image_url[0] ); ?>"
                                      alt="<?php echo esc_attr( the_title_attribute( array( 'echo' => 0 ) ) ); ?>"
                                    />
                                  </div>
                                  <?php
                                }
                                ?>
                              </a>
                              <?php
                            } else {
                              //  echo '<a href="#" title="' . get_the_title() . '">';
                              if( $image_size == "custom_size" ) {
                                ?>
                                <a href="<?php esc_url(get_the_permalink()); ?>">
                                  <div style="<?php echo esc_attr( 'width:' . $custom_width . 'px;' ) ?> <?php echo esc_attr( 'height:' . $custom_height . 'px;' ) ?>">
                                    <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>"
                                      alt="<?php echo esc_attr( 'thumbnail' ); ?>"
                                    />
                                  </div>
                                </a>
                                <?php
                              } else {
                                switch( $image_size ) {
                                  case 'full':
                                    $width = "263";
                                    $height = "192";
                                    break;

                                  case 'large':
                                    $width = "263";
                                    $height = "192";
                                    break;

                                  case 'thumbnail':
                                    $width = "150";
                                    $height = "150";
                                    break;

                                  case 'medium-large':
                                    $width = "263";
                                    $height = "192";
                                    break;
                                }
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                  <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>"
                                    alt="<?php echo esc_attr( 'thumbnail' ); ?>" width="<?php echo esc_attr( $width ); ?>"
                                    height="<?php echo esc_attr( $height ); ?>"
                                  />
                                </a>
                                <?php
                              }

                            }

                          } else {
                            if( $image_size == "custom_size" ) {
                              $cwidth   = $custom_width;
                              $cheight  = $custom_height;
                            } else {
                              switch( $image_size ) {
                                case 'full':
                                  $cwidth = "263";
                                  $cheight = "192";
                                  break;
                                case 'large':
                                  $cwidth = "263";
                                  $cheight = "192";
                                  break;
                                case 'thumbnail':
                                  $cwidth = "150";
                                  $cheight = "150";
                                  break;
                                case 'medium-large':
                                  $cwidth = "263";
                                  $cheight = "192";
                                  break;
                              }
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>">
                              <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ) ?>"
                                alt="<?php echo esc_attr( 'thumbnail' ); ?>" width="<?php echo esc_attr( $cwidth ); ?>"
                                height="<?php echo esc_attr( $cheight ); ?>"
                              />
                            </a>
                            <?php
                          }
                        }
                        ?>

                      </div>


                      <div class="iepa-second-wrapper">

                        <div class="imma-woo-category-lists">
                          <!-- show category -->
                          <?php
                          if( isset( $product_show_category ) && $product_show_category == 1 ) {
                            if( $product_type == "category" && $product_category != 'all' ) {
                              $term     = get_term( $product_category, 'product_cat' );
                              // Name
                              $termname =  $term->name;
                              $termid   =  $term->term_id;
                              ?>
                              <span class="product_category_title">
                                <a href="<?php echo esc_url( get_category_link( $termid ) );?>"
                                  alt="<?php echo esc_attr( sprintf( __( 'View all posts in %s', IEPA_TEXT_DOMAIN ), $termname ) );?>"
                                >
                                  <?php echo esc_html( $termname ); ?>
                                </a>
                              </span>
                              <?php
                            } else {
                              $prod_terms = get_the_terms( get_the_ID(), 'product_cat' );

                              if( isset( $prod_terms ) && !empty( $prod_terms ) ) {

                                foreach ( $prod_terms as $key => $value ) {
                                  ?>
                                  <span class='product_category_title'>
                                    <a href="<?php echo esc_url( get_category_link( $value->term_id ) ); ?>"
                                      alt="<?php echo esc_attr( sprintf( __( 'View all posts in %s', IEPA_TEXT_DOMAIN ), $value->name ) ); ?>"
                                    >
                                      <?php echo esc_html( $value->name ); ?>
                                    </a>
                                  </span>
                                  <?php
                                }

                              }
                            }
                          }
                          ?>
                        </div>

                        <!-- show title -->
                        <div class="imma-woo-content">
                          <a href="<?php the_permalink(); ?>">
                            <?php woocommerce_template_loop_product_title(); ?>
                          </a>

                          <?php
                          if( $product_show_description == 1 ) {
                            // show description
                            $desc = IEPA_MM_Libary::imma_get_excerptbyid( get_the_ID(), $post_length );
                            ?>
                            <div class="product-desc">
                              <p class="all-product-desc">
                                <?php echo esc_html( $desc ); ?>
                              </p>
                            </div>
                            <?php
                          }

                          if( $rating == 1 ) {
                            // show rating
                            woocommerce_template_loop_rating();
                          }
                          woocommerce_template_loop_price();

                          if( isset( $show_addtocart ) && $show_addtocart == 1 ) {
                            // show add to cart
                            woocommerce_template_loop_add_to_cart();
                          }
                          ?>

                        </div>

                      </div>

                    </div>

                  </li>

                  <?php
                }
              }
              wp_reset_query();
              ?>

            </ul>

          </div>

        </div>

      </div>
      <!-- End Products -->
      <?php
      echo $after_widget;
    }



    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;


      $product_show_image   = ( isset( $iepa_mm_widget_data_by_id['product_show_image'] ) && $iepa_mm_widget_data_by_id['product_show_image'] != '' ) ? esc_attr( $iepa_mm_widget_data_by_id['product_show_image'] ) : '0';
      $product_show_description = isset( $iepa_mm_widget_data_by_id['product_show_description'] ) ? esc_attr( $iepa_mm_widget_data_by_id['product_show_description'] ) : '0';


      $wpl_title_color      = ( isset( $iepa_mm_widget_data_by_id['iepaplist_title_color'] ) && ( $iepa_mm_widget_data_by_id['iepaplist_title_color'] != '' ) ) ? $iepa_mm_widget_data_by_id['iepaplist_title_color'] : '#000000';
      $wpl_desc_color       = ( isset( $iepa_mm_widget_data_by_id['iepaplist_desc_color'] ) && ( $iepa_mm_widget_data_by_id['iepaplist_desc_color'] != '' ) ) ? $iepa_mm_widget_data_by_id['iepaplist_desc_color'] : '#000000';
      $wpl_catprice_color   = isset( $iepa_mm_widget_data_by_id['iepaplist_catprice_color'] ) ? $iepa_mm_widget_data_by_id['iepaplist_catprice_color'] : '';

      $wpl_atcbtncolor      = isset( $iepa_mm_widget_data_by_id['addtocartbtncolor'] ) ? $iepa_mm_widget_data_by_id['addtocartbtncolor'] : '';
      $wpl_atcbtnhcolor     = isset( $iepa_mm_widget_data_by_id['addtocartbtnhcolor'] ) ? $iepa_mm_widget_data_by_id['addtocartbtnhcolor'] : '';
      $wpl_atcbtnfontcolor  = isset( $iepa_mm_widget_data_by_id['addtocartbtnfontcolor'] ) ? $iepa_mm_widget_data_by_id['addtocartbtnfontcolor'] : '';
      $wpl_atcbtnfonthcolor = isset( $iepa_mm_widget_data_by_id['addtocartbtnfonthcolor'] ) ? $iepa_mm_widget_data_by_id['addtocartbtnfonthcolor'] : '';

      $show_addtocart       = (
                                isset( $iepa_mm_widget_data_by_id['show_addtocart'] ) && ( $iepa_mm_widget_data_by_id['show_addtocart'] != '' )
                              ) ? esc_attr( $iepa_mm_widget_data_by_id['show_addtocart'] ) : '0';

      $product_show_category  = (
                                  isset( $iepa_mm_widget_data_by_id['product_show_category'] ) && ( $iepa_mm_widget_data_by_id['product_show_category'] != '' )
                                ) ? esc_attr( $iepa_mm_widget_data_by_id['product_show_category'] ) : '0';

      $iepa_custom_css = '';


      if( isset( $product_show_image ) && $product_show_image == 1 ) {
        $iepa_custom_css .= '';
      }


      if ( $wpl_title_color != '' ) {
        $iepa_custom_css .= '
        ' . $iepa_mm_sidebar_widget_id . ' .imma-woo-content .woocommerce-loop-product__title {
          color: ' . $wpl_title_color . ';
        }
        ';
      }


      if( $product_show_description == 1 ) {
        if ( $wpl_desc_color != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .product-desc .all-product-desc {
            color: ' . $wpl_desc_color . ';
          }
          ';
        }
      }


      if ( $show_addtocart == '1' ) {

        if ( $wpl_atcbtncolor != "" ) {
          $iepa_custom_css  .=  '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button {
            background: ' . $wpl_atcbtncolor . ';
          }';
        }

        if ( $wpl_atcbtncolor != "" ) {
          $iepa_custom_css  .=  '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button {
            border: ' . $wpl_atcbtncolor . ';
          }';
        }

        if ( $wpl_atcbtnfontcolor != '' ) {
          $iepa_custom_css  .=  '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button {
            color: ' . $wpl_atcbtnfontcolor . ';
          }';
        }


        if ( $wpl_atcbtnhcolor != '' ) {
          $iepa_custom_css  .=  '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button:hover {
            background: ' . $wpl_atcbtnhcolor . ';
          }';
        }

        if ( $wpl_atcbtnhcolor != '' ) {
          $iepa_custom_css  .=  '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button:hover {
            border: ' . $wpl_atcbtnhcolor . ';
          }';
        }

        if ( $wpl_atcbtnfonthcolor != '' ) {
          $iepa_custom_css  .=  '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-pro-productlist-wrap .all-product-list li .iepa-second-wrapper .imma-woo-content a.button:hover {
            color: ' . $wpl_atcbtnfonthcolor . ';
          }';
        }

      }


      if ( $wpl_catprice_color != "" ) {
        $iepa_custom_css .= '
        ' . $iepa_mm_sidebar_widget_id . ' .iepa-second-wrapper .imma-woo-content .price,
        ' . $iepa_mm_sidebar_widget_id . ' .iepa-second-wrapper .imma-woo-content .woocommerce-Price-amount {
          color: ' . $wpl_catprice_color . ' !important;
        }
        ';
      }


      if ( $product_show_category != '0' ) {
        if ( $wpl_catprice_color != "" ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .product_category_title a {
            color: ' . $wpl_catprice_color . ' !important;
          }
          ';
        }
      }

      return $iepa_custom_css;
    }



    /**
    * Sanitize widget form values as they are saved.
    * @see WP_Widget::update()
    * @param array   $new_instance Values just sent to be saved.
    * @param array   $old_instance Previously saved values from database.
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
      $instance                             = $old_instance;
      $instance['display_title']            = strip_tags( $new_instance['display_title'] );
      $instance['product_list_category']    = strip_tags( $new_instance['product_list_category'] );
      $instance['product_list_type']        = strip_tags( $new_instance['product_list_type'] );
      $instance['product_list_number']      = strip_tags( $new_instance['product_list_number'] );
      $instance['product_post_length']      = strip_tags( $new_instance['product_post_length'] );
      $instance['product_show_description'] = strip_tags( $new_instance['product_show_description'] );
      $instance['product_show_category']    = strip_tags( $new_instance['product_show_category'] );
      $instance['image_layout']             = strip_tags( $new_instance['image_layout'] );
      $instance['total_column']             = strip_tags( $new_instance['total_column'] );
      $instance['product_show_image']       = strip_tags( $new_instance['product_show_image'] );
      $instance['show_addtocart']           = strip_tags( $new_instance['show_addtocart'] );
      $instance['rating']                   = strip_tags( $new_instance['rating'] );
      $instance['image_size']               = strip_tags( $new_instance['image_size'] );
      $instance['custom_height']            = strip_tags( $new_instance['custom_height'] );
      $instance['custom_width']             = strip_tags( $new_instance['custom_width'] );
      $instance['iepaplist_title_color']    = strip_tags( $new_instance['iepaplist_title_color'] );
      $instance['iepaplist_desc_color']     = strip_tags( $new_instance['iepaplist_desc_color'] );
      $instance['iepaplist_catprice_color'] = strip_tags( $new_instance['iepaplist_catprice_color'] );
      $instance['addtocartbtncolor']        = strip_tags( $new_instance['addtocartbtncolor'] );
      $instance['addtocartbtnhcolor']       = strip_tags( $new_instance['addtocartbtnhcolor'] );
      $instance['addtocartbtnfontcolor']    = strip_tags( $new_instance['addtocartbtnfontcolor'] );
      $instance['addtocartbtnfonthcolor']   = strip_tags( $new_instance['addtocartbtnfonthcolor'] );

      return $instance;
    }



    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {
      $prod_type = array(
        'category'        => __( 'Category', IEPA_TEXT_DOMAIN ),
        'latest_product'  => __( 'Latest Product', IEPA_TEXT_DOMAIN ),
        'upsell_product'  => __( 'UpSell Product', IEPA_TEXT_DOMAIN ),
        'feature_product' => __( 'Featured Product', IEPA_TEXT_DOMAIN ),
        'on_sale'         => __( 'On Sale Product', IEPA_TEXT_DOMAIN )
      );
      $image_layout = array(
        'left_image_with_content' => __( 'Image On Left of Content', IEPA_TEXT_DOMAIN ),
        // 'right_image_with_content' => __('Image On Right of Content', IEPA_TEXT_DOMAIN),
        'top_image_with_content' => __( 'Image On Top of Content', IEPA_TEXT_DOMAIN )
      );
      $imagesize = array(
        'full'            => __( 'Full', IEPA_TEXT_DOMAIN ),
        'thumbnail'       => __( 'Thumbnail', IEPA_TEXT_DOMAIN ),
        'medium'          => __( 'Medium', IEPA_TEXT_DOMAIN ),
        'medium-large'    => __( 'Medium Large', IEPA_TEXT_DOMAIN ),
        'large'           => __( 'Large', IEPA_TEXT_DOMAIN ),
        'post-thumbnail'  => __( 'Post Thumbnail', IEPA_TEXT_DOMAIN ),
        'custom_size'     => __( 'Custom Image Size', IEPA_TEXT_DOMAIN )
      );

      $taxonomy     = 'product_cat';
      $empty        = 1;
      $orderby      = 'name';
      $show_count   = 0;      // 1 for yes, 0 for no
      $pad_counts   = 0;      // 1 for yes, 0 for no
      $hierarchical = 1;      // 1 for yes, 0 for no
      $title        = '';
      $empty        = 0;
      $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
      );

      $woocommerce_categories         = array();
      $woocommerce_categories_obj     = get_categories($args);
      $woocommerce_categories['all']  = __('Select Any Product', IEPA_TEXT_DOMAIN);
      foreach ($woocommerce_categories_obj as $category) {
        $woocommerce_categories[$category->term_id] = $category->name;
      }

      $display_title            = isset($instance['display_title'])?$instance['display_title']:'';
      $product_list_type        = isset($instance['product_list_type'])?$instance['product_list_type']:'';
      $product_list_category    = isset($instance['product_list_category'])?$instance['product_list_category']:'';
      $product_list_number      = isset($instance['product_list_number'])?$instance['product_list_number']:'';
      $product_post_length      = isset( $instance['product_post_length'] ) ? $instance['product_post_length'] : 10;
      $product_show_description = isset($instance['product_show_description'])?$instance['product_show_description']:'0';
      $featuredimage_layout     = isset($instance['image_layout'])?$instance['image_layout']:'left_image_with_content';
      $total_column_value       = isset($instance['total_column'])?$instance['total_column']:'2';
      $product_show_category    = isset($instance['product_show_category'])?$instance['product_show_category']:'0';
      $product_show_image       = isset($instance['product_show_image'])?$instance['product_show_image']:'0';
      $show_addtocart           = isset($instance['show_addtocart'])?$instance['show_addtocart']:'0';
      $rating                   = isset($instance['rating'])?$instance['rating']:'0';

      $image_size               = (isset($instance['image_size']) && $instance['image_size'] != '')?esc_attr( $instance['image_size'] ):'large';
      $custom_width             = (isset($instance['custom_width']) && $instance['custom_width'] != '')?esc_attr( $instance['custom_width'] ):'';
      $custom_height            = (isset($instance['custom_height']) && $instance['custom_height'] != '')?esc_attr( $instance['custom_height'] ):'';
      ?>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('display_title') ); ?>">
          <?php esc_html_e( 'Title: ',IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'display_title' ) ); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'display_title' )); ?>"
          value="<?php echo esc_attr( $display_title ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('product_list_type') ); ?>">
          <?php esc_html_e( 'Select Product Type', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr($this->get_field_name('product_list_type')); ?>"
          id="<?php echo esc_attr($this->get_field_id('product_list_type')); ?>" class="widefat immapro-listtype">
          <?php
          foreach ( $prod_type as $p_type => $type ) {
            ?>
            <option value="<?php echo esc_attr( $p_type ); ?>" <?php selected($p_type, $product_list_type); ?>>
              <?php echo esc_html( $type ); ?>
            </option>
            <?php
          }
          ?>
        </select>
      </p>

      <p class="imma-listcatgory-field">
        <label for="<?php echo esc_attr($this->get_field_id('product_list_category')); ?>">
          <?php esc_html_e( 'Select Product Category', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr($this->get_field_name('product_list_category')); ?>"
          id="<?php echo esc_attr($this->get_field_id('product_list_category')); ?>" class="widefat immapro-listcategory"
        >
          <?php
          foreach ( $woocommerce_categories as $c_type => $ctype ) {
            ?>
            <option value="<?php echo esc_attr( $c_type ); ?>" <?php selected( $c_type, $product_list_category ); ?>>
              <?php echo esc_html( $ctype ); ?>
            </option>
            <?php
          }
          ?>
        </select>
      </p>

      <p class="smallfield">
        <!-- for input number type add attr step="3" min="1"  -->
        <label for="<?php echo esc_attr( $this->get_field_id('product_list_number') ); ?>">
          <?php esc_html_e( 'Post Per Page', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br />
        <input name="<?php echo esc_attr( $this->get_field_name('product_list_number') ); ?>" type="number"
          id="<?php echo esc_attr($this->get_field_id('product_list_number')); ?>"
          value="<?php echo esc_attr( $product_list_number ); ?>" class="widefat"
        />
      </p>

      <p class="smallfield">
        <label for="<?php echo esc_attr($this->get_field_id('product_show_description'));?>">
          <?php esc_html_e( 'Show Excerpt', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br/>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'product_show_description' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'product_show_description' )); ?>"
          value="1" <?php checked($product_show_description,'1'); ?>
        />
      </p>

      <p class="smallfield">
        <label for="<?php echo esc_attr($this->get_field_id('product_post_length')); ?>">
          <?php esc_html_e( 'Excerpt Length', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="number" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'product_post_length' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'product_post_length' ) ); ?>"
          value="<?php echo esc_attr( $product_post_length ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'product_show_category' ) ); ?>">
          <?php esc_html_e( 'Show Category', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'product_show_category' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'product_show_category' ) ); ?>"
          value="1" <?php checked( $product_show_category, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('rating') ); ?>">
          <?php esc_html_e('Show Rating',IEPA_TEXT_DOMAIN)?> :
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rating' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'rating' ) ); ?>" value="1" <?php checked( $rating, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_addtocart' ) ); ?>">
          <?php esc_html_e( 'Show Add To Cart Button', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'show_addtocart' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'show_addtocart' ) ); ?>"
          value="1" <?php checked( $show_addtocart, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('product_show_image') ); ?>">
          <?php esc_html_e( 'Show Featured Image', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat immashowimg"
          id="<?php echo esc_attr( $this->get_field_id( 'product_show_image' ) ); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'product_show_image' )); ?>"
          value="1" <?php checked( $product_show_image, '1' ); ?>
        />
      </p>

      <div class="show_image_options">
        <p>
          <label for="<?php echo esc_attr($this->get_field_id( 'image_size' )); ?>">
            <?php esc_html_e( 'Image Size', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('image_size')); ?>"
            id="<?php echo esc_attr($this->get_field_id( 'image_size' )); ?>" class="widefat immapro-listsize">
            <?php
            if( isset( $imagesize ) ) {
              foreach ( $imagesize as $custom_imgsize => $imgsize ) {
                ?>
                <option value="<?php echo esc_attr( $custom_imgsize ); ?>" <?php selected( $custom_imgsize, $image_size ); ?>>
                  <?php echo esc_html( $imgsize ); ?>
                </option>
                <?php
              }
            }
            ?>
          </select>
        </p>

        <p class="smallfieldsize <?php if( $image_size != 'custom_size' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
          <label for="<?php echo esc_attr($this->get_field_id( 'custom_width' )); ?>">
            <?php esc_html_e( 'Width', IEPA_TEXT_DOMAIN ); ?> :
          </label>
          <input type="text" class="widefat custom" id="<?php echo esc_attr($this->get_field_id( 'custom_width' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'custom_width' )); ?>"
            placeholder="<?php esc_html_e( 'E.g., 120px', IEPA_TEXT_DOMAIN ); ?>"
            value="<?php echo esc_attr( $custom_width ); ?>"
          />

          <label for="<?php echo esc_attr($this->get_field_id('custom_height')); ?>">
            <?php esc_html_e('Height',IEPA_TEXT_DOMAIN)?> :
          </label>
          <input type="text" class="widefat custom"
            id="<?php echo esc_attr($this->get_field_id( 'custom_height' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'custom_height' )); ?>"
            placeholder="<?php esc_html_e( 'E.g., 120px', IEPA_TEXT_DOMAIN );?>"
            value="<?php echo esc_attr( $custom_height ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id( 'image_layout' )); ?>">
            <?php esc_html_e( 'Select Image Layout Type', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('image_layout')); ?>"
            id="<?php echo esc_attr($this->get_field_id('image_layout')); ?>" class="widefat"
          >
            <?php
            foreach ( $image_layout as $img_type => $img ) {
              ?>
              <option value="<?php echo esc_attr( $img_type ); ?>" <?php selected( $img_type, $featuredimage_layout ); ?>>
                <?php echo esc_html( $img ); ?>
              </option>
              <?php
            }
            ?>
          </select>
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('total_column')); ?>">
            <?php esc_html_e('Total Column',IEPA_TEXT_DOMAIN); ?>:
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('total_column')); ?>"
            id="<?php echo esc_attr($this->get_field_id('total_column')); ?>" class="widefat"
          >
            <option value="1" <?php selected('1', $total_column_value); ?>><?php echo esc_html('1',IEPA_TEXT_DOMAIN); ?></option>
            <option value="2" <?php selected('2', $total_column_value); ?>><?php echo esc_html('2',IEPA_TEXT_DOMAIN); ?></option>
            <option value="3" <?php selected('3', $total_column_value); ?>><?php echo esc_html('3',IEPA_TEXT_DOMAIN); ?></option>
            <option value="4" <?php selected('4', $total_column_value); ?>><?php echo esc_html('4',IEPA_TEXT_DOMAIN); ?></option>
            <option value="5" <?php selected('5', $total_column_value); ?>><?php echo esc_html('5',IEPA_TEXT_DOMAIN); ?></option>
            <option value="6" <?php selected('6', $total_column_value); ?>><?php echo esc_html('6',IEPA_TEXT_DOMAIN); ?></option>
          </select>
        </p>

        <p class="description">
          <?php esc_html_e( 'Set total number of post for each column. If not set, default will be 2.', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <h3><?php esc_html_e( 'Custom Styling', IEPA_TEXT_DOMAIN ); ?></h3>
        <?php
        $iepaplist_title_color    =  ( isset( $instance['iepaplist_title_color'] ) ) ? $instance['iepaplist_title_color'] : '';
        $iepaplist_desc_color     =  ( isset( $instance['iepaplist_desc_color'] ) ) ? $instance['iepaplist_desc_color'] : '';
        $iepaplist_catprice_color =  ( isset( $instance['iepaplist_catprice_color'] ) ) ? $instance['iepaplist_catprice_color'] : '';
        $addtocartbtncolor        =  ( isset( $instance['addtocartbtncolor'] ) ) ? $instance['addtocartbtncolor'] : '';
        $addtocartbtnhcolor       =  ( isset( $instance['addtocartbtnhcolor'] ) ) ? $instance['addtocartbtnhcolor'] : '';
        $addtocartbtnfontcolor    =  ( isset( $instance['addtocartbtnfontcolor'] ) ) ? $instance['addtocartbtnfontcolor'] : '';
        $addtocartbtnfonthcolor   =  ( isset( $instance['addtocartbtnfonthcolor'] ) ) ? $instance['addtocartbtnfonthcolor'] : '';
        ?>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('iepaplist_title_color'));?>">
            <?php esc_html_e( 'Title Color', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker" id="<?php echo esc_attr($this->get_field_id( 'iepaplist_title_color' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'iepaplist_title_color' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $iepaplist_title_color ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('iepaplist_desc_color')); ?>">
            <?php esc_html_e( 'Description Color', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker" id="<?php echo esc_attr($this->get_field_id( 'iepaplist_desc_color' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'iepaplist_desc_color' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $iepaplist_desc_color ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('iepaplist_catprice_color')); ?>">
            <?php esc_html_e( 'Category/Price Color', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker"
            id="<?php echo esc_attr($this->get_field_id( 'iepaplist_catprice_color' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'iepaplist_catprice_color' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $iepaplist_catprice_color ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('addtocartbtncolor')); ?>">
            <?php esc_html_e( 'Add To Cart Background Color', IEPA_TEXT_DOMAIN ) ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker"
            id="<?php echo esc_attr( $this->get_field_id( 'addtocartbtncolor' ) ); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'addtocartbtncolor' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $addtocartbtncolor ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('addtocartbtnhcolor')); ?>">
            <?php esc_html_e( 'Add To Cart Background Hover Color', IEPA_TEXT_DOMAIN ) ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker"
            id="<?php echo esc_attr($this->get_field_id( 'addtocartbtnhcolor' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'addtocartbtnhcolor' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $addtocartbtnhcolor ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('addtocartbtnfontcolor')); ?>">
            <?php esc_html_e( 'Add To Cart Font Color', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker"
            id="<?php echo esc_attr($this->get_field_id( 'addtocartbtnfontcolor' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'addtocartbtnfontcolor' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $addtocartbtnfontcolor ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('addtocartbtnfonthcolor')); ?>">
            <?php esc_html_e( 'Add To Cart Font Hover Color', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat imma-mm-color-picker"
            id="<?php echo esc_attr($this->get_field_id( 'addtocartbtnfonthcolor' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'addtocartbtnfonthcolor' )); ?>" data-alpha="true"
            value="<?php echo esc_attr( $addtocartbtnfonthcolor ); ?>"
          />
        </p>

      </div>

      <style type="text/css">
      .smallfield {
        display: inline-block;
        float: left;
        margin: 11px;
        width: 69px;
      }
      .widefat.custom {
        width: 89px;
      }
      </style>


      <?php

    }

  }

}
