<?php

/**
 * Single Topic Lead Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php bbp_topic_subscription_link( array( 'before' => '' ) ); ?>

<?php bbp_topic_favorite_link(); ?>

<?php do_action( 'bbp_template_before_lead_topic' ); ?>

<div id="post-<?php bbp_topic_id(); ?>" class="row bbp-topic">
	<div class="col-sm-1">

		<?php do_action( 'bbp_theme_before_topic_author_details' ); ?>

		<?php bbp_topic_author_link( array( 'type' => 'avatar', 'size' => 42 ) ); ?>

		<?php do_action( 'bbp_theme_after_topic_author_details' ); ?>
	</div>
	<div class="col-sm-11">

		<div class="">

			<div class="bbp-meta pull-right">

				<?php do_action( 'bbp_theme_before_topic_admin_links' ); ?>

				<?php bbp_topic_admin_links(); ?>

				<?php do_action( 'bbp_theme_after_topic_admin_links' ); ?>

			</div><!-- .bbp-meta -->

			<span class="bbp-topic-post-date pull-right">
				<a href="<?php bbp_topic_permalink(); ?>" class="bbp-topic-permalink text-muted">
					<?php bbp_topic_post_date( 0, 1 ); ?>
				</a>
			</span>

			<?php bbp_topic_author_link( array( 'type' => 'name' ) ); ?>

		</div>


		<?php do_action( 'bbp_theme_before_topic_content' ); ?>

		<?php bbp_topic_content(); ?>

		<?php do_action( 'bbp_theme_after_topic_content' ); ?>

		<?php /* admin details */ ?>
		<?php if ( bbp_is_user_keymaster() ) : ?>

			<?php do_action( 'bbp_theme_before_topic_author_admin_details' ); ?>

			<div class="bbp-topic-ip"><?php bbp_author_ip( bbp_get_topic_id() ); ?></div>

			<?php do_action( 'bbp_theme_after_topic_author_admin_details' ); ?>

		<?php endif; ?>
	</div>
</div><!-- #post-<?php bbp_topic_id(); ?> -->

<?php do_action( 'bbp_template_after_lead_topic' ); ?>
