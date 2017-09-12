<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" /> 
		<title>支付结果通知</title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/wallet_lack.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';$(window).resize(function(){document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';})</script>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1>支付结果通知</h1>
			</div>
		</div>
		
		<div class="contains">	
			<div class="walletLack">
				<!-- <img src="/App/style/img/moneyTip.png"/> -->
				<?php if($res['code'] == 0){ ?>
					<img src="/App/style/img/feifa.png"/>
				<?php }elseif($res['code'] == 1){ ?>
					<img src="/App/style/img/zhifuchenggong.png"/>
				<?php }elseif($res['code'] == 2){ ?>
					<img src="/App/style/img/yizhifu.png"/>
				<?php }elseif($res['code'] == 3){ ?>
					<img src="/App/style/img/yuebuzu.png"/>
				<?php }elseif($res['code'] == 4){ ?>
					<img src="/App/style/img/zhifushibai.png"/>
				<?php } ?>
				<p><?php echo ($res['msg']); ?></p>
			</div>
		</div>
		

		<div class="defineFoot">
			<a href="<?php echo U('Agent/Procurement/index');?>">返回订单</a>
		<?php if($res['code'] == 0){ ?>
			<a href="<?php echo U('Home/Index/index',array('agent'=>AGENT_ID));?>">返回首页</a>
		<?php }elseif($res['code'] == 1){ ?>
			<a href="<?php echo U('Home/Index/index',array('agent'=>AGENT_ID));?>">继续购物</a>
		<?php }elseif($res['code'] == 2){ ?>
			<a href="<?php echo U('Home/Index/index',array('agent'=>AGENT_ID));?>">继续购物</a>
		<?php }elseif($res['code'] == 2){ ?>
			<a href="<?php echo U('Home/Index/index',array('agent'=>AGENT_ID));?>">去充值</a>
		<?php }elseif($res['code'] == 4){ ?>
			<a href="">重新支付</a>
		<?php } ?>
		</div>

	</body>

</html>