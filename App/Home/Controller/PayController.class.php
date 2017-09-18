<?php
// http://192.168.0.88/Home/Pay/index.html?order=Xp%2BE5uRaGvf8pTWmmjtu8mxKU2LaMMu7xlTbgeQqKrc%3D&buy=N1xsSKUv04x%2FGfOejGV1QySdWiJUqyxoDiBR2HO3xgU%3D
namespace Home\Controller;
use Org\Alipaywap\Alipaywap;


use Think\Controller;
class PayController extends Controller
{
	//支付选择页面
	public function index()
	{
		$input = I('get.');
		// $buy = 
		if(!$input['order'] || !$input['buy']){
			$this->payres('非法操作！');
			exit;
		}
		// 解密
		$order_id = decryption($input['order']);//订单id
		$buy = decryption($input['buy']);//订单类型
		// dump($buy);exit;
		if(!$order_id ||  $buy != 1){$this->payres('非法操作！');exit;}
		$data = M('order')->where(array('order_id'=>$order_id,'buy'=>$buy))->find();
		if(!$data){$this->payres('非法操作！');exit;}
		if($data['pay_status'] == 1 || $data['pay_status'] == 2){$this->payres('此订单已经支付!',2);exit;}
		$goods = M('order_goods')->where(array('order_id'=>$order_id))->find();
		if(!$goods){$this->payres('非法操作！');exit;}

		if(IS_POST){
			if(I('post.courier') && I('post.paytype')){
				//支付方式
				switch (I('post.paytype')) {
					case 'Alipay':
						$pay_way = 2;
						break;
					case 'Weixin':
						$pay_way = 1;
						break;
					case 'Offlinepay':
						$pay_way = 4;
						break;
					
					default:
						$pay_way = 0;
						
						break;
				}
				$res = M('order')->where(array('order_id'=>$order_id))->save(array('courier'=>I('post.courier'),'pay_way'=>$pay_way,'updatetime'=>date('Y-m-d H:i:s',time())));//2017-09-18 09:33:32
				if($res){
					$show_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].urlencode(U('Home/Goods/goodDetail',array('goods_id'=>$goods['goods_id'])));
					header( "Location: ".U('Pay/'.I('post.paytype').'/index')."?subject={$goods['goods_name']}&money={$data['count_price']}&show_url={$show_url}&body=购买商品:{$goods['goods_name']}&agent_id=0&out_trade_no={$data['order_sn']}",true,301 );exit;
					/*
					,array('subject'=>$goods['goods_name'],'money'=>$data['count_price'],'show_url'=>$show_url,'body'=>'购买商品:'.$goods['goods_name'],'agent_id'=>0)
					*$subject 订单名称
					*$money 订单金额
					*$show_url 收银台页面上，商品展示的超链接，必填
					*$body 商品描述
					*$agent_id 支付者id 如果是普通用户0
					*/
				}
			}
				$this->error('非法操作！');

		}else{

				$goods['images'] = M('goods')->where(array('goods_id'=>$goods['goods_id']))->getField('images');//查询商品图片
				//处理每个颜色对应的数量
				$color_num = explode(',', $goods['color_num']);
				$count_num = 0;
				foreach($color_num as $key=>$val){
					$goods_color = explode('_', $val);
					$count_num += $goods_color[1];
					$goods['goods_color2'][ $goods_color[1] ] = C('color')[$goods_color[0]];
											// 数量							颜色
				}
				$goods['count_num'] = $count_num;
				$this->assign('data',$data);
				$this->assign('courier',C('COURIER'));
				$this->assign('goods',$goods);
				$this->display();
		}

	}



	//支付结果显示
	public function payres($msg,$code='0')
	{
		$this->assign('res',array('msg'=>$msg,'code'=>$code));
		$this->display('payres');
	}

	//微信支付
	public function weixin()
	{
		echo '微信支付';
	}

	//支付宝支付
	public function alipay()
	{
		echo '支付宝支付';
	}

	//线下支付
	public function offlinepay()
	{
		echo '线下支付';
	}
}