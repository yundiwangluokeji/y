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
    }




    public function _empty(){

    	header('HTTP/1.1 404 Not Found');
		header("status: 404 Not Found");
    	echo 'PublicController';
    }
}
