jQuery(document).ready(function(){
	"use strict";
    jQuery('body').html('<div class="ie8"><span>Hi! Please, use the latest version of the browser in order to visit current page</span></div>');
});

document.addEventListener("DOMContentLoaded", function () {
    const iframes = document.querySelectorAll("iframe");

    iframes.forEach((iframe) => {
        iframe.addEventListener("load", function () {
            iframe.addEventListener("mouseenter", function () {
                document.body.classList.add("disable-cursor-effect");
            });

            iframe.addEventListener("mouseleave", function () {
                document.body.classList.remove("disable-cursor-effect");
            });
        });
    });
});