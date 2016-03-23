<?php if( ! get_theme_mod('share_facebook') ) { ?>
<a onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>"><i class="fa fa-facebook"></i></a>
<?php } ?>

<?php if( ! get_theme_mod('share_twitter') ) { ?>
<a onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="http://twitter.com/share?url=<?php the_permalink() ?>"><i class="fa fa-twitter"></i></a>
<?php } ?>

<?php if( ! get_theme_mod('share_google') ) { ?>
<a onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="fa fa-google-plus"></i></a>
<?php } ?>

<?php if( ! get_theme_mod('share_pinterest') ) { ?>
<a onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="fa fa-pinterest-p"></i></a>
<?php } ?>