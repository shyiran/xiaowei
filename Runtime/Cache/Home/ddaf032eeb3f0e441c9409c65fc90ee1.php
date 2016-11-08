<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
		<link href="/xiaowei/Public/Ins/css/bootstrap.min.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/plugins/toastr/toastr.min.css" rel="stylesheet">

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
	<body class="white-bg">
		
	<div class="Public container">
		<!-- /container -->
		<div class="row">
			<div class="col-xs-12 hidden-xs" style="margin-top:120px;"></div>
		</div>
		<div class="row">
			<div class="col-sm-8 hidden-xs">
				<div class="img"></div>
			</div>
			<div class="col-sm-4 well">
				<div style="margin-bottom:44px;margin-top:20px;">
					<h1 class="text-center"><?php echo get_system_config("system_name");?></h1>
				</div>
				<form method="post" id="form_login" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3  control-label" for="emp_no">帐号：</label>
						<div class="col-sm-9">
							<input class="form-control" id="emp_no" name="emp_no" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3  control-label" for="password">密码：</label>
						<div class="col-sm-9">
							<input class="form-control" id="password" type="password" name="password" />
						</div>
					</div>
					<?php if(!empty($is_verify_code)): ?><div class="form-group">
							<label class="col-sm-3  control-label" for="verify">验证码：</label>
							<div class="col-sm-9 row">
								<div class="col-xs-6">
									<input class="form-control" id="verify" name="verify" />
								</div>
								<div class="col-xs-6">
									<img src="<?php echo U('verify');?>" style='cursor:pointer' title='刷新验证码' id='verifyImg' onclick='freshVerify()'>
								</div>
							</div>
						</div><?php endif; ?>
					<div class="form-group hidden">
						<span class="col-sm-3  control-label"> </span>
						<div class="col-sm-9">
							<label class="inline pull-left col-3">
								<input class="ace" type="checkbox" name="remember" value="1" />
								<span class="lbl"> </span> </label>
							<label for="remember-me">记住我的登录状态</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<input type="button" value="登录" onclick="login();" class="btn btn-sm btn-primary col-10">

						</div>
					</div>
				</form>
				<p>

				</p>
				<p>
					&nbsp;
				</p>
				<p>
					&nbsp;
				</p>
			</div>
		</div>

		<!-- 开源版不允许删除版权链接 谢谢支持  -->
		<div class="row text-right">
			版权所有：<a href="http://www.smeoa.com">小微OA</a>
		</div>
	</div>


		<!-- Mainly scripts -->
		<script src="/xiaowei/Public/Ins/js/jquery-2.1.1.js"></script>
		<script src="/xiaowei/Public/Ins/js/bootstrap.min.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="/xiaowei/Public/Ins/js/inspinia.js"></script>
		<script src="/xiaowei/Public/Ins/js/common.js"></script>
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
		function login() {
			sendForm("form_login", "<?php echo U('public/check_login');?>");
		}

		function freshVerify() {
			$('#verifyImg').attr("src", $('#verifyImg').attr("src") + "&" + Math.random());
		}

		$(document).ready(function() {
			var $dom = "#password";
			if($("#verify").length){
				$dom = "#verify";
			}
			$($dom).keydown(function(event) {
				if (event.keyCode == 13) {
					sendForm("form_login", "<?php echo U('public/check_login');?>");
					return false;
				}
			});
		});
	</script>

	</body>
</html>