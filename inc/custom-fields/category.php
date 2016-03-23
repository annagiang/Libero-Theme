<?php

$widgets = libero_get_widgets();

// Banner Page
rs::metabox(array(
	'name' => 'banner_category_setting',
	'title' => 'Banner Setting',
	'rules' => array(
		'taxonomy' => 'category'
	),
	'controls' => array(
		array(
			'label' 		=> 'Banner Setting',
			'type' 			=> 'radio',
			'display' 		=> 'inline',
			'name' 			=> 'cat_banner_layout',
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
			'name' 			=> 'cat_banner_background',
			'conditional_logic' => array('cat_banner_layout' => '1')
		),
		array(
			'label' 		=> 'Banner Title',
			'type' 			=> 'text',
			'name' 			=> 'cat_banner_title',
			'conditional_logic' => array('cat_banner_layout' => '1')
		),
		array(
			'label' 		=> 'Banner Description',
			'type' 			=> 'text',
			'name' 			=> 'cat_banner_description',
			'conditional_logic' => array('cat_banner_layout' => '1')
		)
	)
));


// Page Setting
rs::metabox(array(
	'name' => 'category_setting',
	'title' => 'Category Setting',
	'rules' => array(
		'taxonomy' => 'category'
	),
	'controls' => array(
		array(
			'label' => 'Column Style',
			'type' => 'radio',
			'display' => 'inline',
			'name' => 'rst_cat_layout',
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
			'name' => 'rst_cat_sidebar',
			'label'=> 'Select Sidebar',
			'type' => 'select',
			'conditional_logic' => array('rst_cat_layout' => '2|3'),
			'default_value'	=> 'sidebar-1',
			'items' => $widgets
		),
		array(
			'label' 		=> 'Template Setting',
			'type' 			=> 'radio',
			'display' 		=> 'inline',
			'name' 			=> 'libero_cat_template',
			'default_value' => '0',
			'items'        	=> array(
				array(
					'value' => 0,
					'text' => 'Default',
					'image' => get_template_directory_uri() . '/inc/images/default.jpg'
				),
				array(
					'value' => 'large',
					'text' => 'Classic',
					'image' => get_template_directory_uri() . '/inc/images/large.jpg'
				),
				array(
					'value' => 'box',
					'text' => 'Grid',
					'image' => get_template_directory_uri() . '/inc/images/Box.jpg'
				),
				array(
					'value' => 'medium',
					'text' => 'List',
					'image' => get_template_directory_uri() . '/inc/images/medium.jpg'
				)
			)
		),
		array (
			'name' 			=> 'libero_cat_columns',
			'type' 			=> 'select',
			'label' 		=> esc_html__('Columns', 'libero'),
			'items'			=> array(
				"4" 	=> "4 Columns",
				"3" 	=> "3 Columns",
				"2" 	=> "2 Columns"
			),
			'default_value'	=> 2,
			'conditional_logic' => array('libero_cat_template:not:i' => '0', 'libero_cat_template' => 'box')
		),
		array(
			'label' 		=> 'Posts per page',
			'type' 			=> 'text',
			'name'			=> 'libero_cat_numberpost',
			'default_value'	=> '10',
			'conditional_logic' => array('libero_cat_template:not:i' => '0'),
		),
		array(
			'label' 		=> 'Excerpt Length',
			'type' 			=> 'text',
			'name'			=> 'libero_cat_excerpt_length',
			'default_value'	=> '30',
			'conditional_logic' => array('libero_cat_template:not:i' => '0'),
		),
		array(
			'label' 		=> 'Pagenavi',
			'type' 			=> 'select',
			'name' 			=> 'libero_cat_pagenavi',
			'default_value'	=> 'number',
			'items'        	=> array(
				'number' => 'Number',
				'load_more' => 'Load More',
				'next_prev' => 'Next/Prev'
			),
			'conditional_logic' => array('libero_cat_template:not:i' => '0'),
		),
		array(
			'label' 		=> 'Number Posts Loadmore',
			'type' 			=> 'text',
			'name'			=> 'libero_cat_number_loadmore',
			'default_value'	=> '4',
			'conditional_logic' => array('libero_cat_template:not:i' => '0', 'libero_cat_pagenavi' => 'load_more'),
		)
	)
));