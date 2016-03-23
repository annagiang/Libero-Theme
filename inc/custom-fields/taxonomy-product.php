<?php

$widgets = libero_get_widgets();


// Header Setting
rs::metabox(array(
	'name' => 'header_shop_setting',
	'title' => 'Header Setting',
	'rules' => array(
		'taxonomy' => 'product_cat'
	),
	'controls' => array(
		array(
			'label' 		=> 'Header Layout',
			'type' 			=> 'select',
			'name' 			=> 'header_layout',
			'default_value'	=> '0',
			'items'			=> array(
				'0' => 'Default',
				'1' => 'Header 1',
				'2' => 'Header 2',
				'3' => 'Header 3',
				'4' => 'Header 4',
				'5' => 'Header 5',
				'6' => 'Header 6',
			)
		),
	)
));


// Banner Page
rs::metabox(array(
	'name' => 'banner_product_cat_setting',
	'title' => 'Banner Setting',
	'rules' => array(
		'taxonomy' => 'product_cat'
	),
	'controls' => array(
		array(
			'label' 		=> 'Banner Setting',
			'type' 			=> 'radio',
			'display' 		=> 'inline',
			'name' 			=> 'shop_banner_layout',
			'default_value'	=> '0',
			'items'			=> array(
				array(
					'value' => 0,
					'text' => 'Default',
					'image' => get_template_directory_uri() . '/inc/images/default.jpg'
				),
				array(
					'value' => 1,
					'text' => 'Custom',
					'image' => get_template_directory_uri() . '/inc/images/custom.jpg'
				),
				array(
					'value' => 2,
					'text' => 'Hidden',
					'image' => get_template_directory_uri() . '/inc/images/hidden.jpg'
				)
			)
		),
		array(
			'label' 		=> 'Background Image',
			'type' 			=> 'image',
			'name' 			=> 'shop_banner_background',
			'conditional_logic' => array('shop_banner_layout' => '1')
		),
		array(
			'label' 		=> 'Banner Title',
			'type' 			=> 'text',
			'name' 			=> 'shop_banner_title',
			'conditional_logic' => array('shop_banner_layout' => '1')
		),
		array(
			'label' 		=> 'Banner Description',
			'type' 			=> 'text',
			'name' 			=> 'shop_banner_description',
			'conditional_logic' => array('shop_banner_layout' => '1')
		)
	)
));


// Category Setting
rs::metabox(array(
	'name' => 'product_cat_setting',
	'title' => 'Category Setting',
	'rules' => array(
		'taxonomy' => 'product_cat'
	),
	'controls' => array(
		array(
			'label' => 'Column Style',
			'type' => 'radio',
			'display' => 'inline',
			'name' => 'rst_shop_layout',
			'description'	=> 'Choose your page column style to show on your page.',
			'items' => array(
				array(
					'value' => 0,
					'text' => 'Default',
					'image' => get_template_directory_uri() . '/inc/images/default.jpg'
				),
				array(
					'value' => 1,
					'text' => 'Full Width',
					'image' => get_template_directory_uri() . '/inc/images/fullwidth.jpg'
				),
				array(
					'value' => 2,
					'text' => 'Sidebar Left',
					'image' => get_template_directory_uri() . '/inc/images/sidebar_left.jpg'
				),
				array(
					'value' => 3,
					'text' => 'Sidebar Right',
					'image' => get_template_directory_uri() . '/inc/images/sidebar_right.jpg'
				)
			),
			'default_value' => '0'
		),
		array(
			'name' => 'rst_shop_sidebar',
			'label'=> 'Select Sidebar',
			'type' => 'select',
			'conditional_logic' => array('rst_shop_layout' => '2|3'),
			'default_value'	=> 'sidebar-1',
			'items' => $widgets
		),
		array (
			'name' 			=> 'libero_shop_product_style',
			'type' 			=> 'select',
			'label' 		=> esc_html__('Show Style Default', 'libero'),
			'items'			=> array(
				"1" 	=> "Grid",
				"2" 	=> "List"
			),
			'default_value'	=> 1,
			'conditional_logic' => array('rst_shop_layout:not:i' => '0'),
		),
		array (
			'name' 			=> 'libero_shop_columns',
			'type' 			=> 'select',
			'label' 		=> esc_html__('Columns', 'libero'),
			'items'			=> array(
				"4" 	=> "4 Columns",
				"3" 	=> "3 Columns",
				"2" 	=> "2 Columns"
			),
			'default_value'	=> 3
		),
		array(
			'label' 		=> 'Posts per page',
			'type' 			=> 'text',
			'name'			=> 'libero_shop_numberpost',
			'default_value'	=> '12',
			'conditional_logic' => array('rst_shop_layout:not:i' => '0'),
		),
		array(
			'label' 		=> 'Top Image',
			'type' 			=> 'image',
			'name'			=> 'libero_shop_image'
		)
	)
));

// Image Top Setting
rs::metabox(array(
	'name' => 'product_cat_image_top_setting',
	'title' => 'Image Top',
	'rules' => array(
		'page_id' => get_option( 'woocommerce_shop_page_id' )
	),
	'controls' => array(
		array(
			'label' 		=> 'Top Image',
			'type' 			=> 'image',
			'name'			=> 'libero_shop_image'
		)
	)
));