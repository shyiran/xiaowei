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
	<?php echo W('PageHeader/search',array('name'=>'用户管理','search'=>'S'));?>
	<form method="post" id="form_adv_search" name="form_adv_search" method="post">
		<input type="hidden" name="ajax" id="ajax" value="1">
		<div class="operate panel panel-default">
			<div class="panel-body">
				<div class="pull-left form-inline">
					<label  for="eq_is_del"><b>状态:</b></label>
					<select id="eq_is_del" name="eq_is_del" class="col-10 form-control" onchange="submit_adv_search();">
						<option value="0">启用</option>
						<option value="1">禁用</option>
						<option value="2">其他</option>
					</select>
					<a onclick="import_user()" class="btn btn-sm btn-primary">导入</a>
				
					<a onclick="reset_pwd()" class="btn btn-sm btn-primary">设置密码</a>
					
				</div>
				<div class="pull-right">
					<a onclick="add()"  class="btn btn-sm btn-primary">新增</a>
					<a onclick="save()"  class="btn btn-sm btn-primary">保存</a>
					|
					<a onclick="del()"  class="btn btn-sm btn-danger">删除</a>
				</div>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-sm-4 sub_left_menu ">
			<form id="form_user" name="form_data" method="post" class="form-horizontal">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center col-4"><label class="inline pull-left">
								<input class="ace" type="checkbox" name="id-toggle-all" id="id-toggle-all" />
								<span class="lbl"></span></label></th>
							<th>员工编号</th>
							<th>姓名</th>
							<th>状态</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($data["id"]); ?>" class="tbody">
								<td class="text-center col-3"><label class="inline pull-left">
									<input class="ace" type="checkbox" name="user_id[]" value="<?php echo ($data["id"]); ?>" />
									<span class="lbl"></span></label></td>
								<td class="click"><?php echo ($data["emp_no"]); ?></td>
								<td class="click"><?php echo ($data["name"]); ?></td>
								<td class="click"><?php echo (status($data["is_del"])); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</form>
			<div class="pagination">
				<?php echo ($page); ?>
			</div>
		</div>
		<div class="col-sm-8">
			<form id="form_data" name="form_data" method="post" class="form-horizontal">
				<input type="hidden" id="save_name" name="save_name">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="pic" id="pic" >
				<input type="hidden" name="signature" id="signature" >
				<input type="hidden" name="opmode" id="opmode" value="edit">
				<table class="table table-bordered" >
					<tr>
						<th class="col-10">
						<nobr>
							员工编号*
						</nobr></th>
						<td colspan="2" class="col-30">
						<input class="form-control" type="text" id="emp_no" name="emp_no"  check="require" msg="请输入员工编号" readonly="readonly">
						</td>
						<td rowspan="3" class="col-20">
							<img class="img-thumbnail col-12" id="emp_pic" onerror="javascript:this.src='/Uploads/emp_pic/no_avatar.jpg'" >
							
						</td>
					</tr>
					<tr>
						<th>姓名*</th>
						<td colspan="2">
						<input  class="form-control" type="text" id="name" name="name" class="input-sm" check="require" msg="请输入姓名">
						</td>
					</tr>
					
					<tr>
						<th>性别</th>
						<td colspan="2">
						<select name="sex" id="sex" class="form-control col-10">
							<option  value="male">男</option>
							<option value="female">女</option>
						</select></td>
					</tr>
					<tr>
						<th>生日</th>
						<td colspan="2">
						<input  type="text" id="birthday" name="birthday" readonly="readonly" class="input-date form-control" readonly="readonly">
						</td>
						<td colspan="2"><a onclick="select_avatar();" class="btn btn-sm btn-primary">上传头像</a>
							</td>
					</tr>
					<tr>
						<th>部门*</th>
						<td class="col-20">
						<div class="input-group ">
							<input class="form-control" name="dept_name"  id="dept_name" type="text" msg="请选择部门" check="require" readonly="readonly" />
							<input name="dept_id" id="dept_id" type="hidden" msg="请选择部门" check="require" />
							<div class="input-group-btn">
								<a class="btn btn-sm btn-primary" onclick="select_dept();" > <i class="fa fa-search" ></i> </a>
							</div>
						</div></td>
						<th class="col-10">职位*</th>
						<td>
						<select name="position_id" id="position_id" class="form-control" msg="请选择职位" check="require">
							<option value="">选择职位</option>
							<?php echo fill_option($position_list);?>
						</select></td>
					</tr>
					<tr>
						<th>
						<nobr>
							办公室电话
						</nobr></th>
						<td>
						<input type="text" id="office_tel" name="office_tel" class="form-control">
						</td>
						<th>
						<nobr>
							移动电话
						</nobr></th>
						<td>
						<input type="text" id="mobile_tel" name="mobile_tel" class="form-control">
						</td>
					</tr>
					<tr>
					<tr>
						<th>电子邮箱</th>
						<td colspan="3">
						<input type="text" id="email" name="email" class="form-control">
						</td>
					</tr>
					<tr>
						<th>
						<nobr>
							负责业务
						</nobr></th>
						<td colspan="3">
						<input type="text" id="duty" name="duty" class="form-control">
						</td>
					</tr>
					<tr>
						<th>状态</th>
						<td colspan="3">
						<select class="form-control col-10"  name="is_del" id="is_del">
							<option  value="0">启用</option>
							<option value="1">禁用</option>
						</select></td>
					</tr>
					<tr>
						<td colspan="5">
						<p align="">
							带*为必填选项
						</p></td>
					</tr>
				</table>
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
			winopen("<?php echo U('add');?>", 560, 470);
		};
		

		function del() {
			if ($("input[name='user_id[]']:checked").length == 0) {
				ui_error('请选择要删除的人员 ');
				return;
			}
			var vars = $("#form_user").serialize();
			ui_confirm('确定要删除吗?', function() {
				sendAjax("<?php echo U('del');?>", vars, function(data) {
					if (data.status) {
						ui_alert(data.info, function() {
							location.reload(true);
						});
					}
				});
			});
		}

		function reset_pwd() {
			if ($("#id").val().length < 1) {
				ui_error("请选择用户");
				return false;
			}
			winopen("<?php echo U('password');?>?id=" + $("#id").val(), 560, 470);
		}

		function import_user() {
			window.open("<?php echo U('import');?>", "_self");
			return false;
		}

		function select_dept() {
			winopen("<?php echo U('dept/winpop2');?>", 560, 470);
		}

		

		function select_avatar() {
			if ($("#id").val().length < 1) {
				ui_error("请选择用户");
				return false;
			}
			winopen("<?php echo U('popup/avatar');?>?id=" + $("#id").val(), 560, 470);
		}

		function select_signature() {
			if ($("#id").val().length < 1) {
				ui_error("请选择用户");
				return false;
			}
			winopen("<?php echo U('popup/signature');?>?id=" + $("#id").val(), 560, 470);
		}

		function btn_search() {
			sendForm("form_search", "/xiaowei/index.php?m=&c=user&a=index");
			$("#form_search").submit();
		}

		function key_search() {
			if (event.keyCode == 13) {
				sendForm("form_search", "/xiaowei/index.php?m=&c=user&a=index");
				return false;
			}
		}

		function save() {
			sendForm("form_data", "<?php echo U('save');?>");
		}

		function showdata(result) {
			$("#form_data select ").each(function() {
				$(this).find('option:first').attr('selected', 'selected');
			});
			for (var s in result.data) {
				set_val(s, result.data[s]);
			}
			$("#dept_name").val($("#dept_list option[value='" + $("#dept_id").val() + "']").text());
			img_url = $("#pic").val();
			if (img_url != "") {
				img_url += "?t=" + Math.random();
				$("#emp_pic").attr("src", img_url);
			} else {
				$("#emp_pic").attr("src", "/Uploads/emp_pic/no_avatar.jpg");
			}

			$("#save_name").val("");
			$("#opmode").val("edit");
		}


		$(document).ready(function() {
			set_return_url();
			set_val('eq_is_del', "<?php echo ($eq_is_del); ?>");
			$(".sub_left_menu tbody td.click").click(function() {
				$tr = $(this).parent();
				$(".sub_left_menu tbody tr.active").removeClass("active");
				$tr.addClass("active");
				sendAjax("<?php echo U('read');?>", "id=" + $tr.attr("id"), function(data) {
					showdata(data);
				});
				return false;
			});
		});

	</script>

	</body>
</html>