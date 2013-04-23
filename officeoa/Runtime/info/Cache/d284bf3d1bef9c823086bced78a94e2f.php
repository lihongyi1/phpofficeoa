<?php if (!defined('THINK_PATH')) exit();?><div style="margin: 10%">

	<center><h2><?php echo ($info["title"]); ?></h2></center>
	<p>
		<?php echo (htmlspecialchars_decode($info["content"],ENT_QUOTES)); ?>
	</p>
</div>