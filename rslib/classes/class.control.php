<?php

class RsControl{
	public $default = array();
	public $baseoptions = array(
		'type' => 'untyped',
		'name' => 'noname',
		'name_prefix' => null,
		'field_id' => null,
		'wrap_id' => null,
		'value' => null,
		'default_value' => null,
		'required' => false,
		'css_class' => null,
		'render_by' => null,
		'render_for' => null,
		'render_object_id' => null,
		'conditional_logic' => null,
		'conditional_logic_id' => null
	);
	
	public function addControl($name, $type = null){
		return rs::addControl($name, $type, get_class($this));
	}
	
	public function parseOptions($options){
		if(is_array($options)){
			$options = array_merge($this->baseoptions, $this->default, $options);
			$options['label'] = !empty($options['label']) ? $options['label'] : $options['name'];
			$options['description'] = isset($options['description']) ? $options['description'] : null;
			$options['value'] = $this->parseValue($options['value'], $options['default_value']);
			$options['field_name'] = $options['name_prefix'] . $options['name'];
			if(empty($options['field_id'])){
				$options['field_id'] = rs::generateId($options['field_name']);
			}
			if(empty($options['wrap_id'])){
				$options['wrap_id'] = $options['field_id'] . '-wrap';
			}
			if(isset($options['multiple']) && $options['multiple']){
				$options['multiple'] = 'multiple '; 
				$options['field_name'] = $options['field_name'] . '[]';
			}
			$options['required'] = $options['required'] ? 'required ' : false; 
			$options['parsed'] = true;
			return $options;
		}
		return false;
	}
	
	public function parseValue($value, $default = null){
		return ($value === null || $value === RS_NOT_SET) ? $default : $value;
	}

	
	public function render(){}
	public function loadFiles(){}
	
	public function renderError($message = null){
		if($message === null){
			$message = 'Render control for ' . get_class($this) . ' error. Please check your options.';
		}
		echo '<div class="rs-render-error">' . esc_html($message) . '</div>';
	}
		
	public function convertRules($rules, $remove_null_rule = true){
		$data = array();
		foreach($rules as $key=>$value){
			if(is_string($key)){
				if($remove_null_rule && $value === null){
					continue;
				}
				$logic = array();
				if(strpos($key, ':not')){
					$key = trim(str_replace(':not', '', $key));
					$logic['not'] = ((string)$value);
				}
				else{
					$logic['equal'] = ((string)$value);
				}
				if(strpos($key, ':i')){
					$key = trim(str_replace(':i', '', $key));
					$logic['i'] = true;
				}
				$data[$key] = isset($data[$key]) ? array_merge($logic, $data[$key]) : $logic;
			}
		}
		return $data;
	}
	
	public function addConditionalLogic($options, $no_wrap = false){
		$logic_id = $options['conditional_logic_id'];
		$wrap_id = $no_wrap ? $options['field_id'] : $logic_id ? $logic_id : $options['wrap_id'];
		$logic = $options['conditional_logic'];
		$control_name = $options['name'];
		if($options['type'] == 'checkbox' && count($options['items']) > 1){
			self::addFieldReferent($options['name'], $options['field_name'] . '[]');
		}
		else{
			self::addFieldReferent($options['name'], $options['field_name']);
		}
		if(is_array($logic)){
			if(!is_array(reset($logic))){
				$logic = array($logic);
			}
			$this_data = array();
			foreach($logic as $i=>$rules){
				$new_rules = array();
				foreach($rules as $name=>$value){
					if(strpos($name, '.')){
						$names = explode('.', $name);
						$name = '';
						$base = array_shift($names);
						if(preg_match("/$base\[(\d+|rsrowindex)\]/", $control_name, $match)){
							$name .= $match[0];
						}
						else{
							$name .= $base;
						}
						while(count($names)){
							$base = array_shift($names);
							if(preg_match("/\[$base\]\[(\d+|rsrowindex)\]/", $control_name, $match)){
								$name .= $match[0];
							}
							else{
								$name .= '[' . $base . ']';
							}
						}
					}
					$new_rules[$name] = $value;
				}
				
				if($rules = self::convertRules($new_rules)){
					$this_data[] = $rules;
				}
			}
			if($this_data){
				$data = rs::getJSData('conditional-logic');
				$i = 1;
				while(!$logic_id && isset($data[$wrap_id])){
					$wrap_id = $wrap_id . '-' . $i++;
				}
				$data[$wrap_id] = $this_data;
				rs::setJSData('conditional-logic', $data);
				
				if(rs::isAjax()){
					echo "<script> rs.addConditionalLogic('".$wrap_id."', ".json_encode($this_data)."); </script>";
				}
			}
		}
		return $logic_id ? $options['wrap_id'] : $wrap_id;
	}
	
	public function addFieldReferent($name, $fieldname){
		if($name != $fieldname && $fieldname){
			$referent = rs::getJSData('field-referent');
			$referent[$name] = $fieldname;
			rs::setJSData('field-referent', $referent);
		}
	}
	
	
	public function getField($name, $post_id = null, $output = null){
		global $post;
		if(empty($post_id) && $post){
			$post_id = $post->ID;
		}
		
		if(is_numeric($post_id)){
			return self::getPostField($name, $post_id);
		}
		if($post_id && is_string($post_id)){
			if(stripos($post_id, 'post') !== false){
				return self::getPostField($name, str_ireplace('post_', '', $post_id));
			}
			elseif(stripos($post_id, 'category') !== false){
				return self::getCatField($name, str_ireplace('category_', '', $post_id));
			}
			elseif(stripos($post_id, 'user') !== false){
				return self::getUserField($name, str_ireplace('user_', '', $post_id));
			}
			elseif(stripos($post_id, 'option') !== false){
				return self::getOption($name, false);
			}
			elseif(stripos($post_id, 'term') !== false){
				$term = explode("_", $post_id);
				return self::getTermField($name, $term[1]);
			}
			elseif($post){
				$output = $post_id;
				return self::getPostField($name, $post->ID);
			}
		}
		
		return rs::message('Please check post_id parameter and/or post object.', get_class($this) . '::getField');
	}
	
	public function getPostField($name, $post_id){
		return get_post_meta($post_id, RS_META_KEY_PREFIX . $name) ? get_post_meta($post_id, RS_META_KEY_PREFIX . $name, true) : null;
	}
	
	public function getPostFields($post_id){
		$values = get_post_meta($post_id);
		if(is_array($values)){
			if(RS_META_KEY_PREFIX){
				$result = array();
				foreach($values as $key=>$value){
					if(strpos($key, RS_META_KEY_PREFIX) === 0){
						$result[str_replace(RS_META_KEY_PREFIX, '', $key)] = maybe_unserialize($value);
					}
				}
				return $result;
			}
			return $values;
		}
		return array();
	}
	
	public function getCatField($name, $cat_id){
		return self::getTermField($name, $cat_id);
	}
	
	public function getCatFields($cat_id){
		return self::getTermFields($cat_id);
	}
	
	public function getTermField($name, $term_id){
		$term_metas = get_option(RS_META_KEY_PREFIX . "taxonomy_{$term_id}_rs_metas");
		if($term_metas && isset($term_metas[$name])){
			$value = $term_metas[$name];
			return $value;
		}
		return null;
	}
	
	public function getTermFields($term_id){
		$term_metas = get_option(RS_META_KEY_PREFIX . "taxonomy_{$term_id}_rs_metas");
		return is_array($term_metas) ? $term_metas : array();
	}
	
	public function getUserField($name, $user_id){
		return get_user_meta($user_id, RS_META_KEY_PREFIX . $name) ? get_user_meta($user_id, RS_META_KEY_PREFIX . $name, true) : null;
	}
	
	public function getUserFields($user_id){
		$values = get_user_meta($user_id);
		if(is_array($values)){
			if(RS_META_KEY_PREFIX){
				$result = array();
				foreach($values as $key=>$value){
					if(strpos($key, RS_META_KEY_PREFIX) === 0){
						$result[str_replace(RS_META_KEY_PREFIX, '', $key)] = maybe_unserialize($value);
					}
				}
				return $result;
			}
			return $values;
		}
		return array();
	}
	
	public function getOption($name, $default = null){
		return get_option(RS_META_KEY_PREFIX . $name, $default);
	}
	
	public function updateField($name, $value, $post_id = null){
		if(!$post_id){
			global $post;
			$post_id = $post->ID; 
		}
		if(is_numeric($post_id)){
			return self::updatePostField($name, $value, $post_id);
		}
		else if(is_string($post_id)){
			if(stripos($post_id, 'post') !== false){
				return self::updatePostField($name, $value, str_ireplace('post_', '', $post_id));
			}
			elseif(stripos($post_id, 'category') !== false){
				return self::updateCatField($name, $value, str_ireplace('category_', '', $post_id));
			}
			elseif(stripos($post_id, 'user') !== false){
				return self::updateUserField($name, $value, str_ireplace('user_', '', $post_id));
			}
			elseif(stripos($post_id, 'option') !== false){
				return self::updateOption($name, $value);
			}
			else{
				$term = explode("_", $post_id);
				return self::updateTermField($name, $value, $term[1]);
			}
		}
		else{
			return rs::message('Type of $post_id parameter is invalid.', get_class($this) . '::updateField', true);
		}
	}
	
	public function updatePostField($name, $value, $post_id){
		return update_post_meta($post_id, RS_META_KEY_PREFIX . $name, $value);
	}
	
	public function updateCatField($name, $value, $cat_id){
		return updateTermField($name, $value, $cat_id);
	}
	
	public function updateTermField($name, $value, $term_id){
		if($name){
			$term_metas = get_option(RS_META_KEY_PREFIX . "taxonomy_{$term_id}_rs_metas");
			if (!is_array($term_metas)) {
				$term_metas = Array();
			}
			if(is_string($value)){
				$value = str_replace("\'", "'", $value);
				$value = str_replace('\"', '"', $value);
			}
			$term_metas[$name] = $value;
			
			return update_option(RS_META_KEY_PREFIX . "taxonomy_{$term_id}_rs_metas", $term_metas );
		}
		else{
			return update_option(RS_META_KEY_PREFIX . "taxonomy_{$term_id}_rs_metas", $value );
		}
	}
	
	public function updateUserField($name, $value, $user_id){
		return update_user_meta($user_id, RS_META_KEY_PREFIX . $name, $value);
	}
	
	public function updateOption($name, $value){
		return update_option(RS_META_KEY_PREFIX . $name, $value);
	}
}
