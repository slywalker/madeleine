<?php
class Template extends AppModel {

	public $name = 'Template';
	public $order = array('Template.created' => 'DESC');
	public $validate = array(
		'name' => array('notempty'),
		'body' => array('notempty')
	);

}
?>