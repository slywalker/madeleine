<?php 
/* SVN FILE: $Id$ */
/* Template Test cases generated on: 2009-12-04 16:12:23 : 1259911403*/
App::import('Model', 'Template');

class TemplateTestCase extends CakeTestCase {
	public $Template = null;
	public $fixtures = array('app.template');

	public function startTest() {
		$this->Template =& ClassRegistry::init('Template');
	}

	public function testTemplateInstance() {
		$this->assertTrue(is_a($this->Template, 'Template'));
	}

	public function testTemplateFind() {
		$this->Template->recursive = -1;
		$results = $this->Template->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Template' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'subject'  => 'Lorem ipsum dolor sit amet',
			'body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created'  => '2009-12-04 16:23:23'
		));
		$this->assertEqual($results, $expected);
	}
}
?>