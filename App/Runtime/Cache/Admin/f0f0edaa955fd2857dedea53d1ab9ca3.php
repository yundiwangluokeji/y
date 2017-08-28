<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>管理员登录 - 欢迎使用云狄科技商城系统</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="shortcut icon" type="image/ico" href="favicon.ico">
<link type="text/css" rel="stylesheet" href="/App/Admin/style/css/style.css">
<script type="text/javascript" src="/App/Admin/style/js/jquery.js"></script>
<script type="text/javascript" src="/App/Admin/style/js/global.js"></script>
<script type="text/javascript" src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<style type="text/css">
body{background:#3C7DBE url(/App/Admin/style/images/login_bg1.jpg) no-repeat center top; font-family:'Microsoft Yahei','Simsun',"宋体"}
.login_tt{font-size:24px; line-height:30px; color:#fff; width:462px; margin:0 auto; margin-top:150px; text-align:center}
.login{background:url(/App/Admin/style/images/login_bg.png) no-repeat; width:462px; height:244px; margin:0 auto; margin-top:15px; padding-top:40px;}
.input1{margin:0px 0 0 65px; font-size:14px; color:#888;}
.input1 input{width:140px; height:28px; border:0; line-height:28px; margin-left:5px;}
.input2{margin:23px 0 0 65px; font-size:14px; color:#888;}
.input2 input{width:140px; height:28px; border:0; line-height:28px; margin-left:5px;}
.input3_box{background:#fff url(/App/Admin/style/images/login_bg.png) no-repeat -36px -87px; border:1px #bbb solid; border-radius:5px; height:35px; line-height:32px;width:182px; padding-left:30px; color:#666; float:left;}
.input3{margin:20px 0 0 33px;}
.input3_box input{width:53px; height:28px; border:0; line-height:28px; margin-left:5px; margin-top:2px;}
.input3 img{margin-left:3px; width:80px; height:32px; border:0; float:left; display:inline; margin-top:2px;}
.login_btn{margin:25px 0 0 33px;}
.login_btn input{background:#0099CC; border-radius:4px; color:#fff; font-size:16px; font-family:'微软雅黑'; width:213px; height:40px; border:0; cursor:pointer;}
.copyright{text-align:center; color:#BECAD6;}
.copyright a,.copyright a:hover{color:#BECAD6;}
.login .input_name{float:left; margin-top:3px; display:block;}
</style>
</head>
<body>
<div class="login_tt"><span class="num">云狄科技</span>商城管理系统</div>
<form method="post" id="imageUploadForm">
<div class="login">	
	<div class="input1"><span class="input_name">账 号:</span>
			<input type="text" name="admin_name">
			<div class="clear"></div>
	</div>
	<div class="input2"><span class="input_name">密 码:</span>
		<input type="password" name="admin_pw">
		<div class="clear"></div>
	</div>
	<div class="input3">
		<div class="input3_box" style="position:relative;">
			<span class="fl">验证码:</span>
			<input class="fl" type="text" name="authcode">
			<div class="clear"></div>
			<img src="<?php echo U('Login/code');?>" onclick="pe_yzm(this)" style="cursor:pointer; position:absolute; left:128px; top:0">
		</div>
		<div class="clear"></div>
	</div>
	<div class="login_btn"><input type="button" id="ImageBrowse"  value="登 录"></div>
</div>
</form>

<script type="text/javascript">
$(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {

    	if ($(":input[name='admin_name']").val() == '') {
			msg('帐号不能为空！')
			return false;
		}
		if ($(":input[name='admin_pw']").val() == '') {
			msg('密码不能为空！')
			return false;
		}
		if ($(":input[name='authcode']").val() == '') {
			msg('验证码不能为空！')
			return false;
		}

		function msg(str){
		 $("#msgshow").remove();
		$("body").append('<div id="msgshow"><div id="msgshow_l"></div><div id="msgshow_m">'+str+'</div><div id="msgshow_r"></div><div class="clear"></div></div>');
		_w_top = document.body.scrollTop || document.documentElement.scrollTop;
		_w_height = $(window).height();
		_w_width = $(window).width();
		_d_top = _w_top + (_w_height - $("#msgshow").height()) / 2;
		_d_left = (_w_width - $("#msgshow_m").width() - 65) / 2;
		$("#msgshow").css({"top":_d_top, "left":_d_left}).show();
		setTimeout(function(){ $("#msgshow").fadeOut(2000) }, 2000);
		}


        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            type:'POST',
            url: '',
            data:formData,
            // cache:false,
            contentType: false,
            processData: false,

            success:function(data){
               if(data.res == 2){
               		window.location.href="<?php echo U('Index/index');?>";
               }else{
               	msg(data.msg)
				
               }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    $("#ImageBrowse").on("click", function() {
        $("#imageUploadForm").submit();
    });


    $(document).keydown(function(event){ 
        if(event.keyCode == 13){
        	$("#imageUploadForm").submit();
        } 
     }); 
});

</script>
	<style type="text/css">
	#msgshow{position:absolute;font-family:'Arial';}
	#msgshow_l{background:url(/App/Admin/style/images/dui_l.gif) no-repeat; width:38px; height:50px; float:left;}
	#msgshow_r{background:url(/App/Admin/style/images/dui_r.gif) no-repeat; width:7px; height:50px; float:left;}
	#msgshow_m{background:url(/App/Admin/style/images/dui_m.gif) repeat-x; height:34px; float:left; padding:16px 10px 0 10px; font-size:14px; font-weight:bold; color:#598f13; display:inline-block; min-width:95px; _width:95px;}
	</style>
	<script type="text/javascript">
		
	</script>

	</body></html>