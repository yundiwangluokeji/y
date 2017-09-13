<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
		<title>南方钟表</title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/proDetails.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';</script>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1>南方钟表</h1>
			</div>
		</div>
		<div class="contains">
			<div class="banner">
				<img src="<?php echo ($goodData["images"]); ?>"/>
			</div>

			<div class="txtDetails">
				<div class="mg">
					<h1><?php echo ($goodData["name"]); ?></h1>
					<p>商品编号:<?php echo ($goodData["goods_sn"]); ?></p>
					<span class="clear">
						<h2>￥<em><?php echo ($goodData["price"]); ?></em></h2>
						<a href="javascript:;"><img src="/App/style/img/share.png"/></a>
                        <div class="collect">
                            <?php if($goodData["isCollect"] == 1): ?><img id="uncollectIco" src="/App/style/img/collectA.png"/>
                                <b style="color: #7bc2ea;"><?php echo ($goodData["collectNum"]); ?></b>
                            <?php elseif($Think.session.AgentUser): ?>
                                <img id="collectIco" src="/App/style/img/collect.png"/>
                                <b><?php echo ($goodData["collectNum"]); ?></b>
                            <?php else: ?>
                                <a href="<?php echo U('Agent/Index/index');?>">
                                    <img src="/App/style/img/collect.png"/>
                                </a>
                                <b><?php echo ($goodData["collectNum"]); ?></b><?php endif; ?>
						</div>
					</span>
				</div>
			</div>

			<div class="mySelect">
				<div class="mg clear">
					<h2>
						请选择<span><em>颜色</em><em>数量</em></span>
					</h2>
					<img src="/App/style/img/arrow.png"/>
				</div>
			</div>

			<div class="proDetails">
				<h1>商品详情页</h1>
				<div class="pic">
					<?php echo (htmlspecialchars_decode($goodData["body"])); ?>
				</div>
			</div>
		</div>

		<div class="defineFoot clear">
			<span class="left">
				<a href="<?php echo U('Home/Index/index');?>"><span><img src="/App/style/img/def01.png"/></span>首页</a>
				<b></b>
			</span>
			<span class="left">
				<a href="<?php echo U('Home/Collect/collect');?>"><span><img src="/App/style/img/def02.png"/></span>收藏夹</a>
			</span>
			<span class="right">
				<a href="<?php echo U('Home/Purchase/purchase');?>">采购</a>
			</span>
		</div>

		<!--选择弹窗-->
		<div class="popSelect">
			<div class="details">
				<div class="message">
					<span><img src="<?php echo ($goodData["images"]); ?>"/></span>
					<h1><em>￥<?php echo ($goodData["price"]); ?></em>商品编号:<?php echo ($goodData["goods_sn"]); ?></h1>
					<a href="javascript:;">×</a>
				</div>

				<div class="allStyle">
					<div class="colour">
						<h2>颜色</h2>
						<ul class="clear">
                            <?php if(is_array($colors)): foreach($colors as $key=>$v): ?><li data-color="<?php echo ($key); ?>"><?php echo ($v); ?></li><?php endforeach; endif; ?>
						</ul>
					</div>

					<div class="amount mg">
						<h2>数量</h2>
						<div class="num">
							<b class="reduct">—</b>
							<input type="text" value="1" disabled="disabled" />
							<b class="add">+</b>
						</div>
					</div>
				</div>

				<button>确认</button>
			</div>
		</div>
        <div id="goods_id" data-val="<?php echo ($goodData["goods_id"]); ?>"></div>
        <div id="AgentUser" data-val="<?php echo (session('AgentUser')); ?>"></div>

		<script>
            $(function(){
                //收藏
                $('#collectIco').click(function () {
                    var goods_id = $('#goods_id').attr('data-val');
                    var agentUser = $('#AgentUser').attr('data-val');
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

                $('#uncollectIco').click(function () {
                    var goods_id = $('#goods_id').attr('data-val');
                    var agentUser = $('#AgentUser').attr('data-val');
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

				//选择弹窗
				$('.mySelect').click(function(){
					$('.popSelect').fadeIn();
					$('html,body').css({'height':'100%','overflow':'hidden'});
				});
				$('.popSelect .message a').click(function(){
					$('.popSelect').hide();
					$('html,body').css('overflow','auto');
				});
				$('.popSelect .colour li').eq(0).addClass('on');
				$('.popSelect .colour li').click(function(){
					$(this).addClass('on').siblings('li').removeClass('on');
				});

				var txtA = $('.popSelect .num input');
				var count = parseInt(txtA.val());
				$('.popSelect .reduct').click(function(){
					if(count<=2){
						count=2;
						$(this).css('color','#545b61');
					}else{
						$('.popSelect .num b').css('color','#ffffff');
					};
					txtA.val(--count);
				});
				$('.popSelect .add').click(function(){
					if(count>100){
						count=99;
						$(this).css('color','#545b61');
					}else{
						$('.popSelect .num b').css('color','#ffffff');
					};
					txtA.val(++count);
				});

				$('.popSelect button').click(function(){
					$('.popSelect').hide();
					$('html,body').css('overflow','auto');
				});
			});
		</script>
	</body>
</html>