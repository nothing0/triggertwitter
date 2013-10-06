<?php

return array(
	'tweet' => array(  
		'validation' => array(
			//'text_contains' => array(), 
			//'hashtags' => array(), 
			'mentions' => array(), 
			//'screen_name' => array(), 
			//'text_equals' => array(), 
			//'retweet' => true,
		),
		'do' => array('path' => ROOT_PATH . 'actions/TweetFound.php', 'class_name' => 'TweetFound', 'method_name' => 'twitterCommand'),  
		'extra_params' => array('found_timestamp' => time()) 
	),
);
