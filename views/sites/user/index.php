<div class="container">
	<div class="login">
		<h2>My Account</h2>
		<?php if(isset($user)):?>
		<?php $json=json_decode($user['data'], true);?>
		<ul>
			<li>Name:</li>
			<li><?php echo $json['name'] ?></li>
			<li>Surname:</li>
			<li><?php echo $json['surname'] ?></li>
			<li>Username:</li>
			<li><?php echo $user['uname'] ?></li>
			<li>E-Mail:</li>
			<li><?php echo $user['email'] ?></li>
			<li>Address:</li>
			<li><?php echo(empty($json['address'])||empty($json['address'])?"Not set":$json['address']." ".$json['zip']) ?></li>
			<br>
			<li style="font-weight: bold; float: left; margin-left: 50px"><a href="user/orders">Past Orders</a></li>
			<li style="font-weight: bold; float: right; margin-right: 50px"><a href="user/edit">Found a mistake? Edit!</a></li>
		</ul>
		<?php else:?>
		<p>A fatal error has occured</p>
		<?php endif;?>
	</div>
</div>