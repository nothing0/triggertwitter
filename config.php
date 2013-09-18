<?php

/* ===================================
 * Twitteroauth keys
 * ===================================
 */
define('CONSUMER_KEY', 			'qh9hBmi4LvU8l7alrGA');
define('CONSUMER_SECRET', 		'86cLVpBGMxg3cJBi1pYtFNRCIhDJ1uh4NctVMWAfPs');
define('OAUTH_TOKEN', 			'285133869-BKSgxOoBHdPY0ksgijWP5JMbJ3xW2Xq9JJqxkTKm');
define('OAUTH_TOKEN_SECRET',	'R1R7SRz9ZIA75B8lmaPHyHWzqwSPDAfMP17QFQtNE');

/* ===================================
 * Global
 * ===================================
 */
// ROOT_PATH is the path to this location where all the twitter-command files are stored
define('ROOT_PATH',				'/Applications/xampp/htdocs/twitter-command/');

// PROJECT_PATH is the path to the project where twitter-command is used for, so that some files don't have to be in the ROOT_PATH
define('PROJECT_PATH',			'/Applications/xampp/htdocs/twitter-command/');

// The name of the actions file
define('ACTIONS_FILE', 			ROOT_PATH . 'actions.php');

// ROOT_PATH can be changed to PROJECT_PATH if the actions directory isn't in the root directory
define('ACTIONS_DIRECTORY',		ROOT_PATH . 'actions/'); 


?>