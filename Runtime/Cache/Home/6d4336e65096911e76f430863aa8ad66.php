<?php if (!defined('THINK_PATH')) exit();?>	<div class="form-group">
		<label class="col-sm-2 control-label" for="field_<?php echo ($data["name"]); ?>"><?php echo ($data["name"]); ?></label>
		<div class="col-sm-10">
			<?php echo W('UserDefineControl/edit',array($data));?>
		</div>
	</div>