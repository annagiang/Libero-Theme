<?php
/// Repeater Control - Render Script And HTML ////

class RsRepeater extends RsControl{
	public $default = array(
		'name' => 'repeater',
		'type' => 'repeater',
		'layout' => 'table',
		'add_row_text' => null,
		'min_rows' => 1,
		'max_rows' => 999,
		'sorting' => true,
		'controls' => array(),
		'default_value' => array()
	);
	public function RsRepeater(){
		$this->addControl('repeater', 'repeater');
	}
	
	public function loadFiles(){
		rs::loadStyle('rs-repeater', RS_LIB_URL . '/controls/repeater/repeater.min.css');
		rs::loadScript('jquery-ui-sortable');
		rs::loadScript('rs-repeater', RS_LIB_URL . '/controls/repeater/repeater.min.js', true);
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);
			
		if(!is_array($options['controls'])){
			return rs::message('Controls must be an array.', 'Repeater ' . $options['name']);
		}
		
		$options['add_row_text'] = $options['add_row_text'] !== null ? $options['add_row_text'] : ($options['layout'] == 'single' ? 'Add Item' : 'Add Row');
		
		if(!is_array($options['value'])){
			$options['value'] = array();
		}

		foreach($options['value'] as $index=>$value){
			if(!is_numeric($index)){
				unset($options['value'][$index]);
			}
		}
		
		$options['value'] = array_values($options['value']);
		
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
		
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-repeater layout-<?php echo esc_attr($options['layout']) ?> <?php echo esc_attr($options['sorting']) ?> <?php echo esc_attr($options['css_class']) ?>" data-max-rows="<?php echo esc_attr($options['max_rows']) ?>" data-min-rows="<?php echo esc_attr($options['min_rows']) ?>" data-base-name="<?php echo esc_attr($options['field_name']) ?>">
			<?php
			if($options['layout'] == 'single'){
				$this->renderSingleLayout($options);
			}
			else if($options['layout'] == 'row'){
				$this->renderRowLayout($options);
			}
			else{
				$this->renderTableLayout($options);
			}
			?>
		</div>
		
		<?php
	}
	public function renderControl($control){
		$return = rs::renderControl($control);
		if(rs::isMessage($return)){
			$this->renderError($return['message']);
		}
	}
	function renderSingleLayout($options){
		$control = $options['controls'][0];
		?>
		<table class="rs-repeater-table rs-table">
			<tbody>
			<?php 
			foreach($options['value'] as $i=>$value) { ?>
				<tr class="row">
					<?php if($options['sorting']) { ?>
						<td class="row-order"><?php echo ($i + 1) ?></td>
					<?php } ?>
					<td>
					<?php 
						$control['value'] = $value;
						$control['name'] = $options['field_name'].'['.$i.']';
						$this->renderControl($control); 
						if($control['description']){
							?><p class="description"><?php echo esc_html($control['description']) ?></p><?php
						}
					?>
					</td>
					<td class="row-action">
						<?php if($options['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
						<a class="rs-repeater-remove-row" title="remove">-</a>
					</td>
				</tr>
			<?php 
			} 
			
			$options['value'] ? $i++ : $i=0;
			
			unset($control['value']);
			
			for(; $i < $options['min_rows']; $i++){ ?>
				<tr class="row">
					<?php if($options['sorting']) { ?>
						<td class="row-order"><?php echo ($i + 1)  ?></td>
					<?php } ?>
					<td>
					<?php 
						$control['name'] = $options['field_name'].'['.$i.']';
						$this->renderControl($control); 
						if($control['description']){
							?><p class="description"><?php echo esc_html($control['description']) ?></p><?php
						}
					?>
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
					<td>
					<?php
						$control['name'] = $options['field_name'].'[rsrowindex]';
						$this->renderControl($control); 
						if($control['description']){
							?><p class="description"><?php echo esc_html($control['description']) ?></p><?php
						}
					?>
					</td>
					<td class="row-action">
						<?php if($options['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
						<a class="rs-repeater-remove-row" title="remove">-</a>
					</td>
				</tr>
			</tfoot>
		</table>
		<div class="rs-repeater-footer">
			<a class="rs-button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo esc_html($options['add_row_text']) ?></a>
		</div>
		<?php
	}

	function renderTableLayout($options){
		$length = count($options['controls']);
		unset($options['value']['rsrowindex']);
		//return;
		?>
		<table class="rs-repeater-table rs-table">
			<thead>
				<tr>
					<?php if($options['sorting']) { ?>
						<th class="row-order"></th>
					<?php } ?>
					<?php 
						$keys = array_keys($options['controls']);
						$last_key = end($keys);
						foreach($options['controls'] as $key=>$control) { 
							$style = $key != $last_key ? 'width:'.(90/$length).'%' : '';
					?>
							<th style="<?php echo esc_attr($style) ?>">
								<?php echo esc_html($control['label']) ?>
							</th>
						<?php } ?>
					<th class="row-action"></th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach($options['value'] as $i=>$value) { ?>
			<tr class="row">
				<?php if($options['sorting']) { ?>
					<td class="row-order"><?php echo ($i + 1) ?></td>
				<?php } ?>
				<?php foreach($options['controls'] as $key=>$control) {?>
					<td>
					<?php 
						unset($control['value']);
						if(isset($options['value'][$i][$control['name']])){
							$control['value'] = $value[$control['name']];
						}						
						$control['name'] = $options['field_name'].'['.$i.']['.$control['name'].']';
						$this->renderControl($control); 
						if($control['description']){
							?><p class="description"><?php echo esc_html($control['description']) ?></p><?php
						}
					?>
					</td>
				<?php } ?>
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
					<?php foreach($options['controls'] as $control) { ?>
						<td>
						<?php 
							unset($control['value']);
							$control['name'] = $options['field_name'].'['.$i.']['.$control['name'].']';
							$this->renderControl($control); 
							if($control['description']){
								?><p class="description"><?php echo esc_html($control['description']) ?></p><?php
							}
						?>
						</td>
					<?php } ?>
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
					<?php $i = -1; foreach($options['controls'] as $control) : $i++; ?>
						<td>
						<?php
							unset($control['value']);
							$control['name'] = $options['field_name'].'[rsrowindex]['.$control['name'].']';
							$this->renderControl($control); 
							if($control['description']){
								?><p class="description"><?php echo esc_html($control['description']) ?></p><?php
							}
						?>
						</td>
					<?php endforeach; ?>
					<td class="row-action">
						<?php if($options['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
						<a class="rs-repeater-remove-row" title="remove">-</a>
					</td>
				</tr>
			</tfoot>
		</table>
		<div class="rs-repeater-footer">
			<a class="rs-button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo esc_attr($options['add_row_text']) ?></a>
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
							$control['name'] = $options['field_name'].'['.$i.']['.$control['name'].']';
							if(isset($control['field_id'])){
								$control['conditional_logic_id'] = rs::generateId($control['field_id']) . '-field';
							}
							else{
								$control['conditional_logic_id'] = rs::generateId($control['name']) . '-field';
							}
							?>
							<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
								<td class="label">
									<label><?php echo esc_html($control['label']) ?></label>
									<?php if($control['description']){ ?>
										<p class="description"><?php echo esc_html($control['description']) ?></p>
									<?php } ?>
								</td>
								<td>
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
							$control['name'] = $options['field_name'].'['.$i.']['.$control['name'].']';
							$control['conditional_logic_id'] = rs::generateId($control['name']);
							?>
							<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
								<td class="label">
									<label><?php echo esc_html($control['label']) ?></label>
									<?php if($control['description']){ ?>
										<p class="description"><?php echo esc_html($control['description']) ?></p>
									<?php } ?>
								</td>
								<td>
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
							$control['name'] = $options['field_name'].'[rsrowindex]['.$control['name'].']';
							if(isset($control['field_id'])){
								$control['conditional_logic_id'] = rs::generateId($control['field_id']) . '-field';
							}
							else{
								$control['conditional_logic_id'] = rs::generateId($control['name']) . '-field';
							}
							?>
							<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
								<td class="label">
									<label><?php echo esc_html($control['label']) ?></label>
									<?php if($control['description']){ ?>
										<p class="description"><?php echo esc_html($control['description']) ?></p>
									<?php } ?>
								</td>
								<td>
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
			<a class="rs-button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo esc_attr($options['add_row_text']) ?></a>
		</div>
		<?php
	}
}
