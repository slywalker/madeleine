<?php
class TemplatesController extends AppController {
	public $name = 'Templates';
	public $components = array('RequestHandler');

	public function admin_index() {
		$this->paginate = array(
			'order' => array('Template.created' => 'DESC'),
		);
		$this->set('templates', $this->paginate());
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Template', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('template', $this->Template->read(null, $id));
	}

	public function admin_add() {
		if ($this->data) {
			$this->Template->create();
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(__('The Template has been saved', true), 'default', array('class' => 'message success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Template could not be saved. Please, try again.', true));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && !$this->data) {
			$this->Session->setFlash(__('Invalid Template', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->data) {
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(__('The Template has been saved', true), 'default', array('class' => 'message success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Template could not be saved. Please, try again.', true));
			}
		} else {
			$this->data = $this->Template->read(null, $id);
		}
	}

	public function admin_delete($id = null) {
		if (!$id) {
			if (isset($this->data['delete'])) {
				if ($this->Template->deleteAll(array('Template.id' => $this->data['delete']))) {
					$this->Session->setFlash(__('Template deleted', true), 'default', array('class' => 'message success'));
				}
			}
		} else {
			if ($this->Template->delete($id)) {
				$this->Session->setFlash(__('Template deleted', true), 'default', array('class' => 'message success'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}

	public function admin_get_ajax($id = null, $field = 'body') {
		if (!$this->RequestHandler->isAjax()) {
			$this->cakeError('error404');
		}
		if (!$id || !$body = $this->Template->field($field, array('Template.id' => $id))) {
			$this->cakeError('error404');
		}
		$this->set(compact('body'));
	}
}
?>