<?php if( !get_theme_mod('libero_logo') ) { ?>
<img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="<?php echo get_option('blogname') ?>">
<?php } else { ?>
<img src="<?php echo esc_url(get_theme_mod('libero_logo')) ?>" alt="<?php echo get_option('blogname') ?>">
<?php } ?>