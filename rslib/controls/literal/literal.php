<?php 
class RsLiteral extends RsControl{
	public $default = array(
		'format' => '<div id="%1$s" class="%2$s">%3$s</div>',
		'name_prefix' => 'ltr-',
		'text' => ''
	);
	
	public function RsLiteral(){
		$this->addControl('literal', 'literal');
	}
	
	public function render($options = array()){
		$this->default['name'] = uniqid();
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		$id = $this->addConditionalLogic($options, true);
		
		echo sprintf($options['format'], $id, $options['css_class'], $options['text']);
	}
}