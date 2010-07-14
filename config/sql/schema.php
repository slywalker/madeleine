<?php 
/* SVN FILE: $Id$ */
/* Madeleine schema generated on: 2010-01-26 12:01:49 : 1264475149*/
class MadeleineSchema extends CakeSchema {
	var $name = 'Madeleine';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $posts = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'subject' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'que' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'sended' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'que' => array('column' => 'que', 'unique' => 0), 'sended' => array('column' => 'sended', 'unique' => 0), 'created' => array('column' => 'created', 'unique' => 0))
	);
	var $templates = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'subject' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'created' => array('column' => 'created', 'unique' => 0), 'created_2' => array('column' => 'created', 'unique' => 0))
	);
	var $users = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'expires' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'email_checkcode' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'disabled' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'error' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'email' => array('column' => 'email', 'unique' => 0), 'expires' => array('column' => 'expires', 'unique' => 0), 'email_checkcode' => array('column' => 'email_checkcode', 'unique' => 0), 'disabled' => array('column' => 'disabled', 'unique' => 0), 'error' => array('column' => 'error', 'unique' => 0))
	);
}
?>