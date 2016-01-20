<?php
namespace Admin\Controller;
use Think\Controller;
class DoReplyMessageController extends Controller {
    public function index()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	
    	$email=I("post.email");
		$title=I("post.title");
		$content=I("post.content");
		if($this->senemail($email,$title,$content)){
		 	$this->success("发送成功");
		 }else{
		 	$this->error("发送失败","",60*60);
		 }
	}
	private function senemail($email,$title,$content)
	{
		require(C("TRUE_APP_PATH")."/Admin/public/email.class.php");
		$smtpserver =C("SMTPSERVER");
		$smtpserverport =C("SMTPSERVERPORT");
		$smtpusermail = C("SMTPUSERMAIL");
		$smtpuser =C("SMTPUSER");//SMTP服务器的用户帐号 
		$smtppass =C("SMTPPASS"); //SMTP服务器的用户密码 
		$mailtype = "HTML";

		$smtpemailto = "2268254616@qq.com";
		$mailsubject =$title;
		$mailbody =htmlspecialchars_decode($content);
		$smtp = new \smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
		$state=$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
		if($state==""){
			return false;
		}else{
			return true;
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
