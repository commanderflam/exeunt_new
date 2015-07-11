<?php get_header(); ?>
        
<?php
		// Start the loop.
	while ( have_posts() ) : the_post();

    	get_template_part( 'content', get_post_format() );

	endwhile;

?>
 
<?php get_footer(); ?>