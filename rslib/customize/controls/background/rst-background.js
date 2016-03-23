jQuery(document).ready( function($) {
	
	
	$( '.customize-control-rsbackground input.background-color' ).each(function() {
		$( this ).wpColorPicker({
			change: function( event, ui ) {
				rst_change_background( $(this) );
			}
		});
	});
	
	$('.customize-control-rsbackground select, .customize-control-rsbackground input.background-color').live('change',function(){
		
		rst_change_background( $(this) );
		
	});
	
	$( '.customize-control-rsbackground button.upload-button' ).each(function() {
		$( this ).click(function(e){
			e.preventDefault();
			current = $(this);
			var custom_uploader = wp.media({
				title: 'Select Image',
				library : { type : 'image'},
				multiple: false  // Set this to true to allow multiple files to be selected
			})
			.on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				box_background = current.closest('.customize-control-rsbackground');
				box_background.find('.background-image').val( attachment.url );
				box_background.find('.rst-background-show-image img').attr('src', attachment.url );
				box_background.find('.rst-background-show-image').removeClass('rs_hidden_control');
				box_background.find('.rst-background-no-image').addClass('rs_hidden_control');
				
				rst_change_background( current );
				
			})
			.open();
		});
	});
	
	$( '.customize-control-rsbackground button.remove-button' ).each(function() {
		$( this ).click(function(e){
			e.preventDefault();
			current = $(this);
			
			box_background = current.closest('.customize-control-rsbackground');
			box_background.find('.background-image').val('');
			box_background.find('.rst-background-show-image img').attr('src', '' );
			box_background.find('.rst-background-show-image').addClass('rs_hidden_control');
			box_background.find('.rst-background-no-image').removeClass('rs_hidden_control');
			
			rst_change_background( current );
			
		});
	});
	
});

function rst_change_background( $section ){
	
	box_background = $section.closest('.customize-control-rsbackground');
	input_save =  box_background.find('input.rst-gallery-items');
	
	background_color = box_background.find('.background-color').val();
	background_image = box_background.find('.background-image').val();
	background_repeat = box_background.find('.rst-bg-repeat').val();
	background_position_vertical = box_background.find('.rst-bg-position-vertical').val();
	background_position_horizontal = box_background.find('.rst-bg-position-horizontal').val();
	background_size = box_background.find('.rst-bg-size').val();
	background_attachment = box_background.find('.rst-bg-attachment').val();
	
	array_value = 
		{
			'background-color': background_color,
			'background-image': background_image,
			'background-repeat': background_repeat,
			'background-position-vertical': background_position_vertical,
			'background-position-horizontal': background_position_horizontal,
			'background-size': background_size,
			'background-attachment': background_attachment
		}
	input_save.val(serialize(array_value));
	input_save.trigger('change');
	
}