<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package libero
 */

get_header(); ?>

	<?php get_template_part( 'template-parts/banner' ); ?>
	
	<div id="primary" class="content-area">
		
		<?php if( !get_theme_mod('disable_loading_content') ) echo '<div class="pageLoading"><div class="pageLoadingInner"></div></div>'; ?>
		
		<?php
			global $post;
			$post_id = $post->ID;
			$class = array();
			
			$is_default = rs::getField('rst_page_layout',$post_id);
			$layout = $is_default ? rs::getField('rst_page_layout',$post_id) : ( get_theme_mod('rst_page_layout') ? get_theme_mod('rst_page_layout') : 1 );
			$is_sidebar = $layout == 2 || $layout == 3;
			$sidebar = $is_default ? rs::getField('rst_page_sidebar',$post_id) : ( get_theme_mod('rst_page_sidebar') ? get_theme_mod('rst_page_sidebar') : 'sidebar-1');
			$page_width = $is_default ? rs::getField('rst_page_width',$post_id) : ( get_theme_mod('rst_page_width') === false ? 1 : get_theme_mod('rst_page_width') );
			
			$class[] = 'site-content';
			$class[] = $is_sidebar ? 'col-sm-8' : 'col-sm-12';
			$class[] = $layout == 2 ? 'has-sidebar-left' : '';
			$class[] = $layout == 3 ? 'has-sidebar-right' : '';
			
		?>
		
		<?php if( $page_width == 1 ) { ?>
		<div class="container">	
		<?php } ?>
		
		<?php if( $page_width == 2 ) { ?>
		<div class="container container-970">	
		<?php } ?>
			
			<div class="row">
				<div class="<?php echo libero_class($class) ?>" id="liber-content">
					<div class="rst-inner-content">
					
						<?php if ( have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'page' );
								?>
								
								<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( ( comments_open() || get_comments_number() ) && !get_theme_mod('page_hide_comment') ) :
										comments_template();
									endif;
								?>

							<?php endwhile; ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>
						
					</div>
					
				</div><!-- .site-content -->
				
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

			</div><!-- .row -->
			
		<?php if( $page_width ) { ?>
		</div><!-- .container -->
		<?php } ?>
		
		
		<div class="container">
			<?php
				$hide_breadcrumb = rs::getField('page_hidden_breadcrumb');
				if( ! $hide_breadcrumb || ! isset( $hide_breadcrumb ) ) libero_wp_bac_breadcrumb();
			?>
		</div>

	</div><!-- #primary -->

<?php get_footer(); ?>
