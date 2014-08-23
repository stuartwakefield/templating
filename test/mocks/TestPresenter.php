<?php
class TestPresenter {
	
	private $message;
	
	function __construct($message) {
		$this->message = $message;
	}
	
	function getMessage() {
		return $this->message;
	}
	
}
