<?php 
//RsMetaBox Control

/* ======= RULES ========
 * User '|' for 'or' operator
 * User '&' for 'and' operator
 * EG: 'post_type' => 'post|page'
 * EG: 'post_id' => '1|100|45'
 * EG: 'term_id' => '34&44'
 * EG: 'term_id:not' => '2or3'
 * EG: 'user_role' => 'administrator|author'
 */
		 
class RsMetabox extends RsControl{
	static $configs;
	
	public $default = array(
		'name' => null,
		'title' => 'Metabox',
		'layout' => 'none',
		'rules' => array(), 
		'context' => 'normal',
		'priority' => 'default',
		'controls' => array()
	);
	
	public $rules_default = array(
		//POST
		'post_type' => null,
		'post_format' => null,
		'post_id' => null, 
		'post_parent' => null,
		
		//POST AND TAXONOMY
		'term_id' => null, 
		'taxonomy' => null, 
		
		//PAGE
		'page_id' => null,
		'page_type' => null, //front_page | posts_page | parent_page | child_page | top_level
		'page_parent' => null, 
		'page_template' => null,
		
		//USER
		'user_role' => null,
		'logged_user_role' => null,
		'new_user_form_on_multisite' => null
	);
	
	public function RsMetabox(){
		$this->addControl('metabox');
	}
	
	public function loadFiles(){
		rs::loadStyle('rs-metabox', RS_LIB_URL . '/controls/metabox/metabox.min.css');
		rs::loadScript('rs-metabox', RS_LIB_URL . '/controls/metabox/metabox.min.js', true);
	}
		
	public function render($options = array()){
		global $pagenow;
		$pages = array('profile.php', 'user-new.php', 'user-edit.php', 'edit-tags.php', 'post.php', 'post-new.php');
		
		if(!in_array($pagenow, $pages)) return;
				
		if(!static::$configs) static::$configs = array();	
		
		if(!$options = $this->parseOptions($options)){
			return rs::message('Add metabox error. Please check your options', 'RsMetabox');
		}
		
		if(did_action('add_meta_boxes')){
			return rs::message('Should be register outside any functions or by action "add_meta_boxes".', 'Add meta box: ' . $options['name']);
		}
		
		if(!is_array($options['rules'])){
			return rs::message('Rules must be an array.', 'Add meta box: ' . $options['name']);
		}
		
		if(empty($options['controls']) || !is_array($options['controls'])){
			return;
		}
		else{
			foreach($options['controls'] as $key=>$control){
				if(is_array($control)){
					$options['controls'][$key] = $this->parseControl($control, $options['name_prefix']);
				}
				else{
					unset($options['controls'][$key]);
				}
			}
		}
				
		if(!is_array(reset($options['rules']))){
			$options['rules'] = array($this->convertRules($options['rules']));
		}
		else{
			foreach($options['rules'] as $key=>$rules){
				$options['rules'][$key] = $this->convertRules($rules);
			}
		}
		
		if(empty($options['name'])){
			$options['name'] = 'rs-metabox-' . (count(static::$configs) + 1);
			$options['wrap_id'] = 'rs-postbox-' . (count(static::$configs) + 1);
			$options['field_id'] = 'rs-metabox-' . (count(static::$configs) + 1);
		}

		$this->loadFiles();
		
		static::$configs[] = $options;
	}
	
	public function mergeRules($key1, $key2, $rules){
		if(isset($rules[$key1])){
			if(isset($rules[$key2])){
				$new = array();
				
				$equal1 = isset($rules[$key1]['equal']) ? $rules[$key1]['equal'] : null;
				$equal2 = isset($rules[$key2]['equal']) ? $rules[$key2]['equal'] : null;
				if($equal1 || $equal2){
					$new['equal'] = trim($equal1 . '|' . $equal2, '|');
				}
				
				$not1 = isset($rules[$key1]['not']) ? $rules[$key1]['not'] : null;
				$not2 = isset($rules[$key2]['not']) ? $rules[$key2]['not'] : null;
				if($not1 || $not2){
					$new['equal'] = trim($not1 . '$' . $not2, '$');
				}
				
				return $new;
			}
			else{
				return $rules[$key1];
			}
		}
		return null;
	}
	
	public function convertRules($rules, $remove_null_rule = true){
		if(!is_array($rules)){
			$rule = $this->rules_default;
		}
		else{
			$rules = array_merge($this->rules_default, $rules);
		}
		$rules = parent::convertRules($rules, $remove_null_rule);
		
		$rules = array_merge($this->rules_default, $rules);
		
		if(empty($rules['post_type'])){
			if($rules['post_id'] || $rules['post_format'] || $rules['post_parent']){
				$rules['post_type'] = array('equal' => 'post');
			}
			if( $rules['page_template'] || $rules['page_id'] || $rules['page_parent'] || $rules['page_type']){
				$rules['post_type'] = array('equal' => 'page');
			}
		}
		if($rules['user_role'] && empty($rules['new_user_form_on_multisite'])){
			$rules['new_user_form_on_multisite'] = array('equal' => '');
		}
		
		
		if($post_id = $this->mergeRules('page_id', 'post_id', $rules)){
			$rules['post_id'] = $post_id;
			unset($rules['page_id']);
		}
		if($page_parent = $this->mergeRules('page_parent', 'post_parent', $rules)){
			$rules['page_parent'] = $page_parent;
			unset($rules['post_parent']);
		}
		
		return $rules;
	}
			
	public function checkRule($value, $rules, $required_rules = false){

		if($rules == null) return !$required_rules;
		
		$equal = isset($rules['equal']) ? $rules['equal'] : null;
		$not = isset($rules['not']) ? $rules['not'] : null;
		$match = true;

		if($equal !== null){
			if($value == $equal){
				$match = true;
			}
			else if($equal == '' || $value == ''){
				$match = false;
			}
			else{
				$rule = explode('|', (string)$equal );
				foreach($rule as $item){
					$subrule = explode('&', $item);
					$submatch = true;
					foreach($subrule as $subitem){
						$submatch = $submatch && strpos('&' . $value, '&' . $subitem) !== false;
					}
					$match = $submatch;
					if($match) break;
				}
			}
		}
  
		if($match && $not !== null){
			if($value == $not){
				$match = false;
			}
			else if($not == '' || $value == ''){
				$match = true;
			}
			else{
				$rule = explode('|', (string)$not );
				foreach($rule as $item){
					$subrule = explode('&', $item);
					$submatch = true;
					foreach($subrule as $subitem){
						$submatch = $submatch && strpos('&' . $value, '&' . $subitem) === false;
					}
					$match = $submatch;
					if($match) break;
				}
			}
		}

		return $match;
	}
	
	public function serializeName($name, $name_prefix){
		return str_replace(" ", "_", $name_prefix . $name);
	}

	public function parseControl($control, $name_prefix){
		$control = array_merge(array(
			'type' => null,
			'label' => $control['name'],
			'description' => null,
			'name_prefix' => null
		), $control);
		
		$control['name_prefix'] = $name_prefix ? $name_prefix : $control['name_prefix'];
		
		$conditional_logic_id = empty($control['name']) ? uniqid('c') : $control['name'];
		
		if(isset($control['field_id'])){
			$control['conditional_logic_id'] = $control['field_id'] . '-field';
		}
		else{
			$control['conditional_logic_id'] = $control['name_prefix'] . $conditional_logic_id . '-field';
		}
		
		if(empty($control['name']) && isset($control['controls']) && is_array($control['controls'])){
			foreach($control['controls'] as $key=>$subcontrol){
				$control['controls'][$key] = $this->parseControl($subcontrol, $name_prefix);
			}
		}
		
		return $control;
	}
	
	public function renderControl($control, $for = null, $id = null){
		$control['render_by'] = 'metabox';
		$control['render_for'] = $for;
		$control['render_object_id'] = $id;
		$return = rs::renderControl($control);
		if(rs::isMessage($return)){
			$this->renderError($return['message']);
		}
	}
	
	public function getFieldsName($controls){
		$names = array();
		foreach($controls as $control){
			if(!empty($control['name'])){
				$names[] = "[" . strlen($control['name_prefix']) . "]" . $control['name_prefix'] . $control['name'];
			}
			elseif(isset($control['controls']) && is_array($control['controls'])){
				$sub_names = $this->getFieldsName($control['controls']);
				$names = array_merge($names, $sub_names);
			}
		}
		return $names;
	}
	
	public function saveFieldsAjax($id){
		if(isset($_REQUEST['rs_meta_names'])){
			$rsnames = $_REQUEST['rs_meta_names'];
			$names = array();
			foreach($rsnames as $fnames){
				if($fnames){
					$names = array_merge($names, explode(',', $fnames));
				}
			}
			foreach($names as $name){
				$index = preg_replace('/\D/', '', $name);
				$field = preg_replace('/.+]/', '', $name);
				$name = substr($field, (int)$index);

				if(isset($_REQUEST[$field])){					
					rs::updateField($name, $_REQUEST[$field], $id);
				}
			}
		}
	}
	
	public function saveFields($controls, $prefix, $id){
		foreach($controls as $control){
			if(is_array($control)){
				$control['name_prefix'] = (string)$prefix;
				$name = $this->serializeName($control['name'], $control['name_prefix']);
				if(isset($_POST[$name])){
					rs::updateField($control['name'], $_POST[$name], $id, $control['type']);
				}
				elseif(isset($control['controls']) && is_array($control['controls'])){
					$this->saveFields($control['controls'], $prefix, $id);
				}
			}
		}
	}
	
	public function addMetaBox($current_post_type, $post){
		global $current_user;
		if(static::$configs){
			foreach(static::$configs as $options){
				$match = false;
				$client_rules = array();
				foreach($options['rules'] as $rules){
					
					$okey = $this->checkRule(implode('&', $current_user->roles), $rules['logged_user_role']) 
							&& $this->checkRule($current_post_type, $rules['post_type'], true) 
							&& $this->checkRule($post->ID, $rules['post_id']);
					$client_rule = array();
					
					if($okey && $rules['page_type'] && is_post_type_hierarchical($current_post_type)){
						
						$current_page_type = 'top_level&child_page';
						
						if(get_pages(array('number' => 1, 'post_type' => $current_post_type, 'parent' => $post->ID))){
							$current_page_type .= '&parent';
						}
						if(get_option('page_on_front') == $post->ID){
							$current_page_type .= '&page_on_front';
						}
						if(get_option('page_for_posts') == $post->ID){
							$current_page_type .= '&page_for_posts';
						}
						$okey = $this->checkRule($current_page_type, $rules['page_type']);
					}
					if($okey){
						foreach(array('page_type', 'page_template', 'post_format', 'page_parent', 'term_id') as $clientkey){
							if($rules[$clientkey]) $client_rule[$clientkey] = $rules[$clientkey];
						}
						if($client_rule) $client_rules[] = $client_rule;

						$match = $match || $okey;
					}
				}
				if($match){
					if($client_rules){	
						$metabox_logic = rs::getJSData('metabox-logic');
						$metabox_logic[$options['wrap_id']] = $client_rules;
						rs::setJSData('metabox-logic', $metabox_logic);
					}
					$this->addConditionalLogic($options);
					add_meta_box( 
						$options['wrap_id'],
						$options['title'],
						array($this, 'renderMetaBox'),
						$current_post_type,
						$options['context'],
						$options['priority'],
						$options
					);
				}
				else{
				}
			}
		}
	}
	
	public function renderMetaBox($post, $args){
		$options = $args['args'];
		
		?>
		<div id="<?php echo esc_attr($options['field_id']) ?>" class="rs-metabox layout-<?php echo esc_attr($options['layout']) ?> <?php echo esc_attr($options['css_class']) ?>">
			<?php
			if($options['layout'] == 'single'){
				$this->renderSingleLayout($post, $options);
			}
			else if($options['layout'] == 'row'){
				$this->renderRowLayout($post, $options);
			}
			else if($options['layout'] == 'table'){
				$this->renderTableLayout($post, $options);
			}
			else{
				$this->renderNoneLayout($post, $options);
			}
			$names = $this->getFieldsName($options['controls']);
			?>
			<input type="hidden" name="rs_meta_names[]" value="<?php echo implode(',', $names) ?>"/>
		</div>
		<?php
	}
	
	public function renderScripts($options, $for = null, $id = null){
		foreach($options['controls'] as $control){ 
			if($control['type'] == 'script'){
				$control['render_by'] = 'metabox';
				$control['render_for'] = $for;
				$control['render_object_id'] = $id;
				rs::renderControl($control);
			}
		}
	}
	
	public function renderSingleLayout($post, $options){
		$control = $options['controls'][0];
		if($control['type'] != 'script'){
			$control['value'] = $this->getPostField($control['name'], $post->ID);
			if($options['name_prefix']) $control['name_prefix'] = $options['name_prefix'];
			$this->renderControl($control, 'post', $post->ID);
		}
		else{
			$control['render_by'] = 'metabox';
			$control['render_for'] = 'post';
			$control['render_object_id'] = $post->ID;
			rs::renderControl($control);
		}
	}

	public function renderRowLayout($post, $options){
		?>
		<table class="rs-table">
			<tbody>
			<?php 
				foreach($options['controls'] as $control){ 
					if($control['type'] == 'script') continue;
					
					$control['value'] = $this->getPostField($control['name'], $post->ID);
					?>
					<tr class="row" id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
						<td class="label">
							<label><?php echo force_balance_tags($control['label']) ?></label>
							<?php if($control['description']) { ?><p class="description"><?php echo force_balance_tags($control['description']) ?></p><?php } ?>
						</td>
						<td><?php $this->renderControl($control, 'post', $post->ID); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php
		
		$this->renderScripts($options);
	}

	public function renderTableLayout($post, $options){
		?>
		<table class="rs-table">
			<thead>
				<tr>
					<?php 
					foreach($options['controls'] as $control){
						if($control['type'] == 'script') continue;
						
						?>
						<th class="label">
							<label><?php echo force_balance_tags($control['label']) ?></label>
							<?php if($control['description']) { ?><p class="description"><?php echo force_balance_tags($control['description']) ?></p><?php } ?>
						</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php 
					foreach($options['controls'] as $control){ 
						if($control['type'] == 'script') continue;
						
						$control['value'] = $this->getPostField($control['name'], $post->ID);
						?>
						<td><div id="<?php echo esc_attr($control['conditional_logic_id']) ?>"><?php $this->renderControl($control, 'post', $post->ID); ?></div></td>
					<?php } ?>
				</tr>
			</tbody>
		</table>
		<?php
		
		$this->renderScripts($options);
	}

	public function renderNoneLayout($post, $options){
		foreach($options['controls'] as $control){ 
			if($control['type'] == 'script') continue;

			$control['value'] = $this->getPostField($control['name'], $post->ID);
			?>
			<div id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
				<p class="label">
					<label><?php echo force_balance_tags($control['label']) ?></label>
					<?php if($control['description']) { ?><p class="description"><?php echo force_balance_tags($control['description']) ?></p><?php } ?>
				</p>
				<?php $this->renderControl($control, 'post', $post->ID); ?>
			</div>
		<?php } 
		
		$this->renderScripts($options);
	}

	public function savePost($post_id){
		$post_id = isset($_GET['post_ID']) ? $_GET['post_ID'] : 0;
		if(static::$configs){
			foreach(static::$configs as $options){
				$this->saveFields($options['controls'], $options['name_prefix'], $post_id);
			}
			do_action('rs_save_fields', static::$configs, 'post', $post_id);
		}
		else{
			$this->saveFieldsAjax('post_' . $post_id);
			do_action('rs_save_fields', null, 'post', $post_id);
		}
	}
	
	public function addTaxonomyFields(){
		$taxonimies = get_taxonomies();
		if($taxonimies && static::$configs){
			foreach($taxonimies as $tax){
				add_action("{$tax}_edit_form_fields", array($this, 'addTermFields'));
				add_action("{$tax}_add_form_fields", array($this, 'addTermFields'));
			}
		}
	}
	
	public function addTermFields($term){
		global $current_user;
		if(is_string($term)){
			$new_term = new stdClass;
			$new_term->taxonomy = $term;
			$new_term->term_id = 0;
			$term= $new_term;
		}
		foreach(static::$configs as $options){
			$match = false;
			foreach($options['rules'] as $rules){
				$match = $match || ($this->checkRule(implode('&', $current_user->roles),  $rules['logged_user_role'])
									&& $this->checkRule($term->taxonomy, $rules['taxonomy'], true) 
									&& $this->checkRule($term->term_id, $rules['term_id']));
			}
			if($match){
				$this->renderTermFields($term, $options);
			}
		}
	}
	
	public function renderTermFields($term, $options){
		$term_id = $term->term_id;
		$term_metas = $this->getTermFields($term_id);
		$this->addConditionalLogic($options, false);
	
		if(isset($_GET['action']) && $_GET['action'] == 'edit'){ 
			?></table><table class="form-table" id="<?php echo esc_attr($options['field_id']) ?>"><?php
		}
		else{
			?><div id="<?php echo esc_attr($options['field_id']) ?>"><?php
		}
		
		foreach($options['controls'] as $control){
			if($control['type'] == 'script') continue;
			
			$name = $control['name'];
			$control['value'] = isset($term_metas[$name]) ? $term_metas[$name] : null;
			
			if(isset($_GET['action']) && $_GET['action'] == 'edit'){ ?>
				<tr class="form-field" id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
					<th valign="top" scope="row">
						<label for="<?php echo rs::generateId($name) ?>"><?php echo force_balance_tags($control['label']); ?></label>
					</th>
					<td>
						<?php $this->renderControl($control, 'term', $term_id) ?>
						<p class="description"><?php echo force_balance_tags($control['description']) ?></p>
					</td>
				</tr>
			<?php } else { ?>
				<div class="form-field" id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
					<label for="<?php echo rs::generateId($name) ?>"><?php echo force_balance_tags($control['label']); ?></label>
					<?php $this->renderControl($control, 'term', $term_id) ?>
					<p class="description"><?php echo force_balance_tags($control['description']) ?></p>
				</div>
			<?php } 
		}
		
		$names = $this->getFieldsName($options['controls']);
		
		if(isset($_GET['action']) && $_GET['action'] == 'edit'){ 
			?>
			<tr class="form-field">
				<td colspan="2">
					<?php 
						$this->renderScripts($options);
					?>
					<input type="hidden" name="rs_meta_names[]" value="<?php echo implode(',', $names) ?>"/>
				</td>
			</tr>
			<?php 
		} 
		else{
			?></div>
			<input type="hidden" name="rs_meta_names[]" value="<?php echo implode(',', $names) ?>"/>
			<?php
			$this->renderScripts($options);
		}
	}
	
	public function saveTermFields($term_id){
		if(static::$configs){
			foreach(static::$configs as $options){
				$this->saveFields($options['controls'], $options['name_prefix'], 'term_' . $term_id);
			}
			do_action('rs_save_fields', static::$configs, 'term', $term_id);
		}
		else{
			$this->saveFieldsAjax('term_' . $term_id);
			do_action('rs_save_fields', null, 'term', $term_id);
		}
	}
	
	public function addUserFields($user){
		if(static::$configs){
			global $current_user;
			foreach(static::$configs as $options){
				$match = false;
				$roles = array();
				foreach($options['rules'] as $rules){
					$okey = $this->checkRule(implode('&', $current_user->roles), $rules['logged_user_role'])  && $rules['user_role']
							&& ($current_user->ID != $user->ID || $this->checkRule(implode('&', $user->roles) . '&all', $rules['user_role'], true));
					$match = $match || $okey;
					if($okey){
						$roles[] = array('user_role' => $rules['user_role']);
					}
				}
				if($match){
					$this->renderUserFields($user, $options, $roles);
				}
			}
		}
	}
	
	public function addNewUserFields($user){
		if(static::$configs){
			global $current_user;
			foreach(static::$configs as $options){
				$match = false;
				$roles = array();
				foreach($options['rules'] as $rules){
					$okey = $this->checkRule(implode('&', $current_user->roles), $rules['logged_user_role']) && $rules['user_role']
							&& (!is_multisite() || $this->checkRule(true, $rules['new_user_form_on_multisite']));
					$match = $match || $okey;
					if($okey){
						$roles[] = array('user_role' => $rules['user_role']);
					}
				}
				if($match){
					if(is_multisite()){
						$options['field_id'] = $options['field_id'] . '-' . uniqid();
					}
					$this->renderUserFields(null, $options, $roles);
				}
			}
		}
	}
	
	public function renderUserFields($user, $options, $roles){
		$metabox_logic = rs::getJSData('metabox-logic');
		$metabox_logic[$options['field_id']] = $roles;
		rs::setJSData('metabox-logic', $metabox_logic);
		$this->addConditionalLogic($options, false);
		?>
		<div id="<?php echo esc_attr($options['field_id']) ?>" class="rs-metabox rs-user-meta <?php echo esc_attr($options['css_class']) ?>">
			<?php if(!empty($options['title'])) { ?><h3><?php echo esc_attr($options['title']);?></h3><?php } ?>
			<table class="form-table">
			<?php
			$names = $this->getFieldsName($options['controls']);
		
			foreach($options['controls'] as $control){
				if($control['type'] == 'script') continue;
				$control['value'] = $user ? $this->getUserField($control['name'], $user->ID) : '';

				?>
					<tr id="<?php echo esc_attr($control['conditional_logic_id']) ?>">
						<th>
							<label for="<?php echo rs::generateId($control['name_prefix'] . $control['name']) ?>"><?php echo force_balance_tags($control['label']); ?></label>
						</th>
						<td>
							<?php $this->renderControl($control, 'user', $user->ID) ?>
							<p class="description"><?php echo force_balance_tags($control['description']) ?></p>
						</td>
					</tr>
				<?php
			}
			?>
			</table>
			<input type="hidden" name="rs_meta_names[]" value="<?php echo implode(',', $names) ?>"/>
		</div>
		<?php
		$this->renderScripts($options);
	}
	
	public function saveUserFields($user_id){
		if(static::$configs){
			foreach(static::$configs as $options){
				foreach($options['controls'] as $control){
					$this->saveFields($options['controls'], $options['name_prefix'], 'user_' . $user_id);
				}
			}
			do_action('rs_save_fields', static::$configs, 'user', $user_id);
		}
		else{
			$this->saveFieldsAjax('user_' . $user_id);
			do_action('rs_save_fields', null, 'user', $user_id);
		}
	}

}

$RsMetaBox = new RsMetaBox;

add_action('add_meta_boxes', array($RsMetaBox, 'addMetaBox'), 1000, 2);
add_action('save_post', array($RsMetaBox, 'savePost'), 1);

add_action("admin_head", array($RsMetaBox, 'addTaxonomyFields'), 1000);
add_action("created_term", array($RsMetaBox, 'saveTermFields'), 1000);
add_action("edited_term", array($RsMetaBox, 'saveTermFields'), 1000);

add_action( 'show_user_profile', array($RsMetaBox, 'addUserFields'), 1000);
add_action( 'edit_user_profile', array($RsMetaBox, 'addUserFields'), 1000);
add_action( 'user_new_form', array($RsMetaBox, 'addNewUserFields'), 1000);
add_action( 'personal_options_update', array($RsMetaBox, 'saveUserFields'), 1000);
add_action( 'edit_user_profile_update', array($RsMetaBox, 'saveUserFields'), 1000);
add_action( 'user_register', array($RsMetaBox, 'saveUserFields'), 1000);
