<?php if (!defined('THINK_PATH')) exit(); if(($readonly) == "true"): ?><select class="hidden form-control" id="udf_field_<?php echo ($id); ?>" name="udf_field_<?php echo ($id); ?>" >
		<?php echo fill_option($data,$val);?>;
	</select>	
	<select class="form-control" disabled="disabled" id="disabled_udf_field_<?php echo ($id); ?>" name="disabled_udf_field_<?php echo ($id); ?>">
		<?php echo fill_option($data,$val);?>;
	</select>
	<?php else: ?>
	<select class="form-control" id="udf_field_<?php echo ($id); ?>" name="udf_field_<?php echo ($id); ?>" <?php if(!empty($validate)): ?>check="<?php echo ($validate); ?>" msg="<?php echo ($msg); ?>"<?php endif; ?>>
		<?php echo fill_option($data,$val);?>;
	</select><?php endif; ?>