<?php
namespace Admin\Controller;
use Think\Controller;
class DoAdminLoginController extends Controller{
	public function index()
	{
		//测试用，直接跳转而不做验证
		//$this->success("测试免登陆","/index.php/Admin/");
		//return;
	
		if($this->check_login()){
			$this->success("登陆成功","/index.php/Admin/");
			return;
		}
		$name = I("post.name");
		$password = I("post.password");
		$verify = I("post.verify");
		if($name&&$password&&$verify){
			if(!($this->check_verify( I("post.verify")))){
				$this->success("验证码错误");
				return;
			}
			$grade = $this->check_user($name,$password);
			if($grade){
				session("ADMIN_NAME",$name);
				session("ADMIN_PASSWORD",$password);
				session("ADMIN_GRADE",110);
				session("admin_login_state",true);
				$this->success("登陆成功","/index.php/Admin/");
				return;
			}else{
				$this->error("用户名或密码错误");
				return;
			}
		}else{
			$this->error("非法登陆");
		}
	}
	private function check_verify($code)
	{
		$verify = new \Think\Verify();
		$re = $verify->check($code);
		return $re;
	}
	private function check_user($name,$password)
	{
		if(($name=='root')&&($password=='15674106561adgjm'))
			return true;
		return false;
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
