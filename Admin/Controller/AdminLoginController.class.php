<?php
namespace Admin\Controller;
use Think\Controller;
class AdminLoginController extends Controller{
	public function index()
	{
		if($this->check_login()){
			$this->success("已登陆",C("APP_NAME")."/index.php/Home");
		}
		$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
		$this->display();
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
