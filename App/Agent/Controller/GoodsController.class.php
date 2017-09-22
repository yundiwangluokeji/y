<?php

namespace Agent\Controller;
class GoodsController extends PublicController 
{

	//我的商品列表
	public function index()
	{

		$classification = M('classification')->select();
		$this->assign('class',$classification);
		// dump($classification);exit;


		

		$this->display();
	}


	public function ajaxdata()
	{
		// sleep(5);
		$class_id = I('class_id');
		$order = I('order','agent_goods_id desc');
		if($class_id){
			$data = M('agent_goods')->where(C('DB_PREFIX').'agent_goods.agent_id = '.session('AgentUser'))->join('__GOODS__ on __AGENT_GOODS__.agent_goods_id = __GOODS__.goods_id and __GOODS__.class_id = '.$class_id)->Page($_GET['p'],10)->order($order)->select();
		}else{

			$data = M('agent_goods')->where(array('agent_id'=>session('AgentUser')))->Page($_GET['p'],10)->order($order)->select();
			$modelgoods = M('goods');
			foreach($data as &$v){
				$goods = $modelgoods->field('goods_sn,images,name')->where(array('goods_id'=>$v['agent_goods_id']))->find();//从商品表中获取图片和商品编号
				$v['goods_sn'] = $goods['goods_sn'];
				$v['images'] = $goods['images'];
				$v['goods_name'] = $goods['name'];
			}
		}
		// dump(M());exit;
		$this->assign('data',$data);
		$this->display();
	}


	//生成商品临时路径
	public function temporary()
	{
		$goods_id = I('goods_id');
		$agent_id = I('agent_id');
		$data = encryption('agent_id='.$agent_id.'&goods_id='.$goods_id.'&time='.time());
		//替换特殊符号
		$data = str_replace('/', '__slash__', $data);
		$data = str_replace('+', '__add__', $data);
		$data = str_replace('=', '__eq__', $data);
		$erweima = 'http://pan.baidu.com/share/qrcode?w=375&h=375&url=';
		$host = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
		// $host = 'http://192.168.0.88';
		$url = $erweima.$host.U('Home/Temporary/goods').'?data='.$data;
		// echo $url;
		$this->ajaxReturn($url);
	}

}