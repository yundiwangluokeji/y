<?php
namespace Admin\Model;

class GoodsModel extends \Think\Model
{
    // 查询商品数据
    public function selectGoodData()
    {
        $goodData = $this->select();
        if ($goodData) {
            return array(
                'status' => 1,
                'msg' => '查询成功',
                'data' => $goodData
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '查询失败，请重试',
                'data' => ''
            );
        }
    }

    // 添加商品
    public function addGood($formData)
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

    // 删除
    public function delGood($goods_id)
    {
        if (is_array($goods_id)) {
            $ids = '';
            for ($i=0; $i < count($goods_id); $i++) {
                if ($i != 0) {
                    $ids = $ids.','.$goods_id[$i];
                } else {
                    $ids = $goods_id[$i];
                }
            }
            $where = 'goods_id in ('.$ids.')';
        } else {
            $where = array('goods_id' => $goods_id);
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

    // 更新商品上下架状态
    public function changeShelves($goods_id, $status)
    {
        $status = $status == 1 ? 0 : 1;
        $updateRes = $this->where(array('goods_id' => $goods_id))->save(array('is_shelves' => $status));
        if ($updateRes) {
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

    // 查询单个商品数据
    public function findGood($goods_id)
    {
        $goodData = $this->where(array('goods_id' => $goods_id))->find();
        if ($goodData) {
            return array(
                'status' => 1,
                'msg' => '查询成功',
                'data' => $goodData
            );
        } else {
            return array(
                'status' => 0,
                'msg' => '查无数据，请重试',
                'data' => ''
            );
        }
    }
}
