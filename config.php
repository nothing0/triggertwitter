<?php

/* ===================================
 * Twitteroauth keys
 * ===================================
 */
define('CONSUMER_KEY', 			'');
define('CONSUMER_SECRET', 		'');
define('OAUTH_TOKEN', 			'');
define('OAUTH_TOKEN_SECRET',	'');

/* ===================================
 * Global
 * ===================================
 */
// ROOT_PATH is the path to this location where all the twitter-command files are stored
define('ROOT_PATH',				'/path/to/project/twitter-command/');

// PROJECT_PATH is the path to the project where twitter-command is used for, so that some files don't have to be in the ROOT_PATH
define('PROJECT_PATH',			'/path/to/project/twitter-command/');

// The name of the actions file
define('ACTIONS_FILE', 			ROOT_PATH . 'actions.php');

// ROOT_PATH can be changed to PROJECT_PATH if the actions directory isn't in the root directory
define('ACTIONS_DIRECTORY',		ROOT_PATH . 'actions/'); 


?>
