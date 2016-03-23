jQuery(window).load( function() {
	$ = jQuery;
	$('.customize-control-repeater .rs-repeater-save').click(function(e){
		e.preventDefault();
		var repeater = $(this).parents('.customize-control-repeater');
		var repeater_input = repeater.find('input.rst-repeater-values[type="hidden"]');
		repeater_input.val( repeater.find('input,select,textarea').serialize() ).trigger('change');
	});
});