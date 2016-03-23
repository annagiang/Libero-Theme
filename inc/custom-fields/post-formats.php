<?php

// Video Setting
rs::metabox(array(
	'name' => 'libero_video_setting',
	'title' => 'Video Setting',
	'rules' => array(
		'post_format' => 'video',
	),
	'controls' => array(
		array(
			'name' => 'libero_video_type',
			'label'=> 'Video Type',
			'type' => 'select',
			'items' => array('youtube' => 'Youtube', 'vimeo' => 'Vimeo' )
		),
		array(
			'name' => 'libero_video_embed',
			'label'=> 'Embed Code',
			'derscription' => 'Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br>This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br><strong>Of course you can also insert your Audio Embedd Code!</strong><br><br><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image..',
			'type' => 'textarea'
		)
	)
));

// Gallery Setting
rs::metabox(array(
	'name' => 'libero_gallery_setting',
	'title' => 'Gallery Setting',
	'rules' => array(
		'post_format' => 'gallery',
	),
	'controls' => array(
		array(
			'name' => 'libero_gallery',
			'type' => 'gallery',
			'label'=> 'Blog Post Images ',
			'derscription' => 'Upload up to 20 images for a slideshow - or only one to display a single image. <br><br><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.'
		)
	)
));

// Audio Setting
rs::metabox(array(
	'name' => 'libero_audio_setting',
	'title' => 'Audio Setting',
	'rules' => array(
		'post_format' => 'audio',
	),
	'controls' => array(
		array(
			'name' => 'libero_audio_iframe',
			'type' => 'textarea',
			'label'=> 'Audio Iframe',
			'derscription' => esc_html('Enter your iframe audio. (e.g: <iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/193781466&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>)')
		)
	)
));

// Link Setting
rs::metabox(array(
	'name' => 'libero_link_setting',
	'title' => 'Link Setting',
	'rules' => array(
		'post_format' => 'link',
	),
	'controls' => array(
		array(
			'name' => 'libero_link_url',
			'type' => 'text',
			'label'=> 'Link Url',
			'derscription' => 'Enter your URL here.'
		)
	)
));

// Quote Setting
rs::metabox(array(
	'name' => 'libero_quote_setting',
	'title' => 'Quote Setting',
	'rules' => array(
		'post_format' => 'quote',
	),
	'controls' => array(
		array(
			'name' => 'libero_quote',
			'type' => 'textarea',
			'label'=> 'Quote',
			'derscription' => 'Enter Quote here.'
		),
		array(
			'name' => 'libero_quotesource',
			'type' => 'text',
			'label'=> 'Quote Author/Source Link',
			'derscription' => 'Enter the Quote Source or Quote Author.'
		)
	)
));