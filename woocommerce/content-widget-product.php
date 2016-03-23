<?php global $product; ?>
<li>
	<a class="libero-product-image" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo force_balance_tags($product->get_image()); ?>
	</a>
	<span class="libero-cats"><?php echo force_balance_tags($product->get_categories( ', ', '', '' )); ?></span>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<span class="product-title"><?php echo force_balance_tags($product->get_title()); ?></span>
	</a>
	<?php if ( ! empty( $show_rating ) ) echo force_balance_tags($product->get_rating_html()); ?>
	<?php echo force_balance_tags($product->get_price_html()); ?>
</li>