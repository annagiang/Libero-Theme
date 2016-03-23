window.onload = (function(){
	jQuery(document).trigger('rs-control-rebuild.rs-upload', document);
	jQuery('.rs-upload-button').live('click',function(){
		if(!jQuery(this).hasClass('trigger-click')){
			jQuery(document).trigger('rs-control-rebuild.rs-upload', document);
			jQuery(this).addClass('trigger-click');
			jQuery(this).trigger('click');
		}
	});
});
jQuery(function($){
	if(Modernizr.boxsizing){
		$('.rs-upload-input').css('padding-right', function(){
			return ($(this).next('.rs-upload-button').outerWidth() + 4) + 'px';
		});
	}
	
	!wp.media && $('.rs-upload-edit').hide();
	
	$(document).bind('rs-control-rebuild.rs-upload', function(e, box){
		box = $(box).is('.rs-upload') ? $(box) : $(box).find('.rs-upload');
		box.each(function(){
			var data = {
				'title': $(this).attr('data-title'),
				'editTitle': $(this).attr('data-edit-title'),
				'type': $(this).attr('data-type'),
				'insertText': $(this).attr('data-insert-text'),
				'updateText': $(this).attr('data-update-text')
			};
			$(this).find('.rs-upload-button').unbind('click').click(function(event){
				event.preventDefault();
				jQuery(this).addClass('trigger-click');
				if(!$(this).isDisabled()){
					var upload = $(this).closest('.rs-upload');
					rs.controls.upload.show({
						title: data.title,
						insertText: data.insertText,
						type: data.type,
						multiple: false,
						onselect: function(data){
							rs_upload_media_update_file_after(data, upload);
						}
					});
				}
			});
			$(this).find('.rs-upload-delete').unbind('click').click(function(event){
				event.preventDefault();
				var upload = $(this).closest('.rs-upload');
				rs_upload_media_remove_file(upload);
			});
			$(this).find('.rs-upload-edit').unbind('click').click(function(event){
				event.preventDefault();
				var upload = $(this).closest('.rs-upload');
				var id = upload.find('.rs-upload-id').val();
				if(id != '') rs.controls.upload.edit({
					fileId: id,
					title: data.editTitle,
					updateText: data.updateText,
					type: data.type,
					onselect: function(data){
						rs_upload_media_update_file(data, upload);
					}
				});
			});
			
		});
		box.find('.rs-upload-input').unbind('change').bind('change', function(event){
			var url = $(this).val().trim().split('?')[0];
			var upload = $(this).closest('.rs-upload');
			if(rs.helpers.files.isFile(url)){
				var type = upload.attr('data-type');
				var local = rs.helpers.files.isLocalFile(url);
			
				var allow = (url == '')
							|| (type != 'audio' && type != 'video' && type != 'image')
							|| (type == 'image' && rs.helpers.files.isImage(url))
							|| (type == 'video' && rs.helpers.files.isVideo(url))
							|| (type == 'audio' && rs.helpers.files.isAudio(url));
				if(allow){
					if(local){				
						$.get(rs.wordpress.admin_ajax_url, {action: 'rsupload_checkurl', url: url}, function(data){
							if(data == -1){
								rs.message('Sorry, the url is not exists. Please manual check it.');
								rs_upload_media_remove_file(upload);
								upload.find('.rs-upload-input').val(url);
							}
							else if(data == 0){
								local = false;
							}
							else{
								rs_upload_media_update_file(data, upload);
							}
						}, 'json').error(function(){
							rs_upload_media_remove_file(upload);
						});
					}
					
					if(!local){
						upload.find('.rs-upload-id').val(url);
						
						var data = {
							id: '',
							url: url,
							type: rs.helpers.files.isImage(url) ? 'image' : 'orther',
							filesize: '',
							title: rs.helpers.files.basename(url),
							icon: rs.wordpress.home_url + '/wp-includes/images/crystal/default.png'
						};
						rs_upload_media_update_file(data, upload);
						upload.find('.rs-upload-edit').css('display', 'none');
						
						if(upload.attr('data-ask-sideload')){
							if(confirm('You are using a file from another domain, do you want upload it to this website?')){
								rs.showLoading();
								$.get(rs.wordpress.admin_ajax_url, {action: 'rsupload_handle_sideload', url: url}, function(data){
									rs.hideLoading();
									if(data.error){
										rs.message(data.message);
									}
									else{
										rs_upload_media_update_file(data, upload);
									}
								}, 'json').error(function(){
									rs.hideLoading();
									rs.message('Sorry, cannot upload this file.');
								});
							}
						}
					}
				}
				else{
					rs.message('Sorry, file type is wrong.');
					rs_upload_media_remove_file(upload);
				}
			}
			else{
				rs_upload_media_remove_file(upload);
			}
		});
		
		box.find('.rs-upload-id').each(function(){
			var id = $(this).val();
			if(jQuery.isNumeric(id) != '' && wp.media){
				var upload = $(this).closest('.rs-upload');
				wp.media.attachment(id).fetch({
					success: function(data){
						data = data.toJSON();
						if(data.url != ''){
							rs_upload_media_update_file(data, upload);
							upload.find('.rs-upload-edit').css('display', '');
						}
					},
					error: function(){
						rs_upload_media_remove_file(upload);
					}
				});		
			}
			else{
				//$(this).next('.rs-upload-input').trigger('change');
			}
		});
		
	});
});

function rs_upload_media_update_file(data, upload){
	var image = data.type == 'image';

	upload.find('.rs-upload-input').val(data.url);
	upload.find('.rs-upload-id').val(data.id || data.url);
	
	upload.find('.rs-upload-details').toggleClass('file-details', !image).toggleClass('image-details', image);
	upload.find('.rs-upload-preview img').attr('src', image ? data.url : data.icon);
	
	upload.find('.rs-upload-name').text(data.title);
	upload.find('.rs-upload-size').text(data.filesize ? 'Size: ' + data.filesize : '');
	upload.find('.rs-upload-details p').toggle(!image);
	upload.find('.rs-upload-details').css('display', 'block');
	
	upload.find('.rs-upload-edit').css('display','');
	upload.find('.rs-upload-action').css('display','');
}
function rs_upload_media_update_file_after(data, upload){
	var image = data.type == 'image';

	upload.find('.rs-upload-input').val(data.url);
	upload.find('.rs-upload-id').val(data.id || data.url);
	
	upload.find('.rs-upload-details').toggleClass('file-details', !image).toggleClass('image-details', image);
	upload.find('.rs-upload-preview img').attr('src', image ? data.url : data.icon);
	
	upload.find('.rs-upload-name').text(data.title);
	upload.find('.rs-upload-size').text(data.filesize ? 'Size: ' + data.filesize : '');
	upload.find('.rs-upload-details p').toggle(!image);
	upload.find('.rs-upload-details').css('display', 'block');
	
	upload.find('.rs-upload-edit').css('display','');
	upload.find('.rs-upload-action').css('display','');
	upload.find('.rs-upload-input').trigger('change');
}

function rs_upload_media_remove_file(upload){
	upload.find('.rs-upload-preview img').attr('src', '');
	upload.find('.rs-upload-details p').text('');
	upload.find('.rs-upload-input').val('');
	upload.find('.rs-upload-id').val('');
	upload.find('.rs-upload-details').css('display','none');
	upload.find('.rs-upload-action').css('display','');
	upload.find('.rs-upload-input').unbind('change').trigger('change');
}