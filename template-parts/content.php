<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package libero
 */

?>

<?php 
	$libero_attr = libero_global_libero_attr();
	$is_hidden_thumbnail = isset($libero_attr['is_hidden_thumbnail']) ? $libero_attr['is_hidden_thumbnail'] : false;
	$is_hidden_category = isset($libero_attr['is_hidden_category']) ? $libero_attr['is_hidden_category'] : false;
	$is_hidden_date = isset($libero_attr['is_hidden_date']) ? $libero_attr['is_hidden_date'] : false;
	$is_hidden_comment = isset($libero_attr['is_hidden_comment']) ? $libero_attr['is_hidden_comment'] : false;
	$is_hidden_excerpt = isset($libero_attr['is_hidden_excerpt']) ? $libero_attr['is_hidden_excerpt'] : false;
	$is_hidden_read_more = isset($libero_attr['is_hidden_read_more']) ? $libero_attr['is_hidden_read_more'] : false;
	$is_hidden_share = isset($libero_attr['is_hidden_share']) ? $libero_attr['is_hidden_share'] : false;
	$excerpt_length = isset($libero_attr['excerpt_length']) ? $libero_attr['excerpt_length'] : 30;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('libero_featured_post libero-classic'); ?>>
	
	<?php if( !$is_hidden_thumbnail ) { ?>
	<div class="libero-loop-thumbnail text-center"><?php get_template_part( 'template-parts/thumbnail', get_post_format() ); ?></div>
	<?php } ?>
	
	<div class="libero-single-content">
		<header class="entry-header">
			
			<div class="text-center">
				
				<?php if( !$is_hidden_category ) { ?>
				<div class="libero_content_meta">
					<span class="libero_category_name"><?php the_category(', '); ?></span>
				</div>
				<?php } ?>
				
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				
				<?php libero_post_info(!$is_hidden_date, false) ?>
			
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			
			<?php if( !$is_hidden_excerpt ) echo libero_get_excerpt_by_id( $post->ID, $excerpt_length); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'libero' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		
		<div class="libero_category_share">
			<?php if( !$is_hidden_read_more ) { ?>
			<a class="libero_continue_reading" href="<?php the_permalink() ?>"><?php esc_html_e('Continue Reading','libero') ?></a>
			<?php } ?>
			
			<?php if( !$is_hidden_share ) { ?>
			<div class="libero_share_icons text-right">
				<?php get_template_part( 'template-parts/share', 'post' ); ?>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
</article><!-- #post-## -->
