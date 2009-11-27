<?php
App::import('Core', 'Controller');
App::import('Component', 'Qdsmtp');
App::import('Component', 'Qdmail');

class SendShell extends Shell {
	var $uses = array('User', 'Post');
	var $mailParams = array(
		'name' => null,
		'from' => null,
		'subject' => null,
		'body' => null,
	);

	function startup(){
		$this->controller = new Controller();
	}

	function main() {
		$defaultConditions = array(
			'sended' => null,
			'que <=' => date('Y-m-d H:i:s'),
		);
		$dummy = String::uuid();
		$conditions = $defaultConditions + array("'".$dummy."' = '".$dummy."'");
		$count = $this->Post->find('count', compact('conditions'));
		if (!$count) {
			echo "Posts are not exists!!!\n";
			CakeLog::write('sandmail', 'Posts are not exists.');
			return;
		}
		printf("%s posts exists.\n", intval($count));
		CakeLog::write('sandmail', sprintf('Send start!!! %s posts exists.', intval($count)));

		$this->Qdmail = new QdmailComponent(null);
		$this->Qdmail->startup($this->controller);

		$sended = 0;
		for ($i = 0; $i < $count; $i++) {
			$dummy = String::uuid();
			$conditions = $defaultConditions + array("'".$dummy."' = '".$dummy."'");
			$offset = $i;
			$post = $this->Post->find('first', compact('conditions', 'offset'));
			
			$params = array(
				'subject' => $post['Post']['subject'],
				'body' => $post['Post']['body'],
			);
			$this->__setMailParams($params);
			
			$success = $this->__sendUsers();
			if ($success) {
				$this->Post->id = $post['Post']['id'];
				$this->Post->saveField('sended', date('Y-m-d H:i:s'));
			}
			$sended += $success;
		}
		printf("Sended total %s mails.\n", $sended);
		CakeLog::write('sandmail', sprintf('Send Finsh!!! total %s mails.', intval($count), $sended));
	}

	private function __resetMailParams() {
		$this->mailParams = array(
			'name' => null,
			'from' => null,
			'subject' => null,
			'body' => null,
		);
		return;
	}

	private function __setMailParams($params) {
		$this->__resetMailParams();
		$this->mailParams = array_merge($this->mailParams, $params);
		return;
	}
	
	private function __sendUsers() {
		$success = 0;
		$miss = 0;
		if ($this->mailParams) {
			$defaultConditions = array('disabled' => 0);
			$dummy = String::uuid();
			$conditions = $defaultConditions + array("'".$dummy."' = '".$dummy."'");
			$count = $this->User->find('count', compact('conditions'));
			for ($i = 0; $i < $count; $i++) {
				$dummy = String::uuid();
				$conditions = $defaultConditions + array("'".$dummy."' = '".$dummy."'");
				$offset = $i;
				$user = $this->User->find('first', compact('conditions', 'offset'));
				if ($this->__send($user['User']['email'])) {
					$success++;
				} else {
					$miss++;
					CakeLog::write('sandmail', sprintf('miss: %s', $user['User']['email']));
				}
			}
			printf("Send mails. success: %s, miss: %s \n", $success, $miss);
			CakeLog::write('sandmail', sprintf('Send mails. success: %s, miss: %s.', $success, $miss));
		}
		return $success;
	}
	
	private function __send($email) {
		if (config('smtp')) {
			$params = SMTP_CONFIG::$default;
			$this->Qdmail->smtp(true);
			$this->Qdmail->smtpServer($params);
		}
		//$this->Qdmail->debug(2);
		$this->Qdmail->to($email);
		$this->Qdmail->from($params['from'], $this->mailParams['name']);
		$this->Qdmail->subject($this->mailParams['subject']);
		$this->Qdmail->body('text', $this->mailParams['body'], null, 'iso-2022-jp');
		
		return $this->Qdmail->send();
	}
}
?>