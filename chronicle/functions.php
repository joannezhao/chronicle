<?php

function remove_menus() {
	remove_menu_page('edit.php');
}
function remove_wp_nodes() {
	global $wp_admin_bar;   
    $wp_admin_bar->remove_node('new-post');
}
function register_recent_tweet_widget() {
	register_widget('tp_widget_recent_tweets');
}

add_action('admin_bar_menu', 'remove_wp_nodes', 999);
add_action('admin_menu', 'remove_menus');
define('HEADER_IMAGE_WIDTH', 300);
define('HEADER_IMAGE_HEIGHT', 45);

if (!isset($content_width)) $content_width = 960;
?>