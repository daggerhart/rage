<?php
/*
 * Variables
 * ---------
 * $layout - rendered layout template
 * $wrapper_file - This filename
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content' ); ?></a>

	<?php rage_template( 'header' ); ?>

	<?php print $layout; ?>

	<?php rage_template( 'footer' ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

