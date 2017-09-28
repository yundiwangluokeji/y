<?php
namespace Admin\Controller;

class BrandController extends PublicController
{
    // 显示品牌
    public function index()
    {
        $count = D('brand')->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $brandData = D('brand')->selectBrandData($where, $Page);
        if ($brandData['status']) {
            $this->assign('brandData', $brandData['data']);
            $this->display();
        } else {
            $this->display();
        }
    }

    // 添加品牌
    public function addBrand()
    {
        if (IS_POST) {
            $formData = I('post.info');
            if ($_FILES['logo']['name']) {
                $returnData = $this->uploadPic($_FILES['logo']);
                $formData['logo'] = $returnData;
            }

            $addRes = D('brand')->addBrand($formData);
            if ($addRes['status']) {
                $this->success($addRes['msg']);
            } else {
                $this->error($addRes['msg']);
            }
        } else {
            $this->display();
        }
    }

    // 调用上传文件方法并处理结果集
    public function uploadPic($file)
    {
        $uploadRes = $this->uploadOne('./Public/Admin/brand/', $file);
        if ($uploadRes['status']) {
            return $uploadRes['data'];
        } else {
            $this->error($uploadRes['msg']);
        }
    }

    // 修改品牌
    public function editBrand()
    {
        if (IS_GET) {
            $brand_id = I('get.brand_id');
            $brandContent = D('brand')->findBrand($brand_id);
            if ($brandContent['status']) {
                $this->assign('brandContent', $brandContent['data']);
                $this->display();
            } else {
                $this->error($brandContent['msg']);
            }
        } else {
            $brand_id = I('post.brand_id');
            $formData = I('post.info');
            if ($_FILES['logo']['name']) {
                $returnData = $this->uploadPic($_FILES['logo']);
                $formData['logo'] = $returnData;
            }
            $editRes = D('brand')->editBrand($formData, $brand_id);
            if ($editRes['status']) {
                $this->success($editRes['msg']);
            } else {
                $this->error($editRes['msg']);
            }
        }
    }

    // 删除品牌
    public function delBrand()
    {
        if (IS_GET) {
            $brand_id = I('get.brand_id');
        } else {
            $brand_id = I('post.brand_id');
        }
        $delRes = D('brand')->delBrand($brand_id);
        if ($delRes['status']) {
            $this->success($delRes['msg']);
        } else {
            $this->error($delRes['msg']);
        }
    }

    // 更新排序
    public function updateBrand()
    {
        $brand_id = I('post.brand_id');
        $updateRes = M('brand')->where(array('brand_id' => $brand_id))->order('sorting desc')->select();
    }
}
