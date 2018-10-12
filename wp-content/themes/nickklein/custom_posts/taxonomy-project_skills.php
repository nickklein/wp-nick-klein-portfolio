<?php
$labels = array(
	'name'        => 'Skills',
	'add_new_item' => 'Add new skill'
);
register_taxonomy('project_skills', array('projects'),
	array('hierarchical' => false,
	  'labels'       => $labels,
	  'rewrite'      => true,
	  'show_tagcloud' => true
	)
);