<?php

class ActionController  {

	protected $_twController;

	public function __construct(TwitterController $twitterController) {
		$this->_twController = $twitterController;
	}

	public function run() {
		$actions = require ACTIONS_FILE;

		$twoauth = $this->_twController->twoauth();

		// Timeline
		$timeline = $twoauth->get('statuses/home_timeline', array('count'=>200));
		
		// Loop through actions
		foreach($actions as $key => $actions) {
			foreach($timeline as $tweet) {
				// Get all data needed
				$data['tweet'] = $tweet;

				$data['hashtags'] = $tweet->entities->hashtags;
				$data['user'] = $tweet->user;
				$data['mentions'] = $tweet->entities->user_mentions;
				$data['retweeted_status'] = (isset($tweet->retweeted_status) ? $tweet->retweeted_status : null);

				// Check
				$validate = $this->validate($key, $actions, $data);

				if($validate) {
					// Call the method that defined as 'do' in actions.php
					$do = $actions['do'];
					if(file_exists($do['path'])) {
						require_once $do['path'];

						// Check if there is a classname specified. If not, call the function without object, else, with
						if(isset($do['class_name'])) {
							$class = new $do['class_name'];
							$class->{$do['method_name']}($tweet, $actions['extra_params']);
						} else {
							$do['method_name']($tweet, $actions['extra_params']);
						}
 					}
				}
			}
		}
	}


	private function validate($key, $actions, $data) {

		$validation = new ValidationController($key, $actions, $data);

		// Run each action if the method exists
		foreach($actions['validation'] as $name => $params) {
		
			if(method_exists($validation, $name)) {
				$validation->{$name}();
			} else {
				throw new Exception("The method \"$name\" doesn't exist");
			}
		}
		
		// Check if it passes
		$passes = $validation->succeed();
		
		return $passes;
	}


}