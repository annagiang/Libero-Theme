<?php 
class RsFile extends RsControl{
	public $default = array(
		'name' => 'file',
		'type' => 'file',
		'max_files' => -1,
		'post_id' => 0,  				// only for upload_to == media
		'display' => 'thumbnail', 		// thumbnail | details
		'extensions' => '*',			// * | png,jpg,bmp,txt,doc,xls 
		'allow_drag_drop' => false,
		'upload_to' => 'media', 		// media | uploads | custom
		'custom_upload_path' => null,
		'auto_start' => true,			// be careful
		'multiple' => true,
		'width' => null,
		'callback' => array(),			// like $default_callback
		'js_callback' => array(),			// like $default_callback
		'browse_text' => 'Select Files',
		'custom_class'	=> 'rs-button'
	);
	
	public $default_callback = array(
		'added_callback' => null,
		'added_parameter' => null,
		'removed_callback' => null,
		'removed_parameter' => null
	);
	
	public function RsFile(){
		$this->addControl('file', 'file');
		$this->addControl('fileupload', 'file');
	}
	
	public function getFiles(){
		wp_enqueue_script('plupload-all');
		rs::loadScript('rs-file-upload', RS_LIB_URL . '/controls/upload-file/upload-file.min.js', true);
		rs::loadStyle('rs-file-upload', RS_LIB_URL . '/controls/upload-file/upload-file.min.css');
	}
	
	public function parseOptions($options){
		if(!$options = parent::parseOptions($options)){
			return false;
		}
		
		if(!is_array($options['callback'])){
			$options['callback'] = array();
		}
		
		if(!is_array($options['js_callback'])){
			$options['js_callback'] = array();
		}
		
		$options['callback'] = array_merge($this->default_callback, $options['callback']);
		$options['js_callback'] = array_merge($this->default_callback, $options['js_callback']);
		
		$options['field_name'] = str_replace('[]', '', $options['field_name']);
		
		if(!is_array($options['value'])){
			$options['value'] = array();
		}
		
		if(!is_int($options['max_files']) || $options['max_files'] == -1){
			$options['max_files'] = 9999;
		}

		$plupload_init = array(
			'runtimes' => 'html5,silverlight,flash,html4',
			'browse_button' => $options['field_id'] . '-button',
			'container' => $options['wrap_id'],
			'id' => $options['field_id'],
			'drop_element' => $options['allow_drag_drop'] ? $options['field_id'] . '-browser' : '',
			'file_data_name' => $options['field_name'], 
			'url' => admin_url('admin-ajax.php'),
			'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
			'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
			'max_file_size' => wp_max_upload_size() . 'b',
			'filters' => array(
				array('title' =>'Allowed Files', 'extensions' => $options['extensions'])
			),
			'multiple_queues' => true,
			'multipart' => true,
			'multi_selection' => $options['multiple'],
			'urlstream_upload' => true,

			'multipart_params' => array(
				'security' => wp_create_nonce('rs-upload-nonce'), 
				'action' => 'rs_file_upload', 
				'field_name' => $options['field_name'],
				'control_name' => $options['name'],
				'post_id' => $options['post_id'],
				'upload_to'=> $options['upload_to'],
				'callback' => json_encode($options['callback']),
				'render_by' => $options['render_by'],
				'custom_upload_path' => $options['custom_upload_path']
			),
			'js_callback' => $options['js_callback'],
			'auto_start' => $options['auto_start'],
			'max_files' => $options['max_files']
		);
		
		$options['config'] = json_encode($plupload_init);
		
		return $options;
	}
	
	public function parseID($id){
		if(is_array($id)){
			return $id['id'];
		}
		return (int)$id;
	}
	
	public function getItem($id){
		$attachment = get_post($id);
		if($attachment){
			$item = array();
			$path = rs::urlToPath($attachment->guid);
			if(file_exists($path)){
				$item['url'] = $attachment->guid;
				$item['id'] = $id;
				$item['title'] = $attachment->post_title;
				$item['nonce'] = wp_create_nonce('rs-upload-nonce-' . $id);
				if($attachment->post_type == 'rsfile'){
					$data = json_decode($attachment->post_content, true);
					$item['thumbnail'] = $data['thumbnail'];
					$item['size'] = $data['size'];
					$item['location'] = $data['location'];
					$item['ext'] = $data['ext'];
					$item['type'] =  $attachment->post_mime_type;
				}
				elseif($attachment->post_type == 'attachment'){
					$thumbnail = @wp_get_attachment_image_src($id, 'thumbnail', true);
					$type = wp_check_filetype($attachment->guid);
					$item['thumbnail'] = $thumbnail ? $thumbnail[0] : includes_url('/images/crystal/default.png');
					$item['size'] = filesize(get_attached_file( $attachment->ID ));
					$item['location'] = 'media';
					$item['type'] = $type['type'];
					$item['ext'] = $type['ext'];
				}
				return $item;
			}
		}
		return null;
	}
	
	/*
		output: thumbnail | url | size | location | type | id | full
	*/
	public function getField($name, $post_id = null, $output = null){
		$values = parent::getField($name, $post_id, $output);
		
		$output = strtolower($output);
		
		if(is_array($values)){
			$result = array();
			$ids = array();
			foreach($values as $id){
				$item = $this->getItem($id);
				if($item){
					if(!empty($output) && $output != 'full' && $output != 'object' && $output != 'array'){
						$result[] = isset($item[$output]) ? $item[$output] : null;
					}
					else{
						$result[] = $item;
					}
					$ids[] = $id;
				}
			}
			parent::updateField($name, $ids, $post_id);
			return $result;
		}
		elseif($values){
			$item = $this->getItem($values);
			if($item){
				if(!empty($output) && $output != 'full' && $output != 'object' && $output != 'array'){
					return isset($item[$output]) ? $item[$output] : null;
				}
				else{
					return $item;
				}
			}
		}
		return false;
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->getFiles();
		
		$wrapid = $this->addConditionalLogic($options);
		
		if($options['max_files'] == 0){
			return;
		}
		
		if(is_numeric($options['width'])){
			$options['width'] .= 'px';
		}
		
		if($options['allow_drag_drop']){
			$options['css_class'] .= ' allow-drag-drop';
		}

		$options['display'] = $options['display'] == 'thumbnail' ? 'thumbnail' : 'details';
		$wstyle = $options['width'] ? "width: {$options['width']}" : "";
		
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-fileupload <?php echo esc_attr($options['css_class']) ?>" data-name="<?php echo esc_attr($options['field_name']) ?>" style="<?php echo esc_attr($wstyle) ?>">
			<ul class="uploaded-list display-<?php echo esc_attr($options['display']) ?> <?php echo isset($options['value']) ? 'has-file' : '' ?>">
				<?php foreach($options['value'] as $val){
					$id = $this->parseID($val);
					if($item = $this->getItem($id)){
						$image = strpos($item['type'], 'image') !== false && strpos($item['thumbnail'], 'default.png') === false;
						$class = $image ? 'has-thumbnail' : '';
						?>
						<li id="rs-file-<?php echo esc_attr($id) ?>" class="rs-file <?php echo esc_attr($class) ?>" title="<?php echo esc_attr($item['title'] . ' | ' . $item['ext'] . ' | ' . static::formatSize($item['size'])) ?>">
							<a href="<?php echo esc_url($item['url']) ?>" target="blank"><img class="file-image" src="<?php echo esc_url($item['thumbnail']) ?>"/></a>
							<a href="<?php echo esc_url($item['url']) ?>" target="blank" class="file-name"><?php echo esc_html($item['title']) ?></a>
							<span class="file-ext"><?php echo esc_html($item['ext']) ?></span>
							<span class="file-size"><?php echo static::formatSize($item['size']) ?></span>
							<a class="remove-file" data-security="<?php echo esc_attr($item['nonce']) ?>" title="Remove this file."></a>
							<input class="file-id" type="hidden" name="<?php echo esc_attr($options['field_name']) ?>[]" value="<?php echo esc_attr($id) ?>"/>
						</li>
					<?php }
				} ?>
			</ul>
			<ul class="pending-list"></ul>
			<div class="upload-browser" id="<?php echo esc_attr($options['field_id']) ?>-browser">
				<a class="<?php echo esc_attr($options['custom_class']) ?>" id="<?php echo esc_attr($options['field_id']) ?>-button"><?php echo esc_html($options['browse_text']) ?></a>
				<?php
					if($options['allow_drag_drop']){
						echo '<p>(Or drop files here to upload)</p>';
					}
				?>
			</div>
			<script type="text/rsdata" class="rs-data"><?php echo ($options['config']) ?></script>
		</div>
		<?php
	}
	
	public static function formatSize($size)
	{
		$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$power = $size > 0 ? floor(log($size, 1024)) : 0;
		return number_format($size / pow(1024, $power), 0) . ' ' . $units[$power];
	}
	
	public function generateThumbnail($url, $path, $type){
		if(strpos($type , "image") !== false){
			$image = wp_get_image_editor($path);
			if (!is_wp_error($image)) {
				$image->resize( 150, 150, true );
				$thumbnail = $image->generate_filename('150x150');
				$image->save($thumbnail);
				$thumbnail = rs::pathToUrl($thumbnail);
			}
			else{
				$thumbnail = $url;
			}
		}
		else{	
			$thumbnail = rs::getIcon($path);
		}
		return $thumbnail;
	}
	
	public function metaboxAutoSave($name, $id){
		$params = rs::parseParams(rs::referentUrl());
		if(isset($params['post'])){
			$field = $params['post'];
		}
		elseif(isset($params['tag_ID'])){
			$field = 'term_' . $params['tag_ID'];
		}
		elseif(isset($params['user_id'])){
			$field = 'user' . $params['user_id'];
		}
		if(isset($field)){
			$files = rs::getField($name, $field);
			if(!is_array($files)) $files = array();
			$files[] = $id;
			rs::updateField($name, $files, $field);
		}
	}
		
	public function uploadFile(){
		check_ajax_referer( 'rs-upload-nonce', 'security' );
		
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		
		$upload_to = $_POST['upload_to'];
		$upload_path = $_POST['custom_upload_path'];
		$name = $_POST['field_name'];
		$control_name = $_POST['control_name'];
		$post_id = $_POST['post_id'];
		$callback = json_decode(stripslashes($_POST['callback']));
		$metabox =  $_POST['render_by'] == 'metabox';
		
		global $current_user;
		
		if($_FILES[$name]){
			if($upload_to == 'media'){
				$id = media_handle_upload( $name, $post_id );
				if( is_wp_error($id)){
					echo json_encode(array(
						'success' => false,
						'message' => $id->get_error_message()
					));
				}
				else{
					$url = wp_get_attachment_url($id);
					$thumbnail = @wp_get_attachment_image_src($id, 'thumbnail', true);
					$thumbnail = $thumbnail ? $thumbnail[0] : includes_url('/images/crystal/default.png');
					$type = wp_check_filetype($url);
					$result = array(
						'success' => true,
						'location' => 'media',
						'thumbnail' => $thumbnail,
						'url' => $url,
						'nonce' => wp_create_nonce('rs-upload-nonce-' . $id),
						'id' => $id,
						'title' => get_the_title($id),
						'type' => $type['type'],
						'size' => $_FILES[$name]['size'],
						'ext' => $type['ext']
					);
					echo json_encode($result);
					if(function_exists($callback->added_callback)){
						call_user_func($callback->added_callback, $result, $callback->added_parameter );
					}
					update_post_meta($id, 'rs-upload', true);
					if($metabox) {
						$this->metaboxAutoSave($control_name, $id);
					}
				}
			}
			elseif($upload_to == 'uploads'){
				$upload_overrides = array( 'test_form' => false );
				$movefile = wp_handle_upload( $_FILES[$name], $upload_overrides );
				if(isset($movefile['error'])){
					echo json_encode(array(
						'success' => false,
						'message' => $movefile['error']
					));
				}
				else{
					$thumbnail = $this->generateThumbnail($movefile['url'], $movefile['file'], $movefile['type']);
					$type = wp_check_filetype($_FILES[$name]['name']);
					$title = str_replace('.' . $type['ext'], '', $_FILES[$name]['name']);
					$post = array(
						'post_type' => 'rsfile',
						'post_title' => $name,
						'post_author' => $current_user->ID,
						'post_content' => json_encode(array(
							'thumbnail' => $thumbnail,
							'size' => $_FILES[$name]['size'],
							'location' => 'uploads',
							'ext' => $type['ext']
						)),
						'guid' => $movefile['url'],
						'post_status' => 'inherit',
						'post_mime_type' => $type['type']
					);
					$id = wp_insert_post($post);
					if($id){
						$result = array(
							'success' => true,
							'location' => 'uploads',
							'thumbnail' => $thumbnail,
							'url' => $movefile['url'],
							'title' => $title,
							'ext' => $type['ext'],
							'type' => $movefile['type'],
							'size' => $_FILES[$name]['size'],
							'id' => $id,
							'nonce' => wp_create_nonce('rs-upload-nonce-' . $id)
						);
						echo json_encode($result);
						if(function_exists($callback->added_callback)){
							call_user_func($callback->added_callback, $result, $callback->added_parameter );
						}
						update_post_meta($id, 'rs-upload', true);
						if($metabox) {
							$this->metaboxAutoSave($control_name, $id);
						}
					}
					else{
						unlink($movefile['file']);
						unlink(rs::urlToPath($thumbnail));
						echo json_encode(array(
							'success' => false,
							'message' => 'System error, please try again.'
						));
					}
				}
			}
			else{
				$upload_path = str_replace(array("\\", "//", "\\\\"), "/", $upload_path);
				$abspath = str_replace("\\", "/", ABSPATH);
				
				if(strpos($upload_path, $abspath) !== false){
					if(!is_dir($upload_path)){
						wp_mkdir_p($upload_path);
					}
					if(is_dir($upload_path)){
						$path_parts = pathinfo($_FILES[$name]['name']);
						$title = $path_parts['filename'];
						$basename = sanitize_title($path_parts['filename']);
						$extension = $path_parts['extension'];
						$path = $upload_path . '/' . $basename . '.' . $extension ;	
						
						$i = 1;
						while(file_exists($path)){
							$path = $upload_path .'/'. $basename . $i . '.' . $extension ;
							$i++;
						}
						
						if(move_uploaded_file($_FILES[$name]["tmp_name"], $path)){
							$url = rs::pathToUrl($path);
							$thumbnail = $this->generateThumbnail($url, $path, $_FILES[$name]['type']);
							$post = array(
								'post_type' => 'rsfile',
								'post_title' => $title,
								'post_author' => $current_user->ID,
								'post_content' => json_encode(array(
									'thumbnail' => $thumbnail,
									'size' => $_FILES[$name]['size'],
									'location' => 'custom',
									'ext' => $extension
								)),
								'guid' => $url,
								'post_status' => 'inherit',
								'post_mime_type' => $_FILES[$name]['type']
							);
							$id = wp_insert_post($post);
							if($id){
								$result = array(
									'success' => true,
									'location' => 'custom',
									'url' => $url,
									'thumbnail' => $thumbnail,
									'type' => $_FILES[$name]['type'],
									'size' => $_FILES[$name]['size'],
									'title' => $title,
									'ext' => $extension,
									'id' => $id,
									'nonce' => wp_create_nonce('rs-upload-nonce-' . $id)
								);
								echo json_encode($result);
								if(function_exists($callback->added_callback)){
									call_user_func($callback->added_callback, $result, $callback->added_parameter );
								}
								update_post_meta($id, 'rs-upload', true);
								if($metabox) {
									$this->metaboxAutoSave($control_name, $id);
								}
							}
							else{
								unlink($path);
								unlink(rs::urlToPath($thumbnail));
								echo json_encode(array(
									'success' => false,
									'message' => 'System error, please try again.'
								));
							}
						}
						else{
							echo json_encode(array(
								'success' => false,
								'message' => 'Cannot upload for some server configuration reason.'
							));
						}
					}
					else{
						echo json_encode(array(
							'success' => false,
							'message' => 'Path does not exist and cannot be created.'
						));
					}
				}
				else{
					echo json_encode(array(
						'success' => false,
						'path' => $upload_path,
						'message' => 'The path is wrong.'
					));
				}
			}
		}
		else{
			echo json_encode(array(
				'success' => false,
				'message' => 'Upload file content is not exist.'
			));
		}
		exit;
	}
	
	public function removeFile(){
		$id = $_POST['id'];
		$callback = json_decode(stripslashes($_POST['callback']));
		check_ajax_referer( 'rs-upload-nonce-' . $id, 'security' );
		echo json_encode(static::deleteFile($id, $callback));
		exit;
	}
	
	public function typeFilter($ext2type){
		$ext2type['photoshop'] = array('psd');
		return $ext2type;
	}
	
	public function iconFilter($icon, $mime){
		if($mime == 'photoshop'){
			return RS_LIB_URL . '/controls/upload-file/icons/photoshop.png';
		}
		return $icon;
	}
	
	public static function deleteFile($id, $callback = null){
		$result = false;
		$attachment = get_post($id);
		if($attachment){
			if($attachment->post_type == 'rsfile'){
				$path = rs::urlToPath($attachment->guid);
				$data = json_decode($attachment->post_content);
				$thumb_path = rs::urlToPath($data->thumbnail);
				if(file_exists($path)){
					$deleted = @unlink($path);
					if(dirname($path) == dirname($thumb_path)){
						$deleted = @unlink($thumb_path) || $deleted;
					}
					if($deleted){
						wp_delete_post( $id, true );
						$result = array(
							'success' => true,
							'id' => $id
						);
						if(function_exists($callback->removed_callback)){
							call_user_func($callback->removed_callback, $id, $callback->removed_parameter);
						}
					}
					else{
						$result = array(
							'success' => false,
							'message' => 'System error, please try again.',
							'id' => $id
						);
					}
				}
				else{
					wp_delete_post( $id, true );
					$result = array(
						'success' => true,
						'id' => $id
					);
				}
			}
			elseif($attachment->post_type == 'attachment'){
				 if(wp_delete_attachment( $id, true ) !== false){
					$result = array(
						'success' => true,
						'id' => $id
					);
					if(function_exists($callback->removed_callback)){
						call_user_func($callback->removed_callback, $id, $callback->removed_parameter);
					}
				 }
				 else{
					$result = array(
						'success' => false,
						'message' => 'System error, please try again.',
						'id' => $id
					);
				 }
			}
		}
		else{
			$result = array(
				'success' => true,
				//'message' => 'The file is not exists.' ,
				'id' => $id
			);
		}
		return $result;
	}
	
	public static function moveFile($id, $new_path, $error = false){
		$attachment = get_post($id);
		if($attachment && $attachment->post_type == 'rsfile'){
			$new_path = str_replace(array("\\", "//", "\\\\"), "/", $new_path);
			$abspath = str_replace("\\", "/", ABSPATH);
			
			if(strpos($new_path, $abspath) !== false){
				if(!is_dir($new_path)){
					wp_mkdir_p($new_path);
				}
				$data = json_decode($attachment->post_content, true);
				$old_file_path = rs::urlToPath($attachment->guid);
				$old_thumb_path = rs::urlToPath($data['thumbnail']);
				
				$path_parts = pathinfo($old_file_path);
				$basename = $path_parts['basename'];
				$new_file_path = $new_path . '/' . $basename;
				
				$move_thumb = dirname($old_file_path) == dirname($old_thumb_path);
				
				if($move_thumb){
					$path_parts = pathinfo($old_thumb_path);
					$basename = $path_parts['basename'];
					$new_thumb_path = $new_path . '/' . $basename;
				}
				
				if($old_file_path != $new_file_path){
					if(rename($old_file_path, $new_file_path)){
						if($move_thumb){
							rename($old_thumb_path, $new_thumb_path);
							$data['thumbnail'] = rs::pathToUrl($new_thumb_path);
						}
						
						$attachment->post_content = json_encode($data);
						
						if(wp_update_post($attachment)){
							global $wpdb;
							$guid = rs::pathToUrl($new_file_path);
							$wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET guid = %s WHERE ID = %d", esc_sql($guid), esc_sql($id) ));
							return true;
						}
						else{
							//roll back
							if($move_thumb){
								rename($new_thumb_path, $old_thumb_path);
							}
							rename($new_file_path, $old_file_path);
							$msg = "Cannot update attachment information.";
						}
					}
					else{
						$msg = "Cannot move this file, please check your path";
					}
				}
				else{
					$msg = "Please choose a different path not be the current path.";
				}
			}
			else{
				$msg = "The path is wrong.";
			}
		}
		else{
			$msg = "The attachment was not uploaded to custom path.";
		}
		return $error ? array('error' => true, 'message' => $msg) : false;
	}
	
}
$RsFile = new RsFile;
add_action('wp_ajax_rs_file_upload', array($RsFile, 'uploadFile'));
add_action('wp_ajax_nopriv_rs_file_upload', array($RsFile, 'uploadFile'));
add_action('wp_ajax_rs_file_upload_remove', array($RsFile, 'removeFile'));
add_action('wp_ajax_nopriv_rs_file_upload_remove', array($RsFile, 'removeFile'));
add_filter('ext2type', array($RsFile, 'typeFilter'));
add_filter('wp_mime_type_icon', array($RsFile, 'iconFilter'), 0, 2);