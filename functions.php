<?php

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );


	if ( ! isset( $content_width ) ) {
		$content_width = 660;
	}

	require_once('wp_bootstrap_navwalker.php');

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'home-feat', 620, 340, true);
		add_image_size( 'x-large', 770, 420, true);
		add_image_size( 'boots3', 220, 145, true);
		add_image_size( 'boots4', 300, 300, true);
		add_image_size( 'feat-thumb', 300, 200, true );
	}

	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'new-primary' => 'New Main Menu',
		//'reviews' => 'Reviews Subnav',
		//'features-menu' => 'Features Subnav',
		'footer1' => 'Footer 1',
		'new-footer1' => 'New Footer 1',
		'footer2' => 'Footer 2',
		'footer3' => 'Footer 3',
		'footer4' => 'Footer 4',
	) );

	add_action( 'init', 'build_taxonomies', 0 );
	
	function build_taxonomies() {
	
	    register_taxonomy( 'featured', 'post', array( 'hierarchical' => true, 'label' => 'Feature Assign', 'query_var' => true, 'rewrite' => true ) );
	    register_taxonomy( 'venues', 'post', array( 'hierarchical' => true, 'label' => 'Venues', 'query_var' => true, 'rewrite' => true ) );
	    register_taxonomy( 'edinburgh', 'post', array( 'hierarchical' => true, 'label' => 'Edinburgh Festival', 'query_var' => true, 'rewrite' => true, 'show_ui' => false) );
	    register_taxonomy( 'festivals', 'post', array( 'hierarchical' => true, 'label' => 'Festivals', 'query_var' => true, 'rewrite' => true ) );
	    register_taxonomy( 'adtype', 'adverts', array( 'hierarchical' => true, 'label' => 'Ad Type', 'query_var' => false, 'rewrite' => false ) );
	    register_taxonomy( 'adpos', 'adverts', array( 'hierarchical' => true, 'label' => 'Ad Position', 'query_var' => false, 'rewrite' => false ) );
	    register_taxonomy( 'carousel', 'post', array( 'hierarchical' => true, 'label' => 'Carousel Assign', 'query_var' => false, 'rewrite' => false ) );
	}	
	
	add_action( 'init', 'create_my_post_types' );
		
		function create_my_post_types() {
			register_post_type( 'review',
				array(
					'labels' => array(
						'name' => __( 'Reviews' ),
						'singular_name' => __( 'Review' ),
						'add_new' => __( 'Add New' ),
						'add_new_item' => __( 'Add New Review' ),
						'edit' => __( 'Edit' ),
						'edit_item' => __( 'Edit Review' ),
						'new_item' => __( 'New Review' ),
						'view' => __( 'View Review' ),
						'view_item' => __( 'View Review' ),
						'search_items' => __( 'Search Reviews' ),
						'not_found' => __( 'No reviews found' ),
						'not_found_in_trash' => __( 'No reviews found in Trash' ),
						'parent' => __( 'Parent Review' )
							),
						'public' => true,
						'supports' => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'author', 'excerpt', 'thumbnail', 'post-formats' ),
						'taxonomies' => array( 'post_tag', 'category', 'featured', 'venues', 'edinburgh', 'festivals', 'carousel'),
						'publicly_queryable' => true,
						'has_archive' => true,
						'rewrite' => array('slug' => 'reviews'),
						'menu_position' => 5,
						'menu_icon' => 'dashicons-media-document',
						'query_var' => true
				)
			);
			
			register_post_type( 'features',
				array(
					'labels' => array(
						'name' => __( 'Features' ),
						'singular_name' => __( 'Feature' ),
						'add_new' => __( 'Add New' ),
						'add_new_item' => __( 'Add New Feature' ),
						'edit' => __( 'Edit' ),
						'edit_item' => __( 'Edit Feature' ),
						'new_item' => __( 'New Feature' ),
						'view' => __( 'View Feature' ),
						'view_item' => __( 'View Feature' ),
						'search_items' => __( 'Search Features' ),
						'not_found' => __( 'No features found' ),
						'not_found_in_trash' => __( 'No features found in Trash' ),
						'parent' => __( 'Parent Feature' )
					),
						'public' => true,
						'has_archive' => true,
						'supports' => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'author', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields' ),
						'taxonomies' => array( 'post_tag', 'category', 'featured', 'edinburgh', 'festivals', 'carousel'),
						'menu_position' => 5,
						'menu_icon' => 'dashicons-welcome-write-blog',
						'query_var' => true
				)
			);
			
				register_post_type( 'podcast',
				array(
					'labels' => array(
						'name' => __( 'Podcasts' ),
						'singular_name' => __( 'Podcast' ),
						'add_new' => __( 'Add New Podcast' ),
						'add_new_item' => __( 'Add New Podcast' ),
						'edit' => __( 'Edit' ),
						'edit_item' => __( 'Edit Podcast' ),
						'new_item' => __( 'New Podcast' ),
						'view' => __( 'View Podcast' ),
						'view_item' => __( 'View Podcast' ),
						'search_items' => __( 'Search Podcasts' ),
						'not_found' => __( 'No podcasts found' ),
						'not_found_in_trash' => __( 'No podcasts found in Trash' ),
						'parent' => __( 'Parent Podcast' )
					),
						'public' => true,
						'has_archive' => true,
						'rewrite' => array('slug' => 'podcasts'),
						'supports' => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'author', 'excerpt', 'thumbnail', 'post-formats', 'festivals' ),
						'taxonomies' => array( 'post_tag', 'category', 'featured', 'edinburgh'),
						'menu_position' => 5,
						'menu_icon' => 'dashicons-microphone',
						'query_var' => true
				)
			);
	
	register_post_type( 'adverts',
		array(
			'labels' => array(
				'name' => __( 'Advertisements' ),
				'singular_name' => __( 'Advert' ),
				'add_new' => __( 'Add New Advert' ),
				'add_new_item' => __( 'Add New Advert' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Advert' ),
				'new_item' => __( 'New Advert' ),
				'view' => __( 'View Advert' ),
				'view_item' => __( 'View Advert' ),
				'search_items' => __( 'Search Advert' ),
				'not_found' => __( 'No Adverts found' ),
				'not_found_in_trash' => __( 'No Adverts found in Trash' ),
				'parent' => __( 'Parent Advert' )
			),
				'public' => false,
				'show_ui' => true,
				'supports' => array( 'title', 'excerpt', 'thumbnail' ),
				'taxonomies' => array( 'adtype', 'adpos'),
				'menu_position' => 5,
						'menu_icon' => 'dashicons-slides',
				'query_var' => false,
				'exclude_from_search' => true
		)
	);
	
} //end registering post types

function jquery_cdn() {

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.8.3');
    wp_enqueue_script('jquery');

}

//add_action('init', 'jquery_cdn');

function exeunt_register_assets() {

	$td = get_template_directory_uri();
    
    wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js', array('jquery'), '1', true );

    wp_register_script( 'exeunt_scripts', $td . '/js/main.js', array('jquery'), '1', true );
        
    //wp_register_script( 'respond', $td . '/js/respond.min.js', array('jquery'), '1', true );
    
    wp_register_script( 'ganalytics', $td . '/js/analytics.js', array('jquery'), '1', true );
            
    wp_register_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700', false, '1', 'screen' );        
    wp_register_style( 'roboto-sans', 'https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900,100italic,300italic,400italic,500italic,700italic,900italic|Amatic+SC:400,700|Dancing+Script:400,700', false, '1', 'screen' );        
    wp_register_style( 'fatties', 'https://fonts.googleapis.com/css?family=Sigmar+One|Chango', false, '1', 'screen' );        

    wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, '1', 'all' );
    wp_register_style( 'bootstrapstyles', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css', false, '1', 'all' );
            
}
add_action( 'wp_enqueue_scripts', 'exeunt_register_assets' );

function exeunt_scripts_and_styles() {
	
	wp_enqueue_style( "bootstrapstyles" );
	wp_enqueue_style( 'mainStyles', get_stylesheet_uri() );
	
    wp_enqueue_script( "jquery" );
    wp_enqueue_script( "bootstrap" );
    //wp_enqueue_script( "modernizr" );
    wp_enqueue_script( "exeunt_scripts" );
	wp_localize_script('exeunt_scripts', 'WP_AJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
    //wp_enqueue_script( "ganalytics" );
    wp_enqueue_style( "fontawesome" );
    wp_enqueue_style( "roboto-sans" );

    //if( is_page_template( 'logotype.php' ) ) {
    	wp_enqueue_style( "fatties" );
    //}
    
    //wp_enqueue_script( "respond" );

}

add_action( 'wp_enqueue_scripts', 'exeunt_scripts_and_styles' );

add_action('wp_ajax_toc_nav', 'toc_nav');
add_action('wp_ajax_nopriv_toc_nav', 'toc_nav');

function toc_nav() {

	$page = $_POST['page'];
	$type = $_POST['type'];

	$args = array(

		'post_type' => $type,
		'posts_per_page' => 10,
		'paged' => $page

		);

	$posts = get_posts($args);

	toc($posts);

    exit;

}

function toc($posts){

	$current_year = date('Y');

	if($posts):

		foreach($posts as $post) : setup_postdata($post); 

		$permalink = get_permalink($post->ID);
		$title = get_the_title($post->ID);
		$date = date_create_from_format('Y-m-d H:i:s', $post->post_date);
		$checkyear = date_format($date, 'Y');
		if($checkyear != $current_year){
			$time = date_format($date, 'd M Y');
		}else{
			$time = date_format($date, 'd M');
		}
		?>

			<tr>
				<td class="author"><?php echo get_the_author(); ?></td>
				<td class="gil nowrap"><?php echo $time ?></td>
				<td class="toc-ex"><span class="gil"><a href="<?php echo $permalink ?>"><?php echo $title; ?></a></span><p><?php echo $post->post_excerpt; ?></p></td>
			</tr>

		<?php

		endforeach;

	endif;
}

function print_r2($val){
    echo '<pre>';
    	print_r($val);
    echo  '</pre>';
}

add_filter( 'pre_get_posts' , 'ucc_include_custom_post_types' );

function ucc_include_custom_post_types( $query ) {
  global $wp_query;

  if ( !is_preview() && !is_admin() && !is_singular() ) {
    $args = array(
      'public' => true ,
      '_builtin' => false
    );
    $output = 'names';
    $operator = 'and';

    $post_types = get_post_types( $args , $output , $operator );

    /* Add 'link' and/or 'page' to array() if you want these included:
     * array( 'post' , 'link' , 'page' ), etc.
     */
    $post_types = array_merge( $post_types , array( 'post' ) );

    if ($query->is_feed) {
      /* Do feed processing here if you did not exclude it previously. This if/else 
       * is not necessary if you want custom post types included in your feed.
       */
    } else {
      $my_post_type = get_query_var( 'post_type' );
      if ( empty( $my_post_type ) )
        $query->set( 'post_type' , $post_types );
    }
  }

  return $query;
}

function massive_author($postid, $authorid, $authorlink, $author, $display_link = true, $pre = '') {

	if($pre){
		echo $pre;
	}

	$only_ga = get_post_meta($postid, 'only_ga', true);
        
    if ( $only_ga == 'Yes' ) {
        
        $guestauthorname = get_post_meta($postid, 'GuestAuthor', true);
        
        $guestauthorlink = get_post_meta($postid, 'GuestLink', true);
		
		if ( $guestauthorlink && $display_link == true ) { 
			return '<a target="_blank" href="'. $guestauthorlink.'">'.$guestauthorname.'</a>'; 
		} else { 
			return $guestauthorname;
		}
		 
	} //only ga
	
	else { //not ga he_author_meta( 'display_name', 25 );

		if($display_link == true){
		
	   		return '<a id="authorinfolink" title="Find out more about '. $author .'" href="#author-info">'.$author.'</a>';

	   		$co_authors = get_post_meta($mainid, 'CoAuthor', false);

	   		if($co_authors):
			
				foreach($co_authors as $co_author):
			
					$co_author_page = get_author_posts_url($co_author);
			
					$co_author_name = get_the_author_meta('display_name',$co_author);
			
					return ' and <a title="More reviews by '. $co_author_name.'" href="' .$co_author_page.'">'.$co_author_name.'</a>';
			
				endforeach; 

			endif;

			$guestauthorname = get_post_meta($postid, 'GuestAuthor', true);
	        
	        $guestauthorlink = get_post_meta($postid, 'GuestLink', true);
	 
	 		if ( $guestauthorname ) { 

	 			return ' and <a target="_blank" href="'. $guestauthorlink.'">'.$guestauthorname.'</a>'; 

	 		} //if there is a guest author

	 	}else {

	 		return $author;

	   		$co_authors = get_post_meta($mainid, 'CoAuthor', false);

	   		if($co_authors):
			
				foreach($co_authors as $co_author):
						
					$co_author_name = get_the_author_meta('display_name',$co_author);
			
					return ' and '.$co_author_name;
			
				endforeach; 

			endif;

			$guestauthorname = get_post_meta($postid, 'GuestAuthor', true);
	        	 
	 		if ( $guestauthorname ) { 

	 			return ' and '.$guestauthorname; 

	 		} //if there is a guest author

	 	}
 
 } //not ga

} //function

function wp_bs_pagination($pages = '', $range = 4)
 
{  
 
     $showitems = ($range * 2) + 1;  
  
     global $paged;
 
     if(empty($paged)) $paged = 1;
 
 
     if($pages == '')
 
     {
 
         global $wp_query; 
 
		 $pages = $wp_query->max_num_pages;
 
         if(!$pages)
 
         {
 
             $pages = 1;
 
         }
 
     }   
 
 
 
     if(1 != $pages)
 
     {
 
        echo '<div class="text-center">'; 
        echo '<nav><ul class="pagination"><li class="disabled hidden-xs"><span><span aria-hidden="true">Page '.$paged.' of '.$pages.'</span></span></li>';
 
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' aria-label='First'><i class=\"fa fa-angle-double-left\"></i><span class='hidden-xs'> First</span></a></li>";
 
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label='Previous'><i class=\"fa fa-angle-left\"></i><span class='hidden-xs'> Previous</span></a></li>";
 
 
 
         for ($i=1; $i <= $pages; $i++)
 
         {
 
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
 
             {
 
                 echo ($paged == $i)? "<li class=\"active\"><span>".$i." <span class=\"sr-only\">(current)</span></span>
 
    </li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
 
             }
 
         }
 
 
 
         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\"  aria-label='Next'><span class='hidden-xs'>Next </span><i class=\"fa fa-angle-right\"></i></a></li>";  
 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' aria-label='Last'><span class='hidden-xs'>Last </span><i class=\"fa fa-angle-double-right\"></i></a></li>";
 
         echo "</ul></nav>";
         echo "</div>";
     }
 
}
function vertad() {
	global $post;
	$args = array( 'post_type' => 'adverts', 'tax_query' => array(
			array(
				'taxonomy' => 'adtype',
				'field' => 'slug',
				'terms' => 'vertical'
			)
		), 'meta_key' => 'Ad Status', 'meta_value' => 'Active', 'numberposts' => 1 );
	$myposts = get_posts( $args );
	foreach( $myposts as $post ) :	setup_postdata($post);?>
			<div class="pull-right img-thumb" id="the-vertical-ad"><?php if ( has_post_thumbnail() ) {?>
			<a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
			<?php the_post_thumbnail();?>
			</a><?php }else {echo get_the_excerpt();}?></div>
	<?php endforeach; wp_reset_query();
}

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_post_type_archive() ) {

            $title = post_type_archive_title( '', false );

        }

    return $title;

});

function my_custom_single_popular_post( $post_html, $p, $instance ){
	$author = massive_author($p->id, $p->uid, '', get_the_author_meta('display_name', $p->uid), false);
    $output = '<li class="list-group-item"><a href="' . get_the_permalink($p->id) . '?source=pop" class="" title="' . esc_attr($p->title) . '">' . $p->title . '</a> <br />' . $author . '</li>';
    //print_r2($p);
    return $output;
}
add_filter( 'wpp_post', 'my_custom_single_popular_post', 10, 3 );

function wpcodex_hide_email_shortcode( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
add_shortcode( 'antispam', 'wpcodex_hide_email_shortcode' );

require get_template_directory() . '/inc/template-tags.php';

?>