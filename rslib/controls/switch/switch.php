<?php
/// RsSwitchButton Control - Render Script And HTML ////

class RsSwitchButton extends RsControl{
	public $default = array(
		'name' => 'switch',
		'type' => 'switch',
		'default_value' => false,
		'style' => 'default' //'default' | 'on-off' | 'yes-no'
	);
	
	public function RsSwitchButton(){
		$this->addControl('switchbutton', 'switch');
	}
	
	public function loadFiles(){
		rs::loadStyle('rs-switch', RS_LIB_URL . '/scripts/jquery.rs.switch/jquery.rs.switch.min.css');
		rs::loadScript('rs-switch', RS_LIB_URL . '/scripts/jquery.rs.switch/jquery.rs.switch.min.js', true);
		rs::loadScript('rs-switch-init', RS_LIB_URL . '/controls/switch/switch.min.js', true);
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}

		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);

		?>
		
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-switch <?php echo esc_attr($options['css_class']) ?> rs-switch-<?php echo esc_attr($options['style']) ?>">
			<input type="checkbox" id="<?php echo esc_attr($options['field_id']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" class="rs-switch-input" value="<?php echo esc_attr($options['value']) ?>" <?php echo esc_attr($options['required']) ?>/>
		</div>
		<?php
	}
}
