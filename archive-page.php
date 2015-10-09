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

<div class="row archive-item">

	

	<?php if(!is_category('news') && has_post_thumbnail()){ ?>

		<div class="col-lg-3 col-md-3 col-sm-4">
			
			<?php twentyfifteen_post_thumbnail('large'); ?>

		</div><!--col 2-->

	<?php } ?>

	<?php 

	if ( has_post_thumbnail() ) : ?>

		<div class="col-lg-5 col-md-5 col-sm-6">

	<?php else: ?>
		
		<div class="col-lg-8 col-md-8 col-sm-10">

	<?php endif; ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
				<h6 class="text-muted gil"><?php the_time('j F Y'); ?></h6>
			 	<h6 class="section-heading gil spaced"><a href="<?php echo $link; ?>"><?php if($type == 'Features' || $type == 'Reviews'){ echo $type. '</a>'; } ?>
			 	<?php if($catlist):
					foreach($catlist as $label => $link):
						echo '<span> &bull; <a href="'.$link.'">'.$label.'</a></span>';
					endforeach;
				endif; ?>

			 	</h6>
				<?php 
						the_title( sprintf( '<h3 class="entry-title archive-entry-title gil"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				?>
				<h6 class="text-uppercase text-muted fw-400 venue-info">
					<?php  
				
						if($venues){ 
							
							$termlink = get_term_link( $venues[0], 'venues' ); 
						
							echo '<a title="See all reviews of shows at '.$venues[0]->name.'" href="'.$termlink.'">'.$venues[0]->name.'</a> &diam;'; 
						}

							echo ' '.get_post_meta($post->ID, "Running Dates", $single = true);?>

				</h6>
			
				<h5 class="author-title gil"><a href="<?php echo $authorlink; ?>" title="See all articles written by <?php echo $author; ?>">By <?php echo $author; ?></a></h5>
			
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */

					if( is_archive() || is_search() ):

						the_excerpt( sprintf(
							__( 'Continue reading %s', 'twentyfifteen' ),
							the_title( '<span class="screen-reader-text">', '</span>', false )
						) );

					endif;

					
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php //twentyfifteen_entry_meta(); ?>
				<?php //global $current_user; if($current_user->ID == 1){edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' );} ?>
			</footer><!-- .entry-footer -->

		</article><!-- #post-## -->

	</div><!--col 6-->

</div><!--row-->

	<hr>

