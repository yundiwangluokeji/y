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
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type='text/javascript' charset='utf-8' src='/Public/ueditor/lang/zh-cn/zh-cn.js'></script>

	<div class="right" style="height: 571px;">
	<div class="now" style="width: 1679px;">
		<a href="Essential information.html" class="sel">① 基本信息</a>
		<!-- <a href="seo.html">② SEO信息</a> -->
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" enctype="multipart/form-data" action="/Admin/Goods/addGood">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20" style="display: table;">
		<tbody>
        <tr>
			<td align="right">商品名称：</td>
			<td colspan="3"><input type="text" name="info[name]" value="" class="inputall input700" maxlength="36"></td>
		</tr>
        <tr>
			<td align="right">商品关键字：</td>
			<td colspan="3"><input type="text" name="info[keywords]" value="" class="inputall input700" maxlength="36"></td>
		</tr>
        <tr>
			<td align="right">商品描述:</td>
			<td colspan="3"><textarea name="info[description]" rows="8" cols="80"></textarea></td>
		</tr>
        <tr>
			<td align="right">排序：</td>
			<td><input type="text" name="info[sorting]" value="0" class="inputall input60"></td>
		</tr>
        <tr>
			<td align="right">点击数：</td>
			<td><input type="text" name="info[click_count]" value="0" class="inputall input60"></td>
		</tr>
		<tr>
			<td align="right" width="150">所属分类：</td>
			<td width="250">
				<select name="info[class_id]" class="inputselect" style="width:100%">
        			<option value="0">= 请选择分类 =</option>
                    <?php if(is_array($typeRes)): foreach($typeRes as $key=>$v): ?><option value="<?php echo ($v["class_id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</td>
			<td align="right" width="150">所属品牌：</td>
			<td>
				<select name="info[brand_id]" class="inputselect" style="width:282px">
				<option value="0">= 请选择品牌 =</option>
                    <?php if(is_array($brandRes)): foreach($brandRes as $key=>$v): ?><option value="<?php echo ($v["brand_id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</td>
		</tr>
		<!-- <tr>
			<td align="right">商品规格：</td>
			<td colspan="3">
				<a href="javascript:;" class="admin_btn mar10" onclick="rule_open()">选择规格</a>
				<a href="javascript:;" class="admin_btn" onclick="rule_close()">关闭规格</a>
				<table width="100%" class="list" style="width:702px;margin-top:10px; border:1px #eee solid" id="rule_html">
				<script type="text/html" id="rule_html_tpl">
				<tr>
					<th class="table_td bgtt" width="50">序号</th>
					{{each rule_list as v}}
					<th class="bgtt">{{v.name}}
						<input type='hidden' name='rule_id[]' value='{{v.id}}' />
						<input type='hidden' name='rule_name[]' value='{{v.name}}' />
					</th>
					{{/each}}
					<th class="table_td bgtt" width="70">本店价<a href="javascript:rule_bat('product_money');" class="cblue">[批]</a></th>
					<th class="table_td bgtt" width="70">市场价<a href="javascript:rule_bat('product_mmoney');" class="cblue">[批]</a></th>
					<th class="table_td bgtt" width="70">库存<a href="javascript:rule_bat('product_num');" class="cblue">[批]</a></th>
					<th class="table_td bgtt" width="50">操作</th>
				</tr>
				{{each ruledata_list as v k}}
				<tr id="{{k+1}}">
					<td>{{k+1}}</td>
					{{each v.name_list as vv}}
					<td>{{vv}}</td>
					{{/each}}
					<td class="table_td"><input type="text" name="product_money[]" value="{{v.money}}" class="inputtext input50" /></td>
					<td class="table_td"><input type="text" name="product_mmoney[]" value="{{v.mmoney}}" class="inputtext input50" /></td>
					<td class="table_td"><input type="text" name="product_num[]" value="{{v.num}}" class="inputtext input40" /></td>
					<td class="table_td">
						<input type="hidden" name="prorule_key[]" value="{{v.id}}" />
						<input type="hidden" name="prorule_name[]" value="{{v.name}}" />
						<a href="javascript:rule_del('{{k+1}}');" class="admin_btn">删除</a>
					</td>
				</tr>
				{{/each}}
				</script>
				</table>
			</td>
		</tr> -->
		<!--<tr>
			<td align="right">商品货号：</td>
			<td><input type="text" name="info[product_mark]" value="" class="inputall input100" /></td>
		</tr>-->
		<tr class="base_html">
			<td align="right">商品价格：</td>
			<td><input type="text" name="info[price]" value="0" class="inputall input100"> <span class="c888">元</span></td>
		</tr>
        <tr class="base_html">
			<td align="right">商品颜色多选:</td>
			<td colspan="3">
                <?php if(is_array($color)): foreach($color as $k=>$v): ?><label><input name="info[color][]" type="checkbox" value="<?php echo ($k); ?>" /><?php echo ($v); ?></label><?php endforeach; endif; ?>
            </td>
		</tr>
		<tr class="base_html">
			<td align="right">剩余库存：</td>
			<td><input type="text" name="info[inventory]" value="" class="inputall input100"> <span class="c888">件</span></td>
		</tr>
		<tr>
			<td align="right">商品缩略图：</td>
			<td colspan="3">
                <div>
					<img src="/App/Admin/style/images/nopic.png" class="fl" style="border:1px solid #ddd;width:140px;height:56px">
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
			<td align="right"></td>
			<td>
				<input type="hidden" name="pesubmit">
				<input type="submit" value="提 交" class="tjbtn" style="margin-left:380px">
			</td>
		</tr>
		</tbody></table>
		</form>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
 var ue = UE.getEditor('editor');
</script>

// var editor;
// KindEditor.ready(function(K) {
// 	editor = K.create('#editortext', {
// 		allowFlashUpload :false,
// 		afterBlur: function(){
// 			this.sync();
// 		}
// 	});
// });
$(function(){
	rule_list("", 'init');
	$(":button").click(function(){
		var kong_num = rule_num = 0;
		if ($(":input[name='prorule_key[]']").length > 0) {
			$("#rule_html").find(":input").each(function(){
				if ($(this).attr("disabled") == "disabled" || $(this).is(":hidden")) return true;
				if ($(this).val() == '') kong_num++;
			})
			if (kong_num > 0) {
				alert('规格属性尚未填写完全');
				return;
			}
		}
		$("form").submit();
	})
	$(".now a").click(function(){
		var _index = $(this).index();
		$(".now a").removeClass("sel");
		$(this).addClass("sel");
		$(".wenzhang").hide().eq(_index).show();
	})
	//按钮锁定
    $(".upload_value").each(function(){
    	var lock = $(this).val() ? 1 : 0;
    	var upload_html = $(this).parents(".upload_html")
    	if ($(this).val()) {
    		upload_html.attr("lock", 1);
    		upload_html.find(".upload_bg").show();
    		//upload_html.find(".upload_do").show();
    	}
    	else {
    		upload_html.attr("lock", 0);
     		upload_html.find(".upload_bg").hide();
    		//upload_html.find(".upload_do").hide();
    	}
    })
    // 初始化Web Uploader




//打开规格框
function rule_open() {
	url = "admin.php?mod=product&act=rule";
	if ($(":input[name='prorule_key[]']").length > 0) {
		var prorule_key = new Array();
		$(":input[name='prorule_key[]']").each(function(){
			prorule_key.push($(this).val());
		})
		prorule_key = prorule_key.join(',');
		url += "&id="+ prorule_key;
	}
	pe_dialog(url, '选择规格', 1000, 550);
}
//关闭规格
function rule_close() {
	$("#rule_html").hide();
	$("#rule_html tr").remove();
	$(".base_html").show();
}
//显示规格列表
function rule_list(id, type) {
	$.getJSON("admin.php?mod=product&act=rule_list&type="+type+"&id="+id, function(json){
		if (json.result) {
			$("#rule_html").show();
			$(".base_html").hide();
			pe_jsontpl('rule_html', json);
		}
	})
}
//删除规格列表
function rule_del(id) {
	if ($("#rule_html tr").length <= 2) {
		rule_close();
	}
	else {
		$("#"+id).remove();
	}
}
//批量设置价格
function rule_bat(name) {
	if (name == 'product_money') text = '本店价';
	if (name == 'product_mmoney') text = '市场价';
	if (name == 'product_num') text = '库存数';
	var num = window.prompt("批量设置" + text, "");
	if (num == '') {
		alert('不能为空!');
		return;
	}
	if (num == null) {return;}
	$(":input[name='" + name + "[]']").val(num);
}
</script>
<style>
#rule_html th{padding:3px 5px; border:1px #e5e5e5 solid; border-right:0; border-left:0; font-weight:normal;}
#rule_html td{padding:5px}
.webuploader-container{width:100%; height:100%; display:block}
.webuploader-pick{background:none; width:100%; height:100%; padding:0; border-radius:0}
.upload_html{position:relative; border:1px solid #ddd; margin-right:17px;}
.upload_bg{position:absolute; top:0; left:0; width:100%; height:100%;background:#ddd; filter:alpha(opacity=0);-moz-opacity:0;opacity:0; display:none}
.upload_do{position:absolute; bottom:0; left:0; width:125px; height:18px; padding-top:8px; background:#000; z-index:9; display:none;}
.upload_jindu{position:absolute; bottom:0; left:0; width:125px; height:22px;line-height:22px; background:#000; filter:alpha(opacity=50); -moz-opacity:0.50; opacity:0.50; color:#fff; font-weight:bold; font-size:12px; text-align:center;display:none}
</style>
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