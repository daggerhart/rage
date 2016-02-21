<?php
/**
 * The template for displaying single posts of a custom post type.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */
?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php

		if ( 'post' == get_post_type() ){
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			rage_template( 'content-post', get_post_format() );
		}
		else {
			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			rage_template( 'content', get_post_type() );
		}
	?>

	<?php rage_template( 'entry-navigation' ); ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>

<?php endwhile; // End of the loop. ?>
