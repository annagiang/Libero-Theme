<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package libero
 */

get_header(); ?>

	<div id="primary" class="content-area">
		
		<?php if( !get_theme_mod('disable_loading_content') ) echo '<div class="pageLoading"><div class="pageLoadingInner"></div></div>'; ?>
	
		<div class="container libero_detail">
			<?php
				global $post;
				$post_id = $post->ID;
				$class = array();
				
				$is_default = rs::getField('rst_single_layout',$post_id);
				$layout = $is_default ? rs::getField('rst_single_layout',$post_id) : ( get_theme_mod('rst_single_layout') ? get_theme_mod('rst_single_layout') : 1 );
				$is_sidebar = $layout == 2 || $layout == 3;
				$sidebar = $is_default ? rs::getField('rst_single_sidebar',$post_id) : ( get_theme_mod('rst_single_sidebar') ? get_theme_mod('rst_single_sidebar') : 'sidebar-1');
				
				$template = rs::getField('single_template',$post_id) ? rs::getField('single_template',$post_id) : ( get_theme_mod('rst_single_template') ? get_theme_mod('rst_single_template') : 1 );
				
				$template = $template == 1 ? 'single' : 'single-2';
				
				$class[] = 'site-content';
				$class[] = $is_sidebar ? 'col-sm-8' : 'col-sm-12';
				$class[] = $layout == 2 ? 'has-sidebar-left' : '';
				$class[] = $layout == 3 ? 'has-sidebar-right' : '';
			?>
			<div class="row">
				
				<div class="<?php echo libero_class($class) ?>" id="liber-content">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php 
							get_template_part( 'template-parts/content', $template ); 
						?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( ( comments_open() || get_comments_number() ) && !get_theme_mod('single_hide_comment') ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // End of the loop. ?>
					
					<?php
						if( get_theme_mod('single_enable_next_post') ) {
							get_template_part( 'template-parts/loadnextpost' );
						}
					?>
					
					<?php
						$hide_breadcrumb = get_theme_mod('single_hide_breadcrumb');
						if( ! $hide_breadcrumb ) libero_wp_bac_breadcrumb();
					?>
				</div>
				
				<?php if( $is_sidebar ) { ?>
				<?php 
					$class_sidebar = array();
					$class_sidebar[] = 'sidebar';
					$class_sidebar[] = 'col-sm-4';
					$class_sidebar[] = 'widget-area';
					$class_sidebar[] = $layout == 2 ? 'sidebar-left' : '';
					$class_sidebar[] = $layout == 3 ? 'sidebar-right' : '';
					if( get_theme_mod('sidebar_title_style') == 2 ) $class_sidebar[] = 'libero-sidebar-center';
				?>
				<div id="sidebar" class="<?php echo libero_class($class_sidebar) ?>" role="complementary">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div><!-- #secondary -->
				
				<?php } ?>
				
				<?php if( !get_theme_mod("single_hide_recomment_box") && !get_theme_mod('single_enable_next_post') ) { ?>
					<?php get_template_part( 'template-parts/single/recomment_box' ); ?>
				<?php } ?>
				
			</div>
		
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>
