<?php

/*******************************************************************************
 * Initialize the theme in an anonymous function to avoid the global scope
 ******************************************************************************/
call_user_func(function(){

	$rage = Rage_Core::get_instance();

	/**
	 * Theme vendor libraries
	 */
	$rage->add_files(array(
		/*
		 * Theme_Wrapper_Templates class for main template wrapping
		 */
		'vendor/theme-wrapper-templates/theme-wrapper-templates.php',

		/*
		 * Sweet Widget Templates
		 * https://github.com/daggerhart/sweet-widgets
		 */
		'vendor/sweet-widget-templates/sweet-widget-templates.php',

		/*
		 * Bootstrap Navwalker helps convert normal theme menus into Bootstrap Navbars
		 * https://github.com/twittem/wp-bootstrap-navwalker
		 */
		'vendor/wp-bootstrap-navwalker/wp-bootstrap-navwalker.php',
	));

	// theme-wrapper template folder
	add_filter( 'theme_wrapper_templates-folder', function() {
		return 'templates/wrappers';
	} );

	// sweet widget template folder
	add_filter( 'sweet_widgets_templates-folder', function() {
		return 'templates/widgets';
	} );

	/**
	 * Scripts
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_register_script
	 */
	$rage->add_scripts(array(
		// bootstrap
		array(
			'bootstrap-min-js',
			"//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
			array( 'jquery' ),
			'3.3.5'
		),

		// skip link focus (from underscores)
		array(
			'rage-skip-link-focus-fix',
			get_stylesheet_directory_uri() . '/assets/js/skip-link-focus-fix.js',
		),
	));

	/*
	 * Conditional scripts
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		$rage->add_scripts( array( 'comment-reply' ) );
	}

	/**
	 * Styles
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_register_style
	 */
	$rage->add_styles(array(
		// default stylesheet
		array(
			'rage-style',
			get_stylesheet_uri(),
		)
	));

	/**
	 * Theme supports
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
	 */
	$rage->add_theme_supports(array(
		// Add default posts and comments RSS feed links to head.
		//'automatic-feed-links',

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		'title-tag',

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		'post-thumbnails',

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		'post_formats' => array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		),

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		'html5' =>  array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		),
	));

	/**
	 * Register widget areas
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	$rage->add_sidebars(array(
		array(
			'name'          => esc_html__( 'Sidebar' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	));

	/**
	 * Image sizes
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_image_size/
	 */
	$rage->add_image_sizes(array(
		array( 'fancy-large', 900, 300, array( 'center', 'top' ) ),
	));

	/**
	 * Navigation menus the theme needs
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	$rage->add_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu' ),
	));
});
