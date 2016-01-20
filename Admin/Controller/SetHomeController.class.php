<?php
namespace Admin\Controller;
use Think\Controller;
class SetHomeController extends Controller {
    public function index()
    {
    	$this->assign("PUBLIC_PATH",C("PUBLIC_PATH"));
    	$this->assign("APP_PATH",C("APP_PATH"));
    	$this->display();
	}
}
