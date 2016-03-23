<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
	
	<?php get_template_part( 'template-parts/banner' ); ?>
	
	<div id="primary" class="content-area">
		<div class="container libero_detail">
		
		<?php
			global $wp_query, $woocommerce_loop;
			$tag = $wp_query->get_queried_object();
			$class = array();
			
			$post_id = is_object($tag) && isset($tag->term_id) ? 'term_'. $tag->term_id : '';
			
			if( is_shop() ) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			}
			
			$is_default = rs::getField('rst_shop_layout',$post_id);
			$layout = $is_default ? rs::getField('rst_shop_layout',$post_id) : ( get_theme_mod('rst_cat_woo_layout') ? get_theme_mod('rst_cat_woo_layout') : 2 );
			$is_sidebar = $layout == 2 || $layout == 3;
			$sidebar = $is_default ? rs::getField('rst_shop_sidebar',$post_id) : ( get_theme_mod('rst_cat_woo_sidebar') ? get_theme_mod('rst_cat_woo_sidebar') : 'sidebar-1' );
			
			$numberpost = $is_default ? rs::getField('libero_shop_numberpost',$post_id) : ( get_theme_mod('shop_numberpost') ? get_theme_mod('shop_numberpost') : 12 );
			$columns = $is_default ? rs::getField('libero_shop_columns',$post_id) : ( get_theme_mod('libero_shop_columns') ? get_theme_mod('libero_shop_columns') : 3 );
			$product_style = $is_default ? rs::getField('libero_shop_product_style',$post_id) : ( get_theme_mod('libero_shop_product_style') ? get_theme_mod('libero_shop_product_style') : 1 );
			$woocommerce_loop['columns'] = $columns;
			$woocommerce_loop['product_style'] = $product_style;
			
			$class[] = 'site-content';
			$class[] = $is_sidebar ? 'col-sm-9' : 'col-sm-12';
			$class[] = $layout == 2 ? 'has-sidebar-left' : '';
			$class[] = $layout == 3 ? 'has-sidebar-right' : '';
			
			
			$args = array(
				'posts_per_page' 	=> absint($numberpost),
				'paged' 			=> max( get_query_var( 'paged' ), get_query_var( 'page' ))
			);
			$query_default = $wp_query->query_vars;
			unset($query_default['s']);
			$args = array_merge( $query_default, $args );
			
			if( isset($_GET['filter_value']) && isset($_GET['attribute_filter']) && !empty($_GET['filter_value']) && !empty($_GET['attribute_filter']) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy'	=> $_GET['attribute_filter'],
						'field'    => 'slug',
						'terms'    => $_GET['filter_value']
					)
				);
			}
			if( isset($_GET['brand']) && is_array($_GET['brand']) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy'	=> 'libero-brand',
						'field'    => 'term_id',
						'terms'    => $_GET['brand']
					)
				);
			}
			
			$the_query = new WP_Query( $args );
		?>
		
		<div class="row">
			<div class="<?php echo libero_class($class) ?>" id="liber-content">
				<div class="libero-inner-content">
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php 
							$shop_image = rs::getField('libero_shop_image', $post_id );
							if( $shop_image ) { 
						?>
						<div class="libero-product_cat-image"><img src="<?php echo esc_url( wp_get_attachment_url($shop_image) ) ?>" alt="" /></div>
						<?php } ?>

						<?php if ( $the_query->have_posts() ) : ?>

							<div class="libero-before-shop">
							<?php
								/**
								 * woocommerce_before_shop_loop hook
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
							</div>
							
							<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php 
								if( function_exists('libero_paging_nav') ) {
									echo '<br />';
									libero_paging_nav($the_query); 
								}
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
					
				</div>
					
				</div><!-- .site-content -->
				
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

			</div><!-- .row -->
			
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
			
			<?php
				$hide_breadcrumb = get_theme_mod('cat_woo_hide_breadcrumb');
				if( ! $hide_breadcrumb ) woocommerce_breadcrumb();
			?>
			
		</div>
	</div><!-- #primary -->

<?php get_footer( 'shop' ); ?>
