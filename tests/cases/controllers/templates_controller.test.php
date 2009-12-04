<?php 
/* SVN FILE: $Id$ */
/* TemplatesController Test cases generated on: 2009-12-04 16:12:23 : 1259911403*/
App::import('Controller', 'Templates');

class TestTemplates extends TemplatesController {
	public $autoRender = false;
}

class TemplatesControllerTest extends CakeTestCase {
	public $Templates = null;

	public function startTest() {
		$this->Templates = new TestTemplates();
		$this->Templates->constructClasses();
	}

	public function testTemplatesControllerInstance() {
		$this->assertTrue(is_a($this->Templates, 'TemplatesController'));
	}

	public function endTest() {
		unset($this->Templates);
	}
}
?>