<div class="container">
	<a href="<?php echo APP_URL."admin"?>">Admin</a>&gt;<a href="<?php echo APP_URL."admin/order"?>">Order Control/User Select</a>&gt;<a href="<?php echo APP_URL."admin/orderlist/$user_id"?>">Orderlist</a>&gt;Order ID:<?php echo $id?><br><br>
	<table>
		<thead>
		<th class="verticalSplit">Address</th>
		<th class="verticalSplit">Order Content</th>
		<th class="verticalSplit">Order Date</th>
		<th class="verticalSplit">Order Status</th>
		<th class="noborder"> </th>
		<th class="noborder"> </th>
		</thead>
		<?php echo $order?>
	</table>
</div>