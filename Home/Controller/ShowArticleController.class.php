<?php
namespace Home\Controller;
use Think\Controller;
class ShowArticleController extends Controller{
    function index()
    {
        $this->assign('PUBLIC_PATH',C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
        $class = $this->get_class();
        $this->assign("CLASS",$class);
        $this->assign("LINK_DATA",$this->get_link_data());
        $id = I("get.id");
        
        
        $data = $this->get_article_data($id);
        $this->assign("READ_RANK",$this->get_read_rank($data['class']));
        $this->assign("DATA",$data);
        $this->display();
    }
    private function get_link_data()
    {
        $link_db=D("friend_link");
        if($link_db==null)
        {
            return false;
        }
        $data = $link_db->select();
        return $data;
    }
    private function get_article_data($id)
    {
		$articles_db=D("articles");
                if($articles_db==null)
                {
                    return false;
                }
                $data=$articles_db->where("id=$id")->find();
                
                        $data['title']=base64_decode($data['title']);
                        $data['class']=base64_decode($data['class']);
                        $data['time']=date('Y-m-d',$data['time']);
                        $data["description"] = base64_decode($data['description']);
                        $data['content'] = file_get_contents($data["addr"]);
                
                $updata_read['id'] = $id;
                $updata_read['read_sum'] = intval($data['read_sum']);
                $updata_read['read_sum']++;
                
                $articles_db->save($updata_read);
                
                return $data;
    }
    private function get_read_rank($class)
    {
        $class = base64_encode($class);
        $articles_db=D("articles");
        if($articles_db==null)
        {
            return false;
        }
        $data = $articles_db->where("class='$class'")->order("read_sum desc")->limit(6)->field("id,title,read_sum")->select();
        
        foreach($data as $key=>$value){
            $data[$key]['title'] = base64_decode($value['title']);
        }
        return $data;
    }
     private function get_class()
    {
        $class_db = D("class");
        $data = $class_db->select();
        foreach($data as $key=>$value)
        {
            $data_arr[] = base64_decode($value["name"]);
        }
        
        return $data_arr;
    }
}
