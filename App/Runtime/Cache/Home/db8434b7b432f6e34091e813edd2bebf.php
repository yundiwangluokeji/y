<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" /> 
		<title>南方钟表</title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/optAddress.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>
		<script type="text/javascript" src="/App/style/layer/layer.js"></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';</script>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1>选择收货地址</h1>
				<a class="addAddress" href="<?php echo U('Agent/Address/address');?>">+ 添加</a>	
			</div>
		</div>
		
		<div class="contains">	
			<!--还没有收货地址-->
			<div class="noAddress" style="display: none;">
				<img src="/App/style/img/noAddress.png"/>
			</div>
			
			<!--选择地址-->
			<div class="optAddress" >
				<ul class="mg">
				<?php if(is_array($data)): foreach($data as $key=>$v): ?><li>
						<h1><em><?php echo getsubstr($v[name],0,20);?></em><?php echo ($v["mobile"]); ?></h1>
						<p><?php echo ($area[ $v['province'] ]); ?>,<?php echo ($area[ $v['city'] ]); ?>,<?php echo ($area[ $v['district'] ]); ?>,<?php echo ($v['address']); ?></p>
						<div class="handle">
							<label class="boxCheck" onclick="window.location.href='<?php echo U(session('buy_type'),array('address_id'=>$v['id']));?>'">
								<label  class="optCheck"><input class="default" type="radio" value="<?php echo ($v["id"]); ?>" name="default" /></label>
								<span>选择此地址</span>
							</label>
							<div class="operate">
								<span class="delete" val="<?php echo ($v["id"]); ?>">
									<b><img src="/App/style/img/delete.png"/></b>
									<h2>删除</h2>
								</span>
								<span class="edit">
									<b><img src="/App/style/img/edit.png"/></b>
									<h2 onclick="window.location.href='<?php echo U("Agent/Address/address",array(addressid=>$v[id]));?>'">编辑</h2>
								</span>
							</div>
						</div>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>

		</div>	
		
		<!--删除提示-->
		<div class="deleteTip">
			<div class="details">
				<h1>确定删除该地址？</h1>
				<span class="clear">
					<a class="cancel" href="javascript:;">取消</a>
					<a class="confirm" href="javascript:;">确认</a>
				</span>
			</div>
		</div>
		
		<script>
			$(function(){
				
				//删除
				$('.optAddress .delete').click(function(){
					liNum = $(this).parent('.operate').parent('.handle').parent('li').index();
					addressid = $(this).attr('val');
					$('.deleteTip').fadeIn();						
				});

				$('.deleteTip .cancel').click(function(){
					$('.deleteTip').fadeOut();

				});

				$('.deleteTip .confirm').click(function(){
					$.get('<?php echo U("Agent/Address/delete");?>',{addressid:addressid},function(res){
						if(res.res == 1){
							$('.deleteTip').fadeOut();
							$('.optAddress li').eq(liNum).remove();
						}
						layer.msg(res.msg)
					})
					
				});


			});
		</script>
	</body>
</html>