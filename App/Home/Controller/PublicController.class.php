<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function _initialize()
    {
    	
    }

    public function _empty(){


    	header('HTTP/1.1 404 Not Found'); 
		header("status: 404 Not Found"); 
    	echo 'PublicController';
    }
}