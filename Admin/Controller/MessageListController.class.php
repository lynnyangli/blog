<?php
namespace Admin\Controller;
use Think\Controller;
class MessageListController extends Controller {
    public function index()
    {
	
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	$this->assign("act",1);
    	$this->assign("sum",$this->getsum());
    	$this->assign("messages_date",$this->getdata(1));
    	$this->display();
	}
	public function domessagelist()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }

         if(I("get.state")=="show")
         {
            if(!I("get.id")){
                return;
            }
            $id=I("get.id");
            $sum=$this->getsum();
            $data=$this->getdata($id);
            $act=$id;
            $this->assign("act",$act);
            $this->assign("messages_date",$this->getdata($id));
            $this->assign("APP_PATH",C("APP_PATH"));
            $this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
            $this->assign("sum",$sum);
            $this->display("index");
        }else 
        if(I("get.state")=="reply"){
            if(!I("get.id")){
                $this->error("获取相关信息错误");
                return false;
            }
            $messages_db=D("messages");
            $data['state']=1;
            $id=I("get.id");
            $messages_db->where("id=".$id)->save($data);
            $email=$messages_db->where('id='.$id)->getField('email');
            $this->success("进入回复",C("APP_PATH")."/index.php/Admin/ReplyMessage/index/email/$email",0);
           
        }else
        if(I("get.state")=="dele")
        {
            
            $id=I("get.id");
            
            $product_db=D("messages");
            if($product_db==null)
            {
                return false;
            }
            if(!$product_db->where("id=".$id)->delete())
            {
                $this->error("删除失败");
            }else{
            	$this->success("删除成功");
            }
        }else{
        $this->error("非法操作");
        }
    }
	private function getdata($i)
    {
        $messages_db=D("messages");
        if($messages_db==null)
        {
            return false;
        }
        $count=$messages_db->count();
        $data=$messages_db->page($i,15)->select();
        foreach ($data as $key => $value) {
            $data[$key]['email']= base64_decode($value['email']);
            if((int)$value['state']==0){ 
            	$data[$key]["state"]='未回复';
            }elseif((int)$value['state']==1){
                $data[$key]["state"]='已回复';
            }
            $data[$key]['des']=base64_decode($value['des']);
            $data[$key]["time"]=date("y-m-d-G:i",$value['time']);
        }
        return $data;
    }
	private function getsum()
    {
        $messages_db=D("messages");
        if($messages_db==null)
        {
            return false;
        }
        $count=$messages_db->count();
        $sum=$count/15;
        if(!($cont%15))
        {
            $sum++;
        }
        return $sum;
    }
	//登陆判定
	private function check_login()
	{
		if(session("ADMIN_NAME")&&  session("ADMIN_PASSWORD")&&  session("ADMIN_GRADE")){
			return true;
		}
		return false;
	}

}
