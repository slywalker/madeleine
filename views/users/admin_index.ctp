<div id="main">
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
			$th[] = $appPaginator->sort('disabled');
			$th[] = $appPaginator->sort('email');
			$th[] = $appPaginator->sort('created');
			$th[] = $appPaginator->sort('expires');
			echo $html->tableHeaders($th);
			foreach ($users as $key => $user) {
				$td = array();
				$td[] = h($user['User']['disabled']);
				$td[] = h($user['User']['email']);
				$td[] = h($user['User']['created']);
				$td[] = h($user['User']['expires']);
				echo $html->tableCells($td, array('class' => 'altrow'));
			}
			?>
		</table>
	</div>
	<div class="actions-bar">
		<div class="actions">
		</div>
		<div class="pagination">
			<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
			<?php echo $paginator->numbers(array('separator' => null));?>
			<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div id="sidebar">
</div>
