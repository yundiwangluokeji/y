<?php
namespace Agent\Controller;
class ProcurementController extends PublicController 
{

	//采购单列表
	public function index()
	{
		
		$this->order_goods();
		$this->display();
	}

	//数据列表
	public function order_goods()
	{
		$data = M('order')->where(array('consignee_id'=>session('AgentUser')))->Page($_GET['p'],10)->select();
		$model = M('order_goods');
		$modelgoods = M('goods');
		foreach($data as &$v){
			$order_goods = $model->where(array('order_id'=>$v['order_id']))->find();//查询订单详情表中的商品
			$goods = $modelgoods->field('goods_sn,images')->where(array('goods_id'=>$order_goods['goods_id']))->find();//从商品表中获取图片和商品编号
			$order_goods['goods_sn'] = $goods['goods_sn'];
			$order_goods['images'] = $goods['images'];
			$v['order_goods'] = $order_goods;
		}

		$this->assign('data',$data);
		// dump($data);exit;
		// $this->display();

	}



}