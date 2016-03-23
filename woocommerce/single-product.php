<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div id="primary" class="content-area">
		<div class="container libero_detail">
			<?php
				global $post;
				$post_id = $post->ID;
				$class = array();
				
				$is_default = rs::getField('rst_single_layout',$post_id);
				$layout = $is_default ? rs::getField('rst_single_layout',$post_id) : ( get_theme_mod('rst_single_woo_layout') ? get_theme_mod('rst_single_woo_layout') : 1 );
				$is_sidebar = $layout == 2 || $layout == 3;
				$sidebar = $is_default ? rs::getField('rst_single_sidebar',$post_id) : ( get_theme_mod('rst_single_woo_sidebar') ? get_theme_mod('rst_single_woo_sidebar') : 'sidebar-1');
				
				$template = rs::getField('single_template',$post_id) ? rs::getField('single_template',$post_id) : ( get_theme_mod('rst_single_woo_template') ? get_theme_mod('rst_single_template') : 1 );
				
				$template = $template == 1 ? 'single' : 'single-2';
				
				$class[] = 'site-content';
				$class[] = $is_sidebar ? 'col-sm-9' : 'col-sm-12';
				$class[] = $layout == 2 ? 'has-sidebar-left' : '';
				$class[] = $layout == 3 ? 'has-sidebar-right' : '';
			?>
			<div class="row">
				
				<div class="<?php echo libero_class($class) ?>" id="liber-content">
				
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
				
				<?php if( $is_sidebar ) { ?>
				<?php 
					$class_sidebar = array();
					$class_sidebar[] = 'sidebar';
					$class_sidebar[] = 'col-sm-3';
					$class_sidebar[] = 'widget-area';
					$class_sidebar[] = $layout == 2 ? 'sidebar-left' : '';
					$class_sidebar[] = $layout == 3 ? 'sidebar-right' : '';
				?>
				<div id="sidebar" class="<?php echo libero_class($class_sidebar) ?>" role="complementary">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div><!-- #secondary -->
				
				<?php } ?>
			</div>
		
		</div>
		
		<div class="container">
			<div class="sidebar-woocommerce">
				<?php 
					if ( ! get_theme_mod('cat_woo_hide_ads_bottom') && is_active_sidebar( 'sidebar-woocommerce-ads' ) ) {
						dynamic_sidebar( 'sidebar-woocommerce-ads' );
					}
				?>
			</div>
			
			<?php if( !get_theme_mod('cat_woo_hide_new_arrivals') ) { ?>
				<?php wc_get_template_part( 'slider-new-arrivals' ); ?>
			<?php } ?>
		</div>
		
		<?php if( !get_theme_mod('single_woo_hide_breadcrumb') ) { ?>
		<div class="container">
			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_breadcrumb - 10 (outputs closing divs for the content)
				 */
				do_action( 'libero_woocommerce_after_main_content_single_product' );
			?>
		</div>
		<?php } ?>
		
	</div><!-- #primary -->

<?php get_footer( 'shop' ); ?>
