<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleListController extends Controller {
    public function index()
    {
	if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	$this->assign("CLASS_ACT",0);
    	$this->assign("CLASS_DATA",$this->get_class_data());
    	$this->assign("ARTICLE_DATA",$this->get_article_data(base64_encode($this->get_class_data()[0]['name']),1));
    	$this->display();
	}
	public function doarticlelist()
	{
		if(!$this->check_login()){
                $this->error("请登陆","/index.php/Admin/AdminLogin");
        }
		if(I("get.state")=="showclass")
		{
			$class=I("get.class");
			$this->assign("CLASS_ACT",I("get.key"));
			$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    		$this->assign("APP_PATH",C("APP_PATH"));
    		$this->assign("CLASS_DATA",$this->get_class_data());
    		$this->assign("ARTICLE_DATA",$this->get_article_data(base64_encode($class),1));
    		$this->display("index");
		}else if(I("get.state")=="dele")
		{
			if(I("get.id")==''){
				$this->error("获取信息失败");
			}
			$id=I("get.id");
			$articles_db=D("articles");
			unlink($articles_db->where('id='.$id)->getField('addr'));
			if($articles_db->where('id='.$id)->delete())
			{
				$this->success("删除成功");
			}else{
				$this->error("删除失败","",12);
			}
		}
		else{
			$this->error("非法操作");
		}
	}
	private function get_article_data($class_name,$page)
	{
		$articles_db=D("articles");
                if($articles_db==null)
                {
                    return false;
                }
                $data=$articles_db->where("class=".'"'.$class_name.'"')->page($page,15)->order('id desc')->select();
                foreach ($data as $key => $value) {
                        $data[$key]['title']=base64_decode($value['title']);
                        $data[$key]['class']=base64_decode($value['class']);
                        $data[$key]['time']=date('Y-m-d',$value['time']);
                }
                return $data;
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
        }
        return $data;
	}
	public function doarticleclass()
	{
		if(!$this->check_login()){
                	$this->error("请登陆","/index.php/Admin/AdminLogin");
        	}
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
