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
	
	#tab-info th{
		width:80px;
	}
	#tab-info tr{
		line-height:50px;
		font-size:18px;
	}
	#tab-pwd tr{
		line-height:50px;
		font-size:18px;
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
	//弹出层管理
	var mask=$('.mask'),
	container=$('.container-popup'),
	title=$('.container-popup').find('.popup-title-text'),
	body=$('.container-popup>.popup-body');
	var popup=new pop(mask,container,title,body);
	//关闭弹出层
	$('.container-popup').find('.popup-title-close').bind('click',function(e){popup.hide();})
	$('.container-popup').on('click','.btn-cancel',function(e){e.preventDefault();popup.hide();});
   //修改密码
   $('.btn-pwd-edit').click(function(e){
		var pwd = $('input[name=pwd]').val();
		var pwd1 = $('input[name=pwd1]').val();
		var pwd2 = $('input[name=pwd2]').val();
		if(pwd&&(pwd1==pwd2)){
			$.post("<?php echo U('Teacher/User/edit_pwd');?>",{type:'pwd',pwd:pwd,pwd2:pwd2},function(r){
				popup.setTitle('修改密码结果').setBody('<p class=text-center>'+r.msg+'<p>').show();
			if(r.status==1){
						setTimeout(function(){popup.hide()},1000);
					}
			});
		}else alert('请输入原始密码以及确保2次密码输入一致！');
   });
	
	//初始化加载班级配置数据
		var dep_list = <?php echo ($dep["v"]); ?>;
		(function(l,c,dom){$.each(l,function(i,e){dom.append('<option value='+e+' '+(e==c?'selected':'')+'>'+e+'</option>');})})(dep_list,'<?php echo ($user["dep"]); ?>',$('#dep-list'));

	})
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
				<div style="height:20px"></div>
				<div class="tab border-main">
  <div class="tab-head">
    <strong>修改资料</strong>
    <ul class="tab-nav">
      <li class="active"><a href="#tab-info">修改个人信息</a></li>
      <li><a href="#tab-pwd">修改密码</a></li>
    </ul>
  </div>
  <div class="tab-body">
    <div class="tab-panel active" id="tab-info">
	<!---修改用户资料--->
	<div class='right-body'>
	<div class="alert alert-yellow" <?php echo ($r==1?'':'hidden'); ?>><span class="close rotate-hover"></span><strong>提示：</strong>更新成功！</div>
	<div class="alert alert-yellow" <?php echo ($r==0?'':'hidden'); ?>><span class="close rotate-hover"></span><strong>提示：</strong>更新失败！</div>
						<div class='x2'></div>
						<div class='x8' style='box-shadow:0 0 4px #aaa;padding:40px;margin:30px 0'>
						
						<form action="<?php echo U('Teacher/User/edit');?>" method="POST">
								<div class='info-left' style='width:60%;float:left'>
								
									<table>
									<tr><td>账      号：</td><td><?php echo ($user["user"]); ?></td></tr>
									<tr><td>姓      名：</td><td><?php echo ($user["name"]); ?></td></tr>
									<tr><td>部      门：</td><td> <?php echo ($user["dep"]); ?></tr>
									<tr><td>账号类型：</td><td>
									<?php switch($user['type']): case "1": ?>教师<?php break;?>
									<?php case "2": ?>院系主任<?php break;?>
									<?php case "3": ?>院长<?php break;?>
									<?php default: ?>默认情况<?php endswitch;?></tr>
									<tr><td>状      态：</td><td><?php echo ($user['status']==1?"<p class=text-green>正常</p>":"<p class=text-red>禁用</p>"); ?></td></tr>
									<tr><td colspan=2 class='text-gray'>联系方式</td></tr>
									<tr><td>Q  Q</td><td><input class='input' name='qq' value=<?php echo ($user["qq"]); ?>></td></tr>
									<tr><td>邮   箱</td><td><input class='input' name='email' value=<?php echo ($user["email"]); ?>></td></tr>
									<tr><td>办公电话</td><td><input class='input' name='officephone' value=<?php echo ($user["officephone"]); ?>></td></tr>
									<tr><td>手   机</td><td><input class='input' name='cellphone' value=<?php echo ($user["cellphone"]); ?>></td></tr>
									
									<tr><td colspan=2><button type="submit" class='button button-block bg-main'>更新信息</button></td></tr>
									</table>
								</div>
								<div class='info-right' style='width:40%;height:200px;float:left'>
									<div class='info-img' style='width:176px;height:195px;border:1px solid #000'>
									<img width=174 height=192 src='https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=801265354,741403095&fm=58'/>
									</div>
								</div>
							</form>
							</div>
							<div class='x2'></div>
						</div>
	<!---用户资料-->
	</div>
    <div class="tab-panel" id="tab-pwd">
		
		<div class='x4'></div>
		<div class='x4'>
								<table>
									<tr><td>请输入原密码</td><td><input type='password' name='pwd'></td></tr>
									<tr><td>请输入新密码</td><td><input type='password' name='pwd1'></td></tr>
									<tr><td>确认新密码</td><td><input type='password' name='pwd2'></td></tr>
									<tr><td colspan=2><button class='button button-block bg-main btn-pwd-edit'>确认修改</button></td></tr>
									
									</table>
									</div class='x4'></div>
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
  <div class='mask' style='position:fixed;top:0;width:100%;height:200%;background:rgba(0,0,0,0.6);display:none;'>
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