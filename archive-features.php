<?php get_header(); ?>

	<div class="row">

		<div class="col-lg-5">

			<h3 class="center">The Latest Features</h3>
        
        <?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div id="contents-holder">

				<div class="text-right gill"><span id="current-page"><span>1</span> of <?php echo $wp_query->max_num_pages; ?></span> 
					<a class="btn btn-default btn-xs toc-nav prev-page disabled" disabled="disabled" data-page="0" data-type="features">&laquo;</a>
					<a class="btn btn-default btn-xs toc-nav next-page" data-page="2" data-type="features">&raquo;</a>
				</div>

			<table class="table toc small">

				<thead>
					<tr>
						<td class="text-right">
							
						</td>
						<td></td>
						
					</tr>
				</thead>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
                <tr>
					<td class="author"><?php echo get_the_author(); ?></td>
					<td class="gil nowrap"><?php the_time('d M'); ?></td>
					<td class="toc-ex"><span class="gil"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><?php the_excerpt(); ?></td>
				</tr>
                
			<?php

				//get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile; ?>
			
			</table>

			</div><!--contents holder-->

			<?php

			//Previous/next page navigation.
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


		</div>

		</div>

		<div class="clearfix"></div>
 
<?php get_footer(); ?>