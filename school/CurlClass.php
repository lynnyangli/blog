<?php

class Curl {
    private $curl;
    //实例对象时即可实例化$curl
    public function __construct($url = null)
    {
        $init_res = false;
        if(!empty($url)) {
            $init_res = $this->curl = curl_init($url);
        }else{
            $init_res = $this->curl = curl_init();
        }
        if(empty($init_res)){
            return false;
        }
    }
    //参数设置选项
    public function setOpt($opt, $value = null)
    {
        $state = false;

        if( empty($this->curl) ){
            return false;
        }

        if( (!empty($opt)) && (!is_null($value)) ){
            $state = curl_setopt($this->curl,$opt,$value);
        }else if(is_array($opt)) {
            $state = curl_setopt_array($opt);
        }
        return $state;
    }
    //执行会话
    public function exec()
    {
         return curl_exec($this->curl);
    }
    //关闭回合
    public function close()
    {
        return curl_close($this->curl);
    }

    public function __destruct()
    {

    }


}