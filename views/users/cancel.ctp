<?php
$this->layout = 'simple';
$this->pageTitle = __('Cancel', true);
?>
<div class="users form">
	<?php
	echo $form->create('User', array('action' => 'cancel'));
	echo $form->inputs(array(
		'legend' => __('Cancel', true),
		'email' => array('label' => __('Email', true)),
	));
	echo $form->end(__('Submit', true));
	?>
</div>
<div class="block">
	<?php echo $html->link(__('Register', true), array('action' => 'register'));?>
</div>
