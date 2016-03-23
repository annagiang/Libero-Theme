<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package libero
 */

get_header(); ?>

	<?php get_template_part( 'template-parts/banner' ); ?>

	<div id="primary" class="content-area">
	
		<?php if( !get_theme_mod('disable_loading_content') ) echo '<div class="pageLoading"><div class="pageLoadingInner"></div></div>'; ?>
	
		<div class="container">
		
		<?php
			global $wp_query;
			$class = array();
			$liberokey = uniqid();
			
			$layout = get_theme_mod('libero_cat_layout') ? get_theme_mod('libero_cat_layout') : 3;
			$is_sidebar = $layout == 2 || $layout == 3;
			$sidebar = get_theme_mod('libero_cat_sidebar') ? get_theme_mod('libero_cat_sidebar') : 'sidebar-1';
			
			$template = get_theme_mod('libero_cat_template') ? get_theme_mod('libero_cat_template') : 'large';
			
			$numberpost = get_theme_mod('libero_cat_numberpost') ? get_theme_mod('libero_cat_numberpost') : 10;
			$excerpt_length = get_theme_mod('libero_cat_excerpt_length') ? get_theme_mod('libero_cat_excerpt_length') : 30;
			$pagenavi = get_theme_mod('libero_cat_pagenavi') ? get_theme_mod('libero_cat_pagenavi') : 'number';
			$number_loadmore = get_theme_mod('libero_cat_number_loadmore') ? get_theme_mod('libero_cat_number_loadmore') : 4;
			$columns = get_theme_mod('libero_cat_columns') ? get_theme_mod('libero_cat_columns') : 2;
			if( ! $columns ) $columns = 2;
			$columns = 12/$columns;
			
			$libero_attr['is_hidden_thumbnail'] = get_theme_mod('cat_hidden_thumbnail');
			$libero_attr['is_hidden_category'] = get_theme_mod('cat_hidden_category');
			$libero_attr['is_hidden_date'] = get_theme_mod('cat_hidden_date');
			$libero_attr['is_hidden_comment'] = get_theme_mod('cat_hidden_comment');
			$libero_attr['is_hidden_excerpt'] = get_theme_mod('cat_hidden_excerpt');
			$libero_attr['is_hidden_read_more'] = get_theme_mod('cat_hidden_read_more');
			$libero_attr['is_hidden_share'] = get_theme_mod('cat_hidden_share');
			$libero_attr['excerpt_length'] = $excerpt_length;
			$libero_attr['pagenavi'] = $pagenavi;
			$libero_attr['number_loadmore'] = $number_loadmore;
			$libero_attr = libero_global_libero_attr();
			
			$class[] = 'site-content';
			$class[] = $is_sidebar ? 'col-sm-8' : 'col-sm-12';
			$class[] = $layout == 2 ? 'has-sidebar-left' : '';
			$class[] = $layout == 3 ? 'has-sidebar-right' : '';
			
			
			$args = array(
				'posts_per_page' 	=> absint($numberpost),
				'paged' 			=> max( get_query_var( 'paged' ), get_query_var( 'page' ))
			);
			$query_default = $wp_query->query_vars;
			unset($query_default['s']);
			$args = array_merge( $query_default, $args );
			$the_query = new WP_Query( $args );
		?>
			<div class="row">
				<div class="<?php echo libero_class($class) ?>" id="liber-content">
					<?php
						$class = array();
						$class[] = 'libero-inner-content';
						if( $template == 'medium' ) {
							$class[] = 'libero_lasted_news';
						}
						if( $template == 'box' ) {
							$class[] = 'libero_blog_list';
							$class[] = 'row';
						}
					?>
				<div class="<?php echo libero_class($class) ?>">
				
					<?php if ( $the_query->have_posts() ) : ?>
						
						<?php /* Start the Loop */ ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<?php if( $template == 'box' ) echo '<div class="col-sm-'. absint($columns) .'">'; ?>
							
							<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', $template );
							?>
							
							<?php if( $template == 'box' ) echo '</div>'; ?>

						<?php endwhile; ?>
						
						<div class="clear"></div>
						<?php if( function_exists('libero_paging_nav') ) libero_paging_nav($the_query,$libero_attr,$liberokey); ?>

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
		
			<?php
				$hide_breadcrumb = get_theme_mod('cat_hidden_breadcrumb');
				if( ! $hide_breadcrumb ) libero_wp_bac_breadcrumb();
			?>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>
