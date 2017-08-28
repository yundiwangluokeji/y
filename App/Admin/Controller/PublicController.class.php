<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller 
{
	public function _initialize()
	{
		if(!session('AdminUser')){$this->redirect('Login/index');}
	}
    

}