<?php
/// Gallery Control - Render Script And HTML (Required RsUpload Control)////

class RsGallery extends RsControl{
	public $default = array(
		'name' => 'gallery',
		'type' => 'gallery',
		'title' => 'Select Images',
		'add_item_text' => 'Add Image',
		'max_items' => 999,
		'default_value' => array(),
		'items' => array(),
		'sorting' => true,
	);
	
	public function RsGallery(){
		$this->addControl('gallery', 'gallery');
	}

	public function getField($name, $post_id = null, $output = null){
		$values = parent::getField($name, $post_id, $output);
		$result = array();
		$output = strtolower($output);
		if($values){
			foreach($values as $id){
				$item = wp_prepare_attachment_for_js($id);
				if($item){
					if($output == 'thumbnail'){
						if($item['sizes'] && $item['sizes']['thumbnail']){
							$result[] = $item['sizes']['thumbnail']['url'];
						}
						else{
							$result[] = $item['url'];
						}
					}
					elseif(!empty($output) && $output != 'full' && $output != 'object' && $output != 'array'){
						$result[] = isset($item[$output]) ? $item[$output] : null;
					}
					else{
						$result[] = $item;
					}
				}
			}
		}
		return $result;
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
		rs::loadStyle('rs-gallery', RS_LIB_URL . '/controls/gallery/gallery.min.css');
		rs::loadScript('jquery-ui-sortable');
		rs::loadScript('rs-gallery', RS_LIB_URL . '/controls/gallery/gallery.min.js', true);
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);

		if(!is_array($options['value'])){
			$options['value'] = array();
		}
		
		$options['sorting'] = $options['sorting'] ? 'sorting-true' : 'sorting-false';
		
		?>

		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-gallery <?php echo esc_attr($options['css_class']) ?> <?php echo esc_attr($options['sorting']) ?>" data-base-name="<?php echo esc_attr($options['field_name']) ?>" data-max-items="<?php echo esc_attr($options['max_items']) ?>" data-title="<?php echo esc_attr($options['title']) ?>">
			<a class="rs-gallery-add-item rs-button"><i class="icon-plus"></i> <?php echo esc_html($options['add_item_text']) ?></a>
			<div class="rs-gallery-items">
				<?php 
				foreach($options['value'] as $i=>$id) {
					$value = wp_prepare_attachment_for_js($id);
					if($value){
						$url = $value['sizes'] && isset($value['sizes']['thumbnail']) ? $value['sizes']['thumbnail']['url'] : $value['url'];
						?>
						<div class="rs-gallery-item">
							<input type="hidden" class="rs-gallery-item-id" name="<?php echo esc_attr($options['name'].'['.$i.']') ?>" value="<?php echo esc_attr($value['id']) ?>"/>
							<img src="<?php echo esc_url($url) ?>" alt="<?php echo esc_attr($value['name']) ?>"/>
							<div class="rs-gallery-action">
								<a class="rs-gallery-delete">D</a>
								<?php if(is_admin()) { ?><a class="rs-gallery-edit">E</a><?php } ?>
							</div>
						</div>
						<?php 
					}
				} ?>
				<div class="clear"></div>
			</div>		
			<div class="rs-gallery-template rs-template">
				<div class="rs-gallery-item">
					<input type="hidden" class="rs-gallery-item-id" name="<?php echo esc_attr($options['name'].'[rsitemindex]') ?>" value=""/>
					<img src="" alt=""/>
					<div class="rs-gallery-action">
						<a class="rs-gallery-delete">D</a>
						<?php if(is_admin()) { ?><a class="rs-gallery-edit">E</a><?php } ?>
					</div>
				</div>
			</div>
			<?php if( $options['derscription'] ) { ?>
			<p class="derscription"><?php echo trim($options['derscription']) ?></p>
			<?php } ?>
		</div>
		<?php
	}
}
