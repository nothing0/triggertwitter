<?php

class TweetFound {

	public function twitterCommand($tweet, $extra_params) {
		echo "\n Tweet found! -->", $tweet->text; 
	}

}