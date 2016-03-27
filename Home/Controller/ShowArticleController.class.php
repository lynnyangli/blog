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

        $comment_arr = $this->getComment($id);
        $this->assign("COMMENT",$this->showComment($comment_arr));

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
    //获取阅读排行
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

    //获取评论信息
    private function getComment($id)
    {

        $data_arr = array();

        $article_db=D("articles");
        $comment_path = $article_db->where("id = $id")->getField('id,comment_addr')[$id];

        //第一条评论则添加评论文件和第一条评论
        if (is_null($comment_path)) {
            return NULL;
        }else{
            $comment_path = C('COMMENT_PATH').'/'.$comment_path;
        }

        $simple_xml = simplexml_load_file($comment_path);

        foreach($simple_xml->children() as $child_node){
            $this->getNode($child_node,$data_arr[]);
        }
        unset($simple_xml);
        return $data_arr;
    }

    //获取评论节点信息
    private function getNode($node, &$arr)
    {
        //$arr['id'] = $node->attributes()['id'][0];
        foreach($node->attributes() as $a=>$b){
            $arr['id'] = (string)$b;
        }

        foreach($node->children() as $child_node) {
            if ($child_node->getName() == 'name') {
                $arr['name'] = base64_decode((string)$child_node);
            } else if ($child_node->getName() == 'date') {
                $arr['date'] = date('Y-m-j:G:i',((string)$child_node));
            }else if ($child_node->getName() == 'node') {
                $this->getNode($child_node, $arr[]);
            }else if($child_node->getName() == 'message') {
                $arr['message'] = base64_decode((string)$child_node);
            }
        }
    }

    function  getCommentHtml($var,$offset)
    {
       // $offset = $offset+10;

       $c_html= <<<EOD
        <div class="panel panel-default" style="margin-left:{$offset}em">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>:{$var['name']}&nbsp;&nbsp;
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>:{$var['date']}
                &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs">回复</button>
            </div>
            <div class="panel-body">
                {$var['message']}
            </div>
        </div>
EOD;

        foreach($var as $v){
            if(is_array($v)){
                $c_html = $c_html.$this->getCommentHtml($v,++$offset);
            }
        }

        return $c_html;
    }
    function showComment($arr)
    {
        $html = '';
        $offset = 1;
        foreach($arr as $var){
            $html = $html.$this->getCommentHtml($var,$offset);
        }
        return $html;
    }
}
