<?php
global $post, $product;
$product = wc_get_product( $post );

do_action( 'woocommerce_before_single_product' );
?>
<div class="product ibtanaecommerceproductaddons">
	<?php do_action( 'iepa_render_product', $product, $post ); ?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
