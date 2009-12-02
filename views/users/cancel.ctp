<div class="madeleine-cancel">
	<?php
	$this->pageTitle = __('Cancel', true);

	if ($this->params['isAjax']) {
		$code = <<<EOT
$('input[type="submit"]').click(function() {
	$(this).parents('form:first').ajaxSubmit( {
		success: function(responseText, responseCode) {
			$('div.madeleine-register').replaceWith(responseText);
			return false;
		}
	});
	return false;
});
EOT;
		echo $javascript->codeBlock($code);
	}
	?>
	<?php if (!empty($success)) :?>
		<p class="message success"><?php echo h($success);?></p>
	<?php else :?>
		<div class="users form">
			<?php
			$session->flash();
			$url = $html->url(array('action' => 'cancel'), true);
			echo $form->create('User', array('url' => $url));
			echo $form->inputs(array(
				'legend' => __('Cancel', true),
				'email' => array('label' => __('Email', true)),
			));
			echo $form->end(__('Submit', true));
			?>
		</div>
		<?php if (!$this->params['isAjax']) :?>
			<div class="block">
				<?php echo $html->link(__('Register', true), array('action' => 'register'));?>
			</div>
		<?php endif;?>
	<?php endif;?>
</div>