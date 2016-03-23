/*
* Plugin name: Redsand Jquery Custom Check Able Control
* Author: phannhuthan
* Uri: http://redsand.vn
* Version: 3.4.2
* Last modify: 12/15/2014
*/

/* param
	
	options = {
		change: function(event, ui = {checked, helper}){
			...
		}
	}
	
*/

(function($){
	$.fn.rsCheckbox = $.fn.rsRadio = $.fn.rsCheckAble = function(options, checked, trigger){
	
		if(options == 'checked'){
			if(checked != undefined){
				this.filter(':checkbox, :radio').each(function(){	
					if($(this).is('.rs-checkbox-hidden, .rs-radio-hidden')){
						if($(this).is(':checked') != checked){
							if(trigger || trigger == undefined){
								$(this).attr('checked', checked).trigger('change');
							}
							else{
								$(this).attr('checked', checked).next().toggleClass('checked', checked).parent('label').toggleClass('checked', checked);
							}
						}
					}
				});
				return this;
			}
			else{
				return this.is(':checked');
			}
		}
	
		options = $.extend({ 
			change: false,
			text: ""
		}, options);
	
		this.filter(':checkbox, :radio').each(function(){			
			var type = $(this).is(':checkbox') ? 'checkbox' : 'radio';
			var checkbox = $(this);
			var helper = checkbox.next('.rs-' + type + '-trigger').removeClass('checked');
			var label = checkbox.closest('label').removeClass('checked');
			
			if(helper.length == 0){
				helper = $('<a class="rs-' + type + '-trigger">' + options.text + '</a>');
				checkbox.after(helper);
			}
			
			label.addClass('rs-' + type);
			checkbox.addClass('rs-' + type + '-hidden');
			
			if(checked) checkbox.attr('checked', true);
			
			if(checkbox.is(':checked')) helper.add(label).addClass('checked');
			
			if(checkbox.is(':disabled')) helper.add(label).addClass('disabled');
			
			helper.unbind('click').click(function(event){
				event.preventDefault();
				if (!checkbox.is(':disabled')) {
				    checkbox.get()[0].click();
				}
			});	
			
			checkbox.unbind('change.rs-checkable').bind('change.rs-checkable', function (event) {
				var name = checkbox.attr('name');
				var list = checkbox.closest('form').length > 0 ? checkbox.closest('form').find('[name="' + name + '"]') : $('[name="' + name + '"]');
			    if (checkbox.is(':radio:checked')) {
			        list.not(this).removeAttr('checked').next().removeClass('checked').closest('label').removeClass('checked');
			    }
				var checked = checkbox.is(':checked');
				if(checked){
					list.filter('[required]').removeAttr('required').addClass('rs-checkbox-required', true);
				}
				else{
					list.filter('.rs-checkbox-required').attr('required', true);
				}
				
			    helper.add(label).toggleClass('checked', checked);
				
				if (typeof options.change == 'function') options.change.call(checkbox, event, {checked: checked, helper: helper});
			});
		});
		
		
		
		return this;
	}
}(jQuery));