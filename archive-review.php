<?php get_header(); ?>

	<div class="row">

		<div class="col-lg-7">

			<div id="carousel-reviews" class="carousel slide" data-interval="5000" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php for ($i = 1; $i <= $total; $i++) { ?>
                    <li data-target="#carousel-reviews" data-slide-to="<?php echo $i-1; ?>" <?php if($i == 1){ ?>class="active"<?php } ?>></li>
                <?php } ?>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                
                <?php
                
                $sequence = 0;
				$highs = array('panel-1', 'panel-2', 'panel-3'); 
				$total = count($highs);

                foreach ($highs as $high): 
                    $args = array(
                        'post_type' => 'review',
                        'tax_query' => array(
							'relation' => 'AND',
                            array(
                                'taxonomy' => 'carousel',
                                'field' => 'slug',
                                'terms' => $high
                            ),
                            array(
								'taxonomy' => 'carousel',
								'field' => 'slug',
								'terms' => 'reviews'
							)
                        ),
                        'posts_per_page' => 1,
                    );
                    $carousel_features = get_posts( $args ); 
                        
                        if ( $carousel_features):
                            foreach($carousel_features as $post): setup_postdata($post);
                            $sequence++;
                            ?>
                            <div class="item <?php if($sequence == 1){echo 'active';} ?>">
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <a href="<?php echo get_post_meta($post->ID, 'Image Link', true);?>">
                                        <?php $attr = array(
                                            'title' => trim(strip_tags( get_the_title() )),
                                        ); the_post_thumbnail('home-carousel', $attr); ?>
                                    </a>
                                <?php }?>

                                <div class="carousel-caption">
							    	<h3>Hello, Moses!</h3>
							    	<p>Moses gets down and dirty with Pharoh.</p>
							    </div>
                            </div>
                            <?php endforeach;
                        endif; 

                    endforeach;?>
              </div>

              <!-- Controls -->
  <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

            </div>

		</div><!--col 7-->

		<div class="col-lg-5">

			<h3 class="center toc-head">The Latest Reviews</h3>
        
        <?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div id="contents-holder">

			<table class="table toc small">

				<thead>
					<tr>
						<td class="text-right">
							
						</td>
						<td></td>
						<td class="text-right"><span id="current-page"><span>1</span> of <?php echo $wp_query->max_num_pages; ?></span> 
						<a class="btn btn-default btn-xs toc-nav prev-page disabled" disabled="disabled" data-page="0" data-type="review">&laquo;</a>
						<a class="btn btn-default btn-xs toc-nav next-page" data-page="2" data-type="review">&raquo;</a></td>
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