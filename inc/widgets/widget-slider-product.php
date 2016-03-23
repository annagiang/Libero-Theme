<?php
class libero_slider_products_widget extends WP_Widget {
	
	function libero_slider_products_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-slider-products', 'description' => 'A widget that show slider products' );

		/* Create the widget. */
		parent::__construct( 'libero-slider-products-widget', 'Libero - Slider Products', $widget_ops);	
	}
	 
	function widget($args, $instance) {
		global $post;
		$html = '';
		$html .= $args['before_widget'];
		if( !empty($instance['title']) ) {
			$html .= $args['before_title'];
				$html .= $instance['title'];
			$html .= $args['after_title'];
		}
		
		$number_posts = isset($instance['number_posts']) ? absint($instance['number_posts']) : 5;
		$number_pages = isset($instance['number_pages']) ? absint($instance['number_pages']) : 2;
		$all_number_posts = $number_posts * $number_pages;
		$args_query = array( 'posts_per_page' => $all_number_posts, 'post_type'	=> 'product' );
		
		$filter = isset($instance['filter']) ? $instance['filter'] : '';
		switch ($filter) {
		case 'top_selles':
			$args_query['meta_key'] = 'total_sales';
			$args_query['orderby'] = 'meta_value_num';
			$args_query['order'] = 'DESC';
			break;
		case 'best_rated':
			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
			$args_query['meta_query'] = WC()->query->get_meta_query();
			break;
		case 'random_post':
			$args_query['orderby'] = 'rand';
			break;
		case 'comment_count':
			$args_query['orderby'] = 'comment_count';
			$args_query['order'] = 'DESC';
			break;
		}
		
		$slider_products = get_posts( $args_query );
		if( $slider_products ) :
			$html .= '<div class="owl-carousel libero_recent_post_owl">';
				
				foreach ( $slider_products as $key=>$post ) : 
					setup_postdata( $post ); 
					if( $key%$number_posts == 0 ) $html .= '<ul class="product_list_widget items">';
						$html .= libero_get_template_part_theme( 'woocommerce/content', 'widget-product' );
					if( $key%$number_posts == ($number_posts-1) ) $html .= '</ul>';
				endforeach; 
				
			$html .= '</div>';
		else:
			$html .= '<p class="woocommerce-info">'. esc_html_e( 'No products were found matching your selection.', 'libero' ) .'</p>';
		endif; 
		wp_reset_postdata();
		
		$html .= $args['after_widget'];
		echo force_balance_tags($html);
	}
 
	function update($new_instance, $old_instance) {
		return $new_instance;		
	}
 
	function form($instance) {
		?><br/>
		<label><?php esc_html_e('Title','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Filter','libero') ?>:
		<select name="<?php echo esc_attr($this->get_field_name( 'filter' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'filter' )); ?>">
			<option value="recent_post" <?php echo isset($instance['filter']) ? selected('recent_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Recent products','libero') ?></option>
			<option value="top_selles" <?php echo isset($instance['filter']) ? selected('top_selles',$instance['filter'], false) : '' ?>><?php esc_html_e('Top Sellers','libero') ?></option>
			<option value="best_rated" <?php echo isset($instance['filter']) ? selected('best_rated',$instance['filter'], false) : '' ?>><?php esc_html_e('Top Rated','libero') ?></option>
			<option value="random_post" <?php echo isset($instance['filter']) ? selected('random_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Random products','libero') ?></option>
			<option value="comment_count" <?php echo isset($instance['filter']) ? selected('comment_count',$instance['filter'], false) : '' ?>><?php esc_html_e('Most comments products','libero') ?></option>
		</select></label>
		<br /><br />
		<label><?php esc_html_e('Posts per page','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'number_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_posts' )); ?>" value="<?php echo isset($instance['number_posts']) ? absint($instance['number_posts']) : 5; ?>" /></label>
		<br /><br />
		<label><?php esc_html_e('Number Pages','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'number_pages' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_pages' )); ?>" value="<?php echo isset($instance['number_pages']) ? absint($instance['number_pages']) : 2; ?>" /></label>
		<?php	
	}
	
}

add_action( 'widgets_init', 'libero_create_slider_products_widget' );

function libero_create_slider_products_widget(){
	return register_widget("libero_slider_products_widget");
}