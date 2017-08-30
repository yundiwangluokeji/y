<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网站概况 - 欢迎使用PHPSHE商城系统</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="shortcut icon" type="image/ico" href="favicon.ico">
<link type="text/css" rel="stylesheet" href="/App/Admin/style/css/style.css">
<script type="text/javascript" src="/App/Admin/style/js/jquery.js"></script>
<script type="text/javascript" src="/App/Admin/style/js/global.js"></script> 
<script type="text/javascript" src="/App/Admin/style/js/arttpl.js"></script>
<script type="text/javascript" src="/App/Admin/style/js/layer.js"></script>
<link rel="stylesheet" href="/App/Admin/style/css/layer.css" id="layuicss-skinlayercss">
</head>
<body style="overflow-y:hidden">
<div class="bgimg"></div>
<div class="pagetop">
	<div class="head">
		<div class="logo fl" onclick="window.location.href='<?php echo U(Index/index);?>'"><img src="/App/Admin/style/images/logo.png"></div>
		<div class="head_r fr">
			<a href="index.html" class="head_tb1" style="border-left:0"><s></s>概况</a>
			<a href="Local template.html" class="head_tb8"><s></s>模板</a>
			<a href="Guest.html" class="head_tb3"><s></s>统计</a>
			<a href="backups.html" class="head_tb5"><s></s>备份</a>
			<a href="cache.html" class="head_tb6"><s></s>缓存</a>
			<a href="" target="_blank" class="head_tb7"><s></s>首页</a>
			<a href="<?php echo U('Login/onlogin');?>" class="head_tb2" style="background:none"><s></s>退出</a>
		</div>
		<div class="clear"></div>
	</div>
</div> <!-- 头部 -->
<div class="content">
	<div class="left" style="height: 894px;">
				<div class="fenlei">
			<h3 class="fl_tb1"><s></s>商品中心</h3>
			<ul>
								<li class="Goods"><a href="<?php echo U('Goods/index');?>"><span>├</span>商品列表</a></li>
								<li class="Type"><a href="<?php echo U('Type/index');?>"><span>├</span>商品分类</a></li>
								<li class="Brand"><a href="<?php echo U('Brand/index');?>"><span>├</span>品牌管理</a></li>
								<li class=""><a href="Specification management.html"><span>├</span>规格管理</a></li>
								<li class=""><a href="A-Evaluation management.html"><span>├</span>评价管理</a></li>
								<li class=""><a href="Coupon-list.html"><span>├</span>优 惠 券</a></li>
								<li class=""><a href="Sales promotion-list.html"><span>├</span>促销活动</a></li>
							</ul>
			<div class="clear"></div>
			<div class="xian"></div>		</div>
				<div class="fenlei">
			<h3 class="fl_tb3"><s></s>交易中心</h3>
			<ul>
								<li class=""><a href="A-Order list.html"><span>├</span>订单列表</a></li>
								<li class=""><a href="Fund details.html"><span>├</span>资金明细</a></li>
								<li class=""><a href="Integration details.html"><span>├</span>积分明细</a></li>
								<li class=""><a href="Recharge record.html"><span>├</span>充值记录</a></li>
								<li class=""><a href="Waiting for settlement.html"><span>├</span>提现管理</a></li>
							</ul>
			<div class="clear"></div>
			<div class="xian"></div>		</div>
				<div class="fenlei">
			<h3 class="fl_tb4"><s></s>用户中心</h3>
			<ul>
								<li class="User"><a href="<?php echo U('User/index');?>"><span>├</span>会员列表</a></li>
								<li class=""><a href="Management list.html"><span>├</span>管 理 员</a></li>
								<li class=""><a href="Administrative authority.html"><span>├</span>管理权限</a></li>
							</ul>
			<div class="clear"></div>
			<div class="xian"></div>		</div>
				<div class="fenlei">
			<h3 class="fl_tb2"><s></s>文章中心</h3>
			<ul>
								<li class=""><a href="Article classification-I.html"><span>├</span>文章分类</a></li>
								<li class=""><a href="Article list-I.html"><span>├</span>文章列表</a></li>
							</ul>
			<div class="clear"></div>
			<div class="xian"></div>		</div>
				<div class="fenlei">
			<h3 class="fl_tb6"><s></s>控制面板</h3>
			<ul>
								<li class="Config"><a href="<?php echo U('Config/index');?>"><span>├</span>网站设置</a></li>
								<li class=""><a href="WeChat settings.html"><span>├</span>微信设置</a></li>
								<li class=""><a href="Payment settings.html"><span>├</span>支付设置</a></li>
								<li class=""><a href="Navigation list.html"><span>├</span>导航管理</a></li>
								<li class=""><a href="thp top ad1.html"><span>├</span>广告管理</a></li>
								<li class=""><a href="link list.html"><span>├</span>友情链接</a></li>
								<li class=""><a href="Express template.html"><span>├</span>运单模板</a></li>
								<li class=""><a href="mess mail record.html"><span>├</span>短/邮记录</a></li>
							</ul>
			<div class="clear"></div>
					</div>
</div> <!-- 左边 -->
 <div class="right" style="height: 894px;">
<div class="now" style="width: 1679px;">
	<a href="Site settings.html" class="sel">网站设置</a>
	<a href="Member settings.html">会员设置</a>
	<a href="Integral setting.html">积分设置</a>
	<a href="Express settings.html">快递设置</a>
	<a href="SMS settings.html">短信设置</a>
	<a href="Mailbox settings.html">邮箱设置</a>
	<a href="Notification settings.html">通知设置</a>
	<div class="clear"></div>
</div>
	<div class="right_main">
		<form method="post" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20">
		<tbody><tr>
			<td align="right" width="150">网站标题：</td>
			<td><input type="text" name="info[web_title]" value="PHPSHE B2C商城系统演示站" class="inputall input500"></td>
		</tr>
		<tr>
			<td align="right">关 键 词：</td>
			<td><input type="text" name="info[web_keywords]" value="phpshe,php,shop,php商城系统,b2c商城系统,php商城源码,b2c商城源码,开源免费网上商城系统" class="inputall input500"></td>
		</tr>
		<tr>
			<td align="right">网站描述：</td>
			<td><textarea name="info[web_description]" style="width:500px;height:100px;">phpshe,php,shop,php商城系统,b2c商城系统,php商城源码,b2c商城源码,开源免费网上商城系统</textarea></td>
		</tr>
		<tr>
			<td align="right">网站Logo：</td>
			<td>
								<p class="mab5"><img src="images/20170215143741r.jpg" height="60" style="border:1px solid #ddd"></p>
								<p><input type="file" name="web_logo"></p>
			</td>
		</tr>
		<tr>
			<td align="right">微信二维码：</td>
			<td>
								<p class="mab5"><img src="images/nopic.png" height="70" style="border:1px solid #ddd"></p>
								<p><input type="file" name="web_qrcode"></p>
			</td>
		</tr>
		<tr>
			<td align="right">咨询电话：</td>
			<td><input type="text" name="info[web_phone]" value="15839823500" class="inputall input500"></td>
		</tr>
		<tr>
			<td align="right">咨询 Q Q：</td>
			<td><input type="text" name="info[web_qq]" value="76265959" class="inputall input500"></td>
		</tr>
		<tr>
			<td align="right">版权所有：</td>
			<td><input type="text" name="info[web_copyright]" value="2008-2017 简好网络" class="inputall input500"></td>
		</tr>
		<tr>
			<td align="right">备 案 号：</td>
			<td><input type="text" name="info[web_icp]" value="豫ICP备17013559号-1" class="inputall input500"></td>
		</tr>
		<tr>
			<td align="right">热门搜索：</td>
			<td><input type="text" name="info[web_hotword]" value="PHPSHE,B2C商城系统,简好网络" class="inputall input500"><span class="c888">（多个请用“,”隔开）</span></td>
		</tr>
		<tr>
			<td align="right">统计代码：</td>
			<td><textarea name="info[web_tongji]" style="width:500px;height:150px;"></textarea><span class="c888">（第三方流量统计代码）</span></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="hidden" name="pe_token" value="bc127a40363dfcec978226909f4e8f2e">
				<input type="submit" name="pesubmit" value="提 交" class="tjbtn">
			</td>
		</tr>
		</tbody></table>
		</form>
	</div>
</div>
	<div class="clear"></div>
</div>

<script type="text/javascript">
function win_init() {
	$(".left").add(".right").css("height", $(window).height() - $(".pagetop").height());
	$(".now").css("width", $(".right_main").outerWidth());
	//$(".right_main").css("height", $(window).height() -  $(".pagetop").height() - $(".now:eq(0)").outerHeight() - $(".right_bottom").outerHeight() + 38);
}
$(function(){
	if ($(".right_bottom").height() == 0) {
		$(".right_bottom").remove();
	}
	win_init();
	$(window).resize(function() {
		win_init();
	});
	$(".list").find("td").hover(
		function(){
			if ($(this).hasClass("bgtt") || $(this).is("[nosel=1]")) return;
			$(this).parent("tr").children("td[nosel!=1]").css("background-color", "#fbfbfb");
		},
		function(){
			if ($(this).hasClass("bgtt") || $(this).is("[nosel=1]")) return;
			$(this).parent("tr").children("td[nosel!=1]").css("background-color", "#fff");
		}
	)
})



// pe_loadscript("http://phpshe.com/demo/phpshe/index.php?mod=notice");
</script>

<style type="text/css">
.right{background:#fff;}
</style>
</body>
<script type="text/javascript">
var lilist = $('.left>.fenlei>ul>li');
for(var i = 0;i < lilist.length;i++){
	if(lilist.eq(i).attr('class') == "<?php echo CONTROLLER_NAME;?>"){
		lilist.eq(i).addClass('sel');
	}
}
</script>
</html> <!-- 左边 -->