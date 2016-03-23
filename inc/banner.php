<?php
function libero_get_options_banner_default($name,$post_id) {
	$args = array();
	$background = get_theme_mod('banner_background');
	if( isset($background) ) {
		$args['background'] = wp_get_attachment_url($background);
	}
	$args['title'] = get_theme_mod('banner_title') ? get_theme_mod('banner_title') : 'Welcome to Libero';
	$args['description'] = get_theme_mod('banner_description');
	$args['is_show'] = true;
	
	if( empty( $args['background'] ) ) {
		$args['background'] = get_template_directory_uri() .'/img/banner_bg.jpg';
	}
	if( is_page() ) {
		$args['title'] = rs::getField( $name . '_banner_layout',$post_id ) && rs::getField( $name . '_banner_title',$post_id ) ? rs::getField( $name . '_banner_title',$post_id ) : get_the_title();
	}
	if( is_archive() ) {
		$args['title'] = rs::getField( $name . '_banner_layout',$post_id ) && rs::getField( $name . '_banner_title',$post_id ) ? rs::getField( $name . '_banner_title',$post_id ) : get_the_archive_title();
		$args['description'] = rs::getField( $name . '_banner_layout',$post_id ) && rs::getField( $name . '_banner_description',$post_id ) ? rs::getField( $name . '_banner_description',$post_id ) : get_the_archive_description();
	}
	if( is_category() ) {
		$args['title'] = rs::getField( $name . '_banner_layout',$post_id ) && rs::getField( $name . '_banner_title',$post_id ) ? rs::getField( $name . '_banner_title',$post_id ) : single_cat_title( '', false );
	}
	if( is_search() ) {
		$args['title'] = esc_html__('Search Page','libero');
		$args['description'] = esc_html__( 'Search Results for: ', 'libero' ). get_search_query();
	}
	return $args;
}
function libero_get_options_banner($name,$post_id) {
	$args = array();
	$default = libero_get_options_banner_default($name,$post_id);
	
	if( rs::getField( $name . '_banner_layout', $post_id ) == 2 ) {
		$default['is_show'] = false ;
	}
	
	if( rs::getField( $name . '_banner_layout', $post_id ) == 1 ) {
		$args['background'] = rs::getField( $name . '_banner_background',$post_id,'image','url' ) ? rs::getField( $name . '_banner_background',$post_id,'image','url' ) : $default['background'];
		$args['title'] = rs::getField( $name . '_banner_title', $post_id ) ? rs::getField( $name . '_banner_title', $post_id ) : $default['title'];
		$args['description'] = rs::getField( $name . '_banner_description', $post_id ) ? rs::getField( $name . '_banner_description', $post_id ) : $default['description'];
		$args['is_show'] = true ;
		return $args;
	}
	return $default;
}
function libero_banner() {
	$name = '';
	$post_id = 1;
	switch ( true ) {
		case is_singular('page'):
			$name = 'page';
			$post_id = get_the_ID();
			break;
		case is_category():
			$name = 'cat';
			$post_id = 'term_'. get_query_var('cat');
			break;
		case is_tax('product_cat'):
			global $wp_query;
			$tag = $wp_query->get_queried_object();
			$term_id = $tag->term_id;

			$name = 'shop';
			$post_id = 'term_'. $term_id;
			break;
		case function_exists('is_shop') && is_shop() :
			$post_id = get_option( 'woocommerce_shop_page_id' );
			$name = 'page';
			break;
	}
	
	return libero_get_options_banner( $name, $post_id );
}