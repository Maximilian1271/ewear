<?php if (!empty($orders)): ?>
<div class="container">
	<?php foreach ($orders as $item):?>
	<div class="login">
		<h2><a href="<?php echo APP_URL."user/order/{$item['uniqid']}"?>">Order from <?php echo date("F j, Y, g:i a",$item['created_at']);?></a></h2>
		<div class="additional">Status:<?php echo $item['StatusName']?></div>
	</div>
	<?php endforeach;?>
</div>
<?php else: header("Location:".APP_URL."error/empty"); endif;?>