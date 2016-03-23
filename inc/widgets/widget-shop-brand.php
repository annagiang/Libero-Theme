<?php
class libero_filter_widget extends WP_Widget {
	
	function libero_filter_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_woo_brand', 'description' => 'A widget that show filter products by brand' );

		/* Create the widget. */
		parent::__construct( 'libero-brand-widget', 'Libero - Woocommerce Filter Brand', $widget_ops);	
	}
	 
	function widget($args, $instance) {
		
		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}

		if ( sizeof( WC()->query->unfiltered_product_ids ) == 0 ) {
			return; // None shown - return
		}
		
		$html = '';
		$html .= $args['before_widget'];
		
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		$html .= '<form action="'. esc_url($actual_link) .'" class="libero-filter-brand">';
		
			$html .= '<div class="libero-title-wrap">';
			if( !empty($instance['title']) ) {
				$html .= $args['before_title'];
					$html .= $instance['title'];
				$html .= $args['after_title'];
			}
			$html .= '<a class="libero-reset-filter" href="#">'. esc_html__('Reset','libero') .'</a>';
			$html .= '</div>';
			
			$brand = get_terms( 'libero-brand', array(
				'orderby'    => 'count',
				'hide_empty' => 0
			 ) );
			if( $brand ) {
				$html .= '<ul class="libero-list-brand">';
				foreach( $brand as $tax ) {
					if( is_object($tax) ) {
						$checked = '';
						$checked = isset($_GET['brand']) && in_array($tax->term_id, $_GET['brand']) ? 'checked="checked"' : '';
						$html .= '<li><input type="checkbox" '. $checked .' name="brand[]" value="'. $tax->term_id .'" />'. $tax->name .'</li>';
					}
				}
				$html .= '</ul>';
			}
			
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				if ( 'brand' === $key ) {
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
			
			$html .= $args['after_widget'];
			
		$html .= '</form>';
		echo force_balance_tags($html);
	}
 
	function update($new_instance, $old_instance) {
		return $new_instance;		
	}
 
	function form($instance) {
		?><br/>
		<label>Title:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>" style="width:100%" /></label>
		<?php
	}
	
}

add_action( 'widgets_init', 'libero_create_filter_widget' );

function libero_create_filter_widget(){
	return register_widget("libero_filter_widget");
}