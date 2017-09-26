<?php
namespace Admin\Model;

class BrandModel extends \Think\Model
{
    // 查询品牌数据
    public function selectBrandData($where = '', $Page)
    {
        $brandData = $this->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("addtime desc")->select();
        if ($brandData) {
            return array(
                'status' => 1,
                'msg' => '查询成功',
                'data' => $brandData
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '查询失败，请重试',
                'data' => ''
            );
        }
    }
    // 添加品牌
    public function addBrand($formData)
    {
        $formData['addtime'] = time();
        $addRes = $this->add($formData);
        if ($addRes) {
            return array(
                'status' => 1,
                'msg' => '添加成功',
                'data' => ''
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '添加失败，请重试',
                'data' => ''
            );
        }
    }

    // 查询单个分类的数据
    public function findBrand($brand_id)
    {
        $brandContent = $this->where(array('brand_id' => $brand_id))->find();
        if ($brandContent) {
            return array(
                'status' => 1,
                'msg' => '查询成功',
                'data' => $brandContent
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '查询原始数据失败，请重试',
                'data' => ''
            );
        }
    }

    // 修改品牌
    public function editBrand($formData, $brand_id)
    {
        $formData['updatetime'] = time();
        $editRes = $this->where(array('brand_id' => $brand_id))->save($formData);
        if ($editRes) {
            return array(
                'status' => 1,
                'msg' => '修改成功',
                'data' => ''
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '修改失败，请重试',
                'data' => ''
            );
        }
    }

    // 删除品牌
    public function delBrand($brand_id)
    {
        if (is_array($brand_id)) {
            $ids = '';
            for ($i=0; $i < count($brand_id); $i++) {
                if ($i != 0) {
                    $ids = $ids.','.$brand_id[$i];
                } else {
                    $ids = $brand_id[$i];
                }
            }
            $where = 'brand_id in ('.$ids.')';
        } else {
            $where = array('brand_id' => $brand_id);
        }
        $delRes = $this->where($where)->delete();
        if ($delRes) {
            return array(
                'status' => 1,
                'msg' => '删除成功',
                'data' => ''
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '删除失败，请重试',
                'data' => ''
            );
        }
    }
}
