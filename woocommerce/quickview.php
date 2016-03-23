<?php
	global $quickview;
	if( !is_array($quickview) ) return;
	$p_id = $quickview['p_id'];
	global $post, $woocommerce, $product;
	
	$post = get_post( $p_id );
	$product = wc_get_product( $p_id );
?>
<div class="quick-view">
	<div class="quickview-wrap transition">
		<div class="quickview-inner clearfix">
			
			<div class="quick-title">
				<h3><?php esc_html_e('Quick View','libero') ?><a href="#" class="quickview-close"><i class="fa fa-close"></i></a></h3>
			</div>
			
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">

				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_quickview_product_summary' );
				?>

			</div><!-- .summary -->
			
		</div><!-- .quickview-inner -->
	</div><!-- .quickview-wrap -->
	<div class="mask quickview-close transition"></div>
</div><!-- #quick-view -->