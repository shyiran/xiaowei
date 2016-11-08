<?php if (!defined('THINK_PATH')) exit();?>	<div class="form-group col-sm-6">
		<label class="col-sm-4 control-label" for="field_<?php echo ($data["name"]); ?>"><?php echo ($data["name"]); ?></label>
		<div class="col-sm-8">
			<?php echo W('UserDefineControl/edit',array($data));?>
		</div>
	</div>