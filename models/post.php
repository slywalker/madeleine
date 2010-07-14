<?php
class Post extends AppModel {

	public $name = 'Post';
	public $order = array('Post.que' => 'DESC');
	public $validate = array(
		'subject' => array('notEmpty'),
		'body' => array('notEmpty'),
	);

	public function beforeValidate() {
		if ($this->data['Post']['body']) {
			$this->data['Post']['body'] = mb_convert_kana($this->data['Post']['body'], 'KV');
		}
	}

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