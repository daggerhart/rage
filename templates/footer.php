<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials\
 */

do_action( 'get_footer' );
?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info container">
		<a href="<?php echo esc_url( esc_html__( 'https://wordpress.org/' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s' ), 'WordPress' ); ?></a>
		<span class="sep"> | </span>
		<?php printf( esc_html__( 'Theme: %1$s by %2$s.' ), 'Rage', '<a href="http://www.daggerhart.com" rel="designer">Jonathan Daggerhart</a>' ); ?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
