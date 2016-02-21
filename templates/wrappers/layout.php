<?php
/*
 * Variables
 * ---------
 * $content - rendered WordPress loop template
 * $layout_file -
 */
?>
<div id="content" class="site-content container">

	<div class="row">
		<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-9 pull-right">
			<main id="main" class="site-main" role="main">

				<?php print $content; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<div id="secondary" class="widget-area col-xs-12 col-sm-12 col-md-3" role="complementary">
			<?php rage_template( 'sidebar' ); ?>
		</div><!-- #secondary -->
	</div>

</div><!-- #content -->
