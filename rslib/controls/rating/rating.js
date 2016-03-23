jQuery(function($){
	$(document).bind('rs-control-rebuild.rs-rating', function(e, box){
		$(box).find('.rs-rating-input').each(function(){
			var config = $(this).data('config');
			$(this).rsRating(config);
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-rating', '.rs-rating');
});