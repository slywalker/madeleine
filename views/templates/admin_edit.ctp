<?php $this->pageTitle = __('Edit Template', true);?>
<div id="main">
	<div class="templates form">
		<?php
		echo $form->create('Template');
		echo $form->inputs(array(
			'legend' => __('Edit Template', true),
			'id',
			'name' => array('label' => __('Template Name', true)),
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
		$li[] =$html->link(__('Delete', true), array('action' => 'delete', $form->value('Template.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Template.id')));
		$li[] = $html->link(__('List Templates', true), array('action' => 'index'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>