jQuery(document).ready(function( $ ) {


	var menu_top = jQuery( "#main-nav" );
	var offset = menu_top.offset();
	var nav_height = menu_top.height();
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

	$('#navbar-placeholder').height(nav_height);

	$(document).on('click', 'a.toc-nav', function(e){

		var page = $(this).attr('data-page');
		var type = $(this).attr('data-type');
		
		toc_nav(page,type);

		if($(this).hasClass('next-page')){
			$('a.toc-nav').each(function(){
				var no = parseInt($(this).attr('data-page'));
				var newno = no+1;
				$(this).attr('data-page', newno);
				if(newno == 0){
					$(this).addClass('disabled').attr('disabled', 'disabled');
				}else{
					$(this).removeClass('disabled').removeAttr('disabled');
				}
			});
		}
		if($(this).hasClass('prev-page')){
			$('a.toc-nav').each(function(){
				var no = parseInt($(this).attr('data-page'));
				var newno = no-1;
				$(this).attr('data-page', newno);
				if(newno == 0){
					$(this).addClass('disabled').attr('disabled', 'disabled');
				}else{
					$(this).removeClass('disabled').removeAttr('disabled');
				}
			});
		}

		$("#contents-holder table").animate({
        	opacity: 0
    	}, 100);

    	$('#current-page span').text(page);


		e.preventDefault();

	});

	toc_cache = [];


	function toc_nav(page, type){

		$.ajax({
		     url: WP_AJAX.ajaxurl,
		     type: 'post',
		     data: {
		     	action: 'toc_nav',
		     	page: page,
		     	type: type

		     }, 
		     success: function(html){
		     	console.log(html);
		     	$('#contents-holder table tbody').html(html);
		     	$("#contents-holder table").animate({
		        	opacity: 200
		    	}, 100);
		     }
		});

	};

});