<?php
/**
 * The template part for top header
 *
 * @package VW Healthcare
 * @subpackage vw-healthcare
 * @since vw-healthcare 1.0
 */
?>

<div class="middle-bar text-center text-lg-start text-md-start py-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-12 py-3 py-md-0 py-lg-3">
        <div class="logo text-lg-start text-md-center">
          <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php endif; ?>
          <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( is_front_page() && is_home() ) : ?>
                <?php if( get_theme_mod('vw_healthcare_logo_title_hide_show',true) == 1){ ?>
                  <p class="site-title py-1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php } ?>
              <?php else : ?>
                <?php if( get_theme_mod('vw_healthcare_logo_title_hide_show',true) == 1){ ?>
                  <p class="site-title py-1 mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php } ?>
              <?php endif; ?>
            <?php endif; ?>
            <?php
              $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) :
            ?>
            <?php if( get_theme_mod('vw_healthcare_tagline_hide_show',false) == 1){ ?>
              <p class="site-description mb-0">
                <?php echo esc_html($description); ?>
              </p>
            <?php } ?>
          <?php endif; ?>
        </div>
      </div>


      <div class="col-lg-8 col-md-12 py-3 py-md-0 py-lg-3">
        <div class="row">
        <div class="col-lg-4 col-md-4 py-3 align-self-lg-center">
          <?php if( get_theme_mod('vw_healthcare_phone_text') != '' || get_theme_mod('vw_healthcare_phone_number') != '' ){ ?>
            <div class="row">
              <div class="col-lg-2 col-md-3">
                <i class="fas fa-phone p-3"></i>
              </div>
              <div class="col-lg-10 col-md-9">
                <p class="mb-0 ptext" style="color: #38b576;" ><?php echo esc_html(get_theme_mod('vw_healthcare_phone_text',''));?></p>
                <p class="p-0"><a href="tel:<?php echo esc_attr( get_theme_mod('vw_healthcare_phone_number','') ); ?>"><?php echo esc_html(get_theme_mod('vw_healthcare_phone_number',''));?></a></p>
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4 py-3 align-self-lg-center">
          <?php if( get_theme_mod('vw_healthcare_location_text') != '' || get_theme_mod('vw_healthcare_location') != '' ){ ?>
            <div class="row">
              <div class="col-lg-2 col-md-3">
                <i class="fas fa-clock"></i>
              </div>
              <div class="col-lg-10 col-md-9">
                <p class="mb-0 ptext" style="color: #38b576;" ><?php echo esc_html(get_theme_mod('vw_healthcare_location_text',''));?></p>
                <p class="p-0"><?php echo esc_html(get_theme_mod('vw_healthcare_location',''));?></p>
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4 py-3 align-self-lg-center">
          <?php if( get_theme_mod('vw_healthcare_location_text') != '' || get_theme_mod('vw_healthcare_location') != '' ){ ?>
            <div class="row">
              <div class="col-lg-2 col-md-3">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="col-lg-10 col-md-9">
                <p class="mb-0 ptext" style="color: #38b576;" >Email Us</p>
                <p class="p-0"> info@populardiagnostic.com </p>
              </div>
            </div>
          <?php }?>
        </div>
        </div>
      </div>



      
      <div class="col-lg-2 col-md-3 py-3 align-self-lg-center">
        <?php if( get_theme_mod('vw_healthcare_appointment_link') != '' || get_theme_mod('vw_healthcare_appointment_text_button') != '' ){ ?>
          <div class="topbar-btn my-4 text-center text-lg-end text-md-end">
          <?php
            if ( is_user_logged_in() ) { 
              $current_user = wp_get_current_user();
                  echo '<div class="col-lg-12 col-md-12"><a href="./my-account" class="py-3 px-4">'.$current_user->display_name .'</a></div>';
            ?>
            <?php } else { ?>
              <a href="<?php echo esc_url(get_theme_mod('vw_healthcare_appointment_link',''));?>" class="py-3 px-4" ><?php echo esc_html(get_theme_mod('vw_healthcare_appointment_text_button',''));?></a>
              <a href="<?php echo esc_url(wp_registration_url());?>" class="py-3 px-4"> Register</a>
          <?php } ?>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
