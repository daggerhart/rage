<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * This file is automatically loaded on every page while this theme is enabled.
 */
require_once get_stylesheet_directory().'/includes/rage/utilities.php';

/**
 * Go berserk
 */
require_once get_stylesheet_directory().'/includes/rage/rage-core.php';

/**
 * Theme structure configuration
 */
require_once get_stylesheet_directory().'/includes/structure.php';

/**
 * Hooks and filters which alter how content is output.
 */
require_once get_stylesheet_directory().'/includes/content-tweaks.php';

/**
 * Hooks and filters which modify how bbPress works.
 */
require_once get_stylesheet_directory().'/includes/bbpress-tweaks.php';
