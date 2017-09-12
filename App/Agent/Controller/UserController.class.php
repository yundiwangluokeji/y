<?php
namespace Agent\Controller;
use Agent\Model\UserModel;
class UserController extends PublicController 
{

	public function index()
	{
		$agent = M('agent')->where(array('father'=>session('AgentUser')))->select();

		foreach($agent as &$v){
			$money = M('money')->where(array('agent_id'=>$v['id']))->getField('money');
			$v['money'] = sprintf("%.2f",$money / 10 / 10);
			$config = M('agent_config')->field('name,logo')->where(array('agent_id'=>$v['id']))->find();
			$v['name'] = $config['name'];
			$v['logo'] = $config['logo'];
		}
		// dump($agent);exit;
		$this->assign('data',$agent);
		$this->display();
	}


	//创建代理商
	public function add()
	{
		    	if(IS_POST){
		    		$input = I('post.');
		    		$agent = new UserModel('agent');
		    		$data = $agent->datas($input);
		    		if(!is_array($data)){$this->ajaxReturn(array('res'=>0,'msg'=>$data));}
		    		M()->startTrans();
		    		$res = $agent->add($data);//添加代理商
		    		if($res){
		    			$data_['agent_id'] = $res;
		    			$moneyres = M('money')->add($data_);//添加代理商钱包
		    		}
		            $data2['name'] = $data['username'].'的店铺';
		            $data2['agent_id'] = $res;
		            $config = M('agent_config')->add($data2);//配置

		    		if($res && $moneyres && $config){
		    			M()->commit();
		    			$this->ajaxReturn(array('res'=>1,'msg'=>'添加成功！'));
		    		}else{
		    			M()->rollback();
		    			$this->ajaxReturn(array('res'=>2,'msg'=>'添加失败！'));
		    		}
		    	}else{

			    	$this->display();
		    	}
	}

}