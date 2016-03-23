<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package libero
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="container">

			<section class="error-404 not-found">
				<header class="text-center">
					<h1 class="page-title"><?php esc_html_e( '404', 'libero' ); ?></h1>
					<p><?php esc_html_e('We are sorry.  But the page you are looking for cannot be found. You might try searching our site.','libero') ?></p>
				</header><!-- .page-header -->

				<div class="page-content text-center">
					<?php get_search_form() ?> 
					<a href="<?php echo esc_url(home_url("/")) ?>" class="libero-backhome"><?php esc_html_e('Back to home page','libero') ?></a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

			<?php libero_wp_bac_breadcrumb(); ?>
			
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>
