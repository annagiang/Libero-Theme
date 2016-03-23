//
// This is The Scripts used for Simply Theme
//

function main() {

(function () {
   'use strict'
	//Script
	//-----------------------------------
	
	
	
    jQuery(document).ready(function($){
		
		/* Owl carosel */
		var owlouter = jQuery(".libero_header_slidershow_owl");
		owlouter.owlCarousel({
			loop: true,
			margin: 0,
			responsiveClass: true,
			items: 1,
			nav: true,
			lazyLoad: true,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : true,
			responsive:{
				0:{
					nav:false
				},
				600:{
					nav:true
				}
			}
		});
 
		var owlinner = jQuery(".libero_header_slidershow_owl_inner");
		owlinner.owlCarousel({
			items: 4,
			margin: 10,
			nav : true,
			lazyLoad: true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : true,
			loop: true,
			responsive:{
				0:{
					items:2,
				},
				600:{
					items:4,
				}
			},
		});
		
		jQuery('.libero_breaking_news').owlCarousel({
			nav: true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : false,
			loop: true,
			autoplay: true,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			items:1,
		});
		
		/* slider inner click */
		jQuery(".libero_header_slidershow_owl_inner .owl-item > a").click(function(e){
			e.preventDefault();
			var index = $(this).attr('data-index');
			owlouter.trigger('to.owl.carousel', [index*1,300]);
		});
		/* .slider inner click */
		
		for( var $i = 0; $i < jQuery(".libero_featured_owl").size(); $i++ ) {
			var _this = jQuery(".libero_featured_owl").eq($i)
			var cloumn = _this.attr('data-columns')*1;
			_this.owlCarousel({
				items: cloumn,
				loop: true,
				dots : true,
				nav : false,
				responsive:{
					0:{
						items:1,
					},
					480:{
						items:2,
					},
					767:{
						items:cloumn,
					},
				}
			});
		}
		
		for( var $i = 0; $i < jQuery(".libero_hottest_owl").size(); $i++ ) {
			var _this = jQuery(".libero_hottest_owl").eq($i)
			var cloumn = _this.attr('data-columns')*1;
			_this.owlCarousel({
				items: cloumn,
				loop: true,
				nav : false,
				margin: 20,
				dots : true,
				responsive:{
					0:{
						items: 1,
						dots : false,
					},
					480:{
						items: 2,
						dots : false,
					},
					768:{
						items: cloumn,
						dots : true,
					},
					1000:{
						items: cloumn,
						dots : true,
					},
				}
			});
		}
		
		jQuery(".libero_recent_post_owl").owlCarousel({
			items: 1,
			nav : true,
			loop: true,
			navText : ['<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>'],
			dots : false,
		});
		
		jQuery(".libero_category_style_4,.libero_header_slider_large_2").owlCarousel({
			items: 1,
			loop: true,
			nav : true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : true,
		});
		
		jQuery(".libero_header_slider_large_3").owlCarousel({
			transitionStyle : "fade",
			stagePadding: 200,
			items: 1,
			loop: true,
			nav : true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : false,
		});
		
		for( var $i = 0; $i < jQuery(".libero_header_slider_3b").size(); $i++ ) {
			var _this = jQuery(".libero_header_slider_3b").eq($i)
			var cloumn = _this.attr('data-columns')*1;
			_this.owlCarousel({
				items: cloumn,
				loop: true,
				nav : true,
				navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
				dots : false,
				responsive:{
					0:{
						items: 1,
					},
					767:{
						items: cloumn,
					}
				}
			});
		}
		
		for( var $i = 0; $i < jQuery(".libero_header_slider_3c").size(); $i++ ) {
			var _this = jQuery(".libero_header_slider_3c").eq($i)
			var cloumn = _this.attr('data-columns')*1;
			_this.owlCarousel({
				
				items: cloumn,
				loop: true,
				nav : true,
				navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
				dots : false,
				responsive:{
					0:{
						items: 1,
					},
					767:{
						items: cloumn,
					}
				}
			});
		}
		
		var owl = jQuery(".libero_header_slider_3");
		owl.on('initialized.owl.carousel changed.owl.carousel', function(event) {
			var item = event.item.index;
			jQuery('.libero_header_slider_3 .owl-item').removeClass('libero_center_item');
			jQuery('.libero_header_slider_3 .owl-item').eq(item + 1).addClass('libero_center_item');
		}).owlCarousel({
			items: 3,
			loop: true,
			nav : true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : false,
			responsive:{
				0:{
					items: 1,
				},
				767:{
					items: 2,
				},
				1300:{
					items: 3,
				},
			}
		});
		
		jQuery(".libero-thumbnail-slider.owl-carousel").owlCarousel({
			items: 1,
			loop: true,
			nav : true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : true,
		});
		
		jQuery(".libero_arrivals_owl").owlCarousel({
			items: 6,
			margin: 30,
			loop: true,
			nav : true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots : false,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 2,
				},
				768:{
					items: 3,
				},
				1000:{
					items: 4,
				},
				1170:{
					items: 6,
				},
			}
		});
		
		/* .Owl carosel */
		
		// Search form
		
		$('.libero_sticky_nav .libero-search-form').submit(function(e){
			if( !$(this).hasClass('open') ){
				e.preventDefault();
				$('.libero_sticky_nav .libero-search-form').addClass('open').removeClass('exit');
			}
		});
		
		$(document).click(function(event){
			if( !$(event.target).is('.libero_sticky_nav .libero-search-form') && !$(event.target).is('.libero_sticky_nav .libero-search-form *') ){
				$('.libero_sticky_nav .libero-search-form').removeClass('open').addClass('exit');
				$('.libero_sticky_nav .libero-search-form .sb').removeClass('active');
			}
		});
		
		$('.libero_sticky_nav .libero-search-form .sb').click(function(){
			$(this).addClass('active');
		});
		
		jQuery('.libero-remove').remove();
		
		/* Custom select box */
		jQuery('.variations_form .libero-select').rsSelectBox();
		jQuery('.woocommerce-ordering select').customSelect();
		
		/* Backstretch */
		if( $('[data-background]').length ) {
			$('[data-background]').each(function() {
				var img = $(this).attr('data-background');
				$(this).backstretch(img);
			});
		}
		
		/* Change Product layout */
		jQuery('.libero_product_layout_list').on('click',function(e){
			e.preventDefault();
			jQuery('.libero_product_layout a').removeClass('active');
			jQuery(this).addClass('active');
			jQuery('.libero-products li').addClass('col-sm-12 libero_products_style_list');
			jQuery('.libero-products li.clear').removeClass('col-sm-12 libero_products_style_list');
			jQuery('.libero-products li').removeClass('col-sm-4');
		});
		jQuery('.libero_product_layout_grid').on('click',function(e){
			e.preventDefault();
			jQuery('.libero_product_layout a').removeClass('active');
			jQuery(this).addClass('active');
			jQuery('.libero-products li').removeClass('col-sm-12 libero_products_style_list');
			jQuery('.libero-products li').addClass('col-sm-4');
			jQuery('.libero-products li.clear').removeClass('col-sm-4');
		});
		
		/* Sticky menu */
		jQuery('.libero_sticky_logo .navbar-toggle').on('click',function(){
			jQuery(this).next('ul').toggleClass('active');
		});
		
		/* Contact Map */
		if ( jQuery('#cd-google-map').length != 0 )
		{
			// set google maps parameters
			
			var map_zoom = jQuery('#cd-google-map').attr('data-zoom');
			if( map_zoom == '' ) map_zoom = 15;
			
			var rs_location = jQuery('#cd-google-map').attr('data-center');
			var latitude = rs_location.substring(0, rs_location.indexOf(",")); 
			var longitude = rs_location.substring(rs_location.indexOf(",")+1);
			
			var marker_url = libero_main_js.themeurl + '/img/marker.png' ;

			//we define here the style of the map
			var style= [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}];
				
			//set google map options
			var map_options = {
				center: new google.maps.LatLng(latitude, longitude),
				zoom: map_zoom*1,
				panControl: false,
				zoomControl: false,
				mapTypeControl: false,
				streetViewControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
				styles: style,
			}
			//inizialize the map
			var map = new google.maps.Map(document.getElementById('google-container'), map_options);
			//add a custom marker to the map				
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(latitude, longitude),
				map: map,
				visible: true,
				icon: marker_url,
			});
		} 
	});
	jQuery(window).load(function(){
		/* Product list */
		product_list_height();
	});
	
	jQuery(window).scroll(function(){
		var wtop = jQuery(window).scrollTop();	
		if( jQuery('.libero_recomment_box').length != 0 )
		{
			var dtop = jQuery('.libero_detail').offset().top;
			var content_height = jQuery('.libero_post_content').offset().top + jQuery('.libero_post_content').height();
			var boxtop = wtop - dtop;
			var box_height = jQuery('.libero_recomment_box').height();
			var container_height = jQuery('.libero_detail').offset().top + jQuery('.libero_detail').height() - 150;
			if ( wtop > content_height )
			{
				jQuery('.libero_recomment_box').addClass('active');
				var boxtop = wtop - dtop;
				if ( wtop < container_height - box_height )
				{
					jQuery('.libero_recomment_box').css('top', boxtop + 50 + 'px');
				}
			} else 
			{
				jQuery('.libero_recomment_box').removeClass('active');
				
			}
		}
		var header_height = jQuery('#libero-header').height();
		if( wtop > header_height )
		{
			jQuery('.libero_header_sticky').addClass('active');
		} else
		{
			jQuery('.libero_header_sticky').removeClass('active');
			jQuery('.libero_sticky_logo > ul').removeClass('active');
		}
	});

	
	function product_list_height() {
		/* Product list */
		jQuery('.libero_products_style_list').each(function() {
			var height = jQuery('.libero_products_style_list').find('.libero-product-thumbnail img').height();
			jQuery('.libero_products_style_list .libero_content_product').css('min-height', height + 'px')
		});
	};
	
}());

}
main();