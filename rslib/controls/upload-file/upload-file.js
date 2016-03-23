rs.uploaders = {};
if(jQuery.event.props.indexOf('dataTransfer') == -1){
	jQuery.event.props.push( "dataTransfer" );
}
function rs_upload_remove_file(id, file_id){
	var uploader = rs.uploaders[id];
	if(uploader){
		var file = uploader.getFile(file_id);
		if(file){alert(file_id);
			var status_before = file.status;
			var container = jQuery('#' + uploader.settings.container);
			var uploaded_list = container.find('.uploaded-list');
			uploader.removeFile(file);
			if(uploader.state == plupload.STARTED && status_before == plupload.UPLOADING)
			{
			  uploader.stop();
			  uploader.start();
			}
			if(uploader.total.queued == 0){
				container.find('.pending-list').removeClass('has-file');
			}
			var count = uploader.total.queued + uploaded_list.find('li').length;
			if(uploader.settings.max_files > count){
				container.find('.upload-browser').show();
			}
		}
	}
}

function rs_upload_remove_uploaded_file(id, file_id, nonce, question){
	var uploader = rs.uploaders[id];
	if(uploader){
		var container = jQuery('#' + uploader.settings.container);
		if(!question || confirm(question)){
			jQuery('#' +  'rs-file-' + file_id).css('opacity', 0.5);
			jQuery.post(rs.wordpress.admin_ajax_url, {id: file_id, security: nonce, action: 'rs_file_upload_remove', callback: uploader.settings.multipart_params.callback}, function(data){
				if(data.success){
					jQuery('#' +  'rs-file-' + file_id).remove();
					
					var count = uploader.total.queued + container.find('.uploaded-list li').length;
					container.find('.upload-browser').toggle(uploader.settings.max_files > count);
					
					if(count == 0){
						container.append('<input type="hidden" class="rs-file-default-value" value="" name="' + uploader.settings.multipart_params.field_name + '"/>');
					}

					var removed_callback = uploader.settings.js_callback.removed_callback;
					if(typeof  window[removed_callback] == 'function'){
						window[removed_callback](data, uploader.settings.js_callback.removed_parameter);
					}
				}
				else{
					jQuery('#' +  'rs-file-' + file_id).css('opacity', 1);
					alert('Cannot remove this file. ' + data.message);
				}
			}, 'json').error(function(){
				jQuery('#' +  'rs-file-' + file_id).css('opacity', 1);
			});
		}
	}
}

function rs_upload_remove_uploaded_files(id, question){
	var uploader = rs.uploaders[id];
	if(uploader){
		if(!question || confirm(question)){
			var container = jQuery('#' + uploader.settings.container);
			container.find('.uploaded-list .remove-file').each(function(){
				rs_upload_remove_uploaded_file(id, jQuery(this).next().val(), jQuery(this).data('security'));
			});
		}
	}
}

function rs_upload_add_file(uploader, files){
	var container = jQuery('#' + uploader.settings.container);
	var list = container.find('.pending-list');
	var uploaded_list = container.find('.uploaded-list');
	var count = uploader.total.queued + uploaded_list.find('li').length;
	var max = files.length;
	if(uploader.settings.max_files <= count) {
		jQuery.each(files, function(i, file) {
			uploader.removeFile(file);
		});
		container.find('.upload-browser').hide();
		return false;
	}
	else{
		max = uploader.settings.max_files - count;
		if(max <= files.length){
			container.find('.upload-browser').hide();
		}
	}
	jQuery.each(files, function(i, file) {
		if(i < max){
			list.append(
				'<li class="rs-file" id="' + file.id + '">' +
					'<div class="file-name">' + file.name + '</div>' + 
					'<div class="file-size"><span>' + plupload.formatSize(0) + '<span> / ' + plupload.formatSize(file.size) + ') </div>' +
					'<div class="file-progress"></div>' +
					'<a class="remove-file" title="Remove this file.">X</a>' +
				'</li>');
		}
		else{
			uploader.removeFile(file);
		}
	}); 
	list.addClass('has-file');
	list.find('.remove-file').click(function(){
		rs_upload_remove_file(uploader.settings.id, jQuery(this).parent().attr('id'));
		jQuery(this).parent().remove();
	});
	uploader.refresh();
	if(uploader.settings.auto_start) uploader.start();
}

function rs_upload_add_file_error(uploader, error){
	var container = jQuery('#' + uploader.settings.container);
	var uploaded_list = container.find('.uploaded-list');
	var count = uploader.total.queued + uploaded_list.find('li').length;
	if(uploader.settings.max_files > count){
		container.find('.upload-browser').show();
	}
	alert('File ' + error.file.name + ' can not be uploaded (' + error.message + ')');
}

function rs_upload_progress(uploader, file) { 
	jQuery('#' + file.id).addClass('uploading').find('.file-progress').width(file.percent + "%");
	jQuery('#' + file.id + " .file-size span").html(plupload.formatSize(parseInt(file.size * file.percent / 100)));
}

function rs_upload_uploaded(uploader, file, response) {
	var container = jQuery('#' + uploader.settings.container);
	var uploaded_list = container.find('.uploaded-list');
	var response = JSON.parse(response["response"]);
	
	jQuery('#' + file.id).remove();
	if(response.success){
		var item = jQuery(
					'<li id="rs-file-'+response.id+'" class="rs-file" title="'+response.title+' | '+response.txt+' | '+plupload.formatSize(response.size)+'">' +
						'<a href="'+response.url+'" target="blank"><img class="file-image" src="'+response.thumbnail+'"/></a>' +
						'<a href="'+response.url+'" target="blank" class="file-name">'+response.title+'</a>' +
						'<span class="file-ext">'+response.ext+'</span>' +
						'<span class="file-size">'+plupload.formatSize(response.size)+'</span>' +
						'<a class="remove-file" data-security="'+response.nonce+'" title="Remove this file."></a>' +
						'<input class="file-id" type="hidden" name="'+uploader.settings.multipart_params.field_name+'[]" value="'+response.id+'"/>' +
					'</li>');
		item.find('.remove-file').click(function(){
			rs_upload_remove_uploaded_file(uploader.settings.id, response.id, response.nonce, 'Are you sure you want to remove this file?');
		});
		
		var type = response.type.split('/')[0];
		if(type == 'image' && response.thumbnail.indexOf('default.png') == -1){
			item.addClass('has-thumbnail');
		}
		uploaded_list.addClass('has-file').append(item);
		
		container.find('.rs-file-default-value').remove();
	}
	else{
		var count = uploader.total.queued + uploaded_list.find('li').length;
		if(uploader.settings.max_files > count){
			container.find('.upload-browser').show();
		}
		alert('File "' + file.name + '" can not be uploaded. ' + response.message);
	}
	
	var added_callback = uploader.settings.js_callback.added_callback;
	if(typeof window[added_callback] == 'function'){
		window[added_callback](response, uploader.settings.js_callback.added_parameter);
	}
	
	if(uploader.total.queued == 0){
		container.find('.pending-list').removeClass('has-file');
		if(uploader.callback){
			uploader.callback.call();
		}
	}
	
	
}

function rs_upload_get_uploader(id){
	return rs.uploaders[id];
}

function rs_upload_has_file(id){
	var uploader = rs_upload_get_uploader(id);
	return uploader && uploader.total.queued;
}

function rs_upload_start(id, callback){
	var uploader = rs_upload_get_uploader(id);
	if(uploader){
		if(typeof callback == 'function') {
			uploader.callback = callback;
		}
		uploader.start();
	}
	else{
		if(typeof callback == 'function') callback.call();
	}
}

function rs_upload_stop(id){
	var uploader = rs_upload_get_uploader(id);
	if(uploader){
		uploader.callback = null;
		uploader.stop();
	}
}

jQuery(function($){
	function rs_upload_message(msg){
		alert(msg);
	}
	
	$(document).bind('rs-control-rebuild.rs-fileupload', function(e, box){
		if(typeof plupload == 'undefined') return false;

		box = $(box).is('.rs-fileupload') ? $(box) : $(box).find('.rs-fileupload');
		
		box.each(function(){
			
			var control = $(this), config, uploader;
			var config = control.find('script.rs-data');
			if(config.length){
				try{
					config = JSON.parse(config.text());
					
					if(config){
					
						if(rs.uploaders[config.id]){
							rs.uploaders[config.id].destroy();
						}
						
						uploader = new plupload.Uploader(config);	
						
						uploader.init();
						
						uploader.bind('FilesAdded', rs_upload_add_file);

						uploader.bind('Error', rs_upload_add_file_error);
						
						uploader.bind('UploadProgress', rs_upload_progress);

						uploader.bind('FileUploaded', rs_upload_uploaded);
						
						rs.uploaders[config.id] = uploader;
						
						control.find('.remove-file').unbind('click.rs-upload').bind('click.rs-upload', function(){
							rs_upload_remove_uploaded_file(config.id, $(this).next().val(), $(this).attr('data-security'), 'Are you sure you want to remove this file?');
						});
						
						if(control.find('.uploaded-list li').length >= uploader.settings.max_files){
							control.find('.upload-browser').hide();
						}
					}
				}
				catch(ex){
					console.log(ex);
				}
			}
		});
		
		$(document).has('.rs-fileupload.allow-drag-drop').unbind('dragover.rs-upload').bind('dragover.rs-upload', function (event) {
			$(this).find('.allow-drag-drop .upload-browser').addClass('dragover');

			if ($.inArray('Files', event.dataTransfer.types) > -1)
			{
				event.stopPropagation();
				event.preventDefault();
				
				event.dataTransfer.dropEffect = $(event.target).closest('.upload-browser').length ? 'copy' : 'none';
			}
		});
		
		$(document).has('.rs-fileupload.allow-drag-drop').unbind('dragleave.rs-upload').bind('dragleave.rs-upload', function (event) {
			$(this).find('.allow-drag-drop .upload-browser').removeClass('dragover');
			$('body').css('cursor', '');
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-fileupload', '.rs-fileupload');
});