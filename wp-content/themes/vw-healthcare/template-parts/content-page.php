<?php
/**
 * The template part for displaying page content
 *
 * @package VW Healthcare
 * @subpackage vw-healthcare
 * @since vw-healthcare 1.0
 */
?>

<div id="content-vw">
  <h1 class="vw-page-title"><?php the_title();?></h1>
  <?php if(has_post_thumbnail()) {?>
    <img class="page-image" src="<?php (the_post_thumbnail_url('full')); ?>" alt="<?php the_title(); ?> post thumbnail image">
    <hr>
  <?php }?> 
  <?php the_content();?>
  <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;
  ?>
  <div class="clearfix"></div>
  <?php wp_link_pages(); ?> 
</div>