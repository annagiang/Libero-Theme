<!--- Header v3 -->
<header id="libero-header" class="libero-header-3">
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
				<ul class="libero-signin">
					<li><a href="#"><?php esc_html_e('Login','libero') ?></a></li>
					<li><a href="#"><?php esc_html_e('Sign up','libero') ?></a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div><!--- End Top Bar -->
	<div class="libero-main-header">
		<div class="container">
			<?php
				if ( class_exists( 'WooCommerce' ) ) {
					get_template_part( "template-parts/header/cart-mini" ); 
				}
			?>
			<h1 class="libero-logo"><a href="<?php echo esc_url(home_url("/")) ?>">
				<?php 
					$libero_logo_type = get_theme_mod('libero_logo_type') ? get_theme_mod('libero_logo_type') : 'image';
					get_template_part( "template-parts/header/logo-$libero_logo_type" );
				?>
			</a></h1>
			<?php get_search_form() ?>
		</div>
	</div><!--- End Main Header -->
	<div class="libero-nav-menu">
		<div class="container">
			<button aria-expanded="false" data-target="#libero-main-menu" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
				<span class="sr-only"><?php esc_html_e('Toggle navigation','libero') ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<nav id="libero-main-menu" class="libero-main-menu collapse navbar-collapse">
				<?php 
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'=> 'libero-nav-header',
								'container' => false
							)
						);
					}
					else {
						libero_not_set_menu('libero-nav-header');
					}
				?>
			</nav>
		</div>
	</div>
</header><!--- End Header -->