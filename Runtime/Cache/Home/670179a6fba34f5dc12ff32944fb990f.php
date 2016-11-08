<?php if (!defined('THINK_PATH')) exit(); if(($readonly) == "true"): ?><textarea class="hidden form-control" name="udf_field_<?php echo ($id); ?>" rows="10" ><?php echo ($val); ?></textarea>		
		<div class="form-control-static"><?php echo ($val); ?></div>
	<?php else: ?>
	<textarea class="editor form-control" name="udf_field_<?php echo ($id); ?>" rows="10" <?php if(!empty($validate)): ?>check="<?php echo ($validate); ?>" msg="<?php echo ($msg); ?>"<?php endif; ?>><?php echo ($val); ?></textarea><?php endif; ?>