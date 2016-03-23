<?php

$widgets = libero_get_widgets();

// Post Setting
rs::metabox(array(
	'name' => 'post_setting_layout',
	'title' => 'Post Layout',
	'rules' => array(
		'post_type' => 'post|product'
	),
	'controls' => array(
		array(
			'label' => 'Post Column Style',
			'type' => 'radio',
			'display' => 'inline',
			'name' => 'template',
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
			'name' => 'rst_single_sidebar',
			'label'=> 'Select Sidebar',
			'type' => 'select',
			'conditional_logic' => array('template' => '2|3'),
			'items' => $widgets
		)
	)
));


// Post Setting
rs::metabox(array(
	'name' => 'post_setting',
	'title' => 'Post Setting',
	'rules' => array(
		'post_type' => 'post'
	),
	'controls' => array(
		array(
			'label' => 'Single Template',
			'type' => 'radio',
			'display' => 'inline',
			'name' => 'single_template',
			'items' => array(
				array(
					'value' => 0,
					'text' => 'Default ( Customize )',
					'image' => get_template_directory_uri() . '/inc/images/single-template-default.jpg'
				),
				array(
					'value' => 1,
					'text' => 'Style Normal',
					'image' => get_template_directory_uri() . '/inc/images/single-teamplate-1.jpg'
				),
				array(
					'value' => 2,
					'text' => 'Style Magazine',
					'image' => get_template_directory_uri() . '/inc/images/single-teamplate-2.jpg'
				)
			),
			'default_value' => '0'
		),
		array(
			'label' 		=> 'Disable First Text Description',
			'type' 			=> 'switch',
			'name' 			=> 'single_first_text',
			'style' 		=> 'default'
		),
	)
));


// Page Setting
rs::metabox(array(	
	'name' => 'page_setting',	
	'title' => 'Page Setting',	
	'rules' => array(		
		'post_type' => 'page'	
	),	
	'controls' => array(		
		array(			
			'label' 		=> 'Hidden Breadcrumb',			
			'type' 			=> 'switch',			
			'name' 			=> 'page_hidden_breadcrumb',
			'style' 		=> 'default'		
		),
		array(
			'label' 		=> 'Hidden Title',
			'type' 			=> 'switch',
			'name' 			=> 'page_hidden_title',
			'style' 		=> 'default'
		),
		array(
			'label' => 'Column Style',
			'type' => 'radio',
			'display' => 'inline',
			'name' => 'rst_page_layout',
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
			'name' => 'rst_page_width',
			'label'=> 'Select Content Width',
			'type' => 'select',
			'conditional_logic' => array('rst_page_layout' => '1|2|3'),
			'default_value'	=> '1',
			'items' => array(
				'1' => 'Container',
				'0' => 'Full Width',
				'2' => '970px',
			)
		),
		array(
			'name' => 'rst_page_sidebar',
			'label'=> 'Select Sidebar',
			'type' => 'select',
			'conditional_logic' => array('rst_page_layout' => '2|3'),
			'default_value'	=> 'sidebar-1',
			'items' => $widgets
		)	)));
// Banner Page
rs::metabox(array(
	'name' => 'banner_page_setting',
	'title' => 'Banner Setting',
	'rules' => array(
		'post_type' => 'page',
	),
	'controls' => array(
		array(			
			'label' 		=> 'Banner Setting',			
			'type' 			=> 'radio',			
			'display' 		=> 'inline',			
			'name' 			=> 'page_banner_layout',			
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
			'name' 			=> 'page_banner_background',
			'conditional_logic' => array('page_banner_layout' => '1')
		),
		array(
			'label' 		=> 'Banner Title',
			'type' 			=> 'text',
			'name' 			=> 'page_banner_title',
			'conditional_logic' => array('page_banner_layout' => '1')
		),
		array(
			'label' 		=> 'Banner Description',
			'type' 			=> 'text',
			'name' 			=> 'page_banner_description',
			'conditional_logic' => array('page_banner_layout' => '1')
		)
	)
));


// Header Setting
rs::metabox(array(
	'name' => 'header_page_setting',
	'title' => 'Header Setting',
	'context' => 'side',
	'rules' => array(
		'post_type' => 'page|post'
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