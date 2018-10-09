<?php
$labels = array(
	'name' => _x('Projects', 'post type projects'),
	'singular_name' => _x('Project', 'post type singular project'),
	'add_new' => _x('Add new project', 'projects'),
	'add_new_item' => __('Add new project item'),
	'edit_item' => __('Edit project item'),
	'new_item' => __('New project item'),
	'view_item' => __('View project item'),
	'search_items' => __('Search items'),
	'not_found' =>  __('Nothing found'),
	'not_found_in_trash' => __('Nothing found in Trash'),
	'parent_item_colon' => ''
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'query_var' => true,
	'show_in_rest' => true,
	'rewrite' => array('slug' => 'work'),
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_position' => null,
	'supports' => array('title','taxonomy', 'thumbnail', 'editor', 'excerpt'),
	'rest_base' => 'maps',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
  ); 
register_post_type( 'projects' , $args );
