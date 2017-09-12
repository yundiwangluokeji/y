<?php
namespace Agent\Controller;
class ConfigController extends PublicController 
{
    public function index()
    {
       
    	$this->display();
    }


    //设置信息
    public function setconfig()
    {
        if(IS_POST){
           if(!I('name')){$this->ajaxReturn(array('res'=>0,'msg'=>'店铺名称不能为空！'));}
           $res = M('agent_config')->where(array('agent_id'=>$this->config['agent_id']))->save(array('name'=>I('name')));
           // dump(M('agent'));exit;
           if($res){
                $this->ajaxReturn(array('res'=>1,'msg'=>'修改成功！'));
            }else{

                $this->ajaxReturn(array('res'=>2,'msg'=>'修改失败！'));
            }


        }else{
        	$this->display();
        }

    }

    //修改密码
    public function setpassword()
    {

        

        if(IS_POST){
            $input = I('post.');
            $model = M('agent');
            // if (!$model->autoCheckToken($_POST)){$this->ajaxReturn(array('res'=>0,'msg'=>'非法提交！')); }
            //解密原密码
            $old_password = $model->where(array('id'=>$this->config['agent_id']))->find();
            if($input['old_password'] != decryption($old_password['password'],$old_password['secret'])){
                $this->ajaxReturn(array('res'=>2,'msg'=>'原密码错误！'));
            }
            if($input['new_password_check'] != $input['new_password']){
                $this->ajaxReturn(array('res'=>3,'msg'=>'修改密码前后不一致!'));
            }

            $data['secret'] = createluan(32);//创建vi
            $data['password'] = encryption($input['new_password'],$data['secret']);//创建密码
            $res = $model->where(array('id'=>$this->config['agent_id']))->save($data);
            if($res){
                $this->ajaxReturn(array('res'=>1,'msg'=>'修改成功！'));
            }else{

                $this->ajaxReturn(array('res'=>4,'msg'=>'修改失败！'));
            }


        }else{

            $this->display();
        }
    }


    //发送验证码
    public function sendcode()
    {
        $mobile = I('post.mobile');
        $res = sendcode($mobile);
        $this->ajaxReturn($res);
    }


    //绑定手机
    public function setmobile()
    {
        if(IS_POST){
            $input = I('post.');
            //验证手机号
            if(!validation_mobile($input['mobile'])){$this->ajaxReturn(array('res'=>0,'msg'=>'手机号格式错误！'));}
            if(S('mobile'.$input['mobile']) != $input['code']){$this->ajaxReturn(array('res'=>2,'msg'=>'验证码错误！'));}
            $res = M('agent')->where(array('id'=>$this->config['agent_id']))->save(array('mobile'=>$input['mobile']));
            if($res){
                $this->ajaxReturn(array('res'=>1,'msg'=>'绑定成功！'));
            }else{
                $this->ajaxReturn(array('res'=>3,'msg'=>'绑定失败！'));
            }

        }else{
            if(M('agent')->where(array('id'=>$this->config['agent_id']))->getField('mobile')){
                echo "<script>alert('已绑定手机号！'); window.history.go(-1);</script>";
            }
            $this->display();
        }
    }

    //关于软件
    public function about()
    {
        $this->display();
    }


}