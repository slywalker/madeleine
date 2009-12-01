<?php
/**
 * user.php
 *
 * @package Madeleine
 * @author Yasuo Harada
 * @copyright 2009 SLYWALKER Co,.Ltd.
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @date $LastChangedDate$
 * @version $Rev$
 **/

/**
 * User
 **/
class User extends AppModel {

	public $name = 'User';
	public $validate = array(
		'email' => array(
			array(
				'rule' => array('checkCompare', '_confirm'),
				'message' => 'This field is differ with confirm',
			),
			array(
				'rule' => array('email'),
				'message' => 'This field needs email format',
			),
			array(
				'rule' => array('isUnique'),
				'message' => 'This field must be unique',
			),
			array(
				'rule' => array('notEmpty'),
				'message' => 'This field is required',
			),
		),
		'disabled' => array('numeric'),
	);

	/**
	 * $__expires
	 *
	 * @var string
	 */
	private $__expires = '+1 hour';

	/**
	 * register
	 *
	 * @param string $email 
	 * @return mixed On success Model::$data if its not empty or true, false on failure
	 */
	public function register($email) {
		// 期限切れregister削除
		$conditions = array(
			'NOT' => array($this->alias.'.email_checkcode' => null),
			$this->alias.'.disabled' => 1,
			$this->alias.'.expires <' => date('Y-m-d H:i:s'),
		);
		$this->deleteAll($conditions);
		// データ追加
		$data = array();
		$data[$this->alias]['email'] = $email;
		$data[$this->alias]['email_checkcode'] = String::uuid();
		$data[$this->alias]['disabled'] = 1;
		$data[$this->alias]['expires'] = date('Y-m-d H:i:s', strtotime('now '.$this->__expires));
		$this->create();
		return $this->save($data);
	}

	/**
	 * cancel
	 *
	 * @param string $email 
	 * @return mixed On success Model::$data if its not empty or true, false on failure
	 */
	public function cancel($id) {
		// 期限切れcancel削除
		$conditions = array(
			'NOT' => array($this->alias.'.email_checkcode' => null),
			$this->alias.'.disabled' => 0,
			$this->alias.'.expires <' => date('Y-m-d H:i:s'),
		);
		$this->deleteAll($conditions);
		// id確認
		if (!$id) {
			return false;
		}
		// データ更新
		$data = array();
		$data[$this->alias]['id'] = $id;
		$data[$this->alias]['email_checkcode'] = String::uuid();
		$data[$this->alias]['expires'] = date('Y-m-d H:i:s', strtotime('now '.$this->__expires));
		return $this->save($data);
	}

	/**
	 * __findEmailCheckcode
	 *
	 * @param string $emailCheckcode 
	 * @return array Array of records
	 */
	protected function __findEmailCheckcode($emailCheckcode) {
		// checkcode存在確認
		$conditions = array(
			$this->alias.'.email_checkcode' => $emailCheckcode,
			$this->alias.'.expires >' => date('Y-m-d H:i:s'),
		);
		return $this->find('first', compact('conditions'));
	}

	/**
	 * confirmRegister
	 *
	 * @param string $emailCheckcode 
	 * @return mixed On success Model::$data if its not empty or true, false on failure
	 */
	public function confirmRegister($emailCheckcode) {
		$data = $this->find('emailCheckcode', $emailCheckcode);
		if (!$data) {
			return false;
		}
		// データ更新
		$_data = array(
			$this->alias => array(
				'id' => $data[$this->alias]['id'],
				'email_checkcode' => '',
				'disabled' => 0,
				'expires' => null,
			)
		);
		return $this->save($_data, false, array('id', 'email_checkcode', 'disabled', 'expires'));
	}

	/**
	 * confirmDelete
	 *
	 * @param string $emailCheckcode 
	 * @return mixed On success Model::$data if its not empty or true, false on failure
	 */
	public function confirmDelete($emailCheckcode) {
		$data = $this->find('emailCheckcode', $emailCheckcode);
		if (!$data) {
			return false;
		}
		if (!$this->delete($data[$this->alias]['id'])) {
			return false;
		}
		return $data[$this->alias]['email'];
	}

	/**
	 * countUpError
	 *
	 * @param string $email 
	 * @return boolen
	 */
	public function countUpError($email) {
		$conditions = array('User.email' => $email);
		$fields = array('id', 'error');
		$user = $this->find('first', compact('conditions', 'fields'));
		if (!$user) {
			return false;
		}
		$this->id = $user['User']['id'];
		$error = $user['User']['error'] + 1;
		return $this->saveField('error', $error);
	}

}
?>