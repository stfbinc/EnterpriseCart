(function ($) {
 "use strict";

/*----------------------------
 jQuery MeanMenu
------------------------------ */
	jQuery('nav#dropdown').meanmenu();	
	
/*----------------------------
 wow js active
------------------------------ */
 new WOW().init();
 
/*----------------------------
 product-curosel active
------------------------------ */  
  $(".product-curosel").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 4,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
  
/*----------------------------
 latest-blog-curosel active
------------------------------ */  
  $(".latest-blog-curosel").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 3,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,3],
	  itemsDesktopSmall : [980,2],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
  });
  
/*----------------------------
 brand-carousel active
------------------------------ */  
  $(".brand-carousel").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 6,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,5],
	  itemsDesktopSmall : [980,4],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
  
/*----------------------------
 related-curosel active
------------------------------ */  
  $(".related-curosel").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 4,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,3],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
  

/*----------------------------
 banner-curosel active
------------------------------ */  
  $(".banner-curosel").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:false,	  
      items : 1,
      itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],	  
  });
  
/*----------------------------
 category-curosel active
------------------------------ */  
  $(".category-curosel").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 1,
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],	  
  });
  
/*----------------------------
 category-curosel active
------------------------------ */  
  $(".blog-gallery").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 1,
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	  itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
  });
  
/*---------------------
 countdown
--------------------- */
	$('[data-countdown]').each(function() {
	  var $this = $(this), finalDate = $(this).data('countdown');
	  $this.countdown(finalDate, function(event) {
		$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
	  });
	});	  

/*----------------------------
 price-slider active
------------------------------ */  
	  $( "#slider-range" ).slider({
	   range: true,
	   min: 40,
	   max: 600,
	   values: [ 60, 570 ],
	   slide: function( event, ui ) {
		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	   }
	  });
	  $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	   " - $" + $( "#slider-range" ).slider( "values", 1 ) );  
	   	

/*----- cart-plus-minus-button -----*/	
	 $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
	  $(".qtybutton").on("click", function() {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
		  var newVal = parseFloat(oldValue) + 1;
		} else {
		   // Don't allow decrementing below zero
		  if (oldValue > 0) {
			var newVal = parseFloat(oldValue) - 1;
			} else {
			newVal = 0;
		  }
		  }
		$button.parent().find("input").val(newVal);
	  }); 	
	  
	  
	
/*-------------------------
  showlogin toggle function
--------------------------*/
	 $( '#showlogin' ).on('click', function() {
        $( '#checkout-login' ).slideToggle(900);
     }); 
	
/*-------------------------
  showcoupon toggle function
--------------------------*/
	 $( '#showcoupon' ).on('click', function() {
        $( '#checkout_coupon' ).slideToggle(900);
     });
	 
/*-------------------------
  Create an account toggle function
--------------------------*/
	 $( '#cbox' ).on('click', function() {
        $( '#cbox_info' ).slideToggle(900);
     });
	 
/*-------------------------
  Create an account toggle function
--------------------------*/
	 $( '#ship-box' ).on('click', function() {
        $( '#ship-box-info' ).slideToggle(1000);
     });	

/*--------------------------
 scrollUp active
---------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        scrollSpeed: 900,
        animation: 'fade'
    }); 

/*---------------------
 about-counter
--------------------- */	
    $('.about-counter').counterUp({
        delay: 50,
        time: 3000
    });	
	
	
	 $(window).scroll(function () {
        if ($(window).width() > 768) {
			 if ($(this).scrollTop() > 10) {
				 $('.sticky-wrapper').addClass('is-sticky');
             } else {
				 $('.sticky-wrapper').removeClass('is-sticky');
             }
         }
     });
	
	if ($().selectpicker) {
        $('.selectpicker').selectpicker();
    }
/*---------------------
 Color Scheme Select
--------------------- */
	
	$('.color-scheme-select-btn').on('click', function(){		
		$('.color-scheme-select').toggleClass('color-scheme-select-visible');
	});

	$('.color-scheme-theme-item').on('click', function(e){
		e.preventDefault();
		$('.color-scheme-theme-item').removeClass('color-scheme-theme-selected');
		$(this).addClass('color-scheme-theme-selected');
		var colorLink = $(this).attr('id');
		$('.color-scheme-theme').attr('href', 'css/' + colorLink + '.css');
		$.cookie('color', colorLink);
	});

	$('.color-scheme-content').on('click', function(e){
		e.preventDefault();
		$('.color-scheme-content').removeClass('color-scheme-selected');
		$(this).addClass('color-scheme-selected');
		var colorLink = $(this).attr('id');			
		$.cookie('color', colorLink);
		$('.color-scheme-color').attr('href', 'css/theme/' + colorLink + '.css');
	});
 
})(jQuery); 

jQuery(document).on('ready', function() {
	if (jQuery.cookie('color') != null) {
		var id=$.cookie('color');
		$('.color-scheme-content').removeClass('color-scheme-selected');
		$('#'+id).addClass('color-scheme-selected');
		$('.color-scheme-color').attr('href', 'css/theme/' + id + '.css');
         //$this.setColor($.cookie('color'));
	}
});

function getCookie(cname) 
	{
    var name = cname + "=";
    var ca = document.cookie.split(';');
	alert(ca);
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
	
    return "";
	}
	

function setCookie(cname, cvalue, exdays) 
{    
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";	
}