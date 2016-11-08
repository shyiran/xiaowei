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
					
	<?php echo W('PageHeader/simple',array('name'=>$folder_name,'search'=>'N'));?>
	<div class="operate panel panel-default">
		<div class="panel-body">
			<div class="pull-left">
				<a class="btn btn-sm btn-primary" onclick="go_return_url()">返回</a>
			</div>
			<div class="pull-right" id="uploader">
				<a id="pickfiles" class="btn btn-sm btn-primary">导入</a>
				<a onclick="export_udf()" class="btn btn-sm btn-primary">导出</a>
				<a onclick="add()" class="btn btn-sm btn-primary">新增</a>
				<a onclick="save()" class="btn btn-sm btn-primary">保存</a>
				&nbsp;|&nbsp;
				<a onclick="del()" class="btn btn-sm btn-danger">删除</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 sub_left_menu ">
			<div class="well">
				<?php echo $menu ?>
			</div>
		</div>
		<div class="col-sm-8 ">
			<form method='post' id="form_data" class="well form-horizontal">
				<input type="hidden" name="controller" id="controller" value="<?php echo (CONTROLLER_NAME); ?>">
				<input type="hidden" name="row_type" id="row_type" value="<?php echo ($row_type); ?>">
				<input type="hidden" name="id" id="id" >
				<input type="hidden" id="opmode" name="opmode" value="edit">
				<input type="hidden" name="ajax" id="ajax" value="1">

				<div class="form-group">
					<label class="col-sm-4 control-label" for="name">名称*：</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="name" name="name" check="require" msg="请输入名称">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="type">控件类型*：</label>
					<div class="col-sm-8">
						<select name="type" id="type" check="require" msg="请选择控件类型" class="form-control col-12">
							<option value="">请选择</option>
							<option value="popup">弹窗选择</option>
							<option value="add_file">文件上传</option>
							<option value="text">单行文本</option>
							<option value="date">日期 </option>
							<option value="datetime">日期+时间 </option>
							<option value="select">列表</option>
							<option value="link_select">联动列表</option>
							<option value="radio">单选</option>
							<option value="checkbox">多选 </option>
							<option value="textarea">多行文本 </option>
							<option value="editor">编辑器</option>
							<option value="simple">简易编辑器</option>
							<option value="help">帮助 </option>
							<option value="hr">分隔符</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="layout">控件布局：</label>
					<div class="col-sm-8">
						<select name="layout" id="layout" check="require" msg="请选择控件布局" class="form-control col-12">
							<option value="">请选择 <option value="1">两列 <option value="2">整行 <option value="3">帮助 <option value="4">分隔符
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="data">控件数据：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="data" name="data" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="config">设置：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="config" name="config" >
					</div>
				</div>
				<div class="form-group =">
					<label class="col-sm-4 control-label" for="sort">排序：</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="sort" name="sort" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="validate">验证：</label>
					<div class="col-sm-8">
						<select name="validate" id="validate" class="form-control col-12">
							<option value="">请选择 <option value="require">必选 <option value="email">邮件 <option value="number">数字
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="msg">错误提示：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="msg" name="msg" >
					</div>
				</div>
			</form>
		</div>
	</div>
	<form method='post'  class="well form-horizontal clearfix">
		<?php if(is_array($field_list)): $i = 0; $__LIST__ = $field_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo W('UserDefineField/edit',array($vo)); endforeach; endif; else: echo "" ;endif; ?>
	</form>

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
		
	<script type="text/javascript" src="/xiaowei/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script>
	<script>
		var uploader = new plupload.Uploader({
			runtimes : 'html5,flash,html4',
			browse_button : 'pickfiles', // you can pass in id...
			container: document.getElementById('uploader'), // ... or DOM Element itself
			url : "<?php echo U('UdfField/import',array('row_type'=>$row_type,'controller'=>$controller));?>",
			flash_swf_url :'/xiaowei/Public/Ins/js/plugins/plupload/Moxie.swf',
			drop_element : 'main-container',
			filters : {
				max_file_size : '10mb',
				mime_types: [{title : "Image files", extensions : "xls,xlsx"},]
			},
			init : {
				FilesAdded : function(up, files) {
					up.start();
				},
				FileUploaded : function(up, file, data) {
					var myObject = eval('(' + data.response + ')');
					if (myObject.status) {
						ui_alert(myObject.info, function() {							
						});						
					} else {
						ui_alert(myObject.info, function() {							
						});
					}
				}
			}
		})
		function add() {
			winopen("<?php echo U('UdfField/add',array('controller'=>$controller,'row_type'=>$row_type));?>",560, 470);
		};

		function export_udf() {
			window.open("<?php echo U('UdfField/export',array('row_type'=>$row_type));?>", "_blank");
			return false;
		}

		function del() {
			ui_confirm('真的要删除吗?', function() {
				$("#opmode").val("del");
				sendForm("form_data", "", "/xiaowei/index.php?m=&c=flow&a=field_manage&row_type=37");				
			});
		};

		function save() {
			if ($("#opmode").val() == "") {
				ui_error("请选择要修改的数据");
				return false;
			} else {
				sendForm("form_data", "", "/xiaowei/index.php?m=&c=flow&a=field_manage&row_type=37");
			}
		};

		function showdata(result) {
			for (var s in result.data) {
				set_val(s, result.data[s]);
			}
		}

		$(document).ready(function() {
			$(".sub_left_menu .tree_menu  a").click(function() {
				$(".sub_left_menu .tree_menu  a").removeClass("active");
				$(this).addClass("active");
				sendAjax("<?php echo U('UdfField/read');?>", "id=" + $(this).attr("node"), function(data) {
					showdata(data);
				});
				return false;
			});
		});

	</script>

	</body>
</html>