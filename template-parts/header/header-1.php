<!--- Header v1 -->
<header id="libero-header" class="libero-header-1 libero-header-border-large">
	<div class="libero-topbar">
		<div class="container">
			<?php 
				if ( has_nav_menu( 'topbar_menu' ) ) {
					wp_nav_menu(array('theme_location' => 'topbar_menu','menu_class'=> 'libero-menu-top','container' => false));
				}
			?>
			<div class="libero-topbar-right">
				<ul class="libero-socials">
					<?php get_template_part( "template-parts/header/social-network" ); ?>
				</ul>
				<?php get_search_form() ?>
			</div>
			<div class="clear"></div>
		</div>
	</div><!--- End Top Bar -->
	<div class="libero-main-header libero-nav-header">
		<div class="container">
			<h1 class="libero-logo"><a href="<?php echo esc_url(home_url("/")) ?>">
				<?php 
					$libero_logo_type = get_theme_mod('libero_logo_type') ? get_theme_mod('libero_logo_type') : 'image';
					get_template_part( "template-parts/header/logo-$libero_logo_type" );
				?>
			</a></h1>
			<button aria-expanded="false" data-target="#libero-main-menu" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
				<span class="sr-only"><?php esc_html_e('Toggle navigation','libero') ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<nav id="libero-main-menu" class="libero-main-menu collapse navbar-collapse">
				<?php 
					if ( has_nav_menu( 'primary_left' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary_left',
								'menu_class'=> 'libero-menu-left',
								'container' => false
							)
						);
					}
					else {
						libero_not_set_menu('libero-menu-left');
					}
					if ( has_nav_menu( 'primary_right' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary_right',
								'menu_class'=> 'libero-menu-right',
								'container' => false
							)
						);
					}
					else {
						libero_not_set_menu('libero-menu-right');
					}
				?>
			</nav>
		</div>
	</div><!--- End Main Header -->
</header><!--- End Header -->