<?php
$li = array();
$li[] = $html->link(__('Posts', true), array(Configure::read('Routing.admin') => true, 'controller' => 'posts', 'action' => 'index'));
$li[] = $html->link(__('Users', true), array(Configure::read('Routing.admin') => true, 'controller' => 'users', 'action' => 'index'));
echo $html->nestedList($li);
?>