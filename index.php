<?php get_header(); ?>
 
<?php if ( have_posts() ) : $number = 0; ?>

	<div class="col-lg-8 col-md-8 col-sm-10">

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title center gil">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

	</div>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				$number++;

				if($number == 1):
					
					get_template_part('archive-first');
				
				else:
				
					get_template_part( 'archive-page' );
				
				endif;

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
 
<?php get_footer(); ?>