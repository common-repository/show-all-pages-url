<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<script>

jQuery(document).ready(function($){

        // submit form on plugin checkbox change
        $(".yy_change_menu_loader .change-menu-name").change( function() {
            $(".yy_change_menu_loader").submit();
        }); // $(".yy_change_menu_loader .change-menu-name").change( function() {


    // =============================================================================================
    // Smooth scrolling for inside links #id-name
    // =============================================================================================


    	// Add smooth scrolling to all links
    	$("a").on('click', function(event) {

    		if (this.hash !== "") { // Make sure this.hash has a value before overriding default behavior

				// making sure the url has # but don't have http:// or https://
				if( ($(this).attr('href').indexOf("http://") != 0) && ($(this).attr('href').indexOf("https://") != 0) ) {

	    			if( !$(this).parents('.no-smooth-scroll').length ) {
	    				if( !$(this).hasClass("no-smooth-scroll") ) {

	    					event.preventDefault(); // Prevent default anchor click behavior
	    					var hash = this.hash; // Store hash

	    					// Using jQuery's animate() method to add smooth page scroll The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
	    					$('html, body').animate({scrollTop: $(hash).offset().top}, 800, function(){
	    						window.location.hash = hash; // Add hash (#) to URL when done scrolling (default click behavior)
	    					}); // $('html, body').animate({

	    				} // if( !$(this).hasClass("no-smooth-scroll") ) {
	    			} // if( !$(this).parents('.no-smooth-scroll').length ) {

				} // if( ($(this).attr('href').indexOf("http://") != 0) && ($(this).attr('href').indexOf("https://") != 0) ) {

    		} // if (this.hash !== "") {

    	}); // $("a").on('click', function(event) {


    // =============================================================================================
    // show hover window of data in the page
    // =============================================================================================
    
    // show hover window of data in the page
    $('.yydev-show-all-url .yy-view-data').click( function() {

		var currentDisplay = $(this).parent().find('.yy-data-window');

		if( currentDisplay.css('display') === 'block') {
			currentDisplay.css('display', 'none');
		} else {
		
			$('.yydev-show-all-url .yy-data-window').each( function() {
				$(this).css('display','none');
			});

			currentDisplay.css('display', 'block');
		}

	});


	$('.yydev-show-all-url .yy-data-close').click( function() {
		$(this).parent().parent().find('.yy-data-window').css('display', 'none')
	});

}); // jQuery(document).ready(function($){

</script>