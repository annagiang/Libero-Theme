<?php
/// Upload Control - Render Script And HTML ////

class RsUpload extends RsControl{
	public $default = array(
		'name' => 'upload', 
		'type' => 'image',
		'title' => '', 
		'edit_title' => '', 
		'buttons' => array(), 
		'show_input' => true,
		'max_height' => 'auto',
		'ask_sideload' => true
	);
	
	public $buttons_default = array(
		'insert_text' => 'Insert', 
		'update_text' => 'Update', 
		'browse_text' => ''
	);
	
	public function RsUpload(){
		$this->addControl('upload', array('media', 'image', 'video', 'audio'));
	}

	public function updateField($name, $value, $post_id = null){
		$value = $this->parseValue($value);
	
		if($value['id']){
			$value = $value['id'];
		}
		else{
			$value = $value['url'];
		}
		parent::updateField($name, $value, $post_id);
	}
	
	public function getField($name, $post_id = null, $output = null){
		$value = parent::getField($name, $post_id, $output);
		$result = array('id' => 0, 'url' => '');
		
		if(is_numeric($value)){
			$result = wp_prepare_attachment_for_js($value);
			if(!$result) {
				$result = array('id' => 0, 'url' => '');
			}
		}
		else if(is_string($value)){
			$result['url'] = $value;
		}
		
		$output = strtolower($output);
		
		if($output == 'thumbnail'){
			if(isset($result['sizes']) && isset($result['sizes']['thumbnail'])){
				return $result['sizes']['thumbnail']['url'];
			}
			return $result['url'];
		}
		
		if(!empty($output) && $output != 'full' && $output != 'object' && $output != 'array'){
			return isset($result[$output]) ? $result[$output] : null;
		}

		return $result;
	}
	
	public function parseValue($value, $default = null){
		if(is_numeric($value)){
			$value = array('id' => $value, 'url' => $this->getAttachmentUrl($value));
		}
		else if(is_string($value)){
			$value = array('id' => $this->getAttachmentId($value), 'url' => $value);
		}
		else{
			$value = is_array($value) ? $value : array();
			$value = array_merge(array('id' => 0, 'url' => ''), $value);
		}
		return $value;
	}
	
	public function getAttachmentUrl($id){
		return wp_get_attachment_url($id);
	}
	
	public function getImageUrl($id, $size = 'thumbnail'){
		$src = wp_get_attachment_image_src($id, $size);
		return $src ? $src['url'] : false;
	}
	
	public function getAttachmentId($url){
		global $wpdb;
		$upload_dir = wp_upload_dir();
		if(is_string($url) && !empty($url)){
			$url = str_replace($upload_dir['baseurl'] . '/', '', $url);
			return $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = %s AND wposts.post_type = 'attachment'", esc_sql($url)));
		}
		return false;
	}
	
	public function loadFiles(){
		rs::loadScript('rs-upload', RS_LIB_URL . '/controls/upload-media/wpupload.min.js', true);
		rs::loadScript('rs-upload-init', RS_LIB_URL . '/controls/upload-media/upload.min.js', true);
		rs::loadStyle('rs-upload', RS_LIB_URL . '/controls/upload-media/upload.min.css');

		if((float)rs::$wordpress->version < 3.5){
			rs::loadScript('media-upload');
			rs::loadScript('thickbox');
			rs::loadStyle('thickbox');
		}
		else{
			wp_enqueue_media();
		}
	}
	
	public function enqueue() {
		wp_enqueue_style('rst-upload', RS_LIB_URL . '/controls/upload-media/upload.min.css');
		wp_enqueue_script('rst-upload', RS_LIB_URL . '/controls/upload-media/wpupload.min.js');
		wp_enqueue_script('rst-upload-init', RS_LIB_URL . '/controls/upload-media/upload.min.js');
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		$this->loadFiles();
		$this->enqueue();

		$options['buttons'] = array_merge($this->buttons_default, $options['buttons']);
		
		if($options['title'] == '') $options['title'] = 'Choose ' . ucfirst($options['type']);
		if($options['edit_title'] == '') $options['edit_title'] = 'Update ' . ucfirst($options['type']);
		if($options['buttons']['browse_text'] == '') $options['buttons']['browse_text'] = 'Choose ' . ucfirst($options['type']);
		
		
		
		if(is_numeric($options['max_height'])) $options['max_height'] .= 'px';
		
		if(!in_array($options['type'], array('audio', 'video', 'image'))) $options['type'] = '';
		
		$wrapid = $this->addConditionalLogic($options);
		$class = $options['show_input'] ? '' : 'hide-input';
		$type = $options['show_input'] ? 'text' : 'hidden';
		
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-upload <?php echo esc_attr($options['css_class']) ?> <?php echo esc_attr($class) ?>" data-title="<?php echo esc_attr($options['title']) ?>" data-type="<?php echo esc_attr($options['type']) ?>" data-insert-text="<?php echo esc_attr($options['buttons']['insert_text']) ?>" data-update-text="<?php echo esc_attr($options['buttons']['update_text']) ?>" data-edit-title="<?php echo esc_attr($options['edit_title']) ?>" data-ask-sideload="<?php echo esc_attr($options['ask_sideload']) ?>">
			<div class="rs-upload-browser">
				<input class="rs-upload-id" type="hidden" name="<?php echo esc_attr($options['name']) ?>" value="<?php echo esc_attr($options['value']['id'] ? $options['value']['id'] : $options['value']['url']) ?>"/>
				<input class="rs-textbox rs-upload-input" id="<?php echo esc_attr($options['field_id']) ?>" type="<?php echo esc_attr($type) ?>" value="<?php echo esc_attr($options['value']['url']) ?>"/>
				<a class="rs-button rs-upload-button"><?php echo esc_html($options['buttons']['browse_text']) ?></a>
			</div>
			<div class="rs-upload-details">
				<div class="rs-upload-preview">
					<img src="" alt="" style="max-height:<?php echo esc_attr($options['max_height']) ?>"/>
					<div class="rs-upload-action">
						<a class="rs-upload-delete" title="Delete">X</a>
						<?php if(is_admin()) { ?><a class="rs-upload-edit" title="Edit">E</a><?php } ?>
					</div>
				</div>
				<p class="rs-upload-name"></p>
				<p class="rs-upload-size"></p>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}

	
	//action 
	public static function thickboxInit(){
		global $pagenow;
		if(isset($_GET['rsupload']) && $_GET['rsupload'] == 'tb'){
			rs::loadScript('rs-upload-init', RS_LIB_URL . '/controls/upload/wpupload.min.js', true);
		}
		if(isset($_POST['action']) && ($_POST['action'] == 'query-attachments' || $_POST['action'] == 'get-attachment')){
			if($referentUrl = rs::referentUrl()){
				if(strpos($referentUrl, 'post.php') == false){
					remove_all_filters('attachment_fields_to_edit');
				}
			}
		}
	}
	
	public static function checkUrl(){
		$upload = new RsUpload;
		$url = $_GET['url'];
		$id = $upload->getAttachmentId($url);
		if($id){
			echo json_encode(wp_prepare_attachment_for_js($id));
		}
		elseif(rs::isSiteUrl($url)){
			echo -1;
		}
		else{
			echo 0;
		}
		exit;
	}
	
	public static function handleSiteload(){

		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		$url = $_GET['url'];
		$timeout_seconds = 30;
		$temp_file = download_url( $url, $timeout_seconds );
		$ext = rs::getExtension($url);
		
		if($ext){
			if (!is_wp_error( $temp_file )) {
				
				$file = array(
					'name' => basename($url), 
					'type' => wp_ext2type($ext),
					'tmp_name' => $temp_file,
					'error' => 0,
					'size' => filesize($temp_file),
				);

				$id = media_handle_sideload( $file, 0 );

				if (is_wp_error($id )) {
					echo json_encode(array(
						'error' => true,
						'message' => $id->get_error_message()
					));
				} else {
					echo json_encode(wp_prepare_attachment_for_js($id));
				}
			}
			else{
				echo json_encode(array(
					'error' => true,
					'message' => $temp_file->get_error_message()
				));
			}
		}
		else{
			echo json_encode(array(
				'error' => true,
				'message' => 'File extension wrong.'
			));
		}
		exit;
	}
}

add_action('init', array('RsUpload', 'thickboxInit'), 0, 0);
add_action('wp_ajax_rsupload_checkurl', array('RsUpload', 'checkUrl'), 0, 0);
add_action('wp_ajax_rsupload_handle_sideload', array('RsUpload', 'handleSiteload'), 0, 0);
add_action('wp_ajax_rsupload_handle_sideload', array('RsUpload', 'handleSiteload'), 0, 0);
