<?php
namespace Admin\Controller;

class GoodsController extends PublicController
{
    // 显示商品
    public function index()
    {
        // 处理搜索
        $where = "1=1";
        if (I('get.name')) {
            $where.=" and name = '".I('get.name')."'";
        }
        if (I('get.classification')) {
            $where.=" and class_id = '".I('get.classification')."'";
        }
        if (I('get.brand')) {
            $where.=" and brand_id = '".I('get.brand')."'";
        }

        $count = D('goods')->countNum();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $goodData = D('goods')->selectGoodData($where, $Page);
        if ($goodData['status']) {
            for ($i=0; $i < count($goodData['data']); $i++) {
                $typeData = D('classification')->findType($goodData['data'][$i]['class_id']);
                $goodData['data'][$i]['class'] = $typeData['data']['name'];

                $brandData = D('brand')->findBrand($goodData['data'][$i]['brand_id']);
                $goodData['data'][$i]['brand'] = $brandData['data']['name'];
            }

            $typeAllData = D('classification')->selectTypeData();
            $brandAllData = D('brand')->selectBrandData();
            $this->assign('typeAllData', $typeAllData['data']);
            $this->assign('brandAllData', $brandAllData['data']);
            $this->assign('goodData', $goodData['data']);
            // dump($goodData);exit;
            $this->display();
        } else {
            $this->display();
        }
    }

    // 修改商品上下架状态
    public function changeShelves()
    {
        $goods_id = I('post.goods_id');
        $status = I('post.status');
        $changeRes = D('goods')->changeShelves($goods_id, $status);
        // $changeRes = json_encode($changeRes);
        // dump($changeRes);exit;
        $this->ajaxReturn($changeRes);
    }

    // 修改商品是否推荐状态
    public function changeRecommend()
    {
        $goods_id = I('post.goods_id');
        $status = I('post.status');
        $changeRes = D('goods')->changeRecommend($goods_id, $status);
        // $changeRes = json_encode($changeRes);
        // dump($changeRes);exit;
        $this->ajaxReturn($changeRes);
    }



    // 添加商品
    public function addGood()
    {
        if (IS_POST) {
            $formData = I('post.info');
            if (!$formData['color']) {
                $this->error('请选择商品颜色后再添加');
            }
            if ($_FILES['images']['name']) {
                $returnData = $this->uploadPic($_FILES['images']);
                $formData['images'] = $returnData;
            }
            // dump($formData['images']);exit;
            $formData['goods_sn'] = date('YmdHis',time());
            for ($i=0; $i < count($formData['color']); $i++) {
                $str .= $formData['color'][$i].',';
            }
            $formData['color'] = $str;
            $addRes = D('goods')->addGood($formData);
            if ($addRes['status']) {
                $this->success($addRes['msg']);
            } else {
                $this->error($addRes['msg']);
            }
        } else {
            $typeRes = M('classification')->select();
            $brandRes = M('brand')->select();
            $color = C('color');
            $this->assign('typeRes', $typeRes);
            $this->assign('brandRes', $brandRes);
            $this->assign('color', $color);
            $this->display();
        }
    }

    // 删除商品
    public function delGood()
    {
        if (IS_GET) {
            $goods_id = I('get.goods_id');
        } else {
            $goods_id = I('post.product_id');
        }
        $delRes = D('goods')->delGood($goods_id);
        if ($delRes['status']) {
            $this->success($delRes['msg']);
        } else {
            $this->error($delRes['msg']);
        }
    }

    // 修改商品
    public function editGood()
    {
        if (IS_GET) {
            $goods_id = I('get.goods_id');
            $findRes = D('goods')->findGood($goods_id);
            if ($findRes['status']) {
                $typeData = D('classification')->selectTypeData();
                $this->assign('typeData', $typeData['data']);
                $brandData = D('brand')->selectBrandData();
                $this->assign('brandData', $brandData['data']);
                $color = C('color');
                $findRes['data']['color'] = rtrim($findRes['data']['color'], ',');
                $findRes['data']['color'] = explode(',', $findRes['data']['color']);
                $this->assign('goodData', $findRes['data']);
                $this->assign('color', $color);
                // dump($color);exit;
                // dump($findRes['data']['color']);exit;
                $this->display();
            } else {
                $this->error($findRes['msg']);
            }
        }else {
            $goods_id = I('post.goods_id');
            $formData = I('post.info');
            if ($_FILES['images']['name']) {
                $returnData = $this->uploadPic($_FILES['images']);
                $formData['images'] = $returnData;
            }
            for ($i=0; $i < count($formData['color']); $i++) {
                $str .= $formData['color'][$i].',';
            }
            $formData['color'] = $str;
            $editRes = D('goods')->editGood($formData, $goods_id);
            // dump($editRes);exit;
            if ($editRes['status']) {
                $this->success($editRes['msg']);
            } else {
                $this->error($editRes['msg']);
            }
        }
    }

    // 调用上传文件方法并处理结果集
    public function uploadPic($file)
    {
        $uploadRes = $this->uploadOne('./Public/Admin/good/', $file);
        if ($uploadRes['status']) {
            return $uploadRes['data'];
        } else {
            $this->error($uploadRes['msg']);
        }
    }
}
