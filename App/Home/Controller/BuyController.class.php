<?php
namespace Home\Controller;
use Think\Controller;

class BuyController extends Controller
{
	public function index()
	{
		echo '回去吧';
	}

	//采购
	public function procurement()
	{
		if(session('cart')['type'] == 'procurement'){
			if(IS_POST){
				M()->startTrans();//开启事务

				//创建订单
				$order['order_sn'] = date('YmdHis',time()).mt_rand(111111,999999);//订单号
				$order['consignee_id'] = session('AgentUser');//收货人id
				$order['agent_id'] = session('cart')['agent_id'];//属于谁的商品
				//订单总价 如果是在代理商下买的 查询代理商的价格
				if(session('cart')['agent_id']){
					$count_price = M('agent_goods')->where(array('agent_goods_id'=>session('cart')['goods_id'],'agent_id'=>session('cart')['agent_id']))->getField('agent_price');
					$order['count_price'] = $count_price * array_sum(session('cart')['color']);
				}else{
					$count_price = M('goods')->where(array('goods_id'=>session('cart')['goods_id']))->getField('price');
					$order['count_price'] = $count_price * array_sum(session('cart')['color']);

				}
				$order['order_status'] = 0;//新订单
				$order['buy'] = 1;//购买
				$order['pay_status'] = 0;//支付状态
				$order['shipping_status'] = 0;//发货状态 
				$address = $this->address($_POST['address'],true);
				$order['username'] = $address['name'];//收货人姓名 
				$order['mobile'] = $address['mobile'];//收货手机号
				$order['address'] = $address['province'].$address['city'].$address['district'].$address['twon'].$address['address'];//地址
				$order['msg'] = session('cart')['msg'];
				$order['time'] = time();
				$order_res = M('order')->add($order);

				// dump($order_res);exit;

				//订单商品详情
				$order_goods['order_id'] = $order_res;//订单id
				$order_goods['goods_id'] = session('cart')['goods_id'];//商品id
				$order_goods['agent_id'] = session('cart')['agent_id'];//属于谁的商品
				$order_goods['goods_price'] = $count_price;//商品单价
				$order_goods['goods_num'] = array_sum(session('cart')['color']);//数量
				$order_goods['goods_name'] = M('goods')->where(array('goods_id'=>session('cart')['goods_id']))->getField('name');;
				$order_goods['goods_color'] = implode(',',array_keys(session('cart')['color']));//颜色
				//每个颜色对应的数量 格式:颜色键_数量
				$color_num = '';
				foreach(session('cart')['color'] as $kk=>$vv){
					$color_num .= $kk.'_'.$vv.',';
				}
				$order_goods['color_num'] = substr($color_num,0,-1);
				$order_goods['time'] = time();
				$order_goods_res = M('order_goods')->add($order_goods);
				if($order_res && $order_goods_res){

					M()->commit();//提交事务
					session('cart',null);
					//跳转倒支付页面
					//加密
					$orderid = encryption($order_res);//订单id
					$buy = encryption(1);//订单类型 预定
					header('location:'.U('pay').'?order='.urlencode($orderid).'&buy='.urlencode($buy));//加密后在编码(编码解决get特殊符号无法接收)


				}else{
					M()->rollback();
					$this->error('下单失败!');
				}
				exit;
			}else{

					$this->address($_GET['address_id']);//地址
					//查询商品
							$goods = M('goods')->where(array('goods_id'=>session('cart')['goods_id']))->find();
							if($goods){
								//如果是在代理商下买的商品  查询代理商的商品价格
								if(session('cart')['agent_id']){
									$goods['price'] = M('agent_goods')->where(array('agent_goods_id'=>session('cart')['goods_id'],'agent_id'=>session('cart')['agent_id']))->getField('agent_price');
								}
								$color_key = array_keys(session('cart')['color']);//取出颜色key
								$color = '';
								$colors = C('color');
								foreach($color_key as $vv){
									$color .= $colors[ $vv ].',';
								}
								$this->assign('color',substr($color,0,-1));
								$this->assign('num',array_sum(session('cart')['color']));
								$this->assign('count_price',sprintf("%.2f",$goods['price'] * array_sum(session('cart')['color'])));
								$this->assign('goods',$goods);
								$this->display();
								exit;
							}

						$this->error('非法操作！');
			}
		}

		$this->error('非法操作！');


	}




	//临时购物车 将提交的商品数据暂时出入session中
	public function cart()
	{
		if(IS_AJAX){
			$input = I('post.');
			session('cart',$input);
			if(session('?cart')){
				$this->ajaxReturn(array('res'=>1,'msg'=>'成功添加至购物车','url'=>U($input['type'])));
			}else{
				$this->ajaxReturn(array('res'=>0,'msg'=>'添加失败！请重新提交~'));
			}

		}else{
			$url = $_SERVER['HTTP_REFERER'] || $_SERVER['HTTP_HOST'];
			header("location:http://{$url}");
		}
	}

	//收货地址 如果$i为真 返回
	protected function address($address_id,$i=null)
	{
		//默认地址
		if(!$address_id){
			$address = M('address')->where(array('agent_id'=>session('AgentUser'),'is_default'=>1))->find();
		}else{
			$address = M('address')->where(array('agent_id'=>session('AgentUser'),'id'=>$address_id))->find();
		}
		if($address){
			$address['province'] = M('area')->where(array('id'=>$address['province']))->getField('name');
			$address['city'] = M('area')->where(array('id'=>$address['city']))->getField('name');
			$address['district'] = M('area')->where(array('id'=>$address['district']))->getField('name');
			$address['twon'] = M('area')->where(array('id'=>$address['twon']))->getField('name');
			if($i){
				return $address;
			}
			$this->assign('address',$address);
		}else{

		}
	}


	//选择收货地址
	public function choose_address()
	{
		if(!I('type')){$this->error('非法操作！');}
		session('buy_type',I('type'));//选择地址完成后返回的路径
		$data = M('address')->where(array('agent_id'=>session('AgentUser')))->select();
        $area = M('area')->getField('id,name',true);
        $this->assign('area',$area);
        $this->assign('data',$data);
    	$this->display();
	}


	//预定
	public function reservation()
	{

		if(session('cart')['type'] == 'reservation'){
			if(IS_POST){
				M()->startTrans();//开启事务

				//创建订单
				$order['order_sn'] = date('YmdHis',time()).mt_rand(111111,999999);//订单号
				$order['consignee_id'] = session('AgentUser');//收货人id
				$order['agent_id'] = session('cart')['agent_id'];//属于谁的商品
				//订单总价 如果是在代理商下买的 查询代理商的价格
				if(session('cart')['agent_id']){
					$count_price = M('agent_goods')->where(array('agent_goods_id'=>session('cart')['goods_id'],'agent_id'=>session('cart')['agent_id']))->getField('agent_price');
					$order['count_price'] = $count_price * array_sum(session('cart')['color']);
				}else{
					$count_price = M('goods')->where(array('goods_id'=>session('cart')['goods_id']))->getField('price');
					$order['count_price'] = $count_price * array_sum(session('cart')['color']);

				}
				$order['order_status'] = 0;//新订单
				$order['buy'] = 0;//预定
				$order['pay_status'] = 0;//支付状态
				$order['shipping_status'] = 0;//发货状态 
				$address = $this->address($_POST['address'],true);
				$order['username'] = $address['name'];//收货人姓名 
				$order['mobile'] = $address['mobile'];//收货手机号
				$order['address'] = $address['province'].$address['city'].$address['district'].$address['twon'].$address['address'];//地址
				$order['msg'] = session('cart')['msg'];
				$order['time'] = time();
				$order_res = M('order')->add($order);

				// dump($order_res);exit;

				//订单商品详情
				$order_goods['order_id'] = $order_res;//订单id
				$order_goods['goods_id'] = session('cart')['goods_id'];//商品id
				$order_goods['agent_id'] = session('cart')['agent_id'];//属于谁的商品
				$order_goods['goods_price'] = $count_price;//商品单价
				$order_goods['goods_num'] = array_sum(session('cart')['color']);
				$order_goods['goods_name'] = M('goods')->where(array('goods_id'=>session('cart')['goods_id']))->getField('name');;
				$order_goods['goods_color'] = implode(',',array_keys(session('cart')['color']));
				//每个颜色对应的数量 格式:颜色键_数量
				$color_num = '';
				foreach(session('cart')['color'] as $kk=>$vv){
					$color_num .= $kk.'_'.$vv.',';
				}
				$order_goods['color_num'] = substr($color_num,0,-1);
				$order_goods['time'] = time();
				$order_goods_res = M('order_goods')->add($order_goods);
				if($order_res && $order_goods_res){

					M()->commit();//提交事务
					//跳转倒支付页面
					//加密
					$orderid = encryption($order_res);//订单id
					$buy = encryption(0);//订单类型 预定
					session('cart',null);
					header('location:'.U('pay').'?order='.urlencode($orderid).'&buy='.urlencode($buy));//加密后在编码(编码解决get特殊符号无法接收)


				}else{
					M()->rollback();
					$this->error('下单失败!');
				}
				exit;
			}else{

					$this->address($_GET['address_id']);//地址
					//查询商品
							$goods = M('goods')->where(array('goods_id'=>session('cart')['goods_id']))->find();
							if($goods){
								//如果是在代理商下买的商品  查询代理商的商品价格
								if(session('cart')['agent_id']){
									$goods['price'] = M('agent_goods')->where(array('agent_goods_id'=>session('cart')['goods_id'],'agent_id'=>session('cart')['agent_id']))->getField('agent_price');
								}
								$color_key = array_keys(session('cart')['color']);//取出颜色key
								$color = '';
								$colors = C('color');
								foreach($color_key as $vv){
									$color .= $colors[ $vv ].',';
								}
								$this->assign('color',substr($color,0,-1));
								$this->assign('num',array_sum(session('cart')['color']));
								$this->assign('count_price',sprintf("%.2f",$goods['price'] * array_sum(session('cart')['color'])));
								$this->assign('goods',$goods);
								$this->display();
								exit;
							}

						$this->error('非法操作！');
			}
		}

		$this->error('非法操作！');


	}


	//个人购买确定
	public function confirm()
	{
		header('location:'.U('Temporary/confirm'));

		// $this->display();
	}

	//支付结果显示
	public function payres($msg,$code='0')
	{
		$this->assign('res',array('msg'=>$msg,'code'=>$code));
		$this->display('payres');
	}


	//执行支付
	public function pay()
	{
		$input = I('get.');
		// $buy = 
		if(!$input['order'] || !$input['buy']){
			$this->payres('非法操作！');
			exit;
		}
		// 解密
		$order_id = decryption($input['order']);//订单id
		$buy = decryption($input['buy']);//订单类型
		$data = M('order')->where(array('order_id'=>$order_id,'buy'=>$buy))->find();
		if($data && $data['consignee_id'] == session('AgentUser')){
			//判断此订单是否支付过
			if($data['pay_status'] == 1 || $data['pay_status'] == 2){
				$this->payres('此订单已经支付!',2);
				exit;
			}
			//查询余额
			$money = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('money') - 100000;//减去一千块保证金
			//把订单中的总金额 元转换成分
			$count_price = $data['count_price'] * 10 * 10;
			if($money < $count_price){$this->payres('余额不足，请充值！',3);exit;}

			//支付
			M()->startTrans();
			$res = M('money')->where(array('agent_id'=>session('AgentUser')))->setDec('money',$count_price);
			if($res){
				//写入钱包日志
				$log_res = $this->money_log($count_price,1,$order_id);

				//给购买的上级增加货币
				if($data['agent_id']){

					$seller_res = M('money')->where(array('agent_id'=>$data['agent_id']))->setInc('money',$count_price);
					if($seller_res){
						//货币操作日志
						$logdata['money'] = $count_price;
						$logdata['operation'] = session('AgentUser');//操作者id
						$logdata['agent_id'] = $data['agent_id'];//被操作者id
						$logdata['money_id'] = M('money')->where(array('agent_id'=>$data['agent_id']))->getField('id');//钱包id
						$logdata['ip'] = $_SERVER['REMOTE_ADDR'];
				        $logdata['address'] = getip($_SERVER['REMOTE_ADDR']);
				        $logdata['res'] = $seller_res;
				        $logdata['type'] = 1;
				        $logdata['msg'] = ''.M('agent_config')->where(array('agent_id'=>session('AgentUser')))->getField('name').'购买商品！';
				        $logdata['time']  = time();
				        M('money_log')->add($logdata);
					}
				}else{
					$seller_res = 1;
				}


				if($log_res){
					//改变支付状态
					$order['pay_way'] = 3;//支付方式
					$order['pay_status'] = 1;//支付方式
					$save_status = M('order')->where(array('order_id'=>$order_id,'buy'=>$buy))->save($order);

					if($res && $log_res && $save_status && $seller_res){
						M()->commit();
						//消除session中的商品
						session('cart',null);
						
						$this->addgoods($order_id,$buy);//给用户添加商品
						$this->payres('支付成功',1);exit;
					}else{
						M()->rollback();
						$this->payres('支付失败！点击重新支付！',4);exit;
					}
				}
				

			}else{
				$this->money_log($count_price,0,$order_id);
				M()->rollback();
				$this->payres('支付失败！点击重新支付!',4);
			}


		}else{
			$this->payres('非法操作！');
		}


	}

	//货币操作日志
	protected function money_log($count_price,$res,$order_id)
	{

				$money = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('id');
				$log['operation'] = session('AgentUser');
				$log['agent_id'] = session('AgentUser');
				$log['money_id'] = $money;
				$log['money'] = $count_price;
				$log['ip'] = getip($_SERVER['REMOTE_ADDR']);
				$log['address'] = getip($_SERVER['REMOTE_ADDR']);
				$log['res'] = $res;
				$log['type'] = 0;
				$log['msg'] = '购买商品:'.M('order_goods')->where(array('order_id'=>$order_id))->getField('goods_name');
				$log['time'] = time();
				return $log_res = M('money_log')->add($log);
	}


	//给代理商添加商品
	protected function addgoods($order_id,$status)
	{

		$order_goods = M('order_goods')->where(array('order_id'=>$order_id))->find();
		$datas['agent_id'] = session('AgentUser');//购买者id
		$datas['goods_permissions'] = 2;
		$datas['agent_goods_id'] = $order_goods['goods_id'];//商品id
		$datas['agent_price'] = $order_goods['goods_price'];// 商品价格
		$datas['agent_color'] = $order_goods['goods_color'];//商品颜色
		$datas['agent_is_shelves'] = 1;//是否上架
		$datas['agent_inventory'] = $order_goods['goods_num'];//是否上架
		$datas['state'] = $status;//商品状态(1购买的商品,2预定的商品)
		$datas['time'] = time();//商品状态(1购买的商品,2预定的商品)
		M('agent_goods')->add($datas);

		//改变订单状态
		M('order')->where(array('order_id'=>$order_id))->save(array('shipping_status'=>1));
	}

}


// 20108.20
//19015.20