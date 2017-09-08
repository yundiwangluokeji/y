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
        for ($i=0; $i < count($list); $i++) {
            // 上次登录时间
            $lastTime = M('login_log')->where(array('name' => $list[$i]['username']))->field('time')->order('time desc')->find();
            if($lastTime){
                $times = time() - $lastTime['time'];
                if ($times > 86400) {
                    $times = floor($times/(86400)).'天前';
                }elseif ($times > 3600) {
                    $times = floor($times/(3600)).'小时前';
                }elseif($times > 60) {
                    $times = floor($times/(60)).'分钟前';
                } else {
                    $times = $times.'秒前';
                }
                $list[$i]['login_time'] = $times;
            }else {
                $list[$i]['login_time'] = '未登录';
            }

        }
    	$this->assign('data',$list);

        // dump($times);exit;
        $this->assign('times', $times);
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
    		$res = $agent->add($data);//添加代理商
    		if($res){
    			$data_['agent_id'] = $res;
    			$moneyres = M('money')->add($data_);//添加代理商钱包
    		}
            $data2['name'] = $data['username'].'的店铺';
            $data2['agent_id'] = $res;
            $config = M('agent_config')->add($data2);

    		if($res && $moneyres && $config){
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

    // 删除代理商
    public function dels()
    {
        if (IS_GET) {
            $id = I('get.id');
        } else {
            $id = I('post.user_id');
        }
        $delRes = D('agent')->dels($id);
        if ($delRes['status']) {
            $this->success($delRes['msg']);
        } else {
            $this->error($delRes['msg']);
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



    // 地址
    public function address()
    {
        if (I('get.id')) {
            $addressRes = M('address')->field('id,agent_id,name,mobile,province,city,district,twon,address,time')->Page($_GET['P'],20)->where(array('agent_id' => I('get.id')))->select();
        }else {
            $addressRes = M('address')->field('id,name,mobile,province,city,district,twon,address,time')->Page($_GET['P'],20)->select();
        }
        for ($i = 0; $i < count($addressRes); $i++) {
            $addressRes[$i]['time'] = date('Y-m-d', $addressRes[$i]['time']);
            $addressRes[$i]['province'] = M('area')->where(array('id' => $addressRes[$i]['province']))->field('name')->find()['name'];
            $addressRes[$i]['city'] = M('area')->where(array('id' => $addressRes[$i]['city']))->field('name')->find()['name'];
            $addressRes[$i]['district'] = M('area')->where(array('id' => $addressRes[$i]['district']))->field('name')->find()['name'];
            $addressRes[$i]['twon'] = M('area')->where(array('id' => $addressRes[$i]['twon']))->field('name')->find()['name'];
        }
        $this->assign('addressRes',$addressRes);
        $this->display();
    }

    // 货币操作记录
    public function money()
    {
        if (I('get.id')) {
            $data = M('money_log as m')
            ->join('__AGENT__ as a on m.agent_id = a.id')
            ->field('m.id,operation,money,ip,address,res,type,msg,time,username')
            ->Page($_GET['P'],20)
            ->where(array('m.agent_id' => I('get.id')))
            ->select();
        }else {
            $data = M('money_log as m')
                ->join('__AGENT__ as a on m.agent_id = a.id')
                ->field('m.id,operation,money,ip,address,res,type,msg,time,username')
                ->Page($_GET['P'],20)
                ->select();
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['time'] = date('Y-m-d', $data[$i]['time']);
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['money'] = sprintf("%.2f", $data[$i]['money'] / 10 / 10);//将货币转换为元保留两位小数
        }
        // 处理操作结果
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['res'] = '1') {
            $data[$i]['res'] = '成功';
            }else {
                $data[$i]['res'] = '失败';
            }
        }
        // 处理操作内型
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['type'] = '1') {
            $data[$i]['type'] = '收入';
            }else {
                $data[$i]['type'] = '支出';
            }
        }

        // dump($data);exit;
        $this->assign('data', $data);
        $this->display();
    }

    // 充值记录
    public function topUp()
    {
        if (I('get.id')) {
            $data = M('topup as t')
            ->join('__AGENT__ as a on t.agent_id = a.id')
            ->field('t.id,pay_type,order,order_sn,res,name,price,url,body,time,username')
            ->Page($_GET['P'],20)
            ->where(array('t.agent_id' => I('get.id')))
            ->select();
        }else {
            $data = M('topup as t')
                ->join('__AGENT__ as a on t.agent_id = a.id')
                ->field('t.id,pay_type,order,order_sn,res,name,price,url,body,time,username')
                ->Page($_GET['P'],20)
                ->select();
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['time'] = date('Y-m-d', $data[$i]['time']);

            if ($data[$i]['pay_type'] == '1') {
            $data[$i]['pay_type'] = '微信';
            }else {
                $data[$i]['pay_type'] = '支付宝';
            }

            if ($data[$i]['res'] == 0) {
                $data[$i]['res'] = '未支付';
            }elseif ($data[$i]['res'] == 1) {
                $data[$i]['res'] = '成功';
            } else{
                $data[$i]['res'] = '支付失败';
            }
        }

        $this->assign('data', $data);
        $this->display();
    }
    // 提现申请
    public function withdrawal()
    {
        if (I('get.id')) {
            $data = M('withdrawal as w')
            ->join('__AGENT__ as a on w.agent_id = a.id')
            ->field('w.id,pay_type,res,name,amount,a.username,account,time,w.username as usernames')
            ->Page($_GET['P'],20)
            ->where(array('w.agent_id' => I('get.id')))
            ->select();
        } else {
            $data = M('withdrawal as w')
            ->join('__AGENT__ as a on w.agent_id = a.id')
            ->field('w.id,pay_type,res,name,amount,a.username,account,time,w.username as usernames')
            ->Page($_GET['P'],20)
            ->select();
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['time'] = date('Y-m-d', $data[$i]['time']);

            if ($data[$i]['pay_type'] == '1') {
                $data[$i]['pay_type'] = '银行卡';
            }else {
                $data[$i]['pay_type'] = '支付宝';
            }

            if ($data[$i]['res'] == 0) {
                $data[$i]['res'] = '新申请';
            }elseif ($data[$i]['res'] == 1) {
                $data[$i]['res'] = '已打款';
            } else{
                $data[$i]['res'] = '已收款';
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function changeStatus()
    {
        $id = I('post.id');
        $saveRes = M('withdrawal')->where(array('id' => $id))->save(array('res' => 1));
        if ($saveRes) {
            $this->ajaxReturn(array(
                'status' => 1,
                'msg' => '修改成功',
                'data' => ''
            ));
        } else {
            $this->ajaxReturn(array(
                'status' => 0,
                'msg' => '修改失败',
                'data' => ''
            ));
        }
    }

    // 代理商登录日志
    public function loginLog()
    {
        if (I('get.name')) {
            $data = M('login_log')
                ->field('id,name,ip,address,res,msg,time')
                ->Page($_GET['P'],20)
                ->where(array('name' => I('get.name')))
                ->select();
        }else {
            $data = M('login_log')
                ->field('id,name,ip,address,res,msg,time')
                ->Page($_GET['P'],20)
                ->select();
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['time'] = date('Y-m-d', $data[$i]['time']);

            if ($data[$i]['res'] == '1') {
            $data[$i]['res'] = '成功';
            }else {
                $data[$i]['res'] = '失败';
            }

        }
        $this->assign('data', $data);
        $this->display();
    }

}
