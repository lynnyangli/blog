<?php
namespace Home\Controller;
use Think\Controller;
class HomeGetMoreController extends \Think\Controller{
    function index()
    {
        $title = '';
        $time = '';
        $description = '';
        $str = '';
        
        $page = I("get.page");
        $data = $this->get_article_data($page);
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
}


