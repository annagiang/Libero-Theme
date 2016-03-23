<?php
class WP_Customize_RSBackground extends WP_Customize_Control {
    public $type = 'rsbackground';
	
    public function render_content() {
		$name = '_customize-rsbackground-' . $this->id;
		$defaultStyling = array(
			'background-color' => '',
			'background-image' => '',
			'background-repeat' => '',
			'background-position-vertical' => '',
			'background-position-horizontal' => '',
			'background-size' => '',
			'background-attachment' => '',
		);
		$values = array();
		if(is_serialized($this->value())){
			$values = unserialize($this->value());
		}
		else {
			$values = $defaultStyling;
		}
		$value_serialized = is_serialized($this->value()) ? $this->value() : serialize($this->value());
	?>
		<div id="customize-control-<?php echo esc_attr($this->id); ?>" class="customize-control-font">
			<div class="content-gallery-input-values">
				<input type="hidden" <?php $this->link(); ?> class="rst-gallery-items" value="<?php echo esc_attr($value_serialized);?>"/>
			</div>
			<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo force_balance_tags($this->description) ; ?></span>
			<?php endif; ?>
		
			<?php
				$defaultValue = $this->setting->default;
				$color = '';
				if ( isset($defaultValue['background-color']) ) {
					$color = $defaultValue['background-color'];
					if ( '#' !== substr( $color, 0, 1 ) ) {
						$color = '#' + $color;
					}
				}
			?>
			<label class="normal">
				<span class="rst-span-bg-repeat">Background Color</span>
				<div class="customize-control-content">
					<input class="background-color" type="text" maxlength="7" value="<?php echo esc_attr($values['background-color']) ?>" placeholder="<?php esc_attr_e( 'Hex Value','libero' ); ?>" data-default-color="<?php echo esc_attr($color) ?>" />
				</div>
			</label>
			
			<label class="normal">
				<span class="rst-span-bg-repeat">Background Image</span>
				<div class="customize-control-background">
					<input class="background-image" type="hidden" value="<?php echo isset($values['background-image']) ? esc_attr($values['background-image']) : '' ?>" />
					
					<div class="current">
						<div class="container">
							
							<?php $active = ( isset($values['background-image']) && !empty($values['background-image']) ) ? '' : 'rs_hidden_control'; ?>
							<?php $unactive = ( isset($values['background-image'])&& !empty($values['background-image']) ) ? 'rs_hidden_control' : ''; ?>
							<div class="rst-background-show-image attachment-media-view attachment-media-view-image landscape <?php echo sanitize_html_class($active) ?>">
								<div class="thumbnail thumbnail-image">
									<img class="attachment-thumb" draggable="false" src="<?php echo isset($values['background-image']) ? esc_url( $values['background-image'] ) : '' ?>" />
								</div>
							</div>
							
							<div class="rst-background-no-image placeholder <?php echo sanitize_html_class($unactive) ?>">
								<div class="inner">
									<span>No image selected</span>
								</div>
							</div>
							
						</div>
					</div>
					<div class="actions rst-background-show-image <?php echo sanitize_html_class($active) ?>">
						<button type="button" class="button remove-button">Remove</button>
						<button type="button" class="button upload-button" id="<?php echo esc_attr($this->id); ?>-button">Change Image</button>
						<div style="clear:both"></div>
					</div>
					
					<div class="actions rst-background-no-image <?php echo sanitize_html_class($unactive) ?>">
						<button type="button" class="button upload-button" id="<?php echo esc_attr($this->id); ?>-button">Select Image</button>
						<div style="clear:both"></div>
					</div>
					
				</div>
			</label>
		
			<label>
				<span class="rst-span-bg-repeat">Repeat</span>
				<select class="rst-bg-repeat">
					<option value=""></option>
					<option <?php selected( $values['background-repeat'], 'no-repeat' ); ?> value="no-repeat">No Repeat</option>
					<option <?php selected( $values['background-repeat'], 'repeat' ); ?> value="repeat">Repeat</option>
					<option <?php selected( $values['background-repeat'], 'repeat-x' ); ?> value="repeat-x">Repeat x</option>
					<option <?php selected( $values['background-repeat'], 'repeat-y' ); ?> value="repeat-y">Repeat y</option>
				</select>
			</label>
		
			<label>
				<span class="rst-span-bg-position">Position</span>
				<select class="rst-bg-position-vertical">
					<option value=""></option>
					<option <?php selected( $values['background-position-vertical'], 'top' ); ?> value="top">Top</option>
					<option <?php selected( $values['background-position-vertical'], 'center' ); ?> value="center">Center</option>
					<option <?php selected( $values['background-position-vertical'], 'bottom' ); ?> value="bottom">Bottom Left</option>
				</select>
				<select class="rst-bg-position-horizontal">
					<option value=""></option>
					<option <?php selected( $values['background-position-horizontal'], 'left' ); ?> value="left">Left</option>
					<option <?php selected( $values['background-position-horizontal'], 'center' ); ?> value="center">Center</option>
					<option <?php selected( $values['background-position-horizontal'], 'right' ); ?> value="right">Right</option>
				</select>
			</label>
		
			<label>
				<span class="rst-span-bg-size">Size</span>
				<select class="rst-bg-size">
					<option value=""></option>
					<option <?php selected( $values['background-size'], 'auto' ); ?> value="auto">Auto</option>
					<option <?php selected( $values['background-size'], 'cover' ); ?> value="cover">Cover</option>
					<option <?php selected( $values['background-size'], 'contain' ); ?> value="contain">Contain</option>
				</select>
			</label>
		
			<label>
				<span class="rst-span-bg-attachment">Attachment</span>
				<select class="rst-bg-attachment">
					<option value=""></option>
					<option <?php selected( $values['background-attachment'], 'scroll' ); ?> value="scroll">Scroll</option>
					<option <?php selected( $values['background-attachment'], 'fixed' ); ?> value="fixed">Fixed</option>
					<option <?php selected( $values['background-attachment'], 'local' ); ?> value="local">Local</option>
					<option <?php selected( $values['background-attachment'], 'inherit' ); ?> value="inherit">Inherit</option>
				</select>
			</label>
		
		</div>
	<?php
    }
	
	public function enqueue() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_style( 'rst-css-google-font', RS_LIB_URL . '/customize/controls/google-font/rst-google-font.min.css' );
		wp_enqueue_style( 'rst-css-background', RS_LIB_URL . '/customize/controls/background/rst-background.css' );
		wp_enqueue_script( 'rst-js-background', RS_LIB_URL . '/customize/controls/background/rst-background.js', array('jquery'), '', true );
	}
	
}