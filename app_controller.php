<?php
class AppController extends Controller {

	public $components = array('Security', 'DebugKit.Toolbar');
	public $helpers = array('Javascript', 'Time', 'AppPaginator');

	/**
	 * beforeFilter
	 *
	 * @return void
	 * @author Yasuo Harada
	 */
	public function beforeFilter() {
		$this->Security->disabledFields = array('delete');
		if (!empty($this->params['admin']) && config('basic')) {
			$users = BASIC_CONFIG::$default;
			$this->Security->loginOptions = array('type' => 'basic');
			$this->Security->loginUsers = $users;
			$this->Security->requireLogin('*');
		}
	}

}
?>