/*
* Plugin name: Redsand Jquery Switch Button Plugin
* Author: phannhuthan
* Uri: http://redsand.vn
* Version: 1.2
* Modify date: 11/14/2014
*/

/* param
	options = {
		change: function(value, button, input, event){
			...
		},
		style: 'default' | 'on-off' | 'yes-no',
		cssClass: ''
	}
*/

(function($){
	$.fn.rsSwitch = function(options){
		
	    options = $.extend({
			change: false,
			cssClass: '',
			style: 'default'
		}, options);
		
		this.data('rsSwitch', options);
		
		this.each(function(){
		
			var button = $(this).prev(), input = $(this);
			
			input.addClass('rs-switch-hidden');
			
			input.filter(':checkbox, :radio').attr('checked', true); //make it always send value
			
			if(input.closest('.rs-switch').length == 0){
				input.wrap('<div class="rs-switch rs-switch-' + options.style + ' ' + options.cssClass + '"></div>');
			}
			else{
				input.closest('.rs-switch').addClass('rs-switch-' + options.style).addClass(options.cssClass);
			}
			
			if (button.length == 0){
		        button = $('<a class="rs-switch-trigger"></a>');
		        input.before(button);
		    }
			
			button.toggleClass('on', input.val() == true);
			button.toggleClass('off', input.val() != true);

			button.unbind('click.rs-switch').bind('click.rs-switch', function(event){
				var on = input.val() == true;
				input.val(on ? '0' : '1');
				button.toggleClass('on', !on);
				button.toggleClass('off', on);				
				input.trigger('change');
				if (typeof options.change == 'function'){
					options.change(!on, button, input, event);
				}
			});
		});
		
		return this;
	}
})(jQuery);