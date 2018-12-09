<div class="container">
	<div class="content">
		<?php if(!empty($prod)):?>
			<?php $json=json_decode($prod['data'], true)?>
			<img class="prodimg" src="<?php if($prod['image']==""){echo APP_URL."assets/images/product/none.jpg";}else echo APP_URL."assets/images/product/".$prod['image']?>" alt="product image">
		<div class="text">
			<h2><?php echo $prod['title']?></h2>
			<h3><?php echo $prod['base_price']?></h3>
			<hr>
			<p><?php echo $prod['product_desc_long']?></p>
			<hr>
			<form method="post">
				<div class="order">
					<div class="size">
						 Available Sizes:
						<input type="radio" name="size" id="S" value="S">
						 <label for="S">S</label>
						<input type="radio" name="size" id="M" value="M" checked>
						 <label for="M">M</label>
						<input type="radio" name="size" id="L" value="L">
						 <label for="L">L</label>
						<input type="radio" name="size" id="XL" value="XL">
						 <label for="XL">XL</label>
						<input type="radio" name="size" id="2XL" value="2XL">
						 <label for="2XL">2XL</label>
						<input type="radio" name="size" id="3XL" value="3XL">
						 <label for="3XL">3XL</label>
					</div>
					<?php if(isset($json)):?>
					<div class="colour">
						<label for="colour">Colour:</label>

						<select name="colour" id="colour">

							<?php foreach ($json['colour'] as $colour):?>
							<option value="<?php echo $colour ?>"><?php echo $colour ?></option>
							<?php endforeach;?>
						</select>
					</div>
					<?php endif;?>
					<div class="quantity">
						<button onclick="document.querySelector('.amount').stepUp(1)">+</button><input name="num" number" min="1" max="10" value="1" class="amount" readonly><button onclick="document.querySelector('.amount').stepDown(1)">-</button>
					</div>
					<?php if ($prod['in_stock']==1):?>
					<input type="submit" name="submit" id="submit" class="submit" value="Add to Cart">
					<?php else:?>
					<input type="submit" name="locked" id="locked" class="submit" disabled value="This item is currently unavailable">
					<?php endif;?>
				</div>
			</form>
		</div>
		<?php else:?>
		There has been an error with your query. Please try something different
		<?php endif;?>
	</div>
</div>