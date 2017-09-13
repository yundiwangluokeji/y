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
<script type='text/javascript' charset='utf-8' src='/Public/ueditor/ueditor.config.js'></script>
<script type='text/javascript' charset='utf-8' src='/Public/ueditor/ueditor.all.min.js'> </script>
<div class="right" style="height: 849px;">
	<div class="now">
		<a href="javascript:;" class="sel">修改商品</a>
		<div class="clear"></div>
	</div>
    <div class="right_main">
    <form method="post" enctype="multipart/form-data" action="/Admin/Goods/editGood">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20" style="display: table;">
    <tbody>
    <tr>
        <td align="right">商品名称：</td>
        <td colspan="3"><input type="text" name="info[name]" value="<?php echo ($goodData["name"]); ?>" class="inputall input700" maxlength="36"></td>
    </tr>
    <tr>
        <td align="right">商品关键字：</td>
        <td colspan="3"><input type="text" name="info[keywords]" value="<?php echo ($goodData["keywords"]); ?>" class="inputall input700" maxlength="36"></td>
    </tr>
    <tr>
        <td align="right">商品描述:</td>
        <td colspan="3"><textarea name="info[description]" rows="8" cols="80"><?php echo ($goodData["description"]); ?></textarea></td>
    </tr>
    <tr>
        <td align="right">排序：</td>
        <td><input type="text" name="info[sorting]" value="<?php echo ($goodData["sorting"]); ?>" class="inputall input60"></td>
    </tr>
    <tr>
        <td align="right">点击数：</td>
        <td><input type="text" name="info[click_count]" value="<?php echo ($goodData["click_count"]); ?>" class="inputall input60"></td>
    </tr>
    <tr>
        <td align="right" width="150">所属分类：</td>
        <td width="250">
            <select name="info[class_id]" class="inputselect" style="width:100%">
                <option value="0">= 请选择分类 =</option>
                <?php if(is_array($typeData)): foreach($typeData as $key=>$v): ?><option value="<?php echo ($v["class_id"]); ?>" <?php if($goodData["class_id"] == $v['class_id']): ?>selected<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </td>
        <td align="right" width="150">所属品牌：</td>
        <td>
            <select name="info[brand_id]" class="inputselect" style="width:282px">
            <option value="0">= 请选择品牌 =</option>
                <?php if(is_array($brandData)): foreach($brandData as $key=>$v): ?><option value="<?php echo ($v["brand_id"]); ?>" <?php if($goodData["brand_id"] == $v['brand_id']): ?>selected<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </td>
    </tr>
    <tr class="base_html">
        <td align="right">商品价格：</td>
        <td><input type="text" name="info[price]" value="<?php echo ($goodData["price"]); ?>" class="inputall input100"> <span class="c888">元</span></td>
    </tr>
    <tr class="base_html">
        <td align="right">商品颜色多选:</td>

        <td colspan="3">
            <?php if(is_array($color)): foreach($color as $k=>$v): ?><label>
                    <input name="info[color][]" type="checkbox" value="<?php echo ($k); ?>"
                        <?php if(is_array($goodData['color'])): foreach($goodData['color'] as $key=>$val): if($k == $val){echo 'checked';} endforeach; endif; ?>
                    ><?php echo ($v); ?></label>&nbsp;<?php endforeach; endif; ?>
        </td>
    </tr>
    <tr class="base_html">
        <td align="right">剩余库存：</td>
        <td><input type="text" name="info[inventory]" value="<?php echo ($goodData["inventory"]); ?>" class="inputall input100"> <span class="c888">件</span></td>
    </tr>
    <tr>
        <td align="right">商品缩略图：</td>
        <td colspan="3">
            <div>
                <img src="<?php echo ($goodData["images"]); ?>" class="fl" style="border:1px solid #ddd;width:140px;height:56px">
                <span class="c999 fl mat15 mal10">（140*56）</span>
                <div class="clear"></div>
            </div>
            <p class="mat5"><input type="file" name="images"></p>
        </td>
    </tr>
    <tr>
        <td align="right">商品详情：</td>
        <td colspan="3" style="padding:5px">
            <script name="info[body]" id="editor" type="text/plain" style="width:100%;height:500px;"></script>
        </td>
    </tr>
    <tr>
        <td align="right"></td>
        <td colspan="3">
            <input type="hidden" name="goods_id" value="<?php echo ($goodData["goods_id"]); ?>">
            <input type="hidden" name="pesubmit">
            <input type="submit" value="提 交" class="tjbtn" style="margin-left:380px">
        </td>
    </tr>
    </tbody></table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20" style="display:none">
    <tbody><tr>
        <td align="right" width="140">页面关键词：</td>
        <td><input type="text" name="info[product_keys]" value="" class="inputall input500"> <span class="c888">（SEO选项）</span></td>
    </tr>
    <tr>
        <td align="right">页面描述：</td>
        <td><textarea name="info[product_desc]" style="width:500px;height:100px;"></textarea> <span class="c888">（SEO选项）</span></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="hidden" name="pesubmit">
            <input type="submit" value="提 交" class="tjbtn" style="margin-left:380px">
        </td>
    </tr>
    </tbody></table>
    </form>
</div>
<script type="text/javascript" charset="utf-8">
 var ue = UE.getEditor('editor');
 ue.ready(function() {
    ue.setContent('<?php echo (htmlspecialchars_decode($goodData["body"])); ?>');
});
</script>

</body></html>