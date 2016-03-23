<?php
	$categories = wp_get_post_categories(get_the_ID());
	$category = isset($categories[0]) ? $categories[0] : 1;
	$current_cat = get_category($category);
	$args=array(
		'post__not_in' => array(get_the_ID()),
		'category__in' => $category,
		'posts_per_page'=> 3
	);
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
?>
<div class="libero_more_posts">
	<div class="row libero_row">
		
		<div class="col-sm-3 libero_col">
			<div class="libero_more_from_cat">
				<div class="libero_more_from_cat_content text-center">
					<h5><span><?php esc_html_e('More from','libero') ?></span><br><?php echo esc_attr($current_cat->name) ?></h5>
					<span><b><?php echo absint( $current_cat->count ) ?></b> <?php esc_html_e('Articles','libero') ?></span>
				</div>
			</div>
		</div>
		
		<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<div class="col-sm-3 libero_col">
			<div class="libero_featured_post libero_small_post">
				<div class="libero_featured_thumbnail">
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('libero-medium') ?></a>
					<div class="libero_thumbnail_overlay">
						<a href="<?php the_permalink() ?>" class="libero_readmore"><?php esc_html_e('Read more','libero') ?></a>
					</div>
				</div>
				<div class="libero_featured_content">
					<h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
					<div class="libero-post-info">
						<?php libero_post_info() ?>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
</div>
<?php wp_reset_postdata(); endif; ?>