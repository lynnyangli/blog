<?php
namespace Admin\Controller;
use Think\Controller;
class FriendLinkListController extends Controller {
    public function index()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	$this->assign("LINK_DATA",$this->get_link_data());
    	$this->display();
    }
	private function get_link_data()
	{
		$link_db=D("friend_link");
        	if($link_db==null)
        	{
            		return false;
        	}
        	$data=$link_db->select();
        	return $data;
	}
	public function addlink()
	{
		if(!$this->check_login()){
                	$this->error("请登陆","/index.php/Admin/AdminLogin");
        	}
		if(I("post.name")&&I("post.des")&&I("post.link")){
			$data['name'] = I("post.name");
			$data['des'] = I("post.des");
			$data['link'] = I("post.link");
			$link_db=D("friend_link");
        		if($link_db==null)
        		{
            			return false;
       			}
			if($link_db->add($data)){
				$this->success("保存成功");
			}else{
				$this->error("保存失败");
			}
		}
		else{	
			$this->error("数据不可为空"); 
		}
	}
	public function delelink()
	{
		if(!$this->check_login()){
                	$this->error("请登陆","/index.php/Admin/AdminLogin");
        	}	
		
		$id=I("get.id");
		if(!empty($id)){
			$link_db=D("friend_link");
			if($link_db->where('id='.$id)->delete())
			{
				$this->success("删除成功");
			}else{
				$this->error("删除失败");
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
