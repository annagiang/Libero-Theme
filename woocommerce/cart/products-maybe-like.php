<div class="libero-product-maybe-you-like">
	<h3 class="libero-title"><?php esc_html_e("Maybe you also like","libero") ?></h3>
	<?php
		global $product, $woocommerce_loop;
		$woocommerce_loop['columns'] = 1;
		$args = array(
			'post_type'	=> 'product',
			'orderby' 	=> 'rand',
			'posts_per_page' => '10'
		);
		$the_query = new WP_Query( $args );
	?>
	<?php if ( $the_query->have_posts() ) : ?>
		<ul class="libero-slider-maybe">
		
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>
		
		</ul>
	<?php endif; ?>
	<?php
		wp_reset_postdata();
	?>
</div>