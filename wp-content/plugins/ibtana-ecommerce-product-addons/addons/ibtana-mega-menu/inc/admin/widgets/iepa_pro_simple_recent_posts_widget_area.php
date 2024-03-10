<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists( 'IEPA_MM_Simple_Recent_Posts' ) ) {

  class IEPA_MM_Simple_Recent_Posts extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'iepa_pro_simple_recent_posts_widget_area', // Base ID
        __( 'IEPA : Recent Posts Widget', IEPA_TEXT_DOMAIN ), // Name
        array( 'description' => __( 'A widget that shows recent posts by order on 3 different layouts.', IEPA_TEXT_DOMAIN ) )
      );
    }

    /**
    * Front-end display of widget.
    * @see WP_Widget::widget()
    * @param array   $args     Widget arguments.
    * @param array   $instance Saved values from database.
    */

    public function widget($args, $instance) {
      extract( $args );
      extract( $instance );
      $display_title            = ( isset( $instance['display_title'] ) && $instance['display_title'] != '' ) ? esc_attr( $instance['display_title'] ) : '';
      $posts_number             = ( isset( $instance['posts_number'] ) && $instance['posts_number'] != '' ) ? intval( $instance['posts_number'] ) : '3';
      $show_category            = ( isset( $instance['show_category'] ) && $instance['show_category'] != '' ) ? esc_attr( $instance['show_category'] ) : '0';
      $show_comment_number      = ( isset( $instance['show_comment_number'] ) && $instance['show_comment_number'] != '' ) ? esc_attr( $instance['show_comment_number'] ) : '0';
      //$show_posts_views  = (isset($instance['show_posts_views']) && $instance['show_posts_views'] != '')?esc_attr( $instance['show_posts_views'] ):'0';
      $show_date                = ( isset( $instance['show_date'] ) && $instance['show_date'] != '' ) ? esc_attr( $instance['show_date'] ) : '0';
      $enable_button            = ( isset( $instance['enable_button'] ) && $instance['enable_button'] != '' ) ? esc_attr( $instance['enable_button'] ) : '0';
      $btntarget                = ( isset( $instance['btntarget'] ) ) ? esc_attr( $instance['btntarget'] ) : '_self';
      $button_name              = ( isset( $instance['button_name'] ) && $instance['button_name'] != '' ) ? esc_attr( $instance['button_name'] ) : '';
      $order_by                 = ( isset( $instance['order_by'] ) && $instance['order_by'] != '' ) ? esc_attr( $instance['order_by'] ) : 'date';
      $ordertype                = ( isset( $instance['ordertype'] ) && $instance['ordertype'] != '' ) ? esc_attr( $instance['ordertype'] ) : 'desc';
      $posts_hover_layout_type  = ( isset( $instance['posts_hover_layout_type'] ) && $instance['posts_hover_layout_type'] != '' ) ? esc_attr( $instance['posts_hover_layout_type'] ) : 'hoverlayout1';
      $pargs = array(
        'post_type'       => 'post',
        'posts_per_page'  => $posts_number,
        'orderby'         => $order_by,
        'order'           => $ordertype
      );

      echo $before_widget;
      ?>

      <div class="iepa-pro-recent-posts-widget">
        <div id="imma-recent-post-lists">

          <div class="new-layout-block-title clearfix">
            <?php
            if ( !empty( $instance['display_title'] ) ) {
              echo $args['before_title'] . apply_filters( 'widget_title', $instance['display_title'] ) . $args['after_title'];
            }
            ?>
          </div>

          <?php
          if( $posts_hover_layout_type == "hoverlayout1" ) {
            $hoverclass = "layout1";
          } else if( $posts_hover_layout_type == "hoverlayout2" ) {
            $hoverclass = "layout2";
          } else {
            $hoverclass = "layout3";
          }
          ?>

          <ul class="imma-recent-posts <?php echo esc_attr( $hoverclass ); ?>">
            <?php

            $query = new WP_Query( $pargs );

            if( $query->have_posts() ) {
              while( $query->have_posts() ) {
                $query->the_post();
                ?>
                <li <?php #post_class(); ?>>
                  <div class="iepa-recentposts-section iepamegamenupro-clearfix">
                    <!-- show featured image -->
                    <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr( $btntarget ); ?>" class="imma-recent-posts-title">
                      <div class="imma-image-left-section">
                        <?php
                        if ( has_post_thumbnail() ) {
                          $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail');
                          if ( ! empty( $large_image_url[0] ) ) {
                            ?>
                            <img src="<?php echo esc_url( $large_image_url[0] ); ?>"
                              alt="<?php echo esc_attr(the_title_attribute( array( 'echo' => 0 ) )); ?>"
                            />
                            <?php
                          } else {
                            ?>
                            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>" alt="thumbnail" />
                            <?php
                          }
                        } else {
                          ?>
                          <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>" alt="thumbnail" />
                          <?php
                        }
                        ?>
                      </div>
                    </a>
                    <!-- left section end -->
                    <div class="iepa-content-right-section">
                      <?php
                      if( $show_category ) {
                        $category_detail = get_the_category( get_the_ID() ,array( 'fields' => 'names' ) );//$post->ID
                        if( isset( $category_detail ) && !empty( $category_detail ) ) {
                          ?>
                          <div class="imma-posts-category-lists">
                            <span class='imma-cat'>
                              <?php
                              $catecount = count( $category_detail );
                              $i = 1;
                              foreach( $category_detail as $cd ) {
                                echo esc_html( $cd->name );
                                if( $i < $catecount ) {
                                  echo esc_html( ", " );
                                }
                                $i++;
                              }
                              ?>
                            </span>
                          </div>
                          <?php
                        }

                      }

                      if( $show_date ) {
                        $format     = 'F j, Y';
                        $pfx_datee  = get_the_date( $format, get_the_ID() );
                        ?>
                        <span class='imma-display-date'>
                          <?php echo esc_html( $pfx_datee ); ?>
                        </span>
                        <?php
                      }
                      ?>
                      <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($btntarget); ?>" class="imma-recent-posts-title">
                        <?php the_title(); ?>
                      </a>
                      <?php
                      if( $show_comment_number ) {
                        $comment_in_number2 = get_comments_number( get_the_ID() );
                        ?>
                        <span class='iepa-comment-number'>
                          <?php echo esc_html( $comment_in_number2 ); ?>
                        </span>
                        <?php
                      }

                      if( $enable_button ) {
                        ?>
                        <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($btntarget); ?>" class="imma-readmore-btn">
                          <span><?php echo esc_html( $button_name ); ?></span>
                        </a>
                        <?php
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
      $instance                             = $old_instance;
      $instance['display_title']            = strip_tags( $new_instance['display_title'] );
      $instance['posts_number']             = strip_tags( $new_instance['posts_number'] );
      $instance['posts_hover_layout_type']  = strip_tags( $new_instance['posts_hover_layout_type'] );
      $instance['show_category']            = strip_tags( $new_instance['show_category'] );
      $instance['show_comment_number']      = strip_tags( $new_instance['show_comment_number'] );
      //$instance['show_posts_views']   = strip_tags( $new_instance['show_posts_views'] );
      $instance['ordertype']                = strip_tags( $new_instance['ordertype'] );
      $instance['order_by']                 = strip_tags( $new_instance['order_by'] );
      $instance['show_date']                = strip_tags( $new_instance['show_date'] );
      $instance['enable_button']            = strip_tags( $new_instance['enable_button'] );
      $instance['btntarget']                = strip_tags( $new_instance['btntarget'] );
      $instance['button_name']              = strip_tags( $new_instance['button_name'] );

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
      $display_title            = isset( $instance['display_title'] ) ? $instance['display_title'] : '';
      $posts_hover_layout_type  = isset( $instance['posts_hover_layout_type'] ) ? $instance['posts_hover_layout_type'] : 'hoverlayout1';
      $posts_number             = isset( $instance['posts_number'] ) ? $instance['posts_number'] : '';
      $show_category            = isset( $instance['show_category'] ) ? $instance['show_category'] : '0';
      $show_date                = isset( $instance['show_date'] ) ? $instance['show_date'] : '0';
      $order_by                 = isset( $instance['order_by'] ) ? $instance['order_by'] : 'date';
      $ordertype                = isset( $instance['ordertype'] ) ? $instance['ordertype'] : 'desc';
      $show_comment_number      = isset( $instance['show_comment_number'] ) ? $instance['show_comment_number'] : '0';
      // $show_posts_views = isset($instance['show_posts_views'])?$instance['show_posts_views']:'0';
      $enable_button            = isset( $instance['enable_button'] ) ? $instance['enable_button'] : '0';
      $btntarget                = isset( $instance['btntarget'] ) ? $instance['btntarget'] : '_self';
      $button_name              = isset( $instance['button_name'] ) ? $instance['button_name'] : '';

      ?>

      <div class="imma-post-display-section2">
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('display_title'));?>">
            <?php esc_html_e( 'Title', IEPA_TEXT_DOMAIN ); ?> :
          </label>
          <input type="text" class="widefat"
            id="<?php echo esc_attr($this->get_field_id( 'display_title' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'display_title' )); ?>"
            value="<?php echo esc_attr( $display_title ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id( 'posts_number' )); ?>">
            <?php esc_html_e( 'Post Per Page', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <br />
          <input name="<?php echo esc_attr($this->get_field_name('posts_number')); ?>" type="number"
            id="<?php echo esc_attr($this->get_field_id('posts_number')); ?>"
            value="<?php echo esc_attr($posts_number); ?>" class="widefat"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('show_category')); ?>">
            <?php esc_html_e( 'Show Category', IEPA_TEXT_DOMAIN ); ?> :
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr($this->get_field_id( 'show_category' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'show_category' )); ?>" value="1" <?php checked($show_category,'1'); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>">
            <?php esc_html_e( 'Show Date', IEPA_TEXT_DOMAIN ); ?> :
          </label>
          <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" value="1" <?php checked($show_date,'1'); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('show_comment_number')); ?>">
            <?php esc_html_e( 'Show Comment Number', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr($this->get_field_id( 'show_comment_number' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'show_comment_number' )); ?>"
            value="1" <?php checked($show_comment_number,'1'); ?>
          />
        </p>

        <p class="posts-layout2">
          <label for="<?php echo esc_attr($this->get_field_id( 'posts_hover_layout_type' )); ?>">
            <?php esc_html_e( 'Select Layout Type', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('posts_hover_layout_type')); ?>"
            id="<?php echo esc_attr($this->get_field_id('posts_hover_layout_type')); ?>" class="widefat imma-posts-layout2">
            <option value="hoverlayout1" <?php selected('hoverlayout1', $posts_hover_layout_type); ?>>
              <?php echo esc_html_e( 'Hover Layout 1', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="hoverlayout2" <?php selected('hoverlayout2', $posts_hover_layout_type); ?>>
              <?php echo esc_html_e( 'Hover Layout 2', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="hoverlayout3" <?php selected('hoverlayout3', $posts_hover_layout_type); ?>>
              <?php echo esc_html_e( 'Hover Layout 3', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>

          <div id="hoverlayout1" class="layout_preview2"
            style="<?php if( $posts_hover_layout_type == "hoverlayout1" ) { echo esc_attr( 'display:block;' ); } else { echo esc_attr( 'display:none;' ); } ?>">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/widget-images/postlayout4.PNG' ); ?>"/>
          </div>
          <div id="hoverlayout2" class="layout_preview2"
            style="<?php if( $posts_hover_layout_type == "hoverlayout2" ) { echo esc_attr( 'display:block;' ); } else { echo esc_attr( 'display:none;' ); } ?>">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/widget-images/postlayout5.PNG' ); ?>"/>
          </div>
          <div id="hoverlayout3" class="layout_preview2"
            style="<?php if( $posts_hover_layout_type == "hoverlayout3" ) { echo esc_attr( 'display:block;' ); } else { echo esc_attr( 'display:none;' ); } ?>">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/widget-images/postlayout6.PNG' ); ?>"/>
          </div>
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('enable_button')); ?>">
            <?php esc_html_e( 'Show Link Button', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'enable_button' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'enable_button' )); ?>" value="1" <?php checked($enable_button,'1'); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('btntarget')); ?>">
            <?php esc_html_e( 'Select Posts Link Target', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('btntarget')); ?>"
            id="<?php echo esc_attr($this->get_field_id('btntarget')); ?>" class="widefat">
            <option value="_blank"  <?php selected('_blank', $btntarget); ?>>
              <?php esc_html_e( '_blank', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="_self"  <?php selected('_self', $btntarget); ?>>
              <?php esc_html_e( '_self', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="_parent" <?php selected('_parent', $btntarget); ?>>
              <?php esc_html_e( '_parent', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="_top"  <?php selected('_top', $btntarget); ?>>
              <?php esc_html_e( '_top', IEPA_TEXT_DOMAIN );?>
            </option>
          </select>
        </p>


        <p>
          <label for="<?php echo esc_attr($this->get_field_id( 'button_name' )); ?>">
            <?php esc_html_e( 'Button Name', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat"
            id="<?php echo esc_attr($this->get_field_id( 'button_name' )); ?>"
            name="<?php echo esc_attr($this->get_field_name( 'button_name' )); ?>" value="<?php echo esc_attr( $button_name ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('order_by')); ?>">
            <?php esc_html_e( 'Select Order By', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('order_by')); ?>"
            id="<?php echo esc_attr($this->get_field_id('order_by')); ?>" class="widefat">
            <option value="ID" <?php selected('ID', $order_by); ?>>
              <?php esc_html_e( 'ID', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="title" <?php selected('title', $order_by); ?>>
              <?php esc_html_e( 'Title', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="name" <?php selected('name', $order_by); ?>>
              <?php esc_html_e( 'Name', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="date" <?php selected('date', $order_by); ?>>
              <?php esc_html_e( 'Date', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="rand" <?php selected('rand', $order_by); ?>>
              <?php esc_html_e( 'Random Number', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="menu_order" <?php selected('menu_order', $order_by); ?>>
              <?php esc_html_e( 'Menu Order', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="author" <?php selected('author', $order_by); ?>>
              <?php esc_html_e( 'Author', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('ordertype')); ?>">
            <?php esc_html_e('Select Order',IEPA_TEXT_DOMAIN)?>:
          </label>
          <select name="<?php echo esc_attr($this->get_field_name('ordertype')); ?>"
            id="<?php echo esc_attr($this->get_field_id('ordertype')); ?>" class="widefat">
            <option value="asc" <?php selected( 'asc', $ordertype ); ?>>
              <?php esc_html_e( 'ASC', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="desc" <?php selected( 'desc', $ordertype ); ?>>
              <?php esc_html_e( 'DESC', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
        </p>

      </div>
      <?php
    }
  }

}
