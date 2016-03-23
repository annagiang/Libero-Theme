<?php
$audio_iframe = rs::getField('libero_audio_iframe',get_the_ID());
if( $audio_iframe != '' ) {
	echo '<div class="libero-iframe">'. $audio_iframe .'</div>';
}
else {
	get_template_part( 'template-parts/thumbnail' );
}