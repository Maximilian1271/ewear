<!--<pre>-->
<!--	--><?php //print_r($cart)?>
<!--</pre>-->
<div class="container">
	<?php if (isset($cart)):?>
		<?php foreach ($cart as $item):?>
		<div class="login">
			<h2><a href="<?php echo APP_URL."shop/prod/".rawurlencode($item['title'])?>"><?php echo $item['title']?></a></h2>
			<div class="additional">
				Size: <?php echo $item['size']?>,
				Quantity: <?php echo $item['num']?>
				<?php if ($item['colour']!="null"): ?>
					,Colour: <?php echo $item['colour']?>
				<?php endif;?>
			</div>
		</div>
		<?php endforeach;?>
		<button type="button" class="remove" onclick="location.href='<?php echo APP_URL."cart/clear"?>'">Clear this Cart</button>
		<button type="button" class="remove order" onclick="location.href='<?php echo APP_URL."cart/order"?>'">Order this Cart</button>
	<?php else:?>
		<?php header("Location:".APP_URL."error/cart");?>
	<?php endif;?>
</div>