<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // disable direct access
}


if ( ! class_exists( 'IEPA_Mega_Menu_Posts_Heading_Widget' ) ) :

  class IEPA_Mega_Menu_Posts_Heading_Widget extends WP_Widget {


    public static $widget_base_id     = 'iepa_pro_post_heading_widget';
    public static $widget_name        = 'IEPA : Display Posts By Category';
    public static $widget_description = 'A widget that shows Posts category wise with featured image.';

    public function __construct() {
      parent::__construct(
        self::$widget_base_id, // Base ID
        __( self::$widget_name, IEPA_TEXT_DOMAIN ), // Name
        array(
          'description' => __(
            self::$widget_description,
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

      extract( $args );
      extract( $instance );

      $display_title          = ( isset( $instance['display_title'] )  && $instance['display_title'] != '' ) ? esc_attr( $instance['display_title'] ) : '';
      $enable_excerpt         = ( isset( $instance['enable_excerpt'] )  && $instance['enable_excerpt'] != '') ? intval( $instance['enable_excerpt'] ) : '';
      $post_length            = ( isset( $instance['post_length'] ) && $instance['post_length'] != '' ) ? esc_attr( $instance['post_length'] ) : '20'; // featured image options
      $postsperpage           = ( isset( $instance['postsperpage'] ) && $instance['postsperpage'] != '' ) ? esc_attr( $instance['postsperpage'] ) : '3';//Posts per page
      $show_added_date        = ( isset( $instance['show_added_date'] ) && $instance['show_added_date'] == 1 ) ? '1' : '0';
      $show_comment_number    = ( isset( $instance['show_comment_number'] ) && $instance['show_comment_number'] == 1 ) ? '1' : '0';

      $order_by               = isset( $instance['order_by'] ) ? $instance['order_by'] : 'id';
      $order                  = isset( $instance['order'] ) ? $instance['order'] : 'asc';
      $enable_featured_image  = ( isset( $instance['enable_featured_image'] ) && $instance['enable_featured_image'] == 1 ) ? '1' : '0';
      //$column_no = isset($instance['column_no'])?$instance['column_no']:'1';
      $enable_button          = ( isset( $instance['enable_button'] ) && $instance['enable_button'] == 1 ) ? '1' : '0';
      $button_name            = ( isset( $instance['button_name'] ) ) ? $instance['button_name'] : '';
      $btntarget              = ( isset( $instance['btntarget'] ) ) ? $instance['btntarget'] : '_blank';
      $category_id            = ( isset( $instance['category_id'] ) ) ? $instance['category_id'] : '';

      if( ( $category_id != '' ) && ( $category_id != 'all' ) ) {
        $explode        = explode( '=', $category_id );
        $category_type  = $explode[0];
        $cat_slug       = $explode[1];
      } else {
        $category_type  = '';
        $cat_slug       = '';
      }

      $show_author_name   = ( isset( $instance['show_author_name'] ) && $instance['show_author_name'] == 1 ) ? '1' : '0';

      $show_cat_name      = ( isset( $instance['show_cat_name'] ) && $instance['show_cat_name'] == 1 ) ? '1' : '0';
      $posts_layout_type  = isset( $instance['posts_layout_type'] ) ? $instance['posts_layout_type'] : 'layout1';
      $feature_image_size = isset( $instance['feature_image_size'] ) ? $instance['feature_image_size'] : 'large';

      if( $category_type == 'category' ) {
        $arguments = array(
          'post_type'      =>  array( 'post', 'post_type'),
          'post_status'    =>  array( 'publish' ),
          'orderby'        =>  $order_by,
          'order'          =>  $order,
          'posts_per_page' =>  $postsperpage,
          'cat'            =>  $cat_slug
        );
        $query = new WP_Query( $arguments );
      } else if( $category_type == 'terms' ) {
        $taxonomy   = $cat_slug;
        $terms_slug = $explode[2];
        $argss = array(
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
        $query = new WP_Query($argss);

      } else {
        $arguments = array(
          'post_type'      =>  array( 'post', 'post_type'),
          'post_status'    =>  array( 'publish' ),
          'orderby'        =>  $order_by,
          'order'          =>  $order,
          'posts_per_page' =>  $postsperpage
        );
        $query = new WP_Query( $arguments );

      }
      $btnbgcolor     = isset( $instance['btnbgcolor'] ) ? $instance['btnbgcolor'] : '';
      $btnbghcolor    = isset( $instance['btnbghcolor'] ) ? $instance['btnbghcolor'] : '';
      $catbgcolor     = isset( $instance['catbgcolor'] ) ? $instance['catbgcolor'] : '';
      $catfcolor      = isset( $instance['catfcolor'] ) ? $instance['catfcolor'] : '';
      $btnfcolor      = isset( $instance['btnfcolor'] ) ? $instance['btnfcolor'] : '';
      //$btnfhcolor = isset($instance['btnfhcolor'])?$instance['btnfhcolor']:'';
      $ptitle_color   = isset( $instance['ptitle_color'] ) ? $instance['ptitle_color'] : '';
      $content_color  = isset( $instance['content_color'] ) ? $instance['content_color'] : '';
      echo $before_widget;
      ?>

      <div class="iepapro-postslist-wrapper">

        <div class="imma-container">

          <div id="iepapro-posts-list" class="posts-list-area clearfix">

            <?php
            if ( !empty( $instance['display_title'] ) ) {
              echo $args['before_title'] . apply_filters( 'widget_title', $instance['display_title'] ) . $args['after_title'];
            }
            ?>

            <div class="iepapro-posts-list <?php echo esc_attr( 'iepa-'.$posts_layout_type ); ?>">
              <?php
              if( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                  $query->the_post();
                  $posts_name       = get_the_title();
                  $posts_id         = get_the_ID();
                  $author_name      = get_the_author();
                  $category_detail  = get_the_category( $posts_id, array( 'fields' => 'names' ) );//$post->ID
                  ?>
                  <!-- show featured image -->
                  <?php
                  if( isset( $enable_featured_image ) && $enable_featured_image == 1 ) {
                    if ( has_post_thumbnail() ) {
                      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), $feature_image_size );
                    }
                  }
                  ?>
                  <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr( $btntarget ); ?>" class="iepamegamenu_post_item">
                    <?php
                    if( $posts_layout_type == "layout1" ) {
                      if ( ! empty( $large_image_url[0] ) ) {
                        ?>
                        <div class="immapro_post_img">
                          <img src="<?php echo esc_url( $large_image_url[0] ); ?>" alt="<?php echo esc_attr( $posts_name ); ?>"/>
                        </div>
                        <?php
                      }
                    }

                    if( $show_cat_name == 1 ) {
                      ?>
                      <div class="show-category">
                        <?php

                        if( isset( $category_detail ) && !empty( $category_detail ) ) {
                          $catcount = count( $category_detail );
                          ?>
                          <span class='imma-cat'>
                            <?php
                            $j = 1;
                            foreach( $category_detail as $cd ) {
                              echo esc_html( $cd->name );
                              if( $j < $catcount ) {
                                echo esc_html( "," );
                              }
                              $j++;
                            }
                            ?>
                          </span>
                          <?php
                        }

                        ?>
                      </div>
                      <?php
                    }
                    ?>

                    <span class="imma-posts-title"><?php echo esc_html( $posts_name ); ?></span>

                    <div class="posts-extra-details">
                      <?php
                      if( isset( $show_author_name ) && $show_author_name == 1 ) {
                        ?>
                        <span class="iepa-author-name">
                          <span><?php echo esc_html( 'by' ); ?></span> <?php echo esc_html( $author_name ); ?>
                        </span>
                        <?php
                      }

                      if( isset( $posts_layout_type ) && $posts_layout_type != "layout3" ) {
                        if( $show_added_date == 1 ) {
                          ?>
                          <span class="imma-entry-date">
                            <span><?php echo esc_html( 'on' ); ?></span> <?php echo esc_html( get_the_date() ); ?>
                          </span>
                          <?php
                        }
                        if( $show_comment_number == 1 ) {
                          $my_var = get_comments_number( $posts_id );
                          ?>
                          <span class="comment_in_number"><?php echo esc_html( $my_var ); ?></span>
                          <?php
                        }
                      }
                      ?>
                    </div>

                    <?php
                    if( $posts_layout_type != "layout1" ) {
                      if ( ! empty( $large_image_url[0] ) ) {
                        ?>
                        <div class="immapro_post_img">
                          <img src="<?php echo esc_url( $large_image_url[0] );?>" alt="<?php echo esc_attr( $posts_name ); ?>"/>
                        </div>
                        <?php
                      }
                    }

                    if( isset( $enable_excerpt ) && $enable_excerpt == 1 ) {
                      $desc = IEPA_MM_Libary::imma_get_excerptbyid( get_the_ID(), $post_length );
                      ?>
                      <div class="immapro_post_content">
                        <p><?php echo esc_html( $desc ); ?></p>
                      </div>
                      <?php
                    }

                    if( isset( $enable_button ) && $enable_button == 1 && $button_name != '' ) {
                      ?>

                      <div class="posts-last-section">
                        <span>
                          <?php echo esc_html( $button_name ); ?>
                        </span>

                        <?php
                        if( isset( $posts_layout_type ) && $posts_layout_type == "layout3" ) {

                          if( $show_added_date == 1 ) {
                            ?>
                            <span class="imma-entry-date">
                              <?php echo esc_html( get_the_date() ); ?>
                            </span>
                            <?php
                          }

                          if( $show_comment_number == 1 ) {
                            $my_var = get_comments_number( $posts_id );
                            ?>
                            <span class="comment_in_number">
                              <?php echo esc_html( $my_var ); ?>
                            </span>
                            <?php
                          }

                        }
                        ?>
                      </div>

                      <?php
                    }
                    ?>

                  </a>

                  <?php
                }
              }
              wp_reset_query();
              ?>
            </div>

          </div>
        </div>

      </div><!-- End Posts -->
      <?php
      echo $after_widget;
    }


    public static function get_iepa_mm_widget_css( $iepa_mm_sidebar_widget_id ) {

      $iepa_mm_widget_data_by_id = IEPA_MM_Libary::iepa_mm_get_widget_instance( $iepa_mm_sidebar_widget_id );

      $iepa_mm_sidebar_widget_id = '#wp_nav_menu-item-' . $iepa_mm_sidebar_widget_id;

      $show_cat_name        = ( isset( $iepa_mm_widget_data_by_id['show_cat_name'] ) && $iepa_mm_widget_data_by_id['show_cat_name'] == 1 ) ? '1' : '0';
      $posts_layout_type    = isset( $iepa_mm_widget_data_by_id['posts_layout_type'] ) ? $iepa_mm_widget_data_by_id['posts_layout_type'] : 'layout1';
      $catfcolor            = isset( $iepa_mm_widget_data_by_id['catfcolor'] ) ? $iepa_mm_widget_data_by_id['catfcolor'] : '';

      $catbgcolor           = isset( $iepa_mm_widget_data_by_id['catbgcolor'] ) ? $iepa_mm_widget_data_by_id['catbgcolor'] : '';

      $ptitle_color         = isset( $iepa_mm_widget_data_by_id['ptitle_color'] ) ? $iepa_mm_widget_data_by_id['ptitle_color'] : '';

      $content_color        = isset( $iepa_mm_widget_data_by_id['content_color'] ) ? $iepa_mm_widget_data_by_id['content_color'] : '';

      $show_author_name     = ( isset( $iepa_mm_widget_data_by_id['show_author_name'] ) && $iepa_mm_widget_data_by_id['show_author_name'] == 1 ) ? '1' : '0';

      $show_added_date      = ( isset( $iepa_mm_widget_data_by_id['show_added_date'] ) && $iepa_mm_widget_data_by_id['show_added_date'] == 1 ) ? '1' : '0';

      $show_comment_number  = ( isset( $iepa_mm_widget_data_by_id['show_comment_number'] ) && $iepa_mm_widget_data_by_id['show_comment_number'] == 1 ) ? '1' : '0';

      $enable_excerpt       = ( isset( $iepa_mm_widget_data_by_id['enable_excerpt'] )  && $iepa_mm_widget_data_by_id['enable_excerpt'] != '' ) ? intval( $iepa_mm_widget_data_by_id['enable_excerpt'] ) : '';

      $enable_button        = ( isset( $iepa_mm_widget_data_by_id['enable_button'] ) && $iepa_mm_widget_data_by_id['enable_button'] == 1 ) ? '1' : '0';

      $button_name          = ( isset( $iepa_mm_widget_data_by_id['button_name'] ) ) ? $iepa_mm_widget_data_by_id['button_name'] : '';

      $btnbgcolor           = isset( $iepa_mm_widget_data_by_id['btnbgcolor'] ) ? $iepa_mm_widget_data_by_id['btnbgcolor'] : '';

      $btnbghcolor          = isset( $iepa_mm_widget_data_by_id['btnbghcolor'] ) ? $iepa_mm_widget_data_by_id['btnbghcolor'] : '';

      $btnfcolor            = isset( $iepa_mm_widget_data_by_id['btnfcolor'] ) ? $iepa_mm_widget_data_by_id['btnfcolor'] : '';

      $iepa_custom_css = '';

      if( $show_cat_name == 1 ) {

        if( $posts_layout_type == "layout3" ) {
          if( $catfcolor != '' ) {
            $iepa_custom_css .= '
            ' . $iepa_mm_sidebar_widget_id . ' .iepa-layout3.iepapro-posts-list .show-category {
              border-bottom: 1px solid ' . $catfcolor . ';
            }
            ';
          }
        }

        if( $posts_layout_type == "layout1" || $posts_layout_type == "layout2" ) {
          if( $catbgcolor != '' || $catfcolor != '' ) {
            $iepa_custom_css .= '
            ' . $iepa_mm_sidebar_widget_id . ' .iepa-' . $posts_layout_type . '.iepapro-posts-list .show-category .imma-cat {
              background:' . $catbgcolor . ';
              color:' . $catfcolor . ';
            }
            ';
          }
        } else {
          if( $catfcolor != '' ) {
            $iepa_custom_css .= '
            ' . $iepa_mm_sidebar_widget_id . ' .iepa-' . $posts_layout_type . '.iepapro-posts-list .show-category .imma-cat {
              color:' . $catfcolor . ';
            }
            ';
          }
        }

      }

      if ( $ptitle_color != '' ) {
        $iepa_custom_css .= '
        ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepapro-posts-list span.imma-posts-title {
          color: ' . $ptitle_color . ';
        }
        ';
      }

      if ( $content_color != '' ) {
        $iepa_custom_css .= '
        ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepapro-posts-list .posts-extra-details {
          color: ' . $content_color . ';
        }
        ';
      }

      if( isset( $show_author_name ) && $show_author_name == 1 && $content_color != '' ) {
        $iepa_custom_css .= '
        ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepapro-posts-list .posts-extra-details .iepa-author-name span {
          color: ' . $content_color . ';
        }
        ';
      }

      if( isset( $posts_layout_type ) && $posts_layout_type != "layout3" ) {
        if( $show_added_date == 1 && $content_color != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . '.iepapro-posts-list .posts-extra-details .imma-entry-date span {
            color: ' . $content_color . ';
          }
          ';
        }

        if( $show_comment_number == 1 && $content_color != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . '.iepapro-posts-list .posts-extra-details .comment_in_number {
            color: ' . $content_color . ';
          }
          ';
        }
      }

      if( isset( $enable_excerpt ) && $enable_excerpt == 1 ) {
        if ( $content_color != '' ) {
          $iepa_custom_css .= '
          ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepapro-posts-list .immapro_post_content {
            color: ' . $content_color . ';
          }
          ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepapro-posts-list .immapro_post_content p {
            color: ' . $content_color . ';
          }
          ';
        }
      }

      if( isset( $enable_button ) && $enable_button == 1 && $button_name != '' ) {

        if( $posts_layout_type == "layout1" || $posts_layout_type == "layout2" ) {
          if ( $btnbgcolor != '' ) {
            $iepa_custom_css .= '
            ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . ' .posts-last-section span {
              background-color: ' . $btnbgcolor . ';
              border: 1px solid ' . $btnbgcolor . ';
            }
            ';
          }
          if ( $btnbghcolor != '' ) {
            $iepa_custom_css .= '
            ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . ' .posts-last-section span:hover {
              background-color: ' . $btnbghcolor . ';
              border: 1px solid ' . $btnbghcolor . ';
            }
            ';
          }
        } else {

          if ( $btnfcolor != '' ) {
            $iepa_custom_css .= '
            ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . ' .posts-last-section span:first-child {
              color: ' . $btnfcolor . ';
            }
            ';
          }

        }

        if( isset( $posts_layout_type ) && $posts_layout_type == "layout3" ) {

          if( $show_added_date == 1 ) {
            if ( $content_color != '' ) {
              $iepa_custom_css .= '
              ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . ' .posts-last-section span.imma-entry-date {
                color: ' . $content_color . ';
              }
              ';
            }
          }

          if( $show_comment_number == 1 ) {
            if ( $content_color != '' ) {
              $iepa_custom_css .= '
              ' . $iepa_mm_sidebar_widget_id . ' .iepapro-postslist-wrapper .iepa-' . $posts_layout_type . ' .posts-last-section span.comment_in_number {
                color: ' . $content_color . ';
              }
              ';
            }
          }

        }

      }

      return $iepa_custom_css;
    }


    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {
      $image_sizes            = IEPA_MM_Libary::imma_get_image_sizes();
      $display_title          = isset($instance['display_title'])?$instance['display_title']:'';
      $category_id            = isset($instance['category_id'])?$instance['category_id']:'';
      $enable_excerpt         = (isset($instance['enable_excerpt']) &&  $instance['enable_excerpt'] == 1)?'1':'0';
      $post_length            = isset($instance['post_length'])?$instance['post_length']:'';
      $postsperpage           = isset($instance['postsperpage'])?$instance['postsperpage']:'3';
      $show_added_date        = (isset($instance['show_added_date']) && $instance['show_added_date'] == 1)?'1':'0';
      $show_comment_number    = (isset($instance['show_comment_number']) && $instance['show_comment_number'] == 1)?'1':'0';
      $order_by               = isset($instance['order_by'])?$instance['order_by']:'id';
      $order                  = isset($instance['order'])?$instance['order']:'asc';
      $enable_featured_image  = (isset($instance['enable_featured_image']) && $instance['enable_featured_image'] == 1)?'1':'0';
      // $column_no = isset($instance['column_no'])?$instance['column_no']:'1';
      $enable_button          = (isset($instance['enable_button']) && $instance['enable_button'] == 1)?'1':'0';
      $button_name            = (isset($instance['button_name']) )?$instance['button_name']:'';
      $btntarget              = (isset($instance['btntarget']) )?$instance['btntarget']:'_blank';
      $show_author_name       = (isset($instance['show_author_name']) && $instance['show_author_name'] == 1)?'1':'0';
      $show_cat_name          = (isset($instance['show_cat_name']) && $instance['show_cat_name'] == 1)?'1':'0';
      $posts_layout_type      = (isset($instance['posts_layout_type']))?$instance['posts_layout_type']:'layout1';
      $feature_image_size     = (isset($instance['feature_image_size']))?$instance['feature_image_size']:'large';

      $btnbgcolor             = (isset($instance['btnbgcolor']))?$instance['btnbgcolor']:'';
      $btnbghcolor            = ( isset( $instance['btnbghcolor'] ) ) ? $instance['btnbghcolor'] : '';
      $catbgcolor             = (isset($instance['catbgcolor']))?$instance['catbgcolor']:'';
      $catfcolor              = (isset($instance['catfcolor']))?$instance['catfcolor']:'';
      $btnfcolor              = (isset($instance['btnfcolor']))?$instance['btnfcolor']:'';
      // $btnfhcolor =  (isset($instance['btnfhcolor']))?$instance['btnfhcolor']:'';
      $ptitle_color           = (isset($instance['ptitle_color']))?$instance['ptitle_color']:'';
      $content_color          = (isset($instance['content_color']))?$instance['content_color']:'';

      ?>

      <div class="iepa-post-display-section">
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'display_title' ) ); ?>">
            <?php esc_html_e( 'Title: ', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'display_title' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'display_title' ) ); ?>"
            value="<?php echo esc_attr( $display_title ); ?>"
          />
        </p>
        <p class="imma-listcatgory-field">
          <label for="<?php echo esc_attr( $this->get_field_id( 'product_list_category' ) ); ?>">
            <?php esc_html_e( 'Select Category', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <?php
          $categories = get_categories( array( 'hide_empty' => 0 ) );
          $taxonomies = IEPA_MM_Libary::get_all_taxonomy_lists();
          ?>

          <select name="<?php echo esc_attr( $this->get_field_name( 'category_id' ) ); ?>"
            id="<?php echo esc_attr( $this->get_field_id( 'category_id' ) ); ?>"
            class="widefat immapro-category"
          >
            <option value="all"><?php esc_html_e( 'All', IEPA_TEXT_DOMAIN ); ?></option>
            <optgroup label="Category">
              <?php
              foreach( $categories as $category => $cat ) {
                ?>
                <option value="<?php echo esc_attr( 'category=' . $cat->term_id ); ?>" <?php selected( 'category='.$cat->term_id, $category_id ); ?>>
                  <?php echo esc_html_e( $cat->name, IEPA_TEXT_DOMAIN ); ?>
                </option>
                <?php
              }
              ?>
            </optgroup>
            <optgroup label="Terms">
              <?php
              foreach( $taxonomies as $tax ) {
                $ex_taxonomy  = explode( ' ',$tax );
                $imp_taxonomy = strtolower( implode( '_', $ex_taxonomy ) );
                $imp_taxonomy = strtolower( implode( '-', $ex_taxonomy ) );
                $args         = array( 'parent' => '0', 'hide_empty' => 0 );
                $terms        = get_terms( $tax, $args );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                  foreach ( $terms as $term ) {
                    ?>
                    <option value="<?php echo esc_attr( 'terms=' . $imp_taxonomy . '=' . $term->slug ); ?>" <?php selected('terms='.$imp_taxonomy.'='.$term->slug, $category_id); ?>>
                      <?php echo esc_html_e( $term->name, IEPA_TEXT_DOMAIN );?>
                    </option>
                    <?php
                  }
                }
              }
              ?>
            </optgroup>
          </select>
        </p>

        <p class="posts-layout">
          <label for="<?php echo esc_attr( $this->get_field_id( 'posts_layout_type' ) ); ?>">
            <?php esc_html_e( 'Select Layout Type', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <select name="<?php echo esc_attr( $this->get_field_name( 'posts_layout_type' ) ); ?>"
            id="<?php echo esc_attr( $this->get_field_id( 'posts_layout_type' ) ); ?>" class="widefat iepa-posts-layout"
          >
            <option value="layout1" <?php selected( 'layout1', $posts_layout_type ); ?>>
              <?php esc_html_e('Layout 1', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="layout2" <?php selected( 'layout2', $posts_layout_type ); ?>>
              <?php esc_html_e('Layout 2', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="layout3" <?php selected( 'layout3', $posts_layout_type ); ?>>
              <?php esc_html_e('Layout 3', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
          <div id="my_layout1" class="layout_preview <?php if( $posts_layout_type != 'layout1' ) { echo ( 'iepa-d-none' ); } ?>">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/widget-images/postlayout1.PNG' ); ?>" />
          </div>
          <div id="my_layout2" class="layout_preview <?php if( $posts_layout_type != 'layout2' ) { echo ( 'iepa-d-none' ); } ?>">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/widget-images/postlayout2.PNG' ); ?>" />
          </div>
          <div id="my_layout3" class="layout_preview <?php if( $posts_layout_type != 'layout3' ) { echo ( 'iepa-d-none' ); } ?>">
            <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/widget-images/postlayout3.PNG' ); ?>" />
          </div>
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'postsperpage' ) ); ?>">
            <?php esc_html_e( 'Posts Per Page', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="number" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'postsperpage' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'postsperpage' ) ); ?>"
            value="<?php echo esc_attr( $postsperpage ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'enable_featured_image' ) ); ?>">
            <?php esc_html_e( 'Show Featured Image', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'enable_featured_image' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'enable_featured_image' ) ); ?>" value="1" <?php checked( $enable_featured_image, '1' ); ?>
          />
        </p>

        <p class="posts-layout">
          <label for="<?php echo esc_attr( $this->get_field_id( 'feature_image_size' ) ); ?>">
            <?php esc_html_e( 'Select Featured Image Size: ', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <select name="<?php echo esc_attr( $this->get_field_name( 'feature_image_size' ) ); ?>"
            id="<?php echo esc_attr( $this->get_field_id( 'feature_image_size' ) ); ?>">
            <?php
            if( isset( $image_sizes ) && !empty( $image_sizes ) ) {
              foreach ( $image_sizes as $size_name => $key ) {
                ?>
                <option value="<?php echo esc_attr( $size_name ); ?>" <?php selected( $size_name, $feature_image_size ); ?>>
                  <?php echo esc_html_e( ucwords( $size_name ), IEPA_TEXT_DOMAIN ); ?>
                </option>
                <?php
              }
            }
            ?>
          </select>
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'show_author_name' ) ); ?>">
            <?php esc_html_e( 'Show Author Name', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'show_author_name' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'show_author_name' ) ); ?>"
            value="1" <?php checked( $show_author_name, '1' ); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'show_cat_name' ) ); ?>">
            <?php esc_html_e( 'Show Category Name', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'show_cat_name' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'show_cat_name' ) ); ?>"
            value="1" <?php checked($show_cat_name,'1'); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'enable_excerpt' ) ); ?>">
            <?php esc_html_e( 'Show Excerpt', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'enable_excerpt' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'enable_excerpt' ) ); ?>"
            value="1" <?php checked( $enable_excerpt, '1' ); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'post_length' ) ); ?>">
            <?php esc_html_e( 'Excerpt Length', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="number" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'post_length' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'post_length' ) ); ?>"
            value="<?php echo esc_attr( $post_length ); ?>"
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'show_added_date' ) ); ?>">
            <?php esc_html_e( 'Show Posts Date', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'show_added_date' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'show_added_date' ) ); ?>"
            value="1" <?php checked( $show_added_date, '1' ); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'show_comment_number' ) ); ?>">
            <?php esc_html_e( 'Show Comment In Number', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'show_comment_number' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'show_comment_number' ) ); ?>"
            value="1" <?php checked( $show_comment_number, '1' ); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
            <?php esc_html_e( 'Select Order By: ', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <select name="<?php echo esc_attr( $this->get_field_name('order_by') ); ?>"
            id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" class="widefat immapro-listtype"
          >
            <option value="none" <?php selected( 'none', $order_by ); ?>>
              <?php esc_html_e( 'None', IEPA_TEXT_DOMAIN ); ?>
            </option>
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
          <label for="<?php echo esc_attr( $this->get_field_id('order') ); ?>">
            <?php esc_html_e( 'Select Order: ', IEPA_TEXT_DOMAIN )?>
          </label>
          <select name="<?php echo esc_attr( $this->get_field_name('order') ); ?>"
            id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" class="widefat immapro-listtype">
            <option value="asc" <?php selected( 'asc', $order ); ?>>
              <?php esc_html_e( 'ASC', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="desc" <?php selected( 'desc', $order ); ?>>
              <?php esc_html_e( 'DESC', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'enable_button' ) ); ?>">
            <?php esc_html_e( 'Show Link Button', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="checkbox" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'enable_button' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'enable_button' ) ); ?>"
            value="1" <?php checked( $enable_button, '1' ); ?>
          />
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'btntarget' ) ); ?>">
            <?php esc_html_e( 'Select Posts Link Target', IEPA_TEXT_DOMAIN ); ?>:
          </label>
          <select name="<?php echo esc_attr( $this->get_field_name( 'btntarget' ) ); ?>"
            id="<?php echo esc_attr( $this->get_field_id( 'btntarget' ) ); ?>" class="widefat"
          >
            <option value="_blank"  <?php selected( '_blank', $btntarget ); ?>>
              <?php esc_html_e( '_blank', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="_self"  <?php selected( '_self', $btntarget ); ?>>
              <?php esc_html_e( '_self', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="_parent" <?php selected( '_parent', $btntarget ); ?>>
              <?php esc_html_e( '_parent', IEPA_TEXT_DOMAIN ); ?>
            </option>
            <option value="_top"  <?php selected( '_top', $btntarget ); ?>>
              <?php esc_html_e( '_top', IEPA_TEXT_DOMAIN ); ?>
            </option>
          </select>
        </p>


        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'button_name' ) ); ?>">
            <?php esc_html_e( 'Button Name', IEPA_TEXT_DOMAIN ); ?>
          </label>
          <input type="text" class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'button_name' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'button_name' ) ); ?>"
            value="<?php echo esc_attr($button_name);?>"
          />
        </p>

        <h3><?php esc_html_e( 'Custom Styling', IEPA_TEXT_DOMAIN );?></h3>

        <div class="immapro-widget-layout-options <?php if( $posts_layout_type === 'layout3' ) { echo esc_attr( 'iepa-d-none' ); } ?>"
          data-option="12_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btnbgcolor' ) ); ?>">
              <?php esc_html_e( 'Button Background Color', IEPA_TEXT_DOMAIN ); ?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'btnbgcolor' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'btnbgcolor' ) ); ?>" data-alpha="true"
              value="<?php echo esc_attr( $btnbgcolor ); ?>"
            />
          </p>
        </div>

        <div class="immapro-widget-layout-options <?php if( $posts_layout_type === 'layout3' ) { echo esc_attr( 'iepa-d-none' ); } ?>"
          data-option="12_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btnbghcolor' ) ); ?>">
              <?php esc_html_e( 'Button Background Hover Color',IEPA_TEXT_DOMAIN )?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'btnbghcolor' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'btnbghcolor' ) ); ?>" data-alpha="true"
              value="<?php echo esc_attr( $btnbghcolor ); ?>"
            />
          </p>
        </div>

        <div class="immapro-widget-layout-options <?php if( $posts_layout_type === 'layout3' ) { echo esc_attr( 'iepa-d-none' ); } ?>"
          data-option="12_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id('catbgcolor') ); ?>">
              <?php esc_html_e( 'Category Background Color', IEPA_TEXT_DOMAIN ); ?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'catbgcolor' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'catbgcolor' ) ); ?>" data-alpha="true"
              value="<?php echo esc_attr( $catbgcolor ); ?>"
            />
          </p>
        </div>

        <div class="immapro-widget-layout-options" data-option="123_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id('catfcolor') ); ?>">
              <?php esc_html_e( 'Category Font Color', IEPA_TEXT_DOMAIN ); ?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'catfcolor' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'catfcolor' ) ); ?>" data-alpha="true"
              value="<?php echo esc_attr( $catfcolor ); ?>"
            />
          </p>
        </div>

        <div class="immapro-widget-layout-options" data-option="123_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id('btnfcolor') ); ?>">
              <?php esc_html_e( 'Button Font Color', IEPA_TEXT_DOMAIN ); ?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'btnfcolor' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'btnfcolor' ) ); ?>"
              value="<?php echo esc_attr( $btnfcolor ); ?>"
            />
          </p>
        </div>


        <div class="immapro-widget-layout-options" data-option="123_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ptitle_color' ) ); ?>">
              <?php esc_html_e( 'Posts Title Color', IEPA_TEXT_DOMAIN ); ?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'ptitle_color' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'ptitle_color' ) ); ?>"
              value="<?php echo esc_attr( $ptitle_color ); ?>"
            />
          </p>
        </div>

        <div class="immapro-widget-layout-options" data-option="123_Layout">
          <p>
            <label for="<?php echo esc_attr( $this->get_field_id('content_color') ); ?>">
              <?php esc_html_e('Content Color',IEPA_TEXT_DOMAIN)?>
            </label>
            <input type="text" class="widefat imma-mm-color-picker"
              id="<?php echo esc_attr( $this->get_field_id( 'content_color' ) ); ?>"
              name="<?php echo esc_attr( $this->get_field_name( 'content_color' ) ); ?>"
              value="<?php echo esc_attr( $content_color ); ?>"
            />
          </p>
        </div>

      </div>
      <?php
    }


    /**
    * Sanitize widget form values as they are saved.
    * @see WP_Widget::update()
    * @param array   $new_instance Values just sent to be saved.
    * @param array   $old_instance Previously saved values from database.
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
      $instance                           = $old_instance;
      $instance['display_title']          = strip_tags( $new_instance['display_title'] );
      $instance['category_id']            = strip_tags( $new_instance['category_id'] );
      $instance['enable_excerpt']         = strip_tags( $new_instance['enable_excerpt'] );
      $instance['post_length']            = strip_tags( $new_instance['post_length'] );
      $instance['postsperpage']           = strip_tags( $new_instance['postsperpage'] );
      $instance['show_added_date']        = strip_tags( $new_instance['show_added_date'] );
      $instance['show_comment_number']    = strip_tags( $new_instance['show_comment_number'] );
      $instance['order_by']               = strip_tags( $new_instance['order_by'] );
      $instance['order']                  = strip_tags( $new_instance['order'] );
      $instance['enable_featured_image']  = strip_tags( $new_instance['enable_featured_image'] );
      // $instance['column_no'] =  strip_tags( $new_instance['column_no'] );
      $instance['enable_button']          = strip_tags( $new_instance['enable_button'] );
      $instance['button_name']            = strip_tags( $new_instance['button_name'] );
      $instance['btntarget']              = strip_tags( $new_instance['btntarget'] );

      $instance['show_author_name']       = strip_tags( $new_instance['show_author_name'] );
      $instance['show_cat_name']          = strip_tags( $new_instance['show_cat_name'] );
      $instance['posts_layout_type']      = strip_tags( $new_instance['posts_layout_type'] );
      $instance['feature_image_size']     = strip_tags( $new_instance['feature_image_size'] );
      $instance['btnbgcolor']             = strip_tags( $new_instance['btnbgcolor'] );
      $instance['btnbghcolor']            = strip_tags( $new_instance['btnbghcolor'] );
      $instance['catbgcolor']             = strip_tags( $new_instance['catbgcolor'] );
      $instance['catfcolor']              = strip_tags( $new_instance['catfcolor'] );
      $instance['btnfcolor']              = strip_tags( $new_instance['btnfcolor'] );
      //$instance['btnfhcolor'] =  strip_tags( $new_instance['btnfhcolor'] );
      $instance['ptitle_color']           = strip_tags( $new_instance['ptitle_color'] );
      $instance['content_color']          = strip_tags( $new_instance['content_color'] );

      return $instance;
    }




  }

endif;
