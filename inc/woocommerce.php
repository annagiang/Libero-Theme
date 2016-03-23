<?php
/*
 * Hook in on activation
 *
 */

/*
 * single-product.php
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 2 ); 
add_action( 'libero_woocommerce_after_main_content_single_product', 'woocommerce_breadcrumb', 10, 2 ); 

/*
 * content-single-product.php
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 2);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15, 2);

/*
 * archive-product.php
 */
add_action( 'woocommerce_before_shop_loop', 'libero_woocommerce_view_type_shop', 40, 2);

/*
 * content-product.php
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10, 2);
add_action('woocommerce_before_shop_loop_item_title',  'libero_woocommerce_loop_before_thumbnail', 5, 2);

add_action('woocommerce_before_shop_loop_item_title',  'libero_woocommerce_loop_before_thumbnail_button', 14, 2);
add_action('woocommerce_before_shop_loop_item_title',  'libero_woocommerce_quick_view', 15, 2);
add_action('woocommerce_before_shop_loop_item_title',  'woocommerce_template_loop_add_to_cart', 20, 2);
add_action('woocommerce_before_shop_loop_item_title',  'libero_woocommerce_loop_after_thumbnail_button', 21, 2);

add_action('woocommerce_before_shop_loop_item_title',  'libero_woocommerce_loop_after_thumbnail', 40, 2);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 2);
add_action( 'woocommerce_shop_loop_item_title', 'libero_woocommerce_category_product', 5, 2);
add_action('woocommerce_after_shop_loop_item',  'libero_woocommerce_quick_view', 5, 2);
add_action('woocommerce_after_shop_loop_item',  'libero_woocommerce_wishlist', 5, 2);
add_action('woocommerce_shop_loop_item_title',  'libero_woocommerce_before_title', 9, 2);
add_action('woocommerce_shop_loop_item_title',  'libero_woocommerce_after_title', 11, 2);
add_action('woocommerce_after_shop_loop_item_title',  'libero_woocommerce_loop_excerpt_product', 20, 2);
 

/*
* quick-view.php
*/
add_action('woocommerce_quickview_product_summary',  'woocommerce_template_single_title', 5, 2);
add_action('woocommerce_quickview_product_summary',  'woocommerce_template_single_rating', 10, 2);
add_action('woocommerce_quickview_product_summary',  'woocommerce_template_single_price', 10, 2);
add_action('woocommerce_quickview_product_summary',  'woocommerce_template_single_add_to_cart', 30, 2);
add_action('woocommerce_quickview_product_summary',  'woocommerce_template_single_meta', 40, 2);
 
 
/*
* variable.php
*/
add_action('woocommerce_single_variation',  'libero_woocommerce_wishlist', 30, 2);
 
/*
 * Hook in on activation
 *
 */
add_action( 'init', 'libero_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function libero_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '270',	// px
		'height'	=> '370',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '540',	// px
		'height'	=> '740',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '270',	// px
		'height'	=> '370',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/*
 * Add Custom Field Attribute
 *
 */
function libero_woo_customfield() {
	include(get_template_directory().'/inc/custom-fields/attribute.php');
}
add_action('init','libero_woo_customfield', 15);

/*
 * Enquery Cart Variation
 *
 */
function libero_woocommerce_scripts() {
	wp_deregister_script('wc-add-to-cart-variation');
	wp_enqueue_script( 'wc-add-to-cart-variation', get_template_directory_uri() .'/js/add-to-cart-variation.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'libero_woocommerce_scripts' );


/*
 * Custom Woo BreadCrumnbs
 *
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'libero_woocommerce_breadcrumbs' );
function libero_woocommerce_breadcrumbs() {
    return array(
		'delimiter'   => '',
		'wrap_before' => '<ul class="breadcrumb">',
		'wrap_after'  => '</ul>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => _x( 'Home', 'breadcrumb', 'libero' ),
	);
}


/*
 * Custom wc_dropdown_variation_attribute_options
 *
 */
function libero_wc_dropdown_variation_attribute_options( $args = array() ) {
	$args = wp_parse_args( apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ), array(
		'options'          => false,
		'attribute'        => false,
		'product'          => false,
		'selected' 	       => false,
		'name'             => '',
		'id'               => '',
		'class'            => '',
		'show_option_none' => esc_html__( 'Choose an option', 'libero' )
	) );
	$options   = $args['options'];
	$product   = $args['product'];
	$attribute = $args['attribute'];
	$name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
	$id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
	$class     = $args['class'];
	if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[ $attribute ];
	}
	echo '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';
	if ( $args['show_option_none'] ) {
		echo '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
	}
	if ( ! empty( $options ) ) {
		if ( $product && taxonomy_exists( $attribute ) ) {
			// Get terms if this is a taxonomy - ordered. We need the names too.
			$terms = wc_get_product_terms( $product->id, $attribute, array( 'fields' => 'all' ) );
			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $options ) ) {
					
					$data_color = '';
					$swatch_type = rs::getField('rst_swatch','term_'.$term->term_id);
					$swatch_color = rs::getField('rst_swatch_color','term_'.$term->term_id);
					if( $swatch_type == 'color' && isset($swatch_color) && !empty($swatch_color) ) $data_color = 'data-color="'. $swatch_color .'"';
					
					echo '<option '. $data_color .' value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
				}
			}
		} else {
			foreach ( $options as $option ) {
				// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
				$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
				echo '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
			}
		}
	}
	echo '</select>';
}

function libero_woocommerce_before_title() {
	echo '<a href="'. get_permalink() .'">';
}
function libero_woocommerce_after_title() {
	echo '</a>';
}
function libero_woocommerce_loop_before_thumbnail() {
	echo '<div class="libero-product-thumbnail">';
}
function libero_woocommerce_loop_after_thumbnail() {
	echo '</div>';
}
function libero_woocommerce_loop_before_thumbnail_button() {
	echo '<div class="libero-addtocart">';
}
function libero_woocommerce_loop_after_thumbnail_button() {
	echo '</div>';
}
function libero_woocommerce_loop_excerpt_product() {
	global $post;
	echo '<div class="libero-excerpt">'. libero_get_excerpt_by_id($post,20) .'</div>';
}
function libero_woocommerce_category_product() {
	global $product, $post;
	$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
	echo ($product->get_categories( ', ', '<span class="posted_in">', '</span>' ));
}
function libero_woocommerce_quick_view() {
	global $product;
	echo '<a class="quick-view-btn button round" data-product-id="'. $product->id .'" href="#">'. esc_html__('Quick view','libero') .'</a>';
}
function libero_woocommerce_wishlist() {
	if( class_exists('YITH_Panel') ) {
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
}

/* Custom Tabs */
function libero_woocommerce_custom_product_tabs( $tabs = array() ) {
	$tabs = array();
	global $product, $post;

	// Description tab - shows product content
	if ( $post->post_content ) {
		$tabs['description'] = array(
			'title'    => esc_html__( 'Details', 'libero' ),
			'priority' => 10,
			'callback' => 'woocommerce_product_description_tab'
		);
	}

	// Additional information tab - shows attributes
	if ( $product && ( $product->has_attributes() || ( $product->enable_dimensions_display() && ( $product->has_dimensions() || $product->has_weight() ) ) ) ) {
		$tabs['additional_information'] = array(
			'title'    => esc_html__( 'Information', 'libero' ),
			'priority' => 20,
			'callback' => 'woocommerce_product_additional_information_tab'
		);
	}
	
	// Reviews tab - shows comments
	if ( comments_open() ) {
		$tabs['reviews'] = array(
			'title'    => sprintf( esc_html__( 'Reviews (%d)', 'libero' ), $product->get_review_count() ),
			'priority' => 50,
			'callback' => 'comments_template'
		);
	}
	
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'libero_woocommerce_custom_product_tabs' );

function libero_woocommerce_view_type_shop() {
	global $woocommerce_loop;
	get_template_part('woocommerce/button-product-layout');
}

/* Quick View */
add_action('wp_ajax_quickview_product', 'libero_quickview_action');
add_action('wp_ajax_nopriv_quickview_product', 'libero_quickview_action');

function libero_quickview_action() {
	global $quickview;
	$quickview = array();
	$quickview['p_id'] = $_POST['p_id'];
	ob_start();
	get_template_part('woocommerce/quickview');
	echo ob_get_clean();
	exit;
}

/* Ajax Mini Cart */
add_filter('add_to_cart_fragments', 'libero_woocommerce_header_add_to_cart_fragment');
function libero_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	get_template_part('template-parts/header/cart-mini');
	$fragments['div#cart-mini'] = ob_get_clean();
	return $fragments;
}

/* Custom html price */
add_filter( 'woocommerce_get_price_html', 'libero_custom_price_html', 100, 2 );
function libero_custom_price_html( $price, $product ){

	$decimal_sep = get_option('woocommerce_price_decimal_sep');
	$num = get_option('woocommerce_price_num_decimals');
	
	$pos = strpos($price, $decimal_sep) + $num + 1;
	$price = substr_replace($price, '</em>', $pos, 0); 
	
	$pos = strrpos($price, $decimal_sep) + $num + 1; 
	$price = substr_replace($price, '</em>', $pos, 0);
	
	$price = str_replace($decimal_sep, $decimal_sep . '<em>', $price);

	return force_balance_tags($price);
}