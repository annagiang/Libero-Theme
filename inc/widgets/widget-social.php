<?php
class libero_social_widget extends WP_Widget {
	
	function libero_social_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_social', 'description' => 'A widget that show social network' );

		/* Create the widget. */
		parent::__construct( 'libero-social-widget', 'Libero - List Social', $widget_ops);	
	}
	 
	function widget($args, $instance) {
		$html = '';
		$html .= $args['before_widget'];
		if( !empty($instance['title']) ) {
			$html .= $args['before_title'];
				$html .= $instance['title'];
			$html .= $args['after_title'];
		}
		
		$html .= '<ul class="libero-social">';
			if( !empty($instance['facebook']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['facebook']) .'"><i class="fa fa-facebook"></i></a></li>';
			}
			if( !empty($instance['google']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['google']) .'"><i class="fa fa-google-plus"></i></a></li>';
			}
			if( !empty($instance['twitter']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['twitter']) .'"><i class="fa fa-twitter"></i></a></li>';
			}
			if( !empty($instance['tumblr']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['tumblr']) .'"><i class="fa fa-tumblr"></i></a></li>';
			}
			if( !empty($instance['instagram']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['instagram']) .'"><i class="fa fa-instagram"></i></a></li>';
			}
			if( !empty($instance['youtube']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['youtube']) .'"><i class="fa fa-youtube"></i></a></li>';
			}
			if( !empty($instance['linkedin']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['linkedin']) .'"><i class="fa fa-linkedin"></i></a></li>';
			}
			if( !empty($instance['flickr']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['flickr']) .'"><i class="fa fa-flickr"></i></a></li>';
			}
			if( !empty($instance['vimeo']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['vimeo']) .'"><i class="fa fa-vimeo-square"></i></a></li>';
			}
			if( !empty($instance['pinterest']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['pinterest']) .'"><i class="fa fa-pinterest-p"></i></a></li>';
			}
			if( !empty($instance['dribbble']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['dribbble']) .'"><i class="fa fa-dribbble"></i></a></li>';
			}
			if( !empty($instance['skype']) ) {
			$html .= '<li><a target="_blank" href="'. esc_url($instance['skype']) .'"><i class="fa fa-skype"></i></a></li>';
			}
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
		<label><?php esc_html_e('Facebook','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" value="<?php echo isset($instance['facebook']) ? esc_attr($instance['facebook']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Twitter','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" value="<?php echo isset($instance['twitter']) ? esc_attr($instance['twitter']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Google plus','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'google' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google' )); ?>" value="<?php echo isset($instance['google']) ? esc_attr($instance['google']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Tumblr','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tumblr' )); ?>" value="<?php echo isset($instance['tumblr']) ? esc_attr($instance['tumblr']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Instagram','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" value="<?php echo isset($instance['instagram']) ? esc_attr($instance['instagram']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Youtube','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" value="<?php echo isset($instance['youtube']) ? esc_attr($instance['youtube']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Linkedin','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" value="<?php echo isset($instance['linkedin']) ? esc_attr($instance['linkedin']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Flickr','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr' )); ?>" value="<?php echo isset($instance['flickr']) ? esc_attr($instance['flickr']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Vimeo','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'vimeo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo' )); ?>" value="<?php echo isset($instance['vimeo']) ? esc_attr($instance['vimeo']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Pinterest','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" value="<?php echo isset($instance['pinterest']) ? esc_attr($instance['pinterest']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Dribbble','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'dribbble' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble' )); ?>" value="<?php echo isset($instance['dribbble']) ? esc_attr($instance['dribbble']) : ''; ?>" style="width:100%" /></label>
		<br /><br />
		<label><?php esc_html_e('Skype','libero') ?>:
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype' )); ?>" value="<?php echo isset($instance['skype']) ? esc_attr($instance['skype']) : ''; ?>" style="width:100%" /></label>
		<?php	
	}

}

add_action( 'widgets_init', 'libero_create_social_widget' );

function libero_create_social_widget(){
	return register_widget("libero_social_widget");
}