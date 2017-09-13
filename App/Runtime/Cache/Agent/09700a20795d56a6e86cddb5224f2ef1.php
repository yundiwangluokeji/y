<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>钱包</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/App/style/css/public.css">
	<link rel="stylesheet" type="text/css" href="/App/style/css/wallet.css">
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
		<a class="back" href="javascript:history.go(-1)"><img src="/App/style/img/back_last.png"></a>
		<i class="line"></i>
		<h3>钱包</h3>
	</div>
	<style type="text/css">
		.money_box{padding: 0.6rem 0;background: #2f3336;text-align: center;line-height: 1.5;}
		.all_money{color: #c3a07d;}
		.all_money h3{font-size: 0.6rem;}
		.all_money p{font-size: 0.3rem;}
		.money_kinds{overflow: hidden;margin-top: 0.7rem;position: relative;}
		.money_kinds_item{float: left;width: 50%;color: #545b62;}
		.money_kinds_item h3{font-size: 0.5rem;}
		.money_kinds_item p{font-size: 0.3rem;}
		.money_kinds .line{position: absolute;width: 1px;height: 0.68rem;margin-top: -0.34rem;background:#545b62;top: 50%;left: 50%;}
		
		.items{margin-top: 0.24rem;}
		.item a{display: block;overflow: hidden;font-size: 0.32rem;color: #FFFFFF;padding: 0.2rem;line-height: 1.5;background: #2f3336;}
		.item .img{float: right;width: 0.15rem;margin-top: 0.1rem;}
	</style>
	<div class="content">
		<div class="money_box">
			<div class="all_money">
				<h3><?php echo ($data['total']); ?></h3>
				<p>总金额</p>
			</div>
			<div class="money_kinds">
				<div class="money_kinds_item" >
					<h3><?php echo ($data['balance']); ?></h3>
					<p>可用余额</p>
				</div>
				<div class="line"></div>
				<div class="money_kinds_item">
					<h3><?php echo ($data['freeze']); ?></h3>
					<p>冻结金额</p>
				</div>
			</div>
		</div>
		<div class="items">
			<div class="item">
				<a href="<?php echo U('withdrawal');?>" style="border-bottom:1px solid #545b62;">
					<span>提现</span>
					<img class="img" src="/App/style/img/wallet_right_icon.png">
				</a>
			</div>
			<div class="item">
				<a href="<?php echo U('topup');?>">
					<span>充值</span>
					<img class="img" src="/App/style/img/wallet_right_icon.png">
				</a>
			</div>
		</div>
	</div>

	<!-- 提交成功弹窗 -->
	<div class="success" style="display: none;">
		<img src="/App/style/img/set_success.png">
		<p>提交成功</p>
	</div>
</body>
</html>