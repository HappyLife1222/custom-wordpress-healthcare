<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists('IEPA_Mega_Menu_PostsFormat') ) {

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_PostsFormat extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'iepamegamenu_pro_blogformat', // Base ID
        __( 'IEPA : Posts Format Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' =>  __(
            'A widget to show posts with post format type with featured images.',
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
      echo $args['before_widget'];
      if ( !empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }

      $post_type        = ( isset( $instance['posttype'] ) && $instance['posttype'] != '' ) ? esc_attr( $instance['posttype'] ) : 'post';
      $postperpage      = ( isset( $instance['postperpage'] ) && $instance['postperpage'] != '' ) ? intval( $instance['postperpage'] ) : '';
      $showdate         = ( isset( $instance['showdate'] ) && $instance['showdate'] == 1 ) ? 1 : 0;
      $show_comment_num = ( isset( $instance['show_comment_num'] ) && $instance['show_comment_num'] == 1 ) ? 1 : 0;
      $show_post_title  = ( isset( $instance['show_post_title'] ) && $instance['show_post_title'] == 1 ) ? 1 : 0;
      $readmorebtn      = ( isset( $instance['readmorebtn'] ) && $instance['readmorebtn'] == 1 ) ? 1 : 0;
      $readmorebtnname  = ( isset( $instance['readmorebtnname'] ) && $instance['readmorebtnname'] != '' ) ? $instance['readmorebtnname'] : '';
      $argumentss = array(
        'post_type'      =>  array( $post_type ),
        'post_status'    =>  array( 'publish' ),
        'posts_per_page' =>  $postperpage
      );
      $query = new WP_Query( $argumentss );
      // IEPA_MM_Libary::displayArr($query);
      if( $query->have_posts() ) {
        ?>
        <div class='iepa-featured-post-title'>

          <ul>
            <?php
            while( $query->have_posts() ) {
              $query->the_post();
              $post_id  = get_the_ID();
              $format   = get_post_format( $post_id ) ? get_post_format( $post_id ) : 'standard';
              if ( has_post_thumbnail() ) {
                $imageurl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
              } else {
                $imageurl[0] = '';
              }
              $width = 'width:55%';
              ?>
              <li>
                <div class="imma_lists_posts iepamegamenupro-clearfix">
                  <a href="<?php the_permalink();?>" target="_blank">
                    <div class="imma-hover-icon">
                      <?php
                      if( $format == "image" ) {
                        ?>
                        <i class="dashicons dashicons-format-image" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "chat" ) {
                        ?>
                        <i class="dashicons dashicons-format-chat" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "gallery" ) {
                        ?>
                        <i class="dashicons dashicons-format-gallery" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "link" ) {
                        ?>
                        <i class="dashicons dashicons-editor-unlink" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "quote" ) {
                        ?>
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "status" ) {
                        ?>
                        <i class="dashicons dashicons-format-status" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "video" ) {
                        ?>
                        <i class="dashicons dashicons-format-video" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "audio" ) {
                        ?>
                        <i class="dashicons dashicons-format-audio" aria-hidden="true"></i>
                        <?php
                      } else if( $format == "aside" ) {
                        ?>
                        <i class="dashicons dashicons-format-aside" aria-hidden="true"></i>
                        <?php
                      } else {
                        ?>
                        <i class="dashicons dashicons-admin-post" aria-hidden="true"></i>
                        <?php
                      }
                      ?>
                    </div>

                    <?php

                    if ( ! empty( $imageurl[0] ) ) {
                      ?>
                      <div class="imma-featured" style="<?php echo esc_attr( $width ); ?>">
                        <img src="<?php echo esc_url( $imageurl[0] ); ?>"
                          alt="<?php echo esc_attr( the_title_attribute( array( 'echo' => 0 ) ) ); ?>"
                        />
                      </div>
                      <?php
                    } else {
                      ?>
                      <div class="imma-featured" style="<?php echo esc_attr( $width ); ?>">
                        <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/thumbnail-default.jpg' ); ?>"
                          alt="<?php echo esc_attr(the_title_attribute( array( 'echo' => 0 ) )); ?>"
                        />
                      </div>
                      <?php
                    }

                    ?>

                    <div class="imma-postformat-title">
                      <div class="span-wrapper">
                        <?php
                        if( $showdate == 1 ) {
                          $posts_date = get_the_date( 'F j, Y', $post_id );
                          ?>
                          <span>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?php echo esc_html( $posts_date ); ?>
                          </span>
                          <?php
                        }

                        if( $show_comment_num == 1 ) {
                          $commentnum = get_comments_number( $post_id );
                          ?>
                          <span>
                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                            <?php echo esc_html( $commentnum ); ?>
                          </span>
                          <?php
                        }
                        ?>
                        <div class="clear"></div>
                      </div>
                      <?php
                      if( $show_post_title == 1 ) {
                        ?>
                        <h4><?php the_title(); ?></h4>
                        <?php
                      }

                      if( $readmorebtn == 1 && $readmorebtnname != '' ) {
                        ?>
                        <span class="featured-btn">
                          <?php echo esc_html( $readmorebtnname ); ?>
                        </span>
                        <?php
                      }
                      ?>
                    </div>

                  </a>
                </div>
              </li>

              <?php
            }
            ?>
          </ul>

        </div>
        <?php
      }
      echo $args['after_widget'];
    }



    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;

      $iepa_custom_css = '';

      $iepa_custom_css .= '
      ' . $iepa_mm_sidebar_widget_id . ' .iepa-featured-post-title .imma_lists_posts .imma-featured {
        width: 55%;
      }
      ';

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
      $instance = $old_instance;
      $instance['title']            = strip_tags( $new_instance['title'] );
      $instance['posttype']         = strip_tags( $new_instance['posttype'] );
      $instance['postperpage']      = strip_tags( $new_instance['postperpage'] );
      $instance['showdate']         = strip_tags( $new_instance['showdate'] );
      $instance['show_comment_num'] = strip_tags( $new_instance['show_comment_num'] );
      $instance['show_post_title']  = strip_tags( $new_instance['show_post_title'] );
      $instance['readmorebtn']      = strip_tags( $new_instance['readmorebtn'] );
      $instance['readmorebtnname']  = strip_tags( $new_instance['readmorebtnname'] );

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
      $title            = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $posttype         = isset( $instance[ 'posttype' ] ) ? $instance[ 'posttype' ] : '';
      $postsperpage     = isset( $instance[ 'postperpage' ] ) ? $instance[ 'postperpage' ] : '';
      $showdate         = ( isset($instance[ 'showdate' ]) && $instance[ 'showdate' ] == 1 ) ? '1' : '0';
      $show_comment_num = ( isset( $instance[ 'show_comment_num' ] ) && $instance[ 'show_comment_num' ] == 1 ) ? '1' : '0';
      $show_post_title  = ( isset( $instance[ 'show_post_title' ] ) && $instance[ 'show_post_title' ] == 1 ) ? '1' : '0';
      $readmorebtn      = ( isset( $instance[ 'readmorebtn' ] ) && $instance[ 'readmorebtn' ] == 1 ) ? '1' : '0';
      $readmorebtnname  = ( isset( $instance[ 'readmorebtnname' ] ) && $instance[ 'readmorebtnname' ] != '' ) ? $instance[ 'readmorebtnname' ] : '';
      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
          <?php esc_html_e( 'Title:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"
          type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
      <?php
      $posttypes =  IEPA_MM_Libary::imma_get_registered_post_types();
      // IEPA_MM_Libary::displayArr( $posttypes);
      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'phone_font_icon' )); ?>">
          <?php esc_html_e( 'Select Posts Type:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select name="<?php echo esc_attr($this->get_field_name( 'posttype' )); ?>"
          id="<?php echo esc_attr($this->get_field_id( 'posttype' )); ?>" class="widefat">
          <?php
          if( isset( $posttypes ) && !empty( $posttypes ) ) {
            foreach ( $posttypes as $key => $value ) {
              ?>
              <option value="<?php echo esc_attr( $value ); ?>"  <?php selected($value, $posttype); ?>>
                <?php echo esc_html( ucfirst( $value ) ); ?>
              </option>
              <?php
            }
          }
          ?>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('postperpage')); ?>">
          <?php esc_html_e( 'Posts Per Page', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'postperpage' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'postperpage' )); ?>" value="<?php echo esc_attr( $postsperpage ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('showdate')); ?>">
          <?php esc_html_e( 'Show Posts Date', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'showdate' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'showdate' )); ?>" value="1" <?php checked($showdate,'1'); ?>/>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('show_comment_num')); ?>">
          <?php esc_html_e( 'Show Comment In Number', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_comment_num' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'show_comment_num' )); ?>" value="1" <?php checked( $show_comment_num, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('show_post_title')); ?>">
          <?php esc_html_e( 'Show Post Title', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_post_title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'show_post_title' )); ?>" value="1" <?php checked( $show_post_title, '1' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'readmorebtn' )); ?>">
          <?php esc_html_e( 'Show Link Button', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'readmorebtn' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'readmorebtn' )); ?>" value="1" <?php checked($readmorebtn,'1'); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('readmorebtnname'));?>">
          <?php esc_html_e( 'Link Button Name', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat"
          id="<?php echo esc_attr($this->get_field_id( 'readmorebtnname' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'readmorebtnname' )); ?>"
          value="<?php echo esc_attr($readmorebtnname);?>"
          placeholder="<?php esc_attr_e( 'READ MORE', IEPA_TEXT_DOMAIN ); ?>"
        />
      </p>
      <?php
    }
  }

}
