jQuery(window).load(function($){
	$ = jQuery;
	$(window).scroll(function(){
		if( $('.libero-loadnextpost').length ) {
			var _this = $('.libero-loadnextpost');
			if ( $(window).scrollTop() > ( _this.offset().top - $(window).height()) ){
				_this.removeClass('hidden');
				if( _this.attr('data-disable') == undefined ) _this.attr('data-disable',0);
				_this.attr('data-disable', _this.attr('data-disable')*1+1 );
				
				if( $('#libero-next-post').attr('data-id') != '0' && parseFloat(_this.attr('data-disable')) == 1 ) {
					$('.libero-loadnextpost').addClass('active');
					$.ajax({
						type: "POST",
						url: libero_loadnext.ajaxurl,
						dataType: 'json',
						data: { 
							'action' 	: 'libero_next_post',
							'id'		: $('#libero-next-post').attr('data-id'),
							'template'	: $('#libero-next-post').attr('data-template'),
						},
						success: function(data){
							_this.attr('data-disable', 0 );
							$('.libero-loadnextpost').removeClass('active');
							$('#libero-next-post').attr('data-id',data.id);
							$(".libero-iframe").fitVids();
							if( data.id == 0 ) {
								$('.libero-loadnextpost').remove();
							}
							$( '<div class="libero-ajax-content">' + data.html + '</div>').appendTo( $('#libero-next-post') ).hide().slideDown(300,function(){
								$(window).trigger('scroll');
							});
						}
					});
				}
			}
		}
	});
});