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

		<footer>
		  <div class="page-center">
			<div id="footer-blurb">
				The Dartmouth Chronicle is a magazine featuring content written by students,
				professors, and alumni that bring the Dartmouth community together and highlight
				the issues of the day
			</div>
			<div class="footer-list">
				<a href="/">Item</a>
				<a href="/">Test</a>
				<a href="/">Item</a>
			</div>
			<div class="footer-list">
				<a href="/">Twitter</a>
				<a href="/">Vimeo</a>
				<a href="/">Facebook</a>
			</div>
		  </div>
		</footer
	
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