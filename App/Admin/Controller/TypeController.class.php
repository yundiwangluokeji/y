<?php
namespace Admin\Controller;

class TypeController extends PublicController
{

    // 显示分类
    public function index()
    {
        $typeData = D('classification')->selectTypeData();
        if ($typeData['status']) {
            $this->assign('typeData', $typeData['data']);
            $this->display();
        } else {
            $this->display();
        }
    }

    // 添加分类
    public function addType()
    {
        if (IS_POST) {
            $formData = I('post.info');
            $addRes = D('classification')->addType($formData);
            if ($addRes['status']) {
                $this->success($addRes['msg'], 'index');
            } else {
                $this->error($addRes['msg']);
            }
        } else {
            $this->display();
        }
    }

    // 删除分类
    public function delType()
    {
        if (IS_GET) {
            $brand_id = I('get.brand_id');
        } else {
            $brand_id = I('post.category_id');
        }
        $delRes = D('classification')->delType($brand_id);
        if ($delRes['status']) {
            $this->success($delRes['msg']);
        } else {
            $this->error($delRes['msg']);
        }
    }

    // 修改分类
    public function editType()
    {
        if (IS_GET) {
            $brand_id = I('get.brand_id');
            $typeContent = D('classification')->findType($brand_id);
            if ($typeContent['status']) {
                $this->assign('typeContent', $typeContent['data']);
                $this->display();
            } else {
                $this->error($typeContent['msg']);
            }
        } else {
            $brand_id = I('post.brand_id');
            $formData = I('post.info');
            $editRes = D('classification')->editType($formData, $brand_id);
            if ($editRes['status']) {
                $this->success($editRes['msg'], 'index');
            } else {
                $this->error($editRes['msg']);
            }
        }
    }

    // 转移商品
    public function transferGood()
    {
        $brand_id = I('get.brand_id');
        $typeContent = D('classification')->findType($brand_id);
        if ($typeContent['status']) {
            $this->assign('typeContent', $typeContent['data']);
        } else {
            $this->error($typeContent['msg']);
        }
        $typeData = D('classification')->selectTypeData();
        if ($typeData['status']) {
            $this->assign('typeData', $typeData['data']);
        } else {
            $this->error($typeData['msg']);
        }
        $this->display();
    }
}
