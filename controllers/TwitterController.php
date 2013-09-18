<?php

class TwitterController {

	private $_twitteroauth;

	public function __construct($twitteroauth) {
		$this->_twitteroauth = $twitteroauth;
	}

	public function twoauth() {
		return $this->_twitteroauth;
	}

}