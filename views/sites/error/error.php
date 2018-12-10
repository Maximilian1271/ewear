<div class="errorcontainer">
	<?php include "assets/images/sunrise.svg";?>
	<?php if (isset($code)):?>
		<h2><i>In the beginning<br>There was Light</i><br><br><?php echo $code?><br><a href="javascript:history.back()">Take me back</a></h2>
	<?php else:?>
		<h2><i>In the beginning<br>There was Light</i><br><br>We did not understand that query :/<br><br>(404)<br><a href="javascript:history.back()">Take me back</a></h2>
	<?php endif; ?>
</div>