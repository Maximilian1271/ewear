<?php echo $css;?>
<div class="container">
	<div class="grid">
		<?php foreach ($prod as $product):?>
		<a href="<?php echo(APP_URL."shop/prod/{$product['title']}");?>">
			<div class="product">
				<div class="title"><?php echo $product['title']?></div>
				<div class="price"><?php echo $product['base_price']?>$</div>
<!--				<div class="desc">--><?php //echo $product['product_desc']?><!--</div>-->
				<img class="prodimg" src="<?php if($product['image']==""){echo "assets/images/product/none.jpg";}else echo $product['image']?>" alt="product image">
			</div>
		</a>
		<?php endforeach;?>
	</div>
</div>