<?php
App::import('Vendor', 'QdmailReceiver', array('file' => 'qdmail_receiver.php'));

class ErrorTask extends Shell {

	public $uses = array('User');
	public $controller = null;

	public function startup() {
	}

	public function execute() {
		config('mail');
		$params = MAIL_CONFIG::$pop;
		$receiver = QdmailReceiver::start('pop', $params);
		
		$count = $receiver->count();
		if (!$count) {
			return;
		}
		
		for($i = 1; $i <= $count; $i++) {
			$body = $receiver->text();
			$this->__countUpError($body);
			$receiver->delete();
			$receiver->next();
		}
		$receiver->done();
		
		$this->__deleteUser();
	}

	private function __countUpError($body) {
		$count = 0;
		$email_regix = "/([_\w\.\-\"]+@[_0-9a-zA-Z\.\-]+\.[a-zA-Z]+)/";
		preg_match_all($email_regix, $body, $match);
		if ($match[1]) {
			$emails = array_unique($match[1]);
			foreach ($emails as $email) {
				$email = str_replace('"', '', $email);
				if ($this->User->countUpError($email)) {
					CakeLog::write('errormail', sprintf('Return Error Mail!!! %s', $email));
					$count++;
				}
			}
		}
		return $count;
	}

	private function __deleteUser() {
		$conditions = array('User.error >=' => 3);
		$fields = array('email');
		$this->User->begin();
		$users = $this->User->find('all', compact('conditions', 'fields'));
		if (!$this->User->deleteAll($conditions)) {
			$this->User->rollback();
			return false;
		}
		foreach ($users as $user) {
			CakeLog::write('errormail', sprintf('Delete Error User!!! %s', $user['User']['email']));
		}
		$this->User->commit();
		return true;
	}
}
?>