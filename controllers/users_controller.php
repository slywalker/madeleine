<?php
/**
 * user_controller.php
 *
 * @package Madeleine
 * @author Yasuo Harada
 * @copyright 2009 SLYWALKER Co,.Ltd.
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @date $LastChangedDate$
 * @version $Rev$
 **/

/**
 * UserController
 **/
class UsersController extends AppController {
	public $name = 'Users';
	public $components = array('RequestHandler', 'Qdmail');

	/**
	 * admin_index
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->set('users', $this->paginate());
	}

	/**
	 * admin_delete
	 *
	 * @param string $id 
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$id) {
			if (isset($this->data['delete'])) {
				if ($this->User->deleteAll(array('User.id' => $this->data['delete']))) {
					$this->Session->setFlash(__('User deleted', true), 'default', array('class' => 'message success'));
				}
			}
		} else {
			if ($this->User->delete($id)) {
				$this->Session->setFlash(__('User deleted', true), 'default', array('class' => 'message success'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * register
	 *
	 * @return void
	 */
	public function register() {
		if ($this->data) {
			$this->User->begin();
			if ($user = $this->User->register($this->data['User']['email'])) {
				// sendmail
				$this->set(compact('user'));
				if ($this->_send($user['User']['email'], __('Confirm Register', true), 'confirm_register')) {
					$this->User->commit();
					if ($this->RequestHandler->isAjax()) {
						$this->set('success', __('A confirm mail has been sent', true));
					} else {
						$this->flash(__('A confirm mail has been sent', true), array('action' => 'index'));
					}
					return;
				}
			}
			$this->User->rollback();
			$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
		}
		
		if (!$this->RequestHandler->isAjax()) {
			$this->layout = 'simple';
		}
	}

	/**
	 * cancel
	 *
	 * @return void
	 */
	public function cancel() {
		if (!empty($this->data['User']['email'])) {
			$conditions = array('User.email' => $this->data['User']['email']);
			$user = $this->User->find('first', compact('conditions'));
			$this->User->begin();
			if ($user && $_user = $this->User->cancel($user['User']['id'])) {
				$user = Set::merge($user, $_user);
				// sendmail
				$this->set(compact('user'));
				if ($this->_send($user['User']['email'], __('Confirm Cancel', true), 'confirm_cancel')) {
					$this->User->commit();
					if ($this->RequestHandler->isAjax()) {
						$this->set('success', __('A confirm mail has been sent', true));
					} else {
						$this->flash(__('A confirm mail has been sent', true), array('action' => 'index'));
					}
					return;
				}
			}
			$this->User->rollback();
			$this->Session->setFlash(__('Invalid Email', true));
		}
		
		if (!$this->RequestHandler->isAjax()) {
			$this->layout = 'simple';
		}
	}

	/**
	 * confirm_register
	 *
	 * @param string $emailCheckcode 
	 * @return void
	 */
	public function confirm_register($emailCheckcode = null) {
		if ($this->User->confirmRegister($emailCheckcode)) {
			$this->flash(__('Confirm has been success', true), array('action' => 'index'));
			return;
		}
		$this->flash(__('Invalid URL', true), array('action' => 'index'));
	}

	/**
	 * confirm_cancel
	 *
	 * @param string $emailCheckcode 
	 * @return void
	 */
	public function confirm_cancel($emailCheckcode = null) {
		if ($emailCheckcode) {
			$email = $this->User->confirmDelete($emailCheckcode);
			if ($email) {
				$this->flash(__('Your Email has cancelled', true), array('action' => 'index'));
				CakeLog::write('cancel', $email);
				return;
			}
		}
		$this->flash(__('Invalid URL', true), array('action' => 'index'));
	}

	/**
	 * _send
	 *
	 * @param string $to 
	 * @param string $subject 
	 * @param string $template 
	 * @param string $config 
	 * @return boolean
	 */
	protected function _send($to, $subject, $template = 'default') {
		config('mail');
		$params = MAIL_CONFIG::$smtp;
		$this->Qdmail->smtp(true);
		$this->Qdmail->smtpServer($params);
		//$this->Qdmail->debug(2);
		$this->Qdmail->to($to);
		$this->Qdmail->from($params['from']);
		$this->Qdmail->subject($subject);
		
		$view = $this->view;
		$this->view = 'View';
		$this->Qdmail->cakeText(null, $template, null, null, 'iso-2022-jp');
		$this->view = $view;
		
		return $this->Qdmail->send();
	}

}
?>