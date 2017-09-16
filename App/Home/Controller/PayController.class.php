<?php
// http://192.168.0.88/Home/Pay/index.html?order=Xp%2BE5uRaGvf8pTWmmjtu8mxKU2LaMMu7xlTbgeQqKrc%3D&buy=N1xsSKUv04x%2FGfOejGV1QySdWiJUqyxoDiBR2HO3xgU%3D
namespace Home\Controller;

use Think\Controller;
class PayController extends Controller
{
	//支付选择页面
	public function index()
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
		if(!$order_id || !$buy || $buy != 'confirm'){$this->payres('非法操作！');exit;}
		$data = M('order')->where(array('order_id'=>$order_id,'buy'=>$buy))->find();
		if(!$data){$this->payres('非法操作！');exit;}
		if($data['pay_status'] == 1 || $data['pay_status'] == 2){$this->payres('此订单已经支付!',2);exit;}




		if(IS_POST){

		}else{


				//查询商品信息

				$this->display();

				// dump($data);exit;
				// if($data && $data['consignee_id'] == session('AgentUser')){
				// 	//判断此订单是否支付过
				// 	if($data['pay_status'] == 1 || $data['pay_status'] == 2){
				// 		$this->payres('此订单已经支付!',2);
				// 		exit;
				// 	}
				// 	//查询余额
				// 	$money = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('money') - 100000;//减去一千块保证金
				// 	//把订单中的总金额 元转换成分
				// 	$count_price = $data['count_price'] * 10 * 10;
				// 	if($money < $count_price){$this->payres('余额不足，请充值！',3);exit;}

				// 	//支付
				// 	M()->startTrans();
				// 	$res = M('money')->where(array('agent_id'=>session('AgentUser')))->setDec('money',$count_price);
				// 	if($res){
				// 		//写入钱包日志
				// 		$log_res = $this->money_log($count_price,1,$order_id);

				// 		if($log_res){
				// 			//改变支付状态
				// 			$order['pay_way'] = 3;//支付方式
				// 			$order['pay_status'] = 1;//支付方式
				// 			$save_status = M('order')->where(array('order_id'=>$order_id,'buy'=>$buy))->save($order);

				// 			if($res && $log_res && $save_status){
				// 				M()->commit();
				// 				//消除session中的商品
				// 				session('cart',null);
				// 				$this->payres('支付成功',1);exit;
				// 			}else{
				// 				M()->rollback();
				// 				$this->payres('支付失败！点击重新支付！',4);exit;
				// 			}
				// 		}
						

				// 	}else{
				// 		$this->money_log($count_price,0,$order_id);
				// 		M()->rollback();
				// 		$this->payres('支付失败！点击重新支付!',4);
				// 	}


				// }else{
				// 	$this->payres('非法操作！');
				// }

		}

	}



	//支付结果显示
	public function payres($msg,$code='0')
	{
		$this->assign('res',array('msg'=>$msg,'code'=>$code));
		$this->display('payres');
	}

	//微信支付
	public function weixin()
	{

	}

	//支付宝支付
	public function alipay()
	{

	}

	//线下支付
	public function offlinepay()
	{

	}
}