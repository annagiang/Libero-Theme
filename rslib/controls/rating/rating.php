<?php
/// Rating Control - Render Script And HTML ////
class RsRating extends RsControl{
	public $default = array(
		'name' => 'rating',
		'type' => 'rating',
		'default_value' => 0,
		'max_rates' => 3,
		'options' => array()
	);
	
	public $rating_options_default = array(
		'maxRates' => null, 	//can set here or in default options.
		'starWidth' => 26,
		'starHeight' => 24,
		'length' => 5,
		'step' => 1,
		'type' => 2
	);
	
	public function RsRating(){
		$this->addControl('rating', 'rating');
	}
	
	public function parseOptions($options){

		if(!$options = parent::parseOptions($options)){
			return false;
		}
		if(!is_array($options['options'])){
			$options['options'] = array();
		}
		$options['options'] = array_merge($this->rating_options_default, $options['options']);
		
		
		if($options['options']['maxRates'] === null){
			$options['options']['maxRates'] = $options['max_rates'];
		}
		
		return $options;
	}
	
	public function loadFiles(){
		rs::loadStyle('rs-rating', RS_LIB_URL . '/scripts/jquery.rs.rating/jquery.rs.rating.min.css');
		rs::loadScript('rs-rating', RS_LIB_URL . '/scripts/jquery.rs.rating/jquery.rs.rating.min.js', true);
		rs::loadScript('rs-rating-init', RS_LIB_URL . '/controls/rating/rating.min.js', true);
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);
		
		$jconfig = json_encode($options['options']);
		
		$options['value'] = (float)$options['value'];
		?>
		
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-rating <?php echo esc_attr($options['css_class']) ?>">
			<input type="hidden" value="<?php echo esc_attr($options['value']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" id="<?php echo esc_attr($options['field_id']) ?>" class="rs-rating-input" data-config='<?php echo esc_attr($jconfig) ?>' <?php echo esc_attr($options['required']) ?>/>
		</div>
		<?php
	}
}
