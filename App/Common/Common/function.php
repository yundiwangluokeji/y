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
