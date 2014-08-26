<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Chronicle
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="site-info">
				<?php do_action( 'twentyfourteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
			</div>
		
		</footer>
	
	</div><!-- #page -->

	<?php wp_footer(); ?>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/skrollr.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/project.js'; ?>"></script>

	<script type="text/javascript">
    $(document).ready(function() {
    	var s = skrollr.init();
    });
  </script>

</body>
</html>