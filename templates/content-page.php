<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header entry-header">
		<?php rage_template( 'entry-thumbnail-fancy' ); ?>

		<h1 class="entry-title"><?php rage_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php rage_template( 'entry-pager', get_post_type() ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

