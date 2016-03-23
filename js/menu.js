function menu_main() {

(function () {
   'use strict'
	//Script
	//-----------------------------------
    jQuery(document).ready(function($){

		$('.libero-nav-header li,.libero-menu-left li,.libero-menu-right li').hover(function(){
			if( !$(this).hasClass('libero-mega-menu') ) {
				var offsets = $(this).offset();
				var left = offsets.left;
				var width_li = $(this).outerWidth(true);
				if( $(this).parent().hasClass('libero-nav-header') ) {
					width_li = 0;
				}
				var width_sub = $(this).find('>ul').outerWidth(true);
				var window_width = $(window).outerWidth(true);
				var container_offset = $('.libero-main-header .container').offset();
				if( left+width_sub+width_li < window_width-container_offset.left ){
					$(this).find('>ul').addClass('libero-position-left').removeClass('libero-position-right');
				}
				else {
					$(this).find('>ul').addClass('libero-position-right').removeClass('libero-position-left');
				}
			}
		});
		
		$('.libero-mega-categories .libero-list-cat a').hover(function(){
			var index = $(this).index();
			$(this).parent().find('.current').removeClass('current');
			$(this).addClass('current');
			$(this).parents('.libero-mega-categories').find('.libero-menu-posts-cat .libero-list-post .current').removeClass('current');
			$(this).parents('.libero-mega-categories').find('.libero-menu-posts-cat .libero-list-post .libero-posts-category').eq(index).addClass('current');
		});
	});
}());

}
menu_main();