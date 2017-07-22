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
					
	<?php echo W('PageHeader/adv_search',array('name'=>'记账明细'));?>
	<form method="post" name="form_adv_search" id="form_adv_search">
		<div class="adv_search panel panel-default  hidden"  id="adv_search">
			<div class="panel-heading">
				<div class="row">
					<h4 class="col-xs-6">高级搜索</h4>
					<div class="col-xs-6 text-right">
						<a  class="btn btn-sm btn-info" onclick="submit_adv_search();">搜索</a>
						<a  class="btn btn-sm " onclick="close_adv_search();">关闭</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="eq_account_id">账户：</label>
					<div class="col-sm-8">
						<select id="account_id" name="eq_account_id" class="form-control">
							<option value="">请选择</option>
							<?php echo fill_option($account_list);?>
						</select>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="li_type">类别：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="li_type" name="li_type" >
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="li_remark">摘要：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="li_remark" name="li_remark" >
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="li_content">客户/供应商：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="li_partner" name="li_partner" >
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="be_create_time">登录时间：</label>
					<div class="col-sm-8">
						<div class="input-daterange input-group" >
							<input type="text" class="input-sm form-control text-center" name="be_input_date" readonly="readonly"/>
							<span class="input-group-addon">-</span>
							<input type="text" class="input-sm form-control text-center" name="en_input_date" readonly="readonly"/>
						</div>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="li_content">经办：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="li_actor_name" name="li_actor_name" >
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="space-8"></div>
	<?php if($auth['write']): ?><div class="operate panel panel-default">
			<div class="panel-body">
				<div class="pull-right">
					<a class="btn btn-sm btn-primary" href="<?php echo U('account_list');?>" >账户管理</a>
					<a class="btn btn-sm btn-primary" onclick="add_income()">记收入</a>
					<a class="btn btn-sm btn-primary" onclick="add_payment()">记支出</a>
					<a class="btn btn-sm btn-primary" onclick="add_transfer()">记转账</a>
				</div>
			</div>
		</div><?php endif; ?>
	<div class="ul_table">
		<ul>
			<li class="thead">
				<span class="col-8 text-center">单据编号</span>
				<span class="col-8 text-center">日期</span>
				<div class="pull-right">
					<span class="col-8 ">账户</span>
					<span class="col-10 text-right">收入</span>
					<span class="col-10 text-right">支出</span>
					<span class="col-10 text-right">合计</span>
					<span class="col-10 text-center">类别</span>
					<span class="col-10  text-center">客户/供应商</span>
					<span class="col-6  text-center">经办</span>
					<span class="col-6  text-center">录入</span>
				</div>
				<span class="auto autocut">摘要 </span>
			</li>
			<?php if(empty($list)): ?><li class="no-data">
					没找到数据
				</li>
				<?php else: ?>
				<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li class="tbody data_item">
						<span class="col-8 text-center"><?php echo ($vo["doc_no"]); ?></span>
						<span class="col-8 text-center"><?php echo ($vo["input_date"]); ?></span>
						<div class="pull-right">
							<span class="col-8 "><?php echo ($vo["account_name"]); ?></span>
							<span class="col-10 text-right data data_1"><?php echo ((isset($vo["income"]) && ($vo["income"] !== ""))?($vo["income"]):0); ?></span>
							<span class="col-10 text-right data data_2"><?php echo ((isset($vo["payment"]) && ($vo["payment"] !== ""))?($vo["payment"]):0); ?></span>
							<span class="col-10 text-right data data_3"><?php echo ($vo['income']-$vo['payment']); ?></span>
							<span class="col-10 text-center"><?php echo ($vo["type"]); ?></span>
							<span class="col-10 text-center"><?php echo ($vo["partner"]); ?>&nbsp;</span>
							<span class="col-6 text-center"><?php echo ($vo["actor_name"]); ?></span>
							<span class="col-6 text-center"><?php echo ($vo["user_name"]); ?></span>
						</div>
						<span class="auto autocut"><a href="<?php echo U('read','id='.$vo['id']);?>"><?php echo ($vo["remark"]); ?></a></span>
					</li><?php endforeach; endif; ?>
				<li class="tbody data_total">
					<span class="col-8 text-center">合计</span>
					<span class="col-8 text-center">&nbsp;</span>
					<div class="pull-right">
						<span class="col-10 text-right data data_1"></span>
						<span class="col-10 text-right data data_2"></span>
						<span class="col-10 text-right data data_3"></span>
						<span class="col-32 text-center">&nbsp;</span>
					</div>
				</li>
				<div class="pagination">
					<?php echo ($page); ?>
				</div><?php endif; ?>
		</ul>
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
		$(document).ready(function() {
			set_return_url();
			total_init();
		});

		function total_init() {
			for (var i = 1; i < 11; i++) {
				total = 0;
				item_selecter = ".data_item .data_" + i;

				$(item_selecter).each(function() {
					total = dec_add(total, $(this).text());
				});
				total_selecter = ".data_total .data_" + i;
				$(total_selecter).text(total);
			}
			$(".ul_table .data").each(function() {
				$(this).text(formatMoney($(this).text()));
			});
		}

		function dec_add(num1, num2) {
			var reg = /\./i;
			if (!reg.test(num1) && !reg.test(num2)) {
				return parseInt(num1) + parseInt(num2);
			}
			var r1 = 0, r2 = 0, m;
			var str1 = num1.toString(), str2 = num2.toString();
			if (str1.indexOf('.') > -1) {
				r1 = str1.split('.')[1].length;
			}
			if (str2.indexOf('.') > -1) {
				r2 = str2.split('.')[1].length;
			}
			m = Math.pow(10, Math.max(r1, r2));
			return (dec_mul(num1, m) + dec_mul(num2, m)) / m;
		}

		function dec_mul(num1, num2) {

			var t1 = 0, t2 = 0, r1, r2;
			try {
				t1 = num1.toString().split(".")[1].length;
			} catch(e) {
				t1 = 0;
			}
			try {
				t2 = num2.toString().split(".")[1].length;
			} catch(e) {
				t2 = 0;
			}
			with (Math) {
				r1 = Number(num1.toString().replace(".", ""));
				r2 = Number(num2.toString().replace(".", ""));
				return (r1 * r2) / pow(10, t2 + t1);
			}
		}

		function formatMoney(numStr, separator) {
			s = numStr;
			if (/[^0-9\.\-]/.test(s))
				return "　";
			s = s.replace(/^(-)?(\d*)$/, "$1$2.");
			s = (s + "00").replace(/(-)?(\d*\.\d\d)\d*/, "$1$2");
			s = s.replace(".", ",");
			var re = /(\d)(\d{3},)/;
			while (re.test(s))
			s = s.replace(re, "$1,$2");
			s = s.replace(/,(\d\d)$/, ".$1");
			return s.replace(/^\./, "0.");
		}

		function formatQty(numStr, separator) {
			s = numStr;
			if (/[^0-9\.\-]/.test(s))
				return "　";
			s = s.replace(/^(-)?(\d*)$/, "$1$2.");
			s = (s + "00").replace(/(-)?(\d*\.\d\d)\d*/, "$1$2");
			s = s.replace(".", ",");
			var re = /(\d)(\d{3},)/;
			while (re.test(s))
			s = s.replace(re, "$1,$2");
			s = s.replace(/,(\d\d)$/, ".$1");
			s = s.replace(/^\./, "0.");
			if (s.split(".")[1] == "00")
				s = s.split(".")[0];
			return s;
		}

		function add_income() {
			window.open("<?php echo U('add_income');?>", "_self");
		}

		function add_payment() {
			window.open("<?php echo U('add_payment');?>", "_self");
		}

		function add_transfer() {
			window.open("<?php echo U('add_transfer');?>", "_self");
		}
	</script>

	</body>
</html>