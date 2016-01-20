<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index()
    {
    	$this->assign('PUBLIC_PATH',C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
        $this->assign("DOCMENT",$this->getArticle(6));
    	$this->display();
    }
    private function getArticle($id)
    {
        $article_db = D("articles");
        $docment_addr = $article_db->where("id=".$id)->getField("addr");
        $contemt = file_get_contents($docment_addr);
       // dump($docment);
        return $contemt;
    }
}