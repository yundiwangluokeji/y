<?php

namespace Admin\Controller;

class ConfigController extends PublicController
{
    // 显示页面
	public function index()
	{
        $configData = D('config')->selectConfigData();
        $this->assign('configData', $configData);
		$this->display();
	}

    // 修改配置
    public function editConfig()
    {
        $formData = I('post.info');
        if ($_FILES['logo']['name']) {
            $returnData = $this->uploadPic($_FILES['logo']);
            $formData['logo'] = $returnData;
        }

        if ($_FILES['wechat']['name']) {
            $returnData = $this->uploadPic($_FILES['wechat']);
            $formData['wechat'] = $returnData;
        }
        $editRes = D('config')->editConfigData($formData);

        if ($editRes['status']) {
            $this->success($editRes['msg']);
        } else {
            $this->error($editRes['msg']);
        }
    }

    // 调用上传文件方法并处理结果集
    public function uploadPic($file)
    {
        $uploadRes = $this->uploadOne('./Public/Admin/config/', $file);
        if ($uploadRes['status']) {
            return $uploadRes['data'];
        } else {
            $this->error($uploadRes['msg']);
        }
    }
}
