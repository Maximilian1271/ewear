<div class="container">
	<div class="grid">
		<?php foreach ($prod as $product):?>
		<a href="<?php echo(APP_URL."shop/prod/{$product['title']}");?>">
			<div class="product">
				<div class="title"><?php echo $product['title']?></div>
				<div class="price"><?php echo($product['in_stock']?$product['base_price']."$":"Out of stock")?></div>
				<img class="prodimg" src="<?php if($product['image']==""){echo "assets/images/product/none.jpg";}else echo "assets/images/product/".$product['image']?>" alt="product image">
			</div>
		</a>
		<?php endforeach;?>
	</div>
</div>