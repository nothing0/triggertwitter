<?php

class ValidationController {

	private $_key, $_action, $_data;
	private $_succeed = true;

	public function __construct($key, $action, $data) {
		$this->_key 	= $key;
		$this->_action 	= $action['validation'];
		$this->_data 	= $data;
	}

	private static function detectArrayMatches($array1, $array2) {
		$passes = false;

		foreach($array1 as $data1) {
			// Loop given hashtags for the search
			foreach($array2 as $data2) {
				// Compare them
				if(strtolower($data1) == strtolower($data2))
					$passes = true;
			}
		}

		return $passes;
	}

	public function succeed() {
		return $this->_succeed;
	}

	/* ===================================
	 * Validation methods
	 * ===================================
	 */
	public function text_contains() {	
		$passes = false;
		foreach($this->_action['text_contains'] as $search_text) {
			if(strpos(strtolower($this->_data['tweet']->text), strtolower($search_text)))
				$passes = true;
		}

		if(!$passes)
			$this->_succeed = false;
	}

	public function hashtags() {
		// Check if the the tweets contain the given hashtags
		$okay = false;
		if(count($this->_data['hashtags']) > 0) {

			foreach($this->_action['hashtags'] as $action_tag) {
				foreach($this->_data['hashtags'] as $data_tag) {
					if(strtolower($action_tag) == strtolower($data_tag->text)) {
						$okay = true;
					}
				}
			}

			// Next, if $this->_action['hashtags'] is set but it's emtpty, also let it pass
			if(count($this->_action['hashtags']) == 0) {
				$okay = true;
			}
		}

		if(!$okay)
			$this->_succeed = false;
		
	}

	public function mentions() {
		// Check for mentions
		if(count($this->_data['mentions'])> 0) {
			// Put screen names in array
			$data_screen_names = array();
			foreach($this->_data['mentions'] as $mention)
				$data_screen_names[] = $mention->screen_name;

			$passes = self::detectArrayMatches($this->_action['mentions'], $data_screen_names);

			if(count($this->_action['mentions']) == 0) 
				$passes = true;

			if(!$passes)
				$this->_succeed = false;
		} else {
			// No mentions were given
			$this->_succeed = false;
		}
	}

	public function screen_name() {
		// Check for the screen name
		$passes = false;

		foreach($this->_action['screen_name'] as $screen_name) {
			if($screen_name == $this->_data['user']->screen_name)
				$passes = true;
		}

		if(!$passes) {
			$this->_succeed = false;
		}
	}

	public function text_equals() {
		// Check if the tweet completly matches
		$passes = false;

		foreach($this->_action['text_equals'] as $text) {
			if($this->_data['tweet']->text == $text) 
				$passes = true;
		}

		if(!$passes)
			$this->_succeed = false;
	}

	public function retweet() {
		$passes = false;

		if($this->_data['retweeted_status'] != null) 
			$passes = true;

		if(!$passes)
			$this->_succeed = false;
	}

}