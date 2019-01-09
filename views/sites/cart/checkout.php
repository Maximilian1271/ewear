<div class="login">
		<h2>Confirm Order:</h2>
			<ul>
			<?php foreach ($shipping as $key => $item):?>
			<li><?php echo $key.":"?></li>
			<li><?php echo $item?></li>
			<?php endforeach;?>
			<hr>
			<h3>Cart Content:</h3>
				<?php foreach ($cart as $key=>$item):?>
				<li><a href="<?php echo APP_URL."shop/prod/".rawurlencode($item['productinfo']['title']) ?>"><?php echo $item['productinfo']['title']?></a>:</li>
				<li><?php echo "Size: ".$item['size'].", Quantity: ".$item['num']?><?php echo($item['colour']!="null"?", Colour: ".$item['colour']: "") ?></li>
				<?php endforeach;?>
			</ul>
	<button type="submit" class="order" style="display:block; float: initial; margin: 0 auto;">Confirm Order</button>
	</div>