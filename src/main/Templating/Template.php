<?php
namespace Templating;

class Template {
	
	private $path;
	
	/**
	 * Constructs a template object with the given template path.
	 * @param string $path
	 *        the path of the template file
	 */
	function __construct($path) {
		$this->path = $path;
	}
	
	/**
	 * Fills the template with values given by a presenter.
	 * @param object|array $presenter
	 *        the object to use as the template presenter
	 * @return string
	 *         the template rendered as a string
	 */
	function fill($presenter) {
		$context = new TemplateContext($presenter);
		return $context($this->path);
	}
	
}