<?php
if (isset($cart)):
$total=0;
$user=new \App\Models\User();
$user=$user->getUserbyId(\App\Libs\Sessions::get('id'));
$json=json_decode($user['data'], true); ?>
<div class="container">
	<div class="res">
		<h2>Total</h2>
		<?php foreach ($cart as $item):?>
		<?php $total=$total+(intval($item['productinfo']['base_price'])*$item['num']) ?>
		<?php endforeach;?>
		<p><?php echo $total?>&pound;</p>
		<hr>
		<h3>Shipping details:</h3><br>
		<form method="post" action="<?php echo APP_URL."cart/checkout" ?>">
			<div class="field textfield">
				<label class="label activejs" for="name">Name<i class="req">*</i></label>
				<input type="text" id="name" name="name" value="<?php echo $json['name']." ".$json['surname'] ?>" required><br>
				<div class="underline"></div>
			</div>
			<div class="field textfield">
				<label class="label activejs" for="address">Address<i class="req">*</i></label>
				<input type="text" id="address" name="address" value="<?php echo $json['address'] ?>" required <?php if($json['address']==""):echo ("placeholder=\"Please provide a Valid address here or in your Profile\""); endif; ?>><br>
				<div class="underline"></div>
			</div>
			<div class="field textfield">
				<label class="label activejs" for="zip">ZIP<i class="req">*</i></label>
				<input type="text" id="zip" name="zip" value="<?php echo $json['zip'] ?>" required <?php if($json['zip']==""):echo ("placeholder=\"Please provide a Valid address here or in your Profile\""); endif; ?>><br>
				<div class="underline"></div>
			</div>
			<h4>Payment Options<i class="req">*</i>:</h4>
			<div class="pay">
				<div class="option">
					<input type="radio" name="pay" id="Mastercard" value="Mastercard" required>
					<label for="Mastercard"><img src="assets/images/mastercard.png" alt="mastercard-logo"></label>
				</div>
				<div class="option">
					<input type="radio" name="pay" id="Paypal" value="Paypal" required>
					<label for="Paypal"><img src="assets/images/paypal.png" alt="paypal-logo"></label>
				</div>
				<div class="option">
					<input type="radio" name="pay" id="Bank" value="Bank" required>
					<label for="Bank"><img src="assets/images/Girocard_mit_Rand_hochformat_cmyk.png" alt="girocard-logo"></label>
				</div>
			</div>
			<div class="btns">
				<button type="button" class="remove" onclick="location.href='<?php echo APP_URL."cart/clear"?>'">Clear this Cart</button>
				<button type="submit" class="remove order" name="place" id="place">Order this Cart</button>
			</div>
		</form>
		<div class="info" style="font-size: 8px; margin-top: 20px;"><i style="font-size: 8px" class="req">*</i>=Required field</div>
	</div>
		<?php foreach ($cart as $item):?>
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
	<?php else:?>
		<?php header("Location:".APP_URL."error/cart");?>
	<?php endif;?>
</div>