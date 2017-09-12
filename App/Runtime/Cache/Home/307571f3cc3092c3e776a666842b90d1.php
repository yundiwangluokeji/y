<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" /> 
		<title><?php echo ($config['name']); ?></title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/conOrder.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>
		<script type="text/javascript" src="/App/style/layer/layer.js" ></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';$(window).resize(function(){document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';})</script>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1>确认订单</h1>
			</div>
		</div>
		
		<div class="contains">	
			<!--添加地址-->
			<?php if(!$address){ ?>
			<div class="addAddress" onclick="window.location.href='<?php echo U('Home/Buy/choose_address');?>?type=<?php echo ACTION_NAME;?>'">
				<div class="mg clear">
					<span>
						<img src="/App/style/img/adress.png"/>
						<h2>请选择收货地址</h2>
					</span>					
					<img src="/App/style/img/arrow02.png"/>
				</div>
			</div>
			<?php }else{ ?>
			<!--已有地址-->
			<div class="yetAddress" onclick="window.location.href='<?php echo U('Home/Buy/choose_address');?>?type=<?php echo ACTION_NAME;?>'">
				<div class="mg clear">
					<span>
						<h1><em><?php echo ($address['name']); ?></em><?php echo ($address['mobile']); ?></h1>
						<span class="clear">
							<img src="/App/style/img/adress.png"/>
							<p><?php echo ($address['province']); echo ($address['city']); echo ($address['district']); echo ($address['twon']); echo ($address['address']); ?></p>
						</span>
					</span>
					<img src="/App/style/img/arrow02.png"/>
				</div>
			</div>
			<?php } ?>
			<div class="informate">
				<h2>商品编号:<?php echo ($goods['goods_sn']); ?></h2>
				<span>
					<div class="mg clear">
						<b><img src="<?php echo ($goods['images']); ?>"/></b>
						<div class="title">
							<h1><?php echo ($goods['name']); ?></h1>
							<p>颜色：<?php echo session('cart')['color'];?></p>
						</div>
						<div class="price"><em>￥<?php echo ($goods['price']); ?></em>× <?php echo session('cart')['num'];?></div>
					</div>
				</span>
				<p>合计: <em>￥<?php echo sprintf("%.2f",$goods['price'] * session('cart')['num']);?></em></p>
			</div>					
			
		</div>	
		<form method="post" onsubmit="return mysubmit()">
		<input type="hidden" name="address" value="<?php echo ($address['id']); ?>"> <!-- 地址id -->	
		<button class="referOrder">确认订单并支付</button>		
		</form>	
		<script>

		function mysubmit()
		{
			if(!$('input[name=address]').val()){
						layer.msg('请添加收货地址');return false;
					}else{
						layer.msg('正在支付...', {
						  icon: 16
						  ,shade: 0.10
						  ,time:0
						});
					}
		}

		</script>
	</body>
</html>