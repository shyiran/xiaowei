<?php if (!defined('THINK_PATH')) exit();?><div class="uploader" id="uploader_<?php echo ($id); ?>" add_file_id="<?php echo ($id); ?>">
	<input id="add_file_<?php echo ($id); ?>" class="add_file" type="hidden" name="<?php echo ($name); ?>" >
	<a id="btn_<?php echo ($id); ?>" href="javascript:;" class="btn btn-sm btn-primary">添加附件</a>
	<ul class="file_list" new_upload="" ></ul>
</div>