<?php 
	$link = rs::getField('libero_link_url');
	if( !empty($link) && is_string($link) ) { 
?>
	<div class="libero-format-link"><a href="<?php echo esc_url($link) ?>"><?php the_post_thumbnail('large') ?><span class="libero-format-link-overlay"></span></a></div>
<?php } else { ?>
	<?php get_template_part( 'template-parts/thumbnail' ); ?>
<?php } ?>