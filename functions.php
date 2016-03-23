<?php
/**
 * libero functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package libero
 */

if ( ! function_exists( 'libero_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function libero_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on libero, use a find and replace
	 * to change 'libero' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'libero', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'libero' ),
		'primary_left' => esc_html__( 'Primary Left Menu (Header 1)', 'libero' ),
		'primary_right' => esc_html__( 'Primary Right Menu (Header 1)', 'libero' ),
		'topbar_menu' => esc_html__( 'TopBar Menu', 'libero' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'libero' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'video',
		'audio',
		'quote',
		'link',
	) );

	
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'libero-large', '1170', '0', true );
		add_image_size( 'libero-medium', '740', '494', true );
	}


		
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function libero_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'libero_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'libero_content_width', 0 );

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function libero_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'libero' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar WooCommerce', 'libero' ),
			'id'            => 'sidebar-woocommerce',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Single WooCommerce Ads', 'libero' ),
			'id'            => 'sidebar-woocommerce-ads',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'libero' ),
			'id'            => 'footer-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'libero' ),
			'id'            => 'footer-2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'libero' ),
			'id'            => 'footer-3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'libero' ),
			'id'            => 'footer-4',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}
	add_action( 'widgets_init', 'libero_widgets_init' );

	/**
	 * Enqueue scripts and styles.
	 */
	function libero_scripts() {
		
		$protocol = is_ssl() ? 'https' : 'http';
		
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
		wp_enqueue_style( 'bootstrap-jasny', get_template_directory_uri() . '/css/jasny-bootstrap.min.css' );
		wp_enqueue_style( 'fontawesome', "$protocol://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" );
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
		wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl.theme.css' );
		wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/css/owl.transitions.css' );
		wp_enqueue_style( 'libero-css-rs-select', get_template_directory_uri() . '/js/rst-selectbox/jquery.rs.selectbox.css' );
		wp_enqueue_style( 'libero-style-loading', get_template_directory_uri() . '/css/loading.css' );
		wp_enqueue_style( 'libero-style-main', get_template_directory_uri() . '/css/main.css' );
		wp_enqueue_style( 'libero-style-customs', get_template_directory_uri() . '/css/custom.css' );
		wp_enqueue_style( 'libero-style-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
		wp_enqueue_style( 'libero-style-responsive', get_template_directory_uri() . '/css/responsive.css' );
		
		wp_enqueue_style( 'libero-style', get_stylesheet_uri() );

		wp_enqueue_script( 'jquery' );
		
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'backstretch', get_template_directory_uri() . '/js/jquery.backstretch.js', array('jquery'), '', true );
		wp_enqueue_script( 'googlemap', $protocol. '://maps.googleapis.com/maps/api/js?key=AIzaSyCgGyzOzpWh_mTpdx-UPt92W6GI8hE7P3M', array('jquery'), '', true );
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '', true );
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '', true );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '', true );
		wp_enqueue_script( 'libero-js-rs-selectbox', get_template_directory_uri() . '/js/rst-selectbox/jquery.rs.selectbox.js', array('jquery'), '', true );
		wp_enqueue_script( 'libero-js-custom-selectbox', get_template_directory_uri() . '/js/jquery.customSelect.js', array('jquery'), '', true );
		
		if( !get_theme_mod('disable_loading_content') ) {
			wp_enqueue_script( 'libero-js-load-content', get_template_directory_uri() . '/js/jquery.pageLoading.js', array('jquery'), '', true );
			wp_enqueue_script( 'libero-js-load-content-call', get_template_directory_uri() . '/js/jquery.pageLoading.call.js', array('jquery'), '', true );
		}
		
		if( !get_theme_mod('disable_sidebar_sticky') ) {
			wp_enqueue_script( 'stickit', get_template_directory_uri() . '/js/jquery.stickit.js', array('jquery'), '', true );
			wp_enqueue_script( 'libero-js-sticky-main', get_template_directory_uri() . '/js/sticky.js', array('jquery'), '', true );
		}
		
		if( get_theme_mod('single_enable_next_post') && is_single() ) {
			wp_enqueue_script( 'libero-load-next-post', get_template_directory_uri() . '/js/load-next-post.js', array('jquery'), '', true );
			wp_localize_script( 'libero-load-next-post', 'libero_loadnext', array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'themeurl' => get_template_directory_uri(),
				'homeurl' => home_url("/"),
			));
		}
		
		wp_enqueue_script( 'libero-js-menu', get_template_directory_uri() . '/js/menu.js', array('jquery'), '', true );
		wp_enqueue_script( 'libero-js-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );
		wp_localize_script( 'libero-js-main', 'libero_main_js', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'themeurl' => get_template_directory_uri(),
			'homeurl' => home_url("/"),
		));
		
		wp_enqueue_script( 'libero-js-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
		wp_localize_script( 'libero-js-custom', 'libero_main', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'themeurl' => get_template_directory_uri(),
			'homeurl' => home_url("/"),
		));
		
		wp_enqueue_script( 'libero-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '', true );

		wp_enqueue_script( 'libero-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'libero_scripts' );
	
	
	
	function libero_fonts_url() {
		
		$fonts_url = '';
 
		/* Translators: If there are characters in your language that are not
		* supported by Lora, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$playfair = _x( 'on', 'Playfair Display font: on or off', 'libero' );
		 
		/* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$roboto_condensed = _x( 'on', 'Roboto Condensed font: on or off', 'libero' );
		 
		if ( 'off' !== $playfair || 'off' !== $roboto_condensed ) {
			$font_families = array();
		 
			if ( 'off' !== $playfair ) {
				$font_families[] = 'Playfair Display:400,700italic,700,400italic';
			}
			 
			if ( 'off' !== $roboto_condensed ) {
				$font_families[] = 'Roboto Condensed:400,400italic,700,700italic';
			}
			 
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
			 
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
		 
		return esc_url_raw( $fonts_url );
	}
	
	
    function libero_enqueue_google_fonts() {
		wp_enqueue_style( 'libero-google-fonts', libero_fonts_url(), array(), null );
	}
	add_action( 'wp_enqueue_scripts', 'libero_enqueue_google_fonts' );
	

	function libero_backend_enqueue_scripts_styles() {
		wp_enqueue_style( 'libero_backend_style', esc_url( get_template_directory_uri() ) .'/inc/css/style-backend.css' );
		wp_enqueue_script( 'libero_bankend_script', get_template_directory_uri() . '/js/backend-main.js', array('jquery'), '', true );
	}
	add_action( 'admin_enqueue_scripts', 'libero_backend_enqueue_scripts_styles', 10000 );
	
    
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );
	
	/**
	 * Highlight text.
	 */
    add_action( 'init', 'libero_editor_background_color' );
    function libero_editor_background_color(){
        add_filter( 'mce_buttons_2', 'libero_editor_background_color_button', 1, 2 ); // 2nd row
    }
    function libero_editor_background_color_button( $buttons, $id ){
        if ( 'content' != $id ) return $buttons;
        array_splice( $buttons, 4, 0, 'backcolor' );
        return $buttons;
    }
	
	/**
	 * FrontEnd Add Sidebar.
	 */
	include( get_template_directory() .'/inc/sidebar/class-sidebar-generator.php');
	if( class_exists( 'avia_sidebar' ) ) { 
		new avia_sidebar();
	}
	
	
	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '/inc/extras.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';

	/**
	 * Load Jetpack compatibility file.
	 */
	require get_template_directory() . '/inc/jetpack.php';
	
	
	/**
	 * Plugins.
	 */
	require get_template_directory() . '/inc/plugins/setup-plugins.php';
	
	/**
	 * Mega Menu.
	 */
	require get_template_directory().'/inc/menu-mega/menu.php';
	
	
	/**
	 * Breadcrumbs.
	 */
	require get_template_directory().'/inc/breadcrumbs.php';
	
	
	/**
	 * WooCommerce Functions.
	 */
	if ( class_exists( 'WooCommerce' ) ) {
		require get_template_directory().'/inc/woocommerce.php';
	}
	
	function libero_setup_init() {
		
		/**
		 * rsLib.
		 */
		include(get_template_directory().'/rslib/rslib.php');
		
		/**
		 * Add Customizer.
		 */
		include(get_template_directory().'/inc/add-customizer.php');
		
		
		/**
		 * Add Custom Fields.
		 */
		include(get_template_directory().'/inc/custom-fields/page-post.php');
		include(get_template_directory().'/inc/custom-fields/user.php');
		include(get_template_directory().'/inc/custom-fields/category.php');
		include(get_template_directory().'/inc/custom-fields/post-formats.php');
		
		if ( class_exists( 'WooCommerce' ) ) {
			include(get_template_directory().'/inc/custom-fields/taxonomy-product.php');
		}
		
		
		
		
	}
	add_action('init','libero_setup_init',9);
	
	/**
	 * Functions.
	 */
	include(get_template_directory().'/inc/count-social-network.php');
	include(get_template_directory().'/inc/banner.php');

	/**
	 * Add Widgets.
	 */
	include(get_template_directory().'/inc/widgets/widget-about-us.php');
	include(get_template_directory().'/inc/widgets/widget-random-posts.php');
	include(get_template_directory().'/inc/widgets/widget-slider-posts.php');
	include(get_template_directory().'/inc/widgets/widget-instagram.php');
	include(get_template_directory().'/inc/widgets/widget-social.php');
	include(get_template_directory().'/inc/widgets/widget-social-network.php');
	
	if( class_exists( 'WooCommerce' ) ) {
		include(get_template_directory().'/inc/widgets/widget-slider-product.php');
		include(get_template_directory().'/inc/widgets/widget-filter.php');
		include(get_template_directory().'/inc/widgets/widget-shop-brand.php');
	}
	
	/*
	 * Function Get Widgets
	 */
	function libero_get_widgets() {
		$sidebar_options = array(
			'0' => esc_html__('Select Sidebar','libero')
		);
		foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}
		return $sidebar_options;
	}

	add_action('init','libero_get_widgets', 5);
	
	/*
	 * Function Not Set Menu
	 */
	function libero_not_set_menu( $class="" ) {
		if ( current_user_can('manage_options') ) {
			echo '<ul class="'. esc_attr($class) .'"><li><a href="'. admin_url( 'nav-menus.php' ) .'">'. esc_html__('Set Menu','libero') .'</a></li></ul>';
		}
	}
	
	/**
	 * Reset Query.
	 */
	add_filter( 'request', 'libero_alter_the_query' );
	function libero_alter_the_query( $request ) {
		if( isset($request['product_cat']) && !(is_admin()) ){
			$request['posts_per_page'] = 1;
		}
		return $request;
	}
	
	
	/*
	 * Function Libero Get Attachment 
	 */
	function libero_get_attachment_image_src( $attributes_id, $size ){
		$attributes = wp_get_attachment_image_src( $attributes_id, $size );
		return $attributes[0];
	}
	
	/**
	 * Get Template Part.
	 */
	function libero_get_template_part_theme( $slug, $name="" ) {
		ob_start();
		get_template_part( $slug, $name );
		return ob_get_clean();
	}
	
	/**
	 * Function Echo Class.
	 */
	if ( ! function_exists( 'libero_class' ) ) {
		function libero_class($args) {
			$class = '';
			if( !is_array($args) ) return $args;
			foreach($args as $item) $class .= trim($item) .' ';
			return trim($class);
		}
	}
	
	/*
	 * Function Get Excerpt
	 */
	if ( ! function_exists( 'libero_get_excerpt_by_id' ) ) {
		function libero_get_excerpt_by_id($post, $length = 0, $tags = '<a><em><strong>', $extra = '...') {
			$old_post = $post;
			if(is_int($post)) {
				$post = get_post($post);
			} elseif(!is_object($post)) {
				return false;
			}
			if( is_object($post) ) setup_postdata($post);
			
			if($length == 0) return apply_filters('the_content', $post->post_content);
			
			// $the_excerpt = apply_filters( 'get_the_excerpt', $post->post_excerpt );
			$the_excerpt = ( empty($post->post_excerpt) ) ? $post->post_content : $post->post_excerpt;
			
			$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
			
			$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
			$excerpt_waste = array_pop($the_excerpt);
			$the_excerpt = implode($the_excerpt);
			$the_excerpt = trim($the_excerpt);
			$the_excerpt = str_replace("\n","",$the_excerpt);
			$the_excerpt = str_replace("\r","",$the_excerpt);
			
			if( $the_excerpt != '' )
				$the_excerpt .= $extra;
			
			$post = $old_post;
			
			return wpautop($the_excerpt);
		}
	}
	
	function libero_global_libero_attr() {
		global $libero_attr;
		return $libero_attr;
	}
	
}
endif; // libero_setup
add_action( 'after_setup_theme', 'libero_setup' );
