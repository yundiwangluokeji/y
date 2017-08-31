<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/App/Home/style/css/public.css">
	<link rel="stylesheet" type="text/css" href="/App/Home/style/css/home.css">
	<script type="text/javascript" src="/App/Home/style/js/jquery-1.7.1.min.js"></script>
	<script>
		document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		$(window).resize(function () {  
			document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		 }) 
	</script>
</head>
<body>
	<div class="header">
		<a href="search.html"><img src="/App/Home/style/img/search_icon.png"></a>
		<h3>南方钟表</h3>
	</div>
	<div class="content">
		<ul>
		<?php if(is_array($data)): foreach($data as $key=>$v): ?><li><a title="<?php echo ($v['name']); ?>" href=""><img src="/App/Home/style/img/brand_img_15.jpg"></a></li><?php endforeach; endif; ?>
		</ul>
	</div>
	<div class="footer">
		<a class="on" href="">
			<img class="shadow" src="/App/Home/style/img/index_icon.png">
			<img class="light" src="/App/Home/style/img/index_icon_on.png">
			<span>首页</span>
		</a>
		<a href="">
			<img class="shadow" src="/App/Home/style/img/tuijian_icon.png">
			<img class="light" src="/App/Home/style/img/tuijian_icon_on.png">
			<span>推荐</span>
		</a>
		<a href="">
			<img class="shadow" src="/App/Home/style/img/us_icon.png">
			<img class="light" src="/App/Home/style/img/us_icon_on.png">
			<span>我的</span>
		</a>
	</div>
	<div class="back_top">
		<img src="/App/Home/style/img/back_top.png">
	</div>
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