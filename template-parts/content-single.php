<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package libero
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('libero_detail_content libero-single-style-1'); ?>>
	<header class="entry-header">
		
		<?php if( !get_theme_mod('single_hide_category') ) { ?>
		<div class="libero_content_meta">
			<span class="libero_category_name"><?php the_category(', '); ?></span>
		</div>
		<?php } ?>
		
		<?php if( !get_theme_mod('single_hide_title') ) the_title( '<h1 class="libero_detail_title">', '</h1>' ); ?>
		
		<div class="libero_post_metas">
			<?php libero_post_info(!get_theme_mod('single_hide_date'), !get_theme_mod('single_hide_comment_count'), !get_theme_mod('single_hide_views')) ?>
		</div>
		
		<?php if( !get_theme_mod('single_hide_share') ) { ?>
			<?php get_template_part( 'template-parts/single/share' ); ?>
		<?php } ?>
		
	</header><!-- .entry-header -->
	
	<?php if( !get_theme_mod('single_hide_thumbnail') ) { ?>
	<div class="libero_detail_thumbnail">
		<?php get_template_part( 'template-parts/thumbnail', get_post_format() ); ?>
	</div>
	<?php } ?>
	
	<?php $class = !rs::getField('single_first_text') ? 'libero_post_dropcap' : '' ?>
	<div class="entry-content libero_post_content <?php echo esc_attr($class) ?>">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'libero' ),
				'after'  => '</div>',
			) );
		?>
		
		<?php if( wp_get_post_tags(get_the_ID()) && ! get_theme_mod('single_hide_tags') ) { ?>
		<div class="libero_tag_meta">
			<div class="libero_post_tag">
				<span><?php esc_html_e('Tags:','libero') ?></span>
				<?php the_tags( '', ' ', '<br />' ); ?> 
			</div>
		</div>
		<?php } ?>
		
	</div><!-- .entry-content -->
	
	<?php if( !get_theme_mod('single_hide_author') ) { ?>
		<?php get_template_part( 'template-parts/single/author-info' ); ?>
	<?php } ?>
	
	<?php if( !get_theme_mod('single_hide_most_posts') ) { ?>
		<?php get_template_part( 'template-parts/single/most_posts_2' ); ?>
	<?php } ?>

</article><!-- #post-## -->
