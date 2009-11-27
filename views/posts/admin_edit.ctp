<div id="main">
	<div class="posts form">
		<?php
		echo $form->create('Post');
		echo $form->inputs(array(
			'legend' => __('Edit Post', true),
			'id',
			'subject',
			'body',
			'que',
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
		$li[] =$html->link(__('Delete', true), array('action' => 'delete', $form->value('Post.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Post.id')));
		$li[] = $html->link(__('List Posts', true), array('action' => 'index'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
