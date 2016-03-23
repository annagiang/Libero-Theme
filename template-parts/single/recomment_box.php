<?php 
	global $wpdb, $post;
	$recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 3";
	$the_comments = $wpdb->get_results($recent_comments); 
?>
<?php if( $the_comments ) : ?>
<div class="libero_recomment_box"> 
	<h4><span><?php esc_html_e("You May Interested","skeets") ?></span></h5>
	<?php foreach( $the_comments as $comment ) : ?>
	<?php 
		$post = get_post($comment->comment_post_ID);
		setup_postdata($post);
	?>
	<div class="libero_recent_post">
		<div class="libero-thumbnail">
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail') ?></a>
		</div>
		<div class="libero-post-info">
			<h5 class="libero-post-title">
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</h5>
			<?php libero_post_info() ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; wp_reset_postdata(); ?>
</div>
<?php endif; ?>