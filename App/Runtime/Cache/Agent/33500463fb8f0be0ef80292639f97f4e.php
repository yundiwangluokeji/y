<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" /> 
		<title>南方钟表</title>
		<link rel="stylesheet" href="/App/style/css/public.css" />
		<link rel="stylesheet" href="/App/style/css/editAddress.css" />
		<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js" ></script>		
	<script type="text/javascript" src="/App/style/layer/layer.js"></script>
		<script>document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';$(window).resize(function(){document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';})</script>
		<style type="text/css">select{width:60%;height: 0.8rem;border:none;background: none;}</style>
	</head>
	<body>
		<div class="header">
			<div class="mg">
				<a class="goback" href="javascript:history.back();"><img src="/App/style/img/back.png"/></a>
				<h1>编辑地址</h1>
				<!-- <a class="keepEdit" href="">保存</a>	 -->
			</div>
		</div>
		
		<div class="contains">	
			<div class="editAddress">
				<form  id="imageUploadForm">
				<input type="hidden" name="addressid" value="<?php echo ($address["id"]); ?>">
					<label>
						<span>姓名</span>
						<input type="text" name="name" value="<?php echo ($address["name"]); ?>" placeholder="请输入收货人姓名" />
					</label>
					<label>
						<span>手机</span>
						<input type="tel" name="mobile" value="<?php echo ($address["mobile"]); ?>"  placeholder="请输入收件人手机号" maxlength="11" onblur="isTel(this.value);"/>
					</label>
					<label style="width:100%;">
						<span>选择省</span>
						
							<select name="province" class="province" level="1">
									<option>请选择省份</option>
								<?php if(is_array($data)): foreach($data as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($address['province'] == $v['id']){echo 'selected';}?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						<img src="/App/style/img/localize.png"/>
					</label>
					<label style="width:100%;">
						<span>选择市</span>
							<select name="city" class="select2" level="2">
							<?php if(is_array($address[city_])): foreach($address[city_] as $key=>$city_v): ?><option  value="<?php echo ($city_v['id']); ?>" <?php if($address['city'] == $city_v['id']){echo 'selected';}?>><?php echo ($city_v['name']); ?></option><?php endforeach; endif; ?>
							</select>
						<img src="/App/style/img/localize.png"/>
					</label>
					<label style="width:100%;">
						<span>选择区</span>
							<select  name="district" class="select3" level="3">
							<?php if(is_array($address[district_])): foreach($address[district_] as $key=>$district_v): ?><option  value="<?php echo ($district_v['id']); ?>" <?php if($address['city'] == $district_v['id']){echo 'selected';}?>><?php echo ($district_v['name']); ?></option><?php endforeach; endif; ?>
							</select>
						<img src="/App/style/img/localize.png"/>
					</label>
					<label style="width:100%;">
						<span>选择乡镇</span>
							<select name="twon"  class="select4">
							<?php if(is_array($address[twon_])): foreach($address[twon_] as $key=>$twon_v): ?><option  value="<?php echo ($twon_v['id']); ?>" <?php if($address['city'] == $twon_v['id']){echo 'selected';}?>><?php echo ($twon_v['name']); ?></option><?php endforeach; endif; ?>
							</select>
						<img src="/App/style/img/localize.png"/>
					</label>
					<label>
						<span>详细地址</span>
						<input type="text" name="address" value="<?php echo ($address["address"]); ?>" placeholder="请输入详细地址" />
					</label>
				
					<a class="keepEdit"  id="ImageBrowse">保存</a>
				</form>
			</div>	
		</div>			
			
		<!--提示-->
		<div class="tipAddress"></div>		
		<script>
			
			//表单验证
			var txtTip = $('.tipAddress');
			var regtel = /0?(13|14|15|18)[0-9]{9}/;				
			function isTel(obj){
				if(!regtel.test(obj)){
					layer.msg('请填写11位有效手机号码');
					
				}else{
					obj;					
				};		
			};
		</script>
		<script type="text/javascript">
	$('select').change(function(){
		var mythis = $(this);
		var level = $(this).attr('level');
		var url = "/index.php<?php echo U('lower');?>";
		$.get(url,{'id':$(mythis).val()},function(res){
			if(res.length>0){

				var str = '<option>请选择</option>';
				$.each(res,function(i , v){
					str += "<option value='"+v.id+"'>"+v.name+"</option>";
				})

				var select = $('select');
				if(level == 1){
					select.eq(1).html('');
					select.eq(2).html('');
					select.eq(3).html('');
				}else if(level == 2){
					select.eq(2).html('');
					select.eq(3).html('');
				}
				$('.select'+(parseInt(level)+1)).parent().css('display','');

				$('.select'+(parseInt(level)+1)).html(str);
			}else{
				// $(mythis).next().remove();
				$('.select'+(parseInt(level)+1)).parent().css('display','none');

			}

		})
	})

</script>
<script type="text/javascript">
	$(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {
    			if($('.editAddress label:nth-child(1) input').val() == ""){
					
					layer.msg('请输入收货人姓名');
					return false;
				}else if($('.editAddress label:nth-child(2) input').val() == ""){
					
					layer.msg('请输入收件人手机号');
					return false;
				}else if(!$('.province').val()){
					layer.msg('请选择省份');
					return false;
				}else if(!$('.select2').val()){
					layer.msg('请选择市');
					return false;
				}else if(!$('.select3').val()){
					
					layer.msg('请选择区');
					return false;
				}else if($('.editAddress label:nth-child(4) input').val() == ""){
					
					layer.msg('请输入详细地址');
					return false;
				}else if(!regtel.test($('input[name=mobile]').val())){
					
					layer.msg('请填写11位有效手机号码');
					return false;
				}



		e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
               if(data.res == 1){
               		window.location.href = "<?php echo ($_SERVER[HTTP_REFERER]); ?>";
               }else{
               		layer.msg(data.msg)
               }
            },
            error: function(data){
               		layer.msg('网络错误！');
            }
        });
    }));

    $("#ImageBrowse").on("click", function() {
        $("#imageUploadForm").submit();
    });

});
</script>
</body>
</html>