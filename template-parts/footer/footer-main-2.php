<div class="libero-logo-footer">
	<?php if( get_theme_mod('libero_footer_logo') ) { ?>
	<img src="<?php echo get_theme_mod('libero_footer_logo') ?>" alt="" />
	<?php } ?>
</div>

<?php 
	if( get_theme_mod('libero_footer_partner') ) {
	parse_str(get_theme_mod('libero_footer_partner'), $libero_partner );
	if( is_array( $libero_partner ) && isset( $libero_partner['libero_footer_partner'] ) ) { 
		$libero_partner = $libero_partner['libero_footer_partner'];
?>
<ul class="libero-partner">
	<?php foreach( $libero_partner as $partner ) { ?>
	<li><a href="<?php echo esc_url($partner['link']) ?>"><img src="<?php echo esc_url( wp_get_attachment_url($partner['logo']) ) ?>" alt="" /></a></li>
	<?php } ?>
</ul>
<?php } ?>
<?php } ?>
<div class="clear"></div>