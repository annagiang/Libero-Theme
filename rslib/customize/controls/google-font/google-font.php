<?php
class WP_Customize_RsGoogleFont extends WP_Customize_Control {
    public $type = 'font';
	public $controls_show;
	// Default style options
	public static $defaultStyling =  array(
		'font-family' => 'Open Sans',
		'font-size' => '13px',
		'font-weight' => 'normal',
		'font-style' => 'normal',
		'line-height' => 'normal',
		'letter-spacing' => 'normal',
		'text-transform' => 'none',
		'font-type' => 'google', // Only used internally to determine if the font is a
	);

	// The list of web safe fonts
	public static $webSafeFonts = array(
		'Arial, Helvetica, sans-serif' => 'Arial',
		'"Arial Black", Gadget, sans-serif' => 'Arial Black',
		'"Comic Sans MS", cursive, sans-serif' => 'Comic Sans',
		'"Courier New", Courier, monospace' => 'Courier New',
		'Georgia, serif' => 'Geogia',
		'Impact, Charcoal, sans-serif' => 'Impact',
		'"Lucida Console", Monaco, monospace' => 'Lucida Console',
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => 'Lucida Sans',
		'"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino',
		'Tahoma, Geneva, sans-serif' => 'Tahoma',
		'"Times New Roman", Times, serif' => 'Times New Roman',
		'"Trebuchet MS", Helvetica, sans-serif' => 'Trebuchet',
		'Verdana, Geneva, sans-serif' => 'Verdana',
	);
	
	// Holds all the Google Fonts for enqueuing
	private static $googleFontsOptions = array();

	private static $firstLoad = true;
	
	public function rst_get_google_fonts(){
		include_once("functions-googlefonts.php");
		return (rs_get_googlefonts());
	}
	
    public function render_content() {
		
		$array_google_fonts = $this->rst_get_google_fonts();
		$name = '_customize-google-font-' . $this->id;
		$value_font = array();
		if(is_serialized($this->value())){
			$value_font = unserialize($this->value());
		}
		else {
			if(count($this->value()) && $this->value() != ''){
				$value_font = ($this->value());
			}
			else{
				$value_font = self::$defaultStyling;
			}
		}
		$controls_show = $this->controls_show;
		?>
		<div id="customize-control-<?php echo esc_attr($this->id); ?>" class="customize-control-font">
			<div class="content-gallery-input-values">
				<input type="hidden" <?php $this->link(); ?> class="rst-font-items" value="<?php echo is_serialized($this->value()) ? esc_attr($this->value()) : serialize($this->value()) ;?>"/>
			</div>
			<?php
		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo force_balance_tags($this->description) ; ?></span>
		<?php endif;
		?>
		<?php if(isset($controls_show["font-family"])) { ?>
			<label>
				<span class="rst-span-font-family">Font Family </span>
				<select class="rst-font-sel-family">
					<optgroup class="safe" label="Web Safe Fonts">
			<?php
			foreach ( self::$webSafeFonts as $key => $value ) :
				?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $value_font['font-family'], $key ); ?>><?php echo esc_attr( $value ); ?></option>
				<?php
			endforeach;
			?>
					</optgroup>
					<optgroup class="google" label="Google WebFonts">
			<?php
			foreach ( $array_google_fonts as $key => $value ) :
				?>
						<option value="<?php echo esc_attr( $value['name'] ); ?>" <?php selected( $value_font['font-family'], $value['name'] ); ?>><?php echo esc_attr( $value['name'] ); ?></option>
				<?php
			endforeach;
			?>
					</optgroup>
				</select>
			</label>
			<?php } ?>
			<?php if(isset($controls_show["font-size"])) { ?>
			<label>
				Font Size
				<select class="rst-font-sel-size">
				<?php
				for($i = 0; $i <= 150; $i++ ){
				?>
					<option value="<?php echo absint($i); ?>px" <?php selected($value_font['font-size'],absint($i).'px'); ?>><?php echo absint($i); ?>px</option>
				<?php
				}
				?>
				</select>
			</label>
			<?php
			}
			if(isset($controls_show["font-weight"])) {
			?>
			<label>
				Font weight
				<select class='rst-font-sel-weight'>
					<?php
					$options = array( 'normal', 'bold', 'bolder', 'lighter', '100', '200', '300', '400', '500', '600', '700', '800', '900' );
					foreach ( $options as $option ) {
						printf( "<option value='%s'%s>%s</option>",
							esc_attr( $option ),
							selected( $value_font['font-weight'], $option, false ),
							$option
						);
					}
					?>
				</select>
			</label>
			<?php
			}
			if(isset($controls_show["font-style"])) {
			?>
			<label>
				Font style
				<select class='rst-font-sel-style'>
					<?php
					$options = array( 'normal', 'italic' );
					foreach ( $options as $option ) {
						printf( "<option value='%s'%s>%s</option>",
							esc_attr( $option ),
							selected( $value_font['font-style'], $option, false ),
							$option
						);
					}
					?>
				</select>
			</label>
			<?php
			}
			if(isset($controls_show["line-height"])) {
			?>
			<label>
				Line Height
				<select class='rst-font-sel-height'>
					<option value="normal">normal</option>
					<?php
					for ( $i = 0; $i <= 150; $i ++ ) {
						printf( "<option value='%s'%s>%s</option>",
							esc_attr( $i . 'px' ),
							selected( $value_font['line-height'], $i . 'px', false ),
							$i . 'px'
						);
					}
					?>
				</select>
			</label>
			<?php
			}
			if(isset($controls_show["letter-spacing"])) {
			?>
			<label>
				Letter Spacing
				<select class='rst-font-sel-spacing'>
					<option value='normal'>normal</option>
					<?php
					for ( $i = -20; $i <= 20; $i++ ) {
						printf( "<option value='%s'%s>%s</option>",
							esc_attr( $i . 'px' ),
							selected( $value_font['letter-spacing'], $i . 'px', false ),
							$i . 'px'
						);
					}
					?>
				</select>
			</label>
			<?php
			}
			if(isset($controls_show["text-transform"])) {
			?>
			<label >
				Text Transform
				<select class='rst-font-sel-transform'>
					<?php
					$options = array( 'none', 'capitalize', 'uppercase', 'lowercase' );
					foreach ( $options as $option ) {
						printf( "<option value='%s'%s>%s</option>",
							esc_attr( $option ),
							selected( $value_font['text-transform'], $option, false ),
							$option
						);
					}
					?>
				</select>
			</label>
			<?php } ?>
		</div>
		<?php
    }
	
	public function enqueue() {
		wp_enqueue_style( 'rst-css-google-font', RS_LIB_URL . '/customize/controls/google-font/rst-google-font.min.css' );
		wp_enqueue_style( 'rst-css-admin-select2', RS_LIB_URL . '/scripts/jquery.select2/choose-admin.min.css' );
		wp_enqueue_script( 'rst-js-serialize', RS_LIB_URL . '/customize/controls/google-font/rst-serialize.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'rst-js-google-font', RS_LIB_URL . '/customize/controls/google-font/rst-google-font.js', array('jquery'), '', true );
		wp_enqueue_script( 'rst-js-select2', RS_LIB_URL . '/scripts/jquery.select2/select2.min.js', array('jquery'), '', true );
	}
	
}