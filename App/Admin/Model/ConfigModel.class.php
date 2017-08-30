<?php
namespace Admin\Model;

class ConfigModel extends \Think\Model
{
    // 处理网站配置数据
    public function selectConfigData()
    {
        $originData = $this->select();
        for ($i=0; $i < count($originData); $i++) {
            $configData[$originData[$i]['configkey']] = $originData[$i]['configval'];
        }
        return $configData;
    }

    // 修改配置信息
    public function editConfigData($formData)
    {
        foreach ($formData as $key => $value) {
            $editRes[$key] = $this->where(array('configkey' => $key))->save(array(
                'configval' => $value,
                'configupdatetime' => time()
            ));
        }

        foreach ($editRes as $k => $v) {
            if (!$v) {
                return array(
                    'status' => 0,
                    'msg' => $key.'修改失败，请重试',
                    'data' => ''
                );
            }
        }

        return array(
            'status' => 1,
            'msg' => '修改成功',
            'data' => ''
        );
    }
}
