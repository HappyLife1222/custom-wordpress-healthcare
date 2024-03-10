<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}



if ( ! class_exists( 'IEPA_Mega_Menu_PostCategoryLayout' ) ) :

  /**
  * Outputs a contact information from widget
  */
  class IEPA_Mega_Menu_PostCategoryLayout extends WP_Widget {

    /**
    * Specifies the classname and description, instantiates the widget,
    * loads localization files, and includes necessary stylesheets and JavaScript.
    */
    public function __construct() {

      parent::__construct(
        'iepa_post_category_tabs_widget',
        __(
          'IEPA: Post Taxonomy Layout',
          IEPA_TEXT_DOMAIN
        ),
        array(
          'classname'   =>  'widget_imma_posttabs_widget imma-post-tabs',
          'description' =>  esc_html(
            'A widget display posts by terms',
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
      $widget_layout                = ( isset( $instance['widget_layout'] ) && ( $instance['widget_layout'] != '' ) ) ? esc_attr( $instance['widget_layout'] ) : 'tab';
      $selected_taxonomy            = ( isset( $instance['selected_taxonomy'] ) && ( $instance['selected_taxonomy'] != '' ) ) ? esc_attr( $instance['selected_taxonomy'] ) : 'post - category';

      $selected_taxonomy_terms      = ( !empty( $instance['selected_taxonomy_terms'] ) ) ? $instance['selected_taxonomy_terms'] : array(
        'uncategorized'
      );

      $enable_view_all              = ( isset( $instance['enable_view_all'] ) && ( $instance['enable_view_all'] == 1 ) ) ? 1 : 0;
      $view_all_tabs_custom_link    = ( isset( $instance['view_all_tabs_custom_link'] ) && ( $instance['view_all_tabs_custom_link'] != '' ) ) ? $instance['view_all_tabs_custom_link'] : '#';
      $post_limit                   = ( isset( $instance['post_limit'] ) && ( $instance['post_limit'] != '' ) ) ? esc_attr( $instance['post_limit'] ) : 1;

      $display_posts_by_terms       = ( isset( $instance['display_posts_by_terms'] ) && ( $instance['display_posts_by_terms'] == 1 ) ) ? 1 : 0;

      $filters                      = ( ! empty( $instance['filters'] ) && $display_posts_by_terms ) ? $instance['filters'] : array(
        array(
          'label'         =>  '',
          'taxonomy'      =>  '',
          'term'          =>  '',
          'postmeta'      =>  array(),
          'view_all_link' =>  ''
        )
      );

      $post_type_slug     = '';
      $post_type_cat_slug = '';
      if ( $selected_taxonomy != '' ) {
        $selected_taxonomy_array  = explode( ' - ', $selected_taxonomy );
        $post_type_slug     = isset( $selected_taxonomy_array[0] ) ? $selected_taxonomy_array[0] : '';
        $post_type_cat_slug = isset( $selected_taxonomy_array[1] ) ? $selected_taxonomy_array[1] : '';
      }

      echo $args['before_widget'];
      if ( !empty( $instance['heading_title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['heading_title'] ) . $args['after_title'];
      }

      ?>

      <div class="iepa-pctw-wrapper">

        <div class="<?php if( $widget_layout == 'tab' ) { echo 'iepa-pctw-tabs'; } else { echo 'iepa-pctw-accordions'; } ?>">
          <?php
          $postCategoriesArgs = array(
            'taxonomy'  =>  $post_type_cat_slug,
            'slug'   =>  $selected_taxonomy_terms
          );
          $postCategories = get_terms( $postCategoriesArgs );
          foreach ( $postCategories as $key_index => $postCategory_termObj ) {
            ?>
            <div class="<?php if( $widget_layout == 'tab' ) { echo 'iepa-pctw-tab-wrap'; } else { echo 'iepa-pctw-accordion-wrap'; } ?> <?php if( 0 == $key_index ) { echo 'active'; } ?>">
              <div class="<?php if( $widget_layout == 'tab' ) { echo 'iepa-pctw-tab'; } else { echo 'iepa-pctw-accordion'; } ?>">
                <?php echo esc_html( $postCategory_termObj->name ); ?>
              </div>
              <div class="iepa-pctw-container-wrap">
                <?php
                // $display_posts_by_terms
                ?>
                <div class="<?php if( $widget_layout == 'tab' ) { echo 'iepa-pctw-container'; } else { echo 'iepa-pctw-accordion-container'; } ?>">

                  <?php
                  foreach ( $filters as $filter_key => $filter_value ) {

                    $filter_view_all_link = (
                      isset( $filter_value['view_all_link'] ) && ( '' !== $filter_value['view_all_link'] )
                      ) ? $filter_value['view_all_link'] : false;
                    $postmeta_array = isset( $filter_value['postmeta'] ) ? $filter_value['postmeta'] : array();

                    $tax_query  = array();

                    if ( $display_posts_by_terms ) {
                      $tax_query['relation']  = 'AND';
                    }
                    $tax_query[]  = array(
                      'taxonomy'  =>  $post_type_cat_slug,
                      'field'     =>  'slug',
                      'terms'     =>  $postCategory_termObj->slug,
                    );
                    if ( $display_posts_by_terms ) {
                      $tax_query[]  = array(
                        'taxonomy'	=>	$filter_value['taxonomy'],
                        'field'			=>	'slug',
                        'terms'			=>	$filter_value['term']
                      );
                    }

                    $query_args = array(
                      'post_type'       =>  $post_type_slug,
                      'posts_per_page'  =>  $post_limit,
                      'tax_query'       =>  $tax_query
                    );

                    $loop   = new WP_Query( $query_args );
                    $count  = $loop->found_posts;
                    ?>
                    <?php if ( $count ): ?>
                      <div class="iepa-pctw-category-container-wrap">

                        <?php if ( $display_posts_by_terms ): ?>
                          <?php if ( $filter_value['label'] ): ?>
                            <div class="iepa-pctw-card-heading">
                              <?php echo esc_html( $filter_value['label'] ); ?>
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>

                        <div class="iepa-pctw-cards-wrap">
                          <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="<?php if( $widget_layout == 'tab' ) { echo 'iepa-pctw-card'; } else { echo 'iepa-pctw-accordion-card'; } ?>">
                              <a class="iepa-pctw-card-post-link" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" target="_blank">
                                <?php the_title(); ?>
                              </a>
                              <div class="iepa-pctw-post-meta-wrap">
                                <?php $post_id = get_the_ID(); ?>
                                <?php foreach ( $postmeta_array as $postmeta_index => $postmeta_key ): ?>
                                  <?php if ( get_post_meta( $post_id, $postmeta_key, true ) ): ?>
                                    <span class="iepa-pctw-post-meta">
                                      <?php echo get_post_meta( $post_id, $postmeta_key, true ); ?>
                                    </span>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          <?php endwhile; ?>
                          <?php wp_reset_postdata(); ?>
                        </div>

                        <?php if ( $filter_view_all_link ): ?>
                          <a href="<?php echo esc_url( $filter_view_all_link ); ?>" target="_blank">
                            <?php echo esc_html( 'view all' ); ?>
                          </a>
                        <?php endif; ?>

                      </div>
                    <?php endif; ?>
                    <?php
                  }
                  ?>

                </div>

              </div>
            </div>
            <?php
          }
          ?>


          <?php if ( 1 == $enable_view_all ): ?>
            <a href="<?php echo esc_url( $view_all_tabs_custom_link ) ?>" target="_blank">
              <?php echo esc_html( 'View All' ); ?>
            </a>
          <?php endif; ?>

        </div>

      </div>

      <?php
      echo $args['after_widget'];
    }


    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;

      $iepa_custom_css = '';

      return $iepa_custom_css;
    }


    public function update( $new_instance, $old_instance ) {

      $instance = $old_instance;

      $instance['heading_title']        = sanitize_text_field( $new_instance['heading_title'] );
      $instance['selected_taxonomy']    = isset( $new_instance[ 'selected_taxonomy' ] ) ? sanitize_text_field( $new_instance[ 'selected_taxonomy' ] ) : '';

      $instance['selected_taxonomy_terms']    = isset( $new_instance[ 'selected_taxonomy_terms' ] ) ? $new_instance[ 'selected_taxonomy_terms' ] : array(
        'uncategorized'
      );

      $instance['widget_layout']        = isset( $new_instance[ 'widget_layout' ] ) ? sanitize_text_field( $new_instance[ 'widget_layout' ] ) : 'tab';
      $instance['enable_view_all']      = ( isset( $new_instance['enable_view_all'] ) && ( $new_instance['enable_view_all'] == 1 ) ) ? 1 : 0;
      $instance['view_all_tabs_custom_link'] = (
        isset( $new_instance['view_all_tabs_custom_link'] ) && ( $new_instance['view_all_tabs_custom_link'] != '' )
        ) ? sanitize_text_field( $new_instance['view_all_tabs_custom_link'] ) : '#';
      $instance['post_limit']           = isset( $new_instance[ 'post_limit' ] ) ? sanitize_text_field( $new_instance[ 'post_limit' ] ) : 1;

      $instance['display_posts_by_terms']  = (
        isset( $new_instance['display_posts_by_terms'] ) && ( $new_instance['display_posts_by_terms'] == 1 )
        ) ? 1 : 0;

      foreach( $new_instance['filters'] as $feature ) {
        $feature['label']        = sanitize_text_field( $feature['label'] );
      }
      $instance['filters'] = $new_instance['filters'];

      return $instance;

    }


    public function form( $instance ) {
      $heading_title                = isset( $instance[ 'heading_title' ] ) ? $instance[ 'heading_title' ] : '';
      $selected_taxonomy            = isset( $instance[ 'selected_taxonomy' ] ) ? $instance[ 'selected_taxonomy' ] : 'post - category';

      $selected_taxonomy_terms      = isset( $instance['selected_taxonomy_terms'] ) ? $instance['selected_taxonomy_terms'] : array(
        'uncategorized'
      );

      $selected_widget_layout       = isset( $instance[ 'widget_layout' ] ) ? $instance[ 'widget_layout' ] : 'tab';

      $selected_taxonomy_array      = explode( ' - ', $selected_taxonomy );
      $post_type_slug               = $selected_taxonomy_array[0];
      $post_type_cat_slug           = $selected_taxonomy_array[1];


      $enable_view_all              = ( isset( $instance['enable_view_all'] ) && ( $instance['enable_view_all'] == 1 ) ) ? 1 : 0;
      $view_all_tabs_custom_link    = ( isset( $instance['view_all_tabs_custom_link'] ) && ( $instance['view_all_tabs_custom_link'] != '' ) ) ? $instance['view_all_tabs_custom_link'] : '#';

      $post_limit                   = isset( $instance['post_limit'] ) ? $instance['post_limit'] : 1;

      $display_posts_by_terms       = ( isset( $instance['display_posts_by_terms'] ) && ( $instance['display_posts_by_terms'] == 1 ) ) ? 1 : 0;
      $saved_filters                = ( isset( $instance['filters'] ) && !empty( $instance['filters'] ) ) ? $instance['filters'] : array(
        array(
          'label'     =>  'Browse By Uncategorized',
          'taxonomy'  =>  'category',
          'term'      =>  'uncategorized'
        )
      );

      $imma_registered_post_types =  IEPA_MM_Libary::imma_get_registered_post_types();

      ?>
      <script class="iepa-pctl-terms-json" type="application/json">
        <?php echo json_encode( get_terms( array(), array( 'hide_empty' => false ) ) ); ?>
      </script>
      <script class="iepa-pctl-postmeta-json" type="text/json">
        <?php
        global $wpdb;
        $post_meta_by_posts = array();
        $post_types_array   = get_post_types();
        foreach ( $post_types_array as $post_type_key => $post_type_value ) {
          $post_type = $post_type_value;
          $query = "
              SELECT DISTINCT($wpdb->postmeta.meta_key)
              FROM $wpdb->posts
              LEFT JOIN $wpdb->postmeta
              ON $wpdb->posts.ID = $wpdb->postmeta.post_id
              WHERE $wpdb->posts.post_type = '%s'
              AND $wpdb->postmeta.meta_key != ''
              AND $wpdb->postmeta.meta_key NOT RegExp '(^[_0-9].+$)'
              AND $wpdb->postmeta.meta_key NOT RegExp '(^[0-9]+$)'
          ";
          $meta_keys = $wpdb->get_col( $wpdb->prepare( $query, $post_type ) );
          $post_meta_by_posts[$post_type_value] = $meta_keys;
        }

        echo json_encode( $post_meta_by_posts );
        ?>
      </script>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'heading_title' ) ); ?>">
          <?php esc_html_e( 'Heading Title:', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading_title' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'heading_title' ) ); ?>" type="text"
          value="<?php echo esc_attr( $heading_title ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'widget_layout' ) ); ?>">
          <?php esc_html_e( 'Select Layout: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'widget_layout' ) ); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'widget_layout' ) ); ?>" class="widefat">
          <option value="<?php echo esc_attr( 'tab' ); ?>" <?php selected( 'tab', $selected_widget_layout ); ?>>
            <?php esc_html_e( 'Tab' ); ?>
          </option>
          <option value="<?php echo esc_attr( 'accordion' ); ?>" <?php selected( 'accordion', $selected_widget_layout ); ?>>
            <?php esc_html_e( 'Accordion' ); ?>
          </option>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'selected_taxonomy' ) ); ?>">
          <?php esc_html_e( 'Select Post Taxonomy: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select name="<?php echo esc_attr($this->get_field_name( 'selected_taxonomy' )); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'selected_taxonomy' ) ); ?>" class="widefat">
          <?php
          if ( isset( $imma_registered_post_types ) && !empty( $imma_registered_post_types ) ) {
            foreach ( $imma_registered_post_types as $posttype_key => $posttype_value ) {

              $post_type_object       = get_post_type_object( $posttype_value );
              $get_object_taxonomies  = get_object_taxonomies( $posttype_value );

              foreach ( $get_object_taxonomies as $get_object_taxonomy ) {
                $get_taxonomy = get_taxonomy( $get_object_taxonomy );
                ?>
                <option
                value="<?php echo esc_attr( $posttype_value . ' - ' . $get_object_taxonomy ); ?>" <?php selected( ( $posttype_value . ' - ' . $get_object_taxonomy ), $selected_taxonomy ); ?>>
                  <?php echo esc_html( $post_type_object->labels->singular_name ) . ' - ' . esc_html( $get_taxonomy->label ); ?>
                </option>
                <?php
              }
            }
          }
          ?>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'selected_taxonomy_terms' ) ); ?>">
          <?php esc_html_e( 'Select Post Taxonomy Terms: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <select
          name="<?php echo esc_attr( $this->get_field_name( 'selected_taxonomy_terms' ) . '[]' ); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'selected_taxonomy_terms' ) ); ?>" class="widefat"
          multiple
        >
          <?php
          if ( !trim( $post_type_cat_slug ) ) {
            $post_type_cat_slug = 'category';
          }
          $selected_taxonomy_terms_array = get_terms( $post_type_cat_slug );
          ?>
          <?php foreach ( $selected_taxonomy_terms_array as $selected_taxonomy_term_key => $selected_taxonomy_term_value ): ?>
            <option value="<?php echo esc_attr( $selected_taxonomy_term_value->slug ); ?>"
              <?php if( in_array( $selected_taxonomy_term_value->slug, $selected_taxonomy_terms ) ) { echo esc_attr( "selected" ); } ?>
            >
              <?php echo esc_html( $selected_taxonomy_term_value->name ); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'enable_view_all' ) ) ?>">
          <?php esc_html_e( 'Show View All Link: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'enable_view_all' ) ) ?>"
          value="1" <?php checked( $enable_view_all, 1 ); ?>
          id="<?php echo esc_attr( $this->get_field_id( 'enable_view_all' ) ) ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'view_all_tabs_custom_link' ) ) ?>">
          <?php esc_html_e( 'View All Custom Link URL: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'view_all_tabs_custom_link' ) ) ?>"
          value="<?php echo esc_attr( $view_all_tabs_custom_link ); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'view_all_tabs_custom_link' ) ) ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'post_limit' ) ); ?>">
          <?php esc_html_e( 'Posts Limit in Each Tab: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="number" name="<?php echo esc_attr( $this->get_field_name( 'post_limit' ) ) ?>"
          value="<?php echo esc_attr( $post_limit ); ?>"
          id="<?php echo esc_attr( $this->get_field_id( 'post_limit' ) ); ?>"
        />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'display_posts_by_terms' ) ); ?>">
          <?php esc_html_e( 'Display Posts By Terms: ', IEPA_TEXT_DOMAIN ); ?>
        </label>
        <input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'display_posts_by_terms' ) ) ?>"
          value="1" <?php checked( $display_posts_by_terms, 1 ); ?>
          id="<?php echo esc_attr( $this->get_field_id( 'display_posts_by_terms' ) ); ?>"
        />
      </p>

      <div class="iepa-pctl-container" <?php if ( !$display_posts_by_terms ) { ?>style="<?php echo esc_attr('display: none;'); ?>"<?php } ?>>
        <?php
        $k = 0;
        ?>

        <?php foreach ( $saved_filters as $saved_filter ): ?>
          <?php
          $saved_filter_label         = $saved_filter['label'];
          $saved_filter_taxonomy      = $saved_filter['taxonomy'];
          $saved_filter_term          = $saved_filter['term'];
          $saved_filter_view_all_link = isset( $saved_filter['view_all_link'] ) ? $saved_filter['view_all_link'] : '';
          $saved_filter_postmeta      = isset( $saved_filter['postmeta'] ) ? $saved_filter['postmeta'] : array();
          ?>
          <div class="iepa-pctl-content">
            <h3><?php echo esc_html( 'Term ' . ( $k + 1 ) ); ?></h3>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][label]' ); ?>">
                <?php echo esc_html( 'Label: ' ); ?>
              </label>
              <input type="text"
                name="<?php echo esc_attr( $this->get_field_name( 'filters' ) . '['.$k.'][label]' ); ?>"
                value="<?php echo esc_attr( $saved_filter_label ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][label]' ); ?>"
              />
            </p>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][taxonomy]' ); ?>">
                <?php echo esc_html( 'Select Taxonomy: ' ); ?>
              </label>
              <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'filters' ) . '['.$k.'][taxonomy]' ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][taxonomy]' ); ?>">
                <?php
                $post_type_object       = get_post_type_object( $post_type_slug );
                $get_object_taxonomies  = get_object_taxonomies( $post_type_slug );
                foreach ( $get_object_taxonomies as $get_object_taxonomy ) {
                  $get_taxonomy = get_taxonomy( $get_object_taxonomy );
                  ?>
                  <option value="<?php echo esc_attr( $get_object_taxonomy ); ?>" <?php selected( $get_object_taxonomy, $saved_filter_taxonomy ); ?>>
                    <?php echo esc_html( $post_type_object->labels->singular_name ) . ' - ' . esc_html( $get_taxonomy->label ); ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </p>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][term]' ); ?>">
                <?php echo esc_html( 'Select Term: ' ); ?>
              </label>
              <?php $get_terms = get_terms( array( 'taxonomy' => $saved_filter_taxonomy, 'hide_empty' => false ) ); ?>
              <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'filters' ) . '['.$k.'][term]' ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][term]' ); ?>"
              >
                <?php foreach ( $get_terms as $get_term ): ?>
                  <option value="<?php echo esc_attr( $get_term->slug ) ?>" <?php selected( $get_term->slug, $saved_filter_term ); ?>>
                    <?php echo esc_html( $get_term->name ); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </p>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][postmeta]' ); ?>">
                <?php echo esc_html( 'Select Post Meta: ' ); ?>
              </label>
              <?php $imma_generate_meta_keys  = IEPA_MM_Libary::imma_generate_meta_keys( $post_type_slug ); ?>
              <select class="widefat"
                name="<?php echo esc_attr( $this->get_field_name( 'filters' ) . '['.$k.'][postmeta][]' ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][postmeta]' ); ?>"
                multiple
              >
                <?php foreach ( $imma_generate_meta_keys as $imma_generate_meta_key_index => $imma_generate_meta_key ): ?>
                  <option value="<?php echo esc_attr( $imma_generate_meta_key ); ?>" <?php if( in_array( $imma_generate_meta_key, $saved_filter_postmeta ) ) { echo esc_attr( "selected" ); } ?>>
                    <?php echo esc_html( $imma_generate_meta_key ); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </p>
            <p class="description">
              <?php esc_html_e( 'Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.', IEPA_TEXT_DOMAIN ); ?>
            </p>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][view_all_link]' ); ?>">
                <?php echo esc_html( 'View All Link: ' ); ?>
              </label>
              <input type="text" class="widefat"
                name="<?php echo esc_attr( $this->get_field_name( 'filters' ) . '['.$k.'][view_all_link]' ); ?>"
                value="<?php echo esc_attr( $saved_filter_view_all_link ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'filters' ) . '['.$k.'][view_all_link]' ); ?>"
              />
            </p>

            <?php if ( $k > 0 ): ?>
              <a class="iepa-pctl-remove-content"><?php echo esc_html( 'Remove' ); ?></a>
            <?php endif; ?>

          </div>
          <?php ++$k; ?>
        <?php endforeach; ?>

      </div>

      <a class="button iepa-pctl-add-term" <?php if ( !$display_posts_by_terms ) { ?>style="<?php echo esc_attr('display: none;'); ?>"<?php } ?>>
        <?php esc_html_e( 'Add New', IEPA_TEXT_DOMAIN ); ?>
      </a>
      <?php
    } // end form


  } // end class

endif;
