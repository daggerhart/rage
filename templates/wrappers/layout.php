<?php
/*
 * This template wraps the main area of the page, such as content and sidebars.
 *
 * To create another layout:
 * ---
 *  - Copy this file and name it layout-<something>.php
 *  - Add a php comment to the top of the file that says something like:
 *    "Theme Layout Name: My New Layout"
 *    (without quotes)
 *
 * Variables
 * ---------
 * $content - Rendered WordPress loop template
 * $layout_file - This layout file
 */
?>
<div id="content" class="site-content container">

	<div class="row">
		<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-9">
			<main id="main" class="site-main" role="main">

				<?php print $content; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<div id="secondary" class="widget-area col-xs-12 col-sm-12 col-md-3" role="complementary">
			<?php rage_template( 'sidebar' ); ?>
		</div><!-- #secondary -->
	</div>

</div><!-- #content -->
