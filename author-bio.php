<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<hr>

<div class="author-info">

	<div class="author-description">
		<p class="author-title gil"><?php echo get_the_author(); ?></p>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( '<p>Read more articles by %s</p>', 'twentyfifteen' ), get_the_author() ); ?>
			</a>
		</p><!-- .author-bio -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
