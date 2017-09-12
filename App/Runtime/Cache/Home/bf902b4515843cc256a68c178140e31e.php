<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
		<title><?php echo ($goodData["name"]); ?></title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/proDetails.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>
		<script type="text/javascript" src="/App/style/layer/layer.js" ></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';</script>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1><?php echo ($config['name']); ?></h1>
			</div>
		</div>
		<div class="contains">
			<div class="banner">
				<img src="<?php echo ($goodData["images"]); ?>"/>
			</div>
<!-- 商品id 如果是代理商-代理商id  颜色 数量 -->
			<div class="txtDetails">
				<div class="mg">
					<h1><?php echo ($goodData["name"]); ?></h1>
					<p>商品编号:<?php echo ($goodData["goods_sn"]); ?></p>
					<span class="clear">
						<h2>￥<em><?php echo ($goodData["price"]); ?></em></h2>
						<a href="javascript:;"><img src="/App/style/img/share.png"/></a>
						<div class="collect">
                            <?php if($goodData["isCollect"] == 1): ?><img onclick="layer.msg('你已经收藏过了！')" src="/App/style/img/collectA.png"/>
                                <b style="color: #7bc2ea;"><?php echo ($goodData["collectNum"]); ?></b>
                            <?php elseif($Think.session.AgentUser): ?>
                                <img id="collectIco" src="/App/style/img/collect.png"/>
                                <b><?php echo ($goodData["collectNum"]); ?></b>
                            <?php else: ?>
                                <a href="<?php echo U('Agent/Index/index');?>">
                                    <img  src="/App/style/img/collect.png"/>
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
				<a href="<?php echo U('Home/Index/index',array('agent'=>AGENT_ID));?>"><span><img src="/App/style/img/def01.png"/></span>首页</a>
				<b></b>
			</span>
			<span class="left">
				<a href="<?php echo U('Agent/Collection/index');?>"><span><img src="/App/style/img/def02.png"/></span>收藏夹</a>
			</span>
			<!-- 如果是代理商两个按钮 普通用户一个按钮 -->
			<?php if(session('AgentUser')){ ?>
			<span class="right" style="width:25%;background: #C1B3A5;">
				<a type="procurement" class="mysubmit_">采购</a>
			</span>
			<span class="right" style="width:25%;">
				<a type="reservation" class="mysubmit_">预定</a>
			</span>
			<?php }else{ ?>
			<span class="right">
				<a type="confirm" class="mysubmit_">确认购买</a>
			</span>
			<?php } ?>

		</div>

		<!--选择弹窗-->
		<form method="post" id="mysubmit" action="<?php echo U('Home/Buy/cart');?>">
		<input type="hidden" name="goods_id" value="<?php echo ($goodData["goods_id"]); ?>"> <!-- 商品id -->
		<input type="hidden" name="color" value=""> <!-- 所选颜色 -->
		<input type="hidden" name="agent_id" value="<?php echo ((isset($_GET['agent']) && ($_GET['agent'] !== ""))?($_GET['agent']):0); ?>"> <!-- 如果当前商品属于代理商 传代理商id -->
		<input type="hidden" name="num" value="1"> <!-- 数量 -->
		<input type="hidden" name="type" value=""> <!-- 提交类型 -->
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

				<button type="button">确认</button>
			</div>
		</div>
		</form>
        <div id="goods_id" data-val="<?php echo ($goodData["goods_id"]); ?>"></div>
        <div id="AgentUser" data-val="<?php echo (session('AgentUser')); ?>"></div>

		<script>

			$(function(){
				//收藏
                $('#collectIco').one('click', function () {
                    var goods_id = $('#goods_id').attr('data-val');
                    var agentUser = $('#AgentUser').attr('data-val');
                    var that = $(this);
                    $.post(
                        '<?php echo U(collect);?>',
                        {"agent_id":agentUser, "goods_id":goods_id},
                        function (data) {
                            if (data.code == 1) {
                                that.attr('src','/App/style/img/collectA.png');
                                that.next().css('color', '#7bc2ea');
                                that.next().text(parseInt(that.next().text())+1);
                            }
                               layer.msg(data.msg);
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

				// 颜色选择
				$('.popSelect .colour li').eq(0).addClass('on');
				$('input[name=color]').val($('.popSelect .colour li').eq(0).text());//默认颜色赋值给表单
				$('.popSelect .colour li').click(function(){
					$(this).addClass('on').siblings('li').removeClass('on');
					$('input[name=color]').val($(this).text());//默认颜色赋值给表单

				});

				//数量减
				var txtA = $('.popSelect .num input');
				var count = parseInt(txtA.val());
				$('.popSelect .reduct').click(function(){
					if(count <= 2){
						count = 2;
						$(this).css('color','#545b61');
					}else{
						$('.popSelect .num b').css('color','#ffffff');
					};
					txtA.val(--count);
					$('input[name=num]').val(count);//数量赋值给表单
				});
				//数量加
				$('.popSelect .add').click(function(){
					if(count >= (<?php echo ($inventory); ?> - 1)){
						count = <?php echo ($inventory); ?> - 1;
						$(this).css('color','#545b61');
						layer.msg('库存不足！');
					}else{
						$('.popSelect .num b').css('color','#ffffff');
					};
					txtA.val(++count);
					$('input[name=num]').val(count);//数量赋值给表单
				});

				$('.popSelect button').click(function(){
					$('.popSelect').hide();
					$('html,body').css('overflow','auto');
				});
			});
		</script>
	</body>
	<script type="text/javascript">
// 商品提交
$(document).ready(function (e) {
    $('#mysubmit').on('submit',(function(e) {

        var formData = new FormData(this);
        formData['type'] = 1;
        e.preventDefault();
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            // cache:false,
            contentType: false,
            processData: false,

            success:function(data){
               if(data.res == 1){
               		window.location.href=data.url;
               }
					layer.msg(data.msg)
            },
            error: function(data){
                layer.msg('网络错误！')
            }
        });
    }));

    $(".mysubmit_").on("click", function() {
    	var type = $(this).attr('type');
    	$('input[name=type]').val(type);
        $("#mysubmit").submit();
    });


    $(document).keydown(function(event){ 
        if(event.keyCode == 13){
        	var type = $(this).attr('type');
    		$('input[name=type]').val(type);
        	$("#mysubmit").submit();
        } 
     }); 
});




	</script>
</html>