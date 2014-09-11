<?php
/*
Template Name: Search Page
*/

	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	}

	$page = (get_query_var('page') ? get_query_var('page') : 1);
	$search_query = array_merge($search_query, array(
		'post_type' => 'article',
		'posts_per_page' => 5,
		'paged' => $page));

	$loop = new WP_Query($search_query);

	get_header();
?>

	<div id="content" class="content">
	  <div class="search-wrapper">
		<div id="search-field-wrapper">
		  <form method="get" id="searchform" action="/">
			<input id="search-field" type="text" value="<?php the_search_query(); ?>" name="s" />
			<button id="search-submit"><span class="glyphicon glyphicon-search"></span></button>
		  </form>
		</div>
	  </div>

	  <div id="results-wrapper">
		<div class="search-wrapper">
		  <?php
			while ($loop->have_posts()):
				$loop->the_post();
				$the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'search');
		  ?>

		    <a class="result-link" href="<?php echo get_the_permalink(); ?>">
		      <div class="result">

		      <div class="result-image shadow-inset-sm" style="background-image: url('<?php echo $the_url[0]; ?>');"></div>
		      <div class="result-info-wrapper">
			    <div class="article-category">
			  	  <?php echo get_the_first_category(); ?>
			  	</div><div class="article-date">
			  	  <?php echo get_the_issue(get_the_ID(), false); ?>
			  	</div>
			    <div class="article-title"><?php the_title(); ?></div>
			    <div class="article-author">By <?php echo get_author(get_the_ID()); ?></div>
			    <div class="article-excerpt"> 
				  <?php echo (strlen(get_the_excerpt()) > 100 ? explode("\n", wordwrap(get_the_excerpt(), 100))[0] . '...' : get_the_excerpt()); ?>
				</div>
			  </div>

		      </div>
		    </a>

		  <?php endwhile; ?>

		  <div class="pagination-wrapper">
		    <?php echo paginate_links(
		    	array(
					'base'         => '/?s=' . urlencode(get_search_query()) . '&page=%#%',
					'format'       => 'page=%#%',
					'current'       => max(1, get_query_var('page')),
					'total'         => $loop->max_num_pages,
					'mid_size'      => 3,
					'type'          => 'plain',
				));
			?>
		  </div>

		</div>  
	  </div>
	
	</div>

<?php
	get_footer();
?>