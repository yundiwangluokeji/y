<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>修改店铺名</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/App/style/css/public.css">
	<link rel="stylesheet" type="text/css" href="/App/style/css/modify_name.css">
	<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/App/style/layer/layer.js"></script>
	<script>
		document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		$(window).resize(function () {  
			document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		 }) 
	</script>
</head>
<body>
	<div class="header">
		<a class="back" href="javascript:history.go(-1)"><img src="/App/style/img/back_last.png"></a>
		<a class="save" href="javascript:;">保存</a>
		<i class="line"></i>
		<h3>修改店铺名</h3>
	</div>

	<div class="content">
		<form >
			<label>
				<input class="name" type="text" name="name" placeholder="店铺名称">
			</label>
			<p>请修改正确的店铺名称</p>
		</form>
	</div>

</body>
</html>