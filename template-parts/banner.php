<?php
	$libero_banner = libero_banner();
	if( $libero_banner['is_show'] ) :
?>
<section class="libero_header_banner" data-background="<?php echo esc_attr($libero_banner['background']) ?>">
	<div class="container text-center">
		<div class="row">
			<div class="col-sm-12">
				<div class="libero_banner_content">
					<div class="libero_content_paragraph">
						<h2><?php echo force_balance_tags($libero_banner['title']) ?></h2>
						<?php if( isset($libero_banner['description']) && $libero_banner['description'] ) { ?>
						<p><?php echo force_balance_tags($libero_banner['description']) ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>