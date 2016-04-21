<?php

/*******************************************************************************
 * Content Tweaks
 ******************************************************************************/
call_user_func(function(){
	/**
	 * Simple WP_Option settings object
	 */
	require_once get_template_directory().'/includes/vendor/wp-option-settings/wp-option-settings.php';

	/**
	 * A simple settings object for theme tweaks.
	 */
	$settings = new WP_Option_Settings( 'rage_theme_settings', array(
		// Pixel width limit for embedded content.
		'content_width' => 640,

		// Word limit for excerpts
		'excerpt_length' => 20,

		// Content appended to post excerpts.
		'excerpt_more' => '[&hellip,]',

		// Convert the "Excerpt more" content into a link to the post.
		'excerpt_more_link' => 0,

		// Template for the "excerpt_more" output
		'excerpt_more_template' => "<span class='excerpt-more'>%1%s</span>",

		// Template for the "excerpt more" as-a-link output
		'excerpt_more_link_template' => "<a class='excerpt-more-link' href='%1%s'>%2%s</a>",

		// Additional classes to add to avatars, separated by spaces
		'avatar_classes' => 'img-circle',
	));

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @link https://codex.wordpress.org/Content_Width
	 *
	 * @global int $content_width
	 */
	add_action( 'after_setup_theme', function() use ( $settings ){
		$GLOBALS['content_width'] = $settings->content_width;
	}, 0 );

	/**
	 * Allow the theme settings to override excerpt_length
	 *
	 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length
	 *
	 * @param $length
	 * @return mixed
	 */
	add_filter( 'excerpt_length', function( $length ) use ( $settings ){
		return $settings->excerpt_length;
	} );

	/**
	 * Allow the theme settings to override excerpt_more
	 *
	 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
	 *
	 * @param $more
	 * @return mixed
	 */
	add_filter( 'excerpt_more', function( $more ) use ( $settings ){
		$more = html_entity_decode( $settings->excerpt_more );

		// optionally, create as a link
		if ( $settings->excerpt_more_link ) {
			$href = get_permalink();
			$more = sprintf( $settings->excerpt_more_link_template, $href, $more );
		}

		// wrap for styling
		return sprintf( $settings->excerpt_more_template, $more );
	} );

	/**
	 * Modify the avatar
	 *
	 * @param $avatar
	 * @return mixed
	 */
	add_filter( 'get_avatar', function( $avatar ) use ( $settings ){
		// alter classes
		if ( $settings->avatar_classes ) {
			$avatar = str_replace( "'avatar avatar-", "'avatar {$settings->avatar_classes} avatar-", $avatar );
		}

		return $avatar;
	} );

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	add_filter( 'body_class', function( $classes ) use ( $settings ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		return $classes;
	} );
});
