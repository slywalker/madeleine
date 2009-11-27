<div id="main">
	<?php echo $form->create(null, array('action' => 'delete'));?>
	<div class="users index">
		<h2><?php __('Users');?></h2>
		<p>
			<?php
			echo $paginator->counter(array(
				'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			));
			?>
		</p>
		<p><?php echo $appPaginator->limit();?></p>
		<table>
			<?php
			$th = array();
			$th[] = __('Del', true);
			$th[] = $appPaginator->sort('email');
			$th[] = $appPaginator->sort('expires');
			$th[] = $appPaginator->sort('email_checkcode');
			$th[] = $appPaginator->sort('disabled');
			$th[] = $appPaginator->sort('modified');
			$th[] = $appPaginator->sort('created');
			$th[] = __('Actions', true);
			echo $html->tableHeaders($th);
			foreach ($users as $key => $user) {
				$td = array();
				$td[] = $form->checkbox('delete.'.$key, array('value' => $user['User']['id']));
				$td[] = h($user['User']['email']);
				$td[] = h($user['User']['expires']);
				$td[] = h($user['User']['email_checkcode']);
				$td[] = h($user['User']['disabled']);
				$td[] = h($user['User']['modified']);
				$td[] = h($user['User']['created']);
				$actions = array();
				$actions[] = $html->link(__('View', true), array('action' => 'view', $user['User']['id']));
				$actions[] = $html->link(__('Edit', true), array('action' => 'edit', $user['User']['id']));
				$actions[] = $html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id']));
				$td[] = array(implode('&nbsp;|&nbsp;', $actions), array('class' => 'actions'));
				echo $html->tableCells($td, array('class' => 'altrow'));
			}
			?>
		</table>
	</div>
	<div class="actions-bar">
		<div class="actions">
			<?php echo $form->submit(__('Delete Selected', true), array('div' => false));?>
		</div>
		<div class="pagination">
			<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
			<?php echo $paginator->numbers(array('separator' => null));?>
			<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
		</div>
		<div class="clear"></div>
	</div>
	<?php echo $form->end();?>
</div>
<div id="sidebar">
</div>
