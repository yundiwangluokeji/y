<?php
namespace Agent\Controller;
use Think\Controller;
class PublicController extends Controller {
    public $config = array();
    public function _initialize()
    {
    	//如果没有登录返回404
        if(!session('AgentUser')){$this->redirect('Login/index');}
    	$this->agentconfig();
        // session('AgentUser',null);
    }


    //代理商信息
    protected function agentconfig()
    {
    	// dump(session());exit;
        $sql = "select 
        __AGENT__.username,
        __AGENT__.father,
        __AGENT__.mobile,
        __AGENT__.status,
        __AGENT_CONFIG__.name,
        __AGENT_CONFIG__.agent_id,
        __AGENT_CONFIG__.address
         from __AGENT__ inner join __AGENT_CONFIG__ ON __AGENT_CONFIG__.agent_id = __AGENT__.id where __AGENT__.id = ".session('AgentUser').' limit 1';
        $agent = M()->query($sql)[0];
        // dump($agent);exit;
        $this->config = $agent;
        $this->assign('config',$agent);
    }

    public function _empty(){
    	header('HTTP/1.1 404 Not Found'); 
		header("status: 404 Not Found"); 
        $this->display('Public/404');
    }


    //  public function __destruct()
    // {
    //     dump(M());
    // }
}