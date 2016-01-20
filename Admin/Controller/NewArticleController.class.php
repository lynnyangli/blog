<?php
namespace Admin\Controller;
use Think\Controller;
class NewArticleController extends Controller {
    public function index()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }	
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	$this->assign("CLASS_DATA",$this->get_class_data());
    	$this->display();
    }
    private function get_class_data()
    {
	$class_data=array();
	$class_db=D("class");
        if($class_db==null)
        {
            return false;
        }
        $data=$class_db->getField("id,name");
        foreach ($data as $key => $value){
            $class_data[$key]= base64_decode($value);
        }
        return $class_data;
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
