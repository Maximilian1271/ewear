<aside>
	<div class="nav-main">
		<div class="search">
			<input type="text" name="search" id="search">
			<label for="search"><img class="search" src="<?php echo APP_URL."assets/images/baseline-search-24px.svg"?>" alt="search"></label>
		</div>
		<div class="options">
			<?php if(\App\Libs\Sessions::get('login')==1): ?>
				<a href="<?php echo APP_URL."user/settings"?>">Account settings</a>
			<?php else: ?>
				<a href="<?php echo APP_URL."login"?>">Log In</a> <i>|</i> <a href="<?php echo APP_URL."register"?>">Register</a>
				<a href="<?php echo APP_URL."cart"?>"><?php require "assets/images/baseline-shopping_cart-24px.svg";?></a>
			<?php endif;?>
		</div>
	</div>
</aside>