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

	public function delete($id = null, $cascade = true) {
		$sended = $this->field('sended', array('Post.id' => $id));
		if ($sended) {
			return false;
		}
		return parent::delete($id, $cascade);
	}

}
?>