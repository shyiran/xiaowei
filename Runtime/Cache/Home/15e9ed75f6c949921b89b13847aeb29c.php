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
					
	<?php echo W('PageHeader/simple',array('name'=>'新建：'.$flow_type['name']));?>
	<div class="operate panel panel-default">
		<div class="panel-body">
			<div class="pull-left">
				<a onclick="go_return_url();" class="btn btn-sm btn-primary">返回</a>
				<?php if(($flow_type["is_lock"]) == "0"): ?><a onclick="popup_confirm();"  class="btn btn-sm btn-primary">选择审批流程</a><?php endif; ?>
			</div>
			<div class="pull-right">
				<a onclick="save(10);"  class="btn btn-sm btn-primary">存草稿</a>
				<a onclick="save(20);"  id="post" class="btn btn-sm btn-primary">提交</a>
			</div>
		</div>
	</div>
	<form method='post' id="form_data" name="form_data" enctype="multipart/form-data" class="well form-horizontal">
		<input type="hidden" id="ajax" name="ajax" value="1">

		<input type="hidden" id="type" name="type" value="<?php echo ($flow_type["id"]); ?>">
		<input type="hidden" id="opmode" name="opmode" value="add">
		<input type="hidden" id="confirm" name="confirm" value="">
		<input type="hidden" id="confirm_name" name="confirm_name" value="">
		<input type="hidden" id="consult" name="consult" value="">
		<input type="hidden" id="consult_name" name="consult_name" value="">
		<input type="hidden" id="refer" name="refer" value="">
		<input type="hidden" id="refer_name" name="refer_name" value="">
		<input type="hidden" id="step" name="step" value="">

		<div class="form-group">
			<label class="col-sm-2 control-label" for="name">标题*：</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" id="name" name="name" check="require" msg="请输入标题">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" >文件编号：</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo ($flow_type["doc_no_format"]); ?>
				</p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" >审批：</label>
			<div class="col-sm-10 address_list_box">
				<p id="confirm_wrap" class="form-control-static address_list">
					<?php echo ($flow_type["confirm_name"]); ?>
				</p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" >协商：</label>
			<div class="col-sm-10 address_list_box">
				<p id="consult_wrap" class=" form-control-static address_list">
					<?php echo ($flow_type["consult_name"]); ?>
				</p>
			</div>
		</div>

		<div class="form-group hidden">
			<label class="col-sm-2 control-label" >抄送：</label>
			<div class="col-sm-10">
				<p id="refer_wrap" class="form-control-static address_list">
					<?php echo ($flow_type["refer_name"]); ?>
				</p>
			</div>
		</div>
		<?php if(is_array($field_list)): $i = 0; $__LIST__ = $field_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo W('UserDefineField/edit',array($vo)); endforeach; endif; else: echo "" ;endif; ?>
		<?php if(($flow_type["is_show"]) == "1"): ?><div class="form-group">
				<div class="col-xs-12">
					<textarea class="editor" id="content" name="content" style="width:100%;height:300px;"><?php echo ($flow_type["content"]); ?></textarea>
				</div>
			</div><?php endif; ?>
		<div class="form-group">
			<label class="col-sm-2 control-label" >附件：</label>
			<div class="col-sm-10">
				<?php echo W('FileUpload/add');?>
			</div>
		</div>
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
		
	<script type="text/javascript">
		$(document).ready(function() {
			udf_field.init();

			<?php if($flow_type['is_lock']==0){ ?>
			$('.address_list').on('mouseenter', 'span', function() {
				$(this).find('i').remove();
				$(this).append('<i class="fa fa-times"></i>');	 
			});
			$('.address_list').on('mouseleave', 'span', function() {
				$i = $(this).find('i');
				$i.removeClass('fa-times');
				$i.addClass('fa-arrow-right');
				$(".address_list span:last i").attr('class', 'fa');
			});

			$('.address_list').on('click', 'i', function() {
				$(this).parents('span').remove();
				$(".address_list span:last i").attr('class', 'fa');
			});
			<?php } ?>
		});
		
		function save(step) {
			$("#confirm").val("");
			$("#confirm_wrap  span").each(function() {
				$("#confirm").val($("#confirm").val() + $(this).attr("data") + '|');
			});

			$("#confirm_name").val($("#confirm_wrap").html());

			$("#consult").val("");
			$("#consult_wrap  span").each(function() {
				$("#consult").val($("#consult").val() + $(this).attr("data") + '|');
			});
			$("#consult_name").val($("#consult_wrap").html());

			if ($("#confirm").val().length < 2) {
				ui_error('请选择审批流程');
				return false;
			}
			$("#step").val(step);
			sendForm("form_data", "<?php echo U('save');?>", "<?php echo U('index');?>");
            var t=3;
			var int=setInterval(function(){
				t--;
				if(t==0){
					$("#post").html("提交")
					$("#post").attr("onclick","save(20)");
					 clearInterval(int);
	
				}else{
				  $("#post").attr("onclick","javascript:alert('不能重复提交！')");
				  $("#post").html("重新提交("+t+")")	
				}
			},1000)
			
		}

		function popup_confirm() {
			winopen("<?php echo U('popup/confirm');?>",560, 470);
		}

	</script>


	</body>
</html>