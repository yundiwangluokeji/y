<?php

namespace Pay\Controller;
use Think\Controller;

class OfflinepayController extends Controller
{
	/*
    *$subject 订单名称
    *$money 订单金额
    *$show_url 收银台页面上，商品展示的超链接，必填
    *$body 商品描述
    *$agent_id 支付者id 如果是普通用户0
    *$out_trade_no  订单号
    */
	public function index($subject,$money,$show_url,$body,$agent_id,$out_trade_no)
	{

            	$res = M('order')->where(array('order_sn'=>$out_trade_no))->save(array('pay_status'=>2));
            	//写入支付记录
                $data['order'] = $out_trade_no;//点单号
                $data['name'] = $subject;//订单名称
                $data['price'] = $money;//订单价格
                $data['url'] = $show_url;//商品地址
                $data['body'] = $body;//商品描述
                $data['time'] = time();
                $data['pay_type'] = 4;//支付类型
                $data['agent_id']  = $agent_id;//代理商id
				if($res){
					M('topup')->add($data);
				}
				
                
                		$data['out_trade_no'] = $out_trade_no;
                		$data['time'] = date('Y-m-d H:i:s',$data['time']);
                		$data['total_fee'] = $data['price'];
                		$data['trade_no'] = '无';
                		$msg = '线下支付待确定！';
                		$this->assign('data',$data);
                		$this->assign('msg',$msg);
                		$this->display('/Alipay/returnurl');



	}
}
