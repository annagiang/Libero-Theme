<?php
/// Textbox Control - Render Script And HTML ////

class RsTextbox extends RsControl{
	public $default = array(
		'name' => 'textbox',
		'placeholder' => null,
		'autocomplete' => 'on',
		'derscription' => '',
		'type' => 'text',
		'width'=> null,
		'default_value' => ''
	);
	
	public function RsTextbox(){
		$this->addControl('text', array('text', 'number', 'email', 'phone'));
		$this->addControl('textbox', array('text', 'number', 'email', 'phone'));		
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$options['value'] = htmlentities((string)$options['value'], ENT_QUOTES, 'UTF-8');
		
		$wrapid = $this->addConditionalLogic($options);
		
		if(is_numeric($options['width'])){
			$options['width'] .= 'px';
		}
		
		$style = $options['width'] ? "width: {$options['width']}" : "";
	
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-textbox-wrap <?php echo esc_attr($options['css_class']) ?>" style="<?php echo esc_attr($style)?>">
			<input type="text" value="<?php echo esc_attr($options['value']) ?>" 
				id="<?php echo esc_attr($options['field_id']) ?>" 
				name="<?php echo esc_attr($options['field_name']) ?>" class="rs-textbox" 
				placeholder="<?php echo esc_attr($options['placeholder']) ?>" 
				autocomplete="<?php echo esc_attr($options['autocomplete']) ?>"			 
				<?php echo esc_attr($options['required']) ?>/>
			<?php if( $options['derscription'] ) { ?>
			<p class="derscription"><?php echo trim($options['derscription']) ?></p>
			<?php } ?>
		</div>
		<?php
	}
}

/// Hidden Control - Render Script And HTML ////

class RsHidden extends RsControl{
	public $default = array(
		'name' => 'hidden',
		'type' => 'hidden',
		'default_value' => ''
	);
	
	public function RsHidden(){
		$this->addControl('hidden', 'hidden');
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}

		$options['value'] = htmlentities((string)$options['value'], ENT_QUOTES, 'UTF-8');

		?>
		<input type="hidden" value="<?php echo esc_attr($options['value']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" id="<?php echo esc_attr($options['field_id']) ?>"/>
		<?php
	}
}

/// Textarea Control - Render Script And HTML ////

class RsTextarea extends RsControl{
	public $default =  array(
		'name' => 'textarea',
		'placeholder' => '',
		'type' => 'textarea',
		'derscription' => '',
		'width' => null,
		'height' => null,
		'auto_height' => false
	);
	
	public function RsTextarea(){
		$this->addControl('textarea', 'textarea');
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}

		$wrapid = $this->addConditionalLogic($options);
		
		if(is_numeric($options['height'])){
			$options['height'] .= 'px';
		}
		if(is_numeric($options['width'])){
			$options['width'] .= 'px';
		}
		
		$options['auto_height'] =  $options['auto_height'] ? 'auto-height' : '';
		
		$wstyle = $options['width'] ? "width: {$options['width']}" : "";
		$tstyle = $options['height'] ? "height: {$options['height']}" : "";
		
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-textarea-wrap <?php echo esc_attr($options['css_class']) ?>" style="<?php echo esc_attr($wstyle) ?>">
			<textarea id="<?php echo esc_attr($options['field_id']) ?>" 
				name="<?php echo esc_attr($options['field_name']) ?>" 
				class="rs-textarea <?php echo esc_attr($options['auto_height']) ?>" 
				placeholder="<?php echo esc_attr($options['placeholder']) ?>" 
				style="<?php echo esc_attr($tstyle) ?>" 
				<?php echo esc_attr($options['required']) ?>><?php echo esc_textarea(trim($options['value'])) ?></textarea>
			<?php if( $options['derscription'] ) { ?>
			<p class="derscription"><?php echo trim($options['derscription']) ?></p>
			<?php } ?>
		</div>
		<?php
	}
}

