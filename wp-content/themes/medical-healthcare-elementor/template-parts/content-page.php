<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Medical Healthcare Elementor
*/

  global $post;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-single mb-4'); ?>>
  <?php if ( has_post_thumbnail() ) { ?>
    <div class="post-thumbnail">
      <?php the_post_thumbnail(''); ?>
    </div>
  <?php }?>
  <div class="post-content">
    <?php the_content(); ?>
  </div>
</div>