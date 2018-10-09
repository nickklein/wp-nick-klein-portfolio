<?php
$labels = array(
	'name'        => 'Categories',
	'add_new_item' => 'Add new Category'
);
register_taxonomy('project_categories', array('projects'),
	array('hierarchical' => true,
	  'labels'       => $labels,
	  'rewrite'      => true,
	  'show_tagcloud' => true
	)
);