<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package libero
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comment" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php comments_number('0 Comment', '1 Comment', '% Comments');?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'libero' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'libero' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'libero' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				function libero_format_comment($comment, $args, $depth) {
				   $GLOBALS['comment'] = $comment; ?>
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
			<?php } ?>
			<?php
				wp_list_comments( array(
					'callback'	 => 'libero_format_comment',
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'libero' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'libero' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'libero' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'libero' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
		  'id_form'           => 'commentform',
		  'id_submit'         => 'submit',
		  'class_submit'      => 'submit button rounded light',
		  'name_submit'       => 'submit',
		  'title_reply'       => esc_html__( 'What do you think?','libero' ),
		  'title_reply_to'    => esc_html__( 'Leave a Reply to %s','libero' ),
		  'cancel_reply_link' => esc_html__( 'Cancel Reply','libero' ),
		  'label_submit'      => esc_html__( 'Post comment','libero' ),
		  'format'            => 'xhtml',

		  'comment_field' =>  '<p class="comment-form-comment"><textarea placeholder="'. esc_html__('Your Thoughts','libero') . ( $req ? '*' : '' ) .'" name="comment" cols="45" rows="8" aria-required="true">' .
			'</textarea></p>',

		  'must_log_in' => '<p class="must-log-in">' .
			sprintf(
			  wp_kses( esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.', 'libero' ), array('a'=>array( 'href' => array() )) ),
			  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			) . '</p>',

		  'logged_in_as' => '<p class="logged-in-as">' .
			sprintf(
			wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','libero' ), array('a'=>array( 'href' => array() )) ),
			  admin_url( 'profile.php' ),
			  $user_identity,
			  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			) . '</p>',

		  'comment_notes_after' => '<p class="form-allowed-tags">' .
			sprintf(
			  wp_kses( esc_html__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'libero' ), array('abbr'=>array()) ),
			  ' <code>' . allowed_tags() . '</code>'
			) . '</p>',

		  'fields' => array(
			  'author' =>
				'<div class="row"><div class="col-sm-4"><p class="comment-form-author"><input id="author" name="author" type="text" placeholder="'. esc_html__('Name','libero') . ( $req ? '*' : '' )  .'" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></p></div>',

			  'email' =>
				'<div class="col-sm-4"><p class="comment-form-email"><input id="email" name="email" type="text" placeholder="'. esc_html__('Email','libero') .( $req ? '*' : '' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></p></div>',

			  'url' =>
				'<div class="col-sm-4"><p class="comment-form-url"><input id="url" name="url" type="text" placeholder="'. esc_html__('Website','libero') .'" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" /></p></div></div>',
			)
		);
	  ?>
	<?php comment_form($args); ?>

</div><!-- #comments -->
