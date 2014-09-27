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
				professors, and alumni that brings the Dartmouth community together and highlights
				the issues of the day
			</div>
			<div class="footer-list">
				<a href="/">Home</a>
				<a href="/about/">About</a>
				<a href="/category/arts/">Arts</a>
				<a href="/category/narrative/">Narrative</a>
				<a href="/category/politics/">Politics</a>
				<a href="/category/science/">Science</a>
				<a href="/category/sports/">Sports</a>
			</div>
			<div class="footer-list">
				<a target="_blank" href="https://twitter.com/dchronicle2014">Twitter</a>
				<a target="_blank" href="/">Vimeo</a>
				<a target="_blank" href="/">Facebook</a>
			</div>
			<div id="dali-logo">
			  <a href="http://dali.dartmouth.edu" target="_blank">
			  	<img src="<?php bloginfo('stylesheet_directory'); ?>/static/images/dali.png" width="200" height="100" />
			  </a>
			</div>
		  </div>
		</footer
	
	</div><!-- #page -->

	<?php wp_footer(); ?>

	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/static/js/skrollr.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/static/js/project.js'; ?>"></script>

</body>
</html>