<?php 
	global $woocommerce_loop; 
	$product_style = isset( $woocommerce_loop['product_style'] ) ? $woocommerce_loop['product_style'] : 1;
	$columns = isset( $woocommerce_loop['columns'] ) ? $woocommerce_loop['columns'] : 3;
	$columns = 'col-sm-'. 12/$columns;
?>
<div class="libero_select_layout libero_product_layout">
	<a class="libero_product_layout_list <?php echo ($product_style == 2 ? 'active' : ''); ?>" data-columns="<?php echo esc_attr($columns) ?>" href="#"><i class="fa fa-th-list"></i></a>
	<a class="libero_product_layout_grid <?php echo ($product_style != 2 ? 'active' : ''); ?>" data-columns="<?php echo esc_attr($columns) ?>" href="#"><i class="fa fa-th-large"></i></a>
</div>