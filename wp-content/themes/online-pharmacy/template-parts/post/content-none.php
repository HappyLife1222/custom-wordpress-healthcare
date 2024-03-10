<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

?>
<div id="category-post">
	<section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'online-pharmacy' ); ?></h1>
		</header>
		<div class="page-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p>
					<?php
					/* translators: %s: Post editor URL. */
					printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'online-pharmacy' ), esc_url( admin_url( 'post-new.php' ) ) );
					?>
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'online-pharmacy' ); ?></p>
				<?php
					get_search_form();

			endif; ?>
		</div>
	</section>
</div>
