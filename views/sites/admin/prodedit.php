<div class="container">
	<a href="<?php echo APP_URL."admin"?>">Admin</a>&gt;<a href="<?php echo APP_URL."admin/product"?>">Product Control</a>&gt;Editing Product <?php echo $prod['id']?><br><br>
	<h2>Editing Product "<?php echo $prod['title']?>" with id "<?php echo $prod['id']?>"</h2>
	<div class="useredit">
	<?php echo $form;?>
	</div>
</div>