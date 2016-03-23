jQuery(function($) {
	$(document).bind('rs-control-rebuild.rs-datetime', function(e, box){
		//// Date ////
		var date_inp = $(box).find(".rs-datepicker-input");
		date_inp.filter('.hasDatepicker').removeClass('hasDatepicker').next('.ui-datepicker-trigger').remove();
		date_inp.each(function(){
			$(this).datepicker({
				showOn: 'button',
				dateFormat: $(this).attr('data-date-format'),
				onSelect: function( date_string, inst){
					inst.input.data('selected', true).trigger('change');
				}
			}).unbind('change').change(function(event){
				if(!$(this).data('selected')){
					try{
						jQuery.datepicker.parseDate($(this).attr('data-date-format'), $(this).val());
					}
					catch(ex){
						var date = new Date($(this).val());
						$(this).val(isNaN(date.getDay()) ? '' : jQuery.datepicker.formatDate($(this).attr('data-date-format'), date));
					}
				}
				$(this).removeData('selected');
				var parent = $(this).closest('.rs-control');
				if(parent.is('.rs-datetime')){
					if($(this).val().trim() == ''){
						parent.find('.rs-datetime-input').val('');
					}
					else{
						var date = $(this).datepicker('getDate');
						date_string = parent.find('.rs-timepicker-input').val();
						if(date_string.trim() == ''){
							date_string = jQuery.datepicker.formatDate('yy-mm-dd', date) + ' 00:00';
							parent.find('.rs-timepicker-input').timepicker('show');
						}
						else{
							date_string = jQuery.datepicker.formatDate('yy-mm-dd', date) + ' ' + date_string;
						}
						parent.find('.rs-datetime-input').val(date_string);
					}
				}
			}).trigger('change');
		});
		
		date_inp.next('.ui-datepicker-trigger').attr('tabindex', '-1');
		
		//// Time ////
		var time_inp = $(box).find(".rs-timepicker-input");
		time_inp.filter('.hasTimepicker').removeClass('hasTimepicker').next('.ui-timepicker-trigger').remove();
		time_inp.each(function(){
			
			var config = $(this).data('config');
			var btn_config = {
				showOn: 'button',
				timeSeparator: ':',
				onSelect: function(time_string, inst){
					inst.input.data('selected', true).trigger('change');
				}
			};
			$.extend( config, btn_config );

			$(this).unbind('keypress').keypress(function(event){
				var key = String.fromCharCode( event.which );
				var regex = /[0-9]|\./;
				if(event.which != 8 && event.which != 0 && key != config.timeSeparator && !regex.test(key) ) {
					event.preventDefault();
				}
			}).unbind('change').change(function(event){
				var val = $(this).val().trim();
				if(!$(this).data('selected')){
					var regex = new RegExp("([0-9]|([01][0-9])|([2][0-3]))" + config.timeSeparator + "(([0-5][0-9])|[0-9])");
					$(this).val(regex.test(val) ? val : '');
				}
				$(this).removeData('selected');
				
				var parent = $(this).closest('.rs-control');
				if(parent.is('.rs-datetime')){
					var date = parent.find('.rs-datepicker-input').datepicker('getDate');
					var time_string = jQuery.datepicker.formatDate('yy-mm-dd', date) + ' ' + $(this).val();
					parent.find('.rs-datetime-input').val(time_string.trim());
				}
			});

			$(this).timepicker(config);
		});
		
		time_inp.next('.ui-timepicker-trigger').attr('tabindex', '-1');
	});
	
	$(document).trigger('rs-control-rebuild.rs-datetime', '.rs-datepicker, .rs-timepicker');
});
