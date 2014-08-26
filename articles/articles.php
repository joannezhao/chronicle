<?php 
/*
    Plugin Name: Articles
    Description: Plugin for displaying articles and issues for the Dartmouth Chronicle
    Author: M. Goff
    Version: 1.5
*/
    
	defined('ABSPATH') or die("No script kiddies please!");
	add_action( 'init', 'create_article_post_type' );
	add_action('init', 'create_issue_taxonomy');

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