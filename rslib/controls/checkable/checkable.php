<?php
/// Checkable Control - Render Script And HTML ////

class RsCheckbox extends RsControl{
	public $default = array(
		'name' => 'checkbox', 
		'type' => 'checkbox',
		'display' => 'list', // or 'inline'
		'items' => null
	);
	public function RsCheckbox(){
		$this->addControl('checkbox', 'checkbox');
	}
	public function loadFiles(){
		rs::loadStyle('rs-checkable', RS_LIB_URL . '/scripts/jquery.rs.checkable/jquery.rs.checkable.min.css');
		rs::loadScript('rs-checkable', RS_LIB_URL . '/scripts/jquery.rs.checkable/jquery.rs.checkable.min.js', true);
		rs::loadScript('rs-checkable-init', RS_LIB_URL . '/controls/checkable/checkable.min.js', true);
		rs::loadStyle('rs-checkable-custom', RS_LIB_URL . '/controls/checkable/checkable.css');
	}
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		if(!is_array($options['items']) || empty($options['items'])){
			return rs::message('Items must be an array.', $options['type'] . ' ' . $options['name']);
		}

		$wrapid = $this->addConditionalLogic($options);

		$options['css_class'] .= ' display-' . $options['display'];	
		
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-<?php echo sanitize_html_class($options['type'], 'checkable') ?> <?php echo esc_attr($options['css_class']) ?>">
			<?php
			if(count($options['items']) > 1){ ?>
				<ul class="clear-fix">
				<?php
					$multival = is_array($options['value']);
					$ischeckbox = $options['type'] == 'checkbox';
					$i = 0;
					foreach($options['items'] as $value=>$text){
						if(is_array($text)){
							$icon = isset($text['image']) ?  $text['image'] : null;
							$value = isset($text['value']) ? $text['value'] : $value;
							$text = isset($text['text']) ? $text['text'] : '';
						}
						$checked = $multival && in_array($value, $options['value']) || (string)$value === (string)$options['value'] && $options['value'] !== null;
						$name = $ischeckbox ? $options['field_name']. '[]' : $options['field_name'];
						$id = $options['field_id'] . '-' .  $i++;
						if( !isset($icon)){
							echo '<li><label class="rs-'.$options['type'].'-label" for="'.$id.'"><input type="'.$options['type'].'" id="'.$id.'" class="rs-'.$options['type'].'-input" name="'.$name.'" value="'.$value.'" '.($checked ? 'checked="checked"' : '').' '.$options['required'].'/>'.$text.'</label></li>';
						}
						else{
							echo '<li><label class="rs-'.$options['type'].'-label" for="'.$id.'"><img src="' . $icon . '" alt="" /><input type="'.$options['type'].'" id="'.$id.'" class="rs-'.$options['type'].'-input" name="'.$name.'" value="'.$value.'" '.($checked ? 'checked="checked"' : '').' '.$options['required'].'/><span>'.$text.'</span></label></li>';
						}
					}
				?>
				</ul>
				<?php 
			} 
			else {
				foreach($options['items'] as $value=>$text){
					if(is_array($text)){
						$icon = isset($text['image']) ?  $text['image'] : null;
						$value = isset($text['value']) ? $text['value'] : $value;
						$text = isset($text['text']) ? $text['text'] : '';
					}
					$checked = (string)$value === (string)$options['value'] && $options['value'] !== null;
					$id = $options['field_id'];
					if( !isset($icon)){
						echo '<label class="rs-'.$options['type'].'-label" for="'.$id.'"><input type="'.$options['type'].'" id="'.$id.'" class="rs-'.$options['type'].'-input" name="'.$options['field_name'].'" value="'.$value.'" '.($checked ? 'checked="checked"' : '').' '.$options['required'].'/>'.$text.'</label>';
					}
					else{
						echo '<label class="rs-'.$options['type'].'-label" for="'.$id.'"><img src="' . $icon . '" alt="" /><input type="'.$options['type'].'" id="'.$id.'" class="rs-'.$options['type'].'-input" name="'.$options['field_name'].'" value="'.$value.'" '.($checked ? 'checked="checked"' : '').' '.$options['required'].'/><span>'.$text.'</span></label>';
					}
				}
			}	
			?>
		</div>
		<?php
	}

}

class RsRadio extends RsCheckbox{
	public function RsRadio(){
		$this->addControl('radio', 'radio');
	}
	public function render($options = array()){
		$options['type'] = 'radio';
		if(empty($options['name'])) $options['name'] = 'radio';
		return parent::render($options);
	}
}
