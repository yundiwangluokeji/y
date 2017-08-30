<?php
namespace Admin\Model;

class ClassificationModel extends \Think\Model
{
    // 查询分类数据
    public function selectTypeData()
    {
        $typeData = $this->select();
        if ($typeData) {
            return array(
                'status' => 1,
                'msg' => '查询成功',
                'data' => $typeData
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '查询失败，请重试',
                'data' => ''
            );
        }
    }

    // 添加分类
    public function addType($formData)
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

    // 删除分类
    public function delType($brand_id)
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

    // 查询单个分类的数据
    public function findType($brand_id)
    {
        $typeContent = $this->where(array('brand_id' => $brand_id))->find();
        if ($typeContent) {
            return array(
                'status' => 1,
                'msg' => '查询成功',
                'data' => $typeContent
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '查询原始数据失败，请重试',
                'data' => ''
            );
        }
    }

    // 修改分类
    public function editType($formData, $brand_id)
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
}
