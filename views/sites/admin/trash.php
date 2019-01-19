<div class="container">
	<a href="<?php echo APP_URL."admin"?>">Admin</a>&gt;<a href="<?php echo APP_URL."admin/product"?>">Product Control</a>&gt;Deleted Products<br><br>
	<div class="control">
		<h2>ProductControl</h2>
		<table>
			<thead>
			<th>Product Name</th>
			<th>Short Description</th>
			<th>Base Price</th>
			<th>Image-Name</th>
			<th>Added</th>
			<th>In stock</th>
			<th>Category</th>
			<th>&nbsp;</th>
			</thead>
			<?php echo $prod;?>
		</table>
		<br>
	</div>
</div>