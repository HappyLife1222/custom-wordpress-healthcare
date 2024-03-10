<?php
/**
 * The template part for top header
 *
 * @package VW Healthcare
 * @subpackage vw-healthcare
 * @since vw-healthcare 1.0
 */
?>

<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-7">
        <?php if( get_theme_mod('vw_healthcare_opening_time') != '' ){ ?>
          <p class="mb-0 py-2 text-center text-lg-start text-md-start"><?php echo esc_html(get_theme_mod('vw_healthcare_opening_time',''));?></p>
        <?php }?>
      </div>
      <div class="col-lg-5 col-md-5">
        <?php dynamic_sidebar('social-links'); ?>
      </div>
    </div>
  </div>
</div>