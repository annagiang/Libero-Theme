jQuery(function($) { 
	$(document).bind('rs-control-rebuild.rs-postlist', function(e, box){
		$(box).find('.rs-postlist select').each(function(){
			$(this).select2();
		});
	});
	$(document).trigger('rs-control-rebuild.rs-postlist', document);
});