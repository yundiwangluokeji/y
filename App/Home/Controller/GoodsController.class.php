<?php
namespace Home\Controller;
class GoodsController extends PublicController 
{
    public function index()
    {
    	$data = M('brand')->order('sorting')->select();
    	$this->assign('data',$data);
    	$this->display();
    }

    //商品列表
    public function goodslist()
    {
    	$brand_id = 1;

    }




}