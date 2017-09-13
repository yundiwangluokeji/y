<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>充值</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/App/style/css/public.css">
	<link rel="stylesheet" type="text/css" href="/App/style/css/wallet_recharge.css">
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
		<h3>充值</h3>
	</div>

	<div class="content">
		<div class="tabs">
			<div class="tabs_item">
				<span>微信</span>
				<div class="line"></div>
			</div>
			<div class="tabs_item">
				<span>支付宝</span>
			</div>

		</div>
		<form onsubmit="return checkForm();" action="<?php echo U(alipaywap);?>" method="post">
			<label>
				<input class="money" type="text" name="money" placeholder="请填写充值金额">
			</label>
			<div class="btn">
				<button class="submit wechat" type="submit">下一步</button>
				<button  class="submit pay" type="submit">下一步</button>
			</div>
		</form>
	</div>
	<!-- 验证码弹窗 -->
	<div class="success" style="display: none;">
		<p></p>
	</div>
</body>
</html>
<script type="text/javascript">
	$('.tabs .tabs_item').eq(0).addClass('on');
	$('.tabs .tabs_item').click(function(){
		var index=$(this).index();
		$(this).addClass('on').siblings('.tabs .tabs_item').removeClass('on');
		$('.btn .submit').eq(index).show().siblings('.btn .submit').hide();
	})
	
	function checkForm(){  
	    var money=$('.money').val();
	    if(money==''){
	        $('.success p').html('充值金额不能为空')
	        $(".success").fadeIn(200).delay(1500).fadeOut(200);
	         return false; 
	    }
	}
</script>