<div class="nav-subnav">
	<a href="<?php echo APP_URL?>">Home</a>
	<a href="<?php echo APP_URL."shop"?>">Shop</a>
	<?php if (\App\Libs\Sessions::get('user_group')>1): ?>
	<a href="<?php echo APP_URL."admin"?>">Admin</a>
	<?php endif;?>
</div>