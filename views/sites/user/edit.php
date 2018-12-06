<div class="container">
	<div class="login">
		<?php
		if(isset($errors)){
			echo "<div class='error'>";
			foreach ($errors as $error):
				echo "<p> $error</p>";
			endforeach;
			echo "</div>";
		}
		echo $form ?>
	</div>
</div>
<?php echo $js?>