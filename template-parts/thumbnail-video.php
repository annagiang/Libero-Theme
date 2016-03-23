<?php
	$type = rs::getField('libero_video_type',get_the_ID());
	$embed = rs::getField('libero_video_embed',get_the_ID());
	$width = rs::getField('libero_video_width',get_the_ID());
	$height = rs::getField('libero_video_height',get_the_ID());
	
	if( $embed != '' ) {
		switch ($type) {
			case 'youtube':
				$url = 'http://www.youtube.com/embed/'. esc_html($embed);
				break;
			case 'vimeo':
				$url = 'http://player.vimeo.com/video/'. esc_html($embed);
				break;
		}
		echo '<div class="libero-iframe"><iframe src="'. esc_url($url) .'" width="'. ($width ? absint($width) : '480') .'" height="'. ($height ? absint($height) : '270') .'" ></iframe></div>';
	}
	else {
		get_template_part( 'template-parts/thumbnail' );
	}
?>