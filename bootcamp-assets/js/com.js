$(document).ready(function(){

	// Select all links with hashes
	$('a[href*="#"]')
	  // Remove links that don't actually link to anything
	  .not('[href="#"]')
	  .not('[href="#quote-carousel"]')
	  .not('[href="#0"]')
	  .click(function(event) {
		// On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

	$(function(){
  $("fieldset > p").each(function(i){
    len=$(this).text().length;
    if(len>80)
    {
		var yourString 	= $(this).text();
		var maxLength 	= 90 // maximum number of characters to extract

		//trim the string to the maximum length
		var trimmedString = yourString.substr(0, maxLength);

		//re-trim if we are in the middle of a word
		trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
       $(this).text(trimmedString+'...');
    }
  });
});
		


	function resetFeatured(){
		var maxHeight = 0;
		$(".featured_coaches").each(function(){
		   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
		});
		$(".featured_coaches").height(maxHeight+3);

	}
	
	function resetFaculty(){
		var maxHeight = 0;
		$(".featured_faculty").each(function(){
		   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
		});
		$(".featured_faculty").height(maxHeight+3);

	}

	$(window).on('resize', function() {
		 if ($(window).width() > 767) 
		 {

			resetFeatured()
			resetFaculty()
		 }//
		 else{
			$(".featured_coaches").css('height','auto');
			$(".featured_faculty").css('height','auto');
		 }
	});

	
	resetFeatured();
	resetFaculty();

});
