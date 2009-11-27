<div id="main">
	<div class="users form">
		<?php
		echo $form->create('User', array('action' => 'register'));
		echo $form->inputs(array(
			'legend' => __('Register', true),
			'email',
		));
		echo $form->end(__('Submit', true));
		?>
	</div>
</div>
<div id="sidebar">
	<div class="block">
		<h3><?php __('Actions');?></h3>
		<?php
		$li = array();
		$li[] = $html->link(__('Cancel', true), array('action' => 'cancel'));
		echo $html->nestedList($li, array('class' => 'navigation'));
		?>
	</div>
</div>
