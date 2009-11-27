<?php
class Post extends AppModel {

	public $name = 'Post';
	public $validate = array(
		'subject' => array('notEmpty'),
		'body' => array('notEmpty'),
	);

}
?>