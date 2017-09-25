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
        if(IS_POST){
            M()->startTrans();
            $model = M('withdrawal');
            $_POST['agent_id']  = session('AgentUser');
            $data = $model->create($_POST,1);//根据表单提交的POST数据创建数据对象
           if(!$data){$erroer = $model->getError(); $this->error($erroer);}
           $data['time'] = time();
            $res = $model->add($data);
            //扣除货币
            $amount = $data['amount'] * 10 * 10;//扣除金额
            $res2 = M('money')->where(array('agent_id'=>session('AgentUser')))->setDec('money',$amount);
            if($res2){
                //日志
                $money_id = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('id');//查询钱包id
                $data3['operation'] = session('AgentUser');
                $data3['agent_id'] = session('AgentUser');
                $data3['money_id'] = $money_id;
                $data3['money'] = $amount;
                $data3['ip'] = $_SERVER['REMOTE_ADDR'];
                $data3['address'] = getip($_SERVER['REMOTE_ADDR']);
                $data3['type'] = 0;
                $data3['msg'] = $data['name'].'提现';
                $data3['time'] = time();
                $res3 = M('money_log')->add($data3);
            } 

            if($res && $res2 && $res3){
                M()->commit();
                $this->success('提现申请提交成功！等待打款',U('Index/index'));
            }else{
                 M()->rollback();
                 $this->error('提现申请提交失败!');
            }

        }else{
            $money = M('money')->where(array('agent_id'=>$this->config['agent_id']))->find();
            //可用余额e
            $balance = ($money['money'] - 100000) <= 0?0:($money['money'] - 100000);//总金额进去冻结金额一千元等于余额
            $balance = sprintf("%.2f",$balance /10 / 10 );//余额 
            $this->assign('balance',$balance);
            $this->display();
        }
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
            require_once("./ThinkPHP/Library/Org/alipaywap/alipay.config.php");
            require_once("./ThinkPHP/Library/Org/alipaywap/lib/alipay_submit.class.php");
                //商户订单号，商户网站订单系统中唯一订单号，必填
                $out_trade_no = date('YmdHis',time()).mt_rand(1111,9999);
                //订单名称，必填
                $subject = '账户充值';
                //付款金额，必填
                if(!(is_numeric($_POST['money']) && $_POST['money'] > 0)){$this->error('金额不合法!');}
                $total_fee = $_POST['money'];
                //收银台页面上，商品展示的超链接，必填
                $show_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].U('index');
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
    public function updatetopup($order,$order_sn,$res,$price)
    {
        //日志记录
        $money_id = M('money')->where(array('agent_id'=>session('AgentUser')))->getField('id');//查询钱包id
        $data['operation'] = session('AgentUser');//操作者
        $data['agent_id'] = session('AgentUser');//被操作者
        $data['money_id'] = $money_id;//钱包id
        $data['money'] = $price * 10 * 10;//充值金额
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['address'] = getip($_SERVER['REMOTE_ADDR']);
        $data['res'] = $res;
        $data['type'] = 1;
        $data['msg'] = '账户充值-支付宝';
        $data['time']  = time();
        $res2 = M('money_log')->add($data);
        //订单状态修改
       $res3 = M('topup')->where(array('order'=>$order))->save(array('res'=>$res,'order_sn'=>$order_sn));

        //充值成功后给用户增加货币
        if($res == 1){
            $res1 = M('money')->where(array('agent_id'=>session('AgentUser')))->setInc('money',$price * 10 * 10);
        }
    }
    

    //服务器异步通知页面
    public function notifyurl()
    {
                        require_once("./ThinkPHP/Library/Org/alipaywap/alipay.config.php");
                        require_once("./ThinkPHP/Library/Org/alipaywap/lib/alipay_notify.class.php");

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
                                 //查询此订单是否处理过
                                    $order_res = M('topup')->where(array('order'=>$out_trade_no,'res'=>0))->find();
                                    if($order_res){
                                        $this->updatetopup($out_trade_no,$trade_no,1,$_GET['total_fee']);//改变订单状态
                                    }else{

                                        $msg = '此订单已经处理过了!';
                                    }
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
                                    $order_res = M('topup')->where(array('order'=>$out_trade_no,'res'=>0))->find();
                                    if($order_res){
                                        $this->updatetopup($out_trade_no,$trade_no,1,$_GET['total_fee']);//改变订单状态
                                    }else{

                                        $msg = '此订单已经处理过了!';
                                    }

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
                        require_once("./ThinkPHP/Library/Org/alipaywap/alipay.config.php");
                        require_once("./ThinkPHP/Library/Org/alipaywap/lib/alipay_notify.class.php");
        //计算得出通知验证结果
            $alipayNotify = new \AlipayNotify($alipay_config);
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
                        $order_res = M('topup')->where(array('order'=>$out_trade_no,'res'=>0))->find();
                        if($order_res){
                            $this->updatetopup($out_trade_no,$trade_no,1,$_GET['total_fee']);//改变订单状态
                            $msg = '支付成功!';
                        }else{

                            $msg = '支付成功!';
                        }

                }
                else {
                     //查询此订单是否处理过
                        $order_res = M('topup')->where(array('order'=>$out_trade_no,'res'=>0))->find();
                      if($order_res){
                            $this->updatetopup($out_trade_no,$trade_no,2,$_GET['total_fee']);//改变订单状态
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





    
}