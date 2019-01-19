<div class="container">
	<?php print_r($order)?>
	<?php $json=json_decode($order['address'], true)?>
	<div class="login">
		<h2>Your order from <?php echo date("F j, Y, g:i a", $order['created_at']) ?>:</h2>
		<div class="additional">
			Delivery Address: <?php echo $json['Address']?>, <?php echo $json['Postal_Code_(ZIP)']?><br>
			Delivery Name: <?php echo $json['Name']?><br>
			Payment Method: <?php echo $json['Payment_Method']?>
		</div>
	</div>
</div>