<?php
namespace Admin\Controller;
use Think\Controller;
class ExitController extends Controller{
	public function direct()
	{
		
		$admin_user_db = D("admin_user");
		$data['login_state'] =false;
		$data["session_id"] = session_id();
		$data['last_time'] = (int)time();
		if($admin_user_db->where("name='".session("ADMIN_NAME")."'AND password='".  md5(session("ADMIN_PASSWORD"))."'")->save($data)){
			return true;
		}
		session(null); 
		session('[destroy]'); 
		echo '<script>window.close();</script>'; 
	}
	public function rm()
	{
		session(null); 
		session('[destroy]'); 
		$this->error("请登陆","/index.php/Admin/AdminLogin");
	}
}
