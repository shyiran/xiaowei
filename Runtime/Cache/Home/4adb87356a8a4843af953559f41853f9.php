<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
		<link href="/xiaowei/Public/Ins/css/bootstrap.min.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/animate.css" rel="stylesheet">
		<link href="/xiaowei/Public/Ins/css/plugins/swiper/css/swiper.min.css" />
		<link href="/xiaowei/Public/Ins/css/plugins/toastr/toastr.min.css" rel="stylesheet">

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

	<body class="popup">
		<div class="popup-container">
			
	<div class="popup-fixed">
		<div class="popup-header clearfix">
			<div class="pull-left">
				<label>
					<input class="ace" type="radio" id="rb_dgp" name="type" value="dgp" >
					<span class="lbl">部门级别-职位</span> </label>
				<label>
					<input class="ace" type="radio" id="rb_dp" name="type" value="dp" >
					<span class="lbl">部门-职位</span> </label>

				<label>
					<input class="ace" type="radio" id="rb_dept" name="type" value="dept"  >
					<span class="lbl">部门</span> </label>

				<label>
					<input class="ace" type="radio" id="rb_emp" name="type" value="emp"  >
					<span class="lbl">人员</span> </label>
			</div>
			<div class="pull-right">
				<a onclick="save();" class="btn btn-sm btn-primary">确定</a>
				<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
			</div>
		</div>
		<div class="popup-body clearfix">
			<div class="col-23 pull-left">
				<span class="popup-label"><b class="hidden dgp">部门级别</b><b class="hidden dp dept emp">部门</b></span>
				<div class="popup_tree_menu">
					<div id="dept_grade" style="width:100%;height:179px;" class="dgp hidden">
						<?php echo ($list_dept_grade); ?>
					</div>
					<div id="dept" style="width:100%;height:179px;" class="dp hidden dept">
						<?php echo ($list_dept); ?>
					</div>
					<div id="emp" style="width:100%;height:179px;" class="emp hidden">
						<?php echo ($list_dept); ?>
					</div>
				</div>
				<div>
					<span class="popup-label"><b class="hidden dgp dp ">职位</b></span>
					<span class="popup-label"><b class="hidden emp">人员</b></span>
				</div>
				<div id="position" class="hidden dgp dp " style="width:100%;height:179px;">
					<?php echo ($list_position); ?>
				</div>
				<div id="addr_list" class="hidden  emp" style="width:100%;height:179px;"></div>
			</div>
			<div class="col-30 pull-left">
				<div class="col-7 pull-left text-center mid" style="margin-top: 24px;">
					<div style="height:206px;">
						<a onclick="add_address('rc');" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-right"></i></a>
						<a onclick="save();" class="hidden-lg btn btn-sm btn-primary">确定</a>
						<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
					</div>
					<a onclick="add_address('cc');" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-right"></i></a>
				</div>
				<div class="col-23 pull-left">
					<b class="popup-label">审批</b><span id="rc_count"></span>
					<div id="rc" class="selected" style="width:100%;height:179px;overflow:hidden">
						<ul></ul>
					</div>
					<b class="popup-label">协商</b><span id="cc_count"></span>
					<div id="cc" class="selected" style="width:100%;height:179px;overflow:hidden">
						<ul></ul>
					</div>
				</div>
			</div>
		</div>
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

		$(document).on("click", ".selected a.fa-times", function() {
			$(this).parent().remove();
			recount();
		});

		// 双击添加到收件人 因后添加的数据 所以需要用live函数
		$(document).on("dblclick", "#addr_list label", function() {
			$text = $(this).text();
			$val = $(this).find("input").val();
			if ($("#rc.selected li[data='" + $val + "']").length == 0) {
				$li = $('<li><span></span><a class="fa fa-times"></a></li>');
				$li.find('span').text($text);
				$li.attr('data', $val);
				$li.appendTo("#rc.selected ul");
				recount();
			};
		});

		function recount() {
			$("#rc_count").text("(" + $("#rc.selected li").length + ")");
			$("#cc_count").text("(" + $("#cc.selected li").length + ")");
			$("#bcc_count").text("(" + $("#bcc.selected li").length + ")");
		}

		function save() {
			$("#confirm_wrap,#consult_wrap,#refer_wrap", parent.document).hide();
			$("#confirm_wrap .address_list,#consult_wrap .address_list,#refer_wrap .address_list", parent.document).html("");

			$("#rc.selected li").each(function(i) {
				emp_no = $(this).attr('data');
				name = jQuery.trim($(this).text());
				name = name.replace(/<.*>/, '');
				html_string = conv_inputbox_item(name, emp_no);
				$("#confirm_wrap .address_list", parent.document).append(html_string);
			});
			$("#cc.selected li").each(function(i) {
				emp_no = $(this).attr('data');
				name = jQuery.trim($(this).text());
				name = name.replace(/<.*>/, '');
				html_string = conv_inputbox_item(name, emp_no);
				$("#consult_wrap .address_list", parent.document).append(html_string);
			});

			$("#confirm_wrap span a", parent.document).remove();
			$("#confirm_wrap .address_list span", parent.document).append("<b><i class=\"fa fa-arrow-right\"></i></b>");
			$("#confirm_wrap .address_list span b:last", parent.document).html("<i class=\"fa\"></i>");

			$("#consult_wrap span a", parent.document).remove();
			$("#consult_wrap .address_list span", parent.document).append("<b><i class=\"fa fa-arrow-right\"></i></b>");
			$("#consult_wrap .address_list span b:last", parent.document).html("<i class=\"fa\"></i>");

			$("#confirm_wrap,#consult_wrap,#refer_wrap", parent.document).show();
			myclose();
		}

		// 显示AJAX 读取的数据
		function showdata(result) {

			$("#addr_list").html("");
			for (s in result.data) {
				var id = result.data[s].id;
				var position_name = result.data[s].position_name;
				var emp_no = result.data[s].emp_no;
				var email = result.data[s].email;
				var name = result.data[s].name;
				var name = name + "/" + position_name;
				var html_string = conv_address_item(name, emp_no);
				$("#addr_list").append(html_string);
			}
		}

		$(document).ready(function() {
			$("#rb_<?php echo ($type); ?>").prop('checked', true);
			// 选择用户默认选择的类型

			$(".<?php echo ($type); ?>").removeClass("hidden");

			$("input[name='type']").on('click', function() {
				$("input[name='type']").each(function() {
					$("." + $(this).val()).addClass("hidden");
				});
				$("." + $(this).val()).removeClass("hidden");
			});

			$("#emp .tree_menu  a").click(function() {
				$(".emp .tree_menu a").attr("class", "");
				var type = $("input[name='type']:checked").val();
				$(this).addClass("active");
				sendAjax("<?php echo U('read');?>", "type=" + type + "&id=" + $(this).attr("node"), function(data) {
					showdata(data);
				});
				return false;
				//禁止连接生效
			});

			$("#dept .tree_menu a").click(function() {
				$("#dept .tree_menu a").each(function() {
					$(this).attr("class", "");
				});
				$(this).addClass("active");

				var type = $("input[name='type']:checked").val();

				return false;
				//禁止连接生效
			});

			$("#dept_grade .tree_menu a").click(function() {
				$("#dept_grade .tree_menu a").each(function() {
					$(this).attr("class", "");
				});
				$(this).addClass("active");

				var type = $("input[name='type']:checked").val();

				return false;
				//禁止连接生效
			});

			$("#position .tree_menu a").click(function() {
				$("#position .tree_menu a").each(function() {
					$(this).attr("class", "");
				});
				$(this).addClass("active");

				var type = $("input[name='type']:checked").val();

				return false;
				//禁止连接生效
			});
		});
		//最终确认

		function add_address(name) {
			var type = $("input[name='type']:checked").val();
			switch(type) {
			case "dgp":
				$dept_grade_id = $("#dept_grade a.active").attr("node");
				$dept_grade_name = $("#dept_grade a.active span").text();

				if ($dept_grade_id == undefined) {
					ui_error("请选择部门级别");
					return false;
				}
				$position_id = $("#position a.active").attr("node");
				$position_name = $("#position a.active span").text();

				if ($position_id == undefined) {
					ui_error("请选择职位");
					return false;
				}
				$text = $dept_grade_name + "-" + $position_name;
				$val = "dgp_" + $dept_grade_id + "_" + $position_id;
				if ($("#" + name + ".selected li[data='" + $val + "']").length == 0) {
					$li = $('<li><span></span><a class="fa fa-times"></a></li>');
					$li.find('span').text($text);
					$li.attr('data', $val);
					$li.appendTo("#" + name + ".selected ul");
					recount();
				};
				break;
			case "dp":
				$dept_id = $("#dept a.active").attr("node");
				$dept_name = $("#dept a.active span").text();

				if ($dept_id == undefined) {
					ui_error("请选择部门");
					return false;
				}
				$position_id = $("#position a.active").attr("node");
				$position_name = $("#position a.active span").text();

				if ($position_id == undefined) {
					ui_error("请选择职位");
					return false;
				}
				$text = $dept_name + "-" + $position_name;
				$val = "dp_" + $dept_id + "_" + $position_id;
				if ($("#" + name + ".selected li[data='" + $val + "']").length == 0) {
					$li = $('<li><span></span><a class="fa fa-times"></a></li>');
					$li.find('span').text($text);
					$li.attr('data', $val);
					$li.appendTo("#" + name + ".selected ul");
					recount();
				};
				break;
			case "dept":
				$dept_id = $("#dept a.active").attr("node");
				$dept_name = $("#dept a.active span").text();

				if ($dept_id == undefined) {
					ui_error("请选择部门");
					return false;
				}
				$text = $dept_name;
				$val = "dept_" + $dept_id;
				if ($("#" + name + ".selected li[data='" + $val + "']").length == 0) {
					$li = $('<li><span></span><a class="fa fa-times"></a></li>');
					$li.find('span').text($text);
					$li.attr('data', $val);
					$li.appendTo("#" + name + ".selected ul");
					recount();
				};
				break;

			case "emp":
				$("input:checked[name='addr_id']").each(function() {
					$(this).prop('checked', false);
					$text = $(this).parents("label").text().trim();
					$val = "emp_" + $(this).val();
					if ($("#" + name + ".selected li[data='" + $val + "']").length == 0) {
						$li = $('<li><span></span><a class="fa fa-times"></a></li>');
						$li.find('span').text($text);
						$li.attr('data', $val);
						$li.appendTo("#" + name + ".selected ul");
						recount();
					};
				});
				break;
			}
		}
	</script>

		<script>
			$(document).ready(function() {
				$(".popup-container").width($("#dialog", parent.document).width());
				if (is_mobile()) {
					$(".popup-container").height(window.screen.height - 40);					
					$(".popup-container").css('overflow', 'auto');
					
					$(".popup-body").height(window.screen.height - 94);
				}
			});
		</script>
	</body>
</html>