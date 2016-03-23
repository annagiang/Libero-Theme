jQuery(function($) { 

	$(document).bind('rs-control-rebuild.rs-colorpicker', function(e, box){
		$(box).find('.rs-colorpicker-trigger').ColorPicker({
			color: $(this).prev().val(),
			onSubmit: function(hsb, hex, rgb, el){
				$(el).ColorPickerHide();
			},
			onShow: function (colpkr) {
				$(colpkr).css({'left': '-=184', 'top': '+=4'}).stop(true,false).fadeIn(500);
				if(parseInt($(colpkr).css('left')) < $(this).prev().offset().left){
					$(colpkr).css('left', $(this).prev().offset().left);
				}
			},
			onHide: function (colpkr,x) {
				console.log(x);
				$($(colpkr).data('colorpicker').el).prev().addClass('changed').trigger('change');
			},
			onChange: function (hsb, hex, rgb) {
				$($(this).data('colorpicker').el).prev().val('#' + hex);
				$($(this).data('colorpicker').el).css('background', '#' + hex);
			}
		}).each(function(){
			$(this).ColorPickerSetColor($(this).prev().val());
			$(this).css('background', $(this).prev().val());
		});
		
		$(box).find('.rs-colorpicker-trigger').prev().change(function(){
			if($(this).is('.changed')){
				$(this).removeClass('changed');
			}
			else{
				var hex = $.Color($(this).val()).toHexString();
				if(hex != $(this).val() && $(this).val() != ''){
					$(this).val(hex).addClass('changed').trigger('change');
				}
				$(this).next().css('background', hex).ColorPickerSetColor(hex);
			}
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-colorpicker', '.rs-colorpicker');
});
