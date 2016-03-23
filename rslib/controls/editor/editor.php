<?php
/// Editor Control - Render Script And HTML ////
/* TinyMce Settings Example (4.0)
'tinymce' => array(
	"theme" => "modern",
	"skin" => "lightgray",
	"plugins" => "charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
	"resize" => "vertical",
	"menubar" => false,
	"toolbar1" => "bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",
	"toolbar2" => "formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
	"toolbar3" => "",
	"toolbar4" => "",
)
*/
class RsEditor extends RsControl{
	public $default = array(
		'name' => 'editor',
		'type' => 'editor',
		'media_button' => false,
		'quicktags' => true,
		'wpautop' => true,
		'textarea_rows' => 10,
		'editor_css' => '',
		'editor_class' => '',
		'tinymce' => array()
	);
	
	public static $default_loaded = false;
	
	public function loadFiles(){
		if(!static::$default_loaded){
			ob_start(); 
			wp_editor('', 'rs_editor_default'); 
			ob_end_clean();
			static::$default_loaded = true;
		}
		rs::loadStyle('wp-editor', includes_url('/css/editor.min.css'));
		rs::loadStyle('wp-dashicons', includes_url('/css/dashicons.min.css'));
		rs::loadScript('rs-editor', RS_LIB_URL . '/controls/editor/editor.min.js', true);
	}
	
	public function RsEditor(){
		$this->addControl('editor', 'editor');
	}
	
	public function render($options = array()){
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}

		$this->loadFiles();
		
		if(!is_array($options['tinymce'])) $options['tinymce'] = array();
		$options['tinymce'] = array_merge(array('rs_editor' => true), $options['tinymce']);
		
		$wrapid = $this->addConditionalLogic($options);
		
		?>
		
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-editor <?php echo esc_attr($options['css_class']) ?>" data-config='<?php echo json_encode($options['tinymce']) ?>'>
		<?php
			if($options['wpautop']){
				$options['value'] = wpautop($options['value']);
			}
			ob_start();
			wp_editor( $options['value'], $options['field_id'], array( 
				'textarea_name' => $options['field_name'], 
				'media_buttons' => $options['media_button'], 
				'quicktags' => $options['quicktags'], 
				'media_buttons' => $options['media_button'], 
				'wpautop' => false, 
				'textarea_rows' => $options['textarea_rows'], 
				'editor_css' => $options['editor_css'], 
				'editor_class' => $options['editor_class'] . ' ' . $options['required'], 
				'tinymce' => $options['tinymce'] 
			)); 
			$html = ob_get_clean();
			$html = preg_replace('/<link[^>]+>/', '', $html);
			echo ($html);
		?>
		</div>
		<?php
	}
}