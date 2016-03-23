<?php
class libero_slider_posts_widget extends WP_Widget {
	
	function libero_slider_posts_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-slider-posts', 'description' => 'A widget that show slider posts' );

		/* Create the widget. */
		parent::__construct( 'libero-slider-post-widget', 'Libero - Slider Posts', $widget_ops);	
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
		
		$html .= '<div class="owl-carousel libero_recent_post_owl">';
		
			$number_posts = isset($instance['number_posts']) ? absint($instance['number_posts']) : 5;
			$number_pages = isset($instance['number_pages']) ? absint($instance['number_pages']) : 2;
			$all_number_posts = $number_posts * $number_pages;
			$args_query = array( 'posts_per_page' => $all_number_posts );
			
			$filter = isset($instance['filter']) ? $instance['filter'] : '';
			switch ($filter) {
			case 'popular_post':
				$args_query['meta_key'] = 'libero_post_views_count';
				$args_query['orderby'] = 'meta_value_num';
				$args_query['order'] = 'DESC';
				break;
			case 'random_post':
				$args_query['orderby'] = 'rand';
				break;
			case 'comment_count':
				$args_query['orderby'] = 'comment_count';
				$args_query['order'] = 'DESC';
				break;
			}
			
			$slider_posts = get_posts( $args_query );
			foreach ( $slider_posts as $key=>$post ) : 
				setup_postdata( $post ); 
				
				if( $key%$number_posts == 0 ) $html .= '<div class="items">';
				$html .= '<div class="libero_recent_post">';
					$html .= '<div class="libero-thumbnail">';
						$html .= '<a href="'. get_permalink() .'">';
							$html .= get_the_post_thumbnail( $post->ID, 'thumbnail' );
						$html .= '</a>';
					$html .= '</div>';
					$html .= '<div class="libero-post-info">';
						$html .= '<h5 class="libero-post-title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h5>';
						$html .= '<span class="libero-date">'. get_the_modified_date() .'</span>';
						$html .= '<a class="libero-comment" href="'. get_permalink() .'/#comment"><span class="count">'. get_comments_number() .'</span> '. esc_html__('Comment','libero') .'</a>';
					$html .= '</div>';
					$html .= '<div class="clear"></div>';
				$html .= '</div>';
				if( $key%$number_posts == ($number_posts-1) ) $html .= '</div>';
			
			endforeach; 
			wp_reset_postdata();
		$html .= '</div>';
		
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
			<option value="recent_post" <?php echo isset($instance['filter']) ? selected('recent_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Recent posts','libero') ?></option>
			<option value="popular_post" <?php echo isset($instance['filter']) ? selected('popular_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Popular posts','libero') ?></option>
			<option value="random_post" <?php echo isset($instance['filter']) ? selected('random_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Random posts','libero') ?></option>
			<option value="comment_count" <?php echo isset($instance['filter']) ? selected('comment_count',$instance['filter'], false) : '' ?>><?php esc_html_e('Most comments posts','libero') ?></option>
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

add_action( 'widgets_init', 'libero_create_slider_posts_widget' );

function libero_create_slider_posts_widget(){
	return register_widget("libero_slider_posts_widget");
}