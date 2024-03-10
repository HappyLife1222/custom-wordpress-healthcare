<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists( 'IEPA_Mega_Menu_GalleryImageWidget' ) ) {

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_GalleryImageWidget extends WP_Widget {


    public function __construct() {
      parent::__construct(
        'iepamegamenu_pro_gallery_image', // Base ID
        __( 'IEPA : Gallery Shortcode Widget', IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __( 'A widget to display gallery images using shortcode.', IEPA_TEXT_DOMAIN )
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

      $gallery_shortcode  = ( isset( $instance['gallery_shortcode'] ) && $instance['gallery_shortcode'] != '' ) ? esc_attr( $instance['gallery_shortcode'] ) : '';

      ?>
      <div class="iepa-image-gallery-widget">

        <?php echo do_shortcode( $gallery_shortcode ); ?>

      </div>
      <?php
      echo $args['after_widget'];
    }

    /*
    * Sanitize widget form values as they are saved.
    * @see WP_Widget::update()
    * @param array   $new_instance Values just sent to be saved.
    * @param array   $old_instance Previously saved values from database.
    * @return array Updated safe values to be saved.
    */

    function update( $new_instance, $old_instance ) {
      $instance                       = $old_instance;
      $instance['title']              = strip_tags($new_instance['title']);
      $instance['gallery_shortcode']  = strip_tags($new_instance['gallery_shortcode']);

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

      $title              = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $gallery_shortcode  = isset( $instance[ 'gallery_shortcode' ] ) ? $instance[ 'gallery_shortcode' ] : '';

      ?>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
          <?php esc_html_e( 'Title:' ,IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
          type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>


      <div class="imma-description-steps">
        <h4>
          <?php esc_html_e( 'Follow the below to step to get gallery shortcode.', IEPA_TEXT_DOMAIN ); ?>
        </h4>
        <ul>
          <?php $admin_url = admin_url(); ?>
          <li>> <?php esc_html_e( 'Go to Admin add new posts from here ', IEPA_TEXT_DOMAIN ); ?> <a href="<?php echo esc_attr( $admin_url . 'post-new.php' ); ?>" target="_blank"><?php esc_html_e('Add New Posts',IEPA_TEXT_DOMAIN);?></a>
          </li>
          <li>> <?php esc_html_e('Click on Add Media Button and then create gallery options tab on Insert Media popup form.',IEPA_TEXT_DOMAIN);?></li>
          <li>> <?php esc_html_e('Then Choose multiple images and click on create a new gallery button below.',IEPA_TEXT_DOMAIN);?></li>
          <li>> <?php esc_html_e('Click on Insert Gallery Button after all images have been selected as per requirement.',IEPA_TEXT_DOMAIN);?></li>
          <li>> <?php esc_html_e('You will get the gallery shortcode on editor area such as [gallery ids="479,441"] with selected images id.',IEPA_TEXT_DOMAIN);?></li>
          <li>> <?php esc_html_e('Copy the shortcode and paste on below shortcode textarea.',IEPA_TEXT_DOMAIN);?></li>
        </ul>
      </div>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('gallery_shortcode') ); ?>">
          <?php esc_html_e( 'Gallery Shortcode', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <br/>
        <textarea id="<?php echo esc_attr( $this->get_field_id( 'gallery_shortcode' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'gallery_shortcode' ) ); ?>" cols="60" rows="5"><?php echo esc_textarea( $gallery_shortcode ); ?></textarea>
      </p>

      <?php
    }
  }

}
