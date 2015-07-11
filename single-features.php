<?php get_header(); ?>

	<div class="row">

		<div class="col-lg-9">
        
<?php
		// Start the loop.
	while ( have_posts() ) : the_post();

    	get_template_part( 'content', get_post_format() );

	endwhile;

?>

		</div>

	</div>
 
<?php get_footer(); ?>