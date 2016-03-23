<?php
class rst_filter_widget extends WP_Widget {
	
	function rst_filter_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_attributes_filter', 'description' => 'A widget that show filter products woocommerce' );

		/* Create the widget. */
		parent::__construct( 'rst-filter-widget', 'Libero - Woocommerce Filter Attributes', $widget_ops);	
	}
	 
	function widget($args, $instance) {
		$html = '';
		$html .= $args['before_widget'];
		
		if( isset($instance['attr']) && !empty($instance['attr']) ) {
			
			$attribute_name = 'pa_'. sanitize_title($instance['attr']);
			$selected = isset( $_REQUEST[ 'filter_value'] ) ? $_REQUEST[ 'filter_value' ] : '';
			$name = 'filter_value';
			
			$terms = get_terms( $attribute_name, 'hide_empty=0' );
			
			$html .= '<form class="variations_form" method="get">';
			
			$html .= '<div class="libero-title-wrap">';
			if( !empty($instance['title']) ) {
				$html .= $args['before_title'];
					$html .= $instance['title'];
				$html .= $args['after_title'];
			}
			$html .= '<a class="libero-reset-filter" href="#">'. esc_html__('Reset','libero') .'</a>';
			$html .= '</div>';
			
			$html .= '<select name="'. $name .'" class="libero-select">';
				$html .= '<option value="">'. esc_html__( 'Choose an option', 'libero' ) .'</option>';
				if( $terms ) {
					foreach( $terms as $term ) {
						$data_color = '';
						$swatch_type = rs::getField('rst_swatch','term_'.$term->term_id);
						$swatch_color = rs::getField('rst_swatch_color','term_'.$term->term_id);
						if( $swatch_type == 'color' && isset($swatch_color) && !empty($swatch_color) ) $data_color = 'data-color="'. $swatch_color .'"';
						
						$html .= '<option '. $data_color .' '. selected($selected, $term->slug, false) .' value="'. $term->slug .'">'. $term->name .'</option>';
					}
				}
			$html .= '</select>';
			$html .= '<input type="hidden" name="attribute_filter" value="'. $attribute_name .'" />';
			
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				if ( 'orderby' === $key || 'submit' === $key || $key === 'filter_value' || $key === 'attribute_filter' ) {
					continue;
				}
				if ( is_array( $val ) ) {
					foreach( $val as $innerVal ) {
						$html .= '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
					}
				} else {
					$html .= '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
				}
			}
		
			$html .= '</form>';
		}
		
		$html .= $args['after_widget'];
		echo force_balance_tags($html);
	}
 
	function update($new_instance, $old_instance) {
		return $new_instance;		
	}
 
	function form($instance) {
		?><br/>
		<label>Title:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<?php 
			$object = wc_get_attribute_taxonomies();
			if( is_array($object) && sizeof($object) ) {
		?>
		<label>Select Attributes:
		<select name="<?php echo esc_attr($this->get_field_name( 'attr' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'attr' )); ?>">
			<?php foreach( $object as $at ) { ?>
			<option <?php isset($instance['attr']) ? selected($instance['attr'],$at->attribute_name) : '' ?> value="<?php echo esc_attr($at->attribute_name) ?>"><?php echo esc_attr($at->attribute_label) ?></option>
			<?php } ?>
		</select></label>
		<br /><br />
		<?php } else { 
			echo '<p>Product Attributes not exist!</p>';
		}
	}
	
}

add_action( 'widgets_init', 'create_filter_widget' );

function create_filter_widget(){
	return register_widget("rst_filter_widget");
}