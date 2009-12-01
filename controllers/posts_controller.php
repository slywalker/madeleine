<?php
class PostsController extends AppController {
	public $name = 'Posts';

	public function admin_index() {
		$this->set('posts', $this->paginate());
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	public function admin_add() {
		if ($this->data) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true), 'default', array('class' => 'message success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && !$this->data) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->data) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true), 'default', array('class' => 'message success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		} else {
			$this->data = $this->Post->read(null, $id);
			if ($this->data['Post']['sended']) {
				$this->Session->setFlash(__('The Post alredy sended.', true));
				$this->redirect(array('action'=>'index'));
			}
		}
	}

	public function admin_delete($id = null) {
		if (!$id) {
			if (isset($this->data['delete'])) {
				if ($this->Post->deleteAll(array('Post.id' => $this->data['delete']))) {
					$this->Session->setFlash(__('Post deleted', true), 'default', array('class' => 'message success'));
				}
			}
		} else {
			if ($this->Post->delete($id)) {
				$this->Session->setFlash(__('Post deleted', true), 'default', array('class' => 'message success'));
			}
		}
		$this->redirect(array('action'=>'index'));
	}

}
?>