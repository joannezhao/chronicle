<?php
/*
	Plugin Name: Chronicle Sliders
	Description: Simple implementation of a slideshow for the Dartmouth Chronicle
	Author: M. Goff
	Version: 1.0
*/

	add_action('init', 'create_slider_taxonomy');
	add_action('after_setup_theme', 'initialize_slider');
	add_action('admin_menu', 'create_slider_admin_menu');

	function initialize_slider() {
		add_theme_support('post-thumbnails');
		add_image_size('slide', 720, 360, true);
		add_image_size('featured', 360, 300, true);
	}

	function create_slider_admin_menu() {
		add_menu_page(
			'Sliders',
			'Sliders',
			'edit_posts',
			'edit-tags.php?taxonomy=slider&post_type=article',
			'',
			'',
			10
		);
		remove_submenu_page('edit.php?post_type=article', 'edit-tags.php?taxonomy=slider&amp;post_type=article');
	}

	function create_slider_taxonomy() {
		register_taxonomy('slider', array('article'),
			array(
				'labels' => array(
					'name' => __('Sliders'),
					'singular_name' => __('Slider'),
					'search_items' =>  __('Search Sliders'),
					'all_items' => __('All Sliders'),
					'edit_item' => __('Edit Slider'),
					'update_item' => __('Update Slider'),
					'add_new_item' => __('Add New Slider'),
					'new_item_name' => __('New Slider Name'),
					'menu_name' => __('Sliders'),
				),
				'public' => true,
				'rewrite' => array('slug' => 'sliders'),
				'hierarchical' => false,
			)
		);
	}

	function the_homepage_slider() {
		$loop = new WP_Query(
			array(
				'post_type' => 'article',
				'posts_per_page' => 5,
				'tax_query' => array(
					array(
						'taxonomy' => 'slider',
						'field' => 'slug',
						'terms' => 'homepage',
						'operator' => 'IN',
					),
				),
			));

		echo get_slider($loop);
	}

	function get_slider($loop) {
		$result = '
			<div class="slide-window">
			  <div class="slide-arrow slide-arrow-left"></div>
			  <div class="slide-arrow slide-arrow-right"></div>
			  <div class="slide-wrapper">';

		$first = true;
		while ($loop->have_posts()) {
			$loop->the_post();

			$the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'slide');
			$result .= '
			    <div class="slide shadow-inset ' . ($first ? 'active' : '') . '" data-id="' . get_the_ID() . '"
			    	style="background-image: url(' . $the_url[0] . ');">
			    	<a href="' . get_the_permalink() . '"></a>
			    </div>';
			$first = false;
		}

		rewind_posts();
		$first = true;
		$result .= '</div><div class="slide-link-wrapper">';

		while ($loop->have_posts()) {
			$loop->the_post();

			$result .= '
				<div class="slide-link ' . ($first ? 'active' : '') . '" data-id="' . get_the_ID() . '">
				  <div class="slide-link-category">' . get_the_first_category(false) . '</div>
				  <div class="slide-link-title">' . get_the_title() . '</div>
				</div>';
			$first = false;
		}

		rewind_posts();
		$first = true;
		$result .= '</div><div class="slide-info-wrapper">';

		while ($loop->have_posts()) {
			$loop->the_post();

			$result .= '
				<div class="slide-info ' . ($first ? 'active' : '') . '" data-id="' . get_the_ID() . '">
				  <a href="' . get_the_permalink() . '">
					<div class="article-category">' . get_the_first_category() . '</div>
					<div class="article-title">' . get_the_title() . '</div>
					<div class="article-author">BY ' . strtoupper(get_author(get_the_ID())) . '</div>
					<div class="article-excerpt">' . 
					  (strlen(get_the_excerpt()) > 100 ? explode("\n", wordwrap(get_the_excerpt(), 100))[0] . '...' : get_the_excerpt()) . '
					</div>
				  </a>
			    </div>';
			$first = false;
		}

		$result .= '</div></div>';
		return $result;
	}

	// Structure for aero-style panel
	  // <div class="img-wrapper">
	  // 	<img width="720" height="360" title="' . get_the_title() . '" src="' . $the_url[0] . '" />
	  // </div>
	  
	  // <div class="slide-title">
	  //   <img class="slide-title-background" width="724" height="364" src="' . $the_url[0] . '"/>
	  //   <div class="slide-title-overlay"></div>
	  //   <div class="slide-title-text">
	  //     <div class="article-title">' . get_the_title() . '</div>
	  //     <div class="article-excerpt">' .
	  //     	(strlen(get_the_excerpt()) > 200 ? explode("\n", wordwrap(get_the_excerpt(), 200))[0] . '...' : get_the_excerpt()) . '
	  //     </div>
	  //   </div>
	  // </div>
?>