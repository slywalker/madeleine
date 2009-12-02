<div class="madeleine-register">
	<?php
	$this->pageTitle = __('Register', true);

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
		$session->flash();
	}
	?>
	<?php if (!empty($success)) :?>
		<p class="message success"><?php echo h($success);?></p>
	<?php else :?>
		<div class="users form">
			<?php
			$url = $html->url(array('action' => 'register'), true);
			echo $form->create('User', array('url' => $url));
			echo $form->inputs(array(
				'legend' => __('Register', true),
				'email' => array('label' => __('Email', true)),
			));
			echo $form->end(__('Submit', true));
			?>
		</div>
		<?php if (!$this->params['isAjax']) :?>
			<div class="block">
				<?php echo $html->link(__('Cancel', true), array('action' => 'cancel'));?>
			</div>
		<?php endif;?>
	<?php endif;?>
</div>