<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package libero
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if( ! has_site_icon() ) { ?>
<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon-114x114.png">
<?php } ?>

<?php wp_head(); ?>
</head>

<?php 
	$libero_banner = libero_banner(); 
	$custom_class = '';
	if( $libero_banner['is_show'] ) $custom_class .= 'has_banner';
	$bg_body = get_theme_mod('libero_bg_body') ? maybe_unserialize(get_theme_mod('libero_bg_body')) : false;
	if( is_array($bg_body) && ( $bg_body['background-color'] != '#ffffff' || $bg_body['background-image'] ) ) $custom_class .= ' libero-custom-background';
?>
<body <?php body_class($custom_class); ?>>

<!--- Wrapper -->
<section id="wrapper">

<?php if( !get_theme_mod('disable_header_sticky') ) get_template_part( "template-parts/header/header-sticky" ); ?>

<?php 
	global $post;
	if( function_exists('is_shop') && is_shop() ) {
		$post_id = get_option( 'woocommerce_shop_page_id' );
		$post = get_page($post_id);
	}
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
	get_template_part( "template-parts/header/header-$libero_header_layout" );
?>