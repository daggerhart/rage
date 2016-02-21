<?php
/**
 * The template for displaying the blog page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php rage_title(); ?></h1>
	</header><!-- .page-header -->

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-post-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			rage_template( 'content-post', get_post_format() );
		?>

	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>

<?php else : ?>

	<?php rage_template( 'content', 'no-results' ); ?>

<?php endif; ?>
