<?php
class WP_Customize_Radio_Image_Control extends WP_Customize_Control {
    public $type = 'radio-image';
 
    public function render_content() {
        if ( empty( $this->choices ) )
			return;

		$name = '_customize-radio-image-' . $this->id;

		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo force_balance_tags($this->description) ; ?></span>
		<?php endif;

		foreach ( $this->choices as $value => $label ) :
			?>
			<label>
				<input type="radio" value="<?php echo esc_attr( $value ); ?>" class="radioImageSelect" data-image="<?php echo esc_html( $label ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
			</label>
			<?php
		endforeach;
    }
	
	public function enqueue() {
		wp_enqueue_style( 'rst-css-radio-image', RS_LIB_URL . '/customize/controls/radio-image/radio-image-select.min.css' );
		wp_enqueue_script( 'rst-js-radio-image', RS_LIB_URL . '/customize/controls/radio-image/jquery.radioImageSelect.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'rst-js-radio-image-main', RS_LIB_URL . '/customize/controls/radio-image/radio-image.min.js', array('jquery'), '', true );
	}
	
}