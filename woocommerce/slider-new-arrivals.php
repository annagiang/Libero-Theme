<?php
	global $product, $woocommerce_loop;
	$woocommerce_loop['columns'] = 1;
	$args = array(
		'post_type'	=> 'product',
		'posts_per_page' => '12'
	);
	$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
<div class="libero_new_arrivals">
	<div class="container">
		<div class="row">
			<h5><?php esc_html_e('New Arrivals','libero') ?></h5>
			
			<div class="libero_arrivals_owl owl-theme">
				
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					<?php wc_get_template_part( 'content', 'product-mini' ); ?>
					
				<?php endwhile; // end of the loop. ?>
				
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php
	wp_reset_postdata();
?>