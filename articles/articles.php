<?php 
/*
    Plugin Name: Articles
    Description: Plugin for displaying articles and issues for the Dartmouth Chronicle
    Author: M. Goff
    Version: 1.5
*/
    
	defined('ABSPATH') or die("No script kiddies please!");
	add_action( 'init', 'create_article_post_type');
	add_action('init', 'create_issue_taxonomy');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	add_action('wp_head', 'track_article_views');
	add_action('create_issue', 'set_issue_date');
	add_action('after_setup_theme', 'initialize_issues');


	function initialize_issues() {
		add_theme_support('post-thumbnails');
		add_image_size('issue', 340, 420, true);
	}

	function set_issue_date($categoryID) {
		add_term_meta($categoryID, 'date', date('d/m/Y'), true);
	}


	// Functions for article view counter 
	function set_article_views($postID) {
	    $count_key = 'article_view_count';
	    $count = get_post_meta($postID, $count_key, true);
	    
	    if ($count == '') {
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }
	    else {
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}

	function track_article_views ($postID) {
	    if (!is_single()) return;
	    if (empty($postID)) {
	        global $post;
	        $postID = $post->ID;
	    }
	    set_article_views($postID);
	}

	function get_article_views($postID) {
		if (empty($postID)) {
	    	if (!empty($post)) {
		        global $post;
		        $postID = $post->ID;
		    }
		    else return;
	    }

	    $count_key = 'article_view_count';
	    $count = get_post_meta($postID, $count_key, true);

	    if ($count == '') {
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return 0;
	    }
	    return $count;
	}

	function get_popular_articles($count=5) {
		$args = array(
			'post_type' => 'article',
			'posts_per_page' => $count,
			'meta_key' => 'article_view_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'date_query' => array(
				'after' => '-1 months'
			),
			'inclusive' => true,
		);

		$loop = new WP_Query($args);
		if ($loop->post_count < 5) {
			$args['date_query']['after'] = '-2 months';
			$loop = new WP_Query($args);
		}

		return $loop;
	}


	// Functions to create custom post types and taxonomoies
	function create_article_post_type() {
		register_post_type('article',
			array(
				'labels' => array(
					'name' => __( 'Articles' ),
					'singular_name' => __( 'Article' ),
					'add_new' => __('Add New Article'),
					'add_new_item' => __('Add New Article'),
					'edit_item' => __('Edit Article'),
					'new_item' => __('Add New Article'),
					'view_item' => __('View Articles'),
 					'search_items' => __('Search Articles'),
				),
				'taxonomies' => array('category'),
				'supports' => array('title','editor','thumbnail', 'author', 'excerpt', 'comments'),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'articles'),
				'menu_position' => 5,
			)
		);
	}

	function create_issue_taxonomy() {
		register_taxonomy('issue', array('article'),
			array(
				'labels' => array(
					'name' => __('Issues'),
      				'singular_name' => __('Issue'),
					'search_items' =>  __('Search Issues'),
					'all_items' => __('All Issues'),
					'edit_item' => __('Edit Issue'),
					'update_item' => __('Update Issue'),
					'add_new_item' => __('Add New Issue'),
					'new_item_name' => __('New Issue Name'),
					'menu_name' => __('Issues'),
      			),
      			'public' => true,
				'rewrite' => array('slug' => 'issues'),
				'hierarchical' => false,
				'single_value' => true,
			)
		);
	}
?>