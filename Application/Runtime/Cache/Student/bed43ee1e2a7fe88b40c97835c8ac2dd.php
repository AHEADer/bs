<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>毕业设计课题信息</title>
<style type='text/css'>
*{
	font-family:'微软雅黑';
	padding:0;
	margin:0;
}
.top{
	text-align:center;
	height:45px;
	font-size:30px;
	background:rgb(72,145,198);
	color:#fff;
}
td{
	height:50px;
}
</style>
</head>

<body>
<div class='top'>
			毕 业 设 计 课 题 信 息
		</div>

<div align="left">
		<table border="0" width="100%" id="table1" style="border-collapse: collapse">
		<tr>
			<td align="right" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<span>题&nbsp;&nbsp;&nbsp; 目：</span></td>
			<td align="center" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4">
			<span><?php echo ($kt["bname"]); ?></span></td>
		</tr>
		<tr>
			<td align="right" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<font>指导老师：</font></td>
			<td align="center" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4">
			<span>
			<?php echo ($kt["tname"]); ?></span></td>
		</tr>
		
		<tr>
			<td align="right" width="24%" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<font>所属单位：</font></td>
			<td align="center" width="75%" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4">
			<span><?php echo ($kt["dep"]); ?></span></td>
		</tr>
		<tr>
			<td align="right" width="24%" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<font>联系方式：</font></td>
			<td align="center" width="75%" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4">
			<span><?php echo ($kt["email"]); ?></span></td>
		</tr>
		<tr>
			<td align="right" width="24%" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<font>课题类型：</font></td>
			<td align="center" width="75%" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4">
			<font id="bs_type"><?php echo ($kt["type"]); ?></font></td>
		</tr>
		<tr>
			<td align="right" width="24%" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<span>进行方式：</span></td>
			<td align="center" width="75%" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4"><span id="bs_way"><?php echo ($kt["way"]); ?></span></td>
		</tr>
		<tr>
			<td align="right" width="24%" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4" bgcolor="#FFFFFF">
			<font>目的要求：</font></td>
			<td align="center" width="75%" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 1px solid #DEEBF4"><span ><?php echo ($kt["require"]); ?></span></td>
		</tr>
		<tr>
			<td align="right" width="24%" style="border-left: 2px solid #4891C6; border-right: 1px solid #DEEBF4; border-top: 1px solid #DEEBF4; border-bottom: 2px solid #4891C6; " bgcolor="#FFFFFF">
			<font>预期目标：</font></td>
			<td align="center" width="75%" bgcolor="#FFFFFF" style="border-left: 1px solid #DEEBF4; border-right: 2px solid #4891C6; border-top: 1px solid #DEEBF4; border-bottom: 2px solid #4891C6; "><span ><?php echo ($kt["goal"]); ?></span></td>
		</tr>
		</table>
		</div>
	
</body>

</html>