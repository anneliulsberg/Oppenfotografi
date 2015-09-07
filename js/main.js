jQuery(function($) {    
    "use strict";

	$('#slideshow li:nth-child(1) a').bgswitcher({
	        images: [baseUri + "/images/slideshow-art-1.jpg", baseUri + "/images/slideshow-art-2.jpg"],
	        effect: "fade",
	        interval: 6 * 1000
	});
	$('#slideshow li:nth-child(2) a').bgswitcher({
	        images: [baseUri + "/images/slideshow-studio-1.jpg", baseUri + "/images/slideshow-studio-2.jpg"],
	        effect: "fade",
	        interval: 7 * 1000
	});
	$('#slideshow li:nth-child(3) a').bgswitcher({
	        images: [baseUri + "/images/slideshow-bry-1.jpg", baseUri + "/images/slideshow-bry-2.jpg"],
	        effect: "fade",
	        interval: 9 * 1000
	});
	$('#slideshow li:nth-child(4) a').bgswitcher({
	        images: [baseUri + "/images/slideshow-fash-1.jpg", baseUri + "/images/slideshow-fash-2.jpg"],
	        effect: "fade",
	        interval: 11 * 1000
	});
	$('#slideshow li:nth-child(5) a').bgswitcher({
	        images: [baseUri + "/images/slideshow-bedr-1.jpg", baseUri + "/images/slideshow-bedr-2.jpg"],
	        effect: "fade",
	        interval: 13 * 1000
	});
	$('#slideshow li:nth-child(6) a').bgswitcher({
	        images: [baseUri + "/images/slideshow-akt-1.jpg", baseUri + "/images/slideshow-akt-2.jpg"],
	        effect: "fade",
	        interval: 15 * 1000
	});
	
	
});