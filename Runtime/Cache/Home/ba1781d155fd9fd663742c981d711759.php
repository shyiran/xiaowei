<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
		<link href="/xiaowei/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />
		<link href="/xiaowei/Public/Ins/css/bootstrap.min.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/animate.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/plugins/gritter/jquery.gritter.css" />
		<?php if(!empty($plugin["jquery-ui"])): ?><link rel="stylesheet" href="/xiaowei/Public/Ins/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" />
	<link rel="stylesheet" href="/xiaowei/Public/Ins/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet"><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><link rel="stylesheet" href="/xiaowei/Public/Ins/css/plugins/date-time/bootstrap-datetimepicker.css" /><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><link href="/xiaowei/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
	<link href="/xiaowei/Public/Ins/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'><?php endif; ?>

        
		<link href="/xiaowei/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />
		<link href="/xiaowei/Public/Ins/css/style.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/xiaowei.css" rel="stylesheet">
		
	</head>
	<script type="text/javascript">
	var upload_url = "<?php echo U('upload');?>";
	var del_url = "<?php echo U('del_file');?>";
	var app_path = "/xiaowei";
	var ws_push_time = "<?php echo get_system_config('ws_push_time');?>";
	var cookie_prefix = "<?php echo C('COOKIE_PREFIX');?>";
	var link_select = "<?php echo U('Popup/link_select');?>";
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?2a935166b0c9b73fef3c8bae58b95fe4";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})(); 
</script>
	<body class="<?php echo (CONTROLLER_NAME); ?>">
		<div class="shade"></div>
		<div class="form-group hidden" id="img_upload_container">
			<div id="img_upload">上传</div>
		</div>
		<nav class="navbar navbar-default row" role="navigation" id="top_menu">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-6">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-lg"></i>
				</button>
				<div class="hidden-xs">
					&nbsp;
				</div>
				<a href="<?php echo U('index/index');?>" class="navbar-brand"><?php echo get_system_config("system_name");?></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-6">
				<ul class="nav navbar-nav navbar-right">
					<?php if(is_array($top_menu)): foreach($top_menu as $key=>$top_menu_vo): ?><a class="nav-app" href="#" url="<?php echo (get_nav_url($top_menu_vo['url'])); ?>" node="<?php echo ($top_menu_vo["id"]); ?>" onclick="click_top_menu(this)" ><i class="<?php echo ($top_menu_vo["icon"]); ?>"></i><?php echo ($top_menu_vo["name"]); ?>
						<?php if(!empty($badge_count[$top_menu_vo['id']])){ $html=''; $html='<span class="label label-danger">'.$badge_count[$top_menu_vo['id']].'</span>'; echo $html; } ?></a><?php endforeach; endif; ?>
					<a class="nav-app btn-danger" href="<?php echo U('public/logout');?>"><i class="fa fa-sign-out"></i>退出</a>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		<div id="wrapper">
			<div class="sidebar navbar-static-side" id="sidebar">
				<div id="user_info" class="text-center hidden-xs"  >
					<span >当前用户：<?php echo (session('user_name')); ?></span>
				</div>
				<div id="nav_head" class="text-center" onclick="toggle_left_menu()">
					<span class="menu-text"><?php echo ($top_menu_name); ?></span>
					<b id="left_menu_icon" class="fa fa-angle-down pull-right"></b>
				</div>
				<?php echo W('Sidebar/left',array('tree'=>$left_menu,'badge_count'=>$badge_count));?>
			</div>
			<div id="page-wrapper" class="gray-bg">
				<div class="row wrapper border-bottom gray-bg">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="fa fa-home home-icon"></i>
								<a href="/">Home</a>
							</li>
							<li>
								<?php echo ($top_menu_name); ?>
							</li>
						</ul><!-- .breadcrumb -->
					</div>
				</div>
				<div class="wrapper wrapper-content">
					
	<input type="hidden" name="ajax" id="ajax" value="1">
	<select name="dept_list" id="dept_list" class="hidden">
		<?php echo fill_option($dept_list);?>
	</select>
	<?php echo W('PageHeader/simple',array('name'=>'部门管理','search'=>'N'));?>
	<form id="form_search" name="form_search" method="post">
		<div class="operate panel panel-default">
			<div class="panel-body">
				<div class="pull-right">
					<a onclick="add()" class="btn btn-sm btn-primary">新增</a>
					<a onclick="save()"  class="btn btn-sm btn-primary">保存</a>
					|
					<a onclick="del()"  class="btn btn-sm btn-danger">删除</a>
				</div>
			</div>
		</div>
	</form>
	<!-- 功能操作区域结束 -->
	<!-- 列表显示区域  -->
	<div class="row">
		<div class="col-sm-4 sub_left_menu ">
			<div class="well">
				<?php echo $menu ?>
			</div>
		</div>
		<div class="col-sm-8 sub_content">
			<form id="form_data" name="form_data" method="post" class="well form-horizontal clearfix">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="opmode" id="opmode" value="">
				<div class="form-group col-xs-12 hidden">
					<label class="col-sm-4 control-label" for="dept_no">编码*：</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="dept_no" name="dept_no" >
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="name">名称*：</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="name" name="name" check="require" msg="请输入名称">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="short">简称*：</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="short" name="short" check="require" msg="请输入简称">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="dept_name">上级部门*：</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input name="dept_name" class="form-control" id="dept_name" type="text" readonly="readonly" msg="请选择上级部门" check="require"/>
							<input name="pid" id="pid" type="hidden" msg="请选择上级部门" check="require" />
							<span class="input-group-btn">
								<button class="btn btn-sm btn-primary" onclick="select_pid()" type="button">
									选择
								</button> </span>
						</div>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="dept_grade_id">部门级别*：</label>
					<div class="col-sm-8">
						<select name="dept_grade_id" id="dept_grade_id" class="form-control" msg="请选择部门级别" check="require">
							<option>选择部门级别</option>
							<?php echo fill_option($dept_grade_list);?>
						</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="sort">排序：</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="sort" name="sort" >
					</div>
				</div>

				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="is_del">状态*：</label>
					<div class="col-sm-8">
						<select   name="is_del" id="is_del" class="form-control">
							<option  value="0">启用</option>
							<option value="1">禁用</option>
						</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-4 control-label" for="remark" >其他：</label>
					<div class="col-sm-8" >
						<textarea class="form-control" name="remark" id="remark" rows="5" class="col-xs-12" ></textarea>
					</div>
				</div>
			</form>
		</div>
	</div>

				</div>
			</div>
		</div>
		 
		
		<script src="/xiaowei/Public/Ins/js/jquery-2.1.1.js"></script>
		<script src="/xiaowei/Public/Ins/js/bootstrap.min.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="/xiaowei/Public/Ins/js/bootstrap-suggest.min.js"></script>
		<!-- Custom and plugin javascript -->
		<script src="/xiaowei/Public/Ins/js/inspinia.js"></script>
		<script src="/xiaowei/Public/Ins/js/common.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/pace/pace.min.js"></script>
		<?php if(!empty($plugin["jquery-ui"])): ?><script src="/xiaowei/Public/Ins/js/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/nouslider/jquery.nouislider.min.js"></script><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><script src="/xiaowei/Public/Ins/js/plugins/date-time/moment-with-locales.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/date-time/bootstrap-datetimepicker.js"></script><?php endif; ?>

<?php if(!empty($plugin["uploader"])): ?><script type="text/javascript" src="/xiaowei/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script>
	<script type="text/javascript" src="/xiaowei/Public/Ins/js/plugins/plupload/plupload.setting.js"></script><?php endif; ?>

<?php if(!empty($plugin["editor"])): if(empty($plugin["uploader"])): ?><script type="text/javascript" src="/xiaowei/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script><?php endif; ?>
	<script type="text/javascript" src="/xiaowei/Public/Ins/js/plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="/xiaowei/Public/Ins/js/plugins/tinymce/tinymce.setting.js"></script><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><script src="/xiaowei/Public/Ins/js/plugins/fullcalendar/moment.min.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/fullcalendar/fullcalendar.min.js"></script><?php endif; ?>

<?php if(!empty($plugin["baidu_map"])): ?><script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=EE6745c36d96321e90b7015f3de4a4ee"></script><?php endif; ?>

<script src="/xiaowei/Public/Ins/js/plugins/toastr/toastr.min.js"></script>
<script src="/xiaowei/Public/Ins/js/plugins/gritter/jquery.gritter.min.js"></script>
<script src="/xiaowei/Public/Ins/js/plugins/bootbox/bootbox.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		<?php if(!empty($plugin["date"])): ?>$('.input-date').datetimepicker({
			format : 'YYYY-MM-DD',
			locale : 'zh-cn',
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});

		$(".input-daterange input").datetimepicker({
			format : "YYYY-MM-DD",
			locale : 'zh-cn',
			showTodayButton : true,
			showClose : true,
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});

		$("#start_date").on("dp.change", function(e) {
			if ($("#end_date").length > 0) {
				$('#end_date').data("DateTimePicker").minDate(e.date);
			}
		});

		$("#end_date").on("dp.change", function(e) {
			if ($("#start_date").length > 0) {
				$('#start_date').data("DateTimePicker").maxDate(e.date);
			}
		});

		$(".input-date-time").datetimepicker({
			format : 'YYYY-MM-DD HH:mm',
			locale : 'zh-cn',
			sideBySide : true,
			showTodayButton : true,
			showClose : true,
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});<?php endif; ?>
	}); 
</script>
		
	<script type="text/javascript">
		function add() {
			winopen("<?php echo U('add');?>",560, 470);
		};

		function save() {
			sendForm("form_data", "<?php echo U('save');?>", "<?php echo U('index');?>");
		}

		function del() {
			if ($(".sub_left_menu a.active").parent().find(".tree_menu").html() != undefined) {
				ui_error("有子目录不能删除");
				return false;
			}
			ui_confirm('确定要删除吗?', function() {
				var vars = $("#form_data").serialize();
				sendAjax("<?php echo U('del');?>", vars, function(data) {
					if (data.status) {
						ui_alert(data.info, function() {
							location.reload(true);
						});
					}
				});
			});
		}

		function select_pid() {
			winopen("<?php echo U('winpop');?>",560, 470);
		}

		function showdata(result) {
			for (var s in result.data) {
				set_val(s, result.data[s]);
			}
			$("#dept_name").val($("#dept_list option[value='" + $("#pid").val() + "']").text());
			$("#opmode").val("edit");
		}

		$(document).ready(function() {
			$(".sub_left_menu .tree_menu a").click(function() {
				$(".sub_left_menu .tree_menu a.active").removeClass("active");
				$(this).addClass("active");
				sendAjax("<?php echo U('read');?>", "id=" + $(this).attr("node"), function(data) {
					showdata(data);
				});
				return false;
			});
		});
	</script>


	</body>
</html>