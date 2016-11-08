<?php if (!defined('THINK_PATH')) exit(); if(($readonly) == "true"): ?><div class="link_select form-inline" data="<?php echo ($data); ?>" pid="<?php echo ((isset($config) && ($config !== ""))?($config):0); ?>">
		<select  class="main form-control" id="udf_field_<?php echo ($id); ?>" name="udf_field_<?php echo ($id); ?>" <?php if(!empty($validate)): ?>check="<?php echo ($validate); ?>" msg="<?php echo ($msg); ?>"<?php endif; ?>></select>
		<select  class="sub form-control" id="udf_field_<?php echo ($id); ?>_sub" name="udf_field_<?php echo ($id); ?>_sub" <?php if(!empty($validate)): ?>check="<?php echo ($validate); ?>" msg="<?php echo ($msg); ?>"<?php endif; ?>></select>
	</div>
	<?php else: ?>
	<div class="link_select form-inline" data="<?php echo ($data); ?>" pid="<?php echo ((isset($config) && ($config !== ""))?($config):0); ?>">
		<select class="main form-control" id="udf_field_<?php echo ($id); ?>" name="udf_field_<?php echo ($id); ?>" <?php if(!empty($validate)): ?>check="<?php echo ($validate); ?>" msg="<?php echo ($msg); ?>"<?php endif; ?>></select>
		<select class="sub form-control" id="udf_field_<?php echo ($id); ?>sub" name="udf_field_<?php echo ($id); ?>sub" <?php if(!empty($validate)): ?>check="<?php echo ($validate); ?>" msg="<?php echo ($msg); ?>"<?php endif; ?>></select>
	</div><?php endif; ?>