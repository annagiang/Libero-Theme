<?php

// User Setting
rs::metabox(array(
	'name' => 'rst_user_setting',
	'title' => 'Social Network',
	'rules' => array(
		'user_role' => 'all',
	),
	'controls' => array(
		array(
			'label' 		=> 'Facebook',
			'type' 			=> 'text',
			'name' 			=> 'user_facebook'
		),
		array(
			'label' 		=> 'Google plus',
			'type' 			=> 'text',
			'name' 			=> 'user_google'
		),
		array(
			'label' 		=> 'Twitter',
			'type' 			=> 'text',
			'name' 			=> 'user_twitter'
		),
		array(
			'label' 		=> 'Tumblr',
			'type' 			=> 'text',
			'name' 			=> 'user_tumblr'
		),
		array(
			'label' 		=> 'Instagram',
			'type' 			=> 'text',
			'name' 			=> 'user_instagram'
		),
		array(
			'label' 		=> 'Youtube',
			'type' 			=> 'text',
			'name' 			=> 'user_youtube'
		),
		array(
			'label' 		=> 'Linkedin',
			'type' 			=> 'text',
			'name' 			=> 'user_linkedin'
		),
		array(
			'label' 		=> 'Flickr',
			'type' 			=> 'text',
			'name' 			=> 'user_flickr'
		),
		array(
			'label' 		=> 'Vimeo',
			'type' 			=> 'text',
			'name' 			=> 'user_vimeo'
		),
		array(
			'label' 		=> 'Pinterest',
			'type' 			=> 'text',
			'name' 			=> 'user_pinterest'
		),
		array(
			'label' 		=> 'Dribbble',
			'type' 			=> 'text',
			'name' 			=> 'user_dribbble'
		),
		array(
			'label' 		=> 'Digg',
			'type' 			=> 'text',
			'name' 			=> 'user_digg'
		),
		array(
			'label' 		=> 'Skype',
			'type' 			=> 'text',
			'name' 			=> 'user_skype'
		),
		array(
			'label' 		=> 'Deviantart',
			'type' 			=> 'text',
			'name' 			=> 'user_deviantart'
		),
		array(
			'label' 		=> 'Yahoo',
			'type' 			=> 'text',
			'name' 			=> 'user_yahoo'
		),
		array(
			'label' 		=> 'Reddit',
			'type' 			=> 'text',
			'name' 			=> 'social_reddit'
		)
	)
));