<?php 
/* SVN FILE: $Id$ */
/* Template Fixture generated on: 2009-12-04 16:12:23 : 1259911403*/

class TemplateFixture extends CakeTestFixture {
	public $name = 'Template';
	public $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'subject' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'body' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'created' => array('column' => 'created', 'unique' => 0))
	);
	public $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'name'  => 'Lorem ipsum dolor sit amet',
		'subject'  => 'Lorem ipsum dolor sit amet',
		'body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'created'  => '2009-12-04 16:23:23'
	));
}
?>