/*
 * Plugin name: Redsand Jquery Custom Select-box UI
 * Author: phannhuthan
 * Uri: http://redsand.vn
 * Version: 4.2
 * Last modify: 10/17/2014
 */

;(function($) {
    $.fn.rsSelectBox = function(options, value, trigger) {
        if (options == "value") {
            if (value != undefined) {
				this.filter('.rs-selectbox-hidden').each(function(){	
					if($(this).val() != value){
						if(trigger || trigger == undefined){
							$(this).val(value).trigger('change');
						}
						else{
							$(this).val(value);
							$(this).parent().trigger('change');
						}
					}
				});
                return this;
            }
            return this.val();
        }
		
        options = $.extend({
            titleAsDefault: true,
            height: 200,
			width: null,
            change: false,
			uiId: "",
            selectedTemplate: function(item) {
                var icon = "";
                if (item.attr('data-icon')) {
                    icon = '<img class="rs-select-icon" src="' + item.attr('data-icon') + '" alt=""/>';
                }
                return icon + item.text();
            },
            itemTemplate: function(item) {
                var icon = "";
                if (item.attr('data-icon')) {
                    icon = '<img class="rs-select-icon" src="' + item.attr('data-icon') + '" alt=""/>';
                }
                return '<span class="rs-select-item" data-value="' + item.val() + '">' + icon + item.text() + '</span>';
            },
            afterInit: false,
            afterShow: false,
            beforeShow: false
        }, options);
		
        this.filter('select:not([multiple])').each(function() {
            var slto = $(this);
            var sltn, sltt, sltv, slti, opts, items, index;
			
			if(!slto.parent().is('.rs-selectbox')){
                sltn = '<div class="rs-control rs-selectbox"></div>';
                slto.wrap(sltn);
			}
			
			sltn = slto.parent();
			
			if(sltn.find('.rs-select-inner').length == 0){
                slti = '<div class="rs-select-inner">';
				slti += '<div class="rs-select-selected">';
                slti += '<div class="rs-select-value"></div>';
                slti += '<div class="rs-select-arrow"></div>';
                slti += '</div>';
                slti += '<div class="rs-select-options"></div>';
                slti += '</div>';
                slto.before(slti);
            }
            
            sltt = sltn.find('.rs-select-selected');
            sltv = sltn.find('.rs-select-value');
            opts = sltn.find('.rs-select-options');
			
			if(options.width){
				sltn.width(options.width);
			}
			if(options.uiId){
				sltn.attr('id', options.uiId);
			}
			
            sltn.attr('title', slto.attr('title'));
            opts.empty().css('overflow', 'auto');
            opts.css('max-height', options.height);
			
            slto.removeClass('rs-selectbox').addClass('rs-selectbox-hidden');
					
			slto.find('option').each(function() {
                opts.append(options.itemTemplate($(this)));
            });
			
            items = opts.children();
			
            if (options.titleAsDefault && (slto.find('option').length == 0 || slto.attr('title') && slto.find('option[selected]').length == 0 && slto.find('option:selected').index() == 0)) {
                sltv.html(slto.attr('title'));
            } else {
                index = slto.find('option:selected').index();
                items.eq(index).addClass('active');
                sltv.html(options.selectedTemplate(slto.find('option:selected'))).data('index', index);
            }
			
            sltn.toggleClass('has-value', sltv.data('index') == slto.find('option:selected').index() && slto.val() != "");
            if (slto.is(':disabled')){
				sltn.addClass('disabled');
			}
            sltn.toggleClass('has-scrollbar', opts.show().scrollTop(1).scrollTop() > 0);
           
			opts.scrollTop(0).hide();
            
			items.unbind('click.rs-selectbox').bind('click.rs-selectbox', function() {
                if (!slto.is(':disabled')) {
                    var opt = slto.find('option').eq($(this).index());
                    if (!$(this).is('.active')) {					
                        slto.val(opt.val()).trigger('change');	
                    }
                    slto.trigger('click');
                }
            });
			
			slto.unbind('change.rs-selectbox').bind('change.rs-selectbox', function(){
				sltn.trigger('change');
				if (typeof options.change == 'function') options.change.call(slto, val, sltn, slto);
			});
			
			sltn.unbind('change.rs-selectbox').bind('change.rs-selectbox',function(){
				var val = slto.val();
				var opt = slto.find(':selected');
				sltn.toggleClass('has-value', val != "");
				
				opts.find('.rs-select-item.active').removeClass('active');
				opts.find('.rs-select-item').eq(opt.index()).addClass('active');
				sltv.html(options.selectedTemplate(opt));
				
				opts.slideUp(200);
				sltn.removeClass('expanded');
			});
            
            
			slto.unbind('focus.rs-selectbox').bind('focus.rs-selectbox', function() {
                if (!slto.is(':disabled')) {
                    if (options.beforeShow) {
                        options.beforeShow(sltn, slto);
                    }
                    opts.slideDown(200, function() {
                        if (options.afterShow && opts.is(':visible')) {
                            options.afterShow(sltn, slto);
                        }
                    });
                    sltn.addClass('focus expanded');
                }
            });
            
			slto.unbind('blur.rs-selectbox').bind('blur.rs-selectbox', function() {
                sltn.removeClass('focus');
            });
            
			sltt.add(options.trigger).unbind('click.rs-selectbox').bind('click.rs-selectbox', function() {
                if (!slto.is(':disabled')) {
                    if (sltn.is('.expanded')) {
                        opts.slideUp(200);
                        sltn.removeClass('expanded');
                    } else {
                        slto.trigger('focus');
                    }
                    slto.trigger('click');
                }
            });
            
			$(document).unbind('click.rs-selectbox').bind('click.rs-selectbox', function(event) {
                if (!$(event.target).is('.rs-select-hidden') && !$(event.target).is(options.trigger)) {
                    $('.rs-selectbox').not($(event.target).parents('.rs-selectbox')).removeClass('focus expanded').find('.rs-select-options').slideUp(200);
                }
            });
            
			$(document).unbind('keydown.rs-selectbox').bind('keydown.rs-selectbox', function(event) {
                if ($('.rs-selectbox.focus').length > 0) {
					if(event.which == 40 || event.which == 38 || event.which == 13){
						var items = $('.rs-selectbox.focus').find('.rs-select-options').children();
						var sp = items.filter('.active').removeClass('active');
						if (event.which == 40) {
							sp = sp.next().size() ? sp.next() : items.first();
						}
						if (event.which == 38) {
							sp = sp.prev().size() ? sp.prev() : items.last();
						}
						if (event.which == 13) {
							sp.trigger('click');
						}
						sp.addClass('active');
						$('.rs-selectbox.focus').find('.rs-select-value').text(sp.text());
						event.preventDefault();
					}
					if(event.which == 9){
						$('.rs-selectbox.focus').removeClass('focus expanded').find('.rs-select-options').slideUp(200);
					}
                }
            });
            if (options.afterInit) options.afterInit(sltn, slto);
        });
		
        this.filter('.rs-selectbox').each(function() {
            $(this).find('select').rsSelectBox(options);
        });
		
        return this;
    }
}(jQuery));