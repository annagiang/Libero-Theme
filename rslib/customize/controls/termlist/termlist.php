<?php
class WP_Customize_Term_List_Control extends WP_Customize_Control {
    public $type = 'term-list';
 
	public function __construct( $manager, $id, $args = array() ) {
		$keys = array_keys( get_object_vars( $this ) );
		foreach ( $keys as $key ) {
			if ( isset( $args[ $key ] ) ) {
				$this->$key = $args[ $key ];
			}
		}

		$this->manager = $manager;
		$this->id = $id;
		if ( empty( $this->active_callback ) ) {
			$this->active_callback = array( $this, 'active_callback' );
		}
		self::$instance_count += 1;
		$this->instance_number = self::$instance_count;

		// Process settings.
		if ( empty( $this->settings ) ) {
			$this->settings = $id;
		}

		$settings = array();
		if ( is_array( $this->settings ) ) {
			foreach ( $this->settings as $key => $setting ) {
				$settings[ $key ] = $this->manager->get_setting( $setting );
			}
		} else {
			$this->setting = $this->manager->get_setting( $this->settings );
			$settings['default'] = $this->setting;
		}
		$this->settings = $settings;
		
		$this->args_settings = $args;
	}
	
    public function render_content() {
      
		$name = '_customize-term-list-' . $this->id;
		$args_settings = $this->args_settings;
		
		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo force_balance_tags($this->description) ; ?></span>
		<?php endif;
		
		$taxonomy = isset($args_settings['taxonomy']) ? $args_settings['taxonomy'] : 'category';
		$multiple = isset($args_settings['multiple']) ? $args_settings['multiple'] : false;
		
		$multi = $multiple ? 'multiple' : '';
		
		$args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => true, 
			'exclude'           => array(), 
			'exclude_tree'      => array(), 
			'include'           => array(),
			'number'            => '', 
			'fields'            => 'all', 
			'slug'              => '',
			'parent'            => '',
			'hierarchical'      => true, 
			'child_of'          => 0,
			'childless'         => false,
			'get'               => '', 
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false, 
			'offset'            => '', 
			'search'            => '', 
			'cache_domain'      => 'core'
		); 
		
		$query = isset($args_settings['query']) ? array_merge($args, $args_settings['query']) : $args;
		
		$elements = get_terms( $taxonomy, $query );
		?>
			<select style="width:100%" <?php echo esc_html($multi) ?> <?php $this->link(); ?>>
				<?php foreach( $elements as $item ) { ?>
				<option <?php echo selected( $this->value(), $item->slug, false ) ?> value="<?php echo force_balance_tags($item->slug) ?>"><?php echo force_balance_tags($item->name) ?></option>
				<?php } ?>
			</select>
		<?php
    }
	
}