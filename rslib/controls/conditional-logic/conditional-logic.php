<?php 
class RsConditionalLogic extends RsControl{
	public $default = array(
		'for' => null,
		'conditional_logic' => null
	);
	
	public function RsConditionalLogic(){
		$this->addControl('conditionalLogic');
		$this->addControl('conditional_logic');
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return rs::message('Add conditional logic error. Please check your options.', 'RsConditionalLogic');
		}
		if($options['for']){
			$options['wrap_id'] = $options['for'];
			$this->addConditionalLogic($options);
		}
	}
}