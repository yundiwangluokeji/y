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
            $class_id = I('get.class_id');
        } else {
            $class_id = I('post.category_id');
        }
        $delRes = D('classification')->delType($class_id);
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
            $class_id = I('get.class_id');
            $typeContent = D('classification')->findType($class_id);
            if ($typeContent['status']) {
                $this->assign('typeContent', $typeContent['data']);
                $this->display();
            } else {
                $this->error($typeContent['msg']);
            }
        } else {
            $class_id = I('post.class_id');
            $formData = I('post.info');
            $editRes = D('classification')->editType($formData, $class_id);
            if ($editRes['status']) {
                $this->success($editRes['msg']);
            } else {
                $this->error($editRes['msg']);
            }
        }
    }

    // 转移商品
    public function transferGood()
    {
        $class_id = I('get.class_id');
        $typeContent = D('classification')->findType($class_id);
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
