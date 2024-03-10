<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}

if ( ! class_exists('IEPA_Mega_Menu_Contact_Info') ) {

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_Contact_Info extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'iepamegamenu_contact_info', // Base ID
        __( 'IEPA MM :  Contact Info', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __( 'Display IEPA Mega Menu Contact Information.', IEPA_TEXT_DOMAIN )
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

      echo wp_kses_post("<div class='iepamegamenu-contact-info'>");

      if( isset( $instance['address_font_icon'] ) || isset( $instance['address'] ) ) {
        echo wp_kses_post("<p>");
        if( isset( $instance['address_font_icon'] ) && $instance['address_font_icon'] != '' ) {
          echo wp_kses_post("<i class='" . esc_attr( $instance['address_font_icon'] ) . "'></i>");
        }
        if( isset( $instance['address'] ) && $instance['address'] != '' ) {
          echo esc_html__( $instance['address'], IEPA_TEXT_DOMAIN );
        }
        echo wp_kses_post("</p>");
      }

      if( isset( $instance['phone_font_icon'] ) || isset( $instance['phone'] ) ) {
        echo wp_kses_post("<p>");
        if( isset( $instance['phone_font_icon'] ) && $instance['phone_font_icon'] != '' ) {
          echo wp_kses_post("<i class='" . esc_attr( $instance['phone_font_icon'] ) . "'></i>");
        }
        if( isset( $instance['phone'] ) && $instance['phone'] != '' ) {
          echo esc_html__( $instance['phone'], IEPA_TEXT_DOMAIN );
        }
        echo wp_kses_post("</p>");
      }

      if( isset( $instance['email_font_icon'] ) || isset( $instance['email'] ) ) {
        echo wp_kses_post("<p>");
        if( isset( $instance['email_font_icon'] ) && $instance['email_font_icon'] != '' ) {
          echo wp_kses_post("<i class='" . esc_attr( $instance['email_font_icon'] ) . "'></i>");
        }
        if( isset( $instance['email'] ) && $instance['email'] != '' ) {
          echo esc_html__( $instance['email'], IEPA_TEXT_DOMAIN );
        }
        echo wp_kses_post("</p>");
      }

      if( isset( $instance['website_font_icon'] ) || isset( $instance['website'] ) ) {
        echo wp_kses_post("<p>");
        if( isset( $instance['website_font_icon'] ) && $instance['website_font_icon'] != '' ) {
          echo wp_kses_post("<i class='" . esc_attr( $instance['website_font_icon'] ) . "'></i>");
        }
        if( isset( $instance['website'] ) && $instance['website'] != '' ) {
          echo esc_html__( $instance['website'], IEPA_TEXT_DOMAIN );
        }
        echo wp_kses_post("</p>");
      }

      if(
        isset( $instance['custom_shortcode_title'] ) && $instance['custom_shortcode_title'] != '' ||
        ( isset( $instance['custom_shortcode'] ) ) && $instance['custom_shortcode'] != ''
      ) {
        echo wp_kses_post("<div class='iepa-social-shortcodes'>");
        echo wp_kses_post("<h4>") . esc_html__( $instance['custom_shortcode_title'], IEPA_TEXT_DOMAIN ) . wp_kses_post("</h4>");
        if( $instance['custom_shortcode'] != '' ) {
          echo do_shortcode( $instance['custom_shortcode'] );
        }
        echo wp_kses_post("</div>");
      }

      echo wp_kses_post("</div>");
      echo $args['after_widget'];
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
      $instance['title']                  = strip_tags( $new_instance['title'] );
      $instance['address']                = strip_tags( $new_instance['address'] );
      $instance['address_font_icon']      = strip_tags( $new_instance['address_font_icon'] );
      $instance['phone']                  = strip_tags( $new_instance['phone'] );
      $instance['phone_font_icon']        = strip_tags( $new_instance['phone_font_icon'] );
      $instance['email']                  = strip_tags( $new_instance['email'] );
      $instance['email_font_icon']        = strip_tags( $new_instance['email_font_icon'] );
      $instance['website']                = strip_tags( $new_instance['website'] );
      $instance['website_font_icon']      = strip_tags( $new_instance['website_font_icon'] );
      $instance['custom_shortcode']       = strip_tags( $new_instance['custom_shortcode'] );
      $instance['custom_shortcode_title'] = strip_tags( $new_instance['custom_shortcode_title'] );

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
      if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
      } else {
        $title = '';
      }

      if( isset( $instance['address'] ) ) {
        $address = $instance['address'];
      } else {
        $address = '';
      }

      if( isset( $instance['address_font_icon'] ) ) {
        $address_font_icon = $instance['address_font_icon'];
      } else {
        $address_font_icon = '';
      }

      if( isset( $instance['phone'] ) ) {
        $phone = $instance['phone'];
      } else {
        $phone = '';
      }

      if( isset( $instance['phone_font_icon'] ) ) {
        $phone_font_icon = $instance['phone_font_icon'];
      } else {
        $phone_font_icon = '';
      }

      if( isset( $instance['email'] ) ) {
        $email = $instance['email'];
      } else {
        $email = '';
      }

      if( isset( $instance['email_font_icon'] ) ) {
        $email_font_icon = $instance['email_font_icon'];
      } else {
        $email_font_icon = '';
      }

      if( isset($instance['website']) ) {
        $website = $instance['website'];
      } else {
        $website = '';
      }

      if( isset( $instance['website_font_icon'] ) ) {
        $website_font_icon = $instance['website_font_icon'];
      } else {
        $website_font_icon = '';
      }

      if( isset( $instance['custom_shortcode'] ) ) {
        $custom_shortcode = $instance['custom_shortcode'];
      } else {
        $custom_shortcode = '';
      }

      if( isset( $instance['custom_shortcode_title'] ) ) {
        $custom_shortcode_title = $instance['custom_shortcode_title'];
      } else {
        $custom_shortcode_title = '';
      }
      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
          <?php esc_html_e( 'Title:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat"
          id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text"
          value="<?php echo esc_attr( $title ); ?>"
        >
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'address_font_icon' )); ?>">
          <?php esc_html_e( 'Address Icon:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class="description">
          <?php esc_html_e( 'Use Fontawesome Class for Address Icon such as fa fa-home', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address_font_icon' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'address_font_icon' )); ?>" type="text"
          value="<?php echo esc_attr( $address_font_icon ); ?>"
          placeholder="<?php esc_attr_e( 'E.g., fa fa-home', IEPA_TEXT_DOMAIN );?>"
        >
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>">
          <?php esc_html_e( 'Address', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>"><?php echo esc_textarea( $address ); ?></textarea>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'phone_font_icon' )); ?>">
          <?php esc_html_e( 'Phone Icon:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class="description">
          <?php esc_html_e( 'Use Fontawesome Class for Phone Icon such as fa fa-phone', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone_font_icon' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'phone_font_icon' )); ?>" type="text"
          value="<?php echo esc_attr( $phone_font_icon ); ?>"
          placeholder="<?php esc_attr_e( 'E.g., fa fa-phone', IEPA_TEXT_DOMAIN ); ?>"
        >
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>">
          <?php esc_attr_e( 'Phone:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat"
          id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" type="text"
          value="<?php echo esc_attr( $phone ); ?>">
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'email_font_icon' )); ?>">
          <?php esc_html_e( 'Email Icon:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class="description">
          <?php esc_html_e( 'Use Fontawesome Class for Email Icon such as fa fa-phone', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email_font_icon' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'email_font_icon' )); ?>" type="text"
          value="<?php echo esc_attr( $email_font_icon ); ?>"
          placeholder="<?php esc_attr_e( 'E.g., fa fa-email', IEPA_TEXT_DOMAIN ); ?>">
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>">
          <?php esc_html_e( 'Email:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" type="email"
          value="<?php echo esc_attr( $email ); ?>">
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'website_font_icon' )); ?>">
          <?php esc_html_e( 'Website Icon:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <p class="description">
          <?php esc_html_e( 'Use Fontawesome Class for Website Icon such as fa fa-phone', IEPA_TEXT_DOMAIN ); ?>
        </p>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'website_font_icon' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'website_font_icon' )); ?>" type="text"
          value="<?php echo esc_attr( $website_font_icon ); ?>"
          placeholder="<?php esc_attr_e( 'E.g., fa fa-globe', IEPA_TEXT_DOMAIN ); ?>">
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'website' )); ?>">
          <?php esc_html_e( 'Website:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'website' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'website' )); ?>" type="text"
          value="<?php echo esc_attr( $website ); ?>">
      </p>


      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'custom_shortcode_title' )); ?>">
          <?php esc_html_e( 'Custom Title', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'custom_shortcode_title' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'custom_shortcode_title' )); ?>"
          value="<?php echo esc_attr( $custom_shortcode_title ); ?>"/>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'custom_shortcode' )); ?>">
          <?php esc_html_e( 'Custom Shortcode', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <textarea class="widefat"
          id="<?php echo esc_attr($this->get_field_id( 'custom_shortcode' )); ?>"
          name="<?php echo esc_attr($this->get_field_name( 'custom_shortcode' )); ?>"><?php echo esc_textarea( $custom_shortcode ); ?></textarea>
      </p>
      <?php
    }
  }

}
