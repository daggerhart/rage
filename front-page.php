<?php
/**
 * The front page template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

?>
<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			/*
			 * Front page needs to be able to handle almost any content.
			 * Load the appropriate template.
			 */
			if ( 'post' == get_post_type() ) {
				rage_template( 'content-post', get_post_format() );
			}
			else {
				rage_template( 'content', get_post_type() );
			}
		?>

	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>

<?php else : ?>

	<?php rage_template( 'content', 'no-results' ); ?>

<?php endif; ?>

