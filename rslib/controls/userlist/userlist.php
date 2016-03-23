<?php

/// Post List Control - Render Script And HTML ////
include_once(RS_LIB_PATH . "/controls/selectbox/selectbox.php");

class RsUserlist extends RsSelectBox{
	public $default = array(
		'name' 			=> 'userlist',
		'type'			=> 'userlist',
		'query' 		=> array(),
		'width' 		=> null,
		'role'      	=> '',
		'empty_first' 	=> true,
		'multiple'		=> false
	);
	
	public $query_default = array(
		'role'         => '',
		'meta_key'     => '',
		'meta_value'   => '',
		'meta_compare' => '',
		'meta_query'   => array(),
		'include'      => array(),
		'exclude'      => array(),
		'orderby'      => 'login',
		'order'        => 'ASC',
		'offset'       => '',
		'search'       => '',
		'number'       => '',
		'count_total'  => false,
		'fields'       => 'all',
		'who'          => ''
	);
	
	public function RsUserlist(){
		$this->addControl('userlist', 'userlist');
	}
	
	public function parseOptions($options){
		if(!$options = parent::parseOptions($options)){
			return false;
		}
		if(!is_array($options['query'])){
			$options['query'] = array();
		}
		if(empty($options['query']['role'])) {
			$options['query']['role'] = $options['role'];
		}
		$options['query'] = array_merge($this->query_default, $options['query']);
		return $options;
	}

	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		$elements = array();
		if( is_array( $options['query']['role'] ) ) {
			foreach( $options['query']['role'] as $role ){
				$current = $options['query'];
				$current['query']['role'] = $role;
				$elements = array_merge( $elements, get_users( $current['query'] ) );
			}
		}
		else {
			$elements = get_users( $options['query'] );
		}
		$options['items'] = array();
		if($options['empty_first']){
			$options['items'][""] = "";
		}
		if( $elements ){
			foreach($elements as $item){
				$options['items'][$item->ID] = $item->display_name;
			}
		}
		$options['css_class'] .= ' rs-userlist';
		parent::render($options);
	}
}
