<?php
  global $post;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-single p-3 mb-4'); ?>>
  <div class="post-content">
    <?php the_content(); ?>
  </div>
</div>