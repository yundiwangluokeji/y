<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>充值(扣除)金额 </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link type="text/css" rel="stylesheet" href="/App/Admin/style/css/style.css" />
<script type="text/javascript" src="/App/Admin/style/js/jquery.js"></script>
<script type="text/javascript" src="/App/Admin/style/js/global.js"></script>
</head>
<body style="background:#fff;padding:5px">
<form method="post" id="form" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang_bak">
<tr>
	<td class="bgtt aright c888" width="100">账户余额</td>
	<td>
		<span class="corg num strong"><?php echo ($money['money']); ?> 元</span>
		<span class="mal10 c888 num mar10">[提现中：0 元]</span>		
	</td>
</tr>
<tr>
	<td class="bgtt aright c888">充值金额</td>
	<td><input type="text"  name="money" class="inputall input100" /> 元 <span id="money_show"></span></td>
</tr>
<tr>
	<td class="bgtt aright c888">操作说明</td>
	<td><input type="text" name="text" class="inputall input250" /> <span id="text_show"></span></td>
</tr>
</table>
<div class="acenter mat20">
	<input type="hidden" name="agent_id" value="<?php echo ($money['agent_id']); ?>" />
	
	<input type="button" value="提 交" class="tjbtn" />
</div>
</form>
</body>
</html>
<script type="text/javascript" src="/App/Admin/style/js/formcheck.js"></script>
<script type="text/javascript">
var form_info = [
	{"name":"money", "mod":"str", "act":"blur", "arg":"", "show_id":"money_show","show_error":"必填", "must":true},
	{"name":"text", "mod":"str", "act":"blur", "arg":"", "show_id":"text_show","show_error":"必填", "must":true}
]
$(":button").pe_submit(form_info, 'form');
</script>
</body>
</html>