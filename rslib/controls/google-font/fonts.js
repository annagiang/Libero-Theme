jQuery(function($) { 
	$(document).bind('rs-control-rebuild.rs-googlefonts', function(e, box){
		$(box).find('.rs-googlefonts').each(function(){
			if(!$(this).data('loaded')){
				$(this).data('loaded', true);
				
				$(this).find('option:lt(10)').each(function(){
					$.getStyle('http://fonts.googleapis.com/css?family=' + $(this).val());
				});
				
				$(this).find('.rs-select-item').each(function(){
					var data = $(this).attr('data-value');
					if(data){
						if(/italic/i.test(data)) $(this).css('font-style', 'italic');
						if(/bold/i.test(data)) $(this).css('font-weight', 'bold');
						if(/\d+/i.test(data)) $(this).css('font-weight', data.match(/\d+/)[0]);
						$(this).css('font-family', data.split(':')[0]);
					}
				});
			}
		});
	});
	$(document).trigger('rs-control-rebuild.rs-googlefonts', document);
});