<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {
	//登陆验证
	if(!$this->check_login()){
		$this->error("请登陆","/index.php/Admin/AdminLogin");
	}
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	$this->display();
    }
	private function check_login()
	{
		if(session("ADMIN_NAME")&&  session("ADMIN_PASSWORD")&&  session("ADMIN_GRADE")){
			return true;
		}
		return false;
	}
}
