jQuery(document).ready(function( $ ) {


	var menu_top = jQuery( "#main-nav" );
	var offset = menu_top.offset();
	var nav_height = $('#main-nav').outerHeight(true);

	//console.log(offset);

	var $document = $(document),
	    $element = $('#fixed-main-nav');

	$document.scroll(function() {
		var position = $document.scrollTop();
	  if (position >= offset.top) {
	    $element.css('visibility', 'visible');
	  } else if (position < offset.top) {
	    $element.css('visibility', 'hidden');
	  } else {

	  }
	});

	//$('#navbar-placeholder').height(nav_height);

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

	$('body.single img').addClass('img-responsive');
	$('div.some-damn-ad img').addClass('center-block');
	$(".wp-caption").removeAttr('style').find('img').addClass('pull-left').after('<div class="clearfix"></div>');


	function row_height(){

	   var maxHeight = -1;

	   $('body.home div.row.posts').each(function(){

	   		maxHeight = 0;
	   		
	   		$(this).children('div').each(function() {
		    	maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
		   	});

	   		$(this).children('div').each(function() {
		    	$(this).innerHeight(maxHeight);
		   	});
	   });
	   $('div.full-block').each(function(){
	   	var parheight = $(this).parent().height();
	   	$(this).height(parheight);
	   });

	 }

	//console.log('done');

	function menu_item_size() { //main-nav-fixed
		
		var menuWidth = $('#menu-new-top-menu').innerWidth();
		var items = $('#menu-new-top-menu').children('li').length;
		var margs = $('#menu-new-top-menu>li:nth-child(2)').css('margin-left').replace("px", "");
		var margs = parseInt(margs,10);
		var total = 0;
		$('#menu-new-top-menu>li').each(function(){
			var itemWidth = $(this).width();
			var itemWidthPlus = itemWidth+margs;
			total = total+itemWidthPlus;
		});
		total = total + $('#main-nav a.navbar-brand').width();
		var remainder = menuWidth-total;
		var rightMargs = remainder/(items);

		$('#menu-new-top-menu>li:not(:last-child), #main-nav a.navbar-brand').css('margin-right', rightMargs);

	}

	function fixed_menu_item_size() { //main-nav-fixed
		
		var menuWidth = $('#main-nav-fixed').innerWidth();
		var items = $('#main-nav-fixed').children('li').length;
		var margs = $('#main-nav-fixed>li:nth-child(2)').css('margin-left').replace("px", "");
		var margs = parseInt(margs,10);
		var total = 0;
		$('#main-nav-fixed>li').each(function(){
			var itemWidth = $(this).width();
			var itemWidthPlus = itemWidth+margs;
			total = total+itemWidthPlus;
		});
		total = total + $('#fixed-main-nav a.navbar-brand').width();
		var remainder = menuWidth-total;
		var rightMargs = remainder/(items);

		$('#main-nav-fixed li:not(:last-child), #fixed-main-nav a.navbar-brand').css('margin-right', rightMargs);

	}

	$(window).resize(menu_item_size);
	$(window).resize(fixed_menu_item_size);
	$(window).resize(row_height);

	function scrollToAnchor(aid){
	    var aTag = $(aid);
	    $('html,body').animate({scrollTop: (aTag.offset().top-70)},'fast');
	}

	$('#authorinfolink').click(function(){
		var loc = $(this).attr('href');
		scrollToAnchor(loc);
	});

	menu_item_size();
	fixed_menu_item_size();
	row_height();


});