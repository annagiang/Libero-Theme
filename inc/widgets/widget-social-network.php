<?php
class libero_social_network_widget extends WP_Widget {
	
	function libero_social_network_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_social', 'description' => 'A widget that show social network' );

		/* Create the widget. */
		parent::__construct( 'libero-social-network-widget', 'Libero - Social Network', $widget_ops);	
	}
	 
	function widget($args, $instance) {
		$html = '';
		$html .= $args['before_widget'];
		if( !empty($instance['title']) ) {
			$html .= $args['before_title'];
				$html .= $instance['title'];
			$html .= $args['after_title'];
		}
		
		$class = array();
		$style = isset($instance['style']) ? $instance['style'] : 1;
		if( $style == 2 ) {
			$class[] = 'libero_social_classic';
		}
		else {
			$class[] = 'libero_social_standar';
		}
		
		$html .= '<div class="'. libero_class($class) .'">';
			
			if( isset($instance['facebook']) && !empty($instance['facebook']) ) {
			$html .= '<a class="libero_facebook_network" href="http://facebook.com/'. $instance['facebook'] .'" target="_blank">';
				$html .= '<i class="fa fa-facebook"></i>';
				$html .= '<span class="libero_network_number">'. number_format(libero_getFacebookLike($instance['facebook'])) .'</span>';
				if( $style == 2 ) {
					$html .= '<span class="libero_network_fans">Fans</span>';
				}
				if( $style == 1 ) {
					$html .= '<span class="libero_network_like">Like</span>';
				}
			$html .= '</a>	';
			}
			
			if( isset($instance['twitter']) && !empty($instance['twitter']) ) {
			$html .= '<a class="libero_twitter_network" href="https://twitter.com/'. $instance['twitter'] .'" target="_blank">';
				$html .= '<i class="fa fa-twitter"></i>';
				$html .= '<span class="libero_network_number">'. number_format(libero_getTwitterFollowers( $instance['twitter'] )) .'</span>';
				if( $style == 2 ) {
					$html .= '<span class="libero_network_fans">Followers</span>';
				}
				if( $style == 1 ) {
					$html .= '<span class="libero_network_like">Follow</span>';
				}
			$html .= '</a>';
			}
			
			if( isset($instance['youtube']) && !empty($instance['youtube']) ) {
			$html .= '<a class="libero_youtube_network" href="https://www.youtube.com/channel/'. $instance['youtube'] .'" target="_blank">';
				$html .= '<i class="fa fa-youtube-play"></i>';
				$html .= '<span class="libero_network_number">'. number_format(libero_getYoutubeSubs($instance['youtube'])) .'</span>';
				if( $style == 2 ) {
					$html .= '<span class="libero_network_fans">Subscribers</span>';
				}
				if( $style == 1 ) {
					$html .= '<span class="libero_network_like">Subscribe</span>';
				}
			$html .= '</a>';
			}
			
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
		<label><?php esc_html_e('Style','libero') ?>:
		<select name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>">
			<option value="1" <?php echo isset($instance['style']) ? selected('1',$instance['style'], false) : '' ?>>Style 1</option>
			<option value="2" <?php echo isset($instance['style']) ? selected('2',$instance['style'], false) : '' ?>>Style 2</option>
		</select></label>
		<br /><br />
		<label><?php esc_html_e('Facebook ID','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" value="<?php echo isset($instance['facebook']) ? esc_attr($instance['facebook']) : ''; ?>" style="width:100%"/></label>
		<br/><br/>
		<label><?php esc_html_e('Twitter ID','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" value="<?php echo isset($instance['twitter']) ? esc_attr($instance['twitter']) : ''; ?>" style="width:100%"/></label>
		<br/><br/>
		<label><?php esc_html_e('Youtube Chanel ID','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" value="<?php echo isset($instance['youtube']) ? esc_attr($instance['youtube']) : ''; ?>" style="width:100%"/></label>
		<br/><br/>
		<?php	
	}

}

add_action( 'widgets_init', 'libero_create_social_network_widget' );

function libero_create_social_network_widget(){
	return register_widget("libero_social_network_widget");
}