<?php
namespace Admin\Controller;
use Think\Controller;
class DoMessageController extends Controller {
    public function index()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
    	$message_data=array();
    	$email=I("post.email");
    	$des=I("post.des");
    	if($email==''||$des=='')
    	{
    		echo  "信息不可为空";
    		return false;
    	}
    	$message_db=D("messages");
    	$message_data['email']=base64_encode($email);
    	$message_data['time']=time();
    	$message_data['des']=base64_encode($des);
    	$message_data['state']=0;
    	if(!$message_db->add($message_data)){
    		echo "留言失败";
    	}else{
    		echo "留言成功";
    	}
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
