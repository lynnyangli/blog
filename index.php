<?php
// 应用入口文件
// 检测PHP环境
//define("BIND_MODULE",'Home2');
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_DEBUG',true);
define('APP_PATH','./');
require './ThinkPHP/ThinkPHP.php';
