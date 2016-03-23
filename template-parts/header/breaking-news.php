<div class="libero_sticky_nowreading">
	<div class="libero_sticky_post_title">
		<span><?php esc_html_e('Breaking news:','libero') ?></span>
		<div class="libero_breaking_news">
			<?php 
				global $post;
				$args = array( 'posts_per_page' => 10 );
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post );
			?>
			<h5 class="libero-post-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
			<?php endforeach;
				wp_reset_postdata(); ?>
		</div>
	</div>
	<div class="clear"></div>
</div>