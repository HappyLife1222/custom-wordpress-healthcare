<?php
/**
 * Template part for displaying about section
 *
 * @package Health Care Hospital
 * @subpackage health_care_hospital
 */

?>
<?php if( get_theme_mod( 'online_pharmacy_slider_arrows') != '') { ?>
<section id="abt-product" class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-md-6 align-self-center">
        <?php if( get_theme_mod( 'health_care_hospital_about_title' ) != '') { ?>
          <h3><?php echo esc_html( get_theme_mod('health_care_hospital_about_title','')); ?></h3>
        <?php } ?>
        <?php if( get_theme_mod( 'health_care_hospital_about_sub_title' ) != '') { ?>
          <h4><?php echo esc_html( get_theme_mod('health_care_hospital_about_sub_title','')); ?></h4>
          <hr>
        <?php } ?>
        <?php if( get_theme_mod( 'health_care_hospital_about_text' ) != '') { ?>
          <p><?php echo esc_html( get_theme_mod('health_care_hospital_about_text','')); ?></p>
        <?php } ?>
        <?php if( get_theme_mod( 'health_care_hospital_about_btn_url' ) != '' || get_theme_mod( 'health_care_hospital_about_btn_text' ) != '') { ?>
          <div class="more-btn">
            <a href="<?php echo esc_url( get_theme_mod('health_care_hospital_about_btn_url','')); ?>" class="about-btn"><?php echo esc_html( get_theme_mod('health_care_hospital_about_btn_text','')); ?></a>
          </div>
        <?php } ?>
      </div>
      <div class="col-lg-6 col-md-6 col-md-6 align-self-center">
        <?php 
          $health_care_hospital_product_cat = get_theme_mod('health_care_hospital_best_product_category');
          $health_care_hospital_count_cat = get_theme_mod('health_care_hospital_best_product_number');
          if ( class_exists( 'WooCommerce' ) ) {
          $online_pharmacy_args = array(
            'post_type' => 'product',
            'posts_per_page' => $health_care_hospital_count_cat,
            'product_cat' => $health_care_hospital_product_cat,
            'order' => 'ASC'
          );?>
          <div class="owl-carousel">
            <?php $loop = new WP_Query( $online_pharmacy_args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
              <div class="product-details text-center">
                <h5><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h5>
                <span><?php esc_attr( apply_filters( 'woocommerce_product_price_class', '' ) ); ?><?php echo $product->get_price_html(); ?></span>
                <p><?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_rating( $loop->post, $product ); } ?></p>
                <div class="product-img">
                  <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, ''); else echo '<img src="'.esc_url(wc_placeholder_img_src()).'" />'; ?>
                </div>
              </div>
            <?php endwhile; wp_reset_query(); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
   <?php } ?>