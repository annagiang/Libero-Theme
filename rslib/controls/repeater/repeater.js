jQuery(function($){
	$(window).load(function(){
		
		$(document).bind('rs-control-rebuild.rs-repeater', function(e, box){

			box = $(box).parent().length ? $(box).parent().find('.rs-repeater') : $(box).find('.rs-repeater');
			
			if(box.length == 0) return;

			box.each(function(){
			
				var repeater = $(this);
				var timer = null;
				var basename =  $(this).attr('data-base-name');
				
				repeater.data('rs-repeater', {
					'minRows': $(this).attr('data-min-rows'),
					'maxRows': $(this).attr('data-max-rows'),
					'baseName': basename,
					'storage': (location.pathname + "-" + $(this).attr('data-base-name')).sanitize()
				});
				
				if(Modernizr.localstorage && repeater.parents('.rs-repeater').length == 0){
					repeater.closest('form').submit(function(){
						localStorage.removeItem(repeater.data('rs-repeater').storage);
					});
					
					if(localStorage[repeater.data('rs-repeater').storage] && rs.helpers.isRefresh){
						repeater.find('.wp-editor-area').each(function(){
							if(parseInt(tinyMCE.majorVersion) >= 4){
								tinymce.remove('#' + this.id);
							}
							else{
								tinymce.execCommand('mceRemoveControl', true, this.id); 
							}
						});
						repeater.html(localStorage[repeater.data('rs-repeater').storage]);
						localStorage.removeItem(repeater.data('rs-repeater').storage);
						repeater.find('.wp-editor-area').each(function(){
							this.value = localStorage['textarea-' + this.id];
							localStorage.removeItem('textarea-' + this.id);
						});
						rs_repeater_rebuild_conditional_logic(repeater);
						
						$(document).trigger('rs-control-rebuild', repeater.find('>table>tbody'));
					}
				}
				
				var length = repeater.find('>table>tbody>tr').length;

				if(length <= repeater.attr('data-min-rows')){
					repeater.find('>table>tbody>tr>.row-action .rs-repeater-remove-row').css('display', 'none');
				}
				
				if(length >= repeater.attr('data-max-rows')){
					repeater.find('>table>tbody>tr>.row-action .rs-repeater-add-row').css('display', 'none');
					repeater.find('>.rs-repeater-footer .rs-repeater-add-row').addClass('disabled');
				}
				if(length == 0){
					repeater.append('<input type="hidden" name="'+basename+'" class="rs-repeater-empty"/>');
				}
			});
					
			box.find('.rs-repeater-footer .rs-repeater-add-row').unbind('click').click(function(){
				rs_repeater_add_row($(this).closest('.rs-repeater'));
			});
			
			box.find('.rs-repeater-table').off('hover.row-hover click.row-click').on('hover.row-hover click.row-click', '>tbody>tr', function(){
				var rowaction = $(this).find('>.row-action');
				if(rowaction.find('.rs-repeater-remove-row').is(':visible')){
					rowaction.find('.rs-repeater-add-row').css('margin-top', ( - 10 - rowaction.height()/2) + 'px');
				}
				else{
					rowaction.find('.rs-repeater-add-row').css('margin-top', ( - 20 - rowaction.height()/2) + 'px');
				}			
			});
			
			box.find('.rs-repeater-table tbody').off('click.remove-row').on('click.remove-row', '>tr>.row-action>.rs-repeater-remove-row', function(){
				var repeater = $(this).closest('.rs-repeater');
				var length = repeater.find('>table>tbody>tr').length;
				if(length > repeater.data('rs-repeater').minRows){
					$(this).closest('tr').find('.wp-editor-area').each(function(){
						if(parseInt(tinyMCE.majorVersion) >= 4){
							tinymce.remove('#' + this.id);
						}
						else{
							tinymce.execCommand('mceRemoveControl', true, this.id); 
						}
					});		
					$(this).closest('tr').remove();
					rs_repeater_reorder(repeater);
					repeater.find('>.rs-repeater-footer .rs-repeater-add-row').removeClass('disabled');
					repeater.find('>table>tbody>tr>.row-action .rs-repeater-add-row').css('display', '');
					length--;
				}
				if(length == repeater.data('rs-repeater').minRows){
					repeater.find('>table>tbody>tr>.row-action .rs-repeater-remove-row').css('display', 'none');
				}
				if(length == 0){
					repeater.append('<input type="hidden" name="'+repeater.data('rs-repeater').baseName+'" class="rs-repeater-empty"/>');
				}
			});
			
			box.find('.rs-repeater-table').off('click.add-row').on('click.add-row', '>tbody>tr>.row-action>.rs-repeater-add-row', function(){
				rs_repeater_add_row($(this).closest('.rs-repeater'), $(this).closest('tr'));
			});
			
			box.filter('.sorting-true').find('.rs-repeater-table tbody').sortable({
				handle: '.row-order',
				cursorAt: {
					top: 10
				},
				helper: function(event, helper){
					var row = helper.clone();
					row.find('td').each(function(i){
						$(this).width(helper.find('td').eq(i).width());
					});	
					return row;
				},
				update: function(event, ui){
					rs_repeater_reorder(ui.item.closest('.rs-repeater'));
				}
			});
			
			box.find('>table>tfoot').find('input,select,textarea').addClass('disabled').attr('disabled','disabled');
			
			$('.rs-repeater .rs-template .wp-editor-area').each(function(){
				if(parseInt(tinyMCE.majorVersion) >= 4){
					tinymce.remove('#' + this.id);
				}
				else{
					tinymce.execCommand('mceRemoveControl', true, this.id); 
				}
			});
			
			$(window).unbind('beforeunload.rs-repeater').bind('beforeunload.rs-repeater', function(event){
				if(Modernizr.localstorage){
					$('.rs-repeater').each(function(){
						if($(this).parents('.rs-repeater').length == 0){
							$(this).find('.wp-editor-area').each(function(){
								localStorage['textarea-' + this.id] = tinymce.get(this.id) ? tinymce.get(this.id).getContent() : '';
								if(parseInt(tinyMCE.majorVersion) >= 4){
									tinymce.remove('#' + this.id);
								}
								else{
									tinymce.execCommand('mceRemoveControl', true, this.id); 
								}
							});						
							$(this).find(':checkbox,:radio,select option').each(function(){
								if(this.checked) 
									$(this).attr('checked', 'checked');
								else
									$(this).removeAttr('checked');
							});
							$(this).find(':text').each(function(){
								$(this).attr('value', $(this).val());
							});
							localStorage[$(this).data('rs-repeater').storage] = $(this).html();
						}
					});
				}
			});
		});

		
		$(document).trigger('rs-control-rebuild.rs-repeater', '.rs-repeater');
	});
});

function rs_repeater_add_row(repeater, row){
	var table = repeater.find('>table');
	var tbody = table.find('>tbody');
	if(tbody.find('>tr').length < repeater.data('rs-repeater').maxRows){
		var tmpl = table.find('> tfoot > tr').html();
		var index = tbody.find('>tr').length;
		var basename = repeater.data('rs-repeater').baseName + '[rsrowindex]';
		var name = basename.replace('rsrowindex', index);
		if(rs.data['field-referent']){
			for(var key in rs.data['field-referent']){
				if(key.indexOf(basename) >= 0){
					var ref = rs.data['field-referent'][key].replace(basename, name);
					rs.data['field-referent'][key.replace(basename, name)] = ref;
				}
			}
		}
		
		var baseid = basename.replace(/(\]\[)|(\])|(\[)/g,'-');
		var id = baseid.replace('rsrowindex', index);

		if(rs.data['conditional-logic']){
			for(var key in rs.data['conditional-logic']){
				if(key.indexOf(baseid) >= 0){
					var logic = rs.data['conditional-logic'][key];
					logic = JSON.parse(JSON.stringify(logic).replace(basename, name));
					rs.data['conditional-logic'][key.replace(baseid, id)] = logic;
				}
			}
		}
		
		var re = new RegExp(baseid, 'g');
		tmpl = tmpl.replace(re, id);
		basename = basename.replace(/\[/g,'\\[').replace(/\]/g,'\\]');
		re = new RegExp(basename, 'g');
		tmpl = tmpl.replace(re, name);
		
		tmpl = jQuery('<tr class="row"></tr>').append(tmpl);
		tmpl.find('input,select,textarea').removeClass('disabled').removeAttr('disabled');
		
		if(row){
			row.before(tmpl);
			rs_repeater_reorder(repeater);
		}
		else{
			tmpl.find('>td.row-order').text(index + 1);
			tbody.append(tmpl);
			jQuery(document).trigger('rs-control-rebuild', repeater);
		}
		repeater.find('.rs-repeater-empty').remove();
		
		repeater.find('>table>tbody>tr>.row-action .rs-repeater-remove-row').css('display', '');
	}
	if(tbody.find('>tr').length == repeater.data('rs-repeater').maxRows){
		repeater.find('>.rs-repeater-footer .rs-repeater-add-row').addClass('disabled');
		repeater.find('>table>tbody>tr>.row-action .rs-repeater-add-row').css('display', 'none');
	}
}

function rs_repeater_rebuild_conditional_logic(repeater){
	repeater.find('>table>tbody>tr').each(function(index){
		var basename = repeater.data('rs-repeater').baseName + '[rsrowindex]';
		var name = basename.replace('rsrowindex', index);
		if(rs.data['field-referent']){
			for(var key in rs.data['field-referent']){
				if(key.indexOf(basename) >= 0 && rs.data['field-referent'][key.replace(basename, name)] == undefined){
					var ref = rs.data['field-referent'][key].replace(basename, name);
					rs.data['field-referent'][key.replace(basename, name)] = ref;
				}
			}
		}
		
		var baseid = basename.replace(/(\]\[)|(\])|(\[)/g,'-');
		var id = baseid.replace('rsrowindex', index);

		if(rs.data['conditional-logic']){
			for(var key in rs.data['conditional-logic']){
				if(key.indexOf(baseid) >= 0 && rs.data['conditional-logic'][key.replace(baseid, id)] == undefined){
					var logic = rs.data['conditional-logic'][key];
					logic = JSON.parse(JSON.stringify(logic).replace(basename, name));
					rs.data['conditional-logic'][key.replace(baseid, id)] = logic;
				}
			}
		}
	});
}

function rs_repeater_reorder(repeater){
	var basename = repeater.data('rs-repeater').baseName ;
	var re1 = new RegExp(basename.replace(/\[/g,'\\[').replace(/\]/g,'\\]') + '\\[\\d+\\]', 'g');
	var baseid = basename.replace(/(\]\[)|(\])|(\[)/g,'-');
	var re2 = new RegExp(baseid + '-\\d+-', 'g');
	repeater.find('.wp-editor-area').each(function(){
		if(parseInt(tinyMCE.majorVersion) >= 4){
			tinymce.remove('#' + this.id);
		}
		else{
			tinymce.execCommand('mceRemoveControl', true, this.id); 
		}
	});
	repeater.find('>table>tbody>tr').each(function(i){
		jQuery(this).find('>td.row-order').text(i + 1);
		jQuery(this).find('[name]').attr('name', function(){		
			return jQuery(this).attr('name').replace(re1,  basename + '[' + i + ']');
		});
		jQuery(this).find('[id]').attr('id', function(){		
			return jQuery(this).attr('id').replace(re2,  baseid + '-' + i + '-');
		});
	});
	jQuery(document).trigger('rs-control-rebuild', repeater);
}