<?php
namespace Home\Controller;

class RecommendedController extends PublicController
{

    //推荐
    public function index()
    {
        $class = I('get.class_id');
        $this->assign('class', $class);

        $orderNum = I('get.orderNum');

        if(AGENT_ID){
            $this->assign('agent', AGENT_ID);
            //查询代理商的商品
            $agent_goodsmode = M('agent_goods');
            $where = "agent_id = ".AGENT_ID." and agent_is_shelves = 1 and agent_is_recommend = 1";

            //代理商的商品浏览权限
            if(AGENT_ID == session('AgentUser')){
                $where .= ' and goods_permissions in(0,1,2)';
            }elseif(session('AgentUser')){
                $where .= ' and goods_permissions in(1,2)';//如果登录情况可以查看对应代理商的权限为1，2的商品
            }else{
                $where .= 'and goods_permissions = 2';//没有登录只能查看权限为2的商品
            }

            M()->execute('SET GLOBAL group_concat_max_len=10240000'); #sql语句修改 作用域全局
            $agent_goods_id = $agent_goodsmode->field('group_concat(agent_goods_id) as agent_goods_id')->where($where)->order('agent_sorting')->Page($_GET['P'],20)->select()[0]['agent_goods_id'];//代理商的商品id
            if ($agent_goods_id) {
                if (is_array($agent_goods_id)) {
                    $agent_goods = $agent_goodsmode->where('agent_goods_id in('.$agent_goods_id.')')->getField('agent_goods_id,agent_price');//查询代理商的商品价格
                } else {
                    $agent_goods = $agent_goodsmode->where('agent_goods_id = "'.$agent_goods_id.'"')->getField('agent_goods_id,agent_price');//查询代理商的商品价格
                }

                $where2 = "is_shelves = 1 and goods_id in(".$agent_goods_id.")";
                if ($class) {
                    $where2 .= " and class_id = ".$class;
                }
                $goods = M('goods')->where($where2)->order('sorting')->select();
                // dump($agent_goodsmode->getLastSQL());
                // dump($goods);exit;
                //将总评平台价格转换成代理商自己的价格
                foreach($goods as &$v){
                    foreach($agent_goods as $key=>$val){
                        if($v['goods_id'] == $key){
                            $v['price'] = $val;
                        }
                    }
                }
            } else {
                $goods = '';
            }

        }else{
            //查询总平台的商品
            $where['is_shelves'] = 1;//是否上架
            $where['is_recommend'] = 1;
            if ($class) {
                $where['class_id'] = $class;
            }
            if ($orderNum) {
                if ($orderNum == 1) {
                    $order = 'price';
                } else {
                    $order = 'price desc';
                }
            } else {
                $order = '';
            }
            $goods = M('goods')->where($where)->Page($_GET['P'], 20)->order($order)->select();
        }
        $this->assign('goodslist',$goods);
        if ($orderNum) {
            $orderNum = $orderNum == 1 ? 2 : 1;
            $this->assign('orderNum', $orderNum);
        }

        // 查询分类
        $classData = M('classification')->field('brand_id, name')->order('sorting')->select();
        $this->assign('classData', $classData);
        $this->assign('brandIcon', $class);

        $this->display();
    }

    // 收藏
    public function collect()
    {
        $data = I('post.');
        $data['addtime'] = time();
        $res = M('agent_collection')->add($data);
        if ($res) {
            $this->ajaxReturn(array(
                'code' => 1,
                'msg' => '收藏成功',
                'data' => '',
            ));
        } else {
            $this->ajaxReturn(array(
                'code' => 0,
                'msg' => '收藏失败',
                'data' => '',
            ));
        }
    }

    // 商品详情
    public function goodDetail()
    {
        $goods_id = I('get.goods_id');
        $goodData = M('goods')->where(array('goods_id' => $goods_id))->find();
        $collectNum = M('agent_collection')->where(array('goods_id' => $goods_id))->count();
        $isCollect = M('agent_collection')->where(array('goods_id' => $goods_id, 'agent_id' => session('AgentUser')))->find();
        if ($isCollect) {
            $goodData['isCollect'] = 1;
        }
        $goodData['collectNum'] = $collectNum;
        $this->assign('goodData', $goodData);
        // $mainColor = C('color');
        $mainColor = rtrim($goodData['color'], ',');
        $mainColor = explode(',', $mainColor);
        $originColor = C('color');
        foreach ($mainColor as $key => $value) {
            $colors[$value] = $originColor[$value];
        }
        $this->assign('colors', $colors);
        $this->display();
    }

}
