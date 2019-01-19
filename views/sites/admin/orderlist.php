<div class="container">
	<a href="<?php echo APP_URL."admin"?>">Admin</a>&gt;<a href="<?php echo APP_URL."admin/order"?>">Order Control/User Select</a>&gt;Orderlist<br><br>
	<?php if(!empty($orders)):?>
	<?php foreach ($orders as $item):?>
	<div class="login">
		<a style="text-align: center;" href="<?php echo APP_URL."admin/orderdetail/{$item['uniqid']}" ?>"><h2>Order from <?php echo date("F j, Y, g:i a",$item['created_at'])?></h2></a>
		<div class="additional">Status:<?php echo $item['StatusName']?></div>
	</div>
	<?php endforeach;?>
	<?php else:?>
	<div class="login">
		<div class="additional" style="text-align: center; margin: 0">No orders could be found for this user</div>
	</div>
	<?php endif;?>
</div>