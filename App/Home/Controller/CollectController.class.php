<?php
namespace Home\Controller;

class CollectController extends PublicController
{
    public function collect()
    {
        M()->execute('SET GLOBAL group_concat_max_len=10240000'); #sql语句修改 作用域全局
        $Collect = M('agent_collection')->field('group_concat(goods_id) as goods_id')->where(array('agent_id' => session('AgentUser')))->Page($_GET['P'],20)->select()[0]['goods_id'];//商品id
        if ($agentCollect) {
            $agentCollect = M('agent_goods')->field('group_concat(agent_goods_id) as agent_goods_id')->where(array('agent_goods_id in('.$Collect.')'))->select()[0]['agent_goods_id'];//商品id
        }
        if (is_array($Collect) && is_array($agentCollect)) {
            foreach ($Collect as $key=>$value) {
                for ($i=0; $i < count($agentCollect); $i++) {
                    if ($value == $agentCollect[$i])
                    unset($Collect[$key]);
                }
            }
        } elseif (is_array($Collect)) {
            foreach ($Collect as $key=>$value) {
                if ($value == $agentCollect)
                    unset($Collect[$key]);
            }
        } else {
            if ($Collect == $agentCollect) {
                $Collect = '';
            }
        }
        if ($Collect) {
            $Collect_goods = M('goods')->where('goods_id in('.$Collect.')')->getField('goods_id,price,name,images');
        }
        if ($agentCollect) {
            $Collect_goods_agent = M('agent_goods ag')->join('__GOODS__ g on ag.agent_goods_id=g.goods_id')->field('ag.agent_price as price, g.goods_id, g.name, g.images')->where('agent_goods_id in('.$agentCollect.')')->select();
        }
        if (is_array($Collect_goods) && is_array($Collect_goods_agent)) {
            $allGoodsData = array_merge($Collect_goods, $Collect_goods_agent);
        } elseif (is_array($Collect_goods)) {
            $allGoodsData = $Collect_goods;
        } elseif (is_array($Collect_goods_agent)) {
            $allGoodsData = $Collect_goods_agent;
        }
        $this->assign('Collect_goods',$allGoodsData);
        $this->display();
    }

    // 删除商品
    public function delGood()
    {
        $goods_id = I('get.goods_id');
        $delRes = M('agent_collection')->where(array('goods_id' => $goods_id))->delete();
        if ($delRes) {
            $this->success('成功', U('collect'));
        } else {
            $this->error('失败');
        }
    }


    // 商品详情
    public function collectDetail()
    {
        $goods_id = I('get.goods_id');
        $goodData = M('goods')->where(array('goods_id' => $goods_id))->find();
        $this->assign('goodData', $goodData);
        $this->display();
    }

}
