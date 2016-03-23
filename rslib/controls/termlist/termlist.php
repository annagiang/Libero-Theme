<?php

/// Post List Control - Render Script And HTML ////
include_once(RS_LIB_PATH . "/controls/selectbox/selectbox.php");

class RsTermlist extends RsSelectBox{
	public $default = array(
		'name' 		=> 'termlist',
		'type'		=> 'termlist',
		'query' 	=> array(),
		'taxonomy' => 'category',
		'width' 	=> null,
		'empty_first' 	=> true,
		'multiple'	=> false
	);
	
	public $query_default = array(
		'orderby'           => 'term_group', 
		'order'             => 'ASC',
		'hide_empty'        => false, 
		'exclude'           => array(), 
		'exclude_tree'      => array(), 
		'include'           => array(),
		'number'            => '', 
		'fields'            => 'all', 
		'slug'              => '', 
		'parent'            => '',
		'hierarchical'      => true, 
		'child_of'          => 0, 
		'get'               => '', 
		'name__like'        => '',
		'description__like' => '',
		'pad_counts'        => false, 
		'offset'            => '', 
		'search'            => '', 
		'cache_domain'      => 'core'
	);
	
	public function RsTermlist(){
		$this->addControl('termlist', 'termlist');
	}
	
	public function parseOptions($options){
		if(!$options = parent::parseOptions($options)){
			return false;
		}
		if(!is_array($options['query'])){
			$options['query'] = array();
		}

		$options['query'] = array_merge($this->query_default, $options['query']);
		return $options;
	}
		
	public function render($options = array()){
		if(!$options =$this->parseOptions($options)){
			return $this->renderError();
		}
		$elements = get_terms( $options['taxonomy'], $options['query'] );
		
		$options['items'] = array();
		
		if($options['empty_first']){
			$options['items'][""] = "";
		}
		
		
		if($elements){
			$items = array();
			foreach($elements as $element){
				$items[$element->term_id] = $element;
			}
			
			foreach($items as $item){
				$name = $item->name;
				if($item->parent > 0){
					$parent = $items[$item->parent];
					$name = '-- ' . $name;
					
					while($parent->parent > 0){
						$parent = $items[$parent->parent];
						$name = '--' . $name;					
					}
				}
				$options['items'][$item->term_id] = $name;
			}

		}
		$options['css_class'] .= ' rs-postlist';
		parent::render($options);
	}
}
