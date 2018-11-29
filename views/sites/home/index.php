<?php //print_r($errors);?>
<?php echo $css;?>
<div class="container">
	<div class="slider">
		<div class="nav">
			<div class="nav-left" onclick="plusDivs(-1)">&#10094;</div>
			<div class="nav-right" onclick="plusDivs(1)">&#10095;</div>
			<div class="dots">
				<span class="dot hover" onclick="currentDiv(1)"></span>
				<span class="dot hover" onclick="currentDiv(2)"></span>
				<span class="dot hover" onclick="currentDiv(3)"></span>
			</div>
		</div>
		<img class="slide" alt="productimage" src="./assets/images/bag-eyewear-fashion-833052.jpg" style="">
		<img class="slide" alt="productimage" src="./assets/images/adult-beautiful-body-301320.jpg" style="">
		<img class="slide" alt="productimage" src="./assets/images/adolescent-casual-cute-428338.jpg" style="">
	</div>
	<?php echo $js ?>
</div>