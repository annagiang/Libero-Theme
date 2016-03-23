<?php

$object = wc_get_attribute_taxonomies();
if( is_array($object) && sizeof($object) ) {
	foreach( $object as $at ) {
		
		rs::metabox(array(
			'name' => 'product_attribute_woo_setting',
			'title' => 'Attribute Swatch Type',
			'rules' => array(
				'taxonomy' => 'pa_'.$at->attribute_name,
			),
			'controls' => array(
				array(
					'label' 		=> 'Swatch Type',
					'type' 			=> 'select',
					'name' 			=> 'rst_swatch',
					'default_value'	=> '0',
					'items'			=> array(
						'0' => 'Text',
						'color' => 'Color'
					)
				),
				array(
					'label' 		=> 'Color',
					'type' 			=> 'color',
					'name' 			=> 'rst_swatch_color',
					'conditional_logic' => array(
						'rst_swatch' => 'color'
					),
				),
			)
		));
		
	}
}