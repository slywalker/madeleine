<?php 
/* SVN FILE: $Id$ */
/* PostsController Test cases generated on: 2009-11-27 12:11:27 : 1259293347*/
App::import('Controller', 'Posts');

class TestPosts extends PostsController {
	public $autoRender = false;
}

class PostsControllerTest extends CakeTestCase {
	public $Posts = null;

	public function startTest() {
		$this->Posts = new TestPosts();
		$this->Posts->constructClasses();
	}

	public function testPostsControllerInstance() {
		$this->assertTrue(is_a($this->Posts, 'PostsController'));
	}

	public function endTest() {
		unset($this->Posts);
	}
}
?>