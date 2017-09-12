<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>我的</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/App/style/css/public.css">
	<link rel="stylesheet" type="text/css" href="/App/style/css/user.css">
	<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js"></script>
	<script>
		document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		$(window).resize(function () {  
			document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		 }) 
	</script>
</head>
<body>
	<div class="header">
		<a class="search" href="search.html"><img src="/App/style/img/search_icon.png"></a>
		<a class="back" href=""><img src="/App/style/img/back_last.png"></a>
		<i class="line"></i>
		<h3>我的</h3>
	</div>

	<div class="content">
		<div class="user">
			<img src="http://pan.baidu.com/share/qrcode?w=150&h=150&url=http://<?php echo $_SERVER['HTTP_HOST']; echo U('Home/Index/index');?>">
			<h3><?php echo ($config["name"]); ?></h3>
			<p>账号：<?php echo ($config["username"]); ?></p>
		</div>
		<div class="items">
			<div class="item">
				<a href="<?php echo U('Home/Index/index',array('agent'=>$config['agent_id']));?>">
					<img class="icon" src="/App/style/img/user_1.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>我的店铺</p>
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('Money/index');?>">
					<img class="icon" src="/App/style/img/user_2.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>钱包</p>
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('Procurement/index');?>">
					<img class="icon" src="/App/style/img/user_3.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>采购单</p>
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('Collection/index');?>">
					<img class="icon" src="/App/style/img/user_4.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>收藏夹</p>
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('User/index');?>">
					<img class="icon" src="/App/style/img/user_5.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>我的代理商</p>
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('Address/index');?>">
					<img class="icon" src="/App/style/img/user_6.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>地址管理</p>
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('Config/index');?>">
					<img class="icon" src="/App/style/img/user_7.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>设置</p>
				</a>
			</div>

			<div class="item">
				<a href="<?php echo U('Login/exitlogin');?>">
					<img class="icon" src="/App/style/img/exit.png">
					<img class="right" src="/App/style/img/user_0.png">
					<p>退出登录</p>
				</a>
			</div>
			
		</div>
	</div>

	<div class="footer">
		<a href="<?php echo U('Home/Index/index');?>">
			<img class="shadow" src="/App/style/img/index_icon.png">
			<img class="light" src="/App/style/img/index_icon_on.png">
			<span>首页</span>
		</a>
		<a href="<?php echo U('Home/Recommended/index');?>">
			<img class="shadow" src="/App/style/img/tuijian_icon.png">
			<img class="light" src="/App/style/img/tuijian_icon_on.png">
			<span>推荐</span>
		</a>
		<a class="on" href="<?php echo U('Agent/Index/index');?>">
			<img class="shadow" src="/App/style/img/us_icon.png">
			<img class="light" src="/App/style/img/us_icon_on.png">
			<span>我的</span>
		</a>
	</div>
	<!-- <div class="back_top">
		<img src="/App/style/img/back_top.png">
	</div> -->
</body>
</html>
<script type="text/javascript">
	$(function(){
		// 返回顶部
		$('.back_top').click(function(){
			$('html,body').animate({scrollTop:0},300)
		})
	})
</script>