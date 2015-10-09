<?php get_header(); ?>
 
<?php if ( have_posts() ) : $number = 0; ?>

	<div class="row">

	<div class="col-lg-8 col-md-8 col-sm-10">

			<header class="page-header">

				<?php if( is_author() ) :

					$authorid = get_query_var('author');
					$name = get_the_author_meta('display_name', $authorid);

					echo '<h1 class="page-title fw-400">'.$name.'</h1>'; ?>

					<hr>

					<div class="row">

						<div class="col-lg-3">
							<?php echo '<div class="pull-left img-thumbnail img-responsive">';

								userphoto($authorid, $before = '', $after = '', $attributes = array('class' => 'img-responsive'));

								echo '</div>'; ?>
						</div>

						<div class="col-lg-9">

							<p class="author-bio george">
								<?php the_author_meta( 'description', $authorid ); ?>
							</p><!-- .author-bio -->
						</div>

					</div>

					<hr>

					<h2>Articles by <?php echo $name; ?></h2>
				
		<?php	

				elseif (is_search()) : ?>
					
						<h1 class="page-title fw-400">Search Results for <em><?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span></em>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>

				<?php else:

					the_archive_title( '<h1 class="page-title center gil fw-400">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );

				endif;
				?>
			</header><!-- .page-header -->

	</div>

	</div><!--row-->

	<hr>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				$number++;

				if($number == -1):
					
					get_template_part('archive-first');
				
				else:
				
					get_template_part( 'archive-page' );
				
				endif;

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			// the_posts_pagination( array(
			// 	'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
			// 	'next_text'          => __( 'Next page', 'twentyfifteen' ),
			// 	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			// ) );

			if (function_exists("wp_bs_pagination")) :
			    wp_bs_pagination();
			endif;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
 
<?php get_footer(); ?>