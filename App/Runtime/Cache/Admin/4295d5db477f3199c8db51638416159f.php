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
								<li class=""><a href="product-list.html"><span>├</span>商品列表</a></li>
								<li class=""><a href="Classification of goods.html"><span>├</span>商品分类</a></li>
								<li class=""><a href="Brand management.html"><span>├</span>品牌管理</a></li>
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
<div class="right" style="height: 849px;">
	<div class="now" style="width: 831px;">
		<a href="Member list.html" class="sel">会员列表（54）</a>
		<a href="Collection account.html">收款账户（9）</a>
		<a href="Delivery address.html">收货地址（9）</a>
		<a href="<?php echo U('User/add');?>" id="fabu">添加代理商</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="user">
				用户名：<input type="text" name="name" value="" class="inputtext input100 mar5">
				联系电话：<input type="text" name="phone" value="" class="inputtext input100 mar5">
				常用邮箱：<input type="text" name="email" value="" class="inputtext input150">
				<select name="orderby" class="selectmini">
				<option value="" href="?mod=user">= 默认排序 =</option>
												<option value="ltime|desc" href="?mod=user&amp;orderby=ltime|desc">1)最近登录</option>
								<option value="point|desc" href="?mod=user&amp;orderby=point|desc">2)最多积分</option>
								<option value="ordernum|desc" href="?mod=user&amp;orderby=ordernum|desc">3)最多订单</option>
								</select>
				<input type="submit" value="搜索" class="input_btn">
			</form>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tbody><tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, &#39;user_id&#39;)"></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt">用户名</th>
			<th class="bgtt" width="80">余额
			</th><th class="bgtt" width="80">状态</th>
			<th class="bgtt" width="60">订单数
			</th><th class="bgtt" width="90">联系电话</th>
			<!-- <th class="bgtt" width="160">常用邮箱</th> -->
			<th class="bgtt" width="70">注册日期</th>
			<th class="bgtt" width="70">上次登录</th>
			<th class="bgtt" width="200">操作</th>
		</tr>
		<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td style="background-color: rgb(255, 255, 255);"><input type="checkbox" name="user_id[]" value="60"></td>
			<td class="num" style="background-color: rgb(255, 255, 255);"><?php echo ($v['id']); ?></td>
			<td style="background-color: rgb(255, 255, 255);"><?php echo ($v['username']); ?></td>
			<td style="background-color: rgb(255, 255, 255);"><span class="num corg"><?php echo ($v['money']); ?>元</span></td>
			<td class="num" style="background-color: rgb(255, 255, 255);">
				<a href="<?php echo U('status',array('agent_id'=>$v['id'],'status'=>$v['status']));?>">
					<img src="/App/Admin/style/images/<?php echo $v['status']?'dui':'cuo'; ?>.png">
				</a>
			</td>
			<td class="num" style="background-color: rgb(255, 255, 255);"><a href="http://phpshe.com/demo/phpshe/admin.php?mod=order&amp;user_id=60" class="cblue" target="_blank">1</a></td>
			<td class="num" style="background-color: rgb(255, 255, 255);"><?php echo ($v['mobile']); ?></td>
			<!-- <td class="num" style="background-color: rgb(255, 255, 255);">1161192196@qq.com</td> -->
			<td class="num" style="background-color: rgb(255, 255, 255);"><span><?php echo date('Y-m-d H:i:s',$v['addtime']);?></span></td>
			<td class="num" style="background-color: rgb(255, 255, 255);"><span>19小时前</span></td>
			<td>

				<a href="<?php echo U('update',array('id'=>$v['id']));?>" class="admin_edit mar3">修改</a>
				<a href="admin.php?mod=user&act=del&id=27&token=0a1f23ba1dc927c624b740dd555c29e5" class="admin_del mar3" onclick="return pe_cfone(this, '删除')">删除</a>
				<a href="Collection account.html" class="admin_btn mar3" target="_blank">账户</a>
				<a href="Delivery address.html" class="admin_btn" target="_blank">地址</a>
			</td>

		</tr><?php endforeach; endif; ?>
		</tbody>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, &#39;user_id&#39;)">
			<button href="admin.php?mod=user&amp;act=del&amp;token=bc127a40363dfcec978226909f4e8f2e" onclick="return pe_cfall(this, &#39;user_id&#39;, &#39;form&#39;, &#39;批量删除&#39;)">批量删除</button>
			<!--<input type="button" value="批量发送邮件" id="sendemail" />-->
		</span>
		<span class="fr fenye">
		<?php echo ($page); ?><style type="text/css">
.fenye{text-align:right;}
.fenye a,.fenye span{border:1px #ccc solid; padding:0 10px; border-radius:2px; color:#666; background:#fff;display:inline-block;  height:24px; line-height:24px; font-weight:normal; margin-left:3px;}
.fenye a:hover,.fenye .current{background:#1DABDF; color:#fff; border:1px #0D95C7 solid;  padding:0 10px;}
.fenye .current{ font-weight:bold;}
</style></span>
		<div class="clear"></div>
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