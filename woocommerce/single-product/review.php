<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

?>
<li <?php comment_class('media comment'); ?> id="li-comment-<?php comment_ID() ?>">
	<article id="comment-<?php comment_ID() ?>" class="comment-body">
		<div class="comment-avatar">
			<div class="media-left">
				<?php echo get_avatar( $comment->comment_author_email, 80 ); ?>					
			</div>
			
			<div class="media-body comment-meta">
				<header class="media-heading">
					<cite class="comment-author"><span><?php echo get_comment_author_link() ?></span> </cite>
					<span class="comment-permalink"><?php printf(esc_html__('%1$s','libero'), get_comment_date(), get_comment_time()) ?></span>
					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'libero' ), $rating ) ?>">
							<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo esc_html($rating); ?></strong> <?php _e( 'out of 5', 'libero' ); ?></span>
						</div>

					<?php endif; ?>
				</header>

				<section class="comment-content comment">
					<?php comment_text(); ?>
											
					<div class="action-link">
						<?php 
							comment_reply_link(
								array(
									'depth' => 1, 
									'max_depth' => 5,
									'reply_text' => esc_html__('Reply','libero'),
								),
								$comment->comment_ID,
								get_the_ID()
							)
						?>
					</div><!-- .action-link -->
				</section><!-- .comment-content -->
			</div>
		</div>					
	</article>