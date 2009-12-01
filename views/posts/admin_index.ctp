<?php $this->pageTitle = __('List Posts', true);?>
<div id="main">
	<?php echo $form->create(null, array('action' => 'delete'));?>
	<div class="posts index">
		<h2><?php __('Posts');?></h2>
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
			$th[] = $appPaginator->sort(__('Subject', true), 'subject');
			$th[] = $appPaginator->sort(__('Que', true), 'que');
			$th[] = $appPaginator->sort(__('Sended', true), 'sended');
			$th[] = $appPaginator->sort(__('Created', true), 'created');
			$th[] = __('Actions', true);
			echo $html->tableHeaders($th);
			foreach ($posts as $key => $post) {
				$td = array();
				if (empty($post['Post']['sended'])) {
					$td[] = $form->checkbox('delete.'.$key, array('value' => $post['Post']['id']));
				} else {
					$td[] = null;
				}
				$td[] = h($post['Post']['subject']);
				$td[] = $time->format('m-d H:i', $post['Post']['que']);
				$td[] = $time->format('m-d H:i', $post['Post']['sended']);
				$td[] = $time->format('m-d H:i', $post['Post']['created']);
				$actions = array();
				$actions[] = $html->link(__('View', true), array('action' => 'view', $post['Post']['id']));
				if (empty($post['Post']['sended'])) {
					$actions[] = $html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id']));
					$actions[] = $html->link(__('Delete', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id']));
				}
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
	<div class="block">
		<h3><?php __('Actions');?></h3>
		<?php
		$li = array();
		$li[] = $html->link(__('New Post', true), array('action' => 'add'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
