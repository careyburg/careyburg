/* --------------------------------------------------------------------------
 *  
 * Author         : Indonez
 * Author URI     : http://indonez.com
 *
 * -------------------------------------------------------------------------- */
(function($){
/* --------------------------------------------------------------------------
 * jQuery Handle Initialization
 * -------------------------------------------------------------------------- */
	"use strict";

	/* ----------- SETTING ----------- */
	var XaragoJStheme = {
		
		xaragojs_mediaelement:function() {
			 $('audio, video').mediaelementplayer();
		},
		
		xaragojs_megamenu:function() {
			
			var megamenu = $('.idz-megamenu');
		
			megamenu.each(function () {
				
				var getImg = $(this).find(".megamenubgimg");
				var imgSrc = getImg.attr("src");
						   
				getImg.hide();
				
				if(imgSrc!=""){
					$(this).find(".uk-dropdown-navbar").css({
					   'background-image' : 'url('+ imgSrc +')'
					});
				}
				
				$(this).find('ul.uk-nav:first-child').each(function () {
					
					$(this).find('ul.uk-nav').removeClass('uk-nav uk-nav-navbar').addClass('sub-menu');
					$(this).removeClass('uk-nav uk-nav-navbar').addClass('uk-grid');
					$(this).attr('data-uk-grid-margin', '');		
					
					var li  = $(this).find('> li'),
						li2 = $(this).find("> :first-child"),
						li3 = $(this).find("> :last-child");
						
					if(megamenu.hasClass( "4column" )){
						li.addClass('uk-width-1-4 uk-width-medium-1-2');		
					}else if(megamenu.hasClass( "3column" )){
						li.addClass('uk-width-1-3 uk-width-medium-1-1');		
					}else if(megamenu.hasClass( "2column" )){
						li.addClass('uk-width-1-2 uk-width-medium-1-2');		
					}else if(megamenu.hasClass( "1column" )){
						li.addClass('uk-width-1-1 uk-width-medium-1-1');		
					}else{
						li.addClass('uk-width-2-10 uk-width-medium-1-3');
						li2.addClass('uk-width-2-10 uk-width-medium-1-3');
						li3.addClass('uk-width-4-10 uk-hidden-medium').removeClass('uk-width-2-10 uk-width-medium-1-3');
					}

							
				});
				
			});
			
		},
		
		xaragojs_scrollUP:function() {
		   
			$(document).scroll(function () {
			var toTop = $('.to-top');
			if ($(this).scrollTop() > 400) {
			
			toTop.fadeIn();
			} else {
			toTop.fadeOut();
			}
			});

		},
		
		
		xaragojs_addslideshow_style:function() {
			
		   var style = $('#slideshow-container');
		   
		   style.find('li.slide-item').each(function () {
			   
			   var color = $(this).attr("data-slide-bg");
			   if(color!=""){
					$(this).css({
					   'background-color' : color
					});
			   }
			   
		   });

		},
		
		// theme init
		xaragojs_init:function(){
			XaragoJStheme.xaragojs_scrollUP();
			XaragoJStheme.xaragojs_mediaelement();
			XaragoJStheme.xaragojs_megamenu();
			XaragoJStheme.xaragojs_addslideshow_style();
	    }
		
	}
		
	  
	// intialization
	jQuery(document).ready(function($){
	
		XaragoJStheme.xaragojs_init();
		
		
		//add class to wp calendar and comment form
		var elementA = $('#wp-calendar, table'),
			elementB = $('form#comment-form, form#commentform, form.woocommerce-checkout, form.cart, form.woocommerce-ordering, form.woocommerce-product-search, form.login, form.checkout_coupon, form.lost_reset_password,  .woocommerce form'),
			elementC = $("#live-chat-button"),
			elementD = $("#btnShowSidebar");
			
			elementA.addClass('uk-table uk-table-striped');
			elementB.addClass('uk-form');
			
		elementC.click(function(){
			
			$("#wp-live-chat-2").toggle();
			
			if( $('#wp-live-chat-4').css('display') == 'block' ) {
				$("#wp-live-chat-2").hide();
			}

		});	
		
		elementD.click(function(){
			
			if( $('#premiumComparisonSidebar').css('display') == 'block' ) {
				$("#premiumComparisonSidebar").toggleClass('showsidebar');
			}

		});	
		
	});
	
}(jQuery));