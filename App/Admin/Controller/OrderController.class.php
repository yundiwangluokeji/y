<?php
namespace Admin\Controller;
use Think\Controller;

class OrderController extends Controller
{
    // 采购订单
    public function orderList1()
    {
        $status = [];
        $orderData = M('order o')
            ->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->select();

        $payWays = ['微信支付', '支付宝支付', '账户余额支付', '线下支付'];
        for ($i = 0; $i < count($orderData); $i++) {
            $orderData[$i]['time'] = date('Y-m-d H:i:s', $orderData[$i]['time']);
            $orderData[$i]['pay_way'] = $payWays[$orderData[$i]['pay_way']];
            $orderData[$i]['order_status'] = $status[$orderData[$i]['order_status']];
        }
        $this->assign('orderData', $orderData);
        $this->display();
    }

    public function orderDetail()
    {
        $order_id = I('get.order_id');
        $status = [];
        $orderData = M('order o')
            ->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where(array('o.order_id' => $order_id))
            ->select();

        $payWays = ['微信支付', '支付宝支付', '账户余额支付', '线下支付'];
        for ($i = 0; $i < count($orderData); $i++) {
            $orderData[$i]['time'] = date('Y-m-d H:i:s', $orderData[$i]['time']);
            $orderData[$i]['pay_way'] = $payWays[$orderData[$i]['pay_way']];
            $orderData[$i]['order_status'] = $status[$orderData[$i]['order_status']];
        }

        // dump($orderData);exit;
        $this->assign('orderData', $orderData);
        $this->display();
    }

    // 预定订单
    public function orderList2()
    {
        $this->display();
    }
}
