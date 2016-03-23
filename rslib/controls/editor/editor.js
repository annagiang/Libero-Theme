jQuery(function($) {
	
	$(document).find('.wp-editor-area').each(function(){
		var id = $(this).attr('id');
		if($('[id="'+id+'"]').length > 1){
			rs.message('The page has two or more editor same id "'+id+'". Please manual check and try again.');
			return false;
		}
	});
	
	$(document).find('.rs-editor').each(function(){
		if($(this).closest('.rs-template').length == 0){
			$(this).data('init', true);
		}
	});
	
	$(document).bind('rs-control-rebuild.rs-editor', function(e, box){
		if(window.tinyMCEPreInit){
			box = $(box).is('.rs-editor') ? $(box) : $(box).find('.rs-editor');
			box.each(function(i){
				if($(this).closest('.rs-template').length == 0 && !$(this).data('init')){
					var config = $(this).data('config');
					var textarea = $(this).find('.wp-editor-area').height('');
					var id = textarea.attr('id');					
					var tmce_active = $(this).find('.wp-editor-wrap').is('.tmce-active');
					
					if($('[id="'+id+'"]').length > 1){
						rs.message('Sorry, the page has two or more editor same id "'+id+'". Please manual check and try again.');
					}
					else{
						if(config){	
							if(tinyMCEPreInit.mceInit[id]){
								tinyMCEPreInit.mceInit[id].id = id;
								$(this).find('.quicktags-toolbar').remove();
								QTags(tinyMCEPreInit.mceInit[id]);
								QTags._buttonsInit();
								
								if(tmce_active){
									setTimeout(function(){	
										if(parseInt(tinyMCE.majorVersion) >= 4){
											try{ tinymce.remove('#' + id); } catch(ex){}
										}
										tinymce.init(tinyMCEPreInit.mceInit[id]);
									}, 10);
								}
							}
							else{
								tinyMCEPreInit.mceInit[id] = config;
								tinyMCEPreInit.mceInit[id] = $.extend({}, tinyMCEPreInit.mceInit["rs_editor_default"], tinyMCEPreInit.mceInit[id]);
								tinyMCEPreInit.mceInit[id].elements = id; //3.0
								tinyMCEPreInit.mceInit[id].selector = '#' + id; //4.0
								tinyMCEPreInit.mceInit[id].id = id; //4.0
								
								$(this).find('.quicktags-toolbar').remove();
								QTags(tinyMCEPreInit.mceInit[id]);
								QTags._buttonsInit();
								
								if(tmce_active){
									setTimeout(function(){	
										tinymce.init(tinyMCEPreInit.mceInit[id]);
									}, 10);
								}
							}
						}
						$(this).data('init', true);
					}
				}
			});
			box.closest('form').unbind('submit.rs-editor').bind('submit.rs-editor', function(){
				tinymce.triggerSave();
			});
		}
		else{
			console.log('If you using ajax please pre load editor control first.');
		}
	});
	
});
