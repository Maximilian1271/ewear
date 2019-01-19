<div class="container">
	<?php $json=json_decode($order['address'], true);
	if($order['status']!=5):?>
	<div class="login">
		<h2>Your order from <?php echo date("F j, Y, g:i a", $order['created_at']) ?>:</h2>
		<div class="additional">
			Delivery Address: <?php echo $json['Address']?>, <?php echo $json['Postal_Code_(ZIP)']?><br>
			Delivery Name: <?php echo $json['Name']?><br>
			Payment Method: <?php echo $json['Payment_Method']?>
		</div>
		<br>
		<h2>Contained:</h2>
		<?php foreach (explode("::", $order['cart_data']) as $item):
		$jsonCart=json_decode($item, true);
		if($item!=null):
		$product=new \app\Models\Product();
		$product=$product->getProductById($jsonCart['id']); ?>
		<div class="additional">
			<b>Product: <?php echo $product['title']?></b><br>
			Size: <?php echo $jsonCart['size']?><br>
			Amount: <?php echo $jsonCart['num']?><br>
			<?php if($jsonCart['colour']!="null"):?>
			Colour: <?php echo $jsonCart['colour']?>
			<?php endif;?>
		</div>
		<?php endif; endforeach;?>
		<?php if($order['status']==0):?>
		<p class="additional">This order is still processing. During this stage, you may cancel the order Process</p>
		<form method="POST" action="<?php echo APP_URL."user/cancel/{$order['uniqid']}"?>">
			<button style="margin: 0px auto;display: block;margin-top: 20px;">Cancel?</button>
		</form>
		<?php endif;?>
	</div>
	<?php else:?>
	<div class="login">
		<h1 style="text-align: center">This order has been cancelled</h1>
		<div class="cancelled">
			<h2>Your order from <?php echo date("F j, Y, g:i a", $order['created_at']) ?>:</h2>
			<div class="additional">
				Delivery Address: <?php echo $json['Address']?>, <?php echo $json['Postal_Code_(ZIP)']?><br>
				Delivery Name: <?php echo $json['Name']?><br>
				Payment Method: <?php echo $json['Payment_Method']?>
			</div>
			<br>
			<h2>Contained:</h2>
			<?php foreach (explode("::", $order['cart_data']) as $item):
				$jsonCart=json_decode($item, true);
				if($item!=null):
					$product=new \app\Models\Product();
					$product=$product->getProductById($jsonCart['id']); ?>
					<div class="additional">
						<b>Product: <?php echo $product['title']?></b><br>
						Size: <?php echo $jsonCart['size']?><br>
						Amount: <?php echo $jsonCart['num']?><br>
						<?php if($jsonCart['colour']!="null"):?>
							Colour: <?php echo $jsonCart['colour']?>
						<?php endif;?>
					</div>
				<?php endif; endforeach;?>
			<?php if($order['status']==0):?>
				<p class="additional">This order is still processing. During this stage, you may cancel the order Process</p>
				<form method="POST" action="<?php echo APP_URL."user/cancel/{$order['uniqid']}"?>">
					<button style="margin: 0px auto;display: block;margin-top: 20px;">Cancel?</button>
				</form>
			<?php endif;?>
		</div>
	</div>
	<?php endif;?>
</div>