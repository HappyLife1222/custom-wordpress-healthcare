<?php
/**
 * The template for displaying the footer
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

?>
		</div>
		<footer id="footer" class="site-footer" role="contentinfo">
			<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				get_template_part( 'template-parts/footer/site', 'info' );
			?>
			<?php if( get_theme_mod( 'online_pharmacy_return_to_header',true) != '' || get_theme_mod( 'online_pharmacy_return_to_header_mob',false) != '') { ?>
				<div class="return-to-header">
					<a href="javascript:" id="return-to-top"><i class="<?php echo esc_attr(get_theme_mod('online_pharmacy_scroll_top_icon','fas fa-arrow-up')); ?> return-to-top"></i></a>
				</div>
			<?php }?>
		</footer>
	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>