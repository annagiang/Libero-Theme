jQuery(window).load(function($){
	$ = jQuery;
	var winwidth = jQuery(window).width();
	if ( winwidth > 767 ) {
		jQuery("#sidebar").stickit({
			scope: StickScope.Parent,
			top: 0
		});
		jQuery(".libero-sidebar-sticky").stickit({
			scope: StickScope.Parent,
			top: 0
		});	
	}
	var key = false;
	jQuery(window).resize(function($){
		var winwidth = jQuery(window).width();
		if ( winwidth > 767 ) {
			if ( key == true) {
				jQuery("#sidebar").stickit({
					scope: StickScope.Parent,
					top: 0
				});
				jQuery(".libero-sidebar-sticky").stickit({
					scope: StickScope.Parent,
					top: 0
				});	
				key = false;
			}
		} else {
			key = true;
			jQuery("#sidebar").stickit('destroy');
			jQuery(".libero-sidebar-sticky").stickit('destroy');	
		}
		
	});
	$(window).trigger('scroll');
	
});
