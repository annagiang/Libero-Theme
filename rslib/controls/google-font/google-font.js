jQuery(function($){
	$('.rs-googlefonts').each(function(){
		$(this).find('select').val($(this).data('value'));
	});
});