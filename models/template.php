<?php
class Template extends AppModel {

	public $name = 'Template';
	public $order = array('Template.created' => 'DESC');
	public $validate = array(
		'name' => array('notempty'),
		'body' => array('notempty')
	);

	public function beforeValidate() {
		if (isset($this->data['Template']['subject'])) {
			$this->data['Template']['subject'] = mb_convert_kana($this->data['Template']['subject'], 'KV');
		}
		if (isset($this->data['Template']['body'])) {
			$this->data['Template']['body'] = mb_convert_kana($this->data['Template']['body'], 'KV');
		}
	}
}
?>