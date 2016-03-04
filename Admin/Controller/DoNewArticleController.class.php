<?php
namespace Admin\Controller;
use Think\Controller;
class DoNewArticleController extends Controller {
    public function index()
    {
	if(!$this->check_login()){
		$this->error("请登陆","/index.php/Admin/AdminLogin");
	}
        $article=array();
        if($_POST['title']&&$_POST["class"]&&$_POST["content"]&&$_POST['description'])
        {
            $class_id = $this->check_class( base64_encode($_POST['class']));
            if( $class_id === false )
            {
                $this->error("分类错误");
            }
            $article['title'] = base64_encode($_POST['title']);
            $article['class'] = base64_encode($_POST['class']);
            $article['description'] = base64_encode($_POST['description']);
            $article['time'] = time();
            $addr = C('ARTICLE_PATH').'/'.base64_encode($article['name']).time().".xml";
	    $fp = fopen($addr, "w");
            if(!$fp)
            {
                $this->error('文件创建失败');
            }else{
                $content=$_POST["content"];
                if(!fwrite($fp,$content))
                {
                    $this->error("xml写入错误");
                }else{
                    $article['addr']=$addr;
                    $article['state']=0;
                   
                    $article_db=D("articles");
                    if($article_db->add($article))
                    {
                        $this->success("添加成功");
                        return;
                    }
                    else
                    {
                        $this->error("添加失败");
                    }
                }
                fclose($fp);
            }
            
        }
        $this->error("数据不可为空");
    }
    private function check_class($class_name)
    {
        $class_db =D("class"); 
        $id=$class_db->where('name='.$class_name)->getField("id");
        if($id!=null){
            return false;
        }else{
            return $id; 
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
