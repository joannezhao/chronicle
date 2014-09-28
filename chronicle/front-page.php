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
	 * @subpackage Dartmouth Chronicle
	 * @since Dartmouth Chronicle 1.0
*/

	require 'packages/vendor/autoload.php';

	get_header();
?>

<div id="content" class="content front-page">
<div id="content-top">
  <div class="page-center">
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
		?>

			<div class="divider" style="margin-top:0">
		      <div class="divider-text">Featured Article</div>
		      <div class="divider-border"></div>
		    </div>

		    <div class="featured-wrapper"><a href="<?php echo get_the_permalink(); ?>">
		 	  <div class="featured-image shadow-inset" style="background-image: url('<?php echo $the_url[0]; ?>');"></div>
		 	  <div class="featured-article"><div class="featured-article-vertical-center">
		 	  	
		 	  	<div class="article-category"> <?php echo get_the_first_category(); ?> </div>
				<div class="article-title"> <?php the_title(); ?> </div>
				<div class="article-author">BY <?php echo strtoupper(get_author(get_the_ID())); ?> </div>
				<div class="article-excerpt"> 
					<?php echo (strlen(get_the_excerpt()) > 100 ? explode("\n", wordwrap(get_the_excerpt(), 100))[0] . '...' : get_the_excerpt()); ?>
				</div>

		 	  </div></div>
		 	</a></div>

	     <?php endif; ?>
	</div>

	<div id="content-right">

	  <!-- Most viewed articles -->
	  <div class="divider" style="margin-top:0;">
	    <div class="divider-text-center"><div class="divider-text">Popular</div></div>
	    <div class="divider-border"></div>
	  </div>

	  <div class="popular-wrapper front-page">
	    <?php
	     	$loop = get_popular_articles(4);

	    	while ($loop->have_posts()):
	    		$loop->the_post();
	    	?>

	    	  <div class="popular-article"><a href="<?php echo get_the_permalink(); ?>">
		 	  	
		 	 	<div class="article-category"> <?php echo get_the_first_category(); ?> </div>
				<div class="article-title"> <?php the_title(); ?> </div>
				<div class="article-author">BY <?php echo strtoupper(get_author(get_the_ID())); ?> </div>

		 	  </a></div>

		<?php endwhile; ?>

	  </div>

	  <!-- Tweets -->
	  <div class="divider">
	    <div class="divider-text-center"><div class="divider-text">Tweets</div></div>
	    <div class="divider-border"></div>
	  </div>

	  <div class="tweet-wrapper">

	  	<?php

	  		$instance = array();
			$instance['title'] = 'Tweets';
			$instance['consumerkey'] = '3CxxaEkzUxsFe1TPsPqknL2vE';
			$instance['consumersecret'] = 'G7AwY47zLUG7SBlrhvvGrJhDYUX6pKaOXELqfhdZxSx5UOTzOq';
			$instance['accesstoken'] = '2770409635-JZn74iNTlyqvPJu51BhVeUwF48fDJYXoxt51pVr';
			$instance['accesstokensecret'] = 'a01WCjOSwASNuc8JcwUpHCqKooxtoTkIUDsR969867NMR';
			$instance['cachetime'] = '2';
			$instance['username'] = 'dartmouth';
			$instance['tweetstoshow'] = '3';
			$instance['excludereplies'] = 'true';

	  		the_widget('tp_widget_recent_tweets', $instance);
	  		
	  	?>

	  </div>
	</div>


 	<!-- Current issue -->
 	<div class="divider">
 	  <div class="divider-text">Current Issue</div>
 	  <div class="divider-border"></div>
 	</div>

 	<?php
 		$issues = get_terms('issue', array( 'hide_empty' => 0 ));
 		if (!empty($issues)):
	 		$newest_issue = false;
	 		$newest_date = false;
	 		foreach ($issues as $issue) {
	 			if (!$newest_issue) {
	 				$newest_issue = $issue;
	 				$newest_date = strtotime(get_term_meta($issue->term_id, 'date', true));
	 				continue;
	 			}
	 			$date = strtotime(get_term_meta($issue->term_id, 'date', true));
	 			if ($date > $newest_date) {
	 				$newest_date = $date;
	 				$newest_issue = $issue;
	 			}
	 		}
	?>

	 	<div class="issue-wrapper">
	 	  <div class="issue-cover">
	 	  	
	 	  	<div class="issue-image shadow-inset"
	 	  		style="background-image: url('<?php echo z_taxonomy_image_url($newest_issue->term_id, 'issue'); ?>');">
	 	  	</div>
	 	  	<!-- <div class="issue-image-blur">
	 	  	  <img width="344" height="424" src="<?php echo z_taxonomy_image_url($newest_issue->term_id, 'issue'); ?>" />
	 	  	</div>
	 	  	<div class="issue-title-overlay"></div>
	 	  	<div class="issue-title">
	 	  	  <div class="issue-title-text"> <?php echo $newest_issue->name; ?> </div>
	 	  	  <div class="issue-title-border"></div>
	 	  	</div> -->
	 	  
	 	  </div>
	 	  <div class="issue-articles">
	 	  	<?php
	 	  		$loop = new WP_Query(
	 	  			array(
						'post_type' => 'article',
						'posts_per_page' => 3,
						'category_name' => 'Issue Theme',
						'order_by' => 'modified',
						'order' => 'DESC',
						'tax_query' => array(
							array(
								'taxonomy' => 'issue',
								'field' => 'term_id',
								'terms' => $newest_issue->term_id,
								'operator' => 'IN',
							),
						)
					));
	 	  		while ($loop->have_posts()):
	 	  			$loop->the_post();
	 	  	?>
	 	  	  
	 	  	  <div class="issue-article"><a href="<?php echo get_the_permalink(); ?>">
	 	  	  	<div class="article-category"> <?php echo get_the_first_category(); ?> </div>
				<div class="article-title"> <?php the_title(); ?> </div>
				<div class="article-author">BY <?php echo strtoupper(get_author(get_the_ID())); ?> </div>
				<div class="article-excerpt"> 
					<?php echo (strlen(get_the_excerpt()) > 100 ? explode("\n", wordwrap(get_the_excerpt(), 100))[0] . '...' : get_the_excerpt()); ?>
				</div>
	 	  	  </a></div>
	 	  	
	 	  	<?php endwhile; ?>

	 	  </div>
	 	</div>

    <?php endif; ?>

    </div>
    </div><!-- #content-top -->



	<!-- More Stories -->
	<div id="content-bottom">
	<div class="page-center">
	  <div class="section-title-wrapper"><div class="section-title">More Stories</div></div>
	  <div class="extra-wrapper">
	    
	    <?php
	    	$loop = new WP_Query(
				array(
					'category_name' => 'More Stories',
					'post_type' => 'article',
					'posts_per_page' => 3,
					'order_by' => 'modified',
					'order' => 'DESC',
				));

	    	while ($loop->have_posts()):
	    		$loop->the_post();
	    		$the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'featured');
		?>

			<div class="extra-story"><a href="<?php echo get_the_permalink(); ?>">
		 	  <div class="extra-story-image shadow-inset-sm" style="background-image: url('<?php echo $the_url[0]; ?>');"></div>
		 	  <div class="extra-story-info">
				<div class="article-category"> <?php echo get_the_first_category(); ?> </div>
				<div class="article-title"> <?php the_title(); ?> </div>
				<div class="article-author">BY <?php echo strtoupper(get_author(get_the_ID())); ?> </div>
				<div class="article-excerpt"> 
					<?php echo (strlen(get_the_excerpt()) > 100 ? explode("\n", wordwrap(get_the_excerpt(), 100))[0] . '...' : get_the_excerpt()); ?>
				</div>
			  </div>
		 	</a></div>

		<?php endwhile; ?>
	  
	  </div>
	</div><!-- #content-bottom -->

  </div>
</div>

<?php
	get_footer();
?>
