<div class="container">
	<?php if (!empty($prod)): ?>
	<div class="grid">
		<?php foreach ($prod as $product):?>
		<a href="<?php echo(APP_URL."shop/prod/".rawurlencode($product['title'])."");?>">
			<div class="product">
				<div class="title"><?php echo $product['title']?></div>
				<div class="price"><?php echo($product['in_stock']?$product['base_price']."&pound;":"Out of stock")?></div>
				<img class="prodimg" src="<?php if($product['image']==""){echo "assets/images/product/none.jpg";}else echo APP_URL."assets/images/product/".rawurlencode($product['image'])?>" alt="product image">
			</div>
		</a>
		<?php endforeach;?>
	</div>
	<?php else:?>
	<?php header("Location:".APP_URL."error/empty");?>
	<?php endif;?>
</div>