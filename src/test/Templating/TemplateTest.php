<?php
namespace Templating;

use PHPUnit_Framework_TestCase as TestCase;

class TemplateTest extends TestCase {
	
	function testRender() {
		$template = new Template('templates/test.php');
		$this->assertEquals('<p>Hello, Test</p>', $template->fill(array(
			'message' => 'Hello, Test'
		)));
	}
	
	function testPresenterRender() {
		$template = new Template('templates/test_presenter.php');
		$this->assertEquals('<p>Hello, Presenter Test</p>', $template->fill(new TestPresenter('Hello, Presenter Test')));
	}
	
	function testPresenterReadOnly() {
		$this->setExpectedException('Templating\Exception');
		$template = new Template('templates/test_presenter_read_only.php');
		$template->fill(new TestPresenter(null));
	}
	
}

class TestPresenter {
	
	private $message;
	
	function __construct($message) {
		$this->message = $message;
	}
	
	function getMessage() {
		return $this->message;
	}
	
}