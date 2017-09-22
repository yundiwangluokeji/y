<?php
namespace Agent\Controller;
class ProcurementController extends PublicController 
{

	//采购单列表
	public function index()
	{
		// $this->order_goods();
		$this->display();
	}

	//数据列表
	public function ajaxlist()
	{
		$where['consignee_id'] = array('eq',session('AgentUser'));
		$where['pay_status'] = array('eq',1);
		$where['shipping_status'] = array('eq',1);
		$where['buy'] = array('eq',I('buy',0));
		// $where['agent_id'] = array('eq',session('AgentUser'));


		$data = M('order')->where($where)->Page($_GET['p'],10)->select();

		// dump(M());exit;
		$model = M('order_goods');
		$modelgoods = M('goods');
        $color = C('color');
		foreach($data as &$v){
			$v['ordersn'] = encryption($v['order_sn']);//加密订单号

			$order_goods = $model->where(array('order_id'=>$v['order_id']))->find();//查询订单详情表中的商品
			$goods = $modelgoods->field('goods_sn,images')->where(array('goods_id'=>$order_goods['goods_id']))->find();//从商品表中获取图片和商品编号
			$order_goods['goods_sn'] = $goods['goods_sn'];
			$order_goods['images'] = $goods['images'];
			$v['order_goods'] = $order_goods;

			$color_num = explode(',', $order_goods['color_num']);
			foreach($color_num as $vv){
				$color_num_ = explode('_', $vv);
				$v['num_color'][][$color_num_[1]] = $color[$color_num_[0]];
				// $color_num_[0];//颜色
				// $color_num_[1];//数量
			}
			// echo '<pre>';
			// print_r($data);exit;

		}
		//查询上级id
		$father = M('agent')->where(array('id'=>session('AgentUser')))->getField('father');


		$this->assign('father',$father);
		$this->assign('data',$data);
		// dump($data);exit;
		$this->display();

	}


	//解除
	public function remove()
	{
		if(1){
			$order_sn = decryption(I('order_sn'));
			if(!$order_sn){$this->ajaxReturn('非法操作！');}//如果订单号解密失败
			$order_id = M('order')->where(array('order_sn'=>$order_sn))->getField('order_id');//转换为订单id
			if(!$order_id){$this->ajaxReturn('非法操作！');}
			M()->startTrans();
			//改变订单状态
			$order_res = M('order')->where(array('order_id'=>$order_id))->save(array('buy'=>2));//修改订单为解除状态
			if($order_res){
						//订单操作日志
						$data['order_id'] = $order_id;//订单id
						$data['operation'] = session('AgentUser');//操作者id
						$data['msg'] = '《'.$this->config['name'].'》在 '.date('Y-m-d H:i:s',time()).'解除订单号为：'.$order_sn.' 下的商品！';//信息说明
						$data['time'] = time();//操作时间
						$log_res = M('order_log')->add($data);

			}

			//删除对应商品
			$goods_id = M('order_goods')->where(array('order_id'=>$order_id))->getField('goods_id');
			if($goods_id){
				$agentgoods_res = M('agent_goods')->where(array('agent_goods_id'=>$goods_id,'agent_id'=>session('AgentUser')))->delete();
			}

			//退款到钱包
			$count_price = M('order')->where(array('order_id'=>$order_id))->getField('count_price') * 10 * 10;//订单总价格 转换成分
			if($count_price){
				$money = M('money')->where(array('agent_id'=>session('AgentUser')))->setInc('money',$count_price);
				if($money){

					//货币操作日志
					$logdata[0]['money'] = $count_price;
					$logdata[0]['operation'] = session('AgentUser');//操作者id
					$logdata[0]['agent_id'] = session('AgentUser');//被操作者id
					$logdata[0]['money_id'] = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('id');//钱包id
					$logdata[0]['ip'] = $_SERVER['REMOTE_ADDR'];
			        $logdata[0]['address'] = getip($_SERVER['REMOTE_ADDR']);
			        $logdata[0]['res'] = $money;
			        $logdata[0]['type'] = 1;
			        $logdata[0]['msg'] = ''.M('agent_config')->where(array('agent_id'=>session('AgentUser')))->getField('name').'解除预定商品！退款';
			        $logdata[0]['time']  = time();
			        // M('money_log')->add($logdata);


			        //循环扣除上级代理商的货币
					$path = M('agent')->where(array('id'=>session('AgentUser')))->getField('path');
					$path = substr($path,2,-3);
					$patharr = explode('_', $path);
					rsort($patharr);
					$money_res_s = 1;
					foreach($patharr as $k=>$v){
						//查询在上级预定时的价格
						$money_ = M('order_reservation')->where(array('agent_id'=>$v,'order_id'=>$order_id))->getField('count_price') * 100;//转换成分
						if($money_){
							$money_res_s *= $ress = M('money')->where(array('agent_id'=>$v))->setDec('money',$money_);
							//货币操作日志
							$logdata[$k+1]['money'] = $money_;
							$logdata[$k+1]['operation'] = session('AgentUser');//操作者id
							$logdata[$k+1]['agent_id'] = $v;//被操作者id
							$logdata[$k+1]['money_id'] = M('money')->where(array('agent_id'=>$v))->getField('id');//钱包id
							$logdata[$k+1]['ip'] = $logdata[0]['ip'];
					        $logdata[$k+1]['address'] = $logdata[0]['address'];
					        $logdata[$k+1]['res'] = $ress;
					        $logdata[$k+1]['type'] = 0;
					        $logdata[$k+1]['msg'] = ''.$logdata[0]['msg'];
					        $logdata[$k+1]['time']  = time();
						}
					}


			        if($money_res_s){
			        	$log_ress = M('money_log')->addAll($logdata);

			        }

					
				}
			}
	

			if($order_res && $agentgoods_res && $money && $money_res_s && $log_ress){
				M()->commit();
				$this->ajaxReturn(array('res'=>1,'msg'=>'操作成功'));
				
			}else{
					M()->rollback();
					$this->ajaxReturn('操作失败！');
			}



		}
	}


	//删除
	public function deletes()
	{
		if(IS_AJAX){
			$order_sn = decryption(I('order_sn'));
			if(!$order_sn){$this->ajaxReturn('非法操作！');}//如果订单号解密失败
			$order_id = M('order')->where(array('order_sn'=>$order_sn))->getField('order_id');//转换为订单id
			if(!$order_id){$this->ajaxReturn('非法操作！');}
			M()->startTrans();

			//改变订单状态为删除状态
			$order_res = M('order')->where(array('order_id'=>$order_id))->save(array('buy'=>3));

			//查询此订单的商品
			$goods_id = M('order_goods')->where(array('order_id'=>$order_id))->getField('goods_id');
			if($goods_id){
				$agent_goods_res = M('agent_goods')->where(array('agent_goods_id'=>$goods_id,'agent_id'=>session('AgentUser')))->delete();
			}

			if($order_res && $agent_goods_res){
				M()->commit();
				$this->ajaxReturn(array('res'=>1,'msg'=>'操作成功'));
			}else{
				M()->rollback();
					$this->ajaxReturn('操作失败！');
			}

		}
	}


	//编辑
	public function editor()
	{
		if(IS_POST){
			$input = I('post.');
			if($input['goodsid']){
				$res = M('agent_goods')->where(array('agent_id'=>session('AgentUser'),'agent_goods_id'=>$input['goodsid']))->save(array('agent_price'=>$input['price'],'goods_permissions'=>$input['goods_permissions'],'agent_is_recommend'=>$input['is_recommend']));

				if($res){
					$this->ajaxReturn(array('res'=>1,'msg'=>'修改成功'));
				}else{
					$this->ajaxReturn(array('res'=>0,'msg'=>'修改失败！'));

				}
			}




			dump($input);
		}else{
			$goods_id = I('goods');
			if($goods_id){
				//查询商品信息
				$goods = M('agent_goods')->where(array('agent_goods_id'=>$goods_id,'agent_id'=>session('AgentUser')))->find();
				$goods2 = M('goods')->field('images,goods_sn,name')->where(array('goods_id'=>$goods_id))->find();
				$goods['images'] = $goods2['images'];
				$goods['goods_sn'] = $goods2['goods_sn'];
				$goods['goods_name'] = $goods2['name'];
				$colorarr = explode(',', $goods['agent_color']);
				$color = '';
				foreach($colorarr as $v){
					$color .= C('color')[$v].',';
				}
				$goods['color'] = substr($color,0,-1);
				$this->assign('data',$goods);



			}else{
				$this->error('非法操作！');
			}

			$this->display();
		}


	}


}
