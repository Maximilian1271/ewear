<div class="login">
		<h2>Confirm Order:</h2>
			<ul>
				<?php foreach ($shipping as $key => $item):?>
				<li><?php echo $key.":"?></li>
				<li><?php echo $item?></li>
				<?php endforeach;?>
			</ul>
			<hr>
			<h3>Cart Content:</h3>
			<ul>
				<?php foreach ($cart as $key=>$item):?>
				<li><a href="<?php echo APP_URL."shop/prod/".rawurlencode($item['productinfo']['title']) ?>"><?php echo $item['productinfo']['title']?></a>:</li>
				<li><?php echo "Size: ".$item['size'].", Quantity: ".$item['num']?><?php echo($item['colour']!="null"?", Colour: ".$item['colour']: "") ?></li>
				<?php endforeach;?>
			</ul>
	<form method="post" action="<?php echo APP_URL."cart/orderSuccess"?>">
		<input type="hidden" name="cartId" value="<?php echo $cartid['id'] ?>">
		<?php foreach ($shipping as $key => $item):?>
			<input type="hidden" name="<?php echo $key?>" value="<?php echo $item?>">
		<?php endforeach;?>
		<input type="hidden" name="csrf" value="<?php echo set_csrf()?>">
		<button type="submit" class="order" id="confirmOrder" name="confirmOrder" style="display:block; float: initial; margin: 0 auto;">Confirm Order</button>
	</form>
	</div>