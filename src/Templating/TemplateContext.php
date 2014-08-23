<?php
/**
 * @package Templating
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
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
		return call_user_func_array(array($this->presenter, $method), $args);
	}
	
	function __invoke($path) {
		ob_start();
		try {
			include $path;
		} catch (\Exception $ex) {
			ob_end_clean();
			throw $ex;
		}
		return ob_get_clean();
	}
	
}
