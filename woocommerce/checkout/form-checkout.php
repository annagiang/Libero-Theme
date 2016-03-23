<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>


<h3 style="margin-top:50px" class="widget-title"><?php esc_html_e('Checkout','libero') ?></h3>
<?php 
	wc_print_notices();

	do_action( 'woocommerce_before_checkout_form', $checkout );

	// If checkout registration is disabled and not logged in, the user cannot checkout
	if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'libero' ) );
		return;
	}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<div class="row">
		<div class="col-sm-6">
			
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>


			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
		</div>
		<div class="col-sm-6">
			<h3 id="order_review_heading" class="widget-title"><?php _e( 'Your order', 'libero' ); ?></h3>
			
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
