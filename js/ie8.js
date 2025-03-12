jQuery(document).ready(function(){
	"use strict";
    jQuery('body').html('<div class="ie8"><span>Hi! Please, use the latest version of the browser in order to visit current page</span></div>');
});

$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        loop: false, // Disable looping
        nav: true, // Enable navigation arrows
        dots: true, // Enable pagination dots
        items: 1, // Number of items to display at a time
        autoplay: false, // Disable autoplay (optional)
        responsive: {
            0: {
                items: 1 // Number of items for small screens
            },
            768: {
                items: 2 // Number of items for medium screens
            },
            1024: {
                items: 3 // Number of items for large screens
            }
        }
    });
});