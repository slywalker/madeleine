<div id="main">
	<div class="posts view">
		<h2><?php  __('Post');?></h2>
		<dl>
			<?php
			$lists = array();
			$lists[] = array('dt' => __('Subject', true), 'dd' => h($post['Post']['subject']));
			$lists[] = array('dt' => __('Body', true), 'dd' => h($post['Post']['body']));
			$lists[] = array('dt' => __('Que', true), 'dd' => h($post['Post']['que']));
			$lists[] = array('dt' => __('Sended', true), 'dd' => h($post['Post']['sended']));
			$lists[] = array('dt' => __('Created', true), 'dd' => h($post['Post']['created']));
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
		$li[] = $html->link(__('Edit Post', true), array('action' => 'edit', $post['Post']['id']));
		$li[] = $html->link(__('Delete Post', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id']));
		$li[] = $html->link(__('List Posts', true), array('action' => 'index'));
		$li[] = $html->link(__('New Post', true), array('action' => 'add'));
		echo $html->nestedList($li, array('class'=>'navigation'));
		?>
	</div>
</div>
