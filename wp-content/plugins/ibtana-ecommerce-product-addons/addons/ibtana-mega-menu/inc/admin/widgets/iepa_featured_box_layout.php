<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists( 'IEPA_Mega_Menu_FeatureBox' ) ) :

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_FeatureBox extends WP_Widget {

    /**
    * Specifies the classname and description, instantiates the widget,
    * loads localization files, and includes necessary stylesheets and JavaScript.
    */
    public function __construct() {

      parent::__construct(
        'iepa_featured_box_layout',
        __(
          'IEPA : Featured Box Layout',
          IEPA_TEXT_DOMAIN
        ),
        array(
          'classname'   =>  'widget_imma_featuredbox_widget imma-fbox',
          'description' =>  esc_html(
            'A widget display featured box layout',
            IEPA_TEXT_DOMAIN
          )
        )
      );

    } // end constructor


    /**
    * Outputs the content of the widget.
    *
    * @param array args    The array of form elements
    * @param array instance  The current instance of the widget
    */
    public function widget( $args, $instance ) {

      echo $args['before_widget'];
      if ( !empty( $instance['heading_title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['heading_title'] ) . $args['after_title'];
      }

      $features         = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();
      $link_target      = ( ! empty( $instance['link_target'] ) ) ? $instance['link_target'] : '_self';
      $font_icon_size   = ( ! empty( $instance['font_icon_size'] ) ) ? $instance['font_icon_size'] : '';
      $font_icon_margin = ( ! empty( $instance['font_icon_margin'] ) ) ? $instance['font_icon_margin'] : '';
      $featured_type    = ( ! empty( $instance['featured_type'] ) && $instance['featured_type'] == "horiontal" ) ? 'iepa-featured-horizontal-type' : 'iepa-featured-vertical-type';
      // echo $before_widget;
      ?>
      <div class="iepa-featuredbox imma-section <?php echo esc_attr( $featured_type );?>">

        <?php
        foreach( $features as $feature ) {
          ?>
          <div class="iepa-featured-box-section">
            <div class="iepa-featuredbox">
              <?php
              if( $feature['firstlink'] != '' ) {
                ?>
                <a href="<?php echo esc_url( $feature['firstlink'] );?>" target="<?php echo esc_attr( $link_target ); ?>">
                  <?php
                }

                if( !empty( $feature['fonticon_class'] ) ) {
                  ?>
                  <div class="iepa-icon-text-icon">
                    <i class="<?php echo esc_attr( $feature['fonticon_class'] ); ?>"></i>
                  </div>
                  <?php
                }

                ?>

                <div class="iepa-feature-box-info">
                  <?php
                  if( !empty( $feature['titletag'] ) ) {
                    ?>
                    <span class="iepa-title-tag">
                      <?php esc_html_e( $feature['titletag'], 'ibtana-ecommerce-product-addons' ); ?>
                    </span>
                    <?php
                  }

                  if( !empty( $feature['description'] ) ) {
                    esc_html_e( $feature['description'] );
                  }
                  ?>
                </div>

                <?php
                if( $feature['firstlink'] != '' ) {
                  ?>
                </a>
                <?php
              }
              ?>

            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <?php
      echo $args['after_widget'];
    }


    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;

      $features = ( ! empty( $iepa_mm_widget_data_by_id['features'] ) ) ? $iepa_mm_widget_data_by_id['features'] : array();

      $font_icon_size   = ( ! empty( $iepa_mm_widget_data_by_id['font_icon_size'] ) ) ? $iepa_mm_widget_data_by_id['font_icon_size'] : '';
      $font_icon_margin = ( ! empty( $iepa_mm_widget_data_by_id['font_icon_margin'] ) ) ? $iepa_mm_widget_data_by_id['font_icon_margin'] : '';


      $iepa_custom_css = '';

      if ( ! empty( $features ) ) {

        if ( $font_icon_size != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-featured-box-section .iepa-icon-text-icon i {
            font-size: ' . $font_icon_size . 'px;
          }
          ';
        }

        if ( $font_icon_margin != "" ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .iepa-featured-box-section .iepa-icon-text-icon i {
            margin: ' . $font_icon_margin . ';
          }
          ';
        }

      }

      return $iepa_custom_css;

    }


    public function update( $new_instance, $old_instance ) {

      $instance = $old_instance;

      $instance['heading_title']    = sanitize_text_field( $new_instance['heading_title'] );
      $instance['featured_type']    = sanitize_text_field( $new_instance['featured_type'] );
      $instance['link_target']      = sanitize_text_field( $new_instance['link_target'] );
      $instance['font_icon_size']   = sanitize_text_field( $new_instance['font_icon_size'] );
      $instance['font_icon_margin'] = sanitize_text_field( $new_instance['font_icon_margin'] );

      foreach( $new_instance['features'] as $feature ) {
        $feature['titletag']        = sanitize_text_field($feature['titletag']);
        $feature['fonticon_class']  = sanitize_text_field($feature['fonticon_class']);
        $feature['description']     = sanitize_text_field($feature['description']);
        $feature['firstlink']       = sanitize_text_field($feature['firstlink']);

      }
      $instance['features'] = $new_instance['features'];

      return $instance;

    }

    public function form( $instance ) {
      $heading_title    = isset( $instance[ 'heading_title' ] ) ? $instance[ 'heading_title' ] : '';
      $featured_type    = isset( $instance[ 'featured_type' ] ) ? $instance[ 'featured_type' ] : '';
      $font_icon_size   = isset( $instance[ 'font_icon_size' ] ) ? $instance[ 'font_icon_size' ] : '';
      $link_target      = isset( $instance[ 'link_target' ] ) ? $instance[ 'link_target' ] : '_self';
      $font_icon_margin = isset( $instance[ 'font_icon_margin' ] ) ? $instance[ 'font_icon_margin' ] : '';
      $featured_types   = array(
        'vertical'  => __( 'Vertical Type', IEPA_TEXT_DOMAIN ),
        'horiontal' => __( 'Horiontal Type', IEPA_TEXT_DOMAIN )
      );
      $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();
      ?>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'heading_title' ) ); ?>">
          <?php esc_html_e( 'Heading Title:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading_title' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'heading_title' ) ); ?>" type="text"
          value="<?php echo esc_attr( $heading_title ); ?>"
        >
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'featured_type' ) ); ?>">
          <?php esc_html_e( 'Select Featured Lists Type', IEPA_TEXT_DOMAIN ); ?>:
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'featured_type' ) ); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'featured_type' ) ); ?>" class="widefat immapro-featured-listtype"
        >
        <?php
        foreach ( $featured_types as $f_type => $type ) {
          ?>
          <option value="<?php echo esc_attr( esc_attr( $f_type ) ); ?>" <?php selected( $f_type, $featured_type ); ?>>
            <?php echo esc_html( $type ); ?>
          </option>
          <?php
        }
        ?>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id('link_target') ); ?>">
          <?php esc_html_e( 'Select Posts Link Target', IEPA_TEXT_DOMAIN ) ?>:
        </label>

        <select name="<?php echo esc_attr( $this->get_field_name( 'link_target' ) ); ?>"
          id="<?php echo esc_attr( $this->get_field_id('link_target') ); ?>" class="widefat">
          <option value="_blank"  <?php selected('_blank', $link_target); ?>><?php esc_html_e('_blank',IEPA_TEXT_DOMAIN);?></option>
          <option value="_self"  <?php selected('_self', $link_target); ?>><?php esc_html_e('_self',IEPA_TEXT_DOMAIN);?></option>
          <option value="_parent" <?php selected('_parent', $link_target); ?>><?php esc_html_e('_parent',IEPA_TEXT_DOMAIN);?></option>
          <option value="_top"  <?php selected('_top', $link_target); ?>><?php esc_html_e('_top',IEPA_TEXT_DOMAIN);?></option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'font_icon_size' ) ); ?>">
          <?php esc_html_e( 'Font Icon Size:' ,IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'font_icon_size' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'font_icon_size' ) ); ?>" type="number"
          value="<?php echo esc_attr( $font_icon_size ); ?>"
        >
      </p>

      <p class="description">
        <?php esc_html_e( 'Set custom font size for font awesome icons.Number Value set as px.', IEPA_TEXT_DOMAIN ); ?>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'font_icon_margin' ) ); ?>">
          <?php esc_html_e( 'Font Icon Margin:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'font_icon_margin' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'font_icon_margin' ) ); ?>" type="text"
          value="<?php echo esc_attr( $font_icon_margin ); ?>"
          placeholder="<?php echo esc_attr( 'For E.g.,2px 4px 5px 6px', IEPA_TEXT_DOMAIN ); ?>"
        >
      </p>

      <p class="description">
        <?php
        esc_html_e(
          'Set custom font marign for font awesome icons.For example: margin:10px 5px 15px 20px; Here, top margin is 10px, right margin is 5px, bottom margin is 15px and left margin is 20px',
          IEPA_TEXT_DOMAIN
        );
        ?>
      </p>

      <span class="imma-additional">
        <?php
        $c = 0;
        if ( count( $features ) > 0 ) {
          foreach( $features as $feature ) {
            //if ( isset( $feature['title'] ) || isset( $feature['description'] ) ) {
            ?>
            <div class="iepa-featured-section">
              <div class="sub-option section widget-icon-class">

                <h3><?php echo esc_html( 'Box ' ); ?><?php echo esc_html( $c + 1 );?></h3>

                <label for="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][fonticon_class]' ); ?>">
                  <?php esc_html_e( 'Font Icon Class :', IEPA_TEXT_DOMAIN ); ?>
                </label>
                <input class="widefat imma-font-class"
                  id="<?php echo esc_attr( $this->get_field_id( 'features' ) .'-'. $c.'-fonticon_class' ); ?>"
                  name="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][fonticon_class]' ); ?>" type="text"
                  value="<?php echo esc_attr( $feature['fonticon_class'] ); ?>" placeholder="fa fa-home"
                />

                <label for="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][titletag]' ); ?>">
                  <?php esc_html_e( 'Title Tag :', IEPA_TEXT_DOMAIN ); ?>
                </label>
                <input class="widefat"
                  id="<?php echo esc_attr( $this->get_field_id( 'features' ) .'-'. $c.'-titletag' ); ?>"
                  name="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][titletag]' ); ?>" type="text"
                  value="<?php echo esc_attr( $feature['titletag'] ); ?>"
                />

                <label for="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][firstlink]' ); ?>">
                  <?php esc_html_e( 'URL Link :',IEPA_TEXT_DOMAIN ); ?>
                </label>
                <input class="widefat"
                  id="<?php echo esc_attr( $this->get_field_id( 'features' ) .'-'. $c.'-firstlink' ); ?>"
                  name="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][firstlink]' ); ?>" type="text"
                  value="<?php echo esc_attr( $feature['firstlink'] ); ?>"
                />


                <label for="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][description]' ); ?>">
                  <?php esc_html_e( 'Description :', IEPA_TEXT_DOMAIN ); ?>
                </label>
                <textarea class="widefat"
                  id="<?php echo esc_attr( $this->get_field_id( 'features' ) .'-'. $c.'-description' ); ?>"
                  name="<?php echo esc_attr( $this->get_field_name( 'features' ) . '['.$c.'][description]' ); ?>" >
                  <?php echo esc_textarea( $feature['description'] ); ?>
                </textarea>

                <a class="iepamegamenu-remove delete"><?php esc_html_e( 'Remove Section', IEPA_TEXT_DOMAIN ); ?></a>
              </div>
            </div>
            <?php
            $c++;
            // }
          }
        }

        ?>
      </span>
      <a class="iepa-add-featuredbox button"><?php esc_html_e( 'Add New Featured Box', IEPA_TEXT_DOMAIN ); ?></a>
      <?php
    } // end form

  } // end class

endif;
