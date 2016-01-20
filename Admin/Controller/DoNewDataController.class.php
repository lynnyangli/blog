<?php
namespace Home\Controller;
use Think\Controller;
class DoNewDataController extends Controller {
	public function index()
	{
		if(!$this->check_login()){
                	$this->error("请登陆","/index.php/Admin/AdminLogin");
        	}
		$GRADE = "1.3.2";
		if(!$this->check_login()){
			$this->error("请登陆","/".C("APP_NAME")."/index.php/Home/AdminLogin");
		}
		//权限校验
		if(!$this->check_grade($GRADE,session("ADMIN_GRADE"))){
			$this->error("权限不足");
		}
		header("content-type:text/html;charset=utf-8");
		$data=$this->getdata();
		if($data){
			if($this->savedata($data)){		//保存数据
				$this->success("成功激活");
			}else{
				$this->error("错误操作");
			}
		}
		
	}
	//接收提交的数据
	private function getdata()
	{
		$data=array();
		$data["passport_number"]=I("post.passport_number");	//接受护照号
		
		if(!$this->check_passport($data['passport_number']))	//校验护照
		{
			$this->error("无效护照号");
			return false;
		}
		
		$data["family_name"]=I("post.family_name");	//接收用户姓
		$data["given_name"]=  I("post.given_name");	//接收用户名
		$data ["phone"]=I("post.phone");	//接收电话号码
		$data ["sex"]=  intval(I("post.sex"));	//接收性别,0为男,1为女,且数据库存储为布尔型;
		$data["birth_time"]= strtotime(I("post.birth_time"));		//接收出生日期,将出生日期转化为uinx时间戳
		$data["mail_addr"]=  I("post.mail_addr");	//接收邮寄地址,,并对其编码
		$data['login_time']=time();		//注册时间为当前时间
		$data["print_state"]=false;		//打印状态为未打印
		$data["qrcode_state"]=false;	//二维码状态
		//
		//接收头像图片
		$image = new \Think\Image();	//实例化图片处理类
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		 $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath  = '/head_img/'; // 设置附件上传目录
		
		$info   =   $upload->uploadOne($_FILES['head_img']);
		if(!$info) {
			
			$this->error($upload->getError());		// 上传错误提示错误信息
		}else{
			//对头像进行压缩
			$image->open(C("APP_PATH")."/Uploads".$info['savepath'].$info['savename']);
			unlink(C("APP_PATH")."/Uploads".$info['savepath'].$info['savename']);
			//生成一个固定大小为150*150的缩略图并保存
			$image->thumb(50, 50,\Think\Image::IMAGE_THUMB_FIXED)->save(C("APP_PATH")."/Uploads".$info['savepath'].$info['savename']);
			$data['head_img']=$info['savepath'].$info['savename'];
		}
		//接收背景图片
		$upload1 = new \Think\Upload();// 实例化上传类
		$upload1->maxSize   =     3145728 ;// 设置附件上传大小
		 $upload1->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload1->savePath  = '/qrcode_background_img/'; // 设置附件上传目录
		$info   =   $upload1->uploadOne($_FILES['rqrcode_background_img']);
		if(!$info) {
			echo "nam";
			$this->error($upload1->getError());		// 上传错误提示错误信息
		}else{
			$image->open(C("APP_PATH")."/Uploads".$info['savepath'].$info['savename']);
			unlink(C("APP_PATH")."/Uploads".$info['savepath'].$info['savename']);
			//生成一个固定大小为150*150的缩略图并保存
			$image->thumb(50, 50,\Think\Image::IMAGE_THUMB_FIXED)->save(C("APP_PATH")."/Uploads".$info['savepath'].$info['savename']);
			$data['qrcode_background_img']=$info['savepath'].$info['savename'];
		}
		//检查数据是否有空
		//var_dump($data);
		foreach ($data as $key => $value) {
			if(!isset($value)){
				$this->error("数据不可为空");
				return false;
			}
		}
		return $data;
	}
	//将提交的数据保存到数据库
	private function savedata($data)
	{
		$data_passport=array();substr(md5("admin"),8,16);
		
		$data['number']=substr(md5($data["given_name"].$data['phone'].$data['given_name'].time().$data["passport_number"]),8,16);	//md5对用户信息进行加密,生成唯一标示码
		
		//护照需要跟新的数据
		$data_passport["user_number"]=$data['number'];		//用户标示码up
		$data_passport['number']=$data['passport_number'];
		$data_passport['activite_time']=(string)time();	//激活时间
		$data_passport['activate']=1;	//激活状态
		
		$user= D("user"); // 实例化user对象
		$passport= D("passport"); // 实例化passport对象
		
		
		
		 $info_1=$user->add($data);	//保存用户信息
		 $info_2=$passport->save($data_passport);//跟新护照信息
		 if( $info_1){
			if($info_2){
				return  true;
			}else{
				return false;
			}
		 }else{
			return false;
		}
		return false;
	}
	//校验护照的有效性
	private function check_passport($number)
	{
		$passport= D("passport"); // 实例化passport对象
		 $number_t = $passport->where('number='."'".$number."'")->getField('number');	//得到护照编号
		 $state = $passport->where('number='."'".$number."'")->getField('activate');		//得到护照激活状态
		if(($number_t==$number)&&($state==false))		//校验护照号是否存在及是否已被激活
		{
			return true;
		}else{
			return false;
		}
	 }
   //权限判定
	private function check_grade($number,$grade)
	{
		$admin_grade_db = D("admin_grade");
		if(!$admin_grade_db){
			return false;
		}else{
			$res = $admin_grade_db->where("number='".$number."'")->getField("grade");
			if(!$res){
				return false;
			}
			$arr = explode("@", $res);
			foreach ($arr as $key => $value)
			{
				if($value == $grade){
					return true;
				}
			}
		}
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
