<?php

/* ===================================
 * Include all files
 * ===================================
 */
// Main files
require_once('config.php');

// twitteroauth
require_once(ROOT_PATH . 'twitteroauth/twitteroauth.php');
require_once(ROOT_PATH . 'twitteroauth/OAuth.php');

// Controllers
require_once(ROOT_PATH . 'controllers/TwitterController.php');
require_once(ROOT_PATH . 'controllers/ActionController.php');

// Autoload
function __autoload($controller) {
	$path = ROOT_PATH . 'controllers/'.$controller.'.php';
	
	if(file_exists($path)) {
		require_once($path);
	} 
}



/* ===================================
 * Define classes and connect
 * ===================================
 */
// Create twitterOauth
$twitterOauth = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);

// Load controllers
$twitterController = new TwitterController($twitterOauth);
$actionController = new ActionController($twitterController);



/* ===================================
 * Run
 * ===================================
 */
$actionController->run();


