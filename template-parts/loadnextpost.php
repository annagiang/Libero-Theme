<?php
	global $post;
	$post_id = $post->ID;
	$template = rs::getField('single_template',$post_id) ? rs::getField('single_template',$post_id) : ( get_theme_mod('rst_single_template') ? get_theme_mod('rst_single_template') : 1 );
	$template = $template == 1 ? 'single' : 'single-2';
	$next_post = get_next_post();
	if( $next_post ) :
?>
<div id="libero-next-post" data-template="<?php echo esc_attr($template) ?>" data-id="<?php echo absint($next_post->ID) ?>"></div>
<div class="libero-loadnextpost text-center">
	<?php get_template_part("template-parts/loading") ?>
</div>
<?php endif; ?>