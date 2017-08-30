<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller
{
	public function _initialize()
	{
		if(!session('AdminUser')){$this->redirect('Login/index');}
	}

    // 单文件上传
    public function uploadOne($path, $file)
    {
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     $path;

        $info   =   $upload->uploadOne($file);
        if (!$info) {
            return array(
                'status' => 0,
                'msg' => $upload->getError(),
                'data' => ''
            );
        } else {
            return array(
                'status' => 1,
                'msg' => '上传成功',
                'data' => $info['savepath'].$info['savename']
            );
        }
    }
}
