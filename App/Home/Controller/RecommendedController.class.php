<?php
namespace Home\Controller;

class RecommendedController extends PublicController
{

    //推荐
    public function index()
    {
        if(AGENT_ID){
            $agent_sorting = I('sorting','agent_price');//排序
            $sorting =  ($agent_sorting == 'agent_price')?'agent_price desc':'agent_price';
            $this->assign('sorting',urlencode($sorting));
        }else{
             $agent_sorting = I('sorting','price');
             $sorting =  ($agent_sorting == 'price')?'price desc':'price';
            $this->assign('sorting',urlencode($sorting));
        }


        $class = I('get.class_id');
        $this->assign('class', $class);

        $brand_id = I('get.brand_id');
        $this->assign('brand', $brand_id);
        // 查询分类
        $classData = M('classification')->field('class_id, name')->order('sorting')->select();
        $this->assign('classData', $classData);
        $this->assign('brandIcon', $class);
        $this->display();
    }




   
    //商品列表
    public function datalist()
    {
        $class = I('get.class_id');
        $this->assign('class', $class);

        $brand_id = I('get.brand_id');
        $this->assign('brand', $brand_id);
        $orderNum = I('get.orderNum');

        if(AGENT_ID){
            $this->assign('agent', AGENT_ID);
            //查询代理商的商品
            $agent_goodsmode = M('agent_goods');
            $where = C('DB_PREFIX').'agent_goods.agent_id = '.AGENT_ID.' and '.C('DB_PREFIX').'agent_goods.agent_is_recommend = 1 and '.C('DB_PREFIX').'agent_goods.agent_is_shelves = 1';
            //代理商的商品浏览权限
            if(AGENT_ID == session('AgentUser')){//自己浏览
                $where .= ' and '.C('DB_PREFIX').'agent_goods.goods_permissions in(0,1,2)';
            }elseif(session('AgentUser')){//登录用户浏览
                $where .= ' and '.C('DB_PREFIX').'agent_goods.goods_permissions in(1,2)';//如果登录情况可以查看对应代理商的权限为1，2的商品
            }else{
                $where .= ' and '.C('DB_PREFIX').'agent_goods.goods_permissions = 2';//没有登录只能查看权限为2的商品
            }
            if($class){
                $where .= ' and '.C('DB_PREFIX').'goods.class_id = '.$class;
            }
            if($brand_id){
                 $where .= ' and '.C('DB_PREFIX').'goods.brand_id = '.$brand_id;
            }

            $agent_sorting = C('DB_PREFIX').'agent_goods.'.I('sorting','agent_price');//排序
            $dbprefix = C('DB_PREFIX');
            $goods = M('agent_goods')->field("{$dbprefix}goods.goods_id,{$dbprefix}goods.name,{$dbprefix}goods.images,{$dbprefix}goods.goods_sn,{$dbprefix}agent_goods.agent_price")->where($where)->join('__GOODS__ on __AGENT_GOODS__.agent_goods_id = __GOODS__.goods_id')->Page($_GET['p'],10)->order(urldecode($agent_sorting))->select();

        }else{
                    //查询总平台的商品
                    $where['is_shelves'] = 1;//是否上架
                    $where['is_recommend'] = 1;//推荐
                    if ($brand_id) {
                        $where['brand_id'] = $brand_id;
                    }
                    if ($class) {
                        $where['class_id'] = $class;
                    }
                    //排序
                    $agent_sorting = I('sorting','price');
                    $goods = M('goods')->where($where)->Page($_GET['p'], 10)->order(urldecode($agent_sorting))->select();
        }
            $agent_collection = M('agent_collection');
            foreach($goods as &$v){
                    $v['collection'] = $agent_collection->where(array('goods_id'=>$v['goods_id']))->count();//收藏量
                    $v['agent_collection'] = $agent_collection->where(array('goods_id'=>$v['goods_id'],'agent_id'=>session('AgentUser')))->getField('id');//当前代理商是否收藏此商品
                    if(!AGENT_ID){$v['agent_price'] = $v['price'];}
            }
        $this->assign('goodslist',$goods);
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

    //  取消收藏
    public function unCollect()
    {
        $goods_id = I('post.goods_id');
        $agentUser = I('post.agent_id');
        $res = M('agent_collection')->where(array('agent_id' => $agentUser, 'goods_id' => $goods_id))->delete();
        if ($res) {
            $this->ajaxReturn(array(
                'code' => 1,
                'msg' => '取消收藏成功',
                'data' => '',
            ));
        } else {
            $this->ajaxReturn(array(
                'code' => 0,
                'msg' => '取消收藏失败',
                'data' => '',
            ));
        }
    }

    

}
