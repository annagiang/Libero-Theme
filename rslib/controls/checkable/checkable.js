jQuery(function($) { 
	$(document).bind('rs-control-rebuild.rs-checkable', function(e, box){
		$(box).find('.rs-radio-input').rsCheckAble();
		$(box).find('.rs-checkbox-input').rsCheckAble({
			change: function(event, ui){
				var control = ui.helper.closest('.rs-control');
				if(control.find(':checked').length == 0){
					control.append('<input class="rs-checkbox-default-value" type="hidden" name="' + $(this).attr('name').replace('[]', '') + '" value=""/>');
				}
				else{
					control.find('.rs-checkbox-default-value').remove();
				}
			}
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-checkable', document);
});
