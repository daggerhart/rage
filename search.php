<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */

?>
<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php rage_title(); ?></h1>
	</header><!-- .page-header -->

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			rage_template( 'content', 'search' );
		?>

	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>

<?php else : ?>

	<?php rage_template( 'content', 'no-results' ); ?>

<?php endif; ?>
