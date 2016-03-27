<?php

namespace Home\Controller;

use Think\Controller;

class DealCommentController extends Controller{

    function index()
    {
        $name_error = array(
            'l不要y',
            '博主',
            '管理员'
        );

        $comment_id = I('post.id');
        $comment_name = I('post.name');
        $comment_content = I('post.content');

        if(is_null($comment_content)||is_null($comment_id)||is_null($comment_name)||in_array($name_error,$comment_name)){
            echo 'false';
            exit();
        }else{
            if($this->addNode($comment_id,$comment_name,$comment_content)){
                echo date('Y-m-j:G:i',time());
                exit();
            }
        }
        echo 'false';
        exit();

    }

    private function addNode($id,$name,$conetnt)
    {
        $article_db = M('articles');

        if(!$article_db){
            return fasle;
        }
        $comment_info = $article_db->where("id = $id")->getField('id,comment_sum,comment_addr')[$id];
        if(empty($comment_info)){
            return false;
        }
        $comment_info['comment_sum'] = intval($comment_info['comment_sum']);
        //第一条评论则添加评论文件和第一条评论
        if (is_null($comment_info['comment_addr'])) {
           $comment_path =  $this->addCommentFile($id,$article_db);
        }else{
            $comment_path = C('COMMENT_PATH').'/'.$comment_info['comment_addr'];
        }
        //添加第一条评论
        $xmldom= new \DOMDocument();
        $xmldom->load($comment_path);
        //获取根节点
        $root = $xmldom->getElementsByTagName('comment')->item(0);
        //创建id属性节点
        $id_node = $xmldom->createAttribute('id');
        //创建Node节点
        $node_node = $xmldom->CreateElement('node');
        //创建name
        $name_node = $xmldom->CreateElement('name');
        //创建date节点
        $date_node = $xmldom->CreateElement('date');
        //创建message节点
        $message_node = $xmldom->CreateElement('message');
        //节点赋值

        $id_node->nodeValue = ++$comment_info['comment_sum'];
        $name_node->nodeValue= base64_encode($name);
        $date_node->nodeValue= time();
        $message_node->nodeValue = base64_encode($conetnt);

        //构建逻辑关系
        $node_node->appendChild($id_node);
        $node_node->appendChild($name_node);
        $node_node->appendChild($date_node);
        $node_node->appendChild($message_node);
        $root->appendChild($node_node);

        if($xmldom->save($comment_path)){
            $article_db->comment_sum = $comment_info['comment_sum'];
            $article_db->where("id = $id")->save();
            return true;
        }
    }
    //添加评论文件
    private function addCommentFile($id,$article_db)
    {
        $xml_mould = '<?xml version="1.0" encoding="utf-8" ?>
            <comment>
            </comment>';
        $comment_file = 'comment_'.$id.'.xml';
        $comment_path = C('COMMENT_PATH').'/'.$comment_file;

        //添加评论文件
        if(file_put_contents($comment_path,$xml_mould)){
            $article_db->comment_addr = $comment_file;
            if(!$article_db->where("id = $id")->save()){
                return false;
            }else{
                return $comment_path;
            }
        }
    }
}