<?php
namespace Admin\Controller;
use Think\Controller;

class OrderController extends Controller
{
    // 采购订单
    public function orderList1()
    {
        $count = M('order o')->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where('consignee_id != 0 && buy = 1')
            ->count();
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $status = [];
        $orderData = M('order o')
            ->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where('consignee_id != 0 && buy = 1')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->order("time desc")
            ->select();

        $payWays = ['未支付', '微信支付', '支付宝支付', '账户余额支付', '线下支付'];
        $colors = C('color');
        for ($i = 0; $i < count($orderData); $i++) {
            $orderData[$i]['time'] = date('Y-m-d H:i:s', $orderData[$i]['time']);
            $orderData[$i]['pay_way'] = $payWays[$orderData[$i]['pay_way']];
            $orderData[$i]['order_status'] = $status[$orderData[$i]['order_status']];
            $orderData[$i]['goods_color'] = explode(',', $orderData[$i]['goods_color']);
            for ($j = 0; $j < count($orderData[$i]['goods_color']); $j++) {
                $orderData[$i]['goods_color'][$j] = $colors[$orderData[$i]['goods_color'][$j]];
            }
            $orderData[$i]['color_num'] = explode(',', $orderData[$i]['color_num']);
            for ($k = 0; $k < count($orderData[$i]['color_num']); $k++) {
                $orderData[$i]['color_num'][$k] = strstr($orderData[$i]['color_num'][$k], '_');
                $orderData[$i]['color_num'][$k] = ltrim($orderData[$i]['color_num'][$k], '_');
            }
            //根据不同的订单状态区分按钮状态
            if ($orderData[$i]['pay_status'] == 0 && $orderData[$i]['shipping_status'] == 0) { //未支付
                $orderData[$i]['btnStatus'] = 0;
                $orderData[$i]['orderStatus'] = '等待支付';
            } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] == 0) { //未发货
                $orderData[$i]['btnStatus'] = 1;
                $orderData[$i]['orderStatus'] = '等待发货';
            } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] != 0) { //已发货
                $orderData[$i]['btnStatus'] = 2;
                $orderData[$i]['orderStatus'] = '已发货';
            } else { //未知状态
                $orderData[$i]['btnStatus'] = 3;
                $orderData[$i]['orderStatus'] = '状态异常';
            }
        }
//        dump($orderData);exit;

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
            ->field('o.agent_id, o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, o.courier, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where(array('o.order_id' => $order_id))
            ->select();
        if ($orderData[0]['agent_id']) {
            $orderData[0]['account'] = M('agent')->field('username as account')->where(array('id' => $orderData[0]['agent_id']))->find()['account'];
        } else {
            $orderData[0]['account'] = '未登录用户';
        }

        $payWays = ['未支付', '微信支付', '支付宝支付', '账户余额支付', '线下支付'];
        $colors = C('color');
        for ($i = 0; $i < count($orderData); $i++) {
            $orderData[$i]['time'] = date('Y-m-d H:i:s', $orderData[$i]['time']);
            $orderData[$i]['pay_way'] = $payWays[$orderData[$i]['pay_way']];
            $orderData[$i]['order_status'] = $status[$orderData[$i]['order_status']];
            $orderData[$i]['goods_color'] = explode(',', $orderData[$i]['goods_color']);
            for ($j = 0; $j < count($orderData[$i]['goods_color']); $j++) {
                $orderData[$i]['goods_color'][$j] = $colors[$orderData[$i]['goods_color'][$j]];
            }
            $orderData[$i]['color_num'] = explode(',', $orderData[$i]['color_num']);
            for ($k = 0; $k < count($orderData[$i]['color_num']); $k++) {
                $orderData[$i]['color_num'][$k] = strstr($orderData[$i]['color_num'][$k], '_');
                $orderData[$i]['color_num'][$k] = ltrim($orderData[$i]['color_num'][$k], '_');
            }

            //根据不同的订单状态区分按钮状态
            if ($orderData[$i]['pay_status'] == 0 && $orderData[$i]['shipping_status'] == 0) { //未支付
                $orderData[$i]['btnStatus'] = 0;
                $orderData[$i]['orderStatus'] = '等待支付';
            } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] == 0) { //未发货
                $orderData[$i]['btnStatus'] = 1;
                $orderData[$i]['orderStatus'] = '等待发货';
            } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] != 0) { //已发货
                $orderData[$i]['btnStatus'] = 2;
                $orderData[$i]['orderStatus'] = '已发货';
            } else { //未知状态
                $orderData[$i]['btnStatus'] = 3;
                $orderData[$i]['orderStatus'] = '状态异常';
            }

        }
        // dump($orderData);exit;
        $this->assign('orderData', $orderData);
        $this->display();
    }


     // 预定订单
    public function orderList2()
    {

        $count = M('order o')->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where('consignee_id != 0 && buy = 0')
            ->count();
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $status = [];
        $orderData = M('order o')
            ->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where('consignee_id != 0 && buy = 0')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->order("time desc")
            ->select();
        $payWays = ['未支付', '微信支付', '支付宝支付', '账户余额支付', '线下支付'];
        $colors = C('color');
        for ($i = 0; $i < count($orderData); $i++) {
            $orderData[$i]['time'] = date('Y-m-d H:i:s', $orderData[$i]['time']);
            $orderData[$i]['pay_way'] = $payWays[$orderData[$i]['pay_way']];
            $orderData[$i]['order_status'] = $status[$orderData[$i]['order_status']];
            $orderData[$i]['goods_color'] = explode(',', $orderData[$i]['goods_color']);
            for ($j = 0; $j < count($orderData[$i]['goods_color']); $j++) {
                $orderData[$i]['goods_color'][$j] = $colors[$orderData[$i]['goods_color'][$j]];
            }
            $orderData[$i]['color_num'] = explode(',', $orderData[$i]['color_num']);
            for ($k = 0; $k < count($orderData[$i]['color_num']); $k++) {
                $orderData[$i]['color_num'][$k] = strstr($orderData[$i]['color_num'][$k], '_');
                $orderData[$i]['color_num'][$k] = ltrim($orderData[$i]['color_num'][$k], '_');
            }

            // 根据不同的订单状态区分按钮状态
           if ($orderData[$i]['pay_status'] == 0 && $orderData[$i]['shipping_status'] == 0) { //未支付
               $orderData[$i]['btnStatus'] = 0;
               $orderData[$i]['orderStatus'] = '等待支付';
           } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] == 0) { //未发货
               $orderData[$i]['btnStatus'] = 1;
               $orderData[$i]['orderStatus'] = '等待发货';
           } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] != 0) { //已发货
               $orderData[$i]['btnStatus'] = 2;
               $orderData[$i]['orderStatus'] = '已发货';
           } else { //未知状态
               $orderData[$i]['btnStatus'] = 3;
               $orderData[$i]['orderStatus'] = '状态异常';
           }
        }
        $this->assign('orderData', $orderData);
        $this->display();
    }


    // 零售订单
    public function orderList3()
    {
        $count = M('order o')->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where('consignee_id = 0')
            ->count();
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $status = [];
        $orderData = M('order o')
            ->join('__ORDER_GOODS__ od on o.order_id = od.order_id')
            ->join('__GOODS__ g on od.goods_id = g.goods_id')
            ->field('o.order_id, o.order_sn, o.count_price, o.order_status, o.pay_way, o.pay_status, o.shipping_status, o.username, o.mobile, o.address, o.time, o.msg, od.color_num, od.goods_id, od.goods_price, od.goods_num, od.goods_name, od.goods_color, g.images')
            ->where('consignee_id = 0')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->order("time desc")
            ->select();
        $payWays = ['未支付', '微信支付', '支付宝支付', '账户余额支付', '线下支付'];
        $colors = C('color');
        for ($i = 0; $i < count($orderData); $i++) {
            $orderData[$i]['time'] = date('Y-m-d H:i:s', $orderData[$i]['time']);
            $orderData[$i]['pay_way'] = $payWays[$orderData[$i]['pay_way']];
            $orderData[$i]['order_status'] = $status[$orderData[$i]['order_status']];
            $orderData[$i]['goods_color'] = explode(',', $orderData[$i]['goods_color']);
            for ($j = 0; $j < count($orderData[$i]['goods_color']); $j++) {
                $orderData[$i]['goods_color'][$j] = $colors[$orderData[$i]['goods_color'][$j]];
            }
            $orderData[$i]['color_num'] = explode(',', $orderData[$i]['color_num']);
            for ($k = 0; $k < count($orderData[$i]['color_num']); $k++) {
                $orderData[$i]['color_num'][$k] = strstr($orderData[$i]['color_num'][$k], '_');
                $orderData[$i]['color_num'][$k] = ltrim($orderData[$i]['color_num'][$k], '_');
            }

            // 根据不同的订单状态区分按钮状态
           if ($orderData[$i]['pay_status'] == 0 && $orderData[$i]['shipping_status'] == 0) { //未支付
               $orderData[$i]['btnStatus'] = 0;
               $orderData[$i]['orderStatus'] = '等待支付';
           } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] == 0) { //未发货
               $orderData[$i]['btnStatus'] = 1;
               $orderData[$i]['orderStatus'] = '等待发货';
           } elseif ($orderData[$i]['pay_status'] != 0 && $orderData[$i]['shipping_status'] != 0) { //已发货
               $orderData[$i]['btnStatus'] = 2;
               $orderData[$i]['orderStatus'] = '已发货';
           } else { //未知状态
               $orderData[$i]['btnStatus'] = 3;
               $orderData[$i]['orderStatus'] = '状态异常';
           }
        }
        $this->assign('orderData', $orderData);
        $this->display();
    }

    //    发货
    public function delivery()
    {
        if (IS_POST) {
            $order_sn = I('post.order_sn');
            $order_status = M('order')->field('order_status')->where(array('order_sn' => $order_sn))->find();
            //    订单状态为1m
            if ($order_status['order_status'] == 1) {
                $courier = I('post.courier');
                $courier_sn = I('post.courier_sn');
                $updateRes = M('order')->where(array('order_sn' => $order_sn))
                    ->save(array(
                        'courier' => $courier,
                        'courier_sn' => $courier_sn,
                        'shipping_status' => 1
                    ));
                    // 插入数据到agent_goods表
                if ($updateRes) {
                    // 查询出订单信息
                    $agentGoodsData = M('order o')
                        ->join('__ORDER_GOODS__ og on o.order_id = og.order_id')
                        ->join('__GOODS__ g on og.goods_id = g.goods_id')
                        ->field('og.goods_id, og.goods_num, og.goods_color, o.consignee_id, o.count_price')
                        ->where('o.order_sn = '.$order_sn)
                        ->find();

                    //查询agent中是否有数据
                    $issetGoodData = M('agent_goods')
                        ->field('agent_color, agent_inventory')
                        ->where(array('agent_goods_id' => $agentGoodsData['goods_id']))
                        ->find();

                    //合并处理颜色
                    if ($issetGoodData) {
                        $agentGoodsData['goods_color'] = rtrim($agentGoodsData['goods_color'],',');
                        $issetGoodData['agent_color'] = rtrim($issetGoodData['agent_color'],',');
                        $color1 = explode(',', $agentGoodsData['goods_color']);
                        $color2 = explode(',', $issetGoodData['agent_color']);
                        $colors = array_merge($color1, $color2);
                        $colors = array_unique($colors);
                        $finalColor = '';
                        foreach ($colors as $v) {
                            $finalColor .= $v.',';

                        }
                        $inventory = $issetGoodData['agent_inventory'] + $agentGoodsData['goods_num'];

                        //修改数据
                        M('agent_goods')
                            ->where(array('agent_goods_id' => $agentGoodsData['goods_id']))
                            ->save(array(
                                'agent_inventory' => $inventory,
                                'agent_color' => $finalColor
                            ));
                    } else {
                        if ($agentGoodsData['consignee_id']) {
                            $infoData['agent_id'] = $agentGoodsData['consignee_id'];
                            $infoData['agent_goods_id'] = $agentGoodsData['goods_id'];
                            $infoData['agent_inventory'] = $agentGoodsData['goods_num'];
                            $infoData['agent_color'] = $agentGoodsData['goods_color'];
                            $infoData['agent_price'] = $agentGoodsData['count_price'];
                            $infoData['agent_is_shelves'] = 1;
                            $infoData['agent_addtime'] = time();

                            //插入数据
                            M('agent_goods')->data($infoData)->add();
                        }
                    }

                    $this->ajaxReturn(array(
                        'status' => 1,
                        'msg' => '发货成功',
                        'data' => ''
                    ));
                } else {
                    $this->ajaxReturn(array(
                        'status' => 0,
                        'msg' => '发货失败',
                        'data' => ''
                    ));
                }
            } else {
                $this->ajaxReturn(array(
                    'status' => 0,
                    'msg' => '请等待下级确认',
                    'data' => ''
                ));
            }
        } else {
            $payWays = ['未支付', '微信支付', '支付宝支付', '账户余额支付', '线下支付'];
            $order_sn = I('get.order_sn');
            $orderInfo = M('order')->field('order_sn, username, mobile, address, pay_way')->where(array('order_sn' => $order_sn))->find();
            $orderInfo['pay_way'] = $payWays[$orderInfo['pay_way']];
            $this->assign('orderInfo', $orderInfo);
            $this->display();
        }
    }


//    付款
    public function gopay()
    {
        $order_sn = I('post.order_sn');
        $payRes = M('order')->where(array('order_sn' => $order_sn))->save(array(
            'pay_status' => 1
        ));
        if ($payRes) {
            $this->ajaxReturn(array(
                'status' => 1,
                'msg' => '付款成功',
                'data' => ''
            ));
        } else {
            $this->ajaxReturn(array(
                'status' => 0,
                'msg' => '付款失败',
                'data' => ''
            ));
        }
    }

}
