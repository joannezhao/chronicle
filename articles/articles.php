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

	add_action('add_meta_boxes', 'add_author_meta_box');
	add_action('save_post', 'save_author_meta_box_data');
	add_filter( 'image_size_names_choose', 'add_parallax_image_size' );

	function add_parallax_image_size( $sizes ) {
	    return array_merge($sizes, array(
	        'parallax' => 'Parallax',
	        'article' => 'Full-Width',
	    ));
	}


	function initialize_issues() {
		add_theme_support('post-thumbnails');
		add_image_size('issue', 340, 420, true);
		add_image_size('recommended', 200, 140, true);
		add_image_size('parallax', 660, 400, true);
		add_image_size('article', 660, 400, true);
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

	function get_article_views($postID = null) {
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


	// Functions to add a meta box for the author
	function add_author_meta_box() {
		add_meta_box(
			'author_meta_box',
			'Author',
			'get_author_meta_box',
			'article',
			'normal',
			'high'
		);
	}

	function get_author_meta_box($article) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'author_meta_box', 'author_meta_box_nonce' );

		$old_author = get_post_meta( $article->ID, 'author', true );

		echo '<input type="text" id="author_field" name="author_field" value="' . esc_attr( $old_author ) . '" size="25" />';
		echo '<p> The person who wrote this article. Defaults to "The Dartmouth Chronicle" </p>';
	}

	function save_author_meta_box_data($article_id) {
		if (!isset( $_POST['author_meta_box_nonce'] )) return;
		if (!wp_verify_nonce($_POST['author_meta_box_nonce'], 'author_meta_box')) return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_article', $article_id)) return;
		if (!isset( $_POST['author_field'] )) return;

		$author = sanitize_text_field( $_POST['author_field'] );
		update_post_meta($article_id, 'author', $author);
	}

	function get_author($postID = null, $link = false) {
		if (empty($postID)) {
	    	if (!empty($post)) {
		        global $post;
		        $postID = $post->ID;
		    }
		    else return;
	    }

		$author = get_post_meta($postID, 'author', true);
		if (strlen($author) > 0) {
			return ($link ? '<a href="' . '">' . $author . '</a>' : $author);
		}
		else {
			return 'The Dartmouth Chronicle';
		}
	}


	// Functions to get article information
	function get_the_first_category($link = false) {
		$the_categories = get_the_category();
		foreach ($the_categories as $key => $value) {
			if ($value->name == "Featured") {
				unset($the_categories[$key]);
			}
		}
		$the_categories = array_values($the_categories);
		
		if (count($the_categories) > 0) {
			return ($link ? '<a class="category-link" href="' . get_category_link($the_categories) . '">' . current($the_categories)->name . '</a>' :
				strtoupper(current($the_categories)->name)); 
		}
		else {
			return 'CURRENT';
		}
	}

	function get_the_issue($postID = null) {
		if (empty($postID)) {
	    	if (!empty($post)) {
		        global $post;
		        $postID = $post->ID;
		    }
		    else return;
	    }

		$issue = get_the_terms($postID, 'issue');
		if ($issue == false) {
			return get_the_date();
		}
		else {
			return '<a href="' . get_term_link(current($issue)) . '">' . current($issue)->name . ' Issue</a>';
		}
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
				'supports' => array('title','editor','thumbnail', 'excerpt', 'comments'),
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