<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

	get_header();
?>

<div class="page-center">
  <div id="main-content" class="main-content">
  	<div id="content-left">

	    <!-- Slider -->
	    <?php the_homepage_slider(); ?>

	    <!-- Featured article -->
	    <?php
	    	$loop = new WP_Query(
				array(
					'category_name' => 'Featured',
					'post_type' => 'article',
					'posts_per_page' => 1,
				));

	    	if ($loop->have_posts()):
	    		$loop->the_post();
	    		$the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'featured');
	    		$the_categories = get_the_category();
	    		foreach ($the_categories as $key => $value) {
	    			if ($value->name == "Featured") {
	    				unset($the_categories[$key]);
	    			}
				}
				$the_categories = array_values($the_categories);
		?>

			<div class="divider">
		      <div class="divider-text">Featured Article</div>
		      <div class="divider-border"></div>
		    </div>

		    <div class="featured-wrapper">
		 	  <div class="featured-image">
		 	  	<img width="360" height="300" title="<?php the_title(); ?>" src="<?php echo $the_url[0]; ?>" />
		 	  </div>
		 	  <div class="featured-article">
		 	  	
		 	  	<div class="article-category"> <?php echo (count($the_categories) ? strtoupper($the_categories[0]->name) : "CURRENT"); ?> </div>
				<div class="article-title"> <?php the_title(); ?> </div>
				<div class="article-author">BY <?php echo strtoupper(get_the_author()); ?> </div>
				<div class="article-excerpt"> 
					<?php echo (strlen(get_the_excerpt()) > 100 ? explode("\n", wordwrap(get_the_excerpt(), 100))[0] . '...' : get_the_excerpt()); ?>
				</div>

		 	  </div>
		 	</div>

	     <?php endif; ?>
	 </div>

	 <div id="content-right">

	   <!-- Most viewed articles -->
	   <div class="most-viewed-wrapper">
	     Hello
	   </div>

	 </div>


 	<!-- Current issue -->
 	<div class="divider">
 	  <div class="divider-text">Current Issue</div>
 	  <div class="divider-border"></div>
 	</div>

  </div>
</div>

<?php
	get_footer();
?>
