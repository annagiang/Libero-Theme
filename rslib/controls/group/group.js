jQuery(function($) {
	$('.handle-groupbox').on('click',function(e){
		//// Group ////
		e.preventDefault();
		$(this).next('.rs-box-group-container').toggleClass('closed');
		$(this).parent('.rs-group').toggleClass('closed');
	});
	$('.label.rs-group-label.display-block').click(function(e){
		//// Group ////
		e.preventDefault();
		$(this).parent('.rs-group').toggleClass('closed');
		$(this).next().next('.rs-box-group-container').toggleClass('closed');
	});
	//add class for style
	$('.inside .rs-metabox  p.label').each(function(){
		if($(this).next().hasClass('rs-group'))
		{
			$(this).addClass('rs-group-label');
			$(this).parent().addClass('rs-box-group');
		}
	});
	$('.inside .rs-metabox label').each(function(){
		if($(this).next().hasClass('rs-group'))
		{
			$(this).addClass('rs-group-label');
			$(this).next().addClass('rs-box-group');
		}
	});
});
