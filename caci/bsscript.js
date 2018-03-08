// Scripts for Bootstrap - caci.org


// ***** SMOOTH SCROLLING *****

$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

   // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
      });
    } // End if
  });
})


// ***** FOR XS VIEWPORT, COLLAPSE NAVBAR AFTER CLICK *****

$(document).on('click', '.navbar-collapse.in', function(e) {
    if($(e.target).is('a') && ($(e.target).attr('class') != 'dropdown-toggle')) {
        $(this).collapse('hide');
    }
});


// ***** TOGGLE TEXT OF SHOW/HIDE BUTTON ACCORDING TO STATE OF COLLAPSE ELEMENT *****

function showHide(hiddenElementId, buttonId, toExpandHtml, toCollapseHtml) {
    $(hiddenElementId).on('hidden.bs.collapse', function() {
        $(buttonId).html(toExpandHtml);
    });
    $(hiddenElementId).on('shown.bs.collapse', function() {
        $(buttonId).html(toCollapseHtml);
    });
}

var chevronDown = ' <span class="glyphicon glyphicon-chevron-down"></span>';
var chevronUp = ' <span class="glyphicon glyphicon-chevron-up"></span>';
var showMoreHtml = 'Show more' + chevronDown;
var showLessHtml = 'Show less' + chevronUp;
var showPastConvHtml = 'Show past Conventions' + chevronDown;
var hidePastConvHtml = 'Hide past Conventions' + chevronUp;

showHide('#at-large-hidden', '#moreless-atlarge', showMoreHtml, showLessHtml);
showHide('#scholarship-hidden', '#moreless-scholarship', showMoreHtml, showLessHtml);
showHide('#past-conv-list', '#show-past-conv', showPastConvHtml, hidePastConvHtml);
