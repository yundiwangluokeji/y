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
								<li class="Order"><a href="<?php echo U('Order/orderList1');?>"><span>├</span>采购订单</a></li>
								<li class="Order"><a href="<?php echo U('Order/orderList2');?>"><span>├</span>预定订单</a></li>
								<li class=""><a href="<?php echo U('Order/orderList3');?>"><span>├</span>零售订单</a></li>
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
</div>
 <!-- 左边 -->
	<div class="right" style="height: 894px;">
	<div class="now" style="width: 1679px;">
		<a href="javascript:;" class="sel">订单详情</a>
		<div class="clear"></div>
	</div>
	<div class="right_main mab15">
	<div class="huiyuan_main" style="padding:0 35px 20px;">
		<div class="liucheng mat20">订单状态</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_bak mat10">
		<tbody>
        <?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><tr>
			<td align="right" width="80">订单编号：</td>
			<td><?php echo ($vo["order_sn"]); ?></td>
		</tr>
		<tr>
			<td align="right">当前状态：</td>
			<td></td>
		</tr><?php endforeach; endif; ?>
		</tbody>
        </table>
		<div class="shixian mat20"></div>
		<div class="liucheng mat20">收货信息</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_bak mat10">
		<tbody>
        <?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><tr>
			<td align="right" width="80">用户帐号：</td>
			<td><span class="c999">未登录用户</span></td>
		</tr>
		<tr>
			<td align="right">姓　　名：</td>
			<td><?php echo ($vo["username"]); ?></td>
		</tr>
		<tr>
			<td align="right">手机号码：</td>
			<td><?php echo ($vo["mobile"]); ?></td>
		</tr>
		<tr>
			<td align="right">收货地址：</td>
			<td><?php echo ($vo["address"]); ?></td>
		</tr>
		<tr>
			<td align="right">订单备注：</td>
			<td></td>
		</tr>
		<tr>
			<td align="right">快递信息：</td>
			<td>无</td>
		</tr><?php endforeach; endif; ?>
		</tbody></table>
		<div class="shixian mat20"></div>
		<div class="liucheng mat20">订单信息</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_bak mat10">
		<tbody>
            <?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><tr>
			<td align="right" width="80">下单时间：</td>
			<td><?php echo ($vo["time"]); ?></td>
		</tr>
		<tr>
			<td align="right">付款时间：</td>
			<td>--</td>
		</tr>
		<tr>
			<td align="right">发货时间：</td>
			<td>--</td>
		</tr>
		<tr>
			<td align="right" width="80">付款方式：</td>
			<td><?php echo ($vo["pay_way"]); ?></td>
		</tr><?php endforeach; endif; ?>
		</tbody></table>
		<div class="shixian mat20"></div>
		<div class="liucheng mat20">商品清单</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_list mat20">
    		<tbody>
            <tr>
    			<td class="bgtt1" width="" align="center" colspan="2">商品名称</td>
    			<td class="bgtt1" width="90" align="center">单价(元)</td>
    			<td class="bgtt1" width="90" align="center">数量</td>
    			<td class="bgtt1" width="110" align="center">小计(元)</td>
    		</tr>
            <?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><tr>
        			<td class="bgtt1" width="" align="center" colspan="2"><?php echo ($vo["goods_name"]); ?></td>
        			<td class="bgtt1" width="90" align="center"><?php echo ($vo["goods_price"]); ?></td>
        			<td class="bgtt1" width="90" align="center"><?php echo ($vo["goods_num"]); ?></td>
        			<td class="bgtt1" width="110" align="center"><?php echo ($vo["count_price"]); ?></td>
        		</tr><?php endforeach; endif; ?>
    		</tbody>
        </table>
		<div class="dingdan_jiesuan" style="padding:10px; line-height:30px; font-family:微软雅黑; font-size:14px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody>
            <?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><tr>
				<td>商品金额：</td>
				<td width="100">¥ <?php echo ($vo["count_price"]); ?></td>
			</tr>
			<!-- <tr>
				<td>应付金额：</td>
				<td class="font18 cred strong">¥ </td>
			</tr> --><?php endforeach; endif; ?>
			</tbody></table>
			<div class="clear"></div>
		</div>
	</div>
	</div>
</div>
	<div class="clear"></div>
	<!--<div class="foot">Copyright <span class="num">©</span> 2008-2014 <a target="_blank" href="http://www.phpshe.com">灵宝简好网络科技有限公司</a> 版权所有</div>-->
</div>
<script type="text/javascript">
$(function(){
	if ($(".right_bottom").height() == 0) {
		$(".right_bottom").remove();
	}
	if ($(".list tr").length > 1) {
		$(".right_main").css("padding-bottom", 0);
	}
	win_init();
	$(window).resize(function() {
		win_init();
	});
	if ($(".left .sel").length) {
		$(".left").scrollTop(localStorage.getItem('left_scrolltop'));
	}
	else {
		localStorage.setItem('left_scrolltop', 0);
	}
	$(".left").scroll(function(){
		localStorage.setItem('left_scrolltop', $(".left").scrollTop());
	})
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
function win_init() {
	$(".left").add(".right").css("height", $(window).height() - $(".pagetop").height());
	$(".now").css("width", $(".right_main").outerWidth());
	//$(".right_main").css("height", $(window).height() -  $(".pagetop").height() - $(".now:eq(0)").outerHeight() - $(".right_bottom").outerHeight() + 38);
}
pe_loadscript("http://phpshe.com/demo/phpshe/index.php?mod=notice");
</script>

</body></html>