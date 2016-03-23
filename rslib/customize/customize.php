<?php

//Making Custom Control
$allfiles = glob(RS_LIB_PATH . "/customize/controls/*", GLOB_ONLYDIR);
foreach($allfiles as $dir){
	$basename = basename($dir);
	if(is_dir($dir) && file_exists(RS_LIB_PATH . "/customize/controls/$basename/$basename.php")){
		include_once(RS_LIB_PATH . "/customize/controls/$basename/$basename.php");
	}
}

//Render Panel


foreach( rs::$customize_panel as $panel ) {
	
	$wp_customize->add_panel( $panel['name'], array(
		'priority'       => isset($panel['priority']) ? $panel['priority'] : 10,
		'title'          => $panel['title'],
		'description'    => isset($panel['description']) ? $panel['description'] : '',
	) );
}


//Render Tab
foreach( rs::$customize as $tab ) {
	
	$args = array(
		'title'      => $tab['title'],
		'description'=> isset($tab['description']) ? $tab['description'] : '',
		'priority'   => $tab['priority'],
	);
	if( isset($tab['panel']) ) {
		$args['panel'] = $tab['panel'];
	}
	
	$wp_customize->add_section( $tab['name'] , $args );
	
	if( $tab['controls'] ) {
		foreach( $tab['controls'] as $key=>$control ) {
			
			
			
			$wp_customize->add_setting( $control['name'] , array(
				'default' => isset($control['default_value']) ? $control['default_value'] : '',
				'sanitize_callback' => 'rst_sanitizeLayout'
			) );
			
			$args_type = array();
			
			$args_type['text'] = 'WP_Customize_Control';
			$args_type['checkbox'] = 'WP_Customize_Control';
			$args_type['radio'] = 'WP_Customize_Control';
			$args_type['select'] = 'WP_Customize_Control';
			$args_type['dropdown-pages'] = 'WP_Customize_Control';
			$args_type['textarea'] = 'WP_Customize_Control';
			$args_type['color'] = 'WP_Customize_Color_Control';
			$args_type['upload'] = 'WP_Customize_Upload_Control';
			$args_type['image'] = 'WP_Customize_Image_Control';
			$args_type['radio-image'] = 'WP_Customize_Radio_Image_Control';
			$args_type['gallery'] = 'WP_Customize_RsGallery';
			$args_type['font'] = 'WP_Customize_RsGoogleFont';
			$args_type['rsbackground'] = 'WP_Customize_RSBackground';
			$args_type['term-list'] = 'WP_Customize_Term_List_Control';
			$args_type['repeater'] = 'WP_Customize_RsRepeater';
			
			$label = array(
				'label'        	=> isset($control['label']) ? $control['label'] : '',
				'section'    	=> $tab['name'],
				'settings'   	=> $control['name'],
				'description'   => isset($control['description']) ? $control['description'] : '',
				'priority'	 	=> $key,
			);
			
			$label = array_merge( $label, $control );
			
			$label['params'] = array();
			$label['params'] = array_merge( $label['params'], $control );
			
			if($control['type'] == 'image'){
				$label['attachment'] = 'full';
			}
			
			if($control['type'] == 'font'){
				$label['controls_show'] = $control['default_value'];
			}
			if(
				$control['type'] == 'text' || 
				$control['type'] == 'checkbox' || 
				$control['type'] == 'radio' || 
				$control['type'] == 'select' ||
				$control['type'] == 'dropdown-pages' ||
				$control['type'] == 'textarea'
			) {
				$label['type'] = $control['type'];
			}
			
			if( isset( $control['items'] ) ) {
				$label['choices'] = $control['items'];
			}
			
			
			$wp_customize->add_control(
				new $args_type[$control['type']](
					$wp_customize, 'settings-'.$control['name'], $label
				)
			);
			
		}
	}
}

function rst_sanitizeLayout($value) {
	return $value;
}

function rst_customize_register( $wp_customize )
{
	wp_enqueue_script('rst-upload', RS_LIB_URL . '/controls/upload-media/wpupload.min.js');
	wp_enqueue_script('rst-upload-init', RS_LIB_URL . '/controls/upload-media/upload.min.js');
	wp_enqueue_script('jquery-ui-sortable');
	
	wp_enqueue_style('rst-upload', RS_LIB_URL . '/controls/upload-media/upload.min.css');
	wp_enqueue_style('rst-gallery', RS_LIB_URL . '/controls/gallery/gallery.min.css');
	
	wp_enqueue_script('rst-gallery', RS_LIB_URL . '/controls/gallery/gallery.min.js');

}
add_action( 'customize_controls_enqueue_scripts', 'rst_customize_register' );
?>