<div class="copyright">
	<?php 
		$libero_default_copyright = esc_html__('&copy; 2015 Libero Magazine - LiberThemes. All Rights Reserved.','libero');
		echo get_theme_mod('libero_footer_copyright') ? get_theme_mod('libero_footer_copyright') : $libero_default_copyright;
	?>
</div>
<?php 
	if ( has_nav_menu( 'footer_menu' ) ) {
		wp_nav_menu(array('theme_location' => 'footer_menu','menu_class'=> 'libero-menu-footer','container' => false));
	}
?>
<div class="clear"></div>