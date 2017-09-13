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
		<a href="A-Order list.html" class="sel">全部订单（135）</a>
		<a href="Waiting for payment.html">等待付款（81）</a>
		<a href="Awaiting delivery.html">等待发货（19）</a>
		<a href="Shipped.html">已发货（8）</a>
		<a href="Completion of transaction.html">交易完成（9）</a>
		<a href="Transaction closed.html">交易关闭（18）</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="order">
				<input type="hidden" name="state" value="">
				订单编号：<input type="text" name="id" value="" class="inputtext input100 mar5">
				姓名：<input type="text" name="user_tname" value="" class="inputtext input80 mar5">
				电话：<input type="text" name="user_phone" value="" class="inputtext input80 mar5">
				帐号：<input type="text" name="user_name" value="" class="inputtext input80 mar5">
				下单时间：<input type="text" name="date1" value="" onfocus="WdatePicker({dateFmt:&#39;yyyy-MM-dd&#39;})" class="Wdate inputtext" style="width:90px;height:20px;">
				至 <input type="text" name="date2" value="" onfocus="WdatePicker({dateFmt:&#39;yyyy-MM-dd&#39;})" class="Wdate inputtext" style="width:90px;height:20px;">
				<input type="submit" value="搜索" class="input_btn">
			</form>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tbody><tr>
			<th class="bgtt" style="border-bottom:0;">商品详情</th>
			<th class="bgtt" style="border-bottom:0;" width="111">实付款(元)</th>
			<th class="bgtt" style="border-bottom:0;" width="251">收货信息</th>
			<th class="bgtt" style="border-bottom:0;" width="81">支付/发货</th>
			<th class="bgtt" style="border-bottom:0;" width="86">状态</th>
			<th class="bgtt" style="border-bottom:0;" width="86">操作</th>
		</tr>
		</tbody></table>
		<!-- start -->
 <!-- 1 -->
		<?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><div class="hy_ordertw c666 mat10">
				订单编号：<span class="num" style="margin-right:60px"><?php echo ($vo["order_sn"]); ?></span>
				下单时间：<span class="num"><?php echo ($vo["time"]); ?></span>
			</div>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
				<tbody><tr>
					<td class="aleft" style="border-left:0;padding-left:10px;padding-right:15px">
						<div class="dingdan_list" style="padding-top:0">
							<a href="http://phpshe.com/demo/phpshe/product/42" class="fl mar5" target="_blank"><img src="<?php echo ($vo["images"]); ?>" width="40" height="40" class="imgbg"></a>
							<div class="fl">
								<a href="http://phpshe.com/demo/phpshe/product/42" title="<?php echo ($vo["goods_name"]); ?>" target="_blank" class="cblue dd_name"><?php echo ($vo["goods_name"]); ?></a>
								<p class="c999 mat5">[主要颜色：<?php echo ($vo["goods_color"]); ?>]&nbsp;&nbsp;</p>
							</div>
							<span class="fr"><span class="num"><?php echo ($vo["goods_price"]); ?></span>(×<?php echo ($vo["goods_num"]); ?>)</span>
							<div class="clear"></div>
						</div>
					</td>
					<td width="110">
						<p class="corg num strong"><?php echo ($vo["count_price"]); ?></p>
						<!--<p class="c999">（含运费：0.0）</p>-->
						<p class="c999"><?php echo ($vo["pay_way"]); ?></p>
					</td>
					<td width="250" class="aleft" valign="top" style="color:#555">
						<p>【姓名】<?php echo ($vo["username"]); ?> <span class="c888">(<?php echo ($vo["mobile"]); ?>)</span></p>
						<p>【地址】<?php echo ($vo["address"]); ?></p>
						<!--<p>【留言】<span class="c888">管他的</span></p>-->
					</td>
					<td width="80">
						<img src="/App/Admin/style/images/fu_<?php if($vo["pay_status"] == 0): ?>0<?php else: ?>1<?php endif; ?>.png" title="">
						<img src="/App/Admin/style/images/huo_<?php if($vo["shipping_status"] == 0): ?>0<?php else: ?>1<?php endif; ?>.png" title="">
						<!--<p><a href="Express order.html" class="cblue" onclick="return pe_dialog(this, &#39;打印快递单&#39;, 1000, 600)">[快递单]</a></p>-->
					</td>
					<td width="85"><span class="corg">未定</span><p class="mat5"><a href="/Admin/Order/orderDetail/order_id/<?php echo ($vo["order_id"]); ?>" class="c999">订单详情</a></p></td>
					<td width="85" style="border-right:0;">
						<a class="tag_org" href="" onclick="return pe_dialog(this, &#39;订单付款&#39;, 600, 340, &#39;order_pay&#39;)">未定</a>
						<p class="mat5"><a href="Cancellation of order.html" onclick="return pe_dialog(this, &#39;取消订单&#39;, 600, 430, &#39;order_close&#39;)" class="c999">取消订单</a></p>
					</td>
				</tr>
				</tbody>
			</table><?php endforeach; endif; ?>
<!-- 1 -->



			<!-- 3 -->
						<div class="hy_ordertw c666 mat10">
			订单编号：<span class="num" style="margin-right:60px">170812150457105</span>
			下单时间：<span class="num">2017-08-12 15:04</span>
		</div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
		<tbody><tr>
			<td class="aleft" style="border-left:0;padding-left:10px;padding-right:15px">
								<div class="dingdan_list" style="padding-top:0">
					<a href="http://phpshe.com/demo/phpshe/product/43" class="fl mar5" target="_blank"><img src="/App/Admin/style/images/thumb_100x100_20170503142610z.jpg" width="40" height="40" class="imgbg"></a>
					<div class="fl">
						<a href="http://phpshe.com/demo/phpshe/product/43" title="phpshe测试商品韩版女装夏装新款V领显瘦系带条纹衬衫" target="_blank" class="cblue dd_name">phpshe测试商品韩版女装夏装新款V领显瘦系带条...</a>
												<p class="c999 mat5">[尺码：S]&nbsp;&nbsp;[主要颜色：萱草蓝]&nbsp;&nbsp;</p>
											</div>
					<span class="fr"><span class="num">108.0</span>(×1)</span>
					<div class="clear"></div>
				</div>
							</td>
			<td width="110">
				<p class="corg num strong">108.0</p>
				<p class="c999">（含运费：0.0）</p>
				<p class="c999">微信支付</p>
			</td>
			<td width="250" class="aleft" valign="top" style="color:#555">
				<p>【姓名】体育界 <span class="c888">(13545678901)</span></p>
				<p>【地址】河北石家庄桥西区横膈膜内的</p>
				<p>【留言】<span class="c888"></span></p>
			</td>
			<td width="80">
				<img src="/App/Admin/style/images/fu_1.png" title="2017-08-15 15:08">
				<img src="/App/Admin/style/images/huo_0.png" title="">
				<p><a href="Express order.html" class="cblue" onclick="return pe_dialog(this, &#39;打印快递单&#39;, 1000, 600)">[快递单]</a></p>
			</td>
			<td width="85"><span class="corg">等待发货</span><p class="mat5"><a href="Order details.html" target="_blank" class="c999">订单详情</a></p></td>
			<td width="85" style="border-right:0;">
								<a class="tag_blue" href="Consignment page.html" onclick="return pe_dialog(this, &#39;填写发货信息&#39;, 600, 430, &#39;order_send&#39;)">发 货</a>
				<p class="mat5"><a href="Cancellation of order.html" onclick="return pe_dialog(this, &#39;取消订单&#39;, 600, 430, &#39;order_close&#39;)" class="c999">取消订单</a></p>
							</td>
		</tr>
		</tbody></table>
		<!--3  -->

			</div>
			<!-- end -->
	<div class="right_bottom">
		<span class="fr fenye"><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=1">首页</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=1" class="sel">1</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=2">2</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=3">3</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=4">4</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=5">5</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=6">6</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=7">7</a><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;page=7">末页</a><style type="text/css">
.fenye{text-align:right;}
.fenye a{border:1px #ccc solid; padding:0 10px; border-radius:2px; color:#666; background:#fff;display:inline-block;  height:24px; line-height:24px; font-weight:normal; margin-left:3px;}
.fenye a:hover,.fenye .sel{background:#1DABDF; color:#fff; border:1px #0D95C7 solid;  padding:0 10px;}
.fenye .sel{ font-weight:bold;}
</style></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript" src="/App/Admin/style/js/WdatePicker.js"></script>
	<div class="clear"></div>
	<!--<div class="foot">Copyright <span class="num">©</span> 2008-2014 <a target="_blank" href="http://www.phpshe.com">灵宝简好网络科技有限公司</a> 版权所有</div>-->
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
pe_loadscript("http://phpshe.com/demo/phpshe/index.php?mod=notice");
</script>

</body></html>