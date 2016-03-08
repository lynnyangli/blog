<?php
namespace Home\Controller;

use Think\Controller;

class GetMoreController extends Controller
{
    function index()
    {   header('content-type:text/html;charset=utf-8');
        $class = I('post.class');
        $page = I('post.page');
        if(!$class && !$page){
            echo 'false';
        }else {
            $data = $this->getData($class, $page);
            if ($data) {
                echo json_encode($data);
            } else if ($data === null) {
                echo 'null';
            }else {
                echo 'false';
            }
        }
    }

    private function getData($class, $page)
    {
        $LIMIT = 5;
        if($class == 'HOME'){
            if (!($articles_db = D('articles'))) {
                return false;
            } else {
                $res = $articles_db->page("$page,$LIMIT")->order('time desc')->select();
                if ($res) {
                    $data = $this->formateData($res);
                } else {
                    return null;
                }
            }
        }else {
            $class = $class = base64_encode($class);
            $class_db = D('class');
            $res = $class_db->where("name='%s'", $class)->getField('name');
            if ($res == $class) {
                unset($res);
                if (!($articles_db = D('articles'))) {
                    return false;
                } else {
                    $res = $articles_db->where('class ="%s"', $class)->page("$page,$LIMIT")->order('time desc')->select();
                    if ($res) {
                        $data = $this->formateData($res);
                    } else {
                        return null;
                    }
                }
            }
        }
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    //格式化数据
    private function formateData($res)
    {
        foreach ($res as $key=>$value) {
            $data[$key]["id"] = $value['id'];
            $data[$key]["color"] = session('class_color')[$value['class']];
            $data[$key]["title"] = base64_decode($value['title']);
            $data[$key]["class"] = base64_decode($value['class']);
            $data[$key]["time"] = date('Y-m-d',$value['time']);
            $data[$key]["description"] = base64_decode($value['description']);
            $data[$key]["read_sum"] = $value['read_sum'];
            $data[$key]["comment_sum"] = $value['comment_sum'];
        }
        return $data;
    }
}