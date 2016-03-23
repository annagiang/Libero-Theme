<?php 
	global $woocommerce;
	$cart_count = $woocommerce->cart->cart_contents_count;
	$cart_total = $woocommerce->cart->get_cart_total();
?>
<div id="cart-mini" class="libero-cart-mini">
	<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="fa fa-shopping-cart"></i>
		<?php printf( _n( 'Cart: %s Item', 'Cart: %s Items', $cart_count, 'libero' ), $cart_count ); ?>
	</a>
	<div class="libero_cart_toggle"> 
		<div class="libero_recently_added_items">
			<?php if( $cart_count ) { ?>
			<h5><?php esc_html_e('Recently added item(s)','libero') ?></h5>
			<?php } ?>
			<div class="libero_mini_cart_items">
				
				<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				?>
				<div class="libero_item_added">
					
					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						if ( ! $_product->is_visible() ) {
							echo force_balance_tags($thumbnail);
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
						}
					?>
					
					<h6><?php echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key ); ?></h6>
					
					<?php
						echo WC()->cart->get_item_data( $cart_item );
					?>
					
					<p><?php echo absint($cart_item['quantity']) ?> x <?php	echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></p>
					<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="libero_remove_item" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>',
							esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
							esc_html__( 'Remove this item', 'libero' ),
							esc_attr( $product_id ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
					?>
				</div>
				<?php } ?>
				
			</div>
			
			<div class="libero_cart_subtotal">
				<p><?php esc_html_e('Cart Subtotal:','libero') ?> <span><?php echo force_balance_tags($cart_total) ?></span></p>
			</div>
			<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><?php esc_html_e('Views cart','libero') ?></a>
			<a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>"><?php esc_html_e('Checkout','libero') ?></a>
		</div>
	</div>
</div>