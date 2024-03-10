<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists( 'IEPA_Mega_Menu_TextImage' ) ) {

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_TextImage extends WP_Widget {


    public function __construct() {
      parent::__construct(
        'iepamegamenu_pro_textimage', // Base ID
        __( 'IEPA : Text Image Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __(
            'A widget to show title, description with image.',
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
      $title_color  = ( isset( $instance['title_color_imma_text_widget_color'] ) && $instance['title_color_imma_text_widget_color'] != '' ) ? $instance['title_color_imma_text_widget_color'] : '';
      if ( !empty( $instance['title'] ) ) {
        // echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        echo wp_kses_post('<h4 class="iepa-mega-block-title">' . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']);
      }

      $sub_title              = ( isset( $instance['sub_title'] ) && $instance['sub_title'] != '' ) ? $instance['sub_title'] : '';
      $description            = ( isset( $instance['description'] ) && $instance['description'] != '' ) ? $instance['description'] : '';
      $url_link               = ( isset( $instance['url_link'] ) && $instance['url_link'] != '' ) ? $instance['url_link'] : '#';
      $textwidget_url_target  = ( isset( $instance['url_target'] ) && $instance['url_target'] != '_self' ) ? $instance['url_target'] : '_self';
      $button_name            = ( isset( $instance['button_name'] ) && $instance['button_name'] != '' ) ? $instance['button_name'] : '';
      $image                  = ( isset( $instance['image'] ) && $instance['image'] != '' ) ? $instance['image'] : '';

      ?>

      <div class='iepa-text-widgets'>
        <div class="thumb">
          <a href="<?php echo esc_url( $url_link ); ?>" target="<?php echo esc_attr( $textwidget_url_target ); ?>">
            <?php
            if( $image  != '' && $image != IEPA_MM_IMG_DIR . '/no_preview.jpg' ) {
              ?>
              <img src="<?php echo esc_url( $image ); ?>" class="image-responsive iepa-post-image"
                alt="custom-image" width="50" height="50"
              />
              <?php
            }
            ?>
            <div class="iepamegamenupro-overlay"></div>
          </a>
        </div>

        <div class="iepa-header">
          <?php
          if( $sub_title != '' ) {
            ?>
            <h2 class="entry-title">
              <a href="<?php echo esc_url( $url_link ); ?>" target="<?php echo esc_attr( $textwidget_url_target ); ?>">
                <?php esc_html( $sub_title ); ?>
              </a>
            </h2>
            <?php
          }

          if( $description != '' ) {
            ?>
            <p class="imma-desc">
              <?php _e( do_shortcode( $description ), 'ibtana-ecommerce-product-addons' ); ?>
            </p>
            <?php
          }

          if( $button_name != '' ) {
            ?>
            <div class="wimma-linkbtn">
              <a href="<?php echo esc_url( $url_link ); ?>" target="<?php echo esc_attr( $textwidget_url_target ); ?>">
                <?php echo esc_html( $button_name ); ?>
              </a>
            </div>
            <?php
          }
          ?>
        </div>

      </div>
      <?php
      echo $args['after_widget'];
    }


    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;

      $title        = (
        isset( $iepa_mm_widget_data_by_id['title'] ) && ( $iepa_mm_widget_data_by_id['title'] != '' )
        ) ? $iepa_mm_widget_data_by_id['title'] : '';

      $title_color  = (
        isset( $iepa_mm_widget_data_by_id['title_color_imma_text_widget_color'] ) && ( $iepa_mm_widget_data_by_id['title_color_imma_text_widget_color'] != '' )
        ) ? $iepa_mm_widget_data_by_id['title_color_imma_text_widget_color'] : '';

      $iepa_custom_css = '';

      if ( $title != '' ) {
        if ( $title_color != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-mega-block-title {
            color: ' . $title_color . ';
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

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title']                              = strip_tags($new_instance['title']);
      $instance['sub_title']                          = strip_tags($new_instance['sub_title']);
      $instance['description']                        = strip_tags($new_instance['description']);
      $instance['url_link']                           = strip_tags($new_instance['url_link']);
      $instance['button_name']                        = strip_tags($new_instance['button_name']);
      $instance['image']                              = strip_tags($new_instance['image']);
      $instance['url_target']                         = strip_tags($new_instance['url_target']);
      $instance['title_color_imma_text_widget_color'] = strip_tags($new_instance['title_color_imma_text_widget_color']);

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

      $title        = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
      $sub_title    = isset($instance[ 'sub_title' ])?$instance[ 'sub_title' ]:'';
      $description  = isset($instance[ 'description' ])?$instance[ 'description' ]:'';
      $url_link     = isset($instance[ 'url_link' ])?$instance[ 'url_link' ]:'';
      $button_name  = isset($instance[ 'button_name' ])?$instance[ 'button_name' ]:'';
      $url_target   = isset($instance[ 'url_target' ])?$instance[ 'url_target' ]:'_self';
      $title_color  = isset($instance[ 'title_color_imma_text_widget_color' ])?$instance[ 'title_color_imma_text_widget_color' ]:'';
      $image        = (isset($instance[ 'image' ]) && $instance[ 'image' ] != '')?$instance[ 'image' ]:IEPA_MM_IMG_DIR.'/no_preview.jpg';

      ?>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
          <?php esc_html_e( 'Title:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"
          type="text" value="<?php echo esc_attr( $title ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('sub_title')); ?>">
          <?php esc_html_e( 'Sub Title', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'sub_title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'sub_title' )); ?>" value="<?php echo esc_attr( $sub_title ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('description'));?>">
          <?php esc_html_e( 'Description', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>"><?php echo esc_textarea( $description ); ?></textarea>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('url_link')); ?>">
          <?php esc_html_e( 'URL Link', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url_link' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'url_link' )); ?>" value="<?php echo esc_url( $url_link ); ?>"/>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('button_name')); ?>">
          <?php esc_html_e( 'Button Name', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_name' ) ); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'button_name' )); ?>"
          placeholder="<?php esc_attr_e( 'BUY NOW', IEPA_TEXT_DOMAIN ); ?>"
          value="<?php echo esc_attr( $button_name ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('url_target')); ?>">
          <?php esc_html_e( 'Choose Target', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select name="<?php echo esc_attr($this->get_field_name('url_target')); ?>" class="widefat">
          <option value="_self" <?php selected( '_self', $url_target ); ?>>
            <?php esc_html_e( '_self', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="_blank" <?php selected( '_blank', $url_target ); ?>>
            <?php esc_html_e( '_blank', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="_parent" <?php selected( '_parent', $url_target ); ?>>
            <?php esc_html_e( '_parent', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="_top" <?php selected( '_top', $url_target ); ?>>
            <?php esc_html_e( '_top', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('title_color'));?>">
          <?php esc_html_e( 'Choose Title Color', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <div class="rt-section-styling">
          <input type='text' class="imma-mm-color-picker"
            name="<?php echo esc_attr($this->get_field_name( 'title_color_imma_text_widget_color' )); ?>"
            value="<?php echo esc_attr( $title_color ); ?>"
          />
        </div>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('image')); ?>">
          <?php esc_html_e( 'Choose Image', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="hidden" class="widefat iepa-image-url" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" value="<?php echo esc_url( $image ); ?>"
        />
        <input type="button" class="imma_image_url button button-primary button-large"
          id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="imma_image_url"  value="Upload Image"
          size="25"
        />
        <br/>
        <img style="width: 22%;" class="imma-image" src="<?php echo esc_url( $image ); ?>">
      </p>
      <?php
    }

  }

}
