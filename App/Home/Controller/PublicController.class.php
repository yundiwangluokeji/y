<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function _initialize()
    {
    	define(AGENT_ID,I('agent'));//代理商id
    	//如果无代理商id或者没有登录返回404
    	if(!I('agent') && !session('AgentUser')){$this->_empty();exit;}
    	//如果代理商不存在返回404
    	if(!M('agent')->where(array('id'=>I('agent')))->find() && AGENT_ID){$this->_empty();exit;}
        //如果不是自己的店铺 也是不可以看的
        // if(AGENT_ID !=)
    	// session('HomeUser',null);
        //如果不是自己上级的店铺 不允许查看
        if(session('AgentUser')){
            $pid = M('agent')->where(array('id'=>session('AgentUser')))->getField('father');
            if(AGENT_ID != $pid && AGENT_ID != session('AgentUser')){
                $this->_empty();exit;
            }
        }
        $this->config();//配置
    }



    //查询店铺信息
    public function config()
    {
        //如果传了代理商id查询代理商的配置 否则查询总平台
       if(AGENT_ID){
            $config = M('agent_config')->where(array('agent_id'=>AGENT_ID))->find();

       }else{
            $config = array();
            $config['name'] = M('config')->where(array('configkey'=>'title'))->getField('configval');
            $config['logo'] = M('config')->where(array('configkey'=>'logo'))->getField('configval');

       }
       $this->assign('config',$config);
    }

    public function _empty(){

    	header('HTTP/1.1 404 Not Found');
		header("status: 404 Not Found");
    	$this->display('Public/404');
    }
}

 // 'id' => string '2' (length=1)
 //  'name' => string '云狄科技11' (length=14)
 //  'agent_id' => string '11' (length=2)
 //  'logo' => string '' (length=0)
 //  'mobile' => string '' (length=0)
 //  'tel' => string '' (length=0)
 //  'address' => string '' (length=0)
 //  'weixin' => string '' (length=0)
 //  'addtime' => null
 //  'updateitme' => string '2017-09-09 13:51:35' (length=19)