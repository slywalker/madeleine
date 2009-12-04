<?php $this->pageTitle = __('List Templates', true);?>
<div id="main">
	<?php echo $form->create(null, array('action' => 'delete'));?>
	<div class="templates index">
		<h2><?php __('Templates');?></h2>
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
			$th[] = $appPaginator->sort(__('Template Name', true), 'name');
			$th[] = __('Actions', true);
			echo $html->tableHeaders($th);
			foreach ($templates as $key => $template) {
				$td = array();
				$td[] = $form->checkbox('delete.'.$key, array('value' => $template['Template']['id']));
				$td[] = h($template['Template']['name']);
				$actions = array();
				$actions[] = $html->link(__('View', true), array('action' => 'view', $template['Template']['id']));
				$actions[] = $html->link(__('Edit', true), array('action' => 'edit', $template['Template']['id']));
				$actions[] = $html->link(__('Delete', true), array('action' => 'delete', $template['Template']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $template['Template']['id']));
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
	</form>
</div>
<div id="sidebar">
	<div class="block">
		<h3><?php __('Actions');?></h3>
		<?php
		$li = array();
		$li[] = $html->link(__('New Template', true), array('action' => 'add'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
