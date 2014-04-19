<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Administracion Areas</title>
	<?php
	$output2 = $output->output;
	$css_files = $output->css_files;
	$js_files = $output->js_files;
	foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
	<style type='text/css'>
		body { font-family: Arial; font-size: 14px; }
		a { color: blue; text-decoration: none; font-size: 14px; }
		a:hover { text-decoration: underline; }
	</style>
</head>
<body>
	<h1>Administración de Areas</h1>
	<div>
		<?php echo $output2; ?>
	</div>
</body>
</html>