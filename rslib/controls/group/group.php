<?php
/// Repeater Control - Render Script And HTML ////

class RsGroup extends RsControl{
	public $default = array(
		'name' => '',
		'type' => 'group',
		'layout' => 'table',
		'show_header' => true,
		'controls' => array(),
		'default_value' => array(),
		'show_controls' => false
	);
	public function RsGroup(){
		$this->addControl('group', 'group');
	}
	
	public function render($options = array()){
		
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		if(empty($options['name'])) {
			$options['wrap_id'] = uniqid('rs-group-');
		}
		else{
			$options['name'] = str_replace('[]', '', $options['name']);
		}
		
		$wrapid = $this->addConditionalLogic($options);
			
		if(!is_array($options['controls'])){
			return rs::message('Controls must be an array.', 'Group ' . $options['name']);
		}
		
		if(!is_array($options['value'])){
			$options['value'] = array();
		}
		
		$render_by = null;
		if(empty($options['name'])){
			if(isset($options['render_by'])){
				if($options['render_by'] == 'metabox'){
					$render_by = 'metabox';
				}
				elseif($options['render_by'] == 'cpanel'){
					$render_by = 'cpanel';
				}
			}
		}
		
		foreach($options['controls'] as $key => $control){
			if(is_array($control)){
				if(empty($control['name']) && $control['type'] != 'group'){
					$control['name'] = $control['type'];
				}
				if(empty($control['label']) && isset($control['name'])){
					$control['label'] = ucfirst($control['name']);
				}
				if(empty($control['description'])){
					$control['description'] = '';
				}
				
				if(isset($control['name']) && isset($options['value'][$control['name']])){
					$control['value'] = $options['value'][$control['name']];
				}	
				elseif(isset($control['name']) && $control['name']){
					if($render_by == 'metabox'){
						$control['value'] = rs::getField($control['name'], $options['render_for'] . '_' . $options['render_object_id']);
					}
					elseif($render_by == 'cpanel'){
						$control['value'] = rs::getOption($control['name']);
					}
				}
				if( isset($control['type']) && $control['type'] == 'group'){
					$control['render_by'] = $options['render_by'];
					$control['render_for'] = $options['render_for'];
					$control['render_object_id'] = $options['render_object_id'];
				}

				if(isset($control['name']) && $options['name']){
					$control['name'] = $options['name'].'['.$control['name'].']';
					$control['name_prefix'] = null;
				}
				elseif($options['name_prefix']){
					$control['name_prefix'] = $options['name_prefix'];
				}
				elseif(empty($control['name_prefix'] )){
					$control['name_prefix']  = null;
				}
				
				$options['controls'][$key] = $control;
			}
			else{
				unset($options['controls'][$key]);
			}				
		}
		$class_box_closed = (isset($options['show_controls']) && $options['show_controls'] ) ? '' : ' closed';
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-group layout-<?php echo esc_attr($options['layout']) ?> <?php echo esc_attr($options['css_class']).esc_attr($class_box_closed); ?>">
			<p class="label rs-group-label display-block">
				<label><?php echo force_balance_tags($options['label']) ?></label>
			</p>
			<div class="handle-groupbox" title="Click to toggle"><br></div>
			<div class="rs-box-group-container<?php echo esc_attr($class_box_closed); ?>">
				<?php
				if($options['layout'] == 'row'){
					$this->renderRowLayout($options);
				}
				elseif($options['layout'] == 'none'){
					$this->renderNoneLayout($options);
				}
				else{
					$this->renderTableLayout($options);
				}
				?>
			</div>
		</div>
		
		<?php
	}
	public function renderControl($control){
		$return = rs::renderControl($control);
		if(rs::isMessage($return)){
			$this->renderError($return['message']);
		}
	}
	function renderTableLayout($options){
		?>
		<table class="rs-table rs-group-table">
			<?php if($options['show_header']) { ?>
			<thead>
				<tr>
					<?php 
					if((!isset($options['controls']) || !count($options['controls'])) && $options['type'] === 'group'){
						$this->renderError('Group could be child controls');
						return;
					}
					else{
						$width = 100/count($options['controls']);
						foreach($options['controls'] as $key=>$control) { ?>
							<th style="width:<?php echo esc_attr($width) ?>%">
								<?php echo force_balance_tags($control['label']) ?>
							</th>
						<?php 
						}
					}					
				?>
				</tr>
			</thead>
			<?php } ?>
			<tbody>
				<tr class="row">
					<?php 
					foreach($options['controls'] as $key=>$control) { ?>
						<td>
						<?php 
							$this->renderControl($control); 
							
							if($control['description']){
								?><p class="description"><?php echo force_balance_tags($control['description']) ?></p><?php
							}
						?>
						</td>
					<?php 
					}
				?>
				</tr>
			</tbody>
		</table>
		<?php
	}

	function renderRowLayout($options){
		?>
		<table class="rs-table rs-group-table">
			<tbody>
				<?php 
				foreach($options['controls'] as $control) { 
					if(isset($control['field_id'])){
						$control['conditional_logic_id'] = rs::generateId('group-item-' . $control['field_id']);
					}
					else{
						$control['conditional_logic_id'] = rs::generateId('group-item-' . $control['name_prefix'] . $control['name']);
					}
					?>
					<tr class="row" id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
						<?php if($options['show_header']) { ?>
						<th class="label">
							<label><?php echo force_balance_tags($control['label']) ?></label>
						</th>
						<?php } ?>
						<td>
						<?php 
							$this->renderControl($control);	
							
							if($control['description']){
								?><p class="description"><?php echo force_balance_tags($control['description']) ?></p><?php
							}						
						?>
						</td>
					</tr>
				<?php 
				}
			?>
			</tbody>
		</table>
		<?php
	}
	function renderNoneLayout($options){
		global $pagenow;
		$check = ($pagenow == 'themes.php');
		foreach($options['controls'] as $control) {
			$name = !empty($control['name']) ? $control['name'] : '';
			if(isset($control['field_id'])){
				$control['conditional_logic_id'] = rs::generateId('group-item-' . $control['field_id']);
			}
			else{
				$control['conditional_logic_id'] = rs::generateId('group-item-' . $control['name_prefix'] . $name);
			}
			echo '<div id="'. esc_attr($control['conditional_logic_id']) .'">';
			if($options['show_header']) {
				echo ($check ? '<div class="rs-field-label">' : '');
			?>
				<label><?php echo force_balance_tags($control['label']) ?></label>
				<?php if($control['description']){ ?>
					<p class="description"><?php echo force_balance_tags($control['description']) ?></p>
				<?php } 
				echo ($check ? '</div>' : '');
			}
			echo ($check ? '<div class="rs-field-editor">' : '');
				$this->renderControl($control);
			echo ($check ? '</div>' : '');
			echo ($check ? '<div class="clear"></div><br/>' : '');
			echo '</div>';
		}
	}
	
	public function serializeName($name, $name_prefix){
		return str_replace(" ", "_", $name_prefix . $name);
	}
}
rs::loadStyle('rs-group', RS_LIB_URL . '/controls/group/group.css');
rs::loadScript('rs-group', RS_LIB_URL . '/controls/group/group.js', true);