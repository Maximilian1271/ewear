<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo APP_URL."assets/css/css.css" ?>">
	<link rel="stylesheet" href="<?php echo APP_URL."assets/css/login.css" ?>">
</head>
<body>
	<div class="header"><?php load_global("header");
		load_view($view, $data);
		load_global("footer")?>
	</div>
</body>
</html>