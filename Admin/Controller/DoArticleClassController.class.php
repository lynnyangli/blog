<?php
namespace Admin\Controller;
use Think\Controller;
class DoArticleClassController extends Controller {
    //删除操作
    public function delete()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
        if(I("get.id")==='')
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
    }
    public function newclass()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
        if(I("post.name")&&I("post.des"))
        {
            $data["name"] = base64_encode( I("post.name") );
            $data["des"] = base64_encode( I("post.des") );
            $class_db = D("class");
            if($class_db->add($data))
            {
		$this->success("添加成功");
            }else{
		$this->error("添加失败");
            }
        }else{
            $this->error("数据不可为空");
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
