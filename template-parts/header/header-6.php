<!--- Header -->
<header id="libero-header" class="libero-header-6">
	<div class="libero-main-header">
		<div class="container">
			<h1 class="libero-logo text-center"><a href="<?php echo esc_url(home_url("/")) ?>">
				<?php 
					$libero_logo_type = get_theme_mod('libero_logo_type') ? get_theme_mod('libero_logo_type') : 'image';
					get_template_part( "template-parts/header/logo-$libero_logo_type" );
				?>
			</a></h1>
			<div class="libero-nav-menu">
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
				<div class="libero-topbar-right">
					<ul class="libero-socials">
						<?php get_template_part( "template-parts/header/social-network" ); ?>
					</ul>
					<?php get_search_form() ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div><!--- End Main Header -->
</header><!--- End Header -->