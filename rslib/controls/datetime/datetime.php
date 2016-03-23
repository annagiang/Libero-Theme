<?php

/// RsDateTimePicker Control - Render Script And HTML ////

class RsDateTimePicker extends RsControl{
	public $default = array(
		'name' => 'date', 
		'type' => 'date',
		'date_format' => 'yy-mm-dd',
		'time_options' => array()
	);
	
	public $time_options_default = array(
		'hours' => array(
			'starts' => 0,
			'ends' => 23
		),
		'minutes' => array(
			'interval' => 5,
			'starts' => 0,
			'ends' => 55
		),
		'minTime' => array(
			'hour' => 0,
			'minute' =>0
		),
		'maxTime' => array(
			'hour' => 23,
			'minute' =>59
		)
	);
	
	
	public function loadFiles(){
		rs::loadStyle('jquery-ui', RS_LIB_URL . '/styles/jquery-ui/rstheme/minified/jquery-ui.min.css');
		rs::loadStyle('jquery-timepicker', RS_LIB_URL . '/scripts/jquery.timepicker/jquery.ui.timepicker.min.css');
		rs::loadStyle('rs-datetime', RS_LIB_URL . '/controls/datetime/datetime.min.css');
		rs::loadScript('jquery-ui-datepicker');
		rs::loadScript('jquery-ui-timepicker', RS_LIB_URL . '/scripts/jquery.timepicker/jquery.ui.timepicker.min.js', true);
		rs::loadScript('rs-datepicker', RS_LIB_URL . '/controls/datetime/datetime.min.js', true);
	}
	
	public function RsDateTimePicker(){
		$this->addControl('datetime', array('time', 'date', 'datetime'));
	}
	
	public function parseOptions($options){
		if(!$options = parent::parseOptions($options)){
			return false;
		}
		if(!is_array($options['time_options'])){
			$options['time_options'] = array();
		}
		
		$options['time_options'] = array_merge($this->time_options_default, $options['time_options']);
		
		return $options;
	}
	
	public function render($options = array()){
				
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);
		
		$jconfig = json_encode($options['time_options']);

		$date = $time = '';
		if($options['type'] == 'datetime'){
			if(@strtotime($options['value'])){
				$date = new DateTime($options['value']);
				$time = $date->format('H:i');
				$date = $date->format('Y-m-d');
			}
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-datetime rs-control <?php echo esc_attr($options['css_class']) ?>">
			<input class="rs-datetime-input" type="hidden" name="<?php echo esc_attr($options['field_name']) ?>" value="<?php echo esc_attr($date) ?> <?php echo esc_attr($time) ?>"/>
			<div class="rs-datepicker">
				<input type="text" id="<?php echo esc_attr($options['field_id']) ?>-date" class="rs-textbox rs-datepicker-input" value="<?php echo esc_attr($date) ?>" data-date-format="<?php echo esc_attr($options['date_format']) ?>" <?php echo esc_attr($options['required']) ?>/>
			</div>
			<div class="rs-timepicker">
				<input type="text" id="<?php echo esc_attr($options['field_id']) ?>-time" class="rs-textbox rs-timepicker-input" value="<?php echo esc_attr($time) ?>" data-config="<?php echo esc_attr($jconfig) ?>" <?php echo esc_attr($options['required']) ?>/>
			</div>
		</div>		
		<?php
		}
		elseif($options['type'] == 'time'){
		?>
			<div id="<?php echo esc_attr($wrapid) ?>" class="rs-timepicker rs-control <?php echo esc_attr($options['css_class']) ?>">
				<input type="text" id="<?php echo esc_attr($options['field_id']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" class="rs-textbox rs-timepicker-input" value="<?php echo esc_attr($options['value']) ?>" data-config='<?php echo esc_attr($jconfig) ?>' <?php echo esc_attr($options['required']) ?>/>
			</div>
		<?php
		}
		else{
		?>
			<div id="<?php echo esc_attr($wrapid) ?>" class="rs-datepicker rs-control <?php echo esc_attr($options['css_class']) ?>">
				<input type="text" id="<?php echo esc_attr($options['field_id']) ?>" name="<?php echo esc_attr($options['field_name']) ?>"  class="rs-textbox rs-datepicker-input" value="<?php echo esc_attr($options['value']) ?>" data-date-format="<?php echo esc_attr($options['date_format']) ?>" <?php echo esc_attr($options['required']) ?>/>
			</div>
		<?php
		}
	}
}