<?php
namespace Admin\Controller;
use Admin\Model\UserModel;

class UserController extends PublicController 
{
	//代理商列表
    public function index()
    {
    	$_GET['p'] = $_GET['p']?$_GET['p']:1;
    	$agent = M('agent');
    	$list = $agent->join('__MONEY__ ON __MONEY__.agent_id = __AGENT__.id')->page($_GET['p'].',20')->select();
    	$this->assign('list',$list);
    	$count      = $agent->join('__MONEY__ ON __MONEY__.agent_id = __AGENT__.id')->count();
    	$Page       = new \Think\Page($count,20);
    	$show       = $Page->show();
    	$this->assign('page',$show);
    	foreach($list as &$v){
    		$v['money'] = sprintf("%.2f", $v['money'] / 10 / 10);
    	}
    	$this->assign('data',$list);
    	$this->display();
    }

    //添加代理商
    public function add()
    {
    	if(IS_POST){
    		$input = I('post.');
    		$agent = new UserModel('agent');
    		$data = $agent->datas($input);
    		if(!is_array($data)){$this->error($data);}
    		M()->startTrans();
    		$res = $agent->add($data);
    		if($res){
    			$data_['agent_id'] = $res;
    			$moneyres = M('money')->add($data_);
    		}
    		if($res && $moneyres){
    			M()->commit();
    			$this->success('添加成功！');
    		}else{
    			M()->rollback();
    			$this->error('添加失败！');
    		}
    	}else{
    		// $i = '100000';//100000
    		// $n = $i / 10 / 10;
    		// echo sprintf("%.2f", $n);;

	    	$this->display();
    	}

    }


    //修改
    public function update()
    {
    	if(IS_POST){
    		$input = I('post.');
    		$agent = M('agent');
    		// $data = $agent->datas($input);
    		if($input['password']){
				$input['secret'] = createluan(32);//创建vi
				$input['password'] = encryption($input['password'],$input['secret']);//创建密码
    			$res = $agent->save($input);
    			if($res){
    				$this->success('修改成功！');
	    		}else{
	    			$this->error('修改失败！');
	    		}
    		}else{
    				$this->error('你没有修改任何数据！');
    		}

    	}else{
    		$id = I('get.id');
    		if($id){
    			$agent = M('agent')->join('__MONEY__ ON __MONEY__.agent_id = __AGENT__.id')->where(C('DB_PREFIX')."agent.id =".$id)->find();

    			$this->assign('agent',$agent);
    		}
    		$this->display();
    	}


    }

    //用户状态
    public function status()
    {
    	$input = I('get.');
    	$status['status'] = $input['status']?0:1;
    	$res = M('agent')->where(array('id'=>$input['agent_id']))->save($status);
    	header('location:'.U('index'));

    }

    //充值钱
    public function addmoney()
    {
    		$model = M('money');
    		if(IS_POST){
    			$input = I('post.');
    			if(!$input['agent_id']){$this->error('错误操作！');}
    			if(!is_numeric($input['money'])){$this->error('请正确输入金额！');}
    			$data = $model->create($_POST,1);//根据表单提交的POST数据创建数据对象
            	if(!$data){$this->error($model->getError());}
            	$money = $data['money'] * 10 * 10;
            	$res = $model->where(array('agent_id'=>$data['agent_id']))->setInc('money',$money);
            	$data2['agent_id']  = $data['agent_id'];
            	$data2['operation'] = 0;//0管理员
            	$data2['type'] = 1;//0管理员
            	$data2['money_id']  = $model->where(array('agent_id'=>$data['agent_id']))->getField('id');
            	$data2['money']  =    '+'.$money;
            	$data2['ip']  = $_SERVER['REMOTE_ADDR'];
            	$data2['address']  = getip($_SERVER['REMOTE_ADDR']);
            	
            	$data2['msg']  = '管理员给你充值 '.$input['money'].'元 管理员备注:'.$input['text'];
            	$data2['time']  = time();
            	if($res){$data2['res']  = 1;}
            	M('money_log')->add($data2);
            	if($res){
    				$this->success('充值成功！');
	    		}else{
	    			$this->error('充值失败！');
	    		}
    		}else{
    			$agent_id = I('get.agent_id');
    			$money = $model->where(array('agent_id'=>$agent_id))->find();
    			if($money){
    				$money['money'] = sprintf("%.2f", $money['money'] / 10 / 10);//将货币转换为元保留两位小数
    				$this->assign('money',$money);
    			}
		    	$this->display();
    		}

    }

    //扣款
    public function deductmoney()
    {

    	    $model = M('money');
    		if(IS_POST){
    			$input = I('post.');
    			if(!$input['agent_id']){$this->error('错误操作！');}
    			if(!is_numeric($input['money'])){$this->error('请正确输入金额！');}
    			$data = $model->create($_POST,1);//根据表单提交的POST数据创建数据对象
            	if(!$data){$this->error($model->getError());}
            	$money = $data['money'] * 10 * 10;
            	$res = $model->where(array('agent_id'=>$data['agent_id']))->setDec('money',$money);
            	$data2['agent_id']  = $data['agent_id'];
            	$data2['operation'] = 0;//0管理员 操作者
            	$data2['type'] = 0;//0管理员
            	$data2['money_id']  = $model->where(array('agent_id'=>$data['agent_id']))->getField('id');//被操作者
            	$data2['money']  =    '-'.$money;
            	$data2['ip']  = $_SERVER['REMOTE_ADDR'];
            	$data2['address']  = getip($_SERVER['REMOTE_ADDR']);
            	
            	$data2['msg']  = '管理员扣除 '.$input['money'].'元 管理员备注:'.$input['text'];
            	$data2['time']  = time();
            	if($res){$data2['res']  = 1;}
            	M('money_log')->add($data2);
            	if($res){
    				$this->success('扣除成功！');
	    		}else{
	    			$this->error('扣除失败！');
	    		}
    		}else{
    			$agent_id = I('get.agent_id');
    			$money = $model->where(array('agent_id'=>$agent_id))->find();
    			if($money){
    				$money['money'] = sprintf("%.2f", $money['money'] / 10 / 10);//将货币转换为元保留两位小数
    				$this->assign('money',$money);
    			}
		    	$this->display();
    		}


    }

}