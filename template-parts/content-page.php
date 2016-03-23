<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package libero
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		<?php if( ! rs::getField('page_hidden_title') ) { ?>
			<?php the_title('<h3 class="libero-page-title">','</h3>') ?>
		<?php } ?>
		
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'libero' ),
				'after'  => '</div>',
			) );
		?>
		
		
	</div><!-- .entry-content -->

</div><!-- #post-## -->
