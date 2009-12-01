<?php
$this->layout = 'simple';
$this->pageTitle = __('Register', true);
?>
<div class="users form">
	<?php
	echo $form->create('User', array('action' => 'register'));
	echo $form->inputs(array(
		'legend' => __('Register', true),
		'email' => array('label' => __('Email', true)),
	));
	echo $form->end(__('Submit', true));
	?>
</div>
<div class="block">
	<?php echo $html->link(__('Cancel', true), array('action' => 'cancel'));?>
</div>
