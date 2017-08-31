<?php
namespace Agent\Controller;
class ConfigController extends PublicController 
{
    public function index()
    {
    	// $data = M('brand')->order('sorting')->select();
    	// $this->assign('data',$data);
    	$this->display();
    }


    //设置信息
    public function setconfig()
    {

    	$this->display();
    }


    //
}