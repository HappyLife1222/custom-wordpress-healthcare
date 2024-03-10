<?php
  global $post;

$post_author_id   = get_post_field( 'post_author', get_queried_object_id() );
$medical_clinic_lite_get_post_column_layout = get_theme_mod( 'medical_clinic_lite_post_column_count', 2 );
$post_column_layout = 'col-sm-12 col-md-6 col-lg-4';
if ( $medical_clinic_lite_get_post_column_layout == 2 ) {
  $post_column_layout = 'col-lg-6 col-md-12';
} elseif ( $medical_clinic_lite_get_post_column_layout == 3 ) {
  $post_column_layout = 'col-sm-12 col-md-6 col-lg-4';
} elseif ( $medical_clinic_lite_get_post_column_layout == 4 ) {
  $post_column_layout = 'col-sm-12 col-md-6 col-lg-3';
}else{
  $post_column_layout = 'col-sm-12 grid-layout';
}
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $audio = false;

  // Only get audio from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $audio = get_media_embedded_in_content( $content, array( 'audio' ) );
  }
?>

<div class="<?php echo esc_attr( $post_column_layout ); ?> blog-grid-layout">
  <div id="post-<?php the_ID(); ?>" <?php post_class('post-box mb-4 p-3'); ?>>
    <?php
      if ( ! is_single() ) {
        // If not a single post, highlight the audio file.
        if ( ! empty( $audio ) ) {
          foreach ( $audio as $audio_html ) {
            echo '<div class="entry-audio">';
              echo $audio_html;
            echo '</div><!-- .entry-audio -->';
          }
        };
      };
    ?>
    <?php if ( get_theme_mod('medical_clinic_lite_blog_admin_enable',true) || get_theme_mod('medical_clinic_lite_blog_comment_enable',true) ) : ?>
      <div class="post-meta my-3">
        <?php if ( get_theme_mod('medical_clinic_lite_blog_admin_enable',true) ) : ?>
          <i class="far fa-user mr-2"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a>
        <?php endif; ?>
        <?php if ( get_theme_mod('medical_clinic_lite_blog_comment_enable',true) ) : ?>
          <span class="ml-3"><i class="far fa-comments mr-2"></i> <?php comments_number( esc_attr('0', 'medical-clinic-lite'), esc_attr('0', 'medical-clinic-lite'), esc_attr('%', 'medical-clinic-lite') ); ?> <?php esc_html_e('comments','medical-clinic-lite'); ?></span>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <h3 class="post-title mb-3 mt-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <div class="post-content">
      <?php echo wp_trim_words( get_the_content(), get_theme_mod('medical_clinic_lite_post_excerpt_number',15) ); ?>
    </div>
  </div>
</div>
