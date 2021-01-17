/*
	Template Name: Cornike - Business HTML5 Template
	Author: Tripples
	Author URI: https://themeforest.net/user/tripples
	Description: Cornike - Business HTML5 Template
	Version: 1.0

	1. Fixed header
	2. Main slideshow
	3. Site search
	4. Owl Carousel
	5. Video popup
	6. Counter
	7. Contact form
	8. Back to top
  
*/


jQuery(function ($) {
	"use strict";

	/* ----------------------------------------------------------- */
	/*  Fixed header
	/* ----------------------------------------------------------- */

	$(window).on('scroll', function () {
		if ($(window).scrollTop() > 70) {
			$('.navdown, .header-two').addClass('navbar-fixed');
		} else {
			$('.navdown, .header-two').removeClass('navbar-fixed');
		}
	});

	/* ----------------------------------------------------------- */
	/*  Mobile Menu
	/* ----------------------------------------------------------- */

	jQuery(".nav.navbar-nav li a").on("click", function () {
		jQuery(this).parent("li").find(".dropdown-menu").slideToggle();
		jQuery(this).find("i").toggleClass("fa-angle-down fa-angle-up");
	});


	/* ----------------------------------------------------------- */
	/*  Contact Map 
	/* -----------------------------------------------------------*/

	if ($('#map').length > 0) {

		var contactmap = {
			lat: 40.742964,
			lng: -73.992277
		};

		$('#map')
			.gmap3({
				zoom: 13,
				center: contactmap,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false
			})

			.marker({
				position: contactmap
			})

			.infowindow({
				position: contactmap,
				content: "NYC Seminar and Conference Center, New York"
			})

			.then(function (infowindow) {
				var map = this.get(0);
				var marker = this.get(1);
				marker.addListener('click', function () {
					infowindow.open(map, marker);
				});
			});
	}


	/* ----------------------------------------------------------- */
	/*  Main slideshow
	/* ----------------------------------------------------------- */

	$('#main-slide').carousel({
		pause: true,
		interval: 100000,
	});




	/* ----------------------------------------------------------- */
	/*  Site search
	/* ----------------------------------------------------------- */

	$('.nav-search').on('click', function () {
		$('.search-block').fadeIn(350);
	});

	$('.search-close').on('click', function () {
		$('.search-block').fadeOut(350);
	});



	/* ----------------------------------------------------------- */
	/*  Owl Carousel
	/* ----------------------------------------------------------- */


	//Project slide

	$("#project-slide").owlCarousel({

		loop: true,
		animateOut: 'fadeOut',
		nav: true,
		margin: 15,
		dots: false,
		mouseDrag: true,
		touchDrag: true,
		slideSpeed: 800,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		items: 4,
		responsive: {
			0: {
				items: 2
			},
			600: {
				items: 4
			}
		}

	});


	//Testimonial slide

	$("#testimonial-slide").owlCarousel({

		loop: false,
		margin: 30,
		nav: false,
		dots: true,
		items: 3,
		responsive: {
			0: {
				items: 1
			},


			600: {
				items: 1
			}
		}

	});



	//Partners slide

	$("#partners-carousel").owlCarousel({

		loop: true,
		margin: 20,
		nav: false,
		dots: false,
		mouseDrag: true,
		touchDrag: true,
		items: 5,
		responsive: {
			0: {
				items: 2
			},
			600: {
				items: 5
			}
		}

	});

	//Page slide

	$(".page-slider").owlCarousel({

		loop: true,
		animateOut: 'fadeOut',
		autoplay: true,
		autoplayHoverPause: true,
		nav: true,
		margin: 0,
		dots: false,
		mouseDrag: true,
		touchDrag: true,
		slideSpeed: 500,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		items: 1,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			}
		}

	});


	//Team slide

	$("#team-slide").owlCarousel({

		loop: false,
		animateOut: 'fadeOut',
		nav: true,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		margin: 20,
		dots: false,
		mouseDrag: true,
		touchDrag: true,
		slideSpeed: 800,
		items: 4,
		responsive: {
			0: {
				items: 1
			},
			480: {
				items: 2
			},
			1000: {
				items: 4,
				loop: false
			}
		}

	});


	/* ----------------------------------------------------------- */
	/*  Video popup
	/* ----------------------------------------------------------- */
	$(document).ready(function () {

		$(".gallery-popup").colorbox({
			rel: 'gallery-popup',
			transition: "fade",
			innerHeight: "500"
		});

		$(".popup").colorbox({
			iframe: true,
			innerWidth: 600,
			innerHeight: 400
		});

	});


	// -----------------------------
	//  Count Up
	// -----------------------------
	function counter() {
		var oTop;
		if ($('.counterUp').length !== 0) {
			oTop = $('.counterUp').offset().top - window.innerHeight;
		}
		if ($(window).scrollTop() > oTop) {
			$('.counterUp').each(function () {
				var $this = $(this),
					countTo = $this.attr('data-count');
				$({
					countNum: $this.text()
				}).animate({
					countNum: countTo
				}, {
					duration: 1000,
					easing: 'swing',
					step: function () {
						$this.text(Math.floor(this.countNum));
					},
					complete: function () {
						$this.text(this.countNum);
					}
				});
			});
		}
	}
	$(window).on('scroll', function () {
		counter();
	});



	/* ----------------------------------------------------------- */
	/*  Contact form
	/* ----------------------------------------------------------- */

	$('#contact-form').submit(function () {

		var $form = $(this),
			$error = $form.find('.error-container'),
			action = $form.attr('action');

		$error.slideUp(750, function () {
			$error.hide();

			var $name = $form.find('.form-control-name'),
				$email = $form.find('.form-control-email'),
				$subject = $form.find('.form-control-subject'),
				$message = $form.find('.form-control-message');

			$.post(action, {
					name: $name.val(),
					email: $email.val(),
					subject: $subject.val(),
					message: $message.val()
				},
				function (data) {
					$error.html(data);
					$error.slideDown('slow');

					if (data.match('success') != null) {
						$name.val('');
						$email.val('');
						$subject.val('');
						$message.val('');
					}
				}
			);

		});

		return false;

	});





	/* ----------------------------------------------------------- */
	/*  Back to top
	/* ----------------------------------------------------------- */

	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#back-to-top').on('click', function () {
		$('#back-to-top').tooltip('hide');
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	$('#back-to-top').tooltip('hide');

        // Prodcut details image view JS
    var modal = document.getElementById("imageModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("imageview");
    var captionText = document.getElementById("caption2");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close2")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }






});

  
$(document).ready(function(){

 $(".user_comment").click(function(){
    $(".comment_section").toggleClass("user_comt");
  });



});

function showReplyForm(cid)
{

	$("#reply-form-"+cid).toggleClass("user_comt");
}
 $(".advance_section .advance").click(function(){
    $('.advance_option').toggleClass("intro");
  });



$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('.apply_now_from-update').offset().top
    }, 'slow');


    // My project js tab

    /**
 * Defines the bootstrap tabs handler.
 *
 * @param {string} element
 *  Element.
 */
var tabsActions = function (element) {
  this.element = $(element);

  this.setup = function () {
    if (this.element.length <= 0) {
      return;
    }
    this.init();
    // Update after resize window.
    var resizeId = null;
    $(window).resize(function () {
      clearTimeout(resizeId);
      resizeId = setTimeout(() => {this.init()}, 50);
    }.bind(this));
  };
  
  this.init = function () {
 
    // Add class to overflow items.
    this.actionOverflowItems();
    var tabs_overflow = this.element.find('.overflow-tab');
 
    // Build overflow action tab element.
    if (tabs_overflow.length > 0) {
      if (!this.element.find('.overflow-tab-action').length) {
        var tab_link = $('<a>')
          .addClass('nav-link')
          .attr('href', '#')
          .attr('data-toggle', 'dropdown')
          .text('...')
          .on('click', function (e) {
            e.preventDefault();
            $(this).parents('.nav.nav-tabs').children('.nav-item.overflow-tab').toggle();
          });

        var overflow_tab_action = $('<li>')
          .addClass('nav-item')
          .addClass('overflow-tab-action')
          .append(tab_link);

        // Add hide to overflow tabs when click on any tab.
        this.element.find('.nav-link').on('click', function (e) {
          $(this).parents('.nav.nav-tabs').children('.nav-item.overflow-tab').hide();
        });
        this.element.append(overflow_tab_action);
      }
      
      this.openOverflowDropdown();
    }
    else {
      this.element.find('.overflow-tab-action').remove();
    }
 };
 
  this.openOverflowDropdown = function () {
    var overflow_sum_height = 0;
    var overflow_first_top = 41;
    
    this.element.find('.overflow-tab').hide();
    // Calc top position of overflow tabs.
    this.element.find('.overflow-tab').each(function () {
      var overflow_item_height = $(this).height() - 1;
      if (overflow_sum_height === 0) {
        $(this).css('top', overflow_first_top + 'px');
        overflow_sum_height += overflow_first_top + overflow_item_height;
      }
      else {
        $(this).css('top', overflow_sum_height + 'px');
        overflow_sum_height += overflow_item_height;
      }

    });
  };

  this.actionOverflowItems = function () {
    var tabs_limit = this.element.width() - 100;
    var count = 0;
    
    // Calc tans width and add class to any tab that is overflow.
    for (var i = 0; i < this.element.children().length; i += 1) {
      var item = $(this.element.children()[i]);
      if (item.hasClass('overflow-tab-action')) {
        continue;
      }
      
      count += item.width();
      if (count > tabs_limit) {
        item.addClass('overflow-tab');
      }
      else if (count < tabs_limit) {
        item.removeClass('overflow-tab');
        item.show();
      }
    }
  };
};

var tabsAction = new tabsActions('.layout--tabs .nav-tabs-wrapper .nav-tabs');
tabsAction.setup();



});


$(".button_classs a.btn-sm.btn-danger").click(function() {
    $('html,body').animate({
        scrollTop: $(".apply_now_from-update").offset().top},
        'slow');
});




  $(".profile_add_section .experience").click(function(){
    $(".experience_section.experience").toggleClass("exactive");
  });
$(".profile_add_section .education").click(function(){
    $(".experience_section.education").toggleClass("exactive");
  });
