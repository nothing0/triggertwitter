Twitter Command - An easy way to search tweets with PHP
-------------------------------------------------------

Twitter Command lets you search your timeline with specific parameters to find the kind of tweets you want. If a tweet is found, Twitter Command will trigger a function that you have created, so you can do everything you want with the found tweet.

How does it work?
-----------------
####It all starts with the config file:
```PHP
// config.php

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
define('ROOT_PATH',				'/path/to/webserver/myProject/twitter-command/');

// PROJECT_PATH is the path to the project where twitter-command is used for, so that some files don't have to be in the ROOT_PATH
define('PROJECT_PATH',			'/path/to/webserver/myProject/');

// The name of the actions file
define('ACTIONS_FILE', 			ROOT_PATH . 'actions.php');

// ROOT_PATH can be changed to PROJECT_PATH if the actions directory isn't in the root directory
define('ACTIONS_DIRECTORY',		ROOT_PATH . 'actions/'); 
```
This is the most basic setup of the config file. The ROOT_PATH means the path to twitter-command (can be within your project) and PROJECT_PATH means the path to your project.


#### After that, we have actions.php:
```PHP
// actions.php

return array(
	'tweet' => array(  
		'validation' => array(
			'text_equals' => array('Using twitter-command', 'twitter-command!') // The tweet must be equal to the given text
		),
		'do' => array('path' => ROOT_PATH . 'actions/TweetFound.php', 'class_name' => 'TweetFound', 'method_name' => 'twitterCommand'), 
		'extra_params' => array('found_timestamp' => time()) 
	),
);
```
What happens above is that there is searched for a tweet with specific text. If the tweet if found, the method TweetFound::twitterCommand is being triggered in actions/TweetFound.php.
There are various methods to search with. In the example above, text_equals is used. These methods are available:
* text_equals
  * array('The text the tweet must have')
* text_contains
  * array('The text the tweet must contain')
* hashtags
  * array('hashtags')
* mentions
  * array('mentions')
* screen_name
  * array('screen_names')
* retweet
  * bool -> if true, the tweet must be a retweet. If false, it may not be a retweet. If it may be both, don't set it.

If there are more than 1 items in the array, they are optional. Only 1 of them has to match to let it pass.
If you leave the array empty, it will automatically pass if there is only one of the things that is searched for.
Example:
```PHP
  'hashtags' => array(), // Empty array
```
In this case it will pass if the tweet contains one or more hashtags, no matter what the text of it is. This also works with mentions.

#### The method that's being triggered
In the example of actions.php, we see this:
```PHP
'do' => array('path' => ROOT_PATH . 'actions/TweetFound.php', 'class_name' => 'TweetFound', 'method_name' => 'twitterCommand'),
'extra_params' => array('found_timestamp' => time()) 
```
This means the method TweetFound::twitterCommand will be triggered.

That will look like this:
```PHP
// actions/TweetFound.php

class TweetFound {

	public function twitterCommand($tweet, $extra_params) {
		echo "\n Tweet found! -->", $tweet->text; 
	}

}
```
You can see that there are two parameters. The first one, $tweet, contains all the data of the tweet. The second, $extra_params, contains the extra parameters defined as extra_params. This can be useful for various things.
With your custom function you can also save the tweet.

#### So, how do we run twitter-command?
It's very simple. Do this in the command line: 
```
$ cd /path/to/twitter-command
$ php -f run.php
```
That's it!

