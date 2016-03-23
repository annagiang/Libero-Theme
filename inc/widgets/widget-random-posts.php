<?php
class libero_random_posts_widget extends WP_Widget {
	
	function libero_random_posts_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-random-post', 'description' => 'A widget that show list posts' );

		/* Create the widget. */
		parent::__construct( 'libero-random-post-widget', 'Libero - List Posts', $widget_ops);	
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
		$libero_custom_class = array();
		$libero_custom_class[] = 'libero-random-post';
		$libero_size = 'thumbnail';
		if( (isset($instance['hide_date']) && $instance['hide_date'] == 1) ) { 
			$libero_custom_class[] = 'libero-hide-date';
		}
		if( (isset($instance['style']) && $instance['style'] == 2) ) { 
			$libero_custom_class[] = 'libero-ramdom-style-2';
			$libero_size = 'libero-medium';
		}
		$html .= '<ul class="'. libero_class($libero_custom_class) .'">';
			$number_posts = $instance['number_posts'] ? absint($instance['number_posts']) : 3;
			$args_query = array( 'posts_per_page' => $number_posts );
			
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
			
			$rand_posts = get_posts( $args_query );
			foreach ( $rand_posts as $post ) : 
				setup_postdata( $post ); 
				
				$html .= '<li>';
					if( has_post_thumbnail() ) {
					$html .= '<div class="libero-thumbnail">';
						$html .= '<a href="'. get_permalink() .'">';
							$html .= get_the_post_thumbnail( $post->ID, $libero_size );
						$html .= '</a>';
					$html .= '</div>';
					}
					$html .= '<div class="libero-post-info">';
						$html .= '<h3 class="libero-post-title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>';
						
						if( ! (isset($instance['hide_date']) && $instance['hide_date'] == 1) ) { 
							$html .= '<span class="libero-date">'. get_the_modified_date() .'</span>';
						}
						if( ! (isset($instance['hide_comment']) && $instance['hide_comment'] == 1) ) { 
							$html .= '<a class="libero-comment" href="'. get_permalink() .'/#comment"><span class="count">'. get_comments_number() .'</span> '. esc_html__('Comment','libero') .'</a>';
						}
					$html .= '</div>';
					$html .= '<div class="clear"></div>';
				$html .= '</li>';
				
			endforeach; 
			wp_reset_postdata();
		$html .= '</ul>';
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
		<label><?php esc_html_e('Number Posts','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'number_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_posts' )); ?>" value="<?php echo isset($instance['number_posts']) ? absint($instance['number_posts']) : 3; ?>" /></label>
		<br /><br />
		<label><?php esc_html_e('Filter','libero') ?>:
		<select name="<?php echo esc_attr($this->get_field_name( 'filter' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'filter' )); ?>">
			<option value="recent_post" <?php echo isset($instance['filter']) ? selected('recent_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Recent posts','libero') ?></option>
			<option value="popular_post" <?php echo isset($instance['filter']) ? selected('popular_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Popular posts','libero') ?></option>
			<option value="random_post" <?php echo isset($instance['filter']) ? selected('random_post',$instance['filter'], false) : '' ?>><?php esc_html_e('Random posts','libero') ?></option>
			<option value="comment_count" <?php echo isset($instance['filter']) ? selected('comment_count',$instance['filter'], false) : '' ?>><?php esc_html_e('Most comments posts','libero') ?></option>
		</select></label>
		<br /><br />
		<label><?php esc_html_e('Style','libero') ?>:
		<select name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>">
			<option <?php isset($instance['style']) ? selected($instance['style'],1) : '' ?> value="1">Style 1</option>
			<option <?php isset($instance['style']) ? selected($instance['style'],2) : '' ?> value="2">Style 2</option>
		</select></label>
		<br /><br />
		<label><?php esc_html_e('Hidden Date','libero') ?>:
		<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'hide_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'hide_date' )); ?>" <?php isset($instance['hide_date']) ? checked($instance['hide_date'],1) : '' ?> value="1" /></label>
		<br /><br />
		<label><?php esc_html_e('Hidden Comment Count','libero') ?>:
		<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'hide_comment' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'hide_comment' )); ?>" <?php isset($instance['hide_comment']) ? checked($instance['hide_comment'],1) : '' ?> value="1" /></label>
		
		<?php	
	}
	
}

add_action( 'widgets_init', 'libero_create_random_posts_widget' );

function libero_create_random_posts_widget(){
	return register_widget("libero_random_posts_widget");
}