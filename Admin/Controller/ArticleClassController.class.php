<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleClassController extends Controller {
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
            $data[$key]['sum']=$this->get_sum($value['name']);
            $data[$key]['des']= base64_decode($value['des']);
        }
        return $data;
	}
	private function get_sum($name)
	{
		$articles_db=D("articles");
        if($articles_db==null)
        {
            return false;
        }
        $sum=$articles_db->where('class='.'"'.$name.'"')->count();
        return $sum;
	}
	public function doarticleclass()
	{
		if(I("get.state")=="add")
		{
			if(I("post.name")==''||I("post.des")==''){
				$this->error("数据不可为空"); 
			}else{
				$data['name']=base64_encode(I("post.name"));
				$data['des']=base64_encode(I("post.des"));
				$class_db=D("class");
        		if($class_db==null)
        		{
            		return false;
       			}
				if($class_db->add($data)){
					$this->success("保存成功");
				}else{
					$this->error("保存失败");
				}
			}
		}elseif(I("get.state")=="dele")
		{
			if(I("get.id")=='')
			{
				$this->error("数据不可为空"); 
			}else
			{
				$id=I("get.id");
				$class_db=D("class");
				if($class_db->where('id='.$id)->delete())
				{
					$this->success("删除成功");
				}else{
					$this->error("删除失败");
				}
			} 
		}else
		{
			$this->error("非法操作");
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
