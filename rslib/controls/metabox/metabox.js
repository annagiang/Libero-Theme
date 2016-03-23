jQuery(function($){
	$.fn.rsMetaBoxToogle = function(show){
		if(this.length == 0) return this;
		show = show == undefined ? !this.is(':visible') : show;
		if(show){
			this.filter('.rs-rule-disabled').removeClass('rs-rule-disabled').not('.rs-logic-disabled').find('.rs-js-disabled').removeClass('rs-js-disabled').removeAttr('disabled');
		}
		else{
			this.addClass('rs-rule-disabled').find(':enabled').addClass('rs-js-disabled').attr('disabled', 'disabled');
			this.find('.rs-template .rs-js-disabled').removeClass('rs-js-disabled');
		};
		return this;
	};
	
	function checkBoxDisplay(boxid){
		var logic = rs.data['metabox-logic'][boxid];
		var matched = false;
		for(var i in logic){
			var submatched = true;
			for(name in logic[i]){
				var value = [];
				if(name == 'term_id'){
					$('.categorydiv div[id$=all] :checked').each(function(){
						value.push(this.value);
					});
				}
				else if(name == 'post_format'){
					var format = $('#post-formats-select :checked').val();
					if(format == '0') value.push('standard');
					value.push(format);
				}
				else if(name == 'page_parent'){
					value.push($('#parent_id').val());
				}
				else if(name == 'page_type'){
					value.push($('#parent_id').val() == '' ? 'top_level' : 'child_page', 'page_on_front', 'page_for_posts');
				}
				else if(name == 'page_template'){
					value.push($('#page_template').val());
				}
				else{
					value = false;
				}
				
				value && (submatched = rs.helpers.checkConditionalLogic(value, logic[i][name]));
				
				if(!submatched) break;
			}
			matched = matched || submatched;
		}
		$('#' + boxid).rsMetaBoxToogle(matched);
	}
	
	//Init
	$('label[for^=rs-postbox]').addClass('rs-hidden rs-postbox-toggle');
	$('div[id^=rs-postbox]').addClass('rs-postbox');
	
	$('.rs-metabox').each(function(){
		$(this).closest('.postbox').addClass('.rs-postbox').removeClass('hide-if-js');
		$('label[for^='+$(this).attr('id')+']').addClass('rs-hidden rs-postbox-toggle');
	});
	
	//User Filter
	$('select#role, select#adduser-role').change(function(){
		var boxes = $(this).closest('form').find('.rs-user-meta');
		var role = ['all', $(this).val()];
		boxes.rsMetaBoxToogle(false).filter(function(){
			var data = rs.data['metabox-logic'][this.id];
			var matched = false;
			for(var i in data){
				console.log(role, data[i]['user_role'], rs.helpers.checkConditionalLogic(role, data[i]['user_role']));
				matched = matched || rs.helpers.checkConditionalLogic(role, data[i]['user_role']);
			}
			return matched;
		}).rsMetaBoxToogle(true);
	}).trigger('change');
	
	//Metabox 
	if(rs.data['metabox-logic']){
		for(var id in rs.data['metabox-logic']){
			var logic = rs.data['metabox-logic'][id];
			for(var i in logic){
				for(var name in logic[i]){
					var element = false;
					if(name == 'term_id'){
						element = $('.categorydiv :checkbox');
					}
					else if(name == 'post_format'){
						element = $('#post-formats-select :radio');
					}
					else if(name == 'page_parent' || name == 'page_type'){
						element = $('#parent_id');
					}
					else if(name == 'page_template'){
						element = $('#page_template');
					}
					element && element.unbind('change.' + id).bind('change.' + id, {id: id}, function(event){
						checkBoxDisplay(event.data.id);
					}).trigger('change');
				}
			}
		}
	}
	
});