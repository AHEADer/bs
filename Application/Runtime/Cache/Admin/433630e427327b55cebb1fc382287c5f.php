<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <title>毕业设计(论文管理系统)</title>
    <meta name="keywords" content="毕业设计" />
    <meta name="description" content="论文管理系统" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="/bs/Public/lib/pintuer/pintuer.css">
	<style type='text/css'>
	#content{
		min-width:936px;
		min-height:656px;
		background:#fff;
	}
	#footer{
		background:#eee;
		box-shadow:0 -1px 1px rgba(0,0,0,0.2);
		padding-top:10px;
		height:45px;
		//min-width:936px;

	}
	.admin .left{
		background:#fff;
		border-right:1px solid #e7e7eb;
	}
	.right{
		padding-left:20px;
		background:#fff;
	}
	//.user-info{
		//border-bottom:1px solid #e7e7eb;
	//}
	.user-img{
		width:100px;
		margin:0 auto;
	}
	.mainmenu{
		padding:10px 0;
		font-size:14px;
		color:rgb(178,178,178);
		border-top: 1px solid #e7e7eb;
	}
	.link{
	color:#000;
	}
	.mainmenu .link{
	padding-left:35px;
	color:#000;
	}
	.link:not(.selected):hover{
		background:rgb(222,222,220);
		cursor:pointer;
		
	}
	.selected{
		background:#44b549;
		color:#fff;
	}
	.icon-logo{
		margin:0 10px;
	}
	dd{
		padding:0;
		margin:0;
		line-height:34px;
	}
	.menu .active{
		background: #0a8;
		color: #fff;
		
	}
	.sites .site{
		list-style:none;
		width:205px;
		height:125px;
		float:left;
		background:#aaa;
		margin:20px;
	}
	.sites .op{
		//position:absolute;
		//background:rgba(0,0,0,0.4);
		background:rgba(0,0,0,0.4) none repeat scroll 0 0 !important;
		filter:Alpha(opacity=40);
		background:#000000;
		
		color:#fff;
		width:205px;
		padding-right:10px;
	}
	.sites .op>span:hover{
		color:rgb(68,181,73);
	}
	.sites .add{
		font-size:20px;
		padding-top:50px;
		text-align:center;
	}
	.sites .img-bg{
		width:205px;
		height:100px;
		text-align:center;
	}
	.sites .title{
		height:24px;
		line-height:24px;
		background:rgb(68,181,73);
		text-align:center;
		color:#fff;
	}
	/**弹出窗口关闭**/
	.icon-times:hover{
		color:#f00;
	}
	</style>
    <script src="/bs/Public/lib/pintuer/jquery.js"></script>
    <script src="/bs/Public/lib/pintuer/pintuer.js"></script>
	<script src='/bs/Public/lib/upload.js'></script>
	<!----IE9以下增加media query-->
    <!--[if lt IE 9]>
	<script src="/bs/Public/lib/pintuer/respond.js"></script>
	<![endif]-->
    <script type='text/javascript'>
	$(function(){
	var pop=function(mask,container,title,body){
		function setTitle(str){
			title.html(str);
			return this;
		}
		function setBody(str){
				body.html(str);
				return this;
		}
		function append(str){
			body.html(str);
			return this;
		}
		function setCss(obj){
			container.css(obj);
			return this;
		}
		function show(){
			mask.show();
			container.show();
			return this;
		}
		function hide(t){
			var delay = parseInt(t);
			mask.fadeOut();
			//container.fadeOut(delay);
			return this;
		}
		return {
			setTitle:setTitle,
			setBody:setBody,
			setCss:setCss,
			append:append,
			show:show,
			hide:hide
		}
	};
	
	var mask=$('.mask'),
	container=$('.container-popup'),
	title=$('.container-popup').find('.popup-title-text'),
	body=$('.container-popup>.popup-body');
	var popup=new pop(mask,container,title,body);
		
		/***相关链接处理***/
		$('.container-popup').find('.popup-title-close').bind('click',function(e){
			popup.hide();
		})
		//添加链接
		$('#link-add').click(function(){
			console.log('点击了');
			var link_add_html='<div class=line><form class="form-x">'+
			'<div class="form-group"><div class="label"><label for="link-title">选择文件</label></div><div class="field"><input type="file" class="input" name="upload" id="upload" size="30" placeholder="网站标题"></div></div>'+
			'<div class="form-group"><div class="label"><label for="link-url">文件名</label></div><div class="field"><input type="text" class="input" name="filename" size="30" placeholder="请输入命名文件名"></div></div></form>'+
			'<div style="text-align:center"><button class="button border-black link-add-yes">上传</button><button class="button border-black btn-cancel">取消</button></div>'+
'</div>';
			popup.setTitle('添加新文件').setCss({width:'400px',height:'200px'});
			popup.setBody(link_add_html);
			
			popup.show();
		});
		//自动命名文件
		$('body').on('change','input[name=upload]',function(e){
			var filePath = $('input[name=upload]').val();
			var file_a= filePath.split('\\');
			//Linux下路径暂时不考虑
			var fileName = file_a[file_a.length-1];
			$('input[name=filename]').val(fileName);
		});
		//删除链接
		$('.link-del').click(function(e){
			e.preventDefault();
			popup.setTitle('删除文件').setCss({width:'250px',height:'100px'});
			popup.setBody('<p>确定要删除"'+$(this).parent().attr('data-title')+'"吗？</p><div style="text-align:center"><button class="button border-black link-del-yes" data-id='+$(this).parent().attr('data-id')+'>确定</button><button class="button border-black btn-cancel">取消</button></div>');
			popup.show();
		})
		
		//ajax上传
		$('.container-popup').on('click','.link-add-yes',function(e){
			if($("input[name=upload]").val()!=""){
				 //上传文件处理
				 $.ajaxFileUpload({
								url:"<?php echo U('Admin/Index/doc_handler');?>",
								secureuri:false,
								fileElementId:'upload',
								dataType: 'json',
								data:{type:'upload',filename:encodeURI($('input[name=filename]').val())},
								success: function (data, status)
								{
									
										$('.popup-body').html('<p class=text-center>'+data.msg+'</p>');
										if(data.status){
											setTimeout(function(){location.reload();},2000);
										}
								},
								error: function (data, status, e)
								{
									console.log(data);
									console.log(status);
									console.log(e);
								}
							});
				 }else alert("请先选择文件！");
		});
		//确认删除
		$('.container-popup').on('click','.link-del-yes',function(e){
			var btn_edit = $(e.target);
			var id=btn_edit.attr('data-id');
			$.post("<?php echo U('Admin/Index/doc_handler');?>",{type:'del',id:id},function(r){
				r=JSON.parse(r);
				popup.append('<p class=text-center>'+r.msg+'</p>');
					if(r.status==1){
						setTimeout(function(){popup.hide();location.reload();},2000);
					}
			});
		})
		
		
		//取消操作
		$('.container-popup').on('click','.btn-cancel',function(){popup.hide();})
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
					<div class='user-img'><img src='https://ss1&#46;baidu&#46;com/6ONXsjip0QIZ8tyhnq/it/u=801265354,741403095&fm=58' class='img-border radius-circle' width=100 height=100></div>
					<div class='user-name'><p class='text-center'><?php echo ($user); ?></p></div>
				</div>
				
				<!---菜单开始-->
				<div class='line menu'>
						<dl class='mainmenu start link'>
							<a href="<?php echo U('Admin/Index/index');?>"><span class='icon-logo icon-home text-big'></span>开始</a>
						</dl>
						
						
						
						<dl class='mainmenu user'>
							<dt><span class='icon-logo icon-user text-big'></span>用户管理</dt>
								<dd class='link'><a href="<?php echo U('Admin/User/account');?>">新建用户</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/User/student');?>">学生</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/User/teacher');?>">教师</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/User/admin');?>">管理员</a></dd>
							
						</dl>
						
						<dl class='mainmenu bs'>
							<dt><span class='icon-logo icon-mortar-board text-big'></span>毕业设计</dt>
							
								<dd class='link'><a href="<?php echo U('Admin/Bs/preview');?>">课题总览</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/Bs/view');?>">查看课题</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/Bs/history');?>">历史数据查询</a></dd>
							
						</dl>
						<dl class='mainmenu sys'>
							<dt><span class='icon-logo icon-cog text-big'></span>系统设置</dt>
								<dd class='link'><a href="<?php echo U('Admin/Sys/init');?>">初始化</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/Sys/sel');?>">选项配置</a></dd>
								<dd class='link'><a href="<?php echo U('Admin/Sys/time');?>">毕设时间设置</a></dd>
						</dl>
						<dl class='mainmenu start link'>
							<a href="<?php echo U('Home/Login/logout');?>"><span class='icon-logo icon-power-off text-big'></span>退出</a>
						</dl>
					
						<dl class='mainmenu text-center'>
							<p>请使用IE8+或chrome浏览</p>毕业管理系统管理后台
						</dl>
					
				</div>
				
				<!--菜单结束-->
				
				
			</div>
			<!---右侧具体内容-->
			<div class='x10 right'>
				<div class='line'>
				<!---图片轮播、时间安排、最新动态、资料下载、链接管理--->
					<div style='height:20px'></div>
					<div class="tab border-main">
					<div class="tab-head">
					<strong>前台设置</strong>
					
					<ul class="tab-nav">
					
					<li><a href="<?php echo U('Admin/Index/plan');?>">时间规划</a></li>
					<li><a href="<?php echo U('Admin/Index/news');?>">动态新闻</a></li>
					<li class='active'><a href="#">相关资料</a></li>
					<li '><a href="<?php echo U('Admin/Index/link');?>">相关链接</a></li>
					</ul>
					</div>
					<div class="tab-body">
					<div class="tab-panel" id="tab-link" style="display:block">
					<!--相关链接-->
						<div class='line sites'>
							<!---模板输出-->
							<?php if(is_array($file)): $i = 0; $__LIST__ = $file;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><li class='site'>
								
									<div class="op text-right" data-title='<?php echo (urldecode($file["title"])); ?>' data-id='<?php echo ($file["id"]); ?>' data-link='<?php echo ($file["fileurl"]); ?>'>
										<span class="link-del icon-trash-o text-big" style='cursor:pointer' title="删除"></span>
									</div>
									<div class='img-bg'>
										<p class='text-left' style='white-space:nowrap;overflow:hidden'>文件名:<?php echo (urldecode($file["title"])); ?></p>
										<p class='text-left'>文件类型:<?php echo ($file["type"]); ?></p>
										<p class='text-left'>发布时间:<?php echo ($file["publishtime"]); ?></p>
									</div>
									
								
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<!---添加新连接-->
							<li class='site'>
								<a href=#>
									<div class='img-bg' id='link-add'>
										<span class='icon-plus text-large' style='font-size:100px' title='添加新文件'></span>
									</div>
									
								</a>
							</li>
							
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