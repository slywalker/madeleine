<?php
App::import('Core', 'Controller');
App::import('Component', 'Qdsmtp');
App::import('Component', 'Qdmail');

class SendTask extends Shell {

	public $uses = array('User', 'Post');
	private $postConditions = array();

	public function startup(){
		$this->postConditions = array(
			'sended' => null,
			'que <=' => date('Y-m-d H:i:s'),
		);
	}

	public function execute() {
		$count = $this->__countPosts();
		
		if ($count > 0) {
			$this->__sendPosts($count);
		}
	}

	private function __sqlNoCache($conditions) {
		$dummy = String::uuid();
		return $conditions + array("'".$dummy."' = '".$dummy."'");
	}

	private function __countPosts() {
		$conditions = $this->__sqlNoCache($this->postConditions);
		$count = $this->Post->find('count', compact('conditions'));
		if ($count == 0) {
			$this->out('Posts are not exists!!!');
			CakeLog::write('sandmail', 'Posts are not exists.');
		} else {
			$this->out(sprintf('%s posts exists.', intval($count)));
			CakeLog::write('sandmail', sprintf('Send start!!! %s posts exists.', intval($count)));
		}
		return $count;
	}

	private function __sendPosts($count) {
		$this->controller = new Controller();
		$this->Qdmail = new QdmailComponent(null);
		$this->Qdmail->startup($this->controller);

		$sended = 0;
		for ($i = 0; $i < $count; $i++) {
			$conditions = $this->__sqlNoCache($this->postConditions);
			$offset = $i;
			$post = $this->Post->find('first', compact('conditions', 'offset'));
			
			$success = $this->__sendUsers($post);
			if ($success) {
				$this->Post->modifySended($post['Post']['id']);
			}
			$sended += $success;
		}
		$this->out(sprintf('Sended total %s mails.', $sended));
		CakeLog::write('sandmail', sprintf('Send Finsh!!! total %s mails.', intval($count), $sended));
		
		return $sended;
	}

	private function __sendUsers($post) {
		$userConditions = array('disabled' => 0);
		$success = 0;
		$miss = 0;

		$conditions = $this->__sqlNoCache($userConditions);
		$count = $this->User->find('count', compact('conditions'));
		if ($count) {
			config('smtp');
			$params = SMTP_CONFIG::$default;
			$this->Qdmail->smtp(true);
			$this->Qdmail->smtpServer($params);
			//$this->Qdmail->debug(2);
			$this->Qdmail->from($params['from']);
			$this->Qdmail->subject($post['Post']['subject']);
			$this->Qdmail->body('text', $post['Post']['body'], null, 'iso-2022-jp');

			for ($i = 0; $i < $count; $i++) {
				$conditions = $this->__sqlNoCache($userConditions);
				$fields = array('email');
				$offset = $i;
				$user = $this->User->find('first', compact('conditions', 'fields', 'offset'));
				$this->Qdmail->to($user['User']['email']);
				if ($this->Qdmail->send()) {
					$success++;
				} else {
					$miss++;
					CakeLog::write('sandmail', sprintf('miss: %s', $user['User']['email']));
				}
			}
			$this->out(sprintf('Send mails. success: %s, miss: %s', $success, $miss));
			CakeLog::write('sandmail', sprintf('Send mails. success: %s, miss: %s.', $success, $miss));
		}
		return $success;
	}

}
?>