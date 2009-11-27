<?php 
/* SVN FILE: $Id$ */
/* Post Fixture generated on: 2009-11-27 12:11:27 : 1259293347*/

class PostFixture extends CakeTestFixture {
	public $name = 'Post';
	public $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'subject' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'body' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'que' => array('type'=>'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'sended' => array('type'=>'datetime', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'que' => array('column' => 'que', 'unique' => 0), 'sended' => array('column' => 'sended', 'unique' => 0), 'created' => array('column' => 'created', 'unique' => 0))
	);
	public $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'subject'  => 'Lorem ipsum dolor sit amet',
		'body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'que'  => '2009-11-27 12:42:27',
		'sended'  => '2009-11-27 12:42:27',
		'created'  => '2009-11-27 12:42:27'
	));
}
?>