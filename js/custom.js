jQuery(document).ready(function($){
	$(".libero-iframe").fitVids();
	
	$('body').append( '<div id="libero-popup-product" class="product single-product"></div>' );
	
	$(document).on('click', '.product .quick-view-btn', function(e) {
		e.preventDefault();
		var _this = $( this );
		var product_id = $(this).attr('data-product-id');
		var home_url = $('a.logo').attr('href');
		$('#libero-popup-product').append( '<div class="quick-view visible"><div class="mask quickview-close transition loading"><span class="libero-loading"><img src="' + libero_main.themeurl +'/img/loading.gif" alt="" /></span></div></div>');
		
		$.ajax({
			type : 'POST',
			data : {
			   'action' : 'quickview_product',
			   'p_id' :  product_id
			},
			url : libero_main.ajaxurl,
			success : function (result){
				var popup = $('#libero-popup-product');
				popup.html(result);
				
				popup.find( '.quick-view' ).addClass( 'visible' );
				
				$('.variations_form .libero-select').rsSelectBox();
				
				popup.find( '.variations_form' ).wc_variation_form();
				popup.find( '.variations_form' ).find('.variations select:eq(0)').change();
				
				
				$("a.zoom").prettyPhoto({hook:"data-rel",social_tools:!1,theme:"pp_woocommerce",horizontal_padding:20,opacity:.8,deeplinking:!1});
				$("a[data-rel^='prettyPhoto']").prettyPhoto({hook:"data-rel",social_tools:!1,theme:"pp_woocommerce",horizontal_padding:20,opacity:.8,deeplinking:!1});
				
				if( $( 'form .quantity' ).length > 0 ) {
					var form_cart = $( 'form .quantity' );
					form_cart.prepend( '<span class="minus">-</span>' );
					form_cart.append( '<span class="plus">+</span>' );

					var minus = form_cart.find( $( '.minus' ) );
					var plus  = form_cart.find( $( '.plus' ) );

					minus.on( 'click', function(){
						var qty = $( this ).parent().find( '.qty' );
						if ( qty.val() <= 1 ) {
							qty.val( 1 );
						} else {
							qty.val( ( parseInt( qty.val() ) - 1 ) );
						}
					});
					plus.on( 'click', function(){
						var qty = $( this ).parent().find( '.qty' );
						if( Number.isInteger( parseInt(qty.attr('max')) ) ) {
							if( qty.val() < parseInt(qty.attr('max')) ) {
								qty.val( ( parseInt( qty.val() ) + 1 ) );
							}
							else {
								qty.val( qty.attr('max') );
							}
						} else {
							qty.val( ( parseInt( qty.val() ) + 1 ) );
						}
					});
				}
			}
		});
	});
	$(document).on('click', '.quickview-close', function(e) {
		e.preventDefault();
		$( this ).parents( '.quick-view' ).toggleClass( 'visible' );
	});
	
	if( $( 'form .quantity' ).length > 0 ) {
		var form_cart = $( 'form .quantity' );
		form_cart.prepend( '<span class="minus">-</span>' );
		form_cart.append( '<span class="plus">+</span>' );

		var minus = form_cart.find( $( '.minus' ) );
		var plus  = form_cart.find( $( '.plus' ) );

		minus.on( 'click', function(){
			var qty = $( this ).parent().find( '.qty' );
			if ( qty.val() <= 1 ) {
				qty.val( 1 );
			} else {
				qty.val( ( parseInt( qty.val() ) - 1 ) );
			}
		});
		plus.on( 'click', function(){
			var qty = $( this ).parent().find( '.qty' );
			if( Number.isInteger( parseInt(qty.attr('max')) ) ) {
				if( qty.val() < parseInt(qty.attr('max')) ) {
					qty.val( ( parseInt( qty.val() ) + 1 ) );
				}
				else {
					qty.val( qty.attr('max') );
				}
			} else {
				qty.val( ( parseInt( qty.val() ) + 1 ) );
			}
		});
	}
	
	
	$('.libero-slider-maybe .clear').remove();
	$(".libero-slider-maybe").owlCarousel({
		items: 2,
		nav : true,
		loop: true,
		navText : ['<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>'],
		dots : false,
		responsive:{
			0:{
				items: 1,
			},
			480:{
				items: 2,
			},
		}
	});
	$('.widget_attributes_filter select').change(function(){
		$(this).parents('form').submit();
	});
	
	$(document).on('click', '.libero-reset-filter', function(e) {
		e.preventDefault();
		$(this).parents('form').find('input[type="text"]').val("");
		$(this).parents('form').find('select option').removeAttr('selected');
		$(this).parents('form').find('input[type="checkbox"]').removeAttr('checked');
		$(this).parents('form').submit();
	});
	
	$('.widget_woo_brand input[type="checkbox"]').change(function(e) {
		e.preventDefault();
		$(this).parents('form').submit();
	});
});