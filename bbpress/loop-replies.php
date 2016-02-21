<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

	<?php if ( bbp_thread_replies() ) : ?>

		<?php bbp_list_replies(); ?>

	<?php else : ?>

		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

			<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
