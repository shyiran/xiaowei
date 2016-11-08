<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
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
	<body class="<?php echo (CONTROLLER_NAME); ?> white-bg">
		<nav class="navbar navbar-default" role="navigation" id="top_menu">
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
					<?php if(is_array($top_menu)): foreach($top_menu as $key=>$top_menu_vo): ?><a class="nav-app" href="#" url="<?php echo (get_nav_url($top_menu_vo['url'])); ?>" node="<?php echo ($top_menu_vo["id"]); ?>" onclick="click_top_menu(this)" ><i class="<?php echo ($top_menu_vo["icon"]); ?>"></i><?php echo ($top_menu_vo["name"]); if(!empty($badge_count[$top_menu_vo['id']])){ $html=''; $html='<span class="label label-danger">'.$badge_count[$top_menu_vo['id']].'</span>'; echo $html; } ?></a><?php endforeach; endif; ?>
					<a class="nav-app btn-danger" href="<?php echo U('public/logout');?>"><i class="fa fa-sign-out"></i>退出</a></ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		<div id="wrapper" >
			<div id="home-wrapper" >
				<div class="wrapper wrapper-content">					
						
	<div class="row" id="sortable-view">
		<div class="col-sm-6 ui-sortable" id="t1">
			<div class="ibox" sort="11">
				<div class="ibox-title">
					<h5>邮件</h5>
					<div class="ibox-tools">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#mail-new">最新</a>
							</li>
							<li>
								<a data-toggle="tab" href="#mail-unread">未读</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="ibox-content">
					<div class="tab-content">
						<div id="mail-new" class="tab-pane in active ul_table">
							<ul>
								<?php if(is_array($new_mail_list)): $i = 0; $__LIST__ = $new_mail_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<span class="pull-right hidden-xs"><?php echo (to_date($vo["create_time"],'Y-m-d')); ?></span>
										<span  class="auto autocut"> <a href="<?php echo U('mail/read','id='.$vo['id']);?>&return_url=Mail/folder?fid=inbox" ><?php echo ((isset($vo["name"]) && ($vo["name"] !== ""))?($vo["name"]):"无标题"); ?></a> </span>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
						<div id="mail-unread" class="tab-pane ul_table">
							<ul>
								<?php if(is_array($unread_mail_list)): $i = 0; $__LIST__ = $unread_mail_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<span class="pull-right hidden-xs"><?php echo (to_date($vo["create_time"],'Y-m-d ')); ?></span>
										<span  class="auto autocut"> <a href="<?php echo U('mail/read','id='.$vo['id']);?>&return_url=Mail/folder?fid=inbox" node="85" return_url="<?php echo U('mail/folder/','fid=inbox');?>" onclick="click_home_list(this)"><?php echo ((isset($vo["name"]) && ($vo["name"] !== ""))?($vo["name"]):"无标题"); ?></a> </span>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="ibox" sort="12">
				<div class="ibox-title">
					<h5>信息</h5>
				</div>
				<div class="ibox-content">
					<div class="ul_table widget-main">
						<ul>
							<?php if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
									<span class="pull-right hidden-xs"><?php echo (to_date($vo["create_time"],'Y-m-d ')); ?></span>
									<span class="auto autocut"><a href="<?php echo U('info/read','id='.$vo['id']);?>&return_url=Info/index" >【<?php echo ($vo["folder_name"]); ?>】<?php echo ($vo["name"]); ?></a> </span>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 ui-sortable" id="t2">
			<div class="ibox" sort="21">
				<div class="ibox-title">
					<h5>审批</h5>
					<div class="ibox-tools">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#flow-todo">待办</a>
							</li>
							<li>
								<a data-toggle="tab" href="#flow-submit">已提交</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="ibox-content">
					<div class="tab-content">
						<div id="flow-todo" class="tab-pane in active ul_table">
							<ul>
								<?php if(is_array($todo_flow_list)): $i = 0; $__LIST__ = $todo_flow_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<span class="pull-right hidden-xs"><?php echo (to_date($vo["create_time"],'Y-m-d')); ?></span>
										<span  class="auto autocut"> <a href="<?php echo U('flow/read','id='.$vo['id'].'&fid=confirm');?>&return_url=Flow/folder?fid=confirm" ><?php echo ($vo["name"]); ?></a> </span>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
						<div id="flow-submit" class="tab-pane ul_table">
							<ul>
								<?php if(is_array($submit_flow_list)): $i = 0; $__LIST__ = $submit_flow_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<span class="pull-right hidden-xs"><?php echo (to_date($vo["create_time"],'Y-m-d')); ?></span>
										<span  class="auto autocut"> <a href="<?php echo U('flow/read','id='.$vo['id'].'&fid=submit');?>&return_url=Flow/folder?fid=submit" ><?php echo ($vo["name"]); ?></a> </span>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="ibox" sort="22">
				<div class="ibox-title">
					<h5>日程</h5>
					<div class="ibox-tools">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#calendar-todo">待办</a>
							</li>
							<li>
								<a data-toggle="tab" href="#calendar-schedule">日程</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="ibox-content">
					<div class="tab-content">
						<div id="calendar-schedule" class=" ul_table tab-pane ">
							<ul>
								<?php if(is_array($schedule_list)): $i = 0; $__LIST__ = $schedule_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<span class="pull-right hidden-xs"><?php echo (substr($vo["start_time"],0,10)); ?></span>
										<span  class="auto autocut"> <a href="<?php echo U('schedule/read2','id='.$vo['id']);?>&return_url=Schedule/index" ><?php echo ($vo["name"]); ?></a></span>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
						<div id="calendar-todo" class=" ul_table active tab-pane">
							<ul>
								<?php if(is_array($todo_list)): $i = 0; $__LIST__ = $todo_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<span class="pull-right hidden-xs"><?php echo ($vo["end_date"]); ?></span>
										<span  class="auto autocut"> <a href="<?php echo U('todo/edit','id='.$vo['id']);?>&return_url=Todo/index"><?php echo ($vo["name"]); ?></a> </span>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
					
				</div>
			</div>
		</div>
		<iframe src="<?php echo U('push/client');?>" class="push" id="push"></iframe>
		<!-- Mainly scripts -->
		<script src="/xiaowei/Public/Ins/js/jquery-2.1.1.js"></script>
		<script src="/xiaowei/Public/Ins/js/bootstrap.min.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="/xiaowei/Public/Ins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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
		$(function() {
			if (!is_mobile()) {
				WinMove();
			}
			init_sort("<?php echo ($home_sort); ?>");
		});

		function init_sort(sort_string) {
			if (sort_string == "") {
				sort_string = "11,12,13|21,22,23";
			}
			array_sort_string = sort_string.split("|");
			sort_string_1 = array_sort_string[0];
			sort_string_2 = array_sort_string[1];
			array_sort = sort_string_1.split(",");

			for (x in array_sort) {
				index = array_sort[x];
				last = $("#t1 .ibox:last");
				current = $(".ibox[sort='" + index + "']");
				if (index !== last.attr("sort")) {
					current.insertAfter(last);
				}
			}

			array_sort = sort_string_2.split(",");
			for (x in array_sort) {
				index = array_sort[x];
				last = $("#t2 .ibox:last");
				current = $(".ibox[sort='" + index + "']");
				if (index !== last.attr("sort")) {
					current.insertAfter(last);
				}
			}
		};
		function set_sort() {
			var sort_string;
			$("#t1 .ibox").each(function() {
				sort_string = sort_string + $(this).attr("sort") + ",";
			});
			sort_string = sort_string + "|";
			$("#t2 .ibox").each(function() {
				sort_string = sort_string + $(this).attr("sort") + ",";
			});
			sendAjax("<?php echo U('set_sort');?>", "val=" + sort_string);
		}

		// Dragable panels
		function WinMove() {
			var element = "[class*=col]";
			var handle = ".ibox-title";
			var connect = "[class*=col]";
			$(element).sortable({
				handle : handle,
				connectWith : connect,
				cancel : ".ibox-tools",
				tolerance : 'pointer',
				forcePlaceholderSize : true,
				opacity : 0.8,
				stop : function(event, ui) {
					t1_count = $("#t1 .ibox").length;
					t2_count = $("#t2 .ibox").length;
					if ((t1_count == 0) || (t2_count == 0)) {
						ui_error("至少保留一个");
						$(element).sortable('cancel');
						return false;
					} else {
						set_sort();
					}
				}
			}).disableSelection();
		}
	</script>

	</body>
</html>