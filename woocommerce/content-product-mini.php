<?php 
	$product = wc_get_product( get_the_ID() );
?>
<div class="libero_content_product product">
	<div class="libero-product-thumbnail">
		<?php
			if ( has_post_thumbnail() ) {

				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s', $image ), $post->ID );

			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'libero' ) ), $post->ID );

			}
		?>
		<div class="libero-addtocart">
			<?php libero_woocommerce_quick_view() ?>
		</div>
	</div>
	<div class="libero_product_info">
		<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
		<span class="price"><?php echo force_balance_tags($product->get_price_html()) ?></span>
	</div>
</div>