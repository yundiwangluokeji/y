<?php
namespace Home\Controller;
use Think\Controller;
use Pay\Controller\AlipayController;

class TemporaryController extends Controller
{
   

    // 临时商品
    public function goods()
    {

        $data = I('get.data');
        if(!$data){$this->_empty('非法访问！');exit;}
        //替换特殊符号
        $data = str_replace('__slash__', '/', $data);
        $data = str_replace('__add__', '+', $data);
        $data = str_replace('__eq__', '=', $data);
        $datastr = decryption($data);//解密
        if(!$datastr){$this->_empty('非法访问！');exit;}
        //转换成数组
        $dataarr = explode('&', $datastr);
        $goodsdata = array();
        foreach($dataarr as $k=>$v){
            $temp = explode('=', $v);
            $goodsdata[ $temp[0] ] = $temp[1];
        }
        if(!$goodsdata['agent_id'] || !$goodsdata['goods_id'] || !$goodsdata['time']){$this->_empty();exit;}
        if(!M('agent')->where(array('id'=>$goodsdata['agent_id']))){$this->_empty();exit;}
        if(!M('goods')->where(array('goods_id'=>$goodsdata['goods_id']))){$this->_empty();exit;}
        if((time() - $goodsdata['time']) > 3600){$this->_empty('链接已过期！');exit;}


        $goods_id = $goodsdata['goods_id'];
        //商品库存
        $inventory = M('agent_goods')->where(array('agent_goods_id'=>$goods_id,'agent_id'=>$goodsdata['agent_id']))->getField('agent_inventory');
        $this->assign('inventory',$inventory);
        //查询商品
        $goodData = M('agent_goods')->where(array('agent_goods_id' => $goods_id,'agent_id'=>$goodsdata['agent_id']))->find();
        // dump($goodData);exit;

        if ($goodData) {
            //增加点击量
            M('agent_goods')->where(array('agent_goods_id'=>$goods_id,'agent_id'=>$goodsdata['agent_id']))->setInc('agent_click_count',1);
            M('goods')->where(array('goods_id'=>$goods_id))->setInc('click_count',1);
            //查询店铺名称
            $configname = M('agent_config')->where(array('agent_id'=>$goodsdata['agent_id']))->getField('name');
            $this->assign('configname',$configname);
            //查询商品图片和编号
            $goods = M('goods')->field('name,goods_sn,images')->where(array('goods_id'=>$goods_id))->find();
            $goodData['name'] = $goods['name'];
            $goodData['goods_sn'] = $goods['goods_sn'];
            $goodData['images'] = $goods['images'];
            $collectNum = M('agent_collection')->where(array('goods_id'=>$goods_id))->count();//收藏量
            $goodData['collectNum'] = $collectNum;
            $this->assign('goodData', $goodData);
            //颜色处理
            $mainColor = rtrim($goodData['agent_color'], ',');
            $mainColor = explode(',', $mainColor);
            $originColor = C('color');
            foreach ($mainColor as $key => $value) {
                $colors[$value] = $originColor[$value];
            }

            $this->assign('colors', $colors);
            $this->display();
        } else {
            $this->_empty();
        }
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

    //订单确认
    public function confirm()
    {
        // dump(session('cart'));exit;
        if(!session('cart')){$this->_empty('非法访问！');}
        if(session('cart')['type'] != 'confirm' || !session('cart')['goods_id'] || !session('cart')['agent_id']){$this->_empty('非法访问！');}
                //查询当前商品
        if(IS_POST){
            // dump($_POST);exit;
                M()->startTrans();//开启事务

                //创建订单
                $order['order_sn'] = date('YmdHis',time()).mt_rand(111111,999999);//订单号
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
                $order['username'] = $_POST['name'];//收货人姓名 
                $order['mobile'] = $_POST['mobile'];//收货手机号
                $order['address'] = M('area')->field('group_concat(name) as name')->where('id in('.implode(',',array_values($_POST['area'])).')')->select()[0]['name'].','.$_POST['address'];//地址
                $order['agent_id'] = session('cart')['agent_id'];//属于谁的商品
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
                    header('location:'.U('Home/Pay/index').'?order='.urlencode($orderid).'&buy='.urlencode($buy));//加密后在编码(编码解决get特殊符号无法接收)


                }else{
                    M()->rollback();
                    $this->error('下单失败!');
                }
                exit;








        }else{

                
                $goods = M('goods')->field('name,goods_sn,images')->where(array('goods_id'=>session('cart')['goods_id']))->find();
                $goods2 = M('agent_goods')->field('')->where(array('agent_goods_id'=>session('cart')['goods_id'],'agent_id'=>session('cart')['agent_id']))->find();
                if($goods && $goods2){

                    //处理颜色
                    $color_key = array_keys(session('cart')['color']);//取出颜色key
                   if(!$color_key){$this->_empty('非法访问！');}
                    $color = '';
                    $colors = C('color');
                    foreach($color_key as $vv){
                        $color .= $colors[ $vv ].',';
                    }
                    $this->assign('color',substr($color,0,-1));
                    $num = array_sum(session('cart')['color']);
                    if($num <= 0){$this->_empty('非法访问！');}
                    $this->assign('num',$num);//数量
                    $this->assign('count_price',sprintf("%.2f",$goods2['agent_price'] * array_sum(session('cart')['color'])));//总价


                    $goodsdata = array_merge($goods,$goods2);
                    $this->assign('goodsdata',$goodsdata);
                     // dump($goodsdata);exit;
                    //省级地址
                    $data = M('area')->field('id,name')->where(array('level'=>1))->select();
                    $this->assign('data',$data);
                    $this->display();
                    
                }else{
                    $this->_empty('非法访问！');
                }

        }

       
    }


    public function _empty($msg=null)
    {
        echo $msg;exit;
    }


       //筛选下级地址
    public function lower()
    {
        if(IS_AJAX){
            $where['parent_id']  = I('id');
            $data = M('area')->field('id,name')->where($where)->select();
            if($data){
                $this->ajaxReturn($data);

            }
        }

    }

}
