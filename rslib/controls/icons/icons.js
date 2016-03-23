jQuery(function($) { 
	
	$(document).bind('rs-control-rebuild.rs-icons', function(e, box){
		$(box).find('.rs-icon-div').unbind('click').click(function(){
			$(this).parent().find('.rs-icons-list').toggle();
		});
		$(box).find('.rs-icons-list ul li').unbind('click').click(function(){
			$(this).parents('.rs-control.rs-icons').find('.rs-icon-preview').attr('class', 'rs-icon-preview').addClass($(this).attr('class'));
			$(this).parents('.rs-control.rs-icons').find('.rs-icon-input').val($(this).attr('class'));
			$(this).parents('.rs-icons-list').hide();
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-icons', document);
});
