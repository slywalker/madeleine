<?php 
/* SVN FILE: $Id$ */
/* UsersController Test cases generated on: 2009-11-27 12:11:12 : 1259293452*/
App::import('Controller', 'Users');

class TestUsers extends UsersController {
	public $autoRender = false;
}

class UsersControllerTest extends CakeTestCase {
	public $Users = null;

	public function startTest() {
		$this->Users = new TestUsers();
		$this->Users->constructClasses();
	}

	public function testUsersControllerInstance() {
		$this->assertTrue(is_a($this->Users, 'UsersController'));
	}

	public function endTest() {
		unset($this->Users);
	}
}
?>