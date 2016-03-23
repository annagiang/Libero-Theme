jQuery(function($) { 
	$(document).bind('rs-control-rebuild.rs-selectbox', function(e, box){
		$(box).find('select.rs-selectbox, .rs-selectbox select').each(function(){
			$(this).rsSelectBox();
		});
	});
	$(document).trigger('rs-control-rebuild.rs-selectbox', document);
});