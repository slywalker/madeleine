<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Madeleine:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
	echo $html->meta('description', __('description', true));
	echo $html->meta('keywords', __('keyword', true));
	if (Configure::read()) {
		echo $html->css('cake.debug');
	}
	echo $scripts_for_layout;
	?>
</head>
<body>
	<?php $session->flash(); ?>
	<?php echo $content_for_layout; ?>
	<?php echo $cakeDebug;?>
</body>
</html>
