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
		
		$authorlink = get_author_posts_url( get_the_author_meta( 'ID' ));
		
		$author = get_the_author();

		$meta = get_post_custom_keys($post->ID );

		$venues = wp_get_post_terms( $post->ID, 'venues' );

		//print_r2($meta);

		//the_category();

	?>
	 	<hr>
	 	<h4 class="section-heading gil center spaced"><a href="<?php echo $link; ?>"><?php echo $type; ?></a></h4>
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title center">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
		<h5 class="caps center text-muted">
			<?php  
		
				if($venues){ 
					
					$termlink = get_term_link( $venues[0], 'venues' ); 
				
					echo '<a title="See all reviews of shows at '.$venues[0]->name.'" href="'.$termlink.'">'.$venues[0]->name.'</a> &diam;'; 
				}

					echo ' '.get_post_meta($post->ID, "Running Dates", $single = true);?>

		</h5>

		<?php

		$feature_intro = get_post_meta($post->ID, 'Feature Intro', true);

		if ( $pt == 'features' && $feature_intro) { ?>

			<div class="article-lead center george it"><?php echo $feature_intro; ?></div>

		<?php } else { ?>
		
			<div class="article-lead center george it"><?php echo the_excerpt(); ?></div>

		<?php } ?>
	
		<h4 class="author-title center gil"><a href="<?php echo $authorlink; ?>" title="See all articles written by <?php echo $author; ?>">By <?php echo $author; ?></a></h4>
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
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		else :
			echo '<hr><p><a class="author-link" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author"><span class="gil">'.$author.'</span></a> is a contributor to '.get_bloginfo('name').'.</p>';
		endif;
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

			<div class="panel" id="show-meta">

				<div class="panel-body">
					
					<?php 

						$show_meta = array('Producer' => 'Produced by', 'Director' => 'Directed by', 'Playwright' => 'Written by', 'Choreographer' => 'Choreography by', 'Performers' => 'Cast includes', 'Original Music' => 'Original Music', 'External Link' => 'Link', 'Running Time' => 'Running Time');
							
							foreach($show_meta as $key => $value){
							
								$meta_check = get_post_meta($post->ID, $key, true);
							
								if($meta_check){

									if($key == 'External Link'):

										echo '<h5><strong class="gil">'.$value.'</strong></h5><p><a href="'.$meta_check.'">'.$meta_check.'</a></p>';

									else:

										echo '<h5><strong class="gil">'.$value.'</strong></h5><p>'.$meta_check.'</p>';

									endif;

								}
							
							}
					?>

				</div>

			</div>

		<?php endif; ?>

			<div class="panel" id="single-side-ad">

				<div class="panel-body">

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
			                <div class="some-damn-ad p5 text-right">
			                    <?php if ( has_post_thumbnail() ) {?>
			                        <p class="text-muted"><small>Advertisement</small></p>
			                        <a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
			                            <?php the_post_thumbnail('full');?>
			                        </a><?php }else {echo get_the_excerpt();}?>
			                </div>
			            <?php endforeach;
			        endif; ?>

				</div>

			</div>

		</div>

			</div>
<?php
	endif;
?>