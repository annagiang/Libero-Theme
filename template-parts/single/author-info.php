<?php
	$user_info = get_userdata(get_the_author_meta( 'ID' ));
	$size_author = 110;
?>
<div class="libero-author-box libero-wrap-content wow fadeIn animated">
	<div class="libero-author-head">
		<div class="libero-author-img">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), $size_author ); ?>
			</a>
		</div>
		<div class="libero-author-info">
			<h4 class="empty-title"><span>
				<?php echo (is_object($user_info) && !empty($user_info->display_name)) ? esc_html($user_info->display_name) : '' ?>
			</span></h4>
			<?php if( get_the_author_meta( 'description', get_the_author_meta( 'ID' ) ) ) { ?>
			<div class="libero-author-about">
				<?php echo apply_filters('the_content', get_the_author_meta( 'description', get_the_author_meta( 'ID' ) )); ?>
			</div>
			<?php } ?>
			<div class="libero-author-link">
				
				<?php if( rs::getField('user_facebook','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_facebook','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-facebook"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_google','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_google','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-google-plus"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_twitter','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_twitter','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-twitter"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_tumblr','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_tumblr','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-tumblr"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_youtube','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_youtube','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-youtube"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_google','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_google','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-pinterest-p"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_linkedin','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_linkedin','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-linkedin"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_tumblr','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_tumblr','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-tumblr"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_flickr','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_flickr','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-flickr"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_instagram','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_instagram','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-instagram"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_vimeo','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_vimeo','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-vimeo-square"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_dribbble','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_dribbble','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-dribbble"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_digg','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_digg','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-digg"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_skype','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_skype','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-skype"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_deviantart','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_deviantart','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-deviantart"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_yahoo','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_yahoo','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-yahoo"></i></a>
				<?php } ?>
				
				<?php if( rs::getField('user_reddit','user_'.get_the_author_meta( 'ID' )) ) { ?>
				<a target="_blank" href="<?php echo rs::getField('user_reddit','user_'.get_the_author_meta( 'ID' )) ?>"><i class="fa fa-reddit"></i></a>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>