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
		add_image_size( 'home-carousel', 780, 320, true);
		add_image_size( 'boots2', 140, 140, true);
		add_image_size( 'boots3', 220, 145, true);
		add_image_size( 'boots4', 300, 300, true);
		add_image_size( 'feat-thumb', 300, 200, true );
		add_image_size( 'button', 80, 80, true );
	}

	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'reviews' => 'Reviews Subnav',
		'features-menu' => 'Features Subnav',
		'footer1' => 'Footer 1',
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
						'menu_icon' => 'dashicons-editor-paragraph',
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
						'menu_icon' => 'dashicons-editor-paragraph',
						'query_var' => true
				)
			);
			
				register_post_type( 'podcast',
				array(
					'labels' => array(
						'name' => __( 'Audio/Video' ),
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
						'supports' => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'author', 'excerpt', 'thumbnail', 'post-formats' ),
						'taxonomies' => array( 'post_tag', 'category', 'featured', 'edinburgh'),
						'menu_position' => 5,
						'menu_icon' => 'dashicons-editor-paragraph',
						'query_var' => true
				)
			);
			
			register_post_type( 'comps',
				array(
					'labels' => array(
						'name' => __( 'Competitions' ),
						'singular_name' => __( 'Competition' ),
						'add_new' => __( 'Add New Competition' ),
						'add_new_item' => __( 'Add New Competition' ),
						'edit' => __( 'Edit' ),
						'edit_item' => __( 'Edit Competition' ),
						'new_item' => __( 'New Competition' ),
						'view' => __( 'View Competition' ),
						'view_item' => __( 'View Competition' ),
						'search_items' => __( 'Search Competition' ),
						'not_found' => __( 'No Competitions found' ),
						'not_found_in_trash' => __( 'No Competitions found in Trash' ),
						'parent' => __( 'Parent Competition' )
					),
						'public' => true,
						'rewrite' => array('slug' => 'comps'),
						'supports' => array( 'title', 'editor', 'trackbacks', 'excerpt', 'thumbnail' ),
						'taxonomies' => array( 'post_tag', 'category', 'featured', 'edinburgh'),
						'menu_position' => 5,
						'menu_icon' => 'dashicons-editor-paragraph',
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
						'menu_icon' => 'dashicons-editor-paragraph',
				'query_var' => false,
				'exclude_from_search' => true
		)
	);
	
	register_post_type( 'home_carousel',
		array(
			'labels' => array(
				'name' => __( 'Carousel' ),
				'singular_name' => __( 'Carousel Image' ),
				'add_new' => __( 'Add New Carousel Image' ),
				'add_new_item' => __( 'Add New Carousel Image' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Carousel Image' ),
				'new_item' => __( 'New Carousel Image' ),
				'view' => __( 'View Carousel Image' ),
				'view_item' => __( 'View Carousel Image' ),
				'search_items' => __( 'Search Carousel Images' ),
				'not_found' => __( 'No Carousel Images found' ),
				'not_found_in_trash' => __( 'No Carousel Images found in Trash' ),
				'parent' => __( 'Parent Carousel Image' )
			),
				'public' => false,
				'show_ui' => true,
				'supports' => array( 'title', 'excerpt', 'thumbnail' ),
				'taxonomies' => array( 'featured'),
				'menu_position' => 5,
						'menu_icon' => 'dashicons-editor-paragraph',
				'query_var' => false,
				'exclude_from_search' => true
		)
	);
	
	register_post_type( 'catimages',
		array(
			'labels' => array(
				'name' => __( 'Category Images' ),
				'singular_name' => __( 'Category Image' ),
				'add_new' => __( 'Add New Category Image' ),
				'add_new_item' => __( 'Add New Category Image' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Category Image' ),
				'new_item' => __( 'New Category Image' ),
				'view' => __( 'View Category Image' ),
				'view_item' => __( 'View Category Image' ),
				'search_items' => __( 'Search Category Image' ),
				'not_found' => __( 'No Category Images found' ),
				'not_found_in_trash' => __( 'No Category Images found in Trash' ),
				'parent' => __( 'Parent Category Image' )
			),
				'public' => false,
				'show_ui' => true,
				'supports' => array( 'title', 'thumbnail' ),
				'taxonomies' => array( 'featured', 'venues', 'festivals', 'category'),
				'menu_position' => 5,
						'menu_icon' => 'dashicons-editor-paragraph',
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
    
    wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), '1', true );
    wp_register_script( 'bootstrap_js_offline', $td . '/js/bootstrap.min.js', array('jquery'), '1', true );

    wp_register_script( 'exeunt_scripts', $td . '/js/main.js', array('jquery'), '1', true );
        
    wp_register_script( 'respond', $td . '/js/respond.min.js', array('jquery'), '1', true );
            
    wp_register_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700', false, '1', 'screen' );        
    
    wp_register_style( 'bootstrapstyles', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', false, '1', 'all' );
    wp_register_style( 'bootstrapstyles_offline', $td . '/css/bootstrap.min.css', false, '1', 'all' );
            
}
add_action( 'wp_enqueue_scripts', 'exeunt_register_assets' );

function exeunt_scripts_and_styles() {
	
	wp_enqueue_style( "bootstrapstyles" );
	wp_enqueue_style( 'mainStyles', get_stylesheet_uri() );
	
    wp_enqueue_script( "jquery" );
    wp_enqueue_script( "bootstrap" );
    wp_enqueue_script( "modernizr" );
    wp_enqueue_script( "exeunt_scripts" );
	wp_localize_script('exeunt_scripts', 'WP_AJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));

    wp_enqueue_style( "fontawesome" );
    wp_enqueue_style( "open-sans" );
    
    wp_enqueue_script( "respond" );

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

require get_template_directory() . '/inc/template-tags.php';

?>