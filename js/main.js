jQuery(document).ready(function( $ ) {


	var menu_top = jQuery( "#main-nav" );
	var offset = menu_top.offset();
	console.log(offset);

	var $document = $(document),
	    $element = $('#main-nav'),
	    className = 'navbar-fixed-top';

	$document.scroll(function() {
	  if ($document.scrollTop() >= offset.top) {
	    // user scrolled 50 pixels or more;
	    // do stuff
	    $element.addClass(className);
	    console.log('added');
	  } else {
	    $element.removeClass(className);
	    console.log('removed');
	  }
	});

});