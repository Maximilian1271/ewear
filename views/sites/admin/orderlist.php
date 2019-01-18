<div class="container">
	<?php foreach ($orders as $item):?>
	<div class="login">
		<a style="text-align: center;" href="<?php echo APP_URL."admin/orderdetail/{$item['uniqid']}" ?>"><h2>Order from <?php echo date("F j, Y, g:i a",$item['created_at'])?></h2></a>
		<div class="additional">Status:<?php echo $item['StatusName']?></div>
	</div>
	<?php endforeach;?>
</div>