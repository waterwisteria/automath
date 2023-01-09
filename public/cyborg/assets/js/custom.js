let lastDashboardBestQuizzesPage = 1;

(function($)
{
	"use strict";

	// Page loading animation
	$(window).on('load', function()
	{
		$('#js-preloader').addClass('loaded');
	});

	dashboardChart();
	dashboardMoreBestQuizzesButton();
	
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

	/* --- Keeping for posterity because it works but dont need it... 
		
	*/
})(window.jQuery);

/**
* Set locale in cookie based on locale data attribute.
*
*/
function setLocale(e)
{
	let locale = e.getAttribute('data-locale');
	document.cookie = "Accept-Language=" + locale;
	
	return true;
}

function dashboardChart()
{
	const ctx = document.getElementById('myChart');
	
	if(!ctx)
	{
		return;
	}
	
	Chart.defaults.color = '#e75e8d';
	//Chart.defaults.backgroundColor = '#fff';
	let quizChartsData = $('#quizChartsData').data('json');
	
	let chart = new Chart(ctx,
	{
		type: 'bar',
		data:
		{
			labels: Object.keys(quizChartsData.Results),
			datasets:
			[{
				label: $(ctx).data('message'),
				data: quizChartsData.Results,
				borderWidth: 1
			}]
		},
		options:
		{
			scales:
			{
				y:
				{
					beginAtZero: true
				}
			},
			onClick: (e) =>
			{
				const canvasPosition = Chart.helpers.getRelativePosition(e, chart);
				const dataX = chart.scales.x.getValueForPixel(canvasPosition.x);

				window.open(quizChartsData.Urls[dataX], '_self');
			}
		}
	});
}

function dashboardMoreBestQuizzesButton()
{
	let $mainButtonAnchor = $('.main-button-container').find('a');
	let ajaxMoreBestQuizRoute = $('#ajax-more-best-quizzes-route').data('route');
	let bestQuizzesPerPage = $('#ajax-more-best-quizzes-route').data('best_quizzes_per_page');

	if(ajaxMoreBestQuizRoute && $mainButtonAnchor.length && bestQuizzesPerPage)
	{
		$mainButtonAnchor.click(function()
		{
			let jqXHR = $.get(
				ajaxMoreBestQuizRoute,
				{
					'page':  ++lastDashboardBestQuizzesPage
				}
			);

			jqXHR.done(function(data)
			{
				let $bestQuizzes = $($.parseHTML(data)).find('.item');
				
				$(data).insertBefore('.main-button-container');
				
				if($bestQuizzes.length < bestQuizzesPerPage)
				{
					$('.main-button-container').remove();
				}
			});

			return false;
		});
	}
}

function runOwnCarousel()
{
	$('.owl-features').owlCarousel({
		items:3,
		loop:true,
		dots: false,
		nav: true,
		autoplay: true,
		margin:30,
		responsive:
		{
			0:
			{
				items: 1
			},
			600:
			{
				items: 2
			},
			1200:
			{
				items: 3
			},
			1800:
			{
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
		responsive:
		{
			0:
			{
				items: 1
			},
			800:
			{
				items: 2
			},
			1000:
			{
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
		responsive:
		{
			0:
			{
				items: 1
			},
			600:
			{
				items: 1
			},
			1000:
			{
				items: 1
			}
		}
	});
}