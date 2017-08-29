<?php


namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
	 protected $_validate = array(     
	 array('name','require','用户名不能为空！'), //默认情况下用正则进行验证 
	 array('name','','帐号名称已经存在！',0,'unique',1), 
	 array('pwd','require','密码名不能为空！',6), 
	);

	public function datas($input)
	{
		if(!$input['username']){return ('用户名不能为空');}
		if($this->where(array('username'=>$input['username']))->find()){return '用户名已存在！';}
		$input['username'] = trim($input['username']);
		$input['password'] = $input['password']?trim($input['password']):'123456';
		$input['secret'] = createluan(32);//创建vi
		$input['password'] = encryption($input['password'],$input['secret']);//创建密码
		$input['addtime'] = time();
		$input['level'] = 1;
		//获取当前数据即将插入的id
		$inseriddata = $this->query("SHOW TABLE STATUS");
		foreach($inseriddata as $v){
			if($v['name'] == $this->trueTableName){
				$inserid = $v['auto_increment'];
			}
		}
		$input['path'] = '0_'.$inserid;
        return $input;
	}

	
		

}
 
