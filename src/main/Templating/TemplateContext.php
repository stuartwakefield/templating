<?php
namespace Templating;

class TemplateContext {
	
	private $presenter;
	
	function __construct($presenter) {
		if (is_array($presenter))
			$presenter = (object) $presenter;
		$this->presenter = $presenter;
	}
	
	function __get($key) {
		return $this->presenter->$key;
	}
	
	function __set($key, $value) {
		throw new Exception('Invalid attempt to write to presenter');
	}
	
	function __call($method, $args) {
		return call_user_method_array($method, $this->presenter, $args);
		
	}
	
	function __invoke($path) {
		ob_start();
		include $path;
		return ob_get_clean();
	}
	
}
