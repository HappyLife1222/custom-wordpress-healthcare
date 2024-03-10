<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists('IEPA_Mega_Menu_Posts_Slider_Widget') ) {

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_Posts_Slider_Widget extends WP_Widget {


    public function __construct() {
      parent::__construct(
        'iepamegamenu_pro_advanced_postslider', // Base ID
        __( 'IEPA : Advanced Posts Slider Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __( 'A widget to show title, description with featured image as slider.', IEPA_TEXT_DOMAIN )
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
      $showposttitle        = ( isset( $instance['showposttitle'] ) && $instance['showposttitle'] != '' ) ? $instance['showposttitle'] : '';
      $show_date            = ( isset( $instance['show_date'] ) && $instance['show_date'] != '' ) ? $instance['show_date'] : '0';
      $postsperpage         = ( isset( $instance['postsperpage'] ) && $instance['postsperpage'] != '' ) ? $instance['postsperpage'] : '3';
      $show_slider_controls = ( isset( $instance['show_slider_controls'] ) && $instance['show_slider_controls'] != '' ) ? $instance['show_slider_controls'] : 'false';
      $speed                = ( isset( $instance['speed'] ) && $instance['speed'] != '' ) ? $instance['speed'] : '1000';
      $duration             = ( isset( $instance['duration'] ) && $instance['duration'] != '' ) ? $instance['duration'] : '1000';
      $autoslide            = ( isset( $instance['autoslide'] ) && $instance['autoslide'] != '' ) ? $instance['autoslide'] : 'true';
      $slider_mode          = ( isset( $instance['slider_mode'] ) && $instance['slider_mode'] != '' ) ? $instance['slider_mode'] : 'fade';
      $random_num           = rand( 10000, 99999 );

      $cateid               = ( isset( $instance['cateid'] ) && $instance['cateid'] != '' ) ? $instance['cateid'] : '';

      $explode              = explode( '=', $cateid );

      $category_type        = $explode[0];
      $cat_slug             = isset( $explode[1] ) ? $explode[1] : '';
      if( $category_type == 'category' ) {
        $get_posts  = array(
          'post_type'       =>  array( 'post', 'post_type' ),
          'post_status'     =>  array( 'publish' ),
          'orderby'         =>  'date',
          'order'           =>  'desc',
          'posts_per_page'  =>  $postsperpage,
          'cat'             =>  $cat_slug
        );

      } else if( $category_type == 'terms' ) {
        $taxonomy   = $cat_slug;
        $terms_slug = $explode[2];
        $get_posts  = array(
          'post_status'     =>  array( 'publish' ),
          'posts_per_page'  =>  $postsperpage,
          'tax_query'       =>  array(
            array(
              'taxonomy'  =>  $taxonomy,
              'field'     =>  'slug',
              'terms'     =>  $terms_slug
            ),
          )
        );
      } else {
        $get_posts = array(
          'post_type'      =>  array( 'post', 'post_type'),
          'post_status'    =>  array( 'publish' ),
          'orderby'        =>  'date',
          'order'          =>  'desc',
          'posts_per_page' =>  $postsperpage
        );
      }


      $query = new WP_Query( $get_posts );

      ?>
      <div class='imma-posts-slider-widgets'>
        <ul class="iepamega-posts-slider" data-id="<?php echo esc_attr( $random_num ); ?>"
          data-auto-slide='<?php echo esc_attr( $autoslide ); ?>' data-speed='<?php echo esc_attr( $speed ); ?>'
          data-duration='<?php echo esc_attr( $duration ); ?>' data-controls='<?php echo esc_attr( $show_slider_controls ); ?>'
          data-mode="<?php echo esc_attr( $slider_mode ); ?>">
          <?php
          while( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();
            if ( has_post_thumbnail() ) {
              $imageurl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
            } else {
              $imageurl[0] = '';
            }
            if ( ! empty( $imageurl[0] ) ) {
              ?>
              <li>
                <img src="<?php echo esc_url( $imageurl[0] );?>" alt="<?php the_title_attribute( array( 'echo' => 0 ) );?>">
                <div class="imma-caption-wrapper">
                  <?php
                  if( $show_date == 1 ) {
                    $posts_date = get_the_date( 'F j, Y', $post_id );
                    ?>
                    <span class="posts-slider-date">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                      <?php echo esc_html( $posts_date ); ?>
                    </span>
                    <?php
                  }

                  if( $showposttitle == 1 ) {
                    ?>
                    <h3 class="imma-posts-title">
                      <a href="<?php echo esc_url( get_the_permalink() ); ?>" target="_blank">
                        <?php echo esc_html( the_title() ); ?>
                      </a>
                    </h3>
                    <?php
                  }
                  ?>
                </div>
              </li>

              <?php

            }
          }
          wp_reset_query();
          ?>
        </ul>
      </div>
      <?php
      echo $args['after_widget'];
    }

    /**
    * Sanitize widget form values as they are saved.
    * @see WP_Widget::update()
    * @param array   $new_instance Values just sent to be saved.
    * @param array   $old_instance Previously saved values from database.
    * @return array Updated safe values to be saved.
    */

    function update( $new_instance, $old_instance ) {
      $instance                         = $old_instance;
      $instance['title']                = strip_tags($new_instance['title']);
      $instance['showposttitle']        = strip_tags($new_instance['showposttitle']);
      $instance['cateid']               = strip_tags( $new_instance['cateid'] );
      $instance['show_date']            = strip_tags($new_instance['show_date']);
      $instance['postsperpage']         = strip_tags($new_instance['postsperpage']);
      $instance['show_slider_controls'] = strip_tags($new_instance['show_slider_controls']);
      $instance['speed']                = strip_tags($new_instance['speed']);
      $instance['duration']             = strip_tags($new_instance['duration']);
      $instance['autoslide']            = strip_tags($new_instance['autoslide']);
      $instance['slider_mode']          = strip_tags($new_instance['slider_mode']);

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

      $title                = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
      $showposttitle        = isset($instance[ 'showposttitle' ])?$instance[ 'showposttitle' ]:'1';
      $cateid               = isset($instance[ 'cateid' ])?$instance[ 'cateid' ]:'';
      $show_date            = isset($instance[ 'show_date' ])?$instance[ 'show_date' ]:'1';
      $postsperpage         = isset($instance[ 'postsperpage' ])?$instance[ 'postsperpage' ]:'3';
      $show_slider_controls = isset($instance[ 'show_slider_controls' ])?$instance[ 'show_slider_controls' ]:'false';
      $speed                = isset($instance[ 'speed' ])?$instance[ 'speed' ]:'1000';
      $duration             = isset($instance[ 'duration' ])?$instance[ 'duration' ]:'1000';
      $autoslide            = isset($instance[ 'autoslide' ])?$instance[ 'autoslide' ]:'true';
      $slider_mode          = isset($instance[ 'slider_mode' ])?$instance[ 'slider_mode' ]:'fade';

      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
          <?php esc_html_e( 'Slider Title:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat"
          id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text"
          value="<?php echo esc_attr( $title ); ?>">
      </p>

      <?php
      $posttypes =  IEPA_MM_Libary::imma_get_registered_post_types();
      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'cateid' )); ?>">
          <?php esc_html_e( 'Select Category', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <?php
        $categories = get_categories( array( 'hide_empty' => 0 ) );
        $taxonomies = IEPA_MM_Libary::get_all_taxonomy_lists();
        ?>

        <select name="<?php echo esc_attr($this->get_field_name('cateid')); ?>"
          id="<?php echo esc_attr($this->get_field_id('cateid')); ?>" class="widefat">
          <optgroup label="Category">
            <?php
            foreach( $categories as $category => $cat ) {
              ?>
              <option value="<?php echo esc_attr( 'category=' . $cat->term_id ); ?>" <?php selected( 'category=' . $cat->term_id, $cateid ); ?>>
                <?php echo esc_html( $cat->name ); ?>
              </option>
              <?php
            }
            ?>
          </optgroup>
          <optgroup label="Terms">
            <?php
            foreach( $taxonomies as $tax ) {
              $ex_taxonomy  = explode( ' ', $tax );
              $imp_taxonomy = strtolower(implode('_',$ex_taxonomy));
              $imp_taxonomy = strtolower(implode('-',$ex_taxonomy));
              $args         = array( 'parent' => '0', 'hide_empty' => 0 );
              $terms        = get_terms( $tax, $args );
              if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                  ?>
                  <option value="<?php echo esc_attr( 'terms=' . $imp_taxonomy . '=' . $term->slug ); ?>" <?php selected('terms='.$imp_taxonomy.'='.$term->slug, $cateid); ?>>
                    <?php echo esc_html( $term->name ); ?>
                  </option>
                  <?php
                }
              }
            }
            ?>
          </optgroup>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('showposttitle'));?>">
          <?php esc_html_e( 'Show Post Title', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'showposttitle' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'showposttitle' )); ?>" value="1" <?php checked($showposttitle,'1'); ?>/>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('show_date'));?>">
          <?php esc_html_e( 'Show Posts Date', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat"
          id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" value="1" <?php checked($show_date,'1'); ?>/>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('postsperpage'));?>">
          <?php esc_html_e('Posts Per Page',IEPA_TEXT_DOMAIN)?>
        </label>
        <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'postsperpage' )); ?>"
        name="<?php echo esc_attr($this->get_field_name( 'postsperpage' )); ?>" value="<?php echo esc_attr( $postsperpage ); ?>"/>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('slider_mode'));?>">
          <?php esc_html_e( 'Slider Mode', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select name="<?php echo esc_attr($this->get_field_name('slider_mode')); ?>"
          id="<?php echo esc_attr($this->get_field_id('slider_mode')); ?>" class="widefat">
          <option value="horizontal"  <?php selected( 'horizontal', $slider_mode ); ?>>
            <?php esc_html_e( 'Horizontal', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="vertical"  <?php selected('vertical', $slider_mode); ?>>
            <?php esc_html_e( 'Vertical', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="fade"  <?php selected('fade', $slider_mode); ?>>
            <?php esc_html_e( 'Fade', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_slider_controls' )); ?>">
          <?php esc_html_e( 'Show Slider Controls', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_slider_controls' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'show_slider_controls' )); ?>"
          value="true" <?php checked( $show_slider_controls, 'true' ); ?>
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('speed'));?>">
          <?php esc_html_e( 'Slider Speed', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'speed' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'speed' )); ?>" value="<?php echo esc_attr( $speed ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('duration'));?>">
          <?php esc_html_e( 'Slider Pause Duration', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'duration' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'duration' )); ?>" value="<?php echo esc_attr( $duration ); ?>"
        />
      </p>

      <p class="description">
        <?php esc_html_e( 'Note: Duration between each slide in milliseconds(pause) in ms.', IEPA_TEXT_DOMAIN ); ?>
      </p>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id('autoslide')); ?>">
          <?php esc_html_e( 'Auto Slide', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select name="<?php echo esc_attr($this->get_field_name('autoslide')); ?>"
          id="<?php echo esc_attr($this->get_field_id('autoslide')); ?>" class="widefat">
          <option value="true"  <?php selected('true', $autoslide); ?>>
            <?php esc_html_e( 'True', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="false"  <?php selected('false', $autoslide); ?>>
            <?php esc_html_e( 'False', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </p>

      <p class="descritpion">
        <?php esc_html_e( 'Note: If Choose true, slides will automatically transition. Default Value:true', IEPA_TEXT_DOMAIN ); ?>
      </p>
      <?php
    }
  }

}
