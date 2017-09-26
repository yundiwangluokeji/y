<?php
namespace Admin\Model;

class AgentModel extends \Think\Model
{
    // 删除
    public function dels($id)
    {
        if (is_array($id)) {
            $ids = '';
            for ($i=0; $i < count($id); $i++) {
                if ($i != 0) {
                    $ids = $ids.','.$id[$i];
                } else {
                    $ids = $id[$i];
                }
            }
            $where = 'id in ('.$ids.')';
        } else {
            $where = array('id' => $id);
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
