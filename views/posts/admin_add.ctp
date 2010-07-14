<?php
$this->pageTitle = __('Add Post', true);

$javascript->link('jquery-1.3.2.min', false);
$url = $html->url(array('controller' => 'templates', 'action' => 'get_ajax'));
$confirmMessage = __('Append to Body. OK?', true);
$code = <<<EOT
$(function(){
	$('select#PostTemplate').change(function () {
		var value = $('select#PostTemplate option:selected').val();
		if (value) {
			ret = confirm('$confirmMessage');
			if (ret == true){
				$.get('$url/' + value + '/subject', function(html) {
					$('#PostSubject').val(html);
				});
				$.get('$url/' + value + '/body', function(html) {
					$('#PostBody').val(html);
				});
			}
		}
	});
});
EOT;
$javascript->codeBlock($code, array('inline' => false));
?>
<div id="main">
	<div class="posts form">
		<?php
		echo $form->create('Post');
		echo $form->inputs(array(
			'legend' => __('Add Post', true),
			'que' => array('label' => __('Que', true), 'dateFormat' => 'YMD', 'monthNames' => false, 'timeFormat' => '24', 'interval' => 10),
			'template' => array('label' => __('Template', true), 'options' => $templates, 'empty' => ''),
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
