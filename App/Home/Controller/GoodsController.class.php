<?php
namespace Home\Controller;

class GoodsController extends PublicController
{

    public function goodslist()
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
            $where = C('DB_PREFIX').'agent_goods.agent_id = '.AGENT_ID.' and '.C('DB_PREFIX').'agent_goods.agent_is_shelves = 1';
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
                    if ($brand_id) {
                        $where['brand_id'] = $brand_id;
                    }
                    if ($class) {
                        $where['class_id'] = $class;
                    }
                    //排序
                    $agent_sorting = I('sorting','price');
                    $goods = M('goods')->field('price,name,goods_id,goods_sn,images')->where($where)->Page($_GET['p'], 10)->order(urldecode($agent_sorting))->select();
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
        if(!$data['agent_id']){$this->ajaxReturn(array('code'=>3,'msg'=>'没有登录无法收藏！'));}
        $data['addtime'] = time();
        $res_ = M('agent_collection')->where(array('goods_id'=>$data['goods_id'],'agent_id'=>$data['agent_id']))->find();
        if($res_){
            $this->ajaxReturn(array('code'=>2,'msg'=>'你已经收藏过了！'));
        }
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
                'msg' => '收藏失败!',
                'data' => '',
            ));
        }
    }

    // 商品详情
    public function goodDetail()
    {
        $goods_id = I('get.goods_id');
        if(!$goods_id){$this->_empty();}

        if($goods_id){

            if(AGENT_ID){
                  //商品库存
                    $model = M('agent_goods');
                    $inventory = $model->where(array('agent_goods_id'=>$goods_id,'agent_id'=>AGENT_ID))->getField('agent_inventory');
                    $this->assign('inventory',$inventory);
                    //商品信息
                    //代理商的商品浏览权限
                    $where = 'agent_id = '.AGENT_ID.' and agent_goods_id = '.$goods_id.' and agent_is_shelves = 1';
                    if(AGENT_ID == session('AgentUser')){//自己浏览
                        $where .= ' and goods_permissions in(0,1,2)';
                    }elseif(session('AgentUser')){//登录用户浏览
                        $where .= ' and goods_permissions in(1,2)';//如果登录情况可以查看对应代理商的权限为1，2的商品
                    }else{
                        $where .= ' and goods_permissions = 2';//没有登录只能查看权限为2的商品
                    }

                    $goodData = $model->where($where)->find();
                    if($goodData){
                        $goodsmodel = M('goods');
                        $goodData['name'] = $goodsmodel->where(array('goods_id'=>$goods_id))->getField('name');
                        $goodData['goods_id'] = $goodData['agent_goods_id'];
                        $goodData['goods_sn'] = $goodsmodel->where(array('goods_id'=>$goods_id))->getField('goods_sn');
                        $goodData['images'] = $goodsmodel->where(array('goods_id'=>$goods_id))->getField('images');
                        $goodData['price'] = $goodData['agent_price'];
                        $goodData['body'] = $goodsmodel->where(array('goods_id'=>$goods_id))->getField('body');

                        //处理颜色
                        $mainColor = explode(',', $goodData['agent_color']);
                        $originColor = C('color');
                        foreach ($mainColor as $key => $value) {
                                $colors[$value] = $originColor[$value];

                        }
                        $this->assign('colors', $colors);
                    }else{

                            $this->_empty();

                    }

                    M('agent_goods')->where(array('agent_id'=>AGENT_ID,'agent_goods_id'=>$goods_id))->setInc('agent_click_count',1);

// ------------------------------------------------------
            }else{
                //总平台商品
                $goodData = M('goods')->where(array('goods_id' => $goods_id,'is_shelves'=>1))->find();
                if($goodData){
                        //处理颜色
                        $mainColor = explode(',', $goodData['color']);
                        // dump($mainColor);exit;

                        $originColor = C('color');
                        foreach ($mainColor as $key => $value) {
                                $colors[$value] = $originColor[$value];

                        }
                        $this->assign('colors', $colors);
                }else{
                        $this->_empty();
                }
                    M('goods')->where(array('agent_id'=>AGENT_ID,'goods_id'=>$goods_id))->setInc('agent_click_count',1);
                    $this->assign('inventory',$goodData['inventory']);//库存

            }
        }else{
            $this->_empty();
        }

            $collectNum = M('agent_collection')->where(array('goods_id' => $goods_id))->count();
            $isCollect = M('agent_collection')->where(array('goods_id' => $goods_id, 'agent_id' => session('AgentUser')))->find();
            if ($isCollect) {
                $goodData['isCollect'] = 1;
            }
            $goodData['collectNum'] = $collectNum;

            $this->assign('goodData', $goodData);
            $this->display();
    }


    //商品搜索
    public function search()
    {
        $q = I('q',null);
        if($q === ''){$this->error('关键词不能为空！');}
        C('TOKEN_ON',false);
        $this->assign('q',$q);
        $this->display();
    }


    //搜索数据
    public function searchdata()
    {

        $q = trim(I('get.q'));
        if(AGENT_ID){
            $where['g.name']  = array('like', '%'.$q.'%');
            $where['g.keywords']  = array('like','%'.$q.'%');
            $where['g.description']  = array('like','%'.$q.'%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;

            if(AGENT_ID == session('AgentUser')){//自己浏览
                $map['ag.goods_permissions'] = array('in',array(0,1,2));
            }elseif(session('AgentUser')){//登录用户浏览
                $map['ag.goods_permissions'] = array('in',array(1,2));//如果登录情况可以查看对应代理商的权限为1，2的商品
            }else{
                $map['ag.goods_permissions'] = array('in',array(2));//没有登录只能查看权限为2的商品
            }


            $goods = M('agent_goods as ag')->join('__GOODS__ as g on ag.agent_goods_id = g.goods_id')->field('agent_price,name,goods_id,goods_sn,images')->where($map)->Page($_GET['p'],10)->select();
            $collect = M('agent_collection');
            foreach($goods as &$v){
                $v['collect'] = $collect->where(array('goods_id'=>$v['goods_id']))->count();
                $v['is_collect'] = $collect->where(array('goods_id'=>$v['goods_id'],'agent_id'=>session('AgentUser')))->getField('id');
                $v['price'] = $v['agent_price'];
            }
// dump(M());exit;
        }else{

            $where['name']  = array('like', '%'.$q.'%');
            $where['keywords']  = array('like','%'.$q.'%');
            $where['description']  = array('like','%'.$q.'%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
            $goods = M('goods')->where($map)->Page($_GET['p'],10)->select();
            $collect = M('agent_collection');
            foreach($goods as &$v){
                $v['collect'] = $collect->field('price,name,goods_id,goods_sn,images')->where(array('goods_id'=>$v['goods_id']))->count();
                $v['is_collect'] = $collect->where(array('goods_id'=>$v['goods_id'],'agent_id'=>session('AgentUser')))->getField('id');
            }
        }

        $this->assign('data',$goods);
        $this->assign('q',$q);
        $this->display();
    }


   // public function _empty()
   // {
   //  $this->show('404');exit;
   // }

}
