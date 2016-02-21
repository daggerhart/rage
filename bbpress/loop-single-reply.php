<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php //bbp_topic_subscription_link( array( 'before' => '' ) ); ?>

<?php //bbp_user_favorites_link(); ?>

<div id="post-<?php bbp_reply_id(); ?>" class="row bbp-reply">

	<div class="col-sm-1 col-sm-offset-1">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'type' => 'avatar', 'size' => 34 ) ); ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="col-sm-10">

		<div class="bbp-meta pull-right">

			<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

			<?php bbp_reply_admin_links(); ?>

			<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

		</div><!-- .bbp-meta -->

		<span class="bbp-reply-post-date pull-right">
			<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink text-muted">
				<?php bbp_reply_post_date( 0, 1 ); ?>
			</a>
		</span>

		<?php bbp_reply_author_link( array( 'type' => 'name') ); ?>

		<?php if ( bbp_is_single_user_replies() ) : ?>

			<span class="bbp-header">
				<?php _e( 'in reply to: ', 'bbpress' ); ?>
				<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>">
					<?php bbp_topic_title( bbp_get_reply_topic_id() ); ?>
				</a>
			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

		<?php /* admin details */ ?>
		<?php if ( bbp_is_user_keymaster() ) : ?>

			<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

			<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

			<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

		<?php endif; ?>
	</div><!-- .bbp-reply-content -->

</div><!-- #post-<?php bbp_reply_id(); ?> -->

