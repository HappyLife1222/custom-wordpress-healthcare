<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}


if ( ! class_exists( 'IEPA_MM_Products_With_Cart_widget_area' ) ) {

  class IEPA_MM_Products_With_Cart_widget_area extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'iepa_pro_products_cart_widget_area', // Base ID
        __( 'IEPA : Woo Products Layout 2 Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' =>  __(
            'A widget that shows WooCommerce Products With Add to Cart Button on different layouts.',
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
      extract($args);
      extract($instance);

      $display_title    = ( isset( $instance['display_title'] ) && ( $instance['display_title'] != '' ) ) ? esc_attr( $instance['display_title'] ) : '';
      $product_number   = ( isset( $instance['product_number'] ) && $instance['product_number'] != '' ) ? intval( $instance['product_number'] ) : '3';
      $show_add_to_cart = ( isset( $instance['show_add_to_cart'] ) && $instance['show_add_to_cart'] != '' ) ? esc_attr( $instance['show_add_to_cart'] ) : '0';
      $rating           = ( isset( $instance['rating'] ) && $instance['rating'] != '' ) ? esc_attr( $instance['rating'] ) : '0';
      $show_price       = ( isset( $instance['show_price'] ) && $instance['show_price'] != '' ) ? esc_attr( $instance['show_price'] ) : '0';
      $order_by         = ( isset( $instance['order_by'] ) && $instance['order_by'] != '' ) ? esc_attr( $instance['order_by'] ) : 'date';
      $ordertype        = ( isset( $instance['ordertype'] ) && $instance['ordertype'] != '' ) ? esc_attr( $instance['ordertype'] ) : 'desc';
      $pargs = array(
        'post_type'       => 'product',
        'posts_per_page'  => $product_number,
        'orderby'         => $order_by,
        'order'           => $ordertype
      );

      echo $before_widget;

      ?>

      <div class="iepa-pro-woo-product-widget">

        <div id="new-layout-product-list" class="new-layout-product-list-area clearfix">

          <div class="new-layout-block-title clearfix">
            <?php
            if ( !empty( $instance['display_title'] ) ) {
              echo $args['before_title'] . apply_filters('widget_title', $instance['display_title']) . $args['after_title'];
            }
            ?>
          </div>

          <ul class="all-woo-product-new-layout">
            <?php

            $query = new WP_Query( $pargs );

            if( $query->have_posts() ) {
              while( $query->have_posts() ) {
                $query->the_post();
                ?>
                <li <?php #post_class(); ?>>
                  <div class="imma-wooproduct-image-section iepamegamenupro-clearfix">
                    <!-- show featured image -->
                    <div class="imma-new-layout-top-section">
                      <?php

                      if ( has_post_thumbnail() ) {
                        woocommerce_show_product_loop_sale_flash();
                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        if ( ! empty( $large_image_url[0] ) ) {
                          ?>
                          <img src="<?php echo esc_url( $large_image_url[0] ); ?>"
                            alt="<?php echo esc_attr( the_title_attribute( array( 'echo' => 0 ) ) ); ?>"
                          />
                          <?php
                        } else {
                          woocommerce_show_product_loop_sale_flash();
                          ?>
                          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>" alt="thumbnail" />
                          <?php
                        }
                      } else {
                        woocommerce_show_product_loop_sale_flash();
                        ?>
                        <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>" alt="thumbnail" />
                        <?php
                      }

                      if( isset( $show_add_to_cart ) && $show_add_to_cart == 1 ) {
                        // show add to cart
                        woocommerce_template_loop_add_to_cart();
                      }

                      ?>
                    </div>

                    <!-- top section end -->
                    <div class="imma-new-layout-bottom-section">

                      <a href="<?php the_permalink(); ?>">
                        <?php woocommerce_template_loop_product_title(); ?>
                      </a>
                      <?php
                      if( $rating == 1 ) {
                        // <!-- show rating -->
                        woocommerce_template_loop_rating();
                      }
                      if( $show_price == 1 ) {
                        // <!-- show price -->
                        woocommerce_template_loop_price();
                      }
                      ?>

                    </div> <!-- bottom section end -->

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


    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

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
      $instance['display_title']    = strip_tags( $new_instance['display_title'] );
      $instance['product_number']   = strip_tags( $new_instance['product_number'] );
      $instance['show_add_to_cart'] = strip_tags( $new_instance['show_add_to_cart'] );
      $instance['rating']           = strip_tags( $new_instance['rating'] );
      $instance['show_price']       = strip_tags( $new_instance['show_price'] );
      $instance['ordertype']        = strip_tags( $new_instance['ordertype'] );
      $instance['order_by']         = strip_tags( $new_instance['order_by'] );

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
      $display_title    = isset($instance['display_title'])?$instance['display_title']:'';
      $product_number   = isset($instance['product_number'])?$instance['product_number']:'';
      $rating           = isset($instance['rating'])?$instance['rating']:'0';
      $show_price       = isset($instance['show_price'])?$instance['show_price']:'0';
      $order_by         = isset($instance['order_by'])?$instance['order_by']:'date';
      $ordertype        = isset($instance['ordertype'])?$instance['ordertype']:'desc';
      $show_add_to_cart = isset($instance['show_add_to_cart'])?$instance['show_add_to_cart']:'0';

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
        <label for="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>">
          <?php esc_html_e( 'Post Per Page', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'product_number' ) ); ?>" type="number"
          id="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>"
          value="<?php echo esc_attr( $product_number ); ?>" class="widefat"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'rating' ) ); ?>">
          <?php esc_html_e( 'Show Rating', IEPA_TEXT_DOMAIN ); ?> :
        </label>
        <input type="checkbox" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'rating' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'rating' ) ); ?>" value="1" <?php checked( $rating, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_price' ) ); ?>">
          <?php esc_html_e( 'Show Price', IEPA_TEXT_DOMAIN ); ?> :
        </label>
        <input type="checkbox" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'show_price' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'show_price' ) ); ?>" value="1" <?php checked( $show_price, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_add_to_cart' ) ); ?>">
          <?php esc_html_e( 'Show Add To Cart Button', IEPA_TEXT_DOMAIN ) ?>
        </label>
        <input type="checkbox" class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'show_add_to_cart' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'show_add_to_cart' ) ); ?>" value="1" <?php checked( $show_add_to_cart, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('order_by') ); ?>">
          <?php esc_html_e( 'Select Order By', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name('order_by') ); ?>"
          id="<?php echo esc_attr( $this->get_field_id('order_by') ); ?>" class="widefat">
          <option value="ID" <?php selected( 'ID', $order_by ); ?>>
            <?php esc_html_e( 'ID', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="title" <?php selected( 'title', $order_by ); ?>>
            <?php esc_html_e( 'Title', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="name" <?php selected( 'name', $order_by ); ?>>
            <?php esc_html_e( 'Name', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="date" <?php selected( 'date', $order_by ); ?>>
            <?php esc_html_e( 'Date', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="rand" <?php selected( 'rand', $order_by ); ?>>
            <?php esc_html_e( 'Random Number', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="menu_order" <?php selected( 'menu_order', $order_by ); ?>>
            <?php esc_html_e( 'Menu Order', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="author" <?php selected( 'author', $order_by ); ?>>
            <?php esc_html_e( 'Author', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('ordertype') ); ?>">
          <?php esc_html_e('Select Order',IEPA_TEXT_DOMAIN)?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name('ordertype') ); ?>"
          id="<?php echo esc_attr( $this->get_field_id('ordertype') ); ?>" class="widefat">
          <option value="asc" <?php selected('asc', $ordertype); ?>><?php esc_html_e( 'ASC', IEPA_TEXT_DOMAIN ); ?></option>
          <option value="desc" <?php selected('desc', $ordertype); ?>><?php esc_html_e( 'DESC', IEPA_TEXT_DOMAIN ); ?></option>
        </select>
      </p>


      <?php

    }




  }

}
