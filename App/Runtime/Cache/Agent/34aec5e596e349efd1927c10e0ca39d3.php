<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/App/style/css/public.css">
	<link rel="stylesheet" type="text/css" href="/App/style/css/login.css">
	<script type="text/javascript" src="/App/style/js/jquery-1.7.1.min.js"></script>
	<script>
		document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		$(window).resize(function () {  
			document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + 'px';
		 }) 
	</script>
</head>
<body>
	<div class="header">
		<a class="back" href="javascript:history.go(-1)"><img src="/App/style/img/back_last.png"></a>
		<i class="line"></i>
		<h3>登录</h3>
	</div>

	<div class="content">
		<form  method="post" action="" id="imageUploadForm">
			<label>
				<span>账号</span>
				<input class="user" type="text" name="user" placeholder="请输入账号">
			</label>
			<label>
				<span>密码</span>
				<input class="password" type="password" name="password" placeholder="请输入密码">
			</label>
			<p><a href="">忘记密码？</a></p>
			<button id="ImageBrowse" class="submit" type="submit">登录</button>
		</form>
	</div>
	<!-- 验证码弹窗 -->
	<div class="success" style="display: none;">
		<p></p>
	</div>
</body>
</html>
<script type="text/javascript">

	function checkForm(){  
	    var user=$('.user').val();
	    var password=$('.password').val();
	    if(user==''){
	        $('.success p').html('账号不能为空')
	        $(".success").fadeIn(200).delay(1500).fadeOut(200);
	         return false; 
	    }
	    if(password==''){
	        $('.success p').html('密码不能为空')
	        $(".success").fadeIn(200).delay(1500).fadeOut(200);
	         return false; 
	    }

	}


	$(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {

    	var user=$('.user').val();
	    var password=$('.password').val();
	    if(user==''){
	        $('.success p').html('账号不能为空')
	        $(".success").fadeIn(200).delay(1500).fadeOut(200);
	         return false; 
	    }
	    if(password==''){
	        $('.success p').html('密码不能为空')
	        $(".success").fadeIn(200).delay(1500).fadeOut(200);
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
               if(data.res == 2){
               		window.location.href = "<?php echo U('Index/index');?>";
               }else{
               		$('.success p').html(data.msg)
	        		$(".success").fadeIn(200).delay(1500).fadeOut(200);
               }
            },
            error: function(data){
               		$('.success p').html('网络错误！');
	        		$(".success").fadeIn(200).delay(1500).fadeOut(200);
            }
        });
    }));

    $("#ImageBrowse").on("click", function() {
        $("#imageUploadForm").submit();return false;
    });

});
</script>