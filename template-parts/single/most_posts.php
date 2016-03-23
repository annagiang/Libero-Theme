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
	<h3 class="widget-title"><?php esc_html_e('Most read','libero') ?></h3>
	
	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<div class="libero_mostread_post">
		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('libero-large') ?></a>
		<h6><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
	</div>
	<?php endwhile; ?>
	
</aside>
<?php
		endif;
		wp_reset_postdata();
	endif;
?>