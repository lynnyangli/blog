<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {
    	$this->assign('PUBLIC_PATH',C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
        $this->assign("CLASS",$this->get_class());
        $this->assign("ARTICLES",$this->get_article_data(1));
        $this->assign("ACT_CLASS",1);
        $this->assign("READ_RANK",$this->get_read_rank());
        $this->assign("LINK_DATA",$this->get_link_data());
    	$this->display();
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
      private function get_article_data($page)
    {
		$articles_db=D("articles");
                if($articles_db==null)
                {
                    return false;
                }
                $data=$articles_db->page($page,5)->order('id desc')->select();
                foreach ($data as $key => $value) {
                        $data[$key]['title']=base64_decode($value['title']);
                        $data[$key]['class']=base64_decode($value['class']);
                        $data[$key]['time']=date('Y-m-d',$value['time']);
                        $data[$key]["description"] = base64_decode($value['description']);
                }
                return $data;
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
    private function get_read_rank()
    {
        $articles_db=D("articles");
        if($articles_db==null)
        {
            return false;
        }
        $data = $articles_db->order("read_sum desc")->limit(6)->field("id,title,read_sum")->select();
        
        foreach($data as $key=>$value){
            $data[$key]['title'] = base64_decode($value['title']);
        }
        return $data;
    }
}
