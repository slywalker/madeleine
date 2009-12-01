<?php $this->pageTitle = __('Add Post', true);?>
<div id="main">
	<div class="posts form">
		<?php
		echo $form->create('Post');
		echo $form->inputs(array(
			'legend' => __('Add Post', true),
			'que' => array('label' => __('Que', true), 'dateFormat' => 'YMD', 'monthNames' => false, 'timeFormat' => '24', 'interval' => 10),
			'subject' => array('label' => __('Subject', true)),
			'body' => array('label' => __('Body', true), 'rows' => 20),
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
		$li[] = $html->link(__('List Posts', true), array('action' => 'index'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
