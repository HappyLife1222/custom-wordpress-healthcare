<?php 

/* Template Name: Left Sidebar Template */

get_header(); ?>

<div class="header-image-box text-center">
  <div class="container">
    <?php if ( get_theme_mod('medical_healthcare_elementor_header_page_title' , true)) : ?>
      <h1><?php the_title(); ?></h1>
    <?php endif; ?>
    <?php if ( get_theme_mod('medical_healthcare_elementor_header_breadcrumb' , true)) : ?>
      <div class="crumb-box mt-3">
        <?php medical_healthcare_elementor_the_breadcrumb(); ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div id="content" class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <div class="sidebar-area">
          <?php
            dynamic_sidebar('sidebar-2');
          ?>
        </div>
      </div>
      <div class="col-lg-8 col-md-8">
        <?php
          while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type());

            wp_link_pages(
              array(
                'before' => '<div class="medical-healthcare-elementor-pagination">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>'
              )
            );
            comments_template();
          endwhile;
        ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
