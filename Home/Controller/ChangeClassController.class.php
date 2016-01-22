<?php
namespace Home\Controller;
use Think\Controller;
class ChangeClassController extends Controller{
    function index()
    {
        $class = I("get.class");
	$class_title = $this->getClassTitle($class);
	$this->assign("CLASS_TITLE",$class_title);
        $this->assign("CLASS",$class);
        $class = base64_encode($class);
        $data = $this->get_article_data($class, 1);
        $this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
        $this->assign("ARTICLES",$data);
        $this->assign("CLASS_LIST",$this->get_Class());
        $this->assign("READ_RANK",$this->get_read_rank($class));
	$this->assign("LINK_DATA",$this->get_link_data());
        $this->display();
    }
    private function get_article_data($class,$page)
    {
		$articles_db=D("articles");
                if($articles_db==null)
                {
                    return false;
                }
                $data=$articles_db->page($page,5)->where("class='$class'")->order('id desc')->select();
                foreach ($data as $key => $value) {
                        $data[$key]['title']=base64_decode($value['title']);
                        $data[$key]['class']=base64_decode($value['class']);
			$data[$key]['C']= mb_substr($data[$key]['class'],0,1,"utf-8");
                        $data[$key]['time']=date('Y-m-d',$value['time']);
			$data[$key]['T_time']=date('m-d',$value['time']);
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
    private function getClassTitle($class)
    {
	$class =base64_encode($class);
        $class_db = D("class");
        $data = $class_db->where("name='$class'")->find();
	if(empty($data)){
            return false;
        }else{
            return base64_decode($data['des']);
        }
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
     private function get_read_rank($class)
    {
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
    public function getMore()
    {
        $class = I("get.class");
        $page = I("get.page");
        $str = '';
        $data = $this->get_article_data($class,$page);
        foreach($data as $key=>$val){
            $tltle = $val['title'];
            $time = $val['time'];
            $description = $val['description'];
            $str = $str.'<div class="doment" >
                    <div class="doment-head">
                        <a><h3>'.$val['title'].'<small>&emsp;'.$val['time'].'</small></h3></a>
                    </div>
                    <div class="domemt-body">
                        <p>&emsp;&emsp;'.$val['description'].'</p>
                        <div class="doment-bottom">
                            <span class="glyphicon glyphicon-search" aria-hidden="true">阅读15</span>&emsp;
                            <span class="gglyphicon glyphicon-pencil" aria-hidden="true">评论15</span>&emsp;
                        </div>
                     </div>
                </div>';
        }
        echo $str;
    }
}

