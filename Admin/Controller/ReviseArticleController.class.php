<?php
namespace Admin\Controller;

use Think\Controller;

class ReviseArticleController extends Controller
{
    public function index()
    {
        $this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
        $this->assign("CLASS_DATA",$this->getClassData());

        $article_data = $this->getArticle(24);

        $description = $article_data['description'];
        $addr = $article_data['addr'];

        if(is_file($addr)){
            $content = file_get_contents($addr);
        }
        $this->assign("DESCRIPTION",base64_decode($description));
        $this->assign("CONTENT",$content);

        $this->display();
    }
    private function getArticle($article_id)
    {
        if(empty($article_id)){
            return fasle;
        }

        $db_articles = M('articles');
        if($db_articles){
            $res = $db_articles->getField('id,description,addr');
            if($res){
                return $res[$article_id];
            }
        }else{
            return false;
        }
    }

    //获取分类
    private function getClassData()
    {
        $class_data=array();
        $class_db=D("class");
        if($class_db==null)
        {
            return false;
        }
        $data=$class_db->getField("id,name");
        foreach ($data as $key => $value){
            $class_data[$key]= base64_decode($value);
        }
        return $class_data;
    }
}