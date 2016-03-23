<?php

/// RsSlider Control - Render Script And HTML ////

class RsSlider extends RsControl{
	public $default = array(
		'name' => 'slider', 
		'type' => 'slider',
		'value' => '',
		'min' => 1,
		'max' => 100,
		'step' => 1,
		'range' => 'min', // min,max,slider
		'before_text' => '',
		'after_text' => ''
	);
	
	public function loadFiles(){
		rs::loadStyle('jquery-ui', RS_LIB_URL . '/styles/jquery-ui/rstheme/minified/jquery-ui.min.css');
		rs::loadStyle('style-slider', RS_LIB_URL . '/controls/slider/slider.min.css');
		rs::loadScript('jquery-ui-slider');
		rs::loadScript('rs-slider', RS_LIB_URL . '/controls/slider/slider.min.js', true);
	}
	
	public function RsSlider(){
		$this->addControl('slider', 'slider');
	}
		
	public function render($options = array()){
				
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);
		
		if( $options['value'] == '' ) {
			if( $options['range'] == 'min' || $options['range'] == 'max' ){
				$options['value'] = 0;
			}
			if( $options['range'] == 'slider' ){
				$options['value'] = '0-0';
			}
		}
		?>
			<div id="<?php echo esc_attr($wrapid) ?>" class="rs-slider rs-control <?php echo esc_attr($options['css_class']) ?>">
				<input type="text" id="<?php echo esc_attr($options['field_id']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" data-range="<?php echo esc_attr($options['range']) ?>" data-step="<?php echo esc_attr($options['step']) ?>" data-min="<?php echo esc_attr($options['min']) ?>" data-max="<?php echo esc_attr($options['max']) ?>" data-before-text="<?php echo esc_attr($options['before_text']) ?>" data-after-text="<?php echo esc_attr($options['after_text']) ?>" class="rs-slider-input" value="<?php echo esc_attr($options['value']) ?>" <?php echo esc_attr($options['required']) ?> />
				<div class="slider-range"></div>
			</div>
		<?php
	}
}