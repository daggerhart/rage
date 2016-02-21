<?php
/**
 * Template part for displaying a single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

	/*
	 * Viewing this content on its own
	 */
	if ( is_singular() ) : ?>
		<header class="entry-header page-header">

			<?php rage_template( 'entry-thumbnail-fancy' ); ?>

			<h1 class="entry-title"><?php rage_title(); ?></h1>

			<div class="entry-meta">
				<?php rage_template( 'entry-taxonomy', get_post_type() ); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php rage_template( 'entry-pager', get_post_type() ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php rage_template( 'entry-author', get_post_type() ); ?>
			<?php rage_template( 'entry-footer', get_post_type() ); ?>
		</footer><!-- .entry-footer -->
	<?php

	/*
	 * Viewing this content as part of a list
	 */
	else: ?>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header><!-- .entry-header -->

		<?php if ( has_post_thumbnail() ): ?>
			<span class="post-thumbnail"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive' ) ); ?></span>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<div class="entry-meta">
			<?php rage_template( 'entry-footer', get_post_type() ); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->

