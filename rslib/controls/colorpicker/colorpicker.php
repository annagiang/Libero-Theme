<?php
/// Checkable Control - Render Script And HTML ////

class RsColorPicker extends RsControl{
	public $default = array(
		'name' => 'color', 
		'type' => 'color'
	);
	
	public function RsColorPicker(){
		$this->addControl('colorpicker', 'color');
	}
	
	public function loadFiles(){
		rs::loadStyle('rs-colorpicker', RS_LIB_URL . '/scripts/jquery.colorpicker/css/colorpicker.min.css');
		rs::loadStyle('rs-colorpicker-custom', RS_LIB_URL . '/controls/colorpicker/colorpicker.min.css');
		rs::loadScript('jquery-color', RS_LIB_URL . '/scripts/jquery.color.min.js', true);
		rs::loadScript('rs-colorpicker', RS_LIB_URL . '/scripts/jquery.colorpicker/js/colorpicker.min.js', true);
		rs::loadScript('rs-colorpicker-init', RS_LIB_URL . '/controls/colorpicker/colorpicker.min.js', true);
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);		
		
		?>
		
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-colorpicker rs-control <?php echo esc_attr($options['css_class']) ?>">
			<input type="text" class="rs-textbox rs-colorpicker-input" value="<?php echo esc_attr($options['value']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" id="<?php echo esc_attr($options['field_id']) ?>" <?php echo esc_attr($options['required']) ?>/>
			<img class="rs-colorpicker-trigger" src="<?php echo RS_LIB_URL . '/controls/colorpicker/trigger.png' ?>" alt="..." title="..."/>
		</div>
		
		<?php
	}
}
