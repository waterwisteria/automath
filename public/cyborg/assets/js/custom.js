(function($)
{
	"use strict";
	
	// Page loading animation
	$(window).on('load', function()
	{
		$('#js-preloader').addClass('loaded');
	});
	
	$(window).scroll(function()
	{
		var scroll = $(window).scrollTop();
		var box = $('.header-text').height();
		var header = $('header').height();
		
		if(scroll >= box - header)
		{
			$("header").addClass("background-header");
		}
		
		else
		{
			$("header").removeClass("background-header");
		}
	});
	
	var width = $(window).width();
	$(window).resize(function()
	{
		if (width > 992 && $(window).width() < 992)
		{
			location.reload();
		}
		
		else if(width < 992 && $(window).width() > 992)
		{
			location.reload();
		}
	});

	// Page loading animation
	$(window).on('load', function()
	{
		if($('.cover').length)
		{
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}
		
		$("#preloader").animate({
			'opacity': '0'
		},
		600,
		function()
		{
			setTimeout(function()
			{
				$("#preloader").css("visibility", "hidden").fadeOut();
			},
			300);
		});
	});

	/* --- Keeping for posterity... 
		$('.owl-features').owlCarousel({
			items:3,
			loop:true,
			dots: false,
			nav: true,
			autoplay: true,
			margin:30,
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1200:{
					items: 3
				},
				1800:{
					items: 3
				}
			}
		});
		
		$('.owl-collection').owlCarousel({
			items:3,
			loop:true,
			dots: false,
			nav: true,
			autoplay: true,
			margin:30,
			responsive: {
				0:{
					items: 1
				},
				800:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});
		
		$('.owl-banner').owlCarousel({
			items:1,
			loop:true,
			dots: false,
			nav: true,
			autoplay: true,
			margin:30,
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 1
				},
				1000:{
					items: 1
				}
			}
		});
	*/
})(window.jQuery);