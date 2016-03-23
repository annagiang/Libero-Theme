<?php

function rst_customizer_css() {
    ?>
    <style type="text/css" id="customize-css">
	<?php
		foreach( rs::$customize as $tab ) {
			if( $tab['controls'] ) {
				foreach( $tab['controls'] as $key=>$control ) {
					if( isset($control['css']) && get_theme_mod( $control['name'] ) ) {
						echo str_replace( '$value', get_theme_mod( $control['name'] ), $control['css'] );
					}
				}
			}
		}
	?>
    </style>
    <?php
}
add_action( 'wp_head', 'rst_customizer_css' );

function rstCompressCSS( $minify ) 
{
	/* remove comments */
	$minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );

	/* remove tabs, spaces, newlines, etc. */
	$minify = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $minify );
		
	return $minify;
}

global $rs_global_google_font_family;
$rs_global_google_font_family = array();
function rstGeneralCSS($values = array(), $write_file = false, $preview = false){
	global $array_google_fonts_as_key;
	global $rs_global_google_font_family;
	$webSafeFonts_array = array(
		'Arial, Helvetica, sans-serif',
		'"Arial Black", Gadget, sans-serif',
		'"Comic Sans MS", cursive, sans-serif',
		'"Courier New", Courier, monospace',
		'Georgia, serif',
		'Impact, Charcoal, sans-serif',
		'"Lucida Console", Monaco, monospace',
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		'"Palatino Linotype", "Book Antiqua", Palatino, serif',
		'Tahoma, Geneva, sans-serif',
		'"Times New Roman", Times, serif',
		'"Trebuchet MS", Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
	);
	$string = '';
	foreach($values as $key => $items){
		$string .= $key;
		$string .= '{';
		if(is_array($items)){
		
			if(isset($items['font-family']) && $items['font-family'] != NULL){
				$string .= 'font-family:'.$items['font-family'].';';
			}
			if(isset($items['font-size']) && $items['font-size'] != NULL){
				$string .= 'font-size:'.$items['font-size'].';';
			}
			if(isset($items['font-weight']) && $items['font-weight'] != NULL){
				$string .= 'font-weight:'.$items['font-weight'].';';
			}
			if(isset($items['font-style']) && $items['font-style'] != NULL){
				$string .= 'font-style:'.$items['font-style'].';';
			}
			if(isset($items['line-height']) && $items['line-height'] != NULL){
				$string .= 'line-height:'.$items['line-height'].';';
			}
			if(isset($items['letter-spacing']) && $items['letter-spacing'] != NULL){
				$string .= 'letter-spacing:'.$items['letter-spacing'].';';
			}
			if(isset($items['text-transform']) && $items['text-transform'] != NULL){
				$string .= 'text-transform:'.$items['text-transform'].';';
			}
			
			//Backgorund
			if(isset($items['background-color']) && $items['background-color'] != NULL){
				$string .= 'background-color:'.$items['background-color'].';';
			}
			if(isset($items['background-image']) && $items['background-image'] != NULL){
				$string .= 'background-image: url("'.$items['background-image'].'");';
			}
			if(isset($items['background-repeat']) && $items['background-repeat'] != NULL){
				$string .= 'background-repeat: '.$items['background-repeat'].';';
			}
			if(isset($items['background-size']) && $items['background-size'] != NULL){
				$string .= 'background-size: '.$items['background-size'].';';
			}
			
			if(isset($items['background-position-vertical']) || isset($items['background-position-horizontal'])){
				$position = ( isset($items['background-position-vertical']) && !empty($items['background-position-vertical']) ) ? $items['background-position-vertical'] : 'top';
				$position_after = ( isset($items['background-position-horizontal'])&& !empty($items['background-position-horizontal']) ) ? $items['background-position-horizontal'] : 'left';
				$position .= ' '.$position_after;
				$string .= 'background-position: '. $position .';';
			}
			if(isset($items['background-attachment']) && $items['background-attachment'] != NULL){
				$string .= 'background-attachment: '.$items['background-attachment'].';';
			}
			
			
			if($preview){
				//enqueue google font
				if ( isset($items['font-family']) && (!in_array($items['font-family'], $webSafeFonts_array))) {			
					// Get the weight
					$variants = array();
					if( isset($items['font-weight']) ) {
						$variant_prev = $items['font-weight'];
						if ( $variant_prev == 'normal' ) {
							$variants[] = '400';
							$variants[] = '400italic';
						} else if ( $variant_prev == 'bold' ) {
							$variants[] = '500';
							$variants[] = '500italic';
						} else if ( $variant_prev == 'bolder' ) {
							$variants[] = '800';
							$variants[] = '800italic';
						} else if ( $variant_prev == 'lighter' ) {
							$variants[] = '100';
							$variants[] = '100italic';
						}
					}
					$variants[] = '400';
					$variants = array_unique( $variants );
				
					$rs_global_google_font_family[] = sprintf("%s:%s",str_replace( ' ', '+', $items['font-family'] ),implode( ',', $variants ));
				}
			}
		}
		$string .= '}';
	}
	$string_out = rstCompressCSS($string);
	if($preview){
		
		/**
		 * Enqueue Google Fonts.
		 */
		if(is_array($rs_global_google_font_family) && count($rs_global_google_font_family)){
			$rs_global_google_font_family_out = implode('|',$rs_global_google_font_family);
			$query_args = array(
				'family' => $rs_global_google_font_family_out
			);
			wp_register_style( 'rst_custom_enqueue_google_font', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
			wp_enqueue_style( 'rst_custom_enqueue_google_font' );
		}
	}
	else{
		if($write_file){
			rst_WriteCSS( $string_out, RS_LIB_PATH . "/customize/rst-writerCSS.min.css");
		}
		else{
			rst_WriteCSS( $string_out, RS_LIB_PATH . "/customize/rst-writerCSS-customize.min.css");
		}
		add_action( 'wp_enqueue_scripts', 'rst_enqueue_style_for_front_end_customize', 9999 );
	}
}

function rstCheckFileExistAndAvailable($cssFilename){
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem;

	// Verify that we can create the file
	if ( $wp_filesystem->exists( $cssFilename ) ) {
		if ( ! $wp_filesystem->is_writable( $cssFilename ) ) {
			return false;
		}
		if ( ! $wp_filesystem->is_readable( $cssFilename ) ) {
			return false;
		}
	}
	// Verify directory
	if ( ! $wp_filesystem->is_dir( dirname( $cssFilename ) ) ) {
		return false;
	}
	if ( ! $wp_filesystem->is_writable( dirname( $cssFilename ) ) ) {
		return false;
	}
	return true;
}

function rst_enqueue_style_for_front_end_customize(){
	if(!file_exists(RS_LIB_PATH . "/customize/rst-writerCSS-customize.min.css")){
		rst_customizer_css_render_file(false);
	}
	wp_register_style( 'rst-font-for-frontend-customize', ( RS_LIB_URL . "/customize/rst-writerCSS-customize.min.css"));
	wp_enqueue_style( 'rst-font-for-frontend-customize' );
}
function rst_enqueue_style_for_front_end(){
	if(!file_exists(RS_LIB_PATH . "/customize/rst-writerCSS.min.css")){
		rst_customizer_css_render_file();
	}
	wp_register_style( 'rst-font-for-frontend', ( RS_LIB_URL . "/customize/rst-writerCSS.min.css"));
	wp_enqueue_style( 'rst-font-for-frontend' );
}
add_action( 'wp_enqueue_scripts', 'rst_enqueue_style_for_front_end',9999 );
function rst_WriteCSS( $parsedCSS, $cssFilename ) {
	if(rstCheckFileExistAndAvailable($cssFilename)){
		// Write our CSS
		global $wp_filesystem;
		return $wp_filesystem->put_contents( $cssFilename, $parsedCSS, 0644 );
	}
}
function rst_customizer_css_render($write_file = false, $preview = false) {
	$controlCSS = array();
	foreach( rs::$customize as $tab ) {
		if( $tab['controls'] ) {
			foreach( $tab['controls'] as $key=>$control ) {
				if(
					( $control['type'] == 'font' && isset( $control['css_selector'] ) ) ||
					( $control['type'] == 'rsbackground' && isset( $control['css_selector'] ) )
				)
				{
					if( get_theme_mod( $control['name'] ) ) {
						$value = is_array(get_theme_mod( $control['name'] )) ? get_theme_mod( $control['name'] ) : unserialize(get_theme_mod( $control['name'] ));
						if( $value ) {
							if( isset( $controlCSS[$control['css_selector']] ) && is_array( array_merge($controlCSS[$control['css_selector']]) ) ) {
								$controlCSS[$control['css_selector']] = array_merge($controlCSS[$control['css_selector']], $value);
							}
							else {
								$controlCSS[$control['css_selector']] = $value;
							}
						}
					}
				}
			}
		}
	}
	rstGeneralCSS($controlCSS, $write_file, $preview);
	
}

//render preview css
function rst_customizer_css_render_call(){
	rst_customizer_css_render(false,false);
}
add_action( 'customize_preview_init', 'rst_customizer_css_render_call' );

//render file
function rst_customizer_css_render_file(){
	rst_customizer_css_render(true,false);
}
add_action( 'customize_save_after', 'rst_customizer_css_render_file' );

//get google font
function rst_customizer_css_render_google_fonts(){
	rst_customizer_css_render(false,true);
}
add_action( 'wp_enqueue_scripts', 'rst_customizer_css_render_google_fonts' );

//Conditional logic
function rstCusConvertRules($rules, $remove_null_rule = true){
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
function rst_customizer_js() {
    ?>
	<script type="text/javascript" id="rst-customizer-js">
	jQuery(document).ready(function($){
	<?php
		$array_control_type = array();
		foreach( rs::$customize as $tab ) {
			if( $tab['controls'] ) {
				foreach( $tab['controls'] as $key=>$control ) {
					$array_control_type[$control['name']] = $control['type'];
				}
			}
		}
		foreach( rs::$customize as $tab ) {
			if( $tab['controls'] ) {
				foreach( $tab['controls'] as $key=>$control ) {
					if( isset($control['conditional_logic']) && ( $control['name'] ) ) {
						$content_out = array();
						foreach(rstCusConvertRules($control['conditional_logic']['items']) as $key_logic => $value_logic){
							if(is_array($value_logic)){
								$check_to_lower = false;
								$value_logics = current($value_logic);
								if(isset($value_logic["i"])){
									$value_logics = strtolower($value_logics);
									$check_to_lower = true;
								}
								if(isset($value_logic['not'])){
									$comparse = '!=';
								}
								else {
									$comparse = '==';
								}
								$value_logics_or_and = str_replace('&','|',$value_logics);
								$array_value_logics_or_and = explode('|',$value_logics_or_and);
								$value_logics_or = explode('|',$value_logics);
								$value_logics_or_out = array();
								foreach($value_logics_or as $value_out){
									if(in_array($value_out,$array_value_logics_or_and)){
										$value_logics_or_out[] = $value_out;
									}
								}
								$value_logics_and = explode('&',$value_logics);
								$value_logics_and_out = array();
								foreach($value_logics_and as $value_out_and){
									if(in_array($value_out_and,$array_value_logics_or_and)){
										$value_logics_and_out[] = $value_out_and;
									}
								}
								if(count($array_value_logics_or_and) == 1){
									$value_logics_or_out = $array_value_logics_or_and;
									$value_logics_and_out = array();
								}
								mb_internal_encoding('UTF-8'); 
								mb_http_output('UTF-8'); 
								mb_http_input('UTF-8'); 
								mb_language('uni'); 
								mb_regex_encoding('UTF-8'); 

								ob_start("mb_output_handler");
								if($array_control_type[$key_logic] == 'color'){
								?>
								(
									<?php if(is_array($value_logics_or_out)) foreach($value_logics_or_out as $key_items_out => $value_logics_or_out_items ){ ?>
									<?php if($key_items_out != 0) {?>
									||
									<?php } ?>
									(
										jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>').find('.color-picker-hex.wp-color-picker').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_or_out_items); ?>'
									)
									<?php } ?>
									<?php if(is_array($value_logics_and_out)) foreach($value_logics_and_out as $key_items_and_out => $value_logics_and_out_items ){ ?>
									<?php if($key_items_and_out != 0 || (count($value_logics_or_out) != 0 )) {?>
									&&
									<?php } ?>
									(
										jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>').find('.color-picker-hex.wp-color-picker').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_and_out_items); ?>'
									)
									<?php } ?>
								)
								<?php
								}
								elseif($array_control_type[$key_logic] == 'image'){
								?>
								(
									<?php if(is_array($value_logics_or_out)) foreach($value_logics_or_out as $key_items_out => $value_logics_or_out_items ){ ?>
									<?php if($key_items_out != 0) {?>
									||
									<?php } ?>
									(
										jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>.customize-control-image').find('img').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_or_out_items); ?>'
									)
									<?php } ?>
									<?php if(is_array($value_logics_and_out)) foreach($value_logics_and_out as $key_items_and_out => $value_logics_and_out_items ){ ?>
									<?php if($key_items_and_out != 0 || (count($value_logics_or_out) != 0 )) {?>
									&&
									<?php } ?>
									(
										jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>.customize-control-image').find('img').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_and_out_items); ?>'
									)
									<?php } ?>
								)
								<?php
								}
								elseif($array_control_type[$key_logic] == 'radio-image'){
								?>
								(
									<?php if(is_array($value_logics_or_out)) foreach($value_logics_or_out as $key_items_out => $value_logics_or_out_items ){ ?>
									<?php if($key_items_out != 0) {?>
									||
									<?php } ?>
									(
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]:checked').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_or_out_items); ?>'
									)
									<?php } ?>
									<?php if(is_array($value_logics_and_out)) foreach($value_logics_and_out as $key_items_and_out => $value_logics_and_out_items ){ ?>
									<?php if($key_items_and_out != 0 || count($value_logics_or_out) != 0 ) {?>
									&&
									<?php
									} ?>
									(
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]:checked').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_and_out_items); ?>'
									)
									<?php } ?>
								)
								<?php
								}
								// js for checkbok
								elseif($array_control_type[$key_logic] == 'checkbox'){
									$comparse = ($comparse == '==') ? '!=' : '==';
								?>
								(
									<?php if(is_array($value_logics_or_out)) foreach($value_logics_or_out as $key_items_out => $value_logics_or_out_items ){ ?>
									<?php if($key_items_out != 0) {?>
									||
									<?php } ?>
									(
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]:checked').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?>  undefined
									)
									<?php } ?>
									<?php if(is_array($value_logics_and_out)) foreach($value_logics_and_out as $key_items_and_out => $value_logics_and_out_items ){ ?>
									<?php if($key_items_and_out != 0 || count($value_logics_or_out) != 0 ) {?>
									&&
									<?php
									} ?>
									(
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]:checked').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?>  undefined
									)
									<?php } ?>
								)
								<?php
								}
								else{
								?>
								(
									<?php if(is_array($value_logics_or_out)) foreach($value_logics_or_out as $key_items_out => $value_logics_or_out_items ){ ?>
									<?php if($key_items_out != 0) {?>
									||
									<?php } ?>
									(
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_or_out_items); ?>'
									)
									<?php } ?>
									<?php if(is_array($value_logics_and_out)) foreach($value_logics_and_out as $key_items_and_out => $value_logics_and_out_items ){ ?>
									<?php if($key_items_and_out != 0 || count($value_logics_or_out) != 0 ) {?>
									&&
									<?php
									} ?>
									(
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]').val()<?php if($check_to_lower){ ?>.toLowerCase() <?php } printf("%s",$comparse); ?> '<?php printf("%s",$value_logics_and_out_items); ?>'
									)
									<?php } ?>
								)
								<?php
								}
							}
							$content_out[$key_logic] = ob_get_contents();
							ob_clean();
							ob_end_flush();
						}
						$out_writer = '';
						// relation == and
						if(isset($control['conditional_logic']['relation']) || (isset($control['conditional_logic']['relation']) && $control['conditional_logic']['relation'] === 'and') ){
							$out_writer = implode(' && ',$content_out);
							$out_writer = str_replace('&quot;','"',$out_writer);
							$out_writer = str_replace('&#039;','"',$out_writer);
						}
						// relation == or
						elseif(!isset($control['conditional_logic']['relation']) || $control['conditional_logic']['relation'] === 'or'){
							$out_writer = implode(' || ',$content_out);
							$out_writer = str_replace('&quot;','"',$out_writer);
							$out_writer = str_replace('&#039;','"',$out_writer);
						}
						foreach(rstCusConvertRules($control['conditional_logic']['items']) as $key_logic => $value_logic){
						?>
							if(<?php echo ($out_writer); ?>)
							{
								jQuery('*[data-customize-setting-link="<?php echo esc_attr($control['name']); ?>"]').show().removeClass('important-hide');
								jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>').show().removeClass('important-hide');
							}
							else{
								jQuery('*[data-customize-setting-link="<?php echo esc_attr($control['name']); ?>"]').hide().addClass('important-hide');
								jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>').hide().addClass('important-hide');
							}
							jQuery('*[data-customize-setting-link="<?php echo esc_attr($key_logic); ?>"]').live('change',function(){
								if(<?php echo ($out_writer); ?>)
								{
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($control['name']); ?>"]').show().removeClass('important-hide');
									jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>').show().removeClass('important-hide');
								}
								else{
									jQuery('*[data-customize-setting-link="<?php echo esc_attr($control['name']); ?>"]').hide().addClass('important-hide');
									jQuery('#customize-control-settings-<?php echo esc_attr($control['name']); ?>').hide().addClass('important-hide');
								}
							});
						<?php
						}
					}
				}
			}
		}
	?>
		jQuery('.customize-control-radio-image label').each(function(){
			if(jQuery(this).find('img').hasClass('item-checked')){
				jQuery(this).find('input').trigger('click');
			}
		});
		
	
		jQuery(document).on('click', '#accordion-panel-widgets .accordion-section-title', function(){
			rs.helpers.rebuildControls('#accordion-panel-widgets');
		});
	});
    </script>
	<style type="text/css">
	#customize-theme-controls .accordion-section-content {
		background: #fff;
	}
	.important-hide {
		display: none!important;
	}
	</style>
    <?php
}
add_action( 'customize_controls_print_footer_scripts', 'rst_customizer_js' );