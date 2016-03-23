jQuery(document).ready( function($) {
	$('.customize-control-font select').live('change',function(){
		box_font = $(this).closest('.customize-control-font');
		input_save =  box_font.find('input.rst-font-items');
		font_family = box_font.find('select.rst-font-sel-family').val();
		font_weight = box_font.find('.rst-font-sel-weight').val();
		font_style = box_font.find('.rst-font-sel-style').val();
		font_size = box_font.find('.rst-font-sel-size').val();
		font_height = box_font.find('.rst-font-sel-height').val();
		font_spacing = box_font.find('.rst-font-sel-spacing').val();
		font_transform = box_font.find('.rst-font-sel-transform').val();
		array_value = 
			{
				'font-family': font_family,
				'font-weight': font_weight,
				'font-style': font_style,
				'font-size': font_size,
				'line-height': font_height,
				'letter-spacing': font_spacing,
				'text-transform': font_transform
			}
		input_save.val(serialize(array_value));
		input_save.trigger('change');
		
	});
	$('select.rst-font-sel-family').each(function(){
		$(this).select2();
	});
});