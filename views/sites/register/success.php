<?php
$ref=isset($_SERVER['HTTP_REFERER'])?explode("/", $_SERVER['HTTP_REFERER']):"";
if(isset($_SERVER['HTTP_REFERER'])&&end($ref)=="register"):?>
<div class="container">
	<div class="login">
		<h2>You have been registered successfully</h2>
	</div>
</div>
<?php else:?>
<div class="container">
	<div class="login" style="padding-left: 40px">
		<h2 style="margin: 0;">Error:</h2>
		<p>This is an error</p>
		<p>This is all we know</p>
	</div>
</div>
<?php endif;?>