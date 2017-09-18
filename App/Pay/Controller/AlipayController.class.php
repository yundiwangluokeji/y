<?php

namespace Pay\Controller;
use Think\Controller;

class AlipayController extends Controller
{
	protected $config;

	public function __construct()
	{

			//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
			//合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
			$alipay_config['partner']		= '2088721936305297';

			//收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
			$alipay_config['seller_id']	= $alipay_config['partner'];

			// MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
			$alipay_config['key']			= '4rad6jnqp35pfhu5z0yobuwim057co3y';
			// 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
			$alipay_config['notify_url'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].U('Pay/Alipay/notifyurl');

			// 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
			$alipay_config['return_url'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].U('Pay/Alipay/returnurl');

			//签名方式
			$alipay_config['sign_type']    = strtoupper('MD5');

			//字符编码格式 目前支持utf-8
			$alipay_config['input_charset']= strtolower('utf-8');

			//ca证书路径地址，用于curl中ssl校验
			//请保证cacert.pem文件在当前文件夹目录中
			$alipay_config['cacert']    = getcwd().'\\ThinkPHP\\Library\\Org\\alipaywap\\cacert.pem';
			// $alipay_config['cacert']    = getcwd().'\\cacert.pem';

			//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
			$alipay_config['transport']    = 'http';

			// 支付类型 ，无需修改
			$alipay_config['payment_type'] = "1";
					
			// 产品类型，无需修改
			$alipay_config['service'] = "alipay.wap.create.direct.pay.by.user";
			$this->config = $alipay_config;
			//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		// self::$model = new Model();
	}

	/*
	*$subject 订单名称
	*$money 订单金额
	*$show_url 收银台页面上，商品展示的超链接，必填
	*$body 商品描述
	*$agent_id 支付者id 如果是普通用户0
	*/
	public function index($subject,$money,$show_url,$body,$agent_id,$out_trade_no)
	{
		// return $this->config;
		        require_once("./ThinkPHP/Library/Org/alipaywap/lib/alipay_submit.class.php");
                //商户订单号，商户网站订单系统中唯一订单号，必填
                // $out_trade_no = date('YmdHis',time()).mt_rand(1111,9999);
                //订单名称，必填
                // $subject = '账户充值';
                if(!$subject){return '订单名称，不能为空！';}
                //付款金额，必填
                if(!(is_numeric($money) && $money > 0)){return '金额不合法!';}
                $total_fee = $money;
                //收银台页面上，商品展示的超链接，必填
                // $show_url = "http://shoubiao.yundi88.com/Agent/Money/index.html";
                //商品描述，可空
                // $body = '账户充值 金额：'.sprintf("%.2f",$_POST['money']);

                /************************************************************/
                //构造要请求的参数数组，无需改动
                $parameter = array(
                        "service"       => $this->config['service'],
                        "partner"       => $this->config['partner'],
                        "seller_id"  => $this->config['seller_id'],
                        "payment_type"  => $this->config['payment_type'],
                        "notify_url"    => $this->config['notify_url'],
                        "return_url"    => $this->config['return_url'],
                        "_input_charset"    => trim(strtolower($this->config['input_charset'])),
                        "out_trade_no"  => $out_trade_no,
                        "subject"   => $subject,
                        "total_fee" => $total_fee,
                        "show_url"  => $show_url,
                        "app_pay" => "Y",//启用此参数能唤起钱包APP支付宝
                        "body"  => $body,
                        //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.2Z6TSk&treeId=60&articleId=103693&docType=1
                        //如"参数名"    => "参数值"   注：上一个参数末尾需要“,”逗号。
                        
                );


                //写入支付记录
                $data['order'] = $out_trade_no;//点单号
                $data['name'] = $subject;//订单名称
                $data['price'] = $total_fee;//订单价格
                $data['url'] = $show_url;//商品地址
                $data['body'] = $body;//商品描述
                $data['time'] = time();
                $data['pay_type'] = 2;//支付类型
                $data['agent_id']  = $agent_id;//代理商id
                if(M('topup')->add($data)){
                    //建立请求
                    $alipaySubmit = new \AlipaySubmit($this->config);
                    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
                    echo  $html_text;
                }else{

                    echo  "订单创建失败!";
                }
	}



    //服务器异步通知页面
    public function notifyurl()
    {
                require_once("./ThinkPHP/Library/Org/alipaywap/lib/alipay_notify.class.php");

                        //计算得出通知验证结果
                        $alipayNotify = new \AlipayNotify($this->config);
                        $verify_result = $alipayNotify->verifyNotify();
                        if($verify_result) {//验证成功
                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //请在这里加上商户的业务逻辑程序代
                            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
                            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
                            //商户订单号
                            $out_trade_no = $_POST['out_trade_no'];
                            //支付宝交易号
                            $trade_no = $_POST['trade_no'];
                            //交易状态
                            $trade_status = $_POST['trade_status'];
                            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                                //判断该笔订单是否在商户网站中已经做过处理
                                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                                    //如果有做过处理，不执行商户的业务程序
                                        
                                //注意：
                                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                                //调试用，写文本函数记录程序运行情况是否正常
                                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

                                 //查询此订单是否处理过 订单表和充值记录表

                            	$this->updateorder($out_trade_no,$trade_no,$_GET['total_fee']);
                                   

                            }
                            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                                //判断该笔订单是否在商户网站中已经做过处理
                                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                                    //如果有做过处理，不执行商户的业务程序
                                        
                                //注意：
                                //付款完成后，支付宝系统发送该交易状态通知

                                //调试用，写文本函数记录程序运行情况是否正常
                                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                            	$this->updateorder($out_trade_no,$trade_no,$_GET['total_fee']);

                            }

                            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                               
                            echo "success";     //请不要修改或删除
                            
                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        }
                        else {
                            //验证失败
                            echo "fail";

                            //调试用，写文本函数记录程序运行情况是否正常
                            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                        }
    }


    //页面跳转同步通知页面路径
    public function returnurl()
    {
                        require_once("./ThinkPHP/Library/Org/alipaywap/lib/alipay_notify.class.php");
        //计算得出通知验证结果
            $alipayNotify = new \AlipayNotify($this->config);
            $verify_result = $alipayNotify->verifyReturn();
            if($verify_result) {//验证成功
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //请在这里加上商户的业务逻辑程序代码
                
                //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
                //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

                //商户订单号

                $data['out_trade_no'] = $out_trade_no = $_GET['out_trade_no'];
                //支付宝交易号
                $data['trade_no'] = $trade_no = $_GET['trade_no'];
                //交易状态
                $data['trade_status'] = $trade_status = $_GET['trade_status'];
                $data['trade_status'] = $_GET['total_fee'];
                if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                        //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                        //如果有做过处理，不执行商户的业务程序
                        //查询此订单是否处理过

                	// 支付成功处理
                        $order_res = M('topup')->where(array('order'=>$out_trade_no,'res'=>0))->find();//查询此订单是否处理过
                        if($order_res){//没有处理过
                            $this->updateorder($out_trade_no,$trade_no,$_GET['total_fee'],1);//处理订单
                            $msg = '支付成功!';
                        }else{//处理过了

                            $msg = '支付成功!';
                        }

                }
                else {
                	// 支付失败处理

                     //查询此订单是否处理过
                        $order_res = M('topup')->where(array('order'=>$out_trade_no,'res'=>0))->find();
                      if($order_res){
                           $this->updateorder($out_trade_no,$trade_no,$_GET['total_fee'],2);//处理订单
                            $msg = '支付失败!';
                        }else{

                            $msg = '此订单已经处理过了!';
                        }
                }
                    
                // echo "验证成功<br />";

                //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
            else {
                //验证失败
                //如要调试，请看alipay_notify.php页面的verifyReturn函数
                 $this->error('验证失败!');
            }
            $data['time'] = $_GET['notify_time'];
            $this->assign('data',$data);
            $this->assign('msg',$msg);
            $this->display();
        
    }

    /*
		$out_trade_no 商户订单号
		$trade_no 支付宝交易号
		$total_fee 价格
		$res 支付状态 1支付成功 0支付失败
    */

    protected function updateorder($out_trade_no,$trade_no,$total_fee,$res=0)
    {
    	M('topup')->where(array('order'=>$order))->save(array('res'=>$res,'order_sn'=>$order_sn));//处理支付记录表
    	//如果是充值给用户添加货币 22位的是充值订单号
   		if(strlen($out_trade_no == 22)){
        	$this->updatetopup($out_trade_no,$trade_no,$res,$total_fee);
   		}else{
   			//商品购买  改变商品订单状态
   			$order_res2 = M('order')->where(array('order_sn'=>$out_trade_no,'pay_way'=>2,'pay_status'=>0))->find();
	        if($order_res2 && $res == 1){
	        	M('order')->where(array('order_sn'=>$out_trade_no))->save(array('pay_status'=>1));
	        }
   		}

    }




    //给用户添加货币
    protected function updatetopup($order,$order_sn,$res,$price)
    {
        //日志记录
        $money_id = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('id');//查询钱包id
        $data['operation'] = session('AgentUser');//操作者
        $data['agent_id'] = session('AgentUser');//被操作者
        $data['money_id'] = $money_id;//钱包id
        $data['money'] = '+'.$price * 10 * 10;//充值金额
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['address'] = getip($_SERVER['REMOTE_ADDR']);
        $data['res'] = $res;
        $data['type'] = 1;
        $data['msg'] = '账户充值-支付宝';
        $data['time']  = time();
        $res2 = M('money_log')->add($data);

        //充值成功后给用户增加货币
        if($res == 1){
            $res1 = M('money')->where(array('agent_id'=>session('AgentUser')))->setInc('money',$price * 10 * 10);
        }
    }
    
}



