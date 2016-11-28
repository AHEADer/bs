<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <title>毕业设计(论文管理系统)</title>
    <meta name="keywords" content="毕业设计" />
    <meta name="description" content="论文管理系统" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="/bs/Public/lib/pintuer/pintuer.css">
	<link rel="stylesheet" href="/bs/Public/css/menu.css">
	<style type='text/css'>
	.btn-kt-report{
		display:<?php echo ($ktTimeCheck>0?'':'none'); ?>
	}
	.btn-kt-cancel{
		display:<?php echo ($ktTimeCheck>0?'':'none'); ?>
	}
	</style>
    <script src="/bs/Public/lib/pintuer/jquery.js"></script>
    <script src="/bs/Public/lib/pintuer/pintuer.js"></script>
	<script src="/bs/Public/js/menu.js"></script>
	<!----IE9以下增加media query-->
    <!--[if lt IE 9]>
	<script src="/bs/Public/lib/pintuer/respond.js"></script>
	<![endif]-->
    <script type='text/javascript'>
	$(function(){
	
	
	var mask=$('.mask'),
	container=$('.container-popup'),
	title=$('.container-popup').find('.popup-title-text'),
	body=$('.container-popup>.popup-body');
	var popup=new pop(mask,container,title,body);
		
	/***相关链接处理***/
	$('.container-popup').find('.popup-title-close').bind('click',function(e){
		popup.hide();
	})
	//选择全部
	$('input[name=selectall]').click(function(e){
		if($(e.target).is(':checked'))$.each($('input[type=checkbox]'),function(i,e){e.checked=true;});
		else $.each($('input[type=checkbox]'),function(i,e){e.checked=false;});
	});
	//获取所有选中项目
	function getCheckList(){
		var check_list=[];
		$.each($('input[name=check]'),function(i,e){
				if(e.checked){
					var id_ks = $(e).attr('data-id');
					check_list.push(id_ks);
				}
			});
		return check_list;
	}
	$('.toolbar .button').click(function(e){
			e.preventDefault();
			//查找所有check的
			var d=$(e.target);
			var check_list=getCheckList();
			if(check_list.length){
			//获取类型
				var op_type='';
				var op = '';
				if(d.hasClass('btn-kt-report')){
				//上报
					op_type = '上报';
					op = 'report';
				}else if(d.hasClass('btn-kt-cancel')){
				//取消上报
					op_type = '取消上报';
					op = 'cancel';
				}else if(d.hasClass('btn-kt-del')){
				//删除课题
					op_type = '删除';
					op = 'del';
				}
				popup.setTitle(op_type+'课题').setCss({width:'250px',height:'100px'});
				popup.setBody('<p>确定要'+op_type+check_list.join(',')+'号课题吗？</p><div style="text-align:center"><button class="button border-black link-del-yes" data-type='+op+'>确定</button><button class="button border-black btn-cancel">取消</button></div>');
				popup.show();
			}else{
				popup.setTitle('提示').setCss({width:'250px',height:'100px'});
				popup.setBody('<p class=text-center>您还未选中任何课题！</p>');
				popup.show();
			}
		})
	
		//确认操作
		$('.container-popup').on('click','.link-del-yes',function(e){
			var btn_edit = $(e.target);
			var op=btn_edit.attr('data-type');
			var check_list = getCheckList();
			$.post("<?php echo U('Teacher/Bs/index_handler');?>",{type:op,list:check_list},function(r){
				popup.append('<p class=text-center>'+r.msg+'</p>');
					if(r.status==1){
						setTimeout(function(){popup.hide();location.reload();},2000);
					}
			});
		})
		
			
		
		//取消操作
		$('.container-popup').on('click','.btn-cancel',function(){popup.hide();});
		
		//修改课题
		$('table').on("click",".btn-kt-edit",function(e){
			//检测课题状态，只有未上报的可以修改
			var ndom = $(e.target);
			if(ndom.parent().parent().children(':last').attr("data-status")!='0'){
				alert("课题已经上报无法修改！");
				return false;
			}
			var ktid = ndom.parent().prev().children().attr("data-id");
			window.open("<?php echo U('/Teacher/Bs/kt_edit');?>?id="+ktid,'newwindow','height=1000,width=890,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
		});
	});
	</script>
  </head>
<body>
	<!---全屏--->
	<div id='content'>
		<div class='layout admin'>
			<!--左侧菜单栏-->
			<div class='x2 left'>
				<div class='line user-info'>
					<div class='user-img'><img src='<?php echo ($user[pic]?$user[pic]:"https://ss1&#46;baidu&#46;com/6ONXsjip0QIZ8tyhnq/it/u=801265354,741403095&fm=58"); ?>' class='img-border radius-circle' width=100 height=100></div>
					<div class='user-name'><p class='text-center'><?php echo ($user["name"]); ?></p>
					<p class='text-center user-type'>
							<?php switch($ttype): case "1": ?>教师<?php break;?>
							<?php case "2": ?>系主任<?php break;?>
							<?php case "3": ?>院长<?php break;?>
							<?php default: ?>教师<?php endswitch;?>
						</p></div>
				</div>
				<?php if(($ttype > 1)): ?><div class='line menu'>
						<dl class='mainmenu start link'>
							<a href="<?php echo U('Teacher/Index/index');?>"><span class='icon-logo icon-home text-big'></span>开始</a>
						</dl>
						<dl class='mainmenu user'>
							<dt><span class='icon-logo icon-user text-big'></span>个人中心</dt>
								<dd class='link'><a href="<?php echo U('Teacher/User/view');?>">查看资料</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/User/edit');?>">修改资料</a></dd>
								
							
						</dl>
						
						<dl class='mainmenu bs'>
							<dt><span class='icon-logo icon-mortar-board text-big'></span>毕业设计</dt>
							
								<dd class='link'><a href="<?php echo U('Teacher/Bs/add');?>">课题填报</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/Bs/xt');?>">选题情况</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/Bs/manage');?>">毕设管理</a></dd>
							
						</dl>
						
						<dl class='mainmenu bs'>
							<dt><span class='icon-logo icon-mortar-board text-big'></span>课题管理</dt>
							
								<dd class='link'><a href="<?php echo U('Teacher/BsManager/preview');?>">课题总览</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/BsManager/ktsh');?>">课题审核</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/BsManager/history');?>">历史数据查询</a></dd>
							
						</dl>
						
						
						<dl class='mainmenu start link'>
							<a href="<?php echo U('Home/Login/logout');?>"><span class='icon-logo icon-power-off text-big'></span>退出</dl></a>
						<dl class='mainmenu text-center'>
							<p>请使用IE8+或chrome浏览</p>毕业管理系统管理后台
						</dl>
					
				</div>
				<?php else: ?> 
					<div class='line menu'>
						<dl class='mainmenu start link'>
							<a href="<?php echo U('Teacher/Index/index');?>"><span class='icon-logo icon-home text-big'></span>开始</a>
						</dl>
						<dl class='mainmenu user'>
							<dt><span class='icon-logo icon-user text-big'></span>个人中心</dt>
								<dd class='link'><a href="<?php echo U('Teacher/User/view');?>">查看资料</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/User/edit');?>">修改资料</a></dd>
								
							
						</dl>
						
						<dl class='mainmenu bs'>
							<dt><span class='icon-logo icon-mortar-board text-big'></span>毕业设计</dt>
							
								<dd class='link'><a href="<?php echo U('Teacher/Bs/add');?>">课题填报</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/Bs/xt');?>">选题情况</a></dd>
								<dd class='link'><a href="<?php echo U('Teacher/Bs/manage');?>">毕设管理</a></dd>
							
						</dl>
						<dl class='mainmenu start link'>
							<a href="<?php echo U('Home/Login/logout');?>"><span class='icon-logo icon-power-off text-big'></span>退出</dl></a>
						<dl class='mainmenu text-center'>
							<p>请使用IE8+或chrome浏览</p>毕业管理系统管理后台
						</dl>
					
				</div><?php endif; ?>
			</div>
			<!---右侧具体内容-->
			<div class='x10 right'>
				<div class='line'>
				<!---选题情况--->
					<div style='height:20px'></div>
					<div class="tab border-main">
					<div class="tab-head">
					<strong>课题填报</strong>
					
					<ul class="tab-nav">
					<li class='active'><a href="#">上报课题</a></li>
					<li><a href="<?php echo U('Teacher/Bs/add');?>">录入课题</a></li>
					
					</ul>
					</div>
					<div class="tab-body">
					<div class="tab-panel active">
					<!---显示课题审核情况-->
					<div class="alert alert-yellow"><span class="close rotate-hover"></span><strong>提示：</strong>课题申报时间段:<?php echo ($ktsb["kt_start"]); ?>至<?php echo ($ktsb["kt_end"]); ?></div>
					<table class='table table-hover'>
						<tr><th>选择</th><th>操作</th><th>课题编号</th><th>课题名称</th><th>上报/审核状态</th></tr>
						<?php if(is_array($kt)): $i = 0; $__LIST__ = $kt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kt): $mod = ($i % 2 );++$i;?><tr><td><input type='checkbox' name='check' data-id=<?php echo ($kt["id"]); ?>></td><td><button class='button border-main btn-kt-edit'>修改</button></td><td><?php echo ($kt["id"]); ?></td><td><?php echo ($kt["name"]); ?></td><td data-status='<?php echo ($kt[status]); ?>'><?php echo ($kt['status']>0?'<font color=green>已上报</font>':'<font color=red>未上报</font>'); ?>/
						<?php if(($kt['status'] > 1)): if(($kt['status'] > 2)): ?><font color=green>已通过院审核</font>
							<?php else: ?>
								<font color=blue>已通过系审核</font><?php endif; ?>
						<?php else: ?> <font color=red>待审核</font><?php endif; ?>
						
						</td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
					<div class='toolbar'>
						<input type='checkbox' name='selectall'>全选
						<button class='button btn-kt-report'>上报课题</button>&nbsp;<button class='button btn-kt-cancel'>取消上报</button>
						<button class='button btn-kt-del'>删除课题</button>
						<p>注意:只有未上报的课题才能修改。课题一旦批准后无法删除以及取消上报课题，如需操作，请联系管理员操作！</p>
					</div>
						
					</div>
					
					</div>
					</div>
					
					
					
				</div>
			</div>
		</div>
	</div>
  <!---footer--->
  <div id='footer'>
	<p class='text-center'>CopyRight2015毕业设计(论文)管理系统</p>
  </div>
  <!---全局遮罩层-->
  <div class='mask' style='position:fixed;top:0;width:100%;height:100%;background:rgba(0,0,0,0.6);display:none;'>
		  <!---弹出层--->
		<div class='container-popup' style='position:relative;width:300px;margin:auto;margin-top:200px;display:none'>
		<div class='popup-title' style='width:100%;height: 38px;color:#fff;padding:0 10px;line-height: 38px;position: relative;background:rgb(51,51,51);background: -webkit-gradient(linear,left top,right top,from(#000),to(#767676));border-bottom: 1px solid #d1d6dd;'>
		<span class='popup-title-text'>标题</span>
		<span class='popup-title-close icon-times' style='float:right;cursor:pointer;'></span>
		</div>
		<div class='popup-body' style='background:#fff;color:#000;min-height:100px;padding:10px'>
		</div>
		</div>
  </div>

  
  
</body>
</html>