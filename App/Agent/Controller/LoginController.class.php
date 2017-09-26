<?php
namespace Agent\Controller;
use Think\Controller;
class LoginController extends Controller 
{
    public function index()
    {
        if(IS_POST){
            $input = I('post.');
            $model = M('agent');
            $secret = $model->where(array('username'=>$input['user']))->getField('secret');//获取密钥
            $data['pass'] = encryption($input['password'],'54687931317042615429184061694000');
            $data['name'] = $input['user'];
           if($secret){
                $pass = encryption($input['password'],$secret);
                $res = $model->where(array('username'=>$input['user'],'password'=>$pass))->find();
                if($res){
                    if($res['status'] == 0){
                            $data['res'] = 0;
                            $data['msg'] = '此用户已被冻结！';
                            $this->login_log($data);
                            $this->ajaxReturn(array('res'=>4,'msg'=>'此用户已被冻结！'));
                    }
                    session('AgentUser',$res['admin_id']);
                    $data['res'] = 1;
                    $data['msg'] = '登录成功！';
                    $this->login_log($data);
                    $this->ajaxReturn(array('res'=>2,'msg'=>'登录成功！'));

                }else{
                    $data['res'] = 0;
                    $data['msg'] = '密码错误！';
                    $this->login_log($data);
                    $this->ajaxReturn(array('res'=>3,'msg'=>'密码错误！'));
                }

            }else{
                    $data['res'] = 0;
                    $data['msg'] = '用户名不存在！';
                    $this->login_log($data);
                $this->ajaxReturn(array('res'=>1,'msg'=>'用户名不存在！'));
            }
            

        }else{
            if(session('AgentUser')){
                $this->redirect('Index/index');
            }

        	$this->display();
        }


    }

    //登录日志
    public function login_log($data)
    {
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['address'] = getip($_SERVER['REMOTE_ADDR']);
        $data['time'] = time();
        M('login_log')->add($data);


    }


    public function exitlogin()
    {
        session('AgentUser',null);
       $this->redirect('Login/index');
    }

    




}