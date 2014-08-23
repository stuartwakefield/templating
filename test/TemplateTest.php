<?php
require_once 'mocks/TestPresenter.php';

class TemplateTest extends PHPUnit_Framework_TestCase {
	
	function testRender() {
		$template = new Templating\Template('templates/test.php');
		$this->assertEquals('<p>Hello, Test</p>', trim($template->fill(array(
			'message' => 'Hello, Test'
		))));
	}
	
	function testPresenterRender() {
		$template = new Templating\Template('templates/test_presenter.php');
		$presenter = new TestPresenter('Hello, Presenter Test');
		$this->assertEquals('<p>Hello, Presenter Test</p>', trim($template->fill($presenter)));
	}
	
	function testPresenterReadOnly() {
		$this->setExpectedException('Templating\Exception');
		$template = new Templating\Template('templates/test_presenter_read_only.php');
		$template->fill(new TestPresenter(null));
	}

	function testRenderWithExceptionCleansUpOutputBuffer() {

		// get the level before
		$before = ob_get_level();

		try {
			$template = new Templating\Template('templates/test_exception.php');
			$template->fill(array());
		} catch (Exception $ex) {}
		
		// and the level after
		$after = ob_get_level();

		// escape all extraneous output buffers
		while (ob_get_level() > $before) ob_end_clean();

		$this->assertEquals($after, $before);
	}
	
}
