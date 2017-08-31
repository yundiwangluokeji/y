<?php
namespace Agent\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function _initialize()
    {
    	//如果没有登录返回404
        if(!session('AgentUser')){$this->redirect('Login/index');}
    	$this->agentconfig();
    }


    //代理商信息
    protected function agentconfig()
    {
    	// dump(session());exit;
        $sql = "select 
        __AGENT__.username,
        __AGENT__.mobile,
        __AGENT__.status,
        __AGENT_CONFIG__.name,
        __AGENT_CONFIG__.agent_id,
        __AGENT_CONFIG__.address
         from __AGENT__ inner join __AGENT_CONFIG__ ON __AGENT_CONFIG__.agent_id = __AGENT__.id where __AGENT__.id = ".session('AgentUser').' limit 1';
        $agent = M()->query($sql)[0];
        $this->assign('config',$agent);
    }

    public function _empty(){


    	header('HTTP/1.1 404 Not Found'); 
		header("status: 404 Not Found"); 
    	echo 'PublicController';
    }
}