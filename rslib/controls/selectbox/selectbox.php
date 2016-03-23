<?php
/// Selectbox Control - Render Script And HTML ////

class RsSelectBox extends RsControl{
	public $default =array(
		'name' => 'select', 
		'type' => 'select',
		'items' => array(),
		'width' => null,
		'multiple' => false
	);
	
	public function RsSelectBox(){
		$this->addControl('selectbox', 'select');
	}
	
	public function loadFiles(){
		rs::loadStyle('rs-selecbox', RS_LIB_URL . '/scripts/jquery.rs.selectbox/jquery.rs.selectbox.min.css');
		rs::loadScript('rs-selecbox', RS_LIB_URL . '/scripts/jquery.rs.selectbox/jquery.rs.selectbox.min.js', true);
		rs::loadScript('rs-selecbox-init', RS_LIB_URL . '/controls/selectbox/selectbox.min.js', true);
	}
	
	public function render($options = array()){
		if(!is_array($options['items'])){
			return rs::message('Item must be an array.', get_class($this) . ' ' . $options['name']);
		}
		
		$this->loadFiles();
		
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$wrapid = $this->addConditionalLogic($options, false);
		
		if(is_numeric($options['width'])){
			$options['width'] .= 'px';
		}
		
		$class_multiple = $options['multiple'] ? 'rs-selectbox-multiple' : '';
		$wstyle = $options['width'] ? "width: {$options['width']}" : "";
		
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-selectbox <?php echo esc_attr($class_multiple) ?> <?php echo esc_attr($options['css_class']) ?>" style="<?php echo esc_attr($wstyle) ?>"> 
			<select id="<?php echo esc_attr($options['field_id']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" <?php echo esc_attr($options['multiple']) ?> <?php echo esc_attr($options['required']) ?>>
				<?php 
				$multival = is_array($options['value']);
				foreach($options['items'] as $value => $text){
					$icon = '';
					if(is_array($text)){
						$value = isset($text['value']) ? $text['value'] : '';
						$icon = isset($text['icon']) ? $text['icon'] : '';
						$text = isset($text['text']) ? $text['text'] : '';
					}
					$selected = $multival && in_array($value, $options['value']) || $value == $options['value'];
					echo '<option value="' . $value . '" ' . ($selected ? 'selected="selected"' : '') . ' ' . ($icon ? 'data-icon="' . $icon . '"' : '') . '>' . $text . '</option>';
				} ?>
			</select>
		</div>
		<?php
	}
}
