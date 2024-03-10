<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @subpackage health-service
 * @since health-service
 */
get_header();
?>
<div class="sp-100 bg-w">
	<div class="container">
		<div class="row">
			<?php if( is_active_sidebar( 'blog-sidebar' ) ){ ?>
				<div class="col-lg-8">
			<?php }else{ ?>
				<div class="col-lg-12">
			<?php } ?>
				<?php
				if ( have_posts() ) :

					if ( is_home() && is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'search' );

					endwhile;
					the_posts_pagination();
				else :
					get_template_part( 'template-parts/content/content', 'none' );
				endif;
				?>
			</div>
			<?php if( is_active_sidebar( 'blog-sidebar' ) ){ ?>
				<?php get_sidebar();
			} ?>
		</div>
	</div>
</div>
<?php
get_footer();
?>