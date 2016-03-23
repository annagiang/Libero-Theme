<?php
/// Gallery Control - Render Script And HTML (Required RsUpload Control)////

class WP_Customize_RsRepeater extends WP_Customize_Control {
	public $type = 'repeater';
	public $params = array();
	public static $default = array(
		'name' => 'repeater',
		'type' => 'repeater',
		'layout' => 'row',
		'add_row_text' => null,
		'min_rows' => 0,
		'max_rows' => 999,
		'sorting' => true,
		'controls' => array(),
		'default_value' => array(),
		'value'	=> array()
	);
	public function enqueue(){
		wp_enqueue_style('rst-css-repeater', RS_LIB_URL . '/customize/controls/repeater/repeater.css');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('rst-js-repeater', RS_LIB_URL . '/customize/controls/repeater/repeater.js');
		wp_enqueue_script('rst-js-repeater-save', RS_LIB_URL . '/customize/controls/repeater/save.js');
	}
	public function render_content(){
		$options = array_merge( self::$default, $this->params );
		
		if( !isset($options['controls']) || !is_array($options['controls']) || sizeof($options['controls']) == 0 ){
			echo 'Repeater controls must be an array.';
			return;
		}
		
		$options['add_row_text'] = $options['add_row_text'] !== null ? $options['add_row_text'] : ($options['layout'] == 'single' ? 'Add Item' : 'Add Row');
		
		// Get Value Customize Control Repeater
	
		if( $this->value() && !empty( $options['name'] ) ) {
			parse_str($this->value(), $value );
			$options['value'] = $value[$options['name']];
		}
		else {
			$options['value'] = array();
		}
		
		foreach($options['controls'] as $key => $control){
			if(is_array($control)){
				if(empty($control['name']) && $control['type'] != 'group'){
					$control['name'] = $control['type'];
				}
				if(empty($control['label'])){
					$control['label'] = ucfirst($control['name']);
				}
				if(empty($control['description'])){
					$control['description'] = '';
				}
				$options['controls'][$key] = $control;
			}
			else{
				unset($options['controls'][$key]);
			}
		}
		
		$options['sorting'] = $options['sorting'] ? 'sorting-true' : 'sorting-false';
		
		?>
		
		<div class="rs-repeater layout-<?php echo esc_attr($options['layout']) ?> <?php echo esc_attr($options['sorting']) ?>" data-max-rows="<?php echo esc_attr($options['max_rows']) ?>" data-min-rows="<?php echo esc_attr($options['min_rows']) ?>" data-base-name="<?php echo esc_attr($options['name']) ?>">
			
			<?php
			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo force_balance_tags($this->description) ; ?></span>
			<?php endif; ?>
			
			<input type="hidden" <?php $this->link(); ?> class="rst-repeater-values" value="<?php echo esc_attr($this->value());?>" />
			
			<?php
				$this->renderRowLayout($options);
			?>
		</div>
		
		<?php
	}
	
	function renderRowLayout($options){
		$length = count($options['controls']);
		?>
		<table class="rs-repeater-table rs-table">
			<tbody>
			<?php 
			foreach($options['value'] as $i=>$value) { ?>
				<tr class="row">
					<?php if($options['sorting']) { ?>
						<td class="row-order"><?php echo ($i + 1) ?></td>
					<?php } ?>
					<td class="rs-fields-wrap">
						<table>
						<?php foreach($options['controls'] as $key=>$control) : 
							unset($control['value']);
							if(isset($options['value'][$i][$control['name']])){
								$control['value'] = $value[$control['name']];;
							}						
							$control['name'] = $options['name'].'['.$i.']['.$control['name'].']';
							if(isset($control['field_id'])){
								$control['conditional_logic_id'] = rs::generateId($control['field_id']) . '-field';
							}
							else{
								$control['conditional_logic_id'] = rs::generateId($control['name']) . '-field';
							}
							?>
							<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
								<td>
									<label><?php echo esc_html($control['label']) ?></label>
									<?php if($control['description']){ ?>
										<p class="description"><?php echo esc_html($control['description']) ?></p>
									<?php } ?>
									<?php 
										$this->renderControl($control); 
									?>
								</td>
							</tr>
						<?php endforeach; ?>
						</table>
					</td>
					<td class="row-action">
						<?php if($options['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
						<a class="rs-repeater-remove-row" title="remove">-</a>
					</td>
				</tr>
				<?php
			}
			
			$options['value'] ? $i++ : $i=0;
			
			for(; $i<$options['min_rows']; $i++){ ?>
				<tr class="row">
					<?php if($options['sorting']) { ?>
						<td class="row-order"><?php echo ($i + 1) ?></td>
					<?php } ?>
					<td class="rs-fields-wrap">
						<table>
						<?php foreach($options['controls'] as $control) : 
							unset($control['value']);
							$control['name'] = $options['name'].'['.$i.']['.$control['name'].']';
							$control['conditional_logic_id'] = rs::generateId($control['name']);
							?>
							<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
								<td>
									<label><?php echo esc_html($control['label']) ?></label>
									<?php if($control['description']){ ?>
										<p class="description"><?php echo esc_html($control['description']) ?></p>
									<?php } ?>
									<?php 
										$this->renderControl($control); 
									?>
								</td>
							</tr>
						<?php endforeach; ?>
						</table>
					</td>
					<td class="row-action">
						<?php if($options['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
						<a class="rs-repeater-remove-row" title="remove">-</a>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
			<tfoot>
				<tr class="row rs-template">
					<?php if($options['sorting']) { ?>
						<td class="row-order"></td>
					<?php } ?>
					<td class="rs-fields-wrap">
						<table>
						<?php foreach($options['controls'] as $control) : 
							unset($control['value']);
							$control['name'] = $options['name'].'[rsrowindex]['.$control['name'].']';
							if(isset($control['field_id'])){
								$control['conditional_logic_id'] = rs::generateId($control['field_id']) . '-field';
							}
							else{
								$control['conditional_logic_id'] = rs::generateId($control['name']) . '-field';
							}
							?>
							<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
								<td>
									<label><?php echo esc_html($control['label']) ?></label>
									<?php if($control['description']){ ?>
										<p class="description"><?php echo esc_html($control['description']) ?></p>
									<?php } ?>
									<?php
										$this->renderControl($control);
									?>
								</td>
							</tr>
						<?php endforeach; ?>
						</table>
					</td>
					<td class="row-action">
						<?php if($options['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
						<a class="rs-repeater-remove-row" title="remove">-</a>
					</td>
				</tr>
			</tfoot>
		</table>
		<div class="rs-repeater-footer">
			<a class="button rs-repeater-save">Done</a>
			<a class="button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo esc_attr($options['add_row_text']) ?></a>
		</div>
		<p>Click Done to preview and save data.</p>
		<?php
	}
	
	public function renderControl($control){
		$return = rs::renderControl($control);
		if(rs::isMessage($return)){
			$this->renderError($return['message']);
		}
	}
}
