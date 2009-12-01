<?php
App::import('Core', array('Router', 'Controller'));
App::import('Component', array('Qdsmtp', 'Qdmail'));
App::import('Vendor', 'QdmailReceiver', array('file' => 'qdmail_receiver.php'));

class RegisterTask extends Shell {

	public $uses = array('User');
	public $controller = null;

	public function startup(){
		$this->controller = new Controller();
	}

	public function execute() {
		$receiver = QdmailReceiver::start('stdin');
		$receiver->getMail();
		$email = $receiver->header(array('from', 'mail'));
		if ($email) {
			$this->User->begin();
			if ($user = $this->User->register($email)) {
				// sendmail
				$this->controller->set(compact('user'));
				if ($this->__send($user['User']['email'], __('Confirm Register', true), 'confirm_register')) {
					$this->User->commit();
					return;
				}
			}
			$this->User->rollback();
		}
	}

	private function __send($to, $subject, $template = 'default', $config = 'default') {
		$qdmail = new QdmailComponent(null);
		$qdmail->startup($this->controller);
		
		config('smtp');
		$params = SMTP_CONFIG::$$config;
		$qdmail->smtp(true);
		$qdmail->smtpServer($params);
		
		//$qdmail->debug(2);
		$qdmail->to($to);
		$qdmail->from($params['from']);
		$qdmail->subject($subject);
		
		$this->controller->view = 'View';
		$qdmail->cakeText(null, $template, null, null, 'iso-2022-jp');
		
		return $qdmail->send();
	}

}
?>