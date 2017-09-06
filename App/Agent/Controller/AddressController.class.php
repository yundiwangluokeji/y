<?php
namespace Agent\Controller;
class AddressController extends PublicController 
{
    public function index()
    {
    	// $data = M('brand')->order('sorting')->select();
    	// $this->assign('data',$data);
        $data = M('address')->where(array('agent_id'=>session('AgentUser')))->select();
        $area = M('area')->getField('id,name',true);
        $this->assign('area',$area);
        $this->assign('data',$data);
    	$this->display();
    }


    //添加地址
    public function address()
    {
            $address = M('address');
        if(IS_AJAX){
            // $data = $area->create($_POST,1);//根据表单提交的POST数据创建数据对象
            // if(!$data){$this->ajaxReturn(array('res'=>0,'msg'=>$area->getError()));}
            $data['name'] = I('name');
            $data['agent_id'] = session('AgentUser');
            $data['mobile'] = I('mobile');
            $data['province'] = I('province');
            $data['city'] = I('city');
            $data['district'] = I('district');
            $data['twon'] = I('twon');
            $data['address'] = I('address');
            if(I('addressid')){
                $data['id'] = I('addressid');
                $res = $address->save($data);
                $msg = '更新';
            }else{
                $data['time'] = time();
                $res = $address->add($data);
                $msg = '添加';
                
            }

            if($res){
                $this->ajaxReturn(array('res'=>1,'msg'=>$msg.'成功'));
            }else{
                $this->ajaxReturn(array('res'=>0,'msg'=>$msg.'失败!'));
            }


    	}else{
            $area = M('area');
    		//查询省级
    		$data = $area->field('id,name')->where(array('level'=>1))->select();
            if(I('addressid')){
                $address = $address->where(array('agent_id'=>session('AgentUser'),'id'=>I('addressid')))->find();
                $address['city_'] = $area->field('id,name')->where(array('parent_id'=>$address['province']))->select();//市
                $address['district_'] = $area->field('id,name')->where(array('parent_id'=>$address['city']))->select();//市
                $address['twon_'] = $area->field('id,name')->where(array('parent_id'=>$address['district']))->select();//市
                // echo '<pre>';
                // print_r($address);exit;
                $this->assign('address',$address);

            }
    		$this->assign('data',$data);
	    	$this->display();
    	}
    }

    //筛选下级地址
    public function lower()
    {
    	if(IS_AJAX){
    		$where['parent_id']  = I('id');
    		$data = M('area')->field('id,name')->where($where)->select();
    		if($data){
    			$this->ajaxReturn($data);
    			
    		}
    	}

    }


    //设为默认
    public function setdefault()
    {

        $addressid = I('addressid');

        //首先将自己的所有地址默认值设置为0
        $res = M('address')->where(array('agent_id'=>session('AgentUser'),'is_default'=>1))->save(array('is_default'=>0));
            $res2 = M('address')->where(array('agent_id'=>session('AgentUser'),'id'=>$addressid))->save(array('is_default'=>1));
            if($res2){
                $this->ajaxReturn(array('res'=>1,'msg'=>'设置成功'));
            }

                $this->ajaxReturn(array('res'=>0,'msg'=>'设置失败！'));
    }


    //删除地址
    public function delete()
    {
        $res = M('address')->where(array('id'=>I('addressid'),'agent_id'=>session('AgentUser')))->delete();
        if($res){
                $this->ajaxReturn(array('res'=>1,'msg'=>'删除成功!'));

            }else{
                $this->ajaxReturn(array('res'=>0,'msg'=>'删除失败！'));

            }

    }


    
}