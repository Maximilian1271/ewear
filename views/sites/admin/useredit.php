<div class="container">
	<h2>Editing user <?php echo $user['uname']." with id ".$user['id']?></h2>
	<div class="useredit">
		<?php echo $form;?>
		<div class="additional">
			Registered since: <?php echo date("D M j Y, G:i:s, T" ,$user['created_at'])?><br>
			User-Group: <?php echo $user["Role"]?>
		</div>
	</div>
</div>