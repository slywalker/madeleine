<div id="main">
	<div class="posts view">
		<h2><?php  __('Post');?></h2>
		<dl>
			<?php
			$lists = array();
			$lists[] = array('dt' => __('Id', true), 'dd' => h($post['Post']['id']));
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
	<div class="block notice">
		<h4>Notice Title</h4>
		<p>Morbi posuere urna vitae nunc. Curabitur ultrices, lorem ac aliquam blandit, lectus eros hendrerit eros, at eleifend libero ipsum hendrerit urna. Suspendisse viverra. Morbi ut magna. Praesent id ipsum. Sed feugiat ipsum ut felis. Fusce vitae nibh sed risus commodo pulvinar. Duis ut dolor. Cras ac erat pulvinar tortor porta sodales. Aenean tempor venenatis dolor.</p>
	</div>
</div>
