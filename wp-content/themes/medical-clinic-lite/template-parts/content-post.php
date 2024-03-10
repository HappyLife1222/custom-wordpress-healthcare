<?php
  global $post;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-single p-3 mb-4'); ?>>
  <div class="post-content">
    <?php
      the_content();
      the_tags('<div class="post-tags"><strong>'.esc_html__('Tags:','medical-clinic-lite').'</strong> ', ', ', '</div>');
    ?>
  </div>
</div>