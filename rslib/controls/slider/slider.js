jQuery(function($) {
	$(document).bind('rs-control-rebuild.slider-range', function(e, box){
		
		var slider_range = $(box).find(".slider-range");
		slider_range.each(function(){
			var slider_wrap = $(this).parents('.rs-slider');
			var slider_inp = slider_wrap.find(".rs-slider-input");
			var range = slider_inp.attr('data-range');
			
			if( range == 'min' || range == 'max' ) {
				$(this).slider({
					range: range,
					value: parseFloat(slider_inp.val()),
					min: parseFloat(slider_inp.attr('data-min')),
					max: parseFloat(slider_inp.attr('data-max')),
					step: parseFloat(slider_inp.attr('data-step')),
					create: function( event, ui ) {
						slider_wrap.find(".ui-slider-handle").append( '<span>'+ slider_inp.attr('data-before-text') + slider_inp.val() + slider_inp.attr('data-after-text') +'</span>');
					},
					slide: function( event, ui ) {
						
						slider_inp.val( ui.value );
						slider_wrap.find(".ui-slider-handle span").html( slider_inp.attr('data-before-text') + ui.value + slider_inp.attr('data-after-text') );
						
					}
				});
			}
			if( range == 'slider' ) {
				slider_val = slider_inp.val();
				slider_val_1 = parseFloat(slider_val.split('-')[0]);
				slider_val_2 = parseFloat(slider_val.split('-')[1]);
				$(this).slider({
					range: true,
					values: [ slider_val_1, slider_val_2 ],
					min: parseFloat(slider_inp.attr('data-min')),
					max: parseFloat(slider_inp.attr('data-max')),
					step: parseFloat(slider_inp.attr('data-step')),
					create: function( event, ui ) {
						slider_wrap.find(".ui-slider-handle:eq(0)").append( '<span>'+ slider_inp.attr('data-before-text') + slider_val_1 + slider_inp.attr('data-after-text') +'</span>');
						slider_wrap.find(".ui-slider-handle:eq(1)").append( '<span>'+ slider_inp.attr('data-before-text') + slider_val_2 + slider_inp.attr('data-after-text') +'</span>');
					},
					slide: function( event, ui ) {
						slider_inp.val( ui.values[ 0 ] + '-' + ui.values[ 1 ] );
						slider_wrap.find(".ui-slider-handle:first span").html( slider_inp.attr('data-before-text') + ui.values[ 0 ] + slider_inp.attr('data-after-text') );
						slider_wrap.find(".ui-slider-handle:last span").html( slider_inp.attr('data-before-text') + ui.values[ 1 ] + slider_inp.attr('data-after-text') );
					}
				});
			}
		});
	});
	$(document).trigger('rs-control-rebuild.slider-range', '.rs-slider');
	
});
