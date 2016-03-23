<?php
/// Gallery Control - Render Script And HTML (Required RsUpload Control)////

class WP_Customize_RsGallery extends WP_Customize_Control {
	public $type = 'gallery';
	public $params = array();
	public static $default = array(
		'name' => 'gallery',
		'type' => 'gallery',
		'title' => 'Select Images',
		'add_item_text' => 'Add Image',
		'max_items' => 999,
		'default_value' => array(),
		'items' => array(),
		'sorting' => true,
	);
	public function enqueue(){
		wp_enqueue_script('rst-upload', RS_LIB_URL . '/controls/upload-media/wpupload.min.js');
		wp_enqueue_script('rst-upload-init', RS_LIB_URL . '/controls/upload-media/upload.min.js');
		wp_enqueue_style('rst-upload', RS_LIB_URL . '/controls/upload-media/upload.min.css');
		if((float)rs::$wordpress->version < 3.5){
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
		}
		else{
			wp_enqueue_media();
		}
		wp_enqueue_style('rst-gallery', RS_LIB_URL . '/customize/controls/gallery/gallery.min.css');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('rst-gallery', RS_LIB_URL . '/customize/controls/gallery/gallery.min.js');
	}
	public function render_content($options = array()){
		$options = array_merge( self::$default, $this->params );
		?>
		<div id="customize-control-<?php echo esc_attr($this->id); ?>">
			<?php
			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo force_balance_tags($this->description) ; ?></span>
			<?php endif;
			$options['value'] = explode(',',$this->value());
			if(!is_array($options['value'])){
				$options['value'] = array();
			}
			
			$options['sorting'] = $options['sorting'] ? 'sorting-true' : 'sorting-false';
			?>
			<div class="content-gallery-input-values">
				<input type="text" <?php $this->link(); ?> class="rs-gallery-item-id" value="<?php echo esc_attr($this->value());?>"/>
			</div>
			<div class="rs-gallery <?php echo esc_attr($options['sorting']) ?>" data-base-name="<?php echo esc_attr($options['name']) ?>" data-max-items="<?php echo esc_attr($options['max_items']) ?>" data-title="<?php echo esc_attr($options['title']) ?>">
				<a class="rs-gallery-add-item rs-button"><i class="icon-plus"></i> <?php echo esc_html($options['add_item_text']) ?></a>
				<div class="rs-gallery-items">
					<?php 
					foreach($options['value'] as $i=>$id) {
						$value = wp_prepare_attachment_for_js($id);
						if($value){
							$url = $value['sizes'] && isset($value['sizes']['thumbnail']) ? $value['sizes']['thumbnail']['url'] : $value['url'];
							?>
							<div class="rs-gallery-item">
								<input  type="hidden" class="rs-gallery-item-id" name="<?php echo esc_attr($options['name'].'['.$i.']') ?>" value="<?php echo esc_attr($value['id']) ?>"/>
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
						<input type="hidden" class="rs-gallery-item-id" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr($this->value());?>"/>
						<img src="" alt=""/>
						<div class="rs-gallery-action">
							<a class="rs-gallery-delete">D</a>
							<?php if(is_admin()) { ?><a class="rs-gallery-edit">E</a><?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
