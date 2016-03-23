<div class="libero_header_sticky">
	<div class="container">
		<div class="libero_sticky_logo">
			<a class="sticky-logo" href="<?php echo esc_url(home_url("/")) ?>">
				<?php 
					$libero_logo_type = get_theme_mod('libero_logo_type') ? get_theme_mod('libero_logo_type') : 'image';
					get_template_part( "template-parts/header/logo-$libero_logo_type" );
				?>
			</a>
			<button class="navbar-toggle">
				<span class="sr-only"><?php esc_html_e('Toggle navigation','libero') ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php
				$libero_header_layout = get_theme_mod('libero_header_layout') ? absint(get_theme_mod('libero_header_layout')) : 2;
				if( isset($post) && !is_object(rs::getField('header_layout')) && rs::getField('header_layout') ) {
					$libero_header_layout = rs::getField('header_layout');
				}
				if( is_tax( 'product_cat' ) ) {
					global $wp_query;
					$tag = $wp_query->get_queried_object();
					$post_id = is_object($tag) && isset($tag->term_id) ? 'term_'. $tag->term_id : '';
					
					if( rs::getField('header_layout',$post_id) ) {
						$libero_header_layout = rs::getField('header_layout',$post_id);
					}
				}
				if( $libero_header_layout == 1 ) {
					if ( has_nav_menu( 'primary_left' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary_left',
								'menu_class'=> 'libero-menu-left',
								'container' => false
							)
						);
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
				}
				else {
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'=> 'libero-nav-header',
								'container' => false
							)
						);
					}
				}
			?>
		</div>
		<?php if( is_single() ) { ?>
		<div class="libero_sticky_nowreading">
			<div class="libero_sticky_post_title">
				<span><?php esc_html_e('Now reading','skeets') ?></span>
				<h5 class="libero-post-title"><?php the_title() ?></h5>
			</div>
			<div class="clear"></div>
		</div>
		<div class="libero_sticky_nav">
			<div class="libero_sticky_share">
				<?php get_template_part( "template-parts/share-post" ); ?>
			</div>
			<form class="libero-search-form" action="<?php echo esc_url(home_url("/")) ?>">
				<input type="text" name="s" placeholder="<?php esc_html_e('Type to search...','skeets') ?>">
				<button><i class="fa fa-search"></i></button>
			</form>
			<?php
				previous_post_link( '%link', '<i class="fa fa-angle-left"></i> ' . esc_html__('prev','skeets') );
				next_post_link( '%link', esc_html__('next','skeets') . ' <i class="fa fa-angle-right"></i>' );
			?>
		</div>
		<?php } else { ?>
			<?php get_template_part( "template-parts/header/breaking-news" ); ?>
		<?php } ?>
		<div class="clear"></div>
	</div>
</div>