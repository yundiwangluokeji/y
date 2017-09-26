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
    public function delType($class_id)
    {
        if (is_array($class_id)) {
            $ids = '';
            for ($i=0; $i < count($class_id); $i++) {
                if ($i != 0) {
                    $ids = $ids.','.$class_id[$i];
                } else {
                    $ids = $class_id[$i];
                }
            }
            $where = 'class_id in ('.$ids.')';
        } else {
            $where = array('class_id' => $class_id);
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
    public function findType($class_id)
    {
        $typeContent = $this->where(array('class_id' => $class_id))->find();
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
    public function editType($formData, $class_id)
    {
        $formData['updatetime'] = time();
        $editRes = $this->where(array('class_id' => $class_id))->save($formData);
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
