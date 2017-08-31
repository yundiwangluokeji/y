<?php
namespace Agent\Controller;
class IndexController extends PublicController 
{
    public function index()
    {
    	// $data = M('brand')->order('sorting')->select();
    	// $this->assign('data',$data);
    	$this->display();
    }


    
}