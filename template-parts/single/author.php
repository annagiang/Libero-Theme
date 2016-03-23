<?php $user_info = get_userdata(get_the_author_meta( 'ID' )); ?>
<aside class="widget widget_author">
	<div class="text-center">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 110 ); ?></a>
		<span><?php esc_html_e('By:','libero') ?> 
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><cite><?php echo (is_object($user_info) && !empty($user_info->display_name)) ? esc_html($user_info->display_name) : '' ?></cite></a>
		</span>
	</div>
</aside>