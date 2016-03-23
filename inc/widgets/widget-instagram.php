<?php
class libero_instagram_widget extends WP_Widget {
	
	function libero_instagram_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-instagram', 'description' => 'A widget that show images instagram account' );

		/* Create the widget. */
		parent::__construct( 'libero-instagram-widget', 'Libero - Instagram', $widget_ops);	
	}
	 
	function widget($args, $instance) {
		$html = '';
		$html .= $args['before_widget'];
		if( !empty($instance['title']) ) {
			$html .= $args['before_title'];
				$html .= $instance['title'];
			$html .= $args['after_title'];
		}
		$html .= '<div class="widget-wrap">';
			$html .= '<ul class="clearfix">';
				
				$userID = isset($instance['user_id']) ? $instance['user_id'] : '';
				$access_token = isset($instance['access_token']) ? $instance['access_token'] : '';
				$count = isset($instance['count']) ? absint($instance['count']) : 9;
				
				$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent/?access_token='.$access_token;
				$content = wp_remote_retrieve_body(wp_remote_get($url, array( 'decompress' => false, 'timeout' => 120, 'httpversion' => '1.1' )));
				if( $content ) {
					$json = json_decode($content, true);
					if( is_array($json['data']) ){
						$i = 0; 
						foreach ($json['data'] as $vm): 
							if($count == $i){ break;}
							$i++;
							$img = $vm['images']['low_resolution']['url'];
							$link = $vm["link"];
							$html .= '<li><a target="_blank" href="'. $link .'">';
								$html .= '<img class="img-responsive" alt="" src="'. $img .'" />';
							$html .= '</a></li>';
						endforeach;
					}
				}
				
				
			$html .= '</ul>';
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
		<label><?php esc_html_e('User ID','libero') ?>:<input type="text" id="<?php echo esc_attr($this->get_field_id( 'user_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_id' )); ?>" value="<?php echo isset($instance['user_id']) ? esc_attr($instance['user_id']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Access token','libero') ?>:<input type="text" id="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token' )); ?>" value="<?php echo isset($instance['access_token']) ? esc_attr($instance['access_token']) : ''; ?>" style="width:100%" /></label>
		<i>Go to <a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=467ede5a6b9b48ae8e03f4e2582aeeb3&redirect_uri=http://instafeedjs.com&response_type=token"><u>website</u></a> and login instagram account to get userID and Access Token</i>
		<br /><br />
		<label><?php esc_html_e('Number Photo','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo isset($instance['count']) ? esc_attr($instance['count']) : '9'; ?>" style="width:100%" /></label>
		
		<?php	
	}

}

add_action( 'widgets_init', 'libero_create_instagram_widget' );

function libero_create_instagram_widget(){
	return register_widget("libero_instagram_widget");
}