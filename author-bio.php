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

	<?php 

	$only_ga = get_post_meta($post->ID, 'only_ga', true);

	if ( $only_ga != 'Yes' ) : ?>

<div id="author-info" class="author-info">

	<div class="author-description">
		<p class="author-title gil"><?php echo get_the_author(); ?></p>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->

		<p>
			<a class="btn btn-secondary author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'Read more articles by %s', 'twentyfifteen' ), get_the_author() ); ?>
			</a>
		</p>

	</div><!-- .author-description -->
</div><!-- .author-info -->

<?php endif; ?>
