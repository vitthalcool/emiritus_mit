$(document).ready(function(){
// Select all links with hashes
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
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

// Below Function Executes On Form Submit
function ValidationEvent() {
// Storing Field Values In Variables
var fname = document.getElementById("first-name").value;
var lname= document.getElementById("last-name").value;
var email = document.getElementById("email").value;
var contact = document.getElementById("contact").value;
// Regular Expression For Email
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
// Conditions
if (name != '' && email != '' && contact != '') {
if (email.match(emailReg)) {
if (document.getElementById("male").checked || document.getElementById("female").checked) {
if (contact.length == 10) {
alert("All type of validation has done on OnSubmit event.");
return true;
} else {
alert("The Contact No. must be at least 10 digit long!");
return false;
}
} else {
alert("You must enter name.....!");
return false;
}
} else {
alert("Invalid Email Address...!!!");
return false;
}
} else {
alert("All fields are required.....!");
return false;
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


// Attach Read More on Para if Length is greater
   $.each( $('.breakingPara'), function() {
     var stringLimit = $(this).attr('data-limit');
         string = $(this).text(),
         readMoreLink = $(this).attr('data-read-more-url');

     if ( ($(window).width() > 1700) && ($('main').hasClass('homePage') ) ) {
       stringLimit = 140;
     }

     if (string.length > stringLimit) {
       var firstLines = string.substr(0, stringLimit),
       lastLines = string.substr(stringLimit, string.length);

       $(this).html('<span class="visible-text">'+ firstLines +' </span><span class="ellipses"> ... <a href="'+ readMoreLink +'" class="plus colorblue" title="Read More"> READ MORE </a></span><span class="hidden-text">'+ lastLines +' <span class="minus orange-text"  title="Read Less"> READ LESS</span></span>');
     }
   });