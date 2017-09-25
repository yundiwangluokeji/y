<?php
namespace Agent\Controller;
class OrderController extends PublicController 
{

	//采购单列表
	public function index()
	{
		// dump(session());exit;
		// $this->order_goods();
		$this->display();
	}

	//数据列表
	public function procurementdata()
	{
		// 查询订单商品商品
		//查询下家和自己卖出的零售商品
		$where['path']  = array('like', '%_'.session('AgentUser').'_%');
		// M()->execute('SET GLOBAL group_concat_max_len=10240000');
		$agent = M('agent')->field('group_concat(id) as id')->where($where)->select()[0]['id'];
		$agent .= ($agent)?','.session('AgentUser'):session('AgentUser');
		$buy = I('buy',1);//采购还是预定 0预定 1采购
		//查询订单
		$order = M('order')->where("consignee_id != 0 and buy = {$buy} and agent_id in(".$agent.")")->Page($_GET['p'],10)->order('order_id desc')->select();
		//查询待自己确认的订单
		$mypath = M('agent')->where(array('id'=>session('AgentUser')))->getField('path');
		$this->assign('mypath',$mypath);

		// $confirm = M('order')->where(array('agent_id'=>session('AgentUser').' OR confirm = '.$mypath))->getField('order_id',true);

		$mylevel = M('agent')->where(array('id'=>session('AgentUser')))->getField('level');
		$this->assign('mylevel',$mylevel);

		$pid = M('agent')->where(array('id'=>session('AgentUser')))->getField('father');//查询父id
		//查询订单详情表
		$model = M('order_goods');
		//颜色处理
        $color = C('color');
		foreach($order as &$v){
			// if(in_array($v['order_id'],$confirm)){$v['confirm'] = 1;}//判断知否为待确认订单
			//每个颜色对应的数量
			$order_goods = $model->field('goods_name,color_num,goods_id,goods_num,goods_price')->where(array('order_id'=>$v['order_id']))->find();
			//查询上级价格
			if($pid){

				$v['father_price'] = sprintf("%.2f",M('agent_goods')->where(array('agent_id'=>$pid,'agent_goods_id'=>$order_goods['goods_id']))->getField('agent_price') * $order_goods['goods_num']);
			}else{

				$v['father_price'] = sprintf("%.2f",M('goods')->where(array('goods_id'=>$order_goods['goods_id']))->getField('price') * $order_goods['goods_num']);
			}
			//加密订单号
			$v['ordersn'] = encryption($v['order_sn']);
			$v['images'] = M('goods')->where(array('goods_id'=>$order_goods['goods_id']))->getField('images');
			$v['goods_name'] =$order_goods['goods_name'];
			$v['goods_num'] =$order_goods['goods_num'];
			$v['goods_price'] =$order_goods['goods_price'];
			$color_num = explode(',', $order_goods['color_num']);
			foreach($color_num as $vv){
				$color_num_ = explode('_', $vv);
				$v['num_color'][][$color_num_[1]] = $color[$color_num_[0]];
				// $color_num_[0];//颜色
				// $color_num_[1];//数量
			}
			
			

		}
		$this->assign('data',$order);
		$this->display();

	}

	//零售
	public function retail()
	{
		$this->display();
	}

	//零售数据
	public function retaildata()
	{

		// 查询订单商品商品
		//查询下家和自己卖出的零售商品
		$where['path']  = array('like', '%_'.session('AgentUser').'_%');
		M()->execute('SET GLOBAL group_concat_max_len=10240000');
		$agent = M('agent')->field('group_concat(id) as id')->where($where)->select()[0]['id'];
		$agent .= ($agent)?','.session('AgentUser'):session('AgentUser');

		//查询订单
		$order = M('order')->where('consignee_id = 0 and agent_id in('.$agent.')')->Page($_GET['p'],10)->order('order_id desc')->select();
		//查询待自己确认的订单
		$mypath = M('agent')->where(array('id'=>session('AgentUser')))->getField('path');
		$this->assign('mypath',$mypath);

		// $confirm = M('order')->where(array('agent_id'=>session('AgentUser').' OR confirm = '.$mypath))->getField('order_id',true);

		$mylevel = M('agent')->where(array('id'=>session('AgentUser')))->getField('level');
		$this->assign('mylevel',$mylevel);


		//查询订单详情表
		$model = M('order_goods');
		//颜色处理
        $color = C('color');
		foreach($order as &$v){
			// if(in_array($v['order_id'],$confirm)){$v['confirm'] = 1;}//判断知否为待确认订单
			//每个颜色对应的数量
			$order_goods = $model->field('goods_name,color_num,goods_id,goods_num,goods_price')->where(array('order_id'=>$v['order_id']))->find();
			//加密订单号
			$v['ordersn'] = encryption($v['order_sn']);
			$v['images'] = M('goods')->where(array('goods_id'=>$order_goods['goods_id']))->getField('images');
			$v['goods_name'] =$order_goods['goods_name'];
			$v['goods_num'] =$order_goods['goods_num'];
			$v['goods_price'] =$order_goods['goods_price'];
			$color_num = explode(',', $order_goods['color_num']);
			foreach($color_num as $vv){
				$color_num_ = explode('_', $vv);
				$v['num_color'][][$color_num_[1]] = $color[$color_num_[0]];
				// $color_num_[0];//颜色
				// $color_num_[1];//数量
			}



		}
			// echo '<pre>';
			// print_r($order);exit;
			// dump($order);exit;


		$this->assign('data',$order);
		$this->display();
	}


	//已收款通知上家发货
	public function notice()
	{
		if(IS_AJAX){
			$order_sn = decryption(I('order_sn'));//解密订单号
			if(!$order_sn){$this->ajaxReturn('非法操作~~~');}
			$order_id = M('order')->where(array('order_sn'=>$order_sn))->getField('order_id');//转换为订单id

			if($order_id){
				$pid = M('agent')->where(array('id'=>session('AgentUser')))->getField('father');//查询父id
				if($pid  !== false){
					$p_path = M('agent')->where(array('id'=>$pid))->getField('path');//查询父路径 写入订单表confirm字段 表示请求他确认
					if($pid == 0){$p_path = '0_0';}//如果上级是总平台
					if($p_path){
						M()->startTrans();
						$level = M('agent')->where(array('id'=>session('AgentUser')))->getField('level');//自己的层级
						$order_res = M('order')->where(array('order_id'=>$order_id))->save(array('confirm'=>$p_path,'order_status'=>$level));//更新订单表
						//写入订单操作日志
						$data['order_id'] = $order_id;//订单id
						$data['operation'] = session('AgentUser');//操作者id
						$father_name = M('agent_config')->where(array('agent_id'=>$pid))->getField('name');//查询上级店铺名称
						if(!$father_name){$father_name = M('config')->where(array('config_id'=>1))->getField('configval');}//如果上级是总平台
						$data['msg'] = '《'.$this->config['name'].'》在 '.date('Y-m-d H:i:s',time()).' 通知《'.$father_name.'》发货！';//信息说明
						$data['time'] = time();//操作时间
						$log_res = M('order_log')->add($data);

						//计算扣除的货币金额
						$goods_id = M('order_goods')->where(array('order_id'=>$order_id))->getField('goods_id');
						if($goods_id){
							//查询上级代理商的当前商品价格
							$goods_price = M('agent_goods')->where(array('agent_id'=>$pid,'agent_goods_id'=>$goods_id))->getField('agent_price');
							if($pid == 0){$goods_price = M('goods')->where(array('goods_id'=>$goods_id))->getField('price');}
							if($goods_price){
									$money = ($goods_price * 10 * 10) * M('order_goods')->where(array('order_id'=>$order_id))->getField('goods_num');//转换成分在乘以数量
									//判断余额
									$agent_money = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('money');//查询当前代理商的余额
									if(($agent_money - 100000) < $money){M()->rollback();$this->ajaxReturn('余额不足！');}//当前代理商的货币减去1000元保证金 

									$monye_res = M('money')->where(array('agent_id'=>session('AgentUser')))->setDec('money',$money);//扣除当前代理商货币

									//记录当前商品的价格 预定商品解除时用 当前扣除多少 解除时退还多少
									$reservationdata['order_id'] = $order_id;//订单id
									$reservationdata['agent_id'] = session('AgentUser');//代理商id
									$reservationdata['count_price'] = $money / 10 / 10;//当时扣除的价格 转换回元
									$reservationdata['time'] = time();
									$order_reservation = M('order_reservation')->add($reservationdata);


									if($monye_res){
										//货币操作日志
										$data1['money'] = $money;
										$data1['operation'] = session('AgentUser');//操作者id
										$data1['agent_id'] = session('AgentUser');//被操作者id
										$data1['money_id'] = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('id');//钱包id
										$data1['ip'] = $_SERVER['REMOTE_ADDR'];
								        $data1['address'] = getip($_SERVER['REMOTE_ADDR']);
								        $data1['res'] = $monye_res;
								        $data1['type'] = 0;
								        $data1['msg'] = ''.$data['msg'];
								        $data1['time']  = time();
								        M('money_log')->add($data1);

									}
									//如果上级不是总平台给对应的上级增加货币
									if($pid != 0){
										$money_res2 = M('money')->where(array('agent_id'=>$pid))->setInc('money',$money);//给上级代理商增加货币
										if($money_res2){
											//货币操作日志
											$data2['money'] = $money;
											$data2['operation'] = session('AgentUser');//操作者id
											$data2['agent_id'] = $pid;//被操作者id
											$data2['money_id'] = M('money')->where(array('agent_id'=>$pid))->getField('id');//钱包id
											$data2['ip'] = $_SERVER['REMOTE_ADDR'];
									        $data2['address'] = getip($_SERVER['REMOTE_ADDR']);
									        $data2['res'] = $money_res2;
									        $data2['type'] = 1;
									        $data2['msg'] = ''.$data['msg'];
									        $data2['time']  = time();
									        M('money_log')->add($data2);

										}
										
									}else{
										$money_res2 = 1;
									}


									if($order_res && $log_res && $monye_res && $money_res2 && $order_reservation){
										M()->commit();
										$this->ajaxReturn(array('res'=>1,'msg'=>'操作成功'));
									}else{
										M()->rollback();$this->ajaxReturn('操作失败！');
									}
									exit;
								
							}
						}
					}
					
				}
				M()->rollback();$this->ajaxReturn('操作失败！');

			}else{
				$this->ajaxReturn('非法操作~~~');
			}


		}
	}

	//自己发货
	public function delivery()
	{
		if(IS_AJAX){
			$order_sn = decryption(I('order_sn'));//解密订单号
			if(!$order_sn){$this->ajaxReturn('非法操作~~~');}
			$order_id = M('order')->where(array('order_sn'=>$order_sn))->getField('order_id');//转换为订单id
			if($order_id){
				M()->startTrans();
				$level = M('agent')->where(array('id'=>session('AgentUser')))->getField('level');//自己的层级
				$order_res = M('order')->where(array('order_id'=>$order_id))->save(array('confirm'=>'0_0','order_status'=>$level,'shipping_status'=>1));
				if($order_res){
						$data['order_id'] = $order_id;//订单id
						$data['operation'] = session('AgentUser');//操作者id
						$data['msg'] = '《'.$this->config['name'].'》在 '.date('Y-m-d H:i:s',time()).' 进行发货操作！';//信息说明
						$data['time'] = time();//操作时间
						$log_res = M('order_log')->add($data);
				}
			}

			if($order_res && $log_res){
				M()->commit();
				$this->ajaxReturn(array('res'=>1,'msg'=>'操作成功'));
			}else{
				M()->rollback();$this->ajaxReturn('操作失败！');
			}
		}
	}



}

	