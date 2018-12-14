<?php $total=0;
$user=new \App\Models\User();
$user=$user->getUserbyId(\App\Libs\Sessions::get('id'));
$json=json_decode($user['data'], true); ?>
<div class="container">
	<?php if (isset($cart)):?>
		<?php foreach ($cart as $item):?>
		<?php $total=$total+(intval($item['productinfo']['base_price'])*$item['num']) ?>
		<div class="login">
			<h2><a href="<?php echo APP_URL."shop/prod/".rawurlencode($item['productinfo']['title'])?>"><?php echo $item['productinfo']['title']?></a></h2>
			<p><?php echo $item['productinfo']['base_price']*$item['num']."&pound;"?></p>
			<div class="additional">
				Size: <?php echo $item['size']?>,
				Quantity: <?php echo $item['num']?>
				<?php if ($item['colour']!="null"): ?>
				,Colour: <?php echo $item['colour']?>
				<?php endif;?>
			</div>
		</div>
		<?php endforeach;?>

	<div class="res">
		<h2>Total</h2>
		<p><?php echo $total?>&pound;</p>
		<hr>
		<h3>Shipping details:</h3><br>
		<div class="field textfield">
			<label class="label activejs" for="name">Name</label>
			<input type="text" name="name" value="<?php echo $json['name']." ".$json['surname'] ?>" required><br>
			<div class="underline"></div>
		</div>
		<div class="field textfield">
			<label class="label activejs" for="address">Address</label>
			<input type="text" name="address" value="<?php echo $json['address'] ?>" required><br>
			<div class="underline"></div>
		</div>
		<div class="field textfield">
			<label class="label activejs" for="zip">ZIP</label>
			<input type="text" name="zip" value="<?php echo $json['zip'] ?>" required><br>
			<div class="underline"></div>
		</div>
		<h4>Payment Options:</h4>
		<div class="pay">
			<div class="option">
				<input type="radio" name="pay" id="mastercard">
				<label for="mastercard"><img src="assets/images/mastercard.png" alt=""></label>
			</div>
			<div class="option">
				<input type="radio" name="pay" id="paypal">
				<label for="paypal"><img src="assets/images/paypal.png" alt=""></label>
			</div>
			<div class="option">
				<input type="radio" name="pay" id="bank">
				<label for="bank"><img src="assets/images/Girocard_mit_Rand_hochformat_cmyk.png" alt=""></label>
			</div>
		</div>
		<div></div>
		<div class="btns">
			<button type="button" class="remove" onclick="location.href='<?php echo APP_URL."cart/clear"?>'">Clear this Cart</button>
			<form method="post">
				<input name="place" id="place" value="Order this Cart" type="submit" class="remove order" onclick="location.href='<?php echo APP_URL."cart/order"?>'">
			</form>
		</div>
	</div>
	<?php else:?>
		<?php header("Location:".APP_URL."error/cart");?>
	<?php endif;?>
</div>