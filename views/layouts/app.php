<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo APP_URL."assets/css/css.css" ?>">
	<?php if (count($this->files_css)>0){
		echo $this->loadCss();
	} ?>
</head>
<body>
	<div class="app"><?php
		print_r($_SESSION);
		echo count($_SESSION);
		load_global("header");
		load_view($view, $data);
		load_global("footer")?>
	</div>
	<?php if (count($this->files_js)>0){
		echo $this->loadJs();
	} ?>
</body>
</html>