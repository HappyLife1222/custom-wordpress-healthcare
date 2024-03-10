<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists( 'IEPA_Mega_Menu_LinkImage' ) ) {

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_LinkImage extends WP_Widget {


    public function __construct() {
      parent::__construct(
        'iepamegamenu_pro_linkimage', // Base ID
        __( 'IEPA : Custom Image Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __(
            'A widget to show uploaded image with url link.',
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

      $linktarget   = ( isset( $instance['linktarget'] ) && $instance['linktarget'] != '' ) ? $instance['linktarget'] : '';
      $url_link     = ( isset( $instance['url_link'] ) && $instance['url_link'] != '' ) ? $instance['url_link'] : '#';
      $customimage  = ( isset( $instance['customimage'] ) && $instance['customimage'] != '' ) ? $instance['customimage'] : '';
      $cwidth       = ( isset( $instance['cwidth'] ) && $instance['cwidth'] != '' ) ? $instance['cwidth'] : '';
      $cheight      = ( isset( $instance['cheight'] ) && $instance['cheight'] != '' ) ? $instance['cheight'] : '';


      if( $customimage != '' ) {
        ?>
        <div class="imma-image-link-wrapper">
          <a href="<?php echo esc_url( $url_link ); ?>" target="<?php echo esc_attr( $linktarget ); ?>">
            <img src="<?php echo esc_url( $customimage ); ?>" class="iepa-custom-image" />
          </a>
        </div>
        <?php
      }

      echo $args['after_widget'];
    }


    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {
      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;

      $iepa_custom_css = '';


      $customimage  = ( isset( $iepa_mm_widget_data_by_id['customimage'] ) && $iepa_mm_widget_data_by_id['customimage'] != '' ) ? $iepa_mm_widget_data_by_id['customimage'] : '';
      $cwidth       = ( isset( $iepa_mm_widget_data_by_id['cwidth'] ) && $iepa_mm_widget_data_by_id['cwidth'] != '' ) ? $iepa_mm_widget_data_by_id['cwidth'] : '';
      $cheight      = ( isset( $iepa_mm_widget_data_by_id['cheight'] ) && $iepa_mm_widget_data_by_id['cheight'] != '' ) ? $iepa_mm_widget_data_by_id['cheight'] : '';


      if ( $customimage != '' ) {

        if ( $cwidth != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .imma-image-link-wrapper img.iepa-custom-image {
            width: ' . $cwidth . 'px;
          }
          ';
        }

        if ( $cheight != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .imma-image-link-wrapper img.iepa-custom-image {
            height: ' . $cheight . 'px;
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
      $instance                 = $old_instance;
      $instance['title']        = strip_tags( $new_instance['title'] );
      $instance['linktarget']   = strip_tags( $new_instance['linktarget'] );
      $instance['url_link']     = strip_tags( $new_instance['url_link'] );
      $instance['customimage']  = strip_tags( $new_instance['customimage'] );
      $instance['cwidth']       = strip_tags( $new_instance['cwidth'] );
      $instance['cheight']      = strip_tags( $new_instance['cheight'] );

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

      $title        = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $linktarget   = isset( $instance[ 'linktarget' ] ) ? $instance[ 'linktarget' ] : '';
      $url_link     = isset( $instance[ 'url_link' ] ) ? $instance[ 'url_link' ] : '';
      $customimage  = ( isset( $instance[ 'customimage' ] ) && $instance[ 'customimage' ] != '' ) ? $instance[ 'customimage' ] : IEPA_MM_IMG_DIR . '/no_preview.jpg';
      $cwidth       = isset( $instance[ 'cwidth' ] ) ? $instance[ 'cwidth' ] : '';
      $cheight      = isset( $instance[ 'cheight' ] ) ? $instance[ 'cheight' ] : '';


      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
          <?php esc_html_e( 'Title:' ,IEPA_TEXT_DOMAIN); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('url_link'));?>">
          <?php esc_html_e( 'URL Link', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url_link' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'url_link' )); ?>" value="<?php echo esc_url( $url_link ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('linktarget')); ?>">
          <?php esc_html_e( 'Select Image Link Target', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr($this->get_field_name('linktarget')); ?>"
          id="<?php echo esc_attr($this->get_field_id('linktarget')); ?>" class="widefat">
          <option value="_blank"  <?php selected('_blank', $linktarget); ?>>
            <?php esc_html_e( '_blank', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="_self"  <?php selected('_self', $linktarget); ?>>
            <?php esc_html_e( '_self', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="_parent" <?php selected('_parent', $linktarget); ?>>
            <?php esc_html_e( '_parent', IEPA_TEXT_DOMAIN ); ?>
          </option>
          <option value="_top"  <?php selected('_top', $linktarget); ?>>
            <?php esc_html_e( '_top', IEPA_TEXT_DOMAIN ); ?>
          </option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('customimage'));?>">
          <?php esc_html_e( 'Choose Custom Image', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="hidden" class="widefat iepa-image-url" id="<?php echo esc_attr($this->get_field_id( 'customimage' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'customimage' )); ?>" value="<?php echo esc_url( $customimage ); ?>"
        />
        <input type="button" class="imma_image_url button button-primary button-large"
          id="<?php echo esc_attr($this->get_field_id( 'customimage' )); ?>" name="imma_image_url"  value="Upload Image"
          size="25"/>
        <br/>
        <img style="width: 15%;" class="imma-image" src="<?php echo esc_url( $customimage ); ?>">
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('cwidth'));?>">
          <?php esc_html_e( 'Custom Width', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cwidth' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'cwidth' )); ?>" value="<?php echo esc_attr( $cwidth ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('cheight')); ?>">
          <?php esc_html_e( 'Custom Height', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cheight' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'cheight' )); ?>" value="<?php echo esc_attr( $cheight ); ?>"/>
      </p>
      <?php
    }
  }

}
