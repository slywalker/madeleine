<?php $this->pageTitle = __('View Template', true);?>
<div id="main">
	<div class="templates view">
		<h2><?php  __('Template');?></h2>
		<dl>
			<?php
			$lists = array();
			$lists[] = array('dt' => __('Template Name', true), 'dd' => h($template['Template']['name']));
			$lists[] = array('dt' => __('Body', true), 'dd' => h($template['Template']['body']));
			foreach ($lists as $key => $list) {
				$class = array();
				if ($key % 2 == 0) {
					$class = array('class' => 'altrow');
				}
				echo $html->tag('dt', $list['dt'], $class);
				echo $html->tag('dd', $list['dd'].'&nbsp;', $class);
			}
			?>
		</dl>
	</div>
</div>
<div id="sidebar">
	<div class="block">
		<h3><?php __('Actions');?></h3>
		<?php
		$li = array();
		$li[] = $html->link(__('Edit Template', true), array('action' => 'edit', $template['Template']['id']));
		$li[] = $html->link(__('Delete Template', true), array('action' => 'delete', $template['Template']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $template['Template']['id']));
		$li[] = $html->link(__('List Templates', true), array('action' => 'index'));
		$li[] = $html->link(__('New Template', true), array('action' => 'add'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
