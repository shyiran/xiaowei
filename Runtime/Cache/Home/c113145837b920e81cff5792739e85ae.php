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
					
	<script type="text/javascript"></script>
	<form method="post" action="" id="form_search" name="form_search">
		<?php echo W('PageHeader/simple',array('name'=>'系统信息','search'=>'N'));?>
	</form>
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title text-center">
					<h2>用户数量</h2>
				</div>
				<div class="ibox-content text-center">
					<h1 class="no-margins"><?php echo ($user_count); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title text-center">
					<h2>部门数</h2>
				</div>
				<div class="ibox-content text-center">
					<h1 class="no-margins"><?php echo ($dept_count); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title text-center">
					<h2>文件数量</h2>
				</div>
				<div class="ibox-content text-center">
					<h1 class="no-margins"><?php echo ($file_count); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title text-center">
					<h2>占用空间</h2>
				</div>
				<div class="ibox-content text-center">
					<h1 class="no-margins"><?php echo (reunit($file_spage)); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>文件数量/占用空间</h5>
						<div class="pull-right">
							<div class="btn-group flot">
								<a class="btn btn-xs btn-white flot_m" onclick="get_flot_data('m')"> &nbsp;月&nbsp; </a>
								<a class="btn btn-xs btn-white flot_q" onclick="get_flot_data('q')"> &nbsp;季&nbsp; </a>
								<a class="btn btn-xs btn-white flot_y" onclick="get_flot_data('y')"> &nbsp;年&nbsp; </a>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div class="flot-chart">
							<div class="flot-chart-content" id="flot-line-chart-multi"></div>
						</div>
					</div>
				</div>
			</div>
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
		
	<!-- Flot -->
	<script src="/xiaowei/Public/Ins/js/plugins/flot/jquery.flot.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/flot/jquery.flot.resize.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/flot/jquery.flot.pie.js"></script>
	<script src="/xiaowei/Public/Ins/js/plugins/flot/jquery.flot.time.js"></script>

	<!-- Flot demo data -->
	<script>
		function doPlot(file_count, file_size) {
			$.plot($("#flot-line-chart-multi"), [{
				data : file_count,
				label : "文件数量"
			}, {
				data : file_size,
				label : "占用空间",
				yaxis : 2
			}], {
				xaxes : [{
					mode : "time",
					timeformat : "%Y-%m-%d"
				}],
				yaxes : [{
					min : 0
				}, {
					// align if we are to the right
					alignTicksWithAxis : 1,
					position : "right",
					tickFormatter : euroFormatter
				}],
				legend : {
					position : 'sw'
				},
				colors : ["#1ab394"],
				grid : {
					color : "#999999",
					hoverable : true,
					clickable : true,
					tickColor : "#D4D4D4",
					borderWidth : 0,
					hoverable : true //IMPORTANT! this is needed for tooltip to work,
				},
				tooltip : true,
				tooltipOpts : {
					content : "%s %x : %y",
					xDateFormat : "%Y-%m-%d",
					onHover : function(flotItem, $tooltipEl) {
						// console.log(flotItem, $tooltipEl);
					}
				}
			});
		}
		
		function get_flot_data($range) {
			$(".flot a").removeClass("active");
			$(".flot a.flot_"+$range).addClass("active");
			sendAjax("<?php echo U('get_flot_data');?>",'range='+$range,function(data) {
				//alert(data.file_size);
				doPlot(eval(data.file_size), eval(data.file_count));			
			});
		}
		
		function euroFormatter(v, axis) {
			return v.toFixed(axis.tickDecimals) + "MB";
		}
			
		$(function() {
			var file_count = [[1167778800000, 61.05], [1167778800000, 58.32], [1167865200000, 57.35], [1167951600000, 56.31], [1168210800000, 55.55], [1168297200000, 55.64], [1168383600000, 54.02], [1168470000000, 51.88], [1168556400000, 52.99], [1168815600000, 52.99], [1168902000000, 51.21], [1168988400000, 52.24], [1169074800000, 50.48], [1169161200000, 51.99], [1169420400000, 51.13], [1169506800000, 55.04], [1169593200000, 55.37], [1169679600000, 54.23], [1169766000000, 55.42], [1170025200000, 54.01], [1170111600000, 56.97], [1170198000000, 58.14], [1170284400000, 58.14], [1170370800000, 59.02], [1170630000000, 58.74], [1170716400000, 58.88], [1170802800000, 57.71], [1170889200000, 59.71], [1170975600000, 59.89], [1171234800000, 57.81], [1171321200000, 59.06], [1171407600000, 58.00], [1171494000000, 57.99], [1171580400000, 59.39], [1171839600000, 59.39], [1171926000000, 58.07], [1172012400000, 60.07], [1172098800000, 61.14], [1172444400000, 61.39], [1172530800000, 61.46], [1172617200000, 61.79], [1172703600000, 62.00], [1172790000000, 60.07], [1173135600000, 60.69], [1173222000000, 61.82], [1173308400000, 60.05], [1173654000000, 58.91], [1173740400000, 57.93], [1173826800000, 58.16], [1173913200000, 57.55], [1173999600000, 57.11], [1174258800000, 56.59], [1174345200000, 59.61], [1174518000000, 61.69], [1174604400000, 62.28], [1174860000000, 62.91], [1174946400000, 62.93], [1175032800000, 64.03], [1175119200000, 66.03], [1175205600000, 65.87], [1175464800000, 64.64], [1175637600000, 64.38], [1175724000000, 64.28], [1175810400000, 64.28], [1176069600000, 61.51], [1176156000000, 61.89], [1176242400000, 62.01], [1176328800000, 63.85], [1176415200000, 63.63], [1176674400000, 63.61], [1176760800000, 63.10], [1176847200000, 63.13], [1176933600000, 61.83], [1177020000000, 63.38], [1177279200000, 64.58], [1177452000000, 65.84], [1177538400000, 65.06], [1177624800000, 66.46], [1177884000000, 64.40], [1178056800000, 63.68], [1178143200000, 63.19], [1178229600000, 61.93], [1178488800000, 61.47], [1178575200000, 61.55], [1178748000000, 61.81], [1178834400000, 62.37], [1179093600000, 62.46], [1179180000000, 63.17], [1179266400000, 62.55], [1179352800000, 64.94], [1179698400000, 66.27], [1179784800000, 65.50], [1179871200000, 65.77], [1179957600000, 64.18], [1180044000000, 65.20], [1180389600000, 63.15], [1180476000000, 63.49], [1180562400000, 65.08], [1180908000000, 66.30], [1180994400000, 65.96], [1181167200000, 66.93], [1181253600000, 65.98], [1181599200000, 65.35], [1181685600000, 66.26], [1181858400000, 68.00], [1182117600000, 69.09], [1182204000000, 69.10], [1182290400000, 68.19], [1182376800000, 68.19], [1182463200000, 69.14], [1182722400000, 68.19], [1182808800000, 67.77], [1182895200000, 68.97], [1182981600000, 69.57], [1183068000000, 70.68]];
			var file_size = [[1167606000000, 0.7580], [1167692400000, 0.7580], [1167778800000, 0.75470], [1167865200000, 0.75490], [1167951600000, 0.76130], [1168038000000, 0.76550], [1168124400000, 0.76930], [1168210800000, 0.76940], [1168297200000, 0.76880], [1168383600000, 0.76780], [1168470000000, 0.77080], [1168556400000, 0.77270], [1168642800000, 0.77490], [1168729200000, 0.77410], [1168815600000, 0.77410], [1168902000000, 0.77320], [1168988400000, 0.77270], [1169074800000, 0.77370], [1169161200000, 0.77240], [1169247600000, 0.77120], [1169334000000, 0.7720], [1169420400000, 0.77210], [1169506800000, 0.77170], [1169593200000, 0.77040], [1169679600000, 0.7690], [1169766000000, 0.77110], [1169852400000, 0.7740], [1169938800000, 0.77450], [1170025200000, 0.77450], [1170111600000, 0.7740], [1170198000000, 0.77160], [1170284400000, 0.77130], [1170370800000, 0.76780], [1170457200000, 0.76880], [1170543600000, 0.77180], [1170630000000, 0.77180], [1170716400000, 0.77280], [1170802800000, 0.77290], [1170889200000, 0.76980], [1170975600000, 0.76850], [1171062000000, 0.76810], [1171148400000, 0.7690], [1171234800000, 0.7690], [1171321200000, 0.76980], [1171407600000, 0.76990], [1171494000000, 0.76510], [1171580400000, 0.76130], [1171666800000, 0.76160], [1171753200000, 0.76140], [1171839600000, 0.76140], [1171926000000, 0.76070], [1172012400000, 0.76020], [1172098800000, 0.76110], [1172185200000, 0.76220], [1172271600000, 0.76150], [1172358000000, 0.75980], [1172444400000, 0.75980], [1172530800000, 0.75920], [1172617200000, 0.75730], [1172703600000, 0.75660], [1172790000000, 0.75670], [1172876400000, 0.75910], [1172962800000, 0.75820], [1173049200000, 0.75850], [1173135600000, 0.76130], [1173222000000, 0.76310], [1173308400000, 0.76150], [1173394800000, 0.760], [1173481200000, 0.76130], [1173567600000, 0.76270], [1173654000000, 0.76270], [1173740400000, 0.76080], [1173826800000, 0.75830], [1173913200000, 0.75750], [1173999600000, 0.75620], [1174086000000, 0.7520], [1174172400000, 0.75120], [1174258800000, 0.75120], [1174345200000, 0.75170], [1174431600000, 0.7520], [1174518000000, 0.75110], [1174604400000, 0.7480], [1174690800000, 0.75090], [1174777200000, 0.75310], [1174860000000, 0.75310], [1174946400000, 0.75270], [1175032800000, 0.74980], [1175119200000, 0.74930], [1175205600000, 0.75040], [1175292000000, 0.750], [1175378400000, 0.74910], [1175464800000, 0.74910], [1175551200000, 0.74850], [1175637600000, 0.74840], [1175724000000, 0.74920], [1175810400000, 0.74710], [1175896800000, 0.74590], [1175983200000, 0.74770], [1176069600000, 0.74770], [1176156000000, 0.74830], [1176242400000, 0.74580], [1176328800000, 0.74480], [1176415200000, 0.7430], [1176501600000, 0.73990], [1176588000000, 0.73950], [1176674400000, 0.73950], [1176760800000, 0.73780]];
			//	file_size=<?php echo ($file_size); ?>;

			get_flot_data('m');
					
			//doPlot(file_count, file_size);
		});

	</script>

	</body>
</html>