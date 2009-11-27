<div id="main">
	<div class="users form">
		<?php
		echo $form->create('User', array('action' => 'cancel'));
		echo $form->inputs(array(
			'legend' => __('Cancel', true),
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
		$li[] = $html->link(__('Register', true), array('action' => 'register'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
