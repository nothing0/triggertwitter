<?php

return array(
	'tweet' => array(  
		'validation' => array(
			//'text_contains' => array(), 
			//'hashtags' => array(), 
			'mentions' => array('aron__fidder'), 
			//'screen_name' => array('basvanderploeg'), 
			//'text_equals' => array(), 
			//'retweet' => true,
		),
		'do' => array("path" => ROOT_PATH . 'actions/test1.php', "class_name" => "hoihoi", "method_name" => 'hoi'), 
		'extra_params' => array('jaa' => true) 
	),
);