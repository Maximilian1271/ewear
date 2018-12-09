<aside>
	<div class="nav-main">
		<div class="search">
			<form action="<?php echo APP_URL."shop/"?>" method="post">
				<input type="text" name="search" id="search">
				<label for="search"><img class="search" src="<?php echo APP_URL."assets/images/baseline-search-24px.svg"?>" alt="search"></label>
			</form>
		</div>
		<div class="options">
			<?php if(\App\Libs\Sessions::get('login')==1): ?>
				<a href="<?php echo APP_URL."user"?>">Account</a>
				<a href="<?php echo APP_URL."logout"?>">Log Out</a>
			<?php else: ?>
				<a href="<?php echo APP_URL."login"?>">Log In</a> <i>|</i> <a href="<?php echo APP_URL."register"?>">Register</a>
			<?php endif;?>
			<?php if(isset($_SESSION['cart'])&&$_SESSION['cart']>0):?>
			<a class="cart fill" href="<?php echo APP_URL."cart"?>"><?php require "assets/images/baseline-shopping_cart-24px.svg";?><div><?php echo count($_SESSION['cart'])?></div></a>
			<?php else:?>
			<a class="cart" href="<?php echo APP_URL."cart"?>"><?php require "assets/images/baseline-shopping_cart-24px.svg";?><div>&nbsp;</div></a>
			<?php endif;?>
		</div>
	</div>
</aside>