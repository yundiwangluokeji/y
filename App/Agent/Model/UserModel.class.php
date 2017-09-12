<?php


namespace Agent\Model;
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
		if(!$input['username']){return ('账号不能为空');}
		if($this->where(array('username'=>$input['username']))->find()){return '此账号已存在！';}
		$input['username'] = trim($input['username']);
		$input['password'] = $input['password']?trim($input['password']):'123456';
		$input['secret'] = createluan(32);//创建vi
		$input['password'] = encryption($input['password'],$input['secret']);//创建密码
		$input['addtime'] = time();
		//查询当前代理商 获取层级
		$agent = $this->where(array('id'=>session('AgentUser')))->find();
		if(!$agent){return '非法操作！';}
		if($agent['level'] == 3){return '你是三级代理，没有权限创建自己的代理商！';}
		$input['level'] = $agent['level'] + 1;
		$input['father'] = $agent['id'];//上级代理商id
		//获取当前数据即将插入的id
		$inseriddata = $this->query("SHOW TABLE STATUS");
		foreach($inseriddata as $v){
			if($v['name'] == $this->trueTableName){
				$inserid = $v['auto_increment'];
			}
		}
		$input['path'] = $agent['path'].'_'.$inserid;
        return $input;
	}

	
		

}
 
