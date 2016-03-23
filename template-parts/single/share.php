<aside class="widget widget_share">
	<div class="text-left">
		<?php if( ! get_theme_mod('share_facebook') ) { ?>
		<a class="widget_share_facebook" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>"><i class="fa fa-facebook"></i> <span><?php esc_html_e('Share','libero') ?></span></a>
		<?php } ?>
		<?php if( ! get_theme_mod('share_twitter') ) { ?>
		<a class="widget_share_twitter" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="http://twitter.com/share?url=<?php the_permalink() ?>"><i class="fa fa-twitter"></i> <span><?php esc_html_e('Tweet','libero') ?></span></a>
		<?php } ?>
		<?php if( ! get_theme_mod('share_google_plus') ) { ?>
		<a class="widget_share_google_plus" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="fa fa-google-plus"></i> <span><?php esc_html_e('Google Plus','libero') ?></span></a>
		<?php } ?>
		<?php if( ! get_theme_mod('share_pinterest') ) { ?>
		<a class="widget_share_pinterest" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="fa fa-pinterest-p"></i> <span><?php esc_html_e('Pin','libero') ?></span></a>
		<?php } ?>
	</div>
</aside>