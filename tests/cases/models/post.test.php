<?php 
/* SVN FILE: $Id$ */
/* Post Test cases generated on: 2009-11-27 12:11:27 : 1259293347*/
App::import('Model', 'Post');

class PostTestCase extends CakeTestCase {
	public $Post = null;
	public $fixtures = array('app.post');

	public function startTest() {
		$this->Post =& ClassRegistry::init('Post');
	}

	public function testPostInstance() {
		$this->assertTrue(is_a($this->Post, 'Post'));
	}

	public function testPostFind() {
		$this->Post->recursive = -1;
		$results = $this->Post->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Post' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'subject'  => 'Lorem ipsum dolor sit amet',
			'body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'que'  => '2009-11-27 12:42:27',
			'sended'  => '2009-11-27 12:42:27',
			'created'  => '2009-11-27 12:42:27'
		));
		$this->assertEqual($results, $expected);
	}
}
?>