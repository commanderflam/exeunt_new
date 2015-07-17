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
		twentyfifteen_post_thumbnail();
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
		<div class="article-lead center george it"><?php echo the_excerpt(); ?></div>
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
		endif;
	?>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<?php 
	if ( is_single() ) : ?>
	
		</div>

			</div>
<?php
	endif;
?>