<?php echo $css;?>
<div class="container">
	<div class="login">
		<h2>Register</h2>
		<?php
		if(isset($errors) && count($errors) > 0) {
			echo "<div class='error'>";
			foreach ($errors as $error):
				echo "<p> $error</p>";
			endforeach;
			echo "</div>";

		}
		echo $form;?>
	</div>
</div>