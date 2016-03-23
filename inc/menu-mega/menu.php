<?php

//function to get array to comparse to get title column
function libero_get_all_wordpress_menu_for_comparse(){
    $array_nav_menu = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$array_nav_menu_out = array();
	if($array_nav_menu) foreach($array_nav_menu as $items){
		$array_nav_menu_out[$items->term_taxonomy_id] = $items->name;
	}
	return $array_nav_menu_out;
}

class libero_global_blocks {
    private static $global_instances = array();
    static function add_instance($block_name, $block_instance) {
        self::$global_instances[$block_instance->block_id] = array (
            'id' => $block_instance->block_id,
            'name' => $block_name,
            'instance' => $block_instance
        );
    }
    static function get_instance($block_id) {
        return self::$global_instances[$block_id]['instance'];
    }
    /**
     * map all the blocks in the pagebuilder
     */
    static function wpb_map_all() {
        foreach (self::$global_instances as $block_array) {
            //map in visual composer only classes that have get_map!
            //the mega menu block doesn't have map
            if (method_exists($block_array['instance'], 'get_map')) {
                wpb_map($block_array['instance']->get_map());
            }
        }
    }
    static function debug_get_all_instances() {
        return self::$global_instances;
    }
}
// the menu
class libero_menu {
    var $is_header_menu_mobile = true;
    function __construct() {
        if (is_admin()) {
            add_action('wp_update_nav_menu_item', array( $this, 'hook_wp_update_nav_menu_item'), 10, 3);
            add_filter('wp_edit_nav_menu_walker', array($this, 'hook_wp_edit_nav_menu_walker'));
        }
        add_filter('wp_nav_menu_objects', array($this, 'hook_wp_nav_menu_objects'),  10, 2);
    }
    function hook_wp_edit_nav_menu_walker () {
		include(get_template_directory().'/inc/menu-mega/menu_backend.php');
        return 'libero_nav_menu_edit_walker';
    }
    function hook_wp_update_nav_menu_item ($menu_id, $menu_item_db_id, $args) {
        if (isset($_POST['libero_submenu_style'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, 'libero_submenu_style', $_POST['libero_submenu_style'][$menu_item_db_id]);
        }
		if (isset($_POST['libero_submenu_layout'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, 'libero_submenu_layout', $_POST['libero_submenu_layout'][$menu_item_db_id]);
        }
		if (isset($_POST['libero_submenu_column_count'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, 'libero_submenu_column_count', $_POST['libero_submenu_column_count'][$menu_item_db_id]);
        }
		if (isset($_POST['libero_submenu_categories'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, 'libero_submenu_categories', $_POST['libero_submenu_categories'][$menu_item_db_id]);
        }
    }
    function hook_wp_nav_menu_objects($items, $args = '') {
        $items_buffy = array();
        foreach ($items as &$item) {
            
			$item->is_mega_menu = false;
            
			//is mega menu?
            $libero_submenu_style = get_post_meta($item->ID, 'libero_submenu_style', true);
            $libero_submenu_layout = get_post_meta($item->ID, 'libero_submenu_layout', true);
            $libero_submenu_column_count = get_post_meta($item->ID, 'libero_submenu_column_count', true);
            $libero_submenu_categories = get_post_meta($item->ID, 'libero_submenu_categories', true);
			
			//Submenu Style
			if(isset($libero_submenu_style) && $libero_submenu_style == 'black'){
				$item->classes[] = 'libero-submenu-black';
			}
			
			//Submenu Columns
			if(isset($libero_submenu_layout) && $libero_submenu_layout == 'columns'){
				$item->classes[] = 'libero-mega-menu';
			}
			
			if( $item->menu_item_parent != 0 ) {
				$parent_ID = $item->menu_item_parent;
				$libero_submenu_layout_parent = get_post_meta($parent_ID, 'libero_submenu_layout', true);
				if( isset($libero_submenu_layout_parent) && $libero_submenu_layout_parent == 'columns' ) {
					$libero_submenu_column_count_parent = get_post_meta($parent_ID, 'libero_submenu_column_count', true) ? get_post_meta($parent_ID, 'libero_submenu_column_count', true) : 4;
					$libero_submenu_column_count_parent = 12/absint($libero_submenu_column_count_parent);
					$item->classes[] = "col-sm-$libero_submenu_column_count_parent";
				}
			}
			
			//Submenu Categories
			if(isset($libero_submenu_layout) && $libero_submenu_layout == 'categories'){
				$item->classes[] = 'libero-mega-menu';
				$item->classes[] = 'libero-mega-menu-categories';
				$item->title .= '</a>';
				$item->title .= '<div class="libero-mega-categories sub-menu">';
					$item->title .= '<div class="libero-mega-child-cats col-sm-3">';
						$item->title .= '<div class="libero-list-cat">';
							$item->title .= $this->libero_get_categories($libero_submenu_categories);
						$item->title .= '</div>';
					$item->title .= '</div>';
					$item->title .= '<div class="libero-menu-posts-cat col-sm-9">';
						$item->title .= '<div class="libero-list-post">';
							$item->title .= $this->libero_get_posts_categories($libero_submenu_categories);
						$item->title .= '</div>';
					$item->title .= '</div>';
				$item->title .= '</div>';
				$item->title .= '<a class="libero-remove">';
			}
			
			$items_buffy[] = $item;
			
        } //end foreach
		
        return $items_buffy;
    }
	
	function libero_get_categories($args) {
		$args_query = array();
		$html = '';
		if( sizeof($args) ) {
			$args_query['include'] = implode(",", $args);
		}
		$categories = get_categories( $args_query );
		foreach( $categories as $key=>$cat ) {
			$class = $key==0 ? 'current' : '';
			$html .= '<a class="libero-sub-cat '. $class .'" href="'. get_category_link($cat->term_id) .'">'. $cat->name .'</a>';
		}
		return $html;
	}
	
	function libero_get_posts_categories($args) {
		if( ! is_array($args) ) return '';
		$html = '';
		foreach( $args as $key=>$cat ) {
			$class = $key==0 ? 'current' : '';
			$html .= '<div class="libero-posts-category '. $class .'">';
				$html .= $this->libero_get_posts($cat);
			$html .= '</div>';
		}
		return $html;
	}
	
	function libero_get_posts($cat_id) {
		global $post;
		$args = array(
			'posts_per_page'   => 3,
			'category'         => $cat_id
		);
		$html = '';
		$cat_posts = get_posts( $args );
		foreach( $cat_posts as $post ) {
			setup_postdata($post);
			$html .= '<div class="libero-post-category col-sm-4">';
				$html .= '<a class="libero-thumbnail" href="'. get_permalink() .'">'. get_the_post_thumbnail(get_the_ID(), 'libero-medium') .'</a>';
				$html .= '<a href="'. get_permalink() .'">'. get_the_title() .'</a>';
			$html .= '</div>';
		}
		wp_reset_postdata();
		return $html;
	}
}
new libero_menu();

/**
 * Proper way to enqueue scripts and styles
 */
function libero_menu_mega_scripts() {
	wp_enqueue_script( 'libero-script-menu-mega', get_template_directory_uri() . '/inc/menu-mega/mega_menu.js', array('jquery'), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'libero_menu_mega_scripts' );
