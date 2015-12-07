<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <title>毕业设计(论文管理系统)</title>
    <meta name="keywords" content="毕业设计" />
    <meta name="description" content="论文管理系统" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="/bs/Public/lib/pintuer/pintuer.css">
	<link rel="stylesheet" href="/bs/Public/css/index.css">
	<style type='text/css'>
		#nav-menu li{
			padding-top:12px;
			padding-left:10px;
			font-size:1.2em;
			height:50px;
			
		}
		#nav-menu .active{
			border-left:3px solid rgb(0,170,136);
		}
		
		.news-head-title{
			background:#eee;
		}
		.news-head-time{
			background:#aaa;
		}
		.news-table-content{
			height:380px;
		}
		.news-table-content .line{
			font-size:15px;
			border-bottom:solid 1px #aaa;
			line-height:40px;
		}
		.news-table-content .x2{
			text-align:center;
		}
		//分页
	</style>
    <script src="/bs/Public/lib/pintuer/jquery.js"></script>
    <script src="/bs/Public/lib/pintuer/pintuer.js"></script>
    <!--[if lt IE 9]>
	<script src="/bs/Public/lib/pintuer/respond.js"></script>
	<![endif]-->
	
    <script type='text/javascript'>
	</script>
  </head>
  <body>
  <!---导航栏-->
  <div id='nav-top'>
	<div class='nav-center'>
		<div class='nav-logo'><img src='/bs/Public/img/logo.jpg' width=100px height=70px /></div>
		<div class='nav-title'>毕业设计(论文)管理系统</div>
		<div class='nav-user'>
			<div class="user-info" <?php echo ($user['login']?'':'hidden'); ?>>
                    <a class="user-home" href="<?php echo ($user["home"]); ?>">
                        <img width='40' height='40' class="img-border" src="<?php echo ($user["pic"]); ?>" alt="您的头像">
                        <span class="user-name textoverflow"><?php echo ($user["name"]); ?></span>
                    </a>
					<a  href="<?php echo U('Home/Login/logout');?>" title="退出" class='icon-logout'><span class="icon-power-off text-large"></span></a>                    
         
              
			</div>
			<!----没登录--->
			<div class="button border-main login-btn <?php echo ($user[login]?'hidden':''); ?>">
				<a href=<?php echo U('Home/Login/index');?>><span class='icon-user text-big'></span>登录</a> 
			</div>
		</div>
	</div>
  </div>
  <!---中部内容区--->
  <div id='content'>
	<div class='content-center'>
		<!--图片轮播+右侧新闻-->
		<div class='layout'>
			<!----面包屑导航测试-->
			<div class='line'>
				<ul class="bread bg-main bg-inverse">
				<li><a href="<?php echo U('Home/Index/index');?>" class="icon-home"> 首页</a></li>
				<li><a href="<?php echo U('Home/Index/news');?>" class='icon-bullhorn'>最新动态</a></li>
				<li class='active'>新闻正文</li>
				</ul>
			</div>
			
			<div class='line'>
			<!---左边导航栏--->
				<div class='xm2 xs2 hidden-l'>
					<button class="button icon-navicon" data-target="#nav-link1"></button>
						<ul class="nav nav-navicon" id="nav-menu">
						<li class="nav-head">首页</li>
						<li class='active'>最新动态</li>
						<li><a href="<?php echo U('Home/Index/file');?>">资料下载</a></li>
						<li><a href="<?php echo U('Home/Index/link');?>">相关链接</a></li>
						
						</ul>
				</div>
				<div class='xm9 xs9 xl12'>
				<!---右边正文-->
					
					<div class='news-detail' style='padding:12px 0 12px 0'>
						<div class='content-head'>
							<p>最新动态>正文</p>
							<h1 class='text-center'><b><?php echo ($news["title"]); ?></b></h1>
							<hr style='border:0px solid #000'>
							<p class='text-center'><span>发布时间:<?php echo ($news["publishtime"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>来源：<?php echo ($news["author"]); ?></span></p>
						</div>
						<div class='content-body' style='min-height:358px'>
							<p style='font-size:16px;font-family:宋体;text-indent:32px'><?php echo ($news["content"]); ?></p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!--新闻、下载、链接-->
		
	</div>
  </div>
  <!---footer--->
  <div id='footer'>
	<p class='text-center'>CopyRight2015毕业设计(论文)管理系统</p>
  </div>
  </body>
</html>