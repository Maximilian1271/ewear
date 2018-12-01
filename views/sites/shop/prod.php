<?php echo $css;?>
<div class="container">
	<div class="content">
		<?php if(!empty($prod)):?>
		<img class="prodimg" src="<?php echo APP_URL.$prod['image'] ?>" alt="product image">
		<div class="text">
			<h2><?php echo $prod['title']?></h2>
			<h3><?php echo $prod['base_price']?></h3>
			<hr>
			<p><?php echo $prod['product_desc_long']?></p>
			<hr>
			 <ul>
			    <li>Available Sizes:</li>
				<li>S</li>
				<li>M</li>
				<li>L</li>
				<li>XL</li>
				<li>2XL</li>
				<li>3XL</li>
			</ul>
			<label for="colour">Colour:</label>
			<select name="colour" id="colour">
				<option value="black">Black</option>
				<option value="blue">Blue</option>
				<option value="red">Red</option>
				<option value="green">Green</option>
			</select>
			<div class="quantity">
				<button onclick="document.querySelector('.amount').stepUp(1)">+</button><input type="number" min="1" max="10" value="1" class="amount" readonly><button onclick="document.querySelector('.amount').stepDown(1)">-</button>
			</div>
			<input type="submit" name="submit" id="submit" class="submit">
		</div>
		<?php else:?>
		There has been an error with your query. Please try something different
		<?php endif;?>
	</div>
</div>