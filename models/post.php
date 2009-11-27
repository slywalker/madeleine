<?php
class Post extends AppModel {

	public $name = 'Post';
	public $validate = array(
		'subject' => array('notEmpty'),
		'body' => array('notEmpty'),
	);

	public function modifySended($id) {
		$this->id = $id;
		return $this->saveField('sended', date('Y-m-d H:i:s'));
	}
}
?>