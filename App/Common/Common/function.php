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