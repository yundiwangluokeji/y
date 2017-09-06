<?php
namespace Agent\Controller;
class MoneyController extends PublicController 
{
	//钱包
    public function index()
    {
    	$money = M('money')->where(array('agent_id'=>$this->config['agent_id']))->find();
    	$data['total'] = sprintf("%.2f", $money['money'] / 10 / 10);//总金额
    	$freeze = $money['money'] <= 100000?$money['money']:100000;//如果冻结金额小于一千元全部冻结否则冻结一千
    	$data['freeze'] = sprintf("%.2f", $freeze / 10 / 10);//冻结金额
    	$balance = ($money['money'] - 100000) <= 0?0:($money['money'] - 100000);//总金额进去冻结金额一千元等于余额
    	$data['balance'] = sprintf("%.2f",$balance /10 / 10 );//余额 
    	$this->assign('data',$data);
    	$this->display();
    }


    //提现
    public function withdrawal()
    {
       
    	$this->display();
    }


    //充值
    public function topup()
    {
    	$this->display();
    }



    //支付宝充值
    public function alipaywap()
    {
        if(IS_POST){
            require_once("/ThinkPHP/Library/Org/alipaywap/alipay.config.php");
            require_once("/ThinkPHP/Library/Org/alipaywap/lib/alipay_submit.class.php");
                //商户订单号，商户网站订单系统中唯一订单号，必填
                $out_trade_no = date('YmdHis',time()).mt_rand(1111,9999);
                //订单名称，必填
                $subject = '账户充值';
                //付款金额，必填
                if(!(is_numeric($_POST['money']) && $_POST['money'] > 0)){$this->error('金额不合法!');}
                $total_fee = $_POST['money'];
                //收银台页面上，商品展示的超链接，必填
                $show_url = $_POST['WIDshow_url'];
                //商品描述，可空
                $body = '账户充值 金额：'.sprintf("%.2f",$_POST['money']);

                /************************************************************/
                //构造要请求的参数数组，无需改动
                $parameter = array(
                        "service"       => $alipay_config['service'],
                        "partner"       => $alipay_config['partner'],
                        "seller_id"  => $alipay_config['seller_id'],
                        "payment_type"  => $alipay_config['payment_type'],
                        "notify_url"    => $alipay_config['notify_url'],
                        "return_url"    => $alipay_config['return_url'],
                        "_input_charset"    => trim(strtolower($alipay_config['input_charset'])),
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
                $data['agent_id']  = session('AgentUser');//代理商id
                if(M('topup')->add($data)){
                    //建立请求
                    $alipaySubmit = new \AlipaySubmit($alipay_config);
                    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
                    echo $html_text;
                }else{

                    echo "<script>alert('订单创建失败!');window.history.back();</script>";
                }



                

            // $this->display();

        }
    }


    //处理充值结果
    public function updatetopup($order,$order_sn,$res)
    {
       return M('topup')->where(array('order'=>$order))->save(array('res'=>$res,'order_sn'=>$order_sn));
    }
    

    //服务器异步通知页面
    public function notify_url()
    {

                        require_once("/ThinkPHP/Library/Org/alipaywap/alipay.config.php");
                        require_once("/ThinkPHP/Library/Org/alipaywap/lib/alipay_submit.class.php");

                        //计算得出通知验证结果
                        $alipayNotify = new \AlipayNotify($alipay_config);
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
                                $this->updatetopup($out_trade_no,$trade_no,$trade_status);
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
                                $this->updatetopup($out_trade_no,$trade_no,$trade_status);

                            }

                            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                                $str = '';
                                foreach($_POST as $v){
                                    $str .= $v;
                                }
                                file_put_contents('./pay.txt', $str);
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
    public function return_url()
    {
        
    }





    
}