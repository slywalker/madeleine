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
		$Receiver = QdmailReceiver::start('stdin');
		$Receiver->getMail();
		$email = $Receiver->header(array('from', 'mail'));
		if ($email) {
			$this->User->begin();
			if ($user = $this->User->register($email)) {
				// sendmail
				$this->controller->set(compact('user'));
				if ($this->__send($user['User']['email'], __('Confirm Register', true), 'confirm_register')) {
					$this->User->commit();
					$this->out('OK');
					return;
				}
			}
			$this->User->rollback();
		}
	}

	private function __send($to, $subject, $template = 'default', $config = 'default') {
		$this->Qdmail = new QdmailComponent(null);
		$this->Qdmail->startup($this->controller);
		
		if (config('smtp')) {
			$params = SMTP_CONFIG::$$config;
			$this->Qdmail->smtp(true);
			$this->Qdmail->smtpServer($params);
		}
		
		//$this->Qdmail->debug(2);
		$this->Qdmail->to($to);
		$this->Qdmail->from($params['from']);
		$this->Qdmail->subject($subject);
		
		$this->controller->view = 'View';
		$this->Qdmail->cakeText(null, $template, null, null, 'iso-2022-jp');
		
		return $this->Qdmail->send();
	}

}
?>