<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}


if ( ! class_exists( 'IEPA_MM_Recent_Products_widget_area' ) ) {

  class IEPA_MM_Recent_Products_widget_area extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'iepa_pro_recent_products_widget_area', // Base ID
        __( 'IEPA :  Recent Products Lists Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __(
            'A widget that shows WooCommerce Recent/On Sale/Featured/Upsell Products.',
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

      $display_title          = ( isset( $instance['display_title'] ) && $instance['display_title'] != '' ) ? esc_attr( $instance['display_title'] ) : '';
      $product_type           = ( isset( $instance['product_list_type'] ) && $instance['product_list_type'] != '' ) ? esc_attr( $instance['product_list_type'] ) : 'category';
      $product_category       = ( isset( $instance['product_list_category'] ) && $instance['product_list_category'] != '' ) ? esc_attr( $instance['product_list_category'] ) : 'all';
      $product_number         = ( isset( $instance['product_list_number'] ) && $instance['product_list_number'] != '' ) ? esc_attr( $instance['product_list_number'] ) : '3';
      $display_title          = ( isset( $instance['show_addtocart'] ) && $instance['show_addtocart'] != '' ) ? esc_attr( $instance['show_addtocart'] ) : '0';
      $product_show_category  = ( isset( $instance['product_show_category'] ) && $instance['product_show_category'] != '' ) ? esc_attr( $instance['product_show_category'] ) : '0';
      $show_addtocart         = ( isset( $instance['show_addtocart'] ) && $instance['show_addtocart'] != '' ) ? esc_attr( $instance['show_addtocart'] ) : '0';
      $rating                 = ( isset( $instance['rating'] ) && $instance['rating'] != '' ) ? esc_attr( $instance['rating'] ) : '0';
      $show_price             = ( isset( $instance['show_price'] ) && $instance['show_price'] != '' ) ? esc_attr( $instance['show_price'] ) : '0';
      $show_button            = ( isset( $instance['show_button'] ) && $instance['show_button'] != '' ) ? esc_attr( $instance['show_button'] ) : '0';
      $link_name              = ( isset( $instance['link_name'] ) && $instance['link_name'] != '' ) ? esc_attr( $instance['link_name'] ) : '';
      $order_by               = ( isset( $instance['order_by'] ) && $instance['order_by'] != '' ) ? esc_attr( $instance['order_by'] ) : 'date';
      $ordertype              = ( isset( $instance['ordertype'] ) && $instance['ordertype'] != '' ) ? esc_attr( $instance['ordertype'] ) : 'desc';

      if( $product_type == 'category' ) {
        if( $product_category == "all" ) {
          $product_args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $product_number,
            'orderby'         => $order_by,
            'order'           => $ordertype
          );

        } else {
          $product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
              array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page'  =>  $product_number
          );

        }

      } else if( $product_type == 'latest_product' ) {
        $product_label_custom = __( 'New', IEPA_TEXT_DOMAIN );
        if( $product_category == "all" ) {
          $product_args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $product_number,
            'orderby'         => $order_by,
            'order'           => $ordertype
          );
        } else {
          $product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
              array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page'  => $product_number,
            'orderby'         => $order_by,
            'order'           => $ordertype
          );
        }

      } elseif( $product_type == 'feature_product' ) {

        if( $product_category == "all" ) {
          $product_args = array(
            'post_type'       => 'product',
            'meta_key'        => '_featured',
            'meta_value'      => 'yes',
            'posts_per_page'  => $product_number,
            'orderby'         => $order_by,
            'order'           => $ordertype
          );
        } else {
          $product_args = array(
            'post_type'        => 'product',
            'meta_key'         => '_featured',
            'meta_value'       => 'yes',
            'tax_query' => array(
              array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page'  => $product_number,
            'orderby'         => $order_by,
            'order'           => $ordertype
          );
        }

      } elseif( $product_type == 'upsell_product' ) {
        if( $product_category == "all" ) {
          $product_args = array(
            'post_type'       => 'product',
            'meta_key'        => 'total_sales',
            'orderby'         => 'meta_value_num',
            'posts_per_page'  => $product_number,
            'order'           => $ordertype
          );
        } else {
          $product_args = array(
            'post_type'         => 'product',
            'meta_key'          => 'total_sales',
            'orderby'           => 'meta_value_num',
            'tax_query' => array(
              array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'posts_per_page'    => $product_number,
            'order' => $ordertype
          );
        }
      } elseif( $product_type == 'on_sale' ) {
        if( $product_category == "all" ) {
          $product_args = array(
            'post_type'       => 'product',
            'meta_key'        => 'total_sales',
            'orderby'         => 'meta_value_num',
            'posts_per_page'  => $product_number,
            'order'           => $ordertype,
            'meta_query'      => array(
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

        } else {

          $product_args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $product_number,
            'orderby'         => $order_by,
            'order'           => $ordertype,
            'tax_query' => array(
              array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $product_category
              )
            ),
            'meta_query'  => array(
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

      <div class="imma-recent-product-widget">
        <div id="rec-product-list" class="rec-product-list-area clearfix">

          <div class="rprod-block-title clearfix">
            <?php
            if ( !empty( $instance['display_title'] ) ) {
              echo $args['before_title'] . apply_filters( 'widget_title', $instance['display_title'] ) . $args['after_title'];
            }
            ?>
          </div>

          <ul class="all-re-product-list">
            <?php

            $query = new WP_Query( $product_args );

            if( $query->have_posts() ) {
              while( $query->have_posts() ) {
                $query->the_post();
                ?>
                <li <?php #post_class(); ?>>
                  <div class="imma-recent-product-image-section iepamegamenupro-clearfix">
                    <!-- show featured image -->
                    <div class="imma-recentpro-left-section">
                      <a href="<?php the_permalink(); ?>">
                        <?php
                        if ( has_post_thumbnail() ) {
                          woocommerce_show_product_loop_sale_flash();
                          $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                          if ( ! empty( $large_image_url[0] ) ) {
                            ?>
                            <img src="<?php echo esc_url( $large_image_url[0] ); ?>" alt="<?php echo esc_attr( the_title_attribute( array( 'echo' => 0 ) ) ); ?>" />
                            <?php
                          } else {
                            woocommerce_show_product_loop_sale_flash();
                            ?>
                            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>" alt="thumbnail"/>
                            <?php
                          }
                        } else {
                          woocommerce_show_product_loop_sale_flash();
                          ?>
                          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>" alt="thumbnail" />
                          <?php
                        }
                        ?>
                      </a>
                    </div>

                    <!-- left section end -->
                    <div class="imma-recentpro-right-section">
                      <!-- show category -->
                      <?php
                      if( isset( $product_show_category ) && $product_show_category == 1 ) {
                        if( $product_type == "category" && $product_category != 'all' ) {
                          $term = get_term( $product_category, 'product_cat' );
                          $name = $term->name;
                          ?>
                          <span class="recent_product_category_title">
                            <?php echo esc_html( $name ); ?>
                          </span>
                          <?php
                        } else {
                          $prod_terms = get_the_terms( get_the_ID(), 'product_cat' );
                          if( isset( $prod_terms ) && !empty( $prod_terms ) ) {

                            foreach ( $prod_terms as $key => $value ) {
                              ?>
                              <span class='recent_product_category_title'>
                                <?php echo esc_html( $value->name ); ?>
                              </span>
                              <?php
                            }

                          }
                        }
                      }
                      ?>
                      <a href="<?php the_permalink(); ?>">
                        <?php woocommerce_template_loop_product_title(); ?>
                      </a>
                      <?php
                      if( $show_price == 1 ) {
                        // <!-- show price -->
                        woocommerce_template_loop_price();
                      }
                      if( $rating == 1 ) {
                        // <!-- show rating -->
                        woocommerce_template_loop_rating();
                      }

                      if( isset( $show_button ) && $show_button != 1 && $link_name != '' ) {
                        ?>
                        <a class="all-product-link" href="<?php echo esc_url( get_the_permalink() ); ?>">
                          <?php echo esc_html( $link_name ); ?>
                        </a>
                        <?php
                      }

                      if( isset( $show_addtocart ) && $show_addtocart == 1 ) {
                        // show add to cart
                        woocommerce_template_loop_add_to_cart();
                      }
                      ?>
                    </div> <!-- right section end -->

                  </div>
                </li>
                <?php
              }
            }
            wp_reset_query();
            ?>
          </ul>

        </div>

      </div><!-- End Products -->
      <?php
      echo $after_widget;
    }

    /**
    * Sanitize widget form values as they are saved.
    * @see WP_Widget::update()
    * @param array   $new_instance Values just sent to be saved.
    * @param array   $old_instance Previously saved values from database.
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['display_title']          = strip_tags( $new_instance['display_title'] );
      $instance['product_list_category']  = strip_tags( $new_instance['product_list_category'] );
      $instance['product_list_type']      = strip_tags( $new_instance['product_list_type'] );
      $instance['product_list_number']    = strip_tags( $new_instance['product_list_number'] );
      $instance['link_name']              = strip_tags( $new_instance['link_name'] );
      $instance['show_button']            = strip_tags( $new_instance['show_button'] );
      $instance['product_show_category']  = strip_tags( $new_instance['product_show_category'] );
      $instance['show_addtocart']         = strip_tags( $new_instance['show_addtocart'] );
      $instance['rating']                 = strip_tags( $new_instance['rating'] );
      $instance['show_price']             = strip_tags( $new_instance['show_price'] );
      $instance['order_by']               = strip_tags( $new_instance['order_by'] );
      $instance['ordertype']              = strip_tags( $new_instance['ordertype'] );
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
        'category'        =>  __( 'Category', IEPA_TEXT_DOMAIN ),
        'latest_product'  =>  __( 'Recent Product', IEPA_TEXT_DOMAIN ),
        'upsell_product'  =>  __( 'UpSell Product', IEPA_TEXT_DOMAIN ),
        'feature_product' =>  __( 'Featured Product', IEPA_TEXT_DOMAIN ),
        'on_sale'         =>  __( 'On Sale Product', IEPA_TEXT_DOMAIN ),
      );

      $taxonomy     = 'product_cat';
      $empty        = 1;
      $order_by     = isset( $instance[ 'order_by' ] ) ? $instance[ 'order_by' ] : 'date';
      $ordertype    = isset( $instance[ 'ordertype' ] ) ? $instance[ 'ordertype' ] : 'desc';
      $show_count   = 0;      // 1 for yes, 0 for no
      $pad_counts   = 0;      // 1 for yes, 0 for no
      $hierarchical = 1;      // 1 for yes, 0 for no
      $title        = '';
      $empty        = 0;
      $args = array(
        'taxonomy'      =>  $taxonomy,
        'orderby'       =>  $order_by,
        'show_count'    =>  $show_count,
        'pad_counts'    =>  $pad_counts,
        'hierarchical'  =>  $hierarchical,
        'title_li'      =>  $title,
        'hide_empty'    =>  $empty
      );

      $woocommerce_categories         = array();
      $woocommerce_categories_obj     = get_categories( $args );
      $woocommerce_categories['all']  = __( 'Show Any Category Product', IEPA_TEXT_DOMAIN );
      foreach ( $woocommerce_categories_obj as $category ) {
        $woocommerce_categories[$category->term_id] = $category->name;
      }

      $display_title          = isset( $instance['display_title'] ) ? $instance['display_title'] : '';
      $product_list_type      = isset( $instance['product_list_type'] ) ? $instance['product_list_type'] : '';
      $product_list_category  = isset( $instance['product_list_category'] ) ? $instance['product_list_category'] : '';
      $product_list_number    = isset( $instance['product_list_number'] ) ? $instance['product_list_number'] : '';
      $link_name              = isset( $instance['link_name'] ) ? $instance['link_name'] : '';
      $featuredimage_layout   = isset( $instance['image_layout'] ) ? $instance['image_layout'] : '';
      $product_show_category  = isset( $instance['product_show_category'] ) ? $instance['product_show_category'] : '0';
      $show_addtocart         = isset( $instance['show_addtocart'] ) ? $instance['show_addtocart'] : '0';
      $rating                 = isset( $instance['rating'] ) ? $instance['rating'] : '0';
      $show_price             = isset( $instance['show_price'] ) ? $instance['show_price'] : '0';
      $show_button            = isset( $instance['show_button'] ) ? $instance['show_button'] : '0';

      ?>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'display_title' ) ); ?>">
          <?php esc_html_e( 'Title', IEPA_TEXT_DOMAIN ); ?> :
        </label>
        <input type="text" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'display_title' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'display_title' ) ); ?>"
          value="<?php echo esc_attr( $display_title ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('product_list_type') ); ?>">
          <?php esc_html_e( 'Select Product Type', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'product_list_type' ) ); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'product_list_type' ) ); ?>" class="widefat immapro-listtype">
          <?php foreach ( $prod_type as $p_type => $type ) { ?>
            <option value="<?php echo esc_attr( $p_type ); ?>" <?php selected($p_type, $product_list_type); ?>>
              <?php echo esc_html( $type ); ?>
            </option>
          <?php } ?>
        </select>
      </p>

      <p class="imma-listcatgory-field">
        <label for="<?php echo esc_attr( $this->get_field_id('product_list_category') ); ?>">
          <?php esc_html_e( 'Select Product Category', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name('product_list_category') ); ?>"
          id="<?php echo esc_attr( $this->get_field_id('product_list_category') ); ?>" class="widefat immapro-listcategory"
          >
          <?php foreach ( $woocommerce_categories as $c_type => $ctype ) { ?>
            <option value="<?php echo esc_attr( $c_type ); ?>" <?php selected($c_type, $product_list_category); ?>>
              <?php echo esc_html( $ctype ); ?>
            </option>
          <?php } ?>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'product_list_number' ) ); ?>">
          <?php esc_html_e( 'Post Per Page', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br />
        <input name="<?php echo esc_attr( $this->get_field_name('product_list_number') ); ?>" type="number"
          id="<?php echo esc_attr( $this->get_field_id('product_list_number') ); ?>"
          value="<?php echo esc_attr($product_list_number); ?>" class="widefat"
        />
      </p>

      <div class="clear" style="clear:both;margin-top:5px;"></div>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('show_button') ); ?>">
          <?php esc_html_e( 'Show Button Name',IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_button' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'show_button' ) ); ?>" value="1" <?php checked($show_button,'1'); ?>
        />
      </p>

      <div class="clear" style="clear:both;"></div>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('link_name') ); ?>">
          <?php esc_html_e( 'Button Name', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br />
        <input name="<?php echo esc_attr( $this->get_field_name('link_name') ); ?>"
          placeholder="<?php esc_attr_e( 'E.g., Read More', IEPA_TEXT_DOMAIN ); ?>" type="text"
          id="<?php echo esc_attr( $this->get_field_id('link_name') ); ?>"
          value="<?php echo esc_attr($link_name); ?>" class="widefat"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('product_show_category') ); ?>">
          <?php esc_html_e( 'Show Category', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'product_show_category' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'product_show_category' ) ); ?>"
          value="1" <?php checked($product_show_category,'1'); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('rating') ); ?>">
          <?php esc_html_e( 'Show Rating: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rating' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'rating' ) ); ?>" value="1" <?php checked($rating,'1'); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('show_price') ); ?>">
          <?php esc_html_e( 'Show Price: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_price' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'show_price' ) ); ?>" value="1" <?php checked($show_price,'1'); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_addtocart' ) ); ?>">
          <?php esc_html_e( 'Show Add To Cart Button', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_addtocart' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'show_addtocart' ) ); ?>" value="1" <?php checked($show_addtocart,'1'); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('order_by') ); ?>">
          <?php esc_html_e( 'Select Order By', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>"
          id="<?php echo esc_attr( $this->get_field_id('order_by') ); ?>" class="widefat">
          <option value="ID" <?php selected('ID', $order_by); ?>><?php esc_html_e('ID',IEPA_TEXT_DOMAIN); ?></option>
          <option value="title" <?php selected('title', $order_by); ?>><?php esc_html_e('Title',IEPA_TEXT_DOMAIN); ?></option>
          <option value="name" <?php selected('name', $order_by); ?>><?php esc_html_e('Name',IEPA_TEXT_DOMAIN); ?></option>
          <option value="date" <?php selected('date', $order_by); ?>><?php esc_html_e('Date',IEPA_TEXT_DOMAIN); ?></option>
          <option value="rand" <?php selected('rand', $order_by); ?>><?php esc_html_e('Random Number',IEPA_TEXT_DOMAIN); ?></option>
          <option value="menu_order" <?php selected('menu_order', $order_by); ?>><?php esc_html_e('Menu Order',IEPA_TEXT_DOMAIN); ?></option>
          <option value="author" <?php selected('author', $order_by); ?>><?php esc_html_e('Author',IEPA_TEXT_DOMAIN); ?></option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('ordertype') ); ?>">
          <?php esc_html_e('Select Order',IEPA_TEXT_DOMAIN)?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name('ordertype') ); ?>"
          id="<?php echo esc_attr( $this->get_field_id('ordertype') ); ?>" class="widefat">
          <option value="asc" <?php selected( 'asc', $ordertype ); ?>>
            <?php esc_html_e( 'ASC', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="desc" <?php selected( 'desc', $ordertype ); ?>>
            <?php esc_html_e( 'DESC', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </p>

      <?php

    }

  }

}
