<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<?php 
	if ( is_single() ) : ?>
	
		<div class="row">

			<div class="col-lg-8">
<?php
	endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		//twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">

	<?php
		
		$pt = get_post_type($post->ID);
	
		$obj = get_post_type_object($pt);
		
		$type = $obj->label;
		
		$link = get_post_type_archive_link($pt);

		$authorid = get_the_author_meta( 'ID' );
		
		$authorlink = get_author_posts_url( $authorid );
		
		$author = get_the_author();

		$meta = get_post_custom_keys($post->ID );

		$venues = wp_get_post_terms( $post->ID, 'venues' );

		$cats = wp_get_post_terms( $post->ID, 'category', $args );

		if($cats):
			foreach($cats as $cat):
				//print_r2($cat);
				if($cat->slug !== 'features'){
					$catlist[$cat->name] = get_category_link($cat->term_id);
				}
			endforeach;
		endif;

		

		//print_r2($meta);

		//the_category();

	?>
	 	<h6 class="section-heading gil"><span class="spaced"><a class="<?php echo $pt; ?>" href="<?php echo $link; ?>"><?php if($type == 'Features' || $type == 'Reviews'){ echo $type. '</a>'; } ?>
	 		<?php if($catlist):
			foreach($catlist as $label => $link):
				echo '<span> &bull; <a href="'.$link.'">'.$label.'</a></span>';
			endforeach;
		endif; ?>
		</span>

		<span class="pull-right text-right text-capitalize text-muted"><em>Published <?php the_time('j F Y'); ?></em></span>

	 	</h6>
	 	<hr>
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
		<h6 class="text-uppercase text-muted">
			<?php  
		
				if($venues){ 
					
					$termlink = get_term_link( $venues[0], 'venues' ); 
				
					echo '<a title="See all reviews of shows at '.$venues[0]->name.'" href="'.$termlink.'">'.$venues[0]->name.'</a> &diam;'; 
				}

					echo ' '.get_post_meta($post->ID, "Running Dates", $single = true);?>

		</h6>

		<?php

		$feature_intro = get_post_meta($post->ID, 'Feature Intro', true);

		if ( $pt == 'features' && $feature_intro) { ?>

			<div class="article-lead  george it"><?php echo $feature_intro; ?></div>

		<?php } else { ?>
		
			<div class="article-lead  george it"><?php echo the_excerpt(); ?></div>

		<?php } ?>

		<h5 class="author-title gil"><?php echo massive_author($post->ID, $authorid, $authorlink, $author, true); ?></h5>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */

			if( is_archive() ):

				the_excerpt( sprintf(
					__( 'Continue reading %s', 'twentyfifteen' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

			else :
				
				
				the_content( sprintf(
					__( 'Continue reading %s', 'twentyfifteen' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

			endif;

			wp_link_pages( array(
				'before'      => '<div class="page-links gil"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div><hr>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php $args = array(
            'post_type' => 'adverts',
            'adtype' => 'mpu',
            'tax_query' => array(
                array(
                    'taxonomy' => 'adpos',
                    'field' => 'slug',
                    'terms' => 'mpu-1'
                )
            ), 
            'meta_key' => 'Ad Status', 
            'meta_value' => 'Active', 
            'posts_per_page' => 1 );
        $mpu1 = get_posts( $args );
        if($mpu1):
            foreach( $mpu1 as $post ) : setup_postdata($post);?>
                <div id="body-ad" class="some-damn-ad p5 text-right pull-left">
                    <?php if ( has_post_thumbnail() ) {
                        $attr = array(
                            'class' => 'img-responsive center-block'
                        );
                        ?>
                        <p class="text-muted text-center ad-caption text-uppercase spaced">Advertisement</p>
                        <a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
                            <?php the_post_thumbnail('full', $attr);?>
                        </a><?php } ?>
                </div>
                <div class="clearfix"></div>
            <?php endforeach; wp_reset_postdata();

        endif; ?>

		<?php 

			$urltitle = urlencode( get_the_title() );
			$urlurl = urlencode( get_the_permalink() );

		?>

			<div id="social-media" class="btn-group btn-group-sm gil spaced " role="group" aria-label="Basic example">
				<a class="btn btn-primary twitter" target="_blank" href="http://twitter.com/intent/tweet?status=<?php echo $urltitle; ?>+<?php echo $urlurl; ?>"><i class="fa fa-twitter"></i> Tweet</a>
            	<a class="btn btn-primary fb" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $urlurl; ?>&title=<?php echo $urltitle; ?>"><i class="fa fa-facebook-official"></i> Share</a>
                <a class="btn btn-primary gplu" href="https://plus.google.com/share?url=<?php echo $urlurl; ?>"><i class="fa fa-google-plus"></i></a>
			</div>

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		else :
			//echo '<hr><p><a class="btn btn-secondary author-link" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author"><span class="gil">'.$author.'</span></a> is a contributor to '.get_bloginfo('name').'.</p>';

		?>
			<hr>

			<div id="author-info" class="author-info">

			<div class="author-description">
				<p class="author-title"><span class="gil"><?php echo massive_author($post->ID, $authorid, $authorlink, $author, false); ?></span> is a contributor to Exeunt Magazine</p>

				<p>
					<a class="btn btn-secondary author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'Read more articles by %s', 'twentyfifteen' ), get_the_author() ); ?>
					</a>
				</p>

			</div><!-- .author-description -->
		</div><!-- .author-info -->
		<?php endif;
	?>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php global $current_user; if($current_user->ID == 1){edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' );} ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<?php 
	if ( is_single() ) : ?>
	
		</div>

		<div class="col-lg-4">

		<?php if ( $pt == 'review' ) : ?>

			<div class="card card-block" id="show-meta">

				<h2 class="gill"><?php the_title(); ?> Show Info</h2>
				<hr>

					
					<?php 

						$show_meta = array('Producer' => 'Produced by', 'Director' => 'Directed by', 'Playwright' => 'Written by', 'Choreographer' => 'Choreography by', 'Performers' => 'Cast includes', 'Original Music' => 'Original Music', 'External Link' => 'Link', 'Running Time' => 'Running Time');
							
							foreach($show_meta as $key => $value){
							
								$meta_check = get_post_meta($post->ID, $key, true);
							
								if($meta_check){

									if($key == 'External Link'):

										echo '<p><small><strong class="gil">'.$value.'</strong></small> <a href="'.$meta_check.'">'.$meta_check.'</a></p>';

									else:

										echo '<p><small><strong class="gil">'.$value.'</strong></small> '.$meta_check.'</p>';

									endif;

								}
							
							}
					?>


			</div>

		<?php endif; ?>

			<div class="card" id="single-side-ad">


					<?php $args = array(
			            'post_type' => 'adverts',
			            'adtype' => 'mpu',
			            'tax_query' => array(
			                array(
			                    'taxonomy' => 'adpos',
			                    'field' => 'slug',
			                    'terms' => 'mpu-1'
			                )
			            ), 
			            'meta_key' => 'Ad Status', 
			            'meta_value' => 'Active', 
			            'posts_per_page' => 1 );
			        $mpu1 = get_posts( $args );
			        if($mpu1):
			            foreach( $mpu1 as $post ) : setup_postdata($post);?>
			                <div class="some-damn-ad p5 text-center">
			                    <?php if ( has_post_thumbnail() ) {?>
			                        <p class="text-muted m-y-0"><small>Advertisement</small></p>
			                        <a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
			                            <?php the_post_thumbnail('full');?>
			                        </a><?php }else {echo get_the_excerpt();}?>
			                </div>
			            <?php endforeach;
			        endif; ?>
			        <br />
				</div>

		<div class="card">

			 <div class="card-block">
			    <h2 class="card-title amatic text-center">Most Popular Posts</h2>
			    <h4 class="card-text dancing text-center">in the past seven days</h4>
			  </div>

			<?php 
				$pop_args = array(

					'post_type' => 'features,review',
					'stats_views' => 0,
					'stats_author' => 1,
					'wpp_start' => '<ul class="list-group list-group-flush">',
					'post_html' => '<li class="list-group-item">{title} by <span class="pop-author text-uppercase">{author}</span></li>'

					);
				wpp_get_mostpopular($pop_args); ?>

		</div><!--card-->

		<div class="card card-block">

                <h3 class="text-center fw-400"><span class="amatic">the</span><br/><span class="dancing big">Exeunt</span><br /><span class="amatic spaced">newsletter</span></h3>
                <hr>
                <p class="text-center">Enter your <strong>email address</strong> below to get an occasional email with Exeunt updates and featured articles.</p>
                <hr>
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                <form action="//exeuntmagazine.us2.list-manage.com/subscribe/post?u=11dd1f596e140a1abc054299f&amp;id=d347ea60ae" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll">
                    
                <div class="mc-field-group form-group">
                    <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL">
                </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_11dd1f596e140a1abc054299f_d347ea60ae" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-primary center-block"></div>
                    </div>
                </form>
                </div>

                <!--End mc_embed_signup-->

		</div><!--card-->


		</div>

			</div>
<?php
	endif;
?>