jQuery(document).ready(function($){
	$('select.libero-layout').each(function(){
		if( $(this).val() == 'columns' ) $(this).parents('.menu-item-settings').find('.libero_show_column_count').show();
		if( $(this).val() == 'categories' ) $(this).parents('.menu-item-settings').find('.libero_show_list_category').show();
	});
	$('select.libero-layout').change(function() {
		if( $(this).val() == 'columns' ) {
			$(this).parents('.menu-item-settings').find('.libero_show_column_count').show();
		}
		else {
			$(this).parents('.menu-item-settings').find('.libero_show_column_count').hide();
		}
		if( $(this).val() == 'categories' ) {
			$(this).parents('.menu-item-settings').find('.libero_show_list_category').show();
		}
		else {
			$(this).parents('.menu-item-settings').find('.libero_show_list_category').hide();
		}
	});
});