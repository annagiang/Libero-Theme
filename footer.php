<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package libero
 */

?>
	<?php
		$libero_footer_top_layout = get_theme_mod('libero_top_footer_layout') ? get_theme_mod('libero_top_footer_layout') : 1;
		$libero_footer_main_layout = get_theme_mod('libero_main_footer_layout') ? get_theme_mod('libero_main_footer_layout') : 1;
	?>
	<footer class="libero-footer footer-style-<?php echo absint($libero_footer_top_layout) ?>">
		<?php 
			if( get_theme_mod('libero_show_top_footer') ) {
				get_template_part( "template-parts/footer/footer-top-$libero_footer_top_layout" );
			}
		?>
		<div class="libero-main-footer">
			<div class="container">
				<?php 
					get_template_part( "template-parts/footer/footer-main-$libero_footer_main_layout" );
				?>
			</div>
		</div>
	</footer><!--- End Footer -->
</section><!--- End Wrapper -->
<?php wp_footer(); ?>

</body>
</html>
