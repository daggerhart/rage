<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * This file is automatically loaded on every page while this theme is enabled.
 */

/*------------------------------------------------------------------------------
 * Core - These files should not need to be edited.
 */
/**
 * Helper functions for the theme
 * ---
 * - rage_title()    - attempts to find the appropriate title whenever it's used
 * - rage_template() - simplifies the use of get_template_part()
 */
require_once get_stylesheet_directory().'/includes/rage/utilities.php';

/**
 * Go berserk - The Rage_Core class contains generic WordPress theme helpers for
 * enqueueing scripts, styles, sidebars, nav menus, image sizes, and theme
 * supports
 */
require_once get_stylesheet_directory().'/includes/rage/rage-core.php';

/*------------------------------------------------------------------------------
 * Configuration - These are the files you should edit to fit your theme needs.
 */
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
