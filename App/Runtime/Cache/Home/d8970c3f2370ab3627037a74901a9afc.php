<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
		<title>南方钟表</title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/recommend.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';</script>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1>推荐</h1>
				<a class="search" href=""><img src="/App/style/img/search.png"/></a>
			</div>
		</div>

		<div class="contains">
			<div class="headNav">
				<div class="mg clear">
					<ul>
                        <div class="typeList" style="float:left;">
                            <li data-id="0" <?php if(!$brandIcon): ?>class="on"<?php endif; ?>>全部</li>
                            <?php if(is_array($classData)): foreach($classData as $key=>$v): ?><li data-id="<?php echo ($v["class_id"]); ?>" <?php if($brandIcon == $v['class_id']): ?>class="on"<?php endif; ?> ><?php echo ($v["name"]); ?></li><?php endforeach; endif; ?>
                        </div>
						<li id="priceOrder" data-order="<?php echo $orderNum ? $orderNum : 2; ?>">价格<img src="/App/style/img/down.png"/></li>
					</ul>
					<a href="javascript:;"><img src="/App/style/img/afresh.png"/></a>
				</div>
			</div>

			<div class="goodsList">
				<!--两列显示-->
				<div class="twoCol mg">
					<ul class="clear">
                        <?php if(is_array($goodslist)): foreach($goodslist as $key=>$vo): ?><li>
    							<a href="<?php echo U('Home/Recommended/goodDetail', array('goods_id' => $vo['goods_id']));?>"><img src="<?php echo ($vo["images"]); ?>"/></a>
    							<div class="details">
    								<h1><a href="<?php echo U('Home/Recommended/goodDetail', array('goods_id' => $vo['goods_id']));?>"><?php echo ($vo["name"]); ?></a></h1>
    								<p>编号:<?php echo ($vo["goods_sn"]); ?></p>
    								<h2>批价:<em>￥<?php echo ($vo["price"]); ?></em></h2>
    								<span class="clear">
    									<div class="collect">
                                            <?php if($vo["isCollect"] == 1): ?><img data-id="<?php echo ($vo["goods_id"]); ?>" data-val="<?php echo (session('AgentUser')); ?>" class="uncollectIco" src="/App/style/img/collectA.png"/>
                                                <b style="color: #7bc2ea;"><?php echo ($vo["collectNum"]); ?></b>
                                            <?php elseif($Think.session.AgentUser): ?>
                                                <img data-id="<?php echo ($vo["goods_id"]); ?>" data-val="<?php echo (session('AgentUser')); ?>" class="collectIco" src="/App/style/img/collect.png"/>
                                                <b><?php echo ($vo["collectNum"]); ?></b>
                                            <?php else: ?>
                                                <a href="<?php echo U('Agent/Index/index');?>">
                                                    <img src="/App/style/img/collect.png"/>
                                                </a>
                                                <b><?php echo ($vo["collectNum"]); ?></b><?php endif; ?>
    									</div>
    									<div imgurl="http://pan.baidu.com/share/qrcode?w=230&h=230&url=http://<?php echo $_SERVER['HTTP_HOST']; echo U('Home/Recommended/index');?>" class="code"><img src="/App/style/img/code.png"/></div>
    								</span>
    							</div>
    						</li><?php endforeach; endif; ?>
					</ul>
				</div>

				<!--一列显示-->
				<div class="oneCol">
					<ul class="mg">
                        <?php if(is_array($goodslist)): foreach($goodslist as $key=>$vo): ?><li>
    							<a href="<?php echo U('Home/Recommended/goodDetail', array('goods_id' => $vo['goods_id']));?>"><img src="<?php echo ($vo["images"]); ?>"/></a>
    							<div class="details">
    								<h1><a href="<?php echo U('Home/Recommended/goodDetail', array('goods_id' => $vo['goods_id']));?>"><?php echo ($vo["name"]); ?></a></h1>
    								<p>商品编号:<?php echo ($vo["goods_sn"]); ?></p>
    								<h2>批价:<em>￥<?php echo ($vo["price"]); ?></em></h2>
    								<span class="clear">
    									<div class="collect">
                                            <?php if($vo["isCollect"] == 1): ?><img data-id="<?php echo ($vo["goods_id"]); ?>" data-val="<?php echo (session('AgentUser')); ?>" class="uncollectIco" src="/App/style/img/collectA.png"/>
                                                <b style="color: #7bc2ea;"><?php echo ($vo["collectNum"]); ?></b>
                                            <?php elseif($Think.session.AgentUser): ?>
                                                <img data-id="<?php echo ($vo["goods_id"]); ?>" data-val="<?php echo (session('AgentUser')); ?>" class="collectIco" src="/App/style/img/collect.png"/>
                                                <b><?php echo ($vo["collectNum"]); ?></b>
                                            <?php else: ?>
                                                <a href="<?php echo U('Agent/Index/index');?>">
                                                    <img src="/App/style/img/collect.png"/>
                                                </a>
                                                <b><?php echo ($vo["collectNum"]); ?></b><?php endif; ?>
    									</div>
    									<div imgurl="http://pan.baidu.com/share/qrcode?w=230&h=230&url=http://<?php echo $_SERVER['HTTP_HOST']; echo U('Home/Recommended/index');?>" class="code"><img src="/App/style/img/code.png"/></div>
    								</span>
    							</div>
    						</li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div>

		</div>

        <div class="footer">
            <a href="<?php echo U('Home/Index/index',array('agent'=>AGENT_ID));?>">
                <img class="shadow" src="/App/style/img/index_icon.png">
                <img class="light" src="/App/style/img/index_icon_on.png">
                <span>首页</span>
            </a>
            <a class="on" href="<?php echo U('Home/Recommended/index',array('agent'=>AGENT_ID));?>">
                <img class="shadow" src="/App/style/img/tuijian_icon.png">
                <img class="light" src="/App/style/img/tuijian_icon_on.png">
                <span>推荐</span>
            </a>
            <a href="<?php echo U('Agent/Index/index',array('agent'=>AGENT_ID));?>">
                <img class="shadow" src="/App/style/img/us_icon.png">
                <img class="light" src="/App/style/img/us_icon_on.png">
                <span>我的</span>
            </a>
        </div>

		<!--二维码-->
		<div class="qrCode">
			<span><img src="/App/style/img/QR.png"/></span>
		</div>

		<!--返回顶部-->
		<div class="back_top">
			<img src="/App/style/img/back_top.png">
		</div>
        <div id="agent" data-val="<?php echo ($agent); ?>"></div>
        <div id="brandIcon" data-val="<?php echo ($brandIcon); ?>"></div>


		<script>
            // 自定义js
            $(document).on('click', '.typeList li', function () {
                var agent = $('#agent').attr('data-val');
                var classNum = $(this).attr('data-id');
                if (agent) {
                    var url = "/Home/Recommended/index/class_id/" + classNum + "/agent/" + agent;
                } else {
                    var url = "/Home/Recommended/index/class_id/" + classNum;
                }
                window.location.href = url;
            });

            // 排序
            $('#priceOrder').click(function () {
                var agent = $('#agent').attr('data-val');

                if ($('#brandIcon').attr('data-val')) {
                    var brand_id = '/class_id/' + $('#brandIcon').attr('data-val');
                } else {
                    var brand_id = '';
                }
                if ($(this).attr('data-order')) {
                    var orderNum = '/orderNum/' + $(this).attr('data-order');
                } else {
                    orderNum = '';
                }

                url = "/Home/Recommended/index" + brand_id + orderNum;
                if (agent) {
                    url += '/agent/' + agent;
                }
                window.location.href = url;
            });


			$(function(){
				// $('.headNav li').eq(0).addClass('on');
				// $('.headNav li').click(function(){
				// 	$(this).addClass('on').siblings('li').removeClass('on');
				// });

                //收藏
				$('.collectIco').click(function(){
                    var goods_id = $(this).attr('data-id');
                    var agentUser = $(this).attr('data-val');
                    var that = $(this);
                    $.post(
                        '/Home/Recommended/collect',
                        {"agent_id":agentUser, "goods_id":goods_id},
                        function (data) {
                            if (data.code == 1) {
                                window.location.reload();
                            } else {
                                alert(data.msg);
                            }
                        },
                        'json'
                    );
				});

                // 取消收藏
                $('.uncollectIco').click(function(){
                    var goods_id = $(this).attr('data-id');
                    var agentUser = $(this).attr('data-val');
                    var that = $(this);
                    $.post(
                        '/Home/Recommended/unCollect',
                        {"agent_id":agentUser, "goods_id":goods_id},
                        function (data) {
                            if (data.code == 1) {
                                window.location.reload();
                            } else {
                                alert(data.msg);
                            }
                        },
                        'json'
                    );
                });

				//排版列表
				$('.goodsList .twoCol').show();
				$('.goodsList .oneCol').hide();
				$('.headNav a').toggle(function(){
					$('.goodsList .twoCol').hide();
					$('.goodsList .oneCol').show();
				},function(){
					$('.goodsList .twoCol').show();
					$('.goodsList .oneCol').hide();
				});

				//二维码
                $('.goodsList .code').click(function(){
                    $('.qrCode').fadeIn();
                    var url = $(this).attr('imgurl');
                    $('.qrCode>span>img').attr('src',url);
				});
				$('.qrCode').click(function(){
                    $(this).fadeOut();
				});

				// 返回顶部
				$('.back_top').click(function(){
					$('html,body').animate({scrollTop:0},300)
				});

			});
		</script>
	</body>
</html>