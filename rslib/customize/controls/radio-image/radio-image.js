jQuery(document).ready( function($) {
	$('input.radioImageSelect').radioImageSelect();
	$('.customize-control-radio-image label').click(function(){
		$(this).find('input').trigger('change');
	});
} );