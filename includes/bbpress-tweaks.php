<?php

/*******************************************************************************
 * bbPress Tweaks
 ******************************************************************************/
call_user_func( function(){
	// show the topic as its own visual element
	add_filter( 'bbp_show_lead_topic', '__return_true' );

	// remove styles
	// would rather never enqueue it than de-queue
	add_filter( 'bbp_default_styles', '__return_empty_array', 999 );

	// remove 'ago' from humanized time
	//add_filter( 'bbp_core_time_since_ago_text', function( $text ) { return '%s'; } );

	// significantly reduce size of humanizes time
	add_filter( 'bbp_get_time_since', 'rage_shorten_human_time');

	// bootstrap dropdown for bbp admin links
	add_filter( 'bbp_after_get_topic_admin_links_parse_args', 'bbp_admin_link_args' );
	add_filter( 'bbp_after_get_reply_admin_links_parse_args', 'bbp_admin_link_args' );

	/**
	 * Use Bootstrap dropdown for admin links
	 *
	 * @param $args
	 * @return array
	 */
	function bbp_admin_link_args( $args ){
		$args['before'] = '<div class="dropdown">
							<button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-menu-right">
								<li>';
		$args['after'] =       '</li>
						</ul>
					</div>';
		$args['sep'] = '</li><li>';

		return $args;
	}
});

