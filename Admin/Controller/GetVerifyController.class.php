<?php
namespace Admin\Controller;
use Think\Controller;
class GetVerifyController extends Controller{
	public function index()
	{
		ob_clean();
		$config =    array(
		 'fontSize'    =>    20,    // 验证码字体大小
		 'length'      =>    4,     // 验证码位数
		 'useNoise'    =>    false, // 关闭验证码杂点
		);
		$Verify =     new \Think\Verify($config);
		$Verify->entry();
	}

}
