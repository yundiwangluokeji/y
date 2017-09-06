<?php

 
//密钥  
define('KEY', '95664752368511453358971294651651'); //256 bit  
// define('VI', '56474061254058937921467785493582'); //64 bit  
  
//设置模式和IV   要想存到数据库中取出来还能验证 auto 修改成固定的(长度和key一致)或者把自动生成的向量值存起来
  
 


//加密
function encryption($str,$vi)
{
    import("Org.Xcrypt.Xcrypt");
    $Xcrypt = new Xcrypt(KEY, 'cbc', $vi);  
    return $Xcrypt->encrypt($str, 'base64');  
}



//解密
function decryption($str,$vi)
{
    import("Org.Xcrypt.Xcrypt");
    $Xcrypt = new Xcrypt(KEY, 'cbc', $vi);  
    return $Xcrypt->decrypt($str, 'base64');  

}


    /**
     * 生成随机字符串
     */
	function createluan($length){
		$str = '01234567899876543210012345678998745612300123456789987456321012';
		$strlen = 36; 
		while($length > $strlen){
			$str.= $str;
			$strlen += 36;
		}
		$str = str_shuffle($str); //随机打乱
		return substr($str,mt_rand(6,30),$length); 
	}



	//用ip获取地址
	function getip($ip){
		$ip = json_decode(file_get_contents('http://ip.taobao.com//service/getIpInfo.php?ip='.$ip));
		$data = $ip->data;
		return $data->country.'.'.$data->area.'.'.$data->region.'.'.$data->city.'.'.$data->county.'.'.$data->isp.'.'.$data->ip;
	}


	function sendcode($mobile)
	{
		//解密获取userid
		$mobile = $mobile;
		$r = __MOBILE__;
		if(!preg_match($r,$mobile)){$this->data['res'] = array('res'=>0,'msg'=>'手机号格式错误!');exit;}
		if(M('agent')->where(array('mobile'=>$mobile))->find()){return array('res'=>0,'msg'=>'此手机号已经被使用!');}

		$name = M('agent')->where(array('id'=>session('AgentUser')))->getField('username');//用户名
		$code = mt_rand(111111,999999);//验证码
		//将验证码缓存
		S('mobile'.$mobile,$code,60);
		 //时区设置：亚洲/上海
	    date_default_timezone_set('Asia/Shanghai');
	    //这个是你下面实例化的类
	    vendor('Alidayu.TopClient');
	    //这个是topClient 里面需要实例化一个类所以我们也要加载 不然会报错
	    vendor('Alidayu.ResultSet');
	    //这个是成功后返回的信息文件
	    vendor('Alidayu.RequestCheckUtil');
	    //这个是错误信息返回的一个php文件
	    vendor('Alidayu.TopLogger');
	    //这个也是你下面示例的类
	    vendor('Alidayu.AlibabaAliqinFcSmsNumSendRequest');

	    $c = new \TopClient;
	    //App Key的值 这个在开发者控制台的应用管理点击你添加过的应用就有了
	    $c->appkey = '23527420';
	    //App Secret的值也是在哪里一起的 你点击查看就有了
	    $c->secretKey = '5f95047e86e45110b79d1c5bbee129f1';
	    //这个是用户名记录那个用户操作
	    $req = new \AlibabaAliqinFcSmsNumSendRequest;
	    //代理人编号 可选
	    $req->setExtend("123456");
	    //短信类型 此处默认 不用修改
	    $req->setSmsType("normal");
	    //短信签名 必须
	    $req->setSmsFreeSignName("云狄网络");
	    //短信模板 必须
	    $time = date('Y-m-d H:i:s',time());
	    $req->setSmsParam("{\"code\":\"$code\",\"name\":\"$name\",\"time\":\"$time\"}");
	    //短信接收号码 支持单个或多个手机号码，传入号码为11位手机号码，不能加0或+86。群发短信需传入多个号码，以英文逗号分隔，
	    $req->setRecNum("$mobile");
	    //短信模板ID，传入的模板必须是在阿里大鱼“管理中心-短信模板管理”中的可用模板。
	    $req->setSmsTemplateCode('SMS_56995071'); // templateCode
	    
	    $c->format='json'; 
	    //发送短信
	    $resp = $c->execute($req);

	    if($resp && $resp->result){
	    	return array('res'=>1,'msg'=>'发送成功!');
	    }else{

	    	
	    	if($resp->sub_code == "isv.BUSINESS_LIMIT_CONTROL"){return array('res'=>2,'msg'=>'当前手机号验证码超限！');}

	    	return array('res'=>0,'msg'=>'发送失败!');
	    }


	}
//验证手机号
function validation_mobile($mobile){
		if(preg_match(__MOBILE__,$mobile)){
			return true;
		}
}




/**
 *   实现中文字串截取无乱码的方法
 * $string 要截取的字符串
 * $start 从哪个开始截取 0
 * $lenght 截取的长度
 */
function getsubstr($string, $start, $length) 
{
      if(mb_strlen($string,'utf-8')>$length){
          $str = mb_substr($string, $start, $length,'utf-8');
          return $str.'...';
      }else{
          return $string;
      }
}