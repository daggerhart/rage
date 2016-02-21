<?php
/**
 * Prints HTML with meta information about a post
 */

/*
 * Comment in popup link
 */
if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) )
{
	?>
	<span class="comments-link">
		<?php comments_popup_link( esc_html__( 'Leave a comment' ), esc_html__( '1 Comment' ), esc_html__( '% Comments' ) ) ?>
	</span>
	<?php
}
