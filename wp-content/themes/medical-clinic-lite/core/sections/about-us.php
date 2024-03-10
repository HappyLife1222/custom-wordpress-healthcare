<?php if ( get_theme_mod('medical_clinic_lite_about_us_section_enable', true) == true ) : ?>

  <section id="about" class="pt-5">
    <div class="container">
      <div class="row">
        <?php $medical_clinic_lite_about_pages = array();
          $mod = intval( get_theme_mod( 'medical_clinic_lite_about_us' ));
          if ( 'page-none-selected' != $mod ) {
            $medical_clinic_lite_about_pages[] = $mod;
          }
          if( !empty($medical_clinic_lite_about_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $medical_clinic_lite_about_pages,
              'orderby' => 'post__in'
            );
            $medical_clinic_lite_query = new WP_Query( $args );
            if ( $medical_clinic_lite_query->have_posts() ) :
              $i = 1;
        ?>
        <?php  while ( $medical_clinic_lite_query->have_posts() ) : $medical_clinic_lite_query->the_post(); ?>
          <div class="col-lg-6 col-md-6 col-sm-6 align-self-center">
            <?php the_post_thumbnail(); ?>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 align-self-center">
            <?php if ( get_theme_mod('medical_clinic_lite_about_us_section_title') ) : ?>
              <h3><?php echo esc_html(get_theme_mod('medical_clinic_lite_about_us_section_title')) ?></h3>
            <?php endif; ?>
            <h4 class="my-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <?php echo wp_trim_words( get_the_content(), get_theme_mod('medical_clinic_lite_about_excerpt_number',60) ); ?>
            <p class="about-button mt-4">
              <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Discover More','medical-clinic-lite'); ?></a>
            </p>
          </div>
        <?php $i++; endwhile; ?>
        <?php wp_reset_postdata(); else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <div class="clearfix"></div>
      </div>
    </div>
  </section>

<?php endif; ?>
