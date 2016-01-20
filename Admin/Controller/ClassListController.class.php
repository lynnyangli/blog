<?php
namespace Admin\Controller;
use Think\Controller;
class ClassListController extends Controller {
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
	$class_db=D("class");
        if($class_db==null)
        {
            return false;
        }
        $data=$class_db->select();
        foreach ($data as $key => $value) {
            $data[$key]['name']= base64_decode($value['name']);
            $data[$key]['des']=base64_decode($value['des']);
            $data[$key]["max"]=$value['max'];
        }
        return $data;
    }
    private function savedata($data)
    {
	$json_str=json_encode($data);
	$fp=fopen(C("TRUE_APP_PATH")."/Admin/Conf/class.json",'w');
	fwrite($fp,$json_str);
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
