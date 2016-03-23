<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments">
	
		<?php if ( have_comments() ) : ?>

			<ol class="comment-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'libero' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? esc_html__( 'Leave A Comment', 'libero' ) : esc_html__( 'Leave A Comment', 'libero' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'libero' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'class_submit'      => '',
						'fields'               => array(
							'author' => (!is_user_logged_in() ? '<div class="row">' : '') . '<div class="col-sm-3"><p class="comment-form-author">' .
							            '<input id="author" name="author" placeholder="'. esc_html__('Your name ...','libero') .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p></div>',
							'email'  => '<div class="col-sm-3"><p class="comment-form-email">' .
							            '<input id="email" name="email" placeholder="'. esc_html__('Your email ...','libero') .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p></div>',
						),
						'label_submit'  => esc_html__( 'Send Comment', 'libero' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'libero' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = (!is_user_logged_in() ? '<div class="col-sm-6">' : '') . '<p class="comment-form-rating"><label for="rating">'. esc_html__('Your rating:','libero') .'</label><select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', 'libero' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'libero' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'libero' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'libero' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'libero' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'libero' ) . '</option>
						</select></p>' . (!is_user_logged_in() ? '</div></div>' : '') . '';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea placeholder="'. esc_html__('Your comment ...','libero') .'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'libero' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
