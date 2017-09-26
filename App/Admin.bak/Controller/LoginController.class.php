<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
    	if(IS_POST){
    		$input = I('post.');
    		$verify = new \Think\Verify();
    		if(!$verify->check($input['authcode'])){
    				$this->ajaxReturn(array('res'=>4,'msg'=>'验证码错误！'));
    		}
    		$secret = M('admin')->where(array('username'=>$input['admin_name']))->getField('secret');//获取密钥
    		if($secret){
    			$pass = encryption($input['admin_pw'],$secret);
    			$res = M('admin')->where(array('username'=>$input['admin_name'],'password'=>$pass))->find();
    			if($res){
    				session('AdminUser',$res['admin_id']);
    				$this->ajaxReturn(array('res'=>2,'msg'=>'登录成功！'));

    			}else{
    				$this->ajaxReturn(array('res'=>3,'msg'=>'密码错误！'));
    			}

    		}else{
    			$this->ajaxReturn(array('res'=>1,'msg'=>'用户名不存在！'));
    		}

    	}else{
				if(session('AdminUser')){$this->redirect('Index/index');}
    		$this->display();
    	}
    }

    public function code()
    {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 30;
    	// $Verify->imageW = 80;
    	// $Verify->imageH = 32;
    	$Verify->length = 3;
    	$Verify->useCurve = false;
    	$Verify->useNoise = false;
    	$Verify->entry();
    }

    public function onLogin()
    {
    	session('AdminUser',null);
    	$this->redirect('Login/index');

    }
}
