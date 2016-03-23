<?php

class libero_nav_menu_edit_walker extends Walker_Nav_Menu_Edit {
	function libero_get_categories_tree($parent,$value,$item) {
		$html = '';
		$terms = get_terms( 'category', array(
			'orderby'    => 'term_group',
			'order' => 'ASC',
			'parent'	=> $parent,
			'hide_empty' => 0
		));
		if( $terms ){
			$html .= '<ul class="sub-menu">';
				foreach( $terms as $term )
					$html .= '<li><label><input type="checkbox" '. (in_array((string)$term->term_id, $value) ? 'checked="checked"' : '') .' value="'. $term->term_id .'" name="libero_submenu_categories[' . $item->ID . '][]"> '. $term->name .' ( '. $term->count .' )</label>'. $this->libero_get_categories_tree($term->term_id,$value,$item) .'</li>';
			$html .= '</ul>';
		}
		return $html;
	}
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$libero_submenu_style = get_post_meta($item->ID, 'libero_submenu_style', true);
		$libero_submenu_layout = get_post_meta($item->ID, 'libero_submenu_layout', true);
		$libero_submenu_column_count = get_post_meta($item->ID, 'libero_submenu_column_count', true);
		$libero_submenu_categories = is_array(get_post_meta($item->ID, 'libero_submenu_categories', true)) ? get_post_meta($item->ID, 'libero_submenu_categories', true) : array();
		
		$control_buffy = '';
		$control_buffy .= '<p class="field-submenu description description-wide">';
			$control_buffy .= '<label for="">'. esc_html__('Select Sub Menu Style','libero') .'</label><br />';
			$control_buffy .= '<select name="libero_submenu_style[' . $item->ID . ']">';
				$control_buffy .= '<option value="" '. selected($libero_submenu_style, '', false) .'>White</option>';
				$control_buffy .= '<option value="black" '. selected($libero_submenu_style, 'black', false) .'>Black</option>';
			$control_buffy .= '</select>';
		$control_buffy .= '</p>';
		
		if( $item->menu_item_parent == 0 ) {
			$control_buffy .= '<p class="field-submenu description description-wide">';
				$control_buffy .= '<label for="">'. esc_html__('Select Sub Menu Layout','libero') .'</label><br />';
				$control_buffy .= '<select class="libero-layout" name="libero_submenu_layout[' . $item->ID . ']">';
					$control_buffy .= '<option value="" '. selected($libero_submenu_layout, '', false) .'>Default</option>';
					$control_buffy .= '<option value="columns" '. selected($libero_submenu_layout, 'columns', false) .'>Columns</option>';
					$control_buffy .= '<option value="categories" '. selected($libero_submenu_layout, 'categories', false) .'>Categories</option>';
				$control_buffy .= '</select>';
			$control_buffy .= '</p>';
			
			$control_buffy .= '<p class="field-submenu description description-wide libero_show_column_count" style="display:none;">';
				$control_buffy .= '<label for="">'. esc_html__('Select Columns Count','libero') .'</label><br />';
				$control_buffy .= '<select name="libero_submenu_column_count[' . $item->ID . ']">';
					$control_buffy .= '<option value="4" '. selected($libero_submenu_column_count, '4', false) .'>4 Columns</option>';
					$control_buffy .= '<option value="3" '. selected($libero_submenu_column_count, '3', false) .'>3 Columns</option>';
					$control_buffy .= '<option value="2" '. selected($libero_submenu_column_count, '2', false) .'>2 Columns</option>';
				$control_buffy .= '</select>';
			$control_buffy .= '</p>';
			
			$control_buffy .= '<div class="field-submenu description description-wide libero_show_list_category" style="display:none;">';
				$control_buffy .= '<label for="">'. esc_html__('Select Categories','libero') .'</label><br />';
				$control_buffy .= '<ul class="libero_menu_categories">';
				$terms = get_terms( 'category', array(
					'orderby'    => 'term_group',
					'order' => 'ASC',
					'hide_empty' => 0,
					'parent' => 0
				));
				foreach ( $terms as $key=>$term ) {
					$control_buffy .= '<li><label>';
					$control_buffy .= '<input type="checkbox" '. (in_array((string)$term->term_id, $libero_submenu_categories) ? 'checked="checked"' : '') .' value="'. $term->term_id .'" name="libero_submenu_categories[' . $item->ID . '][]" /> '. $term->name .' ( '. $term->count .' )';
					$control_buffy .= $this->libero_get_categories_tree($term->term_id, $libero_submenu_categories,$item);
					$control_buffy .= '</label></li>';
				}
				$control_buffy .= '</ul>';
			$control_buffy .= '</div>';
		}
		
		
        parent::start_el($buffy, $item, $depth, $args, $id);
        $buffy = preg_replace('/(?=<div.*submitbox)/', $control_buffy, $buffy);
        $output .= $buffy;
    }
}