<?php 
class RsScript extends RsControl{
	public $default = array(
		'name' => 'script',
		'type' => 'script',
		'callback' => null,
		'args' => null
	);
	
	public function RsScript(){
		$this->addControl('script', 'script');
	}
	
	public function render($options = array()){
		$options = $this->parseOptions($options);
		if($options && function_exists($options['callback'])){
			if(is_array($options['args'])){
				call_user_func_array($options['callback'], $options['args']);
			}
			else{
				call_user_func($options['callback'], $options['args']);
			}
		}
	}
}

