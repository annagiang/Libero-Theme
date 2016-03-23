<?php 
	//for use in the loop, list 3 post titles related to first tag on current post
	$tags = wp_get_post_tags(get_the_ID());
	if ( $tags ) :
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array(get_the_ID()),
			'posts_per_page'=> 3
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) :
?>
<aside class="widget widget_most_read">
	<h3><?php esc_html_e('You might also like','libero') ?></h3>
	
	<div class="row libero_row">
		<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<div class="col-sm-4 libero_col">
			<div class="libero_featured_post libero_small_post">
				<div class="libero_featured_thumbnail">
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('libero-large') ?></a>
					<div class="libero_thumbnail_overlay">
						<a href="<?php the_permalink() ?>" class="libero_readmore"><?php esc_html_e('Read more','libero') ?></a>
					</div>
				</div>
				<div class="libero_featured_content">
					<h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
					<div class="libero-post-info">
						<?php libero_post_info(true, false) ?>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
	
</aside>
<?php
		endif;
		wp_reset_postdata();
	endif;
?>