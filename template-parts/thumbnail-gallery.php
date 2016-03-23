<?php
	$gallery = rs::getField('libero_gallery',get_the_ID(),'gallery');
	if(sizeof($gallery)) { ?>
	 <div class="libero-thumbnail-slider owl-carousel">
		<?php foreach( $gallery as $img ) { ?>
		  <img alt="<?php echo esc_attr(get_the_title(get_the_ID())) ?>" src="<?php echo esc_url(libero_get_attachment_image_src( $img['id'], 'libero-large' )) ?>"/>
		<?php } ?>                   
	</div>
<?php
	}
	else {
		 get_template_part( 'template-parts/thumbnail' );
	}