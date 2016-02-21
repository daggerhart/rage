<?php

/**
 * Helper for simplifying access to page title
 *
 * @param bool $echo
 * @return string|void
 */
function rage_title( $echo = true ){
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', TRUE ) ) {
			$title = get_the_title( get_option( 'page_for_posts', TRUE ) );
		}
		else {
			$title = __( 'Latest Posts' );
		}
	}
	elseif ( is_archive() ) {
		$title = get_the_archive_title();
	}
	elseif ( is_search() ) {
		$title = sprintf( __( 'Search Results for %s' ), get_search_query() );
	}
	elseif ( is_404() ) {
		$title = __( 'Not Found' );
	}
	else {
		$title = get_the_title();
	}
	
	if ( $echo ){
		echo $title;
	}
	else {
		return $title;	
	}
}

/**
 * Helper for template calls
 *
 * @param $slug
 * @param null $name
 */
function rage_template( $slug, $name = null ){
	get_template_part( 'templates/' . $slug, $name );
}

/**
 * Abbreviate human-time keywords in a string.
 *
 * @param $text
 * @return string
 */
function rage_shorten_human_time( $text ){
	$replace = array(
			' years' => 'y',
			' year' => 'y',
			' months' => 'm',
			' month' => 'm',
			' days' => 'd',
			' day' => 'd',
			' hours' => 'h',
			' hour' => 'h',
			' minutes' => 'm',
			' minute' => 'm',
			' seconds' => 's',
			' second' => 's',
	);

	return strtr( $text, $replace );
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function rage_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rage_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rage_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rage_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rage_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in rage_categorized_blog.
 */
function rage_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'rage_categories' );
}
add_action( 'edit_category', 'rage_category_transient_flusher' );
add_action( 'save_post',     'rage_category_transient_flusher' );
