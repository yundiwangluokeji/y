<?php
namespace Agent\Controller;
class CollectionController extends PublicController 
{

	//收藏列表
	public function index()
	{

		$this->display();
	}

	//收藏夹的数据 为了好处理 解析后返回回去
	public function collectiondata()
	{
		// sleep(5);
		$data = M('agent_collection')->where(array('agent_id'=>session('AgentUser')))->Page($_GET['p'],10)->select();
		$model = M('goods');
		foreach($data as &$v){
			$goods = $model->field('images,name,price')->where(array('goods_id'=>$v['goods_id']))->find();
			$v['name'] = $goods['name'];
			$v['images'] = $goods['images'];
			$v['price'] = $goods['price'];
		}
		$this->assign('data',$data);
		$this->display();

	}

	//删除收藏夹中商品
	public function delete()
	{
		if(IS_AJAX){
			$goods_id = I('goods_id');
			$res = M('agent_collection')->where(array('goods_id'=>$goods_id,'agent_id'=>session('AgentUser')))->delete();
			if($res){
				$this->ajaxReturn(array('res'=>1,'msg'=>'删除成功!'));
			}
				$this->ajaxReturn(array('res'=>0,'msg'=>'删除失败!'));
		}
	}



}