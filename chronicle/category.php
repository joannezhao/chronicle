<?php
/**
 * The template for displaying Category pages
 *
 *
 * @package WordPress
 * @subpackage Dartmouth Chronicle
 * @since Dartmouth Chronicle 1.0
 */

	get_header();
	$category = $wp_query->get_queried_object();
?>

<!--Parallax images-->
<div class="wrapper-parallax-image wrapper-parallax-image-full"
    data-anchor-target="#gap0"
	data-bottom-top="transform: translate3d(0px, 1200px, 0px);"
	data-top-bottom="transform: translate3d(0px, 0px, 0px);">

	<div class="parallax-image parallax-image-full"
		data-anchor-target="#gap0"
		style="background-image:url('<?php echo z_taxonomy_image_url($category->term_id, 'large'); ?>'); <?php
		  if ($category->slug == "narrative") { echo "background-position: 50% 100%;"; }
		  elseif ($category->slug == "sports") { echo "background-position: 50% 100%;"; }
		  elseif ($category->slug == "arts") { echo "background-position: 50% 30%;"; }
		  elseif ($category->slug == "science") { echo "background-position: 50% 90%;"; } ?>"
		data-bottom-top="transform: translate3d(0px, -300px, 0px);"
		data-top-bottom="transform: translate3d(0px, 220px, 0px);">
	</div>
</div>

<div id="content" class="content">
  <div class="gap gap-full shadow-inset-sm" id="gap0">
  	<div class="text-wrapper-outer"><div class="text-wrapper-mid"><div class="text-wrapper-inner">
  	  
  	  <div class="border"></div><div class="title-box">
	    <span class="title title-border title-shadow"><?php echo $category->name; ?></span>
	  </div><div class="border"></div>
	
	</div></div></div>
  </div>

  <div class="category-page">
    <div class="page-center">


		<div id="content-left">
		  <div class="divider" style="margin-top:0; margin-bottom:0;">
	    	<div class="divider-text">Most Recent</div>
	    	<div class="divider-border"></div>
		  </div>

		  <div class="category-wrapper">
			<?php
				$loop = new WP_Query(
					array(
						'category_name' => $category->name,
						'post_type' => 'article',
						'posts_per_page' => 5,
					));

				$count = 0;
				while ($loop->have_posts()):
					$loop->the_post();
					$the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'featured');
			?>

		    <a href="<?php echo get_the_permalink(); ?>"><div class="category">
		 	  <div class="category-article-image shadow-inset" style="background-image: url('<?php echo $the_url[0]; ?>'); <?php if ($count%2==1): ?>float: right;<?php endif; ?>"></div>
		 	  <div class="category-article-info">
		 	  	
		 	  	<div class="article-category"><?php echo get_the_first_category(); ?></div>
				<div class="article-title"> <?php the_title(); ?> </div>
				<div class="article-author">BY <?php echo strtoupper(get_author(get_the_ID())); ?> </div>
				<div class="article-excerpt"> 
					<?php echo (strlen(get_the_excerpt()) > 150 ? explode("\n", wordwrap(get_the_excerpt(), 150))[0] . '...' : get_the_excerpt()); ?>
				</div>

		 	  </div>
		 	</div></a>

		    <?php $count++; endwhile; ?>
		  </div>
		</div>


		<div id="content-right">
		  
		  <div class="divider" style="margin-top:0;">
	    	<div class="divider-text-center"><div class="divider-text">Popular</div></div>
	    	<div class="divider-border"></div>
		  </div>

		  <div class="popular-wrapper" style="margin-bottom: 40px;">
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

		</div>


    </div>
  </div>

<?php
	get_footer();
?>
